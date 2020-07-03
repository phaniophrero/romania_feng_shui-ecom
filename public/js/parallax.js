window.sr = ScrollReveal();
sr.reveal('.section__students', {
    origin: 'top',
    duration: 2000,
    distance: '300px',
    easing: 'ease-out',
    mobile: true,
    reset: false
});




/* //---Asta este din Scroll Magic --- //

$(document).ready(function () {

    // Init ScrollMagic
    var controller = new ScrollMagic.Controller();

    // build a scene
    var ourScene = new ScrollMagic.Scene({
            triggerElement: '.section__students .students-h1'
        })
        .setClassToggle('.section__students', 'fade-in') // add a class to section__students
        .addIndicators({
            name: 'fade scene',
            colorTrigger: 'transparent',
            indent: 200,
            colorStart: 'transparent'
        }) // this requires a plugin
        .addTo(controller);
});
//--- End --- Scroll --- Magic ---//
*/


/*
$(window).scroll(function () {
    var wScroll = $(this).scrollTop();

    $('.section__students').css({
        'transform': 'translateY(' + wScroll / 9 + '%)'
    });
});
*/
