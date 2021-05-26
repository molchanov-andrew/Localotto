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
