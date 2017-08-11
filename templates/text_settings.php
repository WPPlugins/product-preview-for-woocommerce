<?php $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_text_settings' ); ?>
<input name="br_product_preview_text_settings[settings_name]" type="hidden" value="br_product_preview_text_settings">
<table class="form-table">
    <tr>
        <th><?php _e( 'Product preview button', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <input name="br_product_preview_text_settings[button_text]" type='text' value="<?php echo $options['button_text']; ?>"/>
        </td>
    </tr>
</table>