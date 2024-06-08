<?php
/**
 * The main template file for AjaxinWP, adapted for Bootstrap 5.3 compatibility.
 * Developed by Zeus Eternal
 */

get_header();

// Define container class based on theme mod setting
$content_layout = get_theme_mod('ajaxinwp_content_layout', 'right-sidebar');
$container_class = strpos($content_layout, 'fluid') !== false ? 'container-fluid' : 'container';

// Define content and sidebar classes based on content layout
$content_classes = 'col-lg-8';
$sidebar_classes = 'col-lg-4';
if ($content_layout === 'right-sidebar' || $content_layout === 'right-sidebar-fluid') {
    $content_classes .= ' float-end';
} elseif ($content_layout === 'left-sidebar' || $content_layout === 'left-sidebar-fluid') {
    $content_classes .= ' float-start';
    $sidebar_classes .= ' order-first';
} elseif ($content_layout === 'no-sidebar') {
    $content_classes = 'col-lg-12';
    $sidebar_classes = '';
}

?>

<div id="content" class="site-content mt-5 <?php echo esc_attr($container_class); ?>">
    <div id="primary" class="content-area row theme-content">
        <?php if ($content_layout !== 'no-sidebar' && strpos($content_layout, 'left-sidebar') !== false) : ?>
            <!-- Sidebar on the left -->
            <aside class="<?php echo esc_attr($sidebar_classes); ?>">
                <?php get_sidebar(); ?>
            </aside>
        <?php endif; ?>

        <!-- Main content area -->
        <main id="main" class="<?php echo esc_attr($content_classes); ?>" role="main">
            <div id="ajax-container">
                <?php
                // Load initial content if necessary
                if (!is_ajax_request()) {
                    if (is_page()) {
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-page', get_post_format());
                        endwhile;
                    } elseif (is_single()) {
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-single', get_post_format());
                        endwhile;
                    } elseif (is_category()) {
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-category', get_post_format());
                        endwhile;
                    } elseif (is_archive()) {
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-archive', get_post_format());
                        endwhile;
                    } else {
                        get_template_part('partials/partials-content-home');
                    }
                }
                ?>
            </div>
        </main>

        <?php if ($content_layout !== 'no-sidebar' && strpos($content_layout, 'right-sidebar') !== false) : ?>
            <!-- Sidebar on the right -->
            <aside class="<?php echo esc_attr($sidebar_classes); ?>">
                <?php get_sidebar(); ?>
            </aside>
        <?php endif; ?>
    </div><!-- #primary -->
</div><!-- .site-content -->

<div class="card-footer">
    <?php get_template_part('partials/partials-widgets'); ?>
</div><!-- .card-footer -->

<?php get_footer(); ?>
