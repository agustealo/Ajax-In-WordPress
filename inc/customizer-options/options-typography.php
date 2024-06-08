<?php
// Define an array of font choices
$font_choices = [
    'Roboto'           => 'Roboto',
    'Open Sans'        => 'Open Sans',
    'Lato'             => 'Lato',
    'Slabo 27px'       => 'Slabo 27px',
    'Oswald'           => 'Oswald',
    'Source Sans Pro'  => 'Source Sans Pro',
    'Montserrat'       => 'Montserrat',
    'Raleway'          => 'Raleway',
    'PT Sans'          => 'PT Sans',
    'Noto Sans'        => 'Noto Sans',
    'Ubuntu'           => 'Ubuntu',
    'Poppins'          => 'Poppins',
    'Merriweather'     => 'Merriweather',
    'Roboto Condensed' => 'Roboto Condensed',
    'Playfair Display' => 'Playfair Display',
    'Lora'             => 'Lora',
    'Rubik'            => 'Rubik',
    'Nunito'           => 'Nunito',
    'Arimo'            => 'Arimo',
    'Mulish'           => 'Mulish',
    'Inter'            => 'Inter',
    'Roboto Slab'      => 'Roboto Slab',
    'Work Sans'        => 'Work Sans',
    'Zilla Slab'       => 'Zilla Slab',
    'Fira Sans'        => 'Fira Sans',
    'Karla'            => 'Karla',
    'Heebo'            => 'Heebo',
    'Exo 2'            => 'Exo 2',
    'Varela Round'     => 'Varela Round',
    'Quicksand'        => 'Quicksand',
    // Add more font choices as necessary
];

// Add Typography Options Section
$wp_customize->add_section('ajaxinwp_typography_options', [
    'title'    => __('Typography Options', 'ajaxinwp'),
    'priority' => 130,
]);

// Group 1: Primary Font
$wp_customize->add_setting('ajaxinwp_primary_font', [
    'default'           => 'Roboto',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_primary_font', [
    'label'    => __('Primary Font', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_primary_font',
    'type'     => 'select',
    'choices'  => $font_choices,
]);

// Primary Font Color
$wp_customize->add_setting('ajaxinwp_primary_color', [
    'default'           => '#000000',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
]);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ajaxinwp_primary_color', [
    'label'    => __('Primary Font Color', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_primary_color',
]));

// Primary Font Weight
$wp_customize->add_setting('ajaxinwp_primary_font_weight', [
    'default'           => 'normal',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_primary_font_weight', [
    'label'    => __('Primary Font Weight', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_primary_font_weight',
    'type'     => 'select',
    'choices'  => [
        'normal' => 'Normal',
        'bold'   => 'Bold',
        '100'    => '100',
        '200'    => '200',
    ],
]);

// Group 2: Heading Font
$wp_customize->add_setting('ajaxinwp_heading_font', [
    'default'           => 'Roboto',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_heading_font', [
    'label'    => __('Heading Font', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_heading_font',
    'type'     => 'select',
    'choices'  => $font_choices,
]);

// Heading Font Color
$wp_customize->add_setting('ajaxinwp_heading_color', [
    'default'           => '#000000',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
]);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ajaxinwp_heading_color', [
    'label'    => __('Heading Font Color', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_heading_color',
]));

// Heading Font Weight
$wp_customize->add_setting('ajaxinwp_heading_font_weight', [
    'default'           => 'normal',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_heading_font_weight', [
    'label'    => __('Heading Font Weight', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_heading_font_weight',
    'type'     => 'select',
    'choices'  => [
        'normal' => 'Normal',
        'bold'   => 'Bold',
        '100'    => '100',
        '200'    => '200',
    ],
]);

// Group 3: Link
$wp_customize->add_setting('ajaxinwp_link_color', [
    'default'           => '#1e73be',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
]);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ajaxinwp_link_color', [
    'label'    => __('Link Color', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_link_color',
]));

// Link Weight
$wp_customize->add_setting('ajaxinwp_link_weight', [
    'default'           => 'normal',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_link_weight', [
    'label'    => __('Link Weight', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_link_weight',
    'type'     => 'select',
    'choices'  => [
        'normal' => 'Normal',
        'bold'   => 'Bold',
    ],
]);

// Link Decoration
$wp_customize->add_setting('ajaxinwp_link_decoration', [
    'default'           => 'none',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_link_decoration', [
    'label'    => __('Link Decoration', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_link_decoration',
    'type'     => 'select',
    'choices'  => [
        'none'      => 'None',
        'underline' => 'Underline',
    ],
]);

// Link Hover Color
$wp_customize->add_setting('ajaxinwp_link_hover_color', [
    'default'           => '#1e73be',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
]);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ajaxinwp_link_hover_color', [
    'label'    => __('Link Hover Color', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_link_hover_color',
]));

// Link Hover Weight
$wp_customize->add_setting('ajaxinwp_link_hover_weight', [
    'default'           => 'normal',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_link_hover_weight', [
    'label'    => __('Link Hover Weight', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_link_hover_weight',
    'type'     => 'select',
    'choices'  => [
        'normal' => 'Normal',
        'bold'   => 'Bold',
    ],
]);

// Link Hover Decoration
$wp_customize->add_setting('ajaxinwp_link_hover_decoration', [
    'default'           => 'none',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_link_hover_decoration', [
    'label'    => __('Link Hover Decoration', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_link_hover_decoration',
    'type'     => 'select',
    'choices'  => [
        'none'      => 'None',
        'underline' => 'Underline',
    ],
]);

// Group 4: Font Size
$wp_customize->add_setting('ajaxinwp_font_size', [
    'default'           => '16px',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('ajaxinwp_font_size', [
    'label'    => __('Global Font Size', 'ajaxinwp'),
    'section'  => 'ajaxinwp_typography_options',
    'settings' => 'ajaxinwp_font_size',
    'type'     => 'select',
    'choices'  => [
        '12px' => '12px',
        '14px' => '14px',
        '16px' => '16px',
        '18px' => '18px',
        '20px' => '20px',
    ],
]);
?>
