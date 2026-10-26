<?php
/**
 * Cerrajeros Canillejas — child theme of Prime FSE.
 *
 * The visual system lives in theme.json, the block templates, template parts
 * and patterns. PHP is limited to what block markup cannot express on its own:
 * asset loading, pattern/block-style registration, a breadcrumbs block,
 * FAQ microdata, and local-business structured data.
 *
 * @package CerrajerosCanillejas
 */

namespace CerrajerosCanillejas;

defined( 'ABSPATH' ) || exit;

define( 'CERRAJEROS_CANILLEJAS_VERSION', '1.4.0' );

require_once __DIR__ . '/inc/business.php';
require_once __DIR__ . '/inc/setup.php';
require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/breadcrumbs.php';
require_once __DIR__ . '/inc/block-enhancements.php';
require_once __DIR__ . '/inc/seo.php';
