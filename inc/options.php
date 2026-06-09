<?php
/**
 * Theme Options / Settings
 *
 * ACF Options Page for site-wide settings.
 * Settings are accessible via helper functions and block bindings.
 *
 * @package Dexville_FSE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register ACF Options Page
 */
function dexville_fse_register_options_page() {
	// Bail if ACF is not active
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Site Settings', 'dexville-fse' ),
			'menu_title' => __( 'Site Settings', 'dexville-fse' ),
			'menu_slug'  => 'site-settings',
			'capability' => 'edit_theme_options',
			'icon_url'   => 'dashicons-admin-generic',
			'position'   => 61,
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'dexville_fse_register_options_page' );

/**
 * Helper function to get option values
 *
 * @param string $field_name ACF field name.
 * @param mixed  $default Default value if field is empty.
 * @return mixed Field value or default.
 */
function dexville_get_option( $field_name, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $field_name, 'option' );
	return ! empty( $value ) ? $value : $default;
}

/**
 * Helper: Get contact phone
 *
 * @return string
 */
function dexville_get_phone() {
	return dexville_get_option( 'contact_phone' );
}

/**
 * Helper: Get contact email
 *
 * @return string
 */
function dexville_get_email() {
	return dexville_get_option( 'contact_email' );
}

/**
 * Helper: Get contact address
 *
 * @return string
 */
function dexville_get_address() {
	return dexville_get_option( 'contact_address' );
}

/**
 * Helper: Get social media links
 *
 * @return array
 */
function dexville_get_social_links() {
	return array(
		'facebook'  => dexville_get_option( 'social_facebook' ),
		'instagram' => dexville_get_option( 'social_instagram' ),
		'linkedin'  => dexville_get_option( 'social_linkedin' ),
		'twitter'   => dexville_get_option( 'social_twitter' ),
		'youtube'   => dexville_get_option( 'social_youtube' ),
	);
}

/**
 * Helper: Get Google Analytics / GTM ID
 *
 * @return string
 */
function dexville_get_analytics_id() {
	return dexville_get_option( 'tracking_analytics_id' );
}

/**
 * Output Google Analytics / GTM code in <head>
 */
function dexville_fse_output_analytics() {
	$analytics_id = dexville_get_analytics_id();

	if ( empty( $analytics_id ) ) {
		return;
	}

	// Google Analytics 4
	if ( strpos( $analytics_id, 'G-' ) === 0 ) {
		?>
		<!-- Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $analytics_id ); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '<?php echo esc_js( $analytics_id ); ?>');
		</script>
		<?php
	}

	// Google Tag Manager
	if ( strpos( $analytics_id, 'GTM-' ) === 0 ) {
		?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','<?php echo esc_js( $analytics_id ); ?>');</script>
		<?php
	}
}
add_action( 'wp_head', 'dexville_fse_output_analytics', 1 );

/**
 * Output GTM noscript code after <body>
 */
function dexville_fse_output_gtm_noscript() {
	$analytics_id = dexville_get_analytics_id();

	if ( empty( $analytics_id ) || strpos( $analytics_id, 'GTM-' ) !== 0 ) {
		return;
	}
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $analytics_id ); ?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php
}
add_action( 'wp_body_open', 'dexville_fse_output_gtm_noscript' );
