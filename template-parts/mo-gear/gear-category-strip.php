<?php
/**
 * MO Gear category strip.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = mo_store_get_gear_categories();
?>

<section class="mo-gear-categories" aria-label="<?php esc_attr_e( 'MO Gear categories', 'moknives-store-child' ); ?>">
	<div class="mo-gear-categories__track">
		<?php foreach ( $categories as $category ) : ?>
			<?php
			$term = get_term_by( 'name', $category, 'product_cat' );
			$url  = $term && ! is_wp_error( $term ) ? get_term_link( $term ) : '#';
			?>
			<a class="mo-gear-category" href="<?php echo esc_url( $url ); ?>">
				<?php echo esc_html( $category ); ?>
			</a>
		<?php endforeach; ?>
	</div>
</section>