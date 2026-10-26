<?php
/**
 * Structured data (JSON-LD) and a fallback meta description.
 *
 * When a dedicated SEO plugin is active, the theme stops emitting the
 * page-level graph (WebSite, WebPage, BreadcrumbList, BlogPosting) and the
 * meta description, which those plugins generate themselves. It still emits
 * the Locksmith business node and its services on the front page, because
 * general SEO plugins do not usually describe a local business with this
 * address. Both behaviours can be changed with the filters documented below.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

/**
 * Detects the most common SEO plugins.
 *
 * @return bool
 */
function seo_plugin_active() {
	$active = defined( 'WPSEO_VERSION' )                 // Yoast SEO.
		|| defined( 'RANK_MATH_VERSION' )                // Rank Math.
		|| defined( 'AIOSEO_VERSION' )                   // All in One SEO.
		|| defined( 'SEOPRESS_VERSION' )                 // SEOPress.
		|| defined( 'THE_SEO_FRAMEWORK_VERSION' )        // The SEO Framework.
		|| defined( 'SLIM_SEO_VER' )                     // Slim SEO.
		|| class_exists( 'Squirrly_SEO', false );        // Squirrly.

	/**
	 * Filters whether an SEO plugin is considered active.
	 *
	 * @param bool $active Detection result.
	 */
	return (bool) apply_filters( 'cerrajeros_canillejas_seo_plugin_active', $active );
}

/**
 * Stable @id values.
 *
 * @param string $fragment Fragment name.
 * @return string
 */
function schema_id( $fragment ) {
	return home_url( '/#' . $fragment );
}

/**
 * The Locksmith (LocalBusiness) node. Only confirmed data: no opening hours,
 * coordinates, postal code, prices, ratings or service area.
 *
 * @return array
 */
function schema_business() {
	$logo = get_theme_file_uri( 'assets/images/logo-cerrajeros-canillejas.webp' );

	return array(
		'@type'       => 'Locksmith',
		'@id'         => schema_id( 'negocio' ),
		'name'        => biz( 'name' ),
		'url'         => home_url( '/' ),
		'telephone'   => biz( 'phone_display' ),
		'description' => sprintf(
			'Cerrajería en %1$s, %2$s: cambio de cerradura y bombín, instalación de cerrojos de seguridad y reparación de cierres metálicos.',
			biz( 'locality' ),
			biz( 'landmark' )
		),
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => biz( 'street_address' ),
			'addressLocality' => biz( 'locality' ),
			'addressCountry'  => biz( 'country' ),
		),
		'logo'        => array(
			'@type'  => 'ImageObject',
			'url'    => $logo,
			'width'  => 480,
			'height' => 151,
		),
		'image'       => $logo,
	);
}

/**
 * Service nodes for the three confirmed services.
 *
 * @return array[]
 */
function schema_services() {
	$nodes = array();

	foreach ( services() as $anchor => $service ) {
		$nodes[] = array(
			'@type'       => 'Service',
			'@id'         => schema_id( 'servicio-' . $anchor ),
			'name'        => $service['name'],
			'serviceType' => $service['type'],
			'description' => $service['description'],
			'url'         => section_url( $anchor ),
			'provider'    => array( '@id' => schema_id( 'negocio' ) ),
		);
	}

	return $nodes;
}

/**
 * Canonical-ish URL of the current request, for WebPage nodes.
 *
 * @return string
 */
function current_url() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_singular() ) {
		return (string) get_permalink();
	}
	if ( is_home() ) {
		return blog_url();
	}
	if ( is_category() || is_tag() || is_tax() ) {
		$link = get_term_link( get_queried_object() );
		return is_wp_error( $link ) ? '' : $link;
	}
	if ( is_author() ) {
		return get_author_posts_url( get_queried_object_id() );
	}
	return '';
}

/**
 * Builds the full @graph for the current request.
 *
 * @return array[]
 */
function schema_graph() {
	$graph       = array();
	$plugin      = seo_plugin_active();
	$language    = get_bloginfo( 'language' );
	$business_id = schema_id( 'negocio' );

	/**
	 * Filters whether the Locksmith + Service nodes are printed on the front
	 * page while an SEO plugin is active. Return false if your SEO plugin is
	 * already configured with this business (for example, a Local SEO add-on).
	 *
	 * @param bool $output Default true.
	 */
	$business_with_plugin = apply_filters( 'cerrajeros_canillejas_business_schema_with_seo_plugin', true );

	if ( $plugin ) {
		if ( is_front_page() && $business_with_plugin ) {
			$graph[] = schema_business();
			$graph   = array_merge( $graph, schema_services() );
		}
		return $graph;
	}

	$graph[] = schema_business();
	$graph[] = array(
		'@type'      => 'WebSite',
		'@id'        => schema_id( 'website' ),
		'url'        => home_url( '/' ),
		'name'       => get_bloginfo( 'name' ),
		'inLanguage' => $language,
		'publisher'  => array( '@id' => $business_id ),
	);

	$url = current_url();

	if ( is_front_page() ) {
		$graph   = array_merge( $graph, schema_services() );
		$graph[] = array(
			'@type'      => 'WebPage',
			'@id'        => home_url( '/#webpage' ),
			'url'        => home_url( '/' ),
			'name'       => wp_get_document_title(),
			'isPartOf'   => array( '@id' => schema_id( 'website' ) ),
			'about'      => array( '@id' => $business_id ),
			'inLanguage' => $language,
		);
		return $graph;
	}

	if ( '' === $url || is_404() || is_search() ) {
		return $graph;
	}

	$webpage = array(
		'@type'      => is_home() || is_archive() ? 'CollectionPage' : 'WebPage',
		'@id'        => $url . '#webpage',
		'url'        => $url,
		'name'       => wp_get_document_title(),
		'isPartOf'   => array( '@id' => schema_id( 'website' ) ),
		'inLanguage' => $language,
	);

	$trail = breadcrumb_trail();
	if ( count( $trail ) > 1 ) {
		$items = array();
		foreach ( $trail as $i => $crumb ) {
			$item = array(
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => wp_strip_all_tags( $crumb['name'] ),
			);
			if ( '' !== $crumb['url'] ) {
				$item['item'] = $crumb['url'];
			}
			$items[] = $item;
		}
		$graph[]               = array(
			'@type'           => 'BreadcrumbList',
			'@id'             => $url . '#breadcrumb',
			'itemListElement' => $items,
		);
		$webpage['breadcrumb'] = array( '@id' => $url . '#breadcrumb' );
	}

	$graph[] = $webpage;

	if ( is_singular( 'post' ) ) {
		$post    = get_queried_object();
		$article = array(
			'@type'            => 'BlogPosting',
			'@id'              => $url . '#article',
			'headline'         => wp_strip_all_tags( get_the_title( $post ) ),
			'datePublished'    => get_post_time( 'c', true, $post ),
			'dateModified'     => get_post_modified_time( 'c', true, $post ),
			'publisher'        => array( '@id' => $business_id ),
			'mainEntityOfPage' => array( '@id' => $url . '#webpage' ),
			'isPartOf'         => array( '@id' => schema_id( 'website' ) ),
			'inLanguage'       => $language,
		);

		$author_name = $post->post_author ? get_the_author_meta( 'display_name', $post->post_author ) : '';
		if ( '' !== $author_name ) {
			$article['author'] = array(
				'@type' => 'Person',
				'name'  => $author_name,
				'url'   => get_author_posts_url( $post->post_author ),
			);
		}

		$excerpt = get_the_excerpt( $post );
		if ( $excerpt ) {
			$article['description'] = wp_strip_all_tags( $excerpt );
		}
		if ( has_post_thumbnail( $post ) ) {
			$article['image'] = get_the_post_thumbnail_url( $post, 'full' );
		}

		$graph[] = $article;
	}

	return $graph;
}

/**
 * Prints the JSON-LD graph.
 */
function print_schema() {
	/**
	 * Filters whether the theme prints any JSON-LD at all.
	 *
	 * @param bool $enabled Default true.
	 */
	if ( ! apply_filters( 'cerrajeros_canillejas_output_schema', true ) ) {
		return;
	}

	$graph = apply_filters( 'cerrajeros_canillejas_schema_graph', schema_graph() );

	if ( empty( $graph ) ) {
		return;
	}

	$json = wp_json_encode(
		array(
			'@context' => 'https://schema.org',
			'@graph'   => array_values( $graph ),
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
	);

	if ( $json ) {
		echo '<script type="application/ld+json" class="cerrajeros-canillejas-schema">' . $json . "</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON with HEX_TAG/HEX_AMP.
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\\print_schema', 30 );

/**
 * Meta description when no SEO plugin handles it: a fixed local summary on
 * the front page and the excerpt on posts and pages.
 */
function print_meta_description() {
	if ( seo_plugin_active() ) {
		return;
	}

	$description = '';

	if ( is_front_page() ) {
		$description = sprintf(
			'Cerrajeros en %1$s: cambio de cerradura y bombín, cerrojos de seguridad y reparación de cierres metálicos. %2$s, %3$s. Tel. %4$s.',
			biz( 'locality' ),
			biz( 'street_address' ),
			biz( 'landmark' ),
			biz( 'phone_display' )
		);
	} elseif ( is_home() && ! is_paged() ) {
		// Informational wording on purpose: the blog must not compete with the
		// front page for "cerrajeros en Canillejas" or the service queries.
		$posts_page  = get_queried_object();
		$description = ( $posts_page instanceof \WP_Post && has_excerpt( $posts_page ) )
			? wp_strip_all_tags( get_the_excerpt( $posts_page ) )
			: 'Artículos sobre cerraduras, bombines, cerrojos de seguridad y cierres metálicos.';
	} elseif ( is_singular() ) {
		$post = get_queried_object();
		if ( $post instanceof \WP_Post && ( has_excerpt( $post ) || '' !== trim( $post->post_content ) ) ) {
			$description = wp_trim_words( wp_strip_all_tags( get_the_excerpt( $post ) ), 28, '…' );
		}
	}

	$description = apply_filters( 'cerrajeros_canillejas_meta_description', $description );

	if ( '' !== $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
	}
}
add_action( 'wp_head', __NAMESPACE__ . '\\print_meta_description', 1 );

/*
 * Keyword cannibalisation.
 *
 * The front page is the only page meant to rank for the business and its three
 * services (the service sections are anchors of that one URL). The blog should
 * capture informational searches and pass relevance back through links. The
 * rules below remove duplicate listings that would otherwise compete with the
 * blog and the front page. They step aside when an SEO plugin is active, since
 * those plugins expose the same settings.
 */

/**
 * Whether the current archive is a thin duplicate of the blog listing:
 * author archives (single-author site), date archives and tag archives.
 *
 * @return bool
 */
function is_duplicate_archive() {
	$duplicate = is_author() || is_date() || is_tag();

	/**
	 * Filters whether the current archive gets noindex,follow.
	 *
	 * @param bool $duplicate Default: author, date and tag archives.
	 */
	return (bool) apply_filters( 'cerrajeros_canillejas_noindex_archive', $duplicate );
}

/**
 * Adds noindex,follow to duplicate archives through the core robots API.
 *
 * @param array $robots Robots directives.
 * @return array
 */
function robots_for_duplicate_archives( $robots ) {
	if ( ! seo_plugin_active() && is_duplicate_archive() ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
}
add_filter( 'wp_robots', __NAMESPACE__ . '\\robots_for_duplicate_archives' );

/**
 * Keeps the core XML sitemap consistent with the noindex rules: no author
 * sitemap and no tag sitemap.
 *
 * @param \WP_Sitemaps_Provider $provider Provider instance.
 * @param string                $name     Provider name.
 * @return \WP_Sitemaps_Provider|false
 */
function sitemap_providers( $provider, $name ) {
	if ( 'users' === $name && ! seo_plugin_active() && apply_filters( 'cerrajeros_canillejas_noindex_authors', true ) ) {
		return false;
	}
	return $provider;
}
add_filter( 'wp_sitemaps_add_provider', __NAMESPACE__ . '\\sitemap_providers', 10, 2 );

/**
 * Removes tags from the core sitemap.
 *
 * @param array $taxonomies Taxonomy objects keyed by name.
 * @return array
 */
function sitemap_taxonomies( $taxonomies ) {
	if ( ! seo_plugin_active() && apply_filters( 'cerrajeros_canillejas_noindex_tags', true ) ) {
		unset( $taxonomies['post_tag'] );
	}
	return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', __NAMESPACE__ . '\\sitemap_taxonomies' );

/**
 * Self-referencing canonical for the blog listing and category archives,
 * including their pagination. WordPress core only prints a canonical on
 * single posts and pages.
 */
function print_listing_canonical() {
	if ( seo_plugin_active() || is_duplicate_archive() ) {
		return;
	}

	if ( is_home() && ! is_front_page() ) {
		$base = blog_url();
	} elseif ( is_category() || is_tax() ) {
		$base = get_term_link( get_queried_object() );
	} else {
		return;
	}

	if ( is_wp_error( $base ) || '' === $base ) {
		return;
	}

	$paged = (int) get_query_var( 'paged' );
	$url   = $base;

	if ( $paged > 1 ) {
		global $wp_rewrite;
		$url = $wp_rewrite->using_permalinks()
			? user_trailingslashit( trailingslashit( $base ) . $wp_rewrite->pagination_base . '/' . $paged, 'paged' )
			: add_query_arg( 'paged', $paged, $base );
	}

	printf( '<link rel="canonical" href="%s" />' . "\n", esc_url( $url ) );
}
add_action( 'wp_head', __NAMESPACE__ . '\\print_listing_canonical', 5 );
