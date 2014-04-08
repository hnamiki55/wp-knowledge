<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Skylark
 * @since Skylark 1.6
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of get_custom_header() which was introduced
 * in WordPress 3.4.
 *
 * @uses skylark_header_style()
 * @uses skylark_admin_header_style()
 * @uses skylark_admin_header_image()
 *
 * @package Skylark
 */
function skylark_custom_header_setup() {

	$args = array(
		'width'						=> 920,
		'height'					=> 150,
		'flex-height'				=> true,
		'flex-width'				=> true,
		'default-image'				=> '',
		'default-text-color'		=> 'ffffff',
		'wp-head-callback'			=> 'skylark_header_style',
		'admin-head-callback'		=> 'skylark_admin_header_style',
		'admin-preview-callback'	=> 'skylark_admin_header_image'
	);

	$args = apply_filters( 'skylark_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) :
		// Add support for custom headers.
		add_theme_support( 'custom-header', $args );
	else :
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	endif;

}
add_action( 'after_setup_theme', 'skylark_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress in version 3.4.
 * To provide backward compatibility with previous versions,
 * we will define our own version of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package skylark
 */
if ( ! function_exists( 'get_custom_header' ) ) :
	function get_custom_header() {
		return ( object ) array(
			'url'			=> get_header_image(),
			'thumbnail_url'	=> get_header_image(),
			'width'			=> HEADER_IMAGE_WIDTH,
			'height'		=> HEADER_IMAGE_HEIGHT,
		);
	}
endif;

if ( ! function_exists( 'skylark_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see skylark_custom_header_setup().
 *
 * @since Skylark 1.0.1
 */
function skylark_header_style() {

	// If no custom options for text are set, let's bail
	if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // skylark_header_style

if ( ! function_exists( 'skylark_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see skylark_custom_header_setup().
 *
 * @since skylark 1.0.1
 */
function skylark_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		 background: #4188d4;
		 padding: 1em;
	}
	#headimg {
		text-align: center;
	}
	#headimg h1,
	#desc {
		font-weight: normal;
		text-align: left;
	}
	#headimg h1 {
		font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
		font-size: 30px;
		letter-spacing: -0.015em;
		line-height: 1em;
		margin: 0 0 3px 0;
	}
	#headimg h1 a {
		color: #fff;
		text-decoration: none;
	}
	#desc {
		font-family: 'Open Sans', Helvetica, Arial, sans-serif;
		font-size: 13px;
		font-weight: normal;
		line-height: 1.5em;
		margin-bottom: 20px;
		color: #a7d2ff !important;
	}
	</style>
<?php
}
endif; // skylark_admin_header_style

if ( ! function_exists( 'skylark_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see skylark_custom_header_setup().
 *
 * @since Skylark 1.0.1
 */
function skylark_admin_header_image() { ?>
	<div id="headimg">
		<?php
			$color = get_header_textcolor();
			$image = get_header_image();
			if ( $color && 'blank' != $color )
				$style = ' style="color:#' . $color . '"';
			else
				$style = ' style="display:none"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( ! empty( $image ) ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // skylark_admin_header_image