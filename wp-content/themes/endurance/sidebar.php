<?php 

if ( ( is_page() || is_page_template() ) && 1 == get_theme_mod( 'endurance-display-dynamic-menu', 1 ) ) { get_template_part( 'related-pages' ); }

if (is_active_sidebar('sidebar')) {
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?> <?php endif;
} ?>