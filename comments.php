<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(_x('One comment', 'comments title', 'brizy-theme'));
            } else {
                printf(
                    _nx(
                        '%1$s comment',
                        '%1$s comments',
                        $comments_number,
                        'comments title',
                        'brizy-theme'
                    ),
                    number_format_i18n($comments_number)
                );
            }
            ?>
        </h2>
        
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>
        
        <?php
        the_comments_pagination(array(
            'prev_text' => __('Previous', 'brizy-theme'),
            'next_text' => __('Next', 'brizy-theme'),
        ));
        ?>
        
    <?php endif; ?>
    
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments">
            <?php _e('Comments are closed.', 'brizy-theme'); ?>
        </p>
    <?php endif; ?>
    
    <?php
    comment_form(array(
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h2>',
    ));
    ?>
    
</div>