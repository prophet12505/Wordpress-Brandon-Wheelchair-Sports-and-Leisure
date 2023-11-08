<?php

if( ! function_exists( 'ilovewp_helper_display_breadcrumbs' ) ) {
	function ilovewp_helper_display_breadcrumbs() {

		if ( is_home() ) {
			return;
		}

		// CONDITIONAL FOR "Breadcrumb NavXT" plugin OR Yoast SEO Breadcrumbs
		// https://wordpress.org/plugins/breadcrumb-navxt/

		if ( function_exists('bcn_display') ) { ?>
		<div class="site-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			<div class="site-section-wrapper site-section-wrapper-crumbs">
				<p class="site-breadcrumbs-p"><?php bcn_display(); ?></p>
			</div><!-- .site-section-wrapper .site-section-wrapper-main -->
		</div><!-- .site-breadcrumbs--><?php }

		// CONDITIONAL FOR "Yoast SEO" plugin, Breadcrumbs feature
		// https://wordpress.org/plugins/wordpress-seo/
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<div class="site-breadcrumbs"><div class="site-section-wrapper site-section-wrapper-crumbs"><p class="site-breadcrumbs-p">','</p></div><!-- .site-section-wrapper .site-section-wrapper-main --></div>');
		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_title' ) ) {
	function ilovewp_helper_display_title($post) {

		if( ! is_object( $post ) ) return;
		the_title( '<h1 class="page-title"><span class="page-title-span">', '</span></h1>' );
	}
}

if( ! function_exists( 'ilovewp_helper_display_datetime' ) ) {
	function ilovewp_helper_display_datetime($post) {
		
		if( ! is_object( $post ) ) return;

		return '<p class="entry-descriptor"><span class="entry-descriptor-span"><time class="entry-date published" datetime="' . esc_attr(get_the_date('c')) . '">' . get_the_date() . '</time></span></p>';

	}
}

if( ! function_exists( 'ilovewp_helper_display_excerpt' ) ) {
	function ilovewp_helper_display_excerpt($post) {

		if( ! is_object( $post ) ) return;

		return '<p class="entry-excerpt">' . get_the_excerpt() . '</p>';

	}
}

if( ! function_exists( 'ilovewp_helper_display_comments' ) ) {
	function ilovewp_helper_display_comments($post) {

		if( ! is_object( $post ) ) return;

		if ( comments_open() || get_comments_number() ) :

			echo '<hr /><div id="ilovewp-comments"">';
			comments_template();
			echo '</div><!-- #ilovewp-comments -->';

		endif;

	}
}

if( ! function_exists( 'ilovewp_helper_display_content' ) ) {
	function ilovewp_helper_display_content($post) {

		if( ! is_object( $post ) ) return;

		echo '<div class="entry-content">';
			
			the_content();
			
			wp_link_pages(array('before' => '<p class="page-navigation"><strong>'.__('Pages', 'endurance').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));

		echo '</div><!-- .entry-content -->';

	}
}

if( ! function_exists( 'ilovewp_helper_display_woocommerce_content' ) ) {
	function ilovewp_helper_display_woocommerce_content($post) {

		if( ! is_object( $post ) ) return;

		echo '<div class="entry-content">';
			
			the_content();

		echo '</div><!-- .entry-content -->';

	}
}

if( ! function_exists( 'ilovewp_helper_display_tags' ) ) {
	function ilovewp_helper_display_tags($post) {

		if( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 
			the_tags( '<p class="post-meta post-tags"><strong>'.__('Tags', 'endurance').':</strong> ', ', ', '</p>');
		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_postmeta' ) ) {
	function ilovewp_helper_display_postmeta($post) {

		if( ! is_object( $post ) ) return;

		if ( get_post_type($post->ID) == 'post' ) { 

			echo '<p class="entry-tagline">';
			echo '<span class="post-meta-span post-meta-span-time"><time datetime="' . esc_attr(get_the_time("Y-m-d")) . '" pubdate>' . esc_html(get_the_time(get_option('date_format'))) . '</time></span>';
			echo '<span class="post-meta-span post-meta-span-category">'; the_category(', '); echo '</span>';
			echo '</p><!-- .entry-tagline -->';

		}

	}
}

if( ! function_exists( 'ilovewp_helper_display_page_sidebar_column' ) ) {
	function ilovewp_helper_display_page_sidebar_column() {

		?><div class="site-column-aside">

			<div class="site-column-aside-wrapper">

				<?php get_sidebar(); ?>

			</div><!-- .site-column-aside-wrapper -->

		</div><!-- .site-column-aside --><?php

	}
}

// Content Column Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_page_content_wrapper_start' ) ) {
	function ilovewp_helper_display_page_content_wrapper_start() {

		?><div class="site-column-content"><div class="site-column-content-wrapper"><?php

	}
}

// Content Column Wrapper Start
if( ! function_exists( 'ilovewp_helper_display_page_content_wrapper_end' ) ) {
	function ilovewp_helper_display_page_content_wrapper_end() {

		?></div><!-- .site-column-content-wrapper --></div><!-- .site-column-content --><?php

	}
}

// Get Header Style
if( ! function_exists( 'ilovewp_helper_get_header_style' ) ) {
	function ilovewp_helper_get_header_style() {

		$themeoptions_header_style = esc_attr(get_theme_mod( 'theme-header-style', 'default' ));

		if ( $themeoptions_header_style == 'default' ) {
			$default_position = 'page-header-default';
		} elseif ( $themeoptions_header_style == 'centered' ) {
			$default_position = 'page-header-centered';
		}

		return $default_position;
	}
}

/**
 * Adds a Sub Nav Toggle to the Expanded Menu and Mobile Menu.
 *
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return stdClass An object of wp_nav_menu() arguments.
 */
function endurance_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

	// Add sub menu toggles to the Expanded Menu with toggles.
	if ( isset( $args->show_toggles ) && $args->show_toggles ) {

		$args->after  = '';

		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

			$args->after .= '<button class="sub-menu-toggle toggle-anchor"><span class="screen-reader-text">' . __( 'Show sub menu', 'endurance' ) . '</span><i class="icon-icomoon ilovewp-icon-chevron-down"></i></span></button>';

		}
	} 

	return $args;

}

add_filter( 'nav_menu_item_args', 'endurance_add_sub_toggles_to_main_menu', 10, 3 );