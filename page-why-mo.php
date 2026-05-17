<?php
/**
 * Why MO page template.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

mo_store_get_template_part( 'global/navbar' );
?>

<main id="primary" class="mo-store-main mo-store-main--why-mo">
	<?php mo_store_get_template_part( 'why-mo/page' ); ?>
</main>

<?php
mo_store_get_template_part( 'global/footer' );

get_footer();
