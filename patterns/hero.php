<?php
/**
 * Title: Hero Section
 * Slug: dexville-fse/hero
 * Description: Large hero section with heading, description, and call-to-action buttons
 * Categories: dexville, banner, featured
 * Keywords: hero, header, banner, cta
 */
?>
<!-- wp:cover {"overlayColor":"contrast","minHeight":500,"align":"full"} -->
<div class="wp-block-cover alignfull" style="min-height:500px"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container">

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|l"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
	<div class="wp-block-group">

		<!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xxx-large","textColor":"base"} -->
		<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color has-xxx-large-font-size">Welcome to Your New Site</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","fontSize":"large","textColor":"base"} -->
		<p class="has-text-align-center has-base-color has-text-color has-large-font-size">A modern, performance-first website built for your business. Fast, accessible, and beautiful.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"primary","textColor":"base"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-base-color has-primary-background-color has-text-color has-background wp-element-button">Get Started</a></div>
			<!-- /wp:button -->

			<!-- wp:button {"backgroundColor":"base","textColor":"contrast","className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button">Learn More</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

	</div>
	<!-- /wp:group -->

</div></div>
<!-- /wp:cover -->
