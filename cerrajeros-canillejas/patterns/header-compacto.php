<?php
/**
 * Title: Cabecera compacta
 * Slug: cerrajeros-canillejas/header-compacto
 * Categories: cerrajeros-canillejas, header
 * Block Types: core/template-part/header
 * Keywords: cabecera, compacta, logotipo, teléfono
 * Description: Solo logotipo y botón de llamada, para páginas de aterrizaje.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"align":"full","className":"cc-header cc-header--compact","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull cc-header cc-header--compact"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"cc-header__logo"} -->
<figure class="wp-block-image size-full cc-header__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( \CerrajerosCanillejas\image_url( 'logo-cerrajeros-canillejas.webp' ) ); ?>" alt="Cerrajeros Canillejas, ir al inicio"/></a></figure>
<!-- /wp:image -->

<!-- wp:buttons {"className":"cc-header__call"} -->
<div class="wp-block-buttons cc-header__call"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
