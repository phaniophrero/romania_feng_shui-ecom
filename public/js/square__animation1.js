window.sr = ScrollReveal();
// Romb 1 Left
sr.reveal('.rombLeft', {
    origin: 'left',
    duration: 600,
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

// Romb 2 Left
sr.reveal('.rombLeft2', {
    origin: 'left',
    duration: 600,
    delay: 600,
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

// Romb 3 Left
sr.reveal('.rombLeft3', {
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

// Romb 4 Left
sr.reveal('.rombLeft4', {
    origin: 'left',
    duration: 600,
    delay: 900,
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

// Romb 5 Left
sr.reveal('.rombLeft5', {
    origin: 'left',
    duration: 600,
    delay: 1000,
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

// Romb 6 Left
sr.reveal('.rombLeft6', {
    origin: 'left',
    duration: 600,
    delay: 1100,
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

// bgSquare1 Right
sr.reveal('.bgSquare1', {
    origin: 'right',
    duration: 600,
    delay: 600,
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
sr.reveal('.bgSquare2', {
    origin: 'right',
    duration: 600,
    delay: 800,
    distance: '500px',
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
sr.reveal('.bgSquare3', {
    origin: 'right',
    duration: 600,
    delay: 1000,
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

// categoryHeading Right
sr.reveal('.categoryHeading', {
    origin: 'right',
    duration: 1000,
    delay: 600,
    distance: '100px',
    viewFactor: 0.2,
    mobile: true,
    reset: false
});

// categoryDetails Right
sr.reveal('.categoryDetails', {
    origin: 'right',
    duration: 1000,
    delay: 1000,
    distance: '200px',
    viewFactor: 0.2,
    mobile: true,
    reset: false
});

// categoryBtn Right
sr.reveal('.categoryBtn', {
    origin: 'bottom',
    duration: 800,
    delay: 1400,
    viewFactor: 0.2,
    easing: 'ease-out',
    mobile: true,
    reset: false
});


// Product Image 
sr.reveal('.categoryImage1', {
    afterReveal: function (el) {
        $('.categoryImage1').addClass('show');
    },
    origin: 'top',
    duration: 800,
    delay: 1200,
    distance: '150px',
    easing: 'ease-out',
    mobile: true,
    reset: false
});
