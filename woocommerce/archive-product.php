<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_product_data - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<header class="woocommerce-products-header pt-32 pb-16 px-6 lg:px-12 bg-background-dark text-center">
    <div class="fixed inset-0 z-0 opacity-10 bg-texture pointer-events-none"></div>
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title text-4xl md:text-6xl font-serif font-light text-white mb-6"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>
    <div class="w-16 h-px bg-gradient-to-r from-transparent via-gold to-transparent mx-auto mb-8"></div>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>

<div class="bg-background-darker py-16 px-6 lg:px-12 min-h-screen">
    <div class="max-w-[1440px] mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="text-sm text-slate-400 font-light tracking-wide">
                <?php woocommerce_result_count(); ?>
            </div>
            <div class="flex items-center gap-4">
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>

        <?php
        if ( woocommerce_product_loop() ) {

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action( 'woocommerce_after_shop_loop' );
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action( 'woocommerce_no_products_found' );
        }
        ?>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer();
