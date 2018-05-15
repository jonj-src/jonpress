<?php
/**
 * Feed API
 *
 * @package JonPress
 * @subpackage Feed
 */

_deprecated_file( basename( __FILE__ ), '4.7.0', 'fetch_feed()' );

if ( ! class_exists( 'SimplePie', false ) ) {
	require_once( ABSPATH . WPINC . '/class-simplepie.php' );
}

require_once( ABSPATH . WPINC . '/class-jp-feed-cache.php' );
require_once( ABSPATH . WPINC . '/class-jp-feed-cache-transient.php' );
require_once( ABSPATH . WPINC . '/class-jp-simplepie-file.php' );
require_once( ABSPATH . WPINC . '/class-jp-simplepie-sanitize-kses.php' );
