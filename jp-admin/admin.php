<?php
/**
 * JonPress Administration Bootstrap
 *
 * @package JonPress
 * @subpackage Administration
 */

/**
 * In JonPress Administration Screens
 *
 * @since 2.3.2
 */
if ( ! defined( 'JP_ADMIN' ) ) {
	define( 'JP_ADMIN', true );
}

if ( ! defined( 'JP_NETWORK_ADMIN' ) ) {
	define( 'JP_NETWORK_ADMIN', false );
}

if ( ! defined( 'JP_USER_ADMIN' ) ) {
	define( 'JP_USER_ADMIN', false );
}

if ( ! JP_NETWORK_ADMIN && ! JP_USER_ADMIN ) {
	define( 'JP_BLOG_ADMIN', true );
}

if ( isset( $_GET['import'] ) && ! defined( 'JP_LOAD_IMPORTERS' ) ) {
	define( 'JP_LOAD_IMPORTERS', true );
}

require_once( dirname( dirname( __FILE__ ) ) . '/jp-load.php' );

nocache_headers();

if ( get_option( 'db_upgraded' ) ) {
	flush_rewrite_rules();
	update_option( 'db_upgraded', false );

	/**
	 * Fires on the next page load after a successful DB upgrade.
	 *
	 * @since 2.8.0
	 */
	do_action( 'after_db_upgrade' );
} elseif ( get_option( 'db_version' ) != $jp_db_version && empty( $_POST ) ) {
	if ( ! is_multisite() ) {
		jp_redirect( admin_url( 'upgrade.php?_jp_http_referer=' . urlencode( jp_unslash( $_SERVER['REQUEST_URI'] ) ) ) );
		exit;

		/**
		 * Filters whether to attempt to perform the multisite DB upgrade routine.
		 *
		 * In single site, the user would be redirected to jp-admin/upgrade.php.
		 * In multisite, the DB upgrade routine is automatically fired, but only
		 * when this filter returns true.
		 *
		 * If the network is 50 sites or less, it will run every time. Otherwise,
		 * it will throttle itself to reduce load.
		 *
		 * @since 3.0.0
		 *
		 * @param bool $do_mu_upgrade Whether to perform the Multisite upgrade routine. Default true.
		 */
	} elseif ( apply_filters( 'do_mu_upgrade', true ) ) {
		$c = get_blog_count();

		/*
		 * If there are 50 or fewer sites, run every time. Otherwise, throttle to reduce load:
		 * attempt to do no more than threshold value, with some +/- allowed.
		 */
		if ( $c <= 50 || ( $c > 50 && mt_rand( 0, (int) ( $c / 50 ) ) == 1 ) ) {
			require_once( ABSPATH . WPINC . '/http.php' );
			$response = jp_remote_get(
				admin_url( 'upgrade.php?step=1' ), array(
					'timeout'     => 120,
					'httpversion' => '1.1',
				)
			);
			/** This action is documented in jp-admin/network/upgrade.php */
			do_action( 'after_mu_upgrade', $response );
			unset( $response );
		}
		unset( $c );
	}
}

require_once( ABSPATH . 'jp-admin/includes/admin.php' );

auth_redirect();

// Schedule trash collection
if ( ! jp_next_scheduled( 'jp_scheduled_delete' ) && ! jp_installing() ) {
	jp_schedule_event( time(), 'daily', 'jp_scheduled_delete' );
}

// Schedule Transient cleanup.
if ( ! jp_next_scheduled( 'delete_expired_transients' ) && ! jp_installing() ) {
	jp_schedule_event( time(), 'daily', 'delete_expired_transients' );
}

set_screen_options();

$date_format = __( 'F j, Y' );
$time_format = __( 'g:i a' );

jp_enqueue_script( 'common' );

/**
 * $pagenow is set in vars.php
 * $jp_importers is sometimes set in jp-admin/includes/import.php
 * The remaining variables are imported as globals elsewhere, declared as globals here
 *
 * @global string $pagenow
 * @global array  $jp_importers
 * @global string $hook_suffix
 * @global string $plugin_page
 * @global string $typenow
 * @global string $taxnow
 */
global $pagenow, $jp_importers, $hook_suffix, $plugin_page, $typenow, $taxnow;

$page_hook = null;

$editing = false;

if ( isset( $_GET['page'] ) ) {
	$plugin_page = jp_unslash( $_GET['page'] );
	$plugin_page = plugin_basename( $plugin_page );
}

if ( isset( $_REQUEST['post_type'] ) && post_type_exists( $_REQUEST['post_type'] ) ) {
	$typenow = $_REQUEST['post_type'];
} else {
	$typenow = '';
}

if ( isset( $_REQUEST['taxonomy'] ) && taxonomy_exists( $_REQUEST['taxonomy'] ) ) {
	$taxnow = $_REQUEST['taxonomy'];
} else {
	$taxnow = '';
}

if ( JP_NETWORK_ADMIN ) {
	require( ABSPATH . 'jp-admin/network/menu.php' );
} elseif ( JP_USER_ADMIN ) {
	require( ABSPATH . 'jp-admin/user/menu.php' );
} else {
	require( ABSPATH . 'jp-admin/menu.php' );
}

if ( current_user_can( 'manage_options' ) ) {
	jp_raise_memory_limit( 'admin' );
}

/**
 * Fires as an admin screen or script is being initialized.
 *
 * Note, this does not just run on user-facing admin screens.
 * It runs on admin-ajax.php and admin-post.php as well.
 *
 * This is roughly analogous to the more general {@see 'init'} hook, which fires earlier.
 *
 * @since 2.5.0
 */
do_action( 'admin_init' );

if ( isset( $plugin_page ) ) {
	if ( ! empty( $typenow ) ) {
		$the_parent = $pagenow . '?post_type=' . $typenow;
	} else {
		$the_parent = $pagenow;
	}
	if ( ! $page_hook = get_plugin_page_hook( $plugin_page, $the_parent ) ) {
		$page_hook = get_plugin_page_hook( $plugin_page, $plugin_page );

		// Back-compat for plugins using add_management_page().
		if ( empty( $page_hook ) && 'edit.php' == $pagenow && '' != get_plugin_page_hook( $plugin_page, 'tools.php' ) ) {
			// There could be plugin specific params on the URL, so we need the whole query string
			if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
				$query_string = $_SERVER['QUERY_STRING'];
			} else {
				$query_string = 'page=' . $plugin_page;
			}
			jp_redirect( admin_url( 'tools.php?' . $query_string ) );
			exit;
		}
	}
	unset( $the_parent );
}

$hook_suffix = '';
if ( isset( $page_hook ) ) {
	$hook_suffix = $page_hook;
} elseif ( isset( $plugin_page ) ) {
	$hook_suffix = $plugin_page;
} elseif ( isset( $pagenow ) ) {
	$hook_suffix = $pagenow;
}

set_current_screen();

// Handle plugin admin pages.
if ( isset( $plugin_page ) ) {
	if ( $page_hook ) {
		/**
		 * Fires before a particular screen is loaded.
		 *
		 * The load-* hook fires in a number of contexts. This hook is for plugin screens
		 * where a callback is provided when the screen is registered.
		 *
		 * The dynamic portion of the hook name, `$page_hook`, refers to a mixture of plugin
		 * page information including:
		 * 1. The page type. If the plugin page is registered as a submenu page, such as for
		 *    Settings, the page type would be 'settings'. Otherwise the type is 'toplevel'.
		 * 2. A separator of '_page_'.
		 * 3. The plugin basename minus the file extension.
		 *
		 * Together, the three parts form the `$page_hook`. Citing the example above,
		 * the hook name used would be 'load-settings_page_pluginbasename'.
		 *
		 * @see get_plugin_page_hook()
		 *
		 * @since 2.1.0
		 */
		do_action( "load-{$page_hook}" );
		if ( ! isset( $_GET['noheader'] ) ) {
			require_once( ABSPATH . 'jp-admin/admin-header.php' );
		}

		/**
		 * Used to call the registered callback for a plugin screen.
		 *
		 * @ignore
		 * @since 1.5.0
		 */
		do_action( $page_hook );
	} else {
		if ( validate_file( $plugin_page ) ) {
			jp_die( __( 'Invalid plugin page.' ) );
		}

		if ( ! ( file_exists( JP_PLUGIN_DIR . "/$plugin_page" ) && is_file( JP_PLUGIN_DIR . "/$plugin_page" ) ) && ! ( file_exists( WPMU_PLUGIN_DIR . "/$plugin_page" ) && is_file( WPMU_PLUGIN_DIR . "/$plugin_page" ) ) ) {
			jp_die( sprintf( __( 'Cannot load %s.' ), htmlentities( $plugin_page ) ) );
		}

		/**
		 * Fires before a particular screen is loaded.
		 *
		 * The load-* hook fires in a number of contexts. This hook is for plugin screens
		 * where the file to load is directly included, rather than the use of a function.
		 *
		 * The dynamic portion of the hook name, `$plugin_page`, refers to the plugin basename.
		 *
		 * @see plugin_basename()
		 *
		 * @since 1.5.0
		 */
		do_action( "load-{$plugin_page}" );

		if ( ! isset( $_GET['noheader'] ) ) {
			require_once( ABSPATH . 'jp-admin/admin-header.php' );
		}

		if ( file_exists( WPMU_PLUGIN_DIR . "/$plugin_page" ) ) {
			include( WPMU_PLUGIN_DIR . "/$plugin_page" );
		} else {
			include( JP_PLUGIN_DIR . "/$plugin_page" );
		}
	}

	include( ABSPATH . 'jp-admin/admin-footer.php' );

	exit();
} elseif ( isset( $_GET['import'] ) ) {

	$importer = $_GET['import'];

	if ( ! current_user_can( 'import' ) ) {
		jp_die( __( 'Sorry, you are not allowed to import content.' ) );
	}

	if ( validate_file( $importer ) ) {
		jp_redirect( admin_url( 'import.php?invalid=' . $importer ) );
		exit;
	}

	if ( ! isset( $jp_importers[ $importer ] ) || ! is_callable( $jp_importers[ $importer ][2] ) ) {
		jp_redirect( admin_url( 'import.php?invalid=' . $importer ) );
		exit;
	}

	/**
	 * Fires before an importer screen is loaded.
	 *
	 * The dynamic portion of the hook name, `$importer`, refers to the importer slug.
	 *
	 * @since 3.5.0
	 */
	do_action( "load-importer-{$importer}" );

	$parent_file  = 'tools.php';
	$submenu_file = 'import.php';
	$title        = __( 'Import' );

	if ( ! isset( $_GET['noheader'] ) ) {
		require_once( ABSPATH . 'jp-admin/admin-header.php' );
	}

	require_once( ABSPATH . 'jp-admin/includes/upgrade.php' );

	define( 'JP_IMPORTING', true );

	/**
	 * Whether to filter imported data through kses on import.
	 *
	 * Multisite uses this hook to filter all data through kses by default,
	 * as a super administrator may be assisting an untrusted user.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $force Whether to force data to be filtered through kses. Default false.
	 */
	if ( apply_filters( 'force_filtered_html_on_import', false ) ) {
		kses_init_filters();  // Always filter imported data with kses on multisite.
	}

	call_user_func( $jp_importers[ $importer ][2] );

	include( ABSPATH . 'jp-admin/admin-footer.php' );

	// Make sure rules are flushed
	flush_rewrite_rules( false );

	exit();
} else {
	/**
	 * Fires before a particular screen is loaded.
	 *
	 * The load-* hook fires in a number of contexts. This hook is for core screens.
	 *
	 * The dynamic portion of the hook name, `$pagenow`, is a global variable
	 * referring to the filename of the current page, such as 'admin.php',
	 * 'post-new.php' etc. A complete hook for the latter would be
	 * 'load-post-new.php'.
	 *
	 * @since 2.1.0
	 */
	do_action( "load-{$pagenow}" );

	/*
	 * The following hooks are fired to ensure backward compatibility.
	 * In all other cases, 'load-' . $pagenow should be used instead.
	 */
	if ( $typenow == 'page' ) {
		if ( $pagenow == 'post-new.php' ) {
			do_action( 'load-page-new.php' );
		} elseif ( $pagenow == 'post.php' ) {
			do_action( 'load-page.php' );
		}
	} elseif ( $pagenow == 'edit-tags.php' ) {
		if ( $taxnow == 'category' ) {
			do_action( 'load-categories.php' );
		} elseif ( $taxnow == 'link_category' ) {
			do_action( 'load-edit-link-categories.php' );
		}
	} elseif ( 'term.php' === $pagenow ) {
		do_action( 'load-edit-tags.php' );
	}
}

if ( ! empty( $_REQUEST['action'] ) ) {
	$action = $_REQUEST['action'];

	/**
	 * Fires when an 'action' request variable is sent.
	 *
	 * The dynamic portion of the hook name, `$action`, refers to
	 * the action derived from the `GET` or `POST` request.
	 *
	 * @since 2.6.0
	 */
	do_action( "admin_action_{$action}" );
}
