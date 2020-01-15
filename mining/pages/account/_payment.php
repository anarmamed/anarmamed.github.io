
<div class="container withdraw">
  <div class="indexx">
    <h1>Withdraw of funds</h1>
  </div>



  <?php
        $_OPTIMIZATION["title"] = " Заказ выплаты";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$tim = time();

        # Для того чтобы перекрыть выплаты нужно заменить нижнюю строку на if ($usid !=22 ) а чтобы открыть доступ написать такую строку:  if ($usid ==999999 )
        if ($usid ==9044444 )
          { ?>

  We apologize for temporary inconvenience.<BR />
  The problem with the server.<BR />


</div>
</div>
<div class="clr"></div>
</div>
<?php
    return;
  } ?>

<?PHP


$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT sum(amount) FROM db_sell_items WHERE user_id = '$usid' AND time_frozen>'$tim' ");
$frozen = sprintf("%.2f",$db->FetchRow());
$apply = sprintf("%.2f", $user_data['money_p']-$frozen);



if($user_data["payment_sum"] <= 0 ){
$sumzar = $user_data['payment_sum']*100;
} else {
$sumzar = ($user_data['payment_sum']*100)/$user_data['insert_sum'];
}
$db->Query("SELECT crypto_safe FROM db_users_a WHERE id = '$usid' LIMIT 1");
$crypto = $db->FetchRow();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# Создание условий для заполнения кошельков:




$min_ser = $sonfig_site["min_pay"] * $sonfig_site["ser_per_wmr"];
$status_array = array( 0 => "<font color='brown'>Checking</font>", 1 => "Done", 2 => "<font color='red'>Сanceled</font>", 3 => "<font color='green'>Paid</font>");

# Список платежек
if(!isset($_GET["pay_id"])){

  if(isset($_POST["sys_pay"])){ Header("Location: /account/payment/".$_POST["sys_pay"]); return; }

  $db->Query("SELECT * FROM db_pay_systems ORDER BY id DESC");

  if($db->NumRows() == 0){ echo "<center>No payment systems :(</center><BR /><div class='clr'></div></div>  "; return; }
if ($frozen >0) { ?>
<div class="notice" style="margin: 0;"><i class="fas fa-info-circle"></i> <b>Attention!</b> You have frozen money since
  you previously sold your mining power. We remind, after you have sold your mining power, the sale amount is frozen up
  to 72 hours<br>Now you have frozen <span><?=$frozen?></span>$. Available to withdraw <span><?=$apply?></span>$. You
  can get more information in the <a href="/account/history">history</a> tab.</div>
<?php }
  ?>


<div class="form_pay">
  <h3>Select a payment system:</h3>
  <form class="d-flex flex-column " action="" method="POST">
    <select name="sys_pay" class="image-picker">
      <option data-img-src="/img/11i.png" selected="selected" value="11">PerfectMoney(instant)</option>
      <option disabled="disabled" data-img-src="/img/10io.png" value="10">Payeer(instant)</option>
      <option disabled="disabled" data-img-src="/img/p_btсo.png" value="21">Bitcoin</option>
      <option disabled="disabled" data-img-src="/img/p_etho.png" value="22">Etherium</option>
      <option disabled="disabled" data-img-src="/img/p_liteo.png" value="23">Litecoin</option>
      <option disabled="disabled" data-img-src="/img/p_dogeo.png" value="24">Dogecoin</option>
      <option disabled="disabled" data-img-src="/img/p_dasho.png" value="25">Dash</option>
      <option disabled="disabled" data-img-src="/img/p_btc_casho.png" value="26">Bitcoincash</option>
      <option disabled="disabled" data-img-src="/img/p_zcasho.png" value="27">Zcash</option>
      <option disabled="disabled" data-img-src="/img/p_moneroo.png" value="28">Monero</option>
      <option disabled="disabled" data-img-src="/img/p_eth_classo.png" value="29">EthereumClassic</option>
      <option disabled="disabled" data-img-src="/img/p_rippleo.png" value="30">Ripple</option>
    </select>
    <input type="submit" class="int_main btn-primary" value="Continue" />
  </form>
</div>



</div>
</div>
</div>
<script type="text/javascript" src="/js/jquery3.1.min.js"></script>
<script type="text/javascript" src="/js/image-picker.min.js"></script>
<script>
  $("select").imagepicker()
</script>
<div class="clr"></div>
</div>
<?PHP

return;
}else{

  $pay_id = intval($_GET["pay_id"]);
if ($pay_id == 'chanel10') {
  ?>
<?php
$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
    $arBalance = $payeer->getBalance();
    $balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
   /* echo $balance;*/
if ( !isset($balance) ) { ?>
We apologize for temporary inconvenience.<BR />
The problem with the server.<BR />
</div>
</div>
</div>
<div class="clr"></div>
</div>
<?php
    return; ?>
<?php } ?>

<?PHP
$_OPTIMIZATION["title"] = "Withdraw of funds";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
  
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
  $summpay = $user_data["level"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_dataa = $db->FetchArray();
 $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' order by id DESC LIMIT 1");
 $frompayments = $db->FetchArray();
  
/*$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();*/
  
$status_array = array( 0 => "<font color='brown'>Checked</font>", 1 => "Paid", 2 => "<font color='red'>Canceled</font>", 3 => "<font color='green'>Paid</font>");
  
# Минималка серебром!
$minPay = 1;
$maxPay = 200;
# Настраиваем кол-во суток для ограничения.
$nd_time = 1;

$user_id = $_SESSION["user_id"];
 $db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();






?>



<center> <img style="width: 20vw" src="/img/payment/<?=$pay_id?>.png"> </center><br>
<center>
  <font color="green">Вы вывели <b> <?=round($user_data["payment_sum"])?></b> руб / <?=sprintf("%.2f",$sumzar);?>% от
    суммы Вашего вклада </font>
</center><br>
<b>Выплаты осуществляются в автоматическом режиме! Процент при выводе составляет 0%</b>
<b>Из платежной системы Payeer Вы можете вывести свои средства в автоматическом режиме на все известные платежные
  системы и международные банки.</b>
<b>Ссылки на учебные материалы:</b>

- <a href="http://payeer.com/?partner=182374" target="_blank">Создание счета в Payeer</a>
- <a href="http://payeeer.ru/outpay" target="_blank">Вывод средств из payeer</a>

</br> </br>
<style type="text/css">
  .blok1 {
    background: white;
    width: 95%;
    /* ширина блока */
    border: 2px dotted #cc0000;
  }
</style>


<center><b>Заказ выплаты:</b>
  Ваш кошелек Payeer <font color="green"><?=$user_data["payeer_wallet"];?></font>
</center>
<?PHP
# Заглушка минималки

if($_POST["sum"] >= 250001){

?>
<center>
  <font color="blue"><b>Максимальная сумма для автовыплат составляет 250000 серебра в сутки!<b></font>
</center><BR />

<BR /><BR />
<div class="clr"></div>
</div>
<?PHP

return;
}

?>

<?PHP

$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();

 function ViewPurse($purse){
    
    if( substr($purse,0,1) != "P" ) return false;
    if( !ereg("^[0-9]{7,8}$", substr($purse,1)) ) return false;
  return $purse;
 }
   
 # Заносим выплату
 if(isset($_POST["swap"])){
    
  $purse = $user_data["payeer_wallet"];
  $attempts = 3;
  $sum = floatval($_POST["sum"]);
  $summax = $max - $prof_data["payment_sum"];
  $plat_passs = intval($_POST["plat_pass"]);
    $plat_pass = $plat_passs;
  $val = "RUB";
    $moneyreting = ($sum * 0.01 / 100);
    $ti_to_un = 86400-(time() - $prof_data['date_block_pin']);
    $time_to_un = $func->ConvertTime($ti_to_un);
    if ($user_data["payeer_off"]=='0') {
    if ($prof_data['date_block_pin'] <= time() - 86400) {
    if(($attempts-$prof_data['pin_attempt']) >= 1 ) {
if($plat_pass == $user_dataa['plat_pass']) {
  $db->Query("UPDATE db_users_a SET pin_attempt = '0' WHERE id = '$usid'");
  if($purse !== false){
     
    if($sum >= $minPay){
      if($sum >= $maxPay){
     if($sum <= $user_data["money_p"]){
        if($sum <= $apply){
                            # Проверяем на существующие заявки
                        $db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
                        if($db->FetchRow() == 0){
                                 
                             ### Устанавливаем лимит на 24 часа по выплатам для $USID
                          $ostalo= $sonfig_site["payment_payeer"] - (time()-$frompayments["date_add"]);
                          $ostalos = $func->ConvertTime($ostalo);
       if ($frompayments["date_add"] <= time() - $nd_time * $sonfig_site["payment_payeer"]) {
                            ### Делаем выплату ###
                            /*$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);*/
                          if ($user_dataa['satana']<4)
                          {
                            if ($payeer->isAuth())
                            {
                                /*$arBalance = $payeer->getBalance();*/
                                if($arBalance["auth_error"] == 0)
                                {
                                    $sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
                                    /*$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];*/
                                    if( ($balance) >= ($sum_pay)){
                                    $arTransfer = $payeer->transfer(array(
                                    'curIn' => 'RUB', // счет списания
                                    'sum' => $sum_pay, // сумма получения
                                    'curOut' => 'RUB', // валюта получения
                                    'to' => $purse, // получатель (email)
                                    //'to' => '+71112223344',  // получатель (телефон)
                                    //'to' => 'P1000000',  // получатель (номер счета)
                                    'comment' => iconv('windows-1251', 'utf-8', "Payment for: {$usname} from Evolution-Mining")
                                    //'anonim' => 'Y', // анонимный перевод
                                    //'protect' => 'Y', // протекция сделки
                                    //'protectPeriod' => '3', // период протекции (от 1 до 30 дней)
                                    //'protectCode' => '12345', // код протекции
                                    ));
                                        if (!empty($arTransfer["historyId"]))
                                        {
                                        # Снимаем с пользователя
                                            $db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
                                            # Вставляем запись в выплаты
                                            $da = time();
                                            $dd = $da + 60*60*24*15;
                                            $ppid = $arTransfer["historyId"];
                                            $db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status)
                                            VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");
                                             
                                            $db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
                                           
                                            ?>
<div id='messID' onclick='hidemessage()' class='message2 m-white'>
  <center>
    <img src="/images/successs.png" /><br />
    <b>Средства успешно выплачены на Ваш Payeer кошелек!</b><br />
    Вы можете получить дополнительные бонусы в разделе <a style="color: brown"
      href="/account/joblist">&#171;Задания&#187;</a> если оставите отзыв на форуме MMGP о нашей игре<br />
    <a href="https://mmgp.ru/showthread.php?t=609075"><img src="/images/mmgp.png" /></a><br />
  </center>
</div>";
<?php
                                        }else{  echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Не удалось выплатить! Подозрительная активность. Возможно Вы ввели нерабочий Кошелек<br>Обратитесь к Администрации и смените кошелек</div>";
                                        }
                                    }else echo "<center><font color = 'red'><b>У Вас на балансе нет столько денег!</b></font></center>";
                                }else echo "<center><font color = 'red'><b>Что то с Вашей автроризацией</b></font></center>";
                            }else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center>";
                          }else  echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Не удалось выплатить! Подозрительная активность.<br>Дождитесь принятия решения администрации</div>";
                          }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>В ближайшие 24 часа Вы уже получали выплату!<br>Попробуйте позже<br/>До разблокировки осталось: ".$ostalos."</div>";
                        }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>У вас имеются необработанные заявки. Дождитесь их выполнения</div>";
                             
                    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>You have frozen money.<br>You can withdraw: ".$apply."$</div>";
                    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Вы указали больше, чем имеется на вашем счету</div>";
                 
                 }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Максимальная сумма для выплаты составляет {$maxPay} серебра!</div>";
                }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Минимальная сумма для выплаты составляет {$minPay} серебра!</div>";
         
        }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Кошелек Payeer указан неверно! Смотрите образец!</div>";
      }else{
        $db->Query("UPDATE db_users_a SET pin_attempt = pin_attempt + 1 WHERE id = '$usid'");
        $db->Query("SELECT pin_attempt FROM db_users_a WHERE id = '$usid'");
        $attemm = $db->FetchRow();
        $last_attem = $attempts-$attemm;
      echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Платежный пароль указан не верно!<br/>Осталось попыток: ".$last_attem."</div>";}
      }else{
      $tim = time();
      $db->Query("UPDATE db_users_a SET date_block_pin = '$tim' WHERE id = '$usid'");
      $db->Query("UPDATE db_users_a SET pin_attempt = 0 WHERE id = '$usid'");
      echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Вы более 3-х раз ввели неправильно платежный пароль. <br> Вывод заблокирован на 24 часа!</div>";}
      }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Вывод заблокирован на 24 часа!<br/>До разблокировки осталось: ".$time_to_un."</div>";
    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Вы ранее отключили вывод на Payeer!<br/>Вывод невозможен!</div>";
    }
?>
<?php
if($user_dataa['plat_pass'] == 0) {
  echo "<center><b><font color = 'red'>Укажите платежный пароль в профиле!</font></b></center><BR />";
} else {
if ($user_data["payeer_off"]=='0') {
if ($user_data["payeer_wallet"]!='0') {
?>
<form action="" method="post">
  <table width="99%" border="0" align="center">


    <tr>

    </tr>

    <tr>
      <td>
        <font color="#000;">Отдаете серебро для вывода</font> [Мин. <?=$minPay?></span>]<font color="#000;">:</font>
      </td>
      <td><input type="text" name="sum" id="sum" value="<?=floor($user_data["money_p"]); ?>" size="15"
          onkeyup="PaymentSum();" /></td>
    </tr>
    <tr>
      <td>
        <font color="#000;">Получаете <span id="res_val"></span></font>
        <font color="#000;">:</font>
      </td>
      <td><input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled" /></td>
    <tr>
      <td>
        <font color="#000;">Платежный пароль[указывается в профиле]</font>:
      </td>
      <td><input type="text" name="plat_pass" size="15" /></td>
    </tr>
    <tr>

      <input type="hidden" name="per" id="RUB" value="<?=$sonfig_site["ser_per_wmr"]; ?>" disabled="disabled" />
      <input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled" />
      <input type="hidden" name="val_type" id="val_type" value="RUB" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="swap" value="Заказать выплату" class="sumserf2"
          style=" margin-top:10px;" /></td>
    </tr>
  </table>
</form>
<script language="javascript">
  PaymentSum();
  SetVal();
</script>

<? }
else{ echo "
 <div style='margin:8px; background: red; color: white; border: 2px dashed white; padding: 10px;'>
<h3>Вам необходимо добавить кошелек Payeer в настройках аккаунта! <a href='/account/config' style='color: white;' >перейти>></a> </h3>
</div>";}
}else echo"<div style='margin:8px; background: red; color: white; border: 2px dashed white; padding: 10px;'><h3>Вы ранее уже отключили Payeer кошелек.<br> В целях безопасности Ваших денег повторное включение невозможно</h3></div>";
}
?>

















<?php # Конец кода платежной системы Payeer
}elseif ($pay_id == 11) { #Платежная система PerfectMoney
 

?>
<script LANGUAGE="JavaScript1.1">
  document.oncontextmenu = function () {
    return false;
  };
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('.splLink').click(function () {
      $(this).parent().children('div.splCont').toggle('normal');
      return false;
    });
  });
</script>
<?php
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_dataa = $db->FetchArray();
$mywalperf = ($user_data["perfect_wallet"] =='0') ? 'you did not set the wallet in the settings' : $user_data["perfect_wallet"] ;
/*$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();*/

 $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' order by id DESC LIMIT 1");
 $frompayments = $db->FetchArray();
# Настраиваем кол-во суток для ограничения.
$nd_time = 1;

$status_array = array( 0 => "<font color='brown'>Checking</font>", 1 => "Done", 2 => "<font color='red'>Сanceled</font>", 3 => "<font color='green'>Paid</font>");


?>

<center> <img style="width: 10vw" src="/img/11i.png"> </center>


<!-- <center><font color = "green">Вы вывели <b> <?=round($user_data["payment_sum"])?></b> руб / <?=sprintf("%.2f",$sumzar);?>% от суммы Вашего вклада </font></center> -->
<br>
<hr>
<center> Minimum withdrawal amount - 1$ <br>
  The maximum amount for auto payments is $ 200 per day!<br>
  Your wallet: <font color="red"><?=$mywalperf ?></font>
</center>
<div class="notice green" style="margin: 0;"><i class="fas fa-info-circle"></i> <b>Advice!</b> From the payment system
  <font color="red">PerfectMoney</font> You can withdraw your funds automatically to all known payment systems and
  international banks.</div>




<?php
# Заглушка минималки

if($_POST["sum"] >= 250001){

?>
<center>
  <font color="blue"><b>The maximum amount for auto payments is $ 50 per day!<b></font>
</center><BR />

<BR /><BR />
<div class="clr"></div>
</div>
<?PHP

return;
}


# Минималка серебром!
$minPay = 0.1;
$maxPay = 200;
  function ViewPurse($purse){

    if( substr($purse,0,1) != "U" ) return false;
    if( !preg_match("/^[0-9]{7,8}$/", substr($purse,1)) ) return false;
    return $purse;

  }


  # Заносим выплату
  if(isset($_POST["swap"])){

    $purse = $user_data["perfect_wallet"];
    $attempts = 3;
    $sum = floatval($_POST["sum"]);
    $val = "USD";
    $plat_passs = intval($_POST["plat_pass"]);
    $plat_pass = $plat_passs;
    $ti_to_un = 86400-(time() - $user_dataa['date_block_pin']);
    $time_to_un = $func->ConvertTime($ti_to_un);
    if ($user_data["perfect_off"]=='0') {
    if ($user_dataa['date_block_pin'] <= time() - 86400) {
    /*if(($attempts-$user_dataa['pin_attempt']) >= 1 ) {
    if($plat_pass == $user_dataa['plat_pass']) {*/
       $db->Query("UPDATE db_users_a SET pin_attempt = '0' WHERE id = '$usid'");
      if($purse !== false){

          if($sum >= $minPay){
            if($sum <= $max){
            if($sum <= $user_data["money_p"]){
              if($sum <= $apply){
                ### Устанавливаем лимит на 24 часа по выплатам для $USID
              $ostalo= 86400 - (time()-$frompayments["date_add"]);
                          $ostalos = $func->ConvertTime($ostalo);
       if ($frompayments["date_add"] <= time() - $nd_time * 86400) {
              # Проверяем на существующие заявки
              $db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
              if($db->FetchRow() == 0){


                ### Делаем выплату ###
                $sum_pay = round( ($sum / $sonfig_site["ser_per_wmz"]), 2);
                $memo = iconv('windows-1251', 'utf-8', "Payment_for:_'$usname'_from_Evolution-Mining_");
                $AutoPay= $config->AutoPay;
                $AccountNumberPM = $config->AccountPaymentPM;
                $PmId = $config->PmId;
                $PmPass = $config->PmPass;

                if($AutoPay == "on") {

                  if ($user_dataa['satana']<4)
                          {
                  $arBalance = $func->PmBalance($PmId, $PmPass);
                  # print_r($arBalance);

                  if($arBalance["".$AccountNumberPM.""] != 0)
                  {

                        $sum_pay = round( ($sum / $sonfig_site["ser_per_wmz"]), 4);
                      $kom = round( ($sum_pay * 0.005), 4); //комиссия
                            $sum_end = round( ($sum_pay-$kom), 2);

                    $balance = $arBalance["".$AccountNumberPM.""];
                    if( ($balance) >= ($sum_pay+0)){

                                          $arMoney = $func->SendMoneyPm($PmId, $PmPass, $AccountNumberPM, $purse, $sum_end, $memo);
                      # $arMoney['Payee_Account_Name'];
                      # $arMoney['Payee_Account'];
                      # $arMoney['Payer_Account'];
                      # $arMoney['PAYMENT_AMOUNT'];
                      # $arMoney['PAYMENT_BATCH_NUM'];
                      # $arMoney['PAYMENT_ID'];
                                            # print_r($arMoney);

                      if (!empty($arMoney['PAYMENT_ID']))
                      {

                        # Снимаем с пользователя
                        $db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");

                        # Вставляем запись в выплаты
                        $da = time();
                        $dd = $da + 60*60*24*15;

                        $ppid = $arMoney['PAYMENT_BATCH_NUM'];

                        $db->Query("INSERT INTO db_payment (comission,user, user_id, purse, sum, valuta, serebro, pay_sys, payment_id, date_add, status, date_del)
                        VALUES ('$kom','$usname','$usid','$purse','$sum_end','USD','$sum','PM','$ppid','".time()."','3','$dd')");

                            $db->Query("SELECT ser_per_wmz FROM db_config WHERE id = '1' LIMIT 1");
  $rofig_site = $db->FetchArray();
  $pofig_site = $rofig_site["ser_per_wmz"];
      
    $convrub = (($pofig_site / 100) * $sum_pay);
                        
                        
                        
                        $db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$convrub' WHERE id = '$usid'");
                        $db->Query("UPDATE db_stats SET all_payments = all_payments + '$convrub' WHERE id = '1'");
                        ?>
<div id='messID' onclick='hidemessage()' class='message2 m-white'>
  <center>
    <!-- <img src="/images/successs.png"/><br/> -->
    <b>Funds were successfully paid to your Perfect Money wallet!</b><br />
  </center>
</div>";
<?php

                      }
                      else
                      {
                        echo "<center><font color = 'red'><b>Internal error - report it to the administrator!</div>";
                      }


                    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Internal Error - Please Retry!</div>";


                  }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Failed to pay! try later</div>";
                   }else  echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Failed to pay! Suspicious activity. <br> Wait for the decision of the administration</div>";
                }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Auto payments on PerfectMoney are disabled.</div>";


              }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>You have unprocessed applications. Wait for them to complete.</div>";

            }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>In the next 24 hours you have already received a payment! <br> Try later <br>Until unlock: ".$ostalos."</div>";

            }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>You have frozen money.<br>You can withdraw: ".$apply."$</div>";
            }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>You have entered more than what is in your account</div>";
          }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The maximum amount for payment is {$maxPay} $!</div>";
          }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>The minimum amount for payment is {$minPay} $!</div>";

      }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Wallet specified incorrectly! See the sample!</div>";
     /* }else{
        $db->Query("UPDATE db_users_a SET pin_attempt = pin_attempt + 1 WHERE id = '$usid'");
        $db->Query("SELECT pin_attempt FROM db_users_a WHERE id = '$usid'");
        $attemm = $db->FetchRow();
        $last_attem = $attempts-$attemm;
      echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Платежный пароль указан не верно!<br/>Осталось попыток: ".$last_attem."</div>";}*/
      /*}else{
      $tim = time();
      $db->Query("UPDATE db_users_a SET date_block_pin = '$tim' WHERE id = '$usid'");
      $db->Query("UPDATE db_users_a SET pin_attempt = 0 WHERE id = '$usid'");
      echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Вы более 3-х раз ввели неправильно платежный пароль. <br> Вывод заблокирован на 24 часа!</div>";}*/
      }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>Withdrawal blocked for 24 hours!<br/>Until unlock: ".$time_to_un."</div>";
    }else echo "<div id='messID' onclick='hidemessage()' class='message m-red' style='left: -500px; transition: all 1s ease;'>You have previously disabled the output to PerfectMoney! <br/> No withdrawal possible!</div>";

    
  }
/*  if($user_dataa['plat_pass'] == 0) {
  echo "<center><b><font color = 'red'>Укажите платежный пароль в профиле!</font></b></center><BR />";
} else {*/
if ($user_data["perfect_off"]=='0') {
if ($user_data["perfect_wallet"]!='0') {
?>
<div><a href="javascript//" class="splLink"></a>
  <hr>
  <div class="splCont">
    <form action="" method="post">
      <table width="99%" border="0" align="center">

        <tr align="center">
          <td>Enter the amount to withdraw</td>
        </tr>
        <tr align="center">
          <td><input style="text-align: center;" type="text" name="sum" id="sum" autocomplete="off"
              value="<?=floor($user_data["money_p"])?>" size="5" onkeyup="PaymentSum();" /> $</td>
          <input type="hidden" name="per" id="RUB" value="<?=$sonfig_site["ser_per_wmz"]; ?>" disabled="disabled" />
          <input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled" />
          <input type="hidden" name="val_type" id="val_type" value="RUB" />
        </tr>
        <!-- <tr>
    <td><font color="#000;">Получаете [USD]<span id="res_val"></span></font><font color="#000;">:</font> </td>
  <td>
  <input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled"/>
  
  </td>
  </tr>
  <tr>
    <td><font color="#000;">Платежный пароль[указывается в профиле]</font>: </td>
  <td><input type="text" name="plat_pass" size="15"/></td>
  </tr>-->
        <tr>
          <td colspan="2" align="center"><input type="submit" name="swap" value="Order payment" class="int_main"
              style=" margin-top:10px;" /></td>
        </tr>
      </table>
    </form>

  </div>
</div>
<script language="javascript">
  PaymentSum();
  SetVal();
</script>
<? } else echo "<div class='error' style='margin: 0;'><i class='fas fa-exclamation-triangle'></i>  <b>Error!</b> You need to add PerfectMoney wallet in your account settings! <a href='/account/config' style='color: red;' >go to settings>> </a> </div><br><br>";
}else echo"<div style='margin:8px; background: red; color: white; border: 2px dashed white; padding: 10px;'><h3>Вы ранее уже отключили PerfectMoney кошелек.<br> В целях безопасности Ваших денег повторное включение невозможно</h3></div>";
/*}*/
?>




<?php
  }
}
?>
<br><br>
<center>
  <h1>Your last 10 cash withdrawals</h1>
</center>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">

  <tr>

    <td align="center" class="m-tb">Withdraw</td>
    <td align="center" class="m-tb">Wallet</td>
    <td align="center" class="m-tb">Date</td>
    <td align="center" class="m-tb">Status</td>
  </tr>
  <?PHP

  $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' AND status IN (0,2,3)  ORDER BY id DESC LIMIT 10");

  if($db->NumRows() > 0){

      while($ref = $db->FetchArray()){
        if ($ref["valuta"]=='BTC') {
          $stoim = sprintf("%.5f",$ref["sum"]);
        }else{$stoim = sprintf("%.2f",$ref["sum"]);}
    ?>
  <tr class="htt">

    <td align="center"><?=$stoim ?> <?=$ref["valuta"]; ?></td>
    <td align="center"><?=$ref["purse"]; ?></td>
    <td align="center"><?=date("d.m.Y в H:i:s",$ref["date_add"]); ?></td>
    <td align="center"><?=$status_array[$ref["status"]]; ?></td>
  </tr>
  <?PHP

    }

  }else echo '<tr><td align="center" colspan="5">No withdrawals</td></tr>'
  ?>



</table>

</div>
</div>
</div>
<div class="clr"></div>
</div>