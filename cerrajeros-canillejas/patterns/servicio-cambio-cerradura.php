<?php
/**
 * Title: 02 · Cambio Cerradura
 * Slug: cerrajeros-canillejas/servicio-cambio-cerradura
 * Categories: cerrajeros-canillejas
 * Keywords: cambio de cerradura, bombín, servicio
 * Viewport Width: 1440
 * Description: Diapositiva del servicio de cambio de cerradura y bombín, con dibujo técnico despiezado.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"tagName":"section","anchor":"cambio-cerradura","align":"full","className":"cc-slide cc-slide--lock","layout":{"type":"constrained"}} -->
<section id="cambio-cerradura" class="wp-block-group alignfull cc-slide cc-slide--lock"><!-- wp:group {"align":"wide","className":"cc-split cc-split--media-left","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-split cc-split--media-left"><!-- wp:group {"className":"cc-split__text","layout":{"type":"default"}} -->
<div class="wp-block-group cc-split__text"><!-- wp:paragraph {"className":"cc-kicker"} -->
<p class="cc-kicker"><strong>02 / 07</strong> Servicio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"cc-slide__title"} -->
<h2 class="wp-block-heading cc-slide__title">Cambio Cerradura</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cc-lead"} -->
<p class="cc-lead">Si has perdido las llaves, te mudas a una vivienda o la cerradura empieza a fallar, cambiarla es la forma más directa de volver a controlar quién puede entrar.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Antes de proponer nada revisamos la puerta y el mecanismo. Muchas veces basta con sustituir el bombín, la pieza donde entra la llave; otras conviene cambiar la cerradura completa. Te explicamos la diferencia para que decidas con toda la información.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true,"className":"is-style-index cc-reveal"} -->
<ol class="wp-block-list is-style-index cc-reveal"><!-- wp:list-item -->
<li><strong>Diagnóstico.</strong> Comprobamos el estado de la cerradura, el bombín y la puerta.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Propuesta.</strong> Te decimos si basta con cambiar el bombín o si es mejor sustituir la cerradura.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Montaje.</strong> Instalamos la pieza elegida y la ajustamos a tu puerta.</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><strong>Prueba.</strong> Comprobamos el cierre con las llaves nuevas antes de terminar.</li>
<!-- /wp:list-item --></ol>
<!-- /wp:list -->

<!-- wp:list {"className":"cc-tags"} -->
<ul class="wp-block-list cc-tags"><!-- wp:list-item -->
<li>Pérdida o robo de llaves</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Mudanza</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Llave que gira con dificultad</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Intento de apertura</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>">Llamar al <?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"cc-split__media","layout":{"type":"default"}} -->
<div class="wp-block-group cc-split__media"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-drawing cc-reveal"} -->
<figure class="wp-block-image size-full is-style-drawing cc-reveal"><img src="<?php echo esc_url( \CerrajerosCanillejas\image_url( 'bombin-perfil-europeo.svg' ) ); ?>" alt="Dibujo técnico de un bombín de perfil europeo despiezado: cuerpo, leva, pistones con muelles y llave."/><figcaption class="wp-element-caption">Fig. 02 — Bombín de perfil europeo, vista lateral</figcaption></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
