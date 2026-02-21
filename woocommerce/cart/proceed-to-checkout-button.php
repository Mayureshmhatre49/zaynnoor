<?php
/**
 * Proceed to checkout button
 */

defined( 'ABSPATH' ) || exit;
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward w-full btn-gold-shine bg-metallic-gold text-background-dark font-bold text-sm uppercase tracking-[0.15em] py-5 rounded-sm shadow-[0_4px_20px_rgba(212,175,55,0.2)] hover:shadow-[0_4px_30px_rgba(212,175,55,0.4)] transition-all transform hover:-translate-y-0.5 mb-6 text-center block">
	<?php esc_html_e( 'Proceed to Secure Checkout', 'woocommerce' ); ?>
</a>
