<?php
/*
Template Name: About Us
Template Post Type: page
*/

get_header();
?>

<div class="container about-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- Team Members -->
        <section class="team-members">
            <h2><?php _e('Our Team', 'ajaxinwp'); ?></h2>
            <div class="row">
                <?php
                $team_members = new WP_Query(array(
                    'post_type' => 'team_member',
                    'posts_per_page' => -1,
                ));
                if ($team_members->have_posts()) :
                    while ($team_members->have_posts()) : $team_members->the_post();
                        ?>
                        <div class="col-md-4">
                            <div class="team-member">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="team-member-image">
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
                    echo '<p>No team members found.</p>';
                endif;
                ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>
