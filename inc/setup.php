<?php
/**
 * Theme setup helpers for MO Knives Store Child.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set global content width for responsive media.
 */
function mo_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mo_store_content_width', 1440 );
}
add_action( 'after_setup_theme', 'mo_store_content_width', 0 );

/**
 * Register image sizes used by the cinematic MO Store layouts.
 */
function mo_store_register_image_sizes() {
	add_image_size( 'mo_store_hero_desktop', 2200, 1400, true );
	add_image_size( 'mo_store_hero_mobile', 900, 1400, true );
	add_image_size( 'mo_store_line_card', 1100, 1400, true );
	add_image_size( 'mo_store_filmstrip', 1200, 900, true );
	add_image_size( 'mo_store_gear_hero', 2200, 1000, true );
}
add_action( 'after_setup_theme', 'mo_store_register_image_sizes' );

/**
 * Register clean URL endpoints /lines/{line-slug} for the approved line pages.
 */
function mo_store_register_line_rewrite_rules() {
	add_rewrite_rule(
		'^lines/(takumo|matador|pitmaster)/?$',
		'index.php?pagename=lines/$matches[1]&mo_store_line=$matches[1]',
		'top'
	);
}
add_action( 'init', 'mo_store_register_line_rewrite_rules' );

/**
 * Add custom query vars for line pages.
 *
 * @param array $vars Public query vars.
 * @return array
 */
function mo_store_register_query_vars( $vars ) {
	$vars[] = 'mo_store_line';

	return $vars;
}
add_filter( 'query_vars', 'mo_store_register_query_vars' );

/**
 * Flush rewrite rules when the child theme is activated.
 */
function mo_store_child_theme_activation() {
	mo_store_register_line_rewrite_rules();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'mo_store_child_theme_activation' );

/**
 * Keep WordPress excerpt output clean for MO Store layouts.
 *
 * @param string $more Existing excerpt more string.
 * @return string
 */
function mo_store_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'mo_store_excerpt_more' );

/**
 * Set a refined excerpt length for WooCommerce cards where WoodMart allows it.
 *
 * @param int $length Existing excerpt length.
 * @return int
 */
function mo_store_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 18;
}
add_filter( 'excerpt_length', 'mo_store_excerpt_length', 20 );

/**
 * Add preload hints for MO Store fonts.
 *
 * @param array  $urls          URLs to print resource hints for.
 * @param string $relation_type Resource hint relation type.
 * @return array
 */
function mo_store_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => '',
		);

		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'mo_store_resource_hints', 10, 2 );

/**
 * Disable block library styles on front-end pages where Elementor/WoodMart handle layout.
 */
function mo_store_dequeue_unneeded_block_styles() {
	if ( is_admin() ) {
		return;
	}

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'mo_store_dequeue_unneeded_block_styles', 100 );

/**
 * Add defer attribute to the MO Store JavaScript file.
 *
 * @param string $tag    Script tag.
 * @param string $handle Script handle.
 * @param string $src    Script source.
 * @return string
 */
function mo_store_defer_scripts( $tag, $handle, $src ) {
	if ( 'mo-store' !== $handle ) {
		return $tag;
	}

	return '<script src="' . esc_url( $src ) . '" id="' . esc_attr( $handle ) . '-js" defer></script>' . "\n";
}
add_filter( 'script_loader_tag', 'mo_store_defer_scripts', 10, 3 );

/**
 * Remove WordPress generator meta for a cleaner public head.
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Add theme color meta for supported mobile browsers.
 */
function mo_store_theme_color_meta() {
	echo '<meta name="theme-color" content="#050505">' . "\n";
}
add_action( 'wp_head', 'mo_store_theme_color_meta', 5 );

/**
 * Ensure attachment images default to lazy loading unless marked otherwise.
 *
 * @param array        $attr       Image attributes.
 * @param WP_Post     $attachment Attachment post object.
 * @param string|int[] $size       Requested image size.
 * @return array
 */
function mo_store_lazy_image_attributes( $attr, $attachment, $size ) {
	if ( is_admin() ) {
		return $attr;
	}

	if ( empty( $attr['loading'] ) ) {
		$attr['loading'] = 'lazy';
	}

	if ( empty( $attr['decoding'] ) ) {
		$attr['decoding'] = 'async';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mo_store_lazy_image_attributes', 10, 3 );