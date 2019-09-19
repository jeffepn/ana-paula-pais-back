$(document).ready(function () {
    verifyIfNavFloating($(window).scrollTop());
    $(window).scroll(function () {
        verifyIfNavFloating($(this).scrollTop());
        verifyViexContext($(this).scrollTop());
        this.console.log($(this).scrollTop());
        this.console.log($('.section-services-description-one').offset().top);
    });
    $("body").on("click", ".open-menu", function () {
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
function verifyViexContext(top) {
    if ($('.section-services-description-one').length && !$('.section-services-description-one .content-services-description').hasClass('content-view')) {
        if (top >= $('.section-services-description-one').offset().top - 300 && top <= ($('.section-services-description-one').offset().top + $('.section-services-description-one').height()) - 300) {
            $('.section-services-description-one .content-services-description').addClass('content-view');
        } else {
            $('.section-services-description-one .content-services-description').removeClass('content-view');
        }
    }
    if ($('.section-services-description-two').length && !$('.section-services-description-two .content-services-description').hasClass('content-view')) {
        if (top >= $('.section-services-description-two').offset().top - 300) {
            $('.section-services-description-two .content-services-description').addClass('content-view');
        }
    }
}
