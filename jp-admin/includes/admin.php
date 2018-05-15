<?php
/**
 * Core Administration API
 *
 * @package JonPress
 * @subpackage Administration
 * @since 2.3.0
 */

if ( ! defined( 'JP_ADMIN' ) ) {
	/*
	 * This file is being included from a file other than jp-admin/admin.php, so
	 * some setup was skipped. Make sure the admin message catalog is loaded since
	 * load_default_textdomain() will not have done so in this context.
	 */
	load_textdomain( 'default', JP_LANG_DIR . '/admin-' . get_locale() . '.mo' );
}

/** JonPress Administration Hooks */
require_once( ABSPATH . 'jp-admin/includes/admin-filters.php' );

/** JonPress Bookmark Administration API */
require_once( ABSPATH . 'jp-admin/includes/bookmark.php' );

/** JonPress Comment Administration API */
require_once( ABSPATH . 'jp-admin/includes/comment.php' );

/** JonPress Administration File API */
require_once( ABSPATH . 'jp-admin/includes/file.php' );

/** JonPress Image Administration API */
require_once( ABSPATH . 'jp-admin/includes/image.php' );

/** JonPress Media Administration API */
require_once( ABSPATH . 'jp-admin/includes/media.php' );

/** JonPress Import Administration API */
require_once( ABSPATH . 'jp-admin/includes/import.php' );

/** JonPress Misc Administration API */
require_once( ABSPATH . 'jp-admin/includes/misc.php' );

/** JonPress Options Administration API */
require_once( ABSPATH . 'jp-admin/includes/options.php' );

/** JonPress Plugin Administration API */
require_once( ABSPATH . 'jp-admin/includes/plugin.php' );

/** JonPress Post Administration API */
require_once( ABSPATH . 'jp-admin/includes/post.php' );

/** JonPress Administration Screen API */
require_once( ABSPATH . 'jp-admin/includes/class-jp-screen.php' );
require_once( ABSPATH . 'jp-admin/includes/screen.php' );

/** JonPress Taxonomy Administration API */
require_once( ABSPATH . 'jp-admin/includes/taxonomy.php' );

/** JonPress Template Administration API */
require_once( ABSPATH . 'jp-admin/includes/template.php' );

/** JonPress List Table Administration API and base class */
require_once( ABSPATH . 'jp-admin/includes/class-jp-list-table.php' );
require_once( ABSPATH . 'jp-admin/includes/class-jp-list-table-compat.php' );
require_once( ABSPATH . 'jp-admin/includes/list-table.php' );

/** JonPress Theme Administration API */
require_once( ABSPATH . 'jp-admin/includes/theme.php' );

/** JonPress User Administration API */
require_once( ABSPATH . 'jp-admin/includes/user.php' );

/** JonPress Site Icon API */
require_once( ABSPATH . 'jp-admin/includes/class-jp-site-icon.php' );

/** JonPress Update Administration API */
require_once( ABSPATH . 'jp-admin/includes/update.php' );

/** JonPress Deprecated Administration API */
require_once( ABSPATH . 'jp-admin/includes/deprecated.php' );

/** JonPress Multisite support API */
if ( is_multisite() ) {
	require_once( ABSPATH . 'jp-admin/includes/ms-admin-filters.php' );
	require_once( ABSPATH . 'jp-admin/includes/ms.php' );
	require_once( ABSPATH . 'jp-admin/includes/ms-deprecated.php' );
}
