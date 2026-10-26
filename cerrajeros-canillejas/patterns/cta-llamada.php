<?php
/**
 * Title: Llamada a la acción: servicios y teléfono
 * Slug: cerrajeros-canillejas/cta-llamada
 * Categories: cerrajeros-canillejas, call-to-action
 * Keywords: llamada, teléfono, cta, servicios, enlaces internos
 * Description: Banda para el final de entradas y páginas. Enlaza a las secciones de servicio de la portada (la página que debe posicionar para esas búsquedas) y muestra el teléfono, sin repetir las palabras clave locales en cada artículo.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"align":"wide","className":"cc-cta-band","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-cta-band"><!-- wp:paragraph {"className":"cc-label"} -->
<p class="cc-label">Nuestros servicios</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"cc-cta-band__title"} -->
<p class="cc-cta-band__title">¿Te ayudamos con una cerradura o un cierre?</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"cc-cta-band__services"} -->
<ul class="wp-block-list cc-cta-band__services"><!-- wp:list-item -->
<li><a href="<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cambio-cerradura' ) ); ?>">Cambio de cerradura</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cerrojos-seguridad' ) ); ?>">Instalación de cerrojos de seguridad</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cierres-metalicos' ) ); ?>">Reparación de cierres metálicos</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"className":"cc-cta-band__buttons"} -->
<div class="wp-block-buttons cc-cta-band__buttons"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
