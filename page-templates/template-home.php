<?php
/*
Template Name: Home Page
Template Post Type: page
*/

get_header();
?>

<div class="home-page">
    <!-- Hero Section -->
    <section class="hero">
        <!-- Custom content for hero section -->
    </section>

    <!-- Featured Content -->
    <section class="featured-content">
        <!-- Custom content for featured content -->
    </section>

    <!-- Latest Posts -->
    <section class="latest-posts">
        <?php
        // Display latest posts
        $recent_posts = new WP_Query(array(
            'posts_per_page' => 3,
        ));
        while ($recent_posts->have_posts()) : $recent_posts->the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        wp_reset_postdata();
        ?>
    </section>
</div>

<?php
get_footer();
?>
