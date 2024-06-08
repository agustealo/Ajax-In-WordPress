<?php
/**
 * Partials Content Category
 * Template for displaying home page content in a two-column layout.
 *
 * @package AjaxInWP
 */
?>

<div class="leftcolumn">
    <?php
    // Fetch the latest posts
    $latest_posts = new WP_Query(array(
        'posts_per_page' => 3, // Adjust the number of posts to display
        'post_status'    => 'publish',
        'ignore_sticky_posts' => 1, // Ignore sticky posts
    ));

    // Loop through the posts
    if ($latest_posts->have_posts()) :
        while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
            <div class="card">
                <article id="post-<?php the_ID(); ?>" <?php post_class('home-post'); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
                    <header class="entry-header">
                        <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                            <span class="sticky-post badge badge-primary"><?php esc_html_e('Featured', 'ajaxinwp'); ?></span>
                        <?php endif; ?>

                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                <?php echo get_post_thumbnail_or_fallback(get_the_ID(), 'medium card-img'); ?>
                            </a>
                        </div>

                        <h2 id="post-title-<?php the_ID(); ?>" class="entry-title">
                            <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        <div class="entry-meta  card-img-overlay">
                            <div class="date-card">
                                <time class="entry-date published updated" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <span class="day"><?php echo esc_html(get_the_date('d')); ?></span>
                                    <span class="month"><?php echo esc_html(get_the_date('M')); ?></span>
                                    <span class="year"><?php echo esc_html(get_the_date('y')); ?></span>
                                </time>
                            </div>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary read-more">
                            <?php esc_html_e('Read More', 'ajaxinwp'); ?>
                        </a>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php ajaxinwp_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
            </div>
        <?php endwhile;
        wp_reset_postdata(); // Reset the query
    else : ?>
        <p><?php esc_html_e('No posts found.', 'ajaxinwp'); ?></p>
    <?php endif; ?>
</div>

<!-- Ensure no additional loops or nested loops are present -->
<?php
// Add any other necessary code here

// Reset the main query if necessary
wp_reset_query();
?>
