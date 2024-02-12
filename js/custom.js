jQuery(function($) {
    $('.carousel-posthome-4').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
            }
          },
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 3,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
            }
          }
        ],
        prevArrow: '<button type="button" class="z-1 btn btn-dark btn-sm rounded-0 position-absolute top-50 start-0 translate-middle-y"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        nextArrow: '<button type="button" class="btn btn-dark btn-sm rounded-0 position-absolute top-50 end-0 translate-middle-y"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    });
    $('.close_berita_iklan').on('click', function(){
      $target = $(this).closest('.berita_iklan');
      $target.hide('slow', function(){ $target.remove(); });
    });
});
