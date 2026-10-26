<?php
/**
 * Title: 07 · Contacto
 * Slug: cerrajeros-canillejas/contacto
 * Categories: cerrajeros-canillejas
 * Keywords: contacto, teléfono, dirección, cómo llegar
 * Viewport Width: 1440
 * Description: Diapositiva final con el teléfono en grande, la dirección junto a Correos y el enlace para llegar.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"tagName":"section","anchor":"contacto","align":"full","className":"cc-slide cc-slide--contact","layout":{"type":"constrained"}} -->
<section id="contacto" class="wp-block-group alignfull cc-slide cc-slide--contact"><!-- wp:group {"align":"wide","className":"cc-contact","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-contact"><!-- wp:paragraph {"className":"cc-kicker"} -->
<p class="cc-kicker"><strong>07 / 07</strong> Contacto</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"cc-slide__title cc-contact__title"} -->
<h2 class="wp-block-heading cc-slide__title cc-contact__title">Contacto</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cc-lead cc-contact__lead"} -->
<p class="cc-lead cc-contact__lead">La forma más rápida de hablar con nosotros es por teléfono.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cc-contact__phone","layout":{"type":"default"}} -->
<div class="wp-block-group cc-contact__phone"><!-- wp:paragraph {"className":"cc-label"} -->
<p class="cc-label">Teléfono</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-call cc-contact__number"} -->
<div class="wp-block-button is-style-call cc-contact__number"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"cc-contact__address","layout":{"type":"default"}} -->
<div class="wp-block-group cc-contact__address"><!-- wp:paragraph {"className":"cc-label"} -->
<p class="cc-label">Dirección</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cc-contact__street"} -->
<p class="cc-contact__street">Plaza del Párroco Luis Calleja, 13<br>Canillejas, Madrid</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cc-contact__landmark"} -->
<p class="cc-contact__landmark">Junto a la oficina de Correos.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-arrow"} -->
<div class="wp-block-button is-style-arrow"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( \CerrajerosCanillejas\directions_url() ); ?>">Cómo llegar</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
