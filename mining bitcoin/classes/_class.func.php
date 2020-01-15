<?PHP
class func{

	public $UserIP = "Undefined"; # IP пользователя
	public $UserCode = "Undefined"; # Код от IP
	public $TableID = -1; # ID таблицы
	public $UserAgent = "Undefined"; // Браузер пользователя

	/*======================================================================*\
	Function:	__construct
	Output:		Нет
	Descriiption: Выполняется при создании экземпляра класса
	\*======================================================================*/
	public function __construct(){
		$this->UserIP = $this->GetUserIp();
		$this->UserCode = $this->IpCode();
		$this->UserAgent = $this->UserAgent();
	}

	/*======================================================================*\
	Function:	__destruct
	Output:		Нет
	Descriiption: Уничтожение объекта
	\*======================================================================*/
	public function __destruct(){

	}



	/*======================================================================*\
	Function:	IpToLong
	Descriiption: Преобразует IP в целочисленное
	\*======================================================================*/
	public function IpToInt($ip){

		$ip = ip2long($ip);
		($ip < 0) ? $ip+=4294967296 : true;
		return $ip;
	}


	/*======================================================================*\
	Function:	IpToLong
	Descriiption: Преобразует целочисленное в IP
	\*======================================================================*/
	public function IntToIP($int){
  		return long2ip($int);
	}

	/*======================================================================*\
	Function:	declOfNum
	Descriiption: Склоненяет русские слова
	Пример: $data = $func->declOfNum( $data, array('рубль', 'рубля', 'рублей'));
	\*======================================================================*/
	function declOfNum($number, $titles)
	{
		$cases = array (2, 0, 1, 1, 1, 2);
		return $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
	}


	/*======================================================================*\
	Function:	GetUserIp
	Output:		UserIp
	Descriiption: Определяет IP пользователя
	\*======================================================================*/
	public function GetUserIp(){

		if($this->UserIP == "Undefined"){

			if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND !empty($_SERVER['HTTP_X_FORWARDED_FOR']))
   			{

			$client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );
      		$entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);


      		reset($entries);

				while (list(, $entry) = each($entries))
				{
				$entry = trim($entry);
					if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
				 	{

					$private_ip = array(
						  '/^0\./',
						  '/^127\.0\.0\.1/',
						  '/^192\.168\..*/',
						  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
						  '/^10\..*/');

						$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

						if ($client_ip != $found_ip)
						{
					   	$client_ip = $found_ip;
					   	break;
						}

					}

				}

			$this->UserIP = $client_ip;
			return $client_ip;

			}else return ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );

		}else return $this->UserIP;

	}


	/*======================================================================*\
	Function:	IsLogin
	Output:		True / False
	Input:		Строка логина, Маска, Длина ("10, 25") && ("10")
	Descriiption: Проверяет правильность ввода логина
	\*======================================================================*/
	public function IsLogin($login, $mask = "^[a-zA-Z0-9]", $len = "{4,10}"){

		return (is_array($login)) ? false : (preg_match("/{$mask}{$len}$/", $login)) ? $login : false;

	}

	/*======================================================================*\
	Function:	IsPassword
	Output:		True / False
	Input:		Строка пароля, Маска, Длина ("10, 25") && ("10")
	Descriiption: Проверяет правильность ввода пароля
	\*======================================================================*/
	public function IsPassword($password, $mask = "^[a-zA-Z0-9]", $len = "{4,20}"){

		return (is_array($password)) ? false : (preg_match("/{$mask}{$len}$/", $password)) ? $password : false;

	}
	/*======================================================================*\
	Function:	Склонение русских слов
	\*======================================================================*/
	public function smart_ending($number, $forms, $base = '') 
	{
	  $rest = $number % 10;
	  $number = (int) substr($number, -2, 2);
	  if ($rest == 1 && $number != 11) return $base.$forms[0];
	  elseif (in_array($rest, array(2, 3, 4)) && !in_array($number, array(12, 13, 14))) return $base.$forms[1];
	  else return $base.$forms[2];
	}
	/*======================================================================*\
	Function:	Перевод даты в дни часы мин сек
	\*======================================================================*/
	public function ConvertTime($val)
	{
		$time = (int)$val;
		$m = floor($time / 60);
		$h = floor($m / 60);
		$d = floor($h / 24);
		$h = $h - $d*24;
		$m = $m - $d*24*60 - $h*60;
		$s = $time - $m*60 - $h*60*60 - $d*24*60*60;
	   if($d != 0) return "$d d $h h $m min";
	   if($h != 0) return "$h h $m min $s sec";
	   if($m != 0) return "$m min $s sec";
	   if($s != 0) return "$s sec";
	}
	/*======================================================================*\
	Function:	IsWM
	Output:		True / False
	Input:		Реквизит, TYPE: 0 - WMID, 1 - WMR, 2 - WMZ, 3 - WME, 4 - WMU
	Descriiption: Проверяет правильность ввода пароля
	\*======================================================================*/
	public function IsWM($data, $type = 0){

		$FirstChar = array( 1 => "R",
							2 => "Z",
							3 => "E",
							4 => "U");

		if(strlen($data) < 12 && strlen($data) > 12 && $type < 0 && $type > count($FirstChar)) return false;
			if($type == 0) return (is_array($data)) ? false : ( preg_match("^[0-9]{12}$", $data) ? $data : false );
				if( substr(strtoupper($data),0,1) != $FirstChar[$type] or !preg_match("^[0-9]{12}", substr($data,1)) ) return false;

			return $data;
	}

	/*======================================================================*\
	Function:	IsMail
	Output:		True / False
	Input:		Email
	Descriiption: Проверяет правильность ввода email адреса
	\*======================================================================*/
	public function IsMail($mail){

		if(is_array($mail) && empty($mail) && strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
			return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? false : strtolower($mail);

	}

	/*======================================================================*\
	Function:	IpCode
	Output:		String, Example 255025502550255
	Input:		-
	Descriiption: Возвращает IP с замененными знаками "." на "0"
	\*======================================================================*/
	public function IpCode(){

		$arr_mask = explode(".",$this->GetUserIp());
		return $arr_mask[0].".".$arr_mask[1].".".$arr_mask[2].".0";

	}

	/*======================================================================*\
	Function:	GetTime
	Descriiption: Возвращаер дату
	\*======================================================================*/
	public function GetTime($tis = 0, $unix = true, $template = "d.m.Y H:i:s"){

		if($tis == 0){
			return ($unix) ? time() : date($template,time());
		}else return date($template,$unix);
	}

	/*======================================================================*\
	Function:	UserAgent
	Descriiption: Возвращает браузер пользователя
	\*======================================================================*/
	public function UserAgent(){

		return $this->TextClean($_SERVER['HTTP_USER_AGENT']);

	}

	/*======================================================================*\
	Function:	TextClean
	Descriiption: Очистка текста
	\*======================================================================*/
	public function TextClean($text){

		$array_find = array("`", "<", ">", "^", '"', "~", "\\");
		$array_replace = array("&#96;", "&lt;", "&gt;", "&circ;", "&quot;", "&tilde;", "");



		return str_replace($array_find, $array_replace, $text);

	}

	/*======================================================================*\
	Function:	ShowError
	Descriiption: Выводит список ошибок строкой
	\*======================================================================*/
	public function ShowError($errorArray = array(), $title = "Исправьте следующие ошибки"){

		if(count($errorArray) > 0){

		$string_a = "<div class='Error'><div class='ErrorTitle'>".$title."</div><ul>";

			foreach($errorArray as $number => $value){

				$string_a .= "<li>".($number+1)." - ".$value."</li>";

			}

		$string_a .= "</ul></div><BR />";
		return $string_a;
		}else return "Неизвестная ошибка :(";

	}


	/*======================================================================*\
	Function:	ComissionWm
	Descriiption: Возвращает комиссию WM
	\*======================================================================*/
	public function ComissionWm($sum, $com_payee, $com_payysys){

		$a = ceil(ceil($sum * $com_payee * 100) / 10000*100) / 100;
		$b = ceil(ceil($sum * str_replace("%","",$com_payysys) * 100) / 10000*100) / 100;
		return $a+$b;
	}

	/*======================================================================*\
	Function:	md5Password
	Descriiption: Возвращает md5_пароля
	\*======================================================================*/
	public function md5Password($pass){
		$pass = strtolower($pass);
		return md5("shark_md5"."-".$pass);

	}



	/*======================================================================*\
	Function:	ControlCode
	Descriiption: Возвращает контрольное число
	\*======================================================================*/
	public function ControlCode($time = 0){

		return ($time > 0) ? date("Ymd", $time) : date("Ymd");

	}


	/*======================================================================*\
	Function:	SumCalc
	Descriiption: Возвращает сумму овощей
	\*======================================================================*/
	public function SumCalc($per_h, $sum_tree, $last_sbor){

		if($last_sbor > 0){

			if($sum_tree > 0 AND $per_h > 0){

				$last_sbor = ($last_sbor < time()) ? (time() - $last_sbor) : 0;

				$per_sec = $per_h / 3600;

				return round( ($per_sec * $sum_tree) * $last_sbor);

			}else return 0;

		}else return 0;

	}


	/*======================================================================*\
	Function:	SellItems
	Descriiption: Выводит сумму и остаток
	\*======================================================================*/
	public function SellItems($all_items, $for_one_coin){

		if($all_items <= 0 OR $for_one_coin <= 0) return 0;

		return sprintf("%.2f", ($all_items / $for_one_coin));

	}

/*======================================================================*\
	Function:	PmBalance
	Descriiption: Проверка баланса на PerfectMoney
	\*======================================================================*/
	function PmBalance($PmId, $PmPass){
        $f=fopen('https://perfectmoney.is/acct/balance.asp?AccountID='.$PmId.'&PassPhrase='.$PmPass.'', 'rb');

		if($f===false){
			echo 'error openning url';
		}

		// getting data
		$out=array(); $out="";
		while(!feof($f)) $out.=fgets($f);

		fclose($f);

		// searching for hidden fields
		if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
			echo 'Ivalid output';
			exit;
		}

		$ar="";
		foreach($result as $item){
			$key=$item[1];
			$ar[$key]=$item[2];
		}

		//echo '<pre>';
		//print_r($ar);
		//echo '</pre>';
		return $ar;
	}
/* Как применить эту функцию?
Вто таким кодом мы вытягиваем баланс по перфекту
$conf_merchantPmId = $config->PmId;
  $conf_wallPm = $config->AccountPaymentPM;
$conf_merchantPmPass = $config->PmPass;
$ar = $func->PmBalance($conf_merchantPmId, $conf_merchantPmPass);
$bal_perf = $ar[$conf_wallPm];*/



	/*======================================================================*\
	Function:	SendMoneyPm
	Descriiption: Перевод средств PerfectMoney
	\*======================================================================*/
	function SendMoneyPm($PmId, $PmPass, $AccountNumberPM, $purse, $sum_pay, $memo){
		$f=fopen('https://perfectmoney.is/acct/confirm.asp?AccountID='.$PmId.'&PassPhrase='.$PmPass.'&Payer_Account='.$AccountNumberPM.'&Payee_Account='.$purse.'&Amount='.$sum_pay.'&PAY_IN=1&PAYMENT_ID=1223&Memo='.$memo.'', 'rb');

		if($f===false){
			echo 'error openning url';
		}

		// getting data
		$out=array(); $out="";
		while(!feof($f)) $out.=fgets($f);

		fclose($f);

		// searching for hidden fields
		if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
			echo 'Ivalid output';
			exit;
		}

		$ar="";
		foreach($result as $item){
			$key=$item[1];
			$ar[$key]=$item[2];
		}

		//echo '<pre>';
		//print_r($ar);
		//echo '</pre>';
		return $ar;
	}

}  
	
?>