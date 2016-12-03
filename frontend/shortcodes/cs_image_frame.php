<?php

/**
 * @Shortcode Name : Image Freame
 * @retrun
 *
 */
if (!function_exists('jobcareer_image_shortcode')) {

    function jobcareer_image_shortcode($atts, $content = "") {
        global $post;
        $defaults = array(
            'column_size' => '',
            'cs_image_section_title' => '',
            'image_style' => '',
            'cs_image_url' => '#',
            'cs_image_title' => '',
            'cs_image_caption' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $section_title = '';
        if ($cs_image_section_title && trim($cs_image_section_title) != '') {
            $section_title = '<div class="cs-element-title"><h2>' . $cs_image_section_title . '</h2></div>';
        }
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '<div class="' . $column_class . '">';
        if ($cs_image_section_title && trim($cs_image_section_title) != '') {
            $html .= '<section><h4>' . $cs_image_section_title . '</h4></section>';
        }
        $html .= '<div class="image-frame cs-img-frame">';
        if (isset($cs_image_url) && $cs_image_url != '') {
            $html .= '<figure><img src="' . esc_url($cs_image_url) . '" alt=""></figure>';
        }

        if ($cs_image_title && trim($cs_image_title) != '') {
            $html .= '<h4>' . $cs_image_title . '</h4>';
        }
        $html .= '<p>' . do_shortcode($content) . '<p>';


        $html .= '</div>';
        $html .= '</div>';
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_IMAGE, 'jobcareer_image_shortcode');
}