$(document).ready(function() {
    verifyIfNavFloating($(window).scrollTop());
    $(window).scroll(function() {
        verifyIfNavFloating($(this).scrollTop());
    });
    $("body").on("click", ".open-menu", function() {
        if (!$(".navbar-collapse").hasClass("show")) {
            $("#nav-master").removeClass("navbar-transparent");
        } else {
            if ($("#nav-master").hasClass("transparent")) {
                $("#nav-master").addClass("navbar-transparent");
            }
        }
    });
});
function verifyIfNavFloating(top) {
    if (top < 50) {
        $("header").removeClass("nav-in-floating ");
    } else {
        if (!$("header").hasClass("nav-in-floating")) {
            $("header").addClass("nav-in-floating ");
        }
    }
}
