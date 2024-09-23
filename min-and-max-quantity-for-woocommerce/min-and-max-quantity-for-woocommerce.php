<?php

/**
 * Plugin Name: Minimum and Maximum Quantity for WooCommerce
 * Plugin URI:          https://www.thedotstore.com/
 * Description:         We can set a minimum and maximum allowable product quantity and/or price that can be purchased for each product storewide, or just for an individual product.
 * Version:             1.1.2
 * Author:              theDotstore
 * Author URI:          https://www.thedotstore.com/
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         min-and-max-quantity-for-woocommerce
 * Domain Path:         /languages
 * 
 * WC requires at least: 4.5
 * WP tested up to: 6.5.2
 * WC tested up to: 8.7.0
 * Requires PHP: 7.2
 * Requires at least: 5.0
 *
 */
// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !function_exists( 'mmqw_fs' ) ) {
    // Create a helper function for easy SDK access.
    function mmqw_fs()
    {
        global  $mmqw_fs ;
        
        if ( !isset( $mmqw_fs ) ) {
            // Activate multisite network integration.
            if ( !defined( 'WP_FS__PRODUCT_12041_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_12041_MULTISITE', true );
            }
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $mmqw_fs = fs_dynamic_init( array(
                'id'             => '12041',
                'slug'           => 'min-and-max-quantity-for-woocommerce',
                'type'           => 'plugin',
                'public_key'     => 'pk_b6c4d7923cb624cb7edd66eb23fb6',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'       => 'min-and-max-quantity-for-woocommerce',
                'first-path' => 'admin.php?page=mmqw-rules-list',
                'support'    => false,
            ),
                'is_live'        => true,
            ) );
        }
        
        return $mmqw_fs;
    }
    
    // Init Freemius.
    mmqw_fs();
    // Signal that SDK was initiated.
    do_action( 'mmqw_fs_loaded' );
}

if ( !defined( 'MMQW_PLUGIN_VERSION' ) ) {
    define( 'MMQW_PLUGIN_VERSION', '1.1.2' );
}
if ( !defined( 'MMQW_PLUGIN_URL' ) ) {
    define( 'MMQW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if ( !defined( 'MMQW_PLUGIN_BASENAME' ) ) {
    define( 'MMQW_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( !defined( 'MMQW_PLUGIN_NAME' ) ) {
    define( 'MMQW_PLUGIN_NAME', 'Minimum and Maximum Quantity for WooCommerce' );
}
if ( !defined( 'MMQW_PERTICULAR_FEE_AMOUNT_NOTICE' ) ) {
    define( 'MMQW_PERTICULAR_FEE_AMOUNT_NOTICE', 'You can turn off this button, if you do not need to apply below min max rules.' );
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mmqw-for-woocommerce-activator.php
 */
if ( !function_exists( 'mmqw_activate_for_woocommerce' ) ) {
    function mmqw_activate_for_woocommerce()
    {
        set_transient( 'mmqw-admin-notice', true );
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-mmqw-for-woocommerce-activator.php';
        Min_Max_Quantity_For_WooCommerce_Activator::activate();
        // Set flag for plugin data migration
        add_option( 'mmqw_plugin_data_migrated', 'no' );
    }

}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mmqw-for-woocommerce-deactivator.php
 */
if ( !function_exists( 'mmqw_deactivate_for_woocommerce' ) ) {
    function mmqw_deactivate_for_woocommerce()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-mmqw-for-woocommerce-deactivator.php';
        Min_Max_Quantity_For_WooCommerce_Deactivator::deactivate();
    }

}
register_activation_hook( __FILE__, 'mmqw_activate_for_woocommerce' );
register_deactivation_hook( __FILE__, 'mmqw_deactivate_for_woocommerce' );
add_action( 'admin_init', 'mmqw_deactivate_plugin' );
if ( !function_exists( 'mmqw_deactivate_plugin' ) ) {
    function mmqw_deactivate_plugin()
    {
        if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
            deactivate_plugins( '/minimum-and-maximum-quantity-for-woocommerce/minimum-and-maximum-quantity-for-woocommerce.php', true );
        }
    }

}
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mmqw-for-woocommerce.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'mmqw_run_for_woocommerce' ) ) {
    function mmqw_run_for_woocommerce()
    {
        $plugin = new Min_Max_Quantity_For_WooCommerce();
        $plugin->run();
    }

}
mmqw_run_for_woocommerce();

if ( !function_exists( 'mmqw_plugin_custom_icon_for_freemius' ) ) {
    function mmqw_plugin_custom_icon_for_freemius()
    {
        return dirname( __FILE__ ) . '/images/mmqw-icon-256x256.png';
    }
    
    mmqw_fs()->add_filter( 'plugin_icon', 'mmqw_plugin_custom_icon_for_freemius' );
}

/**
 * Plugin compability with WooCommerce HPOS
 *
 * @since 1.1.2
 */
add_action( 'before_woocommerce_init', function () {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
} );