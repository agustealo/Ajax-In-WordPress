<?php
class Bootstrap_Comment_Walker extends Walker_Comment {
    protected function comment($comment, $depth, $args) {
        ?>
        <li <?php comment_class('media mb-4'); ?> id="comment-<?php comment_ID(); ?>">
            <div class="media-body">
                <h5 class="mt-0 mb-1"><?php echo get_comment_author_link(); ?></h5>
                <?php if ('0' == $comment->comment_approved) : ?>
                    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'ajaxinwp'); ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                        <?php
                        /* translators: 1: date, 2: time */
                        printf(
                            __('%1$s at %2$s', 'ajaxinwp'),
                            get_comment_date(),
                            get_comment_time()
                        ); ?>
                    </a>
                    <?php edit_comment_link(__('(Edit)', 'ajaxinwp'), '  ', ''); ?>
                </div>

                <?php comment_text(); ?>

                <div class="reply">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'class' => 'btn btn-sm btn-secondary'))); ?>
                </div>
            </div>
        </li>
        <?php
    }
}
