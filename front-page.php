<?php
/**
 * Front Page Template
 */

get_header(); ?>

<section class="relative h-screen w-full overflow-hidden flex items-center justify-center">
	<div class="absolute inset-0 z-0">
		<div class="w-full h-full bg-cover bg-[9%_0] md:bg-center bg-no-repeat transition-transform duration-[30s] hover:scale-105" style="background-image: url('http://sale.local/wp-content/uploads/2026/02/Gemini_Generated_Image_y1oitry1oitry1oi-scaled.png');"></div>
		<div class="absolute inset-0 bg-hero-gradient-home bg-opacity-80 mix-blend-multiply"></div>
		<div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-90"></div>
		<div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]"></div>
	</div>
	<div class="absolute top-[10%] right-[15%] w-32 h-32 rounded-full bg-accent-gold blur-[80px] opacity-20 animate-pulse"></div>
	
	<!-- Particles -->
	<div class="absolute inset-0 z-10 overflow-hidden pointer-events-none">
		<div class="particle w-1 h-1 top-[20%] left-[20%]" style="animation-delay: 0s;"></div>
		<div class="particle w-1.5 h-1.5 top-[60%] left-[80%]" style="animation-delay: 2s;"></div>
		<div class="particle w-1 h-1 top-[40%] left-[40%]" style="animation-delay: 4s;"></div>
		<div class="particle w-2 h-2 top-[80%] left-[10%]" style="animation-delay: 1s;"></div>
		<div class="particle w-1 h-1 top-[10%] left-[90%]" style="animation-delay: 3s;"></div>
	</div>
	
	<div class="relative z-20 layout-container px-6 flex flex-col items-center text-center max-w-5xl mx-auto pt-24">
		<span class="text-accent-gold tracking-[0.4em] text-xs uppercase mb-8 font-medium animate-fade-in-up border-b border-accent-gold/30 pb-2">Royal Ramadan Collection</span>
		<h1 class="text-5xl md:text-7xl lg:text-8xl font-serif text-white leading-[1.1] tracking-tight mb-10 drop-shadow-2xl">
			Elevate Your Presence <br/>
			<span class="italic text-accent-gold text-glow">This Ramadan</span>
		</h1>
		<p class="text-lg md:text-xl text-slate-300 font-light max-w-2xl mb-14 leading-relaxed tracking-wide opacity-90">
			A celestial convergence of modesty and majesty. Discover the limited edition jubbas crafted for the sacred nights.
		</p>
		<div class="flex flex-col sm:flex-row gap-8">
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-hover-effect btn-gold-shine px-12 py-4 rounded-sm text-background-darker bg-gold font-display font-bold tracking-[0.2em] text-xs uppercase transition-all duration-300 hover:shadow-[0_0_30px_rgba(198,168,124,0.3)] transform hover:-translate-y-1 inline-flex items-center justify-center">
				Explore Collection
			</a>
			<button class="btn-hover-effect group relative overflow-hidden bg-transparent border border-white/20 text-white px-12 py-4 rounded-sm font-display font-bold tracking-[0.2em] text-xs uppercase transition-all duration-300 hover:bg-white/5 hover:border-accent-gold/50 hover:text-accent-gold">
				Our Atelier
			</button>
		</div>
	</div>
	<div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-3 opacity-60">
		<div class="w-[1px] h-16 bg-gradient-to-b from-transparent via-accent-gold to-transparent"></div>
		<span class="text-[10px] uppercase tracking-[0.3em] text-accent-gold/70">Scroll</span>
	</div>
</section>

<!-- Philosophy Section -->
<section class="relative bg-background-dark py-32 overflow-hidden">
	<div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary-dark/20 rounded-full blur-[120px] pointer-events-none translate-x-1/2 -translate-y-1/2"></div>
	<div class="layout-container px-6 md:px-12 max-w-[1440px] mx-auto">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
			<div class="lg:col-span-7 relative">
				<div class="relative z-10 grid grid-cols-2 gap-6 items-center">
					<div class="space-y-6 pt-12">
						<div class="relative overflow-hidden rounded-sm aspect-[3/4]">
							<img alt="Detail of fabric" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity duration-700 hover:scale-105 transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7DoTfChg3IaJ2EcBRWMiEsEJ5fE5KNzuTHVITJ8gj0oljgqkVyBTrI6odbZXFImO4OkWeOPFi0HVrsiYWfGdwRndLh5cQwoupeylJLSH45OCDMQ4RbgTjikRJGQagW7ZADQ_gUjky8pyuNxmVZ3takJZ2qHi3xTbKfTc0J1cJu5MA1O9TbqEfpUA50b_qqJ7l7vFcplI4mjBkbT3eP_AjcKJq6dAGVnAUZ77wRYlqvPvgmj6_qEjDDxAbtS-3xaQbgcai5esFaWE"/>
						</div>
					</div>
					<div class="space-y-6">
						<div class="relative overflow-hidden rounded-sm aspect-[3/4]">
							<img alt="Model in profile" class="w-full h-full object-cover opacity-90 hover:opacity-100 transition-opacity duration-700 hover:scale-105 transform grayscale-[30%]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAyEybtbEKvboFZqBpI-o9Wh9knIxiwNcBJUALa6PtTmj9HziUvTdOf8MfIUHMO6D93iEXpQzrt5vTDPdi2rBFtFBVC3uJBM9NH6J98pws3m4qZu6dKTFSpX80g6Doza7Zbq1ZNCailpFbVBQd15xqNz8BfX3nvD64BuZS9uGznpM4zTBScPOE-BOvBeieeTmleFJwBCb5_LuMVtXoibYbLSaZYObMiLRir_CrbW2urV0pu3TrkjABsEVmCCwMKdHuj1b7a6p2Uc00"/>
						</div>
					</div>
				</div>
				<div class="absolute top-0 bottom-0 left-12 right-12 border border-accent-gold/10 z-0 pointer-events-none"></div>
			</div>
			<div class="lg:col-span-5 flex flex-col justify-center relative">
				<span class="text-accent-gold text-xs font-bold tracking-[0.3em] uppercase mb-6 flex items-center gap-4">
					<span class="w-8 h-[1px] bg-accent-gold"></span>
					Our Philosophy
				</span>
				<h2 class="text-4xl md:text-5xl font-serif text-white mb-8 leading-tight">
					The Art of <br/>
					<span class="italic text-accent-gold font-light">Modesty</span>
				</h2>
				<div class="space-y-6 text-slate-400 font-light leading-relaxed text-lg">
					<p>In a world of noise, true luxury whispers. Our Ramadan collection is an homage to the quiet dignity of tradition, elevated by the precision of modern tailoring.</p>
					<p>Each garment is a masterpiece of restraint, crafted from rare silks and breathable linens sourced from the finest mills. We don't just design clothing; we curate a state of being—serene, noble, and profoundly present.</p>
				</div>
				<div class="mt-12 flex items-center justify-between border-t border-white/10 pt-8">
					<div>
						<img alt="Signature" class="h-12 w-auto invert opacity-60 mb-2" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCVcEYdugL0IO22mIeNGm7IOYx81pFgrpx_HsH0n4GMRN8DhG9mkc4OU8QoHuVnz4WvXWeA7QfgAgj5rlHRoYVKXkTfpTsMyZjp3rtJbnNCrCWaHrxvf387412SP7EZRYqXtnI4COehb2oKgRlqdx7kcKAFB1Yp04mklNyuHVnGHCa-4dO_xQfSzwlkC-a0fdLAnOrae80knwveNA0-IVIJkAcmjRIFB9u5iHxvwUo8Ei3JtjZjTtfLwpbRUAD64vS9YAiliQlwR30"/>
						<span class="text-xs text-accent-gold uppercase tracking-widest block">Master Tailor</span>
					</div>
					<a class="group flex items-center gap-3 text-white text-sm uppercase tracking-widest hover:text-accent-gold transition-colors" href="#">
						Read Story
						<span class="material-symbols-outlined text-lg group-hover:translate-x-2 transition-transform">arrow_right_alt</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Products Collection Section (Dynamic) -->
<section class="relative bg-background-darker py-24 md:py-32 border-t border-white/5">
	<div class="absolute inset-0 bg-texture opacity-10 pointer-events-none"></div>
	<div class="layout-container px-6 md:px-12 max-w-7xl mx-auto relative z-10">
		<div class="flex flex-col items-center text-center mb-20">
			<span class="text-accent-gold tracking-[0.4em] text-xs font-bold uppercase mb-4">Ramadan <?php echo date('Y'); ?></span>
			<h2 class="text-4xl md:text-6xl font-serif text-white mb-8">Exclusive Collection</h2>
			<p class="text-slate-400 max-w-lg mx-auto font-light mb-8">Limited pieces designed for the discerning gentleman.</p>
		</div>
		
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
			<?php
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => 2,
				'orderby'        => 'date',
				'order'          => 'DESC'
			);
			$loop = new WP_Query( $args );
			
			// Hardcoded fallback UI if no products found (to match exactly)
			if ( ! $loop->have_posts() ) {
				get_template_part( 'template-parts/fallback-home-products' );
			} else {
				$count = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
					global $product;
					$is_first = ($count === 0);
					$badge_text = $is_first ? 'Premium' : 'Bestseller';
					$badge_class = $is_first ? 'bg-accent-gold text-background-darker' : 'bg-white/10 backdrop-blur-md text-white border border-white/10';
					$img_url = has_post_thumbnail() ? get_the_post_thumbnail_url($product->get_id(), 'large') : 'https://lh3.googleusercontent.com/aida-public/AB6AXuC7DoTfChg3IaJ2EcBRWMiEsEJ5fE5KNzuTHVITJ8gj0oljgqkVyBTrI6odbZXFImO4OkWeOPFi0HVrsiYWfGdwRndLh5cQwoupeylJLSH45OCDMQ4RbgTjikRJGQagW7ZADQ_gUjky8pyuNxmVZ3takJZ2qHi3xTbKfTc0J1cJu5MA1O9TbqEfpUA50b_qqJ7l7vFcplI4mjBkbT3eP_AjcKJq6dAGVnAUZ77wRYlqvPvgmj6_qEjDDxAbtS-3xaQbgcai5esFaWE'; // Default fallback
					?>
					<div class="group card-hover-glow relative bg-[#05110c] border border-white/5 p-8 rounded-sm flex flex-col hover:border-accent-gold/40 transition-all duration-500">
						<div class="relative w-full aspect-[4/5] overflow-hidden rounded-sm mb-8 bg-background-dark">
							<a href="<?php the_permalink(); ?>" class="block w-full h-full">
								<img alt="<?php echo esc_attr( $product->get_name() ); ?>" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 filter brightness-90 group-hover:brightness-100" src="<?php echo esc_url($img_url); ?>"/>
							</a>
							<div class="absolute top-4 left-4">
								<span class="<?php echo esc_attr($badge_class); ?> px-3 py-1 text-[10px] font-bold uppercase tracking-widest"><?php echo esc_html($badge_text); ?></span>
							</div>
						</div>
						<div class="flex flex-col flex-grow">
							<div class="flex justify-between items-baseline mb-3">
								<a href="<?php the_permalink(); ?>"><h3 class="text-2xl font-serif text-white group-hover:text-accent-gold transition-colors"><?php the_title(); ?></h3></a>
								<span class="text-xl text-accent-gold font-light"><?php echo wc_price( $product->get_price() ); ?></span>
							</div>
							<div class="text-slate-500 font-light text-sm leading-relaxed mb-8 border-b border-white/5 pb-6">
								<?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
							</div>
							<div class="mt-auto grid grid-cols-2 gap-4">
								<a href="<?php the_permalink(); ?>" class="btn-gold-shine bg-gold text-background-darker py-4 px-6 rounded-sm text-xs font-bold uppercase tracking-[0.15em] hover:shadow-lg transition-all text-center btn-hover-effect">
									View Details
								</a>
								<a href="<?php echo esc_url( 'https://wa.me/' . get_option('emerald_whatsapp_number') ); ?>" target="_blank" class="btn-hover-effect flex items-center justify-center gap-2 border border-accent-gold/60 text-accent-gold hover:bg-accent-gold hover:text-background-darker py-4 px-6 rounded-sm text-xs font-bold uppercase tracking-[0.15em] transition-all duration-300 group/btn">
									<span>Enquiry</span>
									<span class="material-symbols-outlined text-sm group-hover/btn:scale-110 transition-transform">chat</span>
								</a>
							</div>
						</div>
					</div>
					<?php
					$count++;
				endwhile;
				wp_reset_postdata();
			}
			?>
		</div>
		
		<div class="mt-20 text-center">
			<a class="inline-block text-slate-400 hover:text-accent-gold transition-colors text-xs font-bold uppercase tracking-[0.3em] border-b border-white/10 hover:border-accent-gold pb-2" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">View Full Collection</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
