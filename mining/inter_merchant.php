<?PHP
# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

//extract($_POST);

$fk_merchant_id = '100916'; //merchant_id ID мазагина в free-kassa.ru (http://free-kassa.ru/merchant/cabinet/help/)
$fk_merchant_key = 'zqd26789'; //Секретное слово http://free-kassa.ru/merchant/cabinet/profile/tech.php
$fk_merchant_key2 = 'vkgayz9r'; //Секретное слово2 (result) http://free-kassa.ru/merchant/cabinet/profile/tech.php

$ik_payment_amount = round(floatval($_POST['AMOUNT']),2);
$user_id = $_POST['us_id'];
	
$hash = md5($fk_merchant_id.":".$_POST['AMOUNT'].":".$fk_merchant_key2.":".$_POST['MERCHANT_ORDER_ID']);

if ($hash != $_POST['SIGN']) die("SumError");
    
   
   	# Настройки
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();
   
   $db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
   $user_ardata = $db->FetchArray();
   $user_name = $user_ardata["user"];
   $refid = $user_ardata["referer_id"];

   
   $db->Query("SELECT * from db_users_a WHERE id = '{$refid}'"); 
$rf_data=$db->FetchArray(); 
$refback=$rf_data["refback"]/100;
$add_ref_bonus = $rf_data["add_ref_bonus"]/100;
$justref = 0.05+$add_ref_bonus;
    # Зачисляем баланс
   $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmr"] * $ik_payment_amount) );
   
    #--------
   $db->Query("SELECT insert_sum FROM db_users_b WHERE id = '{$user_id}'LIMIT 1");
   $ins_sum = $db->FetchRow();
   
    // $serebro = intval($ins_sum <= 0.01) ? ($serebro + ($serebro * 0.50) ) : $serebro;
   $add_tree  = ( $ik_payment_amount >= 700)  ? 1 : 0;
   $lsb = time();
   $db->Query("SELECT user, referer_id, referer_id2, referer_id3 FROM db_users_a WHERE id = '{$user_id}' LIMIT 1");
    $user_ardata = $db->FetchArray();
    $ref2 = $user_ardata["referer_id2"];
    $ref3 = $user_ardata["referer_id3"];


    # Задаем процент рефки
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
   $serebro = ($sonfig_site["bonus_in"]==0) ? $serebro : $serebro+(($serebro/100)*$sonfig_site["bonus_in"]); 
   $db->Query("UPDATE db_users_b SET money_b = money_b + '$serebro', to_referer = to_referer + '$to_referer',  insert_sum = insert_sum + '$ik_payment_amount' WHERE id = '{$user_id}'");
   
   # Зачисляем средства рефереру
   
  $db->Query("UPDATE db_users_b SET money_p = money_p + $to_referer, from_referals = from_referals + '$to_referer' WHERE id = '$refid'");
   
   # Статистика пополнений
   $da = time();
  $dd = $da + 60*60*24*15;
   $db->Query("INSERT INTO db_insert_money (val, plat, status, user, user_id, money, serebro, date_add, date_del) 
   VALUES ('RUB','Free-Kassa', '0', '$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");
   
    # Конкурс
$competition = new competition($db);
$competition->UpdatePoints($user_id, $ik_payment_amount);
   
   # Обновление статистики сайта
   $db->Query("UPDATE db_stats SET all_insert = all_insert + '$ik_payment_amount' WHERE id = '1'");


?>