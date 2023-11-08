<?php 

/*-----------------------------------------------------------------------------------*/
/* Initializing Widgetized Areas (Sidebars)																			 */
/*-----------------------------------------------------------------------------------*/

function endurance_widgets_init() {

	register_sidebar(array(
		'name' => __('Sidebar','endurance'),
		'id' => 'sidebar',
		'before_widget' => '<div class="widget %2$s clearfix" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="widget-title">',
		'after_title' => '</p>',
	));

	register_sidebar(array(
		'name' => __('Homepage: Welcome Message','endurance'),
		'id' => 'homepage-welcome',
		'description' => __('We recommend adding a single [Text Widget]. The widget\'s title will be wrapped in a H1 tag.','endurance'),
		'before_widget' => '<div class="widget widget-welcome %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="title-welcome widget-title"><span class="page-title-span">',
		'after_title' => '</span></h1>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 1', 'endurance' ),
		'id'            => 'footer-col-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span class="page-title-span">',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 2', 'endurance' ),
		'id'            => 'footer-col-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span class="page-title-span">',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 3', 'endurance' ),
		'id'            => 'footer-col-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span class="page-title-span">',
		'after_title'   => '</span></p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 4', 'endurance' ),
		'id'            => 'footer-col-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content-wrapper">',
		'after_widget'  => '</div><!-- .widget-content-wrapper --></div>',
		'before_title'  => '<p class="widget-title"><span class="page-title-span">',
		'after_title'   => '</span></p>',
	) );

} 

add_action( 'widgets_init', 'endurance_widgets_init' );