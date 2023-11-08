<?php
/**
 * Spring Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package spring_blog
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function spring_blog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Spring Blog, use a find and replace
		* to change 'spring-blog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'spring-blog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'spring-blog' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'spring_blog_custom_background_args',
			array(
				'default-color' => 'F0F0F0',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	add_editor_style( array( '/css/editor-style.css', spring_blog_get_fonts_url() ) );

	// Gutenberg support
	add_theme_support( 'editor-color-palette', array(
       	array(
			'name' => esc_html__( 'Blue', 'spring-blog' ),
			'slug' => 'blue',
			'color' => '#2c7dfa',
       	),
       	array(
           	'name' => esc_html__( 'Green', 'spring-blog' ),
           	'slug' => 'green',
           	'color' => '#07d79c',
       	),
       	array(
           	'name' => esc_html__( 'Orange', 'spring-blog' ),
           	'slug' => 'orange',
           	'color' => '#ff8737',
       	),
       	array(
           	'name' => esc_html__( 'Black', 'spring-blog' ),
           	'slug' => 'black',
           	'color' => '#2f3633',
       	),
       	array(
           	'name' => esc_html__( 'Grey', 'spring-blog' ),
           	'slug' => 'grey',
           	'color' => '#82868b',
       	),
   	));

	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-font-sizes', array(
	   	array(
	       	'name' => esc_html__( 'small', 'spring-blog' ),
	       	'shortName' => esc_html__( 'S', 'spring-blog' ),
	       	'size' => 12,
	       	'slug' => 'small'
	   	),
	   	array(
	       	'name' => esc_html__( 'regular', 'spring-blog' ),
	       	'shortName' => esc_html__( 'M', 'spring-blog' ),
	       	'size' => 16,
	       	'slug' => 'regular'
	   	),
	   	array(
	       	'name' => esc_html__( 'larger', 'spring-blog' ),
	       	'shortName' => esc_html__( 'L', 'spring-blog' ),
	       	'size' => 36,
	       	'slug' => 'larger'
	   	),
	   	array(
	       	'name' => esc_html__( 'huge', 'spring-blog' ),
	       	'shortName' => esc_html__( 'XL', 'spring-blog' ),
	       	'size' => 48,
	       	'slug' => 'huge'
	   	)
	));
	add_theme_support('editor-styles');
	add_theme_support( 'wp-block-styles' );
}
add_action( 'after_setup_theme', 'spring_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spring_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spring_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'spring_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spring_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'spring-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'spring-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'spring-blog' ),
			'id'            => 'footer-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'spring-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'spring-blog' ),
			'id'            => 'footer-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'spring-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 3', 'spring-blog' ),
			'id'            => 'footer-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'spring-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'spring_blog_widgets_init' );

/**
* Enqueue theme fonts.
*/
function spring_blog_fonts() {
	$fonts_url = spring_blog_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		wp_enqueue_style( 'spring-blog-fonts', wptt_get_webfont_url( $fonts_url ), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'spring_blog_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'spring_blog_fonts', 1 );

/**
 * Retrieve webfont URL to load fonts locally.
 */
function spring_blog_get_fonts_url() {
	$font_families = array(
		'Poppins:400,500,600,700,800',
		'Open Sans:300,400,500,600,700',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'spring_blog_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}

/**
 * Enqueue scripts and styles.
 */
function spring_blog_scripts() {

	wp_enqueue_style( 'spring-blog-style', get_stylesheet_uri() );

	wp_style_add_data( 'spring-blog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'spring-blog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'spring-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'spring-blog-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spring_blog_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Spring Blog 1.0.0
 */
function spring_blog_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'spring-blog-block-editor-style', get_theme_file_uri( '/css/editor-blocks.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'spring-blog-fonts', spring_blog_get_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'spring_blog_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';