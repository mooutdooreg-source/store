<?php
/**
 * Explore the Lines homepage slider.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lines = mo_store_get_home_lines();
?>

<section class="mo-lines" id="explore-lines" aria-labelledby="mo-lines-title">
	<div class="mo-section-heading mo-lines__heading">
		<h2 id="mo-lines-title"><?php esc_html_e( 'Explore the Lines', 'moknives-store-child' ); ?></h2>
		<p><?php esc_html_e( 'Each line carries its own identity, use, and cutting philosophy.', 'moknives-store-child' ); ?></p>
	</div>

	<div class="mo-lines__slider" data-mo-lines-slider>
		<div class="mo-lines__track" data-mo-slider-track>
			<?php foreach ( $lines as $line ) : ?>
				<?php
				$card_id = empty( $line['slug'] ) ? '' : 'mo-' . sanitize_html_class( $line['slug'] ) . '-card';
				$cta     = empty( $line['cta'] ) ? __( 'Explore Line', 'moknives-store-child' ) : $line['cta'];
				$mobile  = empty( $line['mobile'] ) ? '' : $line['mobile'];
				$visual  = empty( $line['visual_class'] ) ? '' : sanitize_html_class( $line['visual_class'] );
				?>
				<a
					class="mo-line-card skeleton"
					data-mo-slider-card
					href="<?php echo esc_url( $line['url'] ); ?>"
					<?php if ( $card_id ) : ?>
						id="<?php echo esc_attr( $card_id ); ?>"
					<?php endif; ?>
				>
					<?php if ( ! empty( $line['image'] ) ) : ?>
						<?php if ( $mobile ) : ?>
							<picture class="mo-line-card__image">
								<source media="(max-width: 767px)" srcset="<?php echo esc_url( $mobile ); ?>">
								<img
									src="<?php echo esc_url( $line['image'] ); ?>"
									alt="<?php echo esc_attr( $line['name'] ); ?>"
									loading="lazy"
									decoding="async"
								/>
							</picture>
						<?php else : ?>
							<img
								class="mo-line-card__image"
								src="<?php echo esc_url( $line['image'] ); ?>"
								alt="<?php echo esc_attr( $line['name'] ); ?>"
								loading="lazy"
								decoding="async"
							/>
						<?php endif; ?>
					<?php else : ?>
						<span class="mo-line-card__image <?php echo esc_attr( $visual ); ?>" role="img" aria-label="<?php echo esc_attr( $line['name'] ); ?>"></span>
					<?php endif; ?>

					<div class="mo-line-card__overlay" aria-hidden="true"></div>

					<div class="mo-line-card__content">
						<p class="mo-line-card__eyebrow"><?php echo esc_html( $line['eyebrow'] ); ?></p>

						<h3><?php echo esc_html( $line['name'] ); ?></h3>

						<p class="mo-line-card__description">
							<?php echo esc_html( $line['description'] ); ?>
						</p>

						<p class="mo-line-card__status">
							<?php echo esc_html( $line['status'] ); ?>
						</p>

						<span class="mo-line-card__link">
							<?php echo esc_html( $cta ); ?>
						</span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
