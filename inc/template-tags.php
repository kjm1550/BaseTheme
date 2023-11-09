<?php

/**
 * Custom template tags for this theme
 *
 *
 * @package baseTheme
 */

/**
 * Function to add the js and css for Glide
 */
if (!function_exists('add_glide')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function add_glide()
	{
		static $add_glide_called = false;
		if (!$add_glide_called) {
			$add_glide_called = true;
?>
			<link rel="stylesheet" type="text/css" href="/wp-content/themes/BaseTheme/js/glide/glide-style.min.css" />
			<script type="text/javascript" src="/wp-content/themes/BaseTheme/js/glide/glide.min.js"></script>
<?php
		}
	}
endif;
