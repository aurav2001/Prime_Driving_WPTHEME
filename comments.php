<?php
/**
 * The template for displaying comments and comment form in Driveria Theme
 *
 * @package Driveria
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area driveria-comments-container">

    <?php if (have_comments()) : ?>
        <div class="comments-header">
            <h3 class="comments-title">
                <i class="fa-solid fa-comments"></i>
                <?php
                $comment_count = get_comments_number();
                if ('1' === $comment_count) {
                    printf(
                        /* translators: 1: title. */
                        esc_html__('1 Comment on "%1$s"', 'driveria'),
                        '<span>' . get_the_title() . '</span>'
                    );
                } else {
                    printf(
                        /* translators: 1: comment count, 2: title. */
                        esc_html(_nx('%1$s Comment on "%2$s"', '%1$s Comments on "%2$s"', $comment_count, 'comments title', 'driveria')),
                        number_format_i18n($comment_count),
                        '<span>' . get_the_title() . '</span>'
                    );
                }
                ?>
            </h3>
        </div>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 52,
                'reply_text'  => '<i class="fa-solid fa-reply"></i> ' . esc_html__('Reply', 'driveria'),
            ));
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'driveria'); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req       = get_option('require_name_email');
    $html_req  = ($req ? ' required="required"' : '');

    $fields = array(
        'author' => sprintf(
            '<div class="comment-form-group comment-form-author">
                <label for="author" class="form-label">%s %s</label>
                <div class="input-icon-wrapper">
                    <i class="fa-regular fa-user field-icon"></i>
                    <input id="author" name="author" type="text" class="form-control" value="%s" size="30" placeholder="%s"%s />
                </div>
            </div>',
            esc_html__('Name', 'driveria'),
            ($req ? '<span class="required">*</span>' : ''),
            esc_attr($commenter['comment_author']),
            esc_attr__('Your full name', 'driveria'),
            $html_req
        ),
        'email' => sprintf(
            '<div class="comment-form-group comment-form-email">
                <label for="email" class="form-label">%s %s</label>
                <div class="input-icon-wrapper">
                    <i class="fa-regular fa-envelope field-icon"></i>
                    <input id="email" name="email" type="email" class="form-control" value="%s" size="30" placeholder="%s"%s />
                </div>
            </div>',
            esc_html__('Email', 'driveria'),
            ($req ? '<span class="required">*</span>' : ''),
            esc_attr($commenter['comment_author_email']),
            esc_attr__('name@example.com', 'driveria'),
            $html_req
        ),
        'url' => sprintf(
            '<div class="comment-form-group comment-form-url">
                <label for="url" class="form-label">%s</label>
                <div class="input-icon-wrapper">
                    <i class="fa-solid fa-globe field-icon"></i>
                    <input id="url" name="url" type="url" class="form-control" value="%s" size="30" placeholder="%s" />
                </div>
            </div>',
            esc_html__('Website', 'driveria'),
            esc_attr($commenter['comment_author_url']),
            esc_attr__('https://yourwebsite.com', 'driveria')
        ),
        'cookies' => sprintf(
            '<div class="comment-form-group-checkbox comment-form-cookies-consent">
                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />
                <label for="wp-comment-cookies-consent">%s</label>
            </div>',
            (empty($commenter['comment_author_email']) ? '' : ' checked="checked"'),
            esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'driveria')
        ),
    );

    $comment_field = sprintf(
        '<div class="comment-form-group comment-form-comment">
            <label for="comment" class="form-label">%s <span class="required">*</span></label>
            <textarea id="comment" name="comment" class="form-control" cols="45" rows="5" placeholder="%s" required="required"></textarea>
        </div>',
        esc_html__('Comment', 'driveria'),
        esc_attr__('Write your comment or question here...', 'driveria')
    );

    comment_form(array(
        'title_reply'          => esc_html__('Leave a Reply', 'driveria'),
        'title_reply_to'       => esc_html__('Leave a Reply to %s', 'driveria'),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title"><i class="fa-solid fa-pen-to-square"></i> ',
        'title_reply_after'    => '</h3>',
        'cancel_reply_before'  => ' <small>',
        'cancel_reply_after'   => '</small>',
        'comment_notes_before' => '<p class="comment-notes">' . esc_html__('Your email address will not be published. Required fields are marked *', 'driveria') . '</p>',
        'comment_field'        => $comment_field,
        'fields'               => $fields,
        'class_form'           => 'comment-form driveria-comment-form',
        'class_submit'         => 'submit driveria-btn-primary-submit',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s"><i class="fa-solid fa-paper-plane"></i> ' . esc_html__('Post Comment', 'driveria') . '</button>',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
    ));
    ?>

</div>
