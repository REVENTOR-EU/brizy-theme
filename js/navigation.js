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
            reventorBrizyMenu.menuText + '</button>');
    }

    // Handle window resize
    $(window).resize(function() {
        if ($(window).width() > 768) {
            $('.main-navigation .nav-menu').removeClass('toggled');
            $('.main-navigation .menu-toggle').removeClass('active');
        }
    });

    // Skip to content link
    $('.skip-link').click(function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            target.attr('tabindex', '-1').focus();
        }
    });

    // Smooth scroll for anchor links
    $('a[href^="#"]').click(function(e) {
        var target = $($(this.getAttribute('href')));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 600);
        }
    });

})(jQuery);