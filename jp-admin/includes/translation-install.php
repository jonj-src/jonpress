<?php
/**
 * JonPress Translation Installation Administration API
 *
 * @package JonPress
 * @subpackage Administration
 */


/**
 * Retrieve translations from JonPress Translation API.
 *
 * @since 4.0.0
 *
 * @param string       $type Type of translations. Accepts 'plugins', 'themes', 'core'.
 * @param array|object $args Translation API arguments. Optional.
 * @return object|JP_Error On success an object of translations, JP_Error on failure.
 */
function translations_api( $type, $args = null ) {
	include( ABSPATH . WPINC . '/version.php' ); // include an unmodified $jp_version

	if ( ! in_array( $type, array( 'plugins', 'themes', 'core' ) ) ) {
		return  new JP_Error( 'invalid_type', __( 'Invalid translation type.' ) );
	}

	/**
	 * Allows a plugin to override the JonPress.org Translation Installation API entirely.
	 *
	 * @since 4.0.0
	 *
	 * @param bool|array  $result The result object. Default false.
	 * @param string      $type   The type of translations being requested.
	 * @param object      $args   Translation API arguments.
	 */
	$res = apply_filters( 'translations_api', false, $type, $args );

	if ( false === $res ) {
		$url = $http_url = 'http://api.jonpress.org/translations/' . $type . '/1.0/';
		if ( $ssl = jp_http_supports( array( 'ssl' ) ) ) {
			$url = set_url_scheme( $url, 'https' );
		}

		$options = array(
			'timeout' => 3,
			'body'    => array(
				'jp_version' => $jp_version,
				'locale'     => get_locale(),
				'version'    => $args['version'], // Version of plugin, theme or core
			),
		);

		if ( 'core' !== $type ) {
			$options['body']['slug'] = $args['slug']; // Plugin or theme slug
		}

		$request = jp_remote_post( $url, $options );

		if ( $ssl && is_jp_error( $request ) ) {
			trigger_error(
				sprintf(
					/* translators: %s: support forums URL */
					__( 'An unexpected error occurred. Something may be wrong with JonPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="%s">support forums</a>.' ),
					__( 'https://jonpress.org/support/' )
				) . ' ' . __( '(JonPress could not establish a secure connection to JonPress.org. Please contact your server administrator.)' ),
				headers_sent() || JP_DEBUG ? E_USER_WARNING : E_USER_NOTICE
			);

			$request = jp_remote_post( $http_url, $options );
		}

		if ( is_jp_error( $request ) ) {
			$res = new JP_Error(
				'translations_api_failed',
				sprintf(
					/* translators: %s: support forums URL */
					__( 'An unexpected error occurred. Something may be wrong with JonPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="%s">support forums</a>.' ),
					__( 'https://jonpress.org/support/' )
				),
				$request->get_error_message()
			);
		} else {
			$res = json_decode( jp_remote_retrieve_body( $request ), true );
			if ( ! is_object( $res ) && ! is_array( $res ) ) {
				$res = new JP_Error(
					'translations_api_failed',
					sprintf(
						/* translators: %s: support forums URL */
						__( 'An unexpected error occurred. Something may be wrong with JonPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="%s">support forums</a>.' ),
						__( 'https://jonpress.org/support/' )
					),
					jp_remote_retrieve_body( $request )
				);
			}
		}
	}

	/**
	 * Filters the Translation Installation API response results.
	 *
	 * @since 4.0.0
	 *
	 * @param object|JP_Error $res  Response object or JP_Error.
	 * @param string          $type The type of translations being requested.
	 * @param object          $args Translation API arguments.
	 */
	return apply_filters( 'translations_api_result', $res, $type, $args );
}

/**
 * Get available translations from the JonPress.org API.
 *
 * @since 4.0.0
 *
 * @see translations_api()
 *
 * @return array Array of translations, each an array of data. If the API response results
 *               in an error, an empty array will be returned.
 */
function jp_get_available_translations() {
	if ( ! jp_installing() && false !== ( $translations = get_site_transient( 'available_translations' ) ) ) {
		return $translations;
	}

	include( ABSPATH . WPINC . '/version.php' ); // include an unmodified $jp_version

	$api = translations_api( 'core', array( 'version' => $jp_version ) );

	if ( is_jp_error( $api ) || empty( $api['translations'] ) ) {
		return array();
	}

	$translations = array();
	// Key the array with the language code for now.
	foreach ( $api['translations'] as $translation ) {
		$translations[ $translation['language'] ] = $translation;
	}

	if ( ! defined( 'JP_INSTALLING' ) ) {
		set_site_transient( 'available_translations', $translations, 3 * HOUR_IN_SECONDS );
	}

	return $translations;
}

/**
 * Output the select form for the language selection on the installation screen.
 *
 * @since 4.0.0
 *
 * @global string $jp_local_package
 *
 * @param array $languages Array of available languages (populated via the Translation API).
 */
function jp_install_language_form( $languages ) {
	global $jp_local_package;

	$installed_languages = get_available_languages();

	echo "<label class='screen-reader-text' for='language'>Select a default language</label>\n";
	echo "<select size='14' name='language' id='language'>\n";
	echo '<option value="" lang="en" selected="selected" data-continue="Continue" data-installed="1">English (United States)</option>';
	echo "\n";

	if ( ! empty( $jp_local_package ) && isset( $languages[ $jp_local_package ] ) ) {
		if ( isset( $languages[ $jp_local_package ] ) ) {
			$language = $languages[ $jp_local_package ];
			printf(
				'<option value="%s" lang="%s" data-continue="%s"%s>%s</option>' . "\n",
				esc_attr( $language['language'] ),
				esc_attr( current( $language['iso'] ) ),
				esc_attr( $language['strings']['continue'] ),
				in_array( $language['language'], $installed_languages ) ? ' data-installed="1"' : '',
				esc_html( $language['native_name'] )
			);

			unset( $languages[ $jp_local_package ] );
		}
	}

	foreach ( $languages as $language ) {
		printf(
			'<option value="%s" lang="%s" data-continue="%s"%s>%s</option>' . "\n",
			esc_attr( $language['language'] ),
			esc_attr( current( $language['iso'] ) ),
			esc_attr( $language['strings']['continue'] ),
			in_array( $language['language'], $installed_languages ) ? ' data-installed="1"' : '',
			esc_html( $language['native_name'] )
		);
	}
	echo "</select>\n";
	echo '<p class="step"><span class="spinner"></span><input id="language-continue" type="submit" class="button button-primary button-large" value="Continue" /></p>';
}

/**
 * Download a language pack.
 *
 * @since 4.0.0
 *
 * @see jp_get_available_translations()
 *
 * @param string $download Language code to download.
 * @return string|bool Returns the language code if successfully downloaded
 *                     (or already installed), or false on failure.
 */
function jp_download_language_pack( $download ) {
	// Check if the translation is already installed.
	if ( in_array( $download, get_available_languages() ) ) {
		return $download;
	}

	if ( ! jp_is_file_mod_allowed( 'download_language_pack' ) ) {
		return false;
	}

	// Confirm the translation is one we can download.
	$translations = jp_get_available_translations();
	if ( ! $translations ) {
		return false;
	}
	foreach ( $translations as $translation ) {
		if ( $translation['language'] === $download ) {
			$translation_to_load = true;
			break;
		}
	}

	if ( empty( $translation_to_load ) ) {
		return false;
	}
	$translation = (object) $translation;

	require_once ABSPATH . 'jp-admin/includes/class-jp-upgrader.php';
	$skin              = new Automatic_Upgrader_Skin;
	$upgrader          = new Language_Pack_Upgrader( $skin );
	$translation->type = 'core';
	$result            = $upgrader->upgrade( $translation, array( 'clear_update_cache' => false ) );

	if ( ! $result || is_jp_error( $result ) ) {
		return false;
	}

	return $translation->language;
}

/**
 * Check if JonPress has access to the filesystem without asking for
 * credentials.
 *
 * @since 4.0.0
 *
 * @return bool Returns true on success, false on failure.
 */
function jp_can_install_language_pack() {
	if ( ! jp_is_file_mod_allowed( 'can_install_language_pack' ) ) {
		return false;
	}

	require_once ABSPATH . 'jp-admin/includes/class-jp-upgrader.php';
	$skin     = new Automatic_Upgrader_Skin;
	$upgrader = new Language_Pack_Upgrader( $skin );
	$upgrader->init();

	$check = $upgrader->fs_connect( array( JP_CONTENT_DIR, JP_LANG_DIR ) );

	if ( ! $check || is_jp_error( $check ) ) {
		return false;
	}

	return true;
}
