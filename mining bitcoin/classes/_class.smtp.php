<?php
class smtp {
	var $config = NULL;
	var $Hosts = "";
	/*======================================================================*\
	Function:	__construct
	Descriiption: РљРѕРЅСЃС‚СЂСѓРєС‚РѕСЂ РєР»Р°СЃСЃР°
	\*======================================================================*/
	function __construct($config){
		$this->config = $config;
		$this->Hosts = str_replace("www.","",$_SERVER['HTTP_HOST']);
		
	}
	/*======================================================================*\
	Function:	SendRegKey
	Descriiption: РћС‚РїСЂР°РІР»СЏРµС‚ СЂРµРіРёСЃС‚СЂР°С†РёРѕРЅРЅС‹Р№ РєР»СЋС‡
	\*======================================================================*/
	function SendRegKey($email, $key){
	
		$text = "РќР° РІР°С€ Email Р±С‹Р»Р° Р·Р°РїСЂРѕС€РµРЅР° СЃСЃС‹Р»РєР° РґР»СЏ СЂРµРіРёСЃС‚СЂР°С†РёРё РІ РёРіСЂРµ \"".$this->Hosts."\"<BR />";
		$text.= "Р•СЃР»Рё РІС‹ РЅРµ Р·Р°РїСЂР°С€РёРІР°Р»Рё СЃСЃС‹Р»РєСѓ, РїСЂРѕСЃС‚Рѕ РїСЂРѕРёРіРЅРѕСЂРёСЂСѓР№С‚Рµ СЌС‚Рѕ СЃРѕРѕР±С‰РµРЅРёРµ. <BR /><BR />";
		$text.= "РЎСЃС‹Р»РєР° РґР»СЏ СЂРµРіРёСЃС‚СЂР°С†РёРё: <a href='http://".$this->Hosts."/signup/key/{$key}'>";
		$text.= "http://".$this->Hosts."/signup/key/{$key}</a>";
		$subject = "Р РµРіРёСЃС‚СЂР°С†РёСЏ РІ РёРіСЂРµ \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	/*======================================================================*\
	Function:	SendReСЃKey
	Descriiption: РћС‚РїСЂР°РІР»СЏРµС‚ РєР»СЋС‡ СЃРјРµРЅС‹ РїР°СЂРѕР»СЏ
	\*======================================================================*/
	function SendRecKey($email, $key){
	
		$text = "РќР° РІР°С€ Email Р±С‹Р»Р° Р·Р°РїСЂРѕС€РµРЅР° СЃСЃС‹Р»РєР° РґР»СЏ РІРѕСЃСЃС‚Р°РЅРѕРІР»РµРЅРёСЏ РїР°СЂРѕР»СЏ РІ РёРіСЂРµ \"".$this->Hosts."\"<BR />";
		$text.= "Р•СЃР»Рё РІС‹ РЅРµ Р·Р°РїСЂР°С€РёРІР°Р»Рё СЃСЃС‹Р»РєСѓ, РїСЂРѕСЃС‚Рѕ РїСЂРѕРёРіРЅРѕСЂРёСЂСѓР№С‚Рµ СЌС‚Рѕ СЃРѕРѕР±С‰РµРЅРёРµ. <BR /><BR />";
		$text.= "РЎСЃС‹Р»РєР° РґР»СЏ РІРѕСЃСЃС‚Р°РЅРѕРІР»РµРЅРёСЏ: <a href='http://".$this->Hosts."/recovery/key/{$key}'>";
		$text.= "http://".$this->Hosts."/recovery/key/{$key}</a>";
		$subject = "Р’РѕСЃСЃС‚Р°РЅРѕРІР»РµРЅРёРµ РїР°СЂРѕР»СЏ РІ РёРіСЂРµ \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	/*======================================================================*\
	Function:	RecoveryPassword
	Descriiption: Р’РѕСЃСЃС‚Р°РЅРѕРІР»РµРЅРёРµ РїР°СЂРѕР»СЏ
	\*======================================================================*/
	function RecoveryPassword($user, $pass, $email){
	
		$text = "РЈРІР°Р¶Р°РµРјС‹Р№, {$user}! <BR />";
		$text.= "Р’Р°С€ РїР°СЂРѕР»СЊ РІ РёРіСЂРµ <a href='http://".$this->Hosts."/'>Р’РµСЃРµР»С‹Рµ Р С‹Р±Р°РєРё</a>: <b>{$pass}</b><BR />";
		
		$subject = "РќР°РїРѕРјРёРЅР°РµРј Р’Р°С€ РїР°СЂРѕР»СЊ! - \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	
	/*======================================================================*\
	Function:	SendAfterReg
	Descriiption: РћС‚РїСЂР°РІР»СЏРµС‚ РґР°РЅРЅС‹Рµ РїРѕСЃР»Рµ СЂРµРіРёСЃС‚СЂР°С†РёРё
	\*======================================================================*/
	function SendAfterReg($user, $pass, $email){
	
		$text = "Р‘Р»Р°РіРѕРґР°СЂРёРј РІР°СЃ Р·Р° СЂРµРіРёСЃС‚СЂР°С†РёСЋ РІ РёРіСЂРµ \"".$this->Hosts."\"<BR />";
		$text.= "Р’Р°С€Рё РґР°РЅРЅС‹Рµ РґР»СЏ РІС…РѕРґР° РІ Р»РёС‡РЅС‹Р№ РєР°Р±РёРЅРµС‚ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ: <BR />";
		$text.= "<b>Р›РѕРіРёРЅ:</b> {$user}<BR />";
		$text.= "<b>РџР°СЂРѕР»СЊ:</b> {$pass}<BR />";
		$text.= "РЎСЃС‹Р»РєР° РґР»СЏ РІС…РѕРґР° РІ РєР°Р±РёРЅРµС‚: <a href='http://".$this->Hosts."/'>http://".$this->Hosts."/</a>";
		$subject = "Р—Р°РІРµСЂС€РµРЅРёРµ СЂРµРіРёСЃС‚СЂР°С†РёРё РІ СЃРёСЃС‚РµРјРµ \"".$this->Hosts."\"";
	
		return $this->SendMail($email, $subject, $text);
		
	}
	
	/*======================================================================*\
	Function:	SetNewPassword
	Descriiption: РћС‚РїСЂР°РІР»СЏРµС‚ РґР°РЅРЅС‹Рµ РїРѕСЃР»Рµ СЃРјРµРЅС‹ РїР°СЂРѕР»СЏ
	\*======================================================================*/
	function SetNewPassword($user, $pass, $email){
	
		$text = "Р’ РЅР°СЃС‚СЂРѕР№РєР°С… РІР°С€РµРіРѕ Р°РєРєР°СѓРЅС‚Р° Р±С‹Р» РёР·РјРµРЅРµРЅ РїР°СЂРѕР»СЊ<BR />";
		$text.= "Р’Р°С€Рё РЅРѕРІС‹Рµ РґР°РЅРЅС‹Рµ РґР»СЏ РІС…РѕРґР° РІ Р»РёС‡РЅС‹Р№ РєР°Р±РёРЅРµС‚ РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ: <BR />";
		$text.= "<b>Р›РѕРіРёРЅ:</b> {$user}<BR />";
		$text.= "<b>РќРѕРІС‹Р№ РїР°СЂРѕР»СЊ:</b> {$pass}<BR />";
		$text.= "РЎСЃС‹Р»РєР° РґР»СЏ РІС…РѕРґР° РІ РєР°Р±РёРЅРµС‚: <a href='http://".$this->Hosts."/'>http://".$this->Hosts."/</a>";
		$subject = "РЎРјРµРЅР° РїР°СЂРѕР»СЏ РІ СЃРёСЃС‚РµРјРµ \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	
	/*======================================================================*\
	Function:	ReferalPlus
	Descriiption: РћРїРѕРІРµС‰РµРЅРёРµ СЂРµС„РµСЂРµСЂР° Рѕ СЂРµРіРёСЃС‚СЂР°С†РёРё СЂРµС„РµСЂР°Р»Р°
	\*======================================================================*/
	function ReferalPlus($email, $user){
	
		$text = "РџСЂРёРІРµС‚СЃС‚РІСѓСЋ <b>{$user}</b>!<BR />";
		$text.= "РЈ Р’Р°СЃ РїРѕСЏРІРёР»СЃСЏ РЅРѕРІС‹Р№ СЂРµС„РµСЂР°Р». <BR />";
		$text.= "РЎ РЈРІР°Р¶РµРЅРёРµРј<BR />";
		$text.= "РљРѕРјР°РЅРґР° <a href='http://".$this->Hosts."/'>Fun-fishermen.org</a>";
		$subject = "РќРѕРІС‹Р№ СЂРµС„РµСЂР°Р» РЅР° \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	
	/*======================================================================*\
	Function:	InsertMoney
	Descriiption: РћРїРѕРІРµС‰РµРЅРёРµ СЂРµС„РµСЂРµСЂР° Рѕ РїРѕРїРѕР»РЅРµРЅРёРё СЂРµС„РµСЂР°Р»РѕРј Р±Р°РѕР°РЅСЃР°
	\*======================================================================*/
	function InsertMoney($email, $user){
	
		$text = "РџСЂРёРІРµС‚СЃС‚РІСѓСЋ <b>{$user}</b>!<BR />";
		$text.= "Р’Р°С€ СЂРµС„РµСЂР°Р» РїРѕРїРѕР»РЅРёР» Р±Р°Р»Р°РЅСЃ. <BR />";
		$text.= "РЎ РЈРІР°Р¶РµРЅРёРµРј<BR />";
		$text.= "РљРѕРјР°РЅРґР° <a href='http://".$this->Hosts."/'>Fun-fishermen.org</a>";
		$subject = "Р’Р°С€ СЂРµС„РµСЂР°Р» РїРѕРїРѕР»РЅРёР» Р±Р°Р»Р°РЅСЃ \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	
	/*======================================================================*\
	Function:	BankWinn
	Descriiption: РћРїРѕРІРµС‰РµРЅРёРµ Рѕ РІС‹РёРіСЂС‹С€Рµ РІ РЅР°РєРѕРїРёС‚РµР»СЊРЅРѕРј Р±Р°РЅРєРµ
	\*======================================================================*/
	function BankWinn($email, $user, $sum){
	
		$text = "РџСЂРёРІРµС‚СЃС‚РІСѓСЋ <b>{$user}</b>!<BR />";
		$text.= "Р’С‹ СЃС‚Р°Р»Рё РїРѕР±РµРґРёС‚РµР»РµРј РІ РЅР°РєРѕРїРёС‚РµР»СЊРЅРѕРј Р±Р°РЅРєРµ. <BR />";
		$text.= "РЎСѓРјРјР° Р’Р°С€РµРіРѕ РІС‹РёРіСЂС‹С€Р° СЃРѕСЃС‚Р°РІР»СЏРµС‚ {$sum} СЂСѓР±Р»РµР№. <BR />";
		$text.= "РЎ РЈРІР°Р¶РµРЅРёРµРј<BR />";
		$text.= "РљРѕРјР°РЅРґР° <a href='http://".$this->Hosts."/'>".$this->Hosts."</a>";
		$subject = "Р’С‹ СЃС‚Р°Р»Рё РїРѕР±РµРґРёС‚РµР»РµРј РЅР°РєРѕРїРёС‚РµР»СЊРЅРѕРіРѕ Р±Р°РЅРєР° \"".$this->Hosts."\"";
		
		return $this->SendMail($email, $subject, $text);
		
	}
	
	/*======================================================================*\
	Function:	Headers
	Descriiption: РЎРѕР·РґР°РЅРёРµ Р·Р°РіРѕР»РѕРІРєРѕРІ РїРёСЃСЊРјР°
	\*======================================================================*/
	function Headers(){
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=UTF-8\r\n";
	$headers.= "Date: ".date("m.d.Y H:i:s")."\r\n";
	$headers.= "From: ".$this->config->SMTP_PROJECT." <".$this->config->SMTP_USER."> \r\n";
	
		return $headers;
	
	}
	
	/*======================================================================*\
	Function:	SendMail
	Descriiption: РћС‚РїСЂР°РІРёС‚РµР»СЊ
	\*======================================================================*/
	function SendMail($email, $subject, $text){
		$text .= "<BR>----------------------------------------------------
		<BR>РЎРѕРѕР±С‰РµРЅРёРµ Р±С‹Р»Рѕ РІС‹СЃР»Р°РЅРѕ СЂРѕР±РѕС‚РѕРј, РїРѕР¶Р°Р»СѓР№СЃС‚Р°, РЅРµ РѕС‚РІРµС‡Р°Р№С‚Рµ РЅР° РЅРµРіРѕ!";
		return ($this -> mailSmtp($email, $subject, $text, $this->Headers())) ? true : false;	
	}

	function mailSmtp($reciever, $subject, $content, $headers, $debug = 0) {
		$sock = fsockopen($this->config->SMTP_HOST, $this->config->SMTP_PORT, $errno, $errstr, 30);
		$str = fgets($sock, 512);

		if (!$sock) {
			printf("Socket is not created\n");
			exit(1);
		}

		$this->smtp_msg($sock, "HELO " . $_SERVER['SERVER_NAME']);
		$this->smtp_msg($sock, "AUTH LOGIN");
		$this->smtp_msg($sock, base64_encode($this->config->SMTP_USER));
		$this->smtp_msg($sock, base64_encode($this->config->SMTP_PASS));
		$this->smtp_msg($sock, "MAIL FROM: <" . $this->config->SMTP_FROM . ">");
		$this->smtp_msg($sock, "RCPT TO: <" . $reciever . ">");
		$this->smtp_msg($sock, "DATA");

		$headers = "Subject: " . $subject . "\r\n" . $headers;
		$data = $headers . "\r\n\r\n" . $content . "\r\n.";

		$this->smtp_msg($sock, $data);
		$this->smtp_msg($sock, "QUIT");

		fclose($sock);
	}

	function smtp_msg($sock, $msg) {
		if (!$sock) {
			printf("Broken socket!\n");
			exit(1);
		}

		if (isset($_SERVER['debug']) && $_SERVER['debug']) {
			printf("Send from us: %s<BR>", nl2br(htmlspecialchars($msg)));
		}

		fputs($sock, "$msg\r\n");
		$str = fgets($sock, 512);

		if (!$sock) {
			printf("Socket is down\n");
			exit(1);
		} else {

			if (isset($_SERVER['debug']) && $_SERVER['debug']) {
				printf("Got from server: %s<BR>", nl2br(htmlspecialchars($str)));
			}

			$e = explode(" ", $str);
			$code = array_shift($e);
			$str = implode(" ", $e);

			if ($code > 499) {
				printf("Problems with SMTP conversation.<BR><BR>Code %d.<BR>Message %s<BR>", $code, $str);
				exit(1);
			}

		}

	}
}
?>