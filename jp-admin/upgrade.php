<?php
/**
 * Upgrade JonPress Page.
 *
 * @package JonPress
 * @subpackage Administration
 */

/**
 * We are upgrading JonPress.
 *
 * @since 1.5.1
 * @var bool
 */
define( 'JP_INSTALLING', true );

/** Load JonPress Bootstrap */
require( dirname( dirname( __FILE__ ) ) . '/jp-load.php' );

nocache_headers();

timer_start();
require_once( ABSPATH . 'jp-admin/includes/upgrade.php' );

delete_site_transient( 'update_core' );

if ( isset( $_GET['step'] ) ) {
	$step = $_GET['step'];
} else {
	$step = 0;
}

// Do it. No output.
if ( 'upgrade_db' === $step ) {
	jp_upgrade();
	die( '0' );
}

/**
 * @global string $jp_version
 * @global string $required_php_version
 * @global string $required_mysql_version
 * @global wpdb   $wpdb
 */
global $jp_version, $required_php_version, $required_mysql_version;

$step = (int) $step;

$php_version   = phpversion();
$mysql_version = $wpdb->db_version();
$php_compat    = version_compare( $php_version, $required_php_version, '>=' );
if ( file_exists( JP_CONTENT_DIR . '/db.php' ) && empty( $wpdb->is_mysql ) ) {
	$mysql_compat = true;
} else {
	$mysql_compat = version_compare( $mysql_version, $required_mysql_version, '>=' );
}

@header( 'Content-Type: ' . get_option( 'html_type' ) . '; charset=' . get_option( 'blog_charset' ) );
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php echo get_option( 'blog_charset' ); ?>" />
	<meta name="robots" content="noindex,nofollow" />
	<title><?php _e( 'JonPress &rsaquo; Update' ); ?></title>
	<?php
	jp_admin_css( 'install', true );
	jp_admin_css( 'ie', true );
	?>
</head>
<body class="jp-core-ui">
<p id="logo"><a href="<?php echo esc_url( __( 'https://jonpress.org/' ) ); ?>" tabindex="-1"><?php _e( 'JonPress' ); ?></a></p>

<?php if ( get_option( 'db_version' ) == $jp_db_version || ! is_blog_installed() ) : ?>

<h1><?php _e( 'No Update Required' ); ?></h1>
<p><?php _e( 'Your JonPress database is already up-to-date!' ); ?></p>
<p class="step"><a class="button button-large" href="<?php echo get_option( 'home' ); ?>/"><?php _e( 'Continue' ); ?></a></p>

<?php
elseif ( ! $php_compat || ! $mysql_compat ) :
	if ( ! $mysql_compat && ! $php_compat ) {
		printf( __( 'You cannot update because <a href="https://codex.jonpress.org/Version_%1$s">JonPress %1$s</a> requires PHP version %2$s or higher and MySQL version %3$s or higher. You are running PHP version %4$s and MySQL version %5$s.' ), $jp_version, $required_php_version, $required_mysql_version, $php_version, $mysql_version );
	} elseif ( ! $php_compat ) {
		printf( __( 'You cannot update because <a href="https://codex.jonpress.org/Version_%1$s">JonPress %1$s</a> requires PHP version %2$s or higher. You are running version %3$s.' ), $jp_version, $required_php_version, $php_version );
	} elseif ( ! $mysql_compat ) {
		printf( __( 'You cannot update because <a href="https://codex.jonpress.org/Version_%1$s">JonPress %1$s</a> requires MySQL version %2$s or higher. You are running version %3$s.' ), $jp_version, $required_mysql_version, $mysql_version );
	}
?>
<?php
else :
	switch ( $step ) :
		case 0:
			$goback = jp_get_referer();
			if ( $goback ) {
				$goback = esc_url_raw( $goback );
				$goback = urlencode( $goback );
			}
	?>
	<h1><?php _e( 'Database Update Required' ); ?></h1>
<p><?php _e( 'JonPress has been updated! Before we send you on your way, we have to update your database to the newest version.' ); ?></p>
<p><?php _e( 'The database update process may take a little while, so please be patient.' ); ?></p>
<p class="step"><a class="button button-large button-primary" href="upgrade.php?step=1&amp;backto=<?php echo $goback; ?>"><?php _e( 'Update JonPress Database' ); ?></a></p>
<?php
			break;
		case 1:
			jp_upgrade();

			$backto = ! empty( $_GET['backto'] ) ? jp_unslash( urldecode( $_GET['backto'] ) ) : __get_option( 'home' ) . '/';
			$backto = esc_url( $backto );
			$backto = jp_validate_redirect( $backto, __get_option( 'home' ) . '/' );
	?>
	<h1><?php _e( 'Update Complete' ); ?></h1>
	<p><?php _e( 'Your JonPress database has been successfully updated!' ); ?></p>
	<p class="step"><a class="button button-large" href="<?php echo $backto; ?>"><?php _e( 'Continue' ); ?></a></p>

<!--
<pre>
<?php printf( __( '%s queries' ), $wpdb->num_queries ); ?>

<?php printf( __( '%s seconds' ), timer_stop( 0 ) ); ?>
</pre>
-->

<?php
			break;
endswitch;
endif;
?>
</body>
</html>
