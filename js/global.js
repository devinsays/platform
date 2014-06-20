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
			$window: $(window),
			$primarynavigation: $('.primary-navigation')
		},

		// Init functions
		init: function() {
			this.bindEvents();
		},

		// Bind Elements
		bindEvents: function() {
			var self = this;

			self.navigationInit();

			this.cache.$document.on( 'ready', function() {
				self.fitVidsInit();
			} );
		},

		/**
		 * Initialize the mobile menu functionality.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		navigationInit: function() {

			var self = this;

			if ( ! this.cache.$primarynavigation ) {
				return;
			}

			this.cache.$menutoggle = this.cache.$primarynavigation.find( '.menu-toggle' ).eq(0);
			this.cache.$menu = this.cache.$primarynavigation.find( 'ul' ).eq(0);

			// Add class to the menu
			if ( ! this.cache.$menu.hasClass('nav-menu') )
				this.cache.$menu.addClass('nav-menu');

			// Add dropdown toggle to display child menu items.
			$('.main-navigation > div > ul > .page_item_has_children, .main-navigation > div > ul > .menu-item-has-children').append( '<span class="dropdown-toggle" />');

			// When mobile menu is tapped/clicked
			this.cache.$menutoggle.on( 'click', function() {
				if ( ! self.cache.$primarynavigation.hasClass('toggled') ) {
					self.cache.$menu.slideDown( '400', function() {
						self.cache.$primarynavigation.addClass('toggled');
					});
				} else {
					self.cache.$menu.slideUp( '400', function(){
						self.cache.$primarynavigation.removeClass('toggled');
					});
				}
			});

			// When mobile submenu is tapped/clicked
			$('.dropdown-toggle').click( function() {
				var $submenu = $(this).parent().find('.children,.sub-menu'),
					$toggle = $(this);
				if ( ! $(this).hasClass('toggled') ) {
					$submenu.slideDown( '400', function() {
						$toggle.addClass('toggled');
					});
				} else {
					$submenu.slideUp( '400', function(){
						$toggle.removeClass('toggled');
					});
				}
			});

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