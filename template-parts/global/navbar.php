<?php
/**
 * Global MO Store navbar.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$home_url = home_url( '/' );
?>

<header class="mo-navbar" data-mo-navbar>
	<div class="mo-navbar__inner">
		<a class="mo-navbar__logo" href="<?php echo esc_url( $home_url ); ?>" aria-label="<?php esc_attr_e( 'MO Store homepage', 'moknives-store-child' ); ?>">
			<img
				src="<?php echo esc_url( mo_store_logo_url() ); ?>"
				alt="<?php esc_attr_e( 'MO Store', 'moknives-store-child' ); ?>"
				width="96"
				height="40"
				loading="eager"
				decoding="async"
			/>
		</a>

		<nav class="mo-navbar__nav" aria-label="<?php esc_attr_e( 'MO Store primary navigation', 'moknives-store-child' ); ?>">
			<a class="mo-navbar__link" href="<?php echo esc_url( $home_url . '#explore-lines' ); ?>">
				<?php esc_html_e( 'Lines', 'moknives-store-child' ); ?>
			</a>
			<a class="mo-navbar__link" href="<?php echo esc_url( $home_url . '#shape-next-batch' ); ?>">
				<?php esc_html_e( 'About Store', 'moknives-store-child' ); ?>
			</a>
			<a class="mo-navbar__link" href="<?php echo esc_url( $home_url . '#mo-store-standard' ); ?>">
				<?php esc_html_e( 'Craft', 'moknives-store-child' ); ?>
			</a>
			<a class="mo-navbar__link" href="<?php echo esc_url( home_url( '/mo-gear/' ) ); ?>">
				<?php esc_html_e( 'MO Gear', 'moknives-store-child' ); ?>
			</a>
		</nav>

		<button
			class="mo-navbar__toggle"
			type="button"
			aria-label="<?php esc_attr_e( 'Open MO Store menu', 'moknives-store-child' ); ?>"
			aria-expanded="false"
			aria-controls="mo-mobile-menu"
			data-mo-menu-toggle
		>
			<span class="mo-navbar__toggle-line"></span>
			<span class="mo-navbar__toggle-line"></span>
		</button>
	</div>

	<div class="mo-mobile-menu" id="mo-mobile-menu" data-mo-mobile-menu hidden>
		<div class="mo-mobile-menu__panel">
			<a class="mo-mobile-menu__link" href="<?php echo esc_url( $home_url . '#explore-lines' ); ?>">
				<span>01</span>
				<?php esc_html_e( 'Lines', 'moknives-store-child' ); ?>
			</a>
			<a class="mo-mobile-menu__link" href="<?php echo esc_url( $home_url . '#shape-next-batch' ); ?>">
				<span>02</span>
				<?php esc_html_e( 'About Store', 'moknives-store-child' ); ?>
			</a>
			<a class="mo-mobile-menu__link" href="<?php echo esc_url( $home_url . '#mo-store-standard' ); ?>">
				<span>03</span>
				<?php esc_html_e( 'Craft', 'moknives-store-child' ); ?>
			</a>
			<a class="mo-mobile-menu__link" href="<?php echo esc_url( home_url( '/mo-gear/' ) ); ?>">
				<span>04</span>
				<?php esc_html_e( 'MO Gear', 'moknives-store-child' ); ?>
			</a>
		</div>
	</div>
</header>