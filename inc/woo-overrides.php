<?php
/**
 * WooCommerce refinements for MO Gear.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) && ! function_exists( 'WC' ) ) {
	return;
}

/**
 * Remove generic WooCommerce wrappers where child templates provide cinematic structure.
 */
function mo_store_woocommerce_setup() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'after_setup_theme', 'mo_store_woocommerce_setup', 30 );

/**
 * Set product grid columns for MO Gear.
 *
 * @param int $columns Existing column count.
 * @return int
 */
function mo_store_loop_columns( $columns ) {
	return 3;
}
add_filter( 'loop_shop_columns', 'mo_store_loop_columns', 20 );

/**
 * Set products per page for a curated premium grid.
 *
 * @param int $count Existing product count.
 * @return int
 */
function mo_store_products_per_page( $count ) {
	return 12;
}
add_filter( 'loop_shop_per_page', 'mo_store_products_per_page', 20 );

/**
 * Remove generic WooCommerce notices from the top of shop archives.
 * Notices still render inside cart/checkout where WooCommerce needs them.
 */
function mo_store_remove_shop_notices() {
	$is_shop_context = function_exists( 'is_shop' ) && is_shop();
	$is_tax_context  = function_exists( 'is_product_taxonomy' ) && is_product_taxonomy();

	if ( $is_shop_context || $is_tax_context ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
	}
}
add_action( 'wp', 'mo_store_remove_shop_notices' );

/**
 * Remove default result count and sorting for a cleaner MO Gear landing grid.
 */
function mo_store_refine_shop_loop_header() {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}
add_action( 'init', 'mo_store_refine_shop_loop_header' );

/**
 * Add MO Gear body class to WooCommerce pages.
 *
 * @param array $classes Existing classes.
 * @return array
 */
function mo_store_woocommerce_body_class( $classes ) {
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$classes[] = 'mo-store-woocommerce';
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$classes[] = 'mo-store-mo-gear-shop';
	}

	return $classes;
}
add_filter( 'body_class', 'mo_store_woocommerce_body_class' );

/**
 * Replace the default sale flash with a refined text badge only when WooCommerce marks a product on sale.
 *
 * @param string     $html    Existing sale flash HTML.
 * @param WP_Post    $post    Product post object.
 * @param WC_Product $product WooCommerce product object.
 * @return string
 */
function mo_store_sale_flash( $html, $post, $product ) {
	if ( ! $product || ! $product->is_on_sale() ) {
		return '';
	}

	return '<span class="mo-gear-sale-badge">' . esc_html__( 'Special Release', 'moknives-store-child' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'mo_store_sale_flash', 20, 3 );

/**
 * Customize add-to-cart button text for MO Gear while preserving WooCommerce purchasing flow.
 *
 * @param string     $text    Existing button text.
 * @param WC_Product $product Product object.
 * @return string
 */
function mo_store_add_to_cart_text( $text, $product ) {
	if ( ! $product instanceof WC_Product ) {
		return $text;
	}

	if ( $product->is_type( 'variable' ) ) {
		return esc_html__( 'Choose Options', 'moknives-store-child' );
	}

	return esc_html__( 'Add to Cart', 'moknives-store-child' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'mo_store_add_to_cart_text', 20, 2 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'mo_store_add_to_cart_text', 20, 2 );

/**
 * Add dark rugged luxury wrapper classes around product grids.
 */
function mo_store_before_shop_loop_wrapper() {
	echo '<div class="mo-gear-grid-shell">';
}
add_action( 'woocommerce_before_shop_loop', 'mo_store_before_shop_loop_wrapper', 5 );

/**
 * Close dark rugged luxury product grid wrapper.
 */
function mo_store_after_shop_loop_wrapper() {
	echo '</div>';
}
add_action( 'woocommerce_after_shop_loop', 'mo_store_after_shop_loop_wrapper', 50 );

/**
 * Add a subtle product card meta label.
 */
function mo_store_product_card_meta_label() {
	echo '<span class="mo-gear-card-kicker">' . esc_html__( 'MO Gear', 'moknives-store-child' ) . '</span>';
}
add_action( 'woocommerce_shop_loop_item_title', 'mo_store_product_card_meta_label', 5 );

/**
 * Remove WooCommerce breadcrumbs on MO Gear pages to avoid generic shop framing.
 */
function mo_store_remove_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}
add_action( 'init', 'mo_store_remove_breadcrumbs' );

/**
 * Improve product image attributes for performance.
 *
 * @param array      $attr       Image attributes.
 * @param WP_Post    $attachment Attachment object.
 * @param string|int[] $size     Image size.
 * @return array
 */
function mo_store_product_image_attributes( $attr, $attachment, $size ) {
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$attr['loading']  = 'lazy';
		$attr['decoding'] = 'async';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mo_store_product_image_attributes', 20, 3 );
