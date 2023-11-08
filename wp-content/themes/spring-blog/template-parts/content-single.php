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

	<footer class="entry-footer">
		<?php spring_blog_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>
	</header><!-- .entry-header -->

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php 
				spring_blog_posted_on();
				spring_blog_posted_by();
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="featured-image">
			<?php spring_blog_post_thumbnail(); ?>
		</div><!-- .featured-image -->
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->