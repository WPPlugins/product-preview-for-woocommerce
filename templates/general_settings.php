<?php $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_general_settings' ); ?>
<input name="br_product_preview_general_settings[settings_name]" type="hidden" value="br_product_preview_general_settings">
<table class="form-table">
    <tr>
        <th><?php _e( 'Use quick view', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <input name="br_product_preview_general_settings[use]" type='checkbox' value="1"<?php if ( $options['use'] ) echo ' checked'; ?>>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'Display style', 'BeRocket_Product_Preview_domain' ) ?></th>
        <td>
            <select name="br_product_preview_general_settings[style]">
                <option value="show"<?php if ( $options['style'] == 'show' ) echo ' selected'; ?>><?php _e( 'Show/Hide', 'BeRocket_Product_Preview_domain' ) ?></option>
                <option value="clone"<?php if ( $options['style'] == 'clone' ) echo ' selected'; ?>><?php _e( 'Clone', 'BeRocket_Product_Preview_domain' ) ?></option>
                <option value="clone_from_data"<?php if ( $options['style'] == 'clone_from_data' ) echo ' selected'; ?>><?php _e( 'Clone from data', 'BeRocket_Product_Preview_domain' ) ?></option>
            </select>
        </td>
    </tr>
</table>