<?php get_header(); ?>
<div class="row">
<div class="twelve columns">
<div class="single-page" role="main">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
<h2 id="post-<?php the_ID(); ?>" class="article-title">
<?php the_title(); ?>
</h1>
</a>
<section class="post-content">
<?php the_excerpt(); ?>
</section><!-- .post-content -->
</article>
<?php endwhile; ?>
<?php comments_template(); ?>
<?php else : ?>
<h2 class="center"><?php esc_attr_e('Nothing is Here - Search Result Not Found', 'sagan'); ?></h2>
<div class="entry-content">
<p><?php esc_attr_e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'sagan' ); ?></p>
</div><!-- .entry-content -->
<?php endif; ?>
</div><!--End Single Article-->
</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>