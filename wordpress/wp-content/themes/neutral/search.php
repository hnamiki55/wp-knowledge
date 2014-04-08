<?php get_header(); $options = get_neutral_option(); ?>
  <div id="contents" class="clearfix">

   <div id="left_col">
<?php if (have_posts()) : ?>

    <div id="search_result">
     <p><?php _e('Search results for ', 'neutral'); echo '[ <span id="keyword">' .$s. "</span> ]"; ?> - <?php $my_query =& new WP_Query("s=$s & showposts=-1"); echo $my_query->post_count; _e(' hit', 'neutral'); ?></p>	
    </div>

<?php while ( have_posts() ) : the_post(); ?>

    <div class="search_result_content">
     <h2 class="post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
     <?php if ($options['show_date'] or $options['show_author']) { ?>
     <ul class="post_info">
      <?php if ($options['show_date']): ?><li><?php the_time(__('M jS. Y', 'neutral')) ?></li><?php endif; ?>
      <?php if ($options['show_author']) : ?><li><?php _e('By ','neutral'); ?><?php the_author_posts_link(); ?></li><?php endif; ?>
      <?php edit_post_link(__('[ EDIT ]', 'neutral'), '<li class="post_edit">', '</li>' ); ?>
     </ul>
     <?php }; ?>
     <p><a href="<?php the_permalink() ?>"><?php the_excerpt_rss(); ?><span class="read_more"><?php _e('[ READ MORE ]', 'neutral'); ?></span></a></p>
    </div>

<?php endwhile; else: ?>
    <div class="post">
     <h2 class="post_title"><?php _e("Sorry, but you are looking for something that isn't here.","neutral"); ?></h2>
    </div>
<?php endif; ?>

    <div class="search_result_pager">
    <?php if ($options['pager'] == 'pager') { ?>
    <?php include('navigation.php'); ?>
    <?php } else { ?>
    <div id="prev_next_post" class="clearfix">
     <p class="next_post"><?php next_posts_link( __( 'Older posts', 'neutral' ) ); ?></p>
     <p class="prev_post"><?php previous_posts_link( __( 'Newer posts', 'neutral' ) ); ?></p>
    </div>
    <?php }; ?>
    </div>

   </div><!-- END #left_col -->

   <?php if($options['layout'] == 'right') { ?>
    <?php get_sidebar(); ?>
   <?php }; ?>

  </div><!-- END #contents -->
<?php get_footer(); ?>