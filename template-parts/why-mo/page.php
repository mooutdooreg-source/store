<?php
/**
 * Why MO story page content.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story_sections = array(
	array(
		'title'      => 'My Journey Begins',
		'paragraphs' => array(
			'So I started sharpening. And then sharpening some more.',
			'From repeated use, I began understanding edges, angles, and the way a blade moves through material. Geometry came next — I adjusted grinds and profiles to match real tasks. Handles were redesigned for comfort, grip, and control.',
			'Every change came from experience, not theory.',
		),
	),
	array(
		'title'      => 'Learning the Science',
		'paragraphs' => array(
			'Before I could make my first proper knife, I realized I needed to understand why blades work.',
			'I dove into metallurgy — learning how steel behaves under heat and stress. I studied heat treatment, edge retention, and toughness. Every first knife was informed by this deep study, every decision deliberate.',
		),
	),
	array(
		'title'      => 'From Small Requests to Full-Time Bladesmith',
		'paragraphs' => array(
			'As I honed my craft, friends and enthusiasts began asking for knives. I made each one with care, building trust blade by blade.',
			'Over time, what started as a hobby turned into a full-time calling. Since 2015, I have been practicing as a full-time bladesmith — building knives around real requirements, not catalogue assumptions.',
		),
	),
	array(
		'title'      => 'ECC — From the Wild to the Kitchen',
		'paragraphs' => array(
			'The next chapter came through ECC, which I co-founded as Master Bladesmith and Designer.',
			'Here, my work reached the chefs and kitchens of the finest steakhouses and Japanese culinary environments. The same standards I applied outdoors — reliability, geometry, comfort — now had to meet the demands of professional culinary work.',
			'ECC was not the beginning. It was a proving ground — where my approach was tested at the highest level.',
		),
	),
);

$standard_points = array(
	'Tested in the field, proven by use',
	'Crafted with precise geometry and comfort in mind',
	'Heat-treated for performance and resilience',
	'Built for people who need knives they can actually trust',
);
?>

<section class="mo-why-page" aria-labelledby="mo-why-page-title">
	<div class="mo-why-page__inner">
		<header class="mo-why-page__header mo-why-story-hero">
			<p class="mo-why__kicker"><?php esc_html_e( 'Why MO / Story', 'moknives-store-child' ); ?></p>
			<h1 id="mo-why-page-title">
				<span><?php esc_html_e( 'Why MO', 'moknives-store-child' ); ?></span>
			</h1>
			<div class="mo-why-story-hero__copy">
				<p class="mo-why-story-hero__lead">
					<?php esc_html_e( 'It started with one simple truth: ordinary knives just couldn’t keep up with what I needed.', 'moknives-store-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'I was out in the wild — hunting, camping, by the sea, cooking over open fires — and the knives I had were frustrating. They dulled too quickly. Handles hurt my hands. Geometry didn’t make sense for the task.', 'moknives-store-child' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'I wanted knives I could actually rely on.', 'moknives-store-child' ); ?>
				</p>
			</div>
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

		<div class="mo-why-story" aria-label="<?php esc_attr_e( 'Why MO story chapters', 'moknives-store-child' ); ?>">
			<?php foreach ( $story_sections as $section ) : ?>
				<article class="mo-why-story-card">
					<h2><?php echo esc_html( $section['title'] ); ?></h2>
					<?php foreach ( $section['paragraphs'] as $paragraph ) : ?>
						<p><?php echo esc_html( $paragraph ); ?></p>
					<?php endforeach; ?>
				</article>
			<?php endforeach; ?>

			<article class="mo-why-story-card mo-why-story-card--standard">
				<h2><?php esc_html_e( 'The MO Standard Today', 'moknives-store-child' ); ?></h2>
				<p><?php esc_html_e( 'Now, every MO blade carries my story:', 'moknives-store-child' ); ?></p>
				<ul>
					<?php foreach ( $standard_points as $point ) : ?>
						<li><?php echo esc_html( $point ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p><?php esc_html_e( 'This site is your gateway to owning a MO blade without a special request or waiting list. We release limited numbered batches of each model, available for immediate delivery, so every blade is ready to perform from the moment it reaches your hand.', 'moknives-store-child' ); ?></p>
			</article>
		</div>

		<section class="mo-why-story-cta" aria-label="<?php esc_attr_e( 'Why MO next steps', 'moknives-store-child' ); ?>">
			<h2><?php esc_html_e( 'Field Tested. Chef Proven. Built by Mo.', 'moknives-store-child' ); ?></h2>
			<p><?php esc_html_e( 'Every blade tells the story of its making. No shortcuts. No empty claims. Only knives built to perform, from the wild to the table.', 'moknives-store-child' ); ?></p>
			<div class="mo-why-story-cta__links">
				<a class="mo-button mo-button--primary" href="<?php echo esc_url( home_url( '/#explore-lines' ) ); ?>">
					<?php esc_html_e( 'Limited batches live here → Explore the Lines', 'moknives-store-child' ); ?>
				</a>
				<a class="mo-button mo-button--ghost" href="https://moknives.art/" target="_blank" rel="noopener">
					<?php esc_html_e( 'One-of-one customs live at moknives.art', 'moknives-store-child' ); ?>
				</a>
			</div>
		</section>
	</div>
</section>
