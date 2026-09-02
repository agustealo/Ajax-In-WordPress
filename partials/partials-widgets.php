<?php
/**
 * Footer widget grid.
 *
 * @package AjaxInWP
 */

$widget_areas = array( 'Widget1', 'Widget2', 'Widget3', 'Widget4' );
$active_areas = array_filter(
	$widget_areas,
	static function ( $widget_area ) {
		return is_active_sidebar( 'ajaxinwp_widget_area_' . sanitize_title( $widget_area ) );
	}
);

if ( empty( $active_areas ) ) {
	return;
}
?>
<div class="widget-container row mt-4">
	<?php foreach ( $active_areas as $widget_area ) : ?>
		<?php $widget_area_id = 'ajaxinwp_widget_area_' . sanitize_title( $widget_area ); ?>
		<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
			<div class="widget-area card">
				<?php dynamic_sidebar( $widget_area_id ); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
