<?php
/**
 * Shape the Next Batch section.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = mo_store_get_batch_preference_options();
?>

<section class="mo-batch" id="shape-next-batch" aria-labelledby="mo-batch-title">
	<div class="mo-batch__inner">
		<div class="mo-section-heading mo-batch__heading">
			<h2 id="mo-batch-title"><?php esc_html_e( 'Shape the Next Batch', 'moknives-store-child' ); ?></h2>

			<p class="mo-batch__subtitle">
				<?php esc_html_e( 'Tell us what direction you want to see in a future MO Store release.', 'moknives-store-child' ); ?>
			</p>

			<p class="mo-batch__model">
				<?php esc_html_e( 'MO Store releases are built as focused limited batches — each line shaped around a defined use, cutting purpose, and MO standard.', 'moknives-store-child' ); ?>
			</p>
		</div>

		<form class="mo-batch__form" data-mo-preference-form>
			<div class="mo-batch__intro">
				<p class="mo-batch__question">
					<?php esc_html_e( 'What would you like to see in the next MO Store batch?', 'moknives-store-child' ); ?>
				</p>

				<p class="mo-batch__choose">
					<?php esc_html_e( 'Choose a direction:', 'moknives-store-child' ); ?>
				</p>
			</div>

			<input type="hidden" name="action" value="mo_store_submit_preference">
			<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'mo_store_preference_nonce' ) ); ?>">
			<input type="hidden" name="preference" value="" data-mo-preference-value>

			<div class="mo-honeypot" aria-hidden="true">
				<label for="mo-preference-website">
					<?php esc_html_e( 'Website', 'moknives-store-child' ); ?>
				</label>
				<input id="mo-preference-website" type="text" name="mo_store_website" tabindex="-1" autocomplete="off">
			</div>

			<div class="mo-batch__options" role="listbox" aria-label="<?php esc_attr_e( 'Choose a direction', 'moknives-store-child' ); ?>">
				<?php foreach ( $options as $option ) : ?>
					<button
						class="mo-batch-option"
						type="button"
						role="option"
						aria-selected="false"
						data-mo-preference-option
						data-value="<?php echo esc_attr( $option['id'] ); ?>"
					>
						<span class="mo-batch-option__icon">
							<?php mo_store_icon( $option['icon'] ); ?>
						</span>

						<span class="mo-batch-option__label">
							<?php echo esc_html( $option['label'] ); ?>
						</span>

						<span class="mo-batch-option__description">
							<?php echo esc_html( $option['description'] ); ?>
						</span>

						<span class="mo-batch-option__check" aria-hidden="true">
							<?php mo_store_icon( 'check' ); ?>
						</span>
					</button>
				<?php endforeach; ?>
			</div>

			<p class="mo-batch__note">
				<?php esc_html_e( 'This helps guide future MO Store batches.', 'moknives-store-child' ); ?>
			</p>

			<button class="mo-button mo-button--primary mo-batch__submit" type="submit" disabled data-mo-preference-submit>
				<?php esc_html_e( 'Submit Your Preference', 'moknives-store-child' ); ?>
			</button>

			<div class="mo-form-message" data-mo-preference-message aria-live="polite"></div>
		</form>
	</div>
</section>
