<?php
/*
 * Template Name: Showcase Page
 *
 * @package Skylark
 * @since Skylark 1.6
*/
get_header();

?>

<div id="showcase-wrap">

	<?php // If the user has filled out a brief introductory message in the theme options, display it here
		$options = skylark_get_theme_options();

		if ( '' != $options['intro_text'] ) :
	?>
	<section id="intro" class="introduction">
		<p><?php echo esc_html( stripslashes( $options['intro_text'] ) ); ?></p>
	</section><!-- .introduction -->
	<?php endif; ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php
				$options = skylark_get_theme_options();
				$primary_category = $options['primary_category'];
				$categories = array();
			?>

			<?php if ( ! empty( $primary_category ) ) { ?>

				<!-- Begin featured category section. -->
				<section id="category-highlight">

				<?php
					/* We need to first get the blog category IDs. Category IDs are stored inside a stdClass object.
					/* Let's cycle through get_categories() and place into an array the IDs of categories that are either the primary
					/* featured category OR categories that are children of the primary featured category. */

					foreach ( get_categories() as $object ) {
						if ( cat_is_ancestor_of( $primary_category, $object->term_id ) || $object->term_id == $primary_category ) :
							array_push( $categories, $object->term_id );
						endif;
					}

					/* Now that we have our featured categories, let's display their posts in a nice
					/* news-like block. We're listing categories in alphabetical order and
					/* will display up to 6 posts in each block. If a post has already appeared in the slider, it WON'T
					/* be duplicated here. */

					foreach ( $categories as $cat ) {

						$loop = new WP_Query( array(
							'category__in'   => $cat,
							'posts_per_page' => 4,
							'post__not_in'   => skylark_get_featured_posts( 'ids-only' ),
						) );

						if ( $loop->have_posts() ) :
				?>
							<div class="category-section clear-fix">
								<header class="category-header">
									<?php $term = get_term( $cat, 'category' ); ?>
									<h1 class="category-title"><a href="<?php echo get_term_link( $term, 'category' ); ?>" title="<?php echo esc_attr( $term->name ); ?>"><?php echo $term->name; ?></a></h1>
								<?php if ( '' != $term->description ) : ?>
										<h2 class="category-description"><?php echo $term->description; ?></h2>
								<?php endif; ?>
								</header>

								<?php while ( $loop->have_posts() ) : $loop->the_post();

									$featured_post_ids[] = get_the_ID();

									/* Let's show a thumbnail (if it exists), title, and excerpt for each post */
								?>
									<article <?php post_class(); ?>>
										<?php if ( '' != get_the_post_thumbnail() ) : ?>
											<div class="feature-thumbnail">
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
													<span class="post-format-icon"><?php echo get_post_format(); ?></span>
													<?php the_post_thumbnail( 'skylark-small-thumbnail', array( 'class' => 'skylark-small-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?>
												</a>
											</div><!-- .feature-thumbnail -->
										<?php endif; // end check for post thumbnail existence ?>

										<header>
											<h3 class="entry-title">
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
											</h3><!-- .entry-title -->
										</header>

										<div class="entry-summary">
											<?php the_excerpt(); ?>
											<?php edit_post_link( __( 'Edit', 'skylark' ), '<span class="edit-link">', '</span>' ); ?>
										</div><!-- .entry-summary -->

									</article><!-- .hentry -->

								<?php

									endwhile;

									wp_reset_query();
								?>

							</div><!-- .category-section -->

						<?php endif; //end the check for existence of posts

					} //end foreach ?>

				</section><!-- .category-highlight -->

			<?php } // end check for primary category option ?>

		</div><!-- #content -->
	</div><!-- #primary .site-content -->
</div><!-- #showcase-wrap -->

<?php get_footer(); ?>