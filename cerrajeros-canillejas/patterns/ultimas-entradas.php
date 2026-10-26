<?php
/**
 * Title: 06 · Últimas Entradas
 * Slug: cerrajeros-canillejas/ultimas-entradas
 * Categories: cerrajeros-canillejas
 * Keywords: blog, entradas, noticias, query loop
 * Viewport Width: 1440
 * Description: Diapositiva con las tres entradas más recientes (bucle de consulta nativo) y enlace al blog.
 *
 * @package CerrajerosCanillejas
 */

?>
<!-- wp:group {"tagName":"section","anchor":"ultimas-entradas","align":"full","className":"cc-slide cc-slide--posts","layout":{"type":"constrained"}} -->
<section id="ultimas-entradas" class="wp-block-group alignfull cc-slide cc-slide--posts"><!-- wp:group {"align":"wide","className":"cc-posts","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cc-posts"><!-- wp:group {"className":"cc-posts__head","layout":{"type":"default"}} -->
<div class="wp-block-group cc-posts__head"><!-- wp:paragraph {"className":"cc-kicker"} -->
<p class="cc-kicker"><strong>06 / 07</strong> Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"cc-slide__title"} -->
<h2 class="wp-block-heading cc-slide__title">Últimas Entradas</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cc-posts__intro"} -->
<p class="cc-posts__intro">Lo último que hemos publicado en el blog.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-arrow"} -->
<div class="wp-block-button is-style-arrow"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( \CerrajerosCanillejas\blog_url() ); ?>">Ver todas las entradas</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":61,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"cc-latest"} -->
<div class="wp-block-query cc-latest"><!-- wp:post-template {"className":"cc-latest__list"} -->
<!-- wp:group {"className":"cc-latest__item","layout":{"type":"default"}} -->
<div class="wp-block-group cc-latest__item"><!-- wp:post-date {"format":"d/m/Y","className":"cc-latest__date"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"className":"cc-latest__title"} /-->

<!-- wp:post-excerpt {"excerptLength":22,"className":"cc-latest__excerpt"} /-->

<!-- wp:post-featured-image {"aspectRatio":"4/3","sizeSlug":"medium","className":"cc-latest__thumb"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"className":"cc-latest__empty"} -->
<p class="cc-latest__empty">Todavía no hay entradas publicadas.</p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
