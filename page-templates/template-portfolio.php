<?php
/*
Template Name: Portfolio
Template Post Type: page
*/

get_header();
?>

<div class="container portfolio-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Portfolio Items -->
        <section class="portfolio-items">
            <?php
            $portfolio_items = new WP_Query(array(
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
            ));
            if ($portfolio_items->have_posts()) :
                while ($portfolio_items->have_posts()) : $portfolio_items->the_post();
                    get_template_part('template-parts/content', 'portfolio');
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No portfolio items found.</p>';
            endif;
            ?>
        </section>
    </main>
</div>

<?php
get_footer();
?>
