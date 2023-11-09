<?php

/**
 * baseTheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package baseTheme
 */

if (!defined('baseTheme_VERSION')) {
	// Replace the version number of the theme on each release.
	define('baseTheme_VERSION', '1.0.0');
}

if (!function_exists('baseTheme_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function baseTheme_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on baseTheme, use a find and replace
		 * to change 'baseTheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('baseTheme', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'baseTheme'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'baseTheme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function baseTheme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('baseTheme_content_width', 640);
}
add_action('after_setup_theme', 'baseTheme_content_width', 0);

/**
 * Register widget area. Uncomment this to create a widget
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*
function baseTheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'baseTheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baseTheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'baseTheme_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function baseTheme_scripts()
{
	wp_enqueue_style('baseTheme-style', get_stylesheet_uri(), array(), baseTheme_VERSION);
	wp_style_add_data('baseTheme-style', 'rtl', 'replace');

	wp_enqueue_script('baseTheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), baseTheme_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'baseTheme_scripts');

/**
 * Removes some unused code.
 */
function remove_unused_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('readyclass');
}
add_action('wp_enqueue_scripts', 'remove_unused_css');
function remove_jquery_migrate($scripts)
{
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ($script->deps) { // Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array(
				'jquery-migrate'
			));
		}
	}
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// First we check to see if acf_add_options_page is a function.
// If it is not, then we probably do not have ACF Pro installed
// uncomment if Global Modules are wanted.
// if (function_exists('acf_add_options_page')) {

// 	acf_add_options_page(array(
// 		'page_title'    => 'Global Modules',
// 		'menu_title'    => 'Global Modules',
// 		'menu_slug'     => 'global-modules',
// 		'capability'    => 'edit_posts'
// 	));
// }

// console logs php 
function console_log($output, $with_script_tags = true)
{
	$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
		');';
	if ($with_script_tags) {
		$js_code = '<script>' . $js_code . '</script>';
	}
	echo $js_code;
};
