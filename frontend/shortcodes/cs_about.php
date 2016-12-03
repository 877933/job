<?php

/*
 *
 * @Shortcode Name : about
 * @retrun
 *
 */

if (!function_exists('jobcareer_about_shortcode')) {

    function jobcareer_about_shortcode($atts, $content = "") {
        $defaults = array('column_size' => '', 'cs_about_section_title' => '', 'about_url' => '', 'cs_bg_color' => '', 'cs_text_color' => '', 'cs_image_about_url' => '', 'button_text' => '', 'content_texarea', '', 'about_action_textarea' => '');

        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);

        $cs_text_color = isset($cs_text_color) ? $cs_text_color : '';
        $cs_about_section_title = isset($cs_about_section_title) ? $cs_about_section_title : '';

        $content_texarea = isset($atts['content_texarea']) ? $atts['content_texarea'] : '';
        $about_url = isset($about_url) ? $about_url : '';
        $button_text = isset($button_text) ? $button_text : '';
        $cs_image_about_url = isset($cs_image_about_url) ? $cs_image_about_url : '';
        $cs_bg_color = isset($cs_bg_color) ? $cs_bg_color : '';


        $about = '';
        $about .= ' <div class="row">';
        $about .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
        $about .= '<div class="cs-about-info" style="background:' . esc_html($cs_bg_color) . ';">';
        $about .= '<h2 style="color:' . esc_html($cs_text_color) . ' !important;"> ' . esc_html($cs_about_section_title) . '</h2>';
        $about .= '<div><p style="color:' . esc_html($cs_text_color) . ' !important;">' . do_shortcode($content_texarea) . '</p>';
        $about .= '<div class="button_style cs-button">';
        $about .= '<a target="_self" style=" color:' . esc_html($cs_text_color) . ';" class="btn-post circle  custom-btn btn-lg bg-color" href="' . esc_url($about_url) . '">' . esc_html($button_text) . '</a>';
        $about .= '</div>';
        $about .= '</div>';
        $about .= '</div>';
        $about .= '</div>';
        $about .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">';
        $about .= '<div class="img-frame">';
        $about .= '<img alt="" src="' . esc_url($cs_image_about_url) . '">';
        $about .= '</div>';
        $about .= '</div>';
        $about .= '</div>';
        return $about;
    }
    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_ABOUT, 'jobcareer_about_shortcode');
}