<?php
/**
 * Why MO homepage section.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="mo-why" id="why-mo" aria-labelledby="mo-why-title">
	<div class="mo-why__inner">
		<div class="mo-why__intro">
			<p class="mo-why__kicker"><?php esc_html_e( 'Why MO / Origin', 'moknives-store-child' ); ?></p>
			<h2 id="mo-why-title">
				<span><?php esc_html_e( 'No Theater.', 'moknives-store-child' ); ?></span>
				<span class="mo-why__title-accent"><?php esc_html_e( 'Only performance', 'moknives-store-child' ); ?></span>
			</h2>
			<p>
				<?php esc_html_e( 'My work did not begin at the anvil. It began in the field - as a hunter, angler, and open-fire cook - shaped by the demanding reality of use.', 'moknives-store-child' ); ?>
			</p>
			<a class="mo-why-trust" href="<?php echo esc_url( home_url( '/why-mo/' ) ); ?>" aria-label="<?php esc_attr_e( 'Read the full Why MO proof page', 'moknives-store-child' ); ?>">
				<img
					class="mo-why-trust__badge"
					src="<?php echo esc_url( mo_store_image_url( 'abs-member-badge.svg' ) ); ?>"
					alt="<?php esc_attr_e( 'American Bladesmith Society member badge', 'moknives-store-child' ); ?>"
					loading="lazy"
					decoding="async"
				>
				<div class="mo-why-trust__copy">
					<span><?php esc_html_e( 'ABS Member', 'moknives-store-child' ); ?></span>
					<p>
						<?php esc_html_e( 'ABS Member. Forging since 2015 under the name Mo. Building for the wild, the mission, the kitchen, and the long life of an heirloom.', 'moknives-store-child' ); ?>
					</p>
				</div>
			</a>

			<div class="mo-why-video">
				<video
					src="<?php echo esc_url( mo_store_video_url( 'performance-proof.mp4' ) ); ?>"
					autoplay
					muted
					loop
					playsinline
					preload="metadata"
					aria-label="<?php esc_attr_e( 'Performance proof process video', 'moknives-store-child' ); ?>"
				></video>
			</div>
		</div>

	</div>
</section>
