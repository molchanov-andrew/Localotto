$(document).ready(function(){

    $(document).on('change','.months-select',function (e) {
        var monthBefore = $(this).attr('data-month-before');
        var chosenMonth = $(this).val();
        if(chosenMonth == monthBefore )
        {
            return;
        }
        $(this).attr('data-month-before',chosenMonth);
        getResultsData({changedMonth:true});
        e.preventDefault();
    });
    $(document).on('change','.years-select',function (e) {
        var yearBefore = $(this).attr('data-year-before');
        var chosenYear = $(this).val();
        if(chosenYear == yearBefore)
        {
            return;
        }
        $(this).attr('data-year-before',chosenYear);
        getResultsData({changedYear:true});
        e.preventDefault();
    });
    $('#typeHot,#typeCold').change(function (e) {
        var id = $(this).attr('id');
        var label = $('label[for="'+id+'"]');
        $('.sort-type-container label').removeClass('active');
        label.addClass('active');
        getResultsData({changedType:true});
        e.preventDefault();
    });
    $("#lotteryId").change(function (e) {
        var lotteryBefore = $(this).attr('data-lottery-before');
        var chosenLottery = $(this).val();
        if(chosenLottery == lotteryBefore )
        {
            return;
        }
        $(this).attr('data-lottery-before',chosenLottery);
        getResultsData({changedLottery:true});
        e.preventDefault();
    })
});

function getResultsData(params)
{
    var monthsContainer = $('.months-container');
    var yearsContainer = $('.years-container');

    var chosenYear = $('.years-select').val();
    var currentMonthsSelect = $('.months-select').val();
    var currentType = $('.hidden-radio:checked').val();
    var lotteryId = $('#lotteryId').val();
    var language = $('#language').val();
    var data = {
        id:lotteryId,
        type:currentType,
        language:language
    };
    if(params.changedMonth)
    {
        data.month = currentMonthsSelect;
        data.year = chosenYear;
    }
    if(params.changedYear)
    {
        if(chosenYear == 'all')
        {
            monthsContainer.html('');
        }
        data.year = chosenYear;
    }
    if(params.changedLottery || params.changedType)
    {
        monthsContainer.html('');
    }

    $.post('/getHotNumbers',data,function (data) {
        data = JSON.parse(data);
        if (typeof data.hotColdBlock !== 'undefined') {
            $('#hotNumbers').html(data.hotColdBlock);
        }
        if (typeof data.availableYearsBlock !== 'undefined') {
            yearsContainer.html(data.availableYearsBlock);
        }
        if (typeof data.availableMonthsBlock !== 'undefined') {
            monthsContainer.html(data.availableMonthsBlock);
        }
    });
}