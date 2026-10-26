<?php
/**
 * Title: 01 · Portada con llamada directa
 * Slug: cerrajeros-canillejas/hero-llamada
 * Categories: cerrajeros-canillejas
 * Keywords: portada, hero, teléfono, llamada, cerrajeros canillejas
 * Viewport Width: 1440
 * Description: Primera diapositiva: H1 local, resumen de servicios, botón de llamada e índice de servicios.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"tagName":"section","anchor":"inicio","align":"full","className":"cc-slide cc-slide--hero","layout":{"type":"constrained"}} -->
<section id="inicio" class="wp-block-group alignfull cc-slide cc-slide--hero"><!-- wp:group {"align":"wide","className":"cc-hero","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-hero"><!-- wp:paragraph {"className":"cc-kicker cc-hero__kicker"} -->
<p class="cc-kicker cc-hero__kicker"><strong>01 / 07</strong> Cerrajería en Canillejas · Madrid</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"cc-hero__title"} -->
<h1 class="wp-block-heading cc-hero__title">Cerrajeros <em>en Canillejas</em></h1>
<!-- /wp:heading -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cc-hero__figure"} -->
<figure class="wp-block-image size-full cc-hero__figure"><img src="<?php echo esc_url( \CerrajerosCanillejas\image_url( 'cilindro-tecnico.svg' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"cc-hero__lead"} -->
<p class="cc-hero__lead">Cambio de cerradura y bombín, instalación de cerrojos de seguridad y reparación de cierres metálicos. Estamos en la Plaza del Párroco Luis Calleja, 13, junto a la oficina de Correos.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"cc-callslab cc-hero__call","layout":{"type":"default"}} -->
<div class="wp-block-group cc-callslab cc-hero__call"><!-- wp:paragraph {"className":"cc-callslab__label"} -->
<p class="cc-callslab__label">Llamada directa</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"cc-callslab__buttons"} -->
<div class="wp-block-buttons cc-callslab__buttons"><!-- wp:button {"className":"is-style-call cc-callslab__button"} -->
<div class="wp-block-button is-style-call cc-callslab__button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"cc-callslab__note"} -->
<p class="cc-callslab__note">Cuéntanos qué ocurre y te orientamos por teléfono.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:list {"className":"cc-agenda cc-hero__agenda"} -->
<ul class="wp-block-list cc-agenda cc-hero__agenda"><!-- wp:list-item -->
<li><a href="<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cambio-cerradura' ) ); ?>"><strong>02</strong> Cambio Cerradura</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cerrojos-seguridad' ) ); ?>"><strong>03</strong> Cerrojos de seguridad</a></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><a href="<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cierres-metalicos' ) ); ?>"><strong>04</strong> Cierres metálicos</a></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"className":"cc-marquee"} -->
<p class="cc-marquee">Cerraduras · Bombines · Cerrojos de seguridad · Cierres metálicos · Canillejas · Cerraduras · Bombines · Cerrojos de seguridad · Cierres metálicos · Canillejas ·</p>
<!-- /wp:paragraph --></section>
<!-- /wp:group -->
