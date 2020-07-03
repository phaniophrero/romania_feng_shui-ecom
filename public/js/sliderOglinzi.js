new Glider(document.querySelector('.productCarousel_oglinzi'), {
    // Mobile-first defaults
    slidesToShow: 1,
    slidesToScroll: 1,
    scrollLock: true,
    draggable: true,
    dots: '#resp-dots5',
    arrows: {
        prev: '.glider-prev5',
        next: '.glider-next5'
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
            dots: '#resp-dots5',
            arrows: {
                prev: '.glider-prev5',
                next: '.glider-next5'
            },
            duration: 0.5
        }
    }, {
        // screens greater than >= 1024px
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            scrollLock: true,
            draggable: true,
            itemWidth: 300,
            dots: '.dots5',
            arrows: {
                prev: '.glider-prev5',
                next: '.glider-next5'
            },
            duration: 0.5
        }
    }]
});
