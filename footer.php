<?php
/**
 * Footer template for Brizy Theme
 * Clean, minimal footer designed for Brizy page builder compatibility
 */
?>

        </main>
    </div>

    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <nav id="footer-navigation" class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'menu_class'     => 'footer-nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'brizy_theme_fallback_footer_menu',
                    'depth'          => 1,
                ));
                ?>
            </nav>
            
            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                   <?php _e('All rights reserved.', 'brizy-theme'); ?>
                </p>
            </div>
        </div>
    </footer>

</div>

<?php wp_footer(); ?>

</body>
</html>