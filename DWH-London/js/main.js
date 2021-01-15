$(document).ready(function() {

// E-mail Ajax Send
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});


// Slick-Slider
$(document).ready(function () {
	$('.features-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		autoplay: true,
		autoplaySpeed: 3000,
	});
	$('.testimonial-slider').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true,
				}
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
				}
			}
		]
	});
	$('.about_body-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
	});
});
});


new WOW().init();


jQuery(function ($) {
	$("#phone").mask("+99(999)-99-99-999");



// Плавная прокрутка к якорю
$("body").on('click', '[href*="#"]', function(e){
	var fixed_offset = 5;
	$('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
	e.preventDefault();
  });

});

// --------------------------------------Навигационное меню и Бургер

// $(document).ready(function(){
//   $('.header_burger').click(function(event){
//     $('.header_burger, .header_menu').toggleClass('active');
// 		$('body').toggleClass('lock');
// 	});
// 	$('.header_link').click(function(event){
// 		$('.header_menu').toggleClass('active'); 
// 		$('.header_burger').toggleClass('active'); 
// 		$('body').toggleClass('lock');
// 	}); 
// });

const burger = document.getElementById('burger'),
	headerMenu = document.querySelector('.header_menu'),
	body = document.getElementsByTagName('body')[0],
	menuLinks = document.querySelectorAll('.header_link');


burger.addEventListener('click', () => {
	burger.classList.toggle('active');
	headerMenu.classList.toggle('active');
	body.classList.toggle('lock');
});

// Делегирование событий
headerMenu.addEventListener('click', (event) => {
	if (event.target && event.target.matches("a.header_link")) {
		burger.classList.remove('active');
		headerMenu.classList.remove('active');
		body.classList.remove('lock');		
	}
});
