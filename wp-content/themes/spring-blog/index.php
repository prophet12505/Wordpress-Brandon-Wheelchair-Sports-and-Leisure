<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring_blog
 */

get_header();
?>

<div class="container">
	<main id="primary" class="site-main">
		<?php $post_column_option = get_theme_mod( 'post_column_option', 3 ); ?>
		<div class="blog-archive columns-<?php echo $post_column_option; ?> clear">
			<?php if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>
		</div><!--.blog-archive -->

		<?php the_posts_pagination(); ?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div><!-- .container -->
<?php
get_footer();