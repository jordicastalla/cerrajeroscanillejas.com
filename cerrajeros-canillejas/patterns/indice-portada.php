<?php
/**
 * Title: Índice de diapositivas
 * Slug: cerrajeros-canillejas/indice-portada
 * Categories: cerrajeros-canillejas
 * Inserter: no
 * Description: Índice fijo 01–07 de la portada. Son enlaces normales a cada sección; el script del tema solo marca la sección activa.
 *
 * @package CerrajerosCanillejas
 */

$cc_sections = array(
	'inicio'             => 'Inicio',
	'cambio-cerradura'   => 'Cambio Cerradura',
	'cerrojos-seguridad' => 'Cerrojos',
	'cierres-metalicos'  => 'Cierres metálicos',
	'quienes-somos'      => 'Quiénes somos',
	'ultimas-entradas'   => 'Blog',
	'contacto'           => 'Contacto',
);
?>
<!-- wp:navigation {"overlayMenu":"never","className":"cc-deck-index","layout":{"type":"flex","orientation":"vertical"}} -->
<?php foreach ( $cc_sections as $cc_anchor => $cc_label ) : ?>
<!-- wp:navigation-link {"label":"<?php echo esc_attr( $cc_label ); ?>","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( $cc_anchor ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<?php endforeach; ?>
<!-- /wp:navigation -->
