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
 * Handle Shape the Next Batch preference submissions.
 */
function mo_store_submit_preference() {
	check_ajax_referer( 'mo_store_preference_nonce', 'nonce' );

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
		'ip'         => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
		'user_agent' => isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '',
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

	$entry = array(
		'name'             => $name,
		'email'            => $email,
		'country'          => $country,
		'line'             => $line,
		'preferred_design' => $preferred,
		'message'          => $message,
		'created'          => current_time( 'mysql' ),
		'ip'               => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
		'user_agent'       => isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '',
	);

	$entries   = get_option( 'mo_store_interest_entries', array() );
	$entries   = is_array( $entries ) ? $entries : array();
	$entries[] = $entry;

	update_option( 'mo_store_interest_entries', $entries, false );

	$line_messages = array(
		'TAKUMO'       => 'You are on the TAKUMO first access list.',
		'MATADOR'      => 'You are on the MATADOR first access list.',
		'PITMASTER'    => 'You are on the PITMASTER first access list.',
		'Not Sure Yet' => 'You are on the MO Store first access list.',
	);

	wp_send_json_success(
		array(
			'title'   => isset( $line_messages[ $line ] ) ? $line_messages[ $line ] : $line_messages['Not Sure Yet'],
			'message' => 'We will email you before the July release opens.',
		)
	);
}
add_action( 'wp_ajax_mo_store_submit_interest', 'mo_store_submit_interest' );
add_action( 'wp_ajax_nopriv_mo_store_submit_interest', 'mo_store_submit_interest' );