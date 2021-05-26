window.alert = function(){}
var dd = true;
var showAllBrokers = false;
var userRating = 0;

// Fix if translates for numbers shorteners not signed
if(!TranslatorJS.billionsIndex.length || TranslatorJS.billionsIndex == 'billionsIndex') {
    TranslatorJS.billionsIndex = 'B';
}
if(!TranslatorJS.millionsIndex.length || TranslatorJS.millionsIndex == 'millionsIndex') {
    TranslatorJS.millionsIndex = 'M';
}
if(!TranslatorJS.thousandsIndex.length || TranslatorJS.thousandsIndex == 'thousandsIndex') {
    TranslatorJS.thousandsIndex = 'K';
}

$(document).ready(function()
{
    initHiddenBeforeDocreadyText();
    $('#followCurrentMonth').click(function (e) {
        e.preventDefault();
       var hrefTo = $('[data-current-month]').attr('href');
        window.location.href = hrefTo;
    });
    $('.selectpicker').selectpicker({
        noneResultsText:TranslatorJS.noResultsText + ' {0}',
    });

    $('#title, #seo_keywords, #seo_description').keyup(function()
    {
        var maxLength;
        switch($(this).attr('id'))
        {
            case 'title':
                maxLength = 90;
                break;
            case 'seo_description':
                maxLength = 10000;
                break;
            case 'seo_keywords':
                maxLength = 300;
                break;
        }
        var curLength = $(this).val().length;
        $(this).val($(this).val().substr(0, maxLength));
        var remaning = maxLength - curLength;
        if (remaning < 0) remaning = 0;
        $(this).parent().children('small').html(remaning + ' remaning signs.');
        if (remaning == 0)
        {
            $(this).css('background','#80E669');
        }
        else
        {
            $(this).css('background','#fff');
        }
    });

    $('#title, #seo_keywords, #seo_description').each(function() {
        var maxLength;
        switch($(this).attr('id'))
        {
            case 'title':
                maxLength = 90;
                break;
            case 'seo_description':
                maxLength = 10000;
                break;
            case 'seo_keywords':
                maxLength = 300;
                break;
        }
        $(this).parent().children('small').html(maxLength - $(this).html().length  + ' remaning signs.');
    });

    $('.caret').click(function () {
        var mySelect = $(this).siblings('select');
        mySelect.focus();
    });

    $(document).on('change','#followLink',function(e){
        e.preventDefault();
        var link = $(this).val();
        if($(this).find('option:selected').attr('data-post-link') == 'true'){
            followLinkByPost($(this).val(),{getLastUnavailableResult:1})
            return false;
        }
        if(typeof link !== typeof undefined && link !== false)
        {
            window.location.href = link;
        }
        return false;
    });

    $(document).on('click','#showResults li a',function () {
        var link = $(this).attr('data-link');
        if(typeof link !== typeof undefined && link !== false)
            window.location.href = link;
    });

    $('.main-page-brokers-logo').mousemove(function( event ) {
        var x = event.pageX - $(this).offset().left;
        var y = event.pageY - $(this).offset().top;
          $(this).children('.pop-up').css('left', (x+20)+'px');
          $(this).children('.pop-up').css('top', (y+20)+'px');
        });

    $('[broker-number="1"], [broker-number="2"]').change(function (e) {
        var broker = $(this).attr('broker-number');
        $.post('/getBroker', {broker_id:$(this).val(),language:language}, function(response){
            var data = JSON.parse(response);

            $('[name="broker_name'+broker+'"]').html(data.broker_name);
            $('[name="lottories'+broker+'"]').html(data.lottories);
            $('[name="bonuses'+broker+'"]').html(data.bonuses);
            $('[name="systematic'+broker+'"]').html(data.systematic);
            $('[name="scan_ticket'+broker+'"]').html(data.scan_ticket);
            $('[name="languages'+broker+'"]').html(data.languages);
            $('[name="syndicat'+broker+'"]').html(data.syndicat);
            $('[name="paymentMethods'+broker+'"]').html(data.paymentMethods);
            $('[name="phones'+broker+'"]').html(data.phones);
            $('[name="year'+broker+'"]').html(data.year);
            $('[name="clicks'+broker+'"]').html(data.clicks);
            $('[name="email'+broker+'"]').html(data.email);
            $('[name="chat'+broker+'"]').html(data.chat);
            $('[name="action'+broker+'"]').html(data.action);
            $('.popover-toggle').popover();
        });
    });

    //TODO: COMMENTED AFTER MIGRATION
    // $('#paginationsToggle').click(function(){
    //     $('.compare-table.table.table-hover').bootstrapTable('togglePagination');
    //     $('#paginationsToggle').html('')
    // });

    $('#home-page-Search').click(function(){
        var s = '/searchFromHomePage';
        $.post(s, $('#HomePage-SeadchOptions').serialize()+'&language='+language, function(data) {
            $('.brokers-block').html(data);
            $('#lookotherBrokers').css('display', 'none');
        });
    });


    $('#search-in-broker-table').click(function () {
        $(this).closest('form').submit();

    })
    //TODO: COMMENTED AFTER MIGRATION
    // $('#search-in-broker-table').click(function(){
    //     var s = '/searchFromBrokersTable';
    //     $.post(s, $('#searchOptionsFromBrokerTable').serialize()+'&language='+language+'&languageId='+languageId, function(data) {
    //         $('#reloadedTable').bootstrapTable('destroy');
    //         $('#brokers').html(data);
    //         $('#paginationsToggle').css('display', 'none');
    //         $('#reloadedTable').bootstrapTable({pagination:false});
    //     });
    // });
    //
    // // Used in brokers table.
    // $('#showAllBrokersInTable').click(function(){
    //     var s = '/searchFromBrokersTable';
    //     $('#showAllBrokersInTable').hide();
    //     $.post(s, 'language='+language+'&languageId='+languageId, function(data) {
    //         $('#reloadedTable').bootstrapTable('destroy');
    //         $('#brokers').html(data);
    //         $('#paginationsToggle').css('display', 'none');
    //         $('#reloadedTable').bootstrapTable({pagination:false});
    //     });
    // });
    //
    // $('#showAllBrokersInTables').click(function(){
    //     var s = '/searchFromBrokersTable2';
    //     $('#showAllBrokersInTable').hide();
    //     $('#showRestBrokers').removeClass('hide');
    //     $.post(s, 'language='+language, function(data) {
    //         $('#reloadedTable').bootstrapTable('destroy');
    //         $('#brokers').html(data);
    //         $('#paginationsToggle').css('display', 'none');
    //         $('#reloadedTable').bootstrapTable({pagination:false});
    //     });
    // });
    //
    // $('#showRestBrokers').click(function(){
    //     var s = '/searchForRestBrokers';
    //     $('#showRestBrokers').hide();
    //     $.post(s, 'language='+language, function(data) {
    //         $('#reloadedTable').bootstrapTable('destroy');
    //         $('#brokers').html(data);
    //         $('#paginationsToggle').css('display', 'none');
    //         $('#reloadedTable').bootstrapTable({pagination:false});
    //     });
    // });

    $('#showAllCurrencies').click(function(){
        $.post('/getAllCurrency', 'language='+language, function(data)
        {
            $('#currencies').html(data);
            $('#currencies').dropdown('toggle');
        });
    });

    $('#lookotherBrokers').click(function()
    {

        var s = '/searchFromHomePage';
        $.post(s, 'language='+language, function(data) {
            $('.brokers-block').html(data);
            $('#lookotherBrokers').css('display', 'none');
            showAllBrokers = true;
            unifyHeights('main-content-on-home-page', 'side-lotteries');
            $('#lookotherBrokers').hide();
        });
    });


    $(window).scroll(function() {

        if($(this).scrollTop() != 0) {

            $('#toTop').fadeIn();

            } else {

            $('#toTop').fadeOut();

        }

    });

    $('#toTop').click(function() {

        $('body,html').animate({scrollTop:0},800);

    });

    $('#sendContactFormFromCU').click(function(e)
    {
        e.preventDefault();
        var complateValid = true;
        if(!$('#contactForm #name').val())
        {
            $('#contactForm #name').css('background', '#FAD7D7');
            complateValid = false;
        }
        if(!$('#contactForm #email').val() || !/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test($('#contactForm #email').val()))
        {
            $('#contactForm #email').css('background', '#FAD7D7');
            complateValid = false;
        }
        if(!$('#contactForm #phone').val() || !/^\+?\d{0,4}\(?\d{1,4}\)?\d{3}-?\d{2}-?\d{2}$/.test($('#contactForm #phone').val()))
        {
            $('#contactForm #phone').css('background', '#FAD7D7');
            complateValid = false;
        }
        if(!$('#contactForm #message').val())
        {
            $('#contactForm #message').css('background', '#FAD7D7');
            complateValid = false;
        }
        setTimeout(function(){
            $('#contactForm #message, #contactForm #phone, #contactForm #email, #contactForm #name').css('background', '#FFF');
        }, 1000);
        if(complateValid)
        {
            var s = '/sendContactForm';
            $.post(s, $('#contactForm').serialize()+'&language='+language, function(data) {
                $('#popUp .modal-content .modal-body').html(data);
                $('#popUp').modal('toggle');
                var formData = document.getElementsByName('contact-form')[0];
                formData.reset();
            });
        }
    });
//TODO: COMMENTED AFTER MIGRATION
//     $(document).scroll(function(){
//         if($('.compare-table.table.table-hover').length){
//             if(window.scrollY >= getOffsetRect('.compare-table.table.table-hover').top && $(window).width() > 1025)
//             {
//                 $('#fixed-header-of-table').css('background', $('.compare-table.table.table-hover thead').css('background'));
//                 $('#fixed-header-of-table').html('');
//                 $('table.compare-table.table.table-hover[data-toggle!="table"]').clone().prependTo('#fixed-header-of-table');
//                 $('#fixed-header-of-table').css('opacity', 1);
//                 $('#fixed-header-of-table').css('height', 40);
//             }
//
//             if(window.scrollY < getOffsetRect('.compare-table.table.table-hover').top)
//             {
//                 $('#fixed-header-of-table').css('opacity', 0);
//                 $('#fixed-header-of-table').css('height', 0);
//             }
//         }
//     });


    $(window).resize(function()
    {
        if($('.carousel .item').length)
        {
            setHeightForSliderHP();
        }
    });

    countExChange();
    // get_lottery();
    setHeightForSliderHP();

    setTimeout(function(){
        if($( window ).width() > 768)
        {
            unifyHeights('main-content-on-home-page', 'side-lotteries');
        }
        else
        {
            $('#side-lotteries').css('height', 'auto');
        }

    }, 1000);

    setInterval(function () {
        updateTimers();
    }, 1000);
});

// function get_lottery()
// {
//     var lotteryId = $('#lotto_id').val();
//     var s = '/getlottoresults';
//     $.post(s, {id:$('#selected_lottery').val(),lotto_id:lotteryId}, function(data) {
//         $('#lotto-info').html(data);
//     });
// }

function countExChange()
{
    var currency = $.cookie('currency');
    var symbol = $.cookie('currencySymbol');
    var currencyName = $.cookie('selectedCurrency');
    var translatedCurrency = $.cookie('translatedCurrency');
    if(!currency)
    {
        currency = 1;
        $.cookie('currency', currency);
        $.cookie('currencySymbol', '$');
    }

    $('.navbar-wrapper > div > div > nav > ul > li:nth-child(5) > div > button').html(symbol+' '+translatedCurrency);

    if(dd)
    {
        $('.money').each(function()
        {
            if($(this).hasClass('money-initialized')){
                return;
            }
            $(this).addClass('.money-initialized');
            var basicPrice = $(this).text().replace(/\s/g, '');
            $(this).attr('data-basic-cost',basicPrice);
            if($(this).hasClass('is-a-jackpot')){
                if(basicPrice == 0){
                    $(this).html(TranslatorJS.emptyJackpot);
                    $(this).addClass('is-empty-jackpot');
                    return;
                }
            }
            var myCurrency = currency;
            var mySymbol = symbol;
            var ownCurrency = $(this).attr('data-special-currency-id');
            var myName = currencyName;
            var formatFunction = priceToDigitIndexed;

            if(typeof ownCurrency !== typeof undefined && ownCurrency !== false && typeof currencies[ownCurrency] !== typeof undefined && typeof currencies[ownCurrency]['symbol'] !== typeof undefined)
            {
                mySymbol = currencies[ownCurrency]['symbol'];
                myCurrency = currencies[ownCurrency]['rate'];
                myName = currencies[ownCurrency]['name'];
            }
            var canHover = '';
            var mobileArrow = '';
            if($(this).hasClass('ticket-price'))
            {
                canHover = 'can-hover';
                mobileArrow = '<span class="hidden-lg hidden-md hidden-sm arrow-mobile"><i class="glyphicon glyphicon-chevron-right"></i></span>';
            }
            var value = parseFloat($(this).html()) * myCurrency;
            if($(this).attr('data-style') === 'coma')
            {
                formatFunction = formatComas;
            }
            $(this).html(
                '<span class="currency-sign currency-'+myName+' '+canHover+'">'+mySymbol.replace(/\s/g, '')+'</span>&nbsp;'+
                '<span class="money-numbers">'+formatFunction(value)+'</span>' + mobileArrow
                // Mobile addition.

            );

            if($(this).hasClass('ticket-price'))
            {
                var additionalCurrencies = [currencies[1],currencies[4],currencies[11]];
                makeBonusCurrencyPopup($(this).find('.currency-sign'),basicPrice,additionalCurrencies);
            }

            if(!$(this).is('td') && !($(this).parents('td').length > 0) && !$(this).hasClass('money-dynamic')) {
                var valueBefore = $(this).find('.money-numbers').text();

                $(this).prop('Counter', 0).animate({
                    Counter: parseFloat(value)
                }, {
                    duration: 2500,
                    easing: 'swing',
                    step: function (now) {
                        value = formatFunction(now);
                        $(this).find('.money-numbers').html(value);
                    },
                    complete: function () {
                        $(this).find('.money-numbers').html(valueBefore);
                    }
                });
            }
        });

        dd = false;
        setTimeout(function(){
            console.log('dd active');
            dd = true;
        }, 2000);
    }
}

function makeBonusCurrencyPopup(currencyNode, basicPrice, additionalCurrencies) {
    var currentCurrencySymbol = currencyNode.text();
    var parentNode = $(this).closest('.money');
    if(!basicPrice)
        basicPrice = parentNode.attr('data-basic-cost');
    if(parseFloat(basicPrice) == 0)
    {
        var html = '<span class="additional-currencies-popup zero-price-block">';
        var zeroText = TranslatorJS.zeroPriceText;
        html+='<div>'+zeroText+'</div>'
    }
    else
    {
        var html = '<span class="additional-currencies-popup">';
        for (var key in additionalCurrencies)
        {
            if(currentCurrencySymbol !== (additionalCurrencies[key]['symbol'].replace(/\s/g, '')))
            {
                var finalPrice = parseFloat(basicPrice)*parseFloat(additionalCurrencies[key]['rate']);
                html+='<p>';
                html+='<span class="currency-in">'+additionalCurrencies[key]['symbol'].replace(/\s/g, '')+'</span>&nbsp;';
                html+='<span >'+priceToDigitIndexed(finalPrice)+'</span>';
                html+='</p>';
            }
        }
    }
    html += '</span>';
    currencyNode.append(html);
}

function priceToDigitIndexed(value) {
    value = parseFloat(value);
    var divideLimit = 4; // We counting to billions so it's enough to stop here.

    var shorteners = ['', TranslatorJS.thousandsIndex, TranslatorJS.millionsIndex, TranslatorJS.billionsIndex, 'T'];
    for (var divideIteration = 0; divideIteration <= divideLimit; divideIteration++) {
        var divideResult = value / 1000;
        if (divideResult < 1) {
            value = parseFloat(value.toFixed(1));
            value += '<span class="money-index">'+shorteners[divideIteration]+'</span>';
            break;
        }
        value = divideResult;
    }
    return value;
}
function updateTimers()
{
    $('.timer').each(function()
    {
        $(this).removeClass('timer-underway');
        var targetDate = new Date($(this).attr('time')*1000);

        var current_date = new Date().getTime();
        var seconds_left = (targetDate - current_date) / 1000;

        // do some time calculations
        var days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        var hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        var minutes = parseInt(seconds_left / 60);
        var seconds = parseInt(seconds_left % 60);

        // For popup
        if($(this).hasClass('popup-timer'))
        {
            var time = {
                days:days,
                hours:hours,
                minutes:minutes,
                seconds:seconds
            };
            setDynamicTimePopup(time,$(this));
            return;
        }

        // format countdown string + set tag value
        var displaytime = "";

        var aa = parseInt(minutes) + parseInt(seconds) + parseInt(hours) + parseInt(days);
        if(aa > 0)
        {
            if(days>0)
            {
                if(days == 1)
                {
                    displaytime += days + TranslatorJS.day+", ";
                }
                else
                {
                    displaytime += days + TranslatorJS.days+", ";
                }
            }
            if(hours>0)
            {
                displaytime += hours + ":";
            }
            if(minutes < 10)
            {
                minutes = 0+''+minutes;
            }
            if(seconds < 10)
            {
                seconds = 0+''+seconds;
            }
            displaytime += minutes + ":" + seconds;
            var aa = minutes + seconds + hours + days;
            if(aa < 0)
            {
                $(this).addClass('timer-underway');
                displaytime = TranslatorJS.underwayDraw;
            }
        }
        else
        {
            $(this).addClass('timer-underway');
            displaytime = TranslatorJS.underwayDraw;
        }
        $(this).html(displaytime);
    });
}
function formatComas(n) {
    return n.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
}

/*
 Currency
 */

function setHeightForSliderHP()
{
    var g = $('.carousel.slide.hidden-xs.hidden-sm .item').css('width');
    g = parseInt(g, 10);
    var m = g/100*21.7;
    $('.carousel.slide.hidden-xs.hidden-sm .item').css('height', m);
}

function unifyHeights(firstElemId, secondElemId)
{
    var height = $('#'+firstElemId).outerHeight();
    $('#'+secondElemId).css('height', height);
}

function priceSorter(a, b)
{
    a = a.replace(/\D+/g,""), b = b.replace(/\D+/g,"");
    a = parseInt(a);
    b = parseInt(b);
    if (a > b) return 1;
    if (a < b) return -1;
    return 0;
}
function jackpotSorter(a,b) {
    if (a.jackpot < b.jackpot) return -1;
    if (a.jackpot > b.jackpot) return 1;
    return 0;
}
function countSorter(a, b)
{
    a = a.replace(/<span>(\d+)<\/span>/g,"$1"), b = b.replace(/<span>(\d+)<\/span>/g,"$1")
    a = parseInt(a);
    b = parseInt(b);
    if(!a)
    {
        a = 0;
    }
    if(!b)
    {
        b = 0;
    }
    if (a > b) return 1;
    if (a < b) return -1;
    return 0;
}

function numberSorter(a, b)
{
    a = a.replace(/\D+/g,""), b = b.replace(/\D+/g,"");
    a = parseInt(a);
    b = parseInt(b);
    if (a > b) return 1;
    if (a < b) return -1;
    return 0;
}

function chanceToWinSorter(a, b)
{
    a = a.replace(/1\s+\w+\s+/g, '').replace(/\s+/g, '');
    b = b.replace(/1\s+\w+\s+/g, '').replace(/\s+/g, '');
    a = parseInt(a);
    b = parseInt(b);
    if (a > b) return 1;
    if (a < b) return -1;
    return 0;
}

function numbersToGuess(a, b)
{
    a = a.replace(/\d\s+\w+\s+/g, '');
    b = b.replace(/\d\s+\w+\s+/g, '');
    a = parseInt(a);
    b = parseInt(b);
    if (a > b) return 1;
    if (a < b) return -1;
    return 0;
}
function devideTAGSSorter(a, b)
{
    a = a.replace(/(<([^>]+)>)/ig, '');
    b = b.replace(/(<([^>]+)>)/ig, '');
    console.log(a, b);
    if (a > b) return 1;
    if (a < b) return -1;
    return 0;
}

var TableSortingFunctions = {
    numberSorter: function (a, b)
    {
        a = a.replace(/\D+/g,""), b = b.replace(/\D+/g,"");
        a = parseInt(a);
        b = parseInt(b);
        if (a > b) return 1;
        if (a < b) return -1;
        return 0;
    },

    chanceToWinSorter: function (a, b)
    {
        a = a.replace(/1\s+\w+\s+/g, '').replace(/\s+/g, '');
        b = b.replace(/1\s+\w+\s+/g, '').replace(/\s+/g, '');
        a = parseInt(a);
        b = parseInt(b);
        if (a > b) return 1;
        if (a < b) return -1;
        return 0;
    },

    numbersToGuessSorter: function (a, b)
    {
        a = a.replace(/\d\s+\w+\s+/g, '');
        b = b.replace(/\d\s+\w+\s+/g, '');
        a = parseInt(a);
        b = parseInt(b);
        if (a > b) return 1;
        if (a < b) return -1;
        return 0;
    },

    deleteTagsAndSort: function (a, b)
    {
        a = a.replace(/<.*.>/g, '');
        b = b.replace(/<.*.>/g, '');
        if (a > b) return 1;
        if (a < b) return -1;
        return 0;
    }
}


$( "[target='blank'], [target='_blank']" ).click(function(elem){ $.post('/followRecord', {language: $('html').attr('lang'), href:elem.currentTarget.href, from:window.location.href}) });
$( "#simPopUp .modal-dialog a" ).click(function(elem){
    $('#simPopUp').modal('hide');
});

function voteForAgent()
{
    resetErrors();
    var values = [
        $('#voting-modal #voter-name'),
        $('#voting-modal #voter-email'),
        $('#voting-modal .rating input'),
        userRating
    ];

    if(!validate(values)) {
        return false;
    }

    var s = '/voteForAgent';
    $.post(s,
        {
            id: $('#voting-modal #broker_ids').val(),
            name: values[0].val(),
            email: values[1].val(),
            count: values[3],
            language: $('html').attr('lang')
        },
        function(data) {
            var data = $.parseJSON(data);
            /* header message */
            $('#voting-modal .modal-title').html(
                '<button type="button" class="close" data-dismiss="modal">×</button>'+
                '<h4 class="modal-title">'+data['header']+'</h4>'
            );

            /* modal body message */
            $('#voting-modal .container-fluid .row').html(
                '<div class="speech">'+data['body']+'</div>'
            );

            /* footer button */
            $('#voting-modal button.vote-close').addClass('long-button').text(data["footer"]);
            $('#voting-modal #send-vote').css('display', 'none');

            /* update visual rating */
            $('#voting-modal button.vote-close, #voting-modal button.close').click(function(){
                if(data['marks'] != undefined && data['sum_marks'] != undefined) {
                    $("#number-of-votes").text(
                        data['marks']
                    );
                    $('span.stars').stars(data['marks'], data['sum_marks']);
                }
            });
        }
    );
}

function resetErrors() {
    $('#voting-modal input, .rating').removeClass('inputTxtError');
    $('label.error').remove();
}

function number_format( number, decimals, dec_point, thousands_sep ) {
    var i, j, kw, kd, km;
    if( isNaN(decimals = Math.abs(decimals)) ){
        decimals = 2;
    }
    if( dec_point == undefined ){
        dec_point = ",";
    }
    if( thousands_sep == undefined ){
        thousands_sep = ".";
    }

    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

    if( (j = i.length) > 3 ){
        j = j % 3;
    } else{
        j = 0;
    }

    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
    return km + kw + kd;
}

function setCurrency(cost, defaultName, symbol)
{
    $.cookie('currency', cost);
    $.cookie('selectedCurrency', defaultName);
    $.cookie('currencySymbol', symbol);
    location.reload();
}

function getOffsetRect(coords)
{
    var box = document.querySelector(coords).getBoundingClientRect()

    var body = document.body;
    var docElem = document.documentElement;

    var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft;

    var clientTop = docElem.clientTop || body.clientTop || 0;
    var clientLeft = docElem.clientLeft || body.clientLeft || 0;

    var top  = box.top +  scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;

    return { top: Math.round(top), left: Math.round(left) };
}
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
$(window).load(function() {
    $(".se-pre-con").fadeOut("slow").remove();
});
var timer = setInterval(function () {
    $('.popover-toggle').popover();
}, '1000');
function pluralForm ( n, forms ) {
    return forms[(n%10==1 && n%100!=11 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2) ];
};
function pluralFormEn(n,forms){
    return (n == 1) ? forms[0] : forms[1];
};
//pluralForm( 1, ["стул", "стула", "стульев"] );

function setDynamicTimePopup(time,node) {
    if(time.days < 10)
    {
        time.days = 0+''+time.days;
    }
    if(time.hours < 10)
    {
        time.hours = 0+''+time.hours;
    }

    var container = $(node);
    var fields = {
        days:container.find('.popup-days'),
        hours:container.find('.popup-hours'),
        minutes:container.find('.popup-minutes'),
        seconds:container.find('.popup-seconds')
    };
    var translations = {
        days:[TranslatorJS.day1,TranslatorJS.day2,TranslatorJS.day5],
        hours:[TranslatorJS.hour1,TranslatorJS.hour2,TranslatorJS.hour5],
        minutes:[TranslatorJS.minute1,TranslatorJS.minute2,TranslatorJS.minute5],
        seconds:[TranslatorJS.second1,TranslatorJS.second2,TranslatorJS.second5]
    };
    for (var field in fields)
    {
        var tmplanguage = language;
        tmplanguage = tmplanguage.toLowerCase();
        if(tmplanguage === 'en' || tmplanguage === 'fr'){
            fields[field].find('.popup-draw-text').html(pluralFormEn(time[field],translations[field]));
        }
        else{
            fields[field].find('.popup-draw-text').html(pluralForm(time[field],translations[field]));
        }
        fields[field].find('.popup-draw-value').html(time[field]);
    }
}

function initHiddenBeforeDocreadyText() {
    $('[data-hidden-before-docready-text]').each(function () {
        var text = $(this).attr('data-hidden-before-docready-text');
        if(typeof text !== typeof undefined){
            $(this).append(text);
        }
    })
}

function followLinkByPost(link,params) {
    var f = document.createElement("form");
    f.setAttribute('method',"post");
    f.setAttribute('action',link);
    f.setAttribute('id','followLinkByPost');

    for(var key in params)
    {
        var newHiddenInput = document.createElement("input"); //input element, text
        newHiddenInput.setAttribute('type',"hidden");
        newHiddenInput.setAttribute('name',key);
        newHiddenInput.setAttribute('value',params[key]);
        f.appendChild(newHiddenInput);
    }
    document.getElementsByTagName('body')[0].appendChild(f);
    f.submit();
}