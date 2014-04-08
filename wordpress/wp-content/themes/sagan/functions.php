<?php
add_action( 'after_setup_theme', 'sagan_theme_setup' );
function sagan_theme_setup() {
require_once ( get_template_directory() . '/theme-options.php' );
register_nav_menu( 'main-menu', __( 'Main Menu', 'sagan' ) );
register_nav_menu( 'bottom-menu', __( 'Footer Menu', 'sagan' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 280, 210, true);
add_editor_style('/inc/custom-editor-style.css');
if ( ! isset( $content_width ) ) $content_width = 900;
function sagan_new_excerpt_more($more) {
global $post;
return '<a class="moretag" href="'. get_permalink($post->ID) . '">...continue reading</a>';
}
add_filter('excerpt_more', 'sagan_new_excerpt_more');
function sagan_custom_excerpt_length( $length ) {
return 20;
}
add_filter( 'excerpt_length', 'sagan_custom_excerpt_length', 999 );
function sagan_blank_slate_title($title) {
if ($title == '') {
return 'Untitled Post';
} else {
return $title;
}
}
add_filter('the_title', 'sagan_blank_slate_title');
/* Thanks to One Trick Pony, StackExchange */
add_filter('post_class', 'sagan_post_class');
function sagan_post_class($classes){
  global $wp_query;
  if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'last';
  return $classes;
}
/* Secondary Excerpt by c.bavota - thanks! */
function sagan_excerpt($limit) {
$excerpt = explode(' ', get_the_excerpt(), $limit);
if (count($excerpt)>=$limit) {
array_pop($excerpt);
$excerpt = implode(" ",$excerpt).'...';
} else {
$excerpt = implode(" ",$excerpt);
}	
$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
return $excerpt;
}
function sagan_content($limit) {
$content = explode(' ', get_the_content(), $limit);
if (count($content)>=$limit) {
array_pop($content);
$content = implode(" ",$content).'...';
} else {
$content = implode(" ",$content);
}
$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content); 
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}
}
function sagan_wp_title( $title, $sep ) {
global $paged, $page;
if ( is_feed() )
return $title;
// Add the site name.
$title .= get_bloginfo( 'name' );
// Add the site description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
$title = "$title $sep $site_description";
// Add a page number if necessary.
if ( $paged >= 2 || $page >= 2 )
$title = "$title $sep " . sprintf( __( 'Page %s', 'sagan' ), max( $paged, $page ) );
return $title;
}
add_filter( 'wp_title', 'sagan_wp_title', 10, 2 );
// End theme setup
/* Scripts, Fonts & Styles */
/**
 * Enqueue Google Fonts
 */
function sagan_font() {
	$protocol = is_ssl() ? 'https' : 'http';
		wp_register_style( 'sagan-ubuntu', "$protocol://fonts.googleapis.com/css?family=Ubuntu+Condensed" );
}
add_action( 'init', 'sagan_font' );
function sagan_scripts_styles() {
	global $wp_styles;
	wp_register_style( 'sagan-foundation-style', get_template_directory_uri() . '/stylesheets/foundation.min.css', 
	array(), 
	'2132013', 
	'all' );
	wp_register_script( 'sagan-orbit', get_template_directory_uri() . '/javascripts/jquery.foundation.orbit.js', array('jquery'), '1.0', true );
	wp_register_script( 'sagan-modernizr', get_template_directory_uri() . '/javascripts/modernizr.foundation.js', array(), '1.0', true );
	wp_register_script( 'sagan-navigation', get_template_directory_uri() . '/javascripts/navigation.js', array(), '1.0', true );
	wp_register_script( 'sagan-orbitloader', get_template_directory_uri() . '/javascripts/orbitload.js', array(), '1.0', true );
		// enqueing:
	wp_enqueue_style( 'sagan-foundation-style' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'sagan-ubuntu' );
	wp_enqueue_script( 'sagan-navigation');
	wp_enqueue_script( 'sagan-modernizr');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' ); 
	}
	global $sagan_options; $sagan_settings = get_option( 'sagan_options', $sagan_options );
	if (is_front_page() && !is_paged() & $sagan_settings['orbit_slider'] ) {
	wp_enqueue_script( 'sagan-orbit');
	wp_enqueue_script( 'sagan-orbitloader');
}
}
add_action( 'wp_enqueue_scripts', 'sagan_scripts_styles' );
/* Sidebar Areas */
function sagan_register_sidebars() {

register_sidebar(array(

'name' => __( 'Homepage Widget Block 1', 'sagan' ),

'id' => 'home-1',

'description' => __( 'Homepage Widget Block 1.', 'sagan' ),

'before_widget' => '<div>',

'after_widget' => '</div>',

'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',

'after_title' => '</h4></div>',

));

register_sidebar(array(

'name' => __( 'Homepage Widget Block 2', 'sagan' ),

'id' => 'home-2',

'description' => __( 'Homepage Widget Block 2.', 'sagan' ),

'before_widget' => '<div>',

'after_widget' => '</div>',

'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',

'after_title' => '</h4></div>',

));

register_sidebar(array(

'name' => __( 'Homepage Widget Block 3', 'sagan' ),

'id' => 'home-3',

'description' => __( 'Homepage Widget Block 3.', 'sagan' ),

'before_widget' => '<div>',

'after_widget' => '</div>',

'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',

'after_title' => '</h4></div>',

));

register_sidebar(array(

'name' => __( 'Homepage Widget Block 4', 'sagan' ),

'id' => 'home-4',

'description' => __( 'Homepage Widget Block 4.', 'sagan' ),

'before_widget' => '<div>',

'after_widget' => '</div>',

'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',

'after_title' => '</h4></div>',

));

register_sidebar(array(
'name' => __( 'Right Sidebar', 'sagan' ),
'id' => 'sidebar',
'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'sagan' ),
'before_widget' => '<div>',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-title-block"><h4 class="sidebar">',
'after_title' => '</h4></div>',
));
register_sidebar(array(
'name' => __( 'Below Posts' , 'sagan' ),
'id' => 'belowposts-sidebar',
'description' => __( 'Widgets in this area will be shown beneath the blog post type. Use this for sharing, related articles and more.' , 'sagan' ),
'before_title' => '<div class="sidebar-title-block"><h4 class="belowposts">',
'after_title' => '</h4></div>',
'before_widget' => '<div class="bottom-widget">',
'after_widget' => '</div><hr>',
));
}
/* Custom Widget */

class Sagan_Category_Posts_Widget extends WP_Widget {
			
	function __construct() {
    	$widget_ops = array(
			'classname'   => 'widget_category_entries', 
			'description' => __('Display recent posts from a specific category.')
		);
    	parent::__construct('sagan-category-posts', __('Sagan Category Posts'), $widget_ops);
	}

	function widget($args, $instance) {
           
			extract( $args );
		
			$title = apply_filters( 'widget_title', empty($instance['title']) ? 'Category Posts' : $instance['title'], $instance, $this->id_base);			
			if ( ! $number = absint( $instance['number'] ) ) $number = 5;
						
			if( ! $cats = $instance["cats"] )  $cats='';
					
			// array to call category posts.
			
			$sagan_args=array(
						   
				'showposts' => $number,
				'category__in'=> $cats,
				);
			
			$sagan_widget = null;
			$sagan_widget = new WP_Query($sagan_args);
			
			echo $before_widget;
			
			// Widget title
			
			echo $before_title;
			echo $instance["title"];
			echo $after_title;
			
			// Post list in widget
			
			echo "<ul>\n";
			
		while ( $sagan_widget->have_posts() )
		{
			$sagan_widget->the_post();
		?>
			<li class="sagan-item">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>" class="sagan-title"><?php the_title(); ?></a>
		
			</li>
		<?php

		}

		 wp_reset_query();

		echo "</ul>\n";
		echo $after_widget;

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        	$instance['cats'] = $new_instance['cats'];
		$instance['number'] = absint($new_instance['number']);
	     
        		return $instance;
	}
	
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		
?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
                        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        
         <p>
            <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the category posts list:');?> 
            
                <?php
                   $cats=  get_categories('hide_empty=1');
                     echo "<br/>";
                     foreach ($cats as $cat) {
                         $option='<input type="checkbox" id="'. $this->get_field_id( 'cats' ) .'[]" name="'. $this->get_field_name( 'cats' ) .'[]"';
                            if (is_array($instance['cats'])) {
                                foreach ($instance['cats'] as $cats) {
                                    if($cats==$cat->term_id) {
                                         $option=$option.' checked="checked"';
                                    }
                                }
                            }
                            $option .= ' value="'.$cat->term_id.'" />';
			    $option .= '&nbsp;';
                            $option .= $cat->cat_name;
                            $option .= '<br />';
                            echo $option;
                         }
                    
                    ?>
            </label>
        </p>
        
<?php
	}
}

function sagan_register_widgets() {
	register_widget( 'Sagan_Category_Posts_Widget' );
}

add_action( 'widgets_init', 'sagan_register_widgets' );
add_action( 'widgets_init', 'sagan_register_sidebars' );
/* Twenty Twelve Comment System */
if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
* Template for comments and pingbacks.
* To override this walker in a child theme without modifying the comments template
* simply create your own twentytwelve_comment(), and that function will be used instead.
* Used as a callback by wp_list_comments() for displaying the comments.
* @since Twenty Twelve 1.0
*/
function sagan_twentytwelve_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case 'pingback' :
case 'trackback' :
// Display trackbacks differently than normal comments.
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<p><?php esc_attr_e( 'Pingback:', 'sagan' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'sagan' ), '<span class="edit-link">', '</span>' ); ?></p>
<?php
break;
default :
// Proceed with normal comments.
global $post;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<article id="comment-<?php comment_ID(); ?>" class="comment">
<header class="comment-meta comment-author vcard">
<?php
echo get_avatar( $comment, 77 );
printf( '<cite class="fn">%1$s %2$s</cite>',
get_comment_author_link(),
// If current post author is also comment author, make it known visually.
( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'sagan' ) . '</span>' : ''
);
printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
esc_url( get_comment_link( $comment->comment_ID ) ),
get_comment_time( 'c' ),
/* translators: 1: date, 2: time */
sprintf( __( '%1$s at %2$s', 'sagan' ), get_comment_date(), get_comment_time() )
);
?>
</header><!-- .comment-meta -->
<?php if ( '0' == $comment->comment_approved ) : ?>
<p class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'sagan' ); ?></p>
<?php endif; ?>
<section class="comment-content comment">
<?php comment_text(); ?>
<?php edit_comment_link( __( 'Edit', 'sagan' ), '<p class="edit-link">', '</p>' ); ?>
</section><!-- .comment-content -->
<div class="reply">
<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'sagan' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div><!-- .reply -->
</article><!-- #comment-## -->
<?php
break;
endswitch; // end comment_type check
}endif;