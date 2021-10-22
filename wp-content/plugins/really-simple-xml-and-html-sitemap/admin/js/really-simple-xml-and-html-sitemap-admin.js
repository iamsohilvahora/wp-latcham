(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function() {
		$('body').on("click", ".post-types input[type='checkbox']",  function(e) {
            if( $(this).val() == 'page' && $(this).is(':checked') ){
                $('.exc_pageids').addClass('d-none');
			}else if( $(this).val() == 'page' && !$(this).is(':checked') ){
                $('.exc_pageids').removeClass('d-none');
			}
        });
		
		if ( $('.post-types').length > 0 ) {
            $('.post-types td input').each(function(){
				if( $(this).val() == 'page' && $(this).is(':checked') ){
					$('.exc_pageids').addClass('d-none');
				}
			});
        }
	});
	
	$( window ).load(function() {
		
	});

})( jQuery );
