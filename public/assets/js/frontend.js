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
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:2,
                nav:false
            },
        }
    });

    $('a.owl-carousel-img-left').click(function(event){
        event.preventDefault();
        owl.trigger('prev.owl.carousel', [300]);
    })

    $("a.owl-carousel-img-right").click(function(event){
        event.preventDefault();
        owl.trigger('next.owl.carousel', [300]);
    });

}
