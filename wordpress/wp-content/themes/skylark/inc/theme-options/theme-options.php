<?php
/**
 * Skylark Theme Options
 *
 * @package Skylark
 * @since Skylark 1.6
 */

/**
 * Register the form setting for our skylark_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, skylark_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since Skylark 1.0.1
 */
function skylark_theme_options_init() {

	register_setting(
		'skylark_options', // Options group, see settings_fields() call in skylark_theme_options_render_page()
		'skylark_theme_options', // Database option, see skylark_get_theme_options()
		'skylark_theme_options_validate' // The sanitization callback, see skylark_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see skylark_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'intro_text', // Unique identifier for the field for this section
		__( 'Brief introductory message', 'skylark' ), // Setting field label
		'skylark_settings_field_intro_text', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see skylark_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
	add_settings_field( 'primary_category', __( 'Primary Featured Category', 'skylark' ), 'skylark_settings_field_primary_category', 'theme_options', 'general' );
}
add_action( 'admin_init', 'skylark_theme_options_init' );

/**
 * Change the capability required to save the 'skylark_options' options group.
 *
 * @see skylark_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see skylark_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function skylark_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_skylark_options', 'skylark_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since Skylark 1.0.1
 */
function skylark_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'skylark' ),   // Name of page
		__( 'Theme Options', 'skylark' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'skylark_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'skylark_theme_options_add_page' );

// Return an array of all categories (so that the user can pick one to feature on the news template)
function skylark_primary_category() {

	$primary_category = get_categories();

	return apply_filters( 'skylark_primary_category', $primary_category );
}

/**
 * Returns the default options for Skylark 1.0.1.
 */
function skylark_get_default_theme_options() {
	$default_theme_options = array(
		'primary_category' => '1',
		'intro_text' => '',
		);

	return apply_filters( 'skylark_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for Skylark 1.0.1.
 */
function skylark_get_theme_options() {
	return get_option( 'skylark_theme_options', skylark_get_default_theme_options() );
}

/**
 * Renders the introductory message setting
 */
function skylark_settings_field_intro_text() {
	$options = skylark_get_theme_options();
	?>
	<input type="text" name="skylark_theme_options[intro_text]" id="intro-text" value="<?php echo esc_attr( stripslashes ( $options['intro_text'] ) ); ?>" size="50" />
	<label class="description" for="intro-text"><?php _e( 'Appears below the slider on the showcase page template', 'skylark' ); ?></label>
	<?php
}

/**
 * Renders the primary category setting
 */
function skylark_settings_field_primary_category() {
	$options = skylark_get_theme_options();
	?>
	<select name="skylark_theme_options[primary_category]" id="primary-category">
		<?php
			if ( ! isset( $selected ) )
				$selected = '';
			foreach ( skylark_primary_category() as $option ) {
				$selected_option = $options['primary_category'];
				if ( '' != $selected_option ) {
					if ( $options['primary_category'] == $option->term_id ) {
						$selected = "selected=\"selected\"";
					} else {
						$selected = '';
					}
				}
				?>
				<option value="<?php echo $option->term_id; ?>" <?php echo $selected; ?> />
					<?php echo $option->name; ?>
				</option>
			<?php } ?>
	</select>
	<label class="description" for="skylark_theme_options[primary_category]"><?php _e( 'Choose a primary featured category for posts on the Showcase Page template', 'skylark' ); ?></label>
	<?php
}

/**
 * Renders the Theme Options administration screen.
 *
 * @since Skylark 1.0.1
 */
function skylark_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'skylark' ), $theme_name ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'skylark_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see skylark_theme_options_init()
 * @todo set up Reset Options action
 *
 * @param array $input Unknown values.
 * @return array Sanitized theme options ready to be stored in the database.
 *
 * @since Skylark 1.0.1
 */
function skylark_theme_options_validate( $input ) {
		$output = $defaults = skylark_get_default_theme_options();


	// The text input must be safe text with no HTML tags
	if ( isset( $input['intro_text'] ) && ! empty( $input['intro_text'] ) )
		$output['intro_text'] = wp_filter_nohtml_kses( $input['intro_text'] );

	// Set the primary category ID to "1" if the input value is not in the array of categories.
	if ( array_key_exists( $input['primary_category'], skylark_primary_category() ) ) :
		$options['primary_category'] = $input['primary_category'];
	else :
		$options['primary_category'] = 1;
	endif;

	return $input;
}