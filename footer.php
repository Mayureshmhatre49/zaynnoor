	</div><!-- #page or main wrap -->

	<!-- Search Modal -->
	<div id="search-modal" class="modal-overlay fixed inset-0 z-[70] flex items-center justify-center p-4">
		<div class="absolute inset-0 bg-background-dark/90 backdrop-blur-xl" id="search-modal-close-overlay"></div>
		<div class="relative w-full max-w-4xl opacity-0 translate-y-10 transition-all duration-500" id="search-modal-content">
			<button id="search-modal-close-btn" class="absolute -top-16 right-0 text-white hover:text-gold transition-colors">
				<span class="material-symbols-outlined text-4xl font-light">close</span>
			</button>
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="relative group">
					<input type="search" class="w-full bg-transparent border-b-2 border-white/10 focus:border-gold outline-none text-white text-3xl md:text-5xl font-serif py-4 pr-16 placeholder:text-white/10 transition-colors" placeholder="What are you seeking?..." value="" name="s" />
					<button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 text-white/40 group-hover:text-gold transition-colors">
						<span class="material-symbols-outlined text-4xl">search</span>
					</button>
                    <input type="hidden" name="post_type" value="product" />
				</div>
			</form>
			<div class="mt-8 flex gap-6 text-[10px] uppercase tracking-[0.3em] text-white/30 justify-center">
				<span>Trending:</span>
				<a href="?s=emerald&post_type=product" class="hover:text-gold transition-colors">Emerald</a>
				<a href="?s=velvet&post_type=product" class="hover:text-gold transition-colors">Velvet</a>
				<a href="?s=limited&post_type=product" class="hover:text-gold transition-colors">Ramadan</a>
			</div>
		</div>
	</div>

	<!-- Cart Drawer -->
	<!-- We put this outside the main flex wrapper to easily span full height -->
	<div id="cart-drawer-overlay" class="cart-drawer-overlay fixed inset-0 z-[60] bg-black/60">
		    <div id="cart-drawer-container" class="cart-drawer absolute right-0 top-0 bottom-0 w-full max-w-sm bg-background-dark shadow-2xl border-l border-white/10 flex flex-col p-8 md:p-10">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8 border-b border-white/5 pb-6">
            <h3 class="text-xl font-serif text-white">Your Selection</h3>
            <button id="cart-drawer-close" class="text-slate-500 hover:text-gold transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Dynamic Content -->
        <div class="widget_shopping_cart_content flex-grow flex flex-col overflow-hidden">
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
	</div>

	<!-- Footer -->
	<footer class="bg-emerald-dark border-t border-white/5 py-12 md:py-16 mt-auto">
		<div class="layout-container max-w-[1440px] mx-auto px-6 text-center">
			<div class="flex flex-col items-center gap-6 mb-8 md:mb-12">
				<span class="text-2xl md:text-3xl font-cinzel tracking-widest text-white/90 uppercase">Jubba</span>
				<p class="text-slate-400 text-sm font-light max-w-md">Refining the essence of modern modesty through timeless craftsmanship.</p>
				<div class="flex gap-8 text-slate-400">
					<a class="hover:text-gold transition-colors text-xs uppercase tracking-widest" href="#">Instagram</a>
					<a class="hover:text-gold transition-colors text-xs uppercase tracking-widest" href="#">WhatsApp</a>
					<a class="hover:text-gold transition-colors text-xs uppercase tracking-widest" href="#">Email</a>
				</div>
			</div>
			
			<div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-500 uppercase tracking-wider">
				<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
				<div class="flex gap-6">
					<a class="hover:text-slate-300 transition-colors" href="#">Privacy Policy</a>
					<a class="hover:text-slate-300 transition-colors" href="#">Terms of Service</a>
				</div>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>
