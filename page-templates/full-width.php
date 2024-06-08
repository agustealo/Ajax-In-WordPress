<?php
/*
Template Name: Full Width
Template Post Type: page
*/

get_header(); ?>

<div class="container-fluid full-width-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
            // If comments are open or there is at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- .container-fluid -->

<?php
get_footer();
?>
