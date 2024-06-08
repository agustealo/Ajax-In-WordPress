<?php
if (!function_exists('ajaxinwp_setup')) :
    function ajaxinwp_setup() {
        load_theme_textdomain('ajaxinwp', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo', array(
            'height'      => 'auto',
            'width'       => 400,
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');
        add_theme_support('editor-styles');

        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'ajaxinwp'),
        ));

        // Add image sizes
        add_image_size('ajaxinwp-thumb', 400, 400, true); // Thumb size
        add_image_size('ajaxinwp-feature', 1080, 720, true); // Feature size
    }
endif;
add_action('after_setup_theme', 'ajaxinwp_setup');

// Function to get post thumbnail or fallback image
function get_post_thumbnail_or_fallback($post_id, $size = 'medium', $attr = '') {
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail($post_id, $size, $attr);
    } else {
        $default_image_url = get_template_directory_uri() . '/assets/img/fallback1080x720.jpg';
        return '<img src="' . esc_url($default_image_url) . '" alt="' . esc_attr__('Default Image', 'ajaxinwp') . '" class="attachment-' . esc_attr($size) . ' size-' . esc_attr($size) . ' wp-post-image">';
    }
}

// Enqueue styles and scripts
function ajaxinwp_styles_and_scripts() {
    /* Uncomment to get started with boostrap or delete lines to use other assets
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3', 'all');
    wp_enqueue_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css', array(), '1.7.2', 'all');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
    wp_enqueue_script('font-awesome', 'https://kit.fontawesome.com/a531f5a022.js', array(), null, true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);
    */
    wp_enqueue_script('ajaxinwp-js', get_template_directory_uri() . '/assets/js/ajaxinwp.js', array('jquery'), wp_get_theme()->get('Version'), true);

    wp_localize_script('ajaxinwp-js', 'ajaxinwp_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ajaxinwp_nonce'),
        'homeURL'  => get_home_url(),
        'isHome'   => is_home() || is_front_page()
    ));

    wp_add_inline_script('ajaxinwp-js', 'document.body.dataset.theme = "' . esc_js(get_theme_mod('ajaxinwp_color_scheme', 'auto')) . '";', 'before');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ajaxinwp_styles_and_scripts');

// Load additional theme files
require_once get_template_directory() . '/helpers/bootstrap-menu-walker.php';
require_once get_template_directory() . '/helpers/bootstrap-comment-walker.php';
require_once get_template_directory() . '/inc/ajax-redirect.php';

// Enqueue scripts for customizer preview
function ajaxinwp_customize_preview_js() {
    wp_enqueue_script('ajaxinwp_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), wp_get_theme()->get('Version'), true);
}
add_action('customize_preview_init', 'ajaxinwp_customize_preview_js');

// Function to print post date and time
if (!function_exists('ajaxinwp_posted_on')) :
    function ajaxinwp_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html_x('Posted on %s', 'post date', 'ajaxinwp'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>';
    }
endif;

// Function to print post author
if (!function_exists('ajaxinwp_posted_by')) :
    function ajaxinwp_posted_by() {
        $byline = sprintf(
            esc_html_x('by %s', 'post author', 'ajaxinwp'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
endif;

// Function to print categories, tags and edit link
if (!function_exists('ajaxinwp_entry_footer')) :
    function ajaxinwp_entry_footer() {
        if ('post' === get_post_type()) {
            $categories_list = get_the_category_list(esc_html__(', ', 'ajaxinwp'));
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'ajaxinwp') . '</span> | ', $categories_list);
            }

            $tags_list = get_the_tag_list('', esc_html__(', ', 'ajaxinwp'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'ajaxinwp') . '</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ajaxinwp'),
                        array('span' => array('class' => array()))
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    __('Edit <span class="screen-reader-text">%s</span>', 'ajaxinwp'),
                    array('span' => array('class' => array()))
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

// Handle AJAX requests
function ajaxinwp_handle_ajax_requests() {
    if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
        ob_start();

        if (is_page()) {
            while (have_posts()) :
                the_post();
                echo '<div id="ajax-container">';
                get_template_part('partials/partials-content-page', get_post_format());
                echo '</div>';
            endwhile;
        } elseif (is_single()) {
            while (have_posts()) :
                the_post();
                echo '<div id="ajax-container">';
                get_template_part('partials/partials-content-single', get_post_format());
                echo '</div>';
            endwhile;
        } elseif (is_category()) {
            echo '<div id="ajax-container">';
            get_template_part('partials/partials-content-category', get_post_format());
            echo '</div>';
        } elseif (is_archive()) {
            echo '<div id="ajax-container">';
            get_template_part('partials/partials-content-archive', get_post_format());
            echo '</div>';
        } else {
            echo '<div id="ajax-container">';
            get_template_part('partials/partials-content-home');
            echo '</div>';
        }

        $content = ob_get_clean();
        echo $content;
        exit;
    }
}
add_action('template_redirect', 'ajaxinwp_handle_ajax_requests');

// Function to ensure images are cropped
function ajaxinwp_ensure_image_crops($metadata, $attachment_id) {
    $sizes = ['ajaxinwp-thumb', 'ajaxinwp-feature'];
    foreach ($sizes as $size) {
        if (!isset($metadata['sizes'][$size])) {
            $image_path = get_attached_file($attachment_id);
            $editor = wp_get_image_editor($image_path);
            if (!is_wp_error($editor)) {
                $editor->resize(get_option("{$size}_size_w"), get_option("{$size}_size_h"), true);
                $resized = $editor->save();
                if (!is_wp_error($resized)) {
                    $metadata['sizes'][$size] = [
                        'file' => basename($resized['path']),
                        'width' => $resized['width'],
                        'height' => $resized['height'],
                        'mime-type' => $resized['mime-type'],
                    ];
                }
            }
        }
    }
    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'ajaxinwp_ensure_image_crops', 10, 2);
?>
