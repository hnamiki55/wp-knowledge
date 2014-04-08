<?php
// Default options values
$sagan_options = array(
	'home_headline' => '',
	'sagan_logo' => '',
	'slider_image_one' => '',
	'slider_image_two' => '',
	'slider_image_three' => '',
	'slider_image_four' => '',
	'slider_image_five' => '',
	'slider_image_caption_one' => '',
	'slider_image_caption_two' => '',
	'slider_image_caption_three' => '',
	'slider_image_caption_four' => '',
	'slider_image_caption_five' => '',
	'slider_image_one_link' => '',
	'slider_image_two_link' => '',
	'slider_image_three_link' => '',
	'slider_image_four_link' => '',
	'slider_image_five_link' => '',
	'orbit_slider' => false,
	'footer_link' => true
);
if ( is_admin() ) : // Load only if we are viewing an admin page
function sagan_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sagan_theme_options', 'sagan_options', 'sagan_validate_options' );
}
add_action( 'admin_init', 'sagan_register_settings' );
function sagan_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'sagan_theme_options_page' );
}
add_action( 'admin_menu', 'sagan_theme_options' );
// Function to generate options page
function sagan_theme_options_page() {
	global $sagan_options, $sagan_categories, $sagan_layouts;
	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>
	<div class="wrap">
	<?php screen_icon(); echo "<h2>" . __( 'Sagan Theme Options', 'sagan' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>
	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php esc_attr_e( 'Options saved' , 'sagan' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>
	<form method="post" action="options.php">
	<?php $settings = get_option( 'sagan_options', $sagan_options ); ?>
	
	<?php settings_fields( 'sagan_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>
	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	<h3><?php esc_attr_e('Orbit Slider Settings' , 'sagan' ); ?></h3>
	<p><?php esc_attr_e('Use up to five images. If you want to use fewer, leave some blank. Images should be 1200 by 400.' , 'sagan'); ?></p>
	<tr valign="top"><th scope="row">Show Orbit Slider</th>
	<td>
	<input type="checkbox" id="orbit_slider" name="sagan_options[orbit_slider]" value="1" <?php checked( true, $settings['orbit_slider'] ); ?> />
	<label for="orbit_slider">Check to enable the home page slider</label>
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_one"><h3>Slide 1</h3></label></th>
	<tr valign="top"><th scope="row"><label for="slider_image_one">Slider Image 1 URL</label></th>
	<td>
	<input id="slider_image_one" name="sagan_options[slider_image_one]" type="url" size="60" value="<?php echo($settings['slider_image_one']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_caption_one">Slider Image 1 Caption</label></th>
	<td>
	<input id="slider_image_caption_one" name="sagan_options[slider_image_caption_one]" type="text" size="60" value="<?php echo($settings['slider_image_caption_one']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_one">Slider Image 1 Link</label></th>
	<td>
	<input id="slider_image_one_link" name="sagan_options[slider_image_one_link]" type="url" size="60" value="<?php echo($settings['slider_image_one_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_two"><h3>Slide 2</h3></label></th>
<tr valign="top"><th scope="row"><label for="slider_image_two">Slider Image 2 URL</label></th>
	<td>
	<input id="slider_image_two" name="sagan_options[slider_image_two]" type="url" size="60" value="<?php echo($settings['slider_image_two']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_caption_two">Slider Image 2 Caption</label></th>
	<td>
	<input id="slider_image_caption_two" name="sagan_options[slider_image_caption_two]" type="text" size="60" value="<?php echo($settings['slider_image_caption_two']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_two_link">Slider Image 2 Link</label></th>
	<td>
	<input id="slider_image_two_link" name="sagan_options[slider_image_two_link]" type="url" size="60" value="<?php echo($settings['slider_image_two_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_three"><h3>Slide 3</h3></label></th>
<tr valign="top"><th scope="row"><label for="slider_image_three">Slider Image 3 URL</label></th>
	<td>
	<input id="slider_image_three" name="sagan_options[slider_image_three]" type="url" size="60" value="<?php echo($settings['slider_image_three']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_caption_three">Slider Image 3 Caption</label></th>
	<td>
	<input id="slider_image_caption_three" name="sagan_options[slider_image_caption_three]" type="text" size="60" value="<?php echo($settings['slider_image_caption_three']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_three_link">Slider Image 3 Link</label></th>
	<td>
	<input id="slider_image_three_link" name="sagan_options[slider_image_three_link]" type="url" size="60" value="<?php echo($settings['slider_image_three_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_four"><h3>Slide 4</h3></label></th>

<tr valign="top"><th scope="row"><label for="slider_image_four">Slider Image 4 URL</label></th>
	<td>
	<input id="slider_image_four" name="sagan_options[slider_image_four]" type="url" size="60" value="<?php echo($settings['slider_image_four']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_caption_four">Slider Image 4 Caption</label></th>
	<td>
	<input id="slider_image_caption_four" name="sagan_options[slider_image_caption_four]" type="text" size="60" value="<?php echo($settings['slider_image_caption_four']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_four_link">Slider Image 4 Link</label></th>
	<td>
	<input id="slider_image_four_link" name="sagan_options[slider_image_four_link]" type="url" size="60" value="<?php echo($settings['slider_image_four_link']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_five"><h3>Slide 5</h3></label></th>
<tr valign="top"><th scope="row"><label for="slider_image_five">Slider Image 5 URL</label></th>
	<td>
	<input id="slider_image_five" name="sagan_options[slider_image_five]" type="url" size="60" value="<?php echo($settings['slider_image_five']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_caption_five">Slider Image 5 Caption</label></th>
	<td>
	<input id="slider_image_caption_five" name="sagan_options[slider_image_caption_five]" type="text" size="60" value="<?php echo($settings['slider_image_caption_five']); ?>" />
	</td>
	</tr>
<tr valign="top"><th scope="row"><label for="slider_image_five_link">Slider Image 5 Link</label></th>
	<td>
	<input id="slider_image_five_link" name="sagan_options[slider_image_five_link]" type="url" size="60" value="<?php echo($settings['slider_image_five_link']); ?>" />
	</td>
	</tr>
	</table>
<table class="form-table">
<h3><?php esc_attr_e('Home Page Headline' , 'sagan' ); ?></h3>
	<p><?php esc_attr_e('This headline will be displayed above the slider on the home page.' , 'sagan'); ?></p>
	<tr valign="top"><th scope="row"><label for="home_headline">Home Page Headline</label></th>
	<td>
	<input id="home_headline" name="sagan_options[home_headline]" type="text" size="40" value="<?php echo($settings['home_headline']); ?>" />
	<label class="description" for="sagan_options[home_headline]"><?php esc_attr_e( 'Leave blank to disable', 'sagan' ); ?></label>
	</td>
	</tr>
</table>
<table class="form-table">
<h3><?php esc_attr_e('Site Logo' , 'sagan' ); ?></h3>
	<p><?php esc_attr_e('Enter the URL for your custom logo here.' , 'sagan'); ?></p>
	<tr valign="top"><th scope="row"><label for="home_headline">Custom Logo</label></th>
	<td>
<input id="sagan_logo" name="sagan_options[sagan_logo]" type="url" size="60" value="<?php echo($settings['sagan_logo']); ?>" />
<label class="description" for="sagan_options[sagan_logo]"><?php esc_attr_e( 'Leave blank to use the site title', 'sagan' ); ?></label>
	</td>
	</tr>
</table>
<table class="form-table">
	<h3><?php esc_attr_e('Footer Link' , 'sagan' ); ?></h3>
	<p><?php esc_attr_e('Disable the footer link.' , 'sagan'); ?></p>
	<tr valign="top"><th scope="row">Footer Credit Link</th>
	<td>
	<input type="checkbox" id="footer_link" name="sagan_options[footer_link]" value="1" <?php checked( true, $settings['footer_link'] ); ?> />
	<label for="footer_link">De-select to remove the footer credit link.</label>
	</td>
	</tr>
</table>
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>
	</form>
<p>
<?php esc_attr_e('Thank you for using Sagan. A lot of time went into development. Donations small or large always appreciated.' , 'sagan'); ?></p>
<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="QD8ECU2CY3N8J">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<a href="http://www.edwardrjenkins.com/themes/sagan/" target="_blank"><?php esc_attr_e('Sagan Documentation' , 'sagan' ); ?></a>
	</div>
	<?php
}
function sagan_validate_options( $input ) {
	global $sagan_options;
	$settings = get_option( 'sagan_options', $sagan_options );
		$input['home_headline'] = esc_attr( $input['home_headline'] );
	$input['sagan_logo'] = esc_url( $input['sagan_logo'] );
	$input['slider_image_one'] = esc_url( $input['slider_image_one'] );
	$input['slider_image_two'] = esc_url( $input['slider_image_two'] );
	$input['slider_image_three'] = esc_url( $input['slider_image_three'] );
	$input['slider_image_four'] = esc_url( $input['slider_image_four'] );
	$input['slider_image_five'] = esc_url( $input['slider_image_five'] );
	$input['slider_image_caption_one'] = esc_attr( $input['slider_image_caption_one'] );
	$input['slider_image_caption_two'] = esc_attr( $input['slider_image_caption_two'] );
	$input['slider_image_caption_three'] = esc_attr( $input['slider_image_caption_three'] );
	$input['slider_image_caption_four'] = esc_attr( $input['slider_image_caption_four'] );
	$input['slider_image_caption_five'] = esc_attr( $input['slider_image_caption_five'] );
	$input['slider_image_one_link'] = esc_url( $input['slider_image_one_link'] );
	$input['slider_image_two_link'] = esc_url( $input['slider_image_two_link'] );
	$input['slider_image_three_link'] = esc_url( $input['slider_image_three_link'] );
	$input['slider_image_four_link'] = esc_url( $input['slider_image_four_link'] );
	$input['slider_image_five_link'] = esc_url( $input['slider_image_five_link'] );
	// If the checkbox has not been checked, we void it
	if ( ! isset( $input['orbit_slider'] ) )
	$input['orbit_slider'] = null;
	// We verify if the input is a boolean value
	$input['orbit_slider'] = ( $input['orbit_slider'] == 1 ? 1 : 0 );
	if ( ! isset( $input['footer_link'] ) )
	$input['footer_link'] = null;
	return $input;
}
endif;  // EndIf is_admin()