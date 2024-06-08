<?php
/**
 * The template for displaying all single posts
 *
 * @package AjaxinWP
 */

get_header();
$content_layout = get_theme_mod('ajaxinwp_content_layout', 'right-sidebar');
$container_class = strpos($content_layout, 'fluid') !== false ? 'container-fluid' : 'container';
$content_classes = 'col-lg-8';
$sidebar_classes = 'col-lg-4';

// Adjust content and sidebar classes based on the content layout
if ($content_layout === 'right-sidebar' || $content_layout === 'right-sidebar-fluid') {
    $content_classes .= ' float-end';
    $sidebar_classes .= ' float-end';
} elseif ($content_layout === 'left-sidebar' || $content_layout === 'left-sidebar-fluid') {
    $content_classes .= ' float-start';
    $sidebar_classes .= ' float-start';
} elseif ($content_layout === 'no-sidebar') {
    $content_classes = 'no-sidebar col-lg-12';
    $sidebar_classes = '';
}
?>

<div id="content" class="site-content <?php echo esc_attr($container_class); ?>">
    <div id="primary" class="content-area row theme-content">
        <?php if ($content_layout !== 'no-sidebar' && strpos($content_layout, 'left-sidebar') !== false) : ?>
        <!-- Sidebar on the left -->
        <aside class="<?php echo esc_attr($sidebar_classes); ?>">
            <?php get_sidebar(); ?>
        </aside>
        <?php endif; ?>

        <!-- Main Content Area -->
        <main id="main" class="<?php echo esc_attr($content_classes); ?>" role="main">
            <div id="ajax-container">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('partials/partials-content-single', get_post_format());
                endwhile; // End of the loop.
                ?>
            </div><!-- #ajax-container -->
        </main><!-- #main -->

        <?php if ($content_layout !== 'no-sidebar' && strpos($content_layout, 'right-sidebar') !== false) : ?>
        <!-- Sidebar on the right -->
        <aside class="<?php echo esc_attr($sidebar_classes); ?>">
            <?php get_sidebar(); ?>
        </aside>
        <?php endif; ?>
    </div><!-- #primary -->
</div><!-- .site-content -->

<?php get_template_part('partials/widgets'); ?>

<div class="card-footer text-body-secondary">
    <?php
    // Load the partial footer for AJAX compatibility
    get_template_part('partials/footer');
    ?>
</div><!-- .card-footer -->

<?php get_footer(); ?>
