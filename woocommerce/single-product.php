<?php
/**
 * Single Product Template Override
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	global $product;

	// Ensure $product is the product object
	if ( ! is_a( $product, 'WC_Product' ) ) {
		$product = wc_get_product( get_the_ID() );
	}

	if ( ! $product ) {
		continue;
	}

	// Handle Product Views/Data
	$product_id     = $product->get_id();
	$price_html     = $product->get_price_html();
	$stock_quantity = $product->get_stock_quantity();
	$low_stock      = ( get_option( 'emerald_show_low_stock' ) && $stock_quantity > 0 && $stock_quantity <= 5 ) ? true : false;
	$currency       = get_woocommerce_currency();

	// Gallery images
	$attachment_ids = $product->get_gallery_image_ids();
	$main_image_url = has_post_thumbnail() ? get_the_post_thumbnail_url( $product_id, 'full' ) : wc_placeholder_img_src( 'full' );

	// Available Attributes
	$attributes           = $product->get_attributes();
	$available_variations = $product->is_type( 'variable' ) ? $product->get_available_variations() : array();
	$sizes                = array();
	if ( isset( $attributes['pa_size'] ) ) {
		$sizes = wc_get_product_terms( $product_id, 'pa_size', array( 'fields' => 'names' ) );
	} elseif ( isset( $attributes['Size'] ) ) {
		$sizes = $attributes['Size']->get_options(); // Custom attribute
	}

	// Ensure the standard single product action fires (needed for some plugins and variation data in footer)
	do_action( 'woocommerce_before_single_product' );
	?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'flex-grow layout-container flex flex-col max-w-[1440px] mx-auto w-full px-4 sm:px-6 lg:px-12 py-8', $product ); ?>>
        
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 py-4 mb-4 text-sm mt-24">
			<?php woocommerce_breadcrumb( array( 'wrap_before' => '', 'wrap_after' => '', 'delimiter' => '<span class="text-slate-400 dark:text-[#555] mx-2">/</span>', 'before' => '<span class="text-slate-500 hover:text-primary transition-colors">', 'after' => '</span>' ) ); ?>
        </div>

        <!-- Product Hero Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 min-h-[800px]">
            <!-- Gallery (Left) -->
            <div class="lg:col-span-7 flex flex-col-reverse md:flex-row gap-4 h-full md:max-h-[800px]">
                <!-- Thumbnails Rail -->
                <div class="flex md:flex-col gap-4 overflow-x-auto md:overflow-y-auto w-full md:w-24 flex-shrink-0 pr-1 custom-scrollbar">
					<?php if ( has_post_thumbnail() ) : ?>
                    <button class="gallery-thumb w-20 md:w-full aspect-[3/4] rounded-lg overflow-hidden border-2 border-primary ring-2 ring-primary/20 opacity-100 transition-all flex-shrink-0" data-img="<?php echo esc_attr( get_the_post_thumbnail_url( $product_id, 'full' ) ); ?>">
                        <img alt="Thumbnail" class="w-full h-full object-cover" src="<?php echo esc_attr( get_the_post_thumbnail_url( $product_id, 'woocommerce_thumbnail' ) ); ?>"/>
                    </button>
					<?php endif; ?>
                    
					<?php
					if ( $attachment_ids ) {
						foreach ( $attachment_ids as $attachment_id ) {
							$full_src  = wp_get_attachment_image_url( $attachment_id, 'full' );
							$thumb_src = wp_get_attachment_image_url( $attachment_id, 'woocommerce_thumbnail' );
							?>
                            <button class="gallery-thumb w-20 md:w-full aspect-[3/4] rounded-lg overflow-hidden border border-transparent hover:border-slate-500 opacity-60 hover:opacity-100 transition-all flex-shrink-0" data-img="<?php echo esc_attr( $full_src ); ?>">
                                <img alt="Gallery Image" class="w-full h-full object-cover" src="<?php echo esc_attr( $thumb_src ); ?>"/>
                            </button>
							<?php
						}
					}


					?>
                </div>

                <!-- Main Image -->
                <div class="relative flex-1 h-[500px] md:h-full rounded-xl overflow-hidden group cursor-zoom-in bg-slate-900">
                    <img id="main-product-image" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 gallery-main-image" src="<?php echo esc_attr( $main_image_url ); ?>"/>
                    <div class="absolute inset-0 pointer-events-none bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                    
                    <!-- Zoom hint -->
                    <div class="absolute bottom-6 right-6 bg-black/40 backdrop-blur-md rounded-full p-3 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="material-symbols-outlined">zoom_in</span>
                    </div>
                    
					<?php if ( $low_stock ) : ?>
                        <div class="absolute top-6 left-6 badge-pulse">
                            <span class="bg-red-500/80 backdrop-blur-sm text-white px-3 py-1.5 rounded-sm text-[10px] font-bold uppercase tracking-widest shadow-lg">Only <?php echo $stock_quantity; ?> Left</span>
                        </div>
					<?php endif; ?>
                </div>
            </div>

            <!-- Details (Right) -->
            <div class="lg:col-span-5 flex flex-col justify-center h-full pt-4 lg:pt-0 lg:pl-8">
                <form class="cart" id="custom-add-to-cart-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                
                <!-- Title & Price -->
                <div class="mb-8 border-b border-white/10 pb-8">
                    <div class="flex items-center gap-2 mb-4">
						<?php if ( $product->is_featured() ) : ?>
                            <span class="px-2 py-0.5 rounded-sm text-[10px] font-bold uppercase tracking-widest bg-gold text-slate-900">Featured</span>
						<?php endif; ?>
						<?php if ( has_term( 'ramadan', 'product_cat', $product_id ) || has_term( 'ramadan', 'product_tag', $product_id ) ) : ?>
                            <span class="px-2 py-0.5 rounded-sm text-[10px] font-bold uppercase tracking-widest bg-primary/20 text-primary">Ramadan Exclusive</span>
						<?php endif; ?>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-serif text-white tracking-tight mb-4 leading-[1.1]"><?php the_title(); ?></h1>
                    <div class="flex items-end gap-4">
                        <span class="text-2xl font-light text-white price-display"><?php echo wp_kses_post( $price_html ); ?></span>
                    </div>
                </div>

                <!-- Narrative -->
                <div class="mb-10 text-slate-300 leading-relaxed font-light text-lg">
					<?php echo apply_filters( 'the_content', $product->get_description() ); ?>
                </div>

                <!-- Selectors -->
                <div class="space-y-8 mb-10">
                    <!-- Variations -->
					<?php if ( $product->is_type( 'variable' ) ) : ?>
                        <input type="hidden" name="product_id" value="<?php echo absint( $product_id ); ?>" />
                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                        
                        <div class="variations-container" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ); ?>">
							<?php
							foreach ( $attributes as $attribute_name => $options ) :
								$attribute_label = wc_attribute_label( $attribute_name );
								?>
                                <div class="mb-6 attribute-selector">
                                    <div class="flex justify-between items-center mb-3">
                                        <label class="text-sm font-bold text-white uppercase tracking-wider">Select <?php echo esc_html( $attribute_label ); ?></label>
										<?php if ( strtolower( $attribute_label ) === 'size' && get_option( 'emerald_show_size_recommendation' ) ) : ?>
                                            <button type="button" id="size-guide-trigger" class="text-xs text-slate-400 underline hover:text-primary transition-colors">Size Guide</button>
										<?php endif; ?>
                                    </div>
                                    
                                    <select id="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>" class="hidden custom-variation-select" name="attribute_<?php echo sanitize_title( $attribute_name ); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $attribute_name ); ?>">
                                        <option value="">Choose an option</option>
										<?php
										$attr_values = wc_get_product_terms( $product_id, $attribute_name, array( 'fields' => 'slugs' ) );
										if ( empty( $attr_values ) ) {
											$attr_values = $options->get_options();
										}

										foreach ( $attr_values as $term ) {
											echo '<option value="' . esc_attr( $term ) . '">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term ) ) . '</option>';
										}
										?>
                                    </select>

                                    <!-- Custom UI for Variations (Buttons) -->
                                    <div class="flex flex-wrap gap-3 custom-variation-buttons" data-select-id="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
										<?php foreach ( $attr_values as $term_slug ) : 
                                            $term_obj = get_term_by('slug', $term_slug, $attribute_name);
                                            $term_name = $term_obj ? $term_obj->name : apply_filters( 'woocommerce_variation_option_name', $term_slug );
                                            $color_hex = '';
                                            if ($attribute_name === 'pa_color' && $term_obj) {
                                                $color_hex = get_term_meta($term_obj->term_id, 'emerald_color_hex', true);
                                            }
                                        ?>
                                            <?php if ($color_hex) : ?>
                                                <button type="button" class="variation-btn w-10 h-10 rounded-full border-2 border-transparent hover:border-primary flex items-center justify-center transition-all btn-hover-effect relative group/swatch" data-val="<?php echo esc_attr( $term_slug ); ?>" style="background-color: <?php echo esc_attr($color_hex); ?>;">
                                                    <span class="sr-only"><?php echo esc_html($term_name); ?></span>
                                                </button>
                                            <?php else : ?>
                                                <button type="button" class="variation-btn w-14 h-12 rounded-sm border border-slate-600 flex items-center justify-center text-sm font-medium hover:border-primary hover:text-primary text-slate-300 transition-all btn-hover-effect" data-val="<?php echo esc_attr( $term_slug ); ?>">
    												<?php echo esc_html( $term_name ); ?>
                                                </button>
                                            <?php endif; ?>
										<?php endforeach; ?>
                                    </div>
                                    <div class="text-red-400 text-xs mt-2 hidden error-msg">Please select a <?php echo esc_html( $attribute_label ); ?></div>
                                </div>
							<?php endforeach; ?>
                        </div>
					<?php else : ?>
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>" />
					<?php endif; ?>

                    <!-- Quantity -->
                    <div>
                        <label class="text-sm font-bold text-white uppercase tracking-wider mb-3 block">Quantity</label>
                        <div class="flex items-center w-32 h-12 rounded-sm border border-slate-600 overflow-hidden">
                            <button type="button" class="qty-btn flex-1 h-full flex items-center justify-center hover:bg-white/5 transition-colors" data-action="minus">
                                <span class="material-symbols-outlined text-sm">remove</span>
                            </button>
                            <?php 
                            $max_qty = $product->get_max_purchase_quantity();
                            ?>
                            <input type="number" name="quantity" class="w-10 h-full bg-transparent text-center border-none focus:ring-0 text-white font-medium p-0" min="1" <?php echo ( $max_qty > 0 ) ? 'max="' . esc_attr( $max_qty ) . '"' : ''; ?> value="1" step="1"/>
                            <button type="button" class="qty-btn flex-1 h-full flex items-center justify-center hover:bg-white/5 transition-colors" data-action="plus">
                                <span class="material-symbols-outlined text-sm">add</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col gap-4">
                    <button type="submit" class="btn-hover-effect btn-gold-shine w-full h-14 rounded-sm bg-gold text-background-darker text-sm font-bold uppercase tracking-widest shadow-lg shadow-gold/20 flex items-center justify-center gap-3 transition-all transform active:scale-[0.99] relative overflow-hidden" id="add-to-cart-submit">
                        <span class="btn-text">Add to Cart</span>
                        <div class="spinner absolute hidden w-5 h-5 border-2 border-background-darker rounded-full"></div>
                        <span class="material-symbols-outlined text-xl btn-icon">shopping_bag</span>
                    </button>
                    <p class="text-xs text-center text-slate-400 mt-2">Free express shipping on all orders above $500.</p>
                </div>

                <!-- Trust Badges -->
				<?php if ( get_option( 'emerald_show_trust_badges' ) ) : ?>
					<?php get_template_part( 'template-parts/trust-badges' ); ?>
				<?php endif; ?>

                </form>
                
                <!-- WhatsApp Safety Net -->
                <div class="mt-8 text-center" id="whatsapp-inquiry-container">
                    <p class="text-sm text-slate-400 mb-3 font-light">Need assistance sizing or styling?</p>
					<?php
					$wa_num = get_option( 'emerald_whatsapp_number' );
					$wa_tpl = get_option( 'emerald_whatsapp_template' );
					// Pre-fill parts
					$wa_tpl = str_replace( '{product_name}', get_the_title(), $wa_tpl );
					$wa_tpl = str_replace( '{product_url}', get_permalink(), $wa_tpl );
					?>
                    <button type="button" id="whatsapp-inquiry-btn" class="btn-hover-effect inline-flex items-center gap-2 text-gold hover:text-white transition-colors text-xs uppercase tracking-wider group" data-wa="<?php echo esc_attr( $wa_num ); ?>" data-tpl="<?php echo esc_attr( $wa_tpl ); ?>">
                        <svg class="w-4 h-4 fill-current transition-transform group-hover:scale-110" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path></svg>
                        Chat with Concierge
                    </button>
                </div>
            </div>
        </div>

		<?php get_template_part( 'template-parts/single-additional' ); ?>

    </div>

    <!-- Size Guide Modal -->
	<?php get_template_part( 'template-parts/size-guide-modal' ); ?>

	<?php
	do_action( 'woocommerce_after_single_product' );
endwhile; // end of the loop.

get_footer();

