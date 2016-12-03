<?php

/*
 *
 * @Shortcode Name : Slider
 * @retrun
 *
 */
if (!function_exists('jobcareer_slider_shortcode')) {

    function jobcareer_slider_shortcode($atts) {
        $defaults = array(
            'column_size' => '1/1',
            'cs_slider_header_title' => '',
            'cs_slider_id' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        ob_start();

        $html = '';
        if (isset($cs_slider_header_title) && $cs_slider_header_title <> '') {
            $html .= '<div class="col-md-12"><div class="cs-element-title"><h2>' . $cs_slider_header_title . '</h2></div></div>';
        }
        $html .= do_shortcode('[rev_slider ' . $cs_slider_id . ']');
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_SLIDER, 'jobcareer_slider_shortcode');
    }
}