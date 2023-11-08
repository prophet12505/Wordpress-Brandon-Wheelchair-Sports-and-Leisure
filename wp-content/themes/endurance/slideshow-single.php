<?php 
if ( is_single() || is_page() || is_page_template() ) {

	$meta_target_id = $post->ID;

	if ( $post->ID == 0 ) {
		global $wp_query;
		if ( isset( $wp_query->queried_object->ID ) ) { $meta_target_id = $wp_query->queried_object->ID; }
	}

	$post_meta = get_post_custom($meta_target_id);

	if ( has_post_thumbnail( $meta_target_id ) ) {
		$featured_image_id = get_post_thumbnail_id($meta_target_id);
		?>
		<div class="site-section-wrapper site-section-hero-wrapper">
			<div id="ilovewp-hero">
				<?php
				$image_alt_attribute = get_post_meta($featured_image_id, '_wp_attachment_image_alt', true);
				if ( empty($image_alt_attribute) ) {
					$image_alt_attribute = '';
				}
				$atts = array(
					'alt' 		=> $image_alt_attribute,
					'class' 	=> 'size-endurance-thumb-slideshow',
					'loading' 	=> 'eager'
				);
				the_post_thumbnail('endurance-thumb-slideshow', $atts);

				if ( is_page() ) {
					$themeoptions_featured_parent_title = esc_attr(get_theme_mod( 'endurance-display-featured-parent-title', 0 ));

					if ( $themeoptions_featured_parent_title == 1 ) {

						$parent_id = $post->post_parent;
						$parent_title = get_the_title($parent_id);

						?><div class="ilovewp-hero-parent">
							<h2 class="ilovewp-parent-page-title"><?php echo esc_html( $parent_title ); ?></h2>
						</div><!-- .ilovewp-hero-parent --><?php 
					}
				}

				?>
			</div><!-- #ilovewp-hero .site-section .site-section-slideshow -->
		</div><!-- .site-section-wrapper .site-section-hero-wrapper --><?php

	}

} 