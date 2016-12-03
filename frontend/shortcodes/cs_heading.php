<?php

// start Heading shortcode front end view function
if (!function_exists('jobcareer_heading_shortcode')) {

    function jobcareer_heading_shortcode($atts, $content = "") {
        $divider_div = '';
        $defaults = array(
            'column_size' => '',
            'heading_title' => '',
            'color_title' => '',
            'color_title_color' => '',
            'heading_color' => '#000',
            'class' => 'cs-heading-shortcode',
            'heading_style' => '',
            'heading_style_type' => '1',
            'heading_size' => '',
            'letter_space' => '',
            'line_height' => '',
            'font_weight' => '',
            'sub_heading_title' => '',
            'heading_font_style' => '',
            'heading_align' => 'center',
            'heading_divider' => '',
            'heading_color' => '',
            'heading_content_color' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $html = '';
        if (isset($column_size) && $column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
            $html .='<div class="' . $column_class . '">';
        }
        $css = '';
        $he_font_style = '';
        $heading_divider = isset($heading_divider) ? $heading_divider : '';
        if (isset($heading_divider) and $heading_divider == 'on') {
            if ($heading_style == 'stylish') {
                $divider_div = '<div class="cs-stylish-divider"></div>';
            } else {
                $divider_div = '<div class="spliter-medium"></div>';
            }
        }
        $sub_heading_title = isset($sub_heading_title) ? $sub_heading_title : '';
        if ($heading_font_style <> '') {
            $he_font_style = ' font-style:' . $heading_font_style;
        }
        echo balanceTags($css, false);

        if ($color_title != '' && $color_title_color != '' && false !== strpos($heading_title, $color_title)) {
            $heading_title = str_replace($color_title, '<span style="color:' . $color_title_color . ' !important;">' . $color_title . '</span>', $heading_title);
        }

        $cs_stylish_heading_class = '';
        if ($heading_style == 'stylish') {
            $cs_stylish_heading_class = ' cs-stylish-heading';
        }
        $html .= '<div class="cs-heading' . $cs_stylish_heading_class . '">';
        if ($heading_style == 'section_title') {
            $html .= '<div class="cs-element-title"><h2 style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: ' . $letter_space . 'px !important; line-height: ' . $line_height . 'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h2></div>';
        } elseif ($heading_style == 'fancy') {
            $html .= '<h3 class="cs-fancy" style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: ' . $letter_space . 'px !important; line-height: ' . $line_height . 'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h3>';
        } elseif ($heading_style == 'stylish') {
            $html .= '<h2 style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: ' . $letter_space . 'px !important; line-height: ' . $line_height . 'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h2>';
        } elseif ($heading_style == 'modern') {
            if ($heading_title != '') {
                $heading_title_words = explode(" ", $heading_title);
                $heading_title_words[0] = isset($heading_title_words[0]) ? '<span class="cs-color">' . $heading_title_words[0] . '</span>' : '';
                $heading_title = implode(' ', $heading_title_words);
                $html .= '<h3 style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: ' . $letter_space . 'px !important; line-height: ' . $line_height . 'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h3>';
            }
        } else {
            $html .= '<h' . $heading_style . ' style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: ' . $letter_space . 'px !important; line-height: ' . $line_height . 'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h' . $heading_style . '>';
        }
        if ($content != '') {
            $html .= '<div style="color:' . $heading_content_color . ' !important; text-align: ' . $heading_align . ';' . $he_font_style . ';">' . nl2br($content) . '</div>';
        }
        $html .= $divider_div;
        $html .= '</div>';
        if (isset($column_size) && $column_size != '') {
            $html .='</div>';
        }
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_HEADING, 'jobcareer_heading_shortcode');
    }
}