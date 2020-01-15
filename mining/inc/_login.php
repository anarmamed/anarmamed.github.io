<style>
	.table-enter td{
		border: 0 !important;
	}
	.recor a{
		font-size: 1.5vw;
		color: red;
	}
</style>

<?PHP
if ($_SERVER[REQUEST_URI]!=="/signup"){
	if(isset($_POST["log_email"])){

		if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
	unset($_SESSION["captcha"]);
	
	$lmail = $func->IsMail($_POST["log_email"]);
	
		if($lmail !== false){
		
			$db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$lmail'");
			if($db->NumRows() == 1){
			
			$log_data = $db->FetchArray();
			
				if(strtolower($log_data["pass"]) == strtolower($_POST["pass"])){
				
					if($log_data["banned"] == 0){
						
						# Считаем рефералов
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$log_data["id"]."'");
						$refs = $db->FetchRow();
						
						$db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$log_data["id"]."'");
						
						$_SESSION["user_id"] = $log_data["id"];
						$_SESSION["user"] = $log_data["user"];
						$_SESSION["referer_id"] = $log_data["referer_id"];
						Header("Location: /account");
						
					
				}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Ваш аккаунт заблокирован!<br/>Одна из причин - вы нарушили пункт правил 4.1.2.8. Не создавать дополнительные игровые аккаунты для своей либо любой другой выгоды - блокировка без разбирательств!</div>";
				
				}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Email и/или Пароль указан неверно!</div>";
			
			}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Указанный Email не зарегистрирован в системе!</div>";
			
		}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Email указан неверно!</div>";

	}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Символы с картинки введены неверно!</div>";
	
	}
}
?>



<div class=" header1">
  <div class="row justify-content-center content no-gutters">
   <div class="col-3 center-block cl-left">
   

          