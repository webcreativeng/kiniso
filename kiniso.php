<?php

/*
Plugin Name: Kiniso
Plugin URI: https://www.linkedin.com/in/oluwasegunoderinde/
Description: A Plugin that does Something awesome.
Version: 1.0
Author: Victor
Author URI: https://www.linkedin.com/in/oluwasegunoderinde/
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: kiniso
Domain Path: /languages
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . '/class-kiniso.php' );

require_once( plugin_dir_path( __FILE__ ) . '/includes/class-kiniso-controller.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/class-kiniso-shortcodes.php' );

require_once( plugin_dir_path( __FILE__ ) . '/includes/class-kiniso-activator.php' );
require_once( plugin_dir_path( __FILE__ ) . '/includes/class-kiniso-uninstaller.php' );

// Ensure the custom table is created on plugin activation and deleted on plugin uninstall
register_activation_hook( __FILE__, 'kiniso_activate' );
register_uninstall_hook( __FILE__, 'kiniso_uninstall' );

function kiniso_activate() {
    $activator = new Kiniso_Activator();
    $activator->kiniso_create_records_table();
}

function kiniso_uninstall() {
	$uninstaller = new Kiniso_Uninstaller();
	$uninstaller->kiniso_remove_table();
}

// Initialize the plugin
$kiniso = new Kiniso();
add_action( 'init', array( $kiniso, 'init') );
