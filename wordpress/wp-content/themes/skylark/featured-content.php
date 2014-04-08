<?php
/*
 * Template for the Featured Content Slider
 *
 * @package Skylark
 * @since Skylark 1.6
*/
?>

<?php get_header(); ?>

<?php $featured_posts = skylark_get_featured_posts(); ?>

<?php if ( ! empty( $featured_posts ) ) : ?>
	<section class="featured-wrapper">
		<div class="featured-nav-wrapper">
			<div id="featured-content" class="clear-fix">
			<?php foreach ( (array) $featured_posts as $order => $post ) : setup_postdata( $post ); ?>
				<article class="<?php echo ( 0 == $order ) ? 'featured-post first' : 'featured-post'; ?>">
					<div class="featured-post-content">
						<header>
							<h1 class="post-title entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h1>
						</header>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					</div><!-- .featured-post-content-->
					<div class="featured-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
							<?php the_post_thumbnail( 'skylark-featured-thumbnail' ); ?>
						</a>
					</div><!-- .featured-thumbnail -->
				</article><!-- .featured-post -->
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
			</div><!-- .featured-content -->
			<span id="slider-prev" class="slider-nav">&larr;</span>
			<span id="slider-next" class="slider-nav">&rarr;</span>
		</div><!--.featured-nav-wrapper -->
	</section><!-- .featured-wrapper -->
<?php endif; ?>