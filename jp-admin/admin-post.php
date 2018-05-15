<?php
/**
 * JonPress Generic Request (POST/GET) Handler
 *
 * Intended for form submission handling in themes and plugins.
 *
 * @package JonPress
 * @subpackage Administration
 */

/** We are located in JonPress Administration Screens */
if ( ! defined( 'JP_ADMIN' ) ) {
	define( 'JP_ADMIN', true );
}

if ( defined( 'ABSPATH' ) ) {
	require_once( ABSPATH . 'jp-load.php' );
} else {
	require_once( dirname( dirname( __FILE__ ) ) . '/jp-load.php' );
}

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

require_once( ABSPATH . 'jp-admin/includes/admin.php' );

nocache_headers();

/** This action is documented in jp-admin/admin.php */
do_action( 'admin_init' );

$action = empty( $_REQUEST['action'] ) ? '' : $_REQUEST['action'];

if ( ! jp_validate_auth_cookie() ) {
	if ( empty( $action ) ) {
		/**
		 * Fires on a non-authenticated admin post request where no action was supplied.
		 *
		 * @since 2.6.0
		 */
		do_action( 'admin_post_nopriv' );
	} else {
		/**
		 * Fires on a non-authenticated admin post request for the given action.
		 *
		 * The dynamic portion of the hook name, `$action`, refers to the given
		 * request action.
		 *
		 * @since 2.6.0
		 */
		do_action( "admin_post_nopriv_{$action}" );
	}
} else {
	if ( empty( $action ) ) {
		/**
		 * Fires on an authenticated admin post request where no action was supplied.
		 *
		 * @since 2.6.0
		 */
		do_action( 'admin_post' );
	} else {
		/**
		 * Fires on an authenticated admin post request for the given action.
		 *
		 * The dynamic portion of the hook name, `$action`, refers to the given
		 * request action.
		 *
		 * @since 2.6.0
		 */
		do_action( "admin_post_{$action}" );
	}
}
