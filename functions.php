<?php
/**
 * Brizy Starter
 *
 * A minimal WordPress theme designed specifically for maximum compatibility
 * with Brizy page builder. This theme is NOT built by the official Brizy team.
 *
 * This theme provides only essential WordPress functionality while letting
 * Brizy handle all design and layout decisions.
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Setup - Only essential WordPress features
 */
function reventor_brizy_setup() {
	// Core WordPress features
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
	add_theme_support( 'automatic-feed-links' );

	// Navigation menus
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'brizy-starter' ),
			'footer'  => __( 'Footer Menu', 'brizy-starter' ),
		)
	);

	// Disable Gutenberg editor globally
	add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
	add_filter( 'use_block_editor_for_post', '__return_false', 100 );
}
add_action( 'after_setup_theme', 'reventor_brizy_setup' );

/**
 * Enqueue minimal styles and scripts
 */
function brizy_theme_scripts() {
	wp_enqueue_style( 'brizy-starter-style', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'brizy-starter-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'brizy_theme_scripts' );

/**
 * Brizy Compatibility - Full width support
 */
function reventor_brizy_full_width() {
	add_theme_support( 'align-wide' );

	// Remove content width restrictions for Brizy
	add_filter(
		'content_width',
		function ( $width ) {
			return 1920; // Full width for Brizy compatibility
		}
	);
}
add_action( 'after_setup_theme', 'reventor_brizy_full_width' );

/**
 * Register widget area
 */
function reventor_brizy_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'brizy-starter' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'brizy-starter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'reventor_brizy_widgets_init' );


/**
 * Fallback menu for primary navigation
 */
function brizy_theme_fallback_menu() {
	echo '<ul class="nav-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'brizy-starter' ) . '</a></li>';
	echo '</ul>';
}

/**
 * Display admin notice on theme activation suggesting Brizy plugin installation
 */
function reventor_brizy_activation_notice() {
	// Include the required file for is_plugin_active() function
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	// Check if Brizy is already active
	if ( is_plugin_active( 'brizy-editor/brizy-editor.php' ) ) {
		// Clear the notice flag if Brizy is now active
		delete_option( 'reventor_brizy_show_notice' );
		return;
	}

	// Set flag to show the notice
	update_option( 'reventor_brizy_show_notice', true );
}
add_action( 'after_switch_theme', 'reventor_brizy_activation_notice' );

/**
 * Show admin notice with Brizy installation suggestion
 */
function reventor_brizy_show_activation_notice() {
	// Include the required file for is_plugin_active() function
	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	// Check if Brizy is already active
	if ( is_plugin_active( 'brizy-editor/brizy-editor.php' ) ) {
		delete_option( 'reventor_brizy_show_notice' );
		return;
	}

	// Check if notice should be displayed
	if ( ! get_option( 'reventor_brizy_show_notice' ) ) {
		return;
	}

	// Only show to users who can install plugins
	if ( ! current_user_can( 'install_plugins' ) ) {
		return;
	}

	$install_link = wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'install-plugin',
				'plugin' => 'brizy',
			),
			admin_url( 'update.php' )
		),
		'install-plugin_brizy'
	);

	$activate_link = wp_nonce_url(
		add_query_arg(
			array(
				'action'        => 'activate',
				'plugin'        => 'brizy-editor/brizy-editor.php',
				'plugin_status' => 'all',
				'paged'         => '1',
			),
			admin_url( 'plugins.php' )
		),
		'activate-plugin_brizy-editor/brizy-editor.php'
	);

	?>
	<div class="notice notice-info is-dismissible" data-dismissible="reventor_brizy_dismiss">
		<p>
			<strong><?php _e( 'Welcome to Brizy Starter!', 'brizy-starter' ); ?></strong><br>
			<?php _e( 'This theme is optimized for the Brizy page builder. To get the best experience, we recommend installing and activating the Brizy plugin.', 'brizy-starter' ); ?>
		</p>
		<p>
			<?php
			if ( file_exists( WP_PLUGIN_DIR . '/brizy-editor/brizy-editor.php' ) ) {
				// Brizy is installed but not active
				?>
				<a href="<?php echo esc_url( $activate_link ); ?>" class="button button-primary">
					<?php _e( 'Activate Brizy', 'brizy-starter' ); ?>
				</a>
				<?php
			} else {
				// Brizy is not installed
				?>
				<a href="<?php echo esc_url( $install_link ); ?>" class="button button-primary">
					<?php _e( 'Install Brizy', 'brizy-starter' ); ?>
				</a>
				<?php
			}
			?>
		</p>
	</div>
	<script type="text/javascript">
		(function() {
			document.addEventListener('DOMContentLoaded', function() {
				var dismissibleNotice = document.querySelector('.notice[data-dismissible="reventor_brizy_dismiss"]');
				if (dismissibleNotice) {
					dismissibleNotice.addEventListener('click', function(e) {
						if (e.target.classList.contains('notice-dismiss')) {
							var url = window.location.href;
							if (url.indexOf('?') === -1) {
								url += '?reventor_brizy_dismiss_notice=1&_wpnonce=' + '<?php echo wp_create_nonce( 'reventor_brizy_dismiss' ); ?>';
							} else {
								url += '&reventor_brizy_dismiss_notice=1&_wpnonce=' + '<?php echo wp_create_nonce( 'reventor_brizy_dismiss' ); ?>';
							}
							fetch(url);
						}
					});
				}
			});
		})();
	</script>
	<?php
}
add_action( 'admin_notices', 'reventor_brizy_show_activation_notice' );

/**
 * Handle dismissal of Brizy activation notice
 */
function reventor_brizy_dismiss_notice() {
	// Check if this is the dismiss action
	if ( isset( $_GET['reventor_brizy_dismiss_notice'] ) && $_GET['reventor_brizy_dismiss_notice'] === '1' ) {
		// Verify nonce
		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'reventor_brizy_dismiss' ) ) {
			return;
		}

		// Dismiss the notice
		delete_option( 'reventor_brizy_show_notice' );

		// Redirect back to the same page
		wp_safe_remote_post( admin_url( 'admin.php' ), array(
			'blocking' => false,
		) );
	}
}
add_action( 'admin_init', 'reventor_brizy_dismiss_notice' );

/**
 * Note: Automatic plugin installation removed to comply with WordPress.org guidelines.
 * Users should manually install and activate the Brizy page builder plugin.
 * See the README.md for installation instructions.
 */

/**
 * Note: Automatic home page creation removed to comply with WordPress.org guidelines.
 * Users have full control over their homepage setup and can create a custom home page
 * by creating a new page and selecting the "Brizy Template" from the page template dropdown.
 */

/**
 * Fallback menu for footer navigation
 */
function brizy_theme_fallback_footer_menu() {
	echo '<ul class="footer-nav-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . __( 'Home', 'brizy-starter' ) . '</a></li>';
	echo '</ul>';
}
