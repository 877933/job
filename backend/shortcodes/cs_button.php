<?php
/*
 *
 * @Shortcode Name : Button
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_button')) {

    function jobcareer_pb_button($die = 0) {
        global $jobcareer_node, $cs_count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;

        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $PREFIX = CS_SC_BUTTON;
        $counter = $_POST['counter'];
        $parseObject = new ShortcodeParse();
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'column_size'=>'','button_size' => 'btn-lg', 'button_border' => '', 'border_button_color' => '', 'button_title' => '', 'button_link' => '#', 'button_color' => '', 'button_bg_color' => '', 'button_icon_position' => 'left', 'button_icon' => '', 'button_type' => 'rounded', 'button_target' => '_self');
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $atts_content = $output['0']['content'];
        } else {
            $atts_content = array();
        }
        $button_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_button';
        $cs_count_node++;
        $coloumn_class = 'column_' . $button_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }

        $rand_id = rand(45, 897009);
        ?>

        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="button" data="<?php echo jobcareer_element_size_data_array_index($button_element_size) ?>" >
        <?php jobcareer_element_setting($name, $cs_counter, $button_element_size, '', 'heart'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_BUTTON); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Button Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter) ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
					<?php
                    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                        jobcareer_shortcode_element_size();
                    }
                    ?>
        <?php
        $cs_opt_array = array(
            'name' => esc_html__('Label', 'jobcareer'),
            'desc' => '',
            'hint_text' => esc_html__("Add button text here", 'jobcareer'),
            'echo' => true,
            'field_params' => array(
                'std' => jobcareer_special_char($button_title),
                'cust_id' => '',
                'classes' => 'txtfield',
                'cust_name' => 'button_title[]',
                'return' => true,
            ),
        );
        $jobcareer_html_fields->cs_text_field($cs_opt_array);
        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Button Link', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Add your button link/URL here", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($button_link),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'button_link[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>




        <?php
        $cs_opt_array = array(
            'name' => esc_html__('Enable Border', 'jobcareer'),
            'desc' => '',
            'hint_text' => esc_html__("Enable/Disable button border with this drop down..", 'jobcareer'),
            'echo' => true,
            'field_params' => array(
                'std' => $button_border,
                'id' => '',
                'cust_id' => '',
                'cust_name' => 'button_border[]',
                'classes' => 'button_border chosen-select-no-single  select-small',
				'extra_atr' => ' onchange=cs_enable_border_change(this.value)',
                'options' => array(
                    'yes' => esc_html__('Yes', 'jobcareer'),
                    'no' => esc_html__('No', 'jobcareer'),
                ),
                'return' => true,
            ),
        );

        $jobcareer_html_fields->cs_select_field($cs_opt_array);
        ?>
		<?php 
		$cs_display_css_proprety='yes';
		if(isset($button_border) && $button_border!=''){
			if($button_border=='no'){
				$cs_display_css_proprety='none';
			}
			
		}
		?>
						<div class="border-div" style="display:<?php echo $cs_display_css_proprety; ?>">
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Border Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Define button border color with this color picker", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($border_button_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'border_button_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
						</div>
						<script type="text/javascript">
                                function cs_enable_border_change(selected_val) {

                                    if (selected_val == 'no') {
                                        $('.border-div').hide();
                                    }
                                    else {
                                        $('.border-div').show();
                                    }

                                }



                            </script>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Background Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Define button background color with this color picker.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($button_bg_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'button_bg_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>



                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Label Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Define button text color with this color picker.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($button_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'button_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Button Size', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select button size. Three sizes avaiable Large, Medium and Small", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $button_size,
                                'id' => '',
                                'cust_id' => 'button_size',
                                'cust_name' => 'button_size[]',
                                'classes' => 'button_size chosen-select-no-single select-medium',
                                'options' => array(
                                    'btn-lg' => esc_html__('Large', 'jobcareer'),
                                    'medium-btn' => esc_html__('Medium', 'jobcareer'),
                                    'btn-sml' => esc_html__('Small', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>
                        <div class="form-elements" id="cs_infobox_<?php echo esc_attr($name . $cs_counter); ?>">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label> <?php esc_html_e("Choose Icon:", 'jobcareer'); ?></label><a data-content="<?php esc_html_e("Select the Icons you would like to show in your button.", 'jobcareer'); ?>" data-trigger="hover" 
                                                                                         data-placement="right" data-toggle="popover" class="cs-help cs" data-original-title="" title=""><i class="icon-help"></i></a>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?php jobcareer_fontawsome_icons_box($button_icon, $rand_id, 'button_icon'); ?>
                                <p></p>
                            </div>
                        </div>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Button Icon Position', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Select button icon position with this dropdown", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $button_icon_position,
                                        'id' => '',
                                        'cust_id' => 'button_icon_position',
                                        'cust_name' => 'button_icon_position[]',
                                        'classes' => 'button_icon_position chosen-select-no-single select-medium',
                                        'options' => array(
                                            'left' => esc_html__('Left', 'jobcareer'),
                                            'right' => esc_html__('Right', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Button Type', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select button type with this dropdown two button types avaiable rounded and square", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $button_type,
                                'id' => '',
                                'cust_id' => 'button_type',
                                'cust_name' => 'button_type[]',
                                'classes' => 'button_type chosen-select-no-single select-medium',
                                'options' => array(
                                    'rectangle' => esc_html__('Square', 'jobcareer'),
                                    'rounded' => esc_html__('Rounded', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Open Link', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select target of your button with this drop down _blank, Opens the link in a new window or tab. _self, Opens the link in the same frame as it was clicked", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $button_target,
                                'id' => '',
                                'cust_id' => 'button_target',
                                'cust_name' => 'button_target[]',
                                'classes' => 'chosen-select-no-single button_target select-medium',
                                'options' => array(
                                    '_blank' => esc_html__('In New Tab', 'jobcareer'),
                                    '_self' => esc_html__('In Same Tab', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>




                    </div>
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>

            <?php
            $cs_opt_array = array(
                'std' => 'button',
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => '',
                'extra_atr' => '',
                'cust_id' => '',
                'cust_name' => 'cs_orderby[]',
                'return' => true,
                'required' => false
            );
            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
            ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => '',
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html__('Save', 'jobcareer'),
                                'cust_id' => '',
                                'cust_type' => 'button',
                                'classes' => 'cs-admin-btn',
                                'cust_name' => '',
                                'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                    <?php } ?>
                    <script>
                        /* modern selection box function */
                        jQuery(document).ready(function ($) {
                            chosen_selectionbox();
                            popup_over();
                        });
                        /* modern selection box function */
                    </script>
                </div>
            </div>
        </div>
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_button', 'jobcareer_pb_button');
}
