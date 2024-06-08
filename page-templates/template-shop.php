<?php
/*
Template Name: Shop
Template Post Type: page
*/

get_header();
?>

<div class="container shop-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- WooCommerce Shop -->
        <section class="shop">
            <?php echo do_shortcode('[woocommerce_shop]'); ?>
        </section>
    </main>
</div>

<?php
get_footer();
?>
