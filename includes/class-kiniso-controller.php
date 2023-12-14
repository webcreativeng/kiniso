<?php

class Kiniso_Controller extends WP_REST_Controller {

	public function register_routes() {
		$version = '1';
		$namespace = 'kiniso/v' . $version;
		$base = 'data';

		register_rest_route( $namespace, '/' . $base, array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_kiniso_data' ),
				'permission_callback' => array( $this, 'get_kiniso_data_permissions_check' ),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'insert_data_to_kiniso_table' ),
				'permission_callback' => array( $this, 'insert_kiniso_data_permissions_check' ),
			),
		) );
	}

	public function get_kiniso_data( $request ) {
		$search = $request->get_param( 'search' );
		$data = Kiniso::kiniso_get_records_table_data( $search );
		return rest_ensure_response( $data );
	}

	public function get_kiniso_data_permissions_check() {
		#allow everyone read Records
		return true;
	}

	public function insert_data_to_kiniso_table( $request ) {
		$name = $request->get_param('ks_name');
		$age = $request->get_param('ks_age');
		#sanitize data
		$name = sanitize_text_field( $name );
		$age = sanitize_text_field( $age );

		#Todo: Return Error if name or age is empty or data is of wrong type

		$status = Kiniso::kiniso_insert_data_to_records_table( $name, $age );
		if ( $status === false ) {
			$message = 'Error Inserting Record';
			$code = 400;
		} else {
			$message = 'Record Inserted Successfully';
			$code = 201;
		}
		$response = rest_ensure_response( array( 'status' => (bool)$status, 'message' => $message ) );
		$response->set_status( $code );
		return $response;
	}

	public function insert_kiniso_data_permissions_check() {
		#allow ONLY Admin to add Records
		return true;
//		return current_user_can( 'manage_options' );
	}


}