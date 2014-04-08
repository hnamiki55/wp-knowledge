<?php get_header(); ?>

	<div id="subhead_container">
		
		<div class="row">

		<div class="twelve columns">
		
	<h1><?php _e( 'Error 404 - Page Not Found.', 'discover' ); ?></h1>
			
			</div>	
			
	</div></div>
	
		<!--content-->
		<div class="row" id="content_container">
			
			<!--left col--><div class="twelve columns">

					
					<div class="post-entry">

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'discover' ); ?></p>
                <h3><?php _e( 'This might be because:', 'discover' ); ?></h3>
             <p><?php _e( 'You have typed the web address incorrectly, or the page you were looking for may have been moved, updated or deleted.', 'discover' ); ?></p>
               <h3><?php _e( 'Please try the following options instead:', 'discover' ); ?></h3>
               <p><?php _e( 'Check for a mis-typed URL error, then press the refresh button on your browser or Use the search box below.', 'discover' ); ?></p>
			<?php get_search_form(); ?>  
						
					</div><!--post-entry end-->
					

</div> <!--column end-->

</div>
<!--content end-->
		

<?php get_footer(); ?>