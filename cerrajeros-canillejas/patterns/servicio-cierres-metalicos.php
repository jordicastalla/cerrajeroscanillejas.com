<?php
/**
 * Title: 04 · Reparación de Cierres Metálicos
 * Slug: cerrajeros-canillejas/servicio-cierres-metalicos
 * Categories: cerrajeros-canillejas
 * Keywords: cierre metálico, persiana metálica, local, garaje, reparación
 * Viewport Width: 1440
 * Description: Diapositiva del servicio de reparación de cierres metálicos de locales y garajes, con lamas, alzado del mecanismo y llamada.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"tagName":"section","anchor":"cierres-metalicos","align":"full","className":"cc-slide cc-slide--shutter","layout":{"type":"constrained"}} -->
<section id="cierres-metalicos" class="wp-block-group alignfull cc-slide cc-slide--shutter"><!-- wp:group {"align":"full","className":"cc-shutter-sign","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull cc-shutter-sign"><!-- wp:group {"align":"wide","className":"cc-shutter-sign__inner","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-shutter-sign__inner"><!-- wp:paragraph {"className":"cc-kicker"} -->
<p class="cc-kicker"><strong>04 / 07</strong> Servicio para locales y garajes</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"cc-slide__title"} -->
<h2 class="wp-block-heading cc-slide__title">Reparación de Cierres Metálicos</h2>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"cc-split cc-split--shutter","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-split cc-split--shutter"><!-- wp:group {"className":"cc-split__text","layout":{"type":"default"}} -->
<div class="wp-block-group cc-split__text"><!-- wp:paragraph {"className":"cc-lead"} -->
<p class="cc-lead">Cuando el cierre metálico de un comercio o de un garaje se atasca, baja torcido o no cierra, el local queda expuesto. Reparamos cierres metálicos de locales comerciales, garajes e instalaciones similares.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Revisamos el cierre completo para localizar el origen de la avería y te explicamos la reparación antes de empezar.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true,"className":"is-style-index cc-reveal"} -->
<ol class="wp-block-list is-style-index cc-reveal"><!-- wp:list-item -->
<li><strong>Eje y muelles.</strong> El cierre pesa al subir o no se mantiene arriba.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Lamas.</strong> Lamas golpeadas, dobladas o desenganchadas.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Guías.</strong> El cierre roza, hace ruido o baja torcido.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Barra final y cerradura.</strong> La cerradura del cierre no abre o no asegura.</li>
<!-- /wp:list-item --></ol>
<!-- /wp:list -->

<!-- wp:group {"className":"cc-callslab cc-callslab--compact","layout":{"type":"default"}} -->
<div class="wp-block-group cc-callslab cc-callslab--compact"><!-- wp:paragraph {"className":"cc-callslab__label"} -->
<p class="cc-callslab__label">¿Cierre bloqueado?</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"cc-callslab__buttons"} -->
<div class="wp-block-buttons cc-callslab__buttons"><!-- wp:button {"className":"is-style-call cc-callslab__button"} -->
<div class="wp-block-button is-style-call cc-callslab__button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"cc-split__media","layout":{"type":"default"}} -->
<div class="wp-block-group cc-split__media"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-drawing cc-reveal"} -->
<figure class="wp-block-image size-full is-style-drawing cc-reveal"><img src="<?php echo esc_url( \CerrajerosCanillejas\image_url( 'cierre-metalico.svg' ) ); ?>" alt="Alzado técnico de un cierre metálico enrollable: eje con muelles en el cajón, lamas, guías laterales y barra final con cerradura."/><figcaption class="wp-element-caption">Fig. 04 — Cierre metálico enrollable, alzado</figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
