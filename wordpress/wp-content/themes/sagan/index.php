<?php get_header(); ?>
<?php if(is_home() && !is_paged()) { ?>
<?php global $sagan_options;
	$sagan_settings = get_option( 'sagan_options', $sagan_options );
?>
<?php if ( $sagan_settings['home_headline'] !='' ) { ?>
<div class="row">
<div class="sixteen columns">
<h1 id="home-headline">
<?php echo $sagan_settings['home_headline']; ?>
</h1>
</div>
</div>
<?php } ?>
<?php if( $sagan_settings['orbit_slider'] ) : ?>
<div class="row">
	<div class="sixteen columns">
	  <div id="slider">

<?php if ( $sagan_settings['slider_image_one'] !='' ) { ?>

<div data-caption="#captionOne">
<span class="orbit-caption" id="captionOne">
<a href="<?php echo $sagan_settings['slider_image_one_link']; ?>">
<?php echo $sagan_settings['slider_image_caption_one']; ?></a></span>
		<a href="<?php echo $sagan_settings['slider_image_one_link']; ?>">
		<img src="<?php echo $sagan_settings['slider_image_one']; ?>" alt="" />
		</a>
</div>
		<?php } ?>
		<?php if ( $sagan_settings['slider_image_two'] !='' ) { ?>
<div data-caption="#captionTwo">
<span class="orbit-caption" id="captionTwo">
<a href="<?php echo $sagan_settings['slider_image_two_link']; ?>">
<?php echo $sagan_settings['slider_image_caption_two']; ?></a></span>
<a href="<?php echo $sagan_settings['slider_image_one_link']; ?>">
		<img src="<?php echo $sagan_settings['slider_image_two']; ?>" alt="" />
		</a>
</div>
		<?php } ?>
		<?php if ( $sagan_settings['slider_image_three'] !='' ) { ?>
<div data-caption="#captionThree">
<span class="orbit-caption" id="captionThree">
<a href="<?php echo $sagan_settings['slider_image_three_link']; ?>">
<?php echo $sagan_settings['slider_image_caption_three']; ?></a></span>
		<a href="<?php echo $sagan_settings['slider_image_three_link']; ?>">
		<img src="<?php echo $sagan_settings['slider_image_three']; ?>" alt="" />
		</a>
</div>
		<?php } ?>
		<?php if ( $sagan_settings['slider_image_four'] !='' ) { ?>
<div data-caption="#captionFour">
<span class="orbit-caption" id="captionFour">
<a href="<?php echo $sagan_settings['slider_image_four_link']; ?>">
<?php echo $sagan_settings['slider_image_caption_four']; ?></a></span>
		<a href="<?php echo $sagan_settings['slider_image_four_link']; ?>">
		<img src="<?php echo $sagan_settings['slider_image_four']; ?>" alt="" />\
		</a>
</div>
		<?php } ?>
		<?php if ( $sagan_settings['slider_image_five'] !='' ) { ?>
<div data-caption="#captionFive">
<span class="orbit-caption" id="captionFive">
<a href="<?php echo $sagan_settings['slider_image_five_link']; ?>">
<?php echo $sagan_settings['slider_image_caption_five']; ?></a></span>
		<a href="<?php echo $sagan_settings['slider_image_five_link']; ?>">
		<img src="<?php echo $sagan_settings['slider_image_five']; ?>" alt="" />
		</a>
</div>
		<?php } ?>
		
	  </div>
	  <hr />
	</div>
  </div>
<?php endif; ?>
<!-- Three-up Content Blocks -->
  
<div class="row">

<div class="sixteen columns home-widget-area">

<div class="four columns">

<?php do_action( 'before_widget' ); ?>

		<?php if ( !dynamic_sidebar( 'home-1' ) ) : ?>

		<?php endif; ?>

</div>

<div class="four columns">

<?php do_action( 'before_widget' ); ?>

		<?php if ( !dynamic_sidebar( 'home-2' ) ) : ?>

		<?php endif; ?>

</div>

<div class="four columns">

<?php do_action( 'before_widget' ); ?>

		<?php if ( !dynamic_sidebar( 'home-3' ) ) : ?>

		<?php endif; ?>

</div>

<div class="four columns">

<?php do_action( 'before_widget' ); ?>

		<?php if ( !dynamic_sidebar( 'home-4' ) ) : ?>

		<?php endif; ?>

</div>

</div>

</div>

<div class="row"><hr></div>
<div class="row">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="eight columns">
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
<h5 class="latest-title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
<?php
$thetitle = $post->post_title; /* or you can use get_the_title() */
$getlength = strlen($thetitle);
$thelength = 45;
echo substr($thetitle, 0, $thelength);
if ($getlength > $thelength) echo "...";
?>
</a></h5>
<?php the_excerpt(); ?>
</article>
</div>
<?php endwhile; ?>
</div>
<?php endif; ?>
<div class="row">
<div class="ten columns centered">
<section id="post-nav">
<?php posts_nav_link(); ?>
</section><!--End Navigation-->
</div>
</div>
<?php } ?>
<?php if(is_paged()) { ?>
<div class="row">
<div class="twelve columns">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
<h2 class="index-title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<?php echo sagan_content(100); ?>
</article>
<?php endwhile; ?>
<section id="post-nav" role="navigation">
<?php posts_nav_link(); ?>
</section><!--End Navigation-->
<?php endif; ?>
</div>
<?php get_sidebar(); ?>

</div>
<?php } ?>
<?php get_footer(); ?>