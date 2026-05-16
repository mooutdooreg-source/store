<?php
/**
 * The template for displaying product content within loops.
 *
 * @package MoknivesStoreChild
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_id    = $product->get_id();
$product_link  = get_permalink( $product_id );
$product_image = $product->get_image(
	'woocommerce_thumbnail',
	array(
		'class'    => 'mo-gear-product__image',
		'loading'  => 'lazy',
		'decoding' => 'async',
	)
);
?>

<li <?php wc_product_class( 'mo-gear-product', $product ); ?>>
	<a class="mo-gear-product__media" href="<?php echo esc_url( $product_link ); ?>">
		<?php
		if ( $product->is_on_sale() ) {
			echo wp_kses_post( apply_filters( 'woocommerce_sale_flash', '', get_post( $product_id ), $product ) );
		}

		echo wp_kses_post( $product_image );
		?>
	</a>

	<div class="mo-gear-product__content">
		<span class="mo-gear-card-kicker">
			<?php esc_html_e( 'MO Gear', 'moknives-store-child' ); ?>
		</span>

		<h2 class="mo-gear-product__title">
			<a href="<?php echo esc_url( $product_link ); ?>">
				<?php echo esc_html( $product->get_name() ); ?>
			</a>
		</h2>

		<?php if ( $product->get_short_description() ) : ?>
			<div class="mo-gear-product__excerpt">
				<?php echo wp_kses_post( wpautop( wp_trim_words( $product->get_short_description(), 18 ) ) ); ?>
			</div>
		<?php endif; ?>

		<div class="mo-gear-product__footer">
			<div class="mo-gear-product__price">
				<?php echo wp_kses_post( $product->get_price_html() ); ?>
			</div>

			<?php
			echo wp_kses_post(
				apply_filters(
					'woocommerce_loop_add_to_cart_link',
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
						esc_attr( isset( $args['class'] ) ? $args['class'] . ' mo-gear-product__button' : 'button mo-gear-product__button' ),
						isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
						esc_html( $product->add_to_cart_text() )
					),
					$product,
					$args
				)
			);
			?>
		</div>
	</div>
</li>