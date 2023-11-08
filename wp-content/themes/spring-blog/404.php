<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package spring_blog
 */

get_header();
?>

<div class="container">
	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'spring-blog' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'spring-blog' ); ?></p>

					<?php
					get_search_form();

					?>
					
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div><!-- .container -->
<?php
get_footer();