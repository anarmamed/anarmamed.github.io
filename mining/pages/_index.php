
<main class="main">
  <div class="main-content">
    
    <!----------------------------------- БЕГУЩАЯ СТРОКА  ------------------------>
          <?php
      $db->Query("SELECT * FROM db_crypt WHERE id = '1' LIMIT 1");
       $crypt_dol = $db->FetchArray();
       $BTCc = ($crypt_dol['BTCc']<0) ? "<font color='red'>".$crypt_dol['BTCc']."</font>" : "<font color='white'>".$crypt_dol['BTCc']."</font>" ;
       $ETHc = ($crypt_dol['ETHc']<0) ? "<font color='red'>".$crypt_dol['ETHc']."</font>" : "<font color='white'>".$crypt_dol['ETHc']."</font>" ;
       $LTCc = ($crypt_dol['LTCc']<0) ? "<font color='red'>".$crypt_dol['LTCc']."</font>" : "<font color='white'>".$crypt_dol['LTCc']."</font>" ;
       $DOGEc = ($crypt_dol['DOGEc']<0) ? "<font color='red'>".$crypt_dol['DOGEc']."</font>" : "<font color='white'>".$crypt_dol['DOGEc']."</font>" ;
       $DASHc = ($crypt_dol['DASHc']<0) ? "<font color='red'>".$crypt_dol['DASHc']."</font>" : "<font color='white'>".$crypt_dol['DASHc']."</font>" ;
       $BCHc = ($crypt_dol['BCHc']<0) ? "<font color='red'>".$crypt_dol['BCHc']."</font>" : "<font color='white'>".$crypt_dol['BCHc']."</font>" ;
       $ZECc = ($crypt_dol['ZECc']<0) ? "<font color='red'>".$crypt_dol['ZECc']."</font>" : "<font color='white'>".$crypt_dol['ZECc']."</font>" ;
       $XMRc = ($crypt_dol['XMRc']<0) ? "<font color='red'>".$crypt_dol['XMRc']."</font>" : "<font color='white'>".$crypt_dol['XMRc']."</font>" ;
       $ETCc = ($crypt_dol['ETCc']<0) ? "<font color='red'>".$crypt_dol['ETCc']."</font>" : "<font color='white'>".$crypt_dol['ETCc']."</font>" ;
       $XRPc = ($crypt_dol['XRPc']<0) ? "<font color='red'>".$crypt_dol['XRPc']."</font>" : "<font color='white'>".$crypt_dol['XRPc']."</font>" ;
       $NEOc = ($crypt_dol['NEOc']<0) ? "<font color='red'>".$crypt_dol['NEOc']."</font>" : "<font color='white'>".$crypt_dol['NEOc']."</font>" ;
       $ADAc = ($crypt_dol['ADAc']<0) ? "<font color='red'>".$crypt_dol['ADAc']."</font>" : "<font color='white'>".$crypt_dol['ADAc']."</font>" ;
       ?>
       
          <div class="marquee">
            <span class="marq">
              <img src="/img/payment/21.png">
              <span class="dolar"><?=$crypt_dol['BTC']?>$</span> <span class="colas ">(<?=$BTCc ?>%)</span>

              <img src="/img/payment/22.png">
              <span class="dolar"><?=$crypt_dol['ETH']?>$</span> <span class="colas  ">(<?=$ETHc ?>%)</span>

              <img src="/img/payment/23.png">
              <span class="dolar"><?=$crypt_dol['LTC']?>$</span> <span class="colas ">(<?=$LTCc ?>%)</span>

              <img src="/img/payment/24.png">
              <span class="dolar"><?=$crypt_dol['DOGE']?>$</span> <span class="colas ">(<?=$DOGEc ?>%)</span>

              <img src="/img/payment/25.png">
              <span class="dolar"><?=$crypt_dol['DASH']?>$</span> <span class="c">(<?=$DASHc ?>%)</span>

              <img src="/img/payment/26.png">
              <span class="dolar"><?=$crypt_dol['BCH']?>$</span> <span class="colas">(<?=$BCHc ?>%)</span>

              <img src="/img/payment/27.png">
              <span class="dolar"><?=$crypt_dol['ZEC']?>$</span> <span class="colas">(<?=$ZECc ?>%)</span>

              <img src="/img/payment/28.png">
              <span class="dolar"> <?=$crypt_dol['XMR']?>$</span> <span class="colas">(<?=$XMRc ?>%)</span>

              <img src="/img/payment/29.png">
              <span class="dolar"><?=$crypt_dol['ETC']?>$</span> <span class="colas">(<?=$ETCc ?>%)</span>

              <img src="/img/payment/30.png">
              <span class="dolar"><?=$crypt_dol['XRP']?>$</span> <span class="colas">(<?=$XRPc ?>%)</span>

              <img src="/img/payment/31.png">
              <span class="dolar"><?=$crypt_dol['NEO']?>$</span> <span class="colas">(<?=$NEOc ?>%)</span>

              <img src="/img/payment/32.png">
              <span class="dolar"><?=$crypt_dol['ADA']?>$</span> <span class="colas">(<?=$ADAc ?>%)</span>
            </span>
          </div>
    
          
<!-- ----------------------------   MAIN   --------------------------------->

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="main-title wow fadeInLeft" data-wow-delay="0.5s">
            <h1>Evolution-Mining</h1>
            <span> (beta)</span>
            <h2>mining bitcoin</h2>
            <p>Official supplier of leading manufacturers,<br> air and immersion cooling,<br> maximum performance at
              the
              lowest price.
            </p>
            <form action="/signup" method="post">
              <input type="submit" class="int_main" value="Start Now!" />
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="main-img">
            <img src="/img/header-image-blue.png">
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<!----------------------------------------    CALCULATOR  ------------------------------------------->
<section class="calculator">
  <div class="container wow fadeInUp" data-wow-delay="0.3s">
    <h3>how much can you earn?</h3>
    <div class="calc_form d-flex justify-content-center align-items-center flex-wrap">
      <div class="calc_part1">
        <div class="calc_titlem">Your deposit:</div><br>
        $<input type="text" autocomplete="off" type="number" value="100" name="sum" size="7" maxlength="6" id="psevdo"
          onkeyup="check (this); calculate(this.value)">
      </div>
      <div class="calc_part2">
        <div class="calc_title">Profit for 1 month</div>
        <span>$</span><span id="res_sum">30</span>
      </div>
      <div class="calc_part2">
        <div class="calc_title">Profit for 3 month</div>
        <span>$</span><span id="res_sum3">90</span>
      </div>
      <div class="calc_part2 calc_last">
        <div class="calc_title">Profit for 6 month</div>
        <span>$</span><span id="res_sum6">180</span>
      </div>
    </div>
    <div class="attent">
      <font color="red">*</font> You can withdraw your deposit at any time by selling G/h mining powers.
    </div>
  </div>
</section>


<!----------------------------------- VIDEO -------------------------------->
<section class="video wow fadeInUp" data-wow-delay="0.3s">
  <h3>Promotion Video</h3>
  <div class="container">
    <div class="video-content ">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"
          allowfullscreen></iframe>
      </div>
    </div>
  </div>
</section>


<!----------------------------------------------- TRUST ----------------------------------------->
<section class="trust">
  <h3 class="wow fadeInUp" data-wow-delay="0.3s">Why trust us?</h3>
  <div class="container">
    <div class="media-objects">
      <div class="row ">
        <div class=" col-md-4 col-lg-3">
          <div class="card wow bounceInUp" data-wow-delay="0.2s">
            <img src="img/pref1.png" alt="">
            <div class="card-body">
              <h5 class="card-title">it is easy</h5>
              <p class="card-text">You buy G/h mining powers -
                We do all the work for you while you rest </p>
            </div>
          </div>
        </div>
        <div class=" col-md-4 col-lg-3">
          <div class="card wow bounceInUp" data-wow-delay="0.4s">
            <img src="img/pref2.png" alt="">
            <div class="card-body">
              <h5 class="card-title">it is safely</h5>
              <p class="card-text">All your deposits are protected -
                we have developed a unique hacking protection system
              </p>
            </div>
          </div>
        </div>
        <div class=" col-md-4 col-lg-3">
          <div class="card wow bounceInUp" data-wow-delay="0.6s">
            <img src="img/pref3.png" alt="">
            <div class="card-body">
              <h5 class="card-title">it is profitable</h5>
              <p class="card-text">We do not risk the money -
                we only mine reliable cryptocurrencies
              </p>
            </div>
          </div>
        </div>
        <div class=" col-md-4 col-lg-3">
          <div class="card wow bounceInUp" data-wow-delay="0.8s">
            <img src="img/pref4.png" alt="">
            <div class="card-body">
              <h5 class="card-title">it is comfortable</h5>
              <p class="card-text">We mine more than five cryptocurrencies -
                you make a profit in dollars
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!----------------------------------------- STATISTIC ---------------------------------------->
<section class="statistic">
  <div class="container wow fadeInUp" data-wow-delay="0.3s">
    <h3>Statistics</h3>
    <div class="stat_block">
      <div class="stat_part">
        <div class="stat_part_up">Working</div>
        <div class="stat_part_down">
          <span><?=intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) ); ?></span>
          <div class="label">days</div>
        </div>
      </div>
      <div class="stat_part">
        <div class="stat_part_up">Sold G/h</div>
        <div class="stat_part_down">
          <span
            data-toggle="counter-up"><?=round(sprintf("%.2f",$stats_data["all_insert"]+$sonfig_site["add_insert"])); ?></span>
          <div class="label">G/h</div>
        </div>
      </div>
      <!--  <div class="stat_part">
            <div class="stat_part_up">Available G/h</div>
            <div class="stat_part_down">
              <span><?=round(sprintf("%.2f",34000-$stats_data["all_insert"]+$sonfig_site["add_insert"])); ?></span>
              G/h
            </div>
          </div> -->
      <div class="stat_part">
        <div class="stat_part_up">Mined</div>
        <div class="stat_part_down">
          <span><?=round(sprintf("%.2f",$stats_data["all_payment"])); ?></span>
          <div class="label">$</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!----------------------------------------- HOW IT WORKS -------------------------------------->
<section class="how_it">
  <div class="container">
    <h3 class="wow fadeInUp" data-wow-delay="0.3s">How it works?</h3>
    <div class="row">
      <div class="col-lg-5">
        <img class="step_img" src="img/datamining.png" alt="">
      </div>
      <div class="col-lg-6 offset-lg-1">
        <div class="step_block">
          <div class="step_part wow fadeInRight">
            <div class="step_one">
              <div class="step_text">
                <p>Step</p>
                <span>1</span>
              </div>
            </div>
            <div class="step_two">
              First of all, <a href="signup.html">register</a> on our site. Fill in all the fields and read the
              project rules.After successful registration, return to the main page and enter your mail and password
              and <a href="signup.html">login</a>
              to your account.
            </div>
          </div>
          <div class="step_part  wow fadeInRight">
            <div class="step_one">
              <div class="step_text">
                <p>Step</p>
                <span>2</span>
              </div>
            </div>
            <div class="step_two">
              After entering your personal account, you need to replenish the balance in a way convenient for you.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="step_block">
          <div class="step_part  wow fadeInLeft">
            <div class="step_one">
              <div class="step_text">
                <p>Step</p>
                <span>3</span>
              </div>
            </div>
            <div class="step_two">
              Choose a tariff plan suitable for your financial capabilities.
            </div>
          </div>
          <div class="step_part  wow fadeInLeft">
            <div class="step_one">
              <div class="step_text">
                <p>Step</p>
                <span>4</span>
              </div>
            </div>
            <div class="step_two">
              Then withdraw profit every day to your wallets, wile our specialists will do their job.
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <img class="step_img" src="img/banner_vector.png" alt="">
      </div>
    </div>
  </div>
</section>


<div class="clr"></div>


<script type="text/javascript">
  var ser_pr = 0.3;
  var ser_pr3 = 0.9;
  var ser_pr6 = 1.8;

  function calculate(st_q) {
    var sum_insert = parseFloat(st_q);
    $('#res_sum').html((sum_insert * ser_pr).toFixed(0));
    $('#res_sum3').html((sum_insert * ser_pr3).toFixed(0));
    $('#res_sum6').html((sum_insert * ser_pr6).toFixed(0));
  }

  function check(input) {
    ch = input.value.replace(/[^\d]/g, '');
    input.value = ch;
  };
  calculate(100);
</script>