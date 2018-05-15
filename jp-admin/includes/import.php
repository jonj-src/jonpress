<?php
/**
 * JonPress Administration Importer API.
 *
 * @package JonPress
 * @subpackage Administration
 */

/**
 * Retrieve list of importers.
 *
 * @since 2.0.0
 *
 * @global array $jp_importers
 * @return array
 */
function get_importers() {
	global $jp_importers;
	if ( is_array( $jp_importers ) ) {
		uasort( $jp_importers, '_usort_by_first_member' );
	}
	return $jp_importers;
}

/**
 * Sorts a multidimensional array by first member of each top level member
 *
 * Used by uasort() as a callback, should not be used directly.
 *
 * @since 2.9.0
 * @access private
 *
 * @param array $a
 * @param array $b
 * @return int
 */
function _usort_by_first_member( $a, $b ) {
	return strnatcasecmp( $a[0], $b[0] );
}

/**
 * Register importer for JonPress.
 *
 * @since 2.0.0
 *
 * @global array $jp_importers
 *
 * @param string   $id          Importer tag. Used to uniquely identify importer.
 * @param string   $name        Importer name and title.
 * @param string   $description Importer description.
 * @param callable $callback    Callback to run.
 * @return JP_Error Returns JP_Error when $callback is JP_Error.
 */
function register_importer( $id, $name, $description, $callback ) {
	global $jp_importers;
	if ( is_jp_error( $callback ) ) {
		return $callback;
	}
	$jp_importers[ $id ] = array( $name, $description, $callback );
}

/**
 * Cleanup importer.
 *
 * Removes attachment based on ID.
 *
 * @since 2.0.0
 *
 * @param string $id Importer ID.
 */
function jp_import_cleanup( $id ) {
	jp_delete_attachment( $id );
}

/**
 * Handle importer uploading and add attachment.
 *
 * @since 2.0.0
 *
 * @return array Uploaded file's details on success, error message on failure
 */
function jp_import_handle_upload() {
	if ( ! isset( $_FILES['import'] ) ) {
		return array(
			'error' => __( 'File is empty. Please upload something more substantial. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.' ),
		);
	}

	$overrides                 = array(
		'test_form' => false,
		'test_type' => false,
	);
	$_FILES['import']['name'] .= '.txt';
	$upload                    = jp_handle_upload( $_FILES['import'], $overrides );

	if ( isset( $upload['error'] ) ) {
		return $upload;
	}

	// Construct the object array
	$object = array(
		'post_title'     => basename( $upload['file'] ),
		'post_content'   => $upload['url'],
		'post_mime_type' => $upload['type'],
		'guid'           => $upload['url'],
		'context'        => 'import',
		'post_status'    => 'private',
	);

	// Save the data
	$id = jp_insert_attachment( $object, $upload['file'] );

	/*
	 * Schedule a cleanup for one day from now in case of failed
	 * import or missing jp_import_cleanup() call.
	 */
	jp_schedule_single_event( time() + DAY_IN_SECONDS, 'importer_scheduled_cleanup', array( $id ) );

	return array(
		'file' => $upload['file'],
		'id'   => $id,
	);
}

/**
 * Returns a list from JonPress.org of popular importer plugins.
 *
 * @since 3.5.0
 *
 * @return array Importers with metadata for each.
 */
function jp_get_popular_importers() {
	include( ABSPATH . WPINC . '/version.php' ); // include an unmodified $jp_version

	$locale            = get_user_locale();
	$cache_key         = 'popular_importers_' . md5( $locale . $jp_version );
	$popular_importers = get_site_transient( $cache_key );

	if ( ! $popular_importers ) {
		$url     = add_query_arg(
			array(
				'locale'  => $locale,
				'version' => $jp_version,
			), 'http://api.jonpress.org/core/importers/1.1/'
		);
		$options = array( 'user-agent' => 'JonPress/' . $jp_version . '; ' . home_url( '/' ) );

		if ( jp_http_supports( array( 'ssl' ) ) ) {
			$url = set_url_scheme( $url, 'https' );
		}

		$response          = jp_remote_get( $url, $options );
		$popular_importers = json_decode( jp_remote_retrieve_body( $response ), true );

		if ( is_array( $popular_importers ) ) {
			set_site_transient( $cache_key, $popular_importers, 2 * DAY_IN_SECONDS );
		} else {
			$popular_importers = false;
		}
	}

	if ( is_array( $popular_importers ) ) {
		// If the data was received as translated, return it as-is.
		if ( $popular_importers['translated'] ) {
			return $popular_importers['importers'];
		}

		foreach ( $popular_importers['importers'] as &$importer ) {
			$importer['description'] = translate( $importer['description'] );
			if ( $importer['name'] != 'JonPress' ) {
				$importer['name'] = translate( $importer['name'] );
			}
		}
		return $popular_importers['importers'];
	}

	return array(
		// slug => name, description, plugin slug, and register_importer() slug
		'blogger'     => array(
			'name'        => __( 'Blogger' ),
			'description' => __( 'Import posts, comments, and users from a Blogger blog.' ),
			'plugin-slug' => 'blogger-importer',
			'importer-id' => 'blogger',
		),
		'wpcat2tag'   => array(
			'name'        => __( 'Categories and Tags Converter' ),
			'description' => __( 'Convert existing categories to tags or tags to categories, selectively.' ),
			'plugin-slug' => 'wpcat2tag-importer',
			'importer-id' => 'jp-cat2tag',
		),
		'livejournal' => array(
			'name'        => __( 'LiveJournal' ),
			'description' => __( 'Import posts from LiveJournal using their API.' ),
			'plugin-slug' => 'livejournal-importer',
			'importer-id' => 'livejournal',
		),
		'movabletype' => array(
			'name'        => __( 'Movable Type and TypePad' ),
			'description' => __( 'Import posts and comments from a Movable Type or TypePad blog.' ),
			'plugin-slug' => 'movabletype-importer',
			'importer-id' => 'mt',
		),
		'opml'        => array(
			'name'        => __( 'Blogroll' ),
			'description' => __( 'Import links in OPML format.' ),
			'plugin-slug' => 'opml-importer',
			'importer-id' => 'opml',
		),
		'rss'         => array(
			'name'        => __( 'RSS' ),
			'description' => __( 'Import posts from an RSS feed.' ),
			'plugin-slug' => 'rss-importer',
			'importer-id' => 'rss',
		),
		'tumblr'      => array(
			'name'        => __( 'Tumblr' ),
			'description' => __( 'Import posts &amp; media from Tumblr using their API.' ),
			'plugin-slug' => 'tumblr-importer',
			'importer-id' => 'tumblr',
		),
		'jonpress'   => array(
			'name'        => 'JonPress',
			'description' => __( 'Import posts, pages, comments, custom fields, categories, and tags from a JonPress export file.' ),
			'plugin-slug' => 'jonpress-importer',
			'importer-id' => 'jonpress',
		),
	);
}
