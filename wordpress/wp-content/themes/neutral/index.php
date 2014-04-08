<?php get_header(); $options = get_neutral_option(); ?>
  <div id="contents" class="clearfix">

   <div id="left_col">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post">
     <h2 class="post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
     <?php if ($options['show_date'] or $options['show_author']) { ?>
     <ul class="post_info">
      <?php if ($options['show_date']): ?><li><?php the_time(__('M jS. Y', 'neutral')) ?></li><?php endif; ?>
      <?php if ($options['show_author']) : ?><li><?php _e('By ','neutral'); ?><?php the_author_posts_link(); ?></li><?php endif; ?>
      <?php edit_post_link(__('[ EDIT ]', 'neutral'), '<li class="post_edit">', '</li>' ); ?>
     </ul>
     <?php }; ?>
     <div class="post_content clearfix">
      <?php the_content(__('Read more', 'neutral')); ?>
      <?php wp_link_pages(); ?>
     </div>
    </div>
    <div class="post_meta">
     <?php if ($options['show_category'] or $options['show_tag'] or $options['show_comment']) { ?>
     <ul class="clearfix">
      <?php if ($options['show_category']): ?><li class="post_category"><?php the_category(' . '); ?></li><?php endif; ?>
      <?php if ($options['show_tag']): ?><?php the_tags('<li class="post_tag">', ' . ', '</li>'); ?><?php endif; ?>
      <?php if ($options['show_comment']): ?><li class="post_comment"><?php comments_popup_link(__('Write comment', 'neutral'), __('1 comment', 'neutral'), __('% comments', 'neutral')); ?></li><?php endif; ?>
     </ul>
     <?php }; ?>
    </div>

    <?php endwhile; else: ?>

    <div class="post">
     <h2 class="post_title"><?php _e("Sorry, but you are looking for something that isn't here.","neutral"); ?></h2>
    </div>

    <?php endif; ?>

    <?php if ($options['pager'] == 'pager') { ?>
    <?php include('navigation.php'); ?>
    <?php } else { ?>
    <div id="prev_next_post" class="clearfix">
     <p class="next_post"><?php next_posts_link( __( 'Older posts', 'neutral' ) ); ?></p>
     <p class="prev_post"><?php previous_posts_link( __( 'Newer posts', 'neutral' ) ); ?></p>
    </div>
    <?php }; ?>

   </div><!-- END #left_col -->

   <?php if($options['layout'] == 'right') { ?>
    <?php get_sidebar(); ?>
   <?php }; ?>

  </div><!-- END #contents -->
<?php get_footer(); ?>