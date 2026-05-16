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
				<article class="mo-line-card skeleton" data-mo-slider-card>
					<img
						class="mo-line-card__image"
						src="<?php echo esc_url( $line['image'] ); ?>"
						alt="<?php echo esc_attr( $line['name'] ); ?>"
						loading="lazy"
						decoding="async"
					/>

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

						<a class="mo-line-card__link" href="<?php echo esc_url( $line['url'] ); ?>">
							<?php esc_html_e( 'Explore Line', 'moknives-store-child' ); ?>
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="mo-lines__desktop-controls" aria-hidden="true">
			<button class="mo-lines__arrow" type="button" data-mo-slider-prev tabindex="-1">
				<?php mo_store_icon( 'arrow-left' ); ?>
			</button>
			<button class="mo-lines__arrow" type="button" data-mo-slider-next tabindex="-1">
				<?php mo_store_icon( 'arrow-right' ); ?>
			</button>
		</div>

		<div class="mo-slider-progress" aria-hidden="true">
			<span data-mo-slider-progress></span>
		</div>
	</div>
</section>