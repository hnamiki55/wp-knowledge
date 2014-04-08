<?php get_header(); ?>

<div class="row">
<div class="nine columns">

	<div id="single=page" role="main">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?>>
			<h1 id="post-<?php the_ID(); ?>" class="page-title">
			<?php the_title(); ?>
			</h1>

	<article class="page-content">
<div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'sagan' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									wp_get_attachment_url(),
									$metadata['width'],
									$metadata['height'],
									get_permalink( $post->post_parent ),
									esc_attr( get_the_title( $post->post_parent ) ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( 'Edit', 'sagan' ), '<span class="sep"> &bull; </span> <span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->

						<nav id="image-navigation" class="site-navigation">
							<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'sagan' ) ); ?></span>
							<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'sagan' ) ); ?></span>
						</nav><!-- #image-navigation -->
					</header><!-- .entry-header -->

					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
								<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$attachments = array_values( get_children( array(
										'post_parent'    => $post->post_parent,
										'post_status'    => 'inherit',
										'post_type'      => 'attachment',
										'post_mime_type' => 'image',
										'order'          => 'ASC',
										'orderby'        => 'menu_order ID'
									) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID == $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>

								<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'chalkboard_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
							</div><!-- .attachment -->

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sagan' ), 'after' => '</div>' ) ); ?>

					</div><!-- .entry-content -->
	</article>
<div style="clear:both;"></div>
<!-- .page-content -->
</div>

		<?php endwhile; ?>

<section id="commentbox">
	<?php comments_template(); ?>
</section>

<?php else : ?>
	<h2 class="center">
		<?php _e('Nothing is Here - Page Not Found', 'sagan'); ?>
	</h2>

	<div class="entry-content">
	<p><?php _e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'sagan' ); ?></p>
	</div><!-- .entry-content -->
<?php endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
