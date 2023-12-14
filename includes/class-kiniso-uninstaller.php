<?php

/**
 * Fired during plugin Uninstall
 * Handles All actions related to the plugin deletion after deactivation.
 *
 * @since 1.0
 *
 * @package Kiniso
 */
class Kiniso_Uninstaller {

	public function kiniso_remove_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'kiniso_records';
		$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

	}

}