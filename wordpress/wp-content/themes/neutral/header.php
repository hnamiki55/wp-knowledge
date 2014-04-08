<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php
global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );
$site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'neutral' ), max( $paged, $page ) );
?></title>
<meta name="description" content="<?php echo bloginfo('description'); ?>" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/comment-style.css" type="text/css" />
<?php if (strtoupper(get_locale()) == 'JA'): ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/japanese.css" type="text/css" />
<?php endif; ?>

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scroll.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jscript.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js"></script>

<!--[if IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ie7.js"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie7.css" type="text/css" />
<![endif]-->

<?php $options = get_neutral_option(); ?>

</head>
<body class="default<?php if(is_page_template('page-noside.php')||is_page_template('page-noside-nocomment.php')||$options['layout'] == 'noside') { echo ' no_side'; }; if (!$options['show_category'] and !$options['show_tag'] and !$options['show_comment']) { echo ' no_postmeta'; }; if (!$options['show_date'] and !$options['show_author']) { echo ' no_postinfo'; }; ?>">

<div id="wrapper">

 <div id="<?php if (has_nav_menu('header-menu')) { echo "header"; } else { echo "header2"; }; ?>">

  <!-- logo -->
  <div id="logo">
   <?php the_dp_logo(); ?>
  </div>
  
  <div id="header_meta">
   <?php if ($options['show_search']) { ?>
   <div id="header_search_area"<?php if (!$options['show_rss']&&!$options['twitter_url']) : echo ' style="margin-right:0;"'; endif; ?>>
    <?php if ($options['custom_search_id']) : ?>
    <form action="http://www.google.com/cse" method="get" id="searchform">
     <div>
      <input id="search_input" type="text" value="<?php _e('SEARCH','neutral'); ?>" name="q" onfocus="if (this.value == '<?php _e('SEARCH','neutral'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','neutral'); ?>';" />
     </div>
     <div>
      <input type="image" src="<?php bloginfo('template_url'); ?>/img/search_button.gif" name="sa" alt="<?php _e('Search from this blog.','neutral'); ?>" title="<?php _e('Search from this blog.','neutral'); ?>" id="search_button" />
      <input type="hidden" name="cx" value="<?php echo $options['custom_search_id']; ?>" />
      <input type="hidden" name="ie" value="UTF-8" />
     </div>
    </form>
    <?php else: ?>
    <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
     <div><input id="search_input" type="text" value="<?php _e('SEARCH','neutral'); ?>" name="s" onfocus="if (this.value == '<?php _e('SEARCH','neutral'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','neutral'); ?>';" /></div>
     <div><input type="image" src="<?php bloginfo('template_url'); ?>/img/search_button.gif" alt="<?php _e('Search from this blog.','neutral'); ?>" title="<?php _e('Search from this blog.','neutral'); ?>" id="search_button" /></div>
    </form>
    <?php endif; ?>
   </div>
   <?php }; ?>
   <?php if ($options['show_rss']) : ?>
   <a href="<?php bloginfo('rss2_url'); ?>" class="target_blank" id="header_rss" title="<?php _e('RSS','neutral'); ?>" ><?php _e('RSS','neutral'); ?></a>
   <?php endif; ?>
   <?php if ($options['twitter_url']) : ?>
   <a href="<?php echo $options['twitter_url']; ?>" class="target_blank" id="header_twitter" title="<?php _e('Twitter','neutral'); ?>" ><?php _e('Twitter','neutral'); ?></a>
   <?php endif; ?>
   <?php if ($options['facebook_url']) : ?>
   <a href="<?php echo $options['facebook_url']; ?>" class="target_blank" id="header_facebook" title="<?php _e('Facebook','neutral'); ?>" ><?php _e('Facebook','neutral'); ?></a>
   <?php endif; ?>
  </div><!-- END #header_meta -->

  <?php if (has_nav_menu('header-menu')) { ?>
  <div class="header_menu">
   <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'header-menu' , 'container' => '' ) ); ?>
  </div>
  <?php } else { ?>
  <div class="no_header_menu"></div>
  <?php }; ?>

 </div><!-- END #header -->