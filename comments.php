<?php
/**
 * The template for displaying Comment form
 */
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
if (comments_open()) {
    if (post_password_required())
        return;
}
if (have_comments()) :
    ?>
   <div id="comments">
        <h5><?php echo comments_number('0 ', esc_html__('1 Comment','jobcareer'), esc_html__('% Comments', 'jobcareer')); ?></h5>
        <ul>
            <?php wp_list_comments(array('callback' => 'jobcareer_comment')); ?>
        </ul>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?  ?>
            <div class="navigation">
                <div class="nav-previous"><span class="meta-nav">&larr;</span>
                    <?php previous_comments_link(esc_html__('Older Comments', 'jobcareer')); ?>
                </div>
                <div class="nav-next"><span class="meta-nav">&rarr;</span>
                    <?php next_comments_link(esc_html__('Newer Comments', 'jobcareer')); ?>
                </div>
            </div>
            <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?  ?>
            <div class="navigation">
                <div class="nav-previous"><span class="meta-nav">&larr;</span>
                    <?php previous_comments_link(esc_html__('Older Comments', 'jobcareer')); ?>
                </div>
                <div class="nav-next"><span class="meta-nav">&rarr;</span>
                    <?php next_comments_link(esc_html__('Newer Comments', 'jobcareer')); ?>
                </div>
            </div>
            <!-- .navigation -->
        <?php endif; ?>
    </div>
<?php endif; // end have_comments()  ?>
<div id="respond-comment">

    <?php
    $cs_msg_class = '';
    if (is_user_logged_in()) {
        $cs_msg_class = ' cs-message';
	}
    
	$var_arrays = array('post_id', 'jobcareer_form_fields');
	$comment_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
	extract($comment_global_vars);
    $you_may_use = esc_html__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'jobcareer');
    $must_login = '<a href="%s" class="cs-color">logged in</a>' . esc_html__('You must be  to post a comment.', 'jobcareer');
    $logged_in_as = '<span>'.esc_html__('Logged in as&nbsp;', 'jobcareer') . '</span><a href="%1$s" class="cs-color">%2$s</a>. <a href="%3$s" class="cs-color" title="Log out of this account">' . esc_html__('Log out', 'jobcareer') . '</a>';
    $required_fields_mark = ' ' . esc_html__('Required fields are marked %s', 'jobcareer');
    $required_text = sprintf($required_fields_mark, '<span class="required">*</span>');
    $cs_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'nameinput',
        'extra_atr' => esc_attr($commenter['comment_author']) . ' placeholder="' . esc_html__("Enter your Name", "jobcareer") . '" tabindex="1"',
        'cust_id' => 'author',
        'cust_name' => 'author',
        'return' => true,
        'required' => false
    );

    $cs_email_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'emailinput',
        'extra_atr' => esc_attr($commenter['comment_author_email']) . ' placeholder="' . esc_html__("Enter your Email", "jobcareer") . '" size="30" tabindex="2"',
        'cust_id' => 'email',
        'cust_name' => 'email',
        'return' => true,
        'required' => false
    );

    $cs_url_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'websiteinput',
        'extra_atr' => 'placeholder="' . esc_html__("Enter your Phone", "jobcareer") . '" size="30" tabindex="3"',
        'cust_id' => 'url',
        'cust_name' => 'url',
        'return' => true,
        'required' => false
    );

    $jobcareer_comment_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'commenttextarea',
        'extra_atr' => ' rows="55" cols="15"',
        'cust_id' => 'comment_mes',
        'cust_name' => 'comment',
        'return' => true,
        'required' => false
    );

    $defaults = array('fields' => apply_filters('comment_form_default_fields', array(
		'notes' => '',
		'author' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="row"><div class="input-holder"> <i class="icon-user9"></i> ' . $jobcareer_form_fields->cs_form_text_render($cs_opt_array) . '' .
		'</div></div></div>',
		'email' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="row"><div class="input-holder">' . ' <i class="icon-envelope4"></i> ' . $jobcareer_form_fields->cs_form_text_render($cs_email_opt_array) . '' . '</div></div></div>',
		'url' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="row"><div class="input-holder">' .'<i class="icon-mobile4"></i> ' . $jobcareer_form_fields->cs_form_text_render($cs_url_opt_array) . '
			' .  '</div></div></div>')),
		'comment_field' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12' . $cs_msg_class . '"><div class="row"><div class="input-holder">' . $jobcareer_form_fields->cs_form_textarea_render($jobcareer_comment_opt_array) . '</div></div></div>',
        'must_log_in' => '<span>' . sprintf($must_login, wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</span>',
	    'logged_in_as' => '<span>' . sprintf($logged_in_as, admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</span>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        'class_form' => 'form-holder contact-form',
        'id_form' => 'form-style row',
        'class_submit' => 'cs-bgcolor acc-submit',
        'id_submit' => 'cs-bg-color',
        'title_reply' => '' . esc_html__('Leave us a comment', 'jobcareer') . '',
        'title_reply_to' => '' . esc_html__('Leave us a comment', 'jobcareer') . '',
        'cancel_reply_link' => esc_html__('Cancel reply', 'jobcareer'),
        'submit_field' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="row"><div class="input-button">%1$s %2$s</a></div></div></div>',
        'label_submit' => esc_html__('Submit', 'jobcareer'),
	);
    comment_form($defaults, $post_id);
    ?>
</div>

<!-- Col Start -->