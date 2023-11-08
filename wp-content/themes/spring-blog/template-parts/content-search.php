<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spring_blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-post-container">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<?php spring_blog_post_thumbnail(); ?>
			</div><!-- .featured-image -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php spring_blog_entry_footer(); ?>
		</footer><!-- .entry-footer -->

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</header><!-- .entry-header -->

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				spring_blog_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php $excerpt = get_the_excerpt();
		if ( !empty($excerpt) ) { ?>
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		<?php } ?>
	</div><!-- .blog-post-container -->
</article><!-- #post-<?php the_ID(); ?> -->