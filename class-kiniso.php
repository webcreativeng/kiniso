<?php

class Kiniso {

	public function init() {
		$kiniso_shortcodes = new Kiniso_Shortcodes();
		add_shortcode( 'kiniso_form', array( $kiniso_shortcodes, 'kiniso_sc_form') );
		add_shortcode( 'kiniso_list', array( $kiniso_shortcodes, 'kiniso_sc_list') );

		// REST API custom endpoints
		add_action( 'rest_api_init', function () {
			$kiniso_controller = new Kiniso_Controller();
			$kiniso_controller->register_routes();
		} );
	}

	public static function kiniso_insert_data_to_records_table( $name, $age ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'kiniso_records';

		return $wpdb->insert(
			$table_name,
			array( 'name' => $name, 'age' => $age ),
			array( '%s', '%d' )
		);
	}

	public static function kiniso_get_records_table_data( $search = '' ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'kiniso_records';

		$query = "SELECT * FROM $table_name";
		if ( ! empty( $search ) ) {
			$query .= $wpdb->prepare( " WHERE name LIKE %s", '%' . $wpdb->esc_like( $search ) . '%' );
		}

		return $wpdb->get_results( $query );

	}
}