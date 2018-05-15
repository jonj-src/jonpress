<?php
/**
 * Multisite sites administration panel.
 *
 * @package JonPress
 * @subpackage Multisite
 * @since 3.0.0
 */

require_once( dirname( __FILE__ ) . '/admin.php' );

jp_redirect( network_admin_url( 'sites.php' ) );
exit;
