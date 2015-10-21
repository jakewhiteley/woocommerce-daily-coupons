<?php

/**
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Daily Coupons
 * Plugin URI:        http://twentyzerotwo.co.uk/wordpress/woocommerce-plugin-daily-coupons
 * Description:       Allows Shop Owners to create or edit existing coupons for WooCommerce that will only work on set days of the week.
 * Version:           1.0.0
 * Author:            TwentyZeroTwo
 * Author URI:        http://twentyzerotwo.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-daily-coupons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-daily-coupons-activator.php
 */
function activate_woocommerce_Daily_coupons() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-daily-coupons-activator.php';
	Woocommerce_Daily_Coupons_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-daily-coupons-deactivator.php
 */
function deactivate_woocommerce_Daily_coupons() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-daily-coupons-deactivator.php';
	Woocommerce_Daily_Coupons_Deactivator::deactivate();

}

register_activation_hook( __FILE__, 'activate_woocommerce_Daily_coupons' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_Daily_coupons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-daily-coupons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_Daily_coupons() {

	$plugin = new Woocommerce_Daily_Coupons();
	$plugin->run();

}
run_woocommerce_Daily_coupons();
