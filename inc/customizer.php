<?php
/**
 * AjaxinWP Theme Customizer
 * Developed by Zeus Eternal
 */

function ajaxinwp_customize_register($wp_customize) {
    // Widgets
    $wp_customize->add_section('ajaxinwp_widgets', [
        'title'    => __('Widgets', 'ajaxinwp'),
        'priority' => 109,
    ]);

    // Widgets Settings
    $wp_customize->add_section('ajaxinwp_widgets_settings', [
        'title'    => __('Widgets Settings', 'ajaxinwp'),
        'priority' => 110,
    ]);
    
    // Theme Colors Settings
    $wp_customize->add_section('ajaxinwp_theme_colors', [
        'title'    => __('Theme Colors', 'ajaxinwp'),
        'priority' => 111,
    ]);

    // Typography
    $wp_customize->add_section('ajaxinwp_typography_options', [
        'title'    => __('Typography', 'ajaxinwp'),
        'priority' => 115,
    ]);

    // Layout
    $wp_customize->add_section('ajaxinwp_layout_options', [
        'title'    => __('Layout', 'ajaxinwp'),
        'priority' => 114,
    ]);

    // Theme Elements
    $wp_customize->add_section('ajaxinwp_layout_elements', [
        'title'    => __('Theme Elements', 'ajaxinwp'),
        'priority' => 116,
    ]);

    // Advanced Scripts
    $wp_customize->add_section('ajaxinwp_advanced_scripts_options', [
        'title'    => __('Advanced Scripts', 'ajaxinwp'),
        'priority' => 120,
    ]);

    // Include separate files for clean organization
    require_once get_template_directory() . '/inc/customizer-options/options-colors.php';
    require_once get_template_directory() . '/inc/customizer-options/options-branding.php';
    require_once get_template_directory() . '/inc/customizer-options/options-javascripts.php';
    require_once get_template_directory() . '/inc/customizer-options/options-layout.php';
    require_once get_template_directory() . '/inc/customizer-options/options-typography.php';
    require_once get_template_directory() . '/inc/customizer-options/options-widgets-settings.php';
}

add_action('customize_register', 'ajaxinwp_customize_register');
?>
