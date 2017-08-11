<?php $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_style_settings' );
$default = BeRocket_Product_Preview::$defaults['br_product_preview_style_settings'] ?>
<input name="br_product_preview_style_settings[settings_name]" type="hidden" value="br_product_preview_style_settings">
<table class="form-table">
</table>
<table class="berocket_pagination_style berocket_pp_styles">
    <tr>
        <td colspan="4"><h3><?php _e( 'Preview style', 'BeRocket_Product_Preview_domain' ) ?></h3></td>
    </tr>
    <tr>
        <td colspan="4"><h4><?php _e( 'Color', 'BeRocket_Product_Preview_domain' ) ?></h4></td>
    </tr>
    <tr>
        <th><?php _e( 'Background color', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Border color', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Text color', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Link color', 'BeRocket_Product_Preview_domain' ) ?></th>
    </tr>
    <tr>
        <td>
            <div class="colorpicker_field" data-default="<?php echo $default['block']['background-color']; ?>" data-color="<?php echo ( $options['block']['background-color'] ) ? $options['block']['background-color'] : '000000' ?>"></div>
            <input type="hidden" value="<?php echo ( $options['block']['background-color'] ) ? $options['block']['background-color'] : '' ?>" name="br_product_preview_style_settings[block][background-color]" />
            <input type="button" value="<?php _e('Default', 'BeRocket_Product_Preview_domain') ?>" class="theme_default button">
        </td>
        <td>
            <div class="colorpicker_field" data-default="<?php echo $default['block']['border-color']; ?>" data-color="<?php echo ( $options['block']['border-color'] ) ? $options['block']['border-color'] : '000000' ?>"></div>
            <input type="hidden" value="<?php echo ( $options['block']['border-color'] ) ? $options['block']['border-color'] : '' ?>" name="br_product_preview_style_settings[block][border-color]" />
            <input type="button" value="<?php _e('Default', 'BeRocket_Product_Preview_domain') ?>" class="theme_default button">
        </td>
        <td>
            <div class="colorpicker_field" data-default="<?php echo $default['text']['color']; ?>" data-color="<?php echo ( $options['text']['color'] ) ? $options['text']['color'] : '000000' ?>"></div>
            <input type="hidden" value="<?php echo ( $options['text']['color'] ) ? $options['text']['color'] : '' ?>" name="br_product_preview_style_settings[text][color]" />
            <input type="button" value="<?php _e('Default', 'BeRocket_Product_Preview_domain') ?>" class="theme_default button">
        </td>
        <td>
            <div class="colorpicker_field" data-default="<?php echo $default['link']['color']; ?>" data-color="<?php echo ( $options['link']['color'] ) ? $options['link']['color'] : '000000' ?>"></div>
            <input type="hidden" value="<?php echo ( $options['link']['color'] ) ? $options['link']['color'] : '' ?>" name="br_product_preview_style_settings[link][color]" />
            <input type="button" value="<?php _e('Default', 'BeRocket_Product_Preview_domain') ?>" class="theme_default button">
        </td>
    </tr>
    <tr>
        <th><?php _e( 'Link color when mouse over', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Price color', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th colspan=2></th>
    </tr>
    <tr>
        <td>
            <div class="colorpicker_field" data-default="<?php echo $default['link_hover']['color']; ?>" data-color="<?php echo ( $options['link_hover']['color'] ) ? $options['link_hover']['color'] : '000000' ?>"></div>
            <input type="hidden" value="<?php echo ( $options['link_hover']['color'] ) ? $options['link_hover']['color'] : '' ?>" name="br_product_preview_style_settings[link_hover][color]" />
            <input type="button" value="<?php _e('Default', 'BeRocket_Product_Preview_domain') ?>" class="theme_default button">
        </td>
        <td>
            <div class="colorpicker_field" data-default="<?php echo $default['price']['color']; ?>" data-color="<?php echo ( $options['price']['color'] ) ? $options['price']['color'] : '000000' ?>"></div>
            <input type="hidden" value="<?php echo ( $options['price']['color'] ) ? $options['price']['color'] : '' ?>" name="br_product_preview_style_settings[price][color]" />
            <input type="button" value="<?php _e('Default', 'BeRocket_Product_Preview_domain') ?>" class="theme_default button">
        </td>
        <td colspan=2></td>
    </tr>
    <tr>
        <td colspan="4"><h4><?php _e( 'Size', 'BeRocket_Product_Preview_domain' ) ?></h4></td>
    </tr>
    <tr>
        <th><?php _e( 'Size', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Padding around preview', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Padding from border to text inside', 'BeRocket_Product_Preview_domain' ) ?></th>
        <th><?php _e( 'Border around preview', 'BeRocket_Product_Preview_domain' ) ?></th>
    </tr>
    <tr>
        <td>
            <p><?php _e( 'Text', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[text][font-size]" data-default="<?php echo $default['text']['font-size']; ?>" type="text" value="<?php echo $options['text']['font-size']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Link', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[link][font-size]" data-default="<?php echo $default['link']['font-size']; ?>" type="text" value="<?php echo $options['link']['font-size']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Price', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[price][font-size]" data-default="<?php echo $default['price']['font-size']; ?>" type="text" value="<?php echo $options['price']['font-size']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Image width', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[image][width]" data-default="<?php echo $default['image']['width']; ?>" type="text" value="<?php echo $options['image']['width']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Image position', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <select name="br_product_preview_style_settings[image][float]" data-default="<?php echo $default['image']['float']; ?>">
                <option value="none"<?php if ( ! $options['image']['float'] || $options['image']['float'] == 'none' ) { echo ' selected'; } ?> ><?php _e( 'NONE', 'BeRocket_Product_Preview_domain' ) ?></option>
                <option value="left"<?php if ( $options['image']['float'] == 'left' ) { echo ' selected'; } ?> ><?php _e( 'Left', 'BeRocket_Product_Preview_domain' ) ?></option>
                <option value="right"<?php if ( $options['image']['float'] == 'right' ) { echo ' selected'; } ?> ><?php _e( 'Right', 'BeRocket_Product_Preview_domain' ) ?></option>
            </select>
            <a class="button br_default_input" href="#default">Default</a>
            </p>
        </td>
        <td>
            <p><?php _e( 'Top', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][margin-top]" data-default="<?php echo $default['block']['margin-top']; ?>" type="text" value="<?php echo $options['block']['margin-top']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Bottom', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][margin-bottom]" data-default="<?php echo $default['block']['margin-bottom']; ?>" type="text" value="<?php echo $options['block']['margin-bottom']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Left', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][margin-left]" data-default="<?php echo $default['block']['margin-left']; ?>" type="text" value="<?php echo $options['block']['margin-left']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Right', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][margin-right]" data-default="<?php echo $default['block']['margin-right']; ?>" type="text" value="<?php echo $options['block']['margin-right']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
        </td>
        <td>
            <p><?php _e( 'Top', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[content][padding-top]" data-default="<?php echo $default['content']['padding-top']; ?>" type="text" value="<?php echo $options['content']['padding-top']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Bottom', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[content][padding-bottom]" data-default="<?php echo $default['content']['padding-bottom']; ?>" type="text" value="<?php echo $options['content']['padding-bottom']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Left', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[content][padding-left]" data-default="<?php echo $default['content']['padding-left']; ?>" type="text" value="<?php echo $options['content']['padding-left']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Right', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[content][padding-right]" data-default="<?php echo $default['content']['padding-right']; ?>" type="text" value="<?php echo $options['content']['padding-right']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
        </td>
        <td>
            <p><?php _e( 'Top', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][border-top-width]" data-default="<?php echo $default['block']['border-top-width']; ?>" type="text" value="<?php echo $options['block']['border-top-width']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Bottom', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][border-bottom-width]" data-default="<?php echo $default['block']['border-bottom-width']; ?>" type="text" value="<?php echo $options['block']['border-bottom-width']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Left', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][border-left-width]" data-default="<?php echo $default['block']['border-left-width']; ?>" type="text" value="<?php echo $options['block']['border-left-width']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
            <p><?php _e( 'Right', 'BeRocket_Product_Preview_domain' ) ?></p>
            <p>
            <input name="br_product_preview_style_settings[block][border-right-width]" data-default="<?php echo $default['block']['border-right-width']; ?>" type="text" value="<?php echo $options['block']['border-right-width']; ?>">
            <a class="button br_default_input" href="#default">Default</a>
            </p>
        </td>
    </tr>
</table>
<a class="button set_all_to_default">Set all to default</a>
