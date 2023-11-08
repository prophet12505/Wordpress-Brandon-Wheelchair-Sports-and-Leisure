<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package spring_blog
 */

get_header();
?>

<div class="container">
	<main id="primary" class="site-main">
		<?php $post_column_option = get_theme_mod( 'post_column_option', 3 ); ?>
		<div class="blog-archive columns-<?php echo $post_column_option; ?> clear">
			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

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