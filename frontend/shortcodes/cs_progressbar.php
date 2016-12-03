<?php

/*
 *
 * @Shortcode Name :  Start function for Progressbar  shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_progressbars_shortcode')) {

    function jobcareer_progressbars_shortcode($atts, $content = "") {
        global $cs_progressbars_style;
        $defaults = array(
            'column_size' => '1/1',
            'cs_progressbars_style' => 'skills-sec',
            'progressbars_element_title' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('.progress .progress-bar').css("width",
                        function () {
                            return $(this).attr("aria-valuenow") + "%";
                        }
                )
            });

        </script>
        <?php

        $output = '';
        if(isset($column_class) &&$column_class !="")
        {
        $output .= '<div class="'.$column_class.'">';
        }
        $output .= ' <section>';
        $output .= '<div class="cs-element-title">';
        $output .= '<h4> ' . esc_html($progressbars_element_title) . '</h4>';
        $output .= do_shortcode($content);
        $output .= '</div>';
                if(isset($column_class) &&$column_class !="")
        {
        $output .= '</div>';
        }

        return $output;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_PROGRESSBAR, 'jobcareer_progressbars_shortcode');
    }
}

/*
 *
 * @Shortcode Name :  Start function for Progressbar  item shortcode/element front end view
 * @retrun
 *
 */



if (!function_exists('cs_progressbar_item_shortcode')) {

    function cs_progressbar_item_shortcode($atts, $content = "") {
        global $cs_progressbars_style;
        $defaults = array('progressbars_title' => '', 'progressbars_color' => '', 'progressbars_percentage' => '50');
        extract(shortcode_atts($defaults, $atts));
        $progressbars_color = isset($progressbars_color) ? $progressbars_color : '';
        $output = '';
        $output .= '<div class="progress-info">';
        $output .= '<span>' . esc_html($progressbars_title) . '</span>';
        $output .= '<small>' . $progressbars_percentage . '%</small>';
        $output .= '</div>';
        $output .= '<div class="progress skill-bar">';
        $output .= '<div class="progress-bar progress-bar-success" style="background:' . $progressbars_color . '; " role="progressbar" aria-valuenow="' . $progressbars_percentage . '" aria-valuemin="0" aria-valuemax="100" ></div>';
        $output .= '</div>';
        return $output;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_PROGRESSBARITEM, 'cs_progressbar_item_shortcode');
    }
}
