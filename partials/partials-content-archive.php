<?php
/**
 * Template part for displaying category posts.
 *
 * @package AjaxInWP
 */

// Ensure this file is not accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>
        
        <div class="entry-meta">
            <?php ajaxinwp_posted_on(); ?>
            <?php ajaxinwp_posted_by(); ?>
        </div><!-- .entry-meta -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php echo wp_trim_words( get_the_excerpt(), 60, '...' ); ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <div class="container">
        <div class="row">
        <div class="col-lg-10 col-md-8 col-sm-6">
        <?php ajaxinwp_entry_footer(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="col-lg-2 col-md-4 col-sm-6 btn btn-primary read-more">
            <?php esc_html_e( 'Read More', 'ajaxinwp' ); ?>
        </a>
        </div>
        </div>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
