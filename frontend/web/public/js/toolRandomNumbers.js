jQuery(function () {
    jQuery('#clock').clock({
        graduations: 0,
        size: 250,
        date: new Date()
    });
});
(function(){
    var MainNumbers = [];
    var BonusNumbers = [];
    var SecondBonusNumbers = [];
    function randomInteger(min, max) {
        var rand = min + Math.random() * (max + 1 - min);
        rand = Math.floor(rand);
        return rand;
    }
    function chooseFromRange(Range, Quantity, ButNotTheseNumbers) {
        var Numbers = [];
        var RandNumber = 0;
        /*console.log(ButNotTheseNumbers);*/
        if (ButNotTheseNumbers) {
            while (Numbers.length < Quantity) {
                RandNumber = randomInteger(1, Range);
                if (!(Numbers.indexOf(RandNumber) > -1)) {
                    if(!(ButNotTheseNumbers.indexOf(RandNumber) > -1))
                    {
                        Numbers.push(RandNumber);
                    }
                }
            }
        } else {
            while (Numbers.length < Quantity) {
                RandNumber = randomInteger(1, Range);
                if (!(Numbers.indexOf(RandNumber) > -1)) {
                    Numbers.push(RandNumber);
                }
            }
        }
        return Numbers;
    }

    function chooseNumbersForNoobs(MainRange, MainQuantity, BonusRange, BonusQuantity, SecondBonusRange, SecondBonusQuantity) {
        MainNumbers = chooseFromRange(MainRange, MainQuantity);
        if(BonusRange)
        {
            if(BonusRange == MainRange)
            {
                BonusNumbers = chooseFromRange(MainRange, BonusQuantity, MainNumbers);
            } else
            {
                BonusNumbers = chooseFromRange(BonusRange, BonusQuantity);
            }
            if(SecondBonusRange)
            {
                SecondBonusNumbers = chooseFromRange(SecondBonusRange, SecondBonusQuantity);
                return [MainNumbers, BonusNumbers, SecondBonusNumbers];
            }
            return [MainNumbers, BonusNumbers];
        }
        return [MainNumbers];
    }
    function createHtmlForResultNumbers(Result)
    {
        var data = '';
        if(Result[0])
        {
            $.each(Result[0],
                function()
                {
                    data += '<span class="main-lottery-number">' + this + '</span>';
                }
            );
        }
        data += '<br>';
        if(Result[1])
        {
            $.each(Result[1],
                function()
                {
                    data += '<span class="bonus-lottery-number">' + this + '</span>';
                }
            );
        }
        data += '<br>';
        if(Result[2])
        {
            $.each(Result[2],
                function()
                {
                    data += '<span class="secondary-lottery-number">' + this + '</span>';
                }
            );
        }
        data += '<br>';
        return data;
    }
    $('button.help-to-choose').click(function(){
        if($('#birthday').val().length > 6)
        {
            // console.log($('#lotto option:selected'));
            var action = "/getUrlForGenerator";
            var data = {};
            var lottery_id = $('#lotto option:selected').data('lottery-id');
            var default_id = $('#lotto option:selected').data('default-id');
            var advert_id = $('#lotto option:selected').data('advert-id');
            var lang_code = $('#lotto option:selected').data('lang-code');
            var button_link = '';
            var MainRange = $('#lotto option:selected').data('main-range');
            var MainQuantity = $('#lotto option:selected').data('main-quantity');
            var BonusRange = $('#lotto option:selected').data('bonus-range');
            var BonusQuantity = $('#lotto option:selected').data('bonus-quantity');
            var SecondBonusRange = $('#lotto option:selected').data('second-bonus-range');
            var SecondBonusQuantity = $('#lotto option:selected').data('second-bonus-quantity');
            // console.log(MainRange);
            var Result = chooseNumbersForNoobs(MainRange, MainQuantity, BonusRange, BonusQuantity, SecondBonusRange, SecondBonusQuantity);
            /*console.log(Result);*/
            var HtmlResult = createHtmlForResultNumbers(Result);

            data['default_broker_id'] = default_id;
            data['promoting_broker_id'] = advert_id;
            data['lang_code'] = lang_code;
            data['lottery_id'] = lottery_id;

            $.post(action, data, function(response){
                var mini_data = JSON.parse(response);
                button_link = '<a style="margin-top: 5px; width: 50%" class="shadows-effect border-radius-effect button-red new-button-thelotter" target="_blank" href="'+mini_data['href']+'">'+mini_data['text']+'</a>';
                $('div.numbers-for-user .inline-numbers').html(HtmlResult);
                $('div.row.choose-numbers-control-panel').find('.new-button-thelotter').remove();
                $('div.row.choose-numbers-control-panel').append(button_link);
            });
            return;
        }
        else
        {
            $('#birthday').animate({
                opacity: "-=0.7",
                border: '1px solid #CC2121'
            }, 500, function() {
                $('#birthday').animate({
                    opacity: "+=0.7",
                    border: '1px solid #60A5E8'
                }, 500);
            });
        }
    });
}());