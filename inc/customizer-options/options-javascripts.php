<?php
// Add the section for custom JavaScript
$wp_customize->add_section('ajaxinwp_advanced_scripts_options', [
    'title'    => __('Additional JS', 'ajaxinwp'),
    'priority' => 160,
]);

// Setting for Custom JS
$wp_customize->add_setting('ajaxinwp_custom_js', [
    'default'           => '',
    'transport'         => 'refresh',
    'sanitize_callback' => 'ajaxinwp_sanitize_custom_js', // Custom sanitize function
    'validate_callback' => 'ajaxinwp_validate_custom_js', // Custom validate function
]);

// Control for Custom JS
$wp_customize->add_control('ajaxinwp_custom_js', [
    'label'       => __('Custom JS', 'ajaxinwp'),
    'section'     => 'ajaxinwp_advanced_scripts_options',
    'settings'    => 'ajaxinwp_custom_js',
    'type'        => 'textarea',
    'description' => __('Add your custom JavaScript code here. Note: Please use it carefully to avoid breaking site functionality.', 'ajaxinwp'),
]);

// Sanitize custom JavaScript code
function ajaxinwp_sanitize_custom_js($input) {
    // Allow only safe HTML tags and attributes
    $allowed_html = [
        'a'          => ['href' => [], 'title' => []],
        'br'         => [],
        'em'         => [],
        'strong'     => [],
        'blockquote' => ['cite' => []],
        'code'       => [],
    ];
    return wp_kses($input, $allowed_html);
}

// Validate custom JavaScript code
function ajaxinwp_validate_custom_js($validity, $value) {
    if (empty($value)) {
        return $validity; // Return early if the input is empty
    }

    // Check for potential security risks
    $forbidden_keywords = ['eval', 'exec', 'system', 'shell_exec', 'passthru', 'phpinfo'];
    foreach ($forbidden_keywords as $keyword) {
        if (stripos($value, $keyword) !== false) {
            $validity->add('security_issue', __('Security issue: The provided JavaScript code contains forbidden keywords.', 'ajaxinwp'));
            return $validity;
        }
    }

    // Perform basic syntax validation
    if (!ajaxinwp_validate_js_syntax($value)) {
        $validity->add('syntax_error', __('Syntax error: The provided JavaScript code is not valid.', 'ajaxinwp'));
    }

    return $validity;
}

// Function to validate JavaScript syntax
function ajaxinwp_validate_js_syntax($input) {
    // Create a temporary file to store the JavaScript code
    $temp_file = tempnam(sys_get_temp_dir(), 'ajaxinwp_js_validation_');
    file_put_contents($temp_file, $input);

    // Use external libraries or services if necessary for validation
    // For now, simply check if the file contains valid JS
    // This is a placeholder for more complex validation logic
    $is_valid = true;

    // Clean up the temporary file
    unlink($temp_file);

    return $is_valid;
}
?>
