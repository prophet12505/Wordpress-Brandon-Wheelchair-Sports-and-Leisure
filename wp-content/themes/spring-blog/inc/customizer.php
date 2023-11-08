<?php
/**
 * Spring Blog Theme Customizer
 *
 * @package spring_blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function spring_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Load sanitize functions.
	include get_template_directory() . '/inc/sanitize.php';

	include get_template_directory() . '/inc/upsell-section.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'spring_blog_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'spring_blog_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->register_section_type( 'spring_blog_Customize_Upsell_Section' );

	// Register section.
	$wp_customize->add_section(
		new spring_blog_Customize_Upsell_Section(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Spring Blog Pro', 'spring-blog' ),
				'pro_text' => esc_html__( 'Buy Pro', 'spring-blog' ),
				'pro_url'  => 'https://kortezthemes.com/spring-blog-pro/',
				'priority' => 10,
			)
		)
	);

	// General Options Panel
	$wp_customize->add_panel( 'general_options_panel',
		array(
		'title'      => __( 'General Options', 'spring-blog' ),
		'capability' => 'edit_theme_options',
		)
	);

	// Excerpt Length
	$wp_customize->add_section('section_excerpt_length', 
		array(    
		'title'       => __('Excerpt Length', 'spring-blog'),
		'panel'       => 'general_options_panel'    
		)
	);

	$wp_customize->add_setting( 'excerpt_length', array(
		'default'           => '20',
		'sanitize_callback' => 'spring_blog_sanitize_number_range',
	) );

	$wp_customize->add_control( 'excerpt_length', array(
		'label'       => __( 'Excerpt Length', 'spring-blog' ),
		'description' => __( 'Min 5 & Max 200.', 'spring-blog' ),
		'section'     => 'section_excerpt_length',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 5, 'max' => 200, 'style' => 'width: 75px;' ),
	) );

	// Sidebar Layout Options
	$wp_customize->add_section('section_sidebar_layout', 
		array(  
	    'capability'  => 'edit_theme_options',  
		'title'       => __('Sidebar Layout Options', 'spring-blog'),
		)
	);

	// Blog Sidebar
	$wp_customize->add_setting('blog_sidebar', 
		array(
		'default' 			=> 'no-sidebar',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spring_blog_sanitize_select',
		'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control('blog_sidebar', 
		array(		
		'label' 	=> __('Blog Sidebar', 'spring-blog'),
		'section' 	=> 'section_sidebar_layout',
		'settings'  => 'blog_sidebar',
		'type' 		=> 'radio',
		'choices' 	=> array(		
			'left-sidebar' 	=> __( 'Show Sidebar on Left', 'spring-blog'),						
			'right-sidebar' => __( 'Show Sidebar on Right', 'spring-blog'),	
			'no-sidebar' 	=> __( 'Disable Sidebar', 'spring-blog'),	
			),	
		)
	);

	// Blog Sidebar
	$wp_customize->add_setting('single_post_sidebar', 
		array(
		'default' 			=> 'right-sidebar',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spring_blog_sanitize_select',
		'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control('single_post_sidebar', 
		array(		
		'label' 	=> __('Single Post Sidebar', 'spring-blog'),
		'section' 	=> 'section_sidebar_layout',
		'settings'  => 'single_post_sidebar',
		'type' 		=> 'radio',
		'choices' 	=> array(		
			'left-sidebar' 	=> __( 'Show Sidebar on Left', 'spring-blog'),						
			'right-sidebar' => __( 'Show Sidebar on Right', 'spring-blog'),	
			'no-sidebar' 	=> __( 'Disable Sidebar', 'spring-blog'),	
			),	
		)
	);

	// Page Sidebar
	$wp_customize->add_setting('page_sidebar', 
		array(
		'default' 			=> 'no-sidebar',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spring_blog_sanitize_select',
		'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control('page_sidebar', 
		array(		
		'label' 	=> __('Page Sidebar', 'spring-blog'),
		'section' 	=> 'section_sidebar_layout',
		'settings'  => 'page_sidebar',
		'type' 		=> 'radio',
		'choices' 	=> array(		
			'left-sidebar' 	=> __( 'Show Sidebar on Left', 'spring-blog'),						
			'right-sidebar' => __( 'Show Sidebar on Right', 'spring-blog'),	
			'no-sidebar' 	=> __( 'Disable Sidebar', 'spring-blog'),	
			),	
		)
	);

	// Post Column Options
	$wp_customize->add_setting( 'post_column_option', array(
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'spring_blog_sanitize_number_range',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'post_column_option', array(
		'label'       => __( 'Enter Post Column', 'spring-blog' ),
		'description' => __( 'Min 1 & Max 5.', 'spring-blog' ),
		'section'     => 'section_sidebar_layout',
		'type'        => 'number',
		'input_attrs' => array( 'min' => 1, 'max' => 5, 'style' => 'width: 55px;' ),
	) );

	// Footer Section
	$wp_customize->add_section('section_footer', array(    
		'title'       => __('Footer Copyright', 'spring-blog'),
	));

	$wp_customize->add_setting( 'footer_copyright_text', array(
		'default'           => esc_html__('Copyright © 2023 Spring Blog. All Rights Reserved.', 'spring-blog'),
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );

	$wp_customize->add_control( 'footer_copyright_text', array(
		'label'       => __( 'Footer Copyright Text', 'spring-blog' ),
		'section' 	  => 'section_footer',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'spring_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function spring_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function spring_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function spring_blog_customize_preview_js() {
	wp_enqueue_script( 'spring-blog-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), 20151215, true );
}
add_action( 'customize_preview_init', 'spring_blog_customize_preview_js' );

/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.0
 */
function spring_blog_customizer_control_scripts() {

	wp_enqueue_style( 'spring-blog-customize-controls', get_template_directory_uri() . '/css/customize-controls.css', '', '1.0.0' );

	wp_enqueue_script( 'spring-blog-customize-controls', get_template_directory_uri() . '/js/customize-controls.js', array( 'customize-controls' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'spring_blog_customizer_control_scripts', 0 );