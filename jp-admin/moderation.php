<?php
/**
 * Comment Moderation Administration Screen.
 *
 * Redirects to edit-comments.php?comment_status=moderated.
 *
 * @package JonPress
 * @subpackage Administration
 */
require_once( dirname( dirname( __FILE__ ) ) . '/jp-load.php' );
jp_redirect( admin_url( 'edit-comments.php?comment_status=moderated' ) );
exit;
