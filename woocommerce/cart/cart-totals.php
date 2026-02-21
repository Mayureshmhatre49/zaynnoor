<?php
/**
 * Cart totals
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?> relative p-1">
    
    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <div class="absolute inset-0 bg-gradient-to-b from-gold/40 via-gold/10 to-gold/40 rounded-sm"></div>
    <div class="absolute inset-[1px] bg-background-dark rounded-sm"></div>
    
    <div class="relative p-8 md:p-10 bg-gradient-to-b from-white/[0.03] to-transparent">
        <h2 class="font-serif text-2xl text-white mb-8"><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>

        <div class="space-y-4 mb-8">
            <div class="cart-subtotal flex justify-between text-sm text-slate-400 font-light">
                <span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
                <span class="text-white font-medium" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>

            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex justify-between text-sm text-slate-400 font-light">
                    <span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                    <span class="text-primary font-medium" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                </div>
            <?php endforeach; ?>

            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
                <?php wc_cart_totals_shipping_html(); ?>
                <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
            <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
                <div class="shipping flex justify-between text-sm text-slate-400 font-light">
                    <span><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></span>
                    <span data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></span>
                </div>
            <?php endif; ?>

            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <div class="fee flex justify-between text-sm text-slate-400 font-light">
                    <span><?php echo esc_html( $fee->name ); ?></span>
                    <span class="text-white font-medium" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></span>
                </div>
            <?php endforeach; ?>

            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
                $taxable_address = WC()->customer->get_taxable_address();
                $estimated_text  = '';

                if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                    /* translators: %s location. */
                    $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                }

                if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                        <div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex justify-between text-sm text-slate-400 font-light">
                            <span><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            <span class="text-white font-medium" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="tax-total flex justify-between text-sm text-slate-400 font-light">
                        <span><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <span class="text-white font-medium" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></span>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="w-full h-px bg-white/10 mb-8"></div>

        <div class="order-total flex justify-between items-end mb-8">
            <span class="text-sm uppercase tracking-widest text-gold font-medium"><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
            <span class="font-serif text-3xl text-white" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <div class="wc-proceed-to-checkout">
            <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
        </div>

        <?php do_action( 'woocommerce_after_cart_totals' ); ?>

        <!-- WhatsApp Safety Net on Cart -->
        <div class="text-center mt-6 mb-6">
            <a class="inline-flex items-center gap-2 text-slate-400 hover:text-green-400 transition-colors text-xs uppercase tracking-wider group" href="<?php echo esc_url( 'https://wa.me/' . get_option('emerald_whatsapp_number') ); ?>" target="_blank">
                <svg class="w-4 h-4 fill-current transition-transform group-hover:scale-110" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path></svg>
                Enquire via WhatsApp
            </a>
        </div>

        <div class="text-[10px] text-slate-500 text-center font-light leading-relaxed">
            Secure checkout powered by Stripe. All transactions are encrypted. 
            <br/>Need assistance? Contact our <a class="underline hover:text-white" href="#">Concierge</a>.
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_after_cart_totals' ); ?>
