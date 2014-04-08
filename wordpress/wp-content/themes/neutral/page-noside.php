<?php
/*
Template Name:No sidebar
*/
?>
<?php get_header(); $options = get_neutral_option(); ?>
  <div id="contents" class="clearfix">

   <div id="left_col">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="post">
     <h1 class="post_title" style="margin-bottom:20px;"><?php the_title(); ?></h1>
     <div class="post_content">
      <?php the_content(__('Read more', 'neutral')); ?>
      <?php wp_link_pages(); ?>
     </div>
    </div>

<?php endwhile; else: ?>
    <div class="post">
     <p><?php _e("Sorry, but you are looking for something that isn't here.","neutral"); ?></p>
    </div>
<?php endif; ?>

    <?php if ($options['show_comment']): ?>
    <div id="comments_wrapper">
     <?php if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); } ?>
    </div>
    <?php endif; ?>

   </div><!-- END #left_col -->

  </div><!-- END #contents -->
<?php get_footer(); ?>