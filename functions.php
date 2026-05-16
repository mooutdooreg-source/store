<?php
/**
 * MO Knives Store Child Theme functions.
 *
 * Child theme for WoodMart, built for moknives.store.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MO_STORE_CHILD_VERSION', '1.0.0' );
define( 'MO_STORE_CHILD_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'MO_STORE_CHILD_URI', trailingslashit( get_stylesheet_directory_uri() ) );

/**
 * Load child theme modules.
 */
$mo_store_includes = array(
	'inc/helpers.php',
	'inc/setup.php',
	'inc/line-data.php',
	'inc/forms.php',
	'inc/shortcodes.php',
	'inc/woo-overrides.php',
);

foreach ( $mo_store_includes as $mo_store_file ) {
	$mo_store_path = MO_STORE_CHILD_DIR . $mo_store_file;

	if ( file_exists( $mo_store_path ) ) {
		require_once $mo_store_path;
	}
}

/**
 * Enqueue WoodMart parent styles and MO Store custom assets.
 */
function mo_store_enqueue_assets() {
	$parent_style_handle = 'woodmart-style';

	wp_enqueue_style(
		$parent_style_handle,
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'mo-store-fonts',
		'https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Montserrat:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'mo-store',
		MO_STORE_CHILD_URI . 'assets/css/mo-store.css',
		array( $parent_style_handle, 'mo-store-fonts' ),
		MO_STORE_CHILD_VERSION
	);

	wp_enqueue_script(
		'mo-store',
		MO_STORE_CHILD_URI . 'assets/js/mo-store.js',
		array(),
		MO_STORE_CHILD_VERSION,
		true
	);

	wp_localize_script(
		'mo-store',
		'moStoreSettings',
		array(
			'ajaxUrl'              => admin_url( 'admin-ajax.php' ),
			'homeUrl'              => home_url( '/' ),
			'assetsUrl'            => MO_STORE_CHILD_URI . 'assets/',
			'preferenceNonce'      => wp_create_nonce( 'mo_store_preference_nonce' ),
			'interestNonce'        => wp_create_nonce( 'mo_store_interest_nonce' ),
			'preferenceAction'     => 'mo_store_submit_preference',
			'interestAction'       => 'mo_store_submit_interest',
			'preferenceSuccess'    => array(
				'title'   => 'Thanks — your preference has been noted.',
				'message' => 'It will help shape future MO Store batches.',
			),
			'interestSuccessLines' => array(
				'TAKUMO'       => 'You are on the TAKUMO first access list.',
				'MATADOR'      => 'You are on the MATADOR first access list.',
				'PITMASTER'    => 'You are on the PITMASTER first access list.',
				'Not Sure Yet' => 'You are on the MO Store first access list.',
			),
			'interestSuccessNote'  => 'We will email you before the July release opens.',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'mo_store_enqueue_assets', 20 );

/**
 * Add body classes used by the MO Store front-end.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function mo_store_body_classes( $classes ) {
	$classes[] = 'mo-store-site';

	if ( is_front_page() ) {
		$classes[] = 'mo-store-home';
	}

	if ( is_page_template( 'page-templates/template-line-page.php' ) ) {
		$classes[] = 'mo-store-line-page';
	}

	if ( is_page( 'mo-gear' ) || is_shop() || is_product_taxonomy() || is_product() ) {
		$classes[] = 'mo-store-gear';
	}

	return $classes;
}
add_filter( 'body_class', 'mo_store_body_classes' );

/**
 * Register MO Store navigation locations.
 */
function mo_store_register_menus() {
	register_nav_menus(
		array(
			'mo_store_primary' => esc_html__( 'MO Store Primary Navigation', 'moknives-store-child' ),
		)
	);
}
add_action( 'after_setup_theme', 'mo_store_register_menus' );

/**
 * Theme support additions for WooCommerce and responsive media.
 */
function mo_store_theme_support() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'mo_store_theme_support', 20 );

/**
 * Remove unnecessary default WordPress emoji assets for a leaner front-end.
 */
function mo_store_disable_emoji_assets() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'mo_store_disable_emoji_assets' );

/**
 * Load line page template automatically for the approved /lines/{slug} pages
 * when the template is available in the child theme.
 *
 * @param string $template Current template path.
 * @return string
 */
function mo_store_line_page_template( $template ) {
	if ( ! is_page() ) {
		return $template;
	}

	$page = get_post();

	if ( ! $page instanceof WP_Post ) {
		return $template;
	}

	$approved_line_slugs = array( 'takumo', 'matador', 'pitmaster' );
	$page_slug           = $page->post_name;
	$parent              = $page->post_parent ? get_post( $page->post_parent ) : null;
	$is_lines_child      = $parent instanceof WP_Post && 'lines' === $parent->post_name;

	if ( $is_lines_child && in_array( $page_slug, $approved_line_slugs, true ) ) {
		$line_template = MO_STORE_CHILD_DIR . 'page-templates/template-line-page.php';

		if ( file_exists( $line_template ) ) {
			return $line_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'mo_store_line_page_template', 50 );