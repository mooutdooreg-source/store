<?php
/**
 * Line page hero.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $line ) || ! is_array( $line ) ) {
	return;
}

$hero_desktop = isset( $line['hero']['desktop'] ) ? $line['hero']['desktop'] : '';
$hero_mobile  = isset( $line['hero']['mobile'] ) ? $line['hero']['mobile'] : $hero_desktop;
?>

<section class="mo-line-hero" aria-labelledby="mo-line-hero-title-<?php echo esc_attr( $line['slug'] ); ?>">
	<picture class="mo-line-hero__media">
		<source media="(max-width: 767px)" srcset="<?php echo esc_url( $hero_mobile ); ?>">
		<img
			src="<?php echo esc_url( $hero_desktop ); ?>"
			alt="<?php echo esc_attr( $line['name'] ); ?>"
			loading="eager"
			decoding="async"
		/>
	</picture>

	<div class="mo-line-hero__overlay" aria-hidden="true"></div>

	<div class="mo-line-hero__content">
		<p class="mo-line-hero__badge">
			<?php echo esc_html( $line['badge'] ); ?>
		</p>

		<h1 id="mo-line-hero-title-<?php echo esc_attr( $line['slug'] ); ?>">
			<?php echo esc_html( $line['name'] ); ?>
		</h1>

		<p class="mo-line-hero__eyebrow">
			<?php echo esc_html( $line['eyebrow'] ); ?>
		</p>

		<p class="mo-line-hero__description">
			<?php echo esc_html( $line['description'] ); ?>
		</p>
	</div>
</section>