<?php
/**
 * Line page horizontal filmstrip media slider and fullscreen viewer.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $line ) || ! is_array( $line ) || empty( $line['media'] ) || ! is_array( $line['media'] ) ) {
	return;
}

$viewer_id = 'mo-media-viewer-' . sanitize_html_class( $line['slug'] );
?>

<section class="mo-line-media" aria-labelledby="mo-line-media-title-<?php echo esc_attr( $line['slug'] ); ?>">
	<div class="mo-line-media__heading">
		<p class="mo-line-media__kicker"><?php esc_html_e( 'Visual Chapters', 'moknives-store-child' ); ?></p>
		<h2 id="mo-line-media-title-<?php echo esc_attr( $line['slug'] ); ?>">
			<?php echo esc_html( $line['name'] ); ?>
		</h2>
	</div>

	<div class="mo-line-media__slider" data-mo-line-media-slider>
		<div class="mo-line-media__track" data-mo-line-media-track>
			<?php foreach ( $line['media'] as $index => $media ) : ?>
				<?php
				$type    = isset( $media['type'] ) ? $media['type'] : 'image';
				$src     = isset( $media['src'] ) ? $media['src'] : '';
				$poster  = isset( $media['poster'] ) ? $media['poster'] : '';
				$name    = isset( $media['name'] ) ? $media['name'] : $line['name'];
				$chapter = isset( $media['chapter'] ) ? $media['chapter'] : '';
				?>

				<button
					class="mo-media-card skeleton"
					type="button"
					data-mo-media-card
					data-index="<?php echo esc_attr( $index ); ?>"
					data-type="<?php echo esc_attr( $type ); ?>"
					data-src="<?php echo esc_url( $src ); ?>"
					data-poster="<?php echo esc_url( $poster ); ?>"
					data-name="<?php echo esc_attr( $name ); ?>"
					aria-label="<?php echo esc_attr( $name ); ?>"
				>
					<span class="mo-media-card__visual">
						<?php if ( 'video' === $type ) : ?>
							<video
								class="mo-media-card__video"
								src="<?php echo esc_url( $src ); ?>"
								poster="<?php echo esc_url( $poster ); ?>"
								muted
								loop
								playsinline
								preload="none"
								data-mo-observe-video
							></video>
						<?php else : ?>
							<img
								src="<?php echo esc_url( $src ); ?>"
								alt="<?php echo esc_attr( $name ); ?>"
								loading="lazy"
								decoding="async"
							/>
						<?php endif; ?>
					</span>

					<span class="mo-media-card__overlay" aria-hidden="true"></span>

					<span class="mo-media-card__content">
						<?php if ( ! empty( $chapter ) ) : ?>
							<span class="mo-media-card__chapter"><?php echo esc_html( $chapter ); ?></span>
						<?php endif; ?>

						<span class="mo-media-card__name"><?php echo esc_html( $name ); ?></span>
					</span>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="mo-slider-progress" aria-hidden="true">
			<span data-mo-line-media-progress></span>
		</div>
	</div>

	<div
		class="mo-media-viewer"
		id="<?php echo esc_attr( $viewer_id ); ?>"
		data-mo-media-viewer
		aria-hidden="true"
		role="dialog"
		aria-modal="true"
		aria-label="<?php esc_attr_e( 'Fullscreen media viewer', 'moknives-store-child' ); ?>"
	>
		<button class="mo-media-viewer__close" type="button" data-mo-media-close aria-label="<?php esc_attr_e( 'Close media viewer', 'moknives-store-child' ); ?>">
			<?php mo_store_icon( 'close' ); ?>
		</button>

		<button class="mo-media-viewer__nav mo-media-viewer__nav--prev" type="button" data-mo-media-prev aria-label="<?php esc_attr_e( 'Previous media', 'moknives-store-child' ); ?>">
			<?php mo_store_icon( 'arrow-left' ); ?>
		</button>

		<div class="mo-media-viewer__stage" data-mo-media-stage></div>

		<button class="mo-media-viewer__nav mo-media-viewer__nav--next" type="button" data-mo-media-next aria-label="<?php esc_attr_e( 'Next media', 'moknives-store-child' ); ?>">
			<?php mo_store_icon( 'arrow-right' ); ?>
		</button>

		<p class="mo-media-viewer__name" data-mo-media-name></p>
	</div>
</section>