<?php
/**
 * Why MO proof page content.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$why_items = array(
	array(
		'kicker' => 'Field Foundation',
		'title'  => 'Before the forge, there was the field',
		'copy'   => 'Working under the name Mo since 2015, I built my foundation in the field first - where a knife had to be more than sharp; it had to be dependable.',
	),
	array(
		'kicker' => 'Field Standard',
		'title'  => 'Where the worlds meet',
		'copy'   => 'That same standard later found its way into the culinary world through co-founding ECC as Master Bladesmith and designer, creating for renowned chefs and some of the most exacting fine-dining, steakhouse, and Japanese culinary environments. Mo Knives exists where those worlds meet: raw durability, disciplined craftsmanship, and purpose without pretense.',
	),
	array(
		'kicker' => 'Craft Logic',
		'title'  => 'The logic of the blade',
		'copy'   => 'Thermal refinement is tuned for resilience, retention, and the task the blade is expected to survive. Numbers without context are theater. The meaningful question is whether hardness, toughness, and stability serve the knife\'s intended work.',
	),
	array(
		'kicker' => 'Geometry Decides',
		'title'  => 'Every line has to justify itself',
		'copy'   => 'From edge thickness to grind choice, every line has to justify itself in contact. A knife can be beautifully finished and still feel wrong in the cut. Geometry is what decides resistance, bite, food release, durability, and control.',
	),
	array(
		'kicker' => 'Performance Proof',
		'title'  => 'No theater. Only performance.',
		'copy'   => 'No cosmetic excess. No empty claims. Only honest construction that earns trust when the blade meets real resistance.',
	),
	array(
		'kicker' => 'Bench. Stone. Cut.',
		'title'  => 'Proof has to agree',
		'copy'   => 'Steel, heat treatment, and geometry only matter when performance confirms them. The bench, the stone, and the cut all have to agree before a theory earns trust.',
	),
	array(
		'kicker' => 'Process Proof',
		'title'  => 'Built in stages, proven in contact',
		'copy'   => 'Forging, grinding, heat treatment, sharpening, and testing are not decorative chapters. They are the controlled sequence that turns material into a dependable tool.',
	),
	array(
		'kicker' => 'Controlled Sequence',
		'title'  => 'Each stage supports the next',
		'copy'   => 'Each stage has to support the next: the profile must serve the hand, the grind must serve the cut, the heat treatment must serve the steel, and the final edge must serve real use.',
	),
	array(
		'kicker' => 'Details Earn Their Place',
		'title'  => 'Construction. Control. Proof.',
		'copy'   => 'The goal is not to make every blade feel dramatic. The goal is to make every detail earn its place through construction, control, and proof.',
	),
);
?>

<section class="mo-why-page" aria-labelledby="mo-why-page-title">
	<div class="mo-why-page__inner">
		<header class="mo-why-page__header">
			<p class="mo-why__kicker"><?php esc_html_e( 'Why MO / Proof', 'moknives-store-child' ); ?></p>
			<h1 id="mo-why-page-title">
				<span><?php esc_html_e( 'No Theater.', 'moknives-store-child' ); ?></span>
				<span class="mo-why__title-accent"><?php esc_html_e( 'Only performance', 'moknives-store-child' ); ?></span>
			</h1>
		</header>

		<div class="mo-why-video mo-why-page__video">
			<video
				src="<?php echo esc_url( mo_store_video_url( 'performance-proof.mp4' ) ); ?>"
				autoplay
				muted
				loop
				playsinline
				preload="metadata"
				aria-label="<?php esc_attr_e( 'Performance proof process video', 'moknives-store-child' ); ?>"
			></video>
		</div>

		<div class="mo-why__proof mo-why-page__proof" aria-label="<?php esc_attr_e( 'Why MO proof points', 'moknives-store-child' ); ?>">
			<?php foreach ( $why_items as $item ) : ?>
				<article class="mo-why-card">
					<span class="mo-why-card__number"><?php echo esc_html( $item['kicker'] ); ?></span>
					<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<p><?php echo esc_html( $item['copy'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
