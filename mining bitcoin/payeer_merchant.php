<?PHP
######################################
# Автор shans5
# Форум svalka58.ru
#  
#  
######################################
# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

 if (isset($_POST["m_operation_id"]) && isset($_POST["m_sign"])){
	$m_key = $config->secretW;
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);

	$sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));
	if ($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success"){
$db->Query("SELECT * FROM db_payeer_insert WHERE id = '".intval($_POST['m_orderid'])."'");
	if($db->NumRows() == 0){ echo $_POST['m_orderid']."|error"; exit;}
	$payeer_row = $db->FetchArray();
	if($payeer_row["status"] > 0){ echo $_POST['m_orderid']."|success"; exit;}
$db->Query("UPDATE db_payeer_insert SET status = '1' WHERE id = '".intval($_POST['m_orderid'])."'");

	$ik_payment_amount = $payeer_row["sum"];
	$user_id = $payeer_row["user_id"];

	# Настройки
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();

$db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
   $user_ardata = $db->FetchArray();
  $user_name = $user_ardata["user"];
   $refid = $user_ardata["referer_id"];
   # Добавили часть кода рефбека
   $db->Query("SELECT * from db_users_a WHERE id = '{$refid}'"); 
$rf_data=$db->FetchArray(); 
$refback=$rf_data["refback"]/100;
$add_ref_bonus = $rf_data["add_ref_bonus"]/100;
$justref = 0.05+$add_ref_bonus;
   # Зачисляем баланс

   $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmr"] * $ik_payment_amount) );

   $db->Query("SELECT insert_sum FROM db_users_b WHERE id = '{$user_id}' LIMIT 1");
   $ins_sum = $db->FetchRow();

     // $serebro = intval($ins_sum <= 0.01) ? ($serebro + ($serebro * 0.5) ) : $serebro;
   $lsb = time();
  $db->Query("SELECT user, referer_id, referer_id2, referer_id3 FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
    $user_ardata = $db->FetchArray();
    $ref2 = $user_ardata["referer_id2"];
    $ref3 = $user_ardata["referer_id3"];


    # Задаем процент рефки первый уровень изменен под рефбек
    $to_r = ($serebro * $justref); 
$to_referer_rb = ($to_r*$refback); 
$to_referer = $to_r - $to_referer_rb; 
$db->Query("UPDATE db_users_b SET money_p=money_p+$to_referer_rb, refback_recieved=refback_recieved+$to_referer_rb where id='{$user_id}'");  // Первый уровень - 5 процентов
    // $to_referer2 = ($serebro * 0.08); // Второй уровень - 8 процента
    // $to_referer3 = ($serebro * 0.03); // Третий уровень - 3 процент


    // $db->Query("UPDATE db_users_b SET money_b = money_b + $to_referer2 WHERE id = '$ref2'");
    // $db->Query("UPDATE db_users_b SET money_b = money_b + $to_referer3 WHERE id = '$ref3'");

    // $db->Query("UPDATE db_users_a SET doxod2 = doxod2 + $to_referer2 WHERE id = '$user_id'");
    // $db->Query("UPDATE db_users_a SET doxod3 = doxod3 + $to_referer3 WHERE id = '$user_id'");

   $add_tree = ( $ik_payment_amount >= 600) ? 1 : 0;
   $serebro = ($sonfig_site["bonus_in"]==0) ? $serebro : $serebro+(($serebro/100)*$sonfig_site["bonus_in"]); 
   $db->Query("UPDATE db_users_b SET money_b = money_b + '$serebro', to_referer = to_referer + '$to_referer', insert_sum = insert_sum + '$ik_payment_amount' WHERE id = '{$user_id}'");

   # Зачисляем средства рефереру и дерево
 $add_tree_referer = ($ins_sum <= 0.01) ? ", a_t = a_t + 0" : "";
   $db->Query("UPDATE db_users_b SET money_p = money_p + $to_referer, from_referals = from_referals + '$to_referer' WHERE id = '$refid'");
  
   # Статистика пополнений
   $da = time();
   $dd = $da + 60*60*24*15;
$db->Query("INSERT INTO db_insert_money (val, plat, status, user, user_id, money, serebro, date_add, date_del) VALUES ('RUB','Payeer', '0', '$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");

   # Конкурс рефералов
$competition = new competition($db);
$competition->UpdatePoints($user_id, $ik_payment_amount);
   # Конкурс инвесторов
$db->Query("SELECT * FROM db_competitioninv_users WHERE user_id = '{$user_id}'");
$in = $db->FetchArray();

    
$a=$in["user_id"];
if($a > 0)
{
$usname = $user_name;
}
else
{
$usname = $user_name;
$db->Query("INSERT INTO db_competitioninv_users (user, user_id, points) VALUES ('$usname','$user_id','0')");
}

$db->Query("SELECT * FROM db_competitioninv WHERE status = '0' LIMIT 1");
$invcomp = $db->FetchArray();

$db->Query("SELECT COUNT(*) FROM db_competitioninv_users WHERE user_id = '{$user_id}'");
$rett = $db->FetchArray();

if ($invcomp["date_add"] >= 0 AND $invcomp["date_end"] > $da)
{
$db->Query("UPDATE db_competitioninv_users SET points = points + '$ik_payment_amount' WHERE user_id = '$user_id'");
}
else
{
$db->Query("UPDATE db_competitioninv_users SET points = points + '0' WHERE user_id = '$user_id'");
}
 

	# Обновление статистики сайта
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");
$wmset = new wmset();
   $marray = $wmset->GetSet($ik_payment_amount);
   $a_t = intval($marray["t_a"]);
   $b_t = intval($marray["t_b"]);
   $c_t = intval($marray["t_c"]);
   $d_t = intval($marray["t_d"]);
   $e_t = intval($marray["t_e"]);
$db->Query("UPDATE db_users_b SET a_t = a_t + '$a_t', b_t = b_t + '$b_t', c_t = c_t + '$c_t', d_t = d_t + '$d_t', e_t = e_t + '$e_t' WHERE id = '{$user_id}'");

	echo $_POST['m_orderid']."|success";
	exit;
	}
	echo $_POST['m_orderid']."|error";
}
?>