/* for carusel in table */
$(document).ready(function() {
    var interval;
    
    interval = setInterval(InfiniteRotator, 3500);
    $("#contain table tr").hover(function(e) {
        clearInterval(interval);
    }, function(e) {
        interval = setInterval(InfiniteRotator, 3500); 
    }); 

});

function InfiniteRotator()
{
    var currentItem = 0;
    var length = $('.lastResultsSection #slider-for-result-last tr').length;
    $('.lastResultsSection #slider-for-result-last tr').eq(currentItem).fadeOut(500);

    setTimeout(function(){
        var current = $('.lastResultsSection #slider-for-result-last tr').eq(currentItem);
        $('.lastResultsSection #slider-for-result-last').append(current);
        $('.lastResultsSection #slider-for-result-last tr').eq(length-1).fadeIn(500);
    },1000);
}
/* end of carusel in table */

/* price sorter for maximum jackpot output 'table' */ 
function priceSorter(a, b)
{
    a = a.replace(/\D+/g,""), b = b.replace(/\D+/g,"");
    a = parseInt(a);
    b = parseInt(b);
    if (a > b) return -1;
    if (a < b) return 1;
    return 0;
}
/* end of price sorter for maximum jackpot output 'table' */ 

/* added for appear button */
$(window).scroll(function() {
    $(".hidme").each(function(i) {
        var bottom_of_object = $(this).offset().top + $(this).outerHeight();
        var bottom_of_window = $(window).scrollTop() + $(window).height();
        
        if( bottom_of_window > bottom_of_object + 200)
        {
            $(this).animate({'opacity':'1'}, 1500);   
        }
    }); 
});
/* end of appear button */