<?php
/**
 * Add Link Administration Screen.
 *
 * @package JonPress
 * @subpackage Administration
 */

/** Load JonPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

if ( ! current_user_can( 'manage_links' ) ) {
	jp_die( __( 'Sorry, you are not allowed to add links to this site.' ) );
}

$title       = __( 'Add New Link' );
$parent_file = 'link-manager.php';

jp_reset_vars( array( 'action', 'cat_id', 'link_id' ) );

jp_enqueue_script( 'link' );
jp_enqueue_script( 'xfn' );

if ( jp_is_mobile() ) {
	jp_enqueue_script( 'jquery-touch-punch' );
}

$link = get_default_link_to_edit();
include( ABSPATH . 'jp-admin/edit-link-form.php' );

require( ABSPATH . 'jp-admin/admin-footer.php' );
