<?php
/**
 * Admin Settings Panel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Menu Item
 */
function emerald_add_admin_menu() {
	add_theme_page(
		'Emerald Luxury Settings',
		'Theme Settings',
		'manage_options',
		'emerald-settings',
		'emerald_settings_page_html'
	);
}
add_action( 'admin_menu', 'emerald_add_admin_menu' );

/**
 * Register Settings
 */
add_action('admin_init', 'emerald_register_settings');
function emerald_register_settings() {
    register_setting('emerald_settings_group', 'emerald_whatsapp_number');
    register_setting('emerald_settings_group', 'emerald_whatsapp_template');
    register_setting('emerald_settings_group', 'emerald_show_trust_badges');
    register_setting('emerald_settings_group', 'emerald_show_low_stock');
    register_setting('emerald_settings_group', 'emerald_show_size_recommendation');
    
    add_settings_section('emerald_main_section', 'Concierge & Feature Controls', 'emerald_section_cb', 'emerald-settings');

    add_settings_field('emerald_whatsapp_number', 'WhatsApp Number', 'emerald_wa_number_cb', 'emerald-settings', 'emerald_main_section');
    add_settings_field('emerald_whatsapp_template', 'WhatsApp Message Template', 'emerald_wa_tpl_cb', 'emerald-settings', 'emerald_main_section');
    add_settings_field('emerald_show_trust_badges', 'Show Trust Badges', 'emerald_checkbox_cb', 'emerald-settings', 'emerald_main_section', ['id' => 'emerald_show_trust_badges']);
    add_settings_field('emerald_show_low_stock', 'Enable Low Stock Pulse', 'emerald_checkbox_cb', 'emerald-settings', 'emerald_main_section', ['id' => 'emerald_show_low_stock']);
    add_settings_field('emerald_show_size_recommendation', 'Enable Size Guide Modal', 'emerald_checkbox_cb', 'emerald-settings', 'emerald_main_section', ['id' => 'emerald_show_size_recommendation']);
}

/**
 * Callbacks
 */
function emerald_section_cb() {
    echo '<p class="description">Fine-tune your brand presence and interactive customer touchpoints below.</p>';
}

function emerald_wa_number_cb() {
    $val = get_option('emerald_whatsapp_number', '+971501234567');
    echo '<input type="text" name="emerald_whatsapp_number" value="' . esc_attr($val) . '" class="regular-text" placeholder="+971501234567" />';
}

function emerald_wa_tpl_cb() {
    $val = get_option('emerald_whatsapp_template', "Salaam, I'm interested in the {product_name}. Could you assist me with {size}? {product_url}");
    echo '<textarea name="emerald_whatsapp_template" class="large-text" rows="3">' . esc_textarea($val) . '</textarea>';
}

function emerald_checkbox_cb($args) {
    $val = get_option($args['id'], '1');
    echo '<input type="checkbox" name="' . esc_attr($args['id']) . '" value="1" ' . checked(1, $val, false) . ' />';
}

/**
 * Page HTML
 */
function emerald_settings_page_html() {
    if (!current_user_can('manage_options')) return;
    ?>
    <div class="wrap" style="background: #0B1812; color: #fff; padding: 30px; border-radius: 8px; margin-top: 20px;">
        <h1 style="color: #D4AF37; font-family: 'Cinzel', serif; margin-bottom: 30px;"><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post" style="max-width: 800px;">
            <?php
            settings_fields('emerald_settings_group');
            do_settings_sections('emerald-settings');
            submit_button('Preserve configuration');
            ?>
        </form>
    </div>
    <style>
        .wrap form { background: rgba(255,255,255,0.05); padding: 40px; border: 1px solid rgba(212,175,55,0.2); }
        .wrap h1 { font-size: 2.5em; border-bottom: 2px solid #D4AF37; display: inline-block; padding-bottom: 10px; }
        .wrap label { color: #D4AF37 !important; font-weight: bold; }
        .wrap .description { color: #888; }
        .button-primary { background: #D4AF37 !important; border-color: #B38728 !important; color: #000 !important; font-weight: bold !important; text-transform: uppercase !important; letter-spacing: 1px !important; }
    </style>
    <?php
}
