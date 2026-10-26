<?php
/**
 * Title: 03 · Instalación de Cerrojos de Seguridad
 * Slug: cerrajeros-canillejas/servicio-cerrojos-seguridad
 * Categories: cerrajeros-canillejas
 * Keywords: cerrojo, seguridad, instalación, servicio
 * Viewport Width: 1440
 * Description: Diapositiva del servicio de instalación de cerrojos de seguridad, con barras de cerrojo, ficha técnica y alzado.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"tagName":"section","anchor":"cerrojos-seguridad","align":"full","className":"cc-slide cc-slide--bolt","layout":{"type":"constrained"}} -->
<section id="cerrojos-seguridad" class="wp-block-group alignfull cc-slide cc-slide--bolt"><!-- wp:group {"align":"wide","className":"cc-bolt","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-bolt"><!-- wp:paragraph {"className":"cc-kicker cc-bolt__kicker"} -->
<p class="cc-kicker cc-bolt__kicker"><strong>03 / 07</strong> Servicio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"cc-slide__title cc-bolt__title"} -->
<h2 class="wp-block-heading cc-slide__title cc-bolt__title">Instalación de Cerrojos de Seguridad</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"cc-bolt__text","layout":{"type":"default"}} -->
<div class="wp-block-group cc-bolt__text"><!-- wp:paragraph {"className":"cc-lead"} -->
<p class="cc-lead">Un cerrojo de seguridad añade un punto de cierre independiente de la cerradura principal. Es una mejora habitual en puertas de vivienda, trasteros y locales.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Lo importante es la instalación: el cerrojo debe quedar bien anclado y alineado con el marco para que cierre con suavidad. Antes de montarlo valoramos la puerta y te ayudamos a elegir el modelo y la altura más adecuados.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true,"className":"is-style-bolts cc-reveal"} -->
<ol class="wp-block-list is-style-bolts cc-reveal"><!-- wp:list-item -->
<li>Valoración de la puerta y el marco</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Elección del cerrojo y de su posición</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Montaje, alineación y prueba de cierre</li>
<!-- /wp:list-item --></ol>
<!-- /wp:list --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-drawing cc-bolt__figure cc-reveal"} -->
<figure class="wp-block-image size-full is-style-drawing cc-bolt__figure cc-reveal"><img src="<?php echo esc_url( \CerrajerosCanillejas\image_url( 'cerrojo-seguridad.svg' ) ); ?>" alt="Alzado técnico de un cerrojo de seguridad: caja con bombín y tres bulones que encajan en el cerradero del marco."/><figcaption class="wp-element-caption">Fig. 03 — Cerrojo de seguridad, alzado</figcaption></figure>
<!-- /wp:image -->

<!-- wp:table {"hasFixedLayout":false,"className":"is-style-spec-sheet cc-bolt__sheet"} -->
<figure class="wp-block-table is-style-spec-sheet cc-bolt__sheet"><table><tbody><tr><th scope="row">Servicio</th><td>Instalación de cerrojos de seguridad</td></tr><tr><th scope="row">Para</th><td>Puertas de vivienda, trasteros y locales</td></tr><tr><th scope="row">Proceso</th><td>Valoración, montaje, ajuste y prueba</td></tr><tr><th scope="row">Consulta</th><td><a href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a></td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:buttons {"className":"cc-bolt__cta"} -->
<div class="wp-block-buttons cc-bolt__cta"><!-- wp:button {"className":"is-style-call"} -->
<div class="wp-block-button is-style-call"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_attr( $cc_tel ); ?>">Consultar instalación · <?php echo esc_html( $cc_phone ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
