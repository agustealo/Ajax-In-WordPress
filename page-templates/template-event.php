<?php
/*
Template Name: Event
Template Post Type: page
*/

get_header();
?>

<div class="container event-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Events -->
        <section class="events">
            <h2><?php _e('Upcoming Events', 'ajaxinwp'); ?></h2>
            <div class="row">
                <?php
                $events = new WP_Query(array(
                    'post_type' => 'event',
                    'posts_per_page' => -1,
                ));
                if ($events->have_posts()) :
                    while ($events->have_posts()) : $events->the_post();
                        ?>
                        <div class="col-md-4">
                            <div class="event">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="event-image">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </div>
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No upcoming events found.</p>';
                endif;
                ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>
