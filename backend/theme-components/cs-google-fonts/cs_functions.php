<?php

/* * ** google font from Api *** */
/* get google font list */
$cs_fonts_vars = array('fonts');
$cs_fonts_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_fonts_vars);
extract($cs_fonts_vars);

if (!function_exists('jobcareer_googlefont_list')) {

    function jobcareer_googlefont_list() {
        global $fonts;
        $font_array = '';
        if (get_option('jobcareer_font_list') <> '' and get_option('jobcareer_font_attribute') <> '') {
            $font_array = get_option('jobcareer_font_list');
            $font_attribute = get_option('jobcareer_font_attribute');
        } else {
            $font_array = jobcareer_get_google_fontlist($fonts);
            $font_attribute = jobcareer_font_attribute($fonts);
            if (is_array($font_array) and count($font_array) > 0 and is_array($font_attribute) and count($font_attribute) > 0) {
                update_option('jobcareer_font_list', $font_array);
                update_option('jobcareer_font_attribute', $font_attribute);
            }
        }
        return $font_array;
    }

}
/* get google font array from jason */
if (!function_exists('jobcareer_get_google_fontlist')) {

    function jobcareer_get_google_fontlist($response = '') {

        if ($response && !is_array($response)) {
            $json_fonts = json_decode($response, true);
            $items = isset($json_fonts['items']) ? $json_fonts['items'] : '';
            //$response = file_get_contents($cachefile);
            $font_list = array();
            $i = 0;
            foreach ($items as $item) {
                //$key=str_replace(' ','-',$item['family']);
                $key = isset($item['family']) ? $item['family'] : '';
                $font_list[$key] = isset($item['family']) ? $item['family'] : '';
                $i++;
            }
            return $font_list;
        }
    }

}
/* get google font array from jason */
if (!function_exists('jobcareer_get_google_font_attribute')) {

    function jobcareer_get_google_font_attribute($response = '', $id = 'ABeeZee') {
        global $fonts;
        if (get_option('jobcareer_font_attribute')) {
            $font_attribute = get_option('jobcareer_font_attribute');
            if (isset($font_attribute) and $font_attribute <> '') {
                $items = isset($font_attribute[$id]) ? $font_attribute[$id] : '';
            }
        } else {
            $arrtibue_array = jobcareer_font_attribute($fonts);
            $items = isset($arrtibue_array[$id]) ? $arrtibue_array[$id] : '';
        }
        return $items;
    }

}
/** end google font from api ** */
/** Get Google font attributes ** */
add_action('wp_ajax_jobcareer_get_google_font_attributes', 'jobcareer_get_google_font_attributes');
if (!function_exists('jobcareer_get_google_font_attributes')) {

    function jobcareer_get_google_font_attributes() {
        global $fonts;
        if (isset($_POST['index']) and $_POST['index'] <> '') {
            $index = $_POST['index'];
        } else {
            $index = '';
        }
        if ($index != 'default') {
            if (get_option('jobcareer_font_attribute')) {
                $font_attribute = get_option('jobcareer_font_attribute');
                $items = isset($font_attribute[$index]) ? $font_attribute[$index] : '';
            } else {
                $json_fonts = json_decode($fonts, true);
                $items = isset($json_fonts['items'][$index]['variants']) ? $json_fonts['items'][$index]['variants'] : '';
            }
            $html = '<select class="chosen-select" id="' . $_POST['id'] . '" name="' . $_POST['id'] . '"><option value="">' . esc_html__('Select Attribute', 'jobcareer') . '</option>';
            foreach ($items as $key => $value) {
                $html .= '<option value="' . $value . '">' . $value . '</option>';
            }
            $html .= '</select>';
        } else {
            $html = '<select class="chosen-select" id="' . $_POST['id'] . '" name="' . $_POST['id'] . '"><option value="">' . esc_html__('Select Attribute', 'jobcareer') . '</option></select>';
        }
        $html .= '
	<script>
            jQuery(document).ready(function ($) {
                chosen_selectionbox();
                popup_over();
            });
	</script>';

        echo balanceTags($html, false);
        die();
    }

}
// Start font attribute function 
if (!function_exists('jobcareer_font_attribute')) {

    function jobcareer_font_attribute($fontarray = '') {
        global $fonts;
        //return $response;
        if ($fontarray && !is_array($fontarray))
            $json_fonts = json_decode($fontarray, true);
        $items = isset($json_fonts['items']) ? $json_fonts['items'] : '';
        $font_list = array();
        $i = 0;
        foreach ($items as $item) {
            $key = isset($item['family']) ? $item['family'] : '';
            $font_list[$key] = isset($item['variants']) ? $item['variants'] : '';
            $i++;
        }
        return $font_list;
    }

}
/**
 * @Set Font for Frontend
 */
if (!function_exists('jobcareer_get_font_family')) {

    function jobcareer_get_font_family($font_index = 'default', $att = 'regular') {
        global $fonts, $cs_fonts_subsets;

        if (get_option('jobcareer_font_list') <> '' and get_option('jobcareer_font_attribute') <> '') {
            $font_attribute = get_option('jobcareer_font_attribute');
        } else {
            $font_attribute = jobcareer_font_attribute($fonts);
        }

        if ($font_index != 'default') {
            $fonts = jobcareer_googlefont_list();
            $all_att = '';
            if (isset($fonts) and is_array($fonts)) {
                $name = isset($fonts[$font_index]) ? $fonts[$font_index] : '';
                $cs_subs = '';

                $cs_subsets = isset($cs_fonts_subsets[$font_index]) ? $cs_fonts_subsets[$font_index] : '';
                if (is_array($cs_subsets) && sizeof($cs_subsets) > 0) {
                    $cs_subs .= '&subset=';
                    $cs_sub_count = 1;
                    foreach ($cs_subsets as $sub_set) {
                        if ($cs_sub_count == 1) {
                            $cs_subs .= $sub_set;
                        } else {
                            $cs_subs .= ',' . $sub_set;
                        }
                        $cs_sub_count++;
                    }
                }
                $call_name = str_replace(' ', '_', $name);
                $name = str_replace(' ', '+', $name);
                $all_att = '';
                if (isset($font_attribute[$font_index]) && is_array($font_attribute[$font_index])) {
                    $font_att_counter = 1;
                    foreach ($font_attribute[$font_index] as $f_atts) {
                        if ($font_att_counter == 1) {
                            $all_att .= ':' . $f_atts;
                        } else {
                            $all_att .= ',' . $f_atts;
                        }
                        $font_att_counter++;
                    }
                }
                $url = add_query_arg('family', $name . $all_att . $cs_subs, "//fonts.googleapis.com/css");
                wp_enqueue_style('jobcareer_font_' . $call_name, $url, array(), '');
            }
        }
    }

}

/**
 * @Get font family Frontend.
 */
if (!function_exists('jobcareer_get_font_name')) {

    function jobcareer_get_font_name($font_index = 'default') {
        global $fonts;
        if ($font_index != 'default') {
            $fonts = jobcareer_googlefont_list();
            if (isset($fonts) and is_array($fonts)) {
                $name = $fonts[$font_index];
                return $name;
            }
        } else {
            return 'default';
        }
    }

}
// Start function for recursive array replace 
if (!function_exists('jobcareer_recursive_array_replace')) {

    function jobcareer_recursive_array_replace($array) {
        global $fonts;
        if (is_array($array)) {
            $new_array = array();
            for ($i = 0; $i < sizeof($array); $i++) {
                $new_array[] = $array[$i] == 'regular' ? 'Normal' : $array[$i];
            }
        }
        return $new_array;
    }

}
/**
 * @Get font family Frontend.
 */
if (!function_exists('jobcareer_get_font_att_array')) {

    function jobcareer_get_font_att_array($atts = array()) {
        global $fonts;
        $atts = jobcareer_recursive_array_replace($atts);
        if (sizeof($atts) == 1 and is_numeric($atts[0]))
            $atts = array_merge($atts, array('Normal'));
        $r_att = '';
        foreach ($atts as $att) {
            $r_att .= $att . ' ';
        }
        return $r_att;
    }

}
/**
 * @Frontend Font Printing.
 */
if (!function_exists('jobcareer_font_font_print')) {

    function jobcareer_font_font_print($atts = '', $size = '12', $line_height = '20', $f_name, $imp = false) {
        global $fonts;
        $important = '';
        $html = '';
        $f_name = jobcareer_get_font_name($f_name);
        if ($f_name == 'default' || $f_name == '') {
            if ($imp == true)
                $important = ' !important';
            if ($size > 0) {
                $html = 'font-size:' . $size . 'px' . $important . ';';
            }
        } else {
            if ($imp == true)
                $important = ' !important';
            $html = 'font:' . $atts . ' ' . $size . 'px' . ( $line_height != '' ? '/' . $line_height . 'px' : '' ) . ' "' . $f_name . '", sans-serif' . $important . ';';
        }
        return $html;
    }

}

// Start load fonts functions 

if (!function_exists('jobcareer_load_fonts')) {

    function jobcareer_load_fonts() {

        global $jobcareer_options;

        /* font family */
        $cs_content_font = (isset($jobcareer_options['cs_content_font'])) ? $jobcareer_options['cs_content_font'] : '';
        $cs_content_font_att = (isset($jobcareer_options['cs_content_font_att'])) ? $jobcareer_options['cs_content_font_att'] : '';

        $cs_mainmenu_font = (isset($jobcareer_options['cs_mainmenu_font'])) ? $jobcareer_options['cs_mainmenu_font'] : '';
        $cs_mainmenu_font_att = (isset($jobcareer_options['cs_mainmenu_font_att'])) ? $jobcareer_options['cs_mainmenu_font_att'] : '';

        $cs_heading1_font = (isset($jobcareer_options['cs_heading1_font'])) ? $jobcareer_options['cs_heading1_font'] : '';
        $cs_heading1_font_att = (isset($jobcareer_options['cs_heading1_font_att'])) ? $jobcareer_options['cs_heading1_font_att'] : '';

        $cs_heading2_font = (isset($jobcareer_options['cs_heading2_font'])) ? $jobcareer_options['cs_heading2_font'] : '';
        $cs_heading2_font_att = (isset($jobcareer_options['cs_heading2_font_att'])) ? $jobcareer_options['cs_heading2_font_att'] : '';

        $cs_heading3_font = (isset($jobcareer_options['cs_heading3_font'])) ? $jobcareer_options['cs_heading3_font'] : '';
        $cs_heading3_font_att = (isset($jobcareer_options['cs_heading3_font_att'])) ? $jobcareer_options['cs_heading3_font_att'] : '';

        $cs_heading4_font = (isset($jobcareer_options['cs_heading4_font'])) ? $jobcareer_options['cs_heading4_font'] : '';
        $cs_heading4_font_att = (isset($jobcareer_options['cs_heading4_font_att'])) ? $jobcareer_options['cs_heading4_font_att'] : '';

        $cs_heading5_font = (isset($jobcareer_options['cs_heading5_font'])) ? $jobcareer_options['cs_heading5_font'] : '';
        $cs_heading5_font_att = (isset($jobcareer_options['cs_heading5_font_att'])) ? $jobcareer_options['cs_heading5_font_att'] : '';

        $cs_heading6_font = (isset($jobcareer_options['cs_heading6_font'])) ? $jobcareer_options['cs_heading6_font'] : '';
        $cs_heading6_font_att = (isset($jobcareer_options['cs_heading6_font_att'])) ? $jobcareer_options['cs_heading6_font_att'] : '';

        $cs_section_title_font = (isset($jobcareer_options['cs_section_title_font'])) ? $jobcareer_options['cs_section_title_font'] : '';
        $cs_section_title_font_att = (isset($jobcareer_options['cs_section_title_font_att'])) ? $jobcareer_options['cs_section_title_font_att'] : '';

        $cs_page_title_font = (isset($jobcareer_options['cs_page_title_font'])) ? $jobcareer_options['cs_page_title_font'] : '';
        $cs_page_title_font_att = (isset($jobcareer_options['cs_page_title_font_att'])) ? $jobcareer_options['cs_page_title_font_att'] : '';

        $cs_post_title_font = (isset($jobcareer_options['cs_post_title_font'])) ? $jobcareer_options['cs_post_title_font'] : '';
        $cs_post_title_font_att = (isset($jobcareer_options['cs_post_title_font_att'])) ? $jobcareer_options['cs_post_title_font_att'] : '';

        $cs_widget_heading_font = (isset($jobcareer_options['cs_widget_heading_font'])) ? $jobcareer_options['cs_widget_heading_font'] : '';
        $cs_widget_heading_font_att = (isset($jobcareer_options['cs_widget_heading_font_att'])) ? $jobcareer_options['cs_widget_heading_font_att'] : '';

        $cs_ft_widget_heading_font = (isset($jobcareer_options['cs_ft_widget_heading_font'])) ? $jobcareer_options['cs_ft_widget_heading_font'] : '';
        $cs_ft_widget_heading_font_att = (isset($jobcareer_options['cs_ft_widget_heading_font_att'])) ? $jobcareer_options['cs_ft_widget_heading_font_att'] : '';

        if (
                ( isset($jobcareer_options['cs_custom_font_woff']) && $jobcareer_options['cs_custom_font_woff'] <> '' ) &&
                ( isset($jobcareer_options['cs_custom_font_ttf']) && $jobcareer_options['cs_custom_font_ttf'] <> '' ) &&
                ( isset($jobcareer_options['cs_custom_font_svg']) && $jobcareer_options['cs_custom_font_svg'] <> '' ) &&
                ( isset($jobcareer_options['cs_custom_font_eot']) && $jobcareer_options['cs_custom_font_eot'] <> '' )
        ):

            $custom_font = true;
        else: $custom_font = false;
        endif;

        if ($custom_font != true) {
            jobcareer_get_font_family($cs_content_font, $cs_content_font_att);
            jobcareer_get_font_family($cs_mainmenu_font, $cs_mainmenu_font_att);
            jobcareer_get_font_family($cs_heading1_font, $cs_heading1_font_att);
            jobcareer_get_font_family($cs_heading2_font, $cs_heading2_font_att);
            jobcareer_get_font_family($cs_heading3_font, $cs_heading3_font_att);
            jobcareer_get_font_family($cs_heading4_font, $cs_heading4_font_att);
            jobcareer_get_font_family($cs_heading5_font, $cs_heading5_font_att);
            jobcareer_get_font_family($cs_heading6_font, $cs_heading6_font_att);
            jobcareer_get_font_family($cs_section_title_font, $cs_section_title_font_att);
            jobcareer_get_font_family($cs_page_title_font, $cs_page_title_font_att);
            jobcareer_get_font_family($cs_post_title_font, $cs_post_title_font_att);
            jobcareer_get_font_family($cs_widget_heading_font, $cs_widget_heading_font_att);
            jobcareer_get_font_family($cs_ft_widget_heading_font, $cs_ft_widget_heading_font_att);
        }
    }

}