<?php
/**
 * Front-end assets.
 *
 * Prime FSE already enqueues its own style.css (from the parent directory).
 * The child's style.css only holds the theme header, so it is not enqueued;
 * the design layer is assets/css/theme.css, loaded once after the parent.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

/**
 * Enqueues the theme stylesheet and the progressive-enhancement script.
 */
function enqueue_assets() {
	wp_enqueue_style(
		'cerrajeros-canillejas',
		get_theme_file_uri( 'assets/css/theme.css' ),
		wp_style_is( 'prime-fse-style', 'registered' ) ? array( 'prime-fse-style' ) : array(),
		CERRAJEROS_CANILLEJAS_VERSION
	);

	wp_enqueue_script(
		'cerrajeros-canillejas',
		get_theme_file_uri( 'assets/js/theme.js' ),
		array(),
		CERRAJEROS_CANILLEJAS_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	// The parent script only animates a Getwid block style. Skip the request
	// when Getwid is not active.
	if ( ! function_exists( 'getwid' ) ) {
		wp_dequeue_script( 'prime-fse-script' );
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_assets', 20 );

/**
 * Preloads the two fonts used above the fold (Syne for the H1, Instrument Sans
 * for body copy). Space Mono is only used for small labels and loads normally.
 */
function preload_fonts() {
	$fonts = array(
		'assets/fonts/syne/syne-latin-wght-normal.woff2',
		'assets/fonts/instrument-sans/instrument-sans-latin-wght-normal.woff2',
	);

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( $font ) )
		);
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\\preload_fonts', 2 );

/**
 * Browser colour and favicons. WordPress' own Site Icon (Appearance → Editor →
 * Site Identity, or Settings → General) takes precedence when it is set.
 */
function head_icons() {
	echo '<meta name="theme-color" content="#0A0A0C">' . "\n";

	if ( has_site_icon() ) {
		return;
	}

	printf( '<link rel="icon" href="%s" sizes="48x48">' . "\n", esc_url( get_theme_file_uri( 'assets/icons/favicon.ico' ) ) );
	printf( '<link rel="icon" href="%s" type="image/png" sizes="192x192">' . "\n", esc_url( get_theme_file_uri( 'assets/icons/icon-192.png' ) ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( get_theme_file_uri( 'assets/icons/apple-touch-icon.png' ) ) );
}
add_action( 'wp_head', __NAMESPACE__ . '\\head_icons', 3 );

/**
 * Same favicon in the admin and on the login screen.
 */
function admin_icons() {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" sizes="48x48">' . "\n", esc_url( get_theme_file_uri( 'assets/icons/favicon.ico' ) ) );
}
add_action( 'admin_head', __NAMESPACE__ . '\\admin_icons' );
add_action( 'login_head', __NAMESPACE__ . '\\admin_icons' );

/**
 * URL of a theme image, for patterns.
 *
 * @param string $file File name inside assets/images.
 * @return string
 */
function image_url( $file ) {
	return get_theme_file_uri( 'assets/images/' . $file );
}
