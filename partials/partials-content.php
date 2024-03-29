<div class="post-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <?php edit_post_link(__('Edit', 'ajaxinwp'), '<span class="edit-link">', '</span>'); ?>
            </footer><!-- .entry-footer -->
        </article><!-- #post-## -->
    <?php endwhile; endif; ?>
</div><!-- .post-content -->
