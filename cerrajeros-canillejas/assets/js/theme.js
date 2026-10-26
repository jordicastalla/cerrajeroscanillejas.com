/**
 * Cerrajeros Canillejas — progressive enhancement.
 *
 * Nothing here is required to read or use the site: without this script all
 * content is visible, links work and scrolling is native. It only adds:
 *  - reveal-on-scroll for elements marked .cc-reveal (and slide titles),
 *  - the active state of the 01–07 index and header links,
 *  - hiding the mobile call bar while another call button is on screen,
 *  - a decorative copper cursor ring for fine pointers.
 * It never intercepts wheel, touch or keyboard scrolling.
 */
( function () {
	'use strict';

	var doc = document;
	var root = doc.documentElement;
	var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	var hasIO = 'IntersectionObserver' in window;

	/* Reveal on scroll ---------------------------------------------------- */
	function setupReveals() {
		if ( reduceMotion.matches || ! hasIO ) {
			return;
		}

		var items = Array.prototype.slice.call(
			doc.querySelectorAll( '.cc-reveal, .cc-deck .cc-slide__title' )
		);

		if ( ! items.length ) {
			return;
		}

		var viewport = window.innerHeight || root.clientHeight;
		// Titles are revealed with clip-path, which would also clip their
		// intersection rectangle, so their parent is observed instead.
		var groups = new Map();

		items.forEach( function ( el ) {
			el.classList.add( 'cc-reveal' );
			var rect = el.getBoundingClientRect();
			// Anything already on screen stays visible: no flash on load.
			if ( rect.top < viewport && rect.bottom > 0 ) {
				el.classList.add( 'is-visible' );
				return;
			}
			var target = el.classList.contains( 'cc-slide__title' ) ? el.parentElement : el;
			if ( ! groups.has( target ) ) {
				groups.set( target, [] );
			}
			groups.get( target ).push( el );
		} );

		root.classList.add( 'cc-motion' );

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						( groups.get( entry.target ) || [] ).forEach( function ( el ) {
							el.classList.add( 'is-visible' );
						} );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ rootMargin: '0px 0px -10% 0px', threshold: 0 }
		);

		groups.forEach( function ( els, target ) {
			observer.observe( target );
		} );
	}

	/* Active slide -------------------------------------------------------- */
	function setupActiveSlide() {
		var slides = doc.querySelectorAll( '.cc-deck .cc-slide[id]' );

		if ( ! slides.length || ! hasIO ) {
			return;
		}

		var links = Array.prototype.slice.call(
			doc.querySelectorAll( 'nav.cc-deck-index a[href*="#"], nav.cc-nav-primary a[href*="#"]' )
		);

		function hashOf( href ) {
			var i = href.indexOf( '#' );
			return i === -1 ? '' : href.slice( i + 1 );
		}

		function activate( id ) {
			links.forEach( function ( link ) {
				var on = hashOf( link.getAttribute( 'href' ) ) === id;
				var item = link.closest( '.wp-block-navigation-item' );
				if ( item ) {
					item.classList.toggle( 'is-active', on );
				}
				if ( link.closest( 'nav.cc-deck-index' ) ) {
					if ( on ) {
						link.setAttribute( 'aria-current', 'true' );
					} else {
						link.removeAttribute( 'aria-current' );
					}
				}
			} );
			root.setAttribute( 'data-cc-slide', id );
		}

		var visible = {};

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					visible[ entry.target.id ] = entry.isIntersecting ? entry.intersectionRatio : 0;
				} );

				var best = '';
				var bestRatio = 0;
				Object.keys( visible ).forEach( function ( id ) {
					if ( visible[ id ] > bestRatio ) {
						best = id;
						bestRatio = visible[ id ];
					}
				} );

				if ( best ) {
					activate( best );
				}
			},
			{ threshold: [ 0, 0.2, 0.4, 0.6, 0.8, 1 ], rootMargin: '-20% 0px -35% 0px' }
		);

		Array.prototype.forEach.call( slides, function ( slide ) {
			observer.observe( slide );
		} );
	}

	/* Mobile call bar ----------------------------------------------------- */
	function setupMobileCall() {
		var bar = doc.querySelector( '.cc-mobile-call' );

		if ( ! bar || ! hasIO ) {
			return;
		}

		var targets = doc.querySelectorAll( '.cc-hero__call, .cc-contact__phone, .cc-cta-band' );
		if ( ! targets.length ) {
			return;
		}

		var onScreen = new Set();

		var observer = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					onScreen.add( entry.target );
				} else {
					onScreen.delete( entry.target );
				}
			} );
			bar.classList.toggle( 'is-hidden', onScreen.size > 0 );
		} );

		Array.prototype.forEach.call( targets, function ( target ) {
			observer.observe( target );
		} );
	}

	/* Cursor ring --------------------------------------------------------- */
	function setupCursor() {
		var finePointer = window.matchMedia( '(hover: hover) and (pointer: fine)' );

		if ( ! finePointer.matches || reduceMotion.matches ) {
			return;
		}

		var ring = doc.createElement( 'div' );
		ring.className = 'cc-cursor';
		ring.setAttribute( 'aria-hidden', 'true' );
		doc.body.appendChild( ring );

		var x = 0;
		var y = 0;
		var cx = 0;
		var cy = 0;
		var raf = 0;
		var interactive = 'a, button, summary, input, textarea, select, label, [role="button"]';

		function frame() {
			cx += ( x - cx ) * 0.22;
			cy += ( y - cy ) * 0.22;
			ring.style.transform = 'translate3d(' + cx.toFixed( 1 ) + 'px,' + cy.toFixed( 1 ) + 'px,0)';
			if ( Math.abs( x - cx ) > 0.1 || Math.abs( y - cy ) > 0.1 ) {
				raf = window.requestAnimationFrame( frame );
			} else {
				raf = 0;
			}
		}

		doc.addEventListener(
			'pointermove',
			function ( event ) {
				if ( event.pointerType !== 'mouse' ) {
					return;
				}
				x = event.clientX;
				y = event.clientY;
				ring.classList.add( 'is-visible' );
				if ( ! raf ) {
					raf = window.requestAnimationFrame( frame );
				}
			},
			{ passive: true }
		);

		doc.addEventListener( 'pointerover', function ( event ) {
			var target = event.target;
			ring.classList.toggle( 'is-hover', !! ( target.closest && target.closest( interactive ) ) );
		} );

		doc.documentElement.addEventListener( 'pointerleave', function () {
			ring.classList.remove( 'is-visible' );
		} );
	}

	function init() {
		setupReveals();
		setupActiveSlide();
		setupMobileCall();
		setupCursor();
	}

	if ( doc.readyState === 'loading' ) {
		doc.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
