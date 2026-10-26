<?php
/**
 * Theme setup: supports, editor styles, pattern category, block styles,
 * the breadcrumbs block and the parent-theme adjustments a child theme needs.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

/**
 * Theme supports and editor styles.
 */
function setup() {
	load_child_theme_textdomain( 'cerrajeros-canillejas', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/theme.css', 'assets/css/editor.css' ) );

	// Prime FSE recommends Getwid, Getwid Mega Menu and other plugins through
	// TGMPA. This child theme only uses core blocks, so the "required plugins"
	// notice would be misleading. The parent file stays untouched.
	remove_action( 'tgmpa_register', 'prime_fse_register_required_plugins' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup', 20 );

/**
 * Pattern category, block styles and the breadcrumbs block.
 */
function register_editor_features() {
	register_block_pattern_category(
		'cerrajeros-canillejas',
		array(
			'label'       => __( 'Cerrajeros Canillejas', 'cerrajeros-canillejas' ),
			'description' => __( 'Diapositivas de la portada y componentes de la marca.', 'cerrajeros-canillejas' ),
		)
	);

	$styles = array(
		'core/group'   => array(
			array( 'name' => 'faq-schema', 'label' => __( 'FAQ (microdatos Schema.org)', 'cerrajeros-canillejas' ) ),
			array( 'name' => 'blueprint', 'label' => __( 'Plano técnico', 'cerrajeros-canillejas' ) ),
		),
		'core/details' => array(
			array( 'name' => 'faq-item', 'label' => __( 'Pregunta frecuente', 'cerrajeros-canillejas' ) ),
		),
		'core/list'    => array(
			array( 'name' => 'index', 'label' => __( 'Índice técnico', 'cerrajeros-canillejas' ) ),
			array( 'name' => 'bolts', 'label' => __( 'Barras de cerrojo', 'cerrajeros-canillejas' ) ),
		),
		'core/table'   => array(
			array( 'name' => 'spec-sheet', 'label' => __( 'Ficha técnica', 'cerrajeros-canillejas' ) ),
		),
		'core/button'  => array(
			array( 'name' => 'call', 'label' => __( 'Llamada (cobre)', 'cerrajeros-canillejas' ) ),
			array( 'name' => 'arrow', 'label' => __( 'Enlace con flecha', 'cerrajeros-canillejas' ) ),
		),
		'core/image'   => array(
			array( 'name' => 'drawing', 'label' => __( 'Dibujo técnico', 'cerrajeros-canillejas' ) ),
		),
	);

	foreach ( $styles as $block => $block_styles ) {
		foreach ( $block_styles as $style ) {
			register_block_style( $block, $style );
		}
	}

	register_block_type( get_stylesheet_directory() . '/blocks/breadcrumbs' );
}
add_action( 'init', __NAMESPACE__ . '\\register_editor_features' );

/**
 * Removes the parent theme's patterns from the inserter.
 *
 * Several of them (pricing tables, testimonials, team profiles, contact
 * forms) invite content this business must not publish, and none of them
 * follow the child theme's design system. No child template references them.
 * Use the filter to keep them: add_filter( 'cerrajeros_canillejas_hide_parent_patterns', '__return_false' );
 */
function hide_parent_patterns() {
	if ( ! apply_filters( 'cerrajeros_canillejas_hide_parent_patterns', true ) ) {
		return;
	}

	$registry = \WP_Block_Patterns_Registry::get_instance();

	foreach ( $registry->get_all_registered() as $pattern ) {
		if ( 0 === strpos( $pattern['name'], 'prime-fse/' ) ) {
			unregister_block_pattern( $pattern['name'] );
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\\hide_parent_patterns', 20 );

/**
 * Reminds administrators to assign the static front page and the posts page,
 * which the "Últimas entradas" slide and the blog link rely on.
 */
function reading_settings_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( $screen && 'options-reading' === $screen->id ) {
		return;
	}

	if ( 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_for_posts' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-info"><p>%1$s <a href="%2$s">%3$s</a></p></div>',
		esc_html__( 'Cerrajeros Canillejas: asigna una página estática de inicio y una página de entradas (por ejemplo, «Blog») para que el blog tenga su propia URL.', 'cerrajeros-canillejas' ),
		esc_url( admin_url( 'options-reading.php' ) ),
		esc_html__( 'Ajustes de lectura', 'cerrajeros-canillejas' )
	);
}
add_action( 'admin_notices', __NAMESPACE__ . '\\reading_settings_notice' );
