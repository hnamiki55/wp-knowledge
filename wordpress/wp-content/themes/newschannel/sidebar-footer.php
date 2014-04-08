<?php
/**
 * The sidebar/widget area just above the footer - for the homepage and archives/categories page.
 */
?>
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : 
		// Checks if any widget is activated in the Footer sidebar.
		// If there's no widget then the sidebar container/box will not be displayed.  ?>
        
			<div id="footer-widget">
				<div id="widget-wrap" class="clearfix">
            		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
            	</div>
            </div>
        
		<?php endif; ?>