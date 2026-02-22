<!DOCTYPE html>
<html <?php language_attributes(); ?> class="dark">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-background-dark font-display text-slate-100 antialiased overflow-x-hidden selection:bg-gold selection:text-background-dark min-h-screen flex flex-col' ); ?>>
<?php wp_body_open(); ?>

<div class="relative flex min-h-screen w-full flex-col">
	<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-black border-b border-white/5">
		<div class="max-w-[1440px] mx-auto px-6 lg:px-12 h-20 md:h-24 flex items-center justify-between">
			<!-- Logo -->
			<div class="flex items-center gap-3">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3">
				<img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/02/z_logo.jpg' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-10 md:h-14 w-auto object-contain" />
			</a>
			</div>
			
			<!-- Desktop Menu -->
			<nav class="hidden md:flex items-center gap-8 lg:gap-12">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_class'     => 'flex items-center gap-8 lg:gap-12',
					'container'      => false,
					'fallback_cb'    => false,
					'items_wrap'     => '%3$s', // Clean wrap to avoid ul if not needed, but WP outputs li. So we customize it.
					// We'll style the li > a via Tailwind in a separate CSS rule if needed, or walker.
				) );
				// Fallback if no menu:
				if ( ! has_nav_menu( 'menu-1' ) ) {
					echo '<a class="text-xs font-medium text-slate-300 hover:text-gold transition-colors tracking-[0.2em] uppercase" href="'.get_permalink( wc_get_page_id( 'shop' ) ).'">Collection</a>';
				}
				?>
			</nav>

			<!-- Icons -->
			<div class="flex items-center gap-4 md:gap-6">
				<button class="text-slate-300 hover:text-white transition-colors" aria-label="Search">
					<span class="material-symbols-outlined font-light text-[22px] md:text-[24px]">search</span>
				</button>
				<button id="cart-drawer-trigger" class="text-slate-300 hover:text-white transition-colors relative" aria-label="Cart">
					<span class="material-symbols-outlined font-light text-[22px] md:text-[24px]">shopping_bag</span>
					<?php if ( class_exists('WooCommerce') && WC()->cart ) : ?>
						<span class="cart-count absolute -top-1 -right-1 w-4 h-4 rounded-full bg-primary text-background-dark text-[10px] flex items-center justify-center font-bold">
							<?php echo WC()->cart->get_cart_contents_count(); ?>
						</span>
					<?php endif; ?>
				</button>
			</div>
		</div>
	</header>
