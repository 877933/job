<?php

/*
 *
 * @File : Frontend view for List shortcode and element
 * @retrun
 *
 */
if (!function_exists('jobcareer_list_shortcode')) {

    function jobcareer_list_shortcode($atts, $content = "") {
        global $cs_border, $cs_list_type, $counter;
        $defaults = array(
            'column_size' => '',
            'cs_list_section_title' => '',
            'cs_list_type' => '',
            'cs_list_icon' => '',
            'cs_border' => '',
            'cs_list_item' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $customID = '';
         $html = "";
        if(isset($column_size) && $column_size!=''){
                  $column_class = jobcareer_custom_column_class($column_size);
                   $html .= '<div class="'.$column_class.'">';
		}
       $cs_list_typeClass = '';
        $section_title = '';
        if ($cs_list_section_title && trim($cs_list_section_title) != '') {
            $section_title = '<div class="cs-element-title"><h2>' . $cs_list_section_title . '</h2></div>';
           $html .=  do_shortcode($section_title);
        }
        if (isset($cs_list_type) && $cs_list_type == 'numeric-icon') {
            $html .= '<ol>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'alphabetic') {
            $html .= '<ol  style="list-style-type: lower-alpha;">';
        } else
            $html .= '<ul class="' . $cs_list_typeClass . '">';

        $html .= do_shortcode($content);  // render content

        if (isset($cs_list_type) && $cs_list_type == 'numeric-icon') {
            $html .= '</ol>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'alphabetic') {
            $html .= '</ol>';
        } else {
            $html .= '</ul>';
        }
       
        //$html .= '<div class="liststyle terms-detail ' . $column_class . '">';
        if(isset($column_size) && $column_size!=''){
                   $html .= '</div>';
		}
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_LIST, 'jobcareer_list_shortcode');
    }
}

//  start Render list item functions
if (!function_exists('cs_list_item_shortcode')) {

    function cs_list_item_shortcode($atts, $content = "") {
        global $cs_border, $cs_list_icon, $cs_list_type, $counter;
        $html = '';
        $defaults = array(
            'cs_list_icon' => '',
            'cs_list_item' => '',
            'cs_list_item_icon_color' => '',
            'cs_list_item_icon_bg_color' => '',
            'cs_cusotm_class' => '',
            'cs_custom_animation' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        if ($cs_border == 'yes') {
            $border = 'has_border';
        } else {
            $border = '';
        }
        if (isset($cs_list_type) && $cs_list_type == 'icon') {
            $icon_style = '';
            $icon_bg_class = '';
            if ($cs_list_item_icon_color != '' || $cs_list_item_icon_bg_color != '') {
                $icon_bg_class = ' icon_with_bg';
                $icon_style .= ' style="';
                if ($cs_list_item_icon_color != '') {
                    $icon_style .= 'color: ' . $cs_list_item_icon_color . ' !important;';
                }
                if ($cs_list_item_icon_bg_color != '') {
                    $icon_style .= ' background-color: ' . $cs_list_item_icon_bg_color . ' !important;';
                }
                $icon_style .= '"';
            }
            $html .= '<li class="' . $border . $icon_bg_class . '" style="list-style-type:none !important;"><i' . $icon_style . ' class="' . $cs_list_icon . '"></i>' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'default') {
            $html .= '<li class="' . $border . '" style="list-style-type:none !important;">' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'built') {
            $html .= '<li class="' . $border . '" style="list-style-type:disc !important;">' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'numeric-icon') {
            $html .= '<li class="' . $border . '" > ' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'alphabetic') {
            $html .= '<li class="' . $border . '" style="list-style:lower-alpha !important;"> ' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        }

        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_LISTITEM, 'cs_list_item_shortcode');
    }
}