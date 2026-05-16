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
		'label' => 'Small-batch production',
		'icon'  => 'mark',
	),
	array(
		'label' => 'Ground by hand',
		'icon'  => 'blade-slim',
	),
	array(
		'label' => 'Hand-finished & sharpened',
		'icon'  => 'spark',
	),
	array(
		'label' => 'Heat-treated by MO',
		'icon'  => 'mark',
	),
	array(
		'label' => 'Limited numbered batches',
		'icon'  => 'blade-slim',
	),
);

$marquee_items = array_merge( $standard_items, $standard_items );
?>

<section class="mo-standard-bar" id="mo-store-standard" aria-label="<?php esc_attr_e( 'MO Store Standard', 'moknives-store-child' ); ?>">
	<div class="mo-standard-bar__track" data-mo-marquee>
		<?php foreach ( $marquee_items as $item ) : ?>
			<div class="mo-standard-bar__item">
				<?php mo_store_icon( $item['icon'], 'mo-standard-bar__icon' ); ?>
				<span><?php echo esc_html( $item['label'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</section>