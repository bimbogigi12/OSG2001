( function( $ ) {
	'use strict';

	/**
	 * Navigation menu component.
	 */
	var Crowley_Menu = function() {

		var self = this;

		/**
		 * Calculate the space available and trigger the display of the dropdown.
		 */
		this.dropdown = function() {
			var menu_item = $( this );

			var sub_menu = $( '> .sub-menu', menu_item ),
				window_width = $( window ).width();

			if ( sub_menu.length ) {
				sub_menu.css( 'margin-left', '' );
				sub_menu.css( 'width', '' );

				menu_item.removeClass( 'crowley-expand-left crowley-expand-right' );

				var sub_menu_width = sub_menu.outerWidth(),
					sub_menu_offset_left = sub_menu.offset().left;

				if ( sub_menu_width <= window_width ) {
					if ( sub_menu_offset_left >= 0 ) {
						menu_item.addClass( 'crowley-expand-left' );
					}

					if ( menu_item.parent().hasClass( 'sub-menu' ) || menu_item.parent().hasClass( 'children' ) ) {
						sub_menu_offset_left +=  menu_item.parent().outerWidth();
					}

					if ( sub_menu_offset_left + sub_menu_width <= window_width ) {
						menu_item.addClass( 'crowley-expand-right' );
					}
				}
			}
		};

		/**
		 * Undo the display of the dropdown.
		 */
		this.dropdown_out = function() {
			var menu_item = $( this );

			menu_item.removeClass( 'crowley-hover' );
			$( '.crowley-hover', menu_item ).removeClass( 'crowley-hover' );
		};

		/**
		 * Event binding.
		 */
		this.bind = function() {
			var selector = '.menu > .menu-item-has-children, .menu > .page_item_has_children, .menu li .menu-item-has-children, .menu li .page_item_has_children';

			/* Menu trigger */
			if ( $( '.crowley-nav-trigger' ).length ) {
				$( '.crowley-nav-trigger' ).on( 'click', function() {
					$( window ).scrollTop( 0 );
					$( 'body' ).toggleClass( 'crowley-menu-open' );
				} );
			}

			$( document ).on( 'mouseenter', selector, self.dropdown );
			$( document ).on( 'mouseleave', selector, self.dropdown_out );

			$( document ).on( 'focus', '.menu li a', self.add_focus );
			$( document ).on( 'blur', '.menu li a', self.remove_focus );
		};

		/**
		 * Remove focus from a menu item.
		 */
		this.remove_focus = function() {
			$( '.crowley-hover' ).removeClass( 'crowley-hover' );
		};

		/**
		 * Add focus to a menu item.
		 */
		this.add_focus = function() {
			var branches = $( this ).parents( 'li' );

			self.dropdown.apply( branches.first() );

			branches.addClass( 'crowley-hover' );
			$( '.crowley-hover' ).not( branches ).removeClass( 'crowley-hover' );
		};

		/**
		 * Expand submenu.
		 */
		$( document ).on( 'click', '.crowley-nav .menu-item-has-children a > span, .crowley-nav .page_item_has_children a > span,.crowley-nav .menu-item-has-children a[href="#"], .crowley-nav .page_item_has_children a[href="#"],.crowley-nav .menu-item-has-children a:not([href]), .crowley-nav .page_item_has_children a:not([href])', function() {
			var open_class = 'crowley-mn-s-open';

			if ( $( this ).is( 'a' ) ) {
				$( this ).toggleClass( open_class );
			}
			else {
				$( this ).parents( 'a' ).first().toggleClass( open_class );
			}

			return false;
		});

		/**
		 * Boot submenu.
		 */
		this.add_submenu_marker = function() {
			$( '.crowley-nav .menu-item-has-children > a, .crowley-nav .page_item_has_children > a' ).append( ' <span></span>' );
		};

		/**
		 * Initialization.
		 */
		this.init = function() {
			self.bind();

			this.add_submenu_marker();
		};

		this.init();

	};

	( new Crowley_Menu() );

} )( jQuery );
