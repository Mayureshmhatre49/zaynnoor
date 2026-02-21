<?php
/**
 * Thankyou page (Order Received)
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="flex-grow pt-40 pb-24 px-6 lg:px-12 bg-background-dark min-h-screen relative overflow-hidden text-center">
    <!-- Success Background Effects -->
    <div class="fixed inset-0 z-0 opacity-10 bg-texture pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="max-w-2xl mx-auto relative z-10">
        
        <?php if ( $order ) : ?>

            <?php if ( $order->has_status( 'failed' ) ) : ?>
                <div class="mb-10 scale-in">
                    <span class="material-symbols-outlined text-red-500 text-8xl font-thin mb-6">error_outline</span>
                    <h1 class="text-4xl font-serif text-white mb-4"><?php esc_html_e( 'Transaction Interrupted', 'woocommerce' ); ?></h1>
                    <p class="text-slate-400 font-light leading-relaxed mb-10"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>
                    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="btn-hover-effect inline-block bg-white text-background-dark px-10 py-4 font-bold uppercase tracking-widest text-xs"><?php esc_html_e( 'Retry Payment', 'woocommerce' ); ?></a>
                </div>
            <?php else : ?>
                
                <div class="mb-16 scale-in">
                    <!-- Success Icon -->
                    <div class="relative w-24 h-24 mx-auto mb-10">
                        <div class="absolute inset-0 bg-gold/20 rounded-full animate-ping opacity-20"></div>
                        <div class="relative flex items-center justify-center w-full h-full bg-gold/10 border border-gold/40 rounded-full">
                            <span class="material-symbols-outlined text-gold text-5xl">verified</span>
                        </div>
                    </div>

                    <span class="text-gold tracking-[0.4em] text-[10px] uppercase font-bold mb-4 block">Gratitude for your patronage</span>
                    <h1 class="text-4xl md:text-6xl font-serif font-light text-white mb-6">The Legacy Begins</h1>
                    <div class="w-16 h-px bg-gradient-to-r from-transparent via-gold to-transparent mx-auto mb-10"></div>
                    
                    <p class="text-slate-300 font-light text-lg mb-4"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <p class="text-slate-400 font-light">Order ID: <span class="text-gold font-medium">#<?php echo $order->get_order_number(); ?></span></p>
                </div>

                <!-- Order Details Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 py-10 border-y border-white/5 mb-16 fade-up">
                    <div class="text-center">
                        <span class="block text-[10px] uppercase tracking-widest text-slate-500 mb-2">Order Date</span>
                        <span class="text-sm text-white font-medium"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
                    </div>
                    <div class="text-center">
                        <span class="block text-[10px] uppercase tracking-widest text-slate-500 mb-2">Total Amount</span>
                        <span class="text-sm text-gold font-medium"><?php echo $order->get_formatted_order_total(); ?></span>
                    </div>
                    <div class="text-center">
                        <span class="block text-[10px] uppercase tracking-widest text-slate-500 mb-2">Method</span>
                        <span class="text-sm text-white font-medium"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
                    </div>
                    <div class="text-center">
                        <span class="block text-[10px] uppercase tracking-widest text-slate-500 mb-2">Estimate</span>
                        <span class="text-sm text-white font-medium">3-5 Business Days</span>
                    </div>
                </div>

                <div class="mb-10 text-slate-400 font-light text-sm italic">
                    "A confirmation emissary has been dispatched to your inbox."
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center fade-up-delay-1">
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-hover-effect px-10 py-5 bg-gold text-background-dark font-bold text-[10px] uppercase tracking-[0.2em]">Return to Collection</a>
                    <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="btn-hover-effect px-10 py-5 border border-white/10 text-white hover:border-gold/30 font-bold text-[10px] uppercase tracking-[0.2em]">Track Manifest</a>
                </div>

            <?php endif; ?>

        <?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

        <?php endif; ?>

    </div>
</main>

<?php get_footer(); ?>
