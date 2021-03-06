<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package JonPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<a href="<?php echo esc_url( __( 'https://jonpress.org/', 'twentythirteen' ) ); ?>" class="imprint">
					<?php printf( __( 'Proudly powered by %s', 'twentythirteen' ), 'JonPress' ); ?>
				</a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php jp_footer(); ?>
</body>
</html>
