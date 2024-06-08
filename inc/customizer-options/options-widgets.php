<?php
function ajaxinwp_customize_register($wp_customize) {
    // Add a section for widgets
    $wp_customize->add_section('ajaxinwp_widgets', [
        'title'    => __('Widgets', 'ajaxinwp'),
        'priority' => 160,
    ]);

    // Add a setting for widget areas
    $wp_customize->add_setting('ajaxinwp_widget_areas', [
        'default'           => ['Header1', 'Widget1', 'Widget2', 'Widget3', 'Widget4'],
        'sanitize_callback' => 'ajaxinwp_sanitize_widget_areas',
    ]);

    $wp_customize->add_control('ajaxinwp_widget_areas', [
        'label'       => __('Widget Areas', 'ajaxinwp'),
        'section'     => 'ajaxinwp_widgets',
        'settings'    => 'ajaxinwp_widget_areas',
        'type'        => 'textarea',
        'description' => __('Enter widget area names separated by new lines.', 'ajaxinwp'),
    ]);
}

add_action('customize_register', 'ajaxinwp_customize_register');

/**
 * Sanitize widget areas
 *
 * @param string $input The input to sanitize.
 * @return array The sanitized input.
 */
function ajaxinwp_sanitize_widget_areas($input) {
    $input = explode("\n", $input);
    $input = array_map('trim', $input);
    $input = array_filter($input);
    return $input;
}
?>