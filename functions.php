<?php
/**
 * Brizy Theme
 * 
 * A minimal WordPress theme designed specifically for maximum compatibility 
 * with Brizy page builder. This theme is NOT built by the official Brizy team.
 * 
 * This theme provides only essential WordPress functionality while letting 
 * Brizy handle all design and layout decisions.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup - Only essential WordPress features
 */
function reventor_brizy_setup() {
    // Core WordPress features
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('automatic-feed-links');
    
    // Navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'brizy-theme'),
        'footer'  => __('Footer Menu', 'brizy-theme'),
    ));
    
    // Disable Gutenberg editor globally
    add_filter('use_block_editor_for_post_type', '__return_false', 100);
    add_filter('use_block_editor_for_post', '__return_false', 100);
}
add_action('after_setup_theme', 'reventor_brizy_setup');

/**
 * Enqueue minimal styles and scripts
 */
function brizy_theme_scripts() {
    wp_enqueue_style('brizy-theme-style', get_stylesheet_uri());
    wp_enqueue_script('brizy-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'brizy_theme_scripts');

/**
 * Brizy Compatibility - Full width support
 */
function reventor_brizy_full_width() {
    add_theme_support('align-wide');
    
    // Remove content width restrictions for Brizy
    add_filter('content_width', function($width) {
        return 1920; // Full width for Brizy compatibility
    });
}
add_action('after_setup_theme', 'reventor_brizy_full_width');

/**
 * Register widget area
 */
function reventor_brizy_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'brizy-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'brizy-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'reventor_brizy_widgets_init');


/**
 * Fallback menu for primary navigation
 */
function brizy_theme_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'brizy-theme') . '</a></li>';
    echo '</ul>';
}

/**
 * Automatically install and activate Brizy plugin on theme activation
 */
function reventor_brizy_install_plugin() {
    if (!current_user_can('install_plugins')) {
        return;
    }
    
    // Check if Brizy is already active
    if (is_plugin_active('brizy-editor/brizy-editor.php')) {
        return;
    }
    
    // Include necessary WordPress files for plugin installation
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    include_once ABSPATH . 'wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/misc.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    
    // Check if Brizy is already installed
    if (file_exists(WP_PLUGIN_DIR . '/brizy-editor/brizy-editor.php')) {
        // Activate the plugin
        activate_plugin('brizy-editor/brizy-editor.php');
    } else {
        // Install the plugin from WordPress.org
        $api = plugins_api('plugin_information', array(
            'slug' => 'brizy',
            'fields' => array('sections' => false)
        ));
        
        if (is_wp_error($api)) {
            return;
        }
        
        // Silent installer to avoid output
        $upgrader = new Plugin_Upgrader(new WP_Automatic_Upgrader_Skin());
        $upgrader->install($api->download_link);
        
        // Activate the plugin after installation
        activate_plugin('brizy-editor/brizy-editor.php');
    }
}
add_action('after_switch_theme', 'reventor_brizy_install_plugin');

/**
 * Automatically create Home page and set as static homepage on theme activation
 */
function reventor_brizy_create_home_page() {
    // Check if Home page already exists
    $home_page = get_page_by_title('Home');
    
    // Create Home page if it doesn't exist
    if (!$home_page) {
        $home_page_id = wp_insert_post(array(
            'post_title'    => 'Home',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
            'page_template' => 'brizy-blank-template.php',
        ));
    } else {
        $home_page_id = $home_page->ID;
        // Update existing Home page to use Brizy template
        update_post_meta($home_page_id, '_wp_page_template', 'brizy-blank-template.php');
    }
    
    // Enable Brizy editor on the Home page if Brizy plugin is active
    if (class_exists('Brizy_Editor_Post')) {
        try {
            $brizy_post = Brizy_Editor_Post::get($home_page_id);
            $brizy_post->enable_editor();
            $brizy_post->set_template('brizy-blank-template.php');
            $brizy_post->save();
        } catch (Exception $e) {
            // Silently fail if Brizy is not fully loaded
        }
    }
    
    // Set the Home page as static front page
    update_option('page_on_front', $home_page_id);
    update_option('show_on_front', 'page');
}
add_action('after_switch_theme', 'reventor_brizy_create_home_page');

/**
 * Fallback menu for footer navigation
 */
function brizy_theme_fallback_footer_menu() {
    echo '<ul class="footer-nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'brizy-theme') . '</a></li>';
    echo '</ul>';
}