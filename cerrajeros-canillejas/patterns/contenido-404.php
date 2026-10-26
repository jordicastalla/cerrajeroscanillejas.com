<?php
/**
 * Title: Contenido de error 404
 * Slug: cerrajeros-canillejas/contenido-404
 * Categories: cerrajeros-canillejas
 * Inserter: no
 * Description: Mensaje de página no encontrada con enlaces de salida y búsqueda.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"align":"wide","className":"cc-404","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-404"><!-- wp:paragraph {"className":"cc-kicker"} -->
<p class="cc-kicker"><strong>Error 404</strong> Página no encontrada</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"cc-404__title"} -->
<h1 class="wp-block-heading cc-404__title">Esta puerta no lleva a ninguna parte</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cc-lead"} -->
<p class="cc-lead">La página que buscas no existe o ha cambiado de dirección. Vuelve al inicio, busca en el blog o llámanos directamente.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-arrow"} -->
<div class="wp-block-button is-style-arrow"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Volver al inicio</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:search {"label":"Buscar en el sitio","showLabel":false,"placeholder":"Buscar…","buttonText":"Buscar","className":"cc-search"} /--></div>
<!-- /wp:group -->
