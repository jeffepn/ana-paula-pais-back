$(document).ready(function () {
    var clipboard = new ClipboardJS('.copy-link-immobile');
    clipboard.on('success', function (e) {
        $('.copy-link-immobile').tooltip('show');
    });
    verifyIfNavFloating($(window).scrollTop());
    verifyViexContext($(window).scrollTop());
    $(window).scroll(function () {
        verifyIfNavFloating($(this).scrollTop());
        verifyViexContext($(this).scrollTop());
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
    $("body").on("click", ".scrool-smoth", function (event) {
        event.stopPropagation();
        event.preventDefault();
        scrollSmoth($(this).attr('href'));

    });
    $("body").on("click", ".close-modal-view-image-immobile", function (event) {
        $('#modal-view-image-immobile').modal('hide');
    });
    $("body").on("click", ".copy-link", function (event) {
        event.preventDefault();
        event.stopPropagation();
        var link = this.getAttribute("data-link");
        alert("Link copiado para área de transferência");
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
    if ($('.section-curated-immobiles').length && !$('.section-curated-immobiles .content-default').hasClass('content-view')) {
        if (top >= $('.section-curated-immobiles').offset().top - 300 && top <= ($('.section-curated-immobiles').offset().top + $('.section-curated-immobiles').height()) - 300) {
            $('.section-curated-immobiles .content-default').addClass('content-view');
        }
    }
    if ($('.section-services-description-one').length && !$('.section-services-description-one .content-default').hasClass('content-view')) {
        if (top >= $('.section-services-description-one').offset().top - 300 && top <= ($('.section-services-description-one').offset().top + $('.section-services-description-one').height()) - 300) {
            $('.section-services-description-one .content-default').addClass('content-view');
        }
    }
    if ($('.section-services-description-two').length && !$('.section-services-description-two .content-default').hasClass('content-view')) {
        if (top >= $('.section-services-description-two').offset().top - 300 && top <= ($('.section-services-description-two').offset().top + $('.section-services-description-two').height()) - 300) {
            $('.section-services-description-two .content-default').addClass('content-view');
        }
    }

}

function scrollSmoth(element) {
    var offsets = getPositionElement(element);
    var top = (offsets['top'] - $('header').height());
    $('html, body').animate({
        scrollTop: top
    }, 500);

}

function scrollInApp(top, element, smoth) {
    if (!smoth) {
        smoth = 500;
    }
    if (element) {
        var offsets = getPositionElement(element);
        var top = (offsets['top'] - $('header').height());
        $('html, body').animate({
            scrollTop: top
        }, smoth);
        return 1;
    }
    $('html, body').animate({
        scrollTop: top
    }, smoth);
}
