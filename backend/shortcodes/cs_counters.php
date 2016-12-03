<?php

/*
 *
 * @Shortcode Name : Counters
 * @retrun
 *
 */
if (!function_exists('jobcareer_counter_item_shortcode')) {

    function jobcareer_counter_item_shortcode($atts, $content = null) {
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        $html = "<p class='cs-deprecated'><i class='icon-warning2'></i> " . __("'COUNTER' Page Builder element Replaced By multi counter in Current Theme Version. Please add it again.", 'jobcareer') . "</p>";
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code('cs_counter', 'jobcareer_counter_item_shortcode');
    }
}