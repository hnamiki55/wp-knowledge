  <!-- Footer -->
  
  <footer class="row">
	<div class="sixteen columns">
	  <hr />
	  <div class="row">
		<div class="seven columns">
		<div id="colophon">
		  <small>&copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?>
		<?php global $sagan_options; $sagan_settings = get_option( 'sagan_options', $sagan_options ); ?>
		<?php if( $sagan_settings['footer_link']) : ?> - <a href="http://www.edwardrjenkins.com/" rel="nofollow">
<?php esc_attr_e( 'Sagan Theme by Edward R. Jenkins' , 'sagan' ); ?>
</a>
<?php else: ?>
<?php esc_attr_e( 'Sagan Theme by Edward R. Jenkins' , 'sagan' ); ?>
<?php endif; ?>
</small>
</div>
		</div>
		<div class="nine columns">
<nav id="footermenu" role="navigation"><?php wp_nav_menu( array( 'theme_location' => 'bottom-menu' ) ); ?></nav>
		</div>
	  </div>
	</div>
  </footer>
</div>
<?php wp_footer(); ?>
</body>
</html>