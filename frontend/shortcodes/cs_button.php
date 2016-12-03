<?php

/*
 *
 * @Shortcode Name : Button
 * @retrun
 *
 */
if (!function_exists('jobcareer_button_shortcode')) {

    function jobcareer_button_shortcode($atts) {
        $html = '';
        $cs_button_class = '';
        $defaults = array(
            'column_size' => '',
            'button_size' => 'btn-lg',
            'button_border' => '',
            'border_button_color' => '',
            'button_title' => '',
            'button_link' => '#',
            'button_color' => '#fff',
            'button_bg_color' => '#000',
            'button_icon_position' => '',
            'button_icon' => '',
            'button_type' => 'rounded',
            'button_target' => '_self',
        );
        extract(shortcode_atts($defaults, $atts));
        if (isset($column_size) && $column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
            $html .= '<div class="' . $column_class . '">';
        }
        $button_type_class = 'no_circle';
        $button_icon_position = isset($button_icon_position) ? $button_icon_position : '';
        $border = '';
        $has_icon = '';
        if ($button_size == 'btn-xlg') {
            $button_size = 'large';
        } elseif ($button_size == 'btn-lg') {
            $button_size = 'custom-btn btn-lg';
        } elseif ($button_size == 'medium-btn') {
            $button_size = 'medium';
        } else {
            $button_size = 'small';
        }
        if (isset($button_border) && $button_border == 'yes') {
            $border = ' border: 2px solid ' . $border_button_color . ';';
        }
        if (isset($button_type) && $button_type == 'rounded') {
            $button_type_class = 'circle';
        }
        if (isset($button_type) && $button_type == 'three-d') {
            $button_type_class = 'has-shadow';
            $border = '';
        }
        if (isset($button_icon) && $button_icon <> '') {
            $has_icon = 'has_icon';
        }
        $button_class_position = (isset($button_icon_position) and $button_icon_position == 'left') ? 'icon-left' : 'icon-right';


        $html .= '<div class="button_style cs-button">';

        $html .= '<a href="' . esc_url($button_link) . '" class="btn-post ' . sanitize_html_class($button_type_class) . '  ' . $button_size . ' bg-color ' . $cs_button_class . '  ' . $has_icon . ' button-icon-' . $button_icon_position . '" style="' . $border . '  background-color: ' . $button_bg_color . '; color:' . $button_color . ';" target="' . $button_target . '">';
        if (isset($button_icon) && $button_icon <> '') {
            $html .= '<i class="' . $button_icon . '"></i>';
        }
        if (isset($button_title) && $button_title <> '') {
            $html .= $button_title;
        }
        $html .= '</a>';

        $html .= '</div>';
        if (isset($column_size) && $column_size != '') {
            $html .= '</div>';
        }
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_BUTTON, 'jobcareer_button_shortcode');
    }
}