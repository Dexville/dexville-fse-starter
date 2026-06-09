<?php
/**
 * Block Bindings
 *
 * Custom block binding sources for connecting blocks to dynamic content.
 * Allows core blocks (paragraph, heading, image) to display ACF option values.
 *
 * @package Dexville_FSE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register custom block binding sources
 */
function dexville_fse_register_block_bindings() {
	// Contact information bindings
	register_block_bindings_source(
		'dexville/contact-phone',
		array(
			'label'              => __( 'Contact Phone', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_phone();
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/contact-email',
		array(
			'label'              => __( 'Contact Email', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_email();
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/contact-address',
		array(
			'label'              => __( 'Contact Address', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_address();
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/contact-hours',
		array(
			'label'              => __( 'Opening Hours', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'contact_hours' );
			},
			'uses_context'       => array(),
		)
	);

	// Business information bindings
	register_block_bindings_source(
		'dexville/business-name',
		array(
			'label'              => __( 'Business Name', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'business_name', get_bloginfo( 'name' ) );
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/business-description',
		array(
			'label'              => __( 'Business Description', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'business_description', get_bloginfo( 'description' ) );
			},
			'uses_context'       => array(),
		)
	);

	// Social media link bindings
	register_block_bindings_source(
		'dexville/social-facebook',
		array(
			'label'              => __( 'Facebook URL', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'social_facebook' );
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/social-instagram',
		array(
			'label'              => __( 'Instagram URL', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'social_instagram' );
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/social-linkedin',
		array(
			'label'              => __( 'LinkedIn URL', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'social_linkedin' );
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/social-twitter',
		array(
			'label'              => __( 'Twitter URL', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'social_twitter' );
			},
			'uses_context'       => array(),
		)
	);

	register_block_bindings_source(
		'dexville/social-youtube',
		array(
			'label'              => __( 'YouTube URL', 'dexville-fse' ),
			'get_value_callback' => function() {
				return dexville_get_option( 'social_youtube' );
			},
			'uses_context'       => array(),
		)
	);
}
add_action( 'init', 'dexville_fse_register_block_bindings' );
