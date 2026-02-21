<?php
/**
 * The template for displaying product content within loops
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( 'group product-card relative overflow-hidden bg-background-dark border border-white/5 hover:border-gold/20 transition-all duration-500 rounded-sm', $product ); ?>>
	
    <!-- Product Image -->
    <div class="relative aspect-[3/4] overflow-hidden">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="block h-full">
            <?php echo $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-700 group-hover:scale-110' ) ); ?>
        </a>
        
        <!-- Hover Overlay -->
        <div class="absolute inset-x-4 bottom-4 translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 flex flex-col gap-2 z-20">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="w-full py-3 bg-white text-background-dark text-[10px] font-bold uppercase tracking-widest text-center shadow-xl hover:bg-gold hover:text-white transition-colors">
                View Details
            </a>
            <?php
            // Add to cart button
            woocommerce_template_loop_add_to_cart();
            ?>
        </div>

        <?php if ( $product->is_on_sale() ) : ?>
            <div class="absolute top-4 left-4 z-10">
                <span class="bg-red-500 text-white px-2 py-1 text-[10px] font-bold uppercase tracking-widest rounded-sm shadow-lg shadow-red-500/20">Sale</span>
            </div>
        <?php endif; ?>

        <?php if ( $product->is_featured() ) : ?>
            <div class="absolute top-4 right-4 z-10">
                <span class="bg-gold text-background-dark px-2 py-1 text-[10px] font-bold uppercase tracking-widest rounded-sm shadow-lg shadow-gold/20">Elite</span>
            </div>
        <?php endif; ?>
    </div>

    <!-- Product Text -->
    <div class="p-6">
        <p class="text-[10px] text-slate-500 uppercase tracking-[0.2em] mb-2">
            <?php echo wc_get_product_category_list( $product->get_id(), ', ', '', '' ); ?>
        </p>
        <h3 class="text-white text-lg font-serif mb-3 leading-tight group-hover:text-gold transition-colors">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo $product->get_name(); ?></a>
        </h3>
        <div class="flex items-center justify-between">
            <span class="text-gold font-serif text-base">
                <?php echo $product->get_price_html(); ?>
            </span>
            <div class="flex gap-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-[10px] text-gold">star</span>
                <span class="material-symbols-outlined text-[10px] text-gold">star</span>
                <span class="material-symbols-outlined text-[10px] text-gold">star</span>
                <span class="material-symbols-outlined text-[10px] text-gold">star</span>
                <span class="material-symbols-outlined text-[10px] text-gold">star</span>
            </div>
        </div>
    </div>
</div>
