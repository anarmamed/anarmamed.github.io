'use strict';

document.body.onload = function() {
    setTimeout(function() {
        var preloader = document.getElementById('page-preloader');
        if( !preloader.classList.contains('done') )
        {
            preloader.classList.add('done')
        }
    }, 1000);
};


const burger = document.getElementById('burger'),
	headerMenu = document.getElementById('navbar'),
    body = document.getElementsByTagName('body')[0],
    mobNav = document.getElementById('mob_nav');

	
burger.addEventListener('click', () => {
	burger.classList.toggle('active');
	headerMenu.classList.toggle('active');
    body.classList.toggle('lock');
    mobNav.classList.toggle('mobile-nav_active');
});


// Делегирование событий
headerMenu.addEventListener('click', (event) => {
	if (event.target && event.target.matches(".nav-link")) {
		burger.classList.remove('active');
		menu.classList.remove('active');
		body.classList.remove('lock');		
	}
});





$(document).ready(function(){

	$('.offer-slider').slick({
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		arrows: false,
		responsive: [
			{
				breakpoint: 1280,
				settings: {
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
				}
			},
			{
				breakpoint: 992,
				settings: {
				slidesToShow: 3,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
				}
			},
			{
				breakpoint: 768,
				settings: {
				slidesToShow: 2,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
				}
			},
			{
				breakpoint: 600,
				settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				dots: false,
				}
			}
				
			]
	});

	$('.cases-slider').slick({
		infinite: true,
		slidesToShow: 2,
		slidesToScroll: 1,	
	});

	$('.testimonials-slider').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
		{
			breakpoint: 1200,
			settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			dots: false,
			},
		}
		]
	});

	$('.clients-slider').slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		arrows: false,
		rows: 3,
		dots: true,
		breakpoint: 768,
			settings: {
			slidesToShow: 1,
			slidesToScroll: 1,
			infinite: true,
			dots: false,
			},
	});



	
	$('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading... #%curr%...',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		}
	});

});
	  
