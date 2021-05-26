$('body').on('click', '#multiple-change', function(){
    if ($("input:checked").length < 2) {
        alert("Choose 2 and more items");
    } else {
        $('#multiple-change').attr({
            href:'change-multiple',
            'data-toggle':'modal',
            'data-target':'#modalGeneral',
            'data-pjax':'0',
        }).addClass('change-multiple-grid open-modal-link')
    }
})

$('body').on('click', '#multiple-delete', function(){
    if ($("input:checked").length < 2) {
        alert("Choose 2 and more items");
    } else {
        $('#multiple-delete').addClass("ajax-solo-rows").attr('href', 'delete-multiple');
    }
})

