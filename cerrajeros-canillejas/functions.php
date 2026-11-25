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
 * <title> al principio del bloque de Rank Math o Yoast SEO
 * ---------------------------------------------------------------------- */

/*
 * En los temas de bloques, WordPress añade su <title>
 * (_block_template_render_title_tag) al elegir la plantilla, después de que
 * los plugins registren sus hooks. Con title-tag declarado, Rank Math y Yoast
 * imprimen su propio <title> al principio de su bloque (antes de la meta
 * description); Yoast intenta quitar el del núcleo, pero lo hace antes de que
 * se añada. Para no tener dos, se quita el del núcleo cuando hay uno de los
 * dos plugins. Sin ellos no cambia nada: sigue saliendo el del núcleo.
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
		if ( false === has_action( 'wp_head', '_block_template_render_title_tag' ) ) {
			return;
		}
		$rank_math = false !== has_action( 'rank_math/head', '_wp_render_title_tag' );
		$yoast     = current_theme_supports( 'title-tag' ) && has_action( 'wpseo_head' );
		if ( $rank_math || $yoast ) {
			remove_action( 'wp_head', '_block_template_render_title_tag', 1 );
		}
	},
	0
);
