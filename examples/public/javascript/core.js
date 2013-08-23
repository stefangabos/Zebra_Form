$(document).ready(function() {

    hljs.initHighlightingOnLoad();

    $('a').bind('click', function() { this.blur() });

    var tab_selectors = $('.tabs a');

    var tabs = $('.tab');

    tab_selectors.each(function(index, selector) {
        $(selector).bind('click', function(e) {
            e.preventDefault();
            tab_selectors.removeClass('selected');
            $(this).addClass('selected');
            tabs.css('display', 'none');
            $(tabs[index]).css({
                'opacity':  0,
                'display': 'block'
            });
            $(tabs[index]).animate({'opacity': 1}, 250);
        });
    });

});