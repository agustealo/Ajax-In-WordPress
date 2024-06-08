<?php
/*
Template Name: Services
Template Post Type: page
*/

get_header();
?>

<div class="container services-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Services -->
        <section class="services">
            <h2><?php _e('Our Services', 'ajaxinwp'); ?></h2>
            <div class="row">
                <?php
                $services = new WP_Query(array(
                    'post_type' => 'service',
                    'posts_per_page' => -1,
                ));
                if ($services->have_posts()) :
                    while ($services->have_posts()) : $services->the_post();
                        ?>
                        <div class="col-md-4">
                            <div class="service">
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No services found.</p>';
                endif;
                ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>
