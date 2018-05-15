<?php
/**
 * Credits administration panel.
 *
 * @package JonPress
 * @subpackage Administration
 */

/** JonPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );
require_once( dirname( __FILE__ ) . '/includes/credits.php' );

$title = __( 'Credits' );

list( $display_version ) = explode( '-', get_bloginfo( 'version' ) );

include( ABSPATH . 'jp-admin/admin-header.php' );
?>
<div class="wrap about-wrap full-width-layout">

<h1><?php printf( __( 'Welcome to JonPress %s' ), $display_version ); ?></h1>

<p class="about-text"><?php printf( __( 'Thank you for updating to the latest version! JonPress %s will smooth your design workflow and keep you safe from coding errors.' ), $display_version ); ?></p>

<div class="jp-badge"><?php printf( __( 'Version %s' ), $display_version ); ?></div>

<h2 class="nav-tab-wrapper jp-clearfix">
	<a href="about.php" class="nav-tab"><?php _e( 'What&#8217;s New' ); ?></a>
	<a href="credits.php" class="nav-tab nav-tab-active"><?php _e( 'Credits' ); ?></a>
	<a href="freedoms.php" class="nav-tab"><?php _e( 'Freedoms' ); ?></a>
	<a href="freedoms.php?privacy-notice" class="nav-tab"><?php _e( 'Privacy' ); ?></a>
</h2>

<div class="about-wrap-content">
<?php

$credits = jp_credits();

if ( ! $credits ) {
	echo '<p class="about-description">';
	/* translators: 1: https://jonpress.org/about/, 2: https://make.jonpress.org/ */
	printf(
		__( 'JonPress is created by a <a href="%1$s">worldwide team</a> of passionate individuals. <a href="%2$s">Get involved in JonPress</a>.' ),
		'https://jonpress.org/about/',
		__( 'https://make.jonpress.org/' )
	);
	echo '</p>';
	echo '</div>';
	echo '</div>';
	include( ABSPATH . 'jp-admin/admin-footer.php' );
	exit;
}

echo '<p class="about-description">' . __( 'JonPress is created by a worldwide team of passionate individuals.' ) . "</p>\n";

echo '<p>' . sprintf(
	/* translators: %s: https://make.jonpress.org/ */
	__( 'Want to see your name in lights on this page? <a href="%s">Get involved in JonPress</a>.' ),
	__( 'https://make.jonpress.org/' )
) . '</p>';

foreach ( $credits['groups'] as $group_slug => $group_data ) {
	if ( $group_data['name'] ) {
		if ( 'Translators' == $group_data['name'] ) {
			// Considered a special slug in the API response. (Also, will never be returned for en_US.)
			$title = _x( 'Translators', 'Translate this to be the equivalent of English Translators in your language for the credits page Translators section' );
		} elseif ( isset( $group_data['placeholders'] ) ) {
			$title = vsprintf( translate( $group_data['name'] ), $group_data['placeholders'] );
		} else {
			$title = translate( $group_data['name'] );
		}

		echo '<h3 class="jp-people-group">' . esc_html( $title ) . "</h3>\n";
	}

	if ( ! empty( $group_data['shuffle'] ) ) {
		shuffle( $group_data['data'] ); // We were going to sort by ability to pronounce "hierarchical," but that wouldn't be fair to Matt.
	}

	switch ( $group_data['type'] ) {
		case 'list':
			array_walk( $group_data['data'], '_jp_credits_add_profile_link', $credits['data']['profiles'] );
			echo '<p class="jp-credits-list">' . jp_sprintf( '%l.', $group_data['data'] ) . "</p>\n\n";
			break;
		case 'libraries':
			array_walk( $group_data['data'], '_jp_credits_build_object_link' );
			echo '<p class="jp-credits-list">' . jp_sprintf( '%l.', $group_data['data'] ) . "</p>\n\n";
			break;
		default:
			$compact = 'compact' == $group_data['type'];
			$classes = 'jp-people-group ' . ( $compact ? 'compact' : '' );
			echo '<ul class="' . $classes . '" id="jp-people-group-' . $group_slug . '">' . "\n";
			foreach ( $group_data['data'] as $person_data ) {
				echo '<li class="jp-person" id="jp-person-' . esc_attr( $person_data[2] ) . '">' . "\n\t";
				echo '<a href="' . esc_url( sprintf( $credits['data']['profiles'], $person_data[2] ) ) . '" class="web">';
				$size   = 'compact' == $group_data['type'] ? 30 : 60;
				$data   = get_avatar_data( $person_data[1] . '@md5.gravatar.com', array( 'size' => $size ) );
				$size  *= 2;
				$data2x = get_avatar_data( $person_data[1] . '@md5.gravatar.com', array( 'size' => $size ) );
				echo '<img src="' . esc_url( $data['url'] ) . '" srcset="' . esc_url( $data2x['url'] ) . ' 2x" class="gravatar" alt="" />' . "\n";
				echo esc_html( $person_data[0] ) . "</a>\n\t";
				if ( ! $compact ) {
					echo '<span class="title">' . translate( $person_data[3] ) . "</span>\n";
				}
				echo "</li>\n";
			}
			echo "</ul>\n";
			break;
	}
}

?>
</div>
</div>
<?php

include( ABSPATH . 'jp-admin/admin-footer.php' );

return;

// These are strings returned by the API that we want to be translatable
__( 'Project Leaders' );
__( 'Core Contributors to JonPress %s' );
__( 'Noteworthy Contributors' );
__( 'Cofounder, Project Lead' );
__( 'Lead Developer' );
__( 'Release Lead' );
__( 'Release Design Lead' );
__( 'Release Deputy' );
__( 'Core Developer' );
__( 'External Libraries' );
