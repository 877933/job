<?php

/*
 *
 * @Shortcode Name : Gallery
 * @retrun
 *
 */

if (!function_exists('jobcareer_gallery_shortcode')) {

    function jobcareer_gallery_shortcode($atts, $content = "") {
        global $post, $cs_gallery_style;
        $defaults = array(
            'column_size' => '',
            'cs_gallery_section_title' => '',
            'cs_gallery_margin_left' => '0',
            'cs_gallery_margin_right' => '0',
        );
        extract(shortcode_atts($defaults, $atts));
        $column_size = isset($column_size) ? $column_size : '';
        $margin_str = '';
        $column_class = '';
        if (isset($cs_gallery_margin_left) && $cs_gallery_margin_left) {
            $margin_str = 'margin-left:' . $cs_gallery_margin_left . 'px;';
        }
        if (isset($cs_gallery_margin_right) && $cs_gallery_margin_right) {
            $margin_str = 'margin-right:' . $cs_gallery_margin_right . 'px;';
        }
        if ($margin_str != '') {
            $margin_str = 'style="' . $margin_str . '"';
        }
        if($column_size != ''){
        $column_class = jobcareer_custom_column_class($column_size);
        }
        $owlcount = rand(40, 9999999);
        $title = "";
        if (isset($cs_gallery_section_title) && $cs_gallery_section_title <> "") {
            $title = $cs_gallery_section_title;
        }

        $html = '';
        jobcareer_gallery_masonry();
        if ($title <> "") {
            $html .= '<h2>' . esc_attr($title) . '</h2>';
        }
        $html .= '<div ' . $margin_str . ' class="cs-gallery">';
        $html .= '<ul class="gallery">';
        $html .= do_shortcode($content);
        $html .= '</ul>';
        $html .= '</div>';
        $col_div_start = '';
        $col_div_end = '';
        if ($column_class != '') {
            $col_div_start = '<div class="' . $column_class . '">';
            $col_div_end = '</div>';
        }
        return $col_div_start.$html.$col_div_end;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_GALLERY, 'jobcareer_gallery_shortcode');
    }
}

/*
 * @Gallery Item
 * @retrun
 */
if (!function_exists('cs_gallery_item_shortcode')) {

    function cs_gallery_item_shortcode($atts, $content = "") {
        global $post, $cs_gallery_style;
        $defaults = array('cs_website_url' => '', 'cs_gallery_title' => '', 'cs_gallery_logo' => '', 'cs_gallery_size' => 'img-small');
        extract(shortcode_atts($defaults, $atts));
        $randomid = rand(0, 999);

        $html = '';
        $cs_gallery_logo = isset($cs_gallery_logo) ? $cs_gallery_logo : '';
        $cs_website_url = isset($cs_website_url) ? $cs_website_url : '';
        $cs_gallery_size = isset($cs_gallery_size) ? $cs_gallery_size : '';


        $cs_url = $cs_website_url ? $cs_website_url : 'javascript:;';
        $html .= '<li class="' . esc_html($cs_gallery_size) . '"><a href="' . esc_url($cs_gallery_logo) . '" rel="prettyPhoto[0]"><img src="' . esc_url($cs_gallery_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"/></a></li>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_GALLERYITEM, 'cs_gallery_item_shortcode');
    }
}