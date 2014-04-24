<?php
/**
 * Display the resource links for the "bbPress Group".
 *
 * @package    bbPress Admin Bar Addition
 * @subpackage Resources
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
 * Resource links collection
 *
 * @since 1.0
 */
$menu_items = array(

	/** Support menu items */
	'bbpsupport' => array(
		'parent' => $bbpgroup_check_item,
		'title'  => __( 'bbPress Support Forum', 'bbpaba' ),
		'href'   => 'http://bbpress.org/forums/',
		'meta'   => array( 'title' => __( 'bbPress Support Forum', 'bbpaba' ) )
	),
	'bbpsupportwporg' => array(
		'parent' => $bbpsupport,
		'title'  => __( 'Free Support Forum (WP.org)', 'bbpaba' ),
		'href'   => 'http://wordpress.org/tags/bbpress?forum_id=10',
		'meta'   => array( 'title' => __( 'Free Support Forum (WP.org)', 'bbpaba' ) )
	),

	/** Documentation Base menu items */
	'bbpdocumentation' => array(
		'parent' => $bbpgroup_check_item,
		'title'  => __( 'bbPress Documentation', 'bbpaba' ),
		'href'   => 'http://codex.bbpress.org/',
		'meta'   => array( 'title' => _x( 'bbPress Documentation', 'Translators: For the tooltip', 'bbpaba' ) )
	),
	'bbpdocumentation-start' => array(
		'parent' => $bbpdocumentation,
		'title'  => __( 'Getting Started with bbPress', 'bbpaba' ),
		'href'   => 'http://codex.bbpress.org/getting-started-with-bbpress/',
		'meta'   => array( 'title' => __( 'Getting Started with bbPress', 'bbpaba' ) )
	),
	'bbpdocumentation-forumsettings' => array(
		'parent' => $bbpdocumentation,
		'title'  => __( 'Forum Settings', 'bbpaba' ),
		'href'   => 'http://codex.bbpress.org/forum-settings/',
		'meta'   => array( 'title' => __( 'Forum Settings', 'bbpaba' ) )
	),
	'bbpdocumentation-shortcodes' => array(
		'parent' => $bbpdocumentation,
		'title'  => __( 'bbPress Shortcodes', 'bbpaba' ),
		'href'   => 'http://codex.bbpress.org/shortcodes/',
		'meta'   => array( 'title' => __( 'bbPress Shortcodes', 'bbpaba' ) )
	),
	'bbpdocumentation-widgets' => array(
		'parent' => $bbpdocumentation,
		'title'  => __( 'bbPress Widgets', 'bbpaba' ),
		'href'   => 'http://codex.bbpress.org/widgets/',
		'meta'   => array( 'title' => __( 'bbPress Widgets', 'bbpaba' ) )
	),
	'bbpdocumentation-themes' => array(
		'parent' => $bbpdocumentation,
		'title'  => __( 'Theme Compatibility', 'bbpaba' ),
		'href'   => 'http://codex.bbpress.org/theme-compatibility/',
		'meta'   => array( 'title' => __( 'Theme Compatibility', 'bbpaba' ) )
	),

	/** Community Tips & Tricks menu items */
	'bbpknowledgebase' => array(
		'parent' => $bbpgroup_check_item,
		'title'  => __( 'bbPress 2.0 FAQ', 'bbpaba' ),
		'href'   => 'http://bbpress.org/forums/topic/bbpress-2-0-faq/',
		'meta'   => array( 'title' => _x( 'bbPress 2.0 FAQ', 'Translators: For the tooltip', 'bbpaba' ) )
	),
	'bbphooks' => array(
		'parent' => $bbpknowledgebase,
		'title'  => __( 'bbPress 2.0 Hooks &amp; Filters', 'bbpaba' ),
		'href'   => 'http://etivite.com/api-hooks/#bbpress',
		'meta'	 => array( 'title' => _x( 'bbPress 2.0 Hooks, Filters &amp; Components (Dev Docs)', 'Translators: For the tooltip', 'bbpaba' ) )
	),
	'bbpvideo-install' => array(
		'parent' => $bbpknowledgebase,
		'title'  => __( 'Video: bbPress Installation', 'bbpaba' ),
		'href'   => esc_url( BBPABA_VTUTORIALS_INSTALL ),
		'meta'	 => array( 'title' => _x( 'Video: bbPress Installation', 'Translators: For the tooltip', 'bbpaba' ) )
	),
	'bbpvideo-theming' => array(
		'parent' => $bbpknowledgebase,
		'title'  => __( 'Video: bbPress Theming', 'bbpaba' ),
		'href'   => esc_url( BBPABA_VTUTORIALS_THEMING ),
		'meta'	 => array( 'title' => _x( 'Video: bbPress Theming', 'Translators: For the tooltip', 'bbpaba' ) )
	),
	'bbpgetstarted' => array(
		'parent' => $bbpknowledgebase,
		'title'  => __( 'Getting Started with bbPress', 'bbpaba' ),
		'href'   => esc_url( BBPABA_TUTORIALS_STARTING ),
		'meta'	 => array( 'title' => _x( 'Getting Started with bbPress (Smashing Magazine)', 'Translators: For the tooltip', 'bbpaba' ) )
	),

	/** bbPress HQ menu items */
	'bbpsites' => array(
		'parent' => $bbpgroup_check_item,
		'title'  => __( 'bbPress HQ', 'bbpaba' ),
		'href'   => 'http://bbpress.org/',
		'meta'   => array( 'title' => __( 'bbPress HQ', 'bbpaba' ) )
	),
	'bbpblog' => array(
		'parent' => $bbpsites,
		'title'  => __( 'Official Blog', 'bbpaba' ),
		'href'   => 'http://bbpress.org/blog/',
		'meta'   => array( 'title' => __( 'Official Blog', 'bbpaba' ) )
	),
	'bbpdevel' => array(
		'parent' => $bbpsites,
		'title'  => __( 'Development Updates', 'bbpaba' ),
		'href'   => 'http://bbpdevel.wordpress.com/',
		'meta'   => array( 'title' => __( 'Development Updates', 'bbpaba' ) )
	),
	'bbptrac' => array(
		'parent' => $bbpsites,
		'title'  => __( 'Trac: Tickets &amp; Bug Reports', 'bbpaba' ),
		'href'   => 'http://bbpress.trac.wordpress.org/roadmap',
		'meta'   => array( 'title' => __( 'Trac: Tickets &amp; Bug Reports', 'bbpaba' ) )
	),
	'bbpplugins' => array(
		'parent' => $bbpsites,
		'title'  => __( 'More free plugins/extensions at WP.org', 'bbpaba' ),
		'href'   => 'http://wordpress.org/extend/plugins/tags/bbpress/',
		'meta'   => array( 'title' => __( 'More free plugins/extensions at WP.org', 'bbpaba' ) )
	),
	'bbpffnews' => array(
		'parent' => $bbpsites,
		'title'  => __( 'bbPress News Planet', 'bbpaba' ),
		'href'   => 'http://friendfeed.com/bbpress-news',
		'meta'   => array( 'title' => _x( 'bbPress News Planet (official and community news via FriendFeed service)', 'Translators: For the tooltip', 'bbpaba' ) )
	),
);
