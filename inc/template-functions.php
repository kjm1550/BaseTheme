<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package baseTheme
 */

/**
 * Theme options tab in appearance. 
 * 
 * Remove if not needed. Or rename 'Theme Options'
 */
if (function_exists('acf_add_options_sub_page') && current_user_can('theme_options_view')) {
    acf_add_options_sub_page(array(
        'title' => 'Theme Options',
        'parent' => 'themes.php',
    ));
}
