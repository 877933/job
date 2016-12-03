<?php
/*
 * Start class for save post meta
 */

if (!class_exists('jobcareer_meta_fields')) {

    class jobcareer_meta_fields {

        /**
         * 
         * @ Start construct for save post
         */
        public function __construct() {
            add_action('save_post', array($this, 'save_page_option'));
        }

        /**
         * 
         * @ Save Meta Box
         */
        public function save_page_option($post_id = '') {
            global $post, $jobcareer_html_fields;

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            $data = array();

            if (is_admin()) {
                foreach ($_POST as $key => $value) {
                    if (strstr($key, 'cs_')) {
                        if ($key == 'cs_transaction_expiry_date' || $key == 'cs_job_expired' || $key == 'cs_job_posted' || $key == 'cs_candidate_last_activity_date' || $key == 'cs_employer_last_activity_date') {
                            if ($key == 'cs_employer_last_activity_date' && $value == '' || $key == 'cs_candidate_last_activity_date') {
                                $value = date('d-m-Y H:i:s');
                            }
                            $data[$key] = strtotime($value);
                            update_post_meta($post_id, $key, strtotime($value));
                        } else {
                            if ($key == 'cs_cus_field') {
                                if (is_array($value) && sizeof($value) > 0) {
                                    foreach ($value as $c_key => $c_val) {
                                        update_post_meta($post_id, $c_key, $c_val);
                                    }
                                }
                            } else {
                                if ($key == 'cs_job_featured') {
                                    if (is_admin()) {
                                        $data[$key] = $value;
                                        update_post_meta($post_id, $key, $value);
                                    }
                                } else {
                                    $data[$key] = $value;
                                    update_post_meta($post_id, $key, $value);
                                }
                            }
                        }
                    }
                    if ($key == 'job_img' || $key == 'candidate_img' || $key == 'employer_img' || $key == 'cover_employer_img') {
                        update_post_meta($post_id, $key, cs_save_img_url($value));
                    }
                }

                update_post_meta($post_id, 'cs_full_data', $data);
            }
        }

        /**
         * 
         * @ render label
         */
        public function cs_form_label($name = '', $desc = '', $help_text = '') {
            global $post, $jobcareer_html_fields;
            if ($name == '') {
                $name = esc_html__('Label Not defined', 'jobcareer');
            }
            $cs_output = '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">';
            $cs_output .= '<label>' . $name;
            if ($help_text != '') {
                $cs_output.=jobcareer_tooltip_text($help_text);
            }
            $cs_output .= '</label>';
            $cs_output .= '</div>';

            return $cs_output;
        }

        /**
         * 
         * @ render label with popover
         */
        public function cs_form_label_popover($name = '', $description = '') {
            global $post, $jobcareer_html_fields;
            if ($name == '') {
                $name = esc_html__('Label Not defined', 'jobcareer');
            }
            $cs_output = '<li class="to-label">';
            $cs_output .= '<label>' . $name;
            $cs_output .= '</label>';
            if (isset($description)) {
                $cs_output .= jobcareer_tooltip_text($description);
            }
            $cs_output .= '</li>';

            return $cs_output;
        }

        /**
         * 
         * @ render description
         */
        public function cs_form_description($description = '') {
            global $post, $jobcareer_html_fields;

            if ($description == '') {
                return;
            }

            $cs_output = '<span>' . $description . '</span>';

            return $cs_output;
        }

        /**
         * 
         * @ render text field
         */
        public function cs_form_text_render($params = '') {
            global $post, $jobcareer_form_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $onblur = '';
            if ($id == 'location_address' || $id == 'loc_city' || $id == 'loc_postcode' || $id == 'loc_region') {
                $onblur = 'onBlur=gll_search_map()';
            }
            $help_text_str = '';
            if (isset($help_text) && $help_text != '') {
                $help_text_str = $help_text;
            }

            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output = '<div  ' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($help_text_str) && $help_text_str != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($help_text_str));
            }
            $cs_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_opt_array = array(
                'std' => sanitize_text_field($value),
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => 'cs-form-text cs-input' . sanitize_html_class($classes) . '',
                'extra_atr' => '',
                'cust_id' => 'cs_' . sanitize_html_class($id),
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'return' => true,
                'required' => false
            );
            $cs_output .= $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
            $cs_output .= '</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Radio field
         */
        public function cs_form_radio_render($params = '') {
            global $post, $jobcareer_form_fields, $jobcareer_html_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }
            $cs_output = '<ul class="form-elements">';
            $cs_output .= $this->cs_form_label($name, $description);
            $cs_output .= '<li class="to-field">';
            $cs_output .= '<div class="input-sec">';
            $cs_opt_array = array(
                'cust_id' => 'cs_' . sanitize_html_class($id),
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'classes' => 'cs-form-text cs-input',
                'std' => sanitize_text_field($value),
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);
            $cs_output .= '</div>';
            $cs_output .= '</li>';
            $cs_output .= '</ul>';
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Radio field
         */
        public function cs_form_layout_render($params = '') {
            global $post, $jobcareer_form_fields, $cs_form_fields, $cs_html_fields, $jobcareer_html_fields, $jobcareer_options;
            extract($params);
            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_left = $cs_right = $cs_none = $cs_left_checklist = $cs_right_checklist = $cs_none_checklist = '';
            if (isset($cs_value) && $cs_value != '') {
                if (isset($value) && $value == 'left') {
                    $cs_left = 'checked';
                    $cs_left_checklist = "class=check-list";
                } if (isset($value) && $value == 'right') {
                    $cs_right = 'checked';
                    $cs_right_checklist = "class=check-list";
                } else if (isset($value) && $value == 'none') {
                    $cs_none = 'checked';
                    $cs_none_checklist = "class=check-list";
                }
            } else {
                if (isset($post->post_type) && $post->post_type == "post") {
                    if (isset($jobcareer_options['cs_single_post_layout']) && $jobcareer_options['cs_single_post_layout'] == 'sidebar_left') {
                        $cs_left = 'checked';
                        $cs_left_checklist = "class=check-list";
                    } if (isset($jobcareer_options['cs_single_post_layout']) && $jobcareer_options['cs_single_post_layout'] == 'sidebar_right') {
                        $cs_right = 'checked';
                        $cs_right_checklist = "class=check-list";
                    } if (isset($jobcareer_options['cs_single_post_layout']) && $jobcareer_options['cs_single_post_layout'] == 'no_sidebar') {
                        $cs_none = 'checked';
                        $cs_none_checklist = "class=check-list";
                    }
                } else {
                    if (isset($jobcareer_options['cs_default_page_layout']) && $jobcareer_options['cs_default_page_layout'] == 'sidebar_left') {
                        $cs_left = 'checked';
                        $cs_left_checklist = "class=check-list";
                    } if (isset($jobcareer_options['cs_default_page_layout']) && $jobcareer_options['cs_default_page_layout'] == 'sidebar_right') {
                        $cs_right = 'checked';
                        $cs_right_checklist = "class=check-list";
                    } if (isset($jobcareer_options['cs_default_page_layout']) && $jobcareer_options['cs_default_page_layout'] == 'no_sidebar') {
                        $cs_none = 'checked';
                        $cs_none_checklist = "class=check-list";
                    }
                }
            }


            $help_text_str = '';
            if (isset($help_text) && $help_text != '') {
                $help_text_str = $help_text;
            }



            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';

            $cs_output = '<div  ' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($help_text_str) && $help_text_str != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($help_text_str));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= '<div class="input-sec">';
            $cs_output .= '<div class="meta-input pattern">';
            $cs_output .= '<div class=\'radio-image-wrapper\'>';
            $cs_opt_array = array(
                'extra_atr' => '' . $cs_none . ' onclick="show_sidebar_page(\'none\')"',
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'cust_id' => 'page_radio_1',
                'classes' => 'radio',
                'std' => 'none',
                'return' => true,
            );

            $cs_output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);
            $cs_output .= '<label for="page_radio_1">';
            $cs_output .= '<span class="ss">';
            $cs_output .= '<img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/no_sidebar.png"  alt="" />';
            $cs_output .= '</span>';
            $cs_output .= '<span ' . $cs_none_checklist . ' id="check-list"></span>';
            $cs_output .= '</label>';
            $cs_output .= '<span class="title-theme">' . esc_html__("Full Width", 'jobcareer') . '</span></div>';
            $cs_output .= '<div class=\'radio-image-wrapper\'>';

            $cs_opt_array = array(
                'extra_atr' => '' . $cs_right . ' onclick="show_sidebar_page(\'right\')"',
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'cust_id' => 'page_radio_2',
                'classes' => 'radio',
                'std' => 'right',
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);
            $cs_output .= '<label for="page_radio_2">';
            $cs_output .= '<span class="ss">';
            $cs_output .= '<img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/sidebar_right.png" alt="" />';
            $cs_output .= '</span>';
            $cs_output .= '<span ' . $cs_right_checklist . ' id="check-list"></span>';
            $cs_output .= '</label>';
            $cs_output .= '<span class="title-theme">' . esc_html__("Sidebar Right", 'jobcareer') . '</span> </div>';
            $cs_output .= '<div class=\'radio-image-wrapper\'>';

            $cs_opt_array = array(
                'cust_id' => 'page_radio_3',
                'classes' => 'radio',
                'std' => 'left',
                'extra_atr' => '' . $cs_left . ' onclick="show_sidebar_page(\'left\')"',
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);
            $cs_output .= '<label for="page_radio_3">';
            $cs_output .= '<span class="ss">';
            $cs_output .= '<img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/sidebar_left.png" alt="" />';
            $cs_output .= '</span>';
            $cs_output .= '<span ' . $cs_left_checklist . ' id="check-list"></span>';
            $cs_output .= '</label>';
            $cs_output .= '<span class="title-theme">' . esc_html__("Sidebar Left", 'jobcareer') . '</span> </div>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render text field
         */
        public function cs_form_hidden_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);

            if (isset($type) && $type != '') {
                $type = '[]';
            }

            if (isset($return) && $return == 'echo') {
                $cs_opt_array = array(
                    'std' => sanitize_text_field($std),
                    'cust_id' => 'cs_' . sanitize_html_class($id),
                    'cust_name' => 'cs_' . sanitize_html_class($id) . $type,
                    'classes' => 'cs-form-text cs-input',
                );
                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
            } else {
                $cs_opt_array = array(
                    'std' => sanitize_text_field($std),
                    'cust_id' => 'cs_' . sanitize_html_class($id),
                    'cust_name' => 'cs_' . sanitize_html_class($id) . $type,
                    'classes' => 'cs-form-text cs-input',
                );
                return $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
            }
        }

        /**
         * 
         * @ render Date field
         */
        public function cs_form_date_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_output = '<ul class="form-elements">';
            $cs_output .= '<script>
                            jQuery(function(){
                                    jQuery("#cs_' . $id . '").datetimepicker({
                                            format:"m/d/Y",
                                            timepicker:false
                                    });
                            });
                      </script>';
            $cs_output .= $this->cs_form_label($name, $description);
            $cs_output .= '<li class="to-field">';

            $cs_output .= '<div class="input-sec">';
            $cs_opt_array = array(
                'std' => sanitize_text_field($value),
                'cust_id' => 'cs_' . sanitize_html_class($id),
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'return' => true,
            );

            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
            $cs_output .= '</div>';
            $cs_output .= '</li>';
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Textarea field
         */
        public function cs_form_textarea_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);
            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);

            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }
            $help_text_str = '';
            if (isset($help_text) && $help_text != '') {
                $help_text_str = $help_text;
            }

            $cs_output = '';
            //   $cs_output .= $this->cs_form_label_popover($name, $help_text_str);


            $cs_opt_array = array(
                'name' => esc_html__('Subtitle', 'jobcareer'),
                'desc' => '',
                'hint_text' => esc_html__("Enter Subtitle Here.", 'jobcareer'),
                'echo' => true,
                'field_params' => array(
                    'std' => htmlspecialchars_decode($value),
                    'cust_id' => 'cs_' . sanitize_html_class($id) . '',
                    'classes' => 'txtfield',
                    'cust_name' => 'cs_' . sanitize_html_class($id) . '',
                    'return' => true,
                    'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                ),
            );

            $cs_output .= $jobcareer_html_fields->cs_textarea_field($cs_opt_array);

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render select field
         */
        function cs_form_select_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);
            $cs_onchange = '';

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_display = '';
            if (isset($status) && $status == 'hide') {
                $cs_display = 'style=display:none';
            }

            $onblur = '';
            if ($id == 'loc_country') {
                $onblur = 'onBlur=gll_search_map()';
            }

            $cs_classes = '';
            if (isset($classes) && $classes != '') {
                $cs_classes = $classes;
            }
            if (isset($onclick) && $onclick != '') {
                $cs_onchange = 'onchange=javascript:' . $onclick . '(this.value)';
            }
            $help_text_str = '';
            if (isset($help_text) && $help_text != '') {
                $help_text_str = $help_text;
            }
            $cs_output = ' ';
            $cs_select_option = array();

            foreach ($options as $key => $option) {

                $cs_select_option[$key] = $option;
            }

            $cs_opt_array = array(
                'name' => $name,
                'desc' => '',
                'hint_text' => $help_text_str,
                'echo' => true,
                'field_params' => array(
                    'std' => $value,
                    'id' => 'cs_' . sanitize_html_class($id) . '"  ' . $cs_classes . '',
                    'cust_name' => 'cs_' . sanitize_html_class($id) . '',
                    'cust_id' => 'cs_' . sanitize_html_class($id) . '"  ' . $cs_classes . '',
                    'classes' => $cs_classes,
                    // 'extra_atr' => 'data-placeholder="Please Select" onchange="javascript:' . $onclick . '(this.value)" ',
                    'extra_atr' => 'data-placeholder="Please Select" ' . $cs_onchange . '',
                    'options' => $cs_select_option,
                    'return' => true,
                ),
            );

            $cs_output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Multi Select field
         */
        public function cs_form_multiselect_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_output = '<ul class="form-elements" id="wrapper_' . sanitize_html_class($id) . '">';
            $cs_output .= $this->cs_form_label($name, $description);
            $cs_output .= '<li class="to-field">';
            $cs_output .= '<div class="input-sec">';
            $cs_output .= '<div class="select-style">';
            $cs_output .= '<select multiple="multiple" class="cs-fields-render" id="cs_' . sanitize_html_class($id) . '" name="cs_' . sanitize_html_class($id) . '[]" >';

            foreach ($options as $key => $option) {
                $jobcareer_selected = '';
                if (is_array($value) && in_array($key, $value)) {
                    $jobcareer_selected = ' selected="selected"';
                }
                $cs_output .= '<option' . $jobcareer_selected . ' value="' . $key . '">' . $option . '</option>';
            }
            $cs_output .= '</select>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            $cs_output .= '</li>';
            $cs_output .= '</ul>';

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Multi Select field
         */
        public function cs_heading_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_output = '<div class="theme-help" id="' . sanitize_html_class($id) . '">
                            <h4 class="cs-filed-name">' . esc_attr($name) . '</h4>
                            <div class="clear"></div>
                      </div>';
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Checkbox field
         */
        public function cs_form_checkbox_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }
            $help_text_str = '';
            if (isset($help_text) && $help_text != '') {
                $help_text_str = $help_text;
            }
            $cs_output = '';


            $cs_opt_array = array(
                'name' => $name,
                'desc' => '',
                'echo' => true,
                'hint_text' => $help_text_str,
                'field_params' => array(
                    'std' => $value,
                    'id' => sanitize_html_class($id),
                    'classes' => $classes,
                    'return' => true,
                ),
            );

            $cs_output .= $jobcareer_html_fields->cs_checkbox_field($cs_opt_array);


            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render File Upload field
         */
        public function cs_form_fileupload_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);

            $cs_opt_array = array(
                'name' => $name,
                'id' => $id,
                'std' => $std,
                'desc' => '',
                'hint_text' => isset($help_text) ? $help_text : '',
                'field_params' => array(
                    'std' => $std,
                    'id' => $id,
                    'return' => true,
                ),
            );

            $cs_output = $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render File Upload field
         */
        public function cs_form_dynamic_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_output = '<ul class="form-elements"><li class="to-label">';
            $cs_output .= cs_label_render();
            $cs_output .= '</li><li class="to-field has_input"><label class="pbwp-checkbox">';
            $cs_opt_array = array(
                'std' => sanitize_text_field($cs_value),
                'id' => sanitize_html_class($id),
                'classes' => 'myClass',
                'cust_id' => $cs_key,
                'cust_name' => $cs_key,
                'return' => true,
            );

            $cs_output .= $jobcareer_form_fields->cs_checkbox_field($cs_opt_array);
            return $cs_output;
        }

        /**
         * 
         * @ render Button field
         */
        public function cs_form_button_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);
            $cs_opt_array = array(
                'cust_name' => $cs_key,
                'cust_id' => $cs_key,
                'classes' => 'cs-form-text cs-input ',
                'std' => sanitize_text_field($cs_value),
                'return' => true,
            );

            $cs_output = $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);
            return $cs_output;
        }

        /**
         * 
         * @ render Checkbox With Input Field
         */
        public function cs_form_checkbox_with_field_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);
            extract($field);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_input_value = get_post_meta($post->ID, 'cs_' . $field_id, true);
            if (isset($cs_input_value) && $cs_input_value != '') {
                $input_value = $cs_input_value;
            } else {
                $input_value = $field_std;
            }

            $cs_output = '<ul class="form-elements">';
            $cs_output .= $this->cs_form_label($name, $description);
            $cs_output .= '<li class="to-field has_input">';
            $cs_output .= '<label class="pbwp-checkbox">';
            $cs_opt_array = array(
                'std' => $value,
                'id' => sanitize_html_class($id),
                'classes' => 'myClass',
                'cust_id' => sanitize_html_class($id),
                'cust_name' => sanitize_html_class($id),
                'return' => true,
            );

            $cs_output .= $jobcareer_form_fields->cs_checkbox_field($cs_opt_array);
            $cs_output .= '<span class="pbwp-box"></span>';
            $cs_output .= '</label>';
            $cs_opt_array = array(
                'std' => sanitize_text_field($input_value),
                'cust_name' => 'cs_' . sanitize_html_class($field_id),
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
            $cs_output .= '</li>';
            $cs_output .= '</ul>';

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Color field
         */
        public function cs_form_color_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_output = '<div class="form-elements">';
            $cs_output .= $this->cs_form_label($name, $description, $help_text);

            $cs_output .= '<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= '<div class="input-sec">';
            $cs_opt_array = array(
                'std' => sanitize_text_field($value),
                'classes' => 'cs-form-text cs-input bg_color',
                'cust_id' => 'cs_' . sanitize_html_class($id),
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'return' => true,
            );

            $cs_output .= $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Color field
         */
        public static function cs_get_id($params = '') {
            $id = str_replace(array(' ', ',', '.', '"', "'", '/', "\\", '+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', '<', '>', '?', '[', ']', '{', '}', '|', ':',), '', $params);
            $id = sanitize_html_class($id);
            return $id;
        }

        /**
         * 
         * @ render Range field
         */
        public function cs_form_range_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_opt_array = array(
                'name' => $name,
                'desc' => '',
                'hint_text' => $help_text,
                'field_params' => array(
                    'std' => sanitize_text_field($value),
                    'cust_id' => "cs_" . sanitize_html_class($id),
                    'cust_name' => "cs_" . sanitize_html_class($id),
                    'return' => true,
                    'rang' => true,
                    'min' => $min,
                    'max' => $max,
                ),
            );

            $cs_output = $jobcareer_html_fields->cs_text_field($cs_opt_array);
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render Random ID
         */
        public static function jobcareer_generate_random_string($length = 3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }

        /**
         * 
         * @ render Wrapper Start
         */
        public function cs_wrapper_start_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);
            $cs_display = '';
            if (isset($status) && $status == 'hide') {
                $cs_display = 'style="display:none;"';
            }

            $cs_output = '<div class="wrapper_' . sanitize_html_class($id) . '" id="wrapper_' . sanitize_html_class($id) . '" ' . $cs_display . '>';
            echo jobcareer_special_char($cs_output);
        }

        /**
         * 
         * @ render Wrapper Start
         */
        public function cs_wrapper_end_render($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_output = '</div>';
            echo jobcareer_special_char($cs_output);
        }

        /**
         * 
         * @ render File Upload field
         */
        public function cs_information_box($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            $cs_output = '<p>';
            $cs_output .= $description;
            $cs_output .= '</p>';
            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render File Upload field
         */
        public function cs_gallery_render($params = '') {
            global $post, $jobcareer_form_fields, $jobcareer_form_fields, $jobcareer_html_fields;
            extract($params);
            $cs_random_id = $this->jobcareer_generate_random_string('5');
            ?>
            <div class="form-elements" id="wrapper_thumb_view">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label><?php esc_html_e('Add Gallery', 'jobcareer'); ?></label>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div id="gallery_container_<?php echo esc_attr($cs_random_id); ?>">
                        <script>
                            jQuery(document).ready(function () {
                                jQuery("#gallery_sortable_<?php echo esc_attr($cs_random_id); ?>").sortable({
                                    out: function (event, ui) {
                                        cs_gallery_sorting_list('<?php echo 'cs_' . sanitize_html_class($id); ?>', '<?php echo esc_attr($cs_random_id); ?>')
                                    }
                                });

                                jQuery('#gallery_container_<?php echo esc_attr($cs_random_id); ?>').on('click', 'a.delete', function () {
                                    jQuery(this).closest('li.image').remove();
                                    cs_gallery_sorting_list('<?php echo 'cs_' . sanitize_html_class($id); ?>', '<?php echo esc_attr($cs_random_id); ?>')
                                });

                            });
                        </script>
                        <ul class="gallery_images" id="gallery_sortable_<?php echo esc_attr($cs_random_id); ?>">
                            <?php
                            if (metadata_exists('post', $post->ID, 'cs_' . $id)) {
                                $gallery = get_post_meta($post->ID, 'cs_' . $id, true);
                            } else {
                                // Backwards compat
                                $attachment_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&&meta_value=0');
                                $attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
                                $gallery = implode(',', $attachment_ids);
                            }

                            $attachments = array_filter(explode(',', $gallery));
                            if ($attachments) {
                                foreach ($attachments as $attachment_id) {

                                    $attachment_data = $this->cs_get_icon_for_attachment($attachment_id);
                                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
                                        ' . $attachment_data . '
                                        <div class="actions">
                                            <span><a href="javascript:;" class="delete tips" data-tip="' . esc_html__('Delete image', 'jobcareer') . '">' . esc_html__('<i class="icon-times"></i>', 'jobcareer') . '</a></span>
                                        </div>
                                    </li>';
                                }
                            }
                            ?>
                        </ul>
                        <?php
                        $cs_opt_array = array(
                            'std' => $gallery,
                            'id' => $id,
                            'cust_type' => 'hidden',
                        );

                        $jobcareer_form_fields->cs_form_text_render($cs_opt_array);

                        $cs_opt_array = array(
                            'std' => get_template_directory_uri(),
                            'id' => 'theme_url',
                            'cust_type' => 'hidden',
                        );

                        $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
                        ?>
                    </div>
                    <label class="browse-icon add_gallery hide-if-no-js" data-id="<?php echo 'cs_' . sanitize_html_class($id); ?>" data-rand_id="<?php echo esc_attr($cs_random_id); ?>">
                        <?php
                        $cs_opt_array = array(
                            'std' => $name,
                            'id' => 'gal_add',
                            'classes' => 'left',
                            'extra_atr' => ' data-choose="' . $name . '" data-update="' . $name . '" data-delete="' . esc_html__('Delete', 'jobcareer') . '" data-text="' . esc_html__('Delete', 'jobcareer') . '"',
                            'cust_type' => 'button',
                        );

                        $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
                        ?>
                    </label>
                </div>
            </div>

            <?php
        }

        /**
         * 
         * @ render Attachment Icon
         */
        public function cs_get_icon_for_attachment($post_id) {
            $base = get_template_directory_uri() . "/backend/assets/images/";
            $type = get_post_mime_type($post_id);

            switch ($type) {
                case 'image/jpeg':
                case 'image/png':
                case 'image/gif':
                    return wp_get_attachment_image($post_id, 'thumbnail');
                    break;
                case 'video/mpeg':
                case 'video/mp4':
                case 'video/quicktime':
                    return '<img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/video.png' . '" alt=""/>';
                    break;
                case 'text/csv':
                case 'text/plain':
                case 'text/xml':
                    return '<img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/attachment.png' . '" alt=""/>';
                    break;
                default:
                    return '<img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/attachment.png' . '" alt=""/>';
                    break;
            }
        }

        /**
         * 
         * @ render File Upload field
         */
        public function cs_gallery_render_old($params = '') {
            global $post, $jobcareer_html_fields;
            extract($params);

            ob_start();
            echo jobcareer_post_attachments($std);
            $post_data = ob_get_clean();
            echo force_balance_tags($post_data);
        }

        /**
         * 
         * @ render Map Html
         */
        public function cs_location_map_render($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);

            $cs_location_latitude = get_post_meta($post->ID, 'cs_location_latitude', true);
            $cs_location_longitude = get_post_meta($post->ID, 'cs_location_longitude', true);
            $cs_location_zoom = get_post_meta($post->ID, 'cs_location_zoom', true);

            $cs_output = '<div class="gllpLatlonPicker cs-main-picker">';
            $cs_output .= '<ul class="form-elements">';
            $cs_output .= '<li class="to-label">';
            $cs_output .= '<label></label>';
            $cs_output .= '</li>';
            $cs_output .= '<li class="to-field">';
            $cs_opt_array = array(
                'std' => esc_html($name),
                'cust_id' => '',
                'cust_type' => 'button',
                'classes' => 'gllpSearchButton',
                'cust_name' => '',
                'extra_atr' => 'onClick="gll_search_map()"',
                'return' => true,
            );

            $cs_output .= $jobcareer_form_fields->cs_text_field($cs_opt_array);
            $cs_output .= '</li>';
            $cs_output .= '</ul>';
            $cs_output .= '<ul class="form-elements ">';
            $cs_output .= '<li>';
            $cs_output .= '<div class="gllpMap" id="cs-map-location-id"></div>';
            $cs_opt_array = array(
                'std' => esc_attr($cs_location_latitude),
                'id' => '',
                'classes' => 'gllpSearchField cs-search-fields',
                'prefix' => '',
                'cust_name' => 'add_new_loc',
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);

            $cs_opt_array = array(
                'std' => esc_attr($cs_location_latitude),
                'id' => '',
                'classes' => '',
                'prefix' => '',
                'cust_name' => 'cs_location_latitude',
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);

            $cs_opt_array = array(
                'std' => esc_attr($cs_location_longitude),
                'id' => '',
                'classes' => '',
                'prefix' => '',
                'cust_name' => 'cs_location_longitude',
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);

            $cs_opt_array = array(
                'std' => esc_attr($cs_location_zoom),
                'id' => '',
                'classes' => '',
                'prefix' => '',
                'cust_name' => 'cs_location_zoom',
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);

            $cs_output .= '</li>';
            $cs_output .= '</ul>';
            $cs_output .= '</div>';

            echo force_balance_tags($cs_output);
        }

        /**
         * 
         * @ render File Upload field
         */
        public function cs_media_url($params = '') {
            global $post, $jobcareer_html_fields, $jobcareer_form_fields;
            extract($params);

            $cs_value = get_post_meta($post->ID, 'cs_' . $id, true);
            if (isset($cs_value) && $cs_value != '') {
                $value = $cs_value;
            } else {
                $value = $std;
            }

            $cs_output = '<ul class="form-elements">';
            $cs_output .= $this->cs_form_label($name, $description);
            if (isset($help_text) && $help_text != '') {
                $cs_output .= jobcareer_tooltip_text($help_text);
            }
            $cs_output .= '<li class="to-field">';
            $cs_output .= '<div class="input-sec">';
            $cs_opt_array = array(
                'std' => sanitize_text_field($value),
                'cust_id' => 'cs_' . sanitize_html_class($id),
                'cust_name' => 'cs_' . sanitize_html_class($id),
                'return' => true,
            );
            $cs_output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
            $cs_output .= '<label class="browse-icon">';
            $cs_opt_array = array(
                'name' => '',
                'field_params' => array(
                    'std' => '' . esc_html__('Browse', 'jobcareer') . '',
                    'cust_id' => 'cs_' . sanitize_html_class($id) . '_btn',
                    'cust_name' => 'cs_' . sanitize_html_class($id) . '',
                    'cust_type' => 'button',
                    'classes' => 'uploadfileurl left',
                    'cust_name' => '',
                    'return' => true,
                ),
            );

            $cs_output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);
            $cs_output .= '</label>';
            $cs_output .= '</div>';
            $cs_output .= '</li>';
            $cs_output .= '</ul>';
            echo force_balance_tags($cs_output);
        }

    }

}
$cs_metaboxes_vars = array('jobcareer_metaboxes');
$cs_metaboxes_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_metaboxes_vars);
extract($cs_metaboxes_vars);

$jobcareer_metaboxes = new jobcareer_meta_fields();
