<?php
/**
 * Logo Strip Block Template
 *
 * Server-rendered ACF block with CSS-only marquee option.
 * No JavaScript required.
 *
 * @package Dexville_FSE
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during backend preview render.
 * @var int $post_id The post ID the block is rendering content against.
 */

// Get ACF fields
$logos = get_field( 'logos' );
$heading = get_field( 'heading' );
$enable_marquee = get_field( 'enable_marquee' );
$background_color = get_field( 'background_color' ) ?: 'neutral-100';

// Bail if no logos
if ( empty( $logos ) ) {
	if ( $is_preview ) {
		echo '<div class="acf-block-placeholder">';
		echo '<p>Please add logos using the block settings.</p>';
		echo '</div>';
	}
	return;
}

// Block attributes
$class_name = 'dexville-logo-strip';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}
if ( $enable_marquee ) {
	$class_name .= ' dexville-logo-strip--marquee';
}
$class_name .= ' has-' . esc_attr( $background_color ) . '-background-color has-background';

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = ' id="' . esc_attr( $block['anchor'] ) . '"';
}
?>

<div class="<?php echo esc_attr( $class_name ); ?>"<?php echo $anchor; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

	<div class="dexville-logo-strip__inner">

		<?php if ( $heading ) : ?>
			<h2 class="dexville-logo-strip__heading"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<div class="dexville-logo-strip__track">
			<div class="dexville-logo-strip__logos">
				<?php foreach ( $logos as $logo ) : ?>
					<?php if ( ! empty( $logo['image'] ) ) : ?>
						<div class="dexville-logo-strip__logo">
							<?php if ( ! empty( $logo['link'] ) ) : ?>
								<a href="<?php echo esc_url( $logo['link'] ); ?>" target="_blank" rel="noopener noreferrer">
									<?php echo wp_get_attachment_image( $logo['image'], 'medium', false, array( 'loading' => 'lazy' ) ); ?>
								</a>
							<?php else : ?>
								<?php echo wp_get_attachment_image( $logo['image'], 'medium', false, array( 'loading' => 'lazy' ) ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php if ( $enable_marquee ) : ?>
					<!-- Duplicate logos for seamless marquee -->
					<?php foreach ( $logos as $logo ) : ?>
						<?php if ( ! empty( $logo['image'] ) ) : ?>
							<div class="dexville-logo-strip__logo" aria-hidden="true">
								<?php if ( ! empty( $logo['link'] ) ) : ?>
									<a href="<?php echo esc_url( $logo['link'] ); ?>" target="_blank" rel="noopener noreferrer" tabindex="-1">
										<?php echo wp_get_attachment_image( $logo['image'], 'medium', false, array( 'loading' => 'lazy' ) ); ?>
									</a>
								<?php else : ?>
									<?php echo wp_get_attachment_image( $logo['image'], 'medium', false, array( 'loading' => 'lazy' ) ); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

	</div>

</div>
