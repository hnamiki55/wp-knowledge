
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content post_content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newschannel' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'newschannel' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
