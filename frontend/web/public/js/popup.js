$('document').ready(function() {
    var show_pop = $.cookie('show_pop');
    if (show_pop == null) {
            $('#simPopUp').modal();
            $.cookie("show_pop", null);
            $.cookie('show_pop', 1);
    }
});