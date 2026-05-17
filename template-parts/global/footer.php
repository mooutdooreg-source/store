<?php
/**
 * Minimal MO Store footer.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$social_links = apply_filters(
	'mo_store_social_links',
	array(
		'instagram' => array(
			'label' => 'Instagram',
			'url'   => '',
			'icon'  => 'instagram',
			'image' => mo_store_image_url( 'social-instagram.png' ),
		),
		'facebook'  => array(
			'label' => 'Facebook',
			'url'   => '',
			'icon'  => 'facebook',
			'image' => mo_store_image_url( 'social-facebook.png' ),
		),
		'tiktok'    => array(
			'label' => 'TikTok',
			'url'   => '',
			'icon'  => 'tiktok',
			'image' => mo_store_image_url( 'social-tiktok.png' ),
		),
		'snapchat'  => array(
			'label' => 'Snapchat',
			'url'   => '',
			'icon'  => 'snapchat',
			'image' => mo_store_image_url( 'social-snapchat.png' ),
		),
		'youtube'   => array(
			'label' => 'YouTube',
			'url'   => '',
			'icon'  => 'youtube',
			'image' => mo_store_image_url( 'social-youtube.png' ),
		),
	)
);

$social_links = array_filter(
	$social_links,
	function ( $social ) {
		return is_array( $social ) && ! empty( $social['url'] );
	}
);
?>

<footer class="mo-footer">
	<div class="mo-footer__inner">
		<a class="mo-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'MO Store homepage', 'moknives-store-child' ); ?>">
			<img
				src="<?php echo esc_url( mo_store_logo_url() ); ?>"
				alt="<?php esc_attr_e( 'MO Store', 'moknives-store-child' ); ?>"
				width="104"
				height="44"
				loading="lazy"
				decoding="async"
			/>
		</a>

		<?php if ( ! empty( $social_links ) ) : ?>
			<div class="mo-footer__socials" aria-label="<?php esc_attr_e( 'MO Store social links', 'moknives-store-child' ); ?>">
				<?php foreach ( $social_links as $network => $social ) : ?>
					<?php
					$social_image = ! empty( $social['image'] ) ? $social['image'] : '';
					$social_icon  = ! empty( $social['icon'] ) ? $social['icon'] : $network;
					?>
					<a
						class="mo-footer__social"
						href="<?php echo esc_url( $social['url'] ); ?>"
						aria-label="<?php echo esc_attr( mo_store_social_aria_label( $social['label'] ) ); ?>"
					>
						<?php if ( ! empty( $social_image ) ) : ?>
							<img
								src="<?php echo esc_url( $social_image ); ?>"
								alt=""
								width="74"
								height="74"
								loading="lazy"
								decoding="async"
							/>
						<?php else : ?>
							<?php mo_store_icon( $social_icon ); ?>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</footer>
