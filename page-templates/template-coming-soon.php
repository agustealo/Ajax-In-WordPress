<?php
/*
Template Name: Coming Soon
Template Post Type: page
*/

get_header();
?>

<div class="container coming-soon-page">
    <main id="main" class="site-main" role="main">
        <section class="coming-soon">
            <h1><?php _e('Coming Soon', 'ajaxinwp'); ?></h1>
            <p><?php _e('We are working hard to launch our new website. Stay tuned!', 'ajaxinwp'); ?></p>
            <div class="countdown-timer">
                <?php echo do_shortcode('[countdown date="2024-12-31"]'); ?>
            </div>
            <div class="subscription-form">
                <?php echo do_shortcode('[mc4wp_form id="123"]'); ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>
