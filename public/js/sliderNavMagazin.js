var slider = $('#sliderNav').lightSlider({
    controls: false,
    autoWidth: true,
    loop: true,
    onSliderLoad: function () {
        $('#sliderNav').removeClass('cs-hidden');
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

$('#prevBtnNav').on('click', function () {
    slider.goToPrevSlide();
});
$('#nextBtnNav').on('click', function () {
    slider.goToNextSlide();
});
