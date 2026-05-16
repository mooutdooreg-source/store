<?php
/**
 * The template for displaying single MO Gear products.
 *
 * @package MoknivesStoreChild
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

mo_store_get_template_part( 'global/navbar' );

global $product;

if ( ! $product instanceof WC_Product ) {
	$product = wc_get_product( get_the_ID() );
}
?>

<main id="primary" class="mo-store-main mo-store-main--gear mo-store-main--single-product">
	<?php
	while ( have_posts() ) :
		the_post();

		$product_id = get_the_ID();
		$product    = wc_get_product( $product_id );

		if ( ! $product instanceof WC_Product ) {
			continue;
		}

		$gallery_ids = $product->get_gallery_image_ids();
		$main_image  = $product->get_image_id();
		?>

		<article id="product-<?php echo esc_attr( $product_id ); ?>" <?php wc_product_class( 'mo-single-product', $product ); ?>>
			<section class="mo-single-product__hero" aria-labelledby="mo-single-product-title">
				<div class="mo-single-product__media">
					<?php if ( $main_image ) : ?>
						<div class="mo-single-product__main-image">
							<?php
							echo wp_get_attachment_image(
								$main_image,
								'large',
								false,
								array(
									'class'    => 'mo-single-product__image',
									'loading'  => 'eager',
									'decoding' => 'async',
								)
							);
							?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $gallery_ids ) ) : ?>
						<div class="mo-single-product__gallery" aria-label="<?php esc_attr_e( 'Product gallery', 'moknives-store-child' ); ?>">
							<?php foreach ( $gallery_ids as $gallery_id ) : ?>
								<div class="mo-single-product__gallery-item">
									<?php
									echo wp_get_attachment_image(
										$gallery_id,
										'woocommerce_thumbnail',
										false,
										array(
											'class'    => 'mo-single-product__gallery-image',
											'loading'  => 'lazy',
											'decoding' => 'async',
										)
									);
									?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="mo-single-product__summary">
					<p class="mo-single-product__kicker">
						<?php esc_html_e( 'MO Gear', 'moknives-store-child' ); ?>
					</p>

					<h1 id="mo-single-product-title" class="mo-single-product__title">
						<?php the_title(); ?>
					</h1>

					<?php if ( $product->get_short_description() ) : ?>
						<div class="mo-single-product__excerpt">
							<?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?>
						</div>
					<?php endif; ?>

					<div class="mo-single-product__price">
						<?php echo wp_kses_post( $product->get_price_html() ); ?>
					</div>

					<div class="mo-single-product__cart">
						<?php woocommerce_template_single_add_to_cart(); ?>
					</div>

					<div class="mo-single-product__meta">
						<?php woocommerce_template_single_meta(); ?>
					</div>
				</div>
			</section>

			<?php if ( get_the_content() ) : ?>
				<section class="mo-single-product__details" aria-labelledby="mo-single-product-details-title">
					<div class="mo-single-product__details-inner">
						<p class="mo-single-product__details-kicker">
							<?php esc_html_e( 'Details', 'moknives-store-child' ); ?>
						</p>

						<h2 id="mo-single-product-details-title">
							<?php esc_html_e( 'Built for the work around the blade.', 'moknives-store-child' ); ?>
						</h2>

						<div class="mo-single-product__description">
							<?php the_content(); ?>
						</div>
					</div>
				</section>
			<?php endif; ?>
		</article>

	<?php endwhile; ?>
</main>

<?php
mo_store_get_template_part( 'global/footer' );

get_footer( 'shop' );