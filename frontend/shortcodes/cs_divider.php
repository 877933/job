<?php

/*
 *
 * @Shortcode Name : Divider
 * @retrun
 *
 */
if (!function_exists('jobcareer_divider_shortcode')) {

    function jobcareer_divider_shortcode($atts) {
        $html = '';
        $defaults = array(
            'column_size' => '',
            'divider_style' => 'crossy',
            'divider_height' => '1',
            'divider_margin_top' => '',
            'divider_margin_bottom' => '',
            'line' => 'Wide',
            'color' => '#000',
            'cs_divider_class' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        if(isset($column_size) && $column_size!=''){
                  $column_class = jobcareer_custom_column_class($column_size);
                   $html .= '<div class="'.$column_class.'">';
		}
        $column_class = jobcareer_custom_column_class($column_size);
        $divider_margin_top = isset($divider_margin_top) ? $divider_margin_top : '';
        $divider_height = isset($divider_height) ? $divider_height : '';
        $divider_margin_bottom = isset($divider_margin_bottom) ? $divider_margin_bottom : '';
        $divider_div = '<div class="spliter-medium"></div>';
        $html .= '<div style="margin-top:' . $divider_margin_top . 'px; margin-bottom:' . $divider_margin_bottom . 'px;">' . $divider_div . '</div>';
        if(isset($column_size) && $column_size!=''){
                   $html .= '</div>';
		}
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_DIVIDER, 'jobcareer_divider_shortcode');
    }
}