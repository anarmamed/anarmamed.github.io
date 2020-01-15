<html>

<head>
	<title>Evolution-Mining</title>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="description" content="Cloud Mining online">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords"
		content="Earnings, make money online, without investments, investments, investments, earn, farm, money farm, earn on the farm, Playing with the withdrawal of money, mining, HYIP projects, investments, fast lotto, buks, surfing, ruble crane, monitoring">
	<link href="/style/bootstrap.css" rel="stylesheet" type="text/css" />
	<link type="text/css" href="/style/style.css?122" rel="stylesheet" />
	<link type="text/css" href="/style/rangeslider.css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery3.1.min.js"></script>

	<link href="/style/image-picker.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/style/awesome5/fon/css/all.css" type="text/css" />
	<!-- <link rel="stylesheet" href="/style/awesome5/font-awesome.css" type="text/css" /> -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap&subset=cyrillic" rel="stylesheet">
	<!-- <script type="text/javascript" src="/js/jquery3.1.min.js"></script> -->
	<link href="/lib/animate.min.css" rel="stylesheet"/>
	
	<script src="https://use.fontawesome.com/78d790ba3a.js"></script>
	<script type="text/javascript" src="/js/functions.js"></script>

	<!-- 	<script>
	$( function() {
		$( document ).tooltip({
			position: {
				my: "center bottom-20",
				at: "center top",
				using: function( position, feedback ) {
					$( this ).css( position );
					$( "<div>" )
					.addClass( "arrow" )
					.addClass( feedback.vertical )
					.addClass( feedback.horizontal )
					.appendTo( this );
				}
			}
		});
	} );
</script> -->
	<!--[if lt IE 9]>
    <script>
        document.createElement('figure');
        document.createElement('figcaption');
    </script>
<![endif]-->


</head>

<body>
	<div class="all_site">

		<div class="up_site">

			<?PHP 
			if(isset($_SESSION["user"]) AND strpos($_SERVER[REQUEST_URI], 'account') or isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu')){ 
				$usid = $_SESSION["user_id"];
				$uname = $_SESSION["user"];
				$unames = (isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu')) ? 'admin' : $uname ;

				$db->Query("SELECT money_b, money_p FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$my_money = $db->FetchArray();
				?>

			<div class="container-fluid headd">
				<div class="row">
					<div class="col-12">
						<div class="contactt">
							<div class="timtim">
								<i class="fal fa-clock"></i> <span id="time">00:00:00</span>
							</div>

					
							<div class="head_social">
								<?php 
										$db->Query("SELECT a_t, last_sbor FROM db_users_b WHERE id = '$usid' LIMIT 1");
										$bitcloud = $db->FetchArray();
										$db->Query("SELECT a_in_h FROM db_config WHERE id = '1' LIMIT 1");
										$sonfig = $db->FetchRow();
										$allfi1 = $func->SumCalc($sonfig, $bitcloud['a_t'], $bitcloud['last_sbor']);
										$time_to_infinity = $allfi1+($bitcloud['a_t']*$sonfig);
										if ($bitcloud['a_t']>0) { ?>
								Now mining: <b class="timer upper" id="infinity" data-from="<?=$allfi1?>"
									data-to="<?=$time_to_infinity?>" data-speed="3600000"></b> MH points from <b
									class="upper"><?=$bitcloud['a_t'] ?></b> GH/s

								<?php }else{ ?>
								Now you don't have rented powers. At first <b><a style="color: blue;"
										href="/account/insert">Insert</a></b>
								money and <b><a style="color:blue ;" href="/account/buy">rent miner</a></b>
								<?php } ?>
								<!-- <a href=""><i class="fal fa-comments"></i> Chat</a>&nbsp;&nbsp;
									<a href=""><i style="color: #279EDA" class="fab fa-telegram"></i></a>&nbsp;&nbsp;
									<a href=""><i style="color: #FF0000" class="fab fa-youtube"></i></a> -->
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-6 logo_2">
						<a href="index.html">
							<img src="/img/logo_evolution.png" />
						</a>
					</div>
					<div class="col-md-5 col-7 d-flex justify-content-center align-items-center ">
						<div class="cards d-flex">
							<div class="card">
								<p>For Buying <span><?=floor($my_money['money_b']*100)/100; ?> $</span></p>
								
						</div>
						<div class="card">
								<p>To Withdraw <span><?=floor($my_money['money_p']*100)/100; ?> $</span></p>
								
						</div>
						</div>
							
					</div>

					<div class="col-md-4 col-5 d-flex justify-content-center align-items-center ">
						<div class="user_hello ">
							Hello, <strong>
								<?=$unames?>
							</strong> &nbsp;&nbsp;
							<a href="/account/exit"><i class="fas fa-sign-out-alt"></i></a>
							<?php if (isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu')) { ?>
							<a href="/account"><button class="int_reg">Back to Account</button></a>
							<?php  } ?>
							<?php if (isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu') === FALSE) { ?>
							<a href="/?menu=mo4cloud&sel=stats"><button class="int_reg">Admin</button></a>
							<?php  } ?>
						</div>
					
					</div>
				</div>


<!-- menu registr user -->
					<div class="row ">
						<div class="col-12 menu_up ">
							<!-- <div class="header_burger">
								<span><i class="fa fa-bars" aria-hidden="true"></i></span>
							</div> -->
							<ul class=" ul_up d-flex justify-content-center flex-wrap">
								<li><a href="/">Home</a></li>
								<li><a href="/news">News</a></li>
								<li><a href="/about">About Us</a></li>
								<li><a href="/faq">FAQ</a></li>
								<li><a href="/bounty">Bounty</a></li>
								<li><a href="/contacts">Contacts</a></li>
							</ul>
						</div>
					</div>

			</div>
		</div>



		<?php  }else{ ?>
		<!---------------------------------- Header unregistr----------------------------------->

		<div class="container-fluid headd">
			<div class="row">
				<div class="col-md-3 col-6 logo ">
					<a href="/">
						<img src="/img/logo_evolution.png" class="logo_img" />
					</a>
				</div>


				<?PHP
						if ($_SERVER[REQUEST_URI]!=="/signup"){
							if(isset($_POST["log_email"])){

								/*if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
									isset($_SESSION["captcha"]);*/

									$lmail = $func->IsMail($_POST["log_email"]);

									if($lmail !== false){

										$db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$lmail'");
										if($db->NumRows() == 1){

											$log_data = $db->FetchArray();

											if(strtolower($log_data["pass"]) == strtolower($_POST["pass"])){

												if($log_data["banned"] == 0){

						# Count referals
													$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$log_data["id"]."'");
													$refs = $db->FetchRow();

													$db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$log_data["id"]."'");

													$_SESSION["user_id"] = $log_data["id"];
													$_SESSION["user"] = $log_data["user"];
													$_SESSION["referer_id"] = $log_data["referer_id"];
													Header("Location: /account");


												}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Your Account is not correct!</div>";

											}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Email or Password is not correct!</div>";

										}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Your Email is not registered in the system.!</div>";

									}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Email is not correct!</div>";

								/*}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The characters in the picture are entered incorrectly!</div>";*/

							}
						}
						?>

				<div class="col-md-9 col-6 d-flex justify-content-end align-items-center">
					<div class="header_burger">
						<span><i class="fa fa-bars" aria-hidden="true"></i></span>
					</div>
					<div class="header_menu">
						<div class="row">
							<div class="col-md-12  menu_up">

								<ul>
									<li class="active"><a href="/">Home</a></li>
									<li><a href="/news">News</a></li>
									<li><a href="/about">About Us</a></li>
									<li><a href="/faq">FAQ</a></li>
									<li><a href="/bounty">Bounty</a></li>
									<li><a href="/contacts">Contacts</a></li>
								</ul>

							</div>
						</div>
						<div class="row">
							<div class="col-md-12 flex_main">
								<?php if(isset($_SESSION["user"])){ 
																	$uname = $_SESSION["user"];
																	?>


								<!---------------------------- Register user----------------------------- -->

								<div class="flex_1  d-flex mb-2 mr-2">
									<div class="hello ml-4 mt-3 mb-1">Hello, <b><?=$uname?></b>&nbsp;&nbsp;</div>
									<div class="btn">
										<a href="/account"><button class="int_menu btn-primary">My Account</button></a>&nbsp;
										<a href="/account/exit"><button class="int_reg btn-primary">Exit</button></a>
										<?php if (isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu') === FALSE) { ?>
										<a href="/?menu=mo4cloud&sel=stats"><button class="int_reg"
												style="background-color: #9400D3">Admin</button></a>
										<?php  } ?>
									</div>
								</div>
								<!-- --------------------------------------------------------------- -->


								<?php }else{ ?>
								<?php 
																		if ($_SERVER[REQUEST_URI]=="/signup"){ ?>
								<h3>Registration...</h3>
								&nbsp;&nbsp;&nbsp;
								<a style="font-size: 1.3vw;" href="/"><i style="color: green;" class="fas fa-arrow-square-left"></i>Back
									to main</a>
								<?php 
																		}elseif ($_SERVER[REQUEST_URI]=="/recovery"){ ?>
								<h3>Password recovery...</h3>
								&nbsp;&nbsp;&nbsp;
								<a style="font-size: 1.3vw;" href="/"><i style="color: green;" class="fas fa-arrow-square-left"></i>Back
									to main</a>
								<?php 
																			}else{ ?>
								<!-- forgot password -->
								<div class="form_flex">
									<form action="" method="post">
										<input style=" width: 150px" name="log_email" type="text" size="23" maxlength="35"
											class="lg int_menu  " placeholder="Enter your e-mail" />
										<input style=" width: 150px" name="pass" type="password" size="6" maxlength="35"
											class="lg int_menu  " placeholder="Enter your password" />
										<input type="submit" style=" width: 100px" class="int_menu btn-primary " value="Sign in" />
										<!-- <a href="/recovery"  class="rs-ps">Forgot your password?</a> -->
										<!-- <b>Captcha:</b> <input style=" width: 5vw" name="captcha" type="text" size="6" maxlength="6" autocomplete="off" /> -->
										<!-- <a href="#" onclick="ResetCaptcha(this);"><img src="/captcha.php?rnd=<?=rand(1,10000); ?>"  border="0" style="margin:0 1vw 0 0;"/></a> -->
									</form>
								</div>
								<div class="forgot"><span><a href="/recovery">forgot
											password</a></span></div>
								<form class="int_reg " action="/signup" method="post"><input type="submit" class=" btn-primary"
										style=" width: 100px" value="Sign up" /></form>

								<?php } }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>






		<?php } ?>
		<?PHP
									if (isset($_SESSION["user"]) or isset($_SESSION["admin"])) {
										include("inc/_stats2.php");
									}
									?>

		<center>

		</center>


		<?PHP
									$tfstats = time() - 60 * 60 * 24;
									$db->Query("SELECT 
										(SELECT COUNT(*) FROM db_users_a) all_users,
										(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
										(SELECT SUM(all_time_a)/100000 FROM db_users_b) all_payment, 
										(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
									$stats_data = $db->FetchArray();

									?>


		<?PHP 
									if(isset($_SESSION["user"]) AND strpos($_SERVER[REQUEST_URI], 'account') or isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu')){ 
										include("inc/_menu_left.php"); }?>


		<?PHP 
									if(isset($_SESSION["user"]) AND strpos($_SERVER[REQUEST_URI], 'account') or isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu')){ 
										?>
		<div class="col-12 col-xl-12 p-0 ">
			<?php }else{
												?>
			<div class="col-12 col-xl-12 p-0 "> <?php } ?>