<?php
/**
 * Cinematic homepage hero slideshow.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_slides = array(
	array(
		'desktop' => mo_store_image_url( 'hero-home.webp' ),
		'mobile'  => mo_store_image_url( 'hero-home.webp' ),
		'alt'     => 'Mo the Bladesmith working hot steel in the forge',
	),
);
?>

<section class="mo-hero" aria-label="<?php esc_attr_e( 'MO Store cinematic introduction', 'moknives-store-child' ); ?>">
	<div class="mo-hero__slideshow" data-mo-hero-slideshow>
		<?php foreach ( $hero_slides as $index => $slide ) : ?>
			<picture class="mo-hero__slide<?php echo 0 === $index ? ' is-active' : ''; ?>" data-mo-hero-slide>
				<source media="(max-width: 767px)" srcset="<?php echo esc_url( $slide['mobile'] ); ?>">
				<img
					src="<?php echo esc_url( $slide['desktop'] ); ?>"
					alt="<?php echo esc_attr( $slide['alt'] ); ?>"
					<?php echo 0 === $index ? 'loading="eager"' : 'loading="lazy"'; ?>
					decoding="async"
				/>
			</picture>
		<?php endforeach; ?>
	</div>

	<div class="mo-hero__overlay" aria-hidden="true"></div>

	<div class="mo-hero__content">
		<p class="mo-hero__kicker"><?php esc_html_e( 'MO Store', 'moknives-store-child' ); ?></p>

		<h1 class="mo-hero__title">
			<?php esc_html_e( 'Limited numbered batches by MO.', 'moknives-store-child' ); ?>
		</h1>

		<p class="mo-hero__lead">
			<?php esc_html_e( 'Small-batch blades designed, ground by hand, hand-finished, sharpened, and heat-treated by Mo the Bladesmith.', 'moknives-store-child' ); ?>
		</p>

		<p class="mo-hero__release">
			<?php esc_html_e( 'Prepared for limited release.', 'moknives-store-child' ); ?><br>
			<?php esc_html_e( 'New batches begin production in July.', 'moknives-store-child' ); ?>
		</p>

		<a class="mo-button mo-button--primary mo-hero__button" href="#explore-lines">
			<?php esc_html_e( 'Explore the Lines', 'moknives-store-child' ); ?>
		</a>
	</div>
</section>
