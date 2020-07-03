var slider = $('#sliderCards').lightSlider({
    controls: false,
    autoWidth: true,
    loop: true,
    onSliderLoad: function () {
        $('#sliderCards').removeClass('cs-hidden');
    },
    responsive: [{
            breakpoint: 800,
            settings: {
                item: 3,
                slideMove: 1,
                slideMargin: 6,
            }
        },
        {
            breakpoint: 480,
            settings: {
                item: 2,
                slideMove: 1
            }
        }
    ]
});

$('#prevBtnCards').on('click', function () {
    slider.goToPrevSlide();
});
$('#nextBtnCards').on('click', function () {
    slider.goToNextSlide();
});
