<?php
/**
 * Title: Cabecera
 * Slug: cerrajeros-canillejas/header
 * Categories: cerrajeros-canillejas, header
 * Block Types: core/template-part/header
 * Keywords: cabecera, menú, logotipo, teléfono
 * Description: Logotipo, menú principal y botón de llamada.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"align":"full","className":"cc-header","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull cc-header"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","className":"cc-header__logo"} -->
<figure class="wp-block-image size-full cc-header__logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( \CerrajerosCanillejas\image_url( 'logo-cerrajeros-canillejas.webp' ) ); ?>" alt="Cerrajeros Canillejas, ir al inicio"/></a></figure>
<!-- /wp:image -->

<!-- wp:navigation {"overlayMenu":"mobile","className":"cc-nav-primary","layout":{"type":"flex","justifyContent":"right","flexWrap":"nowrap"}} -->
<!-- wp:navigation-link {"label":"Servicios","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cambio-cerradura' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Quiénes somos","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'quienes-somos' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Blog","url":"<?php echo esc_url( \CerrajerosCanillejas\blog_url() ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Contacto","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'contacto' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Llamar al <?php echo esc_attr( $cc_phone ); ?>","url":"<?php echo esc_attr( $cc_tel ); ?>","kind":"custom","isTopLevelLink":true,"className":"cc-nav-call"} /-->
<!-- /wp:navigation -->

<!-- wp:buttons {"className":"cc-header__call"} -->
<div class="wp-block-buttons cc-header__call"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
