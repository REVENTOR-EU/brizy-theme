<?php
/**
 * REVENTOR - Basic Theme for Brizy Builder
 * 
 * This theme is designed for maximum compatibility with Brizy page builder.
 * All styling and layout is handled by Brizy, while this theme provides
 * only essential WordPress functionality.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function reventor_brizy_setup() {
    // Add theme support for various WordPress features
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('title-tag');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'reventor-brizy'),
        'footer'  => __('Footer Menu', 'reventor-brizy'),
    ));
}
add_action('after_setup_theme', 'reventor_brizy_setup');

/**
 * Enqueue styles and scripts
 */
function reventor_brizy_scripts() {
    wp_enqueue_style('reventor-brizy-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('reventor-brizy-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    
    // Localize script for menu text
    wp_localize_script('reventor-brizy-navigation', 'reventorBrizyMenu', array(
        'menuText' => __('Menu', 'reventor-brizy'),
        'closeMenuText' => __('Close Menu', 'reventor-brizy')
    ));
}
add_action('wp_enqueue_scripts', 'reventor_brizy_scripts');

/**
 * Brizy Compatibility Features
 * 
 * Feature 1: Brizy Global Colors Support
 * Ensure theme CSS doesn't interfere with Brizy's color system
 */
function reventor_brizy_global_colors_support() {
    // Remove theme color filters that might interfere with Brizy
    remove_filter('body_class', 'twentytwenty_body_classes');
    add_filter('body_class', function($classes) {
        $classes[] = 'reventor-brizy-theme';
        return $classes;
    });
}
add_action('init', 'reventor_brizy_global_colors_support');

/**
 * Feature 2: Full Width Container Support
 * Remove theme constraints so Brizy pages can span full width
 */
function reventor_brizy_full_width_support() {
    add_theme_support('align-wide');
    add_theme_support('align-full');
    
    // Remove theme container width restrictions
    add_filter('content_width', function($width) {
        if (is_page_template('page-brizy.php') || has_block('brizy/template')) {
            return 1920; // Allow full width for Brizy pages
        }
        return 1200; // Default content width
    });
}
add_action('after_setup_theme', 'reventor_brizy_full_width_support');

/**
 * Feature 3: No Theme Margin/Padding Conflicts
 * Ensure Brizy elements display without theme-imposed spacing
 */
function reventor_brizy_clear_spacing_conflicts() {
    // Remove default margins and padding from theme
    add_action('wp_head', function() {
        echo '<style type="text/css">
            .reventor-brizy-theme .entry-content,
            .reventor-brizy-theme .post,
            .reventor-brizy-theme .page {
                margin: 0 !important;
                padding: 0 !important;
            }
            .reventor-brizy-theme .site-content {
                margin: 0 !important;
                padding: 0 !important;
            }
        </style>';
    });
}
add_action('init', 'reventor_brizy_clear_spacing_conflicts');

/**
 * Feature 4: Brizy Header/Footer Compatibility
 * Support for Brizy's header/footer builder
 */
function reventor_brizy_header_footer_support() {
    // Remove default header/footer actions that Brizy manages
    remove_action('wp_head', 'twentytwenty_add_emoji_script');
    remove_action('wp_head', 'wp_generator');
    
    // Support Brizy header/footer templates
    add_filter('template_include', function($template) {
        if (function_exists('brizy_is_current_page_built') && brizy_is_current_page_built()) {
            if (is_front_page()) {
                $brizy_template = locate_template('front-page.php');
                if ($brizy_template) {
                    return $brizy_template;
                }
            }
        }
        return $template;
    });
}
add_action('init', 'reventor_brizy_header_footer_support');

/**
 * Feature 5: Theme CSS Reset for Brizy
 * Clear default theme styles that might interfere with Brizy elements
 */
function reventor_brizy_css_reset() {
    add_action('wp_head', function() {
        echo '<style type="text/css">
            /* Brizy CSS Reset */
            .reventor-brizy-theme .brizy-content,
            .reventor-brizy-theme .brizy-content *,
            .reventor-brizy-theme .brizy-content *::before,
            .reventor-brizy-theme .brizy-content *::after {
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                outline: none !important;
                box-shadow: none !important;
                text-shadow: none !important;
                background: transparent !important;
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }
            .reventor-brizy-theme .brizy-content {
                width: 100% !important;
                max-width: none !important;
            }
        </style>';
    });
}
add_action('init', 'reventor_brizy_css_reset');

/**
 * Feature 6: Brizy Global Fonts Integration
 * Allow Brizy to manage typography without theme interference
 */
function reventor_brizy_fonts_support() {
    // Remove theme font filters
    remove_filter('the_content', 'twentytwenty_add_drop_cap');
    
    // Allow Brizy to manage fonts
    add_filter('body_class', function($classes) {
        if (function_exists('brizy_is_current_page_built') && brizy_is_current_page_built()) {
            $classes[] = 'brizy-page';
        }
        return $classes;
    });
}
add_action('init', 'reventor_brizy_fonts_support');

/**
 * Feature 7: Responsive Design Foundation
 * Basic responsive framework that Brizy can build upon
 */
function reventor_brizy_responsive_support() {
    add_theme_support('responsive-embeds');
    
    // Add viewport meta tag if not added by Brizy
    add_action('wp_head', function() {
        if (!has_action('wp_head', 'wp_resource_hints') && !function_exists('wp_resource_hints')) {
            echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
        }
    });
}
add_action('after_setup_theme', 'reventor_brizy_responsive_support');

/**
 * Feature 8: Clean HTML Structure
 * Minimal, semantic HTML that Brizy can easily manipulate
 */
function reventor_brizy_clean_html() {
    // Clean up WordPress head
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
    
    // Ensure clean document structure
    add_theme_support('html5', array('script', 'style'));
}
add_action('init', 'reventor_brizy_clean_html');

/**
 * Custom excerpt length
 */
function reventor_brizy_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'reventor_brizy_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function reventor_brizy_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'reventor_brizy_excerpt_more');

/**
 * Theme text domain
 */
function reventor_brizy_textdomain() {
    load_theme_textdomain('reventor-brizy', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'reventor_brizy_textdomain');
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