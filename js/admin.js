(function ($){
    $(document).ready( function () {
        $('.product_preview_submit_form .colorpicker_field').each(function (i,o){
            $(o).css('backgroundColor', '#'+$(o).data('color'));
            $(o).colpick({
                layout: 'hex',
                submit: 0,
                color: '#'+$(o).data('color'),
                onChange: function(hsb,hex,rgb,el,bySetColor) {
                    $(el).css('backgroundColor', '#'+hex).next().val(hex);
                }
            })
        });
        $(document).on('click', '.theme_default', function() {
            var $colorpick = $(this).prev().prev();
            var color = $colorpick.data('default');
            correct_color = color;
            if( color.length > 0 ) {
                correct_color = "#"+color;
            }
            $colorpick.css('backgroundColor', correct_color).colpickSetColor(correct_color);
            $colorpick.next().val(color);
        });
        $(document).on('click', '.br_default_input', function(event) {
            event.preventDefault();
            var $input = $(this).parents('p').first().find('input, select');
            $input.val($input.data('default'));
        });
        $(document).on('click', '.set_all_to_default', function(event) {
            event.preventDefault();
            var $input = $(this).parent().find('.br_default_input, .theme_default').trigger('click');
        });
    });
})(jQuery);
