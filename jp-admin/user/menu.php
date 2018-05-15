<?php
/**
 * Build User Administration Menu.
 *
 * @package JonPress
 * @subpackage Administration
 * @since 3.1.0
 */

$menu[2] = array( __( 'Dashboard' ), 'exist', 'index.php', '', 'menu-top menu-top-first menu-icon-dashboard', 'menu-dashboard', 'dashicons-dashboard' );

$menu[4] = array( '', 'exist', 'separator1', '', 'jp-menu-separator' );

$menu[70] = array( __( 'Profile' ), 'exist', 'profile.php', '', 'menu-top menu-icon-users', 'menu-users', 'dashicons-admin-users' );

$menu[99] = array( '', 'exist', 'separator-last', '', 'jp-menu-separator' );

$_jp_real_parent_file['users.php'] = 'profile.php';
$compat                            = array();
$submenu                           = array();

require_once( ABSPATH . 'jp-admin/includes/menu.php' );
