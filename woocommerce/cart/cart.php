<?php
/**
 * Cart Page
 */

defined( 'ABSPATH' ) || exit;

get_header();

do_action( 'woocommerce_before_cart' ); ?>

<main class="flex-grow pt-32 pb-20 px-6 lg:px-12 relative bg-background-dark min-h-screen">
    <div class="fixed inset-0 z-0 opacity-10 bg-texture pointer-events-none"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary-dark/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-[1440px] mx-auto relative z-10">
        <div class="mb-16 text-center">
            <span class="text-gold tracking-[0.3em] text-xs uppercase font-medium mb-4 block">Your Selection</span>
            <h1 class="text-4xl md:text-6xl font-serif font-light text-white mb-6">Shopping Cart</h1>
            <div class="w-16 h-px bg-gradient-to-r from-transparent via-gold to-transparent mx-auto"></div>
        </div>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Cart Items List -->
                <div class="w-full lg:w-2/3">
                    <div class="overflow-x-auto">
                        <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full text-left border-collapse" cellspacing="0">
                            <thead>
                                <tr class="border-b border-white/10 text-xs uppercase tracking-[0.2em] text-slate-400">
                                    <th class="product-name pb-6 font-normal w-[50%]"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                                    <th class="product-price pb-6 font-normal text-center"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
                                    <th class="product-quantity pb-6 font-normal text-center"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
                                    <th class="product-subtotal pb-6 font-normal text-right"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                                    <th class="product-remove pb-6 font-normal w-10"></th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-200">
                                <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                                <?php
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                        ?>
                                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> group border-b border-white/5 hover:bg-white/[0.02] transition-colors">
                                            
                                            <!-- Product Info -->
                                            <td class="product-name py-8 pr-6" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                <div class="flex items-center gap-6">
                                                    <div class="product-thumbnail w-24 h-32 flex-shrink-0 overflow-hidden rounded-sm border border-white/10 relative">
                                                        <?php
                                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                                        if ( ! $product_permalink ) {
                                                            echo $thumbnail; // PHPCS: XSS ok.
                                                        } else {
                                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                                        }
                                                        ?>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-serif text-xl text-white mb-2"><?php 
                                                            if ( ! $product_permalink ) {
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                            } else {
                                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                            }
                                                        ?></h3>
                                                        <div class="text-sm text-slate-400 font-light mb-1">
                                                            <?php echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok. ?>
                                                        </div>
                                                        <?php
                                                        // Backorder notification.
                                                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Price -->
                                            <td class="product-price py-8 text-center align-middle" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                <span class="text-slate-300 font-light"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?></span>
                                            </td>

                                            <!-- Quantity -->
                                            <td class="product-quantity py-8 text-center align-middle" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                                <div class="inline-flex items-center border-b border-gold/30 hover:border-gold/60 transition-colors">
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                    } else {
                                                        $product_quantity = woocommerce_quantity_input(
                                                            array(
                                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                'input_value'  => $cart_item['quantity'],
                                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                                'min_value'    => '0',
                                                                'product_name' => $_product->get_name(),
                                                            ),
                                                            $_product,
                                                            false
                                                        );
                                                    }
                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                    ?>
                                                </div>
                                            </td>

                                            <!-- Subtotal -->
                                            <td class="product-subtotal py-8 text-right align-middle font-serif text-lg" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                                <span class="text-gold"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?></span>
                                            </td>

                                            <!-- Remove -->
                                            <td class="product-remove py-8 text-right align-middle" data-title="<?php esc_attr_e( 'Remove', 'woocommerce' ); ?>">
                                                <?php
                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove text-slate-500 hover:text-red-400 transition-colors p-2" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="material-symbols-outlined text-lg">close</span></a>',
                                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                            esc_html__( 'Remove this item', 'woocommerce' ),
                                                            esc_attr( $product_id ),
                                                            esc_attr( $_product->get_sku() )
                                                        ),
                                                        $cart_item_key
                                                    );
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                <?php do_action( 'woocommerce_cart_contents' ); ?>

                                <tr class="border-t border-white/10">
                                    <td colspan="6" class="actions py-8">
                                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                                            <?php if ( wc_coupons_enabled() ) { ?>
                                                <div class="coupon flex items-center">
                                                    <input type="text" name="coupon_code" class="input-text bg-transparent border-none focus:ring-0 text-white placeholder-slate-500 text-sm py-1" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                                                    <button type="submit" class="button font-bold text-[10px] uppercase tracking-widest text-gold hover:text-white transition-colors" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
                                                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                                </div>
                                            <?php } ?>

                                            <button type="submit" class="button btn-hover-effect border border-white/10 text-slate-400 hover:text-gold hover:border-gold/40 px-8 py-3 rounded-sm text-xs font-bold uppercase tracking-widest transition-all" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

                                            <?php do_action( 'woocommerce_cart_actions' ); ?>
                                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                                        </div>
                                    </td>
                                </tr>

                                <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                            </tbody>
                        </table>
                        <?php do_action( 'woocommerce_after_cart_table' ); ?>
                    </div>
                    
                    <div class="mt-12 flex justify-between items-center">
                        <a class="flex items-center gap-2 text-sm text-slate-400 hover:text-gold transition-colors uppercase tracking-widest group" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                            <span class="material-symbols-outlined text-lg group-hover:-translate-x-1 transition-transform">arrow_left_alt</span>
                            <?php esc_html_e( 'Continue Shopping', 'woocommerce' ); ?>
                        </a>
                    </div>
                </div>

                <!-- Cart Totals Sidebar -->
                <div class="w-full lg:w-1/3">
                    <div class="cart-collaterals sticky top-32">
                        <?php
                            /**
                             * Cart collaterals hook.
                             *
                             * @hooked woocommerce_cross_sell_display
                             * @hooked woocommerce_cart_totals - 10
                             */
                            do_action( 'woocommerce_cart_collaterals' );
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<?php do_action( 'woocommerce_after_cart' ); ?>
<?php get_footer(); ?>
