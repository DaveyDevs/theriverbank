//--------------------------------------------------------------------//
// Global helper functions
//--------------------------------------------------------------------//

/**
 * Matches polyfill.
 *
 * @since 1.0.0
 */
if ( ! Element.prototype.matches ) {
	Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

/**
 * Closest polyfill.
 *
 * @since 1.0.0
 */
if ( ! Element.prototype.closest ) {
	Element.prototype.closest = function(s) {
		var el = this;

		do {
			if ( el.matches(s) ) return el;
			el = el.parentElement || el.parentNode;
		} while ( el !== null && el.nodeType === 1 );
		
		return null;
	};
}

/**
 * Index polyfill.
 *
 * @since 1.0.0
 */
var sinatraGetIndex = function(el) {
	var i = 0;

	while ( el = el.previousElementSibling ) {
		i++;
	};

	return i;
};

/**
 * Slide Up animation.
 *
 * @since 1.0.0
 *
 * @param  {[type]} target   Element to slide.
 * @param  {Number} duration Animation duration.
 */
var sinatraSlideUp = (target, duration = 500) => {
	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.boxSizing = 'border-box';
	target.style.height = target.offsetHeight + 'px';
	target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	window.setTimeout( () => {
		target.style.display = 'none';
		target.style.removeProperty('height');
		target.style.removeProperty('padding-top');
		target.style.removeProperty('padding-bottom');
		target.style.removeProperty('margin-top');
		target.style.removeProperty('margin-bottom');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
	}, duration);
}

/**
 * Slide Down animation.
 *
 * @since 1.0.0
 * 
 * @param  {[type]} target   Element to slide.
 * @param  {Number} duration Animation duration.
 */
var sinatraSlideDown = (target, duration = 500) => {
	target.style.removeProperty('display');
	let display = window.getComputedStyle(target).display;

	if ( display === 'none' ) {
		display = 'block';
	}

	target.style.display = display;
	let height = target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.boxSizing = 'border-box';
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + 'ms';
	target.style.height = height + 'px';
	target.style.removeProperty('padding-top');
	target.style.removeProperty('padding-bottom');
	target.style.removeProperty('margin-top');
	target.style.removeProperty('margin-bottom');
	window.setTimeout( () => {
		target.style.removeProperty('height');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
	}, duration);
}

/**
 * MoveTo - A lightweight scroll animation javascript library without any dependency.
 * Version 1.8.3 (21-07-2019 00:32)
 * Licensed under MIT
 * Copyright 2019 Hasan Aydoğdu <hsnaydd@gmail.com>
 */
var sinatraScrollTo = function() {
	
	/**
	 * Defaults
	 * @type {object}
	 */
	var defaults = {
		tolerance: 0,
		duration: 800,
		easing: 'easeOutQuart',
		container: window,
		callback: function callback() {}
	};

	/**
	 * easeOutQuart Easing Function
	 * @param  {number} t - current time
	 * @param  {number} b - start value
	 * @param  {number} c - change in value
	 * @param  {number} d - duration
	 * @return {number} - calculated value
	 */

	function easeOutQuart(t, b, c, d) {
		t /= d;
		t--;
		return -c * (t * t * t * t - 1) + b;
	}
	
	/**
	 * Merge two object
	 *
	 * @param  {object} obj1
	 * @param  {object} obj2
	 * @return {object} merged object
	 */
	function mergeObject(obj1, obj2) {
		var obj3 = {};
		Object.keys(obj1).forEach(function (propertyName) {
			obj3[propertyName] = obj1[propertyName];
		});
		Object.keys(obj2).forEach(function (propertyName) {
			obj3[propertyName] = obj2[propertyName];
		});
		return obj3;
	};

	/**
	 * Converts camel case to kebab case
	 * @param  {string} val the value to be converted
	 * @return {string} the converted value
	 */
	function kebabCase(val) {
		return val.replace(/([A-Z])/g, function ($1) {
			return '-' + $1.toLowerCase();
		});
	};

	/**
	 * Count a number of item scrolled top
	 * @param  {Window|HTMLElement} container
	 * @return {number}
	 */
	function countScrollTop(container) {
		if (container instanceof HTMLElement) {
			return container.scrollTop;
		}

		return container.pageYOffset;
	};

	/**
	 * sinatraScrollTo Constructor
	 * @param {object} options Options
	 * @param {object} easeFunctions Custom ease functions
	 */
	function sinatraScrollTo() {
		var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
		var easeFunctions = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
		this.options = mergeObject(defaults, options);
		this.easeFunctions = mergeObject({
			easeOutQuart: easeOutQuart
		}, easeFunctions);
	}

	/**
	 * Register a dom element as trigger
	 * @param  {HTMLElement} dom Dom trigger element
	 * @param  {function} callback Callback function
	 * @return {function|void} unregister function
	 */
	sinatraScrollTo.prototype.registerTrigger = function (dom, callback) {
		var _this = this;

		if (!dom) {
			return;
		}

		var href = dom.getAttribute('href') || dom.getAttribute('data-target'); // The element to be scrolled

		var target = href && href !== '#' ? document.getElementById(href.substring(1)) : document.body;
		var options = mergeObject(this.options, _getOptionsFromTriggerDom(dom, this.options));

		if (typeof callback === 'function') {
			options.callback = callback;
		}

		var listener = function listener(e) {
			e.preventDefault();

			_this.move(target, options);
		};

		dom.addEventListener('click', listener, false);
		return function () {
			return dom.removeEventListener('click', listener, false);
		};
	};

	/**
	 * Move
	 * Scrolls to given element by using easeOutQuart function
	 * @param  {HTMLElement|number} target Target element to be scrolled or target position
	 * @param  {object} options Custom options
	 */
	sinatraScrollTo.prototype.move = function (target) {
		var _this2 = this;

		var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

		if (target !== 0 && !target) {
			return;
		}

		options = mergeObject(this.options, options);
		var distance = typeof target === 'number' ? target : target.getBoundingClientRect().top;
		var from = countScrollTop(options.container);
		var startTime = null;
		var lastYOffset;
		distance -= options.tolerance; // rAF loop

		var loop = function loop(currentTime) {
			var currentYOffset = countScrollTop(_this2.options.container);

			if (!startTime) {
				// To starts time from 1, we subtracted 1 from current time
				// If time starts from 1 The first loop will not do anything,
				// because easing value will be zero
				startTime = currentTime - 1;
			}

			var timeElapsed = currentTime - startTime;

			if (lastYOffset) {
				if (distance > 0 && lastYOffset > currentYOffset || distance < 0 && lastYOffset < currentYOffset) {
					return options.callback(target);
				}
			}

			lastYOffset = currentYOffset;

			var val = _this2.easeFunctions[options.easing](timeElapsed, from, distance, options.duration);

			options.container.scroll(0, val);

			if (timeElapsed < options.duration) {
				window.requestAnimationFrame(loop);
			} else {
				options.container.scroll(0, distance + from);
				options.callback(target);
			}
		};

		window.requestAnimationFrame(loop);
	};

	/**
	 * Adds custom ease function
	 * @param {string}   name Ease function name
	 * @param {function} fn   Ease function
	 */
	sinatraScrollTo.prototype.addEaseFunction = function (name, fn) {
		this.easeFunctions[name] = fn;
	};

	/**
	 * Returns options which created from trigger dom element
	 * @param  {HTMLElement} dom Trigger dom element
	 * @param  {object} options The instance's options
	 * @return {object} The options which created from trigger dom element
	 */
	function _getOptionsFromTriggerDom(dom, options) {
		var domOptions = {};
		Object.keys(options).forEach(function (key) {
			var value = dom.getAttribute("data-mt-".concat(kebabCase(key)));

			if (value) {
				domOptions[key] = isNaN(value) ? value : parseInt(value, 10);
			}
		});
		return domOptions;
	}

	return sinatraScrollTo;
}();

/**
 * Get all of an element's parent elements up the DOM tree
 *
 * @since 1.0.0
 *
 * @param  {Node}   elem     The element.
 * @param  {String} selector Selector to match against [optional].
 * @return {Array}           The parent elements.
 */
var sinatraGetParents = (elem, selector) => {

	// Element.matches() polyfill.
	if ( ! Element.prototype.matches) {
		Element.prototype.matches =
			Element.prototype.matchesSelector ||
			Element.prototype.mozMatchesSelector ||
			Element.prototype.msMatchesSelector ||
			Element.prototype.oMatchesSelector ||
			Element.prototype.webkitMatchesSelector ||
			function(s) {
				var matches = (this.document || this.ownerDocument).querySelectorAll( s ),
					i = matches.length;
				while (--i >= 0 && matches.item( i ) !== this) {}
				return i > -1;
			};
	}

	// Setup parents array.
	var parents = [];

	// Get matching parent elements.
	for ( ; elem && elem !== document; elem = elem.parentNode ) {

		// Add matching parents to array.
		if ( selector ) {
			if ( elem.matches( selector ) ) {	
				parents.push( elem );
			}
		} else {
			parents.push( elem );
		}
	}
	return parents;
};

// CustomEvent() constructor functionality in Internet Explorer 9 and higher.
( function() {

	if (typeof window.CustomEvent === "function") return false;
	
	function CustomEvent(event, params) {
		params = params || { bubbles: false, cancelable: false, detail: undefined };
		var evt = document.createEvent('CustomEvent');
		evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
		return evt;
	}
	
	CustomEvent.prototype = window.Event.prototype;
	window.CustomEvent = CustomEvent;
} )();

/**
 * Trigger custom JS Event.
 * 
 * @since 1.0.0
 * 
 * @link https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent
 * @param {Node} el Dom Node element on which the event is to be triggered.
 * @param {Node} typeArg A DOMString representing the name of the event.
 * @param {String} A CustomEventInit dictionary, having the following fields:
 *			"detail", optional and defaulting to null, of type any, that is an event-dependent value associated with the event.	
 */
var sinatraTriggerEvent = function (el, typeArg) {
	var customEventInit = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  
	var event = new CustomEvent(typeArg, customEventInit);
	el.dispatchEvent(event);
};

// Main
( function() {

	//--------------------------------------------------------------------//
	// Variable caching
	//--------------------------------------------------------------------//

	var sinatraScrollButton = document.querySelector( '#si-scroll-top' );

	//--------------------------------------------------------------------//
	// Local helper functions
	//--------------------------------------------------------------------//

	/**
	 * Submenu overflow helper
	 * 
	 * @since 1.0.0
	 */
	var sinatraSmartSubmenus = () => {
		
		var el,
			elPosRight,
			elPosLeft,
			winRight;

		winRight = window.innerWidth;

		document.querySelectorAll('.sub-menu').forEach((item) => {
			
			// Set item to be visible so we can grab offsets
			item.style.visibility = 'visible';

			// Left offset
			const rect = item.getBoundingClientRect();
			elPosLeft  = rect.left + window.pageXOffset;

			// Right offset
			elPosRight = elPosLeft + rect.width;

			// Remove styles
			item.removeAttribute('style');

			// Decide where to open
			if ( elPosRight > winRight ) {
				item.closest( 'li' ).classList.add( 'opens-left' );
			} else if ( elPosLeft < 0 ) {
				item.closest( 'li' ).classList.add( 'opens-right' );
			}
		});
	};

	/**
	 * Debounce functions for better performance
	 * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
	 *
	 * @since 1.0.0
	 * 
	 * @param  {Function} fn The function to debounce
	 */
	var sinatraDebounce = (fn) => {

		// Setup a timer
		var timeout;

		// Return a function to run debounced
		return function () {

			// Setup the arguments
			var context = this;
			var args = arguments;

			// If there's a timer, cancel it
			if (timeout) {
				window.cancelAnimationFrame(timeout);
			}

			// Setup the new requestAnimationFrame()
			timeout = window.requestAnimationFrame(function () {
				fn.apply(this, args);
			});
		}
	};

	/**
	 * Handles Scroll to Top button click
	 * 
	 * @since 1.0.0
	 */
	var sinatraScrollTopButton = () => {

		if ( null === sinatraScrollButton ) {
			return;
		}

		if ( window.pageYOffset > 450 || document.documentElement.scrollTop > 450 ) {
			sinatraScrollButton.classList.add( 'si-visible' );
		} else {
			sinatraScrollButton.classList.remove( 'si-visible' );
		}
	};

	/**
	 * Handles smooth scrolling of elements that have 'si-smooth-scroll' class.
	 * 
	 * @since 1.0.0
	 */
	var sinatraSmoothScroll = () => {

		const scrollTo = new sinatraScrollTo({
			tolerance: null === document.getElementById('wpadminbar') ? 0 : document.getElementById('wpadminbar').getBoundingClientRect().height,
		});

		const scrollTriggers = document.getElementsByClassName('si-smooth-scroll');

		for ( var i = 0; i < scrollTriggers.length; i++ ) {
			scrollTo.registerTrigger(scrollTriggers[i]);
		}
	};

	/**
	 * Menu accessibility.
	 *
	 * @since 1.0.0
	 */
	var sinatraMenuAccessibility = () => {
		
		if ( ! document.body.classList.contains('si-menu-accessibility') ) {
			return;
		}

		document.querySelectorAll('.sinatra-nav').forEach((menu) => {

			// aria-haspopup
			menu.querySelectorAll('ul').forEach((subMenu) => {
				subMenu.parentNode.setAttribute('aria-haspopup', 'true');
			});

			// Dropdown visibility on focus
			menu.querySelectorAll('a').forEach((link) => {
				link.addEventListener('focus', sinatraMenuFocus, true);
				link.addEventListener('blur', sinatraMenuFocus, true);
			});
		});
	};

	/**
	 * Helper function that toggles .hovered on focused/blurred menu items.
	 *
	 * @since 1.0.0
	 */
	function sinatraMenuFocus() {

		var self = this;

		// Move up until we find .sinatra-nav
		while ( ! self.classList.contains('sinatra-nav') ) {

			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( ! self.classList.contains('hovered') ) {
					self.classList.add('hovered');
				} else {
					self.classList.remove('hovered');
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Helps with accessibility for keyboard only users.
	 *
	 * @since 1.0.0
	 */
	var sinatraKeyboardFocus = () => {
		document.body.addEventListener( 'keydown', function(e) {
			document.body.classList.add('using-keyboard');
		});

		document.body.addEventListener( 'mousedown', function(e) {
			document.body.classList.remove('using-keyboard');
		});
	};

	/**
	 * Adds visibility delay on navigation submenus.
	 * 
	 * @since 1.0.0
	 */
	var sinatraDropdownDelay = () => {
		
		var hoverTimer = null;

		document.querySelectorAll('.sinatra-nav .menu-item-has-children').forEach((item) => {
			item.addEventListener('mouseenter', function() {
				document.querySelectorAll('.menu-item-has-children').forEach((subitem) => {
					subitem.classList.remove('hovered');
				});	
			});
		});

		document.querySelectorAll('.sinatra-nav .menu-item-has-children').forEach((item) => {
			item.addEventListener('mouseleave', function(){
				item.classList.add('hovered');

				if ( null !== hoverTimer ) {
					clearTimeout( hoverTimer );
					hoverTimer = null;
				}

				hoverTimer = setTimeout(() => {
					item.classList.remove('hovered');

					item.querySelectorAll('.menu-item-has-children').forEach((childItem) => {
						childItem.classList.remove('hovered');
					})
				}, 700 );
			});
		})
	};

	/**
	 * Handles header search widget functionality.
	 * 
	 * @since 1.0.0
	 */
	var sinatraHeaderSearch = () => {
		var searchButton = document.querySelectorAll('.si-search');

		if ( 0 === searchButton.length ) {
			return;
		}

		searchButton.forEach((item) => {
			item.addEventListener( 'click', (e) => {
				e.preventDefault();

				if ( item.classList.contains( 'sinatra-active' ) ) {
					close_search(item);
				} else {
					show_search(item);
				}
			});
		});

		// Show search.
		var show_search = function( item ) {

			// Make search visible
			document.body.classList.add('si-search-visible');

			setTimeout( function() {

				// Highlight the search icon
				item.classList.add('sinatra-active');

				// Focus the input
				if ( null !== item.nextElementSibling && null !== item.nextElementSibling.querySelector('input') ) {
					item.nextElementSibling.querySelector('input').focus();
					item.nextElementSibling.querySelector('input').select();
				}

			}, 100 );

			// Attach the ESC listener
			document.addEventListener( 'keydown', esc_close_search );

			// Attach the outside click listener
			document.getElementById('page').addEventListener('click', outside_close_search);
		};

		// Close search
		var close_search = function( item ) {

			// Animate out
			document.body.classList.remove('si-search-visible');

			// Unhighlight the search icon
			item.classList.remove( 'sinatra-active' );

			// Unhook the ESC listener
			document.removeEventListener( 'keydown', esc_close_search );

			// Unhook the click listener
			document.getElementById('page').removeEventListener('click', outside_close_search);
		};

		// Esc support to close search
		var esc_close_search = function(e) {
			if ( e.keyCode == 27 ) {
				document.querySelectorAll('.si-search').forEach((item) => {
					close_search(item);
				});
			}
		};

		// Close search when clicked anywhere outside the search box
		var outside_close_search = function(e) {
			if ( null === e.target.closest('.si-search-container') && null === e.target.closest('.si-search') ) {
				document.querySelectorAll('.si-search').forEach((item) => {
					close_search(item);
				});
			}
		};
	};

	/**
	 * Handles mobile menu functionality.
	 * 
	 * @since 1.0.0
	 */
	var sinatraMobileMenu = () => {

		var page = document.getElementById( 'page' ),
			nav = document.querySelector( '#sinatra-header-inner .sinatra-nav' ),
			current;

		document.querySelectorAll( '.si-mobile-nav > button' ).forEach( (item) => {
			item.addEventListener( 'click', function(e) {
				e.preventDefault();

				if ( document.body.parentNode.classList.contains( 'is-mobile-menu-active' ) ) {
					close_menu();
				} else {
					show_menu();
				}
			}, false );
		})

		// Helper functions.
		var show_menu = function(e) {

			// Add the active class.
			document.body.parentNode.classList.add( 'is-mobile-menu-active' );

			// Hook the ESC listener
			document.addEventListener( 'keyup', esc_close_menu );

			// Hook the click listener
			if ( null !== page ) {
				page.addEventListener( 'click', outside_close_menu );
			}

			// Hook the click listener for submenu toggle.
			document.querySelectorAll( '#sinatra-header .sinatra-nav' ).forEach( (item) => {
				item.addEventListener( 'click', submenu_toggle );
			});

			// Slide down the menu.
			sinatraSlideDown( nav, 250 );
		};

		var close_menu = function(e) {

			// Remove the active class.
			document.body.parentNode.classList.remove( 'is-mobile-menu-active' );

			// Unhook the ESC listener
			document.removeEventListener( 'keyup', esc_close_menu );

			// Unhook the click listener
			if ( null !== page ) {
				page.removeEventListener( 'click', outside_close_menu );
			}

			// Unhook the click listener for submenu toggle.
			document.querySelectorAll( '#sinatra-header .sinatra-nav' ).forEach( (item) => {
				item.removeEventListener( 'click', submenu_toggle );
			});

			// Slide up the menu.
			sinatraSlideUp( nav, 250 );
		};

		var outside_close_menu = function(e) {
			if ( null === e.target.closest( '.si-hamburger' ) && null === e.target.closest( '.site-navigation' ) ) {
				close_menu();
			}
		};

		var esc_close_menu = function(e) {
			if ( e.keyCode == 27 ) {
				close_menu();
			}
		};

		var submenu_toggle = function(e) {

			if ( e.target.parentElement.querySelectorAll('.sub-menu').length ) {
				e.preventDefault();

				current = e.target.parentElement;

				// Show or hide the sub menu.
				if ( current.classList.contains( 'si-open' ) ) {
					
					current.querySelectorAll( '.sub-menu' ).forEach( (submenu) => {
						submenu.style.display = 'none';
					});
					current.classList.remove( 'si-open' );

					// Close all submenus automatically.
					current.querySelectorAll( 'li' ).forEach( (item) => {
						item.classList.remove( 'si-open' );
						item.querySelectorAll( '.sub-menu' ).forEach( (submenu) => {
							submenu.style.display = 'none';
						});
					})

				} else {

					current.querySelectorAll( '.sub-menu' ).forEach( (submenu) => {
						submenu.style.display = 'block';
					});
					current.classList.add( 'si-open' );
				}
			}
		};
	};

	/**
	 * Sinatra preloader.
	 * 
	 * @since 1.0.0
	 */
	var sinatraPreloader = (timeout = 0) => {
		var preloader = document.getElementById('si-preloader');

		if ( null === preloader ) {
			return;
		}

		var delay = 250;

		var hide_preloader = () => {

			if ( document.body.classList.contains('si-loaded') ) {
				return;
			}

			// Start fade out animation.
			document.body.classList.add('si-loading');

			setTimeout( function() {
				// Fade out animation completed - set display none
				document.body.classList.replace('si-loading', 'si-loaded');

				// Dispatch event when preloader is done
				sinatraTriggerEvent(document.body, 'si-preloader-done');
			}, delay );
		};

		// Set timeout or hide immediately
		if ( timeout > 0 ) {
			setTimeout( function() {
				hide_preloader();
			}, timeout );
		} else {
			hide_preloader();
		}

		return false;
	};

	/**
	 * Handles comments toggle functionality.
	 * 
	 * @since 1.0.0
	 */
	var sinatraToggleComments = () => {

		if ( ! document.body.classList.contains('sinatra-has-comments-toggle') ) {
			return;
		}

		var toggleComments = (e) => {
			if ( 'undefined' !== typeof e ) {
				e.preventDefault();
			}
			
			if ( document.body.classList.contains('comments-visible')) {
				document.body.classList.remove('comments-visible');
				document.getElementById('sinatra-comments-toggle').querySelector( 'span' ).innerHTML = sinatra_vars.strings.comments_toggle_show;
			} else {
				document.body.classList.add('comments-visible');
				document.getElementById('sinatra-comments-toggle').querySelector( 'span' ).innerHTML = sinatra_vars.strings.comments_toggle_hide;
			}
		};

		if ( null !== document.getElementById('sinatra-comments-toggle') && ( -1 !== location.href.indexOf("#comment") || -1 !== location.href.indexOf("respond") ) ) {
			toggleComments();
		}

		document.getElementById('sinatra-comments-toggle').addEventListener( 'click', toggleComments );
	};

	/**
	 * Handles toggling and smooth scrolling when clicked on "Comments" link
	 * 
	 * @since 1.0.0
	 */
	var sinatraCommentsClick = () => {

		var commentsLink = document.querySelector('.single .comments-link');

		if ( null === commentsLink ) {
			return;
		}

		commentsLink.addEventListener('click', function(e) {

			// Show comments if hidden under a toggle
			if ( document.body.classList.contains('sinatra-has-comments-toggle') && ! document.body.classList.contains('comments-visible') ) {
				document.getElementById('sinatra-comments-toggle').click();
			}
		});
	};

	//--------------------------------------------------------------------//
	// Events
	//--------------------------------------------------------------------//

	// DOM ready
	document.addEventListener('DOMContentLoaded', function () {
		sinatraPreloader(5000);
		sinatraMenuAccessibility();
		sinatraKeyboardFocus();
		sinatraScrollTopButton();
		sinatraSmoothScroll();
		sinatraDropdownDelay();
		sinatraToggleComments();
		sinatraHeaderSearch();
		sinatraMobileMenu();
		sinatraSmartSubmenus();
		sinatraCommentsClick();
	});

	// Window load
	window.addEventListener('load', function () {
		sinatraPreloader();
	});

	// Scroll
	window.addEventListener('scroll', function() {
		sinatraDebounce( sinatraScrollTopButton() );
	});

	// Resize
	window.addEventListener('resize', function() {
		sinatraDebounce( sinatraSmartSubmenus() );
	});

	// Sinatra ready
	sinatraTriggerEvent(document.body, 'si-ready');

	//--------------------------------------------------------------------//
	// Global
	//--------------------------------------------------------------------//

	window.sinatra = window.sinatra || {};

	// Make preloader function available globally (needed for Customizer preview)
	window.sinatra.preloader = sinatraPreloader;
} )();
