<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="qodef-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="qodef-comment-holder-inner">
				<div class="qodef-comments-title">
					<h5>
						<?php esc_html(get_comments_number()) ?>
						<?php esc_html_e( 'Comments', 'wellexpo' ); ?>
					</h5>
				</div>
				<div class="qodef-comments">
					<ul class="qodef-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'wellexpo_select_comment' ), apply_filters( 'wellexpo_select_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'wellexpo' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$qodef_commenter = wp_get_current_commenter();
		$qodef_req       = get_option( 'require_name_email' );
		$qodef_aria_req  = ( $qodef_req ? " aria-required='true'" : '' );
		$qodef_consent  = empty( $qodef_commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$qodef_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Add Comment', 'wellexpo' ),
			'title_reply_before'   => '<h5 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h5>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'wellexpo' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'wellexpo' ),
			'label_submit'         => esc_html__( 'Submit', 'wellexpo' ),
			'comment_field'        => apply_filters( 'wellexpo_select_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Write comment...', 'wellexpo' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'wellexpo_select_filter_comment_form_default_fields', array(
				'author' => '<label for="author">' . esc_html__( 'Name*', 'wellexpo' ) . '</label><input id="author" name="author" placeholder="' . esc_attr__( 'Your full name...', 'wellexpo' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author'] ) . '"' . $qodef_aria_req . ' />',
				'email'  => '<label for="email">' . esc_html__( 'Email*', 'wellexpo' ) . '</label><input id="email" name="email" placeholder="' . esc_attr__( 'Your email address', 'wellexpo' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author_email'] ) . '"' . $qodef_aria_req . ' />',
				'url'    => '<label for="url">' . esc_html__( 'Website*', 'wellexpo' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Your website', 'wellexpo' ) . '" type="text" value="' . esc_attr( $qodef_commenter['comment_author_url'] ) . '" size="30" maxlength="200" />',
				'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $qodef_consent . ' />' .
			             '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'wellexpo' ) . '</label></p>',
			) )
		);

	$qodef_args = apply_filters( 'wellexpo_select_filter_comment_form_final_fields', $qodef_args );
		
	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="qodef-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $qodef_show_comment_form = apply_filters('wellexpo_select_filter_show_comment_form_filter', true);
    if($qodef_show_comment_form) {
    ?>
        <div class="qodef-comment-form">
            <div class="qodef-comment-form-inner">
                <?php comment_form( $qodef_args ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>	