<?php
// Widget area for additional content in the header
if (is_active_sidebar('ajaxinwp_widget_area_header1')) {
    echo '<div class="widget-hero">';
    dynamic_sidebar('ajaxinwp_widget_area_header1');
    echo        '</div>';
}
?>
