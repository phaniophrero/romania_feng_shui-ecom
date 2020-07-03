new Glider(document.querySelector('.carousel_Students'), {
    // Mobile-first defaults
    slidesToShow: 1,
    slidesToScroll: 1,
    draggable: true,
    dots: '#resp-dots',
    arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
    },
    responsive: [{
        // screens greater than >= 775px
        breakpoint: 775,
        settings: {
            // Set to `auto` and provide item width to adjust to viewport
            slidesToShow: 'auto',
            slidesToScroll: 'auto',
            draggable: true,
            itemWidth: 300,
            dots: '#resp-dots',
            duration: 0.5
        }
    }, {
        // screens greater than >= 1024px
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            draggable: true,
            itemWidth: 300,
            dots: '.dots',
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            },
            duration: 0.5,
        }
    }]
});



// TILT Hover 3D Effect 
$(document).ready(function () {
    $('.wrap-students').tilt({
        maxTilt: 8,
        glare: true,
        maxGlare: 0.3,
        easing: "cubic-bezier(.03,.98,.52,.99)",
        speed: 300,
        transition: true,
    });
});
