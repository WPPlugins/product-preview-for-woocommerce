<?php $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_javascript_settings' ); ?>
<input name="br_product_preview_javascript_settings[settings_name]" type="hidden" value="br_product_preview_javascript_settings">
<table class="form-table">
    <tr>
        <th><?php _e( 'Custom CSS', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <textarea name="br_product_preview_javascript_settings[css]"><?php echo $options['css']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'Before Open', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <textarea name="br_product_preview_javascript_settings[before_open]"><?php echo $options['before_open']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'On Open', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <textarea name="br_product_preview_javascript_settings[on_open]"><?php echo $options['on_open']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'After Close', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <textarea name="br_product_preview_javascript_settings[after_close]"><?php echo $options['after_close']; ?></textarea>
        </td>
    </tr>
</table>