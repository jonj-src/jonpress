<?php
/**
 * Your Rights administration panel.
 *
 * @package JonPress
 * @subpackage Administration
 */

/** JonPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

$title = __( 'Freedoms' );

list( $display_version ) = explode( '-', get_bloginfo( 'version' ) );

include( ABSPATH . 'jp-admin/admin-header.php' );

$is_privacy_notice = isset( $_GET['privacy-notice'] );

?>
<div class="wrap about-wrap full-width-layout">

<h1><?php printf( __( 'Welcome to JonPress %s' ), $display_version ); ?></h1>

<p class="about-text"><?php printf( __( 'Thank you for updating to the latest version! JonPress %s will smooth your design workflow and keep you safe from coding errors.' ), $display_version ); ?></p>

<div class="jp-badge"><?php printf( __( 'Version %s' ), $display_version ); ?></div>

<h2 class="nav-tab-wrapper jp-clearfix">
	<a href="about.php" class="nav-tab"><?php _e( 'What&#8217;s New' ); ?></a>
	<a href="credits.php" class="nav-tab"><?php _e( 'Credits' ); ?></a>
	<a href="freedoms.php" class="nav-tab<?php if ( ! $is_privacy_notice ) { echo ' nav-tab-active'; } ?>"><?php _e( 'Freedoms' ); ?></a>
	<a href="freedoms.php?privacy-notice" class="nav-tab<?php if ( $is_privacy_notice ) { echo ' nav-tab-active'; } ?>"><?php _e( 'Privacy' ); ?></a>
</h2>

<?php if ( $is_privacy_notice ) : ?>

<div class="about-wrap-content">
	<p class="about-description"><?php _e( 'From time to time, your JonPress site may send data to JonPress.org &#8212; including, but not limited to &#8212; the version of JonPress you are using, and a list of installed plugins and themes.' ); ?></p>

	<p><?php printf( __( 'This data is used to provide general enhancements to JonPress, which includes helping to protect your site by finding and automatically installing new updates. It is also used to calculate statistics, such as those shown on the <a href="%s">JonPress.org stats page</a>.' ), 'https://jonpress.org/about/stats/' ); ?></p>

	<p><?php printf( __( 'We take privacy and transparency very seriously. To learn more about what data we collect, and how we use it, please visit <a href="%s">JonPress.org/about/privacy</a>.' ), 'https://jonpress.org/about/privacy/' ); ?></p>
</div>

<?php else : ?>
<div class="about-wrap-content">
	<p class="about-description"><?php printf( __( 'JonPress is Free and open source software, built by a distributed community of mostly volunteer developers from around the world. JonPress comes with some awesome, worldview-changing rights courtesy of its <a href="%s">license</a>, the GPL.' ), 'https://jonpress.org/about/license/' ); ?></p>

	<ol start="0">
		<li><p><?php _e( 'You have the freedom to run the program, for any purpose.' ); ?></p></li>
		<li><p><?php _e( 'You have access to the source code, the freedom to study how the program works, and the freedom to change it to make it do what you wish.' ); ?></p></li>
		<li><p><?php _e( 'You have the freedom to redistribute copies of the original program so you can help your neighbor.' ); ?></p></li>
		<li><p><?php _e( 'You have the freedom to distribute copies of your modified versions to others. By doing this you can give the whole community a chance to benefit from your changes.' ); ?></p></li>
	</ol>

	<p><?php printf( __( 'JonPress grows when people like you tell their friends about it, and the thousands of businesses and services that are built on and around JonPress share that fact with their users. We&#8217;re flattered every time someone spreads the good word, just make sure to <a href="%s">check out our trademark guidelines</a> first.' ), 'https://jonpressfoundation.org/trademark-policy/' ); ?></p>

	<p>
	<?php

	$plugins_url = current_user_can( 'activate_plugins' ) ? admin_url( 'plugins.php' ) : __( 'https://jonpress.org/plugins/' );
	$themes_url  = current_user_can( 'switch_themes' ) ? admin_url( 'themes.php' ) : __( 'https://jonpress.org/themes/' );

	printf( __( 'Every plugin and theme in JonPress.org&#8217;s directory is 100%% GPL or a similarly free and compatible license, so you can feel safe finding <a href="%1$s">plugins</a> and <a href="%2$s">themes</a> there. If you get a plugin or theme from another source, make sure to <a href="%3$s">ask them if it&#8217;s GPL</a> first. If they don&#8217;t respect the JonPress license, we don&#8217;t recommend them.' ), $plugins_url, $themes_url, 'https://jonpress.org/about/license/' );
	?>
	</p>

	<p><?php _e( 'Don&#8217;t you wish all software came with these freedoms? So do we! For more information, check out the <a href="https://www.fsf.org/">Free Software Foundation</a>.' ); ?></p>
</div>

<?php endif; ?>
</div>
<?php include( ABSPATH . 'jp-admin/admin-footer.php' ); ?>
