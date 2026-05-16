<?php
/**
 * Front page template for moknives.store.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

mo_store_get_template_part( 'global/navbar' );
?>

<main id="primary" class="mo-store-main mo-store-main--home">
	<?php
	mo_store_get_template_part( 'home/hero-slideshow' );
	mo_store_get_template_part( 'home/standard-bar' );
	mo_store_get_template_part( 'home/explore-lines' );
	mo_store_get_template_part( 'home/shape-next-batch' );
	?>
</main>

<?php
mo_store_get_template_part( 'global/footer' );

get_footer();