<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Skylark
 * @since Skylark 1.6
 */
?><!DOCTYPE html>
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'skylark' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action( 'before' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrapper">
			<hgroup>
				<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

			<nav role="navigation" class="site-navigation main-navigation">
				<h1 class="assistive-text"><?php _e( 'Menu', 'skylark' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'skylark' ); ?>"><?php _e( 'Skip to content', 'skylark' ); ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav>

			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<div class="header-image">
					<a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( $header_image ); ?>" alt="<?php esc_attr( bloginfo( 'name' ) ); ?>" /></a>
				</div>
			<?php endif; ?>

		</div><!-- .header-wrapper -->
	</header><!-- .site-header -->

	<?php // Load the slider only on the showcase page template
		if ( is_page_template( 'page-showcase.php' ) ) :
			get_template_part( 'featured-content' ); // Loads the featured-content.php template.
		endif;
	?>

	<div id="page" class="hfeed site">
		<div id="main">