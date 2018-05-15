<?php
/**
 * Front to the JonPress application. This file doesn't do anything, but loads
 * jp-blog-header.php which does and tells JonPress to load the theme.
 *
 * @package JonPress
 */

/**
 * Tells JonPress to load the JonPress theme and output it.
 *
 * @var bool
 */
define( 'JP_USE_THEMES', true );

/** Loads the JonPress Environment and Template */
require( dirname( __FILE__ ) . '/jp-blog-header.php' );
