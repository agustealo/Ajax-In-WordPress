<?php
/**
 * Template part for displaying single post content in single.php
 *
 * @package AjaxinWP
 */

// Debug statement to verify `partials-content-single.php` is loaded
echo '<!-- partials-content-single.php loaded -->';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="single-header">
        <?php the_title('<h1 class="single-title display-5">', '</h1>'); ?>
    </header><!-- .single-header -->

    <div class="entry-content">
        <?php
        if (has_post_thumbnail()) {
            echo '<div class="post-thumbnail">';
            the_post_thumbnail('large');
            echo '</div>';
        }

        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'ajaxinwp'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        if (get_edit_post_link()) {
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'ajaxinwp'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }
        ?>

        <?php
        // Display post meta information
        if (function_exists('ajaxinwp_posted_on')) {
            ajaxinwp_posted_on();
        }
        if (function_exists('ajaxinwp_posted_by')) {
            ajaxinwp_posted_by();
        }

        // Display categories and tags
        $categories_list = get_the_category_list(esc_html__(', ', 'ajaxinwp'));
        if ($categories_list) {
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'ajaxinwp') . '</span>', $categories_list);
        }

        $tags_list = get_the_tag_list('', esc_html__(', ', 'ajaxinwp'));
        if ($tags_list) {
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'ajaxinwp') . '</span>', $tags_list);
        }
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

<nav class="post-navigation my-4" role="navigation">
    <div class="nav-links d-flex justify-content-between">
        <div class="nav-previous">
            <?php previous_post_link('%link', '<i class="fas fa-arrow-left"></i> <span class="meta-nav" aria-hidden="true">' . __('Previous', 'ajaxinwp') . '</span> %title'); ?>
        </div>
        <div class="nav-next">
            <?php next_post_link('%link', '<span class="meta-nav" aria-hidden="true">' . __('Next', 'ajaxinwp') . '</span> %title <i class="fas fa-arrow-right"></i>'); ?>
        </div>
    </div>
</nav>

<?php
// Display comments section
if (comments_open() || get_comments_number()) {
    comments_template();
}
?>


