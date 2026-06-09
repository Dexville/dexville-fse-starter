<?php
/**
 * Block Patterns
 *
 * Register custom block pattern categories and patterns.
 *
 * @package Dexville_FSE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom pattern categories
 * Note: We use WordPress built-in categories where possible to avoid duplicates
 */
function dexville_fse_register_pattern_categories() {
	// Only register our main theme category
	// Use WordPress built-in categories: featured, banner, buttons, call-to-action, columns, contact, etc.
	register_block_pattern_category(
		'dexville',
		array(
			'label'       => __( 'Dexville Patterns', 'dexville-fse' ),
			'description' => __( 'Curated patterns for Dexville FSE Starter theme', 'dexville-fse' ),
		)
	);
}
add_action( 'init', 'dexville_fse_register_pattern_categories' );

/**
 * Register patterns from /patterns directory
 */
function dexville_fse_register_patterns() {
	$patterns_dir = get_template_directory() . '/patterns';

	if ( ! is_dir( $patterns_dir ) ) {
		return;
	}

	$pattern_files = glob( $patterns_dir . '/*.php' );

	foreach ( $pattern_files as $pattern_file ) {
		$pattern_slug = basename( $pattern_file, '.php' );

		// Get pattern data from file
		$pattern_data = get_file_data(
			$pattern_file,
			array(
				'title'       => 'Title',
				'slug'        => 'Slug',
				'description' => 'Description',
				'categories'  => 'Categories',
				'keywords'    => 'Keywords',
			)
		);

		// Skip if no title
		if ( empty( $pattern_data['title'] ) ) {
			continue;
		}

		// Start output buffering to capture the pattern content
		ob_start();
		include $pattern_file;
		$pattern_content = ob_get_clean();

		// Parse categories
		$categories = ! empty( $pattern_data['categories'] )
			? array_map( 'trim', explode( ',', $pattern_data['categories'] ) )
			: array( 'dexville' );

		// Parse keywords
		$keywords = ! empty( $pattern_data['keywords'] )
			? array_map( 'trim', explode( ',', $pattern_data['keywords'] ) )
			: array();

		// Register the pattern
		register_block_pattern(
			'dexville-fse/' . $pattern_slug,
			array(
				'title'       => $pattern_data['title'],
				'description' => $pattern_data['description'],
				'content'     => $pattern_content,
				'categories'  => $categories,
				'keywords'    => $keywords,
			)
		);
	}
}
add_action( 'init', 'dexville_fse_register_patterns' );
