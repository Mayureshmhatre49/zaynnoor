<?php
/**
 * Size Guide Modal Template Part
 */
?>
<div id="size-guide-modal" class="modal-overlay fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" id="size-guide-close-overlay"></div>
    <div class="modal-content relative w-full max-w-2xl bg-background-dark border border-white/10 p-8 md:p-12 overflow-y-auto max-h-[90vh] custom-scrollbar rounded-sm">
        <button id="size-guide-close-btn" class="absolute top-6 right-6 text-slate-400 hover:text-white transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
        
        <div class="text-center mb-10">
            <span class="text-gold tracking-[0.3em] text-xs uppercase font-medium mb-4 block">Precision Fit</span>
            <h2 class="text-3xl font-serif text-white">Size Selection Guide</h2>
        </div>

        <!-- Size Chart Table -->
        <div class="overflow-x-auto mb-10">
            <table class="w-full text-left text-sm text-slate-300">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="py-4 font-bold uppercase tracking-wider text-white">Size</th>
                        <th class="py-4 font-bold uppercase tracking-wider text-white">Height (cm)</th>
                        <th class="py-4 font-bold uppercase tracking-wider text-white">Weight (kg)</th>
                        <th class="py-4 font-bold uppercase tracking-wider text-white">Chest (in)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    <tr>
                        <td class="py-4 font-bold text-gold">S</td>
                        <td class="py-4">165-170</td>
                        <td class="py-4">60-70</td>
                        <td class="py-4">36-38</td>
                    </tr>
                    <tr>
                        <td class="py-4 font-bold text-gold">M</td>
                        <td class="py-4">170-175</td>
                        <td class="py-4">70-80</td>
                        <td class="py-4">38-40</td>
                    </tr>
                    <tr>
                        <td class="py-4 font-bold text-gold">L</td>
                        <td class="py-4">175-180</td>
                        <td class="py-4">80-90</td>
                        <td class="py-4">40-42</td>
                    </tr>
                    <tr>
                        <td class="py-4 font-bold text-gold">XL</td>
                        <td class="py-4">180-185</td>
                        <td class="py-4">90-100</td>
                        <td class="py-4">42-44</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Size Recommender -->
        <div class="bg-white/5 p-8 rounded-sm border border-white/10">
            <h3 class="text-lg font-serif text-white mb-6 text-center">Smart Recommendation</h3>
            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">Your Height (cm)</label>
                    <input type="number" id="user-height" class="w-full bg-background-dark border border-white/10 text-white p-3 rounded-sm focus:border-gold transition-colors" placeholder="e.g. 175">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">Your Weight (kg)</label>
                    <input type="number" id="user-weight" class="w-full bg-background-dark border border-white/10 text-white p-3 rounded-sm focus:border-gold transition-colors" placeholder="e.g. 75">
                </div>
            </div>
            <button id="get-recommendation" class="w-full py-4 bg-gold text-background-darker font-bold uppercase tracking-widest text-xs btn-hover-effect">
                Calculate Best Fit
            </button>
            <div id="recommendation-result" class="mt-6 text-center hidden">
                <p class="text-slate-400 text-sm mb-1">Recommended Size:</p>
                <p class="text-3xl font-serif text-gold" id="recommended-size-output">-</p>
            </div>
        </div>
    </div>
</div>
