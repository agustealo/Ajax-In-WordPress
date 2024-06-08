<?php
/*
Template Name: Blog
Template Post Type: page
*/

get_header();
?>

<div class="container blog-page">
    <main id="main" class="site-main" role="main">
        <?php
        $blog_posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 10,
        ));
        if ($blog_posts->have_posts()) :
            while ($blog_posts->have_posts()) : $blog_posts->the_post();
                get_template_part('template-parts/content', get_post_format());
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No posts found.</p>';
        endif;
        ?>
    </main>
</div>

<?php
get_footer();
?>
