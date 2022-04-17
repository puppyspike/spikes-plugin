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

//require 'plugin-update-checker/plugin-update-checker.php';
//$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
//    'https://dev.felixlimburger.de/updater/plugin.json',
//    __FILE__, //Full path to the main plugin file or functions.php.
//    'spikes-plugin'
//);
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
//define( 'SPIKES_PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-spikes-plugin-activator.php
 */
function activate_spikes_plugin() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-spikes-plugin-activator.php';
    Spikes_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-spikes-plugin-deactivator.php
 */
function deactivate_spikes_plugin() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-spikes-plugin-deactivator.php';
    Spikes_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_spikes_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_spikes_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-spikes-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_spikes_plugin() {

    $plugin = new Spikes_Plugin();
    $plugin->run();

}
run_spikes_plugin();
