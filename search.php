<?php
/**
 * The template for displaying search results pages
 */

get_header();
?>

<?php if (have_posts()) : ?>
    
    <header class="page-header">
        <h1 class="page-title">
            <?php
            printf(
                esc_html__('Search Results for: %s', 'brizy-theme'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
    </header>
    
    <div class="posts-container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="entry-header">
                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                </header>
                
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
            </article>
        <?php endwhile; ?>
    </div>
    
    <?php
    the_posts_pagination(array(
        'prev_text' => __('Previous', 'brizy-theme'),
        'next_text' => __('Next', 'brizy-theme'),
    ));
    ?>
    
<?php else : ?>
    
    <section class="no-results not-found">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__('Search Results for: %s', 'brizy-theme'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
        </header>
        
        <div class="page-content">
            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'brizy-theme'); ?></p>
            <?php get_search_form(); ?>
        </div>
    </section>
    
<?php endif; ?>

<?php
get_footer();