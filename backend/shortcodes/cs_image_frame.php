<?php
/*
 *
 * @Shortcode Name : Image frame
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_image')) {

    function jobcareer_pb_image($die = 0) {
        global $jobcareer_node, $cs_count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $PREFIX = CS_SC_IMAGE;
        $defaultAttributes = false;
        $parseObject = new ShortcodeParse();
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
            $defaultAttributes = true;
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_image_section_title' => '',
            'image_style' => '',
            'cs_image_url' => '',
            'cs_image_title' => '',
            'cs_image_caption' => '',
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }

        if (isset($output['0']['content'])) {
            $atts_content = $output['0']['content'];
        } else {
            $atts_content = "";
        }

        $image_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_image';
        $cs_count_node++;
        $coloumn_class = 'column_' . $image_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }

        $rand_id = rand(34, 443534);
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="image" data="<?php echo jobcareer_element_size_data_array_index($image_element_size); ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $image_element_size, '', 'picture-o'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_IMAGE); ?> CS_SC_IMAGE {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_IMAGE); ?>]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Image Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        $sh_code = '';
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                            $sh_code = 1;
                        }
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter Element Title here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($cs_image_section_title),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_image_section_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Image Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter image title..", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($cs_image_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'cs_image_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'std' => $cs_image_url,
                            'id' => 'image_url',
                            'name' => esc_html__('Select Image', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Select image from media gallery with this button.', 'jobcareer'),
                            'echo' => true,
                            'array' => true,
                            'field_params' => array(
                                'std' => $cs_image_url,
                                'cust_id' => '',
                                'id' => 'image_url',
                                'return' => true,
                                'array' => true,
                                'array_txt' => false,
                            ),
                        );
                        if ($sh_code == 1){
                            $cs_opt_array['cus_rand_id'] = (string)jobcareer_generate_random_string(6);
                        }
                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Image Description', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("If you would like a caption to be shown below the image, add it here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($atts_content),
                                'cust_id' => '',
                                'classes' => 'textarea',
                                'cust_name' => 'cs_image_caption[]',
								'cs_editor' => false,
                                'return' => true,
								'cs_editor' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );

                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                        ?>



                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo jobcareer_special_char(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo jobcareer_special_char($name . $cs_counter) ?>', '<?php echo jobcareer_special_char($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>

                        <?php
                        $cs_opt_array = array(
                            'std' => 'image',
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

    add_action('wp_ajax_jobcareer_pb_image', 'jobcareer_pb_image');
}