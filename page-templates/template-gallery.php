<?php
/*
Template Name: Gallery
Template Post Type: page
*/

get_header();
?>

<div class="container gallery-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Image Gallery -->
        <section class="image-gallery">
            <?php echo do_shortcode('[gallery ids="1,2,3,4,5"]'); ?>
        </section>
    </main>
</div>

<?php
get_footer();
?>
