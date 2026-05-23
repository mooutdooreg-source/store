<?php
/**
 * MO Gear page template.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

mo_store_get_template_part( 'global/navbar' );
?>

<main id="primary" class="mo-store-main mo-store-main--gear">
	<?php
	mo_store_get_template_part( 'mo-gear/gear-hero' );
	mo_store_get_template_part( 'mo-gear/gear-category-strip' );
	?>

	<section class="mo-gear-shop" aria-label="<?php esc_attr_e( 'MO Gear product grid', 'moknives-store-child' ); ?>">
		<div class="mo-gear-shop__inner">
			<?php if ( shortcode_exists( 'products' ) ) : ?>
				<?php echo do_shortcode( '[products limit="12" columns="3" paginate="true"]' ); ?>
			<?php else : ?>
				<div class="mo-gear-empty">
					<p><?php esc_html_e( 'MO Gear products will appear here when WooCommerce is ready.', 'moknives-store-child' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
mo_store_get_template_part( 'global/footer' );

get_footer();
