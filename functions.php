<?php
/**
 * Brizy Starter Theme functions and definitions
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! isset( $content_width ) ) {
	$content_width = 1920; // pixels
}

define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

/**
 * Set up theme support
 */
if ( ! function_exists( 'brizy_starter_theme_setup' ) ) {
	function brizy_starter_theme_setup() {
	       /**
	        * Make theme available for translation.
	        * Translations can be filed in the /languages/ directory.
	        * If you're building a theme based on Brizy Starter Theme, use a find and replace
	        * to change 'brizy-starter' to the name of your theme in all the template files.
	        */
	       load_theme_textdomain( 'brizy-starter', get_template_directory() . '/languages' );

	       /**
	        * Let WordPress manage the document title.
	        * By adding theme support, we declare that this theme does not use a
	        * hard-coded <title> tag in the document head, and expect WordPress to
	        * provide it for us.
	        */
	       add_theme_support( 'title-tag' );

	       /**
	        * Enable support for Post Thumbnails on posts and pages.
	        */
	       add_theme_support( 'post-thumbnails' );

	       /**
	        * Add default posts and comments RSS feed links to head.
	        */
	       add_theme_support( 'automatic-feed-links' );

	       /**
	        * Add support for block styles.
	        */
	       add_theme_support( 'wp-block-styles' );

	       /**
	        * Add support for responsive embedded content.
	        */
	       add_theme_support( 'responsive-embeds' );

	       /**
	        * Add support for wide alignment for blocks.
	        */
	       add_theme_support( 'align-wide' );

        /**
         * No need for default images as Brizy generates its own.
         */
        remove_image_size('medium_large');
        add_image_size('medium_large', 150, 150, true);
        remove_image_size('medium');
        add_image_size('medium', 150, 150, true);
        remove_image_size('large');
        add_image_size('large', 150, 150, true);

        register_nav_menus(
            array(
                'primary'   => __( 'Primary Menu', 'brizy-starter' ),
                'secondary' => __( 'Secondary Menu', 'brizy-starter' ),
                'footer'    => __( 'Footer Menu', 'brizy-starter' )
            )
        );

        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
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

        /**
         * Add support for core custom logo.
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 150,
                'width'       => 150,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        /**
         * Add support for custom background.
         */
        add_theme_support(
            'custom-background',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        );

        /**
         * Add support for custom header.
         */
        add_theme_support(
            'custom-header',
            array(
                'default-image'          => '',
                'default-text-color'     => '000000',
                'width'                  => 2000,
                'height'                 => 250,
                'flex-height'            => true,
                'wp-head-callback'       => '',
                'admin-head-callback'    => '',
                'admin-preview-callback' => '',
            )
        );

	}
}
add_action( 'after_setup_theme', 'brizy_starter_theme_setup' );

/**
 * Theme Scripts & Styles
 */
if ( ! function_exists( 'brizy_starter_theme_scripts_styles' ) ) {
	function brizy_starter_theme_scripts_styles() {
        wp_enqueue_style( 'brizy-starter-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
	}
}
add_action( 'wp_enqueue_scripts', 'brizy_starter_theme_scripts_styles' );

if ( ! function_exists( 'brizy_starter_theme_post_thumbnail' ) ) :
    /**
     * Displays post thumbnail.
     */
    function brizy_starter_theme_post_thumbnail() {

        if ( is_singular() ) :
            ?>

            <figure class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </figure><!-- .post-thumbnail -->

        <?php
        else :
            ?>

            <figure class="post-thumbnail">
                <a class="post-thumbnail-inner" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                    <?php the_post_thumbnail( 'post-thumbnail' ); ?>
                </a>
            </figure>

        <?php
        endif; // End is_singular().
    }
endif;

if ( ! function_exists( 'brizy_starter_theme_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function brizy_starter_theme_entry_footer() {

        // Hide author, post date, category and tag text for pages.
        if ( 'post' === get_post_type() ) {

            // Posted by
            brizy_starter_theme_posted_by();

            // Posted on
            brizy_starter_theme_posted_on();

            $categories_list = get_the_category_list( __( ', ', 'brizy-starter' ) );
            if ( $categories_list ) {
                printf(
                    '<span class="cat-links"><span class="screen-reader-text">%1$s</span>%2$s</span>',
                    __( 'Posted in', 'brizy-starter' ),
                    $categories_list
                );
            }

            $tags_list = get_the_tag_list( '', __( ', ', 'brizy-starter' ) );
            if ( $tags_list ) {
                printf(
                    '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                    __( 'Tags:', 'brizy-starter' ),
                    $tags_list
                );
            }
        }

        // Comment count.
        if ( ! is_singular() ) {
            brizy_starter_theme_comment_count();
        }
    }
endif;

if ( ! function_exists( 'brizy_starter_theme_posted_by' ) ) :
    /**
     * Prints HTML with meta information about theme author.
     */
    function brizy_starter_theme_posted_by() {
        printf(
            '<span class="byline"><span class="screen-reader-text">%1$s</span><span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>',
            __( 'Posted by', 'brizy-starter' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author() )
        );
    }
endif;

if ( ! function_exists( 'brizy_starter_theme_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function brizy_starter_theme_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        printf(
            '<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>',
            esc_url( get_permalink() ),
            $time_string
        );
    }
endif;


if ( ! function_exists( 'brizy_starter_theme_comment_count' ) ) :
    /**
     * Prints HTML with the comment count for the current post.
     */
    function brizy_starter_theme_comment_count() {
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';

            comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'brizy-starter' ), get_the_title() ) );

            echo '</span>';
        }
    }
endif;

/**
 * After Import Setup
 *
 * Set the Classic Home Page as front
 * page and assign the menu to
 * the main menu location.
 */
add_action('pt-ocdi/after_import', 'brizy_ocdi_after_import_setup');
function brizy_ocdi_after_import_setup() {
    $primary_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
    if (!$primary_menu) {
        $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu');
    }
    if ($primary_menu) {
        set_theme_mod('nav_menu_locations', array('primary' => $primary_menu->term_id));
    }

    $secondary_menu = get_term_by('name', 'Secondary Menu', 'nav_menu');
    if ($secondary_menu) {
        set_theme_mod('nav_menu_locations', array('secondary' => $secondary_menu->term_id));
    }

    $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
    if ($footer_menu) {
        set_theme_mod('nav_menu_locations', array('footer' => $footer_menu->term_id));
    }

    $front_page_id = get_page_by_title('Home') ?  : get_page_by_title('Homepage');
    if ($front_page_id) {
        update_option('page_on_front', $front_page_id->ID);
        update_option('show_on_front', 'page');
    }
    $blog_page_id = get_page_by_title('Blog');
    if ($blog_page_id) {
        update_option('page_for_posts', $blog_page_id->ID);
    }
}

if ( ! function_exists( 'brizy_starter_theme_register_sidebar' ) ) :
    function brizy_starter_theme_register_sidebar() {
        register_sidebars( 2, array( 'name' => 'Sidebar %d', 'id' => 'sidebar-%d', 'description' => 'Sidebar %d', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
        register_sidebars( 4, array( 'name' => 'Footer %d', 'id' => 'footer-%d', 'description' => 'Footer %d', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>' ) );
    }
    add_action( 'widgets_init', 'brizy_starter_theme_register_sidebar' );
endif;


/** * * * * * * * * * * * * * * * * * * * Change this with your info * * * * * * * * * * * * * * * * * * * * * * * * * * */

 /**
 * Register block styles.
 */
function brizy_starter_register_block_styles() {
     register_block_style(
         'core/button',
         array(
             'name'         => 'fill-outline',
             'label'        => __( 'Fill Outline', 'brizy-starter' ),
             'inline_style' => '.is-style-fill-outline .wp-block-button__link { border: 2px solid currentColor; padding: 0.5em 1.5em; }',
         )
     );
}
add_action( 'init', 'brizy_starter_register_block_styles' );
 
/**
 * Register block patterns.
 */
function brizy_starter_register_block_patterns() {
     register_block_pattern(
         'brizy-starter/heading-with-paragraph',
         array(
             'title'       => __( 'Heading with paragraph', 'brizy-starter' ),
             'description' => _x( 'A heading followed by a paragraph of text.', 'Block pattern description', 'brizy-starter' ),
             'categories'  => array( 'text' ),
             'content'     => '<!-- wp:heading {"level":2} --><h2>' . esc_html__( 'Welcome to our site', 'brizy-starter' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'This is a sample paragraph that you can customize to fit your needs.', 'brizy-starter' ) . '</p><!-- /wp:paragraph -->',
         )
     );
}
add_action( 'init', 'brizy_starter_register_block_patterns' );
 
/**
 * Add editor style.
 */
function brizy_starter_add_editor_style() {
     add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'brizy_starter_add_editor_style' );

/**
 * Set transient on theme activation to show plugin install notice
 */
function brizy_starter_theme_activation() {
    set_transient( 'brizy_starter_activation_notice', true, 5 * DAY_IN_SECONDS );
}
add_action( 'after_switch_theme', 'brizy_starter_theme_activation' );

/**
 * Display admin notice to install Brizy plugin
 */
function brizy_starter_plugin_install_notice() {
    // Check if transient is set and user has permission
    if ( ! get_transient( 'brizy_starter_activation_notice' ) ) {
        return;
    }

    // Check if Brizy plugin is already installed or activated
    $plugin_path = 'brizy/brizy.php';
    if ( is_plugin_active( $plugin_path ) ) {
        delete_transient( 'brizy_starter_activation_notice' );
        return;
    }

    // Check if plugin is installed but not activated
    $installed_plugins = get_plugins();
    $is_installed = isset( $installed_plugins[ $plugin_path ] );

    // Build the plugin install/activate URL
    if ( $is_installed ) {
        $action_url = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=' . $plugin_path ), 'activate-plugin_' . $plugin_path );
        $button_text = __( 'Activate Brizy Plugin', 'brizy-starter' );
    } else {
        $action_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=brizy' ), 'install-plugin_brizy' );
        $button_text = __( 'Install Brizy Plugin', 'brizy-starter' );
    }

    // Display the notice
    ?>
    <div class="notice notice-info is-dismissible" id="brizy-starter-activation-notice">
        <h2><?php esc_html_e( 'Welcome to Brizy Starter Theme!', 'brizy-starter' ); ?></h2>
        <p>
            <?php
            if ( $is_installed ) {
                esc_html_e( 'This theme is built to be used in conjunction with the Brizy plugin. Please activate Brizy now to start building.', 'brizy-starter' );
            } else {
                esc_html_e( 'This theme is built to be used in conjunction with the Brizy plugin. Please install Brizy now to start building.', 'brizy-starter' );
            }
            ?>
        </p>
        <p>
            <a href="<?php echo esc_url( $action_url ); ?>" class="button button-primary">
                <?php echo esc_html( $button_text ); ?>
            </a>
            <a href="<?php echo esc_url( 'https://wordpress.org/plugins/brizy/' ); ?>" target="_blank" class="button">
                <?php esc_html_e( 'Learn More', 'brizy-starter' ); ?>
            </a>
            <button type="button" class="button button-secondary brizy-starter-dismiss-notice">
                <?php esc_html_e( 'Dismiss', 'brizy-starter' ); ?>
            </button>
        </p>
    </div>
    <script>
    jQuery(document).ready(function($) {
        // Handle dismiss button click
        $('.brizy-starter-dismiss-notice').on('click', function() {
            $('#brizy-starter-activation-notice').fadeOut('fast', function() {
                $(this).remove();
            });
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'brizy_starter_dismiss_notice',
                    nonce: '<?php echo wp_create_nonce( 'brizy_starter_dismiss_notice' ); ?>'
                }
            });
        });

        // Handle WordPress built-in dismiss button
        $('#brizy-starter-activation-notice .notice-dismiss').on('click', function() {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'brizy_starter_dismiss_notice',
                    nonce: '<?php echo wp_create_nonce( 'brizy_starter_dismiss_notice' ); ?>'
                }
            });
        });
    });
    </script>
    <?php
}
add_action( 'admin_notices', 'brizy_starter_plugin_install_notice' );

/**
 * Handle AJAX request to dismiss the notice
 */
function brizy_starter_dismiss_notice_ajax() {
    check_ajax_referer( 'brizy_starter_dismiss_notice', 'nonce' );
    delete_transient( 'brizy_starter_activation_notice' );
    wp_send_json_success();
}
add_action( 'wp_ajax_brizy_starter_dismiss_notice', 'brizy_starter_dismiss_notice_ajax' );
