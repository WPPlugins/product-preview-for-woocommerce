<div class="wrap">
<?php 
$dplugin_name = 'WooCommerce Product Preview';
$dplugin_link = 'http://berocket.com/product/woocommerce-product-preview';
$dplugin_price = 18;
$dplugin_desc = '';
@ include 'settings_head.php';
@ include 'discount.php';
?>
<div class="wrap show_premium">  
    <div id="icon-themes" class="icon32"></div>  
    <h2>Product Preview Settings</h2>  
    <?php settings_errors(); ?>  

    <?php $active_tab = isset( $_GET[ 'tab' ] ) ? @ $_GET[ 'tab' ] : 'general'; ?>  

    <h2 class="nav-tab-wrapper">  
        <a href="?page=br-product-preview&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>"><?php _e('General', 'BeRocket_Product_Preview_domain') ?></a>
        <a href="?page=br-product-preview&tab=style" class="nav-tab <?php echo $active_tab == 'style' ? 'nav-tab-active' : ''; ?>"><?php _e('Style', 'BeRocket_Product_Preview_domain') ?></a>
        <a href="?page=br-product-preview&tab=text" class="nav-tab <?php echo $active_tab == 'text' ? 'nav-tab-active' : ''; ?>"><?php _e('Text', 'BeRocket_Product_Preview_domain') ?></a>
        <a href="?page=br-product-preview&tab=javascript" class="nav-tab <?php echo $active_tab == 'javascript' ? 'nav-tab-active' : ''; ?>"><?php _e('CSS / JavaScript', 'BeRocket_Product_Preview_domain') ?></a>
    </h2>  

    <form class="product_preview_submit_form" method="post" action="options.php">  
        <?php 
        if( $active_tab == 'general' ) { 
            settings_fields( 'br_product_preview_general_settings' );
            do_settings_sections( 'br_product_preview_general_settings' );
        } else if( $active_tab == 'style' ) {
            settings_fields( 'br_product_preview_style_settings' );
            do_settings_sections( 'br_product_preview_style_settings' ); 
        } else if( $active_tab == 'text' ) {
            settings_fields( 'br_product_preview_text_settings' );
            do_settings_sections( 'br_product_preview_text_settings' ); 
        } else if( $active_tab == 'javascript' ) {
            settings_fields( 'br_product_preview_javascript_settings' );
            do_settings_sections( 'br_product_preview_javascript_settings' ); 
        }
        ?>             
        <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'BeRocket_Product_Preview_domain') ?>" />
    </form> 
</div>
<?php
$feature_list = array(
    'Custom Image Position on Product Preview',
    'Custom Colors and Sizes for text',
    'Slider to change product to next or previous',
    'All product images on Preview Window',
    'Custom position for elements on Preview Window',
    'Custom position for Quick View buttons',
);
@ include 'settings_footer.php';
?>
</div>
