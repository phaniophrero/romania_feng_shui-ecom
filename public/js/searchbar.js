$(document).ready(function () {
    $(".btn_search").click(function () {
        $(".inputSearch").toggleClass("active").focus().val("");
        $(this).toggleClass("animate");
    });
});
