<?php
/**
 * Template Name: Full-Width Page
 *
 * The template for displaying a full-width page.
 *
 * @package Skylark
 * @since Skylark 1.6
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php get_footer(); ?>