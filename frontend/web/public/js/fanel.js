/**
 * Created by Roma on 17.05.2017.
 */
    // js logic for numbers in dynamic funnel
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
                    data += '<div class="winning-numbers main-fan"><span>' + this + '</span></div>';
                }
            );
        }
        if(Result[1])
        {
            $.each(Result[1],
                function()
                {
                    data += '<div class="winning-numbers bonus-fan"><span>' + this + '</span></div>';
                }
            );
        }
        if(Result[2])
        {
            $.each(Result[2],
                function()
                {
                    data += '<div class="winning-numbers sec-fan"><span>' + this + '</span></div>';
                }
            );
        }
        return data;
    }
    $('.green-button.toStep3').on('click', function(){
        if($('#funel-birthday').val().length >= 10)
        {
            // console.log($('#lotto option:selected'));

            var popup_suffix = 'bdpopup';
            var action = "/getUrlForFanel";
            var show_stepps = "";
            var data = {};
            var lottery_id = $('#funel-select option:selected').data('lottery-id');
            var default_id = $('#funel-select option:selected').data('default-id');
            var advert_id = $('#funel-select option:selected').data('advert-id');
            var lang_code = $('#funel-select option:selected').data('lang-code');
            var button_link = '';
            var MainRange = $('#funel-select option:selected').data('main-range');
            var MainQuantity = $('#funel-select option:selected').data('main-quantity');
            var BonusRange = $('#funel-select option:selected').data('bonus-range');
            var BonusQuantity = $('#funel-select option:selected').data('bonus-quantity');
            var SecondBonusRange = $('#funel-select option:selected').data('second-bonus-range');
            var SecondBonusQuantity = $('#funel-select option:selected').data('second-bonus-quantity');
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
                $('div.stepp.step4 .fanel-group').html('');
                $('div.stepp.step4 .fanel-group-top .place-for-numbers').html('');
                button_link = '<div id="fanel-result" class="red-button"><a class="modal-link" target="_blank" onclick="" href="'+mini_data['href']+popup_suffix+'"><span class="button-inner-text">'+mini_data['text']+' <span class="right-button-arrow"></span></span></a></div>';
                show_stepps = '<div class="show-stepps"><div class="text-before-steps">'+mini_data['step']+'</div><div class="step-circles"></div><div class="step-circles"></div><div class="step-circles"></div><div class="step-circles selected-step"></div></div>';
                $('div.stepp.step4 .fanel-group-top .place-for-numbers').html(HtmlResult);
                $('div.stepp.step4 .fanel-group').html(button_link+show_stepps);
            });
            return;
        }
    });
    $('#fanel').on('click', '.modal-link', function(){
        $('#fanel').modal('hide');
    });

    $('.choose-buttons-funel').on('click', function(){
        $('.choose-buttons-funel').removeClass('choose-buttons-checked');
        $(this).addClass('choose-buttons-checked');
    });

}());

$('document').ready(function() {

    $('#fanel').on('click', '.toStep1', function(){

        $('#fanel .stepp').removeClass('selected-funel-step');
        $('#fanel .step1').addClass('selected-funel-step');

        return false;
    });

    $('#fanel').on('click', '.toStep2', function(){
        var answer1 = $('input[name="pos"]:checked').val();
        //console.log(answer1);
        if (true) {
            $('#fanel .stepp').removeClass('selected-funel-step');
            $('#fanel .step2').addClass('selected-funel-step');
        } else {
            $('#fanel .step1 .error_text').fadeIn(300);
            $('#fanel .step1 .error_text').fadeOut(1000);
        }

        return false;
    });


    $('#fanel').on('click', '.toStep3', function(){
        var answer2 = $('input[name="type"]:checked').val();
        //console.log(answer2);
        if (true) {
            $('#fanel .stepp').removeClass('selected-funel-step');
            $('#fanel .step3').addClass('selected-funel-step');
        } else {
            $('#fanel .step2 .error_text').fadeIn(300);
            $('#fanel .step2 .error_text').fadeOut(1000);
        }

        return false;
    });

    $('#fanel').on('click', '.toStep4', function(){
        var answer3 = $('input[name="quickbooks"]:checked').val();
        //console.log(answer3);

        if (true) {
            $('#fanel .stepp').removeClass('selected-funel-step');
            $('#fanel .step4').addClass('selected-funel-step');
        } else {
            $('#fanel .step3 .error_text').fadeIn(300);
            $('#fanel .step3 .error_text').fadeOut(1000);
        }

        return false;
    });

    var show_funel = $.cookie('show_funel');

    if (show_funel != 1) {
        // setTimeout(function(){
        $('#fanel').modal();
        // }, 3000);
        $.cookie('show_funel', 1);
    }
});