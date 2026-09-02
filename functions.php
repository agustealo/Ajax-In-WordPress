<?php
/**
 * AjaxInWP theme functions.
 *
 * @package AjaxInWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ajaxinwp_setup' ) ) :
	/**
	 * Configure theme defaults and WordPress feature support.
	 */
	function ajaxinwp_setup() {
		load_theme_textdomain( 'ajaxinwp', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_theme_support(
			'html5',
			array( 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
		);
		add_theme_support(
			'custom-logo',
			array(
				'width'       => 400,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'ajaxinwp' ),
			)
		);

		add_image_size( 'ajaxinwp-thumb', 400, 400, true );
		add_image_size( 'ajaxinwp-feature', 1080, 720, true );
	}
endif;
add_action( 'after_setup_theme', 'ajaxinwp_setup' );

/**
 * Return a post thumbnail or the theme fallback image.
 *
 * @param int          $post_id Post ID.
 * @param string|array $size    Registered image size or dimensions.
 * @param string|array $attr    Image attributes.
 * @return string
 */
function ajaxinwp_get_post_thumbnail_or_fallback( $post_id, $size = 'medium', $attr = array() ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size, $attr );
	}

	$default_image_url = get_template_directory_uri() . '/assets/img/fallback1080x720.jpg';
	$size_class        = is_string( $size ) ? $size : 'custom';

	return sprintf(
		'<img src="%1$s" alt="%2$s" class="attachment-%3$s size-%3$s wp-post-image" loading="lazy" decoding="async">',
		esc_url( $default_image_url ),
		esc_attr__( 'Default Image', 'ajaxinwp' ),
		esc_attr( $size_class )
	);
}

/**
 * Backward-compatible alias used by existing templates.
 *
 * @param int          $post_id Post ID.
 * @param string|array $size    Registered image size or dimensions.
 * @param string|array $attr    Image attributes.
 * @return string
 */
function get_post_thumbnail_or_fallback( $post_id, $size = 'medium', $attr = array() ) {
	return ajaxinwp_get_post_thumbnail_or_fallback( $post_id, $size, $attr );
}

/**
 * Enqueue theme assets.
 */
function ajaxinwp_styles_and_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'bootstrap-css',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css',
		array(),
		'5.3.8'
	);
	wp_enqueue_style(
		'bootstrap-icons',
		'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
		array(),
		'1.13.1'
	);
	wp_enqueue_style(
		'ajaxinwp-general-style',
		get_template_directory_uri() . '/assets/css/general.css',
		array( 'bootstrap-css' ),
		$theme_version
	);

	wp_enqueue_script(
		'bootstrap-js',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.8',
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_enqueue_script(
		'ajaxinwp-js',
		get_template_directory_uri() . '/assets/js/ajaxinwp.js',
		array(),
		$theme_version,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	$runtime_config = array(
		'homeURL' => home_url( '/' ),
		'isHome'  => is_home() || is_front_page(),
	);

	wp_add_inline_script(
		'ajaxinwp-js',
		'window.ajaxinwpConfig = ' . wp_json_encode( $runtime_config ) . ';',
		'before'
	);
	wp_add_inline_script(
		'ajaxinwp-js',
		'document.documentElement.dataset.theme = ' . wp_json_encode( get_theme_mod( 'ajaxinwp_color_scheme', 'auto' ) ) . ';',
		'before'
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ajaxinwp_styles_and_scripts' );

require_once get_template_directory() . '/helpers/bootstrap-menu-walker.php';
require_once get_template_directory() . '/helpers/bootstrap-comment-walker.php';
require_once get_template_directory() . '/inc/widgets.php';

if ( ! function_exists( 'ajaxinwp_posted_on' ) ) :
	/**
	 * Print post date metadata.
	 */
	function ajaxinwp_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%s</span>',
			wp_kses_post(
				sprintf(
					esc_html_x( 'Posted on %s', 'post date', 'ajaxinwp' ),
					'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
				)
			)
		);
	}
endif;

if ( ! function_exists( 'ajaxinwp_posted_by' ) ) :
	/**
	 * Print post author metadata.
	 */
	function ajaxinwp_posted_by() {
		$author_link = sprintf(
			'<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

		printf(
			'<span class="byline"> %s</span>',
			wp_kses_post( sprintf( esc_html_x( 'by %s', 'post author', 'ajaxinwp' ), $author_link ) )
		);
	}
endif;

if ( ! function_exists( 'ajaxinwp_entry_footer' ) ) :
	/**
	 * Print post taxonomy, comment, and edit metadata.
	 */
	function ajaxinwp_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'ajaxinwp' ) );
			if ( $categories_list ) {
				printf(
					'<span class="cat-links">%s</span> | ',
					wp_kses_post( sprintf( esc_html__( 'Posted in %s', 'ajaxinwp' ), $categories_list ) )
				);
			}

			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ajaxinwp' ) );
			if ( $tags_list ) {
				printf(
					'<span class="tags-links">%s</span>',
					wp_kses_post( sprintf( esc_html__( 'Tagged %s', 'ajaxinwp' ), $tags_list ) )
				);
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'ajaxinwp' ),
						array( 'span' => array( 'class' => array() ) )
					),
					esc_html( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ajaxinwp' ),
					array( 'span' => array( 'class' => array() ) )
				),
				esc_html( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
