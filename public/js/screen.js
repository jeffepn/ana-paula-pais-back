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
        if ($("#nav-master").hasClass("transparent")) {
            $("#nav-master").addClass("navbar-transparent");
        }
        $("#nav-master").removeClass("nav-in-floating ");
    } else {
        if (!$("#nav-master").hasClass("nav-in-floating")) {
            $("#nav-master").addClass("nav-in-floating ");
        }
        $("#nav-master").removeClass("navbar-transparent");
    }
}
