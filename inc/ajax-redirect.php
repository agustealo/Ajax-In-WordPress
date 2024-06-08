<?php
add_action('template_redirect', function() {
    if (is_ajax_request()) {
        // Determine the part of the content to load
        $content_type = isset($_GET['content_type']) ? sanitize_text_field($_GET['content_type']) : 'default';

        // Map content types to specific template parts
        switch ($content_type) {
            case 'post':
                $template_part = 'partials/partials-content-single';
                break;
            case 'page':
                $template_part = 'partials/partials-content-page';
                break;
            case 'category':
                $template_part = 'partials/partials-content-category';
                break;
            case 'archive':
                $template_part = 'partials/partials-content-archive';
                break;
            default:
                $template_part = 'partials/partials-content-home';
                break;
        }

        // Load the specified template part
        get_template_part($template_part);

        // Handle pagination if applicable
        if ($content_type === 'archive') {
            global $wp_query;
            $max_num_pages = $wp_query->max_num_pages;
            echo '<div id="pagination-max-pages" data-max-pages="' . esc_attr($max_num_pages) . '"></div>';
        }

        exit;
    }
});

// Localize necessary data for JavaScript
add_action('wp_enqueue_scripts', function() {
    $ajax_data = array(
        'home_url' => home_url('/'),
        'color_scheme' => get_theme_mod('ajaxinwp_color_scheme', 'auto'),
    );
    wp_localize_script('ajaxinwp-navigation', 'ajaxinwp_params', $ajax_data);
});

// Check if it's an AJAX request
function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
?>
