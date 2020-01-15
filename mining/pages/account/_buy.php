<script>
  /*document.oncontextmenu = function(){return false;};*/

  function proverka(input) {
    ch = input.value.replace(/[^\d]/g, ''); //разрешаем вводить только числа и запятую
    pos = ch.indexOf(','); // проверяем, есть ли в строке запятая
    if (pos != -1) { // если запятая есть
      if ((ch.length - pos) > 2) { // проверяем, сколько знаков после запятой, если больше 1го то
        ch = ch.slice(0, -1); // удаляем лишнее
      }
    }
    input.value = ch; // приписываем в инпут новое значение
  };
</script>
<?PHP
$_OPTIMIZATION["title"] = "Buy miner";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$time_r = time();
#данные для срока 
$life_time = new life_time($db);
$life_time->CheckTime($usid);

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
$need =floor($user_data["money_b"]/$sonfig_site["amount_a_t"]);
$left = 200-$user_data['a_t'];
$need = ($need>=$left) ? $left : $need ;


$need_b = floor($user_data["money_b"]/$sonfig_site["amount_b_t"]);
$need_c = floor($user_data["money_b"]/$sonfig_site["amount_c_t"]);

// update collect time if user haven't miners
if ($user_data["a_t"] < 1 && $user_data["last_sbor"] < (time() - 600)) {
  $db->Query("UPDATE db_users_b SET last_sbor = '$time_r' WHERE id = '$usid' LIMIT 1");
}

function declOfNumm($number, $titles)
{
    $cases = array (2, 0, 1, 1, 1, 2);
    return $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[min($number%10, 5)] ];
}

// настройки ограничейний
$max_a_t = $sonfig_site["limit_a_t"];
$max_b_t = $sonfig_site["limit_b_t"];
$max_c_t = $sonfig_site["limit_c_t"];
# Покупка нового дерева
if(isset($_POST["item"])){
$kolvo = intval($_POST["kolvo"]);
if ($kolvo > 0) {
if ($kolvo<=$need) {
$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t");
$array_max = array(1 => $max_a_t, 2 => $max_b_t, 3 => $max_c_t);
$array_name = array(1 => "a_s", 2 => "b_s", 3 => "c_s");
$item = intval($_POST["item"]);
if ($kolvo < 0) {
$kolvo = $kolvo * (-1);
}else {$kolvo = 1 * $kolvo;}
$citem = $array_items[$item];

    if(strlen($citem) >= 3){
       
        # Проверяем средства пользователя
        $need_money = $sonfig_site["amount_".$citem] * $kolvo;
        if($need_money <= $user_data["money_b"]){
       
            if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){
               if ($user_data[$citem] + $kolvo <= $array_max[$item]) {
                $to_referer = $need_money * 0.1;
                # Добавляем дерево и списываем деньги
                $db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + '$kolvo',  
                last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");

                $titem = "s_".substr($citem,0,1);
                $ttime = time()+60*60*24*1;

                $smart_name = $array_name[$item];
                $amout_se = $kolvo*1;
                # Вносим запись о покупке
        

                /*$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
                VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");*/

                $db->Query("INSERT INTO db_sell_items (user, user_id, $smart_name, amount, date_add, buy_sell) VALUES 
                  ('$usname','$usid','$kolvo','$amout_se','".time()."', '1')"); 
                /*for ($i=1;$i<=$kolvo;) { 
                $life_time->AddItem($usid,$citem); 
                $i++; 
                }*/
            
                echo "<div id='messID' onclick='hidemessage()' class='message m-green' style='left: -500px; transition: all 1s ease;'>Fine! You rented cloud mining power</div>";
               
                $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
                $user_data = $db->FetchArray();
               } else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Pay attention to the restrictions on renting cloud mining </div>";
            }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Before renting new miners power you should go to the \"Your miners\" tab and collect daily earnings. This is necessary for the starting point of new cloud miners</div>";
       
        }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>No money in the account \"For Buying\". Top up your account!</div>";
   
    }else echo 222;
  }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>You can buy only ".$need."0 G/h bitcloud power</div>";
}else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Wrong amount</div>";
}
//daily income
$first_a = $sonfig_site['a_in_h']/10000;
$first_daily_proc = round($sonfig_site['amount_a_t']*($first_a*24),2);

$first_b = $sonfig_site['b_in_h']/10000;
$first_daily_proc_b = round($sonfig_site['amount_b_t']*($first_b*24),2);

$first_c = $sonfig_site['c_in_h']/10000;
$first_daily_proc_c = round($sonfig_site['amount_c_t']*($first_c*24),2);

$first_d = 55/10000;
$first_daily_proc_d = round($sonfig_site['amount_c_t']*($first_d*24),2);

$first_e = 58/10000;
$first_daily_proc_e = round($sonfig_site['amount_c_t']*($first_e*24),2);

$first_f = 63/10000;
$first_daily_proc_f = round($sonfig_site['amount_c_t']*($first_f*24),2);
?>














<!-- 
<?php 
$vsegor=$user_data["a_t"]+$user_data["b_t"]+$user_data["c_t"];
if($vsegor>0){
?>

<div class="silver-bk justify-content-center">
  <div class="row justify-content-center">
    <div class="col-8 justify-content-center">
      <div class="indexx">
        <span>МОИ РЫБАКИ</span>
      </div>
    </div>
    <div class="col-12 justify-content-center"><br>
      <div class="row justify-content-center">
        <?php $life_time->GetTable($usid); ?>
        <br><br>
      </div>
    </div>
  </div>
</div>
<br><br><br>


<?php } ?> -->

<div class="buy">

  <div class="indexx">
    <h1>Buy miner</h1>
  </div>


  <div class="container bitcloud">
    <div class="descr">
      <p>Miner is a highly efficient piece of mining equipment specially designed for cryptocurrency mining. Our
        datacenters house hundreds of miners.<br>
        Next, all mined cryptocurrency is distributed among all customers of HashFlare depending on their share of
        hashrate in the whole system.</p>
    </div>


    <!-- <style>
.buy_miner{
  border: 1px solid #0A647A;
  border-radius: 0.3vw;
  text-align: center;
}
.buy_title, .buy_form{
  background-color: #0A647A;
  color: #fff;
  padding: 1vw;
}
.buy_title h3{
  color: #D0FF00;
  font-family:"Handelson W00 Six", sans-serif;
}
.buy_title h2{
  font-family:"Handelson W00 Six", sans-serif;
}
.buy_title span{
  color: #D0FF00;
}
.buy_form form{
  margin-bottom: 0;
  font-size: 1.3vw;
}
.buy_form span{
  font-size: 3.5vw;
  color: grey;
  font-family:"Handelson W00 Six", sans-serif;
}
.opacit{
  opacity: 0.3;
}
.spani_top{
  padding-top: 2.3vw;
}
.buy_count{
  text-align: center;
  padding: 0;
  width: 15%;
}
.buy_flex{
  display: flex;
  justify-content:space-around;
}
.buy_text p{
  font-family: 'League Gothic', sans-serif;
  font-size: 1.4vw;
  text-align: justify;
  margin-bottom: 0;
}
.input-group {
  width: 80%;
  margin-left: 10%;
}
</style> -->


    <!-- Bitcloud -->
    <div class="container-fluid buy_content ">
      <div class="row  buy_miner">
        <div class="col-md-4 buy_title">
          <h3>BITCLOUD </h3>
          <p><?=$sonfig_site['amount_a_t']?>$</p>
          <span>for 1 GH/s</span>
        </div>
        <div class="col-md-4 buy_form">
          <form action="" method="post">
            <p><b>Amount:</b></p>
            <input type="number" name="kolvo" value="<?=$need?>" min="0" max="<?=$need?>" step="1" class="buy_count"
              size="3" />
            <input type="hidden" name="item" value="1">
            <input type="submit" value="BUY" class="int_buy">
          </form>
        </div>
        <?php if ($need > 0) { ?>

        <?php }else{ ?>
        <div class="col-2 buy_form spani_top">
          <span>MAX</span>
        </div>
        <?php } ?>
        <div class="col-md-4 buy_text">
          <div class="buy_flex">
            <div class="fr-te-gr mb-3">
             <p> Daily income:<span> <?=$first_daily_proc?></span>%</p>
            </div>
            <div class="fr-te-gr mb-3">
             <p> Earn: <span> <?=$first_a ?>$  </span> /hour </p> 
            </div>
            <div class="fr-te-gr">
             <p> Lease:<span> lifetime </span></p>
            </div>
          </div>
        </div>
      </div>


      <div class="row buy_miner soon">
        <div class="col-md-4 buy_title">
          <h3>BITCLOUD 200+</h3>
          <p><?=$sonfig_site['amount_a_t']?>$</p>
          <span>for 1 GH/s</span>
        </div>
        <?php if ($need > 0) { ?>
          <div class="col-md-4 buy_form">
            <span>SOON</span>
            <!-- <form action="" method="post">
              <p><b>Amount:</b></p>
              <input type="number" name="kolvo" value="<?=$need?>" min="0" max="<?=$need?>" step="1" class="buy_count"
                size="3" />
              <input type="hidden" name="item" value="1">
              <input type="submit" value="BUY" class="int_buy btn-primary">
            </form> -->
          </div>
          <?php }else{ ?>
          <div class="col-2 buy_form spani_top">
            <span>MAX</span>
          </div>
          <?php } ?>
        <div class="col-md-4 buy_text">
          <div class="buy_flex">
            <div class="fr-te-gr mb-3"><b>Daily income: </b>
             <b><?=$first_daily_proc_b?>%</b>
            </div>
            <div class="fr-te-gr mb-3"><b>Earn: </b>
              <b><?=$first_b ?>$</b>
              /hour</font>
            </div>
            <div class="fr-te-gr"><b>Lease: </b>
              lifetime
            </div>
          </div>
        </div>

        
      </div>
      <div class="row buy_miner soon">
        <div class="col-md-4 buy_title">
          <h3>BITCLOUD 500+</h3>
          <p><?=$sonfig_site['amount_a_t']?>$</p>
          <span>for 1 GH/s</span>
        </div>
        <?php if ($need > 0) { ?>
          <div class="col-md-4 buy_form">
            <span>SOON</span>
            <!-- <form action="" method="post">
              <p><b>Amount:</b></p>
              <input type="number" name="kolvo" value="<?=$need?>" min="0" max="<?=$need?>" step="1" class="buy_count"
                size="3" />
              <input type="hidden" name="item" value="1">
              <input type="submit" value="BUY" class="int_buy btn-primary">
            </form> -->
          </div>
          <?php }else{ ?>
          <div class="col-2 buy_form spani_top">
            <span>MAX</span>
          </div>
          <?php } ?>
        <div class="col-md-4 buy_text">
          <div class="buy_flex">
            <div class="fr-te-gr mb-3"><b>Daily income: </b>
             <b><?=$first_daily_proc_c?>%</b>
            </div>
            <div class="fr-te-gr mb-3"><b>Earn: </b>
              <b><?=$first_c ?>$</b>
              /hour</font>
            </div>
            <div class="fr-te-gr"><b>Lease: </b>
              lifetime
            </div>
          </div>
        </div>

        
      </div>
      <div class="row buy_miner soon">
        <div class="col-md-4 buy_title">
          <h3>BITCLOUD 1000+</h3>
          <p><?=$sonfig_site['amount_a_t']?>$</p>
          <span>for 1 GH/s</span>
        </div>
        <?php if ($need > 0) { ?>
          <div class="col-md-4 buy_form">
            <span>SOON</span>
            <!-- <form action="" method="post">
              <p><b>Amount:</b></p>
              <input type="number" name="kolvo" value="<?=$need?>" min="0" max="<?=$need?>" step="1" class="buy_count"
                size="3" />
              <input type="hidden" name="item" value="1">
              <input type="submit" value="BUY" class="int_buy btn-primary">
            </form> -->
          </div>
          <?php }else{ ?>
          <div class="col-2 buy_form spani_top">
            <span>MAX</span>
          </div>
          <?php } ?>
        <div class="col-md-4 buy_text">
          <div class="buy_flex">
            <div class="fr-te-gr mb-3"><b>Daily income: </b>
             <b><?=$first_daily_proc_d?>%</b>
            </div>
            <div class="fr-te-gr mb-3"><b>Earn: </b>
              <b><?=$first_d ?>$</b>
              /hour</font>
            </div>
            <div class="fr-te-gr"><b>Lease: </b>
              lifetime
            </div>
          </div>
        </div>

        
      </div>
      <div class="row buy_miner soon">
        <div class="col-md-4 buy_title">
          <h3>BITCLOUD 2000+</h3>
          <p><?=$sonfig_site['amount_a_t']?>$</p>
          <span>for 1 GH/s</span>
        </div>
        <?php if ($need > 0) { ?>
          <div class="col-md-4 buy_form">
            <span>SOON</span>
            <!-- <form action="" method="post">
              <p><b>Amount:</b></p>
              <input type="number" name="kolvo" value="<?=$need?>" min="0" max="<?=$need?>" step="1" class="buy_count"
                size="3" />
              <input type="hidden" name="item" value="1">
              <input type="submit" value="BUY" class="int_buy btn-primary">
            </form> -->
          </div>
          <?php }else{ ?>
          <div class="col-2 buy_form spani_top">
            <span>MAX</span>
          </div>
          <?php } ?>
        <div class="col-md-4 buy_text">
          <div class="buy_flex">
            <div class="fr-te-gr mb-3"><b>Daily income: </b>
             <b><?=$first_daily_proc_e?>%</b>
            </div>
            <div class="fr-te-gr mb-3"><b>Earn: </b>
              <b><?=$first_e ?>$</b>
              /hour</font>
            </div>
            <div class="fr-te-gr"><b>Lease: </b>
              lifetime
            </div>
          </div>
        </div>

        
      </div>
      <div class="row buy_miner soon">
        <div class="col-md-4 buy_title">
          <h3>BITCLOUD 5000+</h3>
          <p><?=$sonfig_site['amount_a_t']?>$</p>
          <span>for 1 GH/s</span>
        </div>
        <?php if ($need > 0) { ?>
          <div class="col-md-4 buy_form">
            <span>SOON</span>
            <!-- <form action="" method="post">
              <p><b>Amount:</b></p>
              <input type="number" name="kolvo" value="<?=$need?>" min="0" max="<?=$need?>" step="1" class="buy_count"
                size="3" />
              <input type="hidden" name="item" value="1">
              <input type="submit" value="BUY" class="int_buy btn-primary">
            </form> -->
          </div>
          <?php }else{ ?>
          <div class="col-2 buy_form spani_top">
            <span>MAX</span>
          </div>
          <?php } ?>
        <div class="col-md-4 buy_text">
          <div class="buy_flex">
            <div class="fr-te-gr mb-3"><b>Daily income: </b>
             <b><?=$first_daily_proc_f?>%</b>
            </div>
            <div class="fr-te-gr mb-3"><b>Earn: </b>
              <b><?=$first_f ?>$</b>
              /hour</font>
            </div>
            <div class="fr-te-gr"><b>Lease: </b>
              lifetime
            </div>
          </div>
        </div>  
      </div>

    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="clr"></div>
</div>