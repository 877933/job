<?php

/*
 *
 * @Shortcode Name : Mutli Counter
 * @retrun
 *
 */

if (!function_exists('jobcareer_multi_counters_shortcode')) {

    function jobcareer_multi_counters_shortcode($atts, $content = null) {
        global $cs_multi_counters_view, $rand_id, $cs_multi_counters_title_color, $cs_multi_counters_number_color, $cs_multi_counters_icon_color;

        $defaults = array(
            'column_size' => '1/1',
            'cs_multi_counters_section_title' => '',
            'cs_multi_counters_view' => 'fancy',
            'cs_multi_counters_title_color' => '',
            'cs_multi_counters_number_color' => '',
            'cs_multi_counters_icon_color' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $rand_id = rand(98, 56666);
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $section_title = '';
        jobcareer_counter_script();
        $rand_id = rand(9228, 96666);
        $html .= '
		<script type="text/javascript">
		  jQuery(document).ready(function( $ ) {
			jQuery(".cs-counter-' . $rand_id . '").counterUp({
			delay: 10,
			time: 1000
			});
		  });
		</script>';


        $cs_multi_counters_view = isset($cs_multi_counters_view) ? $cs_multi_counters_view : '';
        
        if ($cs_multi_counters_view == 'fancy') {
            $html .= '<div class="' . $column_class . '">';
            $html .= '<div class="row">';
            if (isset($cs_multi_counters_section_title) and $cs_multi_counters_section_title <> '') {
                $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="cs-column-text">';
                $html .= '<h2>' . $cs_multi_counters_section_title . '</h2>';
                $html .= '</div>';
                $html .= '</div>';
            }
            $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="cs-counter simple">
                                <ul class="dashboard-list">';
            $html .= do_shortcode($content);
            $html .= '</ul>
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            $html .= '<div class="' . $column_class . '">';
            if (isset($cs_multi_counters_section_title) and $cs_multi_counters_section_title <> '') {
                $html .= '<div class="cs-element-title">';
                $html .= '<h2>' . $cs_multi_counters_section_title . '</h2>';
                $html .= '</div>';
            }
            $html .= '<div class="cs-counter inner">';
            $html .= '<ul class="dashboard-list">';
            $html .= do_shortcode($content);
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
        }


        

        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTICOUNTERS, 'jobcareer_multi_counters_shortcode');
    }
}
/*
 *
 * @Shortcode Name : Mutli Counter Item
 * @retrun
 *
 */
if (!function_exists('cs_multi_counters_item')) {

    function cs_multi_counters_item($atts, $content = null) {
        
        global $cs_multi_counters_view, $rand_id, $cs_multi_counters_title_color, $cs_multi_counters_number_color, $cs_multi_counters_icon_color;
        $output = '';
        $defaults = array(
            'counter_icon' => '',
            'counter_numbers' => '',
            'counter_title' => '',
            'counter_text_content' => '',
        );
        
        extract(shortcode_atts($defaults, $atts));
        
        $counter_text_content =  (isset($counter_text_content) && $counter_text_content != '')? $counter_text_content : $content;
        $figure = '';
        $html = '';

        if ($cs_multi_counters_view == 'fancy') {
            $output .= '<li>';
            $output .= '<i class="' . $counter_icon . '" style="color:' . $cs_multi_counters_icon_color . ';"></i>';
            $output .= '<div class="cs-text">';
            $output .= '<span style="color: ' . $cs_multi_counters_number_color . ';" class="cs-counter-' . $rand_id . '">' . $counter_numbers . '</span>';
            $output .= '<em style="color:' . $cs_multi_counters_title_color . '">' . $counter_title . '</em>';
            if ($counter_text_content != '') {
                $output .= '<p>' . $counter_text_content . '</p>';
            }
            $output .= '</div>';
            $output .= '</li>';
        } else {
            $output .= '<li>';
            $output .= '<i class="' . $counter_icon . '" style="color:' . $cs_multi_counters_icon_color . ';"></i>';
            $output .= '<div class="cs-text">';
            $output .= '<span style="color: ' . $cs_multi_counters_number_color . ';" class="cs-counter-' . $rand_id . '">' . $counter_numbers . '</span>';
            $output .= '<em style="color:' . $cs_multi_counters_title_color . '">' . $counter_title . '</em>';
            if ($counter_text_content != '') {
                $output .= '<p>' . $counter_text_content . '</p>';
            }
            $output .= '</div>';
            $output .= '</li>';
        }
        return $output;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTICOUNTERSITEM, 'cs_multi_counters_item');
    }
}