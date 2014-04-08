<?php $options = get_neutral_option(); ?>
 <div id="footer">
  <ul id="copyright">
   <li style="background:none;"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></li>
   <li><a href="http://www.mono-lab.net/" class="target_blank"><?php _e('Theme designed by mono-lab','neutral'); ?></a></li>
   <li><a href="http://wordpress.org/" class="target_blank"><?php _e('Powered by WordPress','neutral'); ?></a></li>
  </ul>
  <?php if ($options['show_return_top']) : ?>
  <a href="#wrapper" id="return_top"><?php _e('Return top','neutral'); ?></a>
  <?php endif; ?>
 </div><!-- END #footer -->

</div><!-- END #wrapper -->
<?php wp_footer(); ?>
</body>
</html>