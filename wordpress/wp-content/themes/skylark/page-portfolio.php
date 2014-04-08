<?php
/*
 * Template Name: Portfolio Template
 *
 * @package Skylark
 * @since Skylark 1.6
*/
get_header();

?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'skylark' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'skylark' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			<?php endwhile; ?>

			<div id="portfolio-wrap">
				<section class="portfolio">

					<?php // Display the latest 24 video, gallery, and image posts that have a featured image. 24 was chosen because it's divisible by 3
						$portfolio_args = array(
							'posts_per_page' => 24
						);

						$count = 0; // Set up a variable to count the number of posts so that we can break them up into rows

						$portfolio_query = new WP_Query( $portfolio_args );
					?>
						<ul class="portfolio-posts clear-fix">
							<?php

								while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();

									if ( '' != get_the_post_thumbnail() ) :
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'skylark-portfolio-thumbnail' ); // get the thumbnail image
										// If the thumbnail image is at least as wide as our minimum featured image width, display it along with the post excerpt.
										if ( $image >= 280 ) :

											// Show only image, video, and gallery posts
											if ( 'image' == get_post_format() || 'video' == get_post_format() || 'gallery' == get_post_format() ) :

												$count++;

												if ( 1 <= $count ) :
									?>
													<li <?php post_class(); ?>>

														<div class="feature-thumbnail">
															<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
																<span class="post-format-icon"><?php echo get_post_format(); ?></span>
																<?php the_post_thumbnail( 'skylark-portfolio-thumbnail', array( 'class' => 'skylark-portfolio-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?>
															</a>
														</div><!-- .feature-thumbnail -->

														<header>
															<h3 class="entry-title">
																<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
															</h3><!-- .entry-title -->
														</header>

														<div class="entry-summary">
															<?php the_excerpt(); ?>
															<?php edit_post_link( __( 'Edit', 'skylark' ), '<span class="edit-link">', '</span>' ); ?>
														</div><!-- .entry-summary -->

													</li><!-- .hentry -->

											<?php if ( $count % 3 == 0 ) : // After every 3rd post, end the row and start a new one. ?>
												</ul><!-- .portfolio-posts -->
												<ul class="portfolio-posts clear-fix">
											<?php endif; ?>
								<?php
											endif; // end check for at least one post
										endif; // end check for post formats
									endif; // end check for minimum thumbnail size
								endif; // end check for existence of post thumbnails
							endwhile; // end of the loop
							?>
							</ul><!-- .portfolio-posts -->

					<?php wp_reset_query(); ?>

				</section><!-- .portfolio-->
			</div><!-- #portfolio-wrap -->

		</div><!-- #content -->
	</div><!-- #primary .site-content -->

<?php get_footer(); ?>