<?php 
global $wp_query, $product;
$product_id = br_wc_get_product_id($product);
$options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_general_settings' );
do_action('br_before_preview_box');
if( $options['style'] == 'clone_from_data' ) {
    echo '<div class="br_product_preview_hidden br_product_preview_hidden_', $product_id, '" style="display:none;" data-html=\'';
} ?>
<div class="br_product_preview_hidden br_product_preview_hidden_<?php echo $product_id; ?>">
    <div class="prev_preview_slide"><span><i class="fa fa-chevron-left"></i></span></div>
    <div class="next_preview_slide"><span><i class="fa fa-chevron-right"></i></span></div>
    <div class="br_product_preview_preview">
        <span class="berocket_preview_close"><i class="fa fa-times"></i></span>
        <div class="berocket_preview_content">
            <?php 
                $element_position = array('image', 'title', 'buttons', 'description', 'meta', 'price');
                foreach($element_position as $el_name) {
                    br_build_preview($el_name);
                }
            ?>
        </div>
    </div>
</div>
<?php if( $options['style'] == 'clone_from_data' ) {
    echo '\'></div>';
}
do_action('br_after_preview_box'); ?>
