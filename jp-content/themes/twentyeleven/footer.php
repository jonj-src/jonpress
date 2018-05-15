<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package JonPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/*
				 * A sidebar in the footer? Yep. You can customize
				 * your footer with three columns of widgets.
				 */
			if ( ! is_404() ) {
				get_sidebar( 'footer' );
			}
			?>

			<div id="site-generator">
				<?php do_action( 'twentyeleven_credits' ); ?>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'https://jonpress.org/', 'twentyeleven' ) ); ?>" class="imprint" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentyeleven' ); ?>">
					<?php printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'JonPress' ); ?>
				</a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php jp_footer(); ?>

</body>
</html>