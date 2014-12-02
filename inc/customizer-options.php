<?php
/**
 * Theme Customizer
 *
 * @package Platform
 */

/**
 * Platform Options
 *
 * @since  0.2.0
 *
 * @return array $options
 */
function platform_options() {

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Logo
	$section = 'logo';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Logo', 'platform' ),
		'priority' => '20'
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'platform' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
	);

	$options['logo-favicon'] = array(
		'id' => 'logo-favicon',
		'label'   => __( 'Favicon', 'platform' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'description'  => __( 'File must be <strong>.png</strong> format. Optimal dimensions: <strong>32px x 32px</strong>.', 'platform' ),
	);

	$options['logo-apple-touch'] = array(
		'id' => 'logo-apple-touch',
		'label'   => __( 'Apple Touch Icon', 'platform' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'description'  => __( 'File must be <strong>.png</strong> format. Optimal dimensions: <strong>152px x 152px</strong>.', 'platform' ),
	);

	// Footer Settings
	$section = 'footer';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'platform' ),
		'priority' => '100'
	);

	$options['footer-text'] = array(
		'id' => 'footer-text',
		'label'   => __( 'Footer Text', 'platform' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => platform_get_default_footer_text(),
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

}
add_action( 'init', 'platform_options', 100 );

/**
 * Alters some of the defaults for the theme customizer
 *
 * @since  1.0.0.
 *
 * @param  object $wp_customize The global customizer object.
 * @return void
 */
function platform_customizer_defaults( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->title = 'Header';

}
add_action( 'customize_register', 'platform_customizer_defaults', 100 );