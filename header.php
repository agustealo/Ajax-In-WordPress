<?php
/**
 * Theme header.
 *
 * @package AjaxInWP
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr( get_theme_mod( 'ajaxinwp_color_scheme', 'color' ) ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="row">
	<nav class="navbar" aria-label="<?php esc_attr_e( 'Main navigation', 'ajaxinwp' ); ?>">
		<div class="container">
			<?php if ( has_custom_logo() ) : ?>
				<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php
					echo wp_get_attachment_image(
						get_theme_mod( 'custom_logo' ),
						'full',
						false,
						array( 'class' => 'custom-logo' )
					);
					?>
				</a>
			<?php else : ?>
				<a class="navbar-brand homepage-title-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</a>
			<?php endif; ?>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'ajaxinwp' ); ?>">
				<span class="navbar-toggler-icon" aria-hidden="true"></span>
			</button>

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'depth'           => 2,
					'container'       => 'div',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'navbarNavDropdown',
					'menu_class'      => 'navbar-nav me-auto',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker(),
				)
			);
			?>
		</div>
	</nav>
</div>

<header id="masthead" class="site-header">
	<div id="header-hero-container">
		<?php if ( ! is_singular() && is_active_sidebar( 'ajaxinwp_widget_area_header1' ) ) : ?>
			<div class="container-fluid">
				<?php get_template_part( 'partials/partials-header-hero' ); ?>
			</div>
		<?php endif; ?>
	</div>
</header>
