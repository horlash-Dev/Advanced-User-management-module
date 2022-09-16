$().ready(function() {
    $('.owl-carousel').owlCarousel({
    loop:true,
    responsive: true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:2,
            loop:true,
            nav:true
        }
    }


});
})