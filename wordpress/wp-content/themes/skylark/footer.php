<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Skylark
 * @since Skylark 1.6
 */
?>

	</div><!-- #main -->
</div><!-- #page .hfeed .site -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">
		<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a>
		<?php printf( __( 'Theme: %1$s by %2$s.', 'skylark' ), 'Skylark', '<a href="http://blankthemes.com/" rel="designer">Blank Themes</a>' ); ?>
	</div><!-- .site-info -->
</footer><!-- .site-footer .site-footer -->

<?php wp_footer(); ?>

</body>
</html>