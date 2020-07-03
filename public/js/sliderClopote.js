new Glider(document.querySelector('.productCarousel_clopote'), {
    // Mobile-first defaults
    slidesToShow: 1,
    slidesToScroll: 1,
    scrollLock: true,
    draggable: true,
    dots: '#resp-dots7',
    arrows: {
        prev: '.glider-prev7',
        next: '.glider-next7'
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
            dots: '#resp-dots7',
            arrows: {
                prev: '.glider-prev7',
                next: '.glider-next7'
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
            dots: '.dots7',
            arrows: {
                prev: '.glider-prev7',
                next: '.glider-next7'
            },
            duration: 0.5
        }
    }]
});
