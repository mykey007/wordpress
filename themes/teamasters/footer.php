<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
</div><!-- #page -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
		<?php
			/* footer sidebar */
			if ( ! is_404() ) : ?>
				<div id="footer-widgets" class="widget-area three">
					<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-4' ); ?>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-6' ); ?>
					<?php endif; ?>
				</div><!-- #footer-widgets -->
		<?php endif; ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>