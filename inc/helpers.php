<?php
/**
 * General helper functions for MO Knives Store Child.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a child theme asset URL.
 *
 * @param string $path Relative path inside the child theme.
 * @return string
 */
function mo_store_asset_url( $path = '' ) {
	$path = ltrim( (string) $path, '/' );

	return MO_STORE_CHILD_URI . $path;
}

/**
 * Return a child theme asset path.
 *
 * @param string $path Relative path inside the child theme.
 * @return string
 */
function mo_store_asset_path( $path = '' ) {
	$path = ltrim( (string) $path, '/' );

	return MO_STORE_CHILD_DIR . $path;
}

/**
 * Echo a child theme asset URL.
 *
 * @param string $path Relative path inside the child theme.
 */
function mo_store_the_asset_url( $path = '' ) {
	echo esc_url( mo_store_asset_url( $path ) );
}

/**
 * Get an approved image URL from the child theme assets/img directory.
 *
 * @param string $filename Image filename.
 * @return string
 */
function mo_store_image_url( $filename ) {
	$filename = ltrim( (string) $filename, '/' );

	return mo_store_asset_url( 'assets/img/' . $filename );
}

/**
 * Get an approved video URL from the child theme assets/video directory.
 *
 * @param string $filename Video filename.
 * @return string
 */
function mo_store_video_url( $filename ) {
	$filename = ltrim( (string) $filename, '/' );

	return mo_store_asset_url( 'assets/video/' . $filename );
}

/**
 * Return the MO Store logo SVG URL.
 *
 * @return string
 */
function mo_store_logo_url() {
	return mo_store_image_url( 'logo-mo.svg' );
}

/**
 * Output a reusable inline SVG icon.
 *
 * @param string $icon  Icon key.
 * @param string $class Optional CSS class.
 * @return string
 */
function mo_store_get_icon( $icon, $class = '' ) {
	$icon  = sanitize_key( $icon );
	$class = trim( 'mo-icon ' . sanitize_html_class( $class ) );

	$icons = array(
		'blade-slim'   => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M9 50c13-16 25-28 46-40-8 15-19 30-39 47L9 50Z"/><path d="M17 56l-8-8"/><path d="M14 47l6 6"/></svg>',
		'cleaver'      => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M14 14h38v28c0 8-6 14-14 14H14V14Z"/><path d="M22 22h8"/><path d="M14 48H7"/></svg>',
		'fork-fire'    => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M17 8v24"/><path d="M25 8v24"/><path d="M13 8v16c0 7 4 10 8 10s8-3 8-10V8"/><path d="M21 34v22"/><path d="M44 55c7-4 9-10 7-16-2-7-8-10-7-19-8 7-14 15-12 25 1 6 5 9 12 10Z"/><path d="M43 55c3-4 3-8 1-13"/></svg>',
		'utility'      => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M10 42 42 10l12 12-32 32H10V42Z"/><path d="M38 14l12 12"/><path d="M16 43l5 5"/></svg>',
		'spark'        => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M32 6l5 18 18 8-18 8-5 18-5-18-18-8 18-8 5-18Z"/><path d="M52 8l2 7 7 2-7 2-2 7-2-7-7-2 7-2 2-7Z"/></svg>',
		'mark'         => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M12 32h40"/><path d="M32 12v40"/><path d="M18 18l28 28"/><path d="M46 18 18 46"/></svg>',
		'check'        => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M16 34l10 10 22-24"/></svg>',
		'arrow-left'   => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M40 14 22 32l18 18"/><path d="M24 32h28"/></svg>',
		'arrow-right'  => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M24 14l18 18-18 18"/><path d="M12 32h28"/></svg>',
		'close'        => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M18 18l28 28"/><path d="M46 18 18 46"/></svg>',
		'instagram'    => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><rect x="14" y="14" width="36" height="36" rx="10"/><circle cx="32" cy="32" r="9"/><circle cx="43" cy="21" r="2"/></svg>',
		'facebook'     => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M38 18h8v-8h-8c-9 0-14 5-14 14v6h-7v8h7v16h9V38h10l2-8H33v-6c0-4 2-6 5-6Z"/></svg>',
		'tiktok'       => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M38 10c1 9 6 15 15 17v9c-6 0-11-2-15-5v14c0 9-7 15-16 15S7 54 7 45s7-15 16-15c2 0 4 0 6 1v9c-2-1-4-1-6-1-4 0-7 3-7 7s3 7 7 7 7-3 7-8V10h8Z"/></svg>',
		'snapchat'     => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><path d="M32 8c9 0 15 7 15 17v8c0 3 4 5 8 6-2 6-8 7-12 8-2 5-6 9-11 9s-9-4-11-9c-4-1-10-2-12-8 4-1 8-3 8-6v-8C17 15 23 8 32 8Z"/></svg>',
		'youtube'      => '<svg viewBox="0 0 64 64" aria-hidden="true" focusable="false"><rect x="10" y="18" width="44" height="28" rx="8"/><path d="M29 26l12 6-12 6V26Z"/></svg>',
	);

	if ( ! isset( $icons[ $icon ] ) ) {
		return '';
	}

	return '<span class="' . esc_attr( $class ) . '">' . $icons[ $icon ] . '</span>';
}

/**
 * Echo a reusable inline SVG icon.
 *
 * @param string $icon  Icon key.
 * @param string $class Optional CSS class.
 */
function mo_store_icon( $icon, $class = '' ) {
	echo mo_store_get_icon( $icon, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Render a template part with isolated variables.
 *
 * @param string $slug Template part path relative to template-parts without .php.
 * @param array  $args Variables available to the template.
 */
function mo_store_get_template_part( $slug, $args = array() ) {
	$template = MO_STORE_CHILD_DIR . 'template-parts/' . ltrim( $slug, '/' ) . '.php';

	if ( ! file_exists( $template ) ) {
		return;
	}

	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
	}

	include $template;
}

/**
 * Return the approved MO Store homepage line cards.
 *
 * @return array
 */
function mo_store_get_home_lines() {
	return array(
		array(
			'slug'        => 'takumo',
			'name'        => 'TAKUMO',
			'eyebrow'     => 'Signature Line',
			'description' => 'Japanese-inspired limited kitchen blades.',
			'status'      => 'Prepared for Limited Release',
			'image'       => mo_store_image_url( 'lines-takumo.webp' ),
			'url'         => home_url( '/lines/takumo/' ),
		),
		array(
			'slug'        => 'matador',
			'name'        => 'MATADOR',
			'eyebrow'     => 'Signature Line',
			'description' => 'Butchery-focused blades built for heavy cutting work.',
			'status'      => 'Prepared for Limited Release',
			'image'       => mo_store_image_url( 'lines-matador.jpg' ),
			'url'         => home_url( '/lines/matador/' ),
		),
		array(
			'slug'        => 'pitmaster',
			'name'        => 'PITMASTER',
			'eyebrow'     => 'Signature Line',
			'description' => 'BBQ-focused blades, forks, grills, and wooden serving pieces.',
			'status'      => 'Prepared for Limited Release',
			'image'       => mo_store_image_url( 'lines-pitmaster.webp' ),
			'url'         => home_url( '/lines/pitmaster/' ),
		),
		array(
			'slug'        => 'gear',
			'name'        => 'MO GEAR',
			'eyebrow'     => 'Gear Collection',
			'description' => 'Hard-to-find gear for people who take blades seriously.',
			'status'      => 'Integrated with Store Lines',
			'image'       => mo_store_image_url( 'mo-gear-card.webp' ),
			'mobile'      => mo_store_image_url( 'mo-gear-card-mobile.webp' ),
			'url'          => home_url( '/mo-gear/' ),
			'cta'          => 'Explore Gear',
		),
	);
}

/**
 * Return shape-the-next-batch option data.
 *
 * @return array
 */
function mo_store_get_batch_preference_options() {
	return array(
		array(
			'id'    => 'japanese-kitchen-blades',
			'label' => 'Japanese kitchen blades',
			'icon'  => 'blade-slim',
		),
		array(
			'id'    => 'butchery-heavy-cutting',
			'label' => 'Butchery / heavy cutting',
			'icon'  => 'cleaver',
		),
		array(
			'id'    => 'bbq-tools-serving-pieces',
			'label' => 'BBQ tools & serving pieces',
			'icon'  => 'fork-fire',
		),
		array(
			'id'    => 'outdoor-utility-blades',
			'label' => 'Outdoor / utility blades',
			'icon'  => 'utility',
		),
		array(
			'id'    => 'something-new',
			'label' => 'Something new',
			'icon'  => 'spark',
		),
	);
}

/**
 * Return approved MO Gear category labels.
 *
 * @return array
 */
function mo_store_get_gear_categories() {
	return array(
		'Cutting Boards',
		'BBQ Gear',
		'Shears',
		'Aprons',
		'Sharpening',
		'Maintenance',
		'Leather Work',
		'Gifts',
	);
}

/**
 * Determine current line slug from page context.
 *
 * @return string
 */
function mo_store_get_current_line_slug() {
	$query_line = get_query_var( 'mo_store_line' );

	if ( $query_line ) {
		return sanitize_key( $query_line );
	}

	if ( is_page() ) {
		$page = get_post();

		if ( $page instanceof WP_Post ) {
			return sanitize_key( $page->post_name );
		}
	}

	return '';
}

/**
 * Return whether a given slug is one of the approved MO Store lines.
 *
 * @param string $slug Line slug.
 * @return bool
 */
function mo_store_is_valid_line_slug( $slug ) {
	return in_array( sanitize_key( $slug ), array( 'takumo', 'matador', 'pitmaster' ), true );
}

/**
 * Return a safe ARIA label for social links.
 *
 * @param string $network Social network name.
 * @return string
 */
function mo_store_social_aria_label( $network ) {
	return sprintf(
		/* translators: %s: Social network name. */
		esc_html__( 'MO Store on %s', 'moknives-store-child' ),
		ucfirst( sanitize_text_field( $network ) )
	);
}
