<?php
/**
 * Template Name: MO Store Line Page
 * Template Post Type: page
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$line = mo_store_get_current_line_data();

if ( empty( $line ) || ! is_array( $line ) ) {
	$line_slug = mo_store_get_current_line_slug();

	if ( mo_store_is_valid_line_slug( $line_slug ) ) {
		$line = mo_store_get_line_data( $line_slug );
	}
}

get_header();

mo_store_get_template_part( 'global/navbar' );
?>

<main id="primary" class="mo-store-main mo-store-main--line">
	<?php
	if ( ! empty( $line ) && is_array( $line ) ) {
		mo_store_get_template_part(
			'lines/line-page',
			array(
				'line' => $line,
			)
		);
	}
	?>
</main>

<?php
mo_store_get_template_part( 'global/footer' );

get_footer();