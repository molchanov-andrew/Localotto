jQuery.fn.outerHTML = function(s) {
    return s
        ? this.before(s).remove()
        : jQuery("<p>").append(this.eq(0).clone()).html();
};
$(document).bind("mobileinit", function(){$.extend(  $.mobile , {autoInitializePage: false})});
$(document).ready(function(){
     openedNew = false;
         $('.toggle-menu-button').click(function (e) {
        e.preventDefault();
        $('.tools').toggle();
    });
    var dropdowns = $('.dropdown');
    dropdowns.on('show.bs.dropdown',function (e) {
        $('.longer-content-for-menu-over-logo').addClass('open');
        $('#lotteryCarousel').carousel('pause');
    });
    dropdowns.on('hide.bs.dropdown',function (e) {
        $('.longer-content-for-menu-over-logo').removeClass('open');
        $('#lotteryCarousel').carousel('cycle');
    });
    var tappableCarousel = $(".tappable-carousel");
    tappableCarousel.swiperight(function() {
        $(this).carousel('prev');
    });
    tappableCarousel.swipeleft(function() {
        $(this).carousel('next');
    });

    $('#lotteryCarousel').bind('slid.bs.carousel', function (e) {
        var item = $(this).find('.item.active');
        $('.expand-lottery-country').find('img').attr('src',item.attr('data-country-image')).attr('alt',item.attr('data-country-alt'));
        $('.expand-lottery-guess').html(item.attr('data-numbers-guess'));
        $('.expand-lottery-numbers').html(item.attr('data-additional-numbers'));
        $('.expand-lottery-buy-online').attr('href',item.attr('data-buy-link'));
        $('.expand-lottery-review').attr('href',item.attr('data-review'));
    });
     initMobileCollapsing();
     $('.expandable-mobile-container').each(function () {
         makeExpands(this);
     });
     showAltPopups();
     focusOutAdditionalCurrency();
     $('#secondColumnCompare').change(function () {
         $(this).closest('.compare-broker-select').removeClass('basic-value');
     })
    toggleOverflownText();
    onResize(toggleOverflownText);
});

function focusOutAdditionalCurrency() {
    $('.ticket-price').click(function () {
        if(isMobileWidth())
        {
            $(this).toggleClass('hovered-addition');
        }
    });
    $(document).click(function(event) {
        if(!$(event.target).closest('.ticket-price').length) {
            $('.hovered-addition').removeClass('hovered-addition');
        }
    });
}

function initMobileCollapsing() {
    $(document).on('click','.mobile-collapser',function () {
        var collapseItems = $(this).attr('data-collapse-selector');
        var link = $(this).find('.collapsible-mobile-link');
        var expanded = link.attr('aria-expanded') == 'false';
        link.attr('aria-expanded',expanded);
        if($(this)[0].hasAttribute('data-collapse-parent-selector'))
        {
            var collapseParent = $(this).attr('data-collapse-parent-selector');
            $(this).closest(collapseParent).find(collapseItems).toggleClass('opened');
        }
        else{
            $(collapseItems).toggleClass('opened');
        }
        $(this).toggleClass('opened')
    })
}

function makeExpands(node) {
    var headersSelector = '.h1,.h2,.h3,.h4,h1,h2,h3,h4';
    var firstheading = $(node).find(headersSelector).first();
    var noHeadingTextExists = firstheading.prev();
    if(typeof noHeadingTextExists !== typeof undefined){
        var noHeadingText = firstheading.prevUntil();
        noHeadingText.wrapAll('<span class="mobile-container"></span>');
    }
    var response = getAllBlocksDividedByHeadersRecursive([],$(node).find(headersSelector).first(),headersSelector,0);
    var tmpTemplate = $('#mobileWrapTemplate');
    var template = tmpTemplate.clone().removeAttr('id');
    tmpTemplate.remove();
    for (var key in response)
    {
        var outerHtml = response[key].node.outerHTML();
        var tclone = template.clone();
        response[key].node.outerHTML(tclone);
        tclone.find('.collapsible-menu-title').html(outerHtml);
        tclone.find('.mobile-collapser').attr('data-collapse-selector','.collapsible-with-'+key);
        response[key].foundData.each(function () {
            $(this).addClass('collapsible-with-'+key).addClass('mobile-collapsible');
        });
        $(response[key].foundData).wrapAll('<span class="mobile-container"></span>')
    }
}

function getAllBlocksDividedByHeadersRecursive(data,from,to,index) {
    var foundData = $(from).nextUntil(to);
    var current = $(foundData).next(to);
    data[index] = {node:from,foundData:foundData};
    index++;
    if(!current.is(to))
    {
        return data;
    }
    return getAllBlocksDividedByHeadersRecursive(data,current,to,index);
}

function showAltPopups() {
    var imagesToPopup = $('.brokers-payments-mobile img, .brokers-languages-mobile img');
    $(document).click(function(event) {
        if(!$(event.target).closest('.brokers-payments-mobile').length && !openedNew) {
            $('.alt-popup').remove();
        }
        openedNew = false;
    });
    imagesToPopup.click(function () {
        openedNew = true;
        var alt = $(this).attr('alt');
        if (isMobileWidth() && typeof alt !== typeof undefined && alt !== false) {
            $('.alt-popup').remove();
            $(this).after('<span class="alt-popup"><span class="under-alt-popup">'+alt+'</span></span>');
        }
    });
}
function isMobileWidth() {
    return $(window).width() < 768;
}

function onResize(eventHandler) {
    if(typeof eventHandler === 'function')
    {
        var windowWidth = $(window).width();
        $(window).on('resize', function(){
            if($(this).width() != windowWidth){
                eventHandler();
            }
        });
    }
}

function toggleOverflownText() {
    $('.collapsible-menu-title').each(function () {
        var element = $(this)[0];
        var link = $(this).closest('.collapsible-mobile-link');
        var expanded = link.attr('aria-expanded');
        if(typeof expanded === typeof undefined || expanded === false || expanded === 'false'){
            var overflown = element.offsetHeight < element.scrollHeight || element.offsetWidth < element.scrollWidth;
            if(overflown)
            {
                link.addClass('overflown-text');
            }
            else{
                link.removeClass('overflown-text');
            }
        }
    })
}