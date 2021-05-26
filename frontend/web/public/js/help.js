/**
 * Created by root on 24.11.15.
 */
var ScreenWidth = document.documentElement.clientWidth;
$(document).ready(function () {
    if (ScreenWidth < 400) {
        $('.news-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 10000,
        });
    } else if (ScreenWidth < 800) {
        $('.news-slider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 10000,
        });
    } else if (ScreenWidth < 1100) {
        $('.news-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 10000,
        });
    } else {
        $('.news-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            arrows: true,
            autoplaySpeed: 10000,
        });
    }
});
$(document).ready(function () {
    if (ScreenWidth > 700) {
        $('.iframe-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            adaptiveHeight: false
        });
    }
});
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(function () {
    $('[data-toggle="popover"]').popover();
});