( function( $ ){

	/* Remove a class from the body tag if JavaScript is enabled */
	$( 'body' ).removeClass( 'no-js' );

	/* Cycle */
	$( '#featured-content' ).cycle( {
		slideExpr: '.featured-post',
		fx: 'fade',
		speed: 500,
		timeout: 6000,
		slideResize: true,
		containerResize: false,
		width: '100%',
		fit: 1,
		prev: '#slider-prev',
		next: '#slider-next',
	} );
} )( jQuery );