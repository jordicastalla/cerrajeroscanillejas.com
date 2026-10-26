<?php
/**
 * Render-time enhancements for core blocks.
 *
 * Content stays in editable core blocks; these filters only add attributes
 * that block markup cannot store: FAQ microdata, landmark labels, aria-hidden
 * on decorative text, and intrinsic sizes for the theme's own images.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

/**
 * Whether a parsed block carries a given class in its className attribute.
 *
 * @param array  $block Parsed block.
 * @param string $class Class name.
 * @return bool
 */
function block_has_class( $block, $class ) {
	if ( empty( $block['attrs']['className'] ) ) {
		return false;
	}
	return in_array( $class, preg_split( '/\s+/', (string) $block['attrs']['className'] ), true );
}

/**
 * FAQ item (core/details with the "Pregunta frecuente" style): wraps the
 * answer blocks in two containers so the group filter below can mark them up
 * as an Answer with its text. Editors keep editing ordinary paragraphs.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function faq_item_containers( $content, $block ) {
	if ( ! block_has_class( $block, 'is-style-faq-item' ) ) {
		return $content;
	}

	$summary_end = stripos( $content, '</summary>' );
	$details_end = strripos( $content, '</details>' );

	if ( false === $summary_end || false === $details_end || $details_end < $summary_end ) {
		return $content;
	}

	$start  = $summary_end + strlen( '</summary>' );
	$answer = substr( $content, $start, $details_end - $start );

	return substr( $content, 0, $start )
		. '<div class="cc-faq__answer"><div class="cc-faq__text">' . $answer . '</div></div>'
		. substr( $content, $details_end );
}
add_filter( 'render_block_core/details', __NAMESPACE__ . '\\faq_item_containers', 10, 2 );

/**
 * FAQ group (core/group with the "FAQ (microdatos Schema.org)" style): adds
 * FAQPage / Question / Answer microdata to the visible questions and answers.
 * Only items inside this group are marked up, so the structured data always
 * matches what the visitor can read.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function faq_schema_microdata( $content, $block ) {
	if ( ! block_has_class( $block, 'is-style-faq-schema' ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
		return $content;
	}

	$html = new \WP_HTML_Tag_Processor( $content );

	if ( ! $html->next_tag() ) {
		return $content;
	}

	$html->set_attribute( 'itemscope', true );
	$html->set_attribute( 'itemtype', 'https://schema.org/FAQPage' );

	$expect_summary = false;

	while ( $html->next_tag() ) {
		if ( $html->is_tag_closer() ) {
			continue;
		}

		$tag = $html->get_tag();

		if ( 'DETAILS' === $tag && $html->has_class( 'is-style-faq-item' ) ) {
			$html->set_attribute( 'itemscope', true );
			$html->set_attribute( 'itemprop', 'mainEntity' );
			$html->set_attribute( 'itemtype', 'https://schema.org/Question' );
			$expect_summary = true;
		} elseif ( 'SUMMARY' === $tag && $expect_summary ) {
			$html->set_attribute( 'itemprop', 'name' );
			$expect_summary = false;
		} elseif ( $html->has_class( 'cc-faq__answer' ) ) {
			$html->set_attribute( 'itemscope', true );
			$html->set_attribute( 'itemprop', 'acceptedAnswer' );
			$html->set_attribute( 'itemtype', 'https://schema.org/Answer' );
		} elseif ( $html->has_class( 'cc-faq__text' ) ) {
			$html->set_attribute( 'itemprop', 'text' );
		}
	}

	return $html->get_updated_html();
}
add_filter( 'render_block_core/group', __NAMESPACE__ . '\\faq_schema_microdata', 10, 2 );

/**
 * Accessible names for the theme's navigation landmarks, identified by class.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function navigation_labels( $content, $block ) {
	$labels = array(
		'cc-nav-primary' => __( 'Menú principal', 'cerrajeros-canillejas' ),
		'cc-deck-index'  => __( 'Secciones de la portada', 'cerrajeros-canillejas' ),
		'cc-nav-footer'  => __( 'Menú del pie de página', 'cerrajeros-canillejas' ),
	);

	foreach ( $labels as $class => $label ) {
		if ( block_has_class( $block, $class ) ) {
			$html = new \WP_HTML_Tag_Processor( $content );
			if ( $html->next_tag( 'nav' ) && '' === trim( (string) $html->get_attribute( 'aria-label' ) ) ) {
				$html->set_attribute( 'aria-label', $label );
			}
			return $html->get_updated_html();
		}
	}

	return $content;
}
add_filter( 'render_block_core/navigation', __NAMESPACE__ . '\\navigation_labels', 10, 2 );

/**
 * Decorative moving typography (class "cc-marquee") repeats words that are
 * already on the page; hide it from assistive technology.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function decorative_text( $content, $block ) {
	if ( ! block_has_class( $block, 'cc-marquee' ) ) {
		return $content;
	}

	$html = new \WP_HTML_Tag_Processor( $content );
	if ( $html->next_tag() ) {
		$html->set_attribute( 'aria-hidden', 'true' );
	}
	return $html->get_updated_html();
}
add_filter( 'render_block', __NAMESPACE__ . '\\decorative_text', 10, 2 );

/**
 * Intrinsic size, decoding and lazy-loading for the theme's own images
 * (logo and technical drawings), which are not media-library attachments and
 * therefore get no width/height from WordPress. This prevents layout shift.
 *
 * @param string $content Rendered block.
 * @param array  $block   Parsed block.
 * @return string
 */
function theme_image_attributes( $content, $block ) {
	static $sizes = array(
		'logo-cerrajeros-canillejas.webp' => array( 480, 151 ),
		'cilindro-tecnico.svg'            => array( 640, 640 ),
		'bombin-perfil-europeo.svg'       => array( 760, 540 ),
		'cerrojo-seguridad.svg'           => array( 760, 540 ),
		'cierre-metalico.svg'             => array( 820, 600 ),
		'sello-canillejas.svg'            => array( 260, 260 ),
	);
	static $eager = array( 'logo-cerrajeros-canillejas.webp', 'cilindro-tecnico.svg' );

	$base = get_theme_file_uri( 'assets/images/' );
	$html = new \WP_HTML_Tag_Processor( $content );

	if ( ! $html->next_tag( 'img' ) ) {
		return $content;
	}

	$src = (string) $html->get_attribute( 'src' );
	if ( 0 !== strpos( $src, $base ) ) {
		return $content;
	}

	$file = basename( wp_parse_url( $src, PHP_URL_PATH ) );
	if ( ! isset( $sizes[ $file ] ) ) {
		return $content;
	}

	if ( null === $html->get_attribute( 'width' ) ) {
		$html->set_attribute( 'width', (string) $sizes[ $file ][0] );
		$html->set_attribute( 'height', (string) $sizes[ $file ][1] );
	}
	$html->set_attribute( 'decoding', 'async' );
	if ( null === $html->get_attribute( 'loading' ) ) {
		$html->set_attribute( 'loading', in_array( $file, $eager, true ) ? 'eager' : 'lazy' );
	}

	return $html->get_updated_html();
}
add_filter( 'render_block_core/image', __NAMESPACE__ . '\\theme_image_attributes', 10, 2 );
