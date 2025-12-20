<?php
/**
 * Template for displaying 404 errors (Not Found)
 * Designed for maximum Brizy compatibility
 */

get_header();
?>

<div class="error-404 not-found">
    
    <header class="page-header">
        <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'reventor-brizy'); ?></h1>
    </header>

    <div class="page-content">
        <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'reventor-brizy'); ?></p>

        <?php get_search_form(); ?>

        <div class="widget-area">
            <h2><?php _e('Most Used Categories', 'reventor-brizy'); ?></h2>
            <ul>
                <?php
                wp_list_categories(array(
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'show_count' => 1,
                    'title_li'   => '',
                    'number'     => 10,
                ));
                ?>
            </ul>
        </div>

        <?php
        // Get recent posts
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 5,
            'post_status' => 'publish'
        ));
        
        if (!empty($recent_posts)) :
            ?>
            <div class="widget-area">
                <h2><?php _e('Try looking in the monthly archives.', 'reventor-brizy'); ?></h2>
                <ul>
                    <?php foreach ($recent_posts as $recent) : ?>
                        <li>
                            <a href="<?php echo get_permalink($recent['ID']); ?>">
                                <?php echo $recent['post_title']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
            wp_reset_query();
        endif;
        ?>

        <div class="home-link">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
                <?php _e('← Back to Homepage', 'reventor-brizy'); ?>
            </a>
        </div>
    </div>

</div>

<?php
get_footer();