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
 * Fallback menu for footer navigation
 */
function brizy_theme_fallback_footer_menu() {
    echo '<ul class="footer-nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'brizy-theme') . '</a></li>';
    echo '</ul>';
}