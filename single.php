<?php
/**
 * Single post template.
 *
 * @package AjaxInWP
 */

get_header();

$content_layout  = get_theme_mod( 'ajaxinwp_content_layout', 'right-sidebar' );
$container_class = str_contains( $content_layout, 'fluid' ) ? 'container-fluid' : 'container';
$content_classes = 'col-lg-8';
$sidebar_classes = 'col-lg-4';

if ( 'left-sidebar' === $content_layout || 'left-sidebar-fluid' === $content_layout ) {
	$content_classes .= ' order-lg-2';
	$sidebar_classes .= ' order-lg-1';
} elseif ( 'no-sidebar' === $content_layout ) {
	$content_classes = 'col-12';
	$sidebar_classes = '';
}
?>

<div id="content" class="site-content <?php echo esc_attr( $container_class ); ?>">
	<div id="primary" class="content-area row theme-content">
		<?php if ( $sidebar_classes && str_starts_with( $content_layout, 'left-sidebar' ) ) : ?>
			<aside class="<?php echo esc_attr( $sidebar_classes ); ?>">
				<?php get_sidebar(); ?>
			</aside>
		<?php endif; ?>

		<main id="main" class="<?php echo esc_attr( $content_classes ); ?>">
			<div id="ajax-container">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'partials/partials-content-single', get_post_format() );
				}
				?>
			</div>
		</main>

		<?php if ( $sidebar_classes && str_starts_with( $content_layout, 'right-sidebar' ) ) : ?>
			<aside class="<?php echo esc_attr( $sidebar_classes ); ?>">
				<?php get_sidebar(); ?>
			</aside>
		<?php endif; ?>
	</div>
</div>

<?php get_template_part( 'partials/partials-widgets' ); ?>
<?php get_footer(); ?>
