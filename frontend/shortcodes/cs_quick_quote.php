<?php
/*
 *
 * @Shortcode Name :  Start function for Quick Quote  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_quick_slider_shortcode')) {

    function jobcareer_quick_slider_shortcode($atts, $content = "") {
        global $jobcareer_form_fields;
        $defaults = array(
            'cs_quick_slider_section_title' => '',
            'cs_quick_slider_view' => '',
            'cs_quick_slider_send' => '',
            'cs_success' => '',
            'cs_error' => '',
            'cs_quick_slider_text_color' => '',
            'cs_quick_slider_bg_color' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $cs_email_counter = rand(132423143, 324324990);
        $cs_html = '';
        $section_title = '';
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
        $first_elem_class = 'element-size-67';
        $secnd_elem_class = 'element-size-100';

        if ($cs_quick_slider_view == 'classic') {
            $first_elem_class = 'element-size-50';
            $secnd_elem_class = 'element-size-50';
        }
       ?>
        <script type="text/javascript">
            function frm_submit<?php echo esc_js($cs_email_counter); ?>() {
                "use strict";
                var $ = jQuery;
                $("#loading_div<?php echo esc_js($cs_email_counter); ?>").html('<i class="icon-refresh icon-spin"></i>');
                $("#loading_div<?php echo esc_js($cs_email_counter); ?>").show();
                $("#message<?php echo esc_js($cs_email_counter); ?>").html('');
                var datastring = $('#frm<?php echo esc_js($cs_email_counter); ?>').serialize() + "&cs_slider_email=<?php echo esc_js($cs_quick_slider_send); ?>&cs_slider_succ_msg=<?php echo esc_js($success); ?>&cs_slider_error_msg=<?php echo esc_js($error); ?>&action=jobcareer_slider_form_submit";

                $.ajax({
                    type: 'POST',
                    url: '<?php echo esc_js(esc_url(admin_url('admin-ajax.php'))); ?>',
                    data: datastring,
                    dataType: "json",
                    success: function (response) {
                        show_alert_msg(response.message);

                        if (response.type == 'error') {
                            $("#loading_div<?php echo esc_js($cs_email_counter); ?>").html('');
                            $("#loading_div<?php echo esc_js($cs_email_counter); ?>").hide();
                            $("#message<?php echo esc_js($cs_email_counter); ?>").addClass('error_mess');
                            $("#message<?php echo esc_js($cs_email_counter); ?>").show();
                            $("#message<?php echo esc_js($cs_email_counter) ?>").html(response.message);
                        } else if (response.type == 'success') {
                            $("#frm<?php echo esc_js($cs_email_counter); ?>").slideUp();
                            $("#loading_div<?php echo esc_js($cs_email_counter); ?>").html('');
                            $("#loading_div<?php echo esc_js($cs_email_counter); ?>").hide();
                            $("#message<?php echo esc_js($cs_email_counter); ?>").addClass('succ_mess');
                            $("#message<?php echo esc_js($cs_email_counter) ?>").show();
                            $("#message<?php echo esc_js($cs_email_counter); ?>").html(response.message);
                        }

                    }
                });
            }

        </script>
        <?php
        $text_color = "";
        $bg_color = "";
        if (isset($cs_quick_slider_text_color) && $cs_quick_slider_text_color <> "") {
            $text_color = $cs_quick_slider_text_color;
        }

        if (isset($cs_quick_slider_bg_color) && $cs_quick_slider_bg_color <> "") {
            $bg_color = $cs_quick_slider_bg_color;
        }

        $section_title = "";
        if (isset($cs_quick_slider_section_title) && $cs_quick_slider_section_title <> "") {
            $section_title = '<h2>' . $cs_quick_slider_section_title . '</h2>';
        }
        $cs_html .= '<div class="contact-form" id="slider_form' . absint($cs_email_counter) . '"><div class="inner no-border">' . $section_title . '
         <div class="cs-profile-contact-detail employer-detail">
	<form id="frm' . absint($cs_email_counter) . '" name="frm' . absint($cs_email_counter) . '" method="post" action="javascript:frm_submit' . absint($cs_email_counter) . '(\'' . admin_url("admin-ajax.php") . '\');">
	<div class="input-filed-contact"> <i class="icon-user9"></i>';
       $cs_opt_array = array(
            'std' => '',
            'cust_id' => '',
            'classes' => '',
            'cust_name' => 'slider_name',
            'extra_atr' => ' required="required" placeholder=\'' . esc_html__('Enter name', 'jobcareer') . '\'',
            'return' => true,
        );
        $cs_html .=$jobcareer_form_fields->cs_form_text_render($cs_opt_array);
        $cs_html .= '</div><div class="input-filed-contact"> <i class="icon-envelope4"></i>';
        $cs_opt_array = array(
            'std' => '',
            'cust_id' => '',
            'classes' => '',
            'cust_name' => 'slider_mail',
            'extra_atr' => ' required="required" placeholder=\'' . esc_html__('Enter Email', 'jobcareer') . '\'',
            'return' => true,
        );
        $cs_html .=$jobcareer_form_fields->cs_form_text_render($cs_opt_array);
        $cs_html .= '</div><div class="input-filed-contact"> <i class="icon-mobile4"></i>';
        $cs_opt_array = array(
            'std' => '',
            'cust_id' => '',
            'classes' => '',
            'cust_name' => 'slider_number',
            'extra_atr' => ' required="required" placeholder=\'' . esc_html__('Enter Number', 'jobcareer') . '\'',
            'return' => true,
        );
        $cs_html .=$jobcareer_form_fields->cs_form_text_render($cs_opt_array);
        $cs_html .= '</div><div class="input-filed-contact">';
        $cs_opt_array = array(
            'std' => '',
            'cust_id' => '',
            'classes' => '',
            'cust_name' => 'slider_message',
            'extra_atr' => ' required="required" placeholder=\'' . esc_html__('Enter Message', 'jobcareer') . '\'',
            'return' => true,
        );
        $cs_html .=$jobcareer_form_fields->cs_form_textarea_render($cs_opt_array);
        $cs_opt_array = array(
            'std' => do_shortcode(nl2br($content)),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => 'cs-color acc-submit',
            'extra_atr' => 'style="color:' . $text_color . ' !important; background:' . $bg_color . ' !important;"',
            'cust_id' => 'submit_btn' . absint($cs_email_counter),
            'cust_name' => 'submit',
            'return' => true,
            'required' => false
        );
        $cs_html .= $jobcareer_form_fields->cs_form_submit_render($cs_opt_array);
        $cs_html .= '</div></form><div id="loading_div' . absint($cs_email_counter) . '"></div><div id="message' . absint($cs_email_counter) . '" style="display:none;"></div></div></div></div>';
        return do_shortcode($cs_html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_QUICK_QUOTE, 'jobcareer_quick_slider_shortcode');
    }
}