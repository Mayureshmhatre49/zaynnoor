<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart drawer.
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart cart_list product_list_widget list-none p-0 flex-grow overflow-y-auto custom-scrollbar">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_widget_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> flex gap-4 py-6 border-b border-white/5 group">
					
					<div class="w-20 h-28 flex-shrink-0 bg-background-dark/50 rounded-sm overflow-hidden border border-white/10">
						<?php if ( empty( $product_permalink ) ) : ?>
							<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</a>
						<?php endif; ?>
					</div>

					<div class="flex flex-col justify-between py-1 flex-grow">
						<div>
							<div class="flex justify-between items-start">
								<h4 class="text-white text-sm font-medium leading-tight mb-1">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo wp_kses_post( $product_name ); ?>
									<?php else : ?>
										<a class="hover:text-gold transition-colors" href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo wp_kses_post( $product_name ); ?>
										</a>
									<?php endif; ?>
								</h4>
								<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove remove_from_cart_button text-slate-500 hover:text-red-400 transition-colors" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><span class="material-symbols-outlined text-sm">close</span></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
							</div>
							<div class="text-[10px] text-slate-500 uppercase tracking-widest">
								<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						</div>
						<div class="flex justify-between items-end">
							<span class="text-xs text-slate-400 font-light">Qty: <?php echo absint( $cart_item['quantity'] ); ?></span>
							<span class="text-gold font-serif"><?php echo $product_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						</div>
					</div>
				</li>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</ul>

	<div class="woocommerce-mini-cart__total total py-6 border-t border-white/10 flex justify-between items-end">
		<span class="text-slate-400 text-xs uppercase tracking-widest"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
		<span class="text-xl font-serif text-white"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
	</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="woocommerce-mini-cart__buttons buttons flex flex-col gap-3">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward w-full py-4 border border-white/10 text-slate-300 hover:text-gold hover:border-gold/40 text-[10px] font-bold uppercase tracking-widest text-center transition-all bg-white/[0.02]">
            <?php esc_html_e( 'View Full Selection', 'woocommerce' ); ?>
        </a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward w-full py-4 bg-gold text-background-dark font-bold text-[10px] uppercase tracking-widest text-center btn-hover-effect">
            <?php esc_html_e( 'Secure Checkout', 'woocommerce' ); ?>
        </a>
	</div>

	<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>

<?php else : ?>

	<div class="flex-grow flex flex-col items-center justify-center text-center opacity-40">
        <span class="material-symbols-outlined text-6xl mb-4 font-extralight">shopping_bag</span>
        <p class="text-sm uppercase tracking-[0.2em]"><?php esc_html_e( 'Your basket is currently empty.', 'woocommerce' ); ?></p>
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="mt-8 text-[10px] text-gold underline tracking-widest uppercase hover:text-white transition-colors">Begin Exploration</a>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
