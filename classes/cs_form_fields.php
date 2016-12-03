<?php

/**
 * File Type: Form Fields
 */
if (!class_exists('jobcareer_form_fields')) {

    class jobcareer_form_fields {

        private $counter = 0;

        public function __construct() {
            
        }

        /**
         * 
         * @ Save Meta Box
         */
        public function cs_form_text_render($params = '') {
            global $post, $pagenow;
            extract($params);
            $cs_output = '';
            $prefix_enable = 'true'; // default value of prefix add in name and id
            if (!isset($id)) {
                $id = '';
            }
            if (!isset($std)) {
                $std = '';
            }

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'cs_'; // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } else {
                $cs_value = isset($std) ? $std : '';
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $cs_rand_id = time();

            if (isset($rand_id) && $rand_id != '') {
                $cs_rand_id = $rand_id;
            }

            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';

            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            // Disabled Field
            $cs_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }

            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }

            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . ' vsmall"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $cs_input_type = 'text';
            if (isset($cust_type) && $cust_type != '') {
                $cs_input_type = $cust_type;
            }

            $cs_before = '';
            if (isset($before) && $before != '') {
                $cs_before = '<div class="' . $before . '">';
            }

            $cs_after = '';
            if (isset($after) && $after != '') {
                $cs_after = $after;
            }

            if (isset($rang) && $rang == true && isset($min) && isset($max)) {
                $cs_output .= '<ul><li class="to-field"><div class="cs-drag-slider" data-slider-min="' . $min . '" data-slider-max="' . $max . '" data-slider-step="1" data-slider-value="' . $value . '"></div>';
            }
            $cs_output .= $cs_before;
            if (isset($extra_markup) && $extra_markup != '') {
                $cs_output .= $extra_markup;
            }
            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }
            $cs_output .= '<input type="' . $cs_input_type . '" ' . $cs_visibilty . $cs_required . ' ' . $extra_atributes . ' ' . $cs_classes . ' ' . $html_id . $html_name . ' value="' . $value . '" />';
            $cs_output .="</li></ul>";
            $cs_output .= $cs_after;

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Radio field
         */
        public function cs_form_radio_render($params = '') {

            global $post, $pagenow;
            extract($params);

            $cs_output = '';

            if (!isset($id)) {
                $id = '';
            }

            $prefix_enable = 'true';    // default value of prefix add in name and id

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'cs_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } else {
                $cs_value = isset($std) ? $std : '';
            }

            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            } else {
                $html_id = '';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $checked = isset($cs_value) && $cs_value == $std ? ' checked="checked"' : '';

            // Disbaled Field
            $cs_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }
            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }

            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }
            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }
            $cs_output .= '<input type="radio" ' . $cs_visibilty . $cs_required . ' ' . $cs_classes . ' ' . $extra_atributes . ' ' . $html_id . $html_name . ' value="' . sanitize_text_field($std) . '" />';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Hidden field
         */
        public function cs_form_hidden_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_rand_id = time();

            if (!isset($id)) {
                $id = '';
            }

            $html_id = ' id="cs_' . sanitize_html_class($id) . '"';
            $html_name = ' name="cs_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_name = ' name="cs_' . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }

            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }

            $cs_output = '<input type="hidden" ' . $html_id . ' ' . $cs_classes . ' ' . $html_name . ' value="' . sanitize_text_field($std) . '" />';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render submit field
         */
        public function cs_form_submit_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_rand_id = time();

            if (!isset($id)) {
                $id = '';
            }

            $html_id = ' id="cs_' . sanitize_html_class($id) . '"';
            $html_name = ' name="cs_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_name = ' name="cs_' . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }
            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }
            $cs_output = '<input type="submit" ' . $html_id . ' ' . $extra_atributes . ' ' . $cs_classes . ' ' . $html_name . ' value="' . sanitize_text_field($std) . '" />';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Date field
         */
        public function cs_form_date_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_output = '';

            $cs_format = 'd-m-Y';
            $prefix_enable = 'true';

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'cs_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if (isset($format) && $format != '') {
                $cs_format = $format;
            }

            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } else {
                $cs_value = isset($std) ? $std : '';
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }


            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            // disable attribute
            $cs_disabled = '';
            if (isset($disabled) && $disabled == 'yes') {
                $cs_disabled = ' disabled="disabled"';
            }

            $cs_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $cs_rand_id = time();
            if (isset($rand_id) && $rand_id != '') {
                $cs_rand_id = $rand_id;
            }

            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';

            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            $cs_piker_id = $id;

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
                $cs_piker_id = $id . $cs_rand_id;
            }

            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }

            $cs_output .= '<script>
                                jQuery(function(){
                                    jQuery("#' . $prefix . $cs_piker_id . '").datetimepicker({
                                        format:"' . $cs_format . '",
                                        timepicker:false
                                    });
                                });
                          </script>';
            $cs_output .= '<div class="input-sec">';
            $cs_output .= '<input type="text"' . $cs_visibilty . $cs_required . ' ' . $cs_disabled . ' ' . $extra_atributes . ' ' . $cs_classes . ' ' . $html_id . $html_name . '  value="' . sanitize_text_field($value) . '" />';
            $cs_output .= '</div>';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Textarea field
         */
        public function cs_form_textarea_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_output = '';
            if (!isset($id)) {
                $id = '';
            }
            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
                }
            } else {
                $cs_value = $std;
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_rand_id = time();

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $html_id = ' id="cs_' . sanitize_html_class($id) . '"';
            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="cs_cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="cs_' . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="cs_' . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_name = ' name="cs_' . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            $cs_before = '';
            if (isset($before) && $before != '') {
                $cs_before = '<div class="' . $before . '">';
            }

            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }

            $cs_after = '';
            if (isset($after) && $after != '') {
                $cs_after = '</div>';
            }

            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }

            $cs_output .= $cs_before;
            $cs_output .= ' <textarea' . $cs_required . ' ' . $cs_classes . ' ' . $extra_atributes . ' ' . $html_id . $html_name . '>' . ($value) . '</textarea>';
            $cs_output .= $cs_after;

            if (isset($return) && $return == true) {
                return $cs_output;
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render select field
         */
        public function cs_form_select_render($params = '') {
            global $post, $pagenow;
            extract($params);
            $prefix_enable = 'true';
            if (!isset($id)) {
                $id = '';
            }
            $cs_output = '';

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'cs_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }

            $cs_onchange = '';

            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } else {
                $cs_value = $std;
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_rand_id = time();
            if (isset($rand_id) && $rand_id != '') {
                $cs_rand_id = $rand_id;
            }

            $html_wraper = ' id="wrapper_' . sanitize_html_class($id) . '"';
            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';
            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . ']"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            }

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
                $html_wraper = ' id="wrapper_' . sanitize_html_class($id) . $cs_rand_id . '"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $cs_display = '';
            if (isset($status) && $status == 'hide') {
                $cs_display = 'style=display:none';
            }

            if (isset($onclick) && $onclick != '') {
                $cs_onchange = 'onchange="' . $onclick . '"';
            }

            $cs_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }
            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if (isset($markup) && $markup != '') {
                $cs_output .= $markup;
            }

            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }

            $cs_output .= '<select ' . $cs_visibilty . $cs_required . ' ' . $extra_atributes . ' ' . $cs_classes . $html_id . $html_name . ' ' . $cs_onchange . $cs_required . '>';
            if (isset($options_markup) && $options_markup == true) {
                $cs_output .= $options;
            } else {
                if (is_array($options)) {
                    foreach ($options as $key => $option) {
                        if (!is_array($option)) {
                            $cs_output .= '<option ' . selected($key, $value, false) . 'value="' . $key . '">' . $option . '</option>';
                        }
                    }
                }
            }
            $cs_output .= '</select>';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Multi Select field
         */
        public function cs_form_multiselect_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_output = '';

            $prefix_enable = 'true';
            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'cs_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            $cs_onchange = '';

            if ($pagenow == 'post.php' && $id != '') {
                if (isset($cus_field) && $cus_field == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, $prefix . $id, true);
                }
            } else {
                $cs_value = $std;
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }


            $cs_rand_id = time();
            if (isset($rand_id) && $rand_id != '') {
                $cs_rand_id = $rand_id;
            }
            $html_wraper = ' id="wrapper_' . sanitize_html_class($id) . '"';
            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';
            if (isset($cus_field) && $cus_field == true) {
                $html_name = ' name="' . $prefix . 'cus_field[' . sanitize_html_class($id) . '][]"';
            } else {
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $cs_display = '';
            if (isset($status) && $status == 'hide') {
                $cs_display = 'style=display:none';
            }

            if (isset($onclick) && $onclick != '') {
                $cs_onchange = 'onchange="javascript:' . $onclick . '(this.value, \'' . esc_js(admin_url('admin-ajax.php')) . '\')"';
            }

            if (!is_array($value) && $value != '') {
                $value = explode(',', $value);
            }

            if (!is_array($value)) {
                $value = array();
            }

            // Disbaled Field
            $cs_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }
            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="multiple ' . $classes . '"';
            } else {
                $cs_classes = ' class="multiple"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }

            $cs_output .= '<select' . $cs_visibilty . $cs_required . ' ' . $extra_atributes . ' ' . $cs_classes . ' ' . ' multiple="multiple" ' . $html_id . $html_name . ' ' . $cs_onchange . ' style="height:110px !important;">';

            if (isset($options_markup) && $options_markup == true) {
                $cs_output .= $options;
            } else {
                foreach ($options as $key => $option) {
                    $selected = '';
                    if (in_array($key, $value)) {
                        $selected = 'selected="selected"';
                    }

                    $cs_output .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
                }
            }
            $cs_output .= '</select>';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Checkbox field
         */
        public function cs_form_checkbox_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $std = isset($std) ? $std : '';
            if (!isset($prefix_enable))
                $prefix_enable = 'true';    // default value of prefix add in name and id

            $cs_output = '';

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            if (!isset($id)) {
                $id = '';
            }

            $prefix = 'cs_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }
            if ($pagenow == 'post.php' && $id != '') {
                $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            } else {
                $cs_value = $std;
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_rand_id = time();

            $html_id = ' id="' . $prefix . sanitize_html_class($id) . '"';
            $btn_name = ' name="' . $prefix . sanitize_html_class($id) . '"';
            $html_name = ' name="' . $prefix . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_id = ' id="' . $prefix . sanitize_html_class($id) . $cs_rand_id . '"';
                $btn_name = ' name="' . $prefix . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_name = ' name="' . $prefix . sanitize_html_class($id) . '_array[]"';
            }

            if (isset($cust_id) && $cust_id != '') {
                $html_id = ' id="' . $cust_id . '"';
            }

            if (isset($cust_name)) {
                if ($cust_name == '') {
                    $html_name = '';
                } else {
                    $html_name = ' name="' . $cust_name . '"';
                }
            }

            $checked = isset($value) && $value == 'on' ? ' checked="checked"' : '';
            // Disbaled Field
            $cs_visibilty = '';
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }
            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            if ($html_id == ' id=""' || $html_id == ' id="cs_"') {
                $html_id = '';
            }

            if (isset($simple) && $simple == true) {
                if ($value != '') {
                    $cs_output .= '<input type="checkbox" ' . $html_id . $html_name . ' ' . $cs_classes . ' ' . $checked . ' value="' . $value . '"' . $extra_atributes . ' />';
                } else {
                    $cs_output .= '<input type="checkbox" ' . $html_id . $html_name . ' ' . $cs_classes . ' ' . $checked . $extra_atributes . ' />';
                }
            } else {
                $cs_output .= '<label class="pbwp-checkbox cs-chekbox">';
                $cs_output .= '<input type="hidden"' . $html_name . ' value="' . $value . '" ' . $html_id . ' />';
                $cs_output .= '<input type="checkbox" class="myClass" ' . $btn_name . $checked . ' ' . $html_id . ' ' . $extra_atributes . ' />';
                $cs_output .= '<span class="pbwp-box"></span>';
                $cs_output .= '</label>';
            }

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Checkbox With Input Field
         */
        public function cs_form_checkbox_with_field_render($params = '') {
            global $post, $pagenow;
            extract($params);
            extract($field);
            $prefix_enable = 'true';    // default value of prefix add in name and id

            if (isset($prefix_on)) {
                $prefix_enable = $prefix_on;
            }

            $prefix = 'cs_';    // default prefix
            if (isset($field_prefix) && $field_prefix != '') {
                $prefix = $field_prefix;
            }
            if ($prefix_enable != true) {
                $prefix = '';
            }

            $cs_value = get_post_meta($post->ID, $prefix . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_input_value = get_post_meta($post->ID, $prefix . $field_id, true);
            if (isset($cs_input_value) && $cs_input_value != '') {
                $input_value = $cs_input_value;
            } else {
                $input_value = $field_std;
            }

            $cs_visibilty = ''; // Disbaled Field
            if (isset($active) && $active == 'in-active') {
                $cs_visibilty = 'readonly="readonly"';
            }
            $cs_required = '';
            if (isset($required) && $required == 'yes') {
                $cs_required = ' required="required"';
            }
            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = ' class="' . $classes . '"';
            }
            $extra_atributes = '';
            if (isset($extra_atr) && $extra_atr != '') {
                $extra_atributes = $extra_atr;
            }

            $cs_output .= '<label class="pbwp-checkbox">';
            $cs_output .= $this->cs_form_hidden_render(array('id' => $id, 'std' => '', 'type' => '', 'return' => 'return'));
            $cs_output .= '<input type="checkbox" ' . $cs_visibilty . $cs_required . ' ' . $extra_atributes . ' ' . $cs_classes . ' ' . ' name="' . $prefix . sanitize_html_class($id) . '" id="' . $prefix . sanitize_html_class($id) . '" value="' . sanitize_text_field('on') . '" ' . checked('on', $value, false) . ' />';
            $cs_output .= '<span class="pbwp-box"></span>';
            $cs_output .= '</label>';
            $cs_output .= '<input type="text" name="' . $prefix . sanitize_html_class($field_id) . '"  value="' . sanitize_text_field($input_value) . '">';
            $cs_output .= $this->cs_form_description($description);

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render File Upload field
         */
        public function cs_media_url($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_output = '';

            $cs_value = isset($post->ID) ? get_post_meta($post->ID, 'cs_' . $id, true) : '';
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_rand_id = time();

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $html_id = ' id="cs_' . sanitize_html_class($id) . '"';
            $html_id_btn = ' id="cs_' . sanitize_html_class($id) . '_btn"';
            $html_name = ' name="cs_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $html_id = ' id="cs_' . sanitize_html_class($id) . $cs_rand_id . '"';
                $html_id_btn = ' id="cs_' . sanitize_html_class($id) . $cs_rand_id . '_btn"';
                $html_name = ' name="cs_' . sanitize_html_class($id) . '_array[]"';
            }
            $cs_output .= '<input type="text" class="cs-form-text cs-input" ' . $html_id . $html_name . ' value="' . sanitize_text_field($value) . '" />';
            $cs_output .= '<label class="cs-browse">';
            $cs_output .= '<input type="button" ' . $html_id_btn . $html_name . ' class="uploadfile left" value="' . esc_html__('Browse', 'jobcareer') . '"/>';
            $cs_output .= '</label>';

            if (isset($return) && $return == true) {
                return $cs_output;
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render File Upload field
         */
        public function cs_form_fileupload_render($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_output = '';

            $cs_prefix = 'cs_';
            if (isset($prefix)) {
                $cs_prefix = $prefix;
            }

            if ($pagenow == 'post.php' && $id != '') {

                if (isset($dp) && $dp == true) {
                    $cs_value = get_post_meta($post->ID, $id, true);
                } else {
                    $cs_value = get_post_meta($post->ID, $cs_prefix . $id, true);
                }
            } else {
                $cs_value = $std;
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
                if (isset($dp) && $dp == true) {
                    $value = cs_get_img_url($cs_value, 'jobcareer_media_5');
                } else {
                    $value = $cs_value;
                }
            } else {
                $value = $std;
            }

            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }

            $btn_name = ' name="' . $cs_prefix . sanitize_html_class($id) . '"';
            $html_id = ' id="' . $cs_prefix . sanitize_html_class($id) . '"';
            $html_name = ' name="' . $cs_prefix . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $btn_name = ' name="' . $cs_prefix . sanitize_html_class($id) . $cs_random_id . '"';
                $html_id = ' id="' . $cs_prefix . sanitize_html_class($id) . $cs_random_id . '"';
                if (isset($array_txt) && $array_txt == false) {
                    $html_name = ' name="' . $cs_prefix . sanitize_html_class($id) . '[]"';
                } else {
                    $html_name = ' name="' . $cs_prefix . sanitize_html_class($id) . '_array[]"';
                }
            } else if (isset($dp) && $dp == true) {
                $html_name = ' name="' . sanitize_html_class($id) . '"';
            }

            if (isset($cust_name) && $cust_name <> '') {
                $html_name = ' name="' . sanitize_html_class($cust_name) . $cs_random_id . '"';
            }

            if (isset($value) && $value != '') {
                $display_btn = ' style=display:none';
            } else {
                $display_btn = ' style=display:block';
            }

            // new
            if (is_array($value)) {
                $value = $value[0];
            }
            $cs_output .= '<input' . $html_id . $html_name . 'type="hidden" class="" value="' . $value . '"/>';
            $cs_output .= '<label' . $display_btn . ' class="browse-icon"><input ' . $btn_name . ' type="button" value="' . esc_html__("Browse", 'jobcareer') . '" class="jobcareer_uploadMedia left vsmall">
			</label>';


            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render cvupload Upload field
         */
        public function cs_form_cvupload_render($params = '') {
            global $post, $pagenow;
            extract($params);

            if ($pagenow == 'post.php' && $id != '') {
                $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            } else {
                $cs_value = $std;
            }

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            if (isset($value) && $value != '') {
                $display = 'style=display:block';
            } else {
                $display = 'style=display:none';
            }

            $cs_random_id = CS_FUNCTIONS()->cs_rand_id();

            $btn_name = ' name="cs_' . sanitize_html_class($id) . '"';
            $html_id = ' id="cs_' . sanitize_html_class($id) . '"';
            $html_name = ' name="cs_' . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $btn_name = ' name="cs_' . sanitize_html_class($id) . $cs_random_id . '"';
                $html_id = ' id="cs_' . sanitize_html_class($id) . $cs_random_id . '"';
                $html_name = ' name="cs_' . sanitize_html_class($id) . '_array[]"';
            }

            $cs_output = '<ul class="form-elements">';
            $cs_output .= $this->cs_form_label($name);
            $cs_output .= '<li class="to-field">';
            $cs_output .= '<div class="page-wrap" ' . $display . ' id="cs_' . sanitize_html_class($id) . '_box">';
            $cs_output .= '<div class="gal-active">';
            $cs_output .= '<div class="dragareamain" style="padding-bottom:0px;">';
            $cs_output .= '<ul id="gal-sortable">';
            $cs_output .= '<li class="ui-state-default" id="">';
            $cs_output .= '<div class="thumb-secs" id="cs_' . sanitize_html_class($id) . '_img"> ' . basename($value);
            $cs_output .= '<div class="gal-edit-opts"><a href="javascript:del_media(\'cs_' . sanitize_html_class($id) . '\')" class="delete"></a> </div>';
            $cs_output .= '</div>';
            $cs_output .= '</li>';
            $cs_output .= '</ul>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            $cs_output .= '<input' . $html_id . $html_name . 'type="hidden" class="" value="' . $value . '"/>';
            $cs_output .= '<label class="browse-icon col-xs-cs"><input' . $btn_name . 'type="button" class="jobcareer_uploadMedia left vsmall" value="' . esc_html__("Browse", 'jobcareer') . '"/></label>';
            $cs_output .= '</li>';
            $cs_output .= '</ul>';

            if (isset($return) && $return == true) {
                return force_balance_tags($cs_output);
            } else {
                echo force_balance_tags($cs_output);
            }
        }

        /**
         * @ render Random String
         */
        public function jobcareer_generate_random_string($length = 3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

    }

    $cs_form_fields_vars = array('jobcareer_form_fields');
    $cs_form_fields_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_form_fields_vars);
    extract($cs_form_fields_vars);

    $jobcareer_form_fields = new jobcareer_form_fields();
}