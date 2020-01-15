<?PHP
$_OPTIMIZATION["title"] = "Account - Profile";
$user_id = $_SESSION["user_id"];
$usid = $_SESSION["user_id"];

#данные для срока 
$life_time = new life_time($db);
$life_time->CheckTime($usid);

$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
$views = $func->smart_ending($prof_data["serf_view"], array('просмотр', 'просмотра', 'просмотров'));
$in = sprintf("%.0f",$prof_data["insert_sum"]);
$out = sprintf("%.0f",$prof_data["payment_sum"]);
$ser = sprintf("%.0f",$prof_data["insert_serf"]);
$ref = sprintf("%.0f",$prof_data["from_referals"]);
$rub_add = $func->smart_ending($in, array('рубль', 'рубля', 'рублей'));
$rub_out = $func->smart_ending($out, array('рубль', 'рубля', 'рублей'));
$serf_r = $func->smart_ending($ser, array('рубль', 'рубля', 'рублей'));

$db->Query("SELECT * FROM db_news ORDER BY id DESC LIMIT 1");
$last_nw = $db->FetchArray();



$db->Query("SELECT * FROM db_users_a WHERE id = '$user_id'");
$news_v = $db->FetchArray();
$news_view = $news_v['news_view'];
if ($news_view == 1) { ?>
<div id='messID' onclick='hidemessage()' class='message2 m-white'>
  <center>
    <h1><?=$last_nw['title']?></h1>
    <b><?=$last_nw['news']?></b>
  </center>
</div>
<?php 
  $db->Query("UPDATE db_users_a SET news_view = '0' WHERE id = '{$user_id}'");
} 

?>

<!----------------------------------- PROFILE --------------------------------->
<div class="profile">
    <div class="indexx">
      <h1>My Profile</h1>
    </div>
    <div class="container">
      <div class="acc_contain d-flex justify-content-center align-items-center flex-wrap">
        <div class="acc_block">
          <i class="far fa-id-card"></i>
          <h5>My ID:</h5>
          <span class="acc_inf"><b><?=$prof_data["id"]; ?></b></span>
        </div>
        <div class="acc_block">
          <i class="far fa-head-side"></i>
          <h5>Login:</h5>
          <span class="acc_inf"><b><?=$prof_data["user"]; ?></b></span>
        </div>
        <div class="acc_block">
          <i class="far fa-calendar-edit"></i>
          <h5>Date Reg.:</h5>
          <span class="acc_inf"><b><?=date("d.m.Y",$prof_data["date_reg"]); ?></b></span>
        </div>
        <div class="acc_block">
          <i class="fas fa-history"></i>
          <h5>In Project:</h5>
          <span class="acc_inf"><b><?=intval(((time() - $prof_data["date_reg"]) / 86400 ) ); ?> days</b></span>
        </div>
        <div class="acc_block">
          <i class="far fa-users-class"></i>
          <h5>Ref. Leader:</h5>
          <span class="acc_inf"><b><?=$prof_data["referer"]; ?></b></span>
        </div>
      </div>
      <div class="acc_contain_2  d-flex justify-content-center align-items-center flex-wrap">
        <div class="acc_stat">
          <h5 class="acc_rub">Insert</h5>
          <span class="acc_digit"><b><?=$in?>$</b></span>
        </div>
        <div class="acc_stat">
          <h5 class="acc_rub">Withdraw</h5>
          <span class="acc_digit"><b><?=$out?>$</b></span>
        </div>
        <div class="acc_stat">
          <h5 class="acc_rub">Ref. Earn</h5>
          <span class="acc_digit"><b><?=$ref?>$</b></span>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="clr"></div>
</div>