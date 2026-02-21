<?php
/**
 * Loop Add to Cart Button
 */

global $product;

if ( $product ) {
	$defaults = array(
		'quantity'   => 1,
		'class'      => implode(
			' ',
			array_filter(
				array(
					'button',
					'product_type_' . $product->get_type(),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
				)
			)
		),
		'attributes' => array(
			'data-product_id'  => $product->get_id(),
			'data-product_sku' => $product->get_sku(),
			'aria-label'       => $product->add_to_cart_description(),
			'rel'              => 'nofollow',
		),
	);

	$args = apply_filters( 'woocommerce_loop_add_to_cart_args', $defaults, $product );

	if ( isset( $args['attributes']['aria-label'] ) ) {
		$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
	}

	echo apply_filters(
		'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
		sprintf(
			'<a href="%s" %s class="%s w-full py-3 bg-gold/10 border border-gold/30 text-gold text-[10px] font-bold uppercase tracking-widest text-center hover:bg-gold hover:text-white transition-all transform active:scale-95">%s</a>',
			esc_url( $product->add_to_cart_url() ),
			wc_implode_html_attributes( $args['attributes'] ),
			esc_attr( $args['class'] ),
			esc_html( $product->add_to_cart_text() )
		),
		$product,
		$args
	);
}
