$(function(){

  $('.header__slider').slick({
    infinite: true,
    fade: true,
    prevArrow: '<img class="slick-arrow__left"  src="img/arrow-left.svg">',
    nextArrow: '<img class="slick-arrow__right"  src="img/arrow-right.svg">',
    asNavFor: '.slider-dots__head'
  });

  $('.slider-dots__head').slick({
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
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          
        }
      },
      {
        breakpoint: 840,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
         
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
         
        }
      },
    ]
  });

  $('.slider-map').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.surf-slider',
    focusOnSelect: true,
  });

  $('<div class="quantity-nav"><div class="quantity-button quantity-up"><img src="img/plus.svg" alt=""></div><div class="quantity-button quantity-down"><img src="img/minus.svg" alt=""></div></div>').insertAfter('.quantity input');
  $('.quantity').each(function() {
    var spinner = $(this),
      input = spinner.find('input[type="number"]'),
      btnUp = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min = input.attr('min'),
      max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });

  $('.quantity-button').on('click', function () {
    let summ =  $('.nights').val() * $('.summ').data('nights') +  ($('.guests').val()-1) * $('.summ').data('guests') ;
    $('.summ').html('$'+ summ);
  });

  let summ =  $('.nights').val() * $('.summ').data('nights') +  ($('.guests').val()-1) * $('.summ').data('guests') ;
  $('.summ').html('$'+ summ);


$('.surfboard-box__circle').on('click', function() {
  $(this).toggleClass('active')
});

});