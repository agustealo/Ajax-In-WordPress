<?php
/**
 * Main template.
 *
 * The server always renders the complete page. The JavaScript navigation layer is
 * progressive enhancement and extracts #ajax-container from normal responses.
 *
 * @package AjaxInWP
 */

get_header();
?>

<div id="content" class="site-content mt-5">
	<div id="primary" class="content-area row theme-content">
		<main id="main" class="main-content">
			<div id="ajax-container">
				<?php
				if ( is_page() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'partials/partials-content-page', get_post_format() );
					}
				} elseif ( is_single() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'partials/partials-content-single', get_post_format() );
					}
				} elseif ( is_category() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'partials/partials-content-category', get_post_format() );
					}
				} elseif ( is_archive() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'partials/partials-content-archive', get_post_format() );
					}
				} else {
					get_template_part( 'partials/partials-content-home' );
				}
				?>
			</div>
		</main>

		<aside class="ajaxinwp-sidebar">
			<?php get_sidebar(); ?>
		</aside>
	</div>
</div>

<div class="card-footer">
	<?php get_template_part( 'partials/partials-widgets' ); ?>
</div>

<?php get_footer();
