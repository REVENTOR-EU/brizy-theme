<?php
/**
 * Template for displaying pages
 * Designed for maximum Brizy compatibility
 */

get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'brizy-starter' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div class="comments-section">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>

	</article>

<?php endwhile; ?>

<?php
get_footer();
