<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package spring_blog
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function spring_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_home() || is_archive() || is_search() || is_404() ) {
        $blog_sidebar = get_theme_mod( 'blog_sidebar' , 'no-sidebar' );
        $classes[] = esc_attr( $blog_sidebar );
    }

    if( is_single() ) {
        $single_post_sidebar = get_theme_mod( 'single_post_sidebar' , 'right-sidebar' );
        $classes[] = esc_attr( $single_post_sidebar );
    }

    if( is_page() ) {
        $page_sidebar = get_theme_mod( 'page_sidebar', 'no-sidebar' );
        $classes[] = esc_attr( $page_sidebar );

        $page_title_display     = get_theme_mod( 'page_title_display' , 'enable-page-title' );
        $classes[]              = esc_attr( $page_title_display );

        $page_title_alignment   = get_theme_mod( 'page_title_alignment' , 'page-title-left' );
        $classes[]              = esc_attr( $page_title_alignment );
    }

	return $classes;
}
add_filter( 'body_class', 'spring_blog_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function spring_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'spring_blog_pingback_header' );

/**
 * spring_blog Excerpt Length
 *
 * @since spring_blog 1.0.0
 *
 * @param null
 * @return void
 */

if ( ! function_exists( 'spring_blog_excerpt_length' ) ) :

  /**
   * Implement excerpt length.
   *
   * @since 1.0.0
   *
   * @param int $length The number of words.
   * @return int Excerpt length.
   */
  function spring_blog_excerpt_length( $length ) {

    if ( is_admin() ) {
      return $length;
    }

    $excerpt_length = get_theme_mod( 'excerpt_length', 20 );

    if ( absint( $excerpt_length ) > 0 ) {
      $length = absint( $excerpt_length );
    }

    return $length;
  }

endif;

add_filter( 'excerpt_length', 'spring_blog_excerpt_length', 999 );
