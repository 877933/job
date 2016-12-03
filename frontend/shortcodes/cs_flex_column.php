<?php
/*
 *
 * @File : Flex column
 * @retrun
 *
 */
if (!function_exists('jobcareer_column_shortocde')) {

    function jobcareer_column_shortocde($atts, $content = "") {

        $defaults = array(
            'column_size' => '',
            'flex_column_section_title' => '',
            'cs_column_margin_left' => '0',
            'cs_column_margin_right' => '0',
            'cs_column_top_padding' => '',
            'cs_column_bottom_padding' => '',
            'cs_column_left_padding' => '',
            'cs_column_right_padding' => '',
            'cs_column_image_url' => '',
            'flex_column_text' => '',
            'cs_column_class' => '',
            'content_title_color' => '',
            'column_bg_color' => '' > '1'
        );

        $html = '';
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $flex_column_text = isset($flex_column_text) ? $flex_column_text : '';

        $cs_column_margin_left = isset($cs_column_margin_left) ? $cs_column_margin_left : '0px';
        $cs_column_margin_right = isset($cs_column_margin_right) ? $cs_column_margin_right : '0px';
        $cs_column_top_padding = isset($cs_column_top_padding) ? $cs_column_top_padding : '';
        $cs_column_bottom_padding = isset($cs_column_bottom_padding) ? $cs_column_bottom_padding : '';
        $cs_column_left_padding = isset($cs_column_left_padding) ? $cs_column_left_padding : '';
        $cs_column_right_padding = isset($cs_column_right_padding) ? $cs_column_right_padding : '';

        $style_string = '';
        if ($cs_column_top_padding != '' || $cs_column_bottom_padding != '' || $cs_column_left_padding != '' || $cs_column_right_padding != '') {
            $style_string .= ' ';
            if ($cs_column_top_padding != '') {
                $style_string .= ' padding-top:' . $cs_column_top_padding . 'px; ';
            }
            if ($cs_column_bottom_padding != '') {
                $style_string .= ' padding-bottom:' . $cs_column_bottom_padding . 'px; ';
            }
            if ($cs_column_left_padding != '') {
                $style_string .= ' padding-left:' . $cs_column_left_padding . 'px; ';
            }
            if ($cs_column_right_padding != '') {
                $style_string .= ' padding-right:' . $cs_column_right_padding . 'px; ';
            }
            $style_string .= ' ';
        }

        $style_string_class = '';
        if (wp_is_mobile()) {
            $style_string = '';
            $style_string_class = ' mobile-view';
        }

        $section_title = '';
        if (isset($cs_column_image_url) && $cs_column_image_url != '') {
            $cs_column_image_url;
        }
        if (trim($content_title_color) != '') {
            $content_title_color = $content_title_color;
        } else {
            $content_title_color = '';
        }
        $jobcareer_column_bg_color = '';
        if (trim($column_bg_color) != '' || ($cs_column_image_url) != '') {
            $jobcareer_column_bg_class = 'has-bg-color';
        } else {
            $jobcareer_column_bg_class = '';
        }

        if (trim($cs_column_class) != '') {
            $cs_column_class_id = $cs_column_class;
        } else {
            $cs_column_class_id = '';
        }
        if ($flex_column_section_title && trim($flex_column_section_title) != '') {
            $section_title = '<div class="cs-element-title"><div class="section-inner"><h2 style="color:' . esc_attr($content_title_color) . ' !important;">' . $flex_column_section_title . '</h2></div></div>';
        }

        if ($flex_column_text && trim($flex_column_text) != '') {
            $content .= '<p style="color:' . esc_attr($content_title_color) . ' !important;">' . $flex_column_text . '</p>';
        }
        $content = nl2br($content);
        $content = jobcareer_custom_shortcode_decode($content);
        $html = do_shortcode($content);
        $main_col_start = '';
        $main_col_end = '';
        if($column_class!= ''){
            $main_col_start = '<div class="'.$column_class.'">';
            $main_col_end = '</div>';
        }
        
        $html = $main_col_start. $section_title . '<div  style="background-image:url(' . esc_url($cs_column_image_url) . '); color:' . $content_title_color . '; background-color:' . $column_bg_color . '; margin-left:' . $cs_column_margin_left . 'px; margin-right:' . $cs_column_margin_right . 'px; ' . $style_string . '" class="' . $jobcareer_column_bg_class . ' ' . $style_string_class . '">'
                . $html .
                '</div>'. $main_col_end;
        
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_COLUMN, 'jobcareer_column_shortocde');
    }
}