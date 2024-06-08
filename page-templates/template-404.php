<?php
/*
Template Name: 404 Error
Template Post Type: page
*/

get_header();
?>

<div class="container error-404-page">
    <main id="main" class="site-main" role="main">
        <section class="error-404 not-found">
            <h1><?php _e('Oops! That page can’t be found.', 'ajaxinwp'); ?></h1>
            <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'ajaxinwp'); ?></p>
            <?php get_search_form(); ?>
            <a href="<?php echo home_url('/'); ?>" class="btn btn-primary"><?php _e('Back to Home', 'ajaxinwp'); ?></a>
        </section>
    </main>
</div>

<?php
get_footer();
?>
