<?php
/**
 * Title: Menú del pie de página
 * Slug: cerrajeros-canillejas/footer-nav
 * Categories: cerrajeros-canillejas, footer
 * Inserter: no
 * Description: Enlaces del pie (usado dentro de la parte «Pie de página»).
 *
 * @package CerrajerosCanillejas
 */

?>
<!-- wp:navigation {"overlayMenu":"never","className":"cc-nav-footer","layout":{"type":"flex","orientation":"vertical"}} -->
<!-- wp:home-link {"label":"Inicio"} /-->

<!-- wp:navigation-link {"label":"Cambio Cerradura","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cambio-cerradura' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Cerrojos de seguridad","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cerrojos-seguridad' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Cierres metálicos","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'cierres-metalicos' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Blog","url":"<?php echo esc_url( \CerrajerosCanillejas\blog_url() ); ?>","kind":"custom","isTopLevelLink":true} /-->

<!-- wp:navigation-link {"label":"Contacto","url":"<?php echo esc_url( \CerrajerosCanillejas\section_url( 'contacto' ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
<!-- /wp:navigation -->
