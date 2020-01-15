<div class="clr"></div>

<td valign="top">

  <html>
  <script LANGUAGE="JavaScript1.1">
    /*document.oncontextmenu = function(){return false;};*/
  </script>
  <?PHP
$_OPTIMIZATION["title"] = "Account - Your miners";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

#данные для срока
/*$life_time = new life_time($db);
$life_time->CheckTime($usid);*/

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$delta= time()-$user_data["last_sbor"]; // Паразит 2.0

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

  if(isset($_POST["sbor"])){
  
    if($user_data["last_sbor"] < (time() - 60) ){
    
      $tomat_s = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
      $straw_s = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
      $pump_s = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
      $delta= time()-$user_data["last_sbor"];
      $for_money_p = round($tomat_s/100000,3);
      $to_referer = $for_money_p*0.1;
      
      $db->Query("UPDATE db_users_b SET
      a_b = a_b + '$tomat_s',
      b_b = b_b + '$straw_s',
      c_b = c_b + '$pump_s',
      all_time_a = all_time_a + '$tomat_s',
      all_time_b = all_time_b + '$straw_s',
      all_time_c = all_time_c + '$pump_s',
      money_p = money_p + '$for_money_p',
      to_referer = to_referer + '$to_referer',
      last_sbor = '".time()."'
      WHERE id = '$usid' LIMIT 1");

      // For referer
      $db->Query("SELECT referer_id FROM db_users_a WHERE id = '$usid' LIMIT 1");
   $refid = $db->FetchRow();
      $db->Query("UPDATE db_users_b SET money_p = money_p + $to_referer, from_referals = from_referals + '$to_referer' WHERE id = '$refid'");
      echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='center; transition: all 1s ease;'>You have successfully collected MH Power Points!</div>";
      
      $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
      $user_data = $db->FetchArray();
      
    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='center; transition: all 1s ease;'>You can collect MH Power Points no more than once every 10 minutes !!!</div>";
  
  }













# Sell mining powers
if(isset($_POST["count_sell"])){
$count_sell=intval($_POST["count_sell"]);
$i_have = $user_data["a_t"];
$rent_get = ($sonfig_site["amount_a_t"]*0.95)*$count_sell;
$da = time();
$d_frozen = $da+(60*60*72);
$allalladdmoney = $count_sell;
if ($count_sell<=$i_have && $count_sell>0) {

        # Update Users Data
    $db->Query("UPDATE db_users_b SET money_p = money_p + '$rent_get', a_t = a_t-'$count_sell'  WHERE id = '$usid' LIMIT 1");

    # Insert a note in the statistics
    $db->Query("INSERT INTO db_sell_items (user, user_id, a_s, amount, date_add, buy_sell, time_frozen) VALUES
    ('$usname','$usid','$count_sell','$rent_get','$da', '2','$d_frozen')");

    echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>You sold {$count_sell}GH/s renting power and earned {$rent_get}$!</div><meta http-equiv='refresh' content='10' />";

    /*

        $da = time();
        $dd = $da + 60*60*24*15;
        $allalladdmoney = $money_add+$money_add_for_buy;
    $allallitems = $all_items+$all_items_for_buy;
        # Вставляем запись в статистику
        $db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, amount, all_sell, date_add, date_del) VALUES
        ('$usname','$usid','$tomat_b','$straw_b','$pump_b','$allalladdmoney','$allallitems','$da','$dd')");
 
    echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>За {$allallitems} Earned {$allalladdmoney} MH Power Points!</div>";
        
        $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
        $user_data = $db->FetchArray();*/
        
    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Sorry, you don't have so much power! {$i_have} </div>";
};









$allfi1 = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
$allfi2 = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
$allfi3 = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
$allfi = $allfi1+$allfi2+$allfi3;
$time_to_infinity = $allfi1+($user_data["a_t"]*$sonfig_site["a_in_h"]);
 ?>















  <!-- <style>
.working_block{
  border: 1px solid #0A647A;
  border-radius: 0.3vw;
  text-align: center;

}
.working_third, .working_first{
  background-color: #0A647A;
  color: #fff;
  padding: 1vw;
  margin: 0 !important;
}
.working_third h3{
  color: #D0FF00;
  line-height: 1;
}
.working_first h3, .working_third h3{
  color: #D0FF00;
  font-family:"Handelson W00 Six", sans-serif;
}
.working_first h2{
  font-family:"Handelson W00 Six", sans-serif;
}
.working_first span{
  color: #D0FF00;
}
.buy_flex{
  display: flex;
  justify-content:space-around;
}
.middler{
  font-size: 1.8vw;
  color: #D0FF00;
}
</style> -->



  <div class="miner">
    <div class="container">
      <div class="indexx">
        <h1>Your miners</h1>
      </div>
      <div class="miner_block">

        <div class="you_miners">
          <?PHP
            $all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"];
            ?>
          <h2>For all the time you mined:</h2>

          <p> <span class="mh"><?=$all_items?> MH Power Points</span> or <span
              class="doll"><?=round($all_items/100000,2)?>$</span> </p>

        </div>


        <div class="buy_now">
          <?php if ($user_data["a_t"] < '1') {
            ?>
          <h4>You have no rented cloud mining power</h4>
          <a href="/account/buy"><button class="int_main">Buy Now</button></a>
          <?php }else{
            $hourly = ($user_data["a_t"]* ($sonfig_site["a_in_h"]*1))/100000;
            ?>
        </div>

        <div class="working_block">
          <div class="container-fluid">

            <div class="row">
              <div class="working_first col-md-4 ">
                <h4>BITCLOUD</h4>
                <p><strong> <?=$user_data["a_t"] ?> GH/s</strong></p>
                <span>Renting power</span>
              </div>
              <div class="working_third col-md-4 d-flex flex-column align-items-center justify-content-center">
                <p class="mb-3"><strong class="timer middler" id="infinity" data-from="<?=$allfi1?>"
                    data-to="<?=$time_to_infinity?>" data-speed="3600000"></strong>
                  <span>MH points</span></p>
                <img class="" width="180px" src="/img/LFYM.gif">
                <form action="" method="post">
                  <input type="submit" class="int_buy" name="sbor" value="Sell for <?=round($allfi1/100000,3)?>$">
                </form>
              </div>
              <div class="buy_flex  col-md-4 ">
                <div class="fr-te-gr mb-3">
                  <p>Daily collect: </p>
                  <strong><?=$hourly*24?>$</strong>
                </div>
                <div class="fr-te-gr">
                  <p>Hourly collect: </p>
                  <strong><?=$hourly ?>$</strong>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="sell">
          <h3>Sell Your Mining Powers</h3>
          <div class="sell_form">
            <form action="" method="post">
              <div class="mainn ">
                <div class="out">
                  <output id="retro">You get:<b>0.95$</b></output>
                  <input type="range" name="count_sell" value="1" step="1" min="1" max="<?=$user_data["a_t"] ?>">
                </div>
                <div class="range ">
                  <small class="min  float-left">Min 1GH/s</small>
                  <small class="max  float-right">Max <?=$user_data["a_t"] ?>GH/s</small>
                </div>
                <input type="submit" value="Sell" class="int_main ">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="notice mb-4">
        <span> <i class="fas fa-info-circle"></i> <strong>Attention!</strong> </span>
        <p> You can sell
          your miners at any time. Before you sell mining power dont forget to collect mined MH points, if not -
          uncollected MH points will be LOST. Remember, when selling mining capacities, you lose 5% of the cost,
          after selling you should wait 0-72 hours and get admin's permission, then withdraw will be instant</p>
      </div>
    </div>

    <?php } ?>

  </div>
  </div>
  </div>
  </div>

  <div class="clr"></div>
  </div>