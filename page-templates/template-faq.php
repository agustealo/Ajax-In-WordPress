<?php
/*
Template Name: FAQ
Template Post Type: page
*/

get_header();
?>

<div class="container faq-page">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content', 'page');
        endwhile;
        ?>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="accordion" id="faqAccordion">
                <?php
                $faqs = new WP_Query(array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1,
                ));
                if ($faqs->have_posts()) :
                    $i = 0;
                    while ($faqs->have_posts()) : $faqs->the_post();
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-<?php echo $i; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $i; ?>">
                                    <?php the_title(); ?>
                                </button>
                            </h2>
                            <div id="collapse-<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i === 0 ? 'show' : ''; ?>" aria-labelledby="heading-<?php echo $i; ?>" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No FAQs found.</p>';
                endif;
                ?>
            </div>
        </section>
    </main>
</div>

<?php
get_footer();
?>
