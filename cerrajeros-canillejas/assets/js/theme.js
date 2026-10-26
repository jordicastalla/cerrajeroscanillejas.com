/**
 * Cerrajeros Canillejas — progressive enhancement.
 *
 * Nothing here is required to read or use the site: without this script all
 * content is visible, links work and scrolling is native. It only adds:
 *  - reveal-on-scroll for elements marked .cc-reveal (and slide titles),
 *  - the active state of the 01–07 index and header links,
 *  - hiding the mobile call bar while another call button is on screen,
 *  - the "rodar cilindro" transition between front-page slides,
 *  - a decorative copper cursor ring for fine pointers.
 * It never intercepts wheel, touch or keyboard scrolling: it only reads the
 * scroll position.
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
			// "Servicios" stays highlighted while any of its sections is active.
			Array.prototype.forEach.call(
				doc.querySelectorAll( 'nav.cc-nav-primary .wp-block-navigation-submenu' ),
				function ( submenu ) {
					submenu.classList.toggle(
						'is-active',
						!! submenu.querySelector( '.wp-block-navigation__submenu-container .is-active' )
					);
				}
			);
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

	/* Drum transition ("rodar cilindro") ---------------------------------- */
	/*
	 * The slides behave like the faces of a drum. The slide entering from
	 * below pivots on its top edge with its bottom receding; the slide leaving
	 * at the top pivots on its bottom edge with its top receding. Both share
	 * the same edge, so they stay joined as the drum turns. Progress is the
	 * distance an edge has travelled between the bottom of the viewport and
	 * the bottom of the sticky header; a slide at rest gets no transform.
	 */
	function setupDrum() {
		var slides = Array.prototype.slice.call( doc.querySelectorAll( '.cc-deck > .cc-slide' ) );

		if ( slides.length < 2 || ! window.requestAnimationFrame ) {
			return;
		}

		var query = window.matchMedia( '(min-width: 900px) and (prefers-reduced-motion: no-preference)' );
		var header = doc.querySelector( '.cc-site-header' );
		var flat = 0.04;
		var maxAngle = 40;
		var perspective = '950px';
		var fade = 0.75;

		// Intensity comes from CSS custom properties on :root (theme.css), so
		// it can be tuned without touching this file.
		function readSettings() {
			var css = window.getComputedStyle( root );
			var angle = parseFloat( css.getPropertyValue( '--cc-drum-angle' ) );
			var depth = css.getPropertyValue( '--cc-drum-perspective' ).trim();
			var dim = parseFloat( css.getPropertyValue( '--cc-drum-fade' ) );

			maxAngle = isFinite( angle ) ? Math.max( 0, Math.min( 80, angle ) ) : maxAngle;
			perspective = depth || perspective;
			fade = isFinite( dim ) ? Math.max( 0, Math.min( 1, dim ) ) : fade;
		}
		var pending = false;
		var enabled = false;

		function clear( slide ) {
			slide.style.transform = '';
			slide.style.transformOrigin = '';
			slide.style.opacity = '';
		}

		function update() {
			pending = false;

			var viewport = window.innerHeight || root.clientHeight;
			var line = header ? Math.max( 0, header.getBoundingClientRect().bottom ) : 0;
			var span = Math.max( 1, viewport - line );
			// Layout positions (offsetTop/offsetHeight) ignore the transform this
			// function applies, so the rotation never feeds back into itself.
			var scrolled = window.pageYOffset || root.scrollTop || 0;
			var rects = slides.map( function ( slide ) {
				var top = 0;
				for ( var node = slide; node; node = node.offsetParent ) {
					top += node.offsetTop;
				}
				top -= scrolled;
				return { top: top, bottom: top + slide.offsetHeight };
			} );

			slides.forEach( function ( slide, index ) {
				var rect = rects[ index ];
				var amount = 0;
				var origin = '';

				// One pixel of tolerance: an edge sitting on the header line or the
				// bottom of the viewport is "at rest", not crossing.
				if ( index > 0 && rect.top > line + 1 && rect.top < viewport - 1 ) {
					amount = -( rect.top - line ) / span;
					origin = '50% 0%';
				} else if ( rect.bottom > line + 1 && rect.bottom < viewport - 1 ) {
					amount = ( viewport - rect.bottom ) / span;
					origin = '50% 100%';
				}

				var size = Math.min( 1, Math.abs( amount ) );

				if ( size <= flat ) {
					clear( slide );
					return;
				}

				size = ( size - flat ) / ( 1 - flat );
				slide.style.transformOrigin = origin;
				slide.style.transform = 'perspective(' + perspective + ') rotateX(' + ( ( amount < 0 ? -1 : 1 ) * size * maxAngle ).toFixed( 2 ) + 'deg)';
				slide.style.opacity = ( 1 - fade * size ).toFixed( 3 );
			} );
		}

		function request() {
			if ( ! pending ) {
				pending = true;
				window.requestAnimationFrame( update );
			}
		}

		function toggle() {
			if ( query.matches && ! enabled ) {
				enabled = true;
				readSettings();
				root.classList.add( 'cc-drum' );
				window.addEventListener( 'scroll', request, { passive: true } );
				window.addEventListener( 'resize', request, { passive: true } );
				request();
			} else if ( ! query.matches && enabled ) {
				enabled = false;
				root.classList.remove( 'cc-drum' );
				window.removeEventListener( 'scroll', request );
				window.removeEventListener( 'resize', request );
				slides.forEach( clear );
			}
		}

		if ( query.addEventListener ) {
			query.addEventListener( 'change', toggle );
		} else if ( query.addListener ) {
			query.addListener( toggle );
		}

		toggle();
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
		setupDrum();
		setupCursor();
	}

	if ( doc.readyState === 'loading' ) {
		doc.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
