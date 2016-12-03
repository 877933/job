<?php

/*
 *
 * @Shortcode Name :  Start function for Multiple Service shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_multiple_team_shortcode')) {

    function jobcareer_multiple_team_shortcode($atts, $content = "") {
        $defaults = array(
            'column_size' => '',
            'cs_multiple_team_section_title' => '',
            'cs_multi_team_content_col' => '',
        );
        global $post, $cs_multiple_team_view, $cs_service_content_align, $cs_multiple_service_section_title, $cs_main_title_color, $cs_multi_team_content_col,
        $cs_title_color, $cs_service_content_color, $cs_section_title;
        extract(shortcode_atts($defaults, $atts));

        $cs_multi_team_content_col = isset($cs_multi_team_content_col) ? $cs_multi_team_content_col : '';
        $cs_multiple_team_section_title = isset($cs_multiple_team_section_title) ? $cs_multiple_team_section_title : '';

        $cs_html = '';
        $column_class = jobcareer_custom_column_class($column_size);
        $cs_section_title = '';
        $cs_sub_title = '';
        $randomid = rand(10000, 99999);

        //echo $cs_multiple_team_view;
        if (isset($cs_multiple_team_section_title) && trim($cs_multiple_team_section_title) <> '') {
            $cs_section_title = '<div class="cs-element-title"><h2>' . esc_html($cs_multiple_team_section_title) . '</h2></div>';
        }

        $cs_html .= '<div class="cs-simple">'
                . '<div class="cs-team cs-teamgrid">';
        $cs_html .= jobcareer_special_char($cs_section_title);
        $cs_html .= '<div class="row">';
        $cs_html .= do_shortcode($content);
        $cs_html .= '</div>'
                . '</div></div>';

        if ($column_size == '') {
            return $cs_html;
        } else {
            return '<div class="' . $column_class . '"> ' . $cs_html . '</div>';
        }
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTPLETEAM, 'jobcareer_multiple_team_shortcode');
    }
}

/*
 * @Multiple  Start function for Multiple Service Item shortcode/element front end view
 * @retrun
 */

if (!function_exists('cs_multiple_team_item_shortcode')) {

    function cs_multiple_team_item_shortcode($atts, $content = "") {
        $defaults = array(
            'cs_multi_team_name' => '',
            'cs_multi_team_designation' => '',
            'cs_multi_team_image' => '',
            'cs_multi_team_fb_url' => '',
            'cs_multi_team_twitter_url' => '',
            'cs_multi_team_linkedin_url' => '',
            'cs_multi_team_email' => '',
        );
        global $post, $cs_multiple_team_view, $cs_service_content_align, $cs_service_image_align, $cs_multi_team_content_col, $cs_section_title, $cs_title_color, $cs_service_icon_color;
        extract(shortcode_atts($defaults, $atts));
        $col_class = '';
        if (isset($cs_multi_team_content_col) && $cs_multi_team_content_col != '') {
            $number_col = 12 / $cs_multi_team_content_col;
            $number_col_sm = 12;
            $number_col_xs = 12;
            if ($number_col == 2) {
                $number_col_sm = 4;
                $number_col_xs = 6;
            }
            if ($number_col == 3) {
                $number_col_sm = 6;
                $number_col_xs = 12;
            }
            if ($number_col == 4) {
                $number_col_sm = 6;
                $number_col_xs = 12;
            }
            if ($number_col == 6) {
                $number_col_sm = 12;
                $number_col_xs = 12;
            }
            $col_class = 'col-lg-' . $number_col . ' col-md-' . $number_col . ' col-sm-' . $number_col_sm . ' col-xs-' . $number_col_xs . '';
        }

        $cs_title_color = isset($cs_title_color) ? $cs_title_color : '';
        $cs_text_color = isset($cs_text_color) ? $cs_text_color : '';
        $cs_website_url = isset($cs_website_url) ? $cs_website_url : '';
        $cs_style_class = "";

        $html = '';

        $html .= '<article class="' . $col_class . '">';
        $html .= '<div class="cs-wrapteam">';
        $html .= '<div class="cs-text">';
        $cs_multi_team_name = isset($cs_multi_team_name) ? $cs_multi_team_name : '';
        $cs_multi_team_designation = isset($cs_multi_team_designation) ? $cs_multi_team_designation : '';
        $cs_multi_team_image = isset($cs_multi_team_image) ? $cs_multi_team_image : '';
        $cs_multi_team_linkedin_url = isset($cs_multi_team_linkedin_url) ? $cs_multi_team_linkedin_url : '';

        $html .= '<div class="cs-team">';
        $html .= '<figure><img src="' . esc_url($cs_multi_team_image) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"></figure>';
        $html .= '<div class="team-info">';
        $html .= '<h5>' . $cs_multi_team_name . '</h5>';
        $html .= '<span>' . $cs_multi_team_designation . '</span>';
        $html .= '<div class="team-social-info">';
        $html .= '<ul>';

        if ($cs_multi_team_fb_url || $cs_multi_team_twitter_url || $cs_multi_team_linkedin_url || $cs_multi_team_email) {

            if (isset($cs_multi_team_fb_url) && $cs_multi_team_fb_url != '') {
                $html .= '<li><a href="' . esc_url($cs_multi_team_fb_url) . '" target="_blank"><i class="icon-facebook8 facebook"></i></a></li>';
            }

            if (isset($cs_multi_team_twitter_url) && $cs_multi_team_twitter_url != '') {
                $html .= '<li><a href="' . esc_url($cs_multi_team_twitter_url) . '" target="_blank"><i class="icon-twitter7 twitter"></i></a></li>';
            }

            if (isset($cs_multi_team_linkedin_url) && $cs_multi_team_linkedin_url != '') {
                $html .= '<li><a href="' . esc_url($cs_multi_team_linkedin_url) . '" target="_blank"><i class="icon-linkedin5 linkedin"></i></a></li>';
            }
        }
        $html .= '</ul>';
        $html .= '<div class="team-send-email">';
        if ($cs_multi_team_email != '' && is_email($cs_multi_team_email)) {

            $html .= '<a href="mailto:' . sanitize_email($cs_multi_team_email) . '" target="_blank"><i class="icon-envelope-o"></i> ' . esc_html__('Send Email', 'jobcareer') . '</a>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div></article>';

        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTPLETEAMITEM, 'cs_multiple_team_item_shortcode');
    }
}