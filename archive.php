<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
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
						<span class="posted-on">
							<time class="entry-date published" datetime="<?php echo get_the_date( 'c' ); ?>">
								<?php echo get_the_date(); ?>
							</time>
						</span>
						<span class="byline">
							<?php _e( 'by', 'brizy-starter' ); ?>
							<span class="author vcard">
								<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
									<?php echo get_the_author(); ?>
								</a>
							</span>
						</span>
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
			<h1 class="page-title">
				<?php
				if ( is_search() ) {
					printf(
						esc_html__( 'Search Results for: %s', 'brizy-starter' ),
						'<span>' . get_search_query() . '</span>'
					);
				} else {
					_e( 'Nothing Found', 'brizy-starter' );
				}
				?>
			</h1>
		</header>

		<div class="page-content">
			<?php
			if ( is_search() ) {
				_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'brizy-starter' );
				get_search_form();
			} else {
				_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'brizy-starter' );
				get_search_form();
			}
			?>
		</div>
	</section>

<?php endif; ?>

<?php
get_footer();
