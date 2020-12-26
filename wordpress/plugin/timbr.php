<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://app.timbr.io/demo
 * @since             1.0.0
 * @package           Timbr
 *
 * @wordpress-plugin
 * Plugin Name:       Timbr Live Chat
 * Plugin URI:        https://app.timbr.io/demo
 * Description:       This plugin allows you to embed the Timbr chat widget on your website.
 * Version:           1.0.0
 * Author:            Timbr
 * Author URI:        https://timbr.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       timbr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TIMBR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-timbr-activator.php
 */
function activate_timbr() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-timbr-activator.php';
  Timbr_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-timbr-deactivator.php
 */
function deactivate_timbr() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-timbr-deactivator.php';
  Timbr_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_timbr' );
register_deactivation_hook( __FILE__, 'deactivate_timbr' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-timbr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_timbr() {

  $plugin = new Timbr();
  $plugin->run();

}
run_timbr();
