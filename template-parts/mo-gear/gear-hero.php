<?php
/**
 * MO Gear hero.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="mo-gear-hero" aria-labelledby="mo-gear-hero-title">
	<picture class="mo-gear-hero__media">
		<img
			src="<?php echo esc_url( mo_store_image_url( 'mo-gear-hero.webp' ) ); ?>"
			alt="<?php esc_attr_e( 'MO Gear', 'moknives-store-child' ); ?>"
			loading="eager"
			decoding="async"
		/>
	</picture>

	<div class="mo-gear-hero__overlay" aria-hidden="true"></div>

	<div class="mo-gear-hero__content">
		<p class="mo-gear-hero__kicker">
			<?php esc_html_e( 'MO GEAR', 'moknives-store-child' ); ?>
		</p>

		<h1 id="mo-gear-hero-title">
			<?php esc_html_e( 'BEYOND THE BLADE', 'moknives-store-child' ); ?>
		</h1>

		<p>
			<?php esc_html_e( 'Because details matter. Hard-to-find gear for people who take blades seriously.', 'moknives-store-child' ); ?>
		</p>
	</div>
</section>