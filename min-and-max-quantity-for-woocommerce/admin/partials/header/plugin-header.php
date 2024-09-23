<?php

/**
 * If this file is called directly, abort.
 * 
 * @category HeaderTemplate
 * @package  MinimumMaximumQuantity
 * @author   theDotstore <support@thedotstore.com>
 * @license  GPL-2.0+ (http://www.gnu.org/licenses/gpl-2.0.txt)
 * @link     https://www.thedotstore.com/
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$version_label = '';
$version_label = __( 'Free', 'min-and-max-quantity-for-woocommerce' );
global  $mmqw_fs ;
$plugin_name = 'Min/Max Quantity';
$plugin_version = 'v' . MMQW_PLUGIN_VERSION;
$current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
$min_max_rules_list = ( isset( $current_page ) && 'mmqw-rules-list' === $current_page ? 'active' : '' );
$min_max_checkout_settings = ( isset( $current_page ) && ('mmqw-checkout-settings' === $current_page || 'mmqw-get-started' === $current_page || 'mmqw-information' === $current_page || 'mmqw-manage-messages' === $current_page) ? 'active' : '' );
$min_max_general_settings = ( isset( $current_page ) && 'mmqw-checkout-settings' === $current_page ? 'active' : '' );
$min_max_get_started = ( isset( $current_page ) && 'mmqw-get-started' === $current_page ? 'active' : '' );
$min_max_information = ( isset( $current_page ) && 'mmqw-information' === $current_page ? 'active' : '' );
$mmqw_manage_messages = ( isset( $current_page ) && 'mmqw-manage-messages' === $current_page ? 'active' : '' );
$mmqw_display_submenu = ( !empty($min_max_checkout_settings) && 'active' === $min_max_checkout_settings ? 'display:inline-block' : 'display:none' );
?>
<div id="dotsstoremain">
    <div class="all-pad">
        <hr class="wp-header-end" />
        <header class="dots-header">
            <div class="dots-plugin-details">
                <div class="dots-header-left">
                    <div class="dots-logo-main">
                        <img src="<?php 
echo  esc_url( MMQW_PLUGIN_URL . 'admin/images/min-max-logo.png' ) ;
?>">
                    </div>
                    <div class="plugin-name">
                        <div class="title"><?php 
esc_html_e( $plugin_name, 'min-and-max-quantity-for-woocommerce' );
?></div>
                    </div>
                    <span class="version-label"><?php 
esc_html_e( $version_label, 'min-and-max-quantity-for-woocommerce' );
?></span>
                    <span class="version-number"><?php 
echo  esc_html__( $plugin_version, 'min-and-max-quantity-for-woocommerce' ) ;
?></span>
                </div>
                <div class="dots-header-right">
                	<div class="button-dots">
                        <a target="_blank" href="<?php 
echo  esc_url( 'https://docs.thedotstore.com/category/709-premium-plugin-settings' ) ;
?>"><?php 
esc_html_e( 'Help', 'min-and-max-quantity-for-woocommerce' );
?></a>
                    </div>
                    <div class="button-dots">
                        <a target="_blank" href="<?php 
echo  esc_url( 'http://www.thedotstore.com/support/' ) ;
?>"><?php 
esc_html_e( 'Contact', 'min-and-max-quantity-for-woocommerce' );
?></a>
                    </div>
                    <!-- <div class="button-dots">
                        <?php 
?>
                            <a target="_blank" href="<?php 
echo  esc_url( $mmqw_fs->get_upgrade_url() ) ;
?>"><?php 
esc_html_e( 'Upgrade To Pro', 'min-and-max-quantity-for-woocommerce' );
?></a>
                            <?php 
?>
                    </div> -->
                </div>
            </div>
            <div class="dots-menu-main">
                <nav>
                    <ul>
                        <li>
                            <a class="dotstore_plugin <?php 
echo  esc_attr( $min_max_rules_list ) ;
?>" href="<?php 
echo  esc_url( add_query_arg( array(
    'page' => 'mmqw-rules-list',
), admin_url( 'admin.php' ) ) ) ;
?>"><?php 
esc_html_e( 'Manage Rules', 'min-and-max-quantity-for-woocommerce' );
?></a>
                        </li>
                        <li>
                            <a class="dotstore_plugin <?php 
echo  esc_attr( $min_max_checkout_settings ) ;
?>" href="<?php 
echo  esc_url( add_query_arg( array(
    'page' => 'mmqw-checkout-settings',
), admin_url( 'admin.php' ) ) ) ;
?>"><?php 
esc_html_e( 'Settings', 'min-and-max-quantity-for-woocommerce' );
?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="dots-settings-inner-main">
            <div class="mmqw-section-left">
                <div class="dotstore-submenu-items" style="<?php 
echo  esc_attr( $mmqw_display_submenu ) ;
?>">
                    <ul>
                        <li><a class="<?php 
echo  esc_attr( $min_max_general_settings ) ;
?>" href="<?php 
echo  esc_url( add_query_arg( array(
    'page' => 'mmqw-checkout-settings',
), admin_url( 'admin.php' ) ) ) ;
?>"><?php 
esc_html_e( 'General', 'min-and-max-quantity-for-woocommerce' );
?></a></li>
                        <li><a class="<?php 
echo  esc_attr( $mmqw_manage_messages ) ;
?>" href="<?php 
echo  esc_url( add_query_arg( array(
    'page' => 'mmqw-manage-messages',
), admin_url( 'admin.php' ) ) ) ;
?>"><?php 
esc_html_e( 'Messages', 'min-and-max-quantity-for-woocommerce' );
?></a></li>
                        <li><a class="<?php 
echo  esc_attr( $min_max_get_started ) ;
?>" href="<?php 
echo  esc_url( add_query_arg( array(
    'page' => 'mmqw-get-started',
), admin_url( 'admin.php' ) ) ) ;
?>"><?php 
esc_html_e( 'About', 'min-and-max-quantity-for-woocommerce' );
?></a></li>
                        <li><a class="<?php 
echo  esc_attr( $min_max_information ) ;
?>" href="<?php 
echo  esc_url( add_query_arg( array(
    'page' => 'mmqw-information',
), admin_url( 'admin.php' ) ) ) ;
?>"><?php 
esc_html_e( 'Quick info', 'min-and-max-quantity-for-woocommerce' );
?></a></li>
                    </ul>
                </div>