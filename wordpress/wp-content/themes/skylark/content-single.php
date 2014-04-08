<?php
/**
 * @package Skylark
 * @since Skylark 1.6
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php skylark_posted_on(); ?>
			<span class="sep"> &#149; </span>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'skylark' ) );
				if ( $categories_list && skylark_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'skylark' ), $categories_list ); ?>
			</span>
			<span class="sep"> &#149; </span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'skylark' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'skylark' ), $tags_list ); ?>
			</span>
			<span class="sep"> &#149; </span>
			<?php endif; // End if $tags_list ?>

			<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'skylark' ), __( '1 Comment', 'skylark' ), __( '% Comments', 'skylark' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( '(Edit)', 'skylark' ), '<span class="edit-link"><span class="sep"> &#149; </span>', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	
	<div class="entry-content">
	
	<?php if ( 'image' != get_post_format() && 'gallery' != get_post_format() && 'video' != get_post_format() ) : ?>

			<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'skylark-single', array( 'class' => 'skylark-blog-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?></a>
			</div>
<?php else : ?>
<div class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'skylark' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'skylark-single-full', array( 'class' => 'skylark-blog-thumbnail', 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?></a>
			</div>
<?php endif; ?>

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'skylark' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->