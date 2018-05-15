<?php
/**
 * Install theme network administration panel.
 *
 * @package JonPress
 * @subpackage Multisite
 * @since 3.1.0
 */

if ( isset( $_GET['tab'] ) && ( 'theme-information' == $_GET['tab'] ) ) {
	define( 'IFRAME_REQUEST', true );
}

/** Load JonPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

require( ABSPATH . 'jp-admin/theme-install.php' );
