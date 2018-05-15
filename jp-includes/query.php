<?php
/**
 * JonPress Query API
 *
 * The query API attempts to get which part of JonPress the user is on. It
 * also provides functionality for getting URL query information.
 *
 * @link https://codex.jonpress.org/The_Loop More information on The Loop.
 *
 * @package JonPress
 * @subpackage Query
 */

/**
 * Retrieve variable in the JP_Query class.
 *
 * @since 1.5.0
 * @since 3.9.0 The `$default` argument was introduced.
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param string $var       The variable key to retrieve.
 * @param mixed  $default   Optional. Value to return if the query variable is not set. Default empty.
 * @return mixed Contents of the query variable.
 */
function get_query_var( $var, $default = '' ) {
	global $jp_query;
	return $jp_query->get( $var, $default );
}

/**
 * Retrieve the currently-queried object.
 *
 * Wrapper for JP_Query::get_queried_object().
 *
 * @since 3.1.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return object Queried object.
 */
function get_queried_object() {
	global $jp_query;
	return $jp_query->get_queried_object();
}

/**
 * Retrieve ID of the current queried object.
 *
 * Wrapper for JP_Query::get_queried_object_id().
 *
 * @since 3.1.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return int ID of the queried object.
 */
function get_queried_object_id() {
	global $jp_query;
	return $jp_query->get_queried_object_id();
}

/**
 * Set query variable.
 *
 * @since 2.2.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param string $var   Query variable key.
 * @param mixed  $value Query variable value.
 */
function set_query_var( $var, $value ) {
	global $jp_query;
	$jp_query->set( $var, $value );
}

/**
 * Sets up The Loop with query parameters.
 *
 * Note: This function will completely override the main query and isn't intended for use
 * by plugins or themes. Its overly-simplistic approach to modifying the main query can be
 * problematic and should be avoided wherever possible. In most cases, there are better,
 * more performant options for modifying the main query such as via the {@see 'pre_get_posts'}
 * action within JP_Query.
 *
 * This must not be used within the JonPress Loop.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param array|string $query Array or string of JP_Query arguments.
 * @return array List of post objects.
 */
function query_posts( $query ) {
	$GLOBALS['jp_query'] = new JP_Query();
	return $GLOBALS['jp_query']->query( $query );
}

/**
 * Destroys the previous query and sets up a new query.
 *
 * This should be used after query_posts() and before another query_posts().
 * This will remove obscure bugs that occur when the previous JP_Query object
 * is not destroyed properly before another is set up.
 *
 * @since 2.3.0
 *
 * @global JP_Query $jp_query     Global JP_Query instance.
 * @global JP_Query $jp_the_query Copy of the global JP_Query instance created during jp_reset_query().
 */
function jp_reset_query() {
	$GLOBALS['jp_query'] = $GLOBALS['jp_the_query'];
	jp_reset_postdata();
}

/**
 * After looping through a separate query, this function restores
 * the $post global to the current post in the main query.
 *
 * @since 3.0.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 */
function jp_reset_postdata() {
	global $jp_query;

	if ( isset( $jp_query ) ) {
		$jp_query->reset_postdata();
	}
}

/*
 * Query type checks.
 */

/**
 * Determines whether the query is for an existing archive page.
 *
 * Month, Year, Category, Author, Post Type archive...
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_archive() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_archive();
}

/**
 * Determines whether the query is for an existing post type archive page.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 3.1.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param string|array $post_types Optional. Post type or array of posts types to check against.
 * @return bool
 */
function is_post_type_archive( $post_types = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_post_type_archive( $post_types );
}

/**
 * Determines whether the query is for an existing attachment page.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.0.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param int|string|array|object $attachment Attachment ID, title, slug, or array of such.
 * @return bool
 */
function is_attachment( $attachment = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_attachment( $attachment );
}

/**
 * Determines whether the query is for an existing author archive page.
 *
 * If the $author parameter is specified, this function will additionally
 * check if the query is for one of the authors specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param mixed $author Optional. User ID, nickname, nicename, or array of User IDs, nicknames, and nicenames
 * @return bool
 */
function is_author( $author = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_author( $author );
}

/**
 * Determines whether the query is for an existing category archive page.
 *
 * If the $category parameter is specified, this function will additionally
 * check if the query is for one of the categories specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param mixed $category Optional. Category ID, name, slug, or array of Category IDs, names, and slugs.
 * @return bool
 */
function is_category( $category = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_category( $category );
}

/**
 * Determines whether the query is for an existing tag archive page.
 *
 * If the $tag parameter is specified, this function will additionally
 * check if the query is for one of the tags specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.3.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param mixed $tag Optional. Tag ID, name, slug, or array of Tag IDs, names, and slugs.
 * @return bool
 */
function is_tag( $tag = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_tag( $tag );
}

/**
 * Determines whether the query is for an existing custom taxonomy archive page.
 *
 * If the $taxonomy parameter is specified, this function will additionally
 * check if the query is for that specific $taxonomy.
 *
 * If the $term parameter is specified in addition to the $taxonomy parameter,
 * this function will additionally check if the query is for one of the terms
 * specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param string|array     $taxonomy Optional. Taxonomy slug or slugs.
 * @param int|string|array $term     Optional. Term ID, name, slug or array of Term IDs, names, and slugs.
 * @return bool True for custom taxonomy archive pages, false for built-in taxonomies (category and tag archives).
 */
function is_tax( $taxonomy = '', $term = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_tax( $taxonomy, $term );
}

/**
 * Determines whether the query is for an existing date archive.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_date() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_date();
}

/**
 * Determines whether the query is for an existing day archive.
 *
 * A conditional check to test whether the page is a date-based archive page displaying posts for the current day.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_day() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_day();
}

/**
 * Determines whether the query is for a feed.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param string|array $feeds Optional feed types to check.
 * @return bool
 */
function is_feed( $feeds = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_feed( $feeds );
}

/**
 * Is the query for a comments feed?
 *
 * @since 3.0.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_comment_feed() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_comment_feed();
}

/**
 * Determines whether the query is for the front page of the site.
 *
 * This is for what is displayed at your site's main URL.
 *
 * Depends on the site's "Front page displays" Reading Settings 'show_on_front' and 'page_on_front'.
 *
 * If you set a static page for the front page of your site, this function will return
 * true when viewing that page.
 *
 * Otherwise the same as @see is_home()
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool True, if front of site.
 */
function is_front_page() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_front_page();
}

/**
 * Determines whether the query is for the blog homepage.
 *
 * The blog homepage is the page that shows the time-based blog content of the site.
 *
 * is_home() is dependent on the site's "Front page displays" Reading Settings 'show_on_front'
 * and 'page_for_posts'.
 *
 * If a static page is set for the front page of the site, this function will return true only
 * on the page you set as the "Posts page".
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @see is_front_page()
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool True if blog view homepage, otherwise false.
 */
function is_home() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_home();
}

/**
 * Determines whether the query is for an existing month archive.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_month() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_month();
}

/**
 * Determines whether the query is for an existing single page.
 *
 * If the $page parameter is specified, this function will additionally
 * check if the query is for one of the pages specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @see is_single()
 * @see is_singular()
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param int|string|array $page Optional. Page ID, title, slug, or array of such. Default empty.
 * @return bool Whether the query is for an existing single page.
 */
function is_page( $page = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_page( $page );
}

/**
 * Determines whether the query is for paged results and not for the first page.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_paged() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_paged();
}

/**
 * Determines whether the query is for a post or page preview.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.0.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_preview() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_preview();
}

/**
 * Is the query for the robots file?
 *
 * @since 2.1.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_robots() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_robots();
}

/**
 * Determines whether the query is for a search.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_search() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_search();
}

/**
 * Determines whether the query is for an existing single post.
 *
 * Works for any post type, except attachments and pages
 *
 * If the $post parameter is specified, this function will additionally
 * check if the query is for one of the Posts specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @see is_page()
 * @see is_singular()
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param int|string|array $post Optional. Post ID, title, slug, or array of such. Default empty.
 * @return bool Whether the query is for an existing single post.
 */
function is_single( $post = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_single( $post );
}

/**
 * Determines whether the query is for an existing single post of any post type
 * (post, attachment, page, custom post types).
 *
 * If the $post_types parameter is specified, this function will additionally
 * check if the query is for one of the Posts Types specified.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @see is_page()
 * @see is_single()
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param string|array $post_types Optional. Post type or array of post types. Default empty.
 * @return bool Whether the query is for an existing single post of any of the given post types.
 */
function is_singular( $post_types = '' ) {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_singular( $post_types );
}

/**
 * Determines whether the query is for a specific time.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_time() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_time();
}

/**
 * Determines whether the query is for a trackback endpoint call.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_trackback() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_trackback();
}

/**
 * Determines whether the query is for an existing year archive.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_year() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_year();
}

/**
 * Determines whether the query has resulted in a 404 (returns no results).
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_404() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_404();
}

/**
 * Is the query for an embedded post?
 *
 * @since 4.4.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool Whether we're in an embedded post or not.
 */
function is_embed() {
	global $jp_query;

	if ( ! isset( $jp_query ) ) {
		_doing_it_wrong( __FUNCTION__, __( 'Conditional query tags do not work before the query is run. Before then, they always return false.' ), '3.1.0' );
		return false;
	}

	return $jp_query->is_embed();
}

/**
 * Determines whether the query is the main query.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 3.3.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function is_main_query() {
	if ( 'pre_get_posts' === current_filter() ) {
		$message = sprintf(
			/* translators: 1: pre_get_posts 2: JP_Query->is_main_query() 3: is_main_query() 4: link to codex is_main_query() page. */
			__( 'In %1$s, use the %2$s method, not the %3$s function. See %4$s.' ),
			'<code>pre_get_posts</code>',
			'<code>JP_Query->is_main_query()</code>',
			'<code>is_main_query()</code>',
			__( 'https://codex.jonpress.org/Function_Reference/is_main_query' )
		);
		_doing_it_wrong( __FUNCTION__, $message, '3.7.0' );
	}

	global $jp_query;
	return $jp_query->is_main_query();
}

/*
 * The Loop. Post loop control.
 */

/**
 * Whether current JonPress query has results to loop over.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function have_posts() {
	global $jp_query;
	return $jp_query->have_posts();
}

/**
 * Determines whether the caller is in the Loop.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.jonpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.0.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool True if caller is within loop, false if loop hasn't started or ended.
 */
function in_the_loop() {
	global $jp_query;
	return $jp_query->in_the_loop;
}

/**
 * Rewind the loop posts.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 */
function rewind_posts() {
	global $jp_query;
	$jp_query->rewind_posts();
}

/**
 * Iterate the post index in the loop.
 *
 * @since 1.5.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 */
function the_post() {
	global $jp_query;
	$jp_query->the_post();
}

/*
 * Comments loop.
 */

/**
 * Whether there are comments to loop over.
 *
 * @since 2.2.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return bool
 */
function have_comments() {
	global $jp_query;
	return $jp_query->have_comments();
}

/**
 * Iterate comment index in the comment loop.
 *
 * @since 2.2.0
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @return object
 */
function the_comment() {
	global $jp_query;
	return $jp_query->the_comment();
}

/**
 * Redirect old slugs to the correct permalink.
 *
 * Attempts to find the current slug from the past slugs.
 *
 * @since 2.1.0
 */
function jp_old_slug_redirect() {
	if ( is_404() && '' !== get_query_var( 'name' ) ) {
		// Guess the current post_type based on the query vars.
		if ( get_query_var( 'post_type' ) ) {
			$post_type = get_query_var( 'post_type' );
		} elseif ( get_query_var( 'attachment' ) ) {
			$post_type = 'attachment';
		} elseif ( get_query_var( 'pagename' ) ) {
			$post_type = 'page';
		} else {
			$post_type = 'post';
		}

		if ( is_array( $post_type ) ) {
			if ( count( $post_type ) > 1 ) {
				return;
			}
			$post_type = reset( $post_type );
		}

		// Do not attempt redirect for hierarchical post types
		if ( is_post_type_hierarchical( $post_type ) ) {
			return;
		}

		$id = _find_post_by_old_slug( $post_type );

		if ( ! $id ) {
			$id = _find_post_by_old_date( $post_type );
		}

		/**
		 * Filters the old slug redirect post ID.
		 *
		 * @since 4.9.3
		 *
		 * @param int $id The redirect post ID.
		 */
		$id = apply_filters( 'old_slug_redirect_post_id', $id );

		if ( ! $id ) {
			return;
		}

		$link = get_permalink( $id );

		if ( get_query_var( 'paged' ) > 1 ) {
			$link = user_trailingslashit( trailingslashit( $link ) . 'page/' . get_query_var( 'paged' ) );
		} elseif ( is_embed() ) {
			$link = user_trailingslashit( trailingslashit( $link ) . 'embed' );
		}

		/**
		 * Filters the old slug redirect URL.
		 *
		 * @since 4.4.0
		 *
		 * @param string $link The redirect URL.
		 */
		$link = apply_filters( 'old_slug_redirect_url', $link );

		if ( ! $link ) {
			return;
		}

		jp_redirect( $link, 301 ); // Permanent redirect
		exit;
	}
}

/**
 * Find the post ID for redirecting an old slug.
 *
 * @see jp_old_slug_redirect()
 *
 * @since 4.9.3
 * @access private
 *
 * @global wpdb $wpdb JonPress database abstraction object.
 *
 * @param string $post_type The current post type based on the query vars.
 * @return int $id The Post ID.
 */
function _find_post_by_old_slug( $post_type ) {
	global $wpdb;

	$query = $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta, $wpdb->posts WHERE ID = post_id AND post_type = %s AND meta_key = '_jp_old_slug' AND meta_value = %s", $post_type, get_query_var( 'name' ) );

	// if year, monthnum, or day have been specified, make our query more precise
	// just in case there are multiple identical _jp_old_slug values
	if ( get_query_var( 'year' ) ) {
		$query .= $wpdb->prepare( " AND YEAR(post_date) = %d", get_query_var( 'year' ) );
	}
	if ( get_query_var( 'monthnum' ) ) {
		$query .= $wpdb->prepare( " AND MONTH(post_date) = %d", get_query_var( 'monthnum' ) );
	}
	if ( get_query_var( 'day' ) ) {
		$query .= $wpdb->prepare( " AND DAYOFMONTH(post_date) = %d", get_query_var( 'day' ) );
	}

	$id = (int) $wpdb->get_var( $query );

	return $id;
}

/**
 * Find the post ID for redirecting an old date.
 *
 * @see jp_old_slug_redirect()
 *
 * @since 4.9.3
 * @access private
 *
 * @global wpdb $wpdb JonPress database abstraction object.
 *
 * @param string $post_type The current post type based on the query vars.
 * @return int $id The Post ID.
 */
function _find_post_by_old_date( $post_type ) {
	global $wpdb;

	$date_query = '';
	if ( get_query_var( 'year' ) ) {
		$date_query .= $wpdb->prepare( " AND YEAR(pm_date.meta_value) = %d", get_query_var( 'year' ) );
	}
	if ( get_query_var( 'monthnum' ) ) {
		$date_query .= $wpdb->prepare( " AND MONTH(pm_date.meta_value) = %d", get_query_var( 'monthnum' ) );
	}
	if ( get_query_var( 'day' ) ) {
		$date_query .= $wpdb->prepare( " AND DAYOFMONTH(pm_date.meta_value) = %d", get_query_var( 'day' ) );
	}

	$id = 0;
	if ( $date_query ) {
		$id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta AS pm_date, $wpdb->posts WHERE ID = post_id AND post_type = %s AND meta_key = '_jp_old_date' AND post_name = %s" . $date_query, $post_type, get_query_var( 'name' ) ) );

		if ( ! $id ) {
			// Check to see if an old slug matches the old date
			$id = (int) $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts, $wpdb->postmeta AS pm_slug, $wpdb->postmeta AS pm_date WHERE ID = pm_slug.post_id AND ID = pm_date.post_id AND post_type = %s AND pm_slug.meta_key = '_jp_old_slug' AND pm_slug.meta_value = %s AND pm_date.meta_key = '_jp_old_date'" . $date_query, $post_type, get_query_var( 'name' ) ) );
		}
	}

	return $id;
}

/**
 * Set up global post data.
 *
 * @since 1.5.0
 * @since 4.4.0 Added the ability to pass a post ID to `$post`.
 *
 * @global JP_Query $jp_query Global JP_Query instance.
 *
 * @param JP_Post|object|int $post JP_Post instance or Post ID/object.
 * @return bool True when finished.
 */
function setup_postdata( $post ) {
	global $jp_query;

	if ( ! empty( $jp_query ) && $jp_query instanceof JP_Query ) {
		return $jp_query->setup_postdata( $post );
	}

	return false;
}