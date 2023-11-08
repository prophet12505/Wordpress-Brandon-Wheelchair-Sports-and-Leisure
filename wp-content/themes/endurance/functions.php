<?php			

if ( ! isset( $content_width ) ) $content_width = 660;

/**
 * Define some constats
 */
if( ! defined( 'ILOVEWP_VERSION' ) ) {
	define( 'ILOVEWP_VERSION', '1.2.3' );
}
if( ! defined( 'ILOVEWP_THEME_LITE' ) ) {
	define( 'ILOVEWP_THEME_LITE', true );
}
if( ! defined( 'ILOVEWP_THEME_PRO' ) ) {
	define( 'ILOVEWP_THEME_PRO', false );
}
if( ! defined( 'ILOVEWP_DIR' ) ) {
	define( 'ILOVEWP_DIR', trailingslashit( get_template_directory() ) );
}
if( ! defined( 'ILOVEWP_DIR_URI' ) ) {
	define( 'ILOVEWP_DIR_URI', trailingslashit( get_template_directory_uri() ) );
}

if ( ! function_exists( 'endurance_setup' ) ) :

function endurance_setup() {
    // This theme styles the visual editor to resemble the theme style.
    add_editor_style( array( 'css/editor-style.css' ) );

	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 300, 300, true );

	add_image_size( 'endurance-thumb-slideshow', 980, 450, true );
	add_image_size( 'endurance-thumb-slideshow-small', 654, 300, true );
	add_image_size( 'endurance-thumb-featured-page-large', 660, 440, true );
	add_image_size( 'endurance-thumb-featured-page', 300, 200, true );
	add_image_size( 'endurance-thumbnail-large', 600, 600, true );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

	/* Add support for Custom Background 
	==================================== */
	
	// Custom background color.
	add_theme_support( 'custom-background', array(
		'default-color'	=> 'f8f6f2'
	) );
	
    /* Add support for Custom Logo 
	==================================== */

    add_theme_support( 'custom-logo', array(
	   'height'      => 100,
	   'width'       => 300,
	   'flex-width'  => true,
	   'flex-height' => true,
	) );

	/* Add support for post and comment RSS feed links in <head>
	==================================== */
	
	add_theme_support( 'automatic-feed-links' ); 

	add_theme_support( 'customize-selective-refresh-widgets' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

	/* Add support for Localization
	==================================== */
	
	load_theme_textdomain( 'endurance', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);

	/* Add support for Custom Headers 
	==================================== */
	
	add_theme_support(
		'custom-header', apply_filters(
			'academia_custom_header_args', array(
				'width'            => 980,
				'height'           => 450,
				'flex-height'      => true,
				'video'            => false
			)
		)
	);

	// Register nav menus
    register_nav_menus( array(
        'primary' 	=> __( 'Main Menu', 'endurance' ),
        'mobile'	=> __( 'Mobile Menu', 'endurance' )
    ) );

	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'woocommerce' );

}
endif;

add_action( 'after_setup_theme', 'endurance_setup' );

add_filter( 'image_size_names_choose', 'endurance_custom_sizes' );
 
function endurance_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'endurance-thumb-slideshow' 		  => __( 'Slideshow Size - 980x450', 'endurance' ),
		'endurance-thumb-featured-page' 	  => __( 'Page Thumbnail - Large - 660x440', 'endurance' ),
		'endurance-thumb-featured-page-large' => __( 'Page Thumbnail - Small - 300x200', 'endurance' ),
		'endurance-thumbnail-large' 		  => __( 'Thumbnail - Large - 600x600', 'endurance' ),
		'post-thumbnail' 					  => __( 'Thumbnail - Small - 300x300', 'endurance' ),
	) );
}

if ( ! function_exists( 'endurance_js_scripts' ) ) :

/* Add javascripts and CSS used by the theme 
================================== */
function endurance_js_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	// Theme stylesheet.
	wp_enqueue_style( 'endurance-style', get_stylesheet_uri(), array(), $theme_version );

	if (! is_admin()) {

		wp_enqueue_script(
			'jquery-superfish',
			get_template_directory_uri() . '/js/superfish.min.js',
			array('jquery'),
			true
		);

		wp_enqueue_script(
			'jquery-flexslider',
			get_template_directory_uri() . '/js/jquery.flexslider-min.js',
			array('jquery'),
			true
		);

		wp_register_script( 'endurance-scripts', get_template_directory_uri() . '/js/endurance.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'endurance-scripts' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

		/* Icomoon */
		wp_enqueue_style('ilovewp-icomoon', get_template_directory_uri() . '/css/icomoon.css', null, $theme_version);

	}

}
endif;

add_action('wp_enqueue_scripts', 'endurance_js_scripts');

if ( ! function_exists( 'endurance_get_the_archive_title' ) ) :

/* Custom Archives titles.
=================================== */
function endurance_get_the_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }

    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'endurance_get_the_archive_title' );

/* Enable Excerpts for Static Pages
==================================== */

add_action( 'init', 'endurance_excerpts_for_pages' );

if ( ! function_exists( 'endurance_excerpts_for_pages' ) ) :
function endurance_excerpts_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
endif;

/* Custom Excerpt Length
==================================== */

if ( ! function_exists( 'endurance_new_excerpt_length' ) ) :
function endurance_new_excerpt_length($length) {
	if ( is_admin() ) { return $length; }
	else { return 30; }
}
endif;
add_filter('excerpt_length', 'endurance_new_excerpt_length');

if ( ! function_exists( 'endurance_excerpts' ) ) :

/* Replace invalid ellipsis from excerpts
==================================== */
function endurance_excerpts($text)
{
	if ( is_admin() ) return $text;
	$text = str_replace(' [&hellip;]', '&hellip;', $text);
	$text = str_replace('[&hellip;]', '&hellip;', $text);
	$text = str_replace('[...]', '...', $text);
	return $text;
}
endif;
add_filter('excerpt_more', 'endurance_excerpts');

if ( ! function_exists( 'endurance_hex2rgb' ) ) :

/* Convert HEX color to RGB value (for the customizer)						
==================================== */

function endurance_hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = "$r, $g, $b";
	return $rgb; // returns an array with the rgb values
}

endif;

if ( ! function_exists( 'endurance_pingback_header' ) ) :

/**
* Add a pingback url auto-discovery header for singularly identifiable articles.
*/
function endurance_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo( 'pingback_url' )) );
	}
}
endif;
add_action( 'wp_head', 'endurance_pingback_header' );

if ( ! function_exists( 'endurance_theme_support_classic_widgets' ) ) :

function endurance_theme_support_classic_widgets() {
	remove_theme_support( 'widgets-block-editor' );
}
endif;
add_action( 'after_setup_theme', 'endurance_theme_support_classic_widgets' );

/**
 * --------------------------------------------
 * Enqueue scripts and styles for the backend.
 *
 * @package Endurance
 * --------------------------------------------
 */

if ( ! function_exists( 'endurance_scripts_admin' ) ) {
	/**
	 * Enqueue admin styles and scripts
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function endurance_scripts_admin( $hook ) {
		// if ( 'widgets.php' !== $hook ) return;

		// Styles
		wp_enqueue_style(
			'endurance-style-admin',
			get_template_directory_uri() . '/ilovewp-admin/css/ilovewp_theme_settings.css',
			'', ILOVEWP_VERSION, 'all'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'endurance_scripts_admin' );

if ( ! function_exists( 'endurance_body_classes' ) ) :

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Endurance 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function endurance_body_classes( $classes ) {

	$classes[] = ilovewp_helper_get_header_style();

	return $classes;
}
endif;

add_filter( 'body_class', 'endurance_body_classes' );

if ( ! function_exists( 'endurance_the_custom_logo' ) ) {

/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Endurance 1.0
 */

	function endurance_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			
			// We don't use the default the_custom_logo() function because of its automatic addition of itemprop attributes (they fail the ARIA tests)
			
			$site = get_bloginfo('name');
			$custom_logo_id = get_theme_mod( 'custom_logo' );

			if ( $custom_logo_id ) {
			$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>', 
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image( $custom_logo_id, 'full', false, array(
					'class'    => 'custom-logo',
					'alt' => __('Logo for ','endurance') . esc_attr($site),
					) )
				);
			}

			echo $html;

		}

	}
}

if ( ! function_exists( 'endurance_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function endurance_comment( $comment, $args, $depth ) {

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php esc_html_e( 'Pingback:', 'endurance' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'endurance' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author -->

			<header class="comment-meta">
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php /* translators: 1: date, 2: time */ printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'endurance' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'endurance' ); ?></p>
				<?php endif; ?>

				<div class="comment-tools">
					<?php edit_comment_link( esc_html__( 'Edit', 'endurance' ), '<span class="edit-link">', '</span>' ); ?>

					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<span class="reply">',
							'after'     => '</span>',
						) ) );
					?>
				</div><!-- .comment-tools -->
			</header><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for endurance_comment()

if ( ! function_exists( 'wp_body_open' ) ) :
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
endif;

if ( ! function_exists( 'endurance_remove_header_textcolor' ) ) :

/**
* @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function endurance_remove_header_textcolor( $wp_customize ) {

// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
	return $wp_customize;

}
endif;
add_action( 'customize_register', 'endurance_remove_header_textcolor' );

// Add custom CSS to first featured image on a page
if ( ! function_exists( 'endurance_add_featured_image_class' ) ) :
	function endurance_add_featured_image_class($attr) {
		if ( $attr['class'] === 'custom-logo' ) {
			return $attr; 
		}
		remove_filter('wp_get_attachment_image_attributes','endurance_add_featured_image_class');
		$attr['class'] .= ' endurance-first-image skip-lazy';
		$attr['loading'] = 'eager';
		return $attr;
	}
endif;
add_filter('wp_get_attachment_image_attributes','endurance_add_featured_image_class'); 

/* Include WordPress Theme Customizer
================================== */

require_once( get_template_directory() . '/customizer/customizer.php');

/* Include Additional Options and Components
================================== */

require_once( get_template_directory() . '/ilovewp-admin/sidebars.php');
require_once( get_template_directory() . '/ilovewp-admin/helper-functions.php');
require_once( get_template_directory() . '/ilovewp-admin/components/ilovewp-tgmpa.php');

//require only in admin!
if(is_admin()){	
	require_once('ilovewp-admin/ilovewp-theme-settings.php');

	if (current_user_can( 'manage_options' ) ) {
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notices.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-welcome.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-upgrade.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-review.php');

		// Remove theme data from database when theme is deactivated.
		add_action('switch_theme', 'endurance_db_data_remove');

		if ( ! function_exists( 'endurance_db_data_remove' ) ) {
			function endurance_db_data_remove() {

				delete_option( 'endurance_admin_notices');
				delete_option( 'endurance_theme_installed_time');

			}
		}

	}

}

if ( ! function_exists( 'endurance_bbp_supported_patterns' ) ) :
function endurance_bbp_supported_patterns($hook) {
	$pattern_slugs = array(
		'bbp-pattern-general-about-1',
		'bbp-pattern-general-call-to-action-2',
		'bbp-pattern-general-call-to-action-3',
		'bbp-pattern-general-contact-2',
		'bbp-pattern-general-featured-pages-1',
		'bbp-pattern-general-featured-pages-2',
		'bbp-pattern-general-partners-1',
		'bbp-pattern-general-partners-2',
		'bbp-pattern-general-team-2',
		'bbp-pattern-general-team-3'

	);
	return $pattern_slugs;
}
endif;

add_action( 'bbp_theme_supported_patterns', 'endurance_bbp_supported_patterns' );