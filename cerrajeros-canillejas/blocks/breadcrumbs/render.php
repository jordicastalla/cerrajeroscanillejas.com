<?php
/**
 * Server render for the cerrajeros-canillejas/breadcrumbs block.
 *
 * @package CerrajerosCanillejas
 */

defined( 'ABSPATH' ) || exit;

echo \CerrajerosCanillejas\render_breadcrumbs( get_block_wrapper_attributes( array( 'class' => 'cc-breadcrumbs' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped while building.
