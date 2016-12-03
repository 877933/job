<?php
/*
 *
 * @Shortcode Name : Start function for Price table shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_multi_price_table_shortcode')) {

    function jobcareer_multi_price_table_shortcode($atts, $content = null) {
        global $pricetable_style, $jobcareer_multi_price_table_class, $column_class, $testimonial_text_color, $jobcareer_multi_price_table_section_title, $post, $cs_multi_price_col;
        $randomid = rand(0, 999);
        $defaults = array('column_size' => '', 'jobcareer_multi_price_table_section_title' => '', 'pricetable_style' => '', 'cs_multi_price_col' => '');
        extract(shortcode_atts($defaults, $atts));
        if ($column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
        }
        $html = '';
//        if (isset($pricetable_style) and $pricetable_style == 'simple') {
//
////            if (isset($jobcareer_multi_price_table_section_title) and $jobcareer_multi_price_table_section_title <> '') {
////                echo '<h2>' . esc_attr($jobcareer_multi_price_table_section_title) . '</h2>';
////            }
//             if (isset($jobcareer_multi_price_table_section_title) and $jobcareer_multi_price_table_section_title <> '') {
//                $html .= '<div class="cs-element-title">';
//                $html .= '<h2>' . esc_attr($jobcareer_multi_price_table_section_title) . '</h2>';
//                $html .= '</div>';
//            }
//            $html .= '<div class="price-table multi-simple">'
//                    . '<div class="row">';
//            $html .= do_shortcode($content);
//            $html .= '</div></div>';
//        } else {
            if (isset($jobcareer_multi_price_table_section_title) and $jobcareer_multi_price_table_section_title <> '') {
                $html .= '<div class="cs-element-title">';
                $html .= '<h2>' . esc_attr($jobcareer_multi_price_table_section_title) . '</h2>';
                $html .= '</div>';
            }
            $html .= '<ul class="cs-pricetable">';
            $html .= do_shortcode($content);
            $html .= '</ul>';
      //  }

        return '<div class="' . $column_class . '"> ' . $html . '</div>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTIPRICETABLE, 'jobcareer_multi_price_table_shortcode');
    }
}

/*
 *
 * @Shortcode Name :  Start function for Pricetable Item shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_multi_price_table_item')) {

    function jobcareer_multi_price_table_item($atts, $content = null) {
        global $pricetable_style, $post, $cs_multi_price_col;
        $col_class = '';
        if (isset($cs_multi_price_col) && $cs_multi_price_col != '') {
            $number_col = 12 / $cs_multi_price_col;
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
        $defaults = array(
            'multi_price_table_text' => '',
            'multi_price_table_currency' => '',
            'multi_price_table_time_duration' => '',
            'multi_pricetable_price' => '',
            'multi_price_table_button_text' => '',
            'multi_price_table_title_color' => '',
            'multi_price_table_button_color' => '',
            'pricing_detail' => '',
            'pricetable_featured' => '',
            'multi_price_table_button_color_bg' => '',
            'multi_price_table_button_column_color' => '',
            'multi_price_table_column_bgcolor' => '',
            'button_link' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        if(empty($button_link) || $button_link == '#'){
            $button_link = 'javascript:void()';
        }else{
            $button_link = esc_url($button_link);
        }
        $html = '';
        $pricing_detail = isset($pricing_detail) ? $pricing_detail : '';
        $bg_color = "";
        $column_bg_color = "";
        if (isset($multi_price_table_column_bgcolor) && $multi_price_table_column_bgcolor <> '') {
            $column_bg_color = esc_attr($multi_price_table_column_bgcolor);
        }

//        if (isset($pricetable_style) and $pricetable_style == "simple") {
//            $featured_cell = "";
//            if (isset($pricetable_featured) && $pricetable_featured == 'Yes') {
//                $featured_cell = "cs-featured";
//            }
//            if (isset($multi_price_table_button_color_bg) && $multi_price_table_button_color_bg <> '') {
//                $bg_color = 'style="background:' . esc_attr($multi_price_table_button_color_bg) . ';"';
//            }
//            
//            $html .= '<article class="' . $col_class . ' ' . esc_attr($featured_cell) . '" style="background:' . esc_attr($column_bg_color) . '">';
//            if ($multi_price_table_currency != '' || $multi_pricetable_price != '' || $multi_price_table_time_duration != '') {
//                $html .= '<span class="price">' . $multi_price_table_currency . '' . $multi_pricetable_price . '<em>' . $multi_price_table_time_duration . '</em></span>';
//            }
//            if ($multi_price_table_button_text != '') {
//                $html .= '<h3 style="color:' . $multi_price_table_title_color . ' !important">' . $multi_price_table_text . '</h3>';
//            }
//            $html .= '<ul class="price-list">';
//            $html .= do_shortcode($content);
//            $html .= '</ul>';
//
//            if ($multi_price_table_button_text != '') {
//                $html .= '<a href="' . esc_url($button_link) . '" class="cs-color acc-submit" style="background-color:' . $multi_price_table_button_column_color . ' !important; color:' . $multi_price_table_button_color . ' !important">' . $multi_price_table_button_text . '</a>';
//            }
//
//            $html .= '</article>';
//         //  $html .= '</div>';
//        } else {

            $featured_cell = "";
            if (isset($pricetable_featured) && $pricetable_featured == 'Yes') {
                $featured_cell = "active";
            }
            // $html .= '<div class="row">';
            $html .= '<li class="'.$col_class.'">';
            $html .= '<div style="background-color:#fff;" class="pricetable-holder ' . esc_attr($featured_cell) . '">';
            $html .= '<h2 style="color:' . esc_attr($multi_price_table_title_color) . ' !important; background:' . esc_attr($column_bg_color) . ';">' . esc_attr($multi_price_table_text) . '</h2>';
            $html .= '<div class="price-holder">';
            $html .= '<div class="cs-price">';
            
            $html .= '<span><em>' . esc_attr($multi_price_table_currency) . '' . esc_attr($multi_pricetable_price) . '</em><small>' . esc_attr($multi_price_table_time_duration) . '</small></span>';
            $html .= '<p>' . do_shortcode($content) . '</p>';
            $html .= '</div>';
            $html .= '<a style="background-color:' . $multi_price_table_button_column_color . ' !important; color:' . $multi_price_table_button_color . ' !important" class="cs-bgcolor cs-button" href="' . $button_link . '">' . esc_attr($multi_price_table_button_text) . '</a>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</li>';
//        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTIPRICETABLEITEM, 'jobcareer_multi_price_table_item');
    }
}

/*
 *
 * @Shortcode Name : Price Features
 * @retrun
 *
 */
if (!function_exists('cs_price_features')) {

    function cs_price_features($atts, $content = null) {
        global $pricetable_style, $jobcareer_multi_price_table_class, $column_class, $jobcareer_multi_price_table_section_title, $post;
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        $html = '<li><span>' . do_shortcode($content) . '</span></li>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_PRICE_FEATURES, 'cs_price_features');
    }
}