<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo('charset'); ?>" />

<meta name="viewport" content="width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <!-- Header and Nav -->

  <div class="row">

	<div class="six columns">

<?php global $sagan_options; $sagan_settings = get_option( 'sagan_options', $sagan_options ); ?>

<?php if ( $sagan_settings['sagan_logo'] !='' ) { ?>

				<div id="logo">

<a href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

<img src="<?php echo $sagan_settings['sagan_logo']; ?>" /></a>

				</div>

<?php } ?>

<?php if ( $sagan_settings['sagan_logo'] == '' ) { ?>

				<div id="logo">

<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

<h3><?php echo bloginfo ('name'); ?></h3></a>

				</div>

<?php } ?>

	</div>

	<div class="ten columns">

<nav id="site-navigation" class="main-navigation" role="navigation">

<h3 class="menu-toggle"><?php esc_attr_e( 'Menu', 'sagan' ); ?></h3>

<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'sagan' ); ?>"><?php esc_attr_e( 'Skip to content', 'sagan' ); ?></a>

<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu') ); ?>

</nav><!-- #site-navigation -->

	</div>

  </div>

  <div class="container">

  <!-- End Header and Nav -->