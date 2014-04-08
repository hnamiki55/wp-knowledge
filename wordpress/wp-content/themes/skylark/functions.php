<?php
/**
 * Skylark functions and definitions
 *
 * @package Skylark
 * @since Skylark 1.6
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since skylark 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'skylark_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since skylark 1.0
 */
function skylark_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	require( get_template_directory() . '/inc/wpcom.php' );
	*/

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on skylark, use a find and replace
	 * to change 'skylark' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'skylark', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	// Enable post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'skylark-blog-thumbnail', 664, 170, true );
	add_image_size( 'skylark-featured-thumbnail', 500, 362, true );
	add_image_size( 'skylark-small-thumbnail', 213, 136, true );
	add_image_size( 'skylark-portfolio-thumbnail', 280, 207, true );
	add_image_size( 'skylark-single', 664, 450, true );
	add_image_size( 'skylark-single-full', 920, 450, true );


	add_editor_style();
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skylark' ),
	) );

	/**
	 * Add support for the Image, Gallery, and Video post formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', ) );
}
endif; // skylark_setup
add_action( 'after_setup_theme', 'skylark_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since Skylark 1.0.1
 */
function skylark_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'skylark_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'skylark_register_custom_background' );


/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Skylark 1.0
 */
function skylark_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'skylark' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'skylark_widgets_init' );


/**
 * if lt IE 9
 */
function skylark_head(){
?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
}
add_action( 'wp_head', 'skylark_head');

/**
 * Enqueue scripts and styles
 */
function skylark_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', 'jquery', '20120206', true );

	if ( is_page_template( 'page-showcase.php' ) ) {
		wp_enqueue_script( 'jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.min.js', array( 'jquery' ), '20120419', true );
		wp_enqueue_script( 'skylark-theme', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '20120419', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'skylark_scripts' );

/**
 * Background wrapper style for front-end when a custom background image or color is set
 */
function skylark_custom_background() {

	// Set the default color.
	$background_color = 'ffffff';

	// If background color is specified use that color.
	if ( '' != get_background_color() ) :
		$background_color = get_background_color();
	endif;

	// If a background image is specified, use that image.
	if ( '' != get_background_image() ) :
		$background_image = get_background_image();
	endif;
?>
	<style type="text/css">
		.site {
			background-color: #<?php echo $background_color; ?>
		}
		<?php if ( isset ( $background_image ) ) : ?>
		body {
			background-image: none;
		}
		.site {
			background-image: url(<?php echo $background_image; ?>);
		}
		#main {
			background: #fff;
			margin: 2em auto;
			overflow: hidden;
		}
		#content {
			padding: 2em;
		}
		.page-template-portfolio-php #content {
			padding: 0 2em;
		}
		.page-template-portfolio-php #main .entry-header,
		.page-template-portfolio-php #main .entry-content {
			padding: 2em 2em 0;
		}
		.widget {
			padding: 2em 2em 0 1.313em;
		}
	<?php endif; ?>
	</style>
<?php
}
add_action( 'wp_head', 'skylark_custom_background' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


function skylark_get_featured_posts( $ids = false ) {
	static $featured_ids = array();

	if ( $ids )
		return $featured_ids;

	$sticky = get_option( 'sticky_posts' );
	if ( empty( $sticky ) )
		return array();

	$featured_query = new WP_Query;
	$featured_posts = $featured_query->query( array(
		'post__in'            => $sticky,
		'posts_per_page'      => 10,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => 1
	) );

	if ( ! $featured_posts )
		return array();

	global $post;
	$featured = array();
	foreach ( (array) $featured_posts as $post ) {
		setup_postdata( $post );

		// Featured posts are required to have a featured image.
		if ( '' == get_the_post_thumbnail() )
			continue;

		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'skylark-featured-thumbnail' );

		if ( ! isset( $image[1] ) )
			continue;

		if ( 500 > $image[1] )
			continue;

		$featured[] = $post;
	}

	wp_reset_postdata();

	$featured_ids = wp_list_pluck( $featured, 'ID' );

	return $featured;
}