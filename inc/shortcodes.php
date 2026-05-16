<?php
/**
 * Elementor-friendly shortcodes for MO Store sections.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render a template part shortcode.
 *
 * @param string $template Template part slug.
 * @param array  $args     Template arguments.
 * @return string
 */
function mo_store_render_shortcode_template( $template, $args = array() ) {
	ob_start();
	mo_store_get_template_part( $template, $args );

	return ob_get_clean();
}

/**
 * Homepage navbar shortcode.
 *
 * @return string
 */
function mo_store_shortcode_navbar() {
	return mo_store_render_shortcode_template( 'global/navbar' );
}
add_shortcode( 'mo_store_navbar', 'mo_store_shortcode_navbar' );

/**
 * Homepage cinematic hero slideshow shortcode.
 *
 * @return string
 */
function mo_store_shortcode_hero() {
	return mo_store_render_shortcode_template( 'home/hero-slideshow' );
}
add_shortcode( 'mo_store_hero', 'mo_store_shortcode_hero' );

/**
 * MO Store Standard Bar shortcode.
 *
 * @return string
 */
function mo_store_shortcode_standard_bar() {
	return mo_store_render_shortcode_template( 'home/standard-bar' );
}
add_shortcode( 'mo_store_standard_bar', 'mo_store_shortcode_standard_bar' );

/**
 * Explore the Lines shortcode.
 *
 * @return string
 */
function mo_store_shortcode_explore_lines() {
	return mo_store_render_shortcode_template( 'home/explore-lines' );
}
add_shortcode( 'mo_store_explore_lines', 'mo_store_shortcode_explore_lines' );

/**
 * Shape the Next Batch shortcode.
 *
 * @return string
 */
function mo_store_shortcode_shape_next_batch() {
	return mo_store_render_shortcode_template( 'home/shape-next-batch' );
}
add_shortcode( 'mo_store_shape_next_batch', 'mo_store_shortcode_shape_next_batch' );

/**
 * Minimal MO Store footer shortcode.
 *
 * @return string
 */
function mo_store_shortcode_footer() {
	return mo_store_render_shortcode_template( 'global/footer' );
}
add_shortcode( 'mo_store_footer', 'mo_store_shortcode_footer' );

/**
 * Full homepage shortcode for Elementor blank pages.
 *
 * @return string
 */
function mo_store_shortcode_homepage() {
	ob_start();

	mo_store_get_template_part( 'global/navbar' );
	mo_store_get_template_part( 'home/hero-slideshow' );
	mo_store_get_template_part( 'home/standard-bar' );
	mo_store_get_template_part( 'home/explore-lines' );
	mo_store_get_template_part( 'home/shape-next-batch' );
	mo_store_get_template_part( 'global/footer' );

	return ob_get_clean();
}
add_shortcode( 'mo_store_homepage', 'mo_store_shortcode_homepage' );

/**
 * Full line page shortcode.
 *
 * Usage:
 * [mo_store_line_page line="takumo"]
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function mo_store_shortcode_line_page( $atts ) {
	$atts = shortcode_atts(
		array(
			'line' => mo_store_get_current_line_slug(),
		),
		$atts,
		'mo_store_line_page'
	);

	$line_slug = sanitize_key( $atts['line'] );

	if ( ! mo_store_is_valid_line_slug( $line_slug ) ) {
		return '';
	}

	return mo_store_render_shortcode_template(
		'lines/line-page',
		array(
			'line' => mo_store_get_line_data( $line_slug ),
		)
	);
}
add_shortcode( 'mo_store_line_page', 'mo_store_shortcode_line_page' );

/**
 * MO Gear hero shortcode.
 *
 * @return string
 */
function mo_store_shortcode_gear_hero() {
	return mo_store_render_shortcode_template( 'mo-gear/gear-hero' );
}
add_shortcode( 'mo_store_gear_hero', 'mo_store_shortcode_gear_hero' );

/**
 * MO Gear category strip shortcode.
 *
 * @return string
 */
function mo_store_shortcode_gear_categories() {
	return mo_store_render_shortcode_template( 'mo-gear/gear-category-strip' );
}
add_shortcode( 'mo_store_gear_categories', 'mo_store_shortcode_gear_categories' );