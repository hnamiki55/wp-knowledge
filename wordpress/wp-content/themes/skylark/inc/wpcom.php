<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * @package Skylark
 * @since Skylark 1.6
 */

global $themecolors;

/**
 * Set a default theme color array for WP.com.
 *
 * @global array $themecolors
 * @since skylark 1.0
 */
$themecolors = array(
	'bg' => 'FFFFFF',
	'border' => '4286CC',
	'text' => '333333',
	'link' => 'CC6A22',
	'url' => 'CC6A22',
);

// Dequeue the font script if the blog has WP.com Custom Design.
function skylark_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) ) {
		if ( TypekitData::get( 'upgraded' ) ) {
			$customfonts = TypekitData::get( 'families' );

			if ( ! $customfonts )
				return;

			$site_title = $customfonts['site-title'];
			$headings = $customfonts['headings'];
			$body_text = $customfonts['body-text'];

			if ( $site_title['id'] && $headings['id'] && $body_text['id'] ) {
				wp_dequeue_style( 'open-sans' );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'skylark_dequeue_fonts' );