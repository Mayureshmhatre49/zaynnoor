<?php
/**
 * WooCommerce Compatibility and Hooks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function emerald_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'emerald_woocommerce_setup' );

// Remove default WooCommerce styles completely for custom performance/design
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Override loop wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'emerald_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'emerald_wrapper_end', 10 );

function emerald_wrapper_start() {
	echo '<main id="main" class="site-main" role="main">';
}
function emerald_wrapper_end() {
	echo '</main>';
}

// Ensure cart fragments for AJAX cart
add_filter( 'woocommerce_add_to_cart_fragments', 'emerald_cart_count_fragments', 10, 1 );
function emerald_cart_count_fragments( $fragments ) {
	ob_start();
	?>
	<span class="cart-count absolute -top-1 -right-1 w-4 h-4 rounded-full bg-primary text-background-dark text-[10px] flex items-center justify-center font-bold">
		<?php echo WC()->cart->get_cart_contents_count(); ?>
	</span>
	<?php
	$fragments['span.cart-count'] = ob_get_clean();

	// Also refresh the mini-cart drawer content
	ob_start();
	woocommerce_mini_cart();
	$fragments['div.widget_shopping_cart_content'] = '<div class="widget_shopping_cart_content flex-grow flex flex-col overflow-hidden">' . ob_get_clean() . '</div>';

	return $fragments;
}

/**
 * Force WooCommerce to use CLASSIC shortcode-based Cart & Checkout
 * instead of the Gutenberg block-based versions.
 * Without this, our custom template overrides in /woocommerce/cart/ and /woocommerce/checkout/ won't load.
 */
add_filter( 'woocommerce_cart_shortcode_atts', '__return_empty_array' );

// Disable the block-based cart and checkout
add_action( 'wp_loaded', 'emerald_disable_wc_blocks' );
function emerald_disable_wc_blocks() {
	// If the CartCheckoutUtils class exists (WC 8.3+), use its method
	if ( class_exists( '\Automattic\WooCommerce\Blocks\Utils\CartCheckoutUtils' ) ) {
		add_filter( 'woocommerce_use_block_template_checkout', '__return_false' );
	}
}

// Classic cart/checkout template selection
add_filter( 'wc_get_template', 'emerald_force_classic_templates', 10, 5 );
function emerald_force_classic_templates( $template, $template_name, $args, $template_path, $default_path ) {
	return $template;
}

// Unhook the block-based templates
add_action( 'init', 'emerald_classic_cart_checkout', 20 );
function emerald_classic_cart_checkout() {
	// Tell WC we do NOT support the cart/checkout blocks
	remove_theme_support( 'wc-product-gallery-lightbox' );
}

/**
 * Custom AJAX Add to Cart handler
 */
add_action( 'wp_ajax_emerald_add_to_cart', 'emerald_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_emerald_add_to_cart', 'emerald_ajax_add_to_cart' );
function emerald_ajax_add_to_cart() {
	$product_id   = absint( $_POST['product_id'] ?? 0 );
	$quantity     = absint( $_POST['quantity'] ?? 1 );
	$variation_id = absint( $_POST['variation_id'] ?? 0 );
	$variations   = array();

	// Collect variation attributes
	foreach ( $_POST as $key => $value ) {
		if ( strpos( $key, 'attribute_' ) === 0 ) {
			$variations[ $key ] = sanitize_text_field( $value );
		}
	}

	// For simple products, product_id may come as add-to-cart
	if ( ! $product_id && ! empty( $_POST['add-to-cart'] ) ) {
		$product_id = absint( $_POST['add-to-cart'] );
	}

	// Validate we have a product
	if ( ! $product_id ) {
		wp_send_json_error( array( 'message' => 'Invalid product.' ) );
		wp_die();
	}

	// Clear any existing WC notices before attempting
	wc_clear_notices();

	// If variation_id is 0 but we have variation attributes,
	// resolve the variation_id server-side using WooCommerce's built-in matcher.
	// This handles the case where the JS-side resolution fails (e.g. empty product_variations JSON).
	$product_obj = wc_get_product( $product_id );
	if ( $product_obj && $product_obj->is_type( 'variable' ) && ! $variation_id && ! empty( $variations ) ) {
		$data_store   = WC_Data_Store::load( 'product' );
		$variation_id = $data_store->find_matching_product_variation( $product_obj, $variations );
	}

	if ( $variation_id ) {
		$added = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations );
	} elseif ( $product_obj && ! $product_obj->is_type( 'variable' ) ) {
		// Simple product
		$added = WC()->cart->add_to_cart( $product_id, $quantity );
	} else {
		// Variable product but no variation could be resolved
		wp_send_json_error( array( 'message' => 'Please select all product options.' ) );
		wp_die();
	}

	if ( $added ) {
		WC_AJAX::get_refreshed_fragments();
	} else {
		// Gather WooCommerce error notices for helpful error message
		$notices = wc_get_notices( 'error' );
		wc_clear_notices();
		$error_messages = array();
		if ( ! empty( $notices ) ) {
			foreach ( $notices as $notice ) {
				$error_messages[] = isset( $notice['notice'] ) ? wp_strip_all_tags( $notice['notice'] ) : wp_strip_all_tags( $notice );
			}
		}
		wp_send_json_error( array(
			'message' => ! empty( $error_messages ) ? implode( ' ', $error_messages ) : 'Could not add to cart.',
		) );
	}
	wp_die();
}

// Note: AJAX URL and nonce are localized in inc/enqueue.php to avoid duplication.

/**
 * Force classic shortcode Cart & Checkout pages on theme activation.
 * This replaces any Gutenberg block content with classic shortcodes.
 */
add_action( 'after_switch_theme', 'emerald_convert_cart_checkout_to_classic' );
add_action( 'init', 'emerald_maybe_convert_cart_checkout', 99 );
function emerald_maybe_convert_cart_checkout() {
	if ( get_option( 'emerald_converted_classic', false ) ) return;
	emerald_convert_cart_checkout_to_classic();
	update_option( 'emerald_converted_classic', true );
}
function emerald_convert_cart_checkout_to_classic() {
	// Cart page
	$cart_page_id = wc_get_page_id( 'cart' );
	if ( $cart_page_id > 0 ) {
		wp_update_post( array(
			'ID'           => $cart_page_id,
			'post_content' => '<!-- Classic Cart -->[woocommerce_cart]',
		));
	}
	// Checkout page
	$checkout_page_id = wc_get_page_id( 'checkout' );
	if ( $checkout_page_id > 0 ) {
		wp_update_post( array(
			'ID'           => $checkout_page_id,
			'post_content' => '<!-- Classic Checkout -->[woocommerce_checkout]',
		));
	}
	// My Account page
	$account_page_id = wc_get_page_id( 'myaccount' );
	if ( $account_page_id > 0 ) {
		wp_update_post( array(
			'ID'           => $account_page_id,
			'post_content' => '[woocommerce_my_account]',
		));
	}
}
