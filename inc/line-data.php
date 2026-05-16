<?php
/**
 * Approved data for MO Store line pages.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the approved data for all MO Store lines.
 *
 * @return array
 */
function mo_store_get_lines_data() {
	return array(
		'takumo'    => array(
			'slug'        => 'takumo',
			'name'        => 'TAKUMO',
			'eyebrow'     => 'Signature Line',
			'badge'       => 'Production Begins July',
			'description' => 'Japanese-inspired limited kitchen blades.',
			'hero'        => array(
				'desktop' => mo_store_image_url( 'takumo-hero.webp' ),
				'mobile'  => mo_store_image_url( 'takumo-hero-mobile.webp' ),
			),
			'media'       => array(
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'takumo-form.webp' ),
					'name'    => 'TAKUMO Form',
					'chapter' => '01 Form',
				),
				array(
					'type'    => 'video',
					'src'     => mo_store_video_url( 'takumo-loop-01.mp4' ),
					'poster'  => mo_store_image_url( 'takumo-edge.webp' ),
					'name'    => 'TAKUMO Edge',
					'chapter' => '02 Edge',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'takumo-handle.webp' ),
					'name'    => 'TAKUMO Handle',
					'chapter' => '03 Handle',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'takumo-finish.webp' ),
					'name'    => 'TAKUMO Finish',
					'chapter' => '04 Finish',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'takumo-in-use.webp' ),
					'name'    => 'TAKUMO In Use',
					'chapter' => '05 In Use',
				),
				array(
					'type'    => 'video',
					'src'     => mo_store_video_url( 'takumo-loop-02.mp4' ),
					'poster'  => mo_store_image_url( 'takumo-finish.webp' ),
					'name'    => 'TAKUMO Detail',
					'chapter' => '04 Finish',
				),
			),
		),
		'matador'   => array(
			'slug'        => 'matador',
			'name'        => 'MATADOR',
			'eyebrow'     => 'Signature Line',
			'badge'       => 'Production Begins July',
			'description' => 'Butchery-focused blades built for heavy cutting work.',
			'hero'        => array(
				'desktop' => mo_store_image_url( 'matador-hero.webp' ),
				'mobile'  => mo_store_image_url( 'matador-hero-mobile.webp' ),
			),
			'media'       => array(
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'matador-form.webp' ),
					'name'    => 'MATADOR Form',
					'chapter' => '01 Form',
				),
				array(
					'type'    => 'video',
					'src'     => mo_store_video_url( 'matador-loop-01.mp4' ),
					'poster'  => mo_store_image_url( 'matador-edge.webp' ),
					'name'    => 'MATADOR Edge',
					'chapter' => '02 Edge',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'matador-handle.webp' ),
					'name'    => 'MATADOR Handle',
					'chapter' => '03 Handle',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'matador-finish.webp' ),
					'name'    => 'MATADOR Finish',
					'chapter' => '04 Finish',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'matador-in-use.webp' ),
					'name'    => 'MATADOR In Use',
					'chapter' => '05 In Use',
				),
				array(
					'type'    => 'video',
					'src'     => mo_store_video_url( 'matador-loop-02.mp4' ),
					'poster'  => mo_store_image_url( 'matador-finish.webp' ),
					'name'    => 'MATADOR Detail',
					'chapter' => '04 Finish',
				),
			),
		),
		'pitmaster' => array(
			'slug'        => 'pitmaster',
			'name'        => 'PITMASTER',
			'eyebrow'     => 'Signature Line',
			'badge'       => 'Production Begins July',
			'description' => 'BBQ-focused blades, forks, grills, and wooden serving pieces.',
			'hero'        => array(
				'desktop' => mo_store_image_url( 'pitmaster-hero.webp' ),
				'mobile'  => mo_store_image_url( 'pitmaster-hero-mobile.webp' ),
			),
			'media'       => array(
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'pitmaster-form.webp' ),
					'name'    => 'PITMASTER Form',
					'chapter' => '01 Form',
				),
				array(
					'type'    => 'video',
					'src'     => mo_store_video_url( 'pitmaster-loop-01.mp4' ),
					'poster'  => mo_store_image_url( 'pitmaster-edge.webp' ),
					'name'    => 'PITMASTER Edge',
					'chapter' => '02 Edge',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'pitmaster-handle.webp' ),
					'name'    => 'PITMASTER Handle',
					'chapter' => '03 Handle',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'pitmaster-finish.webp' ),
					'name'    => 'PITMASTER Finish',
					'chapter' => '04 Finish',
				),
				array(
					'type'    => 'image',
					'src'     => mo_store_image_url( 'pitmaster-in-use.webp' ),
					'name'    => 'PITMASTER In Use',
					'chapter' => '05 In Use',
				),
				array(
					'type'    => 'video',
					'src'     => mo_store_video_url( 'pitmaster-loop-02.mp4' ),
					'poster'  => mo_store_image_url( 'pitmaster-finish.webp' ),
					'name'    => 'PITMASTER Detail',
					'chapter' => '04 Finish',
				),
			),
		),
	);
}

/**
 * Return data for one approved MO Store line.
 *
 * @param string $slug Line slug.
 * @return array|null
 */
function mo_store_get_line_data( $slug ) {
	$slug  = sanitize_key( $slug );
	$lines = mo_store_get_lines_data();

	return isset( $lines[ $slug ] ) ? $lines[ $slug ] : null;
}

/**
 * Return the current line page data.
 *
 * @return array|null
 */
function mo_store_get_current_line_data() {
	$slug = mo_store_get_current_line_slug();

	if ( ! mo_store_is_valid_line_slug( $slug ) ) {
		return null;
	}

	return mo_store_get_line_data( $slug );
}

/**
 * Return the approved line dropdown options for the interest form.
 *
 * @return array
 */
function mo_store_get_interest_line_options() {
	return array(
		'TAKUMO',
		'MATADOR',
		'PITMASTER',
		'Not Sure Yet',
	);
}

/**
 * Map a line slug to the interest dropdown label.
 *
 * @param string $slug Line slug.
 * @return string
 */
function mo_store_line_slug_to_interest_label( $slug ) {
	$map = array(
		'takumo'    => 'TAKUMO',
		'matador'   => 'MATADOR',
		'pitmaster' => 'PITMASTER',
	);

	$slug = sanitize_key( $slug );

	return isset( $map[ $slug ] ) ? $map[ $slug ] : 'Not Sure Yet';
}