<?php
/**
 * Layout Options
 * Add settings and controls for layout customization
 */

// Add Layout Options Section
$wp_customize->add_section('ajaxinwp_layout_options', [
    'title'    => __('Layout Options', 'ajaxinwp'),
    'priority' => 120,
]);

// Navigation Position Setting and Control
$wp_customize->add_setting('ajaxinwp_navigation_position', [
    'default'           => 'position-fixed',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_navigation_position',
]);
$wp_customize->add_control('ajaxinwp_navigation_position', [
    'label'    => __('Navigation Position', 'ajaxinwp'),
    'section'  => 'ajaxinwp_layout_options',
    'settings' => 'ajaxinwp_navigation_position',
    'type'     => 'select',
    'choices'  => [
        'position-fixed'  => __('Fixed', 'ajaxinwp'),
        'position-static' => __('Static', 'ajaxinwp'),
    ],
]);

// Navigation Layout Setting and Control
$wp_customize->add_setting('ajaxinwp_navigation_layout', [
    'default'           => 'container',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_navigation_layout',
]);
$wp_customize->add_control('ajaxinwp_navigation_layout', [
    'label'    => __('Navigation Layout', 'ajaxinwp'),
    'section'  => 'ajaxinwp_layout_options',
    'settings' => 'ajaxinwp_navigation_layout',
    'type'     => 'select',
    'choices'  => [
        'default'         => __('Default', 'ajaxinwp'),
        'container'       => __('Container', 'ajaxinwp'),
        'container-fluid' => __('Container Fluid', 'ajaxinwp'),
    ],
]);

// Header Layout Setting and Control
$wp_customize->add_setting('ajaxinwp_header_layout', [
    'default'           => 'container',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_header_layout',
]);
$wp_customize->add_control('ajaxinwp_header_layout', [
    'label'    => __('Header Layout', 'ajaxinwp'),
    'section'  => 'ajaxinwp_layout_options',
    'settings' => 'ajaxinwp_header_layout',
    'type'     => 'select',
    'choices'  => [
        'default'         => __('Default', 'ajaxinwp'),
        'container'       => __('Container', 'ajaxinwp'),
        'container-fluid' => __('Container Fluid', 'ajaxinwp'),
    ],
]);

// Widget Layout Setting and Control
$wp_customize->add_setting('ajaxinwp_widget_layout', [
    'default'           => 'container',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_widget_layout',
]);
$wp_customize->add_control('ajaxinwp_widget_layout', [
    'label'    => __('Widget Layout', 'ajaxinwp'),
    'section'  => 'ajaxinwp_layout_options',
    'settings' => 'ajaxinwp_widget_layout',
    'type'     => 'select',
    'choices'  => [
        'default'         => __('Default', 'ajaxinwp'),
        'container'       => __('Container', 'ajaxinwp'),
        'container-fluid' => __('Container Fluid', 'ajaxinwp'),
    ],
]);

// Footer Layout Setting and Control
$wp_customize->add_setting('ajaxinwp_footer_layout', [
    'default'           => 'd-block',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_footer_layout',
]);
$wp_customize->add_control('ajaxinwp_footer_layout', [
    'label'    => __('Footer Layout', 'ajaxinwp'),
    'section'  => 'ajaxinwp_layout_options',
    'settings' => 'ajaxinwp_footer_layout',
    'type'     => 'select',
    'choices'  => [
        'default' => __('Default', 'ajaxinwp'),
        'd-none'  => __('None', 'ajaxinwp'),
        'd-block' => __('Show', 'ajaxinwp'),
    ],
]);

// Content Layout Setting and Control
$wp_customize->add_setting('ajaxinwp_content_layout', [
    'default'           => 'right-sidebar',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_content_layout',
]);
$wp_customize->add_control('ajaxinwp_content_layout', [
    'label'    => __('Content Layout', 'ajaxinwp'),
    'section'  => 'ajaxinwp_layout_options',
    'settings' => 'ajaxinwp_content_layout',
    'type'     => 'select',
    'choices'  => [
        'right-sidebar' => __('Right Sidebar', 'ajaxinwp'),
        'left-sidebar'  => __('Left Sidebar', 'ajaxinwp'),
        'no-sidebar'    => __('No Sidebar', 'ajaxinwp'),
    ],
]);

// Sanitize Navigation Position
function ajaxinwp_sanitize_navigation_position($input) {
    $valid = ['position-fixed', 'position-static'];
    return in_array($input, $valid, true) ? $input : 'position-fixed';
}

// Sanitize Navigation Layout
function ajaxinwp_sanitize_navigation_layout($input) {
    $valid = ['default', 'container', 'container-fluid'];
    return in_array($input, $valid, true) ? $input : 'container';
}

// Sanitize Header Layout
function ajaxinwp_sanitize_header_layout($input) {
    $valid = ['default', 'container', 'container-fluid'];
    return in_array($input, $valid, true) ? $input : 'container';
}

// Sanitize Widget Layout
function ajaxinwp_sanitize_widget_layout($input) {
    $valid = ['default', 'container', 'container-fluid'];
    return in_array($input, $valid, true) ? $input : 'container';
}

// Sanitize Footer Layout
function ajaxinwp_sanitize_footer_layout($input) {
    $valid = ['default', 'd-none', 'd-block'];
    return in_array($input, $valid, true) ? $input : 'd-block';
}

// Sanitize Content Layout
function ajaxinwp_sanitize_content_layout($input) {
    $valid = ['right-sidebar', 'left-sidebar', 'no-sidebar'];
    return in_array($input, $valid, true) ? $input : 'right-sidebar';
}
?>
