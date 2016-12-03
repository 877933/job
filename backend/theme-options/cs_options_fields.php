<?php

/**
 * @Theme Options Fields Class
 * @return
 *
 */
if (!class_exists('jobcareer_theme_options_fields')) {

    class jobcareer_theme_options_fields {

        // Start function for class construct

        public function __construct() {
            
        }

        # Sub Menu

        public function sub_menu($sub_menu = '') {
            $menu_items = '';
            $active = '';
            $menu_items .= '<ul class="sub-menu">';
            foreach ($sub_menu as $key => $value) {
                $active = ($key == "tab-global-setting") ? 'active' : '';
                $menu_items.='<li class="' . sanitize_html_class($key) . ' ' . $active . ' "><a href="#' . $key . '" onClick="toggleDiv(this.hash);return false;">' . esc_attr($value) . '</a></li>';
            }
            $menu_items .= '</ul>';
            return $menu_items;
        }

        // Start function for theme option fields 

        public function cs_fields($jobcareer_sett_options) {
            global $jobcareer_options, $post, $jobcareer_html_fields, $jobcareer_form_fields;
            $counter = 0;
            $cs_counter = 0;
            $menu = '';
            $output = '';
            $parent_heading = '';
            $style = '';
            foreach ($jobcareer_sett_options as $value) {
                $counter++;
                $val = '';
                if ($value['type'] != "heading") {
                    
                }
                $cs_classes = '';
                if (isset($value['classes']) && $value['classes'] != "") {
                    $cs_classes = $value['classes'];
                }
                $select_value = '';
                switch ($value['type']) {
                    case "heading":
                    case "heading":
                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'fontawesome' => isset($value['fontawesome']) ? $value['fontawesome'] : '',
                            'options' => isset($value['options']) ? $value['options'] : '',
                        );

                        $menu .= $jobcareer_html_fields->cs_set_heading($cs_opt_array);
                        break;
                        break;

                    case "main-heading":
                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'fontawesome' => isset($value['fontawesome']) ? $value['fontawesome'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                        );
                        $menu .= $jobcareer_html_fields->cs_set_main_heading($cs_opt_array);
                        break;

                    case "division":
                        $extra_atts = isset($value['extra_atts']) ? $value['extra_atts'] : '';
                        $d_enable = ' style="display:none;"';
                        if (isset($value['enable_val'])) {
                            $enable_id = isset($value['enable_id']) ? $value['enable_id'] : '';
                            $enable_val = isset($value['enable_val']) ? $value['enable_val'] : '';
                            $d_val = '';
                            if (isset($jobcareer_options)) {
                                if (isset($jobcareer_options[$enable_id])) {
                                    $d_val = $jobcareer_options[$enable_id];
                                }
                            }
                            $d_enable = $d_val == $enable_val ? ' style="display:block;"' : ' style="display:none;"';
                        }
                        $output .= '<div' . $d_enable . ' ' . $extra_atts . '>';
                        break;

                    case "division_close":
                        $output .= '</div>';
                        break;

                    case "col-right-text":
                        $col_heading = "";
                        $help_text = "";
                        if (isset($value['col_heading'])) {
                            $col_heading = isset($value['col_heading']) ? $value['col_heading'] : '';
                        }
                        if (isset($value['help_text'])) {
                            $help_text = isset($value['help_text']) ? $value['help_text'] : '';
                        }
                        $cs_opt_array = array(
                            'col_heading' => $col_heading,
                            'help_text' => $help_text,
                        );
                        $output .= $jobcareer_html_fields->cs_set_col_right($cs_opt_array);
                        break;

                    case "sub-heading":
                        $cs_counter++;
                        if ($cs_counter > 1) {
                            $output .='</div>';
                        }
                        if ($value['id'] != 'tab-global-setting') {
                            $style = 'style="display:none;"';
                        }

                        $output .='<div id="' . $value['id'] . '" ' . $style . ' >';
                        $output .='<div class="theme-header">
									<h1>' . $value['name'] . '</h1>
							   </div>';
                        if (isset($value['with_col']) && $value['with_col'] == true)
                            $output .='<div class="col2-right">';
                        break;

                    case "announcement":
                        $cs_counter++;
                        $output.='<div id="' . $value['id'] . '" class="alert alert-info fade in nomargin theme_box">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                    <h4>' . force_balance_tags($value['name']) . '</h4>
                                    <p>' . force_balance_tags($value['std']) . '</p>
                            </div>';
                        break;

                    case "section":
                        $output .='<div class="theme-help">
                                    <h4>' . esc_attr($value['std']) . '</h4>
                                    <div class="clear"></div>
                              </div>';
                        break;

                    case 'text':
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $val = $jobcareer_options[$value['id']];
                            } else {
                                $val = $value['std'];
                            }
                        } else {
                            $val = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $val,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => '',
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }
                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        break;

                    case 'hidden':
                        $val = $value['std'];
                        $cs_opt_array = array(
                            'std' => $val,
                            'cust_id' => isset($value['id']) ? $value['id'] : '',
                            'cust_name' => isset($value['id']) ? $value['id'] : '',
                            'classes' => '',
                            'return' => true,
                        );
                        $output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
                        break;
                    case 'headerbg slider':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $show = '';
                        $rev_options = '';
                        if (isset($jobcareer_options['cs_headerbg_options']) && $jobcareer_options['cs_headerbg_options'] == 'slider') {
                            $show = 'block';
                        } else if (isset($jobcareer_options['cs_headerbg_options']) && ($jobcareer_options['cs_headerbg_options'] == 'None' || $jobcareer_options['cs_headerbg_options'] == 'Bg Image / bg Color')) {
                            $show = 'none';
                        }
                        if (class_exists('RevSlider') && class_exists('jobcareer_revSlider')) {
                            $slider = new jobcareer_revSlider();
                            $arrSliders = $slider->getAllSliderAliases();
                            foreach ($arrSliders as $key => $entry) {
                                $selected = '';
                                if ($select_value != '') {
                                    if ($select_value == $key['alias']) {
                                        $selected = ' selected="selected"';
                                    }
                                } else {
                                    if (isset($value['std'])) {
                                        if ($value['std'] == $key['alias']) {
                                            $selected = ' selected="selected"';
                                        }
                                    }
                                }
                                $rev_options.= '<option ' . $selected . ' value="' . $key['alias'] . '">' . $entry['title'] . '</option>';
                            }
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'options_markup' => true,
                                'classes' => $cs_classes,
                                'options' => $rev_options,
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case 'slider code':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $show = '';
						$jobcareer_options_default_header=isset($jobcareer_options['cs_default_header']) ? $jobcareer_options['cs_default_header']:'';
                        if ($jobcareer_options_default_header == 'slider') {
                            $show = 'block';
                        } else if ($jobcareer_options_default_header == 'breadcrumbs_sub_header' || $jobcareer_options_default_header == 'no_header') {
                            $show = 'none';
                        }
                        $rev_options = '';

                        if (class_exists('RevSlider') && class_exists('jobcareer_revSlider')) {
                            $slider = new jobcareer_revSlider();
                            $arrSliders = $slider->getAllSliderAliases();
                            foreach ($arrSliders as $key => $entry) {
                                $selected = '';
                                if ($select_value != '') {
                                    if ($select_value == $entry['alias']) {
                                        $selected = ' selected="selected"';
                                    }
                                } else {
                                    if (isset($value['std'])) {
                                        if ($value['std'] == $entry['alias']) {
                                            $selected = ' selected="selected"';
                                        }
                                    }
                                }
                                $rev_options.= '<option ' . $selected . ' value="' . $entry['alias'] . '">' . $entry['title'] . '</option>';
                            }
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_1',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'options_markup' => true,
                                'classes' => $cs_classes,
                                'options' => $rev_options,
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        break;

                    case 'range_font' :
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $val = $jobcareer_options[$value['id']];
                            } else {
                                $val = $value['std'];
                            }
                        } else {
                            $val = $value['std'];
                        }

                        $output .= '<div class="form-elements" id="' . $value['id'] . '_range" style="width:50%; display:inline-block;">';

                        $output .= '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                               <label>' . esc_attr($value["name"]) . '</label>
                                </div>';
                        $output .= '<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="cs-drag-slider" data-slider-min="' . $value['min'] . '" data-slider-max="' . $value['max'] . '" data-slider-step="1" data-slider-value="' . $val . '">
                                </div><input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" value="' . $val . '" class="vsmall" />';
                        $output .= '<p>' . esc_attr($value['desc']) . '</p></div>';
                        $output .= '</div>';

                        break;
                    case 'range':
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $val = $jobcareer_options[$value['id']];
                            } else {
                                $val = $value['std'];
                            }
                        } else {
                            $val = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => isset($val) ? $val : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'range' => true,
                                'min' => isset($value['min']) ? $value['min'] : '',
                                'max' => isset($value['max']) ? $value['max'] : '',
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        break;

                    case 'textarea':
                        $val = $value['std'];
                        $std = get_option($value['id']);
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $val = $jobcareer_options[$value['id']];
                            } else {
                                $val = $value['std'];
                            }
                        } else {
                            $val = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => isset($val) ? $val : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                        break;
					case 'automatic_upgrade':
						// If this is an request to upgrade theme.
						if ( isset( $_GET['action'] ) && $_GET['action'] == 'upgrade_theme' ) {
							$data = jobcareer_auto_upgrade_theme_and_plugins();
							//add_action( 'admin_notices', 'jobcareer_show_theme_auto_update_success' );
							
							$cs_theme_upgraded_name = '';
							if ( isset( $data['cs_theme_upgraded_name'] ) ) {
								$cs_theme_upgraded_name = $data['cs_theme_upgraded_name'];
							}
							
							$plugins_str = '';
							if ( isset( $data['cs_plugins_upgraded'] ) ) {
								$cs_plugins_upgraded = $data['cs_plugins_upgraded'];
								$plugins_str = implode( ', ', $cs_plugins_upgraded );
							}
							
							$msgStr = $cs_theme_upgraded_name;
							if ( $msgStr != '' ) {
								$msgStr .= ', ' . $plugins_str;
							} else {
								$msgStr = $plugins_str;
							}
							
							if ( $msgStr != '' ) {
								$message = __( 'Successfully installed ' . $msgStr, 'jobcareer' );
							} else {
								$message = __( 'Sorry unable to upgrade theme. Contact Theme Author and repot this issue.', 'jobcareer' );
							}

							$cs_counter++;
							$output.='<div id="' . $value['id'] . '" class="alert alert-info fade in nomargin theme_box">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
                                    <h4>Upgrade Theme and Plugin(s)</h4>
                                    <p>' . $message . '</p>
                            </div>
							<script type="text/javascript">
								(function($){
									$(function() {
										$(".wrap").hide();
									});
								})(jQuery);
							</script>
							';
						}
						break;
                    case 'generate_backup':

                        global $wp_filesystem;
                        $backup_url = wp_nonce_url('themes.php?page=jobcareer_theme_options_constructor');

                        if (false === ($creds = request_filesystem_credentials($backup_url, '', false, false, array()) )) {

                            return true;
                        }

                        if (!WP_Filesystem($creds)) {
                            request_filesystem_credentials($backup_url, '', true, false, array());
                            return true;
                        }

                        $cs_upload_dir = trailingslashit(get_template_directory()) . 'backend/assets/data/backups/';

                        $cs_upload_dir_path = trailingslashit(get_template_directory_uri()) . 'backend/assets/data/backups/';

                        $cs_all_list = $wp_filesystem->dirlist($cs_upload_dir);

                        $output .= '<div class="backup_generates_area" data-ajaxurl="' . esc_url(admin_url('admin-ajax.php')) . '">';
                        $output .= '<div class="external_backup_areas">';
                        $cs_opt_array = array(
                            'name' => esc_html__('Import Options', 'jobcareer'),
                            'id' => 'bkup_import_url_main',
                            'desc' => '',
                            'hint_text' => esc_html__('Input the Url from another location and hit Import Button to apply settings.', 'jobcareer'),
                            'fields_list' => array(
                                array('type' => 'text', 'field_params' => array(
                                        'std' => '',
                                        'cust_id' => "bkup_import_url",
                                        'cust_name' => '',
                                        'classes' => 'input-medium',
                                        'return' => true,
                                    ),
                                ),
                                array('type' => 'text', 'field_params' => array(
                                        'std' => esc_html__('Import', 'jobcareer'),
                                        'cust_id' => 'cs-backup-url-restore',
                                        'cust_name' => '',
                                        'classes' => '',
                                        'cust_type' => 'button',
                                        'return' => true,
                                    ),
                                )
                            ),
                        );
                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }
                        $output .= $jobcareer_html_fields->cs_multi_fields($cs_opt_array);
                        $output .= '</div>';
                        if (is_array($cs_all_list) && sizeof($cs_all_list) > 0) {
                            $cs_list_count = 1;
                            $bk_options = '';
                            foreach ($cs_all_list as $file_key => $file_val) {

                                if (isset($file_val['name'])) {
                                    $cs_slected = sizeof($cs_all_list) == $cs_list_count ? ' selected="selected"' : '';
                                    $bk_options .= '<option' . $cs_slected . '>' . $file_val['name'] . '</option>';
                                }
                                $cs_list_count++;
                            }
                            $cs_opt_array = array(
                                'name' => esc_html__('Export Options', 'jobcareer'),
                                'id' => '',
                                'desc' => '',
                                'hint_text' => esc_html__('Here you can Generate/Download Backups. Also you can use these Backups to Restore settings.', 'jobcareer'),
                                'field_params' => array(
                                    'std' => esc_html__('Import', 'jobcareer'),
                                    'cust_id' => "",
                                    'cust_name' => '',
                                    'classes' => 'select-medium chosen-select-no-single',
                                    'extra_atr' => ' onchange="cs_set_filename(this.value, \'' . esc_url($cs_upload_dir_path) . '\')"',
                                    'options_markup' => true,
                                    'options' => isset($bk_options) ? $bk_options : '',
                                    'return' => true,
                                ),
                            );

                            if (isset($value['change']) && $value['change'] == 'yes') {
                                $cs_opt_array['field_params']['onclick'] = $value['id'] . '_change(this.value)';
                            }

                            if (isset($value['split']) && $value['split'] <> '') {
                                $cs_opt_array['split'] = $value['split'];
                            }
                            $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                            if (isset($file_val['name'])) {
                                $cs_opt_array = array(
                                    'name' => '&nbsp;',
                                    'id' => 'bkup_import_url',
                                    'desc' => '',
                                    'fields_before' => '<div class="backup_action_btns">',
                                    'fields_after' => '<a download="' . $file_val['name'] . '" href="' . esc_url($cs_upload_dir_path . $file_val['name']) . '">' . esc_html__('Download', 'jobcareer') . '</a>' . '</div>',
                                    'fields_list' => array(
                                        array('type' => 'text', 'field_params' => array(
                                                'std' => esc_html__('Restore', 'jobcareer'),
                                                'cust_id' => "cs-backup-restore",
                                                'cust_name' => '',
                                                'extra_atr' => ' data-file="' . $file_val['name'] . '"',
                                                'cust_type' => 'button',
                                                'return' => true,
                                            ),
                                        ),
                                        array('type' => 'text', 'field_params' => array(
                                                'std' => esc_html__('Delete', 'jobcareer'),
                                                'cust_id' => "cs-backup-delte",
                                                'cust_name' => '',
                                                'extra_atr' => ' data-file="' . $file_val['name'] . '"',
                                                'cust_type' => 'button',
                                                'return' => true,
                                            ),
                                        ),
                                    ),
                                );
                                if (isset($value['split']) && $value['split'] <> '') {
                                    $cs_opt_array['split'] = $value['split'];
                                }
                                $output .= $jobcareer_html_fields->cs_multi_fields($cs_opt_array);
                            }
                        }

                        $cs_opt_array = array(
                            'name' => "",
                            'desc' => "",
                            'field_params' => array(
                                'std' => esc_html__('Generate Backup', 'jobcareer'),
                                'cust_id' => "cs-generate",
                                'cust_name' => '',
                                'extra_atr' => ' onclick="javascript:cs_backup_generate(\'' . esc_js(admin_url('admin-ajax.php')) . '\');"',
                                'cust_type' => 'button',
                                'return' => true,
                            ),
                        );
                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        break;
                    case 'widgets_backup':

                        $output .= '<div class="backup_generates_area" data-ajaxurl="' . esc_url(admin_url('admin-ajax.php')) . '">';
                        if (class_exists('cs_widget_data')) {

                            global $wp_filesystem;

                            $backup_url = wp_nonce_url('themes.php?page=jobcareer_theme_options_constructor');

                            if (false === ($creds = request_filesystem_credentials($backup_url, '', false, false, array()) )) {

                                return true;
                            }

                            if (!WP_Filesystem($creds)) {
                                request_filesystem_credentials($backup_url, '', true, false, array());
                                return true;
                            }

                            $cs_upload_dir = cs_framework::plugin_dir() . 'include/cs-importer/widgets-backup/';

                            $cs_upload_dir_path = cs_framework::plugin_url() . 'include/cs-importer/widgets-backup/';

                            $cs_all_list = $wp_filesystem->dirlist($cs_upload_dir);

                            $output .= '
			<div class="form-elements">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<label>' . esc_html__('Import Widgets', 'jobcareer') . '</label>';
                            $output .= jobcareer_tooltip_text(esc_html__('Put File Url that contains widget settings', 'jobcareer'));
                            $output .= '
				</div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">';
                            $output .= '<div class="external_backup_areas">
                                            <div id="cs-import-widgets-con">
                                                    <div id="cs-import-widget-loader"></div>
                                                    ' . cs_widget_data::import_settings_page() . '
                                            </div>
                                    </div>';
                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '
			<div class="form-elements">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                            if (is_array($cs_all_list) && sizeof($cs_all_list) > 0) {

                                $output .= '<p>' . esc_html__('Here you can Generate/Download Backups. Also you can use these Backups to Restore settings.', 'jobcareer') . '</p>';

                                $cs_list_count = 1;
                                $bk_options = '';
                                foreach ($cs_all_list as $file_key => $file_val) {

                                    if (isset($file_val['name'])) {

                                        $cs_slected = sizeof($cs_all_list) == $cs_list_count ? ' selected="selected"' : '';
                                        $bk_options .= '<option' . $cs_slected . '>' . $file_val['name'] . '</option>';
                                    }
                                    $cs_list_count++;
                                }

                                $cs_opt_array = array(
                                    'std' => '',
                                    'cust_id' => "cs-wid-backup-change",
                                    'cust_name' => '',
                                    'extra_atr' => ' onchange="cs_set_filename(this.value, \'' . esc_url($cs_upload_dir_path) . '\')"',
                                    'options_markup' => true,
                                    'classes' => $cs_classes,
                                    'options' => $bk_options,
                                    'return' => true,
                                );
                                $output .= $jobcareer_form_fields->cs_form_select_render($cs_opt_array);
                                $output .= '<div class="backup_action_btns">';

                                if (isset($file_val['name'])) {

                                    $cs_opt_array = array(
                                        'std' => esc_html__('Show Widget Settings', 'jobcareer'),
                                        'cust_id' => "cs-wid-backup-restore",
                                        'cust_name' => '',
                                        'extra_atr' => ' data-path="' . $cs_upload_dir_path . '" data-file="' . $file_val['name'] . '"',
                                        'cust_type' => 'button',
                                        'return' => true,
                                    );
                                    $output .= $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
                                    $output .= '<a download="' . $file_val['name'] . '" href="' . esc_url($cs_upload_dir_path . $file_val['name']) . '">' . esc_html__('Download', 'jobcareer') . '</a>';

                                    $cs_opt_array = array(
                                        'std' => esc_html__('Delete', 'jobcareer'),
                                        'cust_id' => "cs-wid-backup-delte",
                                        'cust_name' => '',
                                        'extra_atr' => ' data-file="' . $file_val['name'] . '"',
                                        'cust_type' => 'button',
                                        'return' => true,
                                    );
                                    $output .= $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
                                }

                                $output .= '</div>';
                            }

                            $output .= '<div class="cs-import-help">
                                            <h4>' . esc_html__('Export Widgets', 'jobcareer') . '</h4>
                                    </div>';

                            $output .= '<div id="cs-export-widgets-con">
                                            <div id="cs-export-widget-loader"></div>
                                            ' . cs_widget_data::export_settings_page() . '
                                    </div>';
                            $output .= '</div>';
                            $output .= '</div>';
                        }

                        $output .= '</div>';

                        break;

                    case "radio":
                        if (isset($jobcareer_options)) {
                            $select_value = $jobcareer_options[$value['id']];
                        } else {
                            
                        }
                        foreach ($value['options'] as $key => $option) {
                            $checked = '';
                            if ($select_value != '') {
                                if ($select_value == $option) {
                                    $checked = ' checked';
                                }
                            } else {
                                if ($value['std'] == $option) {
                                    $checked = ' checked';
                                }
                            }
                            $output .= $jobcareer_html_fields->cs_radio_field(
                                    array(
                                        'name' => isset($key) ? $key : '',
                                        'id' => isset($value['id']) ? $value['id'] : '',
                                        'classes' => '',
                                        'std' => $option,
                                        'description' => '',
                                        'hint' => '',
                                        'prefix_on' => false,
                                        'extra_atr' => $checked,
                                        'field_params' => array(
                                            'std' => $option,
                                            'id' => $value['id'],
                                            'return' => true,
                                        ),
                                    )
                            );
                        }
                        break;

                    case "layout":
                        global $cs_header_colors, $post;

                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'hint_text' => '',
                                )
                        );

                        $output .= '<div class="meta-input pattern">';
                        foreach ($value['options'] as $key => $option) {
                            $checked = '';
                            $custom_class = '';
                            if ($select_value != '') {

                                if ($select_value == $key) {
                                    $checked = ' checked';
                                    $custom_class = 'check-list';
                                }
                            } else {
                                if ($value['std'] == $key) {
                                    $checked = ' checked';
                                    $custom_class = 'check-list';
                                }
                            }
                            $name = isset($value['id']) ? $value['id'] : '';
                            $output .= '<div class="radio-image-wrapper">';
                            $cs_opt_array = array(
                                'std' => isset($key) ? $key : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => 'radio',
                                'extra_atr' => ' onclick=select_bg("' . $name . '","' . $key . '","' . get_template_directory_uri() . '","") ' . $checked,
                                'return' => true,
                            );
                            $output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);

                            $output .= '<label for="radio_' . $key . '"><span class="ss"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/' . $key . '.png" /></span> 
				    <span class="' . sanitize_html_class($custom_class) . '" id="check-list">&nbsp;</span></label>
				    <span class="title-theme">' . esc_attr($option) . '</span>            
				    </div>';
                        }
                        $output.= '</div>';
                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        break;
                    case "layout1":
                        global $cs_header_colors, $post;
                        $header_counter = 1;
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'hint_text' => '',
                                )
                        );

                        $output .= '<div class="meta-input pattern">';
                        foreach ($value['options'] as $key => $option) {
                            $checked = '';
                            $custom_class = '';
                            if ($select_value != '') {
                                if ($select_value == $option) {
                                    $checked = ' checked';
                                    $custom_class = 'check-list';
                                }
                            } else {
                                if ($value['std'] == $option) {
                                    $checked = ' checked';
                                    $custom_class = 'check-list';
                                }
                            }
                            $name = isset($value['id']) ? $value['id'] : '';
                            $output .= '<div class="radio-image-wrapper"><span class="header-counter">' . $header_counter . '</span>';
                            $cs_opt_array = array(
                                'std' => $option,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => 'radio',
                                'extra_atr' => ' onclick=select_bg("' . $name . '","' . $option . '","' . get_template_directory_uri() . '","' . admin_url('admin-ajax.php') . '") ' . $checked,
                                'return' => true,
                            );
                            $output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);

                            $output .= ' <label for="radio_' . $key . '">  <span class="ss"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/' . $option . '.png" /></span> 
                                     <span class="' . sanitize_html_class($custom_class) . '" id="check-list">&nbsp;</span>
                                     </label></div>';
                            $header_counter++;
                        }
                        $output.=' </div>';
                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );
                        break;

                    case "horizontal_tab":
                        if (isset($jobcareer_options['cs_layout']) and $jobcareer_options['cs_layout'] <> 'boxed') {
                            echo '<style type="text/css" scoped>
                                    .horizontal_tabs,.main_tab{display:none;
                                    }
                            </style>';
                        }
                        $output .= '<div class="horizontal_tabs"><ul>';
                        $i = 0;
                        foreach ($value['options'] as $key => $val) {
                            $active = ($i == 0) ? 'active' : '';
                            $output .= '<li class="' . sanitize_html_class($val) . ' ' . $active . '"><a href="#' . $val . '" onclick="show_hide(this.hash);return false;">' . $key . '</a></li>';
                            $i++;
                        }
                        $output.='</ul></div>';

                        break;

                    case "layout_body":
                        global $cs_header_colors, $post;
                        $bg_counter = 0;
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        if ($value['path'] == "background") {
                            $image_name = "background";
                        } else {
                            $image_name = "pattern";
                        }
                        $output .= '<div class="main_tab"><div class="horizontal_tab" style="display:' . $value['display'] . '" id="' . $value['tab'] . '">';
                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => $value['name'],
                            'hint_text' => '',
                                )
                        );
                        $output .= '<div class="meta-input cs-body-pattern pattern">';

                        foreach ($value['options'] as $key => $option) {
                            $checked = '';
                            $custom_class = '';
                            if ($select_value != '') {
                                if ($select_value == $option) {
                                    $checked = ' checked';
                                    $custom_class = 'check-list';
                                }
                            } else {
                                if ($value['std'] == $option) {
                                    $checked = ' checked';
                                    $custom_class = 'check-list';
                                }
                            }
                            $name = $value['id'];
                            $output .= '<div class="radio-image-wrapper">';

                            $cs_opt_array = array(
                                'std' => isset($option) ? $option : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => 'radio',
                                'extra_atr' => ' onClick=javascript:select_bg("' . $name . '","' . $option . '","' . get_template_directory_uri() . '","") ' . $checked,
                                'return' => true,
                            );

                            $output .= $jobcareer_form_fields->cs_form_radio_render($cs_opt_array);
                            $output .= '<label for="radio_' . $key . '"> <span class="ss"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/' . $value['path'] . '/' . $image_name . $bg_counter . '.png" /></span> 
				    <span id="check-list" class="' . sanitize_html_class($custom_class) . '">&nbsp;</span>
											</label>
									</div>';
                            $bg_counter++;
                        }

                        $output .= '
					</div>';

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '
					</div>
					</div>';

                        break;
                    case 'select':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        if ($select_value == 'absolute') {
                            if (isset($jobcareer_options['cs_headerbg_options']) and $jobcareer_options['cs_headerbg_options'] == 'cs_rev_slider') {
                                $output .='<style>
                                            #cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
                                            #tab-header-options ul#jobcareer_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header{ display:block;}
                                    </style>';
                            } else if (isset($jobcareer_options['cs_headerbg_options']) and $jobcareer_options['cs_headerbg_options'] == 'jobcareer_bg_image_color') {
                                $output .='<style>
                                            #cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:block;}
                                            #tab-header-options ul#jobcareer_headerbg_slider_1{ display:none; }
                                    </style>';
                            } else {
                                $output .='<style>
                                            #cs_headerbg_options_header{display:block;}
                                            #cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
                                            #tab-header-options ul#jobcareer_headerbg_slider_1{ display:none; }
                                    </style>';
                            }
                        } elseif ($select_value == 'relative') {
                            $output .='<style>
                                            #tab-header-options ul#jobcareer_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header,#tab-header-options ul#cs_headerbg_image_upload,#tab-header-options ul#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box{ display:none;}
                                  </style>';
                        }
                        $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                        $select_header_bg = ($value['id'] == 'cs_header_position') ? 'onchange=javascript:cs_set_headerbg(this.value)' : '';

                        $cs_change_function = (isset($value['change']) && $value['change'] == 'yes') ? ' onchange="' . $value['id'] . '_change(this.value)"' : '';

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_select',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => isset($select_value) ? $select_value : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => 'chosen-select-no-single',
                                'extra_atr' => $cs_change_function . ' ' . $select_header_bg,
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'return' => true,
                            ),
                        );

                        if (isset($value['change']) && $value['change'] == 'yes') {
                            $cs_opt_array['field_params']['onclick'] = $value['id'] . '_change(this.value)';
                        }

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);


                        $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';
                        break;

                    case 'select_values':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                        $select_header_bg = ($value['id'] == 'cs_header_position') ? 'onchange=javascript:cs_set_headerbg(this.value)' : '';

                        $cs_search_display = '';

                        if ($value['id'] == 'cs_search_by_location') {
                            $cs_directory_location_suggestions = isset($jobcareer_options['cs_directory_location_suggestions']) ? $jobcareer_options['cs_directory_location_suggestions'] : '';
                            $cs_search_display = $cs_directory_location_suggestions == 'Website' ? 'block' : 'none';
                        }

                        if ($value['id'] == 'cs_search_by_location_city') {
                            $cs_search_by_location = isset($jobcareer_options['cs_search_by_location']) ? $jobcareer_options['cs_search_by_location'] : '';
                            $cs_search_display = $cs_search_by_location == 'single_city' ? 'block' : 'none';
                        }

                        $cs_change_function = (isset($value['change']) && $value['change'] == 'yes') ? ' onchange="' . $value['id'] . '_change(this.value)"' : '';

                        $cs_opt_array = array(
                            'name' => $value['name'],
                            'id' => $value['id'] . '_select',
                            'extra_att' => ' style="display:' . $cs_search_display . ';"',
                            'desc' => $value['desc'],
                            'hint_text' => $value['hint_text'],
                            'field_params' => array(
                                'std' => isset($select_value) ? $select_value : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'extra_atr' => $cs_change_function . ' ' . $select_header_bg,
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'classes' => $cs_classes,
                                'return' => true,
                            ),
                        );

                        if (isset($value['change']) && $value['change'] == 'yes') {
                            $cs_opt_array['field_params']['onclick'] = $value['id'] . '_change(this.value)';
                        }

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);


                        $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';
                        break;

                    case 'ad_select':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        if ($select_value == 'absolute') {
                            if ($jobcareer_options['cs_headerbg_options'] == 'cs_rev_slider') {
                                $output .='<style>
                                            #cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
                                            #tab-header-options ul#jobcareer_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header{ display:block;}
                                    </style>';
                            } else if ($jobcareer_options['cs_headerbg_options'] == 'jobcareer_bg_image_color') {
                                $output .='<style>
                                                #cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:block;}
                                                #tab-header-options ul#jobcareer_headerbg_slider_1{ display:none; }
                                        </style>';
                            } else {
                                $output .='<style>
                                            #cs_headerbg_options_header{display:block;}
                                            #cs_headerbg_image_upload,#cs_headerbg_color_color,#cs_headerbg_image_box{ display:none;}
                                            #tab-header-options ul#jobcareer_headerbg_slider_1{ display:none; }
                                    </style>';
                            }
                        } elseif ($select_value == 'relative') {
                            $output .='<style>
                                        #tab-header-options ul#jobcareer_headerbg_slider_1,#tab-header-options ul#cs_headerbg_options_header,#tab-header-options ul#cs_headerbg_image_upload,#tab-header-options ul#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box{ display:none;}
                                 </style>';
                        }

                        $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                        $select_header_bg = ($value['id'] == 'cs_header_position') ? 'onchange=javascript:cs_set_headerbg(this.value)' : '';

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_select',
                            'extra_att' => ' style="display:' . $cs_search_display . ';"',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => isset($select_value) ? $select_value : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => $cs_classes,
                                'extra_atr' => $select_header_bg,
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'return' => true,
                            ),
                        );

                        if (isset($value['change']) && $value['change'] == 'yes') {
                            $cs_opt_array['field_params']['onclick'] = $value['id'] . '_change(this.value)';
                        }

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';
                        break;


                    case 'gfont_select':

                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                        $output .='<div class="alert alert-info fade in nomargin theme_box">
								<h4><b>' . esc_attr($value['name']) . '</b></h4>
								<p><strong>' . esc_attr($value['hint_text']) . '</strong></p>
                               </div>';
                        $output .='<div class="form-elements" style="width:50%; display:inline-block;">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . esc_html__('Font Family', 'jobcareer') . '</label></div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="input-sec">
                                        <div class="select-style">
                                        <select class="chosen-select" onchange="cs_google_font_att(\'' . admin_url("admin-ajax.php") . '\',this.value, \'' . $value['id'] . '_att\')" name="' . $value['id'] . '" id="' . $value['id'] . '">';
                        $output .='<option value="default">'. esc_html__('Default Font', 'jobcareer') .'</option>';
                        $i = 0;
                        foreach ($value['options'] as $key => $option) {
                            $selected = '';
                            if ($select_value != '') {
                                if ($select_value == $key) {
                                    $selected = ' selected="selected"';
                                }
                            } else {
                                if (isset($value['std']))
                                    if ($value['std'] == $key) {
                                        $selected = ' selected="selected"';
                                    }
                            }
                            $output .= '<option' . $selected . ' value="' . $option . '">';
                            $output .= $option;
                            $output .= '</option>';
                            $i++;
                        }
                        $output .= '</select></div>
                                                    </div><div class="left-info">
                                                    <p>' . esc_attr($value['desc']) . '</p>
                                            </div>
                                        </div>
                                </div>';

                        $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';

                        break;

                    case 'gfont_att_select':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                                $value['options'] = jobcareer_get_google_font_attribute('', $jobcareer_options[str_replace('_att', '', $value['id'])]);
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $output .= ($value['id'] == 'cs_bgimage_position') ? '<div class="main_tab">' : '';
                        $output .='<div class="form-elements" id="' . $value['id'] . '_select" style="width:50%; display:inline-block;">
                                	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . esc_attr($value['name']) . '</label></div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="input-sec">
                                        <div class="select-style">
                                        <select class="chosen-select" name="' . $value['id'] . '" id="' . $value['id'] . '">
                                        <option value="">' . esc_html__('Select Attribute', 'jobcareer') . '</option>';
                        if (is_array($value['options'])) {
                            foreach ($value['options'] as $option) {
                                $selected = '';
                                if ($select_value != '') {
                                    if ($select_value == $option) {
                                        $selected = ' selected="selected"';
                                    }
                                } else {
                                    if (isset($value['std']))
                                        if ($value['std'] == $option) {
                                            $selected = ' selected="selected"';
                                        }
                                }
                                $output .= '<option' . $selected . ' value="' . $option . '">';
                                $output .= $option;
                                $output .= '</option>';
                            }
                        }
                        $output .= '</select></div>
                                                    </div><div class="left-info">
                                                    <p>' . esc_attr($value['desc']) . '</p>
                                            </div>
                                        </div>
                                </div>';

                        $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';

                        break;

                    case 'select_ftext':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']]) and $jobcareer_options[$value['id']] <> '') {
                                $select_value = $jobcareer_options[$value['id']];
                            } else {
                                $select_value = $value['std'];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $output .='<div class="form-elements" id="' . $value['id'] . '_select" style="width:50%; display:inline-block;">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><label>' . esc_attr($value['name']) . '</label></div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <div class="input-sec">
                                        <div class="select-style">';
                        $cs_change_function = (isset($value['change']) && $value['change'] == 'yes') ? ' onchange="' . $value['id'] . '_change(this.value)"' : '';
                        $output .='<select ' . $select_header_bg . ' name="' . $value['id'] . '"' . $cs_change_function . ' id="' . $value['id'] . '">';

                        foreach ($value['options'] as $opti_key => $option) {
                            $selected = '';
                            if ($select_value != '') {
                                if ($select_value == $option) {
                                    $selected = ' selected="selected"';
                                }
                            } else {
                                if (isset($value['std'])) {
                                    if ($value['std'] == $option) {
                                        $selected = ' selected="selected"';
                                    }
                                }
                            }
                            $output .= '<option' . esc_html($selected) . ' value="' . esc_html($option) . '">';
                            $output .= $option;
                            $output .= '</option>';
                        }
                        $output .= '</select></div></div><div class="left-info"><p>' . esc_attr($value['desc']) . '</p></div></div></div>';
                        $output .=($value['id'] == 'cs_bgimage_position') ? '</div>' : '';
                        break;

                    case 'default header':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'extra_atr' => 'onchange="cs_sub_header_show_slider(this.value)"',
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'classes' => $cs_classes,
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;
                    case 'default header background':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'extra_atr' => ' onchange="cs_set_headerbg(this.value)"',
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'classes' => $cs_classes,
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case 'default padding':

                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        ?>                        
                        <?php if ($select_value == 'default') { ?>
                            <style type="text/css" scoped>
                                #cs_sh_paddingtop_range {
                                    display:none;
                                }
                                #cs_sh_paddingbottom_range {
                                    display:none;
                                }
                            </style>
                        <?php } ?>
                        <?php

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => $value['hint_text'],
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => $value['id'],
                                'extra_atr' => ' onchange="javascript:cs_hide_show_toggle(this.value,"theme_options","theme_options")"',
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'classes' => $cs_classes,
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case "sidebar":
                        $val = $value['std'];
                        if (isset($jobcareer_options['sidebar']) and count($jobcareer_options['sidebar']) > 0) {
                            $val['sidebar'] = $jobcareer_options['sidebar'];
                        }
                        if (isset($val['sidebar']) and count($val['sidebar']) > 0 and $val['sidebar'] <> '') {
                            $display = 'block';
                        } else {
                            $display = 'none';
                        }
                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'hint_text' => esc_html__("Please enter the desired title of sidebar", 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => '',
                            'cust_id' => "sidebar_input",
                            'cust_name' => 'sidebar_input',
                            'classes' => 'input-medium',
                            'return' => true,
                        ));

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => esc_html__("Add Sidebar", 'jobcareer'),
                            'id' => "add_sidebar",
                            'cust_name' => '',
                            'cust_type' => 'button',
                            'extra_atr' => ' onclick="javascript:add_sidebar()"',
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '
					<div class="clear"></div>
					<div class="sidebar-area" style="display:' . $display . '">
						<div class="theme-help">
						  <h4 style="padding-bottom:0px;">' . esc_html__('Already Added Sidebars', 'jobcareer') . '</h4>
						  <div class="clear"></div>
						</div>
						<div class="boxes">
							<table class="to-table" border="0" cellspacing="0">
							<thead>
								<tr>
									<th>' . esc_html__('Sider Bar Name', 'jobcareer') . '</th>
									<th class="centr">' . esc_html__("Actions", 'jobcareer') . '</th>
								</tr>
							</thead>
							<tbody id="sidebar_area">';
                        if ($display == 'block') {
                            $i = 1;
                            foreach ($val['sidebar'] as $sidebar) {
                                ?>
                                <script type="text/javascript">
                                    var $ = jQuery;
                                    $(document).ready(function () {
                                        function slideout() {
                                            setTimeout(function () {
                                                $("#sidebar_area").slideUp("slow", function () {
                                                });

                                            }, 2000);
                                        }


                                        $(function () {
                                            $("#sidebar_area").sortable({opacity: 0.8, cursor: 'move', update: function () {

                                                    $("#sidebar_area").html(theResponse);
                                                    $("#sidebar_area").slideDown('slow');
                                                    slideout();

                                                }
                                            });
                                        });

                                    });
                                </script> 
                                <?php

                                $output.='<tr id="sidebar_' . $i . '">
											<td>';

                                $cs_sidebar_name = jobcareer_get_sidebar_id($sidebar);

                                $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                    'std' => isset($sidebar) ? $sidebar : '',
                                    'id' => "hide_sidebar" . $i,
                                    'cust_name' => 'sidebar[' . $cs_sidebar_name . ']',
                                    'cust_type' => 'hidden',
                                    'return' => true,
                                ));

                                $output.= $sidebar
                                        . '</td>
											<td class="centr"> <a class="remove-btn" onclick="javascript:return confirm(\''.esc_html__('Are you sure! You want to delete this','jobcareer').'\')" href="javascript:cs_div_remove(\'sidebar_' . $i . '\')" data-toggle="tooltip" data-placement="top" title="'. esc_html__('Remove', 'jobcareer') .'"><i class="icon-times"></i></a>
										</td>
									</tr>';
                                $i++;
                            }
                        };
                        $output.='</tbody>
							</table>
						</div>
					</div>';
                        break;

                    case 'select_sidebar':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $cs_single_post_layout = isset($jobcareer_options['cs_single_post_layout']) ? $jobcareer_options['cs_single_post_layout']:'';

                        if (isset($cs_single_post_layout) and $cs_single_post_layout == 'no_sidebar') {
                            $cus_style = ' style="display:none;"';
                        } else {
                            $cus_style = ' style="display:block;"';
                        }
                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'extra_att' => isset($cus_style) ? $cus_style : '',
                            'desc' => $value['desc'],
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'options' => $value['options']['sidebar'],
                                'return' => true,
                                'classes' => $cs_classes,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case 'select_sidebar1':

                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $cs_single_post_layout = isset($jobcareer_options['cs_default_page_layout']) ? $jobcareer_options['cs_default_page_layout']:'';

                        if (isset($cs_single_post_layout) and $cs_single_post_layout == 'no_sidebar') {
                            $cus_style = ' style="display:none;"';
                        } else {
                            $cus_style = ' style="display:block;"';
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'extra_att' => isset($cus_style) ? $cus_style : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => $cs_classes,
                                'options' => $value['options']['sidebar'],
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case "footer_sidebar":
                        $val = $value['std'];
                        if (isset($jobcareer_options['footer_sidebar']) and count($jobcareer_options['footer_sidebar']) > 0) {
                            $val['footer_sidebar'] = $jobcareer_options['footer_sidebar'];
                        }

                        if (isset($jobcareer_options['footer_width']) and count($jobcareer_options['footer_width']) > 0) {
                            $val['footer_width'] = $jobcareer_options['footer_width'];
                        }



                        if (isset($val['footer_sidebar']) and count($val['footer_sidebar']) > 0 and $val['footer_sidebar'] <> '') {
                            $display = 'block';
                        } else {
                            $display = 'none';
                        }


                        if (isset($val['footer_width']) and count($val['footer_width']) > 0 and $val['footer_width'] <> '') {
                            $display = 'block';
                        } else {
                            $display = 'none';
                        }



                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'hint_text' => esc_html__("Please enter the desired title of Footer sidebar", 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => '',
                            'cust_id' => "footer_sidebar_input",
                            'cust_name' => 'footer_sidebar_input',
                            'classes' => 'input-medium',
                            'return' => true,
                        ));

                        $output .= $jobcareer_form_fields->cs_form_select_render(array(
                            'std' => '',
                            'cust_id' => "footer_sidebar_width",
                            'cust_name' => 'footer_sidebar_width',
                            'classes' => 'input-medium',
                            'options' =>
                            array(
                                '2' => esc_html__('2 Column (16.67%)', 'jobcareer'),
                                '3' => esc_html__('3 Column (25%)', 'jobcareer'),
                                '4' => esc_html__('4 Column (33.33%)', 'jobcareer'),
                                '6' => esc_html__('6 Column (50%)', 'jobcareer'),
                                '8' => esc_html__('8 Column (66.66%)', 'jobcareer'),
                                '9' => esc_html__('9 Column (75%)', 'jobcareer'),
                                '10' => esc_html__('10 Column (83.33%)', 'jobcareer'),
                                '12' => esc_html__('12 Column (100%)', 'jobcareer'),
                            ),
                            'return' => true,
                        ));


                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => esc_html__("Add Sidebar", 'jobcareer'),
                            'id' => "add_footer_sidebar",
                            'cust_name' => '',
                            'cust_type' => 'button',
                            'extra_atr' => ' onclick="javascript:add_footer_sidebar()"',
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '
					<div class="clear"></div>
					<div class="footer_sidebar-area" style="display:' . $display . '">
						<div class="theme-help">
						  <h4 style="padding-bottom:0px;">' . esc_html__('Already Added Sidebars', 'jobcareer') . '</h4>
						  <div class="clear"></div>
						</div>
						<div class="boxes">
							<table class="to-table" border="0" cellspacing="0">
							<thead>
								<tr>
									<th>' . esc_html__('Sider Bar Name', 'jobcareer') . '</th>
									<th>' . esc_html__('Sider Bar Width', 'jobcareer') . '</th>
									<th class="centr">' . esc_html__("Actions", 'jobcareer') . '</th>
								</tr>
							</thead>
							<tbody id="footer_sidebar_area">';
                        if ($display == 'block') {
                            $i = 0;

                            // var_dump($val['footer_width']);


                            foreach ($val['footer_sidebar'] as $footer_sidebar) {
                                ?>
                                <script type="text/javascript">
                                    var $ = jQuery;
                                    $(document).ready(function () {
                                        function slideout() {
                                            setTimeout(function () {
                                                $("#footer_sidebar_area").slideUp("slow", function () {
                                                });

                                            }, 2000);
                                        }


                                        $(function () {
                                            $("#footer_sidebar_area").sortable({opacity: 0.8, cursor: 'move', update: function () {

                                                    $("#footer_sidebar_area").html(theResponse);
                                                    $("#footer_sidebar_area").slideDown('slow');
                                                    slideout();

                                                }
                                            });
                                        });

                                    });
                                </script> 
                                <?php

                                $output.='<tr id="footer_sidebar_' . $i . '">
							
											<td>';

                                $cs_footer_sidebar_name = jobcareer_get_sidebar_id($footer_sidebar);
                                $cs_footer_sidebar_width = $jobcareer_options['footer_width'][$i];

                                $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                    'std' => isset($footer_sidebar) ? $footer_sidebar : '',
                                    'id' => "hide_footer_sidebar" . $i,
                                    'cust_name' => 'footer_sidebar[]',
                                    'cust_type' => 'hidden',
                                    'return' => true,
                                ));

                                $output.= $footer_sidebar;

                                $output.='<td>';

                                $cs_footer_sidebar_name = jobcareer_get_sidebar_id($footer_sidebar);

                                $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                    'std' => isset($cs_footer_sidebar_width) ? $cs_footer_sidebar_width : '',
                                    'id' => "hide_footer_sidebar_width" . $i,
                                    'cust_name' => 'footer_width[]',
                                    'cust_type' => 'hidden',
                                    'return' => true,
                                ));

                                $output.= $cs_footer_sidebar_width;

                                $output.= '</td>';

                                $output.= '</td> 
											<td class="centr"> <a class="remove-btn" onclick="javascript:return confirm(\''.esc_html__('Are you sure! You want to delete this','jobcareer').'\')" href="javascript:cs_div_remove(\'footer_sidebar_' . $i . '\')" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Remove','jobcareer').'"><i class="icon-times"></i></a>
										</td>
									</tr>';
                                $i++;
                            }
                        };
                        $output.='</tbody>
							</table>
						</div>
					</div>';
                        break;

                    case 'select_footer_sidebar':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $cs_single_post_layout = $jobcareer_options['cs_single_post_layout'];

                        if (isset($cs_single_post_layout) and $cs_single_post_layout == 'no_footer_sidebar') {
                            $cus_style = ' style="display:none;"';
                        } else {
                            $cus_style = ' style="display:block;"';
                        }
                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'extra_att' => isset($cus_style) ? $cus_style : '',
                            'desc' => $value['desc'],
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'options' => $value['options']['footer_sidebar'],
                                'return' => true,
                                'classes' => $cs_classes,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case 'select_footer_sidebar1':

                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $cs_single_post_layout = $jobcareer_options['cs_default_page_layout'];

                        if (isset($cs_single_post_layout) and $cs_single_post_layout == 'no_footer_sidebar') {
                            $cus_style = ' style="display:none;"';
                        } else {
                            $cus_style = ' style="display:block;"';
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => $value['id'] . '_header',
                            'extra_att' => isset($cus_style) ? $cus_style : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => $cs_classes,
                                'options' => $value['options']['footer_sidebar'],
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;
                    case 'mailchimp':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => $select_value,
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => $cs_classes,
                                'options' => isset($value['options']) ? $value['options'] : '',
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        break;

                    case "wpml":
                        $saved_std = '';
                        $std = '';
                        if (function_exists('icl_object_id')) {
                            if (isset($jobcareer_options)) {
                                if (isset($jobcareer_options[$value['id']])) {
                                    $saved_std = $jobcareer_options[$value['id']];
                                }
                            } else {
                                $std = $value['std'];
                            }
                            $checked = '';
                            if (!empty($saved_std)) {
                                if ($saved_std == 'on') {
                                    $checked = 'checked="checked"';
                                } else {
                                    $checked = '';
                                }
                            } elseif ($std == 'on') {
                                $checked = 'checked="checked"';
                            } else {
                                $checked = '';
                            }
                            $cs_opt_array = array(
                                'name' => isset($value['name']) ? $value['name'] : '',
                                'id' => isset($value['id']) ? $value['id'] : '',
                                'desc' => isset($value['desc']) ? $value['desc'] : '',
                                'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                                'field_params' => array(
                                    'std' => isset($std) ? $std : '',
                                    'cust_id' => isset($value['id']) ? $value['id'] : '',
                                    'cust_name' => isset($value['id']) ? $value['id'] : '',
                                    'return' => true,
                                ),
                            );

                            if (isset($value['split']) && $value['split'] <> '') {
                                $cs_opt_array['split'] = $value['split'];
                            }

                            $output .= $jobcareer_html_fields->cs_checkbox_field($cs_opt_array);
                        }
                        break;
                    case "checkbox":
                        $saved_std = '';
                        $std = '';
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $std = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $std = $value['std'];
                        }

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'main_id' => isset($value['id']) ? $value['id'] . '_main' : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => $value['hint_text'],
                            'field_params' => array(
                                'std' => isset($std) ? $std : '',
                                'id' => isset($value['id']) ? $value['id'] : '',
                                'prefix_enable' => false,
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'return' => true,
                            ),
                        );

                        $output .= $jobcareer_html_fields->cs_checkbox_field($cs_opt_array);

                        break;


                    case "layout_body_color":
                        $val = $value['std'];
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $val = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $std = $value['std'];
                            if ($std != '') {
                                $val = $std;
                            }
                        }
                        $cs_hint = isset($value['hint_text']) ? $value['hint_text'] : '';

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'styles' => 'display:none;',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => isset($val) ? $val : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => 'bg_color',
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        break;
                    case "color":
                        $val = $value['std'];
                        if (isset($jobcareer_options)) {
                            if (isset($jobcareer_options[$value['id']])) {
                                $val = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $std = $value['std'];
                            if ($std != '') {
                                $val = $std;
                            }
                        }
                        $cs_hint = isset($value['hint_text']) ? $value['hint_text'] : '';
                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'field_params' => array(
                                'std' => isset($val) ? $val : '',
                                'cust_id' => isset($value['id']) ? $value['id'] : '',
                                'cust_name' => isset($value['id']) ? $value['id'] : '',
                                'classes' => 'bg_color',
                                'return' => true,
                            ),
                        );

                        if (isset($value['split']) && $value['split'] <> '') {
                            $cs_opt_array['split'] = $value['split'];
                        }

                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        break;

                    case "upload logo":

                        $cs_counter++;
                        if (isset($jobcareer_options) and $jobcareer_options <> '' && isset($jobcareer_options[$value['id']])) {
                            $val = $jobcareer_options[$value['id']];
                        } else {
                            $val = $value['std'];
                        }
                        $display = ($val <> '' ? 'display' : 'none');

                        $cs_opt_array = array(
                            'name' => isset($value['name']) ? $value['name'] : '',
                            'id' => isset($value['id']) ? $value['id'] : '',
                            'main_id' => isset($value['mian_id']) ? $value['mian_id'] : '',
                            'std' => $val,
                            'desc' => isset($value['desc']) ? $value['desc'] : '',
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                            'prefix' => '',
                            'field_params' => array(
                                'std' => isset($val) ? $val : '',
                                'id' => isset($value['id']) ? $value['id'] : '',
                                'prefix' => '',
                                'return' => true,
                            ),
                        );

                        $output .= $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

                        break;
                    case "upload font":
                        $cs_counter++;
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            $val = $jobcareer_options[$value['id']];
                        } else {
                            $val = $value['std'];
                        }
                        $display = ($val <> '' ? 'display' : 'none');

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => $value["name"],
                            'hint_text' => '',
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => isset($val) ? $val : '',
                            'cust_id' => isset($value['id']) ? $value['id'] : '',
                            'cust_name' => isset($value['id']) ? $value['id'] : '',
                            'classes' => 'input-medium',
                            'return' => true,
                        ));

                        $output .= '
					<label class="browse-icon">';

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => esc_html__('Browse', 'jobcareer'),
                            'id' => 'add_btn',
                            'cust_name' => isset($value['id']) ? $value['id'] : '',
                            'cust_type' => 'button',
                            'classes' => 'jobcareer_uploadMedia left',
                            'return' => true,
                        ));

                        $output .= '
					</label>';

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );
                        break;
                    case 'select_dashboard':
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (isset($jobcareer_options[$value['id']])) {
                                $select_value = $jobcareer_options[$value['id']];
                            }
                        } else {
                            $select_value = $value['std'];
                        }
                        $args = array(
                            'depth' => 0,
                            'child_of' => 0,
                            'sort_order' => 'ASC',
                            'sort_column' => 'post_title',
                            'show_option_none' => 'Please select a page',
                            'hierarchical' => '1',
                            'exclude' => '',
                            'include' => '',
                            'meta_key' => '',
                            'meta_value' => '',
                            'authors' => '',
                            'exclude_tree' => '',
                            'selected' => $select_value,
                            'echo' => 0,
                            'name' => isset($value['id']) ? $value['id'] : '',
                            'post_type' => 'page'
                        );

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => $value["name"],
                            'hint_text' => isset($value['hint_text']) ? $value['hint_text'] : '',
                                )
                        );
                        $output .= wp_dropdown_pages($args);

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        break;

                    case "networks":
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {
                            if (!isset($jobcareer_options['social_net_awesome']) and ! isset($jobcareer_options['social_net_awesome'])) {
                                $network_list = '';
                                $display = 'none';
                            } else {
                                $network_list = $jobcareer_options['social_net_awesome'];
                                $social_net_tooltip = $jobcareer_options['social_net_tooltip'];
                                $social_net_icon_path = $jobcareer_options['social_net_icon_path'];
                                $social_net_url = $jobcareer_options['social_net_url'];
                                $social_font_awesome_color = $jobcareer_options['social_font_awesome_color'];
                                $display = 'block';
                            }
                        } else {
                            $val = $value['options'];
                            $std = $value['id'];
                            $display = 'block';
                            $network_list = $val['social_net_awesome'];
                            $social_net_tooltip = $val['social_net_tooltip'];
                            $social_net_icon_path = $val['social_net_icon_path'];
                            $social_net_url = $val['social_net_url'];
                            $social_font_awesome_color = $val['social_font_awesome_color'];
                        }

                        $cs_opt_array = array(
                            'name' => esc_html__('Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter title text for icon', 'jobcareer'),
                            'field_params' => array(
                                'std' => '',
                                'cust_id' => 'social_net_tooltip_input',
                                'cust_name' => '',
                                'return' => true,
                            ),
                        );

                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Url', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter full URL of your social network', 'jobcareer'),
                            'field_params' => array(
                                'std' => '',
                                'cust_id' => 'social_net_url_input',
                                'cust_name' => '',
                                'return' => true,
                            ),
                        );

                        $output .= $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'std' => '',
                            'id' => 'social_net_icon_path_input',
                            'name' => esc_html__('Icon Path', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Attach your custom icon from media.', 'jobcareer'),
                            'prefix' => '',
                            'field_params' => array(
                                'std' => '',
                                'id' => 'social_net_icon_path_input',
                                'return' => true,
                                'array_txt' => false,
                                'prefix' => '',
                            ),
                        );

                        $output .= $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);


                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'id' => 'cs_infobox_networks' . $counter,
                            'name' => esc_html__("Fontawsome Icon ", 'jobcareer'),
                            'hint_text' => esc_html__('Choose icon from icon picker.', 'jobcareer'),
                                )
                        );
                        $output .= jobcareer_fontawsome_theme_options("", "networks" . $counter, 'social_net_awesome_input');

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => esc_html__("FontAwesome Color", 'jobcareer'),
                            'hint_text' => esc_html__('Provide a hex color code here (with #) for selected icon.', 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => '',
                            'cust_id' => 'social_font_awesome_color',
                            'cust_name' => 'social_font_awesome_color',
                            'classes' => 'bg_color',
                            'extra_atr' => ' data-default-color="#eee"',
                            'return' => true,
                        ));
                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => '&nbsp;',
                            'hint_text' => '',
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => esc_html__('Add', 'jobcareer'),
                            'cust_id' => 'add_social_icon',
                            'cust_name' => '',
                            'cust_type' => 'button',
                            'classes' => 'cs-btn-floating',
                            'extra_atr' => ' onclick=javascript:jobcareer_add_social_icon("' . admin_url("admin-ajax.php") . '")',
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '<div class="clear"></div>
                              <div class="social-area" style="display:' . $display . '">
                              <div class="theme-help">
                                    <h4 class="cs-dragmain">' . esc_html__("Already Added Social Icons", 'jobcareer') . '</h4>
                                    <div class="clear"></div>
                              </div>
                              <div class="boxes">
                              <table class="to-table" border="0" cellspacing="0">
                                      <thead>
                                            <tr>
                                              <th>' . esc_html__("Icon Path", 'jobcareer') . '</th>
                                              <th>' . esc_html__("Network Name", 'jobcareer') . '</th>
                                              <th>' . esc_html__("Url", 'jobcareer') . '</th>
											  <th>' . esc_html__("Icon", 'jobcareer') . '</th>
                                              <th class="centr">' . esc_html__("Actions Icon", 'jobcareer') . '</th>
                                            </tr>
                                      </thead>
                                      <tbody id="social_network_area">';
                        ?>

                        <script type="text/javascript">
                            var $ = jQuery;
                            $(document).ready(function () {
                                function slideout() {
                                    setTimeout(function () {
                                        $("#social_network_area").slideUp("slow", function () {
                                        });

                                    }, 2000);
                                }


                                $(function () {
                                    $("#social_network_area").sortable({opacity: 0.8, cursor: 'move', update: function () {

                                            $("#social_network_area").html(theResponse);
                                            $("#social_network_area").slideDown('slow');
                                            slideout();

                                        }
                                    });
                                });

                            });
                        </script> 
                        <?php

                        $i = 0;
                        if ($network_list <> '') {
                            foreach ($network_list as $network) {
                                if (isset($network_list[$i]) || isset($network_list[$i])) {
                                    $output.='<tr id="del_' . str_replace(' ', '-', $social_net_tooltip[$i]) . '"><td>';
                                    if (isset($network_list[$i]) and $network_list[$i] <> '') {
                                        $output .= '<i style="color:' . $social_font_awesome_color[$i] . ';" class="fa ' . $network_list[$i] . ' icon-2x"></i>';
                                    } else {
                                        $output.='<img width="50" src="' . esc_url($social_net_icon_path[$i]) . '">';
                                    }
                                    $output .= '</td><td>' . $social_net_tooltip[$i] . '</td>';
                                    $output .= '<td><a href="' . $social_net_url[$i] . '">' . $social_net_url[$i] . '</a></td>';
                                    if (isset($social_net_icon_path[$i]) and $social_net_icon_path[$i] <> '') {
                                        $output .= '<td> <img src="' . esc_url($social_net_icon_path[$i]) . '" height="50" width="50" ></td>';
                                    } else {
                                        $output .= '<td>&nbsp;</td>';
                                    }
                                    $output .= '<td class="centr"> 
                                                <a class="remove-btn" onclick="javascript:return confirm(\''.esc_html__('Are you sure! You want to delete this', 'jobcareer').'\')" href="javascript:social_icon_del(\'' . str_replace(' ', '-', $social_net_tooltip[$i]) . '\')" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Remove', 'jobcareer').'">
                                                <i class="icon-times"></i></a>
                                                <a href="javascript:cs_toggle(\'' . str_replace(' ', '-', $social_net_tooltip[$i]) . '\')" data-toggle="tooltip" data-placement="top" title="'. esc_html__('Edit', 'jobcareer') .'">
                                                      <i class="icon-pencil6"></i>
                                                </a>
                                            </td></tr>';

                                    $output .= '<tr id="' . str_replace(' ', '-', $social_net_tooltip[$i]) . '" style="display:none">
                                            <td colspan="5">
											<div>
                                            <div  class="close_btn"><a onclick="cs_toggle(\'' . str_replace(' ', '-', $social_net_tooltip[$i]) . '\')"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/close-red.png" /></a></div>';

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("Title", 'jobcareer'),
                                        'hint_text' => esc_html__("Please enter text for icon tooltip", 'jobcareer'),
                                            )
                                    );

                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($social_net_tooltip[$i]) ? $social_net_tooltip[$i] : '',
                                        'cust_id' => 'social_net_tooltip',
                                        'cust_name' => 'social_net_tooltip[]',
                                        'classes' => 'small',
                                        'return' => true,
                                    ));
                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("URL", 'jobcareer'),
                                        'hint_text' => esc_html__("Please enter url", 'jobcareer'),
                                            )
                                    );
                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($social_net_url[$i]) ? $social_net_url[$i] : '',
                                        'cust_id' => 'social_net_url',
                                        'cust_name' => 'social_net_url[]',
                                        'classes' => 'small',
                                        'return' => true,
                                    ));
                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $cs_opt_array = array(
                                        'std' => isset($social_net_icon_path[$i]) ? $social_net_icon_path[$i] : '',
                                        'id' => 'social_net_icon_path',
                                        'name' => esc_html__('Icon Path', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__("Please enter text for icon tooltip", 'jobcareer'),
                                        'array' => true,
                                        'prefix' => '',
                                        'field_params' => array(
                                            'std' => isset($social_net_icon_path[$i]) ? $social_net_icon_path[$i] : '',
                                            'id' => 'social_net_icon_path',
                                            'return' => true,
                                            'array' => true,
                                            'array_txt' => false,
                                            'prefix' => '',
                                        ),
                                    );

                                    $output .= $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'id' => 'cs_infobox_theme_options' . $i,
                                        'name' => esc_html__("Font awsome Icon", 'jobcareer'),
                                        'hint_text' => '',
                                            )
                                    );

                                    $output .= jobcareer_fontawsome_theme_options($network_list[$i], "theme_options" . $i, 'social_net_awesome');

                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("Font awesome Color", 'jobcareer'),
                                        'hint_text' => '',
                                            )
                                    );

                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($social_font_awesome_color[$i]) ? $social_font_awesome_color[$i] : '',
                                        'cust_id' => 'social_font_awesome_color',
                                        'cust_name' => 'social_font_awesome_color[]',
                                        'classes' => 'bg_color',
                                        'return' => true,
                                    ));

                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= ' </div>  </td>
                                        </tr>';
                                }
                                $i++;
                            }
                        }

                        $output .= '</tbody></table></div></div>';

                        break;
                        $output .= '</div>';

                    case "banner_fields":
                        $cs_rand_id = rand(23789, 534578930);
                        if (isset($jobcareer_options) and $jobcareer_options <> '') {

                            if (!isset($jobcareer_options['banner_field_title'])) {
                                $banner_fields = '';
                                $banner_fields_style = '';
                                $banner_fields_type = '';
                                $banner_fields_image = '';
                                $banner_fields_url = '';
                                $banner_fields_url_target = '';
                                $banner_fields_code = '';
                                $banner_fields_code_no = '';
                                $display = 'none';
                            } else {
                                $banner_fields = $jobcareer_options['banner_field_title'];
                                $banner_fields_style = $jobcareer_options['banner_field_style'];
                                $banner_fields_type = $jobcareer_options['banner_field_type'];
                                $banner_fields_image = $jobcareer_options['banner_field_image'];
                                $banner_fields_url = $jobcareer_options['banner_field_url'];
                                $banner_fields_url_target = $jobcareer_options['banner_field_url_target'];
                                $banner_fields_code = $jobcareer_options['banner_adsense_code'];
                                $banner_fields_code_no = $jobcareer_options['banner_field_code_no'];
                                $display = 'block';
                            }
                        } else {
                            $val = $value['options'];
                            $std = $value['id'];
                            $display = 'block';
                            $banner_fields = isset($jobcareer_options['banner_field_title']) ? $jobcareer_options['banner_field_title']:'';
                            $banner_fields_style = isset($jobcareer_options['banner_field_style']) ? $jobcareer_options['banner_field_style']:'';
                            $banner_fields_type = isset($jobcareer_options['banner_field_type']) ? $jobcareer_options['banner_field_type']:'';
                            $banner_fields_image = isset($jobcareer_options['banner_field_image']) ? $jobcareer_options['banner_field_image']:'';
                            $banner_fields_url = isset($jobcareer_options['banner_field_url']) ? $jobcareer_options['banner_field_url']:'';
                            $banner_fields_url_target = isset($jobcareer_options['banner_field_url_target']) ? $jobcareer_options['banner_field_url_target']:'';
                            $banner_fields_code = isset($jobcareer_options['banner_adsense_code']) ? $jobcareer_options['banner_adsense_code']:'';
                            $banner_fields_code_no = isset($jobcareer_options['banner_field_code_no']) ? $jobcareer_options['banner_field_code_no']:'';
                        }


                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => esc_html__("Banner Title", 'jobcareer'),
                            'hint_text' => '',
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => '',
                            'cust_id' => 'banner_title_input',
                            'cust_name' => '',
                            'classes' => 'small',
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => esc_html__("Banner Style", 'jobcareer'),
                            'hint_text' => esc_html__("Select banner style from here.", 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_select_render(array(
                            'std' => '',
                            'cust_id' => 'banner_style_input',
                            'cust_name' => '',
                            'classes' => 'chosen-select-no-single',
                            'options' => array('top_banner' => esc_html__('Top Banner', 'jobcareer'), 'bottom_banner' => esc_html__('Bottom Banner', 'jobcareer'), 'sidebar_banner' => esc_html__('Sidebar Banner', 'jobcareer'), 'vertical_banner' => esc_html__('Vertical Banner', 'jobcareer'),),
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => esc_html__("Banner Type", 'jobcareer'),
                            'hint_text' => esc_html__("Select banner type from here.", 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_select_render(array(
                            'std' => '',
                            'cust_id' => 'banner_type_input',
                            'cust_name' => '',
                            // 'classes' => $cs_classes,
                            'classes' => 'chosen-select-no-single',
                            'extra_atr' => ' onchange="cs_banner_type_toggle(this.value, \'' . $cs_rand_id . '\')"',
                            'options' => array('image' => esc_html__('Image', 'jobcareer'), 'code' => esc_html__('Code', 'jobcareer')),
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '
					<div class="form-elements" id="cs_banner_image_field_' . $cs_rand_id . '">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					  <label>' . esc_html__('Image', 'jobcareer') . '</label>';
                        $output .= jobcareer_tooltip_text(esc_html(esc_html__("Select banner image from media.", 'jobcareer')));
                        $output .= '</div>
					<div class=" demo_abcd col-lg-8 col-md-8 col-sm-12 col-xs-12" id="cs_banner_image_value_' . $cs_rand_id . '">';

                        $output .= '
					  <ul id="' . $cs_rand_id . '_upload">
						<li>';
                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => '',
                            'cust_id' => 'banner_field_image' . $cs_rand_id,
                            'cust_name' => '',
                            'cust_type' => 'hidden',
                            'classes' => 'small',
                            'return' => true,
                        ));
                        $output .= '
						  <label class="browse-icon">';
                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => esc_html__('Browse', 'jobcareer'),
                            'cust_id' => 'browse-one',
                            'cust_name' => 'banner_field_image' . $cs_rand_id,
                            'cust_type' => 'button',
                            'classes' => 'jobcareer_uploadMedia left',
                            'return' => true,
                        ));
                        $output .= '
						</li>
					  </ul>';

                        $output .= '
					  <div class="page-wrap" style="overflow:hidden;display:none" id="banner_field_image' . $cs_rand_id . '_box" >';

                        if (isset($banner_fields_image[$i]) && $banner_fields_image[$i] <> "") {
                            $output .= '<div class="gal-active cs-galactive">
                                          <div class="dragareamain cs-dragmain">
                                                <ul id="gal-sortable">
                                                  <li class="ui-state-default" id="">
                                                        <div class="thumb-secs"> <img src="" id="banner_field_image' . $cs_rand_id . '_img" alt=""  />
                                                          <div class="gal-edit-opts"> <a href=javascript:del_media("banner_field_image' . $cs_rand_id . '") class="delete"></a> </div>
                                                        </div>
                                                  </li>
                                                </ul>
                                          </div>
									</div>';
                        }

                        $output.= '</div>
						</div>
					</div>';

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => esc_html__("Url", 'jobcareer'),
                            'hint_text' => esc_html__("Add URL of Image.", 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => '',
                            'cust_id' => 'banner_field_url_input',
                            'cust_name' => '',
                            'classes' => 'small',
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => esc_html__("Target", 'jobcareer'),
                            'hint_text' => esc_html__("Select target blank for open add in new tab or self for open in same window.", 'jobcareer'),
                                )
                        );

                        $output .= $jobcareer_form_fields->cs_form_select_render(array(
                            'std' => '',
                            'cust_id' => 'banner_field_url_target_input',
                            'cust_name' => '',
                            'classes' => 'chosen-select-no-single',
                            'options' => array('_self' => esc_html__('Self', 'jobcareer'), '_blank' => esc_html__('Blank', 'jobcareer')),
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '
					  <div class="form-elements" id="cs_banner_code_field_' . $cs_rand_id . '" style="display:none;">
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<label>' . esc_html__('Adsense Code', 'jobcareer') . ' <span>' . '</label>';
                        $output .= jobcareer_tooltip_text(esc_html(esc_html__("Add your adsence code here.", 'jobcareer')));

                        $output .= '
					  	</div>
					  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="cs_banner_code_value_' . $cs_rand_id . '" style="display:none;">';

                        $output .= $jobcareer_form_fields->cs_form_textarea_render(array(
                            'std' => '',
                            'cust_id' => 'banner_adsense_code_input',
                            'cust_name' => '',
                            'return' => true,
                        ));

                        $output .= '  
					  </div>
					  </div>';

                        $output .= $jobcareer_html_fields->cs_opening_field(array(
                            'name' => '&nbsp;',
                            'hint_text' => '',
                                )
                        );

                        $output .= '
					  <span id="banner-loader"></span>';

                        $output .= $jobcareer_form_fields->cs_form_text_render(array(
                            'std' => esc_html__('Add', 'jobcareer'),
                            'cust_id' => 'add-banre',
                            'cust_name' => '',
                            'cust_type' => 'button',
                            'extra_atr' => ' onclick=javascript:jobcareer_add_banner_fields("' . admin_url("admin-ajax.php") . '","' . esc_js(get_template_directory_uri()) . '","' . $cs_rand_id . '")',
                            'classes' => 'cs-btn-floating',
                            'return' => true,
                        ));

                        $output .= $jobcareer_html_fields->cs_closing_field(array(
                            'desc' => '',
                                )
                        );

                        $output .= '
					  <div class="clear"></div>
					  <div class="banner-fields-area" style="display:' . $display . '">
					  <div class="theme-help">
							<h4 class="cs-dragmain">' . esc_html__('Already Added Banners', 'jobcareer') . '</h4>
							<div class="clear"></div>
					  </div>
					  <div class="boxes">
					  <table class="to-table" border="0" cellspacing="0">
							  <thead>
									<tr>
									  <th>' . esc_html__('Title', 'jobcareer') . '</th>
									  <th>' . esc_html__('Style', 'jobcareer') . '</th>
									  <th>' . esc_html__('Image', 'jobcareer') . '</th>
									  <th>' . esc_html__('Clicks', 'jobcareer') . '</th>
									  <th>' . esc_html__('Shortcode', 'jobcareer') . '</th>
									</tr>
							  </thead>
							  <tbody id="cs_banner_fields">';
                        ?>

                        <script type="text/javascript">
                            var $ = jQuery;
                            $(document).ready(function () {
                                function slideout() {
                                    setTimeout(function () {
                                        $("#cs_banner_fields").slideUp("slow", function () {
                                        });

                                    }, 2000);
                                }


                                $(function () {
                                    $("#cs_banner_fields").sortable({opacity: 0.8, cursor: 'move', update: function () {

                                            $("#cs_banner_fields").html(theResponse);
                                            $("#cs_banner_fields").slideDown('slow');
                                            slideout();

                                        }
                                    });
                                });

                            });
                        </script> 
                        <?php

                        $i = 0;
                        if ($banner_fields <> '') {
                            foreach ($banner_fields as $field) {
                                $cs_rand_id = rand(23789, 934578930) . $i;
                                if (isset($banner_fields[$i]) || isset($banner_fields[$i])) {
                                    // Image Display Block Check
                                    $cs_image_display = $banner_fields_image[$i] <> '' ? 'block' : 'none';
                                    // Banner Style Check
                                    $cs_top_banner_selected = $banner_fields_style[$i] == 'top_banner' ? 'selected' : '';
                                    $cs_bottom_banner_selected = $banner_fields_style[$i] == 'bottom_banner' ? 'selected' : '';
                                    $cs_sidebar_banner_selected = $banner_fields_style[$i] == 'sidebar_banner' ? 'selected' : '';
                                    $cs_vertical_banner_selected = $banner_fields_style[$i] == 'vertical_banner' ? 'selected' : '';
                                    // Banner Type Check
                                    $cs_image_banner_selected = $banner_fields_type[$i] == 'image' ? 'selected' : '';
                                    $cs_code_banner_selected = $banner_fields_type[$i] == 'code' ? 'selected' : '';
                                    // Banner Type Display Block Check
                                    $cs_baner_image_display = $banner_fields_type[$i] == 'image' ? 'block' : 'none';
                                    $cs_baner_code_display = $banner_fields_type[$i] == 'code' ? 'block' : 'none';
                                    // Target Check
                                    $cs_self_target_selected = $banner_fields_url_target[$i] == '_self' ? 'selected' : '';
                                    $cs_blank_target_selected = $banner_fields_url_target[$i] == '_blank' ? 'selected' : '';

                                    if ($banner_fields_style[$i] == 'top_banner') {
                                        $cs_banner_group = 'Top';
                                    } else if ($banner_fields_style[$i] == 'bottom_banner') {
                                        $cs_banner_group = 'Bottom';
                                    } else if ($banner_fields_style[$i] == 'sidebar_banner') {
                                        $cs_banner_group = 'Sidebar';
                                    } else {
                                        $cs_banner_group = 'Vertical';
                                    }
                                    $output.='<tr id="del_' . jobcareer_slugify_text($banner_fields[$i]) . '">';
                                    $output .= '<td>' . $banner_fields[$i] . '</td>';
                                    $output .= '<td>' . $cs_banner_group . '</td>';
                                    if ($banner_fields_type[$i] == 'image') {
                                        if ($banner_fields_image[$i] <> '') {
                                            $output .= '<td><img src="' . esc_url($banner_fields_image[$i]) . '" alt="" width="100" /></td>';
                                        } else {
                                            $output .= '<td>&nbsp;</td>';
                                        }
                                    } else {
                                        $output .= '<td>' . esc_html__('Custom Code', 'jobcareer') . '</td>';
                                    }
                                    if ($banner_fields_type[$i] == 'image') {

                                        $cs_banner_click_count = get_option("cs_banner_clicks_" . $banner_fields_code_no[$i]);
                                        $cs_banner_click_count = $cs_banner_click_count <> '' ? $cs_banner_click_count : '0';
                                        $output .= '<td>' . $cs_banner_click_count . '</td>';
                                    } else {
                                        $output .= '<td>&nbsp;</td>';
                                    }

                                    $output .= '<td>[cs_ads id="' . $banner_fields_code_no[$i] . '"]</td>';
                                    $output .= '<td class="centr"> 
                                                    <a class="remove-btn" onclick="javascript:return confirm(\''.esc_html__('Are you sure! You want to delete this', 'jobcareer').'\')" href="javascript:social_icon_del(\'' . jobcareer_slugify_text($banner_fields[$i]) . '\')" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Remove', 'jobcareer').'">
                                                    <i class="icon-cross3"></i></a>
                                                    <a href="javascript:cs_toggle(\'' . jobcareer_slugify_text($banner_fields[$i]) . '\')" data-toggle="tooltip" data-placement="top" title="Edit">
                                                          <i class="icon-pencil6"></i>
                                                    </a>
                                            </td>
                                          </tr>';
                                    $output .= '<tr id="' . jobcareer_slugify_text($banner_fields[$i]) . '" style="display:none">
                                            <td colspan="6">
											<div>
                                            	<div class="close_btn"><a onclick="cs_toggle(\'' . jobcareer_slugify_text($banner_fields[$i]) . '\')"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/close-red.png" /></a></div>';

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("Title", 'jobcareer'),
                                        'hint_text' => esc_html__("Please enter Banner Title.", 'jobcareer'),
                                            )
                                    );

                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($banner_fields[$i]) ? $banner_fields[$i] : '',
                                        'cust_id' => 'add-banre' . $i,
                                        'cust_name' => 'banner_field_title[]',
                                        'classes' => 'small',
                                        'return' => true,
                                    ));
                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("Banner Style", 'jobcareer'),
                                        'hint_text' => esc_html__("Please select Banner Style.", 'jobcareer'),
                                            )
                                    );
                                    $output .= $jobcareer_form_fields->cs_form_select_render(array(
                                        'std' => isset($cs_top_banner_selected) ? $cs_top_banner_selected : '',
                                        'classes' => 'chosen-select-no-single',
                                        'cust_id' => 'banner-style' . $cs_rand_id,
                                        'cust_name' => 'banner_field_style[]',
                                        'options' => array('top_banner' => esc_html__('Top Banner', 'jobcareer'), 'bottom_banner' => esc_html__('Bottom Banner', 'jobcareer'), 'sidebar_banner' => esc_html__('Sidebar Banner', 'jobcareer'), 'vertical_banner' => esc_html__('Vertical Banner', 'jobcareer'),),
                                        'return' => true,
                                    ));

                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("Banner Type", 'jobcareer'),
                                        'hint_text' => esc_html__("Please select Banner Type.", 'jobcareer'),
                                            )
                                    );
                                    $output .= $jobcareer_form_fields->cs_form_select_render(array(
                                        'std' => isset($cs_image_banner_selected) ? $cs_image_banner_selected : '',
                                        'classes' => $cs_classes,
                                        'cust_id' => 'banner-style' . $cs_rand_id,
                                        'cust_name' => 'banner_field_type[]',
                                        'classes' => 'chosen-select-no-single',
                                        'extra_atr' => ' onchange="cs_banner_type_toggle(this.value, \'' . $cs_rand_id . '\')"',
                                        'options' => array('image' => esc_html__('Image', 'jobcareer'), 'code' => esc_html__('Code', 'jobcareer')),
                                        'return' => true,
                                    ));

                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= '
							<div class="form-elements" id="cs_banner_image_field_' . $cs_rand_id . '" style="display:' . $cs_baner_image_display . ';">
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								  	<label>' . esc_html__('Image', 'jobcareer') . '</label>
								</div>
                                                    
								<div  class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="cs_banner_image_value_' . $cs_rand_id . '" >';

                                    $output .= '<ul id="' . $i . '_upload">
												<li>';
                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($banner_fields_image[$i]) ? $banner_fields_image[$i] : '',
                                        'cust_id' => 'banner_field_image' . $i,
                                        'cust_name' => 'banner_field_image[]',
                                        'cust_type' => 'hidden',
                                        'classes' => '',
                                        'return' => true,
                                    ));
                                    $output .= '<label class="browse-icon">';

                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => esc_html__('Browse', 'jobcareer'),
                                        'cust_id' => 'type-abnre' . $i,
                                        'cust_name' => 'banner_field_image' . $i,
                                        'cust_type' => 'button',
                                        'classes' => 'jobcareer_uploadMedia left',
                                        'return' => true,
                                    ));
                                    $output .= '</li>
											</ul>';



                                    $output .= '<div class="page-wrap" style="overflow:hidden;display:' . $cs_image_display . ';" id="banner_field_image' . $i . '_box" >';

                                    if (isset($banner_fields_image[$i]) && $banner_fields_image[$i] <> "") {
                                        $output.=' <div class="gal-active cs-galactive">
																	  <div class="dragareamain cs-dragmain">
																		<ul id="gal-sortable">
																			  <li class="ui-state-default">
																				<div class="thumb-secs"> <img src="' . esc_url($banner_fields_image[$i]) . '" id="banner_field_image' . $i . '_img" />
																					  <div class="gal-edit-opts"> <a href=javascript:del_media("banner_field_image' . $i . '") class="delete"></a> </div>
																				</div>
																			  </li>
																		</ul>
															</div>
													</div>';
                                    }
                                    $output.='</div>';



                                    $output .='</div>
									   </div>';

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("URL", 'jobcareer'),
                                        'hint_text' => esc_html__("Please enter Banner Url", 'jobcareer'),
                                            )
                                    );

                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($banner_fields_url[$i]) ? $banner_fields_url[$i] : '',
                                        'cust_id' => 'type-abnre' . $i,
                                        'cust_name' => 'banner_field_url[]',
                                        'classes' => 'small',
                                        'return' => true,
                                    ));

                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= $jobcareer_html_fields->cs_opening_field(array(
                                        'name' => esc_html__("Target", 'jobcareer'),
                                        'hint_text' => esc_html__("Please select Banner Link Target", 'jobcareer'),
                                            )
                                    );

                                    $output .= $jobcareer_form_fields->cs_form_select_render(array(
                                        'std' => isset($cs_self_target_selected) ? $cs_self_target_selected : '',
                                        'classes' => 'chosen-select-no-single',
                                        'cust_id' => 'banner-style' . $cs_rand_id,
                                        'cust_name' => 'banner_field_url_target[]',
                                        'options' => array('_self' => esc_html__('Self', 'jobcareer'), '_blank' => esc_html__('Blank', 'jobcareer')),
                                        'return' => true,
                                    ));

                                    $output .= $jobcareer_html_fields->cs_closing_field(array(
                                        'desc' => '',
                                            )
                                    );

                                    $output .= '
                                                    <div class="form-elements" id="cs_banner_code_field_' . $cs_rand_id . '" style="display:' . $cs_baner_code_display . ';">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														  <label>' . esc_html__('Adsense Code', 'jobcareer') . '</label>
                                                    	</div>
                                                    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="cs_banner_code_value_' . $cs_rand_id . '" style="display:' . $cs_baner_code_display . ';">';

                                    $output .= $jobcareer_form_fields->cs_form_textarea_render(array(
                                        'std' => isset($banner_fields_code[$i]) ? $banner_fields_code[$i] : '',
                                        'cust_id' => 'type-abnre' . $i,
                                        'cust_name' => 'banner_adsense_code[]',
                                        'classes' => '',
                                        'return' => true,
                                    ));

                                    $output .= '</div></div>';

                                    $output .= $jobcareer_form_fields->cs_form_text_render(array(
                                        'std' => isset($banner_fields_code_no[$i]) ? $banner_fields_code_no[$i] : '',
                                        'cust_id' => 'type-abnre' . $i,
                                        'cust_name' => 'banner_field_code_no[]',
                                        'cust_type' => 'hidden',
                                        'classes' => '',
                                        'return' => true,
                                    ));

                                    $output .= ' </div></td> </tr>';
                                }
                                $i++;
                            }
                        }

                        $output .= '</tbody></table></div></div>';
                }
            }
            $output .= '</div>';
            return array($output, $menu);
        }

    }

}