<?php

/*
 *
 * @Shortcode Name : Counters
 * @retrun
 *
 */
if (!function_exists('jobcareer_counter_item_shortcode')) {

    function jobcareer_counter_item_shortcode($atts, $content = null) {
        global $counter_style, $post;
        extract(shortcode_atts(array(
            'column_size' => '',
            'counter_style' => '',
            'counter_icon_type' => '',
            'cs_counter_logo' => '',
            'counter_icon' => '',
            'counter_icon_align' => '',
            'counter_icon_size' => '',
            'counter_icon_color' => '#21cdec',
            'counter_numbers' => '',
            'counter_number_color' => '#333333',
            'counter_title' => '',
            'counter_text_color' => '#818181',
            'counter_border_color' => '#ffffff',
            'counter_border' => '',
          ), $atts));

        $column_class = jobcareer_custom_column_class($column_size);
        $rand_id = rand(12398, 56666);
        $output = '';
        $counter_style_class = '';
        $pattren_bg = '';
        $has_border = '';
        $output = '';
        $border_class = '';
        $output .= '
                <script>
                    jQuery(document).ready(function($){
						"use strict";
                        jQuery(".custom-counter-' . esc_js($rand_id) . '").counterUp({
                            delay: 10,
                            time: 1000
                        });
                    });    
                </script>';
        $combine_counter_icon = '';
        $counter_numbers = is_numeric($counter_numbers) ? number_format($counter_numbers) : $counter_numbers;
        if ($counter_icon_type == 'icon' && $counter_icon <> '') {
            $combine_counter_icon = '<i class="' . $counter_icon . ' ' . $counter_icon_size . '" style=" color: ' . $counter_icon_color . '; "></i>';
        } else if ($counter_icon_type == 'image' && $cs_counter_logo <> '') {
            $combine_counter_icon = '<img src="' . esc_url($cs_counter_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '">';
        }
        $counter_style_class = 'cs-counter count-boxy ' . $counter_icon_align;
        $output .= '<figure>';
        $output .= $combine_counter_icon;
        $output .= '</figure>';
        $output .='<div class="cs-text">';
        
        if ($counter_numbers <> '') {
            
            $output .= '<a class="cs-numcount custom-counter-' . $rand_id . '" style=" color: ' . $counter_number_color . ';">' . $counter_numbers . '</a>';
        }
        if ($counter_title <> '') {
            $output .= '<p style="color:' . $counter_text_color . ';">' . $counter_title . '</p>';
        }
        $output .='</div>';
        $html = '<div><article style="border:7px solid ' . $counter_border_color . ' " class="' . $counter_style_class . ' ' . $border_class . '">' . $output . '</article>
          </div>';
        
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_COUNTERS, 'jobcareer_counter_item_shortcode');
    }
}