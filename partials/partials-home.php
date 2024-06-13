<?php
/**
 * Template part for displaying the home page content.
 *
 * @package AjaxinWP
 */

?>

<div class="container my-5">
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php
            // Start the Loop.
            while (have_posts()) : the_post(); ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Read More', 'ajaxinwp'); ?></a>
                        </div>
                        <div class="card-footer text-muted">
                            <?php the_time(get_option('date_format')); ?> by <?php the_author(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

            <div class="col-12">
                <?php
                // Display pagination
                the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => __('&larr; Previous', 'ajaxinwp'),
                    'next_text' => __('Next &rarr;', 'ajaxinwp'),
                    'screen_reader_text' => __('Posts navigation', 'ajaxinwp')
                ]);
                ?>
            </div>

        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <?php _e('Sorry, no posts matched your criteria.', 'ajaxinwp'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
