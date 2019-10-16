<?php
/**
 * Daowa: Color Patterns
 *
 * @package WordPress
 * @subpackage daowa
 * @since 1.0
 */

/**
 * Generate the CSS for the current primary color.
 */
function daowa_custom_colors_css() {

	$primary_color = 0;
	if ( "default" !== get_theme_mod( "primary_color", "default" ) ) {
		$primary_color = absint( get_theme_mod( "primary_color_hue", 0 ) );
	}

	/**
	 * Filter Daowa default saturation level.
	 *
	 * @since Daowa 1.0
	 *
	 * @param int $saturation Color saturation level.
	 */
	$saturation = apply_filters( "daowa_custom_colors_saturation", 100 );
	$saturation = absint( $saturation ) . "%";

	/**
	 * Filter Daowa default selection saturation level.
	 *
	 * @since Daowa 1.0
	 *
	 * @param int $saturation_selection Selection color saturation level.
	 */
	$saturation_selection = absint( apply_filters( "daowa_custom_colors_saturation_selection", 50 ) );
	$saturation_selection = $saturation_selection . "%";

	/**
	 * Filter Daowa default lightness level.
	 *
	 * @since Daowa 1.0
	 *
	 * @param int $lightness Color lightness level.
	 */
	$lightness = apply_filters( "daowa_custom_colors_lightness", 33 );
	$lightness = absint( $lightness ) . "%";

	/**
	 * Filter Daowa default hover lightness level.
	 *
	 * @since Daowa 1.0
	 *
	 * @param int $lightness_hover Hover color lightness level.
	 */
	$lightness_hover = apply_filters( "daowa_custom_colors_lightness_hover", 60 );
	$lightness_hover = absint( $lightness_hover ) . "%";

	/**
	 * Filter Daowa default selection lightness level.
	 *
	 * @since Daowa 1.0
	 *
	 * @param int $lightness_selection Selection color lightness level.
	 */
	$lightness_selection = apply_filters( "daowa_custom_colors_lightness_selection", 90 );
	$lightness_selection = absint( $lightness_selection ) . "%";

	$theme_css = "
		/*
		 * Set background for:
		 * - featured image :before
		 * - featured image :before
		 * - post thumbmail :before
		 * - post thumbmail :before
		 * - Submenu
		 * - Sticky Post
		 * - buttons
		 * - WP Block Button
		 * - Blocks
		 */
		
		@import url('https://fonts.googleapis.com/css?family=Varela+Round&display=swap');

		@import url('" . get_theme_mod("font_family_source", "") . "');

		body {
			background-color: " . get_theme_mod("bg_color_scheme_1", "") . ";
		}
		h1, h2, h3, h4, h5, h6, p, ul, ol, pre, table, blockquote, input, button, select, textarea, .blog-posts .row p {
			color: " . get_theme_mod("text_color", "") . ";
			font-family: 'Varela Round', sans-serif;
			font-family: " . get_theme_mod("font_family", "") . "
		}
		h1{
			font-size: " . get_theme_mod("heading_1_font_size", "") . "px;
			font-weight: " . get_theme_mod("heading_1_font_weight", "") . ";
			letter-spacing: " . get_theme_mod("heading_1_letter_spacing", "") . "px;
			text-transform: " . get_theme_mod("heading_1_text_case", "") . ";
			line-height: " . get_theme_mod("heading_1_line_height", "") . "px;
			
		}
		p {
			font-size: " . get_theme_mod("paragraph_font_size", "") . "px;
		}
		.bg-menu-4 {
			background-color: " . get_theme_mod("homepage_header_bg_color", "") . ";
		}
		.blog-posts .row .bg-color-blog-posts {
			background: " . get_theme_mod("sidebar_background_color", "") . ";
		}
		.blog-posts article:nth-child(3n-1) .bg-color-blog-posts {
			background: " . get_theme_mod("variant_posts_background_color", "") . " !important;
		}
		input[type='submit'], button[type='submit'], .em_comment input#submit {
			border: 0px solid " . get_theme_mod("button_bg_color", "") . ";
			background: " . get_theme_mod("button_bg_color", "") . ";
		}

		.blog-posts article:nth-child(3n-1) .row p, .blog-posts article:nth-child(3n-1) .row h1 {
			color: " . get_theme_mod("veriant_posts_text_color", "") . ";
		}

		h1.daowa-site-title a {
			color: #333347;
		  }
		h1.daowa-site-title {
			font-size: 42px;
			line-height: 48px;
		}
		p.daowa-site-description {
			color: #5f5f5f;
		}

		a, a:visited, .widget a {
			color: " . get_theme_mod("link_color", "") . ";
		}
		a:hover, a:active, .widget a:hover, .post-navigation .nav-links a:hover, .entry .entry-meta a:hover, .entry .entry-footer a:hover {
			color: " . get_theme_mod("hover_link_color", "") . ";
		}
		
		
		";

	$editor_css = "
		/*
		 * Set colors for:
		 * - links
		 * - blockquote
		 * - pullquote (solid color)
		 * - buttons
		 */
		.editor-block-list__layout .editor-block-list__block a,
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:hover .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:focus .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:active .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink {
			color: hsl( " . $primary_color . ", " . $saturation . ", " . $lightness . " ); /* base: #0073a8; */
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .editor-block-list__layout .wp-block-freeform blockquote {
			border-color: hsl( " . $primary_color . ", " . $saturation . ", " . $lightness . " ); /* base: #0073a8; */
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color) {
			background-color: hsl( " . $primary_color . ", " . $saturation . ", " . $lightness . " ); /* base: #0073a8; */
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__button,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover {
			background-color: hsl( " . $primary_color . ", " . $saturation . ", " . $lightness . " ); /* base: #0073a8; */
		}

		/* Hover colors */
		.editor-block-list__layout .editor-block-list__block a:hover,
		.editor-block-list__layout .editor-block-list__block a:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
			color: hsl( " . $primary_color . ", " . $saturation . ", " . $lightness_hover . " ); /* base: #005177; */
		}

		/* Do not overwrite solid color pullquote or cover links */
		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color a,
		.editor-block-list__layout .editor-block-list__block .wp-block-cover a {
			color: inherit;
		}
		";

	if ( function_exists( "register_block_type" ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	/**
	 * Filters Daowa custom colors CSS.
	 *
	 * @since Daowa 1.0
	 *
	 * @param string $css           Base theme colors CSS.
	 * @param int    $primary_color The user"s selected color hue.
	 * @param string $saturation    Filtered theme color saturation level.
	 */
	return apply_filters( "daowa_custom_colors_css", $theme_css, $primary_color, $saturation );
}
