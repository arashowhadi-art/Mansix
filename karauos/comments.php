<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Karauos
 * @version 3.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) : ?>

        <h3 class="comments-title">
            <?php echo '<div class="flex align-items-center comments-number"> <i class="far fa-comments"></i> '; comments_number( __( 'No Responses', text_domain ), __( '1 Response', text_domain ), __( '% Responses', text_domain ) ); echo '</div>'; ?>
        </h3>
        <ul class="comment-list">
            <?php
            wp_list_comments( array(
                'avatar_size' => 40,
                'short_ping'  => true,
                'reply_text'  => __( 'Reply', text_domain ),
            ) );
            ?>
        </ul>
        <?php
        the_comments_pagination( array(
            'prev_text' => '<span class="comment-reader-text">' . __( 'Previous', text_domain ) . '</span>',
            'next_text' => '<span class="comment-reader-text">' . __( 'Next', text_domain ) . '</span>',
        ) );
    endif; // Check for have_comments().
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', text_domain ); ?></p>
    <?php
    endif;
    $commenter = wp_get_current_commenter();
    if ( ! isset( $args['format'] ) )
        $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5    = 'html5' === $args['format'];
    $comments_args = array(
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><textarea class="form-control" id="comment" name="comment" aria-required="true" placeholder="' . __( "Write your own comment ...", text_domain ) . '" rows="8" cols="37" wrap="hard"></textarea></p>',
        'label_submit'         => __( 'Post a comment', text_domain ),
        'class_submit'         => 'submit submit-btn_ph',
        'title_reply'          => __( 'Post a comment', text_domain ),
        'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h5>',
        'cancel_reply_before'  => '',
        'cancel_reply_after'   => '',
        'cancel_reply_link'    => __( 'Cancel reply' ),
        'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.', text_domain ) . '</span></p>',
        'fields' => apply_filters( 'comment_form_default_fields', array(

            'author' =>
                '<p class="comment-form-author">' .
                '<input id="author" name="author" placeholder="' . __( 'Enter Your Name', text_domain ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' /></p>',

            'email' =>
                '<p class="comment-form-email">' .
                '<input id="email" name="email" placeholder="' . __( 'Enter Your Email', text_domain ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' /></p>',

            'url' => '',

            'cookies' => ''

        ) //fields array
        )
    );
    comment_form($comments_args);

    ?>


</div><!-- #comments -->