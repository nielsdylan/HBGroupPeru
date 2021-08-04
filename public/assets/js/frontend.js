$(document).ready(function(){

    var obj_act_top = $(this).scrollTop();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
            $("nav.navbar").removeClass('navbar-fondo');
        }
        else {
            $('#back-to-top').fadeOut();
            $("nav.navbar").addClass('navbar-fondo');
        }
    });

    $('a#back-to-top').click(function () {

        $('body,html').animate({
            scrollTop: 0
        }, 500);

        return false;

    });

    if ($(this).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
        $("nav.navbar").removeClass('navbar-fondo');
    }
    else {
        $('#back-to-top').fadeOut();
        $("nav.navbar").addClass('navbar-fondo');
    }
    fancybox();
    owlCarousel();
});
function owlCarousel() {
    var owl = $('.slider_card');

    owl.owlCarousel({
        loop:true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause:true,
        responsive: {
            0:{
                items:1,
                nav:false,
                dots: false,
            },
            600:{
                items:2,
                nav:false,
                dots: false,
            },
            1000:{
                items:2,
                dots: false,
                nav:false
            },
        }
    });

    $('a.owl-carousel-img-left').click(function(event){
        event.preventDefault();
        owl.trigger('prev.owl.carousel', [00]);
    })

    $("a.owl-carousel-img-right").click(function(event){
        event.preventDefault();
        owl.trigger('next.owl.carousel', [300]);
    });



    var owl_secund = $('.owl-carousel-second');

    owl_secund.owlCarousel({
        items: 5,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsiveClass:true,
        nav: false,
        dots: false,
        responsive: {
          0: {
            items: 2,
            nav: false,
            dots: false,
          },
          600: {
            items: 3,
            nav: false,
            dots: false,
          },
          1000: {
            items: 5,
            nav: false,
            loop: true,
            margin: 10,
            dots: false,
          }
        }
    });

    $('a.owl-carousel-product-left').click(function(event){
        event.preventDefault();
        owl_secund.trigger('prev.owl.carousel', [300]);
    })

    $("a.owl-carousel-product-right").click(function(event){
        event.preventDefault();
        owl_secund.trigger('next.owl.carousel', [300]);
    });

}
function fancybox() {
    $('.fancybox').fancybox({
        autoSize: true,
        fitToView: true,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none',
        padding: 4,
        helpers: {
            overlay: {
              locked: false
            }
        }
    });


    $('.fancybox-gallery').fancybox({
        showCloseButton: false,
        padding: 5,
        width: '450',
        autoSize: false,
    });
}
