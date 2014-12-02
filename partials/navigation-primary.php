<?php
/**
 * Outputs primary navigation.
 *
 * @package Platform
 */
?>

<nav class="primary-navigation" role="navigation">
	<div class="navigation-col-width">
		<button class="menu-toggle"><?php _e( 'Menu', 'platform' ); ?></button>
		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'link_before' => '<span>',
			'link_after' => '</span>'
		) ); ?>
	</div>
</nav>
