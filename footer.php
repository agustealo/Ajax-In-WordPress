<?php
/**
 * Theme footer.
 *
 * @package AjaxInWP
 */

$footer_layout = get_theme_mod( 'ajaxinwp_footer_layout', 'd-block' );
$footer_text   = get_theme_mod( 'ajaxinwp_footer_text', '' );
?>
<footer id="colophon" class="site-footer <?php echo esc_attr( $footer_layout ); ?>">
	<div class="site-info row">
		<?php if ( ! empty( $footer_text ) ) : ?>
			<span class="footer-text col-auto"><?php echo esc_html( $footer_text ); ?></span>
		<?php else : ?>
			<a href="https://wordpress.org/" class="col-auto"><?php esc_html_e( 'Proudly powered by WordPress', 'ajaxinwp' ); ?></a>
		<?php endif; ?>

		<span class="col-auto">
			&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
			<a href="https://agustealo.com/" target="_blank" rel="noopener noreferrer">Zeus Eternal (Agustealo)</a>.
			<?php esc_html_e( 'All rights reserved.', 'ajaxinwp' ); ?>
		</span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
