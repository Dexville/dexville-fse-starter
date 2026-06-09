<?php
/**
 * Block Registration
 *
 * Register ACF blocks and native blocks.
 * ACF blocks use PHP render templates (no build step).
 * Native blocks compile from /blocks to /build via @wordpress/scripts.
 *
 * @package Dexville_FSE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF blocks from /blocks directory
 */
function dexville_fse_register_acf_blocks() {
	// Bail if ACF is not active
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	$blocks_dir = get_template_directory() . '/blocks';

	if ( ! is_dir( $blocks_dir ) ) {
		return;
	}

	// Scan for block.json files in /blocks subdirectories
	$block_dirs = glob( $blocks_dir . '/*/block.json' );

	foreach ( $block_dirs as $block_json_path ) {
		// Register the block using block.json
		register_block_type( dirname( $block_json_path ) );
	}
}
add_action( 'init', 'dexville_fse_register_acf_blocks' );

/**
 * Register compiled native blocks from /build directory
 * These are built with @wordpress/scripts (Phase 4+)
 */
function dexville_fse_register_native_blocks() {
	$build_dir = get_template_directory() . '/build';

	if ( ! is_dir( $build_dir ) ) {
		return;
	}

	// Scan for block.json files in /build subdirectories
	$block_dirs = glob( $build_dir . '/*/block.json' );

	foreach ( $block_dirs as $block_json_path ) {
		// Register the block using block.json
		register_block_type( dirname( $block_json_path ) );
	}
}
add_action( 'init', 'dexville_fse_register_native_blocks' );
