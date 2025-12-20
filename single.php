<?php
/**
 * Template for displaying single posts
 * Designed for maximum Brizy compatibility
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            
            <div class="entry-meta">
                <span class="posted-on">
                    <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </span>
                
                <span class="byline">
                    <?php _e('by', 'reventor-brizy'); ?> 
                    <span class="author vcard">
                        <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                            <?php echo get_the_author(); ?>
                        </a>
                    </span>
                </span>
                
                <?php if (has_category()) : ?>
                    <span class="cat-links">
                        <?php _e('in', 'reventor-brizy'); ?> <?php the_category(', '); ?>
                    </span>
                <?php endif; ?>
                
                <?php if (has_tag()) : ?>
                    <span class="tags-links">
                        <?php the_tags('', ', ', ''); ?>
                    </span>
                <?php endif; ?>
            </div>
        </header>

        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content">
            <?php
            the_content();
            
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'reventor-brizy'),
                'after'  => '</div>',
            ));
            ?>
        </div>

        <footer class="entry-footer">
            <?php
            // Post navigation
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . __('Previous:', 'reventor-brizy') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . __('Next:', 'reventor-brizy') . '</span> <span class="nav-title">%title</span>',
            ));
            ?>
        </footer>

        <?php if (comments_open() || get_comments_number()) : ?>
            <div class="comments-section">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    </article>

<?php endwhile; ?>

<?php
get_footer();