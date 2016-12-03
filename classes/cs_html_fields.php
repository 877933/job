<?php

/**
 * File Type: Form Fields
 */
if (!class_exists('jobcareer_html_fields')) {

    class jobcareer_html_fields extends jobcareer_form_fields {

        public function __construct() {
            // Do something...
        }

        /**
         * opening field markup
         * 
         */
        public function cs_opening_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';

            return $cs_output;
        }

        /**
         * full opening field markup
         * 
         */
        public function cs_full_opening_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			<div class="form-elements">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

            return $cs_output;
        }

        /**
         * closing field markup
         * 
         */
        public function cs_closing_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '<p>' . esc_html($desc) . '</p>
			</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            return $cs_output;
        }

        /**
         * heading markup
         * 
         */
        public function cs_heading_render($params = '') {
            global $post;
            extract($params);
            $cs_output = '
			<div class="theme-help" id="' . sanitize_html_class($id) . '">
				<h4 style="padding-bottom:0px;">' . esc_attr($name) . '</h4>
				<div class="clear"></div>
			</div>';
            echo force_balance_tags($cs_output);
        }

        /**
         * heading markup
         * 
         */
        public function cs_set_heading($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			<li>
				<a title="' . esc_html($name) . '" href="#">
				<i class="' . sanitize_html_class($fontawesome) . '"></i>
				<span class="cs-title-menu">' . esc_html($name) . '</span></a>';
            if (is_array($options) && sizeof($options) > 0) {
                $active = '';
                $cs_output .= '<ul class="sub-menu">';
                foreach ($options as $key => $value) {
                    $active = ( $key == "tab-general-page-settings" ) ? 'active' : '';
                    $cs_output .= '<li class="' . sanitize_html_class($key) . ' ' . $active . '"><a href="#' . $key . '" onClick="toggleDiv(this.hash);return false;">' . esc_html($value) . '</a></li>';
                }
                $cs_output .= '</ul>';
            }
            $cs_output .= '
			</li>';

            return $cs_output;
        }

        /**
         * main heading markup
         * 
         */
        public function cs_set_main_heading($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			<li>
				<a title="' . $name . '" href="#' . $id . '" onClick="toggleDiv(this.hash);return false;">
					<i class="' . sanitize_html_class($fontawesome) . '"></i>
					<span class="cs-title-menu">' . esc_html($name) . '</span>
				</a>
			</li>';

            return $cs_output;
        }

        /**
         * sub heading markup
         * 
         */
        public function cs_set_sub_heading($params = '') {
            extract($params);
            $cs_output = '';
            $style = '';
            if ($counter > 1) {
                $cs_output .= '</div><!-- end col2-->';
            }
            if ($id != 'tab-general-page-settings') {
                $style = 'style="display:none;"';
            }
            $cs_output .= '<div  id="' . $id . '" ' . $style . '>';
            $cs_output .= '
				<div class="theme-header">
					<h1>' . esc_html($name) . '</h1>
				</div>';

            $cs_output .= '<div class="col2-right">';

            return $cs_output;
        }

        /**
         * announcement markup
         * 
         */
        public function cs_set_announcement($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
				<div id="' . $id . '" class="alert alert-info fade in nomargin theme_box">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
					<h4>' . esc_html($name) . '</h4>
					<p>' . esc_html($std) . '</p>
				</div>';

            return $cs_output;
        }

        /**
         * settings col right markup
         * 
         */
        public function cs_set_col_right($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			</div><!-- end col2-right-->';
            if ((isset($col_heading) && $col_heading != '') || (isset($help_text) && $help_text <> '')) {
                $cs_output .= '
				<div class="col3">
					<h3>' . esc_html($col_heading) . '</h3>
					<p>' . esc_html($help_text) . '</p>                                
				</div>';
            }

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * settings section markup
         * 
         */
        public function cs_set_section($params = '') {
            extract($params);
            $cs_output = '';
            if (isset($accordion) && $accordion == true) {
                if (isset($active) && $active == true) {
                    $active = '';
                } else {
                    $active = ' class="collapsed"';
                }
                $cs_output .= '
				<div class="panel-heading">
					<a' . $active . ' href="#accordion-' . esc_attr($id) . '" data-parent="#accordion-' . esc_attr($parrent_id) . '" data-toggle="collapse"><h4>' . esc_html($std) . '</h4>';
            } else {
                $cs_output .= '
				<div class="theme-help">
					<h4>' . esc_html($std) . '</h4>
					<div class="clear"></div>
				</div>';
            }
            if (isset($accordion) && $accordion == true) {
                $cs_output .= '
					</a>
				</div>';
            }

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * text field markup
         * 
         */
        public function cs_text_field($params = '') {
            extract($params);
            $cs_output = '';

            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '
			<div  ' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $desc = isset($desc) ? $desc : '';
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= parent::cs_form_text_render($field_params);
            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * date field markup
         * 
         */
        public function cs_date_field($params = '') {
            extract($params);
            $cs_output = '';

            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }

            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= parent::cs_form_date_render($field_params);
            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * textarea field markup
         * 
         */
        public function cs_textarea_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }
			
			
			
            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
			
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
				
			if(isset($field_params['cs_editor'])){
				if($field_params['cs_editor']==true){
					$editor_class	= 'cs_editor'.mt_rand();
					$field_params['classes']	.= ' '.$editor_class;	
				}
			}
            $cs_output .= parent::cs_form_textarea_render($field_params);
            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';
			if(isset($field_params['cs_editor'])){
				if($field_params['cs_editor']==true){
					echo '<script>
						jQuery(".'.$editor_class.'").jqte();
					</script>';
				}
			}
            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * radio field markup
         * 
         */
        public function cs_radio_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			<div class="input-sec">';
            $cs_output .= parent::cs_form_radio_render($field_params);
            $cs_output .= esc_html($description);
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * select field markup
         * 
         */
        public function cs_select_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }

            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '
			<div' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            if (isset($multi) && $multi == true) {
                $cs_output .= parent::cs_form_multiselect_render($field_params);
            } else {
                $cs_output .= parent::cs_form_select_render($field_params);
            }
            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * checkbox field markup
         * 
         */
        public function cs_checkbox_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }

            $custom_id = isset($main_id) ? ' id="' . $main_id . '"' : '';
            // cs_checkbox_field
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '
			<div' . $custom_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= parent::cs_form_checkbox_render($field_params);
            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * upload media field markup
         * 
         */
        public function cs_media_url_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			<div class="form-elements">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= parent::cs_media_url($field_params);
            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * upload file field markup
         * 
         */
        public function cs_upload_file_field($params = '') {
            global $post, $pagenow;
            extract($params);

            $cs_prefix = 'cs_';
            if (isset($prefix)) {
                $cs_prefix = $prefix;
            }

            if ($pagenow == 'post.php') {

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
            if (isset($value) && $value != '') {
                $display = 'style=display:block';
                $display_btn = 'style=display:none';
            } else {
                $display = 'style=display:none';
                $display_btn = 'style=display:block';
            }

            $cs_random_id = '';

            $html_id = ' id="' . $cs_prefix . sanitize_html_class($id) . '"';

            if (isset($array) && $array == true) {
                $cs_random_id = rand(123345, 987456);
                 if(isset($cus_rand_id)){
                    $cs_random_id = $cus_rand_id;
                } 
                $html_id = ' id="' . $cs_prefix . sanitize_html_class($id) . $cs_random_id . '"';
            }

            $field_params['cs_random_id'] = $cs_random_id;

            // main_id
            $block_main_id = '';
            if (isset($main_id) && $main_id <> "") {
                $block_main_id = 'id=' . $main_id;
            }

            $style = '';
            if (isset($styles) && $styles <> "") {
                $style = 'style=' . $styles . '';
            }

            $cs_output = '';
            $cs_output .= '
			<div class="form-elements"  ' . esc_attr($block_main_id) . ' ' . esc_attr($style) . ' >
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= parent::cs_form_fileupload_render($field_params);
            $cs_output .= '<div class="page-wrap" ' . $display . ' id="' . $cs_prefix . sanitize_html_class($id) . $cs_random_id . '_box">';
            $cs_output .= '<div class="gal-active">';
            $cs_output .= '<div class="dragareamain" style="padding-bottom:0px;">';

            // new
            if (is_array($value)) {
                $value = $value[0];
            }
            if (isset($force_std) && $force_std == true) {
                $value = $std;
            }
            $cs_output .= '<ul id="gal-sortable">';
            $cs_output .= '<li class="ui-state-default" id="">';
            $cs_output .= '<div class="thumb-secs"> <img src="' . esc_url($value) . '" id="' . $cs_prefix . sanitize_html_class($id) . $cs_random_id . '_img" width="100" alt="" />';
            $cs_output .= '<div class="gal-edit-opts"><a href="javascript:del_media(\'' . $cs_prefix . sanitize_html_class($id) . $cs_random_id . '\')" class="delete"></a> </div>';
            $cs_output .= '</div>';
            $cs_output .= '</li>';
            $cs_output .= '</ul>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';
            $cs_output .= '</div>';

            $cs_output .= '<p>' . esc_html($desc) . '</p>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * select page field markup
         * 
         */
        public function cs_select_page_field($params = '') {
            extract($params);
            $cs_output = '';
            $cs_output .= '
			<div class="form-elements">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="select-style">';
            $cs_output .= wp_dropdown_pages($args);
            $cs_output .= '<p>' . esc_html($desc) . '</p>
					</div>
				</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';

            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

        /**
         * text field markup
         * 
         * 
         */
        public function cs_multi_fields($params = '') {
            extract($params);
            $cs_output = '';

            $cs_styles = '';
            if (isset($styles) && $styles != '') {
                $cs_styles = ' style="' . $styles . '"';
            }
            $cust_id = isset($id) ? ' id="' . $id . '"' : '';
            $extra_attr = isset($extra_att) ? ' ' . $extra_att . ' ' : '';
            $cs_output .= '<div' . $cust_id . $extra_attr . ' class="form-elements"' . $cs_styles . '>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_attr($name) . '</label>';
            if (isset($hint_text) && $hint_text != '') {
                $cs_output .= jobcareer_tooltip_text(esc_html($hint_text));
            }
            $cs_fields_before = '';
            if (isset($fields_before) && $fields_before != '') {
                $cs_fields_before = $fields_before;
            }
            $cs_fields_after = '';
            if (isset($fields_after) && $fields_after != '') {
                $cs_fields_after = $fields_after;
            }
            $cs_output .= '</div><div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
            $cs_output .= $cs_fields_before;
            if (isset($fields_list) && is_array($fields_list)) {
                foreach ($fields_list as $field_array) {
                    if ($field_array['type'] == 'text') {
                        $cs_output .= parent::cs_form_text_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'select') {
                        $cs_output .= parent::cs_form_select_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'multiselect') {
                        $cs_output .= parent::cs_form_multiselect_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'checkbox') {
                        $cs_output .= parent::cs_form_checkbox_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'radio') {
                        $cs_output .= parent::cs_form_radio_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'date') {
                        $cs_output .= parent::cs_form_radio_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'textarea') {
                        $cs_output .= parent::cs_form_textarea_render($field_array['field_params']);
                    } elseif ($field_array['type'] == 'media') {
                        $cs_output .= parent::cs_media_url($field_array['field_params']);
                    } elseif ($field_array['type'] == 'fileupload') {
                        $cs_output .= '<div class="page-wrap" ' . $display . ' id="cs_' . sanitize_html_class($id) . '_box">';
                        $cs_output .= '<div class="gal-active">';
                        $cs_output .= '<div class="dragareamain" style="padding-bottom:0px;">';
                        $cs_output .= '<ul id="gal-sortable">';
                        $cs_output .= '<li class="ui-state-default" id="">';
                        $cs_output .= '<div class="thumb-secs"> <img src="' . esc_url($value) . '" id="cs_' . sanitize_html_class($id) . '_img" width="100" alt="" />';
                        $cs_output .= '<div class="gal-edit-opts"><a href="javascript:del_media(\'cs_' . sanitize_html_class($id) . '\')" class="delete"></a> </div>';
                        $cs_output .= '</div>';
                        $cs_output .= '</li>';
                        $cs_output .= '</ul>';
                        $cs_output .= '</div>';
                        $cs_output .= '</div>';
                        $cs_output .= '</div>';
                        $cs_output .= parent::cs_form_fileupload_render($field_params);
                    } elseif ($field_array['type'] == 'dropdown_pages') {
                        $cs_output .= wp_dropdown_pages($args);
                    }
                }
            }
            if (isset($desc) && $desc != '') {
                $cs_output .= '<p>' . esc_html($desc) . '</p>';
            }
            $cs_output .= $cs_fields_after;
            $cs_output .= '</div>';
            if (isset($split) && $split == true) {
                $cs_output .= '<div class="splitter"></div>';
            }
            $cs_output .= '
			</div>';
            if (isset($echo) && $echo == true) {
                echo force_balance_tags($cs_output);
            } else {
                return $cs_output;
            }
        }

    }

    $cs_html_fields_vars = array('jobcareer_html_fields');
    $cs_html_fields_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_html_fields_vars);
    extract($cs_html_fields_vars);
    
    $jobcareer_html_fields = new jobcareer_html_fields();
}
