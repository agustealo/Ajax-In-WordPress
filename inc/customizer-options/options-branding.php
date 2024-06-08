<?php
/**
 * Site Identity Options
 * Add settings and controls for Site Identity customization
 */

// Logo size limits
$max_logo_size = 200;
$min_logo_size = 50;

// Add other element settings with defaults and sanitization
$settings = [
    // Advanced Logo Options for Different Viewports
    // Size
    'ajaxinwp_logo_size' => [
        'default' => 160,
        'sanitize_callback' => 'ajaxinwp_sanitize_logo_height',
        'label' => __('Logo Size', 'ajaxinwp'),
    ],
    'ajaxinwp_logo_size_mobile' => [
        'default' => 80,
        'sanitize_callback' => 'ajaxinwp_sanitize_logo_height',
        'label' => __('Mobile Logo Size', 'ajaxinwp'),
    ],
    'ajaxinwp_logo_size_tablet' => [
        'default' => 120,
        'sanitize_callback' => 'ajaxinwp_sanitize_logo_height',
        'label' => __('Tablet Logo Size', 'ajaxinwp'),
    ],
    // Img
    'ajaxinwp_logo_mobile_tablet_dark' => [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'label' => __('Mobile & Tablet Logo Dark', 'ajaxinwp'),
        'description' => __('Upload a different logo for dark mode on mobile and tablet viewports.', 'ajaxinwp')
    ],
    'ajaxinwp_logo_mobile_tablet_light' => [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'label' => __('Mobile & Tablet Logo Light', 'ajaxinwp'),
        'description' => __('Upload a different logo for light mode on mobile and tablet viewports.', 'ajaxinwp')
    ],
    'ajaxinwp_logo_dark' => [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'label' => __('Dark Mode Logo Image', 'ajaxinwp'),
        'description' => __('Upload a different logo for dark mode.', 'ajaxinwp')
    ],
];

// Add settings to the customizer
foreach ($settings as $setting => $args) {
    $wp_customize->add_setting($setting, array_merge([
        'transport' => 'refresh',
    ], $args));
}

$wp_customize->add_setting('ajaxinwp_logo_size_group_desc', [
    'sanitize_callback' => 'wp_filter_nohtml_kses',
]);
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ajaxinwp_logo_size_group_desc', [
    'label'       => __('Logo Size Settings', 'ajaxinwp'),
    'description' => __('Adjust the size of the logo for different viewports.', 'ajaxinwp'),
    'section'     => 'title_tagline',
    'settings'    => 'ajaxinwp_logo_size_group_desc',
    'type'        => 'hidden',
]));

// Add controls to the customizer
foreach ($settings as $setting => $args) {
    $type = 'text';
    $input_attrs = [];
    $description = isset($args['description']) ? $args['description'] : ''; // Set default description if not provided
    if ($args['sanitize_callback'] === 'ajaxinwp_sanitize_logo_height') {
        $type = 'range';
        $input_attrs = [
            'min' => $min_logo_size,
            'max' => $max_logo_size,
            'step' => 1,
        ];
    } elseif ($args['sanitize_callback'] === 'esc_url_raw') {
        $type = 'url';
    }

    $wp_customize->add_control($setting, [
        'label'    => $args['label'],
        'description' => $description,
        'section'  => 'title_tagline', // Add to the Site Identity section
        'settings' => $setting,
        'type'     => $type,
        'input_attrs' => $input_attrs,
    ]);
}

$wp_customize->add_setting('ajaxinwp_logo_image_group_desc', [
    'sanitize_callback' => 'wp_filter_nohtml_kses',
]);
$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'ajaxinwp_logo_image_group_desc', [
    'label'       => __('Logo Image Settings', 'ajaxinwp'),
    'description' => __('Upload different logos for various viewports and modes.', 'ajaxinwp'),
    'section'     => 'title_tagline',
    'settings'    => 'ajaxinwp_logo_image_group_desc',
    'type'        => 'hidden',
]));

// Custom control for logo images
$logo_controls = [
    'ajaxinwp_logo_dark' => __('Dark Mode Logo Image', 'ajaxinwp'),
    'ajaxinwp_logo_mobile_tablet_dark' => __('Mobile & Tablet Logo Dark', 'ajaxinwp'),
    'ajaxinwp_logo_mobile_tablet_light' => __('Mobile & Tablet Logo Light', 'ajaxinwp'),
];

foreach ($logo_controls as $control => $label) {
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $control, [
        'label'    => $label,
        'section'  => 'title_tagline',
        'settings' => $control,
    ]));
}

// Sanitization callback for logo height
function ajaxinwp_sanitize_logo_height($input) {
    $max_logo_size = 200;
    $min_logo_size = 50;
    $value = absint($input);
    return ($value > $max_logo_size) ? $max_logo_size : (($value < $min_logo_size) ? $min_logo_size : $value);
}

// Custom JS to show px value and move description
function ajaxinwp_customize_js() {
    ?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                // Add px value display to range inputs
                $('input[type="range"]').each(function() {
                    var $this = $(this);
                    var $valueLabel = $('<span class="range-value">' + $this.val() + 'px</span>');
                    $this.closest('.customize-control').find('.customize-control-title').append($valueLabel);

                    $this.on('input change', function() {
                        $valueLabel.text($this.val() + 'px');
                    });
                });

                // Move description below the range slider
                $('input[type="range"]').each(function() {
                    var $this = $(this);
                    var $description = $this.closest('.customize-control').find('.customize-control-description');
                    $this.closest('.customize-control').append($description);
                });
            });
        })(jQuery);
    </script>
    <style>
        .range-value {
            float: right;
            font-weight: normal;
            margin-left: 10px;
        }
        .customize-control-description {
            display: block;
            margin-top: 10px;
        }
    </style>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'ajaxinwp_customize_js');
?>
