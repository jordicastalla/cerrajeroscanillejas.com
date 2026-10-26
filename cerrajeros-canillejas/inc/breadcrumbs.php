<?php
/**
 * Breadcrumb trail shared by the visible breadcrumbs block and the
 * BreadcrumbList structured data, so both always describe the same path.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

/**
 * Builds the trail for the current request.
 *
 * @return array<int, array{name: string, url: string}> Empty on the front page.
 */
function breadcrumb_trail() {
	if ( is_front_page() ) {
		return array();
	}

	$trail = array(
		array(
			'name' => __( 'Inicio', 'cerrajeros-canillejas' ),
			'url'  => home_url( '/' ),
		),
	);

	$posts_page = (int) get_option( 'page_for_posts' );
	$blog_crumb = $posts_page ? array(
		'name' => get_the_title( $posts_page ),
		'url'  => get_permalink( $posts_page ),
	) : null;

	if ( is_home() ) {
		if ( $blog_crumb ) {
			$trail[] = $blog_crumb;
		}
	} elseif ( is_singular( 'post' ) ) {
		if ( $blog_crumb ) {
			$trail[] = $blog_crumb;
		}
		$trail[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	} elseif ( is_page() ) {
		$page = get_queried_object();
		foreach ( array_reverse( get_post_ancestors( $page ) ) as $ancestor ) {
			$trail[] = array(
				'name' => get_the_title( $ancestor ),
				'url'  => get_permalink( $ancestor ),
			);
		}
		$trail[] = array(
			'name' => get_the_title( $page ),
			'url'  => get_permalink( $page ),
		);
	} elseif ( is_singular() ) {
		$trail[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	} elseif ( is_category() || is_tag() || is_tax() || is_author() || is_date() ) {
		if ( $blog_crumb ) {
			$trail[] = $blog_crumb;
		}
		$url  = '';
		$name = wp_strip_all_tags( get_the_archive_title() );
		if ( is_category() || is_tag() || is_tax() ) {
			$url  = get_term_link( get_queried_object() );
			$name = single_term_title( '', false );
		} elseif ( is_author() ) {
			$url  = get_author_posts_url( get_queried_object_id() );
			$name = get_the_author_meta( 'display_name', get_queried_object_id() );
		}
		$trail[] = array(
			'name' => $name,
			'url'  => is_wp_error( $url ) ? '' : (string) $url,
		);
	} elseif ( is_search() ) {
		$trail[] = array(
			/* translators: %s: search query. */
			'name' => sprintf( __( 'Búsqueda: %s', 'cerrajeros-canillejas' ), get_search_query() ),
			'url'  => get_search_link(),
		);
	} elseif ( is_404() ) {
		$trail[] = array(
			'name' => __( 'Página no encontrada', 'cerrajeros-canillejas' ),
			'url'  => '',
		);
	}

	return apply_filters( 'cerrajeros_canillejas_breadcrumb_trail', $trail );
}

/**
 * Renders the visible breadcrumbs as an ordered list inside a <nav>.
 *
 * @param string $wrapper_attributes Block wrapper attributes.
 * @return string
 */
function render_breadcrumbs( $wrapper_attributes = '' ) {
	$trail = breadcrumb_trail();

	if ( count( $trail ) < 2 ) {
		return '';
	}

	$items = '';
	$last  = count( $trail ) - 1;

	foreach ( $trail as $i => $crumb ) {
		if ( $i === $last || '' === $crumb['url'] ) {
			$items .= sprintf(
				'<li class="cc-breadcrumbs__item"%s>%s</li>',
				$i === $last ? ' aria-current="page"' : '',
				esc_html( $crumb['name'] )
			);
		} else {
			$items .= sprintf(
				'<li class="cc-breadcrumbs__item"><a href="%s">%s</a></li>',
				esc_url( $crumb['url'] ),
				esc_html( $crumb['name'] )
			);
		}
	}

	return sprintf(
		'<nav %1$s aria-label="%2$s"><ol class="cc-breadcrumbs__list">%3$s</ol></nav>',
		$wrapper_attributes,
		esc_attr__( 'Migas de pan', 'cerrajeros-canillejas' ),
		$items
	);
}
