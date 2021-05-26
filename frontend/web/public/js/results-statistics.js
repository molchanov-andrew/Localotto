$(document).ready(function(){
    // Not used according to seo optimization. Feel free to delete it.
    $('#sortYear').change(function (e) {
        var yearBefore = $(this).attr('data-year-before');
        var chosenYear = $(this).val();

        if(chosenYear == yearBefore)
        {
            return;
        }
        $(this).attr('data-year-before',chosenYear);

        getResultsData(true);
        e.preventDefault();
    });
    $(document).on('change','.months-select',function (e) {
        var monthBefore = $(this).attr('data-month-before');
        var chosenMonth = $(this).val();

        if(chosenMonth == monthBefore)
        {
            return;
        }
        $(this).attr('data-month-before',chosenMonth);

        getResultsData(false);
        e.preventDefault();
    });
});

function getResultsData(changeMonthSelect)
{
    var chosenYear = $('#sortYear').val();
    var currentMonthsSelect = $('.months-select').val();
    var lotteryId = $('#lotteryId').val();
    var data = {
        id:lotteryId,
        year:chosenYear
    };
    if(!changeMonthSelect)
    {
        data.month = currentMonthsSelect;
    }
    $.post('/getLotteryStatistics',data,function (data) {
        data = JSON.parse(data);
        if (typeof data.numbersArchiveBlock !== 'undefined')
        {
            $('#numbersArchive').html(data.numbersArchiveBlock);

            $('#align-circles').bootstrapTable();
        }
        if(changeMonthSelect && data.availableMonthsBlock !== 'undefined')
        {
            $('.months-block').html(data.availableMonthsBlock);
        }
    });
}