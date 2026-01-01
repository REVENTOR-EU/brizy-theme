<?php
/**
 * Template for displaying 404 errors (Not Found)
 * Designed for maximum Brizy compatibility
 */

get_header();
?>

<div class="error-404 not-found">

	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'brizy-starter' ); ?></h1>
	</header>

	<div class="page-content">
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'brizy-starter' ); ?></p>

		<?php get_search_form(); ?>

		<div class="home-link">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button">
				<?php _e( '← Back to Homepage', 'brizy-starter' ); ?>
			</a>
		</div>
	</div>

</div>

<?php
get_footer();
