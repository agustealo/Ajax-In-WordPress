<?php
$header_layout = get_theme_mod('ajaxinwp_header_layout', 'container');
$header_fluid = ($header_layout === 'container-fluid') ? 'px-0' : '';
$nav_layout = get_theme_mod('ajaxinwp_navigation_layout', 'container');

// Determine the padding top class
$padd_top_class = ($nav_layout === 'position-fixed') ? 'padding-header-top' : (($header_layout === 'container-fluid') ? 'mt-0' : 'hero-top');

// Widget area for additional content in the header
if (is_active_sidebar('ajaxinwp_widget_area_header1')) {
    $widget_area = 'Header1';
    $widget_area_slug = sanitize_title($widget_area);
    $widget_icon = get_theme_mod("ajaxinwp_{$widget_area}_icon", '&#128199;'); // Default icon
    $custom_icon = get_theme_mod("ajaxinwp_{$widget_area}_custom_icon", '');
    $icon = ($widget_icon === 'custom' && !empty($custom_icon)) ? $custom_icon : $widget_icon;
    $description = get_theme_mod("ajaxinwp_{$widget_area}_description", '');
    $show_icon = get_theme_mod("ajaxinwp_{$widget_area}_show_icon", true);
    $show_title = get_theme_mod("ajaxinwp_{$widget_area}_show_title", true);
    $show_description = get_theme_mod("ajaxinwp_{$widget_area}_show_description", true);

    echo '<div class="col ' . esc_attr($padd_top_class) . '">
                <div class="mb-5 ' . esc_attr($header_layout . ' ' . $header_fluid) . '">
                    <div class="widget-hero">';
    dynamic_sidebar('ajaxinwp_widget_area_header1');
    
    if ($show_icon || $show_title) {
        echo '<div class="widget-title px-2">';
        if ($show_icon) {
            echo '<span class="widget-icon">' . html_entity_decode($icon) . '</span>';
        }
        if ($show_title) {
            echo esc_html(get_theme_mod("ajaxinwp_{$widget_area}_name", $widget_area));
        }
        echo '</div>';
    }
    
    if ($show_description && !empty($description)) {
        echo '<div class="widget-description hero-description p-2">' . esc_html($description) . '</div>';
    }
    echo        '</div>';
    echo '</div>';
    echo '</div>';
}
?>
