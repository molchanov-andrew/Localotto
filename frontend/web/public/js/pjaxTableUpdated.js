$(document).ready(function(){
    $(document).on('pjax:success', function() {
        setTimeout(function () {
            countExChange();
        },500)
    });
});