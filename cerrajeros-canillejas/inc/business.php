<?php
/**
 * Business data: the single source for the phone, address and services used by
 * patterns and structured data, so they cannot drift apart.
 *
 * Only confirmed information belongs here. Do not add opening hours, postal
 * code, coordinates, prices or ratings unless the business confirms them.
 * The service area and the everyday + urgent service were confirmed by the
 * business; "urgent" does not mean 24-hour availability.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

/**
 * Returns the confirmed business details.
 *
 * @return array<string, mixed>
 */
function business() {
	static $data = null;

	if ( null === $data ) {
		$data = apply_filters(
			'cerrajeros_canillejas_business',
			array(
				'name'           => 'Cerrajeros Canillejas',
				'phone_display'  => '+34 919 932 556',
				'phone_e164'     => '+34919932556',
				'street_address' => 'Plaza del Párroco Luis Calleja, 13',
				'locality'       => 'Canillejas, Madrid',
				'country'        => 'ES',
				'country_name'   => 'España',
				'landmark'       => 'junto a la oficina de Correos',
				'areas'          => array( 'Canillejas', 'San Blas', 'Rosas', 'Hellín', 'El Salvador' ),
			)
		);
	}

	return $data;
}

/**
 * Returns a single business field, or an empty string.
 *
 * @param string $key Field name.
 * @return string
 */
function biz( $key ) {
	$data = business();
	return isset( $data[ $key ] ) ? (string) $data[ $key ] : '';
}

/**
 * The tel: URI used by every call button.
 *
 * @return string
 */
function phone_href() {
	return 'tel:' . biz( 'phone_e164' );
}

/**
 * Directions link. It only opens Google Maps when the visitor clicks it,
 * so no map or third-party script loads with the page.
 *
 * @return string
 */
function directions_url() {
	$query = biz( 'street_address' ) . ', ' . biz( 'locality' ) . ', ' . biz( 'country_name' );
	return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $query );
}

/**
 * The three confirmed services, keyed by the homepage anchor of each slide.
 *
 * @return array<string, array<string, string>>
 */
function services() {
	return apply_filters(
		'cerrajeros_canillejas_services',
		array(
			'cambio-cerradura'  => array(
				'name'        => 'Cambio de cerradura',
				'type'        => 'Cambio de cerradura y bombín',
				'description' => 'Sustitución del bombín o de la cerradura completa según el estado del mecanismo, con ajuste y prueba de cierre.',
			),
			'cerrojos-seguridad' => array(
				'name'        => 'Instalación de cerrojos de seguridad',
				'type'        => 'Instalación de cerrojos de seguridad',
				'description' => 'Valoración de la puerta y el marco, elección del cerrojo, montaje, alineación y prueba de cierre.',
			),
			'cierres-metalicos' => array(
				'name'        => 'Reparación de cierres metálicos',
				'type'        => 'Reparación de cierres metálicos',
				'description' => 'Revisión y reparación de cierres metálicos de locales comerciales, garajes e instalaciones similares.',
			),
		)
	);
}

/**
 * URL of the posts page (blog). Falls back to the latest-posts home when no
 * static posts page is configured.
 *
 * @return string
 */
function blog_url() {
	$page_id = (int) get_option( 'page_for_posts' );

	if ( $page_id && 'publish' === get_post_status( $page_id ) ) {
		return get_permalink( $page_id );
	}

	return home_url( '/' );
}

/**
 * Absolute URL of a homepage section anchor.
 *
 * @param string $anchor Section id without '#'.
 * @return string
 */
function section_url( $anchor ) {
	return home_url( '/#' . $anchor );
}
