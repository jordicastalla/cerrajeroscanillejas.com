<?php
/**
 * Cerrajeros Canillejas — child theme of Prime FSE.
 *
 * The visual system lives in theme.json, the block templates, template parts
 * and patterns. PHP is limited to what block markup cannot express on its own:
 * asset loading, pattern/block-style registration, a breadcrumbs block,
 * FAQ microdata, and local-business structured data.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

define( 'CERRAJEROS_CANILLEJAS_VERSION', '1.4.0' );

require_once __DIR__ . '/inc/business.php';
require_once __DIR__ . '/inc/setup.php';
require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/breadcrumbs.php';
require_once __DIR__ . '/inc/block-enhancements.php';
require_once __DIR__ . '/inc/seo.php';

/* -------------------------------------------------------------------------
 * <title> al principio del bloque de Rank Math
 * ---------------------------------------------------------------------- */

/*
 * En los temas de bloques, WordPress imprime el <title> con
 * _block_template_render_title_tag(), después del bloque de Rank Math.
 * Con title-tag declarado, Rank Math lo imprime él mismo al principio de su
 * bloque (rank_math/head, prioridad 1, antes de la meta description). Para
 * no tener dos, se quita el del núcleo solo cuando están enganchados ambos.
 * Sin Rank Math no cambia nada: sigue saliendo el <title> del núcleo.
 */
add_action(
	'after_setup_theme',
	static function () {
		add_theme_support( 'title-tag' );
	}
);
add_action(
	'wp_head',
	static function () {
		if ( false !== has_action( 'wp_head', '_block_template_render_title_tag' )
			&& false !== has_action( 'rank_math/head', '_wp_render_title_tag' ) ) {
			remove_action( 'wp_head', '_block_template_render_title_tag', 1 );
		}
	},
	0
);
