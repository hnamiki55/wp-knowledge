<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Skylark
 * @since Skylark 1.6
 */

get_header(); ?>

		<div id="primary" class="site-content">
			<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php skylark_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary .site-content -->

<?php if ( 'image' != get_post_format() && 'gallery' != get_post_format() && 'video' != get_post_format() )
	get_sidebar();
?>
<?php get_footer(); ?>