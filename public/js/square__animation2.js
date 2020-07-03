window.sr = ScrollReveal();
// bgSquare1 Right
sr.reveal('.bgSquareLeft1', {
    origin: 'left',
    duration: 600,
    delay: 400,
    distance: '500px',
    rotate: {
        x: 0,
        y: 0,
        z: 180
    },
    easing: 'ease-out',
    mobile: true,
    reset: false
});

// bgSquare2 Right
sr.reveal('.bgSquareLeft2', {
    origin: 'left',
    duration: 600,
    delay: 600,
    distance: '400px',
    rotate: {
        x: 180,
        y: 0,
        z: 0
    },
    easing: 'ease-out',
    mobile: true,
    reset: false
});

// bgSquare3 Right
sr.reveal('.bgSquareLeft3', {
    origin: 'left',
    duration: 600,
    delay: 800,
    distance: '300px',
    rotate: {
        x: 0,
        y: 0,
        z: 180
    },
    easing: 'ease-out',
    mobile: true,
    reset: false
});

// categoryHeading2 Right
sr.reveal('.categoryHeading2', {
    origin: 'left',
    duration: 1000,
    delay: 600,
    distance: '100px',
    viewFactor: 0.2,
    mobile: true,
    reset: false
});

// categoryDetails2 Right
sr.reveal('.categoryDetails2', {
    origin: 'left',
    duration: 1000,
    delay: 800,
    distance: '200px',
    viewFactor: 0.2,
    mobile: true,
    reset: false
});

// categoryBtn2 Right
sr.reveal('.categoryBtn2', {
    origin: 'bottom',
    duration: 800,
    delay: 1000,
    distance: '150px',
    viewFactor: 0.2,
    easing: 'ease-out',
    mobile: true,
    reset: false
});


// Product Image2 
sr.reveal('.categoryImage2', {
    afterReveal: function (el) {
        $('.categoryImage2').addClass('show');
    },
    origin: 'right',
    duration: 800,
    delay: 1200,
    distance: '150px',
    easing: 'ease-out',
    mobile: true,
    reset: false
});
