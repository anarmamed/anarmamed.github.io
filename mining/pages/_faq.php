<style>
    
.ui-accordion {
  /* margin-bottom: 0px; */
  margin-bottom: 5px;
}
.ui-accordion h3{

  background-color: #74b5fc;
  color: #fff;
}

.ui-accordion-header {
  
  color: #fff;
  cursor: pointer;
  margin: 0;
  padding: 4px 8px;
  padding: 2px 5px;
}

.ui-accordion-header-icon {
  background-image: url('https://cdn.rawgit.com/marcobiedermann/playground/master/ui/accordion/jquery-ui-accordion/source/assets/images/accordion.svg');
  background-size: 100%;
  display: inline-block;
  height: 12px;
  height: 7px;
  margin-right: 8px;
  margin-right: 4px;
  vertical-align: middle;
  width: 12px;
  width: 7px;
}

.ui-accordion-header-icon.ui-icon-triangle-1-s {
  background-position: 0 -35px;
}

.ui-accordion-content {
  background-color: #fff;
  padding: 8px;
  padding: 5px;
}

.ui-accordion-content + .ui-accordion-header {
  margin-top: 8px;
  margin-top: 5px;
}
</style>
<?PHP
$_OPTIMIZATION["title"] = "faq";
$_OPTIMIZATION["description"] = "FAQ";
$_OPTIMIZATION["keywords"] = "faq, questions, help, answers";
?>
<style>
     .inde a{
        color: #0A647A;
        font-weight: bold;
    }
</style>
<div class="silver-bk justify-content-center">
    <div class="row mr-0 ml-0 justify-content-center">
        <div class="col-12 justify-content-center">
            <div class="indexx">
                <BR />
                <h1>FAQ</h1>
                <BR />
            </div>
        </div>
        <div class="col-9 justify-content-center mon_row">
            <br>
            
            <div class="js-ui-accordion">

      <h3>What payment systems do you work with?</h3>
      <div>
        <p>We work with such payment systems: PerfectMoney, Bitcoin, Litecoin, Ripple, Dogecoin, Etherium and others.</p>
      </div>

      <h3>Can I refuse to rent equipment and withdraw money invested?</h3>
      <div>
        <p>Yes, you can stop mining at any time. Commission for the exit of 5%.</p>
      </div>

      <h3>Are multiple accounts allowed?</h3>
      <div>
        <p>Not. This is strictly prohibited. If multiple accounts are identified, we will block all accounts.</p>
      </div>
      
      <h3>Do you have the referral program?</h3>
      <div>
        <p>Yes. We pay 10% from your referal's profit. Use all opportunities to earn money with Evolution-Mining.</p>
   </div>
   
   <h3>What is minimal / maximum withdraw?</h3>
      <div>
        <p>Minimum withdrawal amount - 0.1$ The maximum amount for auto payments is $ 50 per day! U can make only 1 withdraw per 24 hours</p>
   </div>
   
<h3>I want to attract new investors to Evolution-Mining, but I haven’t yet made a deposit. Can I still participate in the referral program?</h3>
      <div>
        <p>Yes, you can. The presence of an active deposit is not an obligatory condition for participation in the referral program.</p>
   </div>
   
   <h3>What is the minimum / maximum amount that I can invest?</h3>
      <div>
        <p>The minimum / maximum investment for the nearest time is 10$ / 200$ </p>
   </div>
   
   <h3>How soon will my deposit be added to my account after the transfer of funds?</h3>
      <div>
        <p>Deposit will be created automatically, immediately.</p>
   </div>
   
   <h3>Can I change the upliner?</h3>
      <div>
        <p>No, you can’t change the upliner. A user who has invited another partner has the right to get a commission for life from all of that referral’s deposits.</p>
   </div>
   
   <h3>Can I create several deposits at once?</h3>
      <div>
        <p>Yes. One user can create an unlimited number of deposits, but the sum should not be more then 200 GH/s ($)</p>
   </div>
   
   <h3>Can i sell the miners and leave the project?</h3>
      <div>
        <p>Yes. You can sell your miners at any time.  after selling you should wait 72 hours, then withdraw will be instant</p>
   </div>
   
    <h3>Are there any comisson after selling a miners?</h3>
      <div>
        <p>Yes. The system takes 5% from the miners price.</p>
   </div>
   
   
    
    

</div>
            </div>
        </div>
    </div>
</div>
<div class="clr"></div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script>
    'use strict';

var $uiAccordion = $('.js-ui-accordion');

$uiAccordion.accordion({
  collapsible: true,
  heightStyle: 'content',

  activate: function activate(event, ui) {
    var newHeaderId = ui.newHeader.attr('id');

    if (newHeaderId) {
      history.pushState(null, null, '#' + newHeaderId);
    }
  },

  create: function create(event, ui) {
    var $this = $(event.target);
    var $activeAccordion = $(window.location.hash);

    if ($this.find($activeAccordion).length) {
      $this.accordion('option', 'active', $this.find($this.accordion('option', 'header')).index($activeAccordion));
    }
  }
});

$(window).on('hashchange', function (event) {
  var $activeAccordion = $(window.location.hash);
  var $parentAccordion = $activeAccordion.parents('.js-ui-accordion');

  if ($activeAccordion.length) {
    $parentAccordion.accordion('option', 'active', $parentAccordion.find($uiAccordion.accordion('option', 'header')).index($activeAccordion));
  }
});
</script>
