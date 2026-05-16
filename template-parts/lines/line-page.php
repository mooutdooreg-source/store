<?php
/**
 * Full line page composition.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $line ) || ! is_array( $line ) ) {
	$line = mo_store_get_current_line_data();
}

if ( empty( $line ) || ! is_array( $line ) ) {
	return;
}

mo_store_get_template_part(
	'lines/line-hero',
	array(
		'line' => $line,
	)
);

mo_store_get_template_part(
	'lines/line-media-slider',
	array(
		'line' => $line,
	)
);

mo_store_get_template_part(
	'lines/line-story-cta',
	array(
		'line' => $line,
	)
);

mo_store_get_template_part(
	'lines/line-story',
	array(
		'line' => $line,
	)
);

mo_store_get_template_part(
	'lines/july-batch-message',
	array(
		'line' => $line,
	)
);

mo_store_get_template_part(
	'lines/interest-form',
	array(
		'line' => $line,
	)
);