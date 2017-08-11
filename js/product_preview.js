(function ($){
    $(document).ready( function () {
        var $current_object = false;
        var $cloned_object = false;
        var already_sliding = false;
        $(document).on( 'click', '.br_product_preview_button', function ( event ) {
            event.preventDefault();
            var preview_id = $(this).data('id');
            show_preview( $('.br_product_preview_hidden_'+preview_id) );
        });
        $(document).on( 'click', '.berocket_preview_close', function ( event ) {
            event.preventDefault();
            hide_preview ( $(this).parents('.br_product_preview_hidden') );
            already_sliding = false;
        });
        $(document).on( 'click', '.br_product_preview_hidden', function ( event ) {
            event.preventDefault();
            hide_preview ( $(this) );
            already_sliding = false;
        });
        function show_preview( $hidden ) {
            product_preview_execute_func ( berocket_product_preview.user_func.before_open );
            var $original = $hidden;
            if ( berocket_product_preview.style == 'show' ) {
                $hidden.show();
            } else if ( berocket_product_preview.style == 'clone' ) {
                $current_object = $hidden;
                $hidden = $hidden.clone().appendTo('body').show();
                $cloned_object = $hidden;
            } else if ( berocket_product_preview.style == 'clone_from_data' ) {
                $current_object = $hidden;
                $hidden = $($hidden.data('html')).appendTo('body').show();
                $cloned_object = $hidden;
            }
            product_preview_execute_func ( berocket_product_preview.user_func.on_open );
            return $hidden;
        }
        function hide_preview( $hidden ) {
            $hidden.find('.prev_preview_slide').show();
            $hidden.find('.next_preview_slide').show();
            if ( berocket_product_preview.style == 'show' ) {
                $hidden.hide();
            } else if ( berocket_product_preview.style == 'clone' ) {
                $hidden.remove();
            } else if ( berocket_product_preview.style == 'clone_from_data' ) {
                $hidden.remove();
            }
            product_preview_execute_func ( berocket_product_preview.user_func.after_close );
        }
        $(document).on( 'click', '.br_product_preview_preview', function ( event ) {
            event.stopPropagation();
        });
    });
})(jQuery);
function product_preview_execute_func ( func ) {
    if( berocket_product_preview.user_func != 'undefined'
        && berocket_product_preview.user_func != null
        && typeof func != 'undefined' 
        && func.length > 0 ) {
        try{
            eval( func );
        } catch(err){
            alert('You have some incorrect JavaScript code (Product Preview)');
        }
    }
}