<?php
/**
 * Enqueue scripts and styles.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function emerald_scripts() {
	// Google Fonts
	wp_enqueue_style( 'emerald-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Cinzel:wght@400;600&display=swap', array(), null );
	
	// Material Symbols
	wp_enqueue_style( 'emerald-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );

	// Theme Styles (Compiled Tailwind + Custom)
	wp_enqueue_style( 'emerald-style', EMERALD_URI . '/assets/css/app.css', array(), EMERALD_VERSION );
	wp_enqueue_style( 'emerald-custom', EMERALD_URI . '/assets/css/custom.css', array('emerald-style'), EMERALD_VERSION );

	// Main Javascript
	wp_enqueue_script( 'emerald-main', EMERALD_URI . '/assets/js/main.js', array(), EMERALD_VERSION, true );
	
	// Localize script for ajax and nonces
	wp_localize_script( 'emerald-main', 'emerald_ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'emerald-security-nonce' ),
		'wc_ajax_url' => WC_AJAX::get_endpoint( '%%endpoint%%' )
	) );
}
add_action( 'wp_enqueue_scripts', 'emerald_scripts' );

// Remove block library CSS for performance
function emerald_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
} 
add_action( 'wp_enqueue_scripts', 'emerald_remove_wp_block_library_css', 100 );
