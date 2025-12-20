<?php
/**
 * REVENTOR - Brizy Theme
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
    
    // Navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'reventor-brizy'),
        'footer'  => __('Footer Menu', 'reventor-brizy'),
    ));
}
add_action('after_setup_theme', 'reventor_brizy_setup');

/**
 * Enqueue minimal styles and scripts
 */
function reventor_brizy_scripts() {
    wp_enqueue_style('reventor-brizy-style', get_stylesheet_uri());
    wp_enqueue_script('reventor-brizy-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'reventor_brizy_scripts');

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
 * Clean WordPress head for Brizy compatibility
 */
function reventor_brizy_clean_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'reventor_brizy_clean_head');

/**
 * Fallback menu for primary navigation
 */
function reventor_brizy_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'reventor-brizy') . '</a></li>';
    echo '</ul>';
}

/**
 * Fallback menu for footer navigation
 */
function reventor_brizy_fallback_footer_menu() {
    echo '<ul class="footer-nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . __('Home', 'reventor-brizy') . '</a></li>';
    echo '</ul>';
}