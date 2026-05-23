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
		'class'   => 'mo-hero__slide--forging',
		'desktop' => mo_store_image_url( 'hero-forged-by-mo.desktop.webp' ),
		'mobile'  => mo_store_image_url( 'hero-forged-by-mo.mobile.webp' ),
		'alt'     => 'Mo forging a patterned billet on the anvil',
	),
	array(
		'class'   => 'mo-hero__slide--sharpening',
		'desktop' => mo_store_image_url( 'hero-hand-sharpened.webp' ),
		'mobile'  => mo_store_image_url( 'hero-hand-sharpened.webp' ),
		'alt'     => 'Hand sharpening a MO blade on a whetstone',
	),
	array(
		'class'   => 'mo-hero__slide--sparks',
		'desktop' => mo_store_image_url( 'hero-grinding-sparks.desktop.webp' ),
		'mobile'  => mo_store_image_url( 'hero-grinding-sparks.webp' ),
		'alt'     => 'Blade grinding sparks in the MO workshop',
	),
	array(
		'class'   => 'mo-hero__slide--handle',
		'desktop' => mo_store_image_url( 'hero-handle-detail.desktop.webp' ),
		'mobile'  => mo_store_image_url( 'hero-handle-detail.webp' ),
		'alt'     => 'Hands checking the handle detail of a finished MO knife',
	),
	array(
		'class'   => 'mo-hero__slide--grounding',
		'desktop' => mo_store_image_url( 'hero-hand-grounded.webp' ),
		'mobile'  => mo_store_image_url( 'hero-hand-grounded.mobile.webp' ),
		'alt'     => 'Mo grinding a blade beside the forge',
	),
);
?>

<section class="mo-hero" aria-label="<?php esc_attr_e( 'MO Store cinematic introduction', 'moknives-store-child' ); ?>">
	<div class="mo-hero__card">
		<div class="mo-hero__slideshow" data-mo-hero-slideshow>
			<?php foreach ( $hero_slides as $index => $slide ) : ?>
				<?php
				$slide_classes = array( 'mo-hero__slide' );

				if ( ! empty( $slide['class'] ) ) {
					$slide_classes[] = $slide['class'];
				}

				if ( 0 === $index ) {
					$slide_classes[] = 'is-active';
				}
				?>
				<picture class="<?php echo esc_attr( implode( ' ', $slide_classes ) ); ?>" data-mo-hero-slide>
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
		<div class="mo-hero__progress" aria-hidden="true">
			<?php foreach ( $hero_slides as $index => $slide ) : ?>
				<span class="mo-hero__progress-segment<?php echo 0 === $index ? ' is-active' : ''; ?>" data-mo-hero-progress-segment></span>
			<?php endforeach; ?>
		</div>
		<div class="mo-hero__counter" aria-hidden="true">
			<span data-mo-hero-current>01</span>
			<span>/</span>
			<span><?php echo esc_html( sprintf( '%02d', count( $hero_slides ) ) ); ?></span>
		</div>

		<div class="mo-hero__content">
			<p class="mo-hero__kicker"><?php esc_html_e( 'MO Store', 'moknives-store-child' ); ?></p>

			<h1 class="mo-hero__title">
				<span><?php esc_html_e( 'Premium', 'moknives-store-child' ); ?></span>
				<span><?php esc_html_e( 'Hard-Use', 'moknives-store-child' ); ?></span>
				<span class="mo-hero__title-accent"><?php esc_html_e( 'Blades', 'moknives-store-child' ); ?></span>
			</h1>

			<p class="mo-hero__subheadline">
				<?php esc_html_e( 'Released only in limited numbered batches.', 'moknives-store-child' ); ?>
			</p>

			<p class="mo-hero__lead">
				<?php esc_html_e( 'Each blade is designed, hand-ground, hand-finished, and heat-treated by Mo the Bladesmith.', 'moknives-store-child' ); ?>
			</p>

			<a class="mo-button mo-button--primary mo-hero__button" href="#explore-lines">
				<?php esc_html_e( 'Explore the Lines', 'moknives-store-child' ); ?>
			</a>
		</div>
	</div>
</section>
