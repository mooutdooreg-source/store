<?php
/**
 * The Template for displaying product archives, including the main shop page.
 *
 * @package MoknivesStoreChild
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

mo_store_get_template_part( 'global/navbar' );
?>

<main id="primary" class="mo-store-main mo-store-main--gear mo-store-main--woocommerce">
	<?php
	mo_store_get_template_part( 'mo-gear/gear-hero' );
	mo_store_get_template_part( 'mo-gear/gear-category-strip' );
	?>

	<section class="mo-gear-shop" aria-label="<?php esc_attr_e( 'MO Gear product archive', 'moknives-store-child' ); ?>">
		<div class="mo-gear-shop__inner">
			<?php if ( woocommerce_product_loop() ) : ?>

				<?php
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				do_action( 'woocommerce_after_shop_loop' );
				?>

			<?php else : ?>

				<div class="mo-gear-empty">
					<p><?php esc_html_e( 'MO Gear products will appear here when they are ready.', 'moknives-store-child' ); ?></p>
				</div>

			<?php endif; ?>
		</div>
	</section>
</main>

<?php
mo_store_get_template_part( 'global/footer' );

get_footer( 'shop' );