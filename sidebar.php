<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Platform
 */
?>

<?php if ( !in_array( get_theme_mod( 'theme-layout' ), array( 'single-column' ) ) ) : ?>

	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->

<?php endif; ?>