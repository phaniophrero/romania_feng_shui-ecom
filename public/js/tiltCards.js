// TILT Hover 3D Effect 
$(document).ready(function () {
    $('.cards-img').tilt({
        maxTilt: 10,
        glare: true,
        maxGlare: 0.3,
        easing: "cubic-bezier(.03,.98,.52,.99)",
        speed: 300,
        transition: true,
    });
});
