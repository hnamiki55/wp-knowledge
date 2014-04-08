<div id="comments">

<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
if (function_exists('post_password_required')) 
	{
	if ( post_password_required() ) 
		{
		echo '<div class="nocomments"><p>';_e('This post is password protected. Enter the password to view comments.','neutral'); echo '</p></div></div>';
		return;
		}
	} else 
	{
	if (!empty($post->post_password)) 
		{ // if there's a password
			if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) 
			{  // and it doesn't match the cookie  ?>
				<div class="nocomments"><p><?php _e('This post is password protected. Enter the password to view comments.','neutral'); ?></p></div></div>
				<?php return;
			}
		}
	}
?>

<?php  //custom comments function by mg12 - http://www.neoease.com/  ?>

<?php
       if (function_exists('wp_list_comments')) { $trackbacks = $comments_by_type['pings']; }
       else { $trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID)); }
?>

<?php if ($comments || comments_open()) ://if there is comment and comment is open ?>

 <div id="comment_header" class="clearfix">

  <ul id="comment_header_left">
<?php if(comments_open()) ://if comment is open ?>
   <li id="add_comment"><a href="#respond"><?php _e('Write comment','neutral'); ?></a></li>
<?php endif; ?>
   <li id="comment_feed"><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Comments RSS','neutral'); ?>"><?php _e('Comments RSS','neutral'); ?></a></li>
  </ul>

  <ul id="comment_header_right">
<?php if(pings_open()) ://if trackback is open ?>
    <li id="trackback_switch"><a href="javascript:void(0);"><?php _e('Trackback','neutral'); ?><?php echo (' ( ' . count($trackbacks) . ' )'); ?></a></li>
    <li id="comment_switch" class="comment_switch_active"><a href="javascript:void(0);"><?php _e('Comments','neutral'); ?><?php echo (' ( ' . (count($comments)-count($trackbacks)) . ' )'); ?></a></li>
<?php else ://if comment is closed,show onky number ?>
    <li id="trackback_closed"><?php _e('Trackback are closed','neutral'); ?></li>
    <li id="comment_closed"><?php _e('Comments', 'neutral'); echo (' (' . (count($comments)-count($trackbacks)) . ')'); ?></li>
<?php endif; ?>
  </ul>

<?php if(pings_open()) ://if trackback is open ?>

<?php endif; ?>
 </div><!-- comment_header END -->


<div id="comment_area">
<!-- start commnet -->
<ol class="commentlist">
	<?php
		if ($comments && count($comments) - count($trackbacks) > 0) {
			// for WordPress 2.7 or higher
			if (function_exists('wp_list_comments')) {
				wp_list_comments('type=comment&callback=custom_comments');
			// for WordPress 2.6.3 or lower
			} else {
				foreach ($comments as $comment) {
					if($comment->comment_type != 'pingback' && $comment->comment_type != 'trackback') {
						custom_comments($comment, null, null);
					}
				}
			}
		} else {
	?>
<li class="comment"><div class="comment-content"><p><?php _e('No comments yet.','neutral'); ?></p></div></li>
	<?php
		}
	?>
</ol>
<!-- comments END -->

<?php //if you select comment pager from comment option
	if (get_option('page_comments')) {
		$comment_pages = paginate_comments_links('echo=0');
		if ($comment_pages) {
?>

<div id="comment_pager" class="clearfix">
 <?php echo $comment_pages; ?>
</div>

<?php } } ?>

</div><!-- #comment-list END -->


<div id="trackback_area">
<!-- start trackback -->
<?php if (pings_open()) ://id trackback is open ?>

<div id="trackback_url_wrapper">
<label for="trackback_url"><?php _e('TrackBack URL' , 'neutral'); ?></label>
<input type="text" name="trackback_url" id="trackback_url" size="60" value="<?php trackback_url() ?>" readonly="readonly" onfocus="this.select()" />
</div>

<ol class="commentlist">

<?php if ($trackbacks) : $trackbackcount = 0; ?>

<?php foreach ($trackbacks as $comment) : ?>
<li class="comment">
 <div class="trackback_time">
  <?php echo get_comment_time(__('M jS. Y', 'neutral')) ?>
  <?php edit_comment_link(__('[ EDIT ]', 'neutral'), '', ''); ?>
 </div>
 <div class="trackback_title">
  <?php _e('Trackback from : ' , 'neutral'); ?><a href="<?php comment_author_url() ?>"><?php comment_author(); ?></a>
 </div>
</li>
<?php endforeach; ?>

<?php else : ?>
<li class="comment"><div class="comment-content"><p><?php _e('No trackbacks yet.','neutral'); ?></p></div></li>
<?php endif; ?>
</ol>
<?php endif; ?>
<!-- trackback end -->
</div><!-- #trackbacklist END -->

<?php endif;//comment is open ?>




<?php if (!comments_open()) : // if comment are closed ?>

<div class="comment_closed" id="respond">
<?php _e('Comment are closed.','neutral'); ?>
</div>





<?php elseif ( get_option('comment_registration') && !$user_ID ) : // If registration required and not logged in. ?>

<div class="comment_form_wrapper" id="respond">
 <?php if (function_exists('wp_login_url')) 
        { $login_link = wp_login_url();  }
       else 
        { $login_link = get_site_url() . '/wp-login.php?redirect_to=' . urlencode(get_permalink()); }
 ?>
<?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'neutral'), $login_link); ?>
</div>




<?php else ://if comment is open ?>

<fieldset class="comment_form_wrapper" id="respond">

<?php if (function_exists('comment_reply_link')) { ?>
<div id="cancel_comment_reply"><?php cancel_comment_reply_link() ?></div>
<?php } ?>

<form action="<?php echo esc_url(site_url('/')); ?>wp-comments-post.php" method="post" id="commentform">

 <?php if ( $user_ID ) : ?>
 <div id="comment_user_login">
  <p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'neutral'), get_site_url() . '/wp-admin/profile.php', $user_identity); ?><span><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'neutral'); ?>"><?php _e('[ Log out ]', 'neutral'); ?></a></span></p>
 </div><!-- #comment-user-login END -->
 <?php else : ?>
 <div id="guest_info">
  <div id="guest_name"><label for="author"><span><?php _e('NAME','neutral'); ?></span><?php if ($req) _e('( required )', 'neutral'); ?></label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></div>
  <div id="guest_email"><label for="email"><span><?php _e('E-MAIL','neutral'); ?></span><?php if ($req) _e('( required )', 'neutral'); ?> <?php _e('- will not be published -','neutral'); ?></label><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></div>
  <div id="guest_url"><label for="url"><span><?php _e('URL','neutral'); ?></span></label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></div>
  <?php if ( function_exists('cs_print_smilies') ) { echo '<div id="custom_smilies">'; cs_print_smilies(); echo "</div>\n"; } ?>
 </div>
 <?php endif; ?>

 <div id="comment_textarea">
  <textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
 </div>

 <div id="submit_comment_wrapper">
  <?php do_action('comment_form', $post->ID); ?>
  <input name="submit" type="submit" id="submit_comment" tabindex="5" value="<?php _e('Submit Comment', 'neutral'); ?>" title="<?php _e('Submit Comment', 'neutral'); ?>" alt="<?php _e('Submit Comment', 'neutral'); ?>" />
 </div>

 <div id="input_hidden_field">
  <?php if (function_exists('comment_id_fields')) { ?>
  <?php comment_id_fields(); ?>
  <?php } else { ?>
  <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
  <?php } ?>
 </div>

</form>
</fieldset><!-- #comment-form-area END -->


<?php endif; ?>
</div><!-- #comment end -->