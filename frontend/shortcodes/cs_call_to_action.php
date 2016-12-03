<?php

/*
 *
 * @File : Call to action
 * @retrun
 *
 */
if (!function_exists('jobcareer_call_to_action')) {

    function jobcareer_call_to_action($atts, $content = "") {
        $defaults = array(
            'column_size' => '',
            'cs_call_to_action_section_title' => '',
            'cs_content_type' => '',
            'cs_call_action_title' => '',
            'cs_call_action_contents' => '',
            'cs_contents_color' => '',
            'cs_call_action_icon' => '',
            'cs_icon_color' => '#FFF',
            'cs_call_to_action_icon_background_color' => '',
            'cs_call_to_action_icon_text_color' => '',
            'cs_call_to_action_button_text' => '',
            'cs_call_to_action_button_link' => '#',
            'cs_call_to_action_bg_img' => '',
            'animate_style' => 'slide',
            'cs_call_to_action' => '',
            'cs_contents_bg_color' => '',
            'cs_call_action_text_align' => '',
            'cs_call_to_action_img' => '',
            'class' => 'cs-article-box',
        );

        extract(shortcode_atts($defaults, $atts));

        $cell_button = '';
        $column_class = '';

        $html = '';
        $cs_call_to_action_button_text = isset($cs_call_to_action_button_text) ? $cs_call_to_action_button_text : '';
        $cs_call_to_action_button_link = isset($cs_call_to_action_button_link) ? $cs_call_to_action_button_link : '';
        $cs_call_to_action = isset($cs_call_to_action) ? $cs_call_to_action : '';
        $cs_call_to_action_icon_text_color = isset($cs_call_to_action_icon_text_color) ? $cs_call_to_action_icon_text_color : '';
        $cs_call_to_action_icon_background_color = isset($cs_call_to_action_icon_background_color) ? $cs_call_to_action_icon_background_color : '';
        $cs_call_to_action_img = isset($cs_call_to_action_img) ? $cs_call_to_action_img : '';
        $cs_contents_bg_color = isset($cs_contents_bg_color) ? $cs_contents_bg_color : '';
        $column_size = isset($column_size) ? $column_size : '';

        if ($column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
        }
        $section_title = '';
        if (isset($cs_call_to_action_section_title) && trim($cs_call_to_action_section_title) <> '') {
            $html .= '<div class="cs-element-title"><h2>' . $cs_call_to_action_section_title . '</h2></div>';
        }
        $cs_call_action_title = isset($cs_call_action_title) ? $cs_call_action_title : '';

        $background_view_call = 'style="';
        $background_view_call .= 'background:url(' . $cs_call_to_action_img . ') no-repeat ' . $cs_contents_bg_color . ' left !important;';
        $background_view_call .= 'background:' . $cs_contents_bg_color . ';';
        $background_view_call .= '"';

        $html .= '<div class="callToaction text-' . $cs_call_action_text_align . '" ' . $background_view_call . '>';
        $html .= '<div class="cs-text">';
        $html .= '<h3 style="color:' . $cs_contents_color . ' !important">' . $cs_call_action_title . '</h3>';
        $html .= '<p>' . do_shortcode($content) . '</p>';
        $html .= '</div>';

        if (isset($cs_call_to_action_button_text) and $cs_call_to_action_button_text <> '') {

            $html .= '<a href="' . esc_url($cs_call_to_action_button_link) . '" class="cs-bgcolor acc-submit" style="background:' . $cs_call_to_action_icon_background_color . '!important; color:' . $cs_call_to_action_icon_text_color . '!important;">' . $cs_call_to_action_button_text . '</a>';
        }
        $html .= '</div>';
        $col_div_start = '';
        $col_div_end = '';
        if ($column_class != '') {
            $col_div_start = '<div class="' . $column_class . '">';
            $col_div_end = '</div>';
        }
        return $col_div_start.'<div class="leftaction">' . $html . '</div>'.$col_div_end;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_CALLTOACTION, 'jobcareer_call_to_action');
    }
}