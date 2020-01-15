<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);





if (isset($_POST["m_operation_id"]) && isset($_POST["m_sign"]))
{
	$m_key = $config->secretW_serf;
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
	if ($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success")
	{

	$db->Query("SELECT * FROM db_serfing_insert WHERE id = '".intval($_POST['m_orderid'])."'");
	if($db->NumRows() == 0){ echo $_POST['m_orderid']."|error"; exit;}

	$payeer_row = $db->FetchArray();
	if($payeer_row["status"] > 0){ echo $_POST['m_orderid']."|success"; exit;}

	$db->Query("UPDATE db_serfing_insert SET status = '1' WHERE id = '".intval($_POST['m_orderid'])."'");

	$ik_payment_amount = $payeer_row["sum"];
	$user_id = $payeer_row["user_id"];

	# Настройки
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();

   $db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
   $user_ardata = $db->FetchArray();
   $user_name = $user_ardata["user"];
   $refid = $user_ardata["referer_id"];

   # Зачисляем баланс
   $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmr"] * $ik_payment_amount) );

   $db->Query("SELECT insert_serf FROM db_users_b WHERE id = '{$user_id}' LIMIT 1");
   $ins_sum = $db->FetchRow();

   $serebro = intval($ins_sum <= 0.01) ? ($serebro + ($serebro * 0.00) ) : $serebro;
   $add_tree = ( $ik_payment_amount >= 00.0) ? 0 : 0;
   $lsb = time();
   $to_referer = ($serebro * 0.00);

   $db->Query("UPDATE db_users_b SET money_serf = money_serf + '$serebro', e_t = e_t + '$add_tree', to_referer = to_referer + '$to_referer',/* last_sbor = '$lsb',*/ insert_serf = insert_serf + '$ik_payment_amount' WHERE id = '{$user_id}'");



   # Зачисляем средства рефереру и дерево
   $add_tree_referer = ($ins_sum <= 0.01) ? ", a_t = a_t + 0" : "";
   $db->Query("UPDATE db_users_b SET money_serf = money_serf + $to_referer, from_referals = from_referals + '$to_referer' {$add_tree_referer} WHERE id = '$refid'");

   # Статистика пополнений
   $da = time();
   $dd = $da + 60*60*24*15;
   $db->Query("INSERT INTO db_insert_money (val, plat, status, user, user_id, money, serebro, date_add, date_del) VALUES ('RUB','Payeer-Serf','0','$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");

     # Конкурс
	$competition = new competition($db);
	$competition->UpdatePoints($user_id, $ik_payment_amount);

   # Обновление статистики сайта
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");
$wmset = new wmset();
   $marray = $wmset->GetSet($ik_payment_amount);
   $a_t = intval($marray["t_a"]);
   $b_t = intval($marray["t_b"]);
   $c_t = intval($marray["t_c"]);
   $d_t = intval($marray["t_d"]);
   $e_t = intval($marray["t_e"]);
$db->Query("UPDATE db_users_b SET a_t = a_t + '$a_t', b_t = b_t + '$b_t', c_t = c_t + '$c_t', d_t = d_t + '$d_t', e_t = e_t + '$e_t'/*, last_sbor = '$lsb'*/ WHERE id = '{$user_id}'");

	echo $_POST['m_orderid']."|success";
	exit;


	}
	echo $_POST['m_orderid']."|error";
}
?>