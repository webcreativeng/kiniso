<?php

/**
 * Handles All actions related to the plugin activation.
 *
 * @since 1.0
 *
 * Class Kiniso_Activator
 */
class Kiniso_Activator {

	public function kiniso_create_records_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$table_name = $wpdb->prefix . 'kiniso_records';

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) !== $table_name ) {
			$sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        age int(11) NOT NULL,
        PRIMARY KEY  (id)
    	) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

	}
}