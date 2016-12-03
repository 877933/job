<?php

/*
 *
 * @Shortcode Name : Start function for Services shortcode/element front end view 
 * @retrun
 *
 */
if (!function_exists('jobcareer_services_shortcode')) {

    function jobcareer_services_shortcode($atts, $content = null) {

        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        $html = "<p class='cs-deprecated'><i class='icon-warning2'></i> " . __("'Services' element has been deprecated but introducing new element 'Info Box' with extra features", 'jobcareer') . " </p>";
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_SERVICES, 'jobcareer_services_shortcode');
    }
}