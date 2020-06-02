$(function(){

  $('.header__slider').slick({
    infinite: true,
    fade: true,
    prevArrow: '<img class="slick-arrow__left"  src="img/arrow-left.svg">',
    nextArrow: '<img class="slick-arrow__right"  src="img/arrow-right.svg">',
    asNavFor: '.slider-dotshead'
  });

  $('.slider-dotshead').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.header__slider',
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          prevArrow: false,
          nextArrow: false
        }
      },
      {
        breakpoint: 840,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          prevArrow: false,
          nextArrow: false
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          prevArrow: false,
          nextArrow: false
        }
      },
    ]
  });

  $('.surf-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<img class="slick-arrow__left"  src="img/arrow-left.svg">',
    nextArrow: '<img class="slick-arrow__right"  src="img/arrow-right.svg">',
    asNavFor: '.slider-map',
  });

  $('.slider-map').slick({
    slidesToShow: 8,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.surf-slider',
    focusOnSelect: true,
  });

});