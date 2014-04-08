<?php get_header(); ?>
<div class="row">
<div class="twelve columns centered">
<div id="404-page">
<article id="post-0" class="post error404 no-results not-found">
<header class="entry-header">
<h1 class="entry-title"><?php esc_attr_e( '404 - Oops. Page Not Found', 'sagan' ); ?></h1>
</header>
<div class="ten columns centered">
<h4><?php _e ('The page you\'re looking for has gone extinct.', 'sagan'); ?></h4>
<p><?php esc_attr_e( 'Maybe you should try searching', 'sagan' ); ?></p>
<?php get_search_form(); ?>
</div>
</article><!-- #post-0 -->
</div>
</div>
<?php get_footer(); ?>