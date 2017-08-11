<?php
/**
 * Plugin Name: Product Preview for WooCommerce
 * Plugin URI: https://wordpress.org/plugins/product-preview-for-woocommerce/
 * Description: Quick Product Preview for WooCommerce Shop Without Product Page Load
 * Version: 1.0.6
 * Author: BeRocket
 * Requires at least: 4.0
 * Author URI: http://berocket.com
 * Text Domain: BeRocket_Product_Preview_domain
 * Domain Path: /languages/
 */
define( "BeRocket_Product_Preview_version", '1.0.6' );
define( "BeRocket_Product_Preview_domain", 'BeRocket_Product_Preview_domain'); 
define( "Product_Preview_TEMPLATE_PATH", plugin_dir_path( __FILE__ ) . "templates/" );
load_plugin_textdomain('BeRocket_Product_Preview_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
require_once(plugin_dir_path( __FILE__ ).'includes/admin_notices.php');
require_once(plugin_dir_path( __FILE__ ).'includes/functions.php');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Class BeRocket_Compare_Products
 */
class BeRocket_Product_Preview {

    public static $info = array( 
        'id'        => 7,
        'version'   => BeRocket_Product_Preview_version,
        'plugin'    => '',
        'slug'      => '',
        'key'       => '',
        'name'      => ''
    );

    /**
     * Defaults values
     */
    public static $defaults = array(
        'br_product_preview_general_settings'       => array(
            'use'                                       => '1',
            'style'                                     => 'show',
        ),
        'br_product_preview_style_settings'         => array(
            'block'                                     => array(
                'background-color'                          => 'ffffff',
                'border-color'                              => '000000',
                'margin-top'                                => '20',
                'margin-bottom'                             => '20',
                'margin-left'                               => '5%',
                'margin-right'                              => '5%',
                'border-top-width'                          => '0',
                'border-bottom-width'                       => '0',
                'border-left-width'                         => '0',
                'border-right-width'                        => '0',
            ),
            'content'                                   => array(
                'padding-top'                               => '20',
                'padding-bottom'                            => '20',
                'padding-left'                              => '20',
                'padding-right'                             => '20',
            ),
            'text'                                      => array(
                'color'                                     => '000000',
                'font-size'                                 => '1em',
            ),
            'link'                                      => array(
                'color'                                     => '000000',
                'font-size'                                 => '1em',
            ),
            'link_hover'                                => array(
                'color'                                     => '555555',
            ),
            'price'                                     => array(
                'font-size'                                 => '1em',
                'color'                                     => '77a464',
            ),
            'image'                                     => array(
                'width'                                     => '35%',
                'float'                                     => 'left',
            ),
        ),
        'br_product_preview_text_settings'          => array(
            'button_text'                               => 'Quick View',
        ),
        'br_product_preview_javascript_settings'    => array(
            'css'                                       => '',
            'before_open'                               => '',
            'on_open'                                   => '',
            'after_close'                               => '',
        ),
    );
    public static $values = array(
        'settings_name' => '',
        'option_page'   => 'br-product-preview',
        'premium_slug'  => 'woocommerce-product-preview',
    );
    
    function __construct () {

        if ( ( is_plugin_active( 'woocommerce/woocommerce.php' ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) && br_get_woocommerce_version() >= 2.1 ) {
            $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_general_settings' );
            if ( $options['use'] ) {
                add_action ( 'init', array( __CLASS__, 'init' ) );
                add_action ( 'wp_head', array( __CLASS__, 'wp_head_style' ) );
            }
            add_action ( 'admin_init', array( __CLASS__, 'admin_init' ) );
            add_action ( 'admin_menu', array( __CLASS__, 'options' ) );
            add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
            $plugin_base_slug = plugin_basename( __FILE__ );
            add_filter( 'plugin_action_links_' . $plugin_base_slug, array( __CLASS__, 'plugin_action_links' ) );
            add_filter( 'is_berocket_settings_page', array( __CLASS__, 'is_settings_page' ) );
        }
    }
    public static function is_settings_page($settings_page) {
        if( ! empty($_GET['page']) && $_GET['page'] == self::$values[ 'option_page' ] ) {
            $settings_page = true;
        }
        return $settings_page;
    }
    public static function plugin_action_links($links) {
		$action_links = array(
			'settings' => '<a href="' . admin_url( 'admin.php?page='.self::$values['option_page'] ) . '" title="' . __( 'View Plugin Settings', 'BeRocket_products_label_domain' ) . '">' . __( 'Settings', 'BeRocket_products_label_domain' ) . '</a>',
		);
		return array_merge( $action_links, $links );
    }
    public static function plugin_row_meta($links, $file) {
        $plugin_base_slug = plugin_basename( __FILE__ );
        if ( $file == $plugin_base_slug ) {
			$row_meta = array(
				'docs'    => '<a href="http://berocket.com/docs/plugin/'.self::$values['premium_slug'].'" title="' . __( 'View Plugin Documentation', 'BeRocket_products_label_domain' ) . '" target="_blank">' . __( 'Docs', 'BeRocket_products_label_domain' ) . '</a>',
				'premium'    => '<a href="http://berocket.com/product/'.self::$values['premium_slug'].'" title="' . __( 'View Premium Version Page', 'BeRocket_products_label_domain' ) . '" target="_blank">' . __( 'Premium Version', 'BeRocket_products_label_domain' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}
		return (array) $links;
    }

    public static function init () {
        $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_general_settings' );
        wp_register_style( 'font-awesome', plugins_url( 'css/font-awesome.min.css', __FILE__ ) );
        wp_enqueue_style( 'font-awesome' );
        wp_register_style( 'berocket_product_preview_style', plugins_url( 'css/product_preview.css', __FILE__ ), "", BeRocket_Product_Preview_version );
        wp_enqueue_style( 'berocket_product_preview_style' );
        wp_enqueue_script( 'berocket_product_preview_script', plugins_url( 'js/product_preview.js', __FILE__ ), array( 'jquery' ), BeRocket_Product_Preview_version );
        add_filter( 'wc_get_template_part', array( __CLASS__, 'get_preview_box' ), 20, 3);
        add_action ( 'woocommerce_after_shop_loop_item', array( __CLASS__, 'get_preview_button' ), 38 );
        add_action ( 'lgv_advanced_after_add_to_cart', array( __CLASS__, 'get_preview_button' ), 38 );
        $javascript_options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_javascript_settings' );
        wp_localize_script(
            'berocket_product_preview_script',
            'berocket_product_preview',
            array( 
                'style'     => $options['style'],
                'user_func' => apply_filters( 'berocket_pp_user_func', $javascript_options ),
            )
        );
    }

    public static function admin_init () {
        if( @ $_GET['page'] == 'br-product-preview' ) {
            wp_register_style( 'berocket_product_preview_fa_select_style', plugins_url( 'css/select_fa.css', __FILE__ ), "", BeRocket_Product_Preview_version );
            wp_enqueue_style( 'berocket_product_preview_fa_select_style' );
            wp_enqueue_script( 'berocket_product_preview_admin_fa', plugins_url( 'js/admin_select_fa.js', __FILE__ ), array( 'jquery' ), BeRocket_Product_Preview_version );
            wp_enqueue_script( 'berocket_aapf_widget-colorpicker', plugins_url( 'js/colpick.js', __FILE__ ), array( 'jquery' ) );
            wp_enqueue_script( 'berocket_product_preview_admin_script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ) );
            wp_register_style( 'berocket_aapf_widget-colorpicker-style', plugins_url( 'css/colpick.css', __FILE__ ) );
            wp_enqueue_style( 'berocket_aapf_widget-colorpicker-style' );
            wp_register_style( 'berocket_product_preview_admin_style', plugins_url( 'css/admin.css', __FILE__ ), "", BeRocket_Product_Preview_version );
            wp_enqueue_style( 'berocket_product_preview_admin_style' );
            wp_enqueue_script( 'jquery-ui-core', array( 'jquery' ) );
            wp_enqueue_script( 'jquery-ui-sortable', array( 'jquery' ) );
        }
        register_setting('br_product_preview_general_settings', 'br_product_preview_general_settings', array( __CLASS__, 'sanitize_product_preview_option' ));
        register_setting('br_product_preview_style_settings', 'br_product_preview_style_settings', array( __CLASS__, 'sanitize_product_preview_option' ));
        register_setting('br_product_preview_text_settings', 'br_product_preview_text_settings', array( __CLASS__, 'sanitize_product_preview_option' ));
        register_setting('br_product_preview_javascript_settings', 'br_product_preview_javascript_settings', array( __CLASS__, 'sanitize_product_preview_option' ));
        register_setting('br_product_preview_license_settings', 'br_product_preview_license_settings', array( __CLASS__, 'sanitize_product_preview_option' ));
        add_settings_section( 
            'br_product_preview_general_page',
            'General Settings',
            'br_product_preview_general_callback',
            'br_product_preview_general_settings'
        );

        add_settings_section( 
            'br_product_preview_style_page',
            'Style Settings',
            'br_product_preview_style_callback',
            'br_product_preview_style_settings'
        );

        add_settings_section( 
            'br_product_preview_text_page',
            'Text Settings',
            'br_product_preview_text_callback',
            'br_product_preview_text_settings'
        );

        add_settings_section( 
            'br_product_preview_javascript_page',
            'CSS / JavaScript Settings',
            'br_product_preview_javascript_callback',
            'br_product_preview_javascript_settings'
        );

        add_settings_section( 
            'br_product_preview_license_page',
            'License Settings',
            'br_product_preview_license_callback',
            'br_product_preview_license_settings'
        );
    }

    public static function options() {
        add_submenu_page( 'woocommerce', __('Product Preview settings', 'BeRocket_Product_Preview_domain'), __('Product Preview', 'BeRocket_Product_Preview_domain'), 'manage_options', 'br-product-preview', array(
            __CLASS__,
            'option_form'
        ) );
    }
    /**
     * Function add options form to settings page
     *
     * @access public
     *
     * @return void
     */
    public static function option_form() {
        $plugin_info = get_plugin_data(__FILE__, false, true);
        include Product_Preview_TEMPLATE_PATH . "settings.php";
    }
    /**
     * Load template
     *
     * @access public
     *
     * @param string $name template name
     *
     * @return void
     */
    public static function br_get_template_part( $name = '' ) {
        $template = '';

        // Look in your_child_theme/woocommerce-product-preview/name.php
        if ( $name ) {
            $template = locate_template( "woocommerce-product-preview/{$name}.php" );
        }

        // Get default slug-name.php
        if ( ! $template && $name && file_exists( Product_Preview_TEMPLATE_PATH . "{$name}.php" ) ) {
            $template = Product_Preview_TEMPLATE_PATH . "{$name}.php";
        }

        // Allow 3rd party plugin filter template file from their plugin
        $template = apply_filters( 'product_preview_get_template_part', $template, $name );

        if ( $template ) {
            load_template( $template, false );
        }
    }
    public static function get_preview_box($template, $slug, $name) {
        if( $slug == 'content' && $name == 'product' ) {
            global $product, $wp_query;
            $product_id = br_wc_get_product_id($product);
            $options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_general_settings' );
            remove_action ( 'woocommerce_after_shop_loop_item', array( __CLASS__, 'get_preview_button' ), 38 );
            remove_action ( 'lgv_advanced_after_add_to_cart', array( __CLASS__, 'get_preview_button' ), 38 );
            $text_options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_text_settings' );
            echo '<div class="br_product_preview_block br_product_preview_'.$product_id.'" data-id="'.$product_id.'">';
            include Product_Preview_TEMPLATE_PATH . "preview.php";
            echo '</div>';
            add_action ( 'woocommerce_after_shop_loop_item', array( __CLASS__, 'get_preview_button' ), 38 );
            add_action ( 'lgv_advanced_after_add_to_cart', array( __CLASS__, 'get_preview_button' ), 38 );
        }
        return $template;
    }
    public static function get_preview_button() {
        global $product, $wp_query;
        $product_id = br_wc_get_product_id($product);
        $text_options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_text_settings' );
        do_action( 'berocket_pp_before_preview_button' );
        echo '<a data-id="', $product_id, '" class="' . apply_filters( 'berocket_pp_preview_button_classes', 'br_product_preview_button button' ) . '" href="#preview">' . $text_options['button_text'] . '</a>';
        do_action( 'berocket_pp_after_preview_button' );
    }
    public static function sanitize_product_preview_option( $input ) {
        $default = self::$defaults[$input['settings_name']];
        $result = self::recursive_array_set( $default, $input );
        return $result;
    }
    public static function recursive_array_set( $default, $options ) {
        foreach( $default as $key => $value ) {
            if( array_key_exists( $key, $options ) ) {
                if( is_array( $value ) ) {
                    if( is_array( $options[$key] ) ) {
                        $result[$key] = self::recursive_array_set( $value, $options[$key] );
                    } else {
                        $result[$key] = self::recursive_array_set( $value, array() );
                    }
                } else {
                    $result[$key] = $options[$key];
                }
            } else {
                if( is_array( $value ) ) {
                    $result[$key] = self::recursive_array_set( $value, array() );
                } else {
                    $result[$key] = '';
                }
            }
        }
        foreach( $options as $key => $value ) {
            if( ! array_key_exists( $key, $result ) ) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
    public static function get_product_preview_option( $option_name ) {
        $options = get_option( $option_name );
        if ( @ $options && is_array ( $options ) ) {
            $options = array_merge( self::$defaults[$option_name], $options );
        } else {
            $options = self::$defaults[$option_name];
        }
        return $options;
    }
    public static function wp_head_style() {
        $style_options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_style_settings' );
        $javascript_options = BeRocket_Product_Preview::get_product_preview_option ( 'br_product_preview_javascript_settings' );
        echo '<style>';
        echo '.br_product_preview_hidden .br_product_preview_preview{';
        self::array_to_style ( $style_options['block'] );
        echo '}';
        echo '.br_product_preview_hidden .br_product_preview_preview a{';
        self::array_to_style ( $style_options['link'] );
        echo '}';
        echo '.br_product_preview_hidden .br_product_preview_preview a:hover{';
        self::array_to_style ( $style_options['link_hover'] );
        echo '}';
        echo '.br_product_preview_hidden .br_product_preview_preview{';
        self::array_to_style ( $style_options['text'] );
        echo '}';
        echo '.br_product_preview_hidden .br_product_preview_preview .berocket_preview_image{';
        self::array_to_style ( $style_options['image'] );
        echo '}';
        echo '.br_product_preview_hidden .br_product_preview_preview .berocket_preview_price, 
        .br_product_preview_hidden .br_product_preview_preview .berocket_preview_price *{';
        self::array_to_style ( $style_options['price'] );
        echo '}';
        echo '.br_product_preview_hidden .br_product_preview_preview .berocket_preview_content{';
        self::array_to_style ( $style_options['content'] );
        echo '}';
        echo '</style>';
        if ( $javascript_options['css'] ) {
            echo '<style>' . apply_filters( 'berocket_pp_custom_css', $javascript_options['css'] ) . '</style>';
        }
    }
    public static function array_to_style ( $styles ) {
        $color = array( 'color', 'background-color', 'border-color' );
        $size = array( 'border-width', 'border-top-width', 'border-bottom-width', 'border-left-width', 'border-right-width',
            'padding-top', 'padding-bottom', 'padding-left', 'padding-right',
            'border-top-left-radius', 'border-top-right-radius', 'border-bottom-right-radius', 'border-bottom-left-radius',
            'margin-top', 'margin-bottom', 'margin-left', 'margin-right', 'top', 'bottom', 'left', 'right',
            'width', 'height', 'line-height', 'font-size', 'border-radius' );
        foreach( $styles as $name => $value ) {
            if ( isset( $value ) && strlen($value) > 0 ) {
                if ( in_array( $name, $color ) ) {
                    if ( $value[0] != '#' ) {
                        $value = '#' . $value;
                    }
                    echo $name . ':' . $value . '!important;';
                } else if ( in_array( $name, $size ) ) {
                    if ( strpos( $value, '%' ) || strpos( $value, 'em' ) || strpos( $value, 'px' ) ) {
                        echo $name . ':' . $value . '!important;';
                    } else {
                        echo $name . ':' . $value . 'px!important;';
                    }
                } else {
                    echo $name . ':' . $value . '!important;';
                }
            }
        }
    }
}

new BeRocket_Product_Preview;

berocket_admin_notices::generate_subscribe_notice();
new berocket_admin_notices(array(
    'start' => 1498413376, // timestamp when notice start
    'end'   => 1504223940, // timestamp when notice end
    'name'  => 'name', //notice name must be unique for this time period
    'html'  => 'Only <strong>$10</strong> for <strong>Premium</strong> WooCommerce Load More Products plugin!
        <a class="berocket_button" href="http://berocket.com/product/woocommerce-load-more-products" target="_blank">Buy Now</a>
         &nbsp; <span>Get your <strong class="red">50% discount</strong> and save <strong>$10</strong> today</span>
        ', //text or html code as content of notice
    'righthtml'  => '<a class="berocket_no_thanks">No thanks</a>', //content in the right block, this is default value. This html code must be added to all notices
    'rightwidth'  => 80, //width of right content is static and will be as this value. berocket_no_thanks block is 60px and 20px is additional
    'nothankswidth'  => 60, //berocket_no_thanks width. set to 0 if block doesn't uses. Or set to any other value if uses other text inside berocket_no_thanks
    'contentwidth'  => 400, //width that uses for mediaquery is image_width + contentwidth + rightwidth
    'subscribe'  => false, //add subscribe form to the righthtml
    'priority'  => 10, //priority of notice. 1-5 is main priority and displays on settings page always
    'height'  => 50, //height of notice. image will be scaled
    'repeat'  => false, //repeat notice after some time. time can use any values that accept function strtotime
    'repeatcount'  => 1, //repeat count. how many times notice will be displayed after close
    'image'  => array(
        'local' => plugin_dir_url( __FILE__ ) . 'images/ad_white_on_orange.png', //notice will be used this image directly
    ),
));
