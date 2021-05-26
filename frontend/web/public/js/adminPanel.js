$(document).ready(function(){
    var hidden;
    $('#main-block').on('click', '.delete-voter', function(){
        if(confirm("Do you want to delete this record?")) {
            var delete_row = $(this).parent().parent();
            $.post('/removeVoter', {id: $(this).attr("data-voter-id")}, function(){
                delete_row.remove();
            });
        }
    });

    $('body').on("click", ".edit-votes", function(){
        hideModal('show');
        hidden = $('#main-block').find($('#hidden-broker-id'));
        hidden.val($(this).attr("data-voter-id"));
    });

    $('#main-block').on('click', '#updateVotes', function(){
        if(confirm("Do you want to change results?")) {
            var count = $('#main-block').find($('#num_votes'));
            var sum = $('#main-block').find($('#sum_marks'));
            if(validate([count, sum]) && count.val() != "" && sum.val() != "") {
                $.post('/updateVotes', {id: hidden.val(), sum: count.val(), count: sum.val()}, function(){
                    hideModal('hide');
                });
            } else {
                alert('Fields must not be empty. Only numbers are allowed.');
            }
        }
    });

    function validate(input) {
        pattern = /[0-9]+/;
        for (var i = 0; i < input.length; i++) {
            console.log(input[i].val());
            if(pattern.test(input[i].val()) === false) {
                return false;
            }
        }
        return true;
    }

    function hideModal(action) {
        if(action == 'show') {
            $('body').modal('toggle').on('hidden.bs.modal', function() {
                $(this).css({display: "block", padding: 0});
            });
        } else {
            $('#editMarksAndVotes').modal('hide');
            $('body').modal('hide').on('hidden.bs.modal', function() {
                $(this).css({display: "block", padding: 0});
            });
        }
    }
});
