<?php
/*
Template Name: Testimonials
Template Post Type: page
*/

get_header();
?>

<div class="container testimonials-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Testimonials -->
        <section class="testimonials">
            <h2><?php _e('Client Testimonials', 'ajaxinwp'); ?></h2>
            <div class="testimonials-slider">
                <?php
                $testimonials = new WP_Query(array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => -1,
                ));
                if ($testimonials->have_posts()) :
                    while ($testimonials->have_posts()) : $testimonials->the_post();
                        ?>
                        <div class="testimonial">
                            <?php the_content(); ?>
                            <p class="testimonial-author"><?php the_title(); ?></p>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No testimonials found.</p>';
                endif;
                ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>
