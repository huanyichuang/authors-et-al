(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

})( jQuery );

// If .et-al exists, add the CSS property left with the value of the largest width of .author.
// This is to make sure that the .et-al is aligned with the last .author.
(function(){
	if ( document.querySelector( '.et-al' ) ) {
		var authors = document.querySelectorAll( '.et-al-author' );
		var largest_width = 0;
		for ( var i = 0; i < authors.length; i++ ) {
			if ( authors[i].offsetWidth > largest_width ) {
				largest_width = authors[i].offsetWidth;
			}
		}
		document.querySelector( '.et-al' ).style.left = largest_width + 'px';
	}
})();