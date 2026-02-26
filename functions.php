<?php
/**
 * Emerald Luxury Theme functions and definitions
 *
 * @package emerald-luxury
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define Theme Constants
define( 'EMERALD_VERSION', '1.0.1' );
define( 'EMERALD_DIR', get_template_directory() );
define( 'EMERALD_URI', get_template_directory_uri() );

// Include Core Files
require_once EMERALD_DIR . '/inc/theme-setup.php';
require_once EMERALD_DIR . '/inc/enqueue.php';
require_once EMERALD_DIR . '/inc/performance.php';
require_once EMERALD_DIR . '/inc/color-swatches.php';

// Include WooCommerce Compatibility (if active)
if ( class_exists( 'WooCommerce' ) ) {
	require_once EMERALD_DIR . '/inc/woocommerce.php';
}

// Include Admin Settings
if ( is_admin() ) {
	require_once EMERALD_DIR . '/inc/admin-settings.php';
}
