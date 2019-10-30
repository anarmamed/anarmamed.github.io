
$('.direction-blocks').slick({
	arrows: false,
	dots: true,
	slidesToShow: 4,
	slidesToScroll: 1,
	responsive: [
	{
		breakpoint: 767,
			settings: {
  		slidesToShow: 2,
  		slidesToScroll: 1,
        	}
		}	
	]
	});
		
				
$( document ).ready(function(){
    $( ".top-nav_btn" ).click(function(){ 
   $( ".top-nav_menu" ).slideToggle(); 
 });
});


$( document ).ready(function(){
    $( ".left-sidebar_btn" ).click(function(){ 
   $( ".left-sidebar_menu" ).slideToggle(); 
 });


var elem = document.querySelector('.calc-range');
var init = new Powerange(elem, { min: 100000, max: 3000000, start: 100000, hideRange: true, step: 100000 });
var radio = $('input[name="programs"]');
var per = 0.2, month = 6, result, total;
var money = +$('.calc-range').val();


$('.calc-range').on('change', function(event) {
	$('.calc-summ_invest_num span').text($(this).val())
});

radio.on('chenge', function(event) {
month = +$(this).attr('data-month');	
per = +$(this).attr('data-per');	
result = Math.round(per / 12 * month * money);
total = result + money
console.log(result); 
console.log(total); 
});
});