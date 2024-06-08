<?php
/*
Template Name: Custom Archive
Template Post Type: page
*/

get_header();
?>

<div class="container archive-page">
    <main id="main" class="site-main" role="main">
        <header class="page-header">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
        </header>

        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', get_post_format());
            endwhile;
            the_posts_navigation();
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </main>
</div>

<?php
get_footer();
?>
