<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
<div class="row">
<div class="sixteen columns">
<div class="single-page" role="main">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
<?php if(!is_front_page()) { ?>
<h1 id="post-<?php the_ID(); ?>" class="article-title">
<?php the_title(); ?>
</h1>
<?php } ?>
<section class="post-content">
<?php the_content(); ?>
</section><!-- .post-content -->
</article>
<?php endwhile; ?>
<?php comments_template(); ?>
<?php else : ?>
<h2 class="center"><?php esc_attr_e('Nothing is Here - Page Not Found', 'sagan'); ?></h2>
<div class="entry-content">
<p><?php esc_attr_e( 'Sorry, but we couldn\'t find what you we\'re looking for.', 'sagan' ); ?></p>
</div><!-- .entry-content -->
<?php endif; ?>
</div><!--End Single Article-->
</div>
</div>
<?php get_footer(); ?>