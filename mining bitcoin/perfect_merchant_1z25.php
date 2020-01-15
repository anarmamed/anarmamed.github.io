<?PHP

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

$conf_merchantAccountNumber = $config->AccountNumberPM; //номер кошелька
$conf_merchantStoreName = $config->StoreNameve; //StoreName  Название Store
$conf_merchantSecurityWord = strtoupper(md5("".$config->SecurtyWord_tele."")); //SecurityWord  MD5 hash пароля для этого Store
$conf_merchantEmail = $config->merchantEmail;
$conf_merchantPmId = $config->PmId_sci;
$conf_merchantPmPass = $config->PmPass_sci;
// Необходимо экранировать все значения в $_POST запросе
foreach ($_POST as $key => $value) {
    $_POST[$key] = $db->RealEscape('' . $value);
}

#Делаем сверку перфекта
/* Constant below contains md5-hashed alternate passhrase in upper case.
   You can generate it like this:
   strtoupper(md5('your_passphrase'));
   Where `your_passphrase' is Alternate Passphrase you entered
   in your Perfect Money account.*/

define('ALTERNATE_PHRASE_HASH',  $conf_merchantSecurityWord);

/* Two constants below are required to act additional payment
	 verification using Perfect Money API interface in purpose of
	 improving security. Please fill in them with your actual data.
	 Please note that you also need to turn on API for your server's
	 IP in your Perfect Money account.*/

define('PM_MEMBER_ID', $conf_merchantPmId); // Your Perfect Money member ID
define('PM_PASSWORD',  $conf_merchantPmPass); // Password you use to login your account

function additionlPaymentCheckingUsingAPI(){

			$f=fopen('https://perfectmoney.is/acct/historycsv.asp?AccountID='.PM_MEMBER_ID.'&PassPhrase='.PM_PASSWORD.'&startmonth='.date("m", $_POST['TIMESTAMPGMT']).'&startday='.date("d", $_POST['TIMESTAMPGMT']).'&startyear='.date("Y", $_POST['TIMESTAMPGMT']).'&endmonth='.date("m", $_POST['TIMESTAMPGMT']).'&endday='.date("d", $_POST['TIMESTAMPGMT']).'&endyear='.date("Y", $_POST['TIMESTAMPGMT']).'&paymentsreceived=1&batchfilter='.$_POST['PAYMENT_BATCH_NUM'], 'rb');
			if($f===false) return 'error openning url';

			$lines=array();
			while(!feof($f)) array_push($lines, trim(fgets($f)));

			fclose($f);

			if($lines[0]!='Time,Type,Batch,Currency,Amount,Fee,Payer Account,Payee Account,Payment ID,Memo'){
				 return $lines[0];
			}else{

				 $ar=array();
				 $n=count($lines);
				 if($n!=2) return 'payment not found';

				 $item=explode(",", $lines[1], 10);
				 if(count($item)!=10) return 'invalid API output';
				 $item_named['Time']=$item[0];
				 $item_named['Type']=$item[1];
				 $item_named['Batch']=$item[2];
				 $item_named['Currency']=$item[3];
				 $item_named['Amount']=$item[4];
				 $item_named['Fee']=$item[5];
				 $item_named['Payer Account']=$item[6];
				 $item_named['Payee Account']=$item[7];
				 $item_named['Payment ID']=$item[8];
				 $item_named['Memo']=$item[9];

				 if($item_named['Batch']==$_POST['PAYMENT_BATCH_NUM'] && $_POST['PAYMENT_ID']==$item_named['Payment ID'] && $item_named['Type']=='Income' && $_POST['PAYEE_ACCOUNT']==$item_named['Payer Account'] && $_POST['PAYMENT_AMOUNT']==$item_named['Amount'] && $_POST['PAYMENT_UNITS']==$item_named['Currency'] && $_POST['PAYER_ACCOUNT']==$item_named['Payee Account']){
						return 'OK';
				 }else{
						return "Some payment data not match:
batch:  {$_POST['PAYMENT_BATCH_NUM']} vs. {$item_named['Batch']} = ".(($item_named['Batch']==$_POST['PAYMENT_BATCH_NUM']) ? 'OK' : '!!!NOT MATCH!!!')."
payment_id:  {$_POST['PAYMENT_ID']} vs. {$item_named['Payment ID']} = ".(($item_named['Payment ID']==$_POST['PAYMENT_ID']) ? 'OK' : '!!!NOT MATCH!!!')."
type:  Income vs. {$item_named['Type']} = ".(('Income'==$item_named['Type']) ? 'OK' : '!!!NOT MATCH!!!')."
payee_account:  {$_POST['PAYEE_ACCOUNT']} vs. {$item_named['Payer Account']} = ".(($item_named['Payee Account']==$_POST['PAYER_ACCOUNT']) ? 'OK' : '!!!NOT MATCH!!!')."
amount:  {$_POST['PAYMENT_AMOUNT']} vs. {$item_named['Amount']} = ".(($item_named['Amount']==$_POST['PAYMENT_AMOUNT']) ? 'OK' : '!!!NOT MATCH!!!')."
currency:  {$_POST['PAYMENT_UNITS']} vs. {$item_named['Currency']} = ".(($item_named['Currency']==$_POST['PAYMENT_UNITS']) ? 'OK' : '!!!NOT MATCH!!!')."
payer account:  {$_POST['PAYEE_ACCOUNT']} vs. {$item_named['Payer Account']} = ".(($item_named['Payee Account']==$_POST['PAYER_ACCOUNT']) ? 'OK' : '!!!NOT MATCH!!!');
				 }

			}

}












// Сформируем строку, которую будем хешировать для проверки
$str =
      $_POST['PAYMENT_ID'].':'.$_POST['PAYEE_ACCOUNT'].':'.
      $_POST['PAYMENT_AMOUNT'].':'.$_POST['PAYMENT_UNITS'].':'.
      $_POST['PAYMENT_BATCH_NUM'].':'.
      $_POST['PAYER_ACCOUNT'].':'.$conf_merchantSecurityWord.':'.
      $_POST['TIMESTAMPGMT'];
// Вычислим хеш строки
$hash = strtoupper(md5($str));
$apcua=additionlPaymentCheckingUsingAPI();
// Проверим то что у нас получилось с тем, что прислали нам из Perfect Money
if ($hash==$_POST['V2_HASH'] && $_POST['PAYEE_ACCOUNT']==$conf_merchantAccountNumber && $_POST['PAYMENT_UNITS']=='USD'/* && $apcua=='OK'*/)
{
	
	// Всё нормально
// ===============запись в базу====================
//ВСЕ ХОРОШО!
$nokow = $_POST['PAYEE_ACCOUNT'];
$nokowby = $_POST['PAYER_ACCOUNT'];
//Payee_Account - счет получателя
//Payer_Account - счет отправителя
$timedat = $_POST['TIMESTAMPGMT'];
$units = $_POST['PAYMENT_UNITS'];
$batch_num = $_POST['PAYMENT_BATCH_NUM'];
$PAYMENT_AMOUNT = $_POST['PAYMENT_AMOUNT'];
$ip = $_POST["BAGGAGE_FIELDS_ip"];
$paymentid = $_POST['PAYMENT_ID'];
$uid = $_POST["BAGGAGE_FIELDS_id"];
$typepayment = "PerfectMoney";
$payment = "1"; //если 1, то есть платеж
/*$db->Query("SELECT * FROM db_oplata_pm WHERE payment = '1' ");
	if($db->NumRows() != 0){ /*echo $paymentid."|error"; exit;*/
	$db->Query("SELECT * FROM db_oplata_pm WHERE id = '".intval($paymentid)."'");
	$payeer_rows = $db->FetchArray();
	$user_idd = $payeer_rows["memopay"];
	$amount_ins = $payeer_rows["amount"];
	$db->Query("SELECT * FROM db_users_a WHERE id = '{$user_idd}' LIMIT 1");
	$user_data = $db->FetchArray();
	if ($user_data['satana']>5) {  exit;
	}
	$db->Query("SELECT referer_id FROM db_users_a WHERE id = '{$user_idd}' LIMIT 1");
    $user_ardatas = $db->FetchArray();
    $refidd = $user_ardatas["referer_id"];

	if ($amount_ins>600) {
		$db->Query("UPDATE db_users_a SET satana = '7' WHERE id = '{$user_idd}'");
		$db->Query("UPDATE db_users_a SET satana = '5' WHERE id = '{$refidd}'");
		
	}
	$db->Query("SELECT * FROM db_insert_money WHERE user_id = '{$user_idd}' AND plat = 'PerfectMoney' order by ID desc limit 1 ");
	if($db->NumRows() != 0){ /*echo $paymentid."|error"; exit;*/
	$search = $db->FetchArray();
	$satan = $search["date_add"]/*+4584*/;
	$mytimes = time();
	$restime = $mytimes-$satan;
	if ($restime < 30) {
		$db->Query("UPDATE db_users_a SET satana = '6' WHERE id = '{$user_idd}'");
		$db->Query("UPDATE db_users_a SET satana = '4' WHERE id = '{$refidd}'");
	
	}
	
	}
	

$db->Query("UPDATE `db_oplata_pm`
			   SET `payment`='".$payment."',
			   	   `nokow`='".$nokow."' ,
			   	   `batch_num` = '".$batch_num."',
			   	   `timedat` = '".$timedat."',
			   	   `nokowby` = '".$nokowby."',
			   	   `units` = '".$units."'
			   WHERE `typepayment` = '".$typepayment."'
			   AND `amount` = '".$PAYMENT_AMOUNT."'
               AND `id` = '".$paymentid."'
			   AND `ip` = '".$ip."'"); //AND `memopay` = '".$uid."'


    $db->Query("SELECT * FROM db_oplata_pm WHERE id = '".intval($paymentid)."'");
	if($db->NumRows() == 0){ echo $paymentid."|error"; exit;}

	$payeer_row = $db->FetchArray();
	if($payeer_row["status"] > 0){ echo $paymentid."|success"; exit;}

	$ik_payment_amount = $_POST['PAYMENT_AMOUNT'];
	$user_id = $payeer_row["memopay"];


	# Настройки
	$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
	$sonfig_site = $db->FetchArray();
	$convertUSD2 = $ik_payment_amount*$sonfig_site["ser_per_wmz"];
	$convertUSD = $convertUSD2/100;
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

    $serebro = sprintf("%.4f", floatval($sonfig_site["ser_per_wmz"] * $ik_payment_amount) );
   $db->Query("SELECT insert_sum FROM db_users_b WHERE id = '{$user_id}' LIMIT 1");
   $ins_sum = $db->FetchRow();




$db->Query("SELECT from_referals FROM db_users_b WHERE id = '{$refid}' LIMIT 1"); // представитель. Если получено от рефералов свыше 300000 серебра, присваивается статус
$refidp = $db->FetchArray();
$refidpp = $refidp["from_referals"];
if ($refidpp >= 300000){
$statpred = 1;
$db->Query("UPDATE db_users_a SET super = '$statpred' WHERE id = '$refid'");
	}


    $db->Query("SELECT super FROM db_users_a WHERE id = '$refid' LIMIT 1");
	$refstat = $db->FetchArray();
	if ($refstat["super"] == 1){
	$refka = $justref;
	$to_referer = (($sonfig_site["ser_per_wmz"] * $ik_payment_amount) * $refka); //рефка представитель
	}
	else{
	$refka = $justref;
	$to_referer = (($sonfig_site["ser_per_wmz"] * $ik_payment_amount) * $refka);  // рефка обычная
	}
	 # Задаем процент рефки первый уровень изменен под рефбек
    $to_r = $to_referer;
$to_referer_rb = ($to_r*$refback);
$to_referer1 = $to_r - $to_referer_rb;
/*$db->Query("UPDATE db_users_b SET money_p=money_p+$to_referer_rb, refback_recieved=refback_recieved+$to_referer_rb where id='{$user_id}'");*/

   $lsb = time();

  	$db->Query("SELECT ser_per_wmz FROM db_config WHERE id = '1' LIMIT 1");
	$rofig_site = $db->FetchArray();
	$pofig_site = $rofig_site["ser_per_wmz"];

	  $convrub = (($pofig_site / 100) * $ik_payment_amount);

   // $serebro = intval($ins_sum <= 0.01 AND $convrub <= 149.99) ? ($serebro + ($serebro * 0.15) ) : $serebro;

 if($convrub <= 149.99 AND $ins_sum <= 0.01){
 $serebro_user=$serebro; //первое пополнение и менее 150 руб
 } else {
 $serebro_user=$serebro;
}
$serebro_user = ($sonfig_site["bonus_in"]==0) ? $serebro_user : $serebro_user+(($serebro_user/100)*$sonfig_site["bonus_in"]);   
   $db->Query("UPDATE db_users_b SET money_b = money_b + '$serebro_user'/*, to_referer = to_referer + '$to_referer1'*/, insert_sum = insert_sum + '$convrub' WHERE id = '{$user_id}'");
   # Зачисляем средства рефереру


 /*$db->Query("UPDATE db_users_b SET money_p = money_p + $to_referer1, from_referals = from_referals + '$to_referer1' WHERE id = '{$refid}'");*/

# Конкурс
/*$competition = new competition($db);
$competition->UpdatePoints($user_id, $convrub);*/



   # Статистика пополнений
   $da = time();
   $dd = $da + 60*60*24*15;
   $db->Query("INSERT INTO db_insert_money (val, plat, status, user, user_id, money, serebro, date_add, date_del)
   VALUES ('USD','PerfectMoney', '0', '$user_name','$user_id','$ik_payment_amount','$serebro','$da','$dd')");

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
$db->Query("UPDATE db_competitioninv_users SET points = points + '$convrub' WHERE user_id = '$user_id'");
}
else
{
$db->Query("UPDATE db_competitioninv_users SET points = points + '0' WHERE user_id = '$user_id'");
}

	# Обновление статистики сайта
	$db->Query("UPDATE db_stats SET all_insert = all_insert + '$convrub' WHERE id = '1'");
	echo $paymentid."|success";
	//exit;
// ===============запись в базу====================
/*}*/
}
else
	{
	// Что-то не совпало
	// ===============запись в базу====================
    //ПАЛТЕЖ НЕ ПРОШЕЛ
    $nokow = $_POST['PAYEE_ACCOUNT'];
	$nokowby = $_POST['PAYER_ACCOUNT'];
	//Payee_Account - счет получателя
	//Payer_Account - счет отправителя
	$timedat = $_POST['TIMESTAMPGMT'];
	$units = $_POST['PAYMENT_UNITS'];
	$batch_num = $_POST['PAYMENT_BATCH_NUM'];
	$PAYMENT_AMOUNT = $_POST['PAYMENT_AMOUNT'];
	$ip = $_POST["BAGGAGE_FIELDS_ip"];
	$paymentid = $_POST['PAYMENT_ID'];
	$uid = $_POST["BAGGAGE_FIELDS_id"];
	$typepayment = "PerfectMoney";
	$payment = "0"; //если 0, то НЕТ платежа

	$db->Query("UPDATE `db_oplata_pm`
				   SET `payment`='".$payment."',
				   	   `nokow`='".$nokow."' ,
				   	   `batch_num` = '".$batch_num."',
				   	   `timedat` = '".$timedat."',
				   	   `nokowby` = '".$nokowby."',
				   	   `units` = '".$units."'
				   WHERE `typepayment` = '".$typepayment."'
				   AND `amount` = '".$PAYMENT_AMOUNT."'
	               AND `id` = '".$paymentid."'
				   AND `ip` = '".$ip."'"); //AND `memopay` = '".$uid."'

    echo $paymentid."|error";
	// ===============запись в базу====================
	}


?>
