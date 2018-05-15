<?php
/**
 * Loads the JonPress environment and template.
 *
 * @package JonPress
 */

if ( ! isset( $jp_did_header ) ) {

	$jp_did_header = true;

	// Load the JonPress library.
	require_once( dirname( __FILE__ ) . '/jp-load.php' );

	// Set up the JonPress query.
	wp();

	// Load the theme template.
	require_once( ABSPATH . WPINC . '/template-loader.php' );

}
