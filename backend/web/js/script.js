$(document).ready(function () {
    $(document).on('hidden.bs.modal', function (event) {
        if ($('.modal:visible').length) {
            $('body').addClass('modal-open');
        }
    });

});

function showNotification(message, styleClass, timeout) {
    timeout = typeof timeout !== 'undefined' ? timeout : 2000;
    var alert = $('#generalAlert');
    alert.html(message).addClass(styleClass).show('fast');
    setTimeout(function () {
        alert.hide('fast').html('').removeClass(styleClass);
    }, timeout);
}

// Function for getting default response.
function showAjaxResponse(response) {
    // var data = JSON.parse(response);
    var data = response;
    var status = '';
    if (data.status === 'success') {
        status = 'alert-success';
    } else if (data.status === 'warning') {
        status = 'alert-warning';
    } else {
        status = 'alert-danger';
    }
    showNotification(data.message, status);
}

// function show/hide filds Page controller actionCreate
(function () {
    $('body').on('change', '#page-module', function () {
        $('[data=\'no_data\']').css('display', 'none');
        let pagesModuleValue = $("#page-module option:selected").val();
        switch (pagesModuleValue) {
            case 'broker':
                $('.field-page-brokerid').css('display', 'inherit');
                break;
            case 'lottery':
                $('.field-page-lotteryid').css('display', 'inherit');
                break;
            case 'last-results-by-country-table':
                $('.field-page-countryid').css('display', 'inherit');
                break;
            case 'buy-online-lottery':
                $('.field-page-lotteryid').css('display', 'inherit');
                break;
            case 'lottery-raffle':
                $('.field-page-lotteryid').css('display', 'inherit');
                break;
        }
    });
})();
