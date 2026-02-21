<?php
/**
 * Checkout Form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<main class="flex-grow w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-12 min-h-screen pt-32">
    <div class="fixed inset-0 z-0 opacity-10 bg-texture pointer-events-none"></div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            
            <!-- Left Column: Billing/Shipping/Payment -->
            <div class="lg:col-span-7 space-y-12">
                
                <div class="flex items-center gap-4 text-xs tracking-widest uppercase mb-8">
                    <span class="text-gold font-bold">01. Details</span>
                    <span class="w-12 h-px bg-gold"></span>
                    <span class="text-white/40">02. Shipping</span>
                    <span class="w-12 h-px bg-white/10"></span>
                    <span class="text-white/40">03. Payment</span>
                </div>

                <?php if ( $checkout->get_checkout_fields() ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <div class="col2-set" id="customer_details">
                        <div class="col-1">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>

                        <div class="col-2">
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>

                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                <?php endif; ?>

            </div>

            <!-- Right Column: Sidebar Order Summary -->
            <div class="lg:col-span-5 relative mt-12 lg:mt-0">
                <div class="sticky top-32">
                    <div class="rounded-xl border border-gold/30 bg-surface-dark/80 backdrop-blur-md p-8 shadow-gold-glow transition-all duration-500 hover:shadow-gold-glow-hover">
                        <h3 class="text-xl font-serif text-white mb-6 flex items-center gap-2">
                            Order Summary
                            <span class="text-[10px] bg-gold/20 text-gold px-2 py-1 rounded-full uppercase tracking-wider font-sans font-bold">
                                <?php echo WC()->cart->get_cart_contents_count(); ?> Item<?php echo WC()->cart->get_cart_contents_count() > 1 ? 's' : ''; ?>
                            </span>
                        </h3>

                        <!-- Mini Cart List Style -->
                        <div class="checkout-summary-items mb-8 border-b border-white/5 pb-4 max-h-[400px] overflow-y-auto custom-scrollbar">
                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
                                    ?>
                                    <div class="flex gap-6 mb-4">
                                        <div class="relative w-20 h-28 flex-shrink-0 bg-background-dark/50 rounded-md overflow-hidden border border-white/10">
                                            <?php echo $_product->get_image(); ?>
                                        </div>
                                        <div class="flex flex-col justify-between py-1 w-full">
                                            <div>
                                                <div class="flex justify-between items-start mb-1">
                                                    <h4 class="text-white font-medium text-base leading-tight"><?php echo $_product->get_name(); ?></h4>
                                                    <span class="text-gold-light font-serif ml-2"><?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?></span>
                                                </div>
                                                <p class="text-[11px] text-slate-400 uppercase tracking-wide">Qty: <?php echo $cart_item['quantity']; ?></p>
                                                <div class="text-[10px] text-slate-500 mt-1">
                                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Totals Integration -->
                        <div class="checkout-totals">
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-sm text-slate-300">
                                    <span>Subtotal</span>
                                    <span><?php wc_cart_totals_subtotal_html(); ?></span>
                                </div>
                                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                                    <div class="flex justify-between text-sm text-slate-300">
                                        <span>Shipping</span>
                                        <span class="text-gold"><?php wc_cart_totals_shipping_html(); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                                    <div class="flex justify-between text-sm text-slate-300">
                                        <span><?php echo esc_html( $fee->name ); ?></span>
                                        <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
                                    </div>
                                <?php endforeach; ?>
                                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                                    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                                        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                                            <div class="flex justify-between text-sm text-slate-300">
                                                <span><?php echo esc_html( $tax->label ); ?></span>
                                                <span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="flex justify-between text-sm text-slate-300">
                                            <span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
                                            <span><?php wc_cart_totals_taxes_total_html(); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <div class="w-full h-px bg-gradient-to-r from-transparent via-gold/40 to-transparent mb-6"></div>
                            
                            <div class="flex justify-between items-end mb-8">
                                <span class="text-slate-200 text-lg font-light">Total</span>
                                <div class="text-right">
                                    <span class="text-3xl font-serif text-white block leading-none"><?php wc_cart_totals_order_total_html(); ?></span>
                                    <span class="text-[10px] text-slate-500 uppercase tracking-widest mt-1 block">Secure Transaction</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit handled by payment partial -->
                        <div class="mt-4 text-center">
                            <div class="flex items-center justify-center gap-2 text-white/30 text-[10px] uppercase tracking-widest">
                                <span class="material-symbols-outlined text-sm">lock</span>
                                256-Bit SSL Encrypted
                            </div>
                            <div class="mt-4 flex justify-center gap-4 opacity-40 grayscale hover:grayscale-0 transition-all duration-500">
                                <div class="h-6 w-10 border border-gold rounded flex items-center justify-center text-[8px] text-gold font-serif">VISA</div>
                                <div class="h-6 w-10 border border-gold rounded flex items-center justify-center text-[8px] text-gold font-serif">MC</div>
                                <div class="h-6 w-10 border border-gold rounded flex items-center justify-center text-[8px] text-gold font-serif">AMEX</div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Review (Payment Methods + Place Order Button) -->
                    <div class="mt-8">
                        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>
                </div>
            </div>

        </div>

    </form>

</main>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<?php get_footer(); ?>
