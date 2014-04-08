<?php $options = get_neutral_option(); ?>

<div id="right_col">

 <?php if ($options['information_contents']) : ?>
 <div class="side_box">
  <h3 class="side_title"><?php echo ($options['information_title']); ?></h3>
  <?php echo wpautop($options['information_contents']); ?>
 </div>
 <?php endif; ?>

<?php if(is_active_sidebar('top')||is_active_sidebar('bottom')||is_active_sidebar('left')||is_active_sidebar('right')){ ?>

 <div id="side_top">
  <?php dynamic_sidebar('top'); ?>
 </div>
 <div id="side_middle" class="clearfix">
  <div id="side_left">
   <?php dynamic_sidebar('left'); ?>
  </div>
  <div id="side_right">
   <?php dynamic_sidebar('right'); ?>
  </div>
 </div>
 <div id="side_bottom">
  <?php dynamic_sidebar('bottom'); ?>
 </div>

<?php } else { ?>

 <div id="side_top">
  <div class="side_box">
   <h3 class="side_title"><?php _e('RECENT ENTRY','neutral'); ?></h3>
   <ul>
    <?php $myposts = get_posts('numberposts=5'); foreach($myposts as $post) : ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endforeach; ?>
   </ul>
  </div>
 </div>

 <div id="side_middle" class="clearfix">
  <div id="side_left">
   <div class="side_box_short">
    <h3 class="side_title"><?php _e('CATEGORY','neutral'); ?></h3>
    <ul>
     <?php wp_list_categories('title_li='); ?>
    </ul>
   </div>
  </div>
  <div id="side_right">
   <div class="side_box_short">
    <h3 class="side_title"><?php _e('ARCHIVES','neutral'); ?></h3>
    <ul>
     <?php wp_get_archives('type=monthly'); ?>
    </ul>
   </div>
  </div>
 </div><!-- END #side_middle_ex -->

 <div id="side_bottom">
  <div class="side_box">
   <h3 class="side_title"><?php _e('LINKS','neutral'); ?></h3>
   <ul>
    <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
   </ul>
  </div>
 </div>

 <?php }; ?>

</div><!-- END #right_col -->