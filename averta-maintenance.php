<?php

/**
 * @link              http://averta.net
 * @since             1.0.0
 * @package           averta-maintenance
 *
 * @wordpress-plugin
 * Plugin Name:       averta maintenance 
 * Description:       Creative Comming Soon And Maintenace Page For Wordpress With Usefull Options.
 * Version:           1.0.0
 * Author:            Averta
 * Author URI:        http://averta.net.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       avla_maint
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Define Some Var
 */
define( 'AVMA_VER', '1.0.0' );
define( 'AVMA_DIR', plugin_dir_path(  __FILE__  ));
define( 'AVMA_URL', plugins_url( '' , __FILE__ ));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_avma-maintenance' );
register_deactivation_hook( __FILE__, 'deactivate_avma-maintenance' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-avma-maintenance.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Avma_maintenance() {

	$plugin = new Avma_maintenance();
	$plugin->run();

}
run_Avma_maintenance();
