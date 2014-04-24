<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    bbPress Admin Bar Addition
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2011-2012, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://genesisthemes.de/en/wp-plugins/bbpress-admin-bar-addition/
 * @link       http://twitter.com/deckerweb
 *
 * @since 1.0
 * @version 1.1
 */

/**
 * Setting internal plugin helper links constants
 *
 * @since 1.7
 */
define( 'BBPABA_URL_TRANSLATE',		'http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/bbpress-admin-bar-addition' );
define( 'BBPABA_URL_WPORG_FAQ',		'http://wordpress.org/extend/plugins/bbpress-admin-bar-addition/faq/' );
define( 'BBPABA_URL_WPORG_FORUM',	'http://wordpress.org/support/plugin/bbpress-admin-bar-addition' );
define( 'BBPABA_URL_WPORG_PROFILE',	'http://profiles.wordpress.org/daveshine/' );
define( 'BBPABA_URL_SUGGESTIONS',	'http://twitter.com/deckerweb' );
define( 'BBPABA_URL_SNIPPETS',		'https://gist.github.com/2721186' );
if ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) {
	define( 'BBPABA_URL_DONATE', 	'http://genesisthemes.de/spenden/' );
	define( 'BBPABA_URL_PLUGIN',	'http://genesisthemes.de/plugins/bbpress-admin-bar-addition/' );
} else {
	define( 'BBPABA_URL_DONATE', 	'http://genesisthemes.de/en/donate/' );
	define( 'BBPABA_URL_PLUGIN', 	'http://genesisthemes.de/en/wp-plugins/bbpress-admin-bar-addition/' );
}


/**
 * Add "Settings" link to plugin page
 *
 * @since 1.7
 *
 * @param  $bbpaba_links
 * @param  $bbpaba_settings_link
 * @return strings settings link
 */
function ddw_bbpaba_settings_page_link( $bbpaba_links ) {

	$bbpaba_settings_link = sprintf( '<a href="%s" title="%s">%s</a>' , admin_url( 'options-general.php?page=bbpress' ) , __( 'Go to the bbPress Forums settings page', 'bbpaba' ) , __( 'bbPress Settings', 'bbpaba' ) );
	
	array_unshift( $bbpaba_links, $bbpaba_settings_link );

	return $bbpaba_links;

}  // end of function ddw_bbpaba_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_bbpaba_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since 1.0
 *
 * @param  $bbpaba_links
 * @param  $bbpaba_file
 * @return strings plugin links
 */
function ddw_bbpaba_plugin_links( $bbpaba_links, $bbpaba_file ) {

	if ( ! current_user_can( 'install_plugins' ) )
		return $bbpaba_links;

	if ( $bbpaba_file == BBPABA_PLUGIN_BASEDIR . '/bbpress-admin-bar-addition.php' ) {
		$bbpaba_links[] = '<a href="' . esc_url_raw( BBPABA_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'bbpaba' ) . '">' . __( 'FAQ', 'bbpaba' ) . '</a>';
		$bbpaba_links[] = '<a href="' . esc_url_raw( BBPABA_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'bbpaba' ) . '">' . __( 'Support', 'bbpaba' ) . '</a>';
		$bbpaba_links[] = '<a href="' . esc_url_raw( BBPABA_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'bbpaba' ) . '">' . __( 'Translations', 'bbpaba' ) . '</a>';
		$bbpaba_links[] = '<a href="' . esc_url_raw( BBPABA_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'bbpaba' ) . '">' . __( 'Donate', 'bbpaba' ) . '</a>';
	}

	return $bbpaba_links;

}  // end of function ddw_bbpaba_plugin_links


add_action( 'load-settings_page_bbpress', 'ddw_bbpaba_bbpress_help', 15 );
add_action( 'load-tools_page_bbp-repair', 'ddw_bbpaba_bbpress_help', 15 );
add_action( 'load-tools_page_bbp-converter', 'ddw_bbpaba_bbpress_help', 15 );
add_action( 'load-tools_page_bbp-reset', 'ddw_bbpaba_bbpress_help', 15 );
add_action( 'load-network-update-core_page_bbpress-update', 'ddw_bbpaba_bbpress_help', 15 );
/**
 * Load plugin help tab after core help tabs on bbPress Forums admin page.
 *
 * @since 1.7
 *
 * @global mixed $bbpaba_bbpress_screen
 */
function ddw_bbpaba_bbpress_help() {

	global $bbpaba_bbpress_screen;

	$bbpaba_bbpress_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher */
	if( ! class_exists( 'WP_Screen' ) || ! $bbpaba_bbpress_screen || ! class_exists( 'bbPress' ) || ! BBPABA_DISPLAY )
		return;

	/** Add the help tab */
	$bbpaba_bbpress_screen->add_help_tab( array(
		'id'       => 'bbpaba-bbpress-help',
		'title'    => __( 'bbPress Admin Bar Addition', 'bbpaba' ),
		'callback' => 'ddw_bbpaba_help_tab_content',
	) );

	/** Add help sidebar */
	if ( 'bbpress' != $_GET['page'] ) {
		$bbpaba_bbpress_screen->set_help_sidebar(
			'<p><strong>' . __( 'More about the plugin author', 'bbpaba' ) . '</strong></p>' .
			'<p>' . __( 'Social:', 'bbpaba' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a></p>' .
			'<p><a href="' . esc_url_raw( BBPABA_URL_WPORG_PROFILE ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>'
		);
	}  // end-if page hook check

}  // end of function ddw_bbpaba_bbpress_help


/**
 * Create and display plugin help tab content
 *
 * @since 1.7
 */
function ddw_bbpaba_help_tab_content() {

	echo '<h3>' . __( 'Plugin', 'bbpaba' ) . ': ' . __( 'bbPress Admin Bar Addition', 'bbpaba' ) . '</h3>' .		
		'<ul>' . 
			'<li><a href="' . esc_url_raw( BBPABA_URL_SUGGESTIONS ) . '" target="_new" title="' . __( 'Suggest new resource items, themes or plugins for support', 'bbpaba' ) . '">' . __( 'Suggest new resource items, themes or plugins for support', 'bbpaba' ) . '</a></li>' .
			'<li><a href="' . esc_url_raw( BBPABA_URL_SNIPPETS ) . '" target="_new" title="' . __( 'Code snippets for customizing &amp; branding', 'bbpaba' ) . '">' . __( 'Code snippets for customizing &amp; branding', 'bbpaba' ) . '</a></li>';

		/** Optional: recommended plugins */
		if ( ! defined( 'BBPSW_PLUGIN_BASEDIR' ) ||
			! class_exists( 'bbPress_Antispam' ) ||
			! class_exists( 'gdbbPressAttachments' ) ||
			! class_exists( 'BBP_PostTopics' )
		) {

			echo '<li><em>' . __( 'Other, recommended bbPress plugins', 'bbpaba' ) . '</em>:';

			if ( ! defined( 'BBPSW_PLUGIN_BASEDIR' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/bbpress-search-widget/" target="_new" title="bbPress Search Widget">bbPress Search Widget</a> &mdash; ' . __( 'search functionality for the bbPress forums, independent from regular WordPress search', 'bbpaba' );

			}  // end-if plugin check

			if ( ! class_exists( 'bbPress_Antispam' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/bbpress-antispam/" target="_new" title="bbPress Antispam">bbPress Antispam</a> &mdash; ' . __( 'elegant anti spam solution plus notify options', 'bbpaba' ) . ' &mdash; <em>' . __( 'currently best free solution out there!', 'bbpaba' ) . '</em>';

			}  // end-if plugin check

			if ( ! class_exists( 'gdbbPressAttachments' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/gd-bbpress-attachments/" target="_new" title="GD bbPress Attachments">GD bbPress Attachments</a> &mdash; ' . __( 'implements attachments for topics &amp; replies via media library', 'bbpaba' );

			}  // end-if plugin check

			if ( ! class_exists( 'BBP_PostTopics' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/bbpress-post-topics/" target="_new" title="bbPress Topics for Posts">bbPress Topics for Posts</a> &mdash; ' . __( 'replace the comments on blog posts with topics from your integrated bbPress install', 'bbpaba' );

			}  // end-if plugin check

			echo '</li>';

		}  // end-if plugins check

	echo '</ul>' .
		'<p><strong>' . __( 'Important plugin links:', 'bbpaba' ) . '</strong>' . 
		'<br /><a href="' . esc_url_raw( BBPABA_URL_PLUGIN ) . '" target="_new" title="' . __( 'Plugin Website', 'bbpaba' ) . '">' . __( 'Plugin Website', 'bbpaba' ) . '</a> | <a href="' . esc_url_raw( BBPABA_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'bbpaba' ) . '">' . __( 'FAQ', 'bbpaba' ) . '</a> | <a href="' . esc_url_raw( BBPABA_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'bbpaba' ) . '">' . __( 'Support', 'bbpaba' ) . '</a> | <a href="' . esc_url_raw( BBPABA_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'bbpaba' ) . '">' . __( 'Translations', 'bbpaba' ) . '</a> | <a href="' . esc_url_raw( BBPABA_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'bbpaba' ) . '">' . __( 'Donate', 'bbpaba' ) . '</a></p>';

}  // end of function ddw_bbpaba_help_tab_content
