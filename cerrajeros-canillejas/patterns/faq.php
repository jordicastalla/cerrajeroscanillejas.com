<?php
/**
 * Title: Preguntas frecuentes (FAQ con microdatos)
 * Slug: cerrajeros-canillejas/faq
 * Categories: cerrajeros-canillejas
 * Keywords: faq, preguntas frecuentes, schema, microdatos
 * Description: Preguntas desplegables. El grupo usa el estilo «FAQ (microdatos Schema.org)» y cada pregunta el estilo «Pregunta frecuente»; el tema añade los microdatos FAQPage a partir del texto visible.
 *
 * @package CerrajerosCanillejas
 */

$cc_phone = \CerrajerosCanillejas\biz( 'phone_display' );
$cc_tel   = \CerrajerosCanillejas\phone_href();
?>
<!-- wp:group {"className":"is-style-faq-schema cc-faq","layout":{"type":"default"}} -->
<div class="wp-block-group is-style-faq-schema cc-faq"><!-- wp:heading {"level":3,"className":"cc-faq__title"} -->
<h3 class="wp-block-heading cc-faq__title">Preguntas frecuentes</h3>
<!-- /wp:heading -->

<!-- wp:details {"className":"is-style-faq-item"} -->
<details class="wp-block-details is-style-faq-item"><summary>¿Qué servicios de cerrajería ofrecéis en Canillejas?</summary><!-- wp:paragraph -->
<p>Cambio de cerradura y de bombín, instalación de cerrojos de seguridad y reparación de cierres metálicos de locales comerciales, garajes e instalaciones similares.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"className":"is-style-faq-item"} -->
<details class="wp-block-details is-style-faq-item"><summary>¿Basta con cambiar el bombín o hay que cambiar toda la cerradura?</summary><!-- wp:paragraph -->
<p>Depende del estado de la cerradura. Si el mecanismo funciona bien, a menudo es suficiente con sustituir el bombín; si está dañado o desgastado, puede convenir cambiarla entera. Lo valoramos y te explicamos las opciones antes de empezar.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"className":"is-style-faq-item"} -->
<details class="wp-block-details is-style-faq-item"><summary>¿Reparáis cierres metálicos de comercios y garajes?</summary><!-- wp:paragraph -->
<p>Sí. Revisamos el cierre para localizar la avería (eje y muelles, lamas, guías, barra final o cerradura) y te explicamos la reparación antes de hacerla.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"className":"is-style-faq-item"} -->
<details class="wp-block-details is-style-faq-item"><summary>¿Cómo puedo contactar con vosotros?</summary><!-- wp:paragraph -->
<p>Por teléfono, en el <a href="<?php echo esc_attr( $cc_tel ); ?>"><?php echo esc_html( $cc_phone ); ?></a>. Cuéntanos qué ocurre y te indicaremos los siguientes pasos.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"className":"is-style-faq-item"} -->
<details class="wp-block-details is-style-faq-item"><summary>¿Dónde estáis?</summary><!-- wp:paragraph -->
<p>En la Plaza del Párroco Luis Calleja, 13, en Canillejas (Madrid), junto a la oficina de Correos.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group -->
