<?php
/**
 * MO Store Standard Bar.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$standard_items = array(
	array(
		'label' => 'Ground by hand',
		'icon'  => 'blade-slim',
		'image' => mo_store_image_url( 'standard-grinding.jpg' ),
	),
	array(
		'label' => 'Hand-finished & sharpened',
		'icon'  => 'spark',
		'image' => mo_store_image_url( 'standard-sharpening.jpg' ),
	),
	array(
		'label' => 'Heat-treated by MO',
		'icon'  => 'mark',
		'image' => mo_store_image_url( 'standard-heat-treatment.webp' ),
	),
	array(
		'label' => 'Limited numbered batches',
		'icon'  => 'blade-slim',
		'image' => mo_store_image_url( 'standard-limited-batch.webp' ),
	),
);

$marquee_items = array_merge( $standard_items, $standard_items );
?>

<section class="mo-standard-bar" id="mo-store-standard" aria-label="<?php esc_attr_e( 'MO Store Standard', 'moknives-store-child' ); ?>">
	<div class="mo-standard-bar__track" data-mo-marquee>
		<?php foreach ( $marquee_items as $item ) : ?>
			<div class="mo-standard-bar__item">
				<?php if ( ! empty( $item['image'] ) ) : ?>
					<img
						class="mo-standard-bar__image"
						src="<?php echo esc_url( $item['image'] ); ?>"
						alt=""
						loading="lazy"
						decoding="async"
					/>
				<?php else : ?>
					<?php mo_store_icon( $item['icon'], 'mo-standard-bar__icon' ); ?>
				<?php endif; ?>
				<span><?php echo esc_html( $item['label'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</section>
