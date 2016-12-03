<?php
/*
 *
 * @Shortcode Name : Contact us
 * @retrun
 *
 */
if (!function_exists('jobcareer_contactform_shortcode')) {

    function jobcareer_contactform_shortcode($atts, $content = "") {

        global $post, $jobcareer_form_fields;
        $view_class = '';
        $defaults = array(
            'column_size' => '',
            'cs_contactform_section_title' => '',
            'cs_contactform_label' => '',
            'cs_contactform_view' => '',
            'cs_contactform_send' => '',
            'cs_success' => '',
            'cs_error' => '',
            'cs_contact_class' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $cs_email_counter = rand(3242343, 324324990);
        $html = '';
        $class = '';
        $section_title = '';
        if ($cs_contactform_section_title && trim($cs_contactform_section_title) != '') {
            $section_title = '<div class="cs-element-title"><h2>' . $cs_contactform_section_title . '</h2></div>';
        }
        if (trim($cs_success) && trim($cs_success) != '') {
            $success = $cs_success;
        } else {
            $success = esc_html__('Email has been sent Successfully', 'jobcareer');
        }
        if (trim($cs_error) && trim($cs_error) != '') {
            $error = $cs_error;
        } else {
            $error = esc_html__('An error Occured, please try again later', 'jobcareer');
        }
        ?>
        <script type="text/javascript">
            function cs_contact_frm_submit(form_id) {
                "use strict";
                var cs_mail_id = document.getElementById("hidden_" + form_id).value;
                var suc = document.getElementById("suc_" + form_id).value;
                var error = document.getElementById("err_" + form_id).value;
                var sendto = document.getElementById("sendto_" + form_id).value;
                
                if (form_id == cs_mail_id) {
                    var $ = jQuery;
                    $("#loading_div" + cs_mail_id).html('<img src="<?php echo esc_js(esc_url(get_template_directory_uri())); ?>/assets/images/ajax-loader.gif" alt="<?php echo jobcareer_get_post_img_title($post->ID); ?>" />');
                    $("#loading_div" + cs_mail_id).show();
                    $("#message" + cs_mail_id).html('');
                    var datastring = $("#frm" + cs_mail_id).serialize() + "&cs_contact_email=" + sendto + "&cs_contact_succ_msg=" + suc + "&cs_contact_error_msg=" + error + "&action=jobcareer_contact_form_submit";

                    //alert(datastring);
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        data: datastring,
                        dataType: "json",
                        success: function (response) {
                            if (response.type == 'error') {
                                $("#loading_div" + cs_mail_id).html('');
                                $("#loading_div" + cs_mail_id).hide();
                                $("#message" + cs_mail_id).addClass('error_mess');
                                $("#message" + cs_mail_id).show();
                                $("#message" + cs_mail_id).html(response.message);
                            }
                            else if (response.type == 'success') {
                                $("#frm" + cs_mail_id).slideUp();
                                $("#loading_div" + cs_mail_id).html('');
                                $("#loading_div" + cs_mail_id).hide();
                                $("#message" + cs_mail_id).addClass('succ_mess');
                                $("#message" + cs_mail_id).show();
                                $("#message" + cs_mail_id).html(response.message);
                            }
                        }
                    }
                    );
                }

            }
        </script>

        <?php
        $html = '';
        if($column_class != ''){
        $html .= '<div class="' . $column_class . '">';
        }
        $html .= $section_title;
        $html .= '<div id="cs-profile-contact-detail" class="cs-profile-contact-detail contact-form-holder" data-validationmsg="' . esc_html__("Please ensure that all required fields are completed and formatted correctly", 'jobcareer') . '">';
        $html .= '<form  name="frm' . absint($cs_email_counter) . '" id="frm' . absint($cs_email_counter) . '" action="javascript:cs_contact_frm_submit(' . absint($cs_email_counter) . ')"  class="comment-form">';
        $html .= ' <div class="input-filed-contact">';
        if (isset($cs_contactform_label) && $cs_contactform_label == 'on') {
            $html .= ' <label>' . esc_html__('Your Name', 'jobcareer') . '</label>';
            $html .= ' <i class="icon-user9"></i>';
        }


        $cs_opt_array = array(
            'std' => '',
            'cust_id' => 'contact_name',
            'classes' => sanitize_html_class($class) . ' ' . sanitize_html_class($view_class),
            'cust_name' => 'contact_name',
            'extra_atr' => ' required="required" placeholder=\'' . esc_html__('Name', 'jobcareer') . '\'',
            'return' => true,
        );
        $html .=$jobcareer_form_fields->cs_form_text_render($cs_opt_array);

        $html .= '</div>';
        $html .= ' <div class="input-filed-contact">';
        if (isset($cs_contactform_label) && $cs_contactform_label == 'on') {
            $html .= ' <label>' . esc_html__('Email Address', 'jobcareer') . '*</label>';
            $html .= '<i class="icon-envelope4"></i>';
        }

        $cs_opt_array = array(
            'std' => '',
            'cust_id' => 'contact_email',
            'classes' => ' ' . sanitize_html_class($class) . ' ' . sanitize_html_class($view_class),
            'cust_name' => 'contact_email',
            'cust_type' => 'email',
            'extra_atr' => ' required  placeholder=\'' . esc_html__('Enter your email address', 'jobcareer') . '\'',
            'return' => true,
        );
        $html .=$jobcareer_form_fields->cs_form_text_render($cs_opt_array);

        $html .= '</div>';
        $html .= '<div class="input-filed-contact">';
        if (isset($cs_contactform_label) && $cs_contactform_label == 'on') {
            $html .= ' <label>' . esc_html__('Subject', 'jobcareer') . '</label>';
            $html .= '<i class="icon-mobile4"></i>';
        }
        $cs_opt_array = array(
            'std' => '',
            'cust_id' => 'contact_subject',
            'classes' => 'form-control ' . sanitize_html_class($class) . ' ' . sanitize_html_class($view_class),
            'cust_name' => 'contact_subject',
            'extra_atr' => ' required="required" placeholder=' . esc_html__('Subject', 'jobcareer'),
            'return' => true,
        );
        $html .=$jobcareer_form_fields->cs_form_text_render($cs_opt_array);

        $html .= '</div>';
        $html .= '<div class="input-filed-contact">';
        if (isset($cs_contactform_label) && $cs_contactform_label == 'on') {
            $html .= ' <label>' . esc_html__('Message', 'jobcareer') . '</label>';
        }
        $cs_opt_array = array(
            'std' => '',
            'cust_id' => 'contact_msg',
            'classes' => 'commenttextarea form-control ' . sanitize_html_class($class) . ' ' . sanitize_html_class($view_class),
            'cust_name' => 'contact_msg',
            'extra_atr' => ' rows="4" cols="39" required="required" placeholder=' . esc_html__('Message', 'jobcareer'),
            'return' => true,
        );
        $html .=$jobcareer_form_fields->cs_form_textarea_render($cs_opt_array);


        $html .= '</div>';


        $cs_opt_array = array(
            'std' => absint($cs_email_counter),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => '',
            'extra_atr' => '',
            'cust_id' => 'hidden_' . absint($cs_email_counter),
            'cust_name' => '',
            'return' => true,
            'required' => false
        );
        $html .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);


        $cs_opt_array = array(
            'std' => esc_attr($success),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => '',
            'extra_atr' => '',
            'cust_id' => 'suc_' . absint($cs_email_counter),
            'cust_name' => '',
            'return' => true,
            'required' => false
        );
        $html .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);

        $cs_opt_array = array(
            'std' => esc_attr($error),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => '',
            'extra_atr' => '',
            'cust_id' => 'err_' . absint($cs_email_counter),
            'cust_name' => '',
            'return' => true,
            'required' => false
        );
        $html .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);

        $cs_opt_array = array(
            'std' => esc_attr($cs_contactform_send),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => '',
            'extra_atr' => '',
            'cust_id' => 'sendto_' . absint($cs_email_counter),
            'cust_name' => '',
            'return' => true,
            'required' => false
        );
        $html .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
        
        $html .= '<div class="input-filed-contact">';
       
        $html .= '<div class="profile-contact-btn">';
        $cs_opt_array = array(
            'std' => esc_html__('Submit Now', 'jobcareer'),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => 'cs-bgcolor acc-submit',
            'extra_atr' => '',
            'cust_id' => 'submit_btn' . absint($cs_email_counter),
            'cust_name' => 'submit',
            'return' => true,
            'required' => false
        );


        $html .= $jobcareer_form_fields->cs_form_submit_render($cs_opt_array);
        $html .= '</div></div>';
        
        $html .= '<div id="loading_div' . $cs_email_counter . '" style="float: left;margin: 19px 0 0 100px;"></div>';
        $html .= '</form>';
        $html .= '<div id="message' . $cs_email_counter . '"  style="display:none;"></div>';
        $html .= ' </div>';
        if($column_class != ''){
        $html .= '</div>';
        }
        ?>
        <?php
        return $html;
    }

    if (function_exists('cs_short_code')) {
        
        cs_short_code(CS_SC_CONTACTUS, 'jobcareer_contactform_shortcode');
    }
}