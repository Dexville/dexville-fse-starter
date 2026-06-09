<?php
/**
 * Performance Cleanup
 *
 * Aggressive front-end optimizations to achieve top Core Web Vitals.
 * This is the performance lever of the theme.
 *
 * @package Dexville_FSE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enable per-block stylesheet loading
 * Only load CSS for blocks actually present on the page
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

/**
 * Remove emoji detection scripts and styles
 */
function dexville_fse_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'dexville_fse_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'dexville_fse_disable_emojis_dns_prefetch', 10, 2 );
}
add_action( 'init', 'dexville_fse_disable_emojis' );

function dexville_fse_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	}
	return array();
}

function dexville_fse_disable_emojis_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/**
 * Dequeue unused block library styles
 */
function dexville_fse_dequeue_block_styles() {
	// Only dequeue on front-end
	if ( is_admin() ) {
		return;
	}

	// Classic theme styles - not needed for FSE
	wp_dequeue_style( 'classic-theme-styles' );

	// wp-block-library-theme contains opinionated button/quote styles
	// Only dequeue if you're defining all element styles in theme.json
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'dexville_fse_dequeue_block_styles', 20 );

/**
 * Remove unnecessary <head> clutter
 */
function dexville_fse_clean_head() {
	// Remove RSD link (Really Simple Discovery for external publishing tools)
	remove_action( 'wp_head', 'rsd_link' );

	// Remove Windows Live Writer manifest
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove WordPress version meta tag
	remove_action( 'wp_head', 'wp_generator' );

	// Remove shortlink
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Remove REST API link tag (keep REST API functional, just remove the tag)
	remove_action( 'wp_head', 'rest_output_link_wp_head' );

	// Remove oEmbed discovery links (keep oEmbed functional if needed, just remove discovery)
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove REST API link in HTTP headers
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );

	// Remove adjacent posts rel links
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
}
add_action( 'init', 'dexville_fse_clean_head' );

/**
 * Disable wp-embed.js if you don't embed WordPress posts on your site
 * Comment this out if you need WordPress embeds
 */
function dexville_fse_dequeue_embed_script() {
	if ( is_admin() ) {
		return;
	}
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'dexville_fse_dequeue_embed_script' );

/**
 * Dequeue jQuery on the front-end unless needed
 * WordPress loads it by default in footer, but blocks should not depend on it
 */
function dexville_fse_dequeue_jquery() {
	// Don't dequeue on admin or customizer
	if ( is_admin() || is_customize_preview() ) {
		return;
	}

	// Dequeue core jQuery - re-enqueue it in blocks/patterns if actually needed
	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'dexville_fse_dequeue_jquery', 20 );

/**
 * Remove global SVG filters (duotone, etc.)
 * These add several KB of inline SVG to <body> even if unused
 */
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Disable block directory (the "Add New Block" feature in block inserter)
 * Prevents external API calls during editing
 */
remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );

/**
 * Remove DNS prefetch for external resources
 * Add back any domains you actually use (e.g., fonts, CDN, analytics)
 */
function dexville_fse_remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'dexville_fse_remove_dns_prefetch', 10, 2 );

/**
 * Defer non-critical scripts
 * Add 'defer' attribute to enqueued scripts that don't need to block rendering
 */
function dexville_fse_defer_scripts( $tag, $handle, $src ) {
	// List of script handles that should be deferred
	$defer_scripts = array(
		// Add handles here as needed, e.g., 'custom-script-handle'
	);

	if ( in_array( $handle, $defer_scripts, true ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'dexville_fse_defer_scripts', 10, 3 );

/**
 * Remove query strings from static resources
 * Some caching systems handle versionless URLs better
 * Note: This removes cache-busting, so use with caution or implement alternative versioning
 */
function dexville_fse_remove_query_strings( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
// Uncomment to enable:
// add_filter( 'style_loader_src', 'dexville_fse_remove_query_strings', 10, 1 );
// add_filter( 'script_loader_src', 'dexville_fse_remove_query_strings', 10, 1 );

/**
 * Limit post revisions
 * Keeps database lean
 */
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
	define( 'WP_POST_REVISIONS', 3 );
}

/**
 * Disable comments feed if not using comments
 * Uncomment to disable
 */
// add_filter( 'feed_links_show_comments_feed', '__return_false' );

/**
 * Additional performance notes for later phases:
 *
 * - Images: WordPress handles lazy-loading natively (loading="lazy" on <img>)
 * - Fonts: Self-hosted via theme.json fontFamilies - no external requests
 * - Caching: Handle at server/CDN level (Kinsta, Cloudflare)
 * - JS: ACF blocks use PHP render templates - zero front-end JS unless explicitly added
 * - Critical CSS: Consider inline critical path CSS in <head> for above-fold content
 * - Preload: Use <link rel="preload"> for hero images / critical fonts (add in header.html)
 */
