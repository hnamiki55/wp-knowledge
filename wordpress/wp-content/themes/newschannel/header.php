<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title('|', true, 'left'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'before' ); ?>
	<header id="branding" role="banner">
    
      <div id="inner-header" class="clearfix">
      
      	<div class="head-wrap">
		<hgroup id="site-heading">
			<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		<?php get_search_form(); ?>
        </div>
        
		<nav id="access" role="navigation">
          <div class="nav-wrap">
			<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'newschannel' ); ?></h1>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'newschannel' ); ?>"><?php _e( 'Skip to content', 'newschannel' ); ?></a></div>
			<?php newschannel_main_nav(); // Adjust using Menus in Wordpress Admin ?>
		  </div>
		</nav><!-- #access -->
        
      </div>   
      
	</header><!-- #branding -->
<div id="container">

