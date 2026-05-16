<?php
/**
 * Short premium line story placeholder.
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

<section class="mo-line-story" id="<?php echo esc_attr( $story_id ); ?>" aria-labelledby="<?php echo esc_attr( $story_id ); ?>-title">
	<div class="mo-line-story__inner">
		<p class="mo-line-story__kicker">
			<?php echo esc_html( $line['name'] ); ?>
		</p>

		<h2 id="<?php echo esc_attr( $story_id ); ?>-title">
			<?php esc_html_e( 'Line Story', 'moknives-store-child' ); ?>
		</h2>

		<div class="mo-line-story__copy">
			<p><?php esc_html_e( 'Story copy pending approval.', 'moknives-store-child' ); ?></p>
		</div>
	</div>
</section>