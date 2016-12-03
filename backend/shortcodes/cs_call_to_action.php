<?php
/*
 *
 * @File : Call to action
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_call_to_action')) {

    function jobcareer_pb_call_to_action($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $PREFIX = CS_SC_CALLTOACTION;
        $cs_counter = $_POST['counter'];
        $parseObject = new ShortcodeParse();
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
            'column_size' => '1/1',
            'cs_call_to_action_section_title' => '',
            'cs_content_type' => '',
            'cs_call_action_title' => '',
            'cs_call_action_contents' => '',
            'cs_contents_color' => '',
            'cs_call_action_icon' => '',
            'cs_icon_color' => '#FFF',
                'cs_call_to_action_icon_background_color' => '',
            'cs_call_to_action_icon_text_color' => '',
            'cs_call_to_action_button_text' => '',
            'cs_call_to_action_button_link' => '#',
            'cs_call_to_action_bg_img' => '',
            'animate_style' => 'slide',
            'class' => 'cs-article-box',
            'cs_contents_bg_color' => '',
            'cs_call_to_action_img' => '',
            'cs_call_action_text_align' => '',
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content']))
            $atts_content = $output['0']['content'];
        else
            $atts_content = "";
        $call_to_action_element_size = '100';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $name = 'jobcareer_pb_call_to_action';
        $coloumn_class = 'column_' . $call_to_action_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="call_to_action" data="<?php echo jobcareer_element_size_data_array_index($call_to_action_element_size) ?>">
            <?php jobcareer_element_setting($name, $cs_counter, $call_to_action_element_size, '', 'info-circle'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_CALLTOACTION); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_CALLTOACTION); ?>]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Call to Action options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter); ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
                        <?php
                        $sh_code = '';
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                            $sh_code = 1;
                        }

                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Add Call to Action element title here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($cs_call_to_action_section_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'cs_call_to_action_section_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("You can add title for call to action.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($cs_call_action_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'cs_call_action_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Content', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("You can add content for call to action.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($atts_content),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'cs_call_action_contents[]',
                                'return' => true,
                                'cs_editor' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );

                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Title Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Define call to action title color with this color picker.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_contents_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'cs_contents_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Background Color', 'jobcareer'),
                            'desc' => '',
                            'id' => 'call_to_action_id',
                            'hint_text' => esc_html__("Define call to action background color with this color picker.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_contents_bg_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'cs_contents_bg_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => $cs_call_to_action_img,
                            'id' => 'call_to_action_img',
                            'main_id' => 'call_to_action_img_id',
                            'name' => esc_html__('Background Image', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Select the background image for call to action element.', 'jobcareer'),
                            'echo' => true,
                            'array' => true,
                            'field_params' => array(
                                'std' => $cs_call_to_action_img,
                                'cust_id' => '',
                                'id' => 'call_to_action_img',
                                'return' => true,
                                'array' => true,
                                'array_txt' => false,
                            ),
                        );
                        if ($sh_code == 1){
                            $cs_opt_array['cus_rand_id'] = (string)jobcareer_generate_random_string(6);
                        }
                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Button Background Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set the button background color for your call to action.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_call_to_action_icon_background_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'cs_call_to_action_icon_background_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Button Text Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set the button text color for your call to action.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_call_to_action_icon_text_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'cs_call_to_action_icon_text_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Button Text', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter text of the button.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_call_to_action_button_text),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_call_to_action_button_text[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Button Link', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter button link here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_call_to_action_button_link),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_call_to_action_button_link[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Text Align', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_call_action_text_align),
                                'cust_id' => 'call_action_text_align',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'cust_name' => 'cs_call_action_text_align[]',
                                'options' => array(
                                    'left' => esc_html__('Left', 'jobcareer'),
                                    'right' => esc_html__('Right', 'jobcareer'),
                                    'center' => esc_html__('Center', 'jobcareer')
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>
                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg" >
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => 'call_to_action',
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

    add_action('wp_ajax_jobcareer_pb_call_to_action', 'jobcareer_pb_call_to_action');
}