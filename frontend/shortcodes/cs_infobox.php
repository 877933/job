<?php

/*
 *
 * @Shortcode Name : Infobox
 * @retrun
 *
 */
if (!function_exists('jobcareer_infobox_shortcode')) {

    function jobcareer_infobox_shortcode($atts, $content = "") {
		global $cs_infobox_list_text_color,$cs_infobox_list_color,$cs_infobox_list_content_color;
        $defaults = array(
            'column_size' => '',
            'cs_infobox_section_title' => '',
            'cs_infobox_title' => '',
            'cs_infobox_bg_color' => '',
            'cs_infobox_list_color' => '',
            'cs_infobox_list_text_color' => '',
            'cs_infobox_list_content_color' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        if (isset($column_size) && $column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
            $html .='<div class="' . $column_class . '">';
        }
        $cs_infobox_list_text_color_style = '';
        if ($cs_infobox_list_text_color != '') {
            $cs_infobox_list_text_color_style = 'style="color: ' . $cs_infobox_list_text_color . ' !important;"';
        }
		$cs_infobox_title = isset($cs_infobox_title) ? $cs_infobox_title : '';
        $section_title = '';
        if ($cs_infobox_section_title && trim($cs_infobox_section_title) != '') {
            $section_title = '<h3>' . $cs_infobox_section_title . '</h3>';
        }
        $cs_infobox_bg_color_style = '';
        if ($cs_infobox_bg_color != '') {
            $cs_infobox_bg_color_style = 'style="background-color: ' . $cs_infobox_bg_color . '"';
        }
        $html.='<div class="contact-info"  ' . $cs_infobox_bg_color_style . '>';
        $html .= '<div class="cs-element-title"><h2>' . $cs_infobox_title . '</h2></div>';
        $html .='<ul>';
        $html .= do_shortcode($content);
        $html .='</ul>
			</div>';
        if (isset($column_size) && $column_size != '') {
            $html .='</div>';
        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_INFOBOX, 'jobcareer_infobox_shortcode');
    }
}
/*
 *
 * @Infobox Item
 * @retrun
 *
 */
if (!function_exists('cs_infobox_item_shortcode')) {

    function cs_infobox_item_shortcode($atts, $content = "") {
        global $cs_infobox_list_text_color,$cs_infobox_list_color,$cs_infobox_list_content_color;
        $html = '';
        $cs_infobox_icon_color_style = '';
        $defaults = array('cs_infobox_list_icon' => '', 'cs_infobox_list_title' => '');
        extract(shortcode_atts($defaults, $atts));
        if (isset($cs_infobox_list_title) && $cs_infobox_list_title <> "") {
            $cs_infobox_list_title = $cs_infobox_list_title . ':';
        }
        if ($cs_infobox_list_color != '') {
            $cs_infobox_icon_color_style = 'style="color: ' . $cs_infobox_list_color . '"';
        }
        $html .= '<li>
                    <div class="contact-icon"><span style="color:' . $cs_infobox_list_color . '" class="' . $cs_infobox_list_icon . '" ' . $cs_infobox_icon_color_style . '></span></div>
                    <div class="contact-label">
						<p>
						  <strong style="color:' . $cs_infobox_list_text_color . '">' . $cs_infobox_list_title . '</strong>
						  <span style="color:' . $cs_infobox_list_content_color . ' !important;">
						  ' . do_shortcode($content) . '
						  </span>
						</p>
                    </div>
                </li>';
        return $html;
    }

    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_INFOBOXITEM, 'cs_infobox_item_shortcode');
}
