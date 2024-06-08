<?php
/*
Template Name: Landing Page
Template Post Type: page
*/

get_header();
?>

<div class="container-fluid landing-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Call to Action -->
        <section class="call-to-action">
            <h2><?php _e('Join Us Today!', 'ajaxinwp'); ?></h2>
            <a href="#" class="btn btn-primary"><?php _e('Get Started', 'ajaxinwp'); ?></a>
        </section>
    </main>
</div>

<?php
get_footer();
?>
