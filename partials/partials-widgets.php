<?php
// Retrieve the widget layout setting value
$widget_layout = get_theme_mod('ajaxinwp_widget_layout', 'container');
?>
<div class="<?php echo esc_attr($widget_layout); ?>">
    <div class="widget-container row mt-4">
        <?php
        // Display widget areas with Bootstrap 5 grid system
        $widget_areas = ['Widget1', 'Widget2', 'Widget3', 'Widget4', 'Sidebar1'];
        foreach ($widget_areas as $widget_area) {
            $widget_area_slug = sanitize_title($widget_area);
            if (is_active_sidebar('ajaxinwp_widget_area_' . $widget_area_slug)) {
                $bg_color = get_theme_mod("ajaxinwp_{$widget_area}_bg_color", '#ffffff');
                $widget_icon = get_theme_mod("ajaxinwp_{$widget_area}_icon", '&#128199;'); // Default icon
                $custom_icon = get_theme_mod("ajaxinwp_{$widget_area}_custom_icon", '');
                $icon = ($widget_icon === 'custom' && !empty($custom_icon)) ? $custom_icon : $widget_icon;
                $description = get_theme_mod("ajaxinwp_{$widget_area}_description", '');
                $show_icon = get_theme_mod("ajaxinwp_{$widget_area}_show_icon", true);
                $show_title = get_theme_mod("ajaxinwp_{$widget_area}_show_title", true);
                $show_description = get_theme_mod("ajaxinwp_{$widget_area}_show_description", true);
                ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="widget-area card">
                        <?php if ($show_icon || $show_title): ?>
                            <div class="widget-title">
                                <?php if ($show_icon): ?>
                                    <span class="widget-icon"><?php echo html_entity_decode($icon); ?></span>
                                <?php endif; ?>
                                <?php if ($show_title): ?>
                                    <?php echo esc_html(get_theme_mod("ajaxinwp_{$widget_area}_name", $widget_area)); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php dynamic_sidebar('ajaxinwp_widget_area_' . $widget_area_slug); ?>
                        <?php if ($show_description && !empty($description)) : ?>
                            <div class="widget-description">
                            <p><?php echo esc_html($description); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div> <!-- Close widget-container -->
</div> <!-- Close container -->
