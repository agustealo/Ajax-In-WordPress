<?php ?>
    <div class="widget-container row mt-4">
        <?php
        // Display widget areas with Bootstrap 5 grid system
        $widget_areas = ['Widget1', 'Widget2', 'Widget3', 'Widget4', 'Sidebar1'];
        foreach ($widget_areas as $widget_area) {
            $widget_area_slug = sanitize_title($widget_area);
            if (is_active_sidebar('ajaxinwp_widget_area_' . $widget_area_slug)) {
        ?>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="widget-area card">
                <?php dynamic_sidebar('ajaxinwp_widget_area_' . $widget_area_slug); ?>
            </div>
        </div>
                <?php
            }
        }
        ?>
</div> <!-- Close container -->
