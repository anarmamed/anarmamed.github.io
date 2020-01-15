<?php 

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
 ?>

<?PHP 
if(isset($_SESSION["user"]) AND strpos($_SERVER[REQUEST_URI], 'account') or isset($_SESSION["admin"]) AND strpos($_SERVER[REQUEST_URI], '?menu')){ 
 ?>
</div> <!-- close row in header1  -->
</div> <!-- close header1 -->

<script type="text/javascript">
  setInterval(function () {
    date = new Date(),
      h = date.getHours(),
      m = date.getMinutes(),
      s = date.getSeconds(),
      h = (h < 10) ? '0' + h : h,
      m = (m < 10) ? '0' + m : m,
      s = (s < 10) ? '0' + s : s,
      document.getElementById('time').innerHTML = h + ':' + m + ':' + s;
  }, 1000);
</script>


<?php  }?>

</div><!--  END up_site -->

<div class="down_site">
  <div class="footer1">
    <div class="foott">
      <div class="row">
        <div class="col-md-4 fot1 mb-3">E-mail: support@evolution-mining.com</div>
        <div class=" col-md-8  fot2 menu_up">
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/news">News</a></li>
            <li><a href="/about">About us</a></li>
            <li><a href="/faq">FAQ</a></li>
            <li><a href="/bounty">Bounty</a></li>
            <li><a href="/contacts">Contacts</a></li>
          </ul>
        </div>
        <div class="col-2 fot1 mt-2">
          <!--  &nbsp;  &nbsp;<img src="/img/telegram.png"/> -->
        </div>
        <div class="col-10 fot2 ">
        
        <div class="opacity">
          <img class="no" src="/img/payment/33.png" />
          <img src="/img/payment/21.png" />
          <img src="/img/payment/10.png" />
          <img src="/img/payment/22.png" />
          <img src="/img/payment/23.png" />
          <img src="/img/payment/24.png" />
          <img src="/img/payment/25.png" />
          <img src="/img/payment/30.png" />
          <img src="/img/payment/26.png" />
        </div>

         
         
        </div>
      </div>
    </div>
  </div>
</div>
</div><!--  END down_site -->
</div> <!-- end all_site -->

</body>

</html>


<!-- <script type="text/javascript" src="/js/bootstrap.js"></script> -->
<script type="text/javascript" src="/js/jquery3.1.min.js"></script>
<script src="/js/wow.min.js"></script><!-- animation -->
<script type="text/javascript" src="/js/jquery.time-to.js"></script><!--  timer online -->
<script type="text/javascript" src="/js/jquery.countto.js"></script><!--  count numbers to up online -->
<script type="text/javascript" src="/js/rangeslider.js?2"></script><!--  range input -->

<script>
   // Initiate the wowjs animation library
  new WOW().init();
</script>

<script>
  //custom slider javascript
  $(function () {
    var output = document.getElementById('retro');

    $(document).on('input', 'input[type="range"]', function (e) {
      output.innerHTML = 'You get:<font color="red"><b>' + ((e.currentTarget.value) * 0.95).toFixed(2) +
        '</b></font>$';
    });

    $('input[type=range]').rangeslider({
      polyfill: false
    });
  });
</script>
<script src="/js/bootstrap-input-spinner.js"></script>
<script>
  $("input[class='buy_count']").inputSpinner()
</script>
<!-- <script type="text/javascript" src="/js/my_javascript.js"></script> -->

<script type="text/javascript">
  jQuery(function ($) {
    // another custom callback for counting to infinity
    $('#infinity').data('countToOptions', {
      onComplete: function (value) {
        count.call(this, {
          from: value,
          to: value + 1000
        });
      }
    });
    // start all the timers
    $('.timer').each(count);

    function count(options) {
      var $this = $(this);
      options = $.extend({}, options || {}, $this.data('countToOptions') || {});
      $this.countTo(options);
    }
  });
</script>
<!-- <script src="/js/datepicker/jquery-ui.min.js"></script> -->
<script type="text/javascript">
  function showmessage() {
    document.getElementById('messID').style.cssText = "left: 50%; transition:all 1s ease;";
  }

  function hidemessage() {
    document.getElementById('messID').style.cssText = "left:-520px; transition:all 1s ease;";
  }

  setTimeout('showmessage()', 10);

  /*  $( function() {
      
      $( "#datepicker" ).datepicker();
    } );*/
</script>