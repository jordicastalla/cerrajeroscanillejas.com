<?php
/**
 * Title: Llamada a la acción: teléfono
 * Slug: cerrajeros-canillejas/cta-llamada
 * Categories: cerrajeros-canillejas, call-to-action
 * Keywords: llamada, teléfono, cta, contacto
 * Description: Banda reutilizable con el teléfono, para entradas y páginas.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"align":"wide","className":"cc-cta-band","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-cta-band"><!-- wp:paragraph {"className":"cc-label"} -->
<p class="cc-label">Cerrajeros Canillejas</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cc-cta-band__title"} -->
<p class="cc-cta-band__title">¿Necesitas un cerrajero en Canillejas?</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cc-cta-band__text"} -->
<p class="cc-cta-band__text">Llámanos y cuéntanos qué ocurre. Estamos en la Plaza del Párroco Luis Calleja, 13, junto a la oficina de Correos.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"cc-cta-band__buttons"} -->
<div class="wp-block-buttons cc-cta-band__buttons"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
