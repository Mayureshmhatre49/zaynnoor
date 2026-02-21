<?php
/**
 * Single Product Additional Info (Reviews / Limited Timer)
 */
?>

<!-- Limited Release Timer (Thematic) -->
<div class="mt-20 lg:mt-32 mb-20">
    <div class="relative rounded-sm overflow-hidden bg-gradient-to-r from-slate-900 to-primary-dark/40 border border-gold/30 p-8 lg:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
        <!-- Pattern Background -->
        <div class="absolute inset-0 opacity-10 bg-texture pointer-events-none"></div>
        <div class="relative z-10 text-center md:text-left">
            <h3 class="text-gold font-serif text-2xl lg:text-3xl font-bold mb-2">Limited Ramadan Release</h3>
            <p class="text-slate-300 max-w-md font-light">Secure your piece of history. This collection will not be restocked once the timer ends.</p>
        </div>
        <div class="relative z-10 flex gap-4 lg:gap-8 ivory-timer" data-end="2024-04-10T00:00:00">
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white font-mono bg-white/5 rounded-sm p-3 backdrop-blur-sm border border-white/10 minutes-value">04</div>
                <span class="text-xs text-gold uppercase tracking-widest mt-2 block">Days</span>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white font-mono bg-white/5 rounded-sm p-3 backdrop-blur-sm border border-white/10 hours-value">12</div>
                <span class="text-xs text-gold uppercase tracking-widest mt-2 block">Hours</span>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-bold text-white font-mono bg-white/5 rounded-sm p-3 backdrop-blur-sm border border-white/10 seconds-value">45</div>
                <span class="text-xs text-gold uppercase tracking-widest mt-2 block">Mins</span>
            </div>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<section class="max-w-5xl mx-auto w-full mb-20">
    <div class="flex items-center justify-between mb-10">
        <h3 class="text-2xl font-serif text-white">Clientele Reflections</h3>
        <div class="flex gap-1 text-gold">
            <span class="material-symbols-outlined text-sm">star</span>
            <span class="material-symbols-outlined text-sm">star</span>
            <span class="material-symbols-outlined text-sm">star</span>
            <span class="material-symbols-outlined text-sm">star</span>
            <span class="material-symbols-outlined text-sm">star</span>
            <span class="text-sm ml-2 text-slate-400 font-medium">(4.9/5 from 120+ reviews)</span>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Review Card 1 -->
        <div class="bg-white/5 p-6 rounded-sm border border-white/5 hover:border-gold/30 transition-all">
            <div class="flex gap-1 text-gold mb-4">
                <span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span>
            </div>
            <p class="text-slate-300 text-sm leading-relaxed mb-6 italic">"The velvet is incredibly soft and the fit is perfect. It truly feels like a bespoke garment. Highly recommended for special occasions."</p>
            <div class="flex items-center gap-3">
                <div class="size-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white">AK</div>
                <div>
                    <p class="text-xs font-bold text-white">Ahmed K.</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest">Verified Owner</p>
                </div>
            </div>
        </div>
        <!-- Review Card 2 -->
        <div class="bg-white/5 p-6 rounded-sm border border-white/5 hover:border-gold/30 transition-all shadow-xl">
            <div class="flex gap-1 text-gold mb-4">
                <span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span>
            </div>
            <p class="text-slate-300 text-sm leading-relaxed mb-6 italic">"Exquisite craftsmanship. The gold embroidery details are subtle yet stunning. Shipping to London was surprisingly fast."</p>
            <div class="flex items-center gap-3">
                <div class="size-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white">ZS</div>
                <div>
                    <p class="text-xs font-bold text-white">Zayn S.</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest">Verified Owner</p>
                </div>
            </div>
        </div>
        <!-- Review Card 3 -->
        <div class="bg-white/5 p-6 rounded-sm border border-white/5 hover:border-gold/30 transition-all">
            <div class="flex gap-1 text-gold mb-4">
                <span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star</span><span class="material-symbols-outlined text-sm">star_half</span>
            </div>
            <p class="text-slate-300 text-sm leading-relaxed mb-6 italic">"Beautiful packaging and presentation. The jubba itself is a masterpiece. Slightly long for me, but easily tailored."</p>
            <div class="flex items-center gap-3">
                <div class="size-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold text-white">OM</div>
                <div>
                    <p class="text-xs font-bold text-white">Omar M.</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest">Verified Owner</p>
                </div>
            </div>
        </div>
    </div>
</section>
