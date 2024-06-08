<?php
/**
 * Constructs and returns custom CSS for theme modifications.
 *
 * @return string Custom CSS.
 */
function ajaxinwp_customizer_css() {
    // Darken CSS color for hover state
    $darken = 30;

    /**
     * Darken a hex color.
     *
     * @param string $color Hex color.
     * @param int $percent Percentage to darken.
     * @return string Darkened hex color.
     */
    function darken_color($color, $percent) {
        $color = str_replace('#', '', $color);
        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));

        $r = max(0, $r - round(255 * $percent / 100));
        $g = max(0, $g - round(255 * $percent / 100));
        $b = max(0, $b - round(255 * $percent / 100));

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    // Default colors and settings for different themes
    $default_colors = [
        '--primary-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_color_primary', '#dee2e6')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_primary', '#a2bfc1')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_primary', '#212529')),
        ],
        '--secondary-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_color_secondary', '#212529')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#161b22')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#e1eaf3')),
        ],
        '--primary-accent-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_color_primary_accent', '#ffc1ea')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_primary', '#bb86fc')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_primary', '#007bff')),
        ],
        '--secondary-accent-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_color_secondary_accent', '#7551f7')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_secondary', '#beb4f7')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_secondary', '#0056b3')),
        ],
        '--primary-font' => [
            'color' => sanitize_text_field(get_theme_mod('ajaxinwp_primary_font', 'Roboto, sans-serif')),
        ],
        '--heading-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_heading_color', '#212529')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_secondary', '#beb4f7')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_secondary', '#0056b3')),
        ],
        '--secondary-heading-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_secondary_heading_color', '#ffffff')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#cccccc')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')),
        ],
        '--nav-bg-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_nav_bg_color', '#f8f9fa')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#161b22')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')),
        ],
        '--nav-text-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_nav_text_color', '#212529')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_primary', '#a2bfc1')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_primary', '#ffffff')),
        ],
        '--nav-link-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_nav_link_color', '#007bff')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_primary', '#a2bfc1')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_primary', '#ffffff')),
        ],
        '--nav-link-hover-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_nav_link_hover_color', '#0056b3')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_secondary', '#beb4f7')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_secondary', '#0056b3')),
        ],
        '--header-bg-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_Header1_bg_color', '#f8f9fa')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#161b22')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')),
        ],
        '--header-text-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_Header1_text_color', '#212529')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#e1eaf3')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#212529')),
        ],
        '--header-icon' => [
            'color' => sanitize_text_field(get_theme_mod('ajaxinwp_Header1_icon', '&#128101;')),
            'dark' => '&#128101;',
            'light' => '&#128101;',
        ],
        '--sidebar-bg-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_Sidebar1_bg_color', '#212529')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#161b22')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')),
        ],
        '--sidebar-text-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_Sidebar1_text_color', '#ffffff')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#e1eaf3')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#212529')),
        ],
        '--sidebar-icon' => [
            'color' => sanitize_text_field(get_theme_mod('ajaxinwp_Sidebar1_icon', '&#128101;')),
            'dark' => '&#128101;',
            'light' => '&#128101;',
        ],
        '--link-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_link_color', '#007bff')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_primary', '#7ab7ff')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_primary', '#007bff')),
        ],
        '--link-hover-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_link_hover_color', '#0056b3')),
            'dark' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_primary', '#7ab7ff')), $darken),
            'light' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_primary', '#007bff')), $darken),
        ],
        '--link-decoration' => [
            'color' => sanitize_text_field(get_theme_mod('ajaxinwp_link_decoration', 'none')),
            'dark' => 'none',
            'light' => 'none',
        ],
        '--link-hover-decoration' => [
            'color' => sanitize_text_field(get_theme_mod('ajaxinwp_link_hover_decoration', 'underline')),
            'dark' => 'underline',
            'light' => 'underline',
        ],
        '--button-bg-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_button_background_color', '#007bff')),
            'dark' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#161b22')), $darken),
            'light' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')), $darken),
        ],
        '--button-text-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_button_text_color', '#ffffff')),
            'dark' => sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#a2bfc1')),
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')),
        ],
        '--button-hover-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_button_hover_color', '#0056b3')),
            'dark' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_dark_accent_primary', '#7ab7ff')), $darken),
            'light' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_light_accent_primary', '#007bff')), $darken),
        ],
        '--border-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_border_color', '#dee2e6')),
            'dark' => 'hsla(0,0%,100%,.2)',
            'light' => sanitize_hex_color(get_theme_mod('ajaxinwp_light_primary', '#dee2e6')),
        ],
        '--body-bg-color' => [
            'color' => sanitize_hex_color(get_theme_mod('ajaxinwp_body_background_color', '#e81b85')),
            'dark' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_dark_secondary', '#161b22')), $darken),
            'light' => darken_color(sanitize_hex_color(get_theme_mod('ajaxinwp_light_secondary', '#ffffff')), $darken),
        ]
    ];

    // Branding Image Settings
    $logo_desktop_dark = get_theme_mod('ajaxinwp_logo_dark');
    $logo_desktop_light = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
    $logo_desktop_light_url = is_array($logo_desktop_light) ? $logo_desktop_light[0] : '';
    $logo_mobile_tablet_dark = get_theme_mod('ajaxinwp_logo_mobile_tablet_dark');
    $logo_mobile_tablet_light = get_theme_mod('ajaxinwp_logo_mobile_tablet_light');
    $logo_size_desktop = get_theme_mod('ajaxinwp_logo_size', 160);
    $logo_size_tablet = get_theme_mod('ajaxinwp_logo_size_tablet', 120);
    $logo_size_mobile = get_theme_mod('ajaxinwp_logo_size_mobile', 80);

    // Function to generate CSS variables
    function generate_css_variables($variables) {
        $css = ':root {';
        foreach ($variables as $css_var => $value) {
            $css .= "{$css_var}: {$value['color']}; ";
        }
        $css .= '}';
        return $css;
    }

    // Function to generate theme-specific CSS
    function generate_theme_css($theme, $variables) {
        $css = "body[data-theme=\"{$theme}\"] {";
        foreach ($variables as $css_var => $value) {
            if (isset($value[$theme])) {
                $css .= "{$css_var}: {$value[$theme]}; ";
            }
        }
        $css .= "}";
        return $css;
    }

    // Prepare variables for CSS generation
    $common_variables = [];
    $dark_variables = [];
    $light_variables = [];
    $color_variables = [];

    foreach ($default_colors as $css_var => $value) {
        $common_variables[$css_var] = $value;
        if (isset($value['dark'])) {
            $dark_variables[$css_var] = $value;
        }
        if (isset($value['light'])) {
            $light_variables[$css_var] = $value;
        }
    }

    ob_start();
    ?>
    <style type="text/css">
        /* Define CSS Base Variables */
        <?php echo generate_css_variables($common_variables); ?>
        <?php echo generate_theme_css('dark', $dark_variables); ?>
        <?php echo generate_theme_css('light', $light_variables); ?>
        <?php echo generate_theme_css('color', $color_variables); ?>

        /* Logo Size Media Queries */
        .custom-logo-link img {
            max-width: <?php echo $logo_size_desktop; ?>px;
            height: auto;
        }
        @media (max-width: 767.98px) {
            .custom-logo-link img {
                max-width: <?php echo $logo_size_mobile; ?>px;
            }
        }
        @media (min-width: 768px) and (max-width: 991.98px) {
            .custom-logo-link img {
                max-width: <?php echo $logo_size_tablet; ?>px;
            }
        }

        /* Light mode logos */
        body[data-theme="light"] .custom-logo-link img {
            content: url('<?php echo esc_url($logo_desktop_light_url); ?>');
        }

        /* Dark mode logos */
        body[data-theme="dark"] .custom-logo-link img {
            content: url('<?php echo esc_url($logo_desktop_dark); ?>');
        }

        /* Color mode logos */
        body[data-theme="color"] .custom-logo-link img {
            content: url('<?php echo esc_url($logo_desktop_light_url); ?>');
        }
        
    </style>
    <?php
    return ob_get_clean();
}

/**
 * Enqueues scripts and styles.
 */
function ajaxinwp_enqueue_scripts() {
    // Enqueue the general stylesheet
    wp_enqueue_style('ajaxinwp-general-style', get_template_directory_uri() . '/assets/css/variables.css', [], wp_get_theme()->get('Version'));
    // Enqueue the theme stylesheet
    wp_enqueue_style('ajaxinwp-theme-style', get_template_directory_uri() . '/assets/css/theme.css', [], wp_get_theme()->get('Version'));
    // Enqueue the inline styles from the customizer
    $custom_css = ajaxinwp_customizer_css();
    wp_add_inline_style('ajaxinwp-theme-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'ajaxinwp_enqueue_scripts');

?>
