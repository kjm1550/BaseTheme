<?php

/**
 * baseTheme Theme Customizer
 *
 * @package baseTheme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function baseTheme_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'baseTheme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'baseTheme_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'baseTheme_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function baseTheme_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function baseTheme_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function baseTheme_customize_preview_js()
{
	wp_enqueue_script('baseTheme-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), baseTheme_VERSION, true);
}
add_action('customize_preview_init', 'baseTheme_customize_preview_js');

/**
 * Add classes to the submit buttons on gravity forms
 */
/*add_filter('gform_submit_button', 'add_custom_css_classes', 10, 2);
function add_custom_css_classes($button, $form)
{
	$dom = new DOMDocument();
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $button);
	$input = $dom->getElementsByTagName('input')->item(0);
	$classes = $input->getAttribute('class');
	$classes .= " buttin-classes";
	$input->setAttribute('class', $classes);
	return $dom->saveHtml($input);
} */
