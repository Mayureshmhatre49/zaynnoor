<?php
/**
 * Performance Tweaks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Remove query strings from static resources
function emerald_remove_cssjs_ver( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'emerald_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'emerald_remove_cssjs_ver', 10, 2 );

// Disable emojis replacing script
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// Remove RSD link
remove_action( 'wp_head', 'rsd_link' );
// Remove wlwmanifest link
remove_action( 'wp_head', 'wlwmanifest_link' );
// Remove WP version
remove_action( 'wp_head', 'wp_generator' );

// Defer parsing of JS
function emerald_defer_js( $tag, $handle ) {
	// Add your handles here to defer them
	$deferred_scripts = array( 'emerald-main' );
	
	if ( in_array( $handle, $deferred_scripts ) ) {
		return str_replace( ' src', ' defer="defer" src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'emerald_defer_js', 10, 2 );
