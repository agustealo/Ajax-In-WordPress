<?php
    // Add Color Scheme Options Section
    $wp_customize->add_section('ajaxinwp_theme_colors', [
        'title'    => __('Theme Colors', 'ajaxinwp'),
        'priority' => 113,
    ]);

    // Add Color Scheme Setting
    $wp_customize->add_setting('ajaxinwp_color_scheme', [
        'default'           => 'color',
        'transport'         => 'refresh',
        'sanitize_callback' => 'ajaxinwp_sanitize_color_scheme',
    ]);

    $wp_customize->add_control('ajaxinwp_color_scheme', [
        'label'    => __('Default Color Scheme', 'ajaxinwp'),
        'section'  => 'ajaxinwp_theme_colors',
        'settings' => 'ajaxinwp_color_scheme',
        'type'     => 'radio',
        'choices'  => [
            'color' => __('Color', 'ajaxinwp'),
            'light'  => __('Light', 'ajaxinwp'),
            'dark'   => __('Dark', 'ajaxinwp'),
        ],
    ]);
add_action('customize_register', 'ajaxinwp_customize_register');
    // Sanitize the input
    function ajaxinwp_sanitize_color_scheme($input) {
        $valid = ['color', 'light', 'dark'];
        return in_array($input, $valid, true) ? $input : 'color'; // Fallback to 'color' as default
    }

    // Add other color settings with defaults and sanitization
    $settings = [
        'ajaxinwp_color_primary' => ['default' => '#f829cb', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_color_secondary' => ['default' => '#f8f9fa', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_color_primary_accent' => ['default' => '#ffc1ea', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_color_secondary_accent' => ['default' => '#7551f7', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_link_color' => ['default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_link_hover_color' => ['default' => '#0056b3', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_link_decoration' => ['default' => 'none', 'sanitize_callback' => 'sanitize_text_field'],
        'ajaxinwp_link_hover_decoration' => ['default' => 'underline', 'sanitize_callback' => 'sanitize_text_field'],
        'ajaxinwp_nav_bg_color' => ['default' => '#ffc1ea', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_nav_text_color' => ['default' => '#212529', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_nav_link_color' => ['default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_Header1_bg_color' => ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_Header1_text_color' => ['default' => '#212529', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_Sidebar1_bg_color' => ['default' => '#212529', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_Sidebar1_text_color' => ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_border_color' => ['default' => '#dee2e6', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_button_background_color' => ['default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_button_text_color' => ['default' => '#e1eaf3', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_button_hover_color' => ['default' => '#0056b3', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_body_background_color' => ['default' => '#e81b85', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_dark_primary' => ['default' => '#a2bfc1', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_dark_secondary' => ['default' => '#161b22', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_dark_accent_primary' => ['default' => '#bb86fc', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_dark_accent_secondary' => ['default' => '#beb4f7', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_light_primary' => ['default' => '#212529', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_light_secondary' => ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_light_accent_primary' => ['default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color'],
        'ajaxinwp_light_accent_secondary' => ['default' => '#0056b3', 'sanitize_callback' => 'sanitize_hex_color'],
    ];

    foreach ($settings as $setting => $args) {
        $wp_customize->add_setting($setting, array_merge([
            'transport' => 'refresh',
        ], $args));
    }

    foreach ($settings as $setting => $args) {
        $control_args = [
            'label'    => __(ucwords(str_replace('_', ' ', str_replace('ajaxinwp_', '', $setting))), 'ajaxinwp'),
            'section'  => 'ajaxinwp_theme_colors',
            'settings' => $setting,
        ];

        if ($args['sanitize_callback'] === 'sanitize_hex_color') {
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting, $control_args));
        } elseif ($args['sanitize_callback'] === 'sanitize_text_field' && ($setting === 'ajaxinwp_link_decoration' || $setting === 'ajaxinwp_link_hover_decoration')) {
            $control_args['type'] = 'select';
            $control_args['choices'] = [
                'none' => __('None', 'ajaxinwp'),
                'underline' => __('Underline', 'ajaxinwp'),
                'overline' => __('Overline', 'ajaxinwp'),
                'line-through' => __('Line-through', 'ajaxinwp'),
            ];
            $wp_customize->add_control($setting, $control_args);
        } else {
            $control_args['type'] = 'text';
            $wp_customize->add_control($setting, $control_args);
        }
    }

    // Separator for organization
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ajaxinwp_color_separator', [
        'type' => 'hidden',
        'section' => 'ajaxinwp_theme_colors',
        'settings' => [],
    ]));