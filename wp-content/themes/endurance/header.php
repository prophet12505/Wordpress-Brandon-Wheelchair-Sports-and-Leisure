<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="container">

	<div class="site-wrapper-all site-wrapper-boxed">

		<a class="skip-link screen-reader-text" href="#site-main"><?php esc_html_e( 'Skip to content', 'endurance' ); ?></a>

		<header id="site-masthead" class="site-section site-section-masthead">
			<div class="site-section-wrapper site-section-wrapper-masthead">
				<div id="site-logo"><?php 
					if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
						endurance_the_custom_logo();
					} else { ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p><?php } ?></div><!-- #site-logo -->
					<div id="site-section-primary-menu">
					<?php
						if (has_nav_menu( 'primary' ) || has_nav_menu( 'mobile' )) {
							get_template_part( 'template-parts/mobile-menu-toggle' );
							get_template_part( 'template-parts/mobile-menu' );
						}
					?>
					<nav id="site-primary-nav">

					<?php if (has_nav_menu( 'primary' )) { 
					wp_nav_menu( array(
						'container' => '', 
						'container_class' => '', 
						'menu_class' => 'dropdown', 
						'menu_id' => 'site-primary-menu', 
						'sort_column' => 'menu_order', 
						'theme_location' => 'primary', 
						'link_after' => '', 
						'items_wrap' => '<ul id="site-primary-menu" class="large-nav sf-menu">%3$s</ul>' ) );
					}
					?>
				</nav><!-- #site-primary-nav -->
				</div><!-- #site-section-primary-menu -->
			</div><!-- .site-section-wrapper .site-section-wrapper-masthead -->
		</header><!-- #site-masthead .site-section-masthead --><?php

		// Function to display Breadcrumbs
		ilovewp_helper_display_breadcrumbs();

		if ( is_front_page() || is_home() ) {
			echo '<div class="site-section-wrapper site-section-hero-wrapper">';
				echo '<div id="ilovewp-hero" class="site-section-slideshow loading">';
				// the_custom_header_markup();
				$header_images = get_uploaded_header_images();
				if ( $header_images && count( $header_images ) > 0 ) {
					echo '<ul class="ilovewp-slides ilovewp-slideshow">';
					$i = 0;
					foreach ( $header_images as $header_image ) {
						$i++;

						$image_alt_attribute = get_post_meta($header_image['attachment_id'], '_wp_attachment_image_alt', true);
						if ( empty($image_alt_attribute) ) {
							$image_alt_attribute = '';
						}

						$atts = array(
							'alt' 		=> $image_alt_attribute,
							'class' 	=> 'size-endurance-thumb-slideshow'
						);
		
						if ( $i == 1 ) {
							$atts['loading'] = 'eager';
						}

						echo '<li class="ilovewp-slide">';
						echo wp_get_attachment_image( $header_image['attachment_id'], 'thumb-ilovewp-featured', false, $atts );
						echo '</li><!-- .ilovewp-slide -->';
					}
					echo '</ul><!-- .ilovewp-slideshow -->';
				}
				echo '</div><!-- #ilovewp-hero .site-section-slideshow -->';
			echo '</div><!-- .site-section-wrapper .site-section-hero-wrapper -->';
		} else {
			if ( is_singular() ) {
				if ( function_exists ( "is_woocommerce") && is_woocommerce() ) {
					return true;
				}
				
				$themeoptions_featured_hero = esc_attr(get_theme_mod( 'endurance-display-featured-hero', 0 ));

				if ( $themeoptions_featured_hero == 1 ) {
					while (have_posts()) : the_post();
					get_template_part('slideshow','single');
					endwhile;
				}
			} 
		}
?>