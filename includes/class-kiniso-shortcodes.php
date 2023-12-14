<?php

/**
 * Handles All Shortcodes related to the plugin.
 */
class Kiniso_Shortcodes {

	public function kiniso_sc_form() {
		if ( isset( $_POST['ks_name'] ) && isset( $_POST['ks_age'] ) ) {
			$name = sanitize_text_field( $_POST['ks_name'] );
			$age = sanitize_text_field( $_POST['ks_age'] );
			$response = Kiniso::kiniso_insert_data_to_records_table( $name, $age );
		}

		ob_start(); ?>
        <?php if( isset( $response ) && $response ) : ?>
            <p><?php _e( 'Data inserted successfully.', 'kiniso' ); ?></p>
        <?php endif; ?>
		<form method="POST">
			<!--        <label for="ks_name">Name:</label>-->
			<label>
				Name:
				<input type="text" name="ks_name" required>
			</label>
			<!--        <label for="ks_age">Age:</label>-->
			<label>
				Age:
				<input type="number" name="ks_age" required>
			</label>
			<input type="submit" name="submit" value="Submit">
		</form>
		<?php
		return ob_get_clean();
	}

	public function kiniso_sc_list( $attributes ) {
		$attributes = shortcode_atts( array(
			'search' => '',
		), $attributes, 'kiniso_list' );

		$data = Kiniso::kiniso_get_records_table_data( $attributes['search'] );
		ob_start(); ?>
		<h4>List of Kiniso Records</h4>
		<ul>
			<?php foreach ( $data as $row ) : ?>
				<li><?php echo $row->name; ?> - <?php echo $row->age; ?></li>
			<?php endforeach; ?>
		</ul>
		<hr>
		<?php
		return ob_get_clean();

	}

}