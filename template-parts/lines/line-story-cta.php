<?php
/**
 * Read the Line Story CTA.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $line ) || ! is_array( $line ) ) {
	return;
}

$story_id = 'line-story-' . sanitize_html_class( $line['slug'] );
?>

<section class="mo-line-story-cta" aria-label="<?php esc_attr_e( 'Read the Line Story', 'moknives-store-child' ); ?>">
	<a class="mo-button mo-button--ghost mo-line-story-cta__button" href="#<?php echo esc_attr( $story_id ); ?>">
		<?php esc_html_e( 'Read the Line Story', 'moknives-store-child' ); ?>
	</a>
</section>