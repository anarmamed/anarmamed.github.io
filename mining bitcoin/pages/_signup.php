<?PHP
$_OPTIMIZATION["title"] = "REGISTRATION";
$_OPTIMIZATION["description"] = "REGISTRATION user in system";
$_OPTIMIZATION["keywords"] = "registration new user in the system";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
?>





<div class="silver-bk justify-content-center">
	<div class="row mr-0 ml-0 justify-content-center">
		<div class="col-12 justify-content-center">
			<div class="indexx">
				<h1>REGISTRATION</h1>
			</div>
		</div>
		<div class=" col-10 offset-1 col-sm-8 offset-sm-1 col-md-8 offset-md-1 ">

		</div>

		<?PHP
	
	# REGISTRATION
	$db->Query("SELECT * FROM db_leader");   
   $leader = $db->FetchArray();
 
	if(isset($_POST["login"])){
	
	if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
	unset($_SESSION["captcha"]);

	$login = $func->IsLogin($_POST["login"]);
	$pass = $func->IsPassword($_POST["pass"]);
	$rules = isset($_POST["rules"]) ? true : false;
	$time = time();
	$ip = $func->UserIP;
	$ipregs = $db->Query("SELECT * FROM `db_users_a` WHERE INET_NTOA(db_users_a.ip) = '$ip' ");
$ipregs = $db->NumRows();
	$email = $func->IsMail($_POST["email"]);
	$referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
	$referer_name = "";
	if($referer_id != 1){
		$db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
		if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
 else{$referer_id = $leader["user_id"]; $referer_name = $leader["user"]; }   }else{ $referer_id = $leader["user_id"]; $referer_name = $leader["user"]; }    
	
		if($rules){
/*if($ipregs == 0) {*/
			if($email !== false){
		
			if($login !== false){
			
				if($pass !== false){
			
					if($pass == $_POST["repass"]){
						
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
						if($db->FetchRow() == 0){
						preg_match('/([a-z0-9\.])+([a-z0-9\-])+(\.)([a-z0-9]{2,5}\.)?([a-z0-9]{2,5})/i',$_COOKIE['rsite'], $out);
                        $out=$db->RealEscape(htmlspecialchars($out[0]));
							
				/* ================== */
                        $db->Query("SELECT referer, referer_id FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
                        $stats_data = $db->FetchArray();
                        $referer_name2=$stats_data["referer"];
                        $referer_id2=$stats_data["referer_id"];

                        $db->Query("SELECT referer, referer_id FROM db_users_a WHERE id = '$referer_id2' LIMIT 1");
                        $stats_data3 = $db->FetchArray();
                        $referer_name3=$stats_data3["referer"];
                        $referer_id3=$stats_data3["referer_id"];


                        # notice new user
                        $db->Query("INSERT INTO db_users_a (user, email, pass, referer, referer_id, referer_id2, referer_id3, date_reg, refsite,  ip)
                        VALUES ('$login','{$email}','$pass','$referer_name','$referer_id','$referer_id2','$referer_id3', '$time','$out',INET_ATON('$ip'))");
                        /* ================== */;
						
						$lid = $db->LastInsert();
						
						$db->Query("INSERT INTO db_users_b (id, user, last_sbor) VALUES ('$lid','$login', '".time()."')");
						
						
						

if (empty($referer_name)){


}

else

{

$db->Query("SELECT referer, referer_id FROM db_users_a WHERE id = '$lid' ");

$ref_bonus = $db->FetchArray();

$user_name = $ref_bonus["referer"];

$ref_id = $ref_bonus["referer_id"];



$db->Query("UPDATE db_users_a SET referals = referals +1 WHERE id = '$ref_id' ");

}
						
						
						
						
						$db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
						// logs
// $log_rich->log_events(3,0,0,$login);
						?>
		<div id='messID' onclick='hidemessage()' class='message2 m-white'>
			<center>
				<img src="/img/successs.png" /><br />
				<center>
					<h2>
						<font color='grey'>You have successfully registered.<BR />Now you can log in to your account.</font>
					</h2>
				</center>
		</div>




		<meta http-equiv="refresh" content="3;url=https://evolution-mining.com/" />
		<?PHP
						return;
						}else echo "<div class='error'><center><font color = 'red'>This login is already in use by another user</font></center></div>";
						
					}else echo "<div class='error'><center><font color = 'red'>Password and re-password do not match</font></center></div>";
			
				}else echo "<div class='error'><center><font color = 'red'>Password is incorrect</font></center></div>";
			
			}else echo "<div class='error'><center><font color = 'red'>Login is incorrect</font></center></div>";

		}else echo "<div class='error'><center><font color = 'red'>Email format is incorrect</font></center></div>";
	/*else echo "<div class='error'><center><font color = 'red'>Registration from this IP has already been made</font></center></div>";*/
		}else echo "<div class='error'><center><font color = 'red'>You have not confirmed the rules</font></center></div>";
	
		}else echo "<div class='error'><center><font color = 'red'>Characters from the image are entered incorrectly </font></center></div>";

	}
	
	
?>



		<BR />
		<?php 
$db->Query("SELECT * FROM db_leader");   
   $leader1 = $db->FetchArray();
   $leaderid1 = $leader["user_id"];
$referer_idd1 = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : $leaderid1;
$referer_named1 = "";
	
		$db->Query("SELECT user FROM db_users_a WHERE id = '$referer_idd1' LIMIT 1");
		if($db->NumRows() > 0){$referer_named1 = $db->FetchRow();}
 if ($referer_idd1 == $leaderid1) {
 	$textref = "You don't have the refleader. Your referer: ";
 }else{
 	$textref = "Your referer: ";
 }
 ?>

		<div class="container">
			<div class="row">
				<div class="form_registr col-10 offset-1 col-sm-8 offset-sm-2 ">
					<form class="d-flex justify-content-sart  flex-column" action="" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="log d-flex flex-column">
									<label for="login">Your login:</label>
									<input name="login" type="text" size="25" maxlength="10"
										value="<?=(isset($_POST["login"])) ? $_POST["login"] : false; ?>" />
									<span>(the field must be between 4 and 10 characters)</span>
								</div>
								<div class="mail d-flex flex-column">
									<label for="email"> Email:</label>
									<input name="email" type="text" size="25" maxlength="50"
										value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>" />
								</div>
								<div class="pass d-flex flex-column">
									<label for=" pass"> Password:</label>
									<input name="pass" type="password" size="25" maxlength="20" />
									<span>(the password field must be between 6 and 20 characters)</span>
								</div>
								<div class="repass d-flex flex-column">
									<label for="repass"> Password again: <font color="#FF0000">*</font></label>
									<input name="repass" type="password" size="25" maxlength="20" />
									<span>(passwords must match)</span>
								</div>
							</div>

							<div class="col-md-6">

								<div class="capcha d-flex flex-column">
									<label for="captcha">Enter the characters from the image</label>
									<input name="captcha" type="text" size="25" maxlength="50" />
									<a href="#" onclick="ResetCaptcha(this);"><img src="/captcha.php?rnd=<?=rand(1,10000); ?>" /></a>
								</div>

								<div class="check">
						
									<p>I confirm that I am 18 years old, read the <a href="/rules" target="_blank" class="stn"> rules</a>
										and accept: <input name="rules" type="checkbox" /> </p>
								</div>

								<div class="submit">
									<p><?=$textref ?><?=$referer_named1 ?></p>
									<input name="registr" class="int_main" type="submit" value="Sign up!">
								</div>
							</div>
						</div>

						<div class="error">
							<i class="fas fa-exclamation-triangle"></i>
							<strong>
								<font color="#FE1414">Warning!</font>
							</strong>
							<p>Registration by one user of more than one account is strictly prohibited. If you violate
								this rule,
								all your accounts will be blocked forever, without the possibility of recovery!</p>
						</div>
					</form>
				</div>
			</div>
		</div>


	</div>
</div>
</div>

</div>
<div class="clr"></div>