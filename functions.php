<?php
/**
 * Platform functions and definitions
 *
 * @package Platform
 */

/**
 * The current version of the theme.
 */
define( 'PLATFORM_VERSION', '0.2.0' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'platform_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function platform_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Platform, use a find and replace
	 * to change 'platform' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'platform', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Registers menu below the site title
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'platform' ),
	) );

	// Registers menu for use in the footer
	register_nav_menus( array(
		'footer' => __( 'Footer Menu', 'platform' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'platform_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Theme layouts
	add_theme_support(
		'theme-layouts',
		array(
			'single-column' => __( 'Single Column', 'platform' ),
			'sidebar-right' => __( 'Sidebar Right', 'platform' ),
			'sidebar-left' => __( 'Sidebar Left', 'platform' )
		),
		array( 'default' => 'sidebar-right' )
	);

}
endif; // platform_setup
add_action( 'after_setup_theme', 'platform_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function platform_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'platform' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'platform_widgets_init' );

/**
 * Enqueue fonts.
 */
function platform_fonts() {

	// Icon Font
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css', array(), '4.2.0' );

}
add_action( 'wp_enqueue_scripts', 'platform_fonts' );

/**
 * Enqueue scripts and styles.
 */
function platform_scripts() {

	wp_enqueue_style(
		'platform-style',
		get_stylesheet_uri(),
		array(),
		PLATFORM_VERSION
	);

	// Use style-rtl.css for RTL layouts
	wp_style_add_data(
		'platform-style',
		'rtl',
		'replace'
	);

	if ( SCRIPT_DEBUG || WP_DEBUG ) :

		wp_enqueue_script(
			'platform-skip-link-focus-fix',
			get_template_directory_uri() . '/js/skip-link-focus-fix.js',
			array(),
			PLATFORM_VERSION,
			true
		);

		wp_enqueue_script(
			'platform-fast-click',
			get_template_directory_uri() . '/js/jquery.fastclick.js',
			array(),
			PLATFORM_VERSION,
			true
		);

		wp_enqueue_script(
			'platform-fitvids',
			get_template_directory_uri() . '/js/jquery.fitvids.js',
			array( 'jquery' ),
			PLATFORM_VERSION,
			true
		);

		wp_enqueue_script(
			'platform-theme',
			get_template_directory_uri() . '/js/theme.js',
			array( 'jquery', 'platform-fitvids' ),
			PLATFORM_VERSION,
			true
		);

	else :

		wp_enqueue_script(
			'platform-scripts',
			get_template_directory_uri() . '/js/platform.min.js',
			array(),
			PLATFORM_VERSION,
			true
		);

	endif;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'platform_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-library/customizer-library.php';
require get_template_directory() . '/inc/customizer-options.php';
require get_template_directory() . '/inc/styles.php';

/**
 * Enables post/page/global layouts.
 */
require get_template_directory() . '/inc/theme-layouts.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';