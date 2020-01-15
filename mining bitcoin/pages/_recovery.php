<style>
	.inde span {
		color: #0A647A;
	}
</style>
<?PHP
$_OPTIMIZATION["title"] = "password recovery";
$_OPTIMIZATION["description"] = "Recovering password";
$_OPTIMIZATION["keywords"] = "evolution-mining, Recovery password";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }

?>

<div class="silver-bk justify-content-center">
	<div class="row mr-0 ml-0 justify-content-center">
		<div class="col-12 justify-content-center">
			<div class="indexx">
		
				<h1>PASSWORD RECOVERY</h1>
		
			</div>
		</div>
		<div class="col-10 offset-1 col-md-6 offset-md-3 justify-content-center inde nice_border">
			<?PHP
	if(isset($_POST["email"])){

		if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
		
		unset($_SESSION["captcha"]);
		
		$email = $func->IsMail($_POST["email"]);
		$time = time();
		$tdel = $time + 60*15;
		
			if($email !== false){
				
				$db->Query("DELETE FROM db_recovery WHERE date_del < '$time'");
				$db->Query("SELECT COUNT(*) FROM db_recovery WHERE ip = INET_ATON('".$func->UserIP."') OR email = '$email'");
				if($db->FetchRow() == 0){
				
					$db->Query("SELECT id, user, email, pass FROM db_users_a WHERE email = '$email'");
					if($db->NumRows() == 1){
					$db_q = $db->FetchArray();
					
					# Вносим запись в БД
					$db->Query("INSERT INTO db_recovery (email, ip, date_add, date_del) VALUES ('$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
					
					# Отправляем пароль
					$sender = new smtp($config);
					$sender -> RecoveryPassword($db_q["email"], $db_q["pass"], $db_q["email"]);
					
					echo "<div class='error green'><center>Login information sent to Email<br/>Check your spam folder, as mail robots can perceive as a message more spam.<br/>If the message did not arrive, write to us by mail <font color = 'red'>support@evolution-mining.com</font></center></div>";
					?>
		</div>
	</div>
</div>
<div class="clr"></div>
</div>

<?PHP
					return; 
					
					}else echo "<div class='error'><center><font color = 'red'>User with this Email is not registered</font></center></div>";
				
				}else echo "<div class='error'><center><font color = 'red'>A password has already been sent to your Email or IP in the last 15 minutes</font></center></div>";
				
			}else echo "<div class='error'><center><font color = 'red'>Email is incorrect</font></center></div>";
		
		}else echo "<div class='error'><center><font color = 'red'>Characters from the image are entered incorrectly </font></center></div>";
	}

?>

<div class="container">
	<div class="row">
		<div class="form_recovery d-flex justify-content-start align-items-center flex-wrap">
			<form class="d-flex justify-content-center align-items-start flex-column"  action="" method="post">
				<label class="text-align-center" for="email"> Email <span class="reg_span">(a password will be sent to it)</span>:</label>
				<input  class="mb-2" name="email" type="text" size="25" maxlength="50"
					value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>" />
				<label for="captcha"> Enter the characters from the image</label>
				<input class="mb-2 text-align-center" name="captcha" type="text" size="8" maxlength="8" />
				<a  href="#" onclick="ResetCaptcha(this);"><img class="mb-2" src="/captcha.php?rnd=<?=rand(1,10000); ?>" border="0"
						style="margin:0;" /></a>
				<input type="submit" class="int_main btn-primary" value="Recovery">
			</form>
		</div>
	</div>
</div>



</div>
</div>
</div>
<div class="clr"></div>
</div>