<?php
/**
 * Title: Content with Image
 * Slug: dexville-fse/content-image
 * Description: Two-column layout with content and image, easily reversible
 * Categories: dexville, columns, featured
 * Keywords: content, image, columns, media
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)">

	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">

		<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
			<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
			<figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&amp;h=600&amp;fit=crop" alt=""/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"blockGap":"var:preset|spacing|m"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Build Something Amazing</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Create beautiful, high-performance websites with our modern FSE theme. Designed for speed, accessibility, and ease of use.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Every element is carefully crafted to deliver the best possible experience for your visitors while keeping your workflow simple and efficient.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Learn More</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->

		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
