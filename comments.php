<?php
// Check if the current post is password protected
if (post_password_required()) {
    return;
}
?>

<!-- Comments Section -->
<div id="comments" class="comments-area mt-4">

    <?php if (have_comments()) : // Check if there are comments ?>
        <h2 class="comments-title">
            <?php
            // Get the number of comments
            $comments_number = get_comments_number();
            // Display the title based on the number of comments
            if ($comments_number === 1) {
                printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'ajaxinwp'), get_the_title());
            } else {
                printf(
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'ajaxinwp'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h2>

        <!-- Comments List -->
        <ul class="comment-list list-unstyled">
            <?php
            // Display the list of comments with custom walker for Bootstrap styling
            wp_list_comments(array(
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size' => 50,
                'walker'     => new Bootstrap_Comment_Walker(),
            ));
            ?>
        </ul>

        <!-- Comments Navigation -->
        <?php the_comments_navigation(); ?>

    <?php endif; // End if have_comments() ?>

    <?php if (!comments_open() && get_comments_number()) : // Check if comments are closed and there are comments ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'ajaxinwp'); ?></p>
    <?php endif; ?>

    <?php
    // Comment Form with custom styling and fields
    comment_form(array(
        'class_form'           => 'comment-form', // Class for the form
        'class_submit'         => 'btn btn-primary mt-3', // Class for the submit button
        'title_reply'          => '<h3 class="comment-reply-title mt-4">' . __('Leave a Reply', 'ajaxinwp') . '</h3>', // Title for the reply section
        'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.', 'ajaxinwp') . '</p>', // Notes before the comment field
        'comment_field'        => '<div class="form-group"><label for="comment" class="form-label">' . _x('Comment', 'noun') . '</label><textarea id="comment" class="form-control" name="comment" rows="4" aria-required="true"></textarea></div>', // Comment field
        'fields'               => array(
            // Author field
            'author' => '<div class="form-group"><label for="author" class="form-label">' . __('Name', 'ajaxinwp') . '</label> ' .
                '<input id="author" name="author" type="text" class="form-control" value="" size="30" aria-required="true" /></div>',
            // Email field
            'email'  => '<div class="form-group"><label for="email" class="form-label">' . __('Email', 'ajaxinwp') . '</label> ' .
                '<input id="email" name="email" type="email" class="form-control" value="" size="30" aria-required="true" /></div>',
            // URL field
            'url'    => '<div class="form-group"><label for="url" class="form-label">' . __('Website', 'ajaxinwp') . '</label>' .
                '<input id="url" name="url" type="url" class="form-control" value="" size="30" /></div>',
        ),
    ));
    ?>
</div><!-- .comments-area -->
