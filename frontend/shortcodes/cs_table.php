<?php

/*
 *
 * @Shortcode Name : Start function for Table shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_table_shortcode_func')) {

    function jobcareer_table_shortcode_func($atts, $content = "") {
        global $table_style;
        $defaults = array('table_style' => '', 'cs_table_section_title' => '', 'column_size' => '1/1', 'cs_table_class' => '');
        extract(shortcode_atts($defaults, $atts));
        
        if (isset($column_size) && $column_size != '') {
            if (function_exists('jobcareer_custom_column_class')) {
                $column_class = jobcareer_custom_column_class($column_size);
            }
        }
        $html = '';
        if (isset($column_class) && $column_class <> '') {
            $html .= '<div class="' . $column_class . '">';
        }
        $section_title = '';
        if (isset($cs_table_section_title) && trim($cs_table_section_title) <> '') {
            $section_title = '<div class="cs-element-title"><h2>' . $cs_table_section_title . '</h2></div>';
        }
            $html .= '<div class="cs-pricing-table table-responsive ' . sanitize_html_class($cs_table_class) . '">' . $section_title . do_shortcode($content) . '</div>';
        if (isset($column_class) && $column_class <> '') {
            $html .= ' </div>';
        }
        return $html;
    }

    echo '';
    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLES, 'jobcareer_table_shortcode_func');
    }
}
/*
 *
 * @Shortcode Name : Start function for Table shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_table_shortcode')) {

    function cs_table_shortcode($atts, $content = "") {
        global $table_style;
        $defaults = array('column_size' => '1/1', 'cs_table_section_title' => '', 'cs_table_content' => '', 'cs_table_class' => '');
        extract(shortcode_atts($defaults, $atts));
        $content = str_replace('<br />', '', $content);
        $table_data = '';
        $cs_class = '';
        return $table_data . '<table class="table ">' . do_shortcode($content) . '</table>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLE, 'cs_table_shortcode');
    }
}

/*
 *
 * @Shortcode Name : Start function for Table Body  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_table_body_shortcode')) {

    function cs_table_body_shortcode($atts, $content = "") {
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        return '<tbody>' . do_shortcode($content) .
                '</tbody>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLEBODY, 'cs_table_body_shortcode');
    }
}
/*
 *
 * @Shortcode Name : Start function for Table Head  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_table_head_shortcode')) {

    function cs_table_head_shortcode($atts, $content = "") {
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        return '<thead>' . do_shortcode($content) . '</thead>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLEHEAD, 'cs_table_head_shortcode');
    }
}
/*
 *
 * @Shortcode Name : Start function for Table Row  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_table_row_shortcode')) {

    function cs_table_row_shortcode($atts, $content = "") {
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        return '<tr>' . do_shortcode($content) . '</tr>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLEROW, 'cs_table_row_shortcode');
    }
}

/*
 *
 * @Shortcode Name :Start function for Table Heading  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_table_heading_shortcode')) {

    function cs_table_heading_shortcode($atts, $content = "") {
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        $html = '';
        $html .= '<th>';
        $html .= do_shortcode($content);
        $html .= '</th>';

        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLEHEADING, 'cs_table_heading_shortcode');
    }
}

/*
 *
 * @Shortcode Name :  Start function for Table Data  shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_table_data_shortcode')) {

    function cs_table_data_shortcode($atts, $content = "") {
        $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        return '<td>' . do_shortcode($content) . '</td>';
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TABLECOLUMN, 'cs_table_data_shortcode');
    }
}