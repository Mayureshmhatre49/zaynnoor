<?php
/**
 * Output a single payment method
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<li class="wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?> border border-gold/20 rounded-lg p-5 bg-background-dark/30 hover:bg-background-dark/50 transition-all cursor-pointer">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio hidden" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>" class="flex items-center justify-between cursor-pointer w-full">
		<div class="flex items-center gap-4">
            <div class="payment-radio-custom w-5 h-5 rounded-full border border-gold/40 flex items-center justify-center transition-colors <?php echo $gateway->chosen ? 'border-gold' : ''; ?>">
                <div class="w-2.5 h-2.5 rounded-full bg-gold transition-opacity <?php echo $gateway->chosen ? 'opacity-100' : 'opacity-0'; ?>"></div>
            </div>
            <span class="text-sm font-medium text-white"><?php echo $gateway->get_title(); ?></span>
        </div>
        <div class="payment-icons opacity-60">
            <?php echo $gateway->get_icon(); ?>
        </div>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?> mt-4 pt-4 border-t border-gold/10 text-xs text-slate-400 leading-relaxed font-light" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
