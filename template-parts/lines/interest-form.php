<?php
/**
 * Unified Interest Form for line pages.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $line ) || ! is_array( $line ) ) {
	$line = mo_store_get_current_line_data();
}

if ( empty( $line ) || ! is_array( $line ) ) {
	return;
}

$line_options     = mo_store_get_interest_line_options();
$selected_line    = mo_store_line_slug_to_interest_label( $line['slug'] );
$interest_form_id = 'mo-interest-form-' . sanitize_html_class( $line['slug'] );
?>

<section class="mo-interest" aria-labelledby="<?php echo esc_attr( $interest_form_id ); ?>-title">
	<div class="mo-interest__inner">
		<div class="mo-interest__content">
			<p class="mo-interest__kicker">
				<?php echo esc_html( $line['name'] ); ?>
			</p>

			<h2 id="<?php echo esc_attr( $interest_form_id ); ?>-title">
				<?php esc_html_e( 'Join the First Release List', 'moknives-store-child' ); ?>
			</h2>

			<p>
				<?php esc_html_e( 'Register your interest for the first limited batches prepared for July.', 'moknives-store-child' ); ?>
			</p>

			<p class="mo-interest__note">
				<?php esc_html_e( 'No deposit required for the first run.', 'moknives-store-child' ); ?>
			</p>
		</div>

		<form class="mo-interest__form" data-mo-interest-form>
			<input type="hidden" name="action" value="mo_store_submit_interest">
			<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'mo_store_interest_nonce' ) ); ?>">

			<div class="mo-honeypot" aria-hidden="true">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-website">
					<?php esc_html_e( 'Website', 'moknives-store-child' ); ?>
				</label>
				<input
					id="<?php echo esc_attr( $interest_form_id ); ?>-website"
					type="text"
					name="mo_store_website"
					tabindex="-1"
					autocomplete="off"
				>
			</div>

			<div class="mo-field">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-name">
					<?php esc_html_e( 'Name', 'moknives-store-child' ); ?>
				</label>
				<input
					id="<?php echo esc_attr( $interest_form_id ); ?>-name"
					type="text"
					name="name"
					autocomplete="name"
					required
				>
			</div>

			<div class="mo-field">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-email">
					<?php esc_html_e( 'Email', 'moknives-store-child' ); ?>
				</label>
				<input
					id="<?php echo esc_attr( $interest_form_id ); ?>-email"
					type="email"
					name="email"
					autocomplete="email"
					required
				>
			</div>

			<div class="mo-field">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-country">
					<?php esc_html_e( 'Country', 'moknives-store-child' ); ?>
				</label>
				<input
					id="<?php echo esc_attr( $interest_form_id ); ?>-country"
					type="text"
					name="country"
					autocomplete="country-name"
					required
				>
			</div>

			<div class="mo-field">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-line">
					<?php esc_html_e( 'Line of Interest', 'moknives-store-child' ); ?>
				</label>
				<select id="<?php echo esc_attr( $interest_form_id ); ?>-line" name="line" required>
					<?php foreach ( $line_options as $option ) : ?>
						<option value="<?php echo esc_attr( $option ); ?>" <?php selected( $selected_line, $option ); ?>>
							<?php echo esc_html( $option ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="mo-field">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-preferred">
					<?php esc_html_e( 'Preferred design / use', 'moknives-store-child' ); ?>
				</label>
				<input
					id="<?php echo esc_attr( $interest_form_id ); ?>-preferred"
					type="text"
					name="preferred_design"
					placeholder="<?php esc_attr_e( 'Example: gyuto, brisket slicer, heavy butcher blade, serving set...', 'moknives-store-child' ); ?>"
					required
				>
			</div>

			<div class="mo-field mo-field--full">
				<label for="<?php echo esc_attr( $interest_form_id ); ?>-message">
					<?php esc_html_e( 'Message optional', 'moknives-store-child' ); ?>
				</label>
				<textarea
					id="<?php echo esc_attr( $interest_form_id ); ?>-message"
					name="message"
					rows="5"
				></textarea>
			</div>

			<button class="mo-button mo-button--primary mo-interest__submit" type="submit">
				<?php esc_html_e( 'Join the List', 'moknives-store-child' ); ?>
			</button>

			<div class="mo-form-message" data-mo-interest-message aria-live="polite"></div>
		</form>
	</div>
</section>
