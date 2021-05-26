$(document).ready(function(){
    var block = $('#bottom-top-jackpots');
    $(window).on('scroll', function(){
        var ftrBottom = 1300;
        if(($(window).scrollTop() > ftrBottom)
            && block.hasClass('simple_hide')) {
            block.hide().toggleClass('simple_hide').slideDown(function(){
                $(this).show();
            });
        }
        else if(($(window).scrollTop() < ftrBottom)
            && !block.hasClass('simple_hide')) {
            block.slideUp(function(){
                $(this).toggleClass('simple_hide');
            });
        }

        if ((window.innerHeight + window.pageYOffset) >= $('footer').offset().top) {
            block.css({visibility:'hidden',opacity:'0'});
        } else {
            block.css({visibility:'visible',opacity:'1'});
        }
    });
});