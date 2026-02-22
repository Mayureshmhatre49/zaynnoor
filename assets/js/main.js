/**
 * Emerald Luxury Theme - Main Javascript
 * Vanilla JS only, Zero Dependencies
 */

document.addEventListener('DOMContentLoaded', () => {
    initGallery();
    initVariations();
    initQuantity();
    initModals();
    initSearch();
    initCartDrawer();
    initTimer();
    initWhatsApp();
});

/**
 * 1. Product Gallery Logic
 */
function initGallery() {
    const mainImg = document.getElementById('main-product-image');
    const thumbs = document.querySelectorAll('.gallery-thumb');

    if (!mainImg || !thumbs.length) return;

    thumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            const newSrc = thumb.getAttribute('data-img');
            if (mainImg.src === newSrc) return;

            // Fade out
            mainImg.classList.add('fading');

            // Highlight thumb
            thumbs.forEach(t => t.classList.remove('border-primary', 'ring-2', 'ring-primary/20', 'opacity-100'));
            thumbs.forEach(t => t.classList.add('border-transparent', 'opacity-60'));
            thumb.classList.remove('border-transparent', 'opacity-60');
            thumb.classList.add('border-primary', 'ring-2', 'ring-primary/20', 'opacity-100');

            setTimeout(() => {
                mainImg.src = newSrc;
                mainImg.classList.remove('fading');
            }, 200);
        });
    });
}

/**
 * 2. Custom Variation Button Selection
 */
function initVariations() {
    const variationBtns = document.querySelectorAll('.variation-btn');
    if (!variationBtns.length) return;

    // Load the variations data from the container
    const variationsContainer = document.querySelector('.variations-container');
    let productVariations = [];
    if (variationsContainer && variationsContainer.getAttribute('data-product_variations')) {
        try {
            productVariations = JSON.parse(variationsContainer.getAttribute('data-product_variations'));
        } catch (e) {
            console.error('Failed to parse product variations:', e);
        }
    }

    variationBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const parent = btn.closest('.custom-variation-buttons');
            const selectId = parent.getAttribute('data-select-id');
            const realSelect = document.getElementById(selectId);
            const val = btn.getAttribute('data-val');

            // Update real hidden select
            realSelect.value = val;
            realSelect.dispatchEvent(new Event('change', { bubbles: true }));

            // Update UI
            parent.querySelectorAll('.variation-btn').forEach(b => b.classList.remove('selected', 'border-primary', 'bg-primary/10', 'text-primary'));
            btn.classList.add('selected', 'border-primary', 'bg-primary/10', 'text-primary');

            // Hide error if shown
            btn.closest('.attribute-selector').querySelector('.error-msg').classList.add('hidden');

            // Resolve the variation_id from the selected attributes
            resolveVariation(productVariations);
        });
    });
}

/**
 * 2b. Resolve Variation ID from selected attributes
 * Matches the currently selected attribute values against the product's
 * available variations and sets the hidden variation_id input accordingly.
 */
function resolveVariation(productVariations) {
    const variationIdInput = document.querySelector('input.variation_id');
    if (!variationIdInput || !productVariations.length) return;

    // Gather all currently selected attribute values
    const selects = document.querySelectorAll('.custom-variation-select');
    const selectedAttrs = {};
    let allSelected = true;

    selects.forEach(s => {
        const attrName = s.getAttribute('data-attribute_name');
        const attrVal = s.value;
        if (!attrVal) {
            allSelected = false;
        }
        selectedAttrs[attrName] = attrVal;
    });

    if (!allSelected) {
        variationIdInput.value = 0;
        return;
    }

    // Find the matching variation
    const matchedVariation = productVariations.find(variation => {
        // Each variation has an 'attributes' object like { attribute_pa_size: "l", attribute_pa_color: "black" }
        // A value of "" in the variation means "any" (matches all)
        return Object.keys(selectedAttrs).every(attrName => {
            const variationVal = variation.attributes[attrName];
            // Empty string in variation = "Any" option, matches everything
            if (!variationVal || variationVal === '') return true;
            return variationVal === selectedAttrs[attrName];
        });
    });

    if (matchedVariation) {
        variationIdInput.value = matchedVariation.variation_id;

        // Update price display if available
        if (matchedVariation.price_html) {
            const priceDisplay = document.querySelector('.price-display');
            if (priceDisplay) {
                priceDisplay.innerHTML = matchedVariation.price_html;
            }
        }

        // Update gallery image if variation has one
        if (matchedVariation.image && matchedVariation.image.full_src) {
            const mainImg = document.getElementById('main-product-image');
            if (mainImg) {
                mainImg.classList.add('fading');
                setTimeout(() => {
                    mainImg.src = matchedVariation.image.full_src;
                    mainImg.classList.remove('fading');
                }, 200);
            }
        }
    } else {
        variationIdInput.value = 0;
    }
}

/**
 * 3. Quantity Increment/Decrement
 */
function initQuantity() {
    const qtyContainers = document.querySelectorAll('.qty-btn');
    qtyContainers.forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.closest('div').querySelector('input[type="number"]');
            let val = parseInt(input.value);
            const action = btn.getAttribute('data-action');

            if (action === 'plus') {
                input.value = val + 1;
            } else if (action === 'minus' && val > 1) {
                input.value = val - 1;
            }
            input.dispatchEvent(new Event('change', { bubbles: true }));
        });
    });
}

/**
 * 4. Modals (Size Guide)
 */
function initModals() {
    const trigger = document.getElementById('size-guide-trigger');
    const modal = document.getElementById('size-guide-modal');
    const closeBtns = [document.getElementById('size-guide-close-btn'), document.getElementById('size-guide-close-overlay')];

    if (!trigger || !modal) return;

    trigger.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    });

    closeBtns.forEach(btn => {
        if (!btn) return;
        btn.addEventListener('click', () => {
            modal.classList.remove('open');
            document.body.style.overflow = '';
        });
    });

    // Size Recommender Logic
    const recBtn = document.getElementById('get-recommendation');
    if (recBtn) {
        recBtn.addEventListener('click', () => {
            const h = parseInt(document.getElementById('user-height').value);
            const w = parseInt(document.getElementById('user-weight').value);
            const resultDiv = document.getElementById('recommendation-result');
            const output = document.getElementById('recommended-size-output');

            if (!h || !w) return alert('Please enter height and weight');

            let size = "L"; // Default
            if (h < 170) size = "S";
            else if (h < 176 && w < 80) size = "M";
            else if (h > 182 || w > 90) size = "XL";

            output.innerText = size;
            resultDiv.classList.remove('hidden');
        });
    }
}

/**
 * 5. AJAX Cart and Drawer
 */
function initCartDrawer() {
    const trigger = document.getElementById('cart-drawer-trigger');
    const drawer = document.getElementById('cart-drawer-overlay');
    const closeBtn = document.getElementById('cart-drawer-close');
    const addToCartForm = document.getElementById('custom-add-to-cart-form');

    if (trigger && drawer) {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            drawer.classList.add('open');
            document.body.style.overflow = 'hidden';
        });

        closeBtn.addEventListener('click', () => {
            drawer.classList.remove('open');
            document.body.style.overflow = '';
        });

        drawer.addEventListener('click', (e) => {
            if (e.target === drawer) {
                drawer.classList.remove('open');
                document.body.style.overflow = '';
            }
        });
    }

    // AJAX Add to Cart
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validation for variations
            const selects = addToCartForm.querySelectorAll('.custom-variation-select');
            let hasError = false;
            selects.forEach(s => {
                if (!s.value) {
                    s.closest('.attribute-selector').querySelector('.error-msg').classList.remove('hidden');
                    hasError = true;
                }
            });
            if (hasError) return;

            // Note: variation_id may be 0 if JS-side resolution couldn't find a match
            // (e.g. empty product_variations data). The server will resolve it from the attributes.


            const submitBtn = document.getElementById('add-to-cart-submit');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnIcon = submitBtn.querySelector('.btn-icon');
            const spinner = submitBtn.querySelector('.spinner');

            // Loading state
            btnText.innerText = "Adding...";
            btnIcon.classList.add('hidden');
            spinner.classList.remove('hidden');
            submitBtn.disabled = true;

            const formData = new FormData(addToCartForm);
            formData.append('action', 'emerald_add_to_cart');

            // Use our custom AJAX endpoint (ajax_url from wp_localize_script in enqueue.php)
            const ajaxUrl = (typeof emerald_ajax !== 'undefined') ? emerald_ajax.ajax_url : '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Server returned ' + res.status);
                    }
                    return res.text();
                })
                .then(text => {
                    // Try to parse JSON — WordPress sometimes prepends HTML to AJAX responses
                    let data;
                    try {
                        // Find the start of JSON in case there is prefixed output
                        const jsonStart = text.indexOf('{');
                        if (jsonStart > 0) {
                            text = text.substring(jsonStart);
                        }
                        data = JSON.parse(text);
                    } catch (parseErr) {
                        console.error('JSON parse error:', parseErr, 'Raw response:', text.substring(0, 200));
                        throw new Error('Invalid response from server');
                    }

                    // Check for explicit error response from wp_send_json_error
                    if (data.success === false) {
                        const errorMsg = (data.data && data.data.message) ? data.data.message : 'Could not add to cart.';
                        console.error('Add to cart error:', errorMsg);
                        btnText.innerText = errorMsg;
                        spinner.classList.add('hidden');
                        btnIcon.innerText = "error";
                        btnIcon.classList.remove('hidden');
                        submitBtn.disabled = false;
                        setTimeout(() => {
                            btnText.innerText = "Add to Cart";
                            btnIcon.innerText = "shopping_bag";
                        }, 3000);
                        return;
                    }

                    // Success — update cart fragments
                    if (data.fragments) {
                        Object.keys(data.fragments).forEach(key => {
                            const el = document.querySelector(key);
                            if (el) el.outerHTML = data.fragments[key];
                        });
                    }

                    // Success state
                    btnText.innerText = "Added ✓";
                    spinner.classList.add('hidden');
                    btnIcon.innerText = "check";
                    btnIcon.classList.remove('hidden');

                    // Open drawer
                    setTimeout(() => {
                        if (drawer) {
                            drawer.classList.add('open');
                            document.body.style.overflow = 'hidden';
                        }

                        // Reset button
                        setTimeout(() => {
                            btnText.innerText = "Add to Cart";
                            btnIcon.innerText = "shopping_bag";
                            submitBtn.disabled = false;
                        }, 2000);
                    }, 500);
                })
                .catch(err => {
                    console.error('Add to cart fetch error:', err);
                    btnText.innerText = "Try Again";
                    spinner.classList.add('hidden');
                    btnIcon.innerText = "error";
                    btnIcon.classList.remove('hidden');
                    submitBtn.disabled = false;
                    setTimeout(() => {
                        btnText.innerText = "Add to Cart";
                        btnIcon.innerText = "shopping_bag";
                    }, 3000);
                });
        });
    }
}

/**
 * 6. Limited Timer
 */
function initTimer() {
    const timer = document.querySelector('.ivory-timer');
    if (!timer) return;

    const endDate = new Date(timer.getAttribute('data-end')).getTime();

    const x = setInterval(() => {
        const now = new Date().getTime();
        const distance = endDate - now;

        if (distance < 0) {
            clearInterval(x);
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        timer.querySelector('.minutes-value').innerText = days.toString().padStart(2, '0');
        timer.querySelector('.hours-value').innerText = hours.toString().padStart(2, '0');
        timer.querySelector('.seconds-value').innerText = minutes.toString().padStart(2, '0');
    }, 1000);
}

/**
 * 7. WhatsApp Logic
 */
function initWhatsApp() {
    const waBtn = document.getElementById('whatsapp-inquiry-btn');
    if (!waBtn) return;

    waBtn.addEventListener('click', () => {
        const num = waBtn.getAttribute('data-wa');
        let tpl = waBtn.getAttribute('data-tpl');

        // Grab current selections
        const selects = document.querySelectorAll('.custom-variation-select');
        let selections = [];
        let missing = false;

        selects.forEach(s => {
            if (!s.value) missing = true;
            else {
                const label = s.closest('.attribute-selector').querySelector('label').innerText.replace('Select ', '');
                selections.push(`${label}: ${s.value}`);
            }
        });

        if (missing) {
            alert('Please select your variations first.');
            return;
        }

        // Replace template tags
        // Note: {product_name} and {product_url} were already replaced in PHP if possible
        // but we handle attributes dynamically here
        tpl = tpl.replace('{color}', selections.find(s => s.toLowerCase().includes('color')) || 'Default');
        tpl = tpl.replace('{size}', selections.find(s => s.toLowerCase().includes('size')) || 'Standard');

        const url = `https://wa.me/${num}?text=${encodeURIComponent(tpl)}`;
        window.open(url, '_blank');
    });
}

/**
 * 8. Search Modal Logic
 */
function initSearch() {
    const trigger = document.getElementById('search-trigger');
    const modal = document.getElementById('search-modal');
    const content = document.getElementById('search-modal-content');
    const closeBtns = [document.getElementById('search-modal-close-btn'), document.getElementById('search-modal-close-overlay')];

    if (!trigger || !modal) return;

    trigger.addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.add('open');
        setTimeout(() => {
            if (content) content.classList.remove('opacity-0', 'translate-y-10');
            const input = modal.querySelector('input');
            if (input) input.focus();
        }, 100);
        document.body.style.overflow = 'hidden';
    });

    closeBtns.forEach(btn => {
        if (!btn) return;
        btn.addEventListener('click', () => {
            if (content) content.classList.add('opacity-0', 'translate-y-10');
            setTimeout(() => {
                modal.classList.remove('open');
                document.body.style.overflow = '';
            }, 300);
        });
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('open')) {
            if (closeBtns[0]) closeBtns[0].click();
        }
    });
}
