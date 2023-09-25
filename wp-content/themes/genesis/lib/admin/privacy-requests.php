<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Admin
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/genesis/
 */

add_filter( 'wp_privacy_personal_data_erasers', 'genesis_privacy_personal_data_erasers' );
/**
 * Registers personal data eraser callbacks.
 *
 * @since 2.7.0
 *
 * @param array $erasers Existing data erasers.
 * @return array Updated data erasers.
 */
function genesis_privacy_personal_data_erasers( array $erasers ) {

	$erasers['genesis_author_archives'] = array(
		'eraser_friendly_name' => __( 'Genesis Author Archive Data', 'genesis' ),
		'callback'             => 'genesis_erase_author_archive_info',
	);

	$erasers['genesis_update_email_address'] = array(
		'eraser_friendly_name' => __( 'Update Notification Email Address', 'genesis' ),
		'callback'             => 'genesis_erase_update_notification_email_address',
	);

	return $erasers;
}

/**
 * Erases Author Archive Settings data saved in user meta.
 *
 * @since 2.7.0
 *
 * @param string $email_address The user's email address.
 *
 * @return array
 */
function genesis_erase_author_archive_info( $email_address ) {

	$response = array(
		'items_removed'  => false,
		'items_retained' => false,
		'messages'       => array(),
		'done'           => true,
	);

	if ( empty( $email_address ) ) {
		return $response;
	}

	$user = get_user_by( 'email', $email_address );

	if ( empty( $user ) ) {
		return $response;
	}

	foreach ( genesis_get_author_archive_fields() as $key => $name ) {

		if ( '' === get_user_meta( $user->ID, $key, true ) ) {
			continue;
		}

		if ( delete_user_meta( $user->ID, $key ) ) {
			$response['items_removed'] = true;
			$response['messages'][]    = $name;
		} else {
			/* translators: %s: One of Custom Archive Headline, Custom Description Text, Custom Document Title, Meta Description, Meta Keywords */
			$response['messages'][]     = sprintf( __( 'Your %s data was unable to be removed at this time.', 'genesis' ), $name );
			$response['items_retained'] = true;
		}
	}

	return $response;
}

/**
 * Erases the Update Notification email address if it matches the given email address.
 *
 * @since 2.7.0
 *
 * @param string $email_address The user's email address.
 *
 * @return array
 */
function genesis_erase_update_notification_email_address( $email_address ) {
	$response = array(
		'items_removed'  => false,
		'items_retained' => false,
		'messages'       => array(),
		'done'           => true,
	);

	if ( strtolower( genesis_get_option( 'update_email_address' ) ) === strtolower( $email_address ) ) {
		genesis_update_settings( array( 'update_email_address' => 'unset' ) );
		$response['items_removed'] = true;
		$response['messages'][]    = __( 'Update Notification Email Address removed.', 'genesis' );
	}

	return $response;
}


add_filter( 'wp_privacy_personal_data_exporters', 'genesis_privacy_personal_data_exporters' );
/**
 * Registers personal data exporter callbacks.
 *
 * @since 2.7.0
 *
 * @param array $exporters Existing data exporters.
 *
 * @return array Updated data exporters.
 */
function genesis_privacy_personal_data_exporters( array $exporters ) {
	$exporters['genesis_author_archives'] = array(
		'exporter_friendly_name' => __( 'Genesis Author Archive Data', 'genesis' ),
		'callback'               => 'genesis_export_author_archive_info',
	);

	return $exporters;
}

/**
 * Exports Author Archive Settings data saved in user meta.
 *
 * @since 2.7.0
 *
 * @param string $email_address The user's email address.
 *
 * @return array
 */
function genesis_export_author_archive_info( $email_address ) {

	$export_data = array();

	if ( empty( $email_address ) ) {
		return $export_data;
	}

	$user = get_user_by( 'email', $email_address );

	if ( empty( $user ) ) {
		return $export_data;
	}

	foreach ( genesis_get_author_archive_fields() as $key => $name ) {
		$user_meta_export = array();

		$export_value = get_user_meta( $user->ID, $key, true );

		if ( empty( $export_value ) ) {
			continue;
		}

		$user_meta_export[] = array(
			'name'  => $name,
			'value' => $export_value,
		);

		$export_data[] = array(
			'group_id'    => 'genesis_author_archive_info',
			'group_label' => __( 'Genesis Author Archive Data', 'genesis' ),
			'item_id'     => "user-{$user->ID}",
			'data'        => $user_meta_export,
		);
	}

	return array(
		'data' => $export_data,
		'done' => true,
	);
}

/**
 * Returns an array of Author Archive fields.
 *
 * @since 2.7.0
 *
 * @return array
 */
function genesis_get_author_archive_fields() {
	return array(
		'headline'         => __( 'Custom Archive Headline', 'genesis' ),
		'intro_text'       => __( 'Custom Description Text', 'genesis' ),
		'doctitle'         => __( 'Custom Document Title', 'genesis' ),
		'meta_description' => __( 'Meta Description', 'genesis' ),
		'meta_keywords'    => __( 'Meta Keywords', 'genesis' ),
	);
}
