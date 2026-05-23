<?php
/**
 * July limited batch message for line pages.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $line ) || ! is_array( $line ) ) {
	return;
}
?>

<section class="mo-july-message" aria-labelledby="mo-july-message-title-<?php echo esc_attr( $line['slug'] ); ?>">
	<div class="mo-july-message__card">
		<h2 id="mo-july-message-title-<?php echo esc_attr( $line['slug'] ); ?>">
			<?php esc_html_e( 'The first July batches will be limited.', 'moknives-store-child' ); ?>
		</h2>

		<p>
			<?php esc_html_e( 'Register your interest early to be notified before the release opens.', 'moknives-store-child' ); ?>
		</p>
	</div>
</section>
