/**
 * Editor registration for the breadcrumbs block. The block is rendered by PHP
 * on the front end; the editor shows a static preview of the trail format.
 */
( function ( blocks, blockEditor, element, i18n ) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'cerrajeros-canillejas/breadcrumbs', {
		edit: function () {
			var props = blockEditor.useBlockProps( { className: 'cc-breadcrumbs' } );
			return el(
				'nav',
				props,
				el(
					'ol',
					{ className: 'cc-breadcrumbs__list' },
					el( 'li', { className: 'cc-breadcrumbs__item' }, el( 'a', { href: '#' }, __( 'Inicio', 'cerrajeros-canillejas' ) ) ),
					el( 'li', { className: 'cc-breadcrumbs__item' }, el( 'a', { href: '#' }, __( 'Blog', 'cerrajeros-canillejas' ) ) ),
					el( 'li', { className: 'cc-breadcrumbs__item', 'aria-current': 'page' }, __( 'Página actual', 'cerrajeros-canillejas' ) )
				)
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.element, window.wp.i18n );
