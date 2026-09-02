<?php
/**
 * Primary sidebar template.
 *
 * @package AjaxInWP
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'ajaxinwp' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
