<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       Spikes Plugin
 * Plugin URI:        https://felixlimburger.de
 * Description:       Das ist ein Plugin für meine Slider und etwas mehr. Mal schauen was passiert.
 * Version:           1.0.1
 * Author:            Felix Limburger
 * Author URI:        https://felixlimburger.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       spikes-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Update Checker
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/puppyspike/spikes-plugin/',
    __FILE__,
    'spikes-plugin'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');


define('SPIKE_VERSION', '1.0.1');
define('SPIKE_SUFFIX', SCRIPT_DEBUG ? '' : '.min');

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

add_action( 'init', 'spike_includes' );
function spike_includes() {

    if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        add_action( 'admin_notices', 'spike_woocommerce_warning' );
    } else if( ! (is_plugin_active( 'gutenberg/gutenberg.php' ) || spike_wp_version('>=', '5.0')) ) {
        add_action( 'admin_notices', 'spike_gutenberg_warning' );
    } else {
        include_once dirname( __FILE__ ) . '/includes/guten-blocks/index.php';
    }
}

function spike_woocommerce_warning() {
    ?>
    <div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">
        <p><?php esc_html_e("Product Blocks for WooCommerce is enabled but not effective. It requires WooCommerce in order to work.", "spike"); ?>.</p>
    </div>
    <?php
}

function spike_gutenberg_warning() {
    ?>

    <div class="message error woocommerce-admin-notice woocommerce-st-inactive woocommerce-not-configured">
        <p><?php esc_html_e("Product Blocks for WooCommerce plugin couldn't find the Block Editor (Gutenberg) on this site. It requires WordPress 5+ or Gutenberg installed as a plugin.", "spike"); ?></p>
    </div>

    <?php
}

function spike_wp_version( $operator = '>', $version = '4.0' ) {
    global $wp_version;
    return version_compare( $wp_version, $version, $operator );
}
