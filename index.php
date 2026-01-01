<?php
/**
 * The main template file
 * This is the fallback template used when no more specific template is found
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		<?php elseif ( is_archive() ) : ?>
			<h1 class="page-title"><?php the_archive_title(); ?></h1>
		<?php endif; ?>
	</header>

	<div class="posts-container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					<div class="entry-meta">
						<span class="posted-on"><?php echo get_the_date(); ?></span>
						<span class="byline"><?php _e( 'by', 'brizy-starter' ); ?> <?php the_author(); ?></span>
					</div>
				</header>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'medium' ); ?>
						</a>
					</div>
				<?php endif; ?>

			</article>
		<?php endwhile; ?>
	</div>

	<?php
	// Pagination
	the_posts_pagination(
		array(
			'prev_text' => __( 'Previous', 'brizy-starter' ),
			'next_text' => __( 'Next', 'brizy-starter' ),
		)
	);
	?>

<?php else : ?>

	<section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title"><?php _e( 'Nothing here', 'brizy-starter' ); ?></h1>
		</header>

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'brizy-starter' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			<?php elseif ( is_search() ) : ?>
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'brizy-starter' ); ?></p>
				<?php get_search_form(); ?>
			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'brizy-starter' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div>
	</section>

<?php endif; ?>

<?php
get_footer();
