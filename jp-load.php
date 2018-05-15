<?php
/**
 * Bootstrap file for setting the ABSPATH constant
 * and loading the jp-config.php file. The jp-config.php
 * file will then load the jp-settings.php file, which
 * will then set up the JonPress environment.
 *
 * If the jp-config.php file is not found then an error
 * will be displayed asking the visitor to set up the
 * jp-config.php file.
 *
 * Will also search for jp-config.php in JonPress' parent
 * directory to allow the JonPress directory to remain
 * untouched.
 *
 * @package JonPress
 */

/** Define ABSPATH as this file's directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

/*
 * If jp-config.php exists in the JonPress root, or if it exists in the root and jp-settings.php
 * doesn't, load jp-config.php. The secondary check for jp-settings.php has the added benefit
 * of avoiding cases where the current directory is a nested installation, e.g. / is JonPress(a)
 * and /blog/ is JonPress(b).
 *
 * If neither set of conditions is true, initiate loading the setup process.
 */
if ( file_exists( ABSPATH . 'jp-config.php' ) ) {

	/** The config file resides in ABSPATH */
	require_once( ABSPATH . 'jp-config.php' );

} elseif ( @file_exists( dirname( ABSPATH ) . '/jp-config.php' ) && ! @file_exists( dirname( ABSPATH ) . '/jp-settings.php' ) ) {

	/** The config file resides one level above ABSPATH but is not part of another installation */
	require_once( dirname( ABSPATH ) . '/jp-config.php' );

} else {

	// A config file doesn't exist

	define( 'WPINC', 'jp-includes' );
	require_once( ABSPATH . WPINC . '/load.php' );

	// Standardize $_SERVER variables across setups.
	jp_fix_server_vars();

	require_once( ABSPATH . WPINC . '/functions.php' );

	$path = jp_guess_url() . '/jp-admin/setup-config.php';

	/*
	 * We're going to redirect to setup-config.php. While this shouldn't result
	 * in an infinite loop, that's a silly thing to assume, don't you think? If
	 * we're traveling in circles, our last-ditch effort is "Need more help?"
	 */
	if ( false === strpos( $_SERVER['REQUEST_URI'], 'setup-config' ) ) {
		header( 'Location: ' . $path );
		exit;
	}

	define( 'JP_CONTENT_DIR', ABSPATH . 'jp-content' );
	require_once( ABSPATH . WPINC . '/version.php' );

	jp_check_php_mysql_versions();
	jp_load_translations_early();

	// Die with an error message
	$die = sprintf(
		/* translators: %s: jp-config.php */
		__( "There doesn't seem to be a %s file. I need this before we can get started." ),
		'<code>jp-config.php</code>'
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: Codex URL */
		__( "Need more help? <a href='%s'>We got it</a>." ),
		__( 'https://codex.jonpress.org/Editing_jp-config.php' )
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: jp-config.php */
		__( "You can create a %s file through a web interface, but this doesn't work for all server setups. The safest way is to manually create the file." ),
		'<code>jp-config.php</code>'
	) . '</p>';
	$die .= '<p><a href="' . $path . '" class="button button-large">' . __( 'Create a Configuration File' ) . '</a>';

	jp_die( $die, __( 'JonPress &rsaquo; Error' ) );
}
