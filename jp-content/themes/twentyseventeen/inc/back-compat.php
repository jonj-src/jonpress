<?php
/**
 * Twenty Seventeen back compat functionality
 *
 * Prevents Twenty Seventeen from running on JonPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package JonPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Prevent switching to Twenty Seventeen on old versions of JonPress.
 *
 * Switches to the default theme.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_switch_theme() {
	switch_theme( JP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'twentyseventeen_upgrade_notice' );
}
add_action( 'after_switch_theme', 'twentyseventeen_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Twenty Seventeen on JonPress versions prior to 4.7.
 *
 * @since Twenty Seventeen 1.0
 *
 * @global string $jp_version JonPress version.
 */
function twentyseventeen_upgrade_notice() {
	$message = sprintf( __( 'Twenty Seventeen requires at least JonPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentyseventeen' ), $GLOBALS['jp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on JonPress versions prior to 4.7.
 *
 * @since Twenty Seventeen 1.0
 *
 * @global string $jp_version JonPress version.
 */
function twentyseventeen_customize() {
	jp_die(
		sprintf( __( 'Twenty Seventeen requires at least JonPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentyseventeen' ), $GLOBALS['jp_version'] ), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'twentyseventeen_customize' );

/**
 * Prevents the Theme Preview from being loaded on JonPress versions prior to 4.7.
 *
 * @since Twenty Seventeen 1.0
 *
 * @global string $jp_version JonPress version.
 */
function twentyseventeen_preview() {
	if ( isset( $_GET['preview'] ) ) {
		jp_die( sprintf( __( 'Twenty Seventeen requires at least JonPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentyseventeen' ), $GLOBALS['jp_version'] ) );
	}
}
add_action( 'template_redirect', 'twentyseventeen_preview' );
