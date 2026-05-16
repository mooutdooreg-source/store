<?php
/**
 * Lightweight AJAX handlers for MO Store preference and interest forms.
 *
 * @package MoknivesStoreChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a sanitized text field from POST.
 *
 * @param string $key POST key.
 * @return string
 */
function mo_store_get_post_text( $key ) {
	if ( ! isset( $_POST[ $key ] ) ) {
		return '';
	}

	return sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
}

/**
 * Return a sanitized textarea field from POST.
 *
 * @param string $key POST key.
 * @return string
 */
function mo_store_get_post_textarea( $key ) {
	if ( ! isset( $_POST[ $key ] ) ) {
		return '';
	}

	return sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) );
}

/**
 * Return the current request IP in a sanitized form.
 *
 * @return string
 */
function mo_store_get_request_ip() {
	return isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
}

/**
 * Return the current request user agent in a sanitized form.
 *
 * @return string
 */
function mo_store_get_request_user_agent() {
	return isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
}

/**
 * Check whether the hidden anti-spam field was filled.
 *
 * @return bool
 */
function mo_store_is_honeypot_filled() {
	return '' !== mo_store_get_post_text( 'mo_store_website' );
}

/**
 * Send a generic success response for spam traps.
 */
function mo_store_send_silent_success() {
	wp_send_json_success(
		array(
			'title'   => esc_html__( 'Thanks - your request has been received.', 'moknives-store-child' ),
			'message' => esc_html__( 'We will review it shortly.', 'moknives-store-child' ),
		)
	);
}

/**
 * Rate-limit public form submissions per IP and browser.
 *
 * @param string $scope  Form scope.
 * @param int    $limit  Allowed submissions in the window.
 * @param int    $window Window length in seconds.
 * @return bool
 */
function mo_store_rate_limit_exceeded( $scope, $limit, $window ) {
	$key_source = mo_store_get_request_ip() . '|' . mo_store_get_request_user_agent();
	$key        = 'mo_store_' . sanitize_key( $scope ) . '_' . md5( $key_source );
	$count      = (int) get_transient( $key );

	if ( $count >= $limit ) {
		return true;
	}

	set_transient( $key, $count + 1, $window );

	return false;
}

/**
 * Handle Shape the Next Batch preference submissions.
 */
function mo_store_submit_preference() {
	check_ajax_referer( 'mo_store_preference_nonce', 'nonce' );

	if ( mo_store_is_honeypot_filled() ) {
		mo_store_send_silent_success();
	}

	if ( mo_store_rate_limit_exceeded( 'preference', 6, HOUR_IN_SECONDS ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please wait before submitting another preference.', 'moknives-store-child' ),
			),
			429
		);
	}

	$preference = mo_store_get_post_text( 'preference' );
	$options    = mo_store_get_batch_preference_options();
	$allowed    = wp_list_pluck( $options, 'id' );

	if ( empty( $preference ) || ! in_array( $preference, $allowed, true ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please choose a direction before submitting.', 'moknives-store-child' ),
			),
			400
		);
	}

	$entry = array(
		'preference' => $preference,
		'source'     => 'Shape the Next Batch',
		'created'    => current_time( 'mysql' ),
		'ip'         => mo_store_get_request_ip(),
		'user_agent' => mo_store_get_request_user_agent(),
	);

	$entries   = get_option( 'mo_store_batch_preferences', array() );
	$entries   = is_array( $entries ) ? $entries : array();
	$entries[] = $entry;

	update_option( 'mo_store_batch_preferences', $entries, false );

	wp_send_json_success(
		array(
			'title'   => 'Thanks — your preference has been noted.',
			'message' => 'It will help shape future MO Store batches.',
		)
	);
}
add_action( 'wp_ajax_mo_store_submit_preference', 'mo_store_submit_preference' );
add_action( 'wp_ajax_nopriv_mo_store_submit_preference', 'mo_store_submit_preference' );

/**
 * Handle Join the First Release List interest form submissions.
 */
function mo_store_submit_interest() {
	check_ajax_referer( 'mo_store_interest_nonce', 'nonce' );

	if ( mo_store_is_honeypot_filled() ) {
		mo_store_send_silent_success();
	}

	if ( mo_store_rate_limit_exceeded( 'interest', 4, HOUR_IN_SECONDS ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please wait before submitting another interest request.', 'moknives-store-child' ),
			),
			429
		);
	}

	$name       = mo_store_get_post_text( 'name' );
	$email      = sanitize_email( mo_store_get_post_text( 'email' ) );
	$country    = mo_store_get_post_text( 'country' );
	$line       = mo_store_get_post_text( 'line' );
	$preferred  = mo_store_get_post_text( 'preferred_design' );
	$message    = mo_store_get_post_textarea( 'message' );
	$line_items = mo_store_get_interest_line_options();

	if ( empty( $name ) || empty( $email ) || empty( $country ) || empty( $line ) || empty( $preferred ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please complete all required fields before joining the list.', 'moknives-store-child' ),
			),
			400
		);
	}

	if ( ! is_email( $email ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please enter a valid email address.', 'moknives-store-child' ),
			),
			400
		);
	}

	if ( ! in_array( $line, $line_items, true ) ) {
		wp_send_json_error(
			array(
				'message' => esc_html__( 'Please choose a valid line of interest.', 'moknives-store-child' ),
			),
			400
		);
	}

	$line_messages = array(
		'TAKUMO'       => 'You are on the TAKUMO first access list.',
		'MATADOR'      => 'You are on the MATADOR first access list.',
		'PITMASTER'    => 'You are on the PITMASTER first access list.',
		'Not Sure Yet' => 'You are on the MO Store first access list.',
	);

	$entries = get_option( 'mo_store_interest_entries', array() );
	$entries = is_array( $entries ) ? $entries : array();

	foreach ( $entries as $existing_entry ) {
		$existing_email = isset( $existing_entry['email'] ) ? strtolower( (string) $existing_entry['email'] ) : '';
		$existing_line  = isset( $existing_entry['line'] ) ? (string) $existing_entry['line'] : '';

		if ( strtolower( $email ) === $existing_email && $line === $existing_line ) {
			wp_send_json_success(
				array(
					'title'   => isset( $line_messages[ $line ] ) ? $line_messages[ $line ] : $line_messages['Not Sure Yet'],
					'message' => esc_html__( 'You are already on this first access list.', 'moknives-store-child' ),
				)
			);
		}
	}

	$entry = array(
		'name'             => $name,
		'email'            => $email,
		'country'          => $country,
		'line'             => $line,
		'preferred_design' => $preferred,
		'message'          => $message,
		'created'          => current_time( 'mysql' ),
		'ip'               => mo_store_get_request_ip(),
		'user_agent'       => mo_store_get_request_user_agent(),
	);

	$entries[] = $entry;

	update_option( 'mo_store_interest_entries', $entries, false );

	wp_send_json_success(
		array(
			'title'   => isset( $line_messages[ $line ] ) ? $line_messages[ $line ] : $line_messages['Not Sure Yet'],
			'message' => 'We will email you before the July release opens.',
		)
	);
}
add_action( 'wp_ajax_mo_store_submit_interest', 'mo_store_submit_interest' );
add_action( 'wp_ajax_nopriv_mo_store_submit_interest', 'mo_store_submit_interest' );
