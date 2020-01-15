<?PHP
$_OPTIMIZATION["title"] = "Account - User Menu";

$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_b.id = db_users_a.id AND db_users_b.id = '$usid'");
$user_data = $db->FetchArray();
?>
<?PHP
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>


<div class="container header1">
	<div class="row">
		<div class="col-12">
			<div class="user-menu d-flex justify-content-between align-items-center flex-wrap">
				<div class="block">
					<a href="/account">
						<i class="far fa-head-side"></i>
						<span>Profile</span>
					</a>
				</div>
				
				<div class="block">
					<a href="/account/buy">
						<i class="far fa-users-class"></i>
						<span>Buy miner</span>
					</a>
				</div>
				<div class="block">
					<a href="/account/mining">
						<i class="far fa-users-class"></i>
						<span>Your miners</span>
					</a>
				</div>
				<div class="block">
					<a href="/account/history">
						<i class="far fa-users-class"></i>
						<span>History</span>
					</a>
				</div>
				<div class="block">
					<a href="/account/referals">
						<i class="far fa-users-class"></i>
						<span>Referals</span>
					</a>
				</div>

				<div class="block" >
					<a href="/account/deposit">
						<i class="far fa-credit-card"></i>
						<span>Deposit</span>
					</a>
				</div>
				<div class="block">
					<a href="/account/withdraw">
						<i class="far fa-sack-dollar"></i>
						<span>Withdraw</span>
					</a>
				</div>

				<div class="block">
					<a href="/account/set">
						<i class="fas fa-cog"></i>
						<span>Settings</span>
					</a>
				</div>

				<div class="block">
					<a href="/account/exit">
						<i class="fas fa-sign-out-alt"></i>
						<span>Log out</span>
					</a>
				</div>
			</div>
		</div>

	</div>
</div>