<?php
/*
Template Name: Contact Page
Template Post Type: page
*/

get_header();
?>

<div class="container contact-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
        endwhile;
        ?>

        <!-- Contact Form -->
        <section class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="1234" title="Contact form 1"]'); ?>
        </section>

        <!-- Google Map -->
        <section class="contact-map">
            <!-- Embed Google Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.218237202631!2d-122.08385168469164!3d37.3860517798269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb7354df5b1bf%3A0x9a4c60b7d2a47b09!2sGoogleplex!5e0!3m2!1sen!2sus!4v1512481669211" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>
    </main>
</div>

<?php
get_footer();
?>
