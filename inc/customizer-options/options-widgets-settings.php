<?php
    $icon_choices = [
        'custom' => 'Custom Icon',
        '&#128199;' => '📊 Analytics',
        '&#128214;' => '📖 Book',
        '&#129303;' => '🧙 Brain',
        '&#128197;' => '📅 Calendar',
        '&#128203;' => '📋 Clipboard',
        '&#9202;' => '⏲ Clock',
        '&#128104;' => '📇 Contact Card',
        '&#128179;' => '💳 Credit Card',
        '&#129569;' => '🧡 DNA',
        '&#9993;' => '✉ Envelope',
        '&#128462;' => '🖌️ Flex',
        '&#128193;' => '📁 Folder',
        '&#128187;' => '💻 Laptop',
        '&#128218;' => '📚 Library',
        '&#128279;' => '🔗 Link',
        '&#128176;' => '💰 Money',
        '&#127925;' => '🎵 Music',
        '&#128396;' => '🖌️ Paintbrush',
        '&#128062;' => '🐾 Paw',
        '&#127822;' => '📰 RSS',
        '&#127988;' => '🏷 Tags',
        '&#9874;' => '🛠️ Tools',
        '&#128295;' => '🔧 Wrench',
    ];

    $widget_areas = ['Header1', 'Widget1', 'Widget2', 'Widget3', 'Widget4', 'Sidebar1'];
    foreach ($widget_areas as $widget_area) {
        // Widget Name
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_name", [
            'default'   => $widget_area,
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control("ajaxinwp_{$widget_area}_name", [
            'label'    => "{$widget_area} Name",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_name",
            'type'     => 'text',
        ]);

        // Widget Background Color
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_bg_color", [
            'default'   => '#ffffff',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control(new WP_Customize_Color_control($wp_customize, "ajaxinwp_{$widget_area}_bg_color", [
            'label'    => "{$widget_area} Background Color",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_bg_color",
        ]));

        // Widget Icons Setting and Control with Pre-defined list
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_icon", [
            'default'   => '&#128199;', // Default to Analytics icon
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control("ajaxinwp_{$widget_area}_icon", [
            'label'    => "{$widget_area} Icon",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_icon",
            'type'     => 'select',
            'choices'  => $icon_choices,
        ]);

        // Custom Icon Text Input for 'custom' option
        if (isset($icon_choices['custom'])) {
            $wp_customize->add_setting("ajaxinwp_{$widget_area}_custom_icon", [
                'default'   => '',
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_text_field', // Ensure proper sanitization
            ]);

            $wp_customize->add_control("ajaxinwp_{$widget_area}_custom_icon", [
                'label'    => "Custom Icon Class for {$widget_area}",
                'section'  => 'ajaxinwp_widgets_settings',
                'settings' => "ajaxinwp_{$widget_area}_custom_icon",
                'type'     => 'text',
                'active_callback' => function() use ($widget_area) {
                    return get_theme_mod("ajaxinwp_{$widget_area}_icon") === 'custom';
                },
            ]);
        }

        // Widget Description
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_description", [
            'default'   => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field', // Ensure proper sanitization
        ]);

        $wp_customize->add_control("ajaxinwp_{$widget_area}_description", [
            'label'    => "{$widget_area} Description",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_description",
            'type'     => 'textarea',
        ]);

        // Show/Hide Icons
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_show_icon", [
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        $wp_customize->add_control("ajaxinwp_{$widget_area}_show_icon", [
            'label'    => "Show Icon for {$widget_area}",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_show_icon",
            'type'     => 'checkbox',
        ]);

        // Show/Hide Titles
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_show_title", [
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        $wp_customize->add_control("ajaxinwp_{$widget_area}_show_title", [
            'label'    => "Show Title for {$widget_area}",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_show_title",
            'type'     => 'checkbox',
        ]);

        // Show/Hide Descriptions
        $wp_customize->add_setting("ajaxinwp_{$widget_area}_show_description", [
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        $wp_customize->add_control("ajaxinwp_{$widget_area}_show_description", [
            'label'    => "Show Description for {$widget_area}",
            'section'  => 'ajaxinwp_widgets_settings',
            'settings' => "ajaxinwp_{$widget_area}_show_description",
            'type'     => 'checkbox',
        ]);
    }