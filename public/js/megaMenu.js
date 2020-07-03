$(document).ready(function () {
    var heights = [];

    $('.subMenu_dropdown1').each(function () {
        heights.push($(this).height());
    });

    var maxHeight = Math.max.apply(null, heights);

    $('.subMenu_dropdown1').height(maxHeight);
});

// Remedii Dropdown 2
$(document).ready(function () {
    var heights = [];

    $('.subMenu_dropdown2').each(function () {
        heights.push($(this).height());
    });

    var maxHeight = Math.max.apply(null, heights);

    $('.subMenu_dropdown2').height(maxHeight);
});

// Consultatii Dropdown 3
$(document).ready(function () {
    var heights = [];

    $('.subMenu_dropdown3').each(function () {
        heights.push($(this).height());
    });

    var maxHeight = Math.max.apply(null, heights);

    $('.subMenu_dropdown3').height(maxHeight);
});
