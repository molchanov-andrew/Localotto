$(document).ready(function () {
    /* declaring variables for circles */
    var sizes = [146, 75]; // first is big array , second for small arrays
    var empty_fill_color = ['#CAD9E6']; // color of the empty arc
    var thicknes = [25, 12.5];
    // colors for gradient
    var gradient_colors = [
        "#006AA7",
        /*"#4076b2",
         "#4c88c6",
         "#5899da",*/
        "#1AA7EB"
    ];
    var gradient_colors_mobile = [
        '#36827d',
        '#82efea'
    ]
    $('.circle-mobile').circleProgress({
        value: $('.circle-mobile span.total-score').text() / 10,
        size: 146,
        thickness: 25,
        startAngle: -Math.PI / 2,
        emptyFill: empty_fill_color,
        fill: {
            gradient: gradient_colors_mobile
        }
    }).on('circle-animation-progress', function (event, progress, value) {
        $(this).find('.total-score').text(
            ('' + (+value * 10 * progress).toFixed(1))
        );
    });
    // concat to one array of circles
    var circles = Array.prototype.concat(
        $('.circle-score-big'),
        $('.circle-score-small')
    );
    // concat to one array of scores
    var circles_scores = Array.prototype.concat(
        $('.circle-score-big').find('span.total-score'),
        $('.circle-score-small').find('span.total-score')
    );
    /* end of declaring variables */

    /* displaying circles */
    for (var i = 0; i < circles.length; i++) {
        for (var j = 0; j < circles[i].length; j++) {
            $(circles[i][j]).circleProgress({
                value: $(circles_scores[i][j]).text() / 10,
                size: sizes[i],
                thickness: thicknes[i],
                startAngle: -Math.PI / 2,
                emptyFill: empty_fill_color,
                fill: {
                    gradient: gradient_colors
                }
            }).on('circle-animation-progress', function (event, progress, value) {
                $(this).find('.total-score').text(
                    ('' + (+value * 10 * progress).toFixed(1))
                );
            });
        }
    }
    /* end of logic for dispalying circles */
});
$.fn.stars = function (num, sum) {
    var val = null;
    return $(this).each(function () {
        if (num === null && sum === null) {
            val = parseFloat($('.votes-stars').attr('data-marks'));
        } else {
            val = (sum != 0 && num != 0) ? parseFloat(sum / num) : 0;
        }
        var size = Math.max(0, (Math.min(5, val))) * 13;
        var $span = $('<span />').width(size);
        $(this).html($span);
    });
};
$('span.stars').stars(null, null);

function validate(values) {
    var messages = [
        TranslatorJS.messageEmailEmpty,
        TranslatorJS.messageIncorrectEmail,
        TranslatorJS.messageRate
    ];
    var flag = true;
    var count = 0;
    var patterns = [
        /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/
    ];
    var length = values.length - 1;
    for (var i = 0; i < length; i++) {
        if (values[i].val() == "") {
            flag = false;
            values[i].addClass('inputTxtError');
            values[i].parent().append("<label class=\"error\">" + messages[0] + "</label>");
        }
    }
    if (!patterns[0].test(values[1].val()) && values[1].val() != "") {
        values[1].addClass('inputTxtError');
        values[1].parent().append("<label class=\"error\">" + messages[1] + "</label>");
        flag = false;
    }

    length = values[2].length;
    for (var i = 0; i < length; i++) {
        if (values[2][i].checked) {
            count++;
        }
    }
    if (count == 0) {
        flag = false;
        $('#voting-modal .rating').addClass('inputTxtError');
        $('#voting-modal .rating').parent().append("<label class=\"error\">" + messages[2] + "</label>");
    }
    return flag;
}

$(document).ready(function () {
    $("#voting-modal .rating input:radio").attr("checked", false);
    $('#voting-modal .rating input').click(function () {
        $("#voting-modal .rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
    $('#voting-modal .rating input:radio').change(function () {
        userRating = this.value;
    });

    $('#send-vote').click(voteForAgent);
});
var timer = setInterval(function () {
    $('.lotteries').popover({
        html: true,
        trigger: 'manual',
        container: $(this).attr('id'),
        placement: 'bottom',
        content: function () {
            $return = '<div class="hover-hovercard"></div>';
        }
    }).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(this).siblings(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide")
            }
        }, 100);
    });
    $('.popover-toggle').popover();
}, '1000');