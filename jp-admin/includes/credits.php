<?php
/**
 * JonPress Credits Administration API.
 *
 * @package JonPress
 * @subpackage Administration
 * @since 4.4.0
 */

/**
 * Retrieve the contributor credits.
 *
 * @since 3.2.0
 *
 * @return array|false A list of all of the contributors, or false on error.
 */
function jp_credits() {
	// include an unmodified $jp_version
	include( ABSPATH . WPINC . '/version.php' );

	$locale = get_user_locale();

	$results = get_site_transient( 'jonpress_credits_' . $locale );

	if ( ! is_array( $results )
		|| false !== strpos( $jp_version, '-' )
		|| ( isset( $results['data']['version'] ) && strpos( $jp_version, $results['data']['version'] ) !== 0 )
	) {
		$url     = "http://api.jonpress.org/core/credits/1.1/?version={$jp_version}&locale={$locale}";
		$options = array( 'user-agent' => 'JonPress/' . $jp_version . '; ' . home_url( '/' ) );

		if ( jp_http_supports( array( 'ssl' ) ) ) {
			$url = set_url_scheme( $url, 'https' );
		}

		$response = jp_remote_get( $url, $options );

		if ( is_jp_error( $response ) || 200 != jp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		$results = json_decode( jp_remote_retrieve_body( $response ), true );

		if ( ! is_array( $results ) ) {
			return false;
		}

		set_site_transient( 'jonpress_credits_' . $locale, $results, DAY_IN_SECONDS );
	}

	return $results;
}

/**
 * Retrieve the link to a contributor's JonPress.org profile page.
 *
 * @access private
 * @since 3.2.0
 *
 * @param string $display_name  The contributor's display name (passed by reference).
 * @param string $username      The contributor's username.
 * @param string $profiles      URL to the contributor's JonPress.org profile page.
 */
function _jp_credits_add_profile_link( &$display_name, $username, $profiles ) {
	$display_name = '<a href="' . esc_url( sprintf( $profiles, $username ) ) . '">' . esc_html( $display_name ) . '</a>';
}

/**
 * Retrieve the link to an external library used in JonPress.
 *
 * @access private
 * @since 3.2.0
 *
 * @param string $data External library data (passed by reference).
 */
function _jp_credits_build_object_link( &$data ) {
	$data = '<a href="' . esc_url( $data[1] ) . '">' . esc_html( $data[0] ) . '</a>';
}
