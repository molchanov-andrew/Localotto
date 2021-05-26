$(document).ready(function(){
    $(document).on('change','#yearResult',function (e) {
        e.preventDefault();
        var option = $('#yearResult').find('option:selected');
        var type = option.attr('data-type');
        if(type == 'link')
        {
            window.location.href = $(this).val();
        }
        else{
            var url = '/getLotteryResultsBlock';
            var data = {
                date:option.val(),
                lotteryId:$('#lotteryId').val(),
                language:$('#languageIso').val(),
                languageId:$('#languageId').val(),
            };
            $.post(url,data,function (response) {
                response = JSON.parse(response);
                $('#numbersArchive').html(response.html);
                $('.statistics-title').html(response.title.text);
                $('.mobile-current-numbers').html(response.mobileNumbers);
                $('#align-circles').bootstrapTable();
            })
        }
    })
});
function searchByDate() {
    // Declare variables
    var input, filter, table, tr, td, i;
    input = document.getElementById("searchByDate");
    filter = input.value.toUpperCase();
    table = document.getElementById("align-circles");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}