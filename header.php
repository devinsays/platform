<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Platform
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'platform' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'partials/navigation', 'primary' ); ?>

		<div class="site-branding">
			<div class="col-width">

				<?php if ( get_theme_mod( 'logo', 0 ) ) {
					$class = 'site-logo';
					$output = '<img src="' . esc_url( get_theme_mod( 'logo' ) ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				} else {
					$class = 'site-title';
					$output = get_bloginfo( 'name' );
				} ?>

				<h1 class="<?php echo esc_attr( $class ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php echo $output; ?>
					</a>
				</h1>

				<?php if ( get_bloginfo( 'description' ) != '' ) : ?>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>

			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content clearfix">
		<div class="col-width">