var slider = $('#sliderStatuete').lightSlider({
    controls: false,
    autoWidth: true,
    loop: true,
    onSliderLoad: function () {
        $('#sliderStatuete').removeClass('cs-hidden');
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

$('#prevBtnStatuete').on('click', function () {
    slider.goToPrevSlide();
});
$('#nextBtnStatuete').on('click', function () {
    slider.goToNextSlide();
});
