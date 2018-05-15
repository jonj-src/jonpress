<?php
/**
 * Used to set up and fix common variables and include
 * the JonPress procedural and class library.
 *
 * Allows for some configuration in jp-config.php (see default-constants.php)
 *
 * @package JonPress
 */

/**
 * Stores the location of the JonPress directory of functions, classes, and core content.
 *
 * @since 1.0.0
 */
define( 'WPINC', 'jp-includes' );

// Include files required for initialization.
require( ABSPATH . WPINC . '/load.php' );
require( ABSPATH . WPINC . '/default-constants.php' );
require_once( ABSPATH . WPINC . '/plugin.php' );

/*
 * These can't be directly globalized in version.php. When updating,
 * we're including version.php from another installation and don't want
 * these values to be overridden if already set.
 */
global $jp_version, $jp_db_version, $tinymce_version, $required_php_version, $required_mysql_version, $jp_local_package;
require( ABSPATH . WPINC . '/version.php' );

/**
 * If not already configured, `$blog_id` will default to 1 in a single site
 * configuration. In multisite, it will be overridden by default in ms-settings.php.
 *
 * @global int $blog_id
 * @since 2.0.0
 */
global $blog_id;

// Set initial default constants including JP_MEMORY_LIMIT, JP_MAX_MEMORY_LIMIT, JP_DEBUG, SCRIPT_DEBUG, JP_CONTENT_DIR and JP_CACHE.
jp_initial_constants();

// Check for the required PHP version and for the MySQL extension or a database drop-in.
jp_check_php_mysql_versions();

// Disable magic quotes at runtime. Magic quotes are added using wpdb later in jp-settings.php.
@ini_set( 'magic_quotes_runtime', 0 );
@ini_set( 'magic_quotes_sybase', 0 );

// JonPress calculates offsets from UTC.
date_default_timezone_set( 'UTC' );

// Turn register_globals off.
jp_unregister_GLOBALS();

// Standardize $_SERVER variables across setups.
jp_fix_server_vars();

// Check if we have received a request due to missing favicon.ico
jp_favicon_request();

// Check if we're in maintenance mode.
jp_maintenance();

// Start loading timer.
timer_start();

// Check if we're in JP_DEBUG mode.
jp_debug_mode();

/**
 * Filters whether to enable loading of the advanced-cache.php drop-in.
 *
 * This filter runs before it can be used by plugins. It is designed for non-web
 * run-times. If false is returned, advanced-cache.php will never be loaded.
 *
 * @since 4.6.0
 *
 * @param bool $enable_advanced_cache Whether to enable loading advanced-cache.php (if present).
 *                                    Default true.
 */
if ( JP_CACHE && apply_filters( 'enable_loading_advanced_cache_dropin', true ) ) {
	// For an advanced caching plugin to use. Uses a static drop-in because you would only want one.
	JP_DEBUG ? include( JP_CONTENT_DIR . '/advanced-cache.php' ) : @include( JP_CONTENT_DIR . '/advanced-cache.php' );

	// Re-initialize any hooks added manually by advanced-cache.php
	if ( $jp_filter ) {
		$jp_filter = JP_Hook::build_preinitialized_hooks( $jp_filter );
	}
}

// Define JP_LANG_DIR if not set.
jp_set_lang_dir();

// Load early JonPress files.
require( ABSPATH . WPINC . '/compat.php' );
require( ABSPATH . WPINC . '/class-jp-list-util.php' );
require( ABSPATH . WPINC . '/formatting.php' );
require( ABSPATH . WPINC . '/meta.php' );
require( ABSPATH . WPINC . '/functions.php' );
require( ABSPATH . WPINC . '/class-jp-meta-query.php' );
require( ABSPATH . WPINC . '/class-jp-matchesmapregex.php' );
require( ABSPATH . WPINC . '/class-jp.php' );
require( ABSPATH . WPINC . '/class-jp-error.php' );
require( ABSPATH . WPINC . '/pomo/mo.php' );

// Include the wpdb class and, if present, a db.php database drop-in.
global $wpdb;
require_jp_db();

// Set the database table prefix and the format specifiers for database table columns.
$GLOBALS['table_prefix'] = $table_prefix;
jp_set_wpdb_vars();

// Start the JonPress object cache, or an external object cache if the drop-in is present.
jp_start_object_cache();

// Attach the default filters.
require( ABSPATH . WPINC . '/default-filters.php' );

// Initialize multisite if enabled.
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/class-jp-site-query.php' );
	require( ABSPATH . WPINC . '/class-jp-network-query.php' );
	require( ABSPATH . WPINC . '/ms-blogs.php' );
	require( ABSPATH . WPINC . '/ms-settings.php' );
} elseif ( ! defined( 'MULTISITE' ) ) {
	define( 'MULTISITE', false );
}

register_shutdown_function( 'shutdown_action_hook' );

// Stop most of JonPress from being loaded if we just want the basics.
if ( SHORTINIT ) {
	return false;
}

// Load the L10n library.
require_once( ABSPATH . WPINC . '/l10n.php' );
require_once( ABSPATH . WPINC . '/class-jp-locale.php' );
require_once( ABSPATH . WPINC . '/class-jp-locale-switcher.php' );

// Run the installer if JonPress is not installed.
jp_not_installed();

// Load most of JonPress.
require( ABSPATH . WPINC . '/class-jp-walker.php' );
require( ABSPATH . WPINC . '/class-jp-ajax-response.php' );
require( ABSPATH . WPINC . '/capabilities.php' );
require( ABSPATH . WPINC . '/class-jp-roles.php' );
require( ABSPATH . WPINC . '/class-jp-role.php' );
require( ABSPATH . WPINC . '/class-jp-user.php' );
require( ABSPATH . WPINC . '/class-jp-query.php' );
require( ABSPATH . WPINC . '/query.php' );
require( ABSPATH . WPINC . '/date.php' );
require( ABSPATH . WPINC . '/theme.php' );
require( ABSPATH . WPINC . '/class-jp-theme.php' );
require( ABSPATH . WPINC . '/template.php' );
require( ABSPATH . WPINC . '/user.php' );
require( ABSPATH . WPINC . '/class-jp-user-query.php' );
require( ABSPATH . WPINC . '/class-jp-session-tokens.php' );
require( ABSPATH . WPINC . '/class-jp-user-meta-session-tokens.php' );
require( ABSPATH . WPINC . '/class-jp-metadata-lazyloader.php' );
require( ABSPATH . WPINC . '/general-template.php' );
require( ABSPATH . WPINC . '/link-template.php' );
require( ABSPATH . WPINC . '/author-template.php' );
require( ABSPATH . WPINC . '/post.php' );
require( ABSPATH . WPINC . '/class-walker-page.php' );
require( ABSPATH . WPINC . '/class-walker-page-dropdown.php' );
require( ABSPATH . WPINC . '/class-jp-post-type.php' );
require( ABSPATH . WPINC . '/class-jp-post.php' );
require( ABSPATH . WPINC . '/post-template.php' );
require( ABSPATH . WPINC . '/revision.php' );
require( ABSPATH . WPINC . '/post-formats.php' );
require( ABSPATH . WPINC . '/post-thumbnail-template.php' );
require( ABSPATH . WPINC . '/category.php' );
require( ABSPATH . WPINC . '/class-walker-category.php' );
require( ABSPATH . WPINC . '/class-walker-category-dropdown.php' );
require( ABSPATH . WPINC . '/category-template.php' );
require( ABSPATH . WPINC . '/comment.php' );
require( ABSPATH . WPINC . '/class-jp-comment.php' );
require( ABSPATH . WPINC . '/class-jp-comment-query.php' );
require( ABSPATH . WPINC . '/class-walker-comment.php' );
require( ABSPATH . WPINC . '/comment-template.php' );
require( ABSPATH . WPINC . '/rewrite.php' );
require( ABSPATH . WPINC . '/class-jp-rewrite.php' );
require( ABSPATH . WPINC . '/feed.php' );
require( ABSPATH . WPINC . '/bookmark.php' );
require( ABSPATH . WPINC . '/bookmark-template.php' );
require( ABSPATH . WPINC . '/kses.php' );
require( ABSPATH . WPINC . '/cron.php' );
require( ABSPATH . WPINC . '/deprecated.php' );
require( ABSPATH . WPINC . '/script-loader.php' );
require( ABSPATH . WPINC . '/taxonomy.php' );
require( ABSPATH . WPINC . '/class-jp-taxonomy.php' );
require( ABSPATH . WPINC . '/class-jp-term.php' );
require( ABSPATH . WPINC . '/class-jp-term-query.php' );
require( ABSPATH . WPINC . '/class-jp-tax-query.php' );
require( ABSPATH . WPINC . '/update.php' );
require( ABSPATH . WPINC . '/canonical.php' );
require( ABSPATH . WPINC . '/shortcodes.php' );
require( ABSPATH . WPINC . '/embed.php' );
require( ABSPATH . WPINC . '/class-jp-embed.php' );
require( ABSPATH . WPINC . '/class-oembed.php' );
require( ABSPATH . WPINC . '/class-jp-oembed-controller.php' );
require( ABSPATH . WPINC . '/media.php' );
require( ABSPATH . WPINC . '/http.php' );
require( ABSPATH . WPINC . '/class-http.php' );
require( ABSPATH . WPINC . '/class-jp-http-streams.php' );
require( ABSPATH . WPINC . '/class-jp-http-curl.php' );
require( ABSPATH . WPINC . '/class-jp-http-proxy.php' );
require( ABSPATH . WPINC . '/class-jp-http-cookie.php' );
require( ABSPATH . WPINC . '/class-jp-http-encoding.php' );
require( ABSPATH . WPINC . '/class-jp-http-response.php' );
require( ABSPATH . WPINC . '/class-jp-http-requests-response.php' );
require( ABSPATH . WPINC . '/class-jp-http-requests-hooks.php' );
require( ABSPATH . WPINC . '/widgets.php' );
require( ABSPATH . WPINC . '/class-jp-widget.php' );
require( ABSPATH . WPINC . '/class-jp-widget-factory.php' );
require( ABSPATH . WPINC . '/nav-menu.php' );
require( ABSPATH . WPINC . '/nav-menu-template.php' );
require( ABSPATH . WPINC . '/admin-bar.php' );
require( ABSPATH . WPINC . '/rest-api.php' );
require( ABSPATH . WPINC . '/rest-api/class-jp-rest-server.php' );
require( ABSPATH . WPINC . '/rest-api/class-jp-rest-response.php' );
require( ABSPATH . WPINC . '/rest-api/class-jp-rest-request.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-posts-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-attachments-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-post-types-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-post-statuses-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-revisions-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-taxonomies-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-terms-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-users-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-comments-controller.php' );
require( ABSPATH . WPINC . '/rest-api/endpoints/class-jp-rest-settings-controller.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-jp-rest-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-jp-rest-comment-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-jp-rest-post-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-jp-rest-term-meta-fields.php' );
require( ABSPATH . WPINC . '/rest-api/fields/class-jp-rest-user-meta-fields.php' );

$GLOBALS['jp_embed'] = new JP_Embed();

// Load multisite-specific files.
if ( is_multisite() ) {
	require( ABSPATH . WPINC . '/ms-functions.php' );
	require( ABSPATH . WPINC . '/ms-default-filters.php' );
	require( ABSPATH . WPINC . '/ms-deprecated.php' );
}

// Define constants that rely on the API to obtain the default value.
// Define must-use plugin directory constants, which may be overridden in the sunrise.php drop-in.
jp_plugin_directory_constants();

$GLOBALS['jp_plugin_paths'] = array();

// Load must-use plugins.
foreach ( jp_get_mu_plugins() as $mu_plugin ) {
	include_once( $mu_plugin );
}
unset( $mu_plugin );

// Load network activated plugins.
if ( is_multisite() ) {
	foreach ( jp_get_active_network_plugins() as $network_plugin ) {
		jp_register_plugin_realpath( $network_plugin );
		include_once( $network_plugin );
	}
	unset( $network_plugin );
}

/**
 * Fires once all must-use and network-activated plugins have loaded.
 *
 * @since 2.8.0
 */
do_action( 'muplugins_loaded' );

if ( is_multisite() ) {
	ms_cookie_constants();
}

// Define constants after multisite is loaded.
jp_cookie_constants();

// Define and enforce our SSL constants
jp_ssl_constants();

// Create common globals.
require( ABSPATH . WPINC . '/vars.php' );

// Make taxonomies and posts available to plugins and themes.
// @plugin authors: warning: these get registered again on the init hook.
create_initial_taxonomies();
create_initial_post_types();

jp_start_scraping_edited_file_errors();

// Register the default theme directory root
register_theme_directory( get_theme_root() );

// Load active plugins.
foreach ( jp_get_active_and_valid_plugins() as $plugin ) {
	jp_register_plugin_realpath( $plugin );
	include_once( $plugin );
}
unset( $plugin );

// Load pluggable functions.
require( ABSPATH . WPINC . '/pluggable.php' );
require( ABSPATH . WPINC . '/pluggable-deprecated.php' );

// Set internal encoding.
jp_set_internal_encoding();

// Run jp_cache_postload() if object cache is enabled and the function exists.
if ( JP_CACHE && function_exists( 'jp_cache_postload' ) ) {
	jp_cache_postload();
}

/**
 * Fires once activated plugins have loaded.
 *
 * Pluggable functions are also available at this point in the loading order.
 *
 * @since 1.5.0
 */
do_action( 'plugins_loaded' );

// Define constants which affect functionality if not already defined.
jp_functionality_constants();

// Add magic quotes and set up $_REQUEST ( $_GET + $_POST )
jp_magic_quotes();

/**
 * Fires when comment cookies are sanitized.
 *
 * @since 2.0.11
 */
do_action( 'sanitize_comment_cookies' );

/**
 * JonPress Query object
 *
 * @global JP_Query $jp_the_query
 * @since 2.0.0
 */
$GLOBALS['jp_the_query'] = new JP_Query();

/**
 * Holds the reference to @see $jp_the_query
 * Use this global for JonPress queries
 *
 * @global JP_Query $jp_query
 * @since 1.5.0
 */
$GLOBALS['jp_query'] = $GLOBALS['jp_the_query'];

/**
 * Holds the JonPress Rewrite object for creating pretty URLs
 *
 * @global JP_Rewrite $jp_rewrite
 * @since 1.5.0
 */
$GLOBALS['jp_rewrite'] = new JP_Rewrite();

/**
 * JonPress Object
 *
 * @global WP $wp
 * @since 2.0.0
 */
$GLOBALS['wp'] = new WP();

/**
 * JonPress Widget Factory Object
 *
 * @global JP_Widget_Factory $jp_widget_factory
 * @since 2.8.0
 */
$GLOBALS['jp_widget_factory'] = new JP_Widget_Factory();

/**
 * JonPress User Roles
 *
 * @global JP_Roles $jp_roles
 * @since 2.0.0
 */
$GLOBALS['jp_roles'] = new JP_Roles();

/**
 * Fires before the theme is loaded.
 *
 * @since 2.6.0
 */
do_action( 'setup_theme' );

// Define the template related constants.
jp_templating_constants();

// Load the default text localization domain.
load_default_textdomain();

$locale      = get_locale();
$locale_file = JP_LANG_DIR . "/$locale.php";
if ( ( 0 === validate_file( $locale ) ) && is_readable( $locale_file ) ) {
	require( $locale_file );
}
unset( $locale_file );

/**
 * JonPress Locale object for loading locale domain date and various strings.
 *
 * @global JP_Locale $jp_locale
 * @since 2.1.0
 */
$GLOBALS['jp_locale'] = new JP_Locale();

/**
 *  JonPress Locale Switcher object for switching locales.
 *
 * @since 4.7.0
 *
 * @global JP_Locale_Switcher $jp_locale_switcher JonPress locale switcher object.
 */
$GLOBALS['jp_locale_switcher'] = new JP_Locale_Switcher();
$GLOBALS['jp_locale_switcher']->init();

// Load the functions for the active theme, for both parent and child theme if applicable.
if ( ! jp_installing() || 'jp-activate.php' === $pagenow ) {
	if ( TEMPLATEPATH !== STYLESHEETPATH && file_exists( STYLESHEETPATH . '/functions.php' ) ) {
		include( STYLESHEETPATH . '/functions.php' );
	}
	if ( file_exists( TEMPLATEPATH . '/functions.php' ) ) {
		include( TEMPLATEPATH . '/functions.php' );
	}
}

/**
 * Fires after the theme is loaded.
 *
 * @since 3.0.0
 */
do_action( 'after_setup_theme' );

// Set up current user.
$GLOBALS['wp']->init();

/**
 * Fires after JonPress has finished loading but before any headers are sent.
 *
 * Most of WP is loaded at this stage, and the user is authenticated. WP continues
 * to load on the {@see 'init'} hook that follows (e.g. widgets), and many plugins instantiate
 * themselves on it for all sorts of reasons (e.g. they need a user, a taxonomy, etc.).
 *
 * If you wish to plug an action once WP is loaded, use the {@see 'jp_loaded'} hook below.
 *
 * @since 1.5.0
 */
do_action( 'init' );

// Check site status
if ( is_multisite() ) {
	if ( true !== ( $file = ms_site_check() ) ) {
		require( $file );
		die();
	}
	unset( $file );
}

/**
 * This hook is fired once WP, all plugins, and the theme are fully loaded and instantiated.
 *
 * Ajax requests should use jp-admin/admin-ajax.php. admin-ajax.php can handle requests for
 * users not logged in.
 *
 * @link https://codex.jonpress.org/AJAX_in_Plugins
 *
 * @since 3.0.0
 */
do_action( 'jp_loaded' );
