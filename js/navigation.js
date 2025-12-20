/**
 * Navigation JavaScript for REVENTOR Brizy Theme
 * Minimal navigation script for basic functionality
 */

(function($) {
    'use strict';

    // Mobile menu toggle
    $('.main-navigation .menu-toggle').click(function() {
        $(this).toggleClass('active');
        $('.main-navigation .nav-menu').toggleClass('toggled');
    });

    // Add mobile menu button if not present
    if ($('.main-navigation .menu-toggle').length === 0) {
        $('.main-navigation').prepend('<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">' + 
            'Menu</button>');
    }

    // Skip to content link
    $('.skip-link').click(function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            target.attr('tabindex', '-1').focus();
        }
    });

})(jQuery);