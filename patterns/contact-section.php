<?php
/**
 * Title: Contact Section
 * Slug: dexville-fse/contact-section
 * Description: Contact information section (will support ACF bindings in Phase 5)
 * Categories: dexville, contact, featured
 * Keywords: contact, address, phone, email
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xxl","bottom":"var:preset|spacing|xxl"}}},"backgroundColor":"neutral-100","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-neutral-100-background-color has-background" style="padding-top:var(--wp--preset--spacing--xxl);padding-bottom:var(--wp--preset--spacing--xxl)">

	<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
	<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--xl)">Get In Touch</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|xl","left":"var:preset|spacing|xl"}}}} -->
	<div class="wp-block-columns">

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|s"}}} -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size">📍</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Address</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>123 Main Street<br>Suite 100<br>City, State 12345</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|s"}}} -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size">📞</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Phone</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><a href="tel:+1234567890">(123) 456-7890</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|s"}}} -->
		<div class="wp-block-column">
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size">✉️</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Email</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><a href="mailto:hello@example.com">hello@example.com</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
