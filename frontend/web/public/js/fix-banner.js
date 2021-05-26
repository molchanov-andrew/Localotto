var fixmeTop = $('.right-banner-images').offset().top;       // get initial position of the element

$(window).scroll(function() {                  // assign scroll event listener

    var currentScroll = $(window).scrollTop()+20; // get current position

    if (currentScroll >= fixmeTop) {           // apply position: fixed if you
        $('.right-banner-images').css({                      // scroll to that element or below it
            position: 'fixed',
            top: '0'
        });
    } else {                                   // apply position: static
        $('.right-banner-images').css({                      // if you scroll above it
            position: 'static'
        });
    }

});
