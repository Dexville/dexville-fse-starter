<?php
/**
 * Dexville FSE Starter Theme
 *
 * A lean, performance-first FSE block theme.
 *
 * @package Dexville_FSE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup
 */
function dexville_fse_setup() {
	// Add support for editor styles
	add_theme_support( 'editor-styles' );

	// Add support for responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Add support for post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add support for custom line height controls
	add_theme_support( 'custom-line-height' );

	// Add support for experimental link color control
	add_theme_support( 'experimental-link-color' );

	// Add support for custom units
	add_theme_support( 'custom-units' );

	// Add support for custom spacing
	add_theme_support( 'custom-spacing' );
}
add_action( 'after_setup_theme', 'dexville_fse_setup' );

/**
 * ACF local JSON sync path
 * Allows field groups to be version-controlled and auto-synced across environments
 */
function dexville_fse_acf_json_save_point( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'dexville_fse_acf_json_save_point' );

function dexville_fse_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'dexville_fse_acf_json_load_point' );

/**
 * Load theme modules
 */
require_once get_template_directory() . '/inc/cleanup.php';
require_once get_template_directory() . '/inc/patterns.php';
require_once get_template_directory() . '/inc/blocks.php';
require_once get_template_directory() . '/inc/options.php';
require_once get_template_directory() . '/inc/bindings.php';
