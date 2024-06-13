<?php
/**
 * The main theme file for AjaxinWP, adapted for Bootstrap 5.3 compatibility.
 * Developed by Zeus Eternal
 *
 * This file is used to display content based on the theme's content layout settings.
 * It supports different content layouts including right sidebar, left sidebar, and no sidebar.
 */

get_header(); // Load the header template

?>

<div id="content" class="site-content mt-5">
    <div id="primary" class="content-area row theme-content">
        <!-- Main content area -->
        <main id="main" class="main-content" role="main">
            <div id="ajax-container">
                <?php
                // Load initial content if necessary
                if (!is_ajax_request()) {
                    if (is_page()) {
                        // Load page content
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-page', get_post_format());
                        endwhile;
                    } elseif (is_single()) {
                        // Load single post content
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-single', get_post_format());
                        endwhile;
                    } elseif (is_category()) {
                        // Load category content
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-category', get_post_format());
                        endwhile;
                    } elseif (is_archive()) {
                        // Load archive content
                        while (have_posts()) : the_post();
                            get_template_part('partials/partials-content-archive', get_post_format());
                        endwhile;
                    } else {
                        // Load home content
                        get_template_part('partials/partials-content-home');
                    }
                }
                ?>
            </div>
        </main>
        <!-- Sidebar on the right -->
        <aside class="ajaxinwp-sidebar">
            <?php get_sidebar(); // Load the sidebar template ?>
        </aside>
    </div><!-- #primary -->
</div><!-- .site-content -->

<div class="card-footer">
    <?php get_template_part('partials/partials-widgets'); // Load the footer widgets ?>
</div><!-- .card-footer -->

<?php get_footer(); // Load the footer template ?>
