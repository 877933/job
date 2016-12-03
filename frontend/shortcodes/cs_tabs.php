<?php

/*
 *
 * @Shortcode Name :  Start function for Tabs shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_tabs_shortcode')) {

    function jobcareer_tabs_shortcode($atts, $content = null) {
        global $tabs_content;
        $tabs_content = '';
        extract(shortcode_atts(array('cs_tab_style' => '', 'cs_tabs_class' => '', 'column_size' => '', 'cs_tabs_section_title' => ''), $atts));
        $column_class='';
		if ($column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
        }
		//echo $column_class;
        $randid = rand(10000, 99999);
        $section_title = '';
        $tabs_output = '';
        if (isset($cs_tabs_section_title) && trim($cs_tabs_section_title) != '') {
            $section_title = '<div class="cs-element-title"><h2>' . $cs_tabs_section_title . '</h2></div>';
        }
        $tabs_vertical_classs = (isset($cs_tab_style) and $cs_tab_style == 'vertical') ? 'vertical' : 'nav-position-top';
        $style_class = "vertical";
        if (isset($cs_tab_style) && $cs_tab_style == 'horizontal') {
            $style_class = "horizontal";
        }
		$tabs_output .=$section_title;
        $tabs_output .= '<div class="cs-tabs ' . sanitize_html_class($style_class) . ' ' . sanitize_html_class($tabs_vertical_classs) . ' " id="cstabs' . absint($randid) . '">';
        $tabs_output .= '<ul class="nav nav-tabs" >';
        $tabs_output .= do_shortcode($content);
        $tabs_output .= '</ul>';
        $tabs_output .= ' <div class="tab-content">';
        $tabs_output .= $tabs_content;
        $tabs_output .= '</div>';
        $tabs_output .= ' </div>';
		
        return '<div  class="' . $column_class . ' ' . sanitize_html_class($cs_tabs_class) . '">' . $tabs_output . '</div>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABS, 'jobcareer_tabs_shortcode');
    }
}
/**
 *
 * @ Start function for Tabs Item shortcode/element front end view
 *
 */
if (!function_exists('cs_tab_item_shortcode')) {

    function cs_tab_item_shortcode($atts, $content = null) {
        global $tabs_content;
        $output = '';
        extract(shortcode_atts(array(
            'cs_tab_icon' => '',
            'tab_title' => '',
            'cs_tab_icon' => '',
            'tab_active' => 'no'
                        ), $atts));
        $activeClass = $tab_active == 'yes' ? 'active in' : '';
        $fa_icon = '';
        if ($cs_tab_icon) {
            $fa_icon = '<i class="' . sanitize_html_class($cs_tab_icon) . '"></i> ';
        }
        $randid = rand(877, 9999);
        $output .= '<li class="' . $activeClass . '"><a data-toggle="tab" href="#cs-tab-' . sanitize_title($tab_title) . $randid . '"  aria-expanded="true">' . $fa_icon . $tab_title . '</a></li>';
        $tabs_content .= '<div id="cs-tab-' . sanitize_title($tab_title) . $randid . '" class="tab-pane fade ' . $activeClass . '">';
        $tabs_content .= '<p>' . do_shortcode($content) . '</p>';
        $tabs_content .= '</div>';

        return $output;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABSITEM, 'cs_tab_item_shortcode');
    }
}
