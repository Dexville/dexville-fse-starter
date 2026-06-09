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
 */
function dexville_fse_register_pattern_categories() {
	register_block_pattern_category(
		'dexville-fse',
		array(
			'label'       => __( 'Dexville FSE', 'dexville-fse' ),
			'description' => __( 'Curated patterns for Dexville FSE Starter theme', 'dexville-fse' ),
		)
	);

	register_block_pattern_category(
		'dexville-fse-hero',
		array(
			'label'       => __( 'Hero Sections', 'dexville-fse' ),
			'description' => __( 'Large page headers and hero sections', 'dexville-fse' ),
		)
	);

	register_block_pattern_category(
		'dexville-fse-content',
		array(
			'label'       => __( 'Content Sections', 'dexville-fse' ),
			'description' => __( 'Content layouts with text and images', 'dexville-fse' ),
		)
	);

	register_block_pattern_category(
		'dexville-fse-cta',
		array(
			'label'       => __( 'Call to Action', 'dexville-fse' ),
			'description' => __( 'CTA sections and conversion-focused patterns', 'dexville-fse' ),
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
			: array( 'dexville-fse' );

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
