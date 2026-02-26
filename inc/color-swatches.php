<?php
/**
 * Color Swatches Management
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Hex Color field to pa_color taxonomy
 */
function emerald_add_color_hex_field() {
	?>
	<div class="form-field term-color-wrap">
		<label for="term-color-hex"><?php _e( 'Hex Color', 'emerald' ); ?></label>
		<input type="text" name="term_color_hex" id="term-color-hex" value="" class="emerald-color-picker" data-default-color="#ffffff" />
		<p class="description"><?php _e( 'Enter the hex color code (e.g. #D4AF37) for this swatch.', 'emerald' ); ?></p>
	</div>
	<?php
}
add_action( 'pa_color_add_form_fields', 'emerald_add_color_hex_field', 10 );

/**
 * Edit Hex Color field
 */
function emerald_edit_color_hex_field( $term ) {
	$color_hex = get_term_meta( $term->term_id, 'emerald_color_hex', true );
	?>
	<tr class="form-field term-color-wrap">
		<th scope="row"><label for="term-color-hex"><?php _e( 'Hex Color', 'emerald' ); ?></label></th>
		<td>
			<input type="text" name="term_color_hex" id="term-color-hex" value="<?php echo esc_attr( $color_hex ); ?>" class="emerald-color-picker" data-default-color="#ffffff" />
			<p class="description"><?php _e( 'Enter the hex color code (e.g. #D4AF37) for this swatch.', 'emerald' ); ?></p>
		</td>
	</tr>
	<?php
}
add_action( 'pa_color_edit_form_fields', 'emerald_edit_color_hex_field', 10 );

/**
 * Save Hex Color field
 */
function emerald_save_color_hex_field( $term_id ) {
	if ( isset( $_POST['term_color_hex'] ) ) {
		update_term_meta( $term_id, 'emerald_color_hex', sanitize_hex_color( $_POST['term_color_hex'] ) );
	}
}
add_action( 'edited_pa_color', 'emerald_save_color_hex_field', 10 );
add_action( 'create_pa_color', 'emerald_save_color_hex_field', 10 );

/**
 * Enqueue scripts for color picker in admin
 */
function emerald_admin_color_picker_scripts( $hook ) {
	if ( 'edit-tags.php' !== $hook && 'term.php' !== $hook ) {
		return;
	}

	$screen = get_current_screen();
	if ( is_object( $screen ) && 'pa_color' === $screen->taxonomy ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'emerald-admin-js', get_template_directory_uri() . '/assets/js/admin.js', array( 'wp-color-picker' ), EMERALD_VERSION, true );
	}
}
add_action( 'admin_enqueue_scripts', 'emerald_admin_color_picker_scripts' );
