<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Platform
 */

if ( ! function_exists( 'platform_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function platform_styles() {

	// Style Rules
}
endif;

add_action( 'customizer_library_styles', 'platform_styles' );

if ( ! function_exists( 'platform_display_customizations' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  0.2.0
 *
 * @return void
 */
function platform_display_customizations() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Platform CSS -->\n<style type=\"text/css\" id=\"platform-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Platform CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'platform_display_customizations', 11 );