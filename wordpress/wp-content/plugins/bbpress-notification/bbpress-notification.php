<?php
/*
Plugin Name: BbPress Notification
Plugin URI:  http://tomas.zhu.bz/my-bbpress-plugin-bbpress-notification.html/
Description: Send new topic and reply notification to admin email automatically.
Version: 1.0.0
Author: Tomas Zhu
Author URI: http://tomas.zhu.bz
License: GPL2
*/

function new_topic_notification($topic_id = 0, $forum_id = 0, $anonymous_data = false, $topic_author = 0)
{
	$admin_email = get_option('admin_email');

	$blog_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	$topic_title = html_entity_decode(strip_tags(bbp_get_topic_title($topic_id)), ENT_NOQUOTES, 'UTF-8');
	$topic_content = html_entity_decode(strip_tags(bbp_get_topic_content($topic_id)), ENT_NOQUOTES, 'UTF-8');
	$topic_excerpt = html_entity_decode(strip_tags(bbp_get_topic_excerpt($topic_id, 100)), ENT_NOQUOTES, 'UTF-8');
	$topic_author = bbp_get_topic_author($topic_id);
	$topic_url = bbp_get_topic_permalink($topic_id);
	$topic_reply = bbp_get_reply_url($topic_id);

	$email_subject = $blog_name. " New Topic Alert: ".$topic_title;

	$email_body = $blog_name.": $topic_title\n\r";
	$email_body .= $topic_content;
	$email_body .= "\n\r--------------------------------\n\r";
	$email_body .= "Topic Url: ".$topic_url."\n\rAuthor: $topic_author". "\n\rYou can reply at: $topic_reply";

	@wp_mail( $admin_email, $email_subject, $email_body );
}


function new_reply_notification( $reply_id = 0, $topic_id = 0, $forum_id = 0, $anonymous_data = false, $reply_author = 0, $is_edit = false, $reply_to = 0 ) 
{

	$admin_email = get_option('admin_email');
		
	$user_id  = (int) $reply_author_id;
	$reply_id = bbp_get_reply_id( $reply_id );
	$topic_id = bbp_get_topic_id( $topic_id );
	$forum_id = bbp_get_forum_id( $forum_id );
		
	$email_subject = get_option('bbpress_notify_newreply_email_subject');
	$email_body = get_option('bbpress_notify_newreply_email_body');

	$blog_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	$topic_title = html_entity_decode(strip_tags(bbp_get_topic_title($topic_id)), ENT_NOQUOTES, 'UTF-8');
	$topic_content = html_entity_decode(strip_tags(bbp_get_topic_content($topic_id)), ENT_NOQUOTES, 'UTF-8');
	$topic_excerpt = html_entity_decode(strip_tags(bbp_get_topic_excerpt($topic_id, 100)), ENT_NOQUOTES, 'UTF-8');
	$topic_author = bbp_get_topic_author($topic_id);
	$topic_url = bbp_get_topic_permalink($topic_id);
	$topic_reply = bbp_get_reply_url($topic_id);
	$reply_url     = bbp_get_reply_url( $reply_id );
	$reply_content = get_post_field( 'post_content', $reply_id, 'raw' );
	$reply_author = bbp_get_topic_author($user_id);
	
	
	$email_subject = $blog_name. " New Reply Alert: ".$topic_title;

	$email_body = $blog_name.": $topic_title\n\r";
	$email_body .= $reply_content;
	$email_body .= "\n\r--------------------------------\n\r";
	$email_body .= "Reply Url: ".$reply_url."\n\rAuthor: $reply_author". "\n\rYou can reply at: $reply_url";

	@wp_mail( $admin_email, $email_subject, $email_body );
}


add_action('bbp_new_topic', 'new_topic_notification');
add_action('bbp_new_reply', 'new_reply_notification');

?>