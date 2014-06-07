/*!
 * Script for initializing globally-used functions and libs.
 *
 * @since 1.0.0
 */
 (function($) {

 	var platform = {

 		// Cache selectors
	 	cache: {
			$document: $(document),
			$window: $(window)
		},

		// Init functions
		init: function() {
			this.bindEvents();
		},

		// Bind Elements
		bindEvents: function() {
			var self = this;

			this.cache.$document.on( 'ready', function() {
				self.fitVidsInit();
			} );
		},

		// Initialize FitVids
		fitVidsInit: function() {

			// Make sure lib is loaded.
			if (!$.fn.fitVids) {
				return;
			}

			// Run FitVids
			$('.hentry').fitVids();
		}


 	};
 	platform.init();

 })(jQuery);