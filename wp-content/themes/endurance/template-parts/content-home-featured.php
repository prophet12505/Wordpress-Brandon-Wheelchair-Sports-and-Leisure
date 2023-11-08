<?php
/**
 * The template used for displaying featured pages on the Front Page.
 *
 * @package Endurance
 */

$page_ids = array();
if ( absint(get_theme_mod( 'endurance-featured-page-1', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'endurance-featured-page-1', false )); }
if ( absint(get_theme_mod( 'endurance-featured-page-2', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'endurance-featured-page-2', false )); }
if ( absint(get_theme_mod( 'endurance-featured-page-3', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'endurance-featured-page-3', false )); }
$page_count = 0;
$page_count = count($page_ids);

if ( $page_count > 0 ) {
	$custom_loop = new WP_Query( array( 'post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in' ) );

	if ( $custom_loop->have_posts() ) : ?>
	<div id="home-featured-pages">

		<ul class="ilovewp-featured-pages-list">

			<?php 
			while ( $custom_loop->have_posts() ) : $custom_loop->the_post();
			$classes = array('site-archive-post','ilovewp-featured-page-item'); 
			
			if ( !has_post_thumbnail() ) {
				$classes[] = 'post-nothumbnail';
			} else {
				$classes[] = 'has-post-thumbnail';
			}
			?><li <?php post_class($classes); ?>>
				<div class="site-column-widget-wrapper">
					<?php if ( has_post_thumbnail() ) { ?>
					<div class="entry-thumbnail">
					<?php 
						echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
						the_post_thumbnail('endurance-thumb-featured-page');
						echo '</a>'; ?>
					</div><!-- .entry-thumbnail --><?php } ?>
					<div class="entry-preview">
						<div class="entry-preview-wrapper">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php if ( 1 == get_theme_mod( 'endurance-display-pages-excerpts', 1 ) ) { ?><p class="entry-excerpt"><?php echo get_the_excerpt(); ?></p><?php } ?>
						</div><!-- .entry-preview-wrapper -->
					</div><!-- .entry-preview -->
				</div><!-- .site-column-widget-wrapper -->
			</li><!-- .site-archive-post --><?php endwhile; ?>

		</ul><!-- .ilovewp-featured-pages-list -->

	</div><!-- #home-featured-pages -->
<?php endif; } ?>