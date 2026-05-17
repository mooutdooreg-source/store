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
		'desktop' => mo_store_image_url( 'hero-home-culinary.webp' ),
		'mobile'  => mo_store_image_url( 'hero-home-culinary.webp' ),
		'alt'     => 'MO culinary blade with wagyu, garlic, and herbs',
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
	<div class="mo-hero__announcement" role="status">
		<?php esc_html_e( 'New batches begin production in July', 'moknives-store-child' ); ?>
	</div>

	<div class="mo-hero__content">
		<p class="mo-hero__kicker"><?php esc_html_e( 'MO Store', 'moknives-store-child' ); ?></p>

		<h1 class="mo-hero__title">
			<span><?php esc_html_e( 'Premium Hard-Use', 'moknives-store-child' ); ?></span>
			<span class="mo-hero__title-accent"><?php esc_html_e( 'Blades', 'moknives-store-child' ); ?></span>
		</h1>

		<p class="mo-hero__subheadline">
			<?php esc_html_e( 'Available exclusively in limited numbered releases. Hand-finished and expertly heat-treated for ultimate performance.', 'moknives-store-child' ); ?>
		</p>

		<p class="mo-hero__lead">
			<?php esc_html_e( 'Premium production blades designed, hand-ground, and precision heat-treated by Mo the Bladesmith.', 'moknives-store-child' ); ?>
		</p>

		<a class="mo-button mo-button--primary mo-hero__button" href="#explore-lines">
			<?php esc_html_e( 'Explore the Lines', 'moknives-store-child' ); ?>
		</a>
	</div>
</section>
