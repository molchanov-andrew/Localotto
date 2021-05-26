$(document).ready(function(){
    $(window).on('scroll', function(){
        var ftr = $('#first-three-results');
        var ftrBottom = ftr.offset().top + ftr.height();
        if(($(window).scrollTop() > ftrBottom)
            && $('#bottom-right-results').hasClass('simple_hide')) {
            $('#bottom-right-results').hide().toggleClass('simple_hide').slideDown(function(){
                $(this).show();
            });
        }
        else if(($(window).scrollTop() < ftrBottom)
            && !$('#bottom-right-results').hasClass('simple_hide')) {
            $('#bottom-right-results').slideUp(function(){
                $(this).toggleClass('simple_hide');
            });
        }

        if ((window.innerHeight + window.pageYOffset) >= $('footer').offset().top) {
            $('#bottom-right-results').css({visibility:'hidden',opacity:'0'});
        } else {
            $('#bottom-right-results').css({visibility:'visible',opacity:'1'});
        }
    });
});