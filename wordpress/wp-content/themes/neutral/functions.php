<?php


// 言語ファイルの読み込み
load_textdomain('neutral', dirname(__FILE__).'/languages/' . get_locale() . '.mo');


// テーマオプション
require_once ( get_stylesheet_directory() . '/admin/theme-options.php' );


// 更新通知
if (strtoupper(get_locale()) == 'JA') {
 require_once ( get_stylesheet_directory() . '/admin/update_notifier_jp.php' );
} else {
 require_once ( get_stylesheet_directory() . '/admin/update_notifier.php' );
};


//ロゴ画像用関数
get_template_part('functions/header-logo');

add_filter('widget_text', 'do_shortcode');

include_once(ABSPATH . WPINC . '/rss.php');
define('MAGPIE_OUTPUT_ENCODING' , 'UTF-8');
define('MAGPIE_CACHE_DIR' , './cache');
define('MAGPIE_FETCH_TIME_OUT', 30);
define('MAGPIE_CACHE_AGE', 60*60);

function readRSS($url){
        $rss = fetch_rss($url);
        $maxitems = $num;
        $items = array_slice($rss->items, 0, $maxitems);
	return $items;
}

function printRSS($atts){
	extract(shortcode_atts(array(
		'url' => '',
		'num' => 0,
		'datestr' => 'off',
	),$atts));
	$items = readRSS($url);
	$line='<ul>';
	if (empty($items)) {
		$line=$line+'<li>No items</li>';
	}else{
		foreach ( $items as $item ){
			$line=$line.'<li><span><a href="'.$item[link].'" target="_blank">'.$item[title]."</a></span></li>";
		}
	}
	return $line;
}

function jvnRSS($atts){
        extract(shortcode_atts(array(
                'url' => '',
                'num' => 0,
        ),$atts));
	$items = readRSS($url);
	$line='<ul>';
	
	if (empty($items)) {
		$line=$line+'<li>No items</li>';
	}else{
		$date="";
		foreach ( $items as $item ){
			$datestr=explode('T',$item[dc][date]);
			if ( $date == "" ){
                               $date = $datestr[0];
                                $line=$line."<li><span>".$date."<BR>";

			} elseif ( $date != $datestr[0] ){
				$line=$line."</span></li>";
				$date = $datestr[0];	
				$line=$line."</ul><ul><li><span>".$date."<BR>";
			}
			if ( strlen($item[title]) > 50 ) {
				$item[title] = mb_substr($item[title],0,50).".....";
			}
			$line=$line.'<a href="'.$item[link].'" target="_blank">'.$item[title]."</a><BR>";
		}
                $line=$line."</span></li>";
	}
	return $line;
}

add_shortcode('rss-output','printRSS');
add_shortcode('jvn-output','jvnRSS');

// スタイルシートの読み込み
add_action('admin_print_styles', 'my_admin_CSS');
function my_admin_CSS() {
 wp_enqueue_style('myAdminCSS', get_bloginfo('stylesheet_directory').'/admin/my_admin.css');
};


add_action( 'wp_before_admin_bar_render', 'hide_before_admin_bar_render' );
function hide_before_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu( 'wp-logo' );
};


// ページナビ用
function show_posts_nav() {
global $wp_query;
return ($wp_query->max_num_pages > 1);
};


// カスタムメニューの設定
if(function_exists('register_nav_menu')) {
 register_nav_menu( 'header-menu', __( 'Header menu', 'neutral' ) );
}



// Sidebar widget
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<div class="side_box %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side top', 'neutral'),
        'id' => 'top'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_box_short %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side middle left', 'neutral'),
        'id' => 'left'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_box_short %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side middle right', 'neutral'),
        'id' => 'right'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_box %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side bottom', 'neutral'),
        'id' => 'bottom'
    ));
}

// Original custom comments function is written by mg12 - http://www.neoease.com/

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}

function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}

?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="external nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif; $options = get_neutral_option(); ?>
     </li>
     <li class="comment-date"><?php echo get_comment_time(__('M jS. Y', 'neutral')); if ($options['show_comment_time']) : echo get_comment_time(__(' g:ia', 'neutral')); endif; ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','neutral').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'neutral'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'neutral'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'neutral'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'neutral'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'neutral'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php } ?>
