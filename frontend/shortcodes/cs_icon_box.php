<?php

/*
 *
 * @Shortcode Name :  Start function for Icon Box shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_icon_box_shortcode')) {

    function jobcareer_icon_box_shortcode($atts, $content = "") {
        $defaults = array(
            'column_size' => '',
            'cs_icon_box_section_title' => '',
            'cs_main_title_color' => '',
            'cs_icon_box_sub_title' => '',
            'cs_icon_box_view' => '',
            'cs_icon_box_content_align' => '',
            'cs_icon_box_image_align' => '',
            'cs_icon_box_content_col' => '',
            'cs_title_color' => '',
            'cs_icon_box_content_color' => '',
            'cs_icon_box_icon_color' => '',
        );
        global $post, $cs_icon_box_view, $cs_icon_box_content_align, $cs_icon_box_image_align, $cs_main_title_color, $cs_icon_box_content_col,
        $cs_title_color, $cs_icon_box_content_color, $cs_icon_box_icon_color;
        extract(shortcode_atts($defaults, $atts));
        $column_size = isset($column_size) ? $column_size : '';

        $col_class = '';
        $cs_html = '';
        $column_class = '';
        if($column_size != ''){
        $column_class = jobcareer_custom_column_class($column_size);
        }
        $cs_section_title = '';
        $cs_sub_title = '';
        $randomid = rand(10000, 99999);
        $cs_main_title_color_str = '';
        //echo $cs_icon_box_view;
        if (isset($cs_main_title_color) && $cs_main_title_color != '') {
            $cs_main_title_color_str .= 'style="color:' . $cs_main_title_color . ' !important;"';
        }
        if (isset($cs_icon_box_sub_title) && trim($cs_icon_box_sub_title) <> '') {
            $cs_sub_title = '<div class="cs-content" ' . $cs_main_title_color_str . '><p><p>' . $cs_icon_box_sub_title . '</p></div>';
        }
        if (isset($cs_icon_box_section_title) && trim($cs_icon_box_section_title) <> '') {
            $cs_section_title = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="cs-element-title"><h2 ' . $cs_main_title_color_str . '>' . esc_html($cs_icon_box_section_title) . '</h2>' . $cs_sub_title . '</div></div>';
        }
         if ($column_class != '') {
        $cs_html .= '<div class="' . $column_class . '">';
        }

        if ($cs_icon_box_view == "cs-box") {
            $cs_html .= '<div class="row"><div class="cs-box" ' . $cs_main_title_color_str . '>';
            $cs_html .= jobcareer_special_char($cs_section_title);

            $cs_html .= do_shortcode($content);

            $cs_html .= '</div></div>';
        } else {
            $cs_html .= '<div class="row"><div class="cs-simple" ' . $cs_main_title_color_str . '>';
            $cs_html .= jobcareer_special_char($cs_section_title);
            $cs_html .= do_shortcode($content);
            $cs_html .= '</div></div>';
        }
          if ($column_class != '') {
             $cs_html .= '</div>';
             }
        return do_shortcode($cs_html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_ICONBOX, 'jobcareer_icon_box_shortcode');
    }
}

/*
 * @Multiple  Start function for Icon Box Item  shortcode/element front end view
 * @retrun
 */

if (!function_exists('cs_icon_box_item_shortcode')) {

    function cs_icon_box_item_shortcode($atts, $content = "") {
        $defaults = array(
            'cs_text_color' => '', 'cs_bg_color' => '',
            'cs_website_url' => '',
            'cs_icon_box_title' => '',
            'cs_icon_box_logo' => '',
            'cs_icon_box_btn' => '',
            'cs_icon_box_btn_link' => '',
            'cs_icon_box_btn_bg_color' => '',
            'cs_icon_box_btn_txt_color' => '',
            'cs_icon_box_image_icon' => '',
            'cs_icon_box_image_circle' => '',
            'cs_sercices_icon' => '',
            'cs_icon_box_icon_size' => '',
            'cs_cs_icon_box_icon_color' => '',
            'cs_icon_box_icon_circle' => '',
            'cs_button_link' => '',
            'cs_button_text' => '',
            'cs_button_text_color' => '',
            'cs_button_color' => '',
            'cs_icon_box_background_color' => '',
            'cs_icon_box_image_size' => '',
            'cs_icon_box_icon_type' => '',
            'cs_icon_box_image_array' => '',
            'cs_icon_box_icon' => '',
            'cs_icon_box_link' => '',
            'cs_cs_icon_box_icon_color' => '',
        );
        global $post, $cs_icon_box_view, $cs_main_title_color, $cs_icon_box_content_align, $cs_icon_box_image_align, $cs_icon_box_content_col, $cs_icon_box_content_color, $cs_title_color, $cs_icon_box_icon_color;
        extract(shortcode_atts($defaults, $atts));
        if (isset($cs_icon_box_content_col) && $cs_icon_box_content_col != '') {
            $number_col = 12 / $cs_icon_box_content_col;
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
        $html = '';
        $icon_border = isset($icon_border) ? $icon_border : '';
        $cs_icon_box_title_color = isset($cs_icon_box_title_color) ? $cs_icon_box_title_color : '';
        $cs_icon_box_title = isset($cs_icon_box_title) ? $cs_icon_box_title : '';        
        $cs_title_color = isset($cs_title_color) ? $cs_title_color : '';
        $cs_text_color = isset($cs_text_color) ? $cs_text_color : '';
        $cs_website_url = isset($cs_website_url) ? $cs_website_url : '';
        $cs_style_class = "";
        if (isset($cs_icon_box_postion_modern) and $cs_icon_box_postion_modern == "top") {
            $cs_style_class = "cs_class_top";
        } else
        if (isset($cs_icon_box_postion_modern) and $cs_icon_box_postion_modern == "center") {
            $cs_style_class = "cs_class_center";
        } else
        if (isset($cs_icon_box_postion_modern) and $cs_icon_box_postion_modern == "right") {
            $cs_style_class = "cs_class_right";
        } else
        if (isset($cs_icon_box_postion_modern) and $cs_icon_box_postion_modern == "left") {
            $cs_style_class = "cs_class_left";
        }
        $cs_image_style_class = "";
        $icon_icon_box = '';
        if (isset($cs_icon_box_icon_color) && $cs_icon_box_icon_color != '') {
            $iconColor = $cs_icon_box_icon_color;
        } else {
            $iconColor = '';
        }
        $circle = '';
        if (isset($cs_icon_box_image_circle) && $cs_icon_box_image_circle == 'yes') {
            $circle = 'circle';
        }
        $icon_circle = '';
        if (isset($cs_icon_box_icon_circle) && $cs_icon_box_icon_circle == 'yes') {
            $circle = 'circle';
            $icon_circle = 'icon-circle';
        }
        if (isset($cs_icon_box_view) && $cs_icon_box_view != '') {
            $cs_icon_box_link_url = '#';
            if (isset($cs_icon_box_link) && $cs_icon_box_link != '') {
                $cs_icon_box_link_url = esc_url($cs_icon_box_link);
            }

            $html .= '<div class="' . $col_class . '"><div class="cs-icon-box ' . $cs_icon_box_content_align . '">';
            if (isset($cs_icon_box_icon) && $cs_icon_box_icon != '' && $cs_icon_box_icon_type == 'icon') {
                $color_string = '';
                if (isset($iconColor) && $iconColor != '') {
                    $color_string = ' style="color:' . $iconColor . ' !important;"';
                }
                $icon_icon_box = '<a href="' . $cs_icon_box_link_url . '"><i class="' . $cs_icon_box_icon . '" ' . $color_string . '></i></a>';
            }
            if (isset($cs_icon_box_image_array) && $cs_icon_box_image_array != '' && $cs_icon_box_icon_type == 'image') {


                $icon_icon_box = '<a href="' . $cs_icon_box_link_url . '"><img alt="icon box image" src="' . $cs_icon_box_image_array . '"></a>';
            }
            $html .= '<div class="cs-media"><figure>' . $icon_icon_box . '</figure></div>';


            if ((isset($cs_icon_box_title) && $cs_icon_box_title != '') || (isset($content) && $content != '')) {
                $html .= '<div class="cs-text">';
                if (isset($cs_icon_box_title) && $cs_icon_box_title != '') {
                    $color_string = '';
                    if (isset($cs_title_color) && $cs_title_color != '') {
                        $color_string = ' style="color:' . $cs_title_color . ' !important;"';
                    }
                    $html .= '<h4 ' . $color_string . '><a ' . $color_string . ' href="' . $cs_icon_box_link_url . '">' . $cs_icon_box_title . '</a></h4>';
                }
                if (isset($content) && $content != '') {
                    $color_string = '';
                    if (isset($cs_icon_box_content_color) && $cs_icon_box_content_color != '') {
                        $color_string = ' style="color:' . $cs_icon_box_content_color . ' !important;"';
                    }
                    $html .= '<p ' . $color_string . '>' . $content . '</p> ';
                }

                $html .= '</div>';
            }

            $html .= '</div></div>';
        }
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_ICONBOXITEM, 'cs_icon_box_item_shortcode');
    }
}