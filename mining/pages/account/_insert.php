<?php /*header("Content-type: text/html; charset=utf-8");*/ ?>
<!-- <style>
  .slideMenuCont {
    position: relative;
    background: #ffffff;
    overflow: hidden;
    width: 100%;
    border-radius: 0 10px 0 0;
  }

  .slideMenu {
    width: 96%;
    margin: 0 auto;
    position: relative;
    background: #ebebeb;
    text-align: center;
    z-index: 2;
    border-radius: 30px;
    -webkit-box-shadow: 0px 9px 17px -9px #678396;
    -moz-box-shadow: 0px 9px 17px -9px #678396;
    box-shadow: 0px 9px 17px -9px #678396;
  }

  .slideMenu ul {
    position: relative;
    line-height: 50px;
  }

  .slideMenu ul li {
    margin: 0 5px 0 0;
    display: inline;
  }

  .slideMenu ul li.active a {
    color: #FF0000;
  }

  .MenuBlockCont {
    background-color: #fff798;
    border-radius: 0.5vw 0 0 0.5vw;
    border: 0.3vw solid #FAAC00;
    position: relative;
    padding: 0 0 39px 0;
    z-index: 1;
    height: 40vw;
  }

  .item img {
    max-width: 50vw;
    max-height: 30vw;
  }

  .slideMenuCont .item {
    width: 100%;
    z-index: 1;
    overflow: hidden;
    position: absolute;
    top: 0;
    left: 0;
  }

  .overlay {
    visibility: hidden;
    overflow: auto;

    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;

    background: #fff;
  }

  .overlay.-active {
    visibility: visible;
  }

  .overlay[data-animation="in"] {
    animation: overlay-in 0.5s ease 1;
  }

  .overlay[data-animation="out"] {
    animation: overlay-out 0.5s ease 1;
  }

  @keyframes overlay-in {

    0% {
      visibility: hidden;
      opacity: 0;
      transform: translateX(100%);
    }

    100% {
      visibility: visible;
      opacity: 1;
      transform: translateX(0);
    }

  }

  @keyframes overlay-out {

    0% {
      visibility: visible;
      opacity: 1;
      transform: translateX(0);
    }

    100% {
      visibility: hidden;
      opacity: 0;
      transform: translateX(-100%);
    }

  }

  .overlay--body {
    max-width: 82vw;

    margin: auto;
    padding: 60px 30px;
  }





  /* Icon close */

  .icon-close {
    display: block;

    width: 4em;
    height: 4em;

    position: relative;

    font-size: 8px;

    transform: rotate(45deg);
  }

  .icon-close:before,
  .icon-close:after,
  .icon-close span:before,
  .icon-close span:after {
    content: "";

    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;

    background: #111;

    transition: 0.2s ease;
    transition-property: transform, width, height;
  }

  .icon-close:before,
  .icon-close:after {
    width: 50%;
    height: 0.5em;

    margin: auto 0;
  }

  .icon-close:after {
    margin-left: auto;
  }

  .icon-close span:before,
  .icon-close span:after {
    width: 0.5em;
    height: 50%;

    margin: 0 auto;
  }

  .icon-close span:after {
    margin-top: auto;
  }

  /* hover */

  .icon-close:hover:before {
    transform: translateX(-1em);
  }

  .icon-close:hover:after {
    transform: translateX(1em);
  }

  .icon-close:hover span:before {
    transform: translateY(-1em);
  }

  .icon-close:hover span:after {
    transform: translateY(1em);
  }

  /* active */

  .icon-close:active:before,
  .icon-close:active:after {
    width: 25%;
  }

  .icon-close:active span:before,
  .icon-close:active span:after {
    height: 25%;
  }

  label {
    margin-bottom: 0;
  }
</style> -->

<?PHP
$_OPTIMIZATION["title"] = "Account - Insert";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
$db->Query("SELECT email FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_email = $db->FetchArray();
$client_email = $user_email['email'];
/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>Engineering works</font></b></center>";
return;
}
*/
?>
<script>
  function add_field(obj) {
    if (obj.value == 22) {
      document.getElementById('client_phone').style.display = 'inline';
    } else {
      document.getElementById('client_phone').style.display = 'none';
    }
    if (obj.value != 22) {
      document.getElementById('client_email').style.display = 'inline';
    } else {
      document.getElementById('client_email').style.display = 'none';
    }
  }
</script>




<div class="deposit">
  <div class="container">
    <div class="indexx">
      <h1>Deposit of funds</h1>
    </div>



    <?
if(isset($_POST['pay_is']) && isset($_POST['service'])){
  
if(intval($_POST['service']) == 1 || /*intval($_POST['service']) == 2 || intval($_POST['service']) == 3 || intval($_POST['service']) == 4 || intval($_POST['service']) == 20 || intval($_POST['service']) == 6 || intval($_POST['service']) == 7 || intval($_POST['service']) == 8 || intval($_POST['service']) == 9 || intval($_POST['service']) == 10 || intval($_POST['service']) == 11 || intval($_POST['service']) == 12 || intval($_POST['service']) == 13 || intval($_POST['service']) == 14 || intval($_POST['service']) == 15 || intval($_POST['service']) == 16 || intval($_POST['service']) == 17 || intval($_POST['service']) == 18 || intval($_POST['service']) == 19 || intval($_POST['service']) == 20 || intval($_POST['service']) == 21 || intval($_POST['service']) == 22 || intval($_POST['service']) == 23 || intval($_POST['service']) == 24 || intval($_POST['service']) == 25 ||*/ intval($_POST['service']) == 40  || intval($_POST['service']) == 41 ){

  //  PAYEER 
if(intval($_POST['service']) == 1){

$sum = round(floatval($_POST["sum"]),2);

# Заносим в БД
$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$_SESSION["user"]);
$m_shop = $config->shopID;
$m_orderid = $db->LastInsert();
$m_amount = number_format($sum, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config->secretW;

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));

?>

    <img style="width: 10vw; margin-bottom: 1vw;" src="/img/10.png"><br>
    <label for="msg">С учетом комиссии Вам необходимо оплатить: <b><?=$sum*1.0095; ?> Руб.</b></label><br />
    <label for="msg">Вы получите: <img style="width: 1.8vw;" src="/images/silver-png.png"><b><?=$sum*100; ?>
        серебра
        <?php if ($sonfig_site["bonus_in"]!=0) { echo "+".$sonfig_site["bonus_in"]."%";} ?></b></label><br />
    <form method="GET" action="//payeer.com/api/merchant/m.php">
      <input type="hidden" name="m_shop" value="<?=$config->shopID; ?>">
      <input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
      <input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
      <input type="hidden" name="m_curr" value="RUB">
      <input type="hidden" name="m_desc" value="<?=$desc; ?>">
      <input type="hidden" name="m_sign" value="<?=$sign; ?>">
      <input type="submit" name="m_process" class="sumserf2" value="Оплатить PAYEER" />
    </form>

  </div>
</div>
</div>

<div class="clr"></div>
</div>

<?PHP
return;
      } // PerfectMoney
      elseif(intval($_POST['service']) == 40){
        ?>
<?
/// db_payeer_insert
if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);
$sum = htmlspecialchars($sum);
$sum_amount = number_format($sum, 2, ".", "");
$ip = $_SERVER['REMOTE_ADDR'];

//PerfectMoney
//$SUGGESTED_MEMO = $_POST["SUGGESTED_MEMO"];
$id = $_POST["PAYMENT_ID"];
//$PAYMENT_AMOUNT = $sum; //$_POST['PAYMENT_AMOUNT'];
$typepayment = "PerfectMoney";
$payment = "0"; //если 0, то НЕТ платежа
$timedat = strtotime(date('d.m.Y H:i:s'));
$memopay = $usid;
$sug_memo = $config->StoreNameve." for ".$usname;

# Заносим в БД
$db->Query("INSERT INTO `db_oplata_pm` VALUES(NULL, '".($typepayment)."', '".($ip)."', '".$sug_memo."', '".$memopay."', '".($payment)."', '', '', '".$timedat."', '', '', '".($sum_amount)."') ");

$id = $db->LastInsert();

//$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");


?>
<center>
  <!-- ======PerfectMoney======= -->
  <img style="width: 10vw; margin-bottom: 1vw;" src="/img/11i.png"><br>
  <label style="font-size: 1.2vw;" for="msg">Including commission, you need to pay:
    <b><?=round($sum_amount*1.005,2) ?> USD</b>(for verified wallets)</label><br />
  <label style="font-size: 1.2vw;" for="msg">You'll get: <b><?=$sum_amount*$sonfig_site["ser_per_wmz"]; ?>$</b> in
    Your Account for
    buying<?php if ($sonfig_site["bonus_in"]!=0) { echo "+".$sonfig_site["bonus_in"]."%";} ?></label><br /><br />
  <form autocomplete="off" id="myForm" action="https://perfectmoney.is/api/step1.asp" method="POST">
    <input type="hidden" name="PAYEE_ACCOUNT" value="<?=$config->AccountNumberPM; ?>">
    <input type="hidden" name="PAYEE_NAME" value="<?=$config->StoreNameve; ?>">
    <input type="hidden" name="PAYMENT_ID" value="<?=$id; ?>">

    <input required="required" placeholder="25" maxlength="10" size="20" type="hidden" id="PAYMENT_AMOUNT"
      name="PAYMENT_AMOUNT" value="<?=$sum; ?>" required>
    <input type="hidden" name="PAYMENT_UNITS" value="USD">
    <input type="hidden" name="STATUS_URL" value="<?=$config->SaitUrl; ?>/perfect_merchant_1z25.php">
    <input type="hidden" name="STATUS_URL_METHOD" value="POST">
    <input type="hidden" name="PAYMENT_URL" value="<?=$config->SaitUrl; ?>/success.html">
    <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="NOPAYMENT_URL" value="<?=$config->SaitUrl; ?>/fail.html">
    <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="SUGGESTED_MEMO" value="<?=$sug_memo; ?>">
    <!-- -----------baggage fields------------ -->
    <input type="hidden" name="BAGGAGE_FIELDS" value="BAGGAGE_FIELDS_id">
    <input type="hidden" name="BAGGAGE_FIELDS" value="BAGGAGE_FIELDS_ip">
    <!-- -----------baggage fields------------ -->
    <input type="hidden" name="BAGGAGE_FIELDS_id" value="<?php echo $usid ?>">
    <input type="hidden" name="BAGGAGE_FIELDS_ip" value="<?php echo $ip ?>">
    <!-- ---------baggage fields END---------- -->
    <input type="submit" name="submit" id="btn" value="Go to the payment PerfectMoney" class="int_main">
  </form>
  <!-- ====== PerfectMoney======= -->
</center>

</div>
</div>
</div>
<div class="clr"></div>
</div>
<?PHP

return;
}
?>

<?php
      } else echo "Transaction Error! If you repeat, contact the administration!";
    } else echo "Error choosing payment system!";
  }

/*require_once('paykassa_sci.class.php'); //подключаем класс для работы с SCI
  #Загружаем курс валют для Пейкассы
$optts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
    "Cookie: foo=bar\r\n"
  )
);
$contextt = stream_context_create($optts);
$syst_name=array("GAS","NEO","XRP","ETC","XMR","ZEC","BCH","DASH","DOGE","LTC","ETH","BTC");
$fille = file_get_contents('https://api.cryptonator.com/api/ticker/'.$syst_name[10].'-rub');
$ress = json_decode($fille, true);
$pricce = $ress["ticker"]["price"];
$count_arr =  count($syst_name);
$x=0;
while ( $x< $count_arr) {
$fille = file_get_contents('https://api.cryptonator.com/api/ticker/'.$syst_name[$x].'-rub', false, $contextt);
$ress = json_decode($fille, true);
$pricce = $ress["ticker"]["price"];
$new_mas[] = $pricce;
$x++;
}
print_r($fille);
*/
$system =  [
    12          => 'bitcoin',
    13          => 'ethereum',
    14          => 'litecoin',
    15          => 'dogecoin',
    16          => 'dash',
    17          => 'bitcoincash',
    18          => 'zcash',
    19          => 'monero',
    20          => 'ethereumclassic',
    21          => 'ripple',
    22          => 'berty',
    23          => 'neo',
    24          => 'gas',
  ];
 $system_name = [
            "bitcoin"           => 'BTC', // поддерживаемая валюта BTC
            "ethereum"          => 'ETH', // поддерживаемая валюта ETH
            "litecoin"          => 'LTC', // поддерживаемая валюта LTC
            "dogecoin"          => 'DOGE', // поддерживаемая валюта DOGE
            "dash"              => 'DASH', // поддерживаемая валюта DASH
            "bitcoincash"       => 'BCH', // поддерживаемая валюта BCH
            "zcash"             => 'ZEC', // поддерживаемая валюта ZEC
            "monero"            => 'XMR', // поддерживаемая валюта XMR
            "ethereumclassic"   => 'ETC', // поддерживаемая валюта ETC
            "ripple"            => 'XRP', // поддерживаемая валюта XRP
            "berty"             => 'RUB', // поддерживаемая валюта RUB USD
            "neo"               => 'NEO', // поддерживаемая валюта NEO
            "gas"               => 'GAS', // поддерживаемая валюта GAS
        ];
        $system = $system[13];
$db->Query("SELECT * FROM db_crypt WHERE id = '1' LIMIT 1");
            $sonfi = $db->FetchArray();
            $zapas = $sonfi[$system_name['bitcoin']];
           /* echo $zapas;*/
?>


<!-- <style>
    #whats,
    #whats1,
    #whats2 {
      float: left;
    }

    #whats3,
    #whats4,
    #whats_btc {
      display: none;
    }

    .image_picker_image {
      width: 9.5vw;
    }
  </style> -->

<div>
  <!-- <div id="course">Currency: 1$ (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> $</div> -->

  <div class="form_pay">
    <form class="d-flex justify-content-between flex-column flex-wrap" name="pay_is" action="" method="post">
      Select a payment system:&nbsp;&nbsp;
      <select size="1" name="service" id="selsel" class="picc">
        <img src="/img/10i.png" alt="PAYEER">
        <option data-img-src="/img/11i.png" selected="selected" value="40">Perfect Money</option>
        <option disabled="disabled" data-img-src="/img/10io.png" value="1">PAYEER</option>
        <option disabled="disabled" data-img-src="/img/p_btсo.png" value="12">bitcoin</option>
        <option disabled="disabled" data-img-src="/img/p_etho.png" value="13">ethereum</option>
        <option disabled="disabled" data-img-src="/img/p_liteo.png" value="14">litecoin</option>
        <option disabled="disabled" data-img-src="/img/p_dogeo.png" value="15">dogecoin</option>
        <option disabled="disabled" data-img-src="/img/p_dasho.png" value="16">dash</option>
        <option disabled="disabled" data-img-src="/img/p_btc_casho.png" value="17">bitcoincash</option>
        <option disabled="disabled" data-img-src="/img/p_zcasho.png" value="18">zcash</option>
        <option disabled="disabled" data-img-src="/img/p_moneroo.png" value="19">monero</option>
        <option disabled="disabled" data-img-src="/img/p_eth_classo.png" value="20">ethereumclassic</option>
        <option disabled="disabled" data-img-src="/img/p_rippleo.png" value="21">ripple</option>
        <!-- <option data-img-src="https://fundingsage.com/wp-content/uploads/2017/05/rentberry_1.png" value="22">berty</option> -->
        <!-- <option data-img-src="/img/1i.png" value="23">neo</option> -->
        <!-- <option data-img-src="/img/1i.png" value="24">gas</option> -->
      </select>


      <div class="btc">
        <div class="whats" id="whats_btc">
          <strong>Min sum - 0.5$</strong>
          <p>Currency Bitcoin-USD for today: 1
            BTC=<?=round($sonfi[$system_name['bitcoin']],0) ?> USD</p>
        </div>

        <input type="hidden" name="m" value="<?=$fk_merchant_id?>">

        <div class="whats_1" id="whats1">
          <label for="sum">Enter the amount in [<?=$config->VAL2; ?>]:</label>
          <input type="text" type="number" value="100" name="sum" size="7" id="psevdo" onchange="calculate2(this.value)"
            onkeyup="calculate2(this.value)" onfocusout="calculate2(this.value)" onactivate="calculate2(this.value)"
            ondeactivate="calculate2(this.value)">
          <!-- Вы получите <span id="res_sum">10000</span> серебра  --><?php if ($sonfig_site["bonus_in"]!=0) { echo "+".$sonfig_site["bonus_in"]."%";} ?>
        </div>

        <div class="whats_3" id="whats3">
          <strong>Attention!!! Qiwi</strong>
          <label for="handpayq"> Enter your wallet QIWI:</label>
          <input type="text" name="handpayq" id="handinsert" size="20" placeholder="+71234556789">
        </div>

        <div class="whats_4" id="whats4">
          <strong>Attention!!! AdvCash</strong>
          <label for="handpaya">Enter your wallet AdvCash:</label>
          <input type="text" name="handpaya" id="handinsert" size="20" placeholder="R12345678">
        </div>

        <input type="submit" name="pay_is" class="int_main btn-primary" value="Continue">
      </div>

    </form>
  </div>






  <!-- <script type="text/javascript">
document.getElementById('psevdo').addEventListener('keyup', (e) => calculate2(e.target.value));
document.getElementById("selsel").addEventListener("change", function() {
  var opt = this.value;
  var get = document.getElementById('psevdo');
  if (opt >= 40) {
    document.getElementById('whats').innerHTML = "Enter the amount in [USD]: ";
    document.getElementById('course').innerHTML = "Exchange Rates: 1$ (PerfectMoney) = 1$ in the project";
    get.value = '10';
    calculate2(10);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 12) {
    document.getElementById('whats').innerHTML = "To replenish Bitcoin, enter the amount in [USD]: ";
    document.getElementById('course').innerHTML = "Exchange Rates: 1 BTC = <?=round($sonfi[$system_name['bitcoin']]*1,0) ?>$";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Attention! Minimum replenishment amount - 0.00010000 BTC = <?=ceil($sonfi[$system_name['bitcoin']]*0.0001) ?>$ </font><br><span>We do not charge a recharge fee, but the fee can be taken from the wallet that you use.</span><br>Exchange Rates: 1 BTC = <?=round($sonfi[$system_name['bitcoin']],0) ?>$";
    /*get.value = '10';*/
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 13) {
    document.getElementById('whats').innerHTML = "To replenish Ethereum, enter the amount in [USD]: ";
    document.getElementById('course').innerHTML = "Exchange Rates: 1 ETH = <?=round($sonfi[$system_name['ethereum']]*1,0) ?>$";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Attention! Minimum replenishment amount <?=ceil(($sonfi[$system_name['ethereum']]*0.003)-($sonfi[$system_name['ethereum']]*0.002)) ?>$<br>+You need to pay a commission 0.00200000 ETH</font><br>Exchange Rates: 1 ETH = <?=round($sonfi[$system_name['ethereum']],0) ?>
    $";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 14) {
    document.getElementById('whats').innerHTML = "To replenish Ethereum, enter the amount in [USD]: ";
    document.getElementById('course').innerHTML = "Exchange Rates: 1 LTC = <?=round($sonfi[$system_name['litecoin']]*1,0) ?>$";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Attention! Minimum replenishment amount - 0.00300000 LTC = <?=ceil($sonfi[$system_name['litecoin']]*0.003) ?>$ </font><br><span>We do not charge a recharge fee, but the fee can be taken from the wallet that you use.</span><br>Exchange Rates: 1 LTC = <?=round($sonfi[$system_name['litecoin']],0) ?>$";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
    
  } else if (opt == 15) {
    document.getElementById('whats').innerHTML = "To replenish Ethereum, enter the amount in [USD]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 DOGE = <?=round($sonfi[$system_name['dogecoin']]*100,2) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения - 100 DOGE = <?=ceil($sonfi[$system_name['dogecoin']]*100) ?> руб. </font><br><span>Мы не берем комиссию за пополнение, но комиссия может браться со стороны кошелька, который вы используете.</span><br>Курс игровой валюты: 1 DOGE = <?=round($sonfi[$system_name['dogecoin']],2) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
    
  } else if (opt == 16) {
    document.getElementById('whats').innerHTML = "Для пополнения DASH введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 DASH = <?=round($sonfi[$system_name['dash']]*100,0) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения - 0.00060000 DASH = <?=ceil($sonfi[$system_name['dash']]*0.0006) ?> руб. </font><br><span>Мы не берем комиссию за пополнение, но комиссия может браться со стороны кошелька, который вы используете.</span><br>Курс игровой валюты: 1 DASH = <?=round($sonfi[$system_name['dash']],0) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
    
  } else if (opt == 17) {
    document.getElementById('whats').innerHTML = "Для пополнения BCH введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 BCH = <?=round($sonfi[$system_name['bitcoincash']]*100,0) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения - 0.00040000 BCH = <?=ceil($sonfi[$system_name['bitcoincash']]*0.0004) ?> руб. </font><br><span>Мы не берем комиссию за пополнение, но комиссия может браться со стороны кошелька, который вы используете.</span><br>Курс игровой валюты: 1 BCH = <?=round($sonfi[$system_name['bitcoincash']],0) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
    
  } else if (opt == 18) {
    document.getElementById('whats').innerHTML = "Для пополнения ZEC введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 ZEC = <?=round($sonfi[$system_name['zcash']]*100,0) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения - 0.00200000 ZEC = <?=ceil($sonfi[$system_name['zcash']]*0.002) ?> руб. </font><br><span>Мы не берем комиссию за пополнение, но комиссия может браться со стороны кошелька, который вы используете.</span><br>Курс игровой валюты: 1 ZEC = <?=round($sonfi[$system_name['zcash']],0) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 19) {
    document.getElementById('whats').innerHTML = "Для пополнения XMR введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 XMR = <?=round($sonfi[$system_name['monero']]*100,0) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения - 0.00200000 XMR = <?=ceil($sonfi[$system_name['monero']]*0.002) ?> руб. </font><br><span>Мы не берем комиссию за пополнение, но комиссия может браться со стороны кошелька, который вы используете.</span><br>Курс игровой валюты: 1 XMR = <?=round($sonfi[$system_name['monero']],0) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 20) {
    document.getElementById('whats').innerHTML = "Для пополнения Ethereum введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 ETC = <?=round($sonfi[$system_name['ethereumclassic']]*100,0) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения <?=ceil(($sonfi[$system_name['ethereumclassic']]*0.01)-($sonfi[$system_name['ethereumclassic']]*0.003)) ?> руб.<br>+Прийдется заплатить обязательную комиссию 0.00200000 ETC</font><br>Курс игровой валюты: 1 ETC = <?=round($sonfi[$system_name['ethereumclassic']],0) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 21) {
    document.getElementById('whats').innerHTML = "Для пополнения Ripple введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 Ripple(XRP) = <?=round($sonfi[$system_name['ripple']]*100,0) ?> серебра.";
    document.getElementById('whats_btc').innerHTML = "<font color='red'>Внимание! Минимальная сумма пополнения - 1 XRP = <?=(ceil($sonfi[$system_name['ripple']]+2)*1) ?> руб. </font><br><span>Мы не берем комиссию за пополнение, но комиссия может браться со стороны кошелька, который вы используете.</span><br>Курс игровой валюты: 1 XRP = <?=round($sonfi[$system_name['ripple']],2) ?> Руб.";
    calculate2(100);
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='block';
  } else if (opt == 3) {
    document.getElementById('whats3').style.display='block';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='none';
    document.getElementById('whats').innerHTML = "Введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 рубль (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> серебра.";
    calculate2(100);
  } else if (opt == 4) {
    document.getElementById('whats4').style.display='block';
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats_btc').style.display='none';
    document.getElementById('whats').innerHTML = "Введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 рубль (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> серебра.";
    calculate2(100);
  } else {
    document.getElementById('whats3').style.display='none';
    document.getElementById('whats4').style.display='none';
    document.getElementById('whats_btc').style.display='none';
    document.getElementById('whats').innerHTML = "Введите сумму в [RUB]: ";
    document.getElementById('course').innerHTML = "Курс игровой валюты: 1 рубль (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> серебра.";
    get.value = '100';
    calculate2(100);
  }
});

function calculate2(st_q) {
  var min = 0.01;
 /* var idd = document.getElementById('selsel').value;
  if (idd == 12) {
    var ser_pr = 250000;
  } else {*/
    var ser_pr = +document.getElementById('selsel').value <= 39 ? 100 : <?=$sonfig_site["ser_per_wmz"]; ?>;
 /* }*/
  var sum_insert = parseFloat(st_q) * ser_pr;
  document.getElementById('res_sum').textContent = Math.floor(sum_insert * 10)/10;
  document.getElementById('res_sum').value = parseFloat(st_q);
};
</script> -->


  <div class="notice">
    <i class="fas fa-info-circle"></i> <strong>Attention!</strong>
    <p>Payeer and PerfectMone
      is credited instantly. The exception is cryptocurrency, money can be credited with a delay, since each
      cryptocurrency has its own subtleties with confirmation of the transfer. As soon as confirmation of receipt of
      funds in the payment aggregator occurs, the project automatically credits funds to your account. As a rule, funds
      are credited from 15 minutes to several hours.</p>
  </div>


  <div class="table_1">
    <h2>Your deposits</h2>
    <span class="angel">	&#10096;	&#10097;</span>
    <div class="container">
      <table cellpadding='2' cellspacing='0' border='1' bordercolor='#ccc' align='center' width="100%">
        <tr>
          <td align="center" style ="padding:5px"  class="m-tb">Deposited</td>
          <!--  <td align="center" class="m-tb">Сredited to the account</td> -->
          <td align="center" class="m-tb">Wallet</td>
          <td align="center" class="m-tb">Date</td>
          <td align="center" class="m-tb">Status</td>
        </tr>
        <?PHP
    $status_array = array("Done", "Waiting", "Rejected", "Not needed");
    $status_color = array("green", "#A92E00", "red", "#3AE2CE");
    $db->Query("SELECT * FROM db_insert_money WHERE user_id = '$usid' ORDER BY id DESC LIMIT 50");
  
    if($db->NumRows() > 0){
  
        while($ref = $db->FetchArray()){
  
      ?>
        <tr class="htt">
          <td align="center"><b><?=sprintf("%.2f",$ref["money"]); ?></b> <?=$ref["val"]; ?></td>
          <!-- <td align="center"><b><?=$ref["serebro"]; ?></b></td> -->
          <td align="center"><img
              src="/img/mine/<?php if($ref["plat"] ==''){ ?>Payeer<?php }else{ ?><?=$ref["plat"]; ?><?php } ?>.png?5" />
          </td>
          <td align="center"><?=date("d.m.Y в H:i:s",$ref["date_add"]); ?></td>
          <td align="center" style="color: <?=$status_color[$ref["status"]]; ?>"><img
              src="/img/mine/<?=$ref["status"]; ?>.png?2" /> <?=$status_array[$ref["status"]]; ?></td>
        </tr>
        <?PHP
  
      }
  
    }else echo '<tr><td align="center" colspan="5">No deposits</td></tr>'
    ?>

      </table>
    </div>




  </div>


</div>
</div>
<div class="clr"></div>
</div>
<script type="text/javascript" src="/js/jquery3.1.min.js"></script>
<script type="text/javascript" src="/js/image-picker.min.js"></script>
<script>
  $("select").imagepicker()
</script>