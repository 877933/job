<?php

/**
 * @Spacer html form for page builder
 */
if (!function_exists('jobcareer_spacer_shortcode')) {

    function jobcareer_spacer_shortcode($atts, $content = "") {
        global $cs_border;

        $defaults = array('cs_spacer_height' => '25','column_size'=>'',);
        extract(shortcode_atts($defaults, $atts));
        $html ='';
        if(isset($column_size) && $column_size!=''){
                  $column_class = jobcareer_custom_column_class($column_size);
                   $html .= '<div class="'.$column_class.'">';
		}
        $cs_spacer_height = $cs_spacer_height ? $cs_spacer_height : '15';
        if (isset($cs_spacer_height) and ! empty($cs_spacer_height)) {
            $html.= '<div class="col-md-12" style="height:' . do_shortcode($cs_spacer_height) . 'px !important;">
		</div>';
        }
        if(isset($column_size) && $column_size!=''){
                   $html .= '</div>';
	}
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_SPACER, 'jobcareer_spacer_shortcode');
    }
}