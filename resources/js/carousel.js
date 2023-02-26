import Swiper from "swiper";

window.swiperProperty = new Swiper("#swiperProperty", {
    slidesPerView: 1,
    spaceBetween: 20,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 4,
        },
        1024: {
            slidesPerView: 5,
        },
    },
});

if (document.getElementById("swiperDepoiments")) {
    window.swiperDepoiments = new Swiper("#swiperDepoiments", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 2500,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            992: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
        },
    });
    window.swiperDepoiments.slideToLoop();
}

document.querySelectorAll(".swiper-button-next")?.forEach((el) => {
    el.addEventListener("click", () => {
        window[el.getAttribute("data-id-swiper")]?.slideNext();
    });
});

document.querySelectorAll(".swiper-button-prev")?.forEach((el) => {
    el.addEventListener("click", () => {
        window[el.getAttribute("data-id-swiper")]?.slidePrev();
    });
});
