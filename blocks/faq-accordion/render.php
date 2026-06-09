<?php
/**
 * FAQ Accordion Block Template
 *
 * Server-rendered ACF block using <details> elements.
 * No JavaScript required. Emits FAQPage JSON-LD schema.
 *
 * @package Dexville_FSE
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during backend preview render.
 * @var int $post_id The post ID the block is rendering content against.
 */

// Get ACF fields
$faqs = get_field( 'faq_items' );
$heading = get_field( 'heading' ) ?: 'Frequently Asked Questions';

// Bail if no FAQs
if ( empty( $faqs ) ) {
	if ( $is_preview ) {
		echo '<div class="acf-block-placeholder">';
		echo '<p>Please add FAQ items using the block settings.</p>';
		echo '</div>';
	}
	return;
}

// Build schema.org FAQPage JSON-LD
$schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array(),
);

foreach ( $faqs as $faq ) {
	if ( ! empty( $faq['question'] ) && ! empty( $faq['answer'] ) ) {
		$schema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $faq['question'] ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => wp_strip_all_tags( $faq['answer'] ),
			),
		);
	}
}

// Block attributes
$class_name = 'dexville-faq-accordion';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = ' id="' . esc_attr( $block['anchor'] ) . '"';
}
?>

<div class="<?php echo esc_attr( $class_name ); ?>"<?php echo $anchor; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

	<?php if ( $heading ) : ?>
		<h2 class="dexville-faq-accordion__heading"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<div class="dexville-faq-accordion__items">
		<?php foreach ( $faqs as $faq ) : ?>
			<?php if ( ! empty( $faq['question'] ) && ! empty( $faq['answer'] ) ) : ?>
				<details class="dexville-faq-accordion__item">
					<summary class="dexville-faq-accordion__question">
						<?php echo esc_html( $faq['question'] ); ?>
					</summary>
					<div class="dexville-faq-accordion__answer">
						<?php echo wp_kses_post( wpautop( $faq['answer'] ) ); ?>
					</div>
				</details>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>

	<!-- FAQPage Schema Markup -->
	<script type="application/ld+json">
		<?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>

</div>
