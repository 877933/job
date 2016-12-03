<?php
/*
 *
 * @Shortcode Name : Quick Quote
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_quick_slider')) {

    function jobcareer_pb_quick_slider($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_QUICK_QUOTE;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_quick_slider_section_title' => '',
            'cs_quick_slider_view' => '',
            'cs_quick_slider_send' => '',
            'cs_success' => '',
            'cs_error' => '',
            'cs_quick_slider_text_color' => '',
            'cs_quick_slider_bg_color' => '',
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $cs_quick_slider_text = $output['0']['content'];
        } else {
            $cs_quick_slider_text = '';
        }
        $quick_slider_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_quick_slider';
        $coloumn_class = 'column_' . $quick_slider_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="quick_slider" data="<?php echo jobcareer_element_size_data_array_index($quick_slider_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $quick_slider_element_size, '', 'building-o', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_QUICK_QUOTE); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_QUICK_QUOTE); ?>]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Quick Qoute Form Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('This is used for the one page navigation, to identify the section below. Give a title', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_quick_slider_section_title),
                                'id' => 'cs_quick_slider_section_title',
                                'cust_name' => 'cs_quick_slider_section_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Send To', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Add a email which you want to receive email', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_quick_slider_send),
                                'id' => 'cs_quick_slider_send',
                                'cust_name' => 'cs_quick_slider_send[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Success Message', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Set a message if your email sent successfully', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_success),
                                'id' => 'cs_success',
                                'cust_name' => 'cs_success[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Error Message', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('set a message for error message', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_error),
                                'id' => 'cs_error',
                                'cust_name' => 'cs_error[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Button Text', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html('set a message for error message', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_quick_slider_text),
                                'id' => 'cs_quick_slider_text',
                                'cust_name' => 'cs_quick_slider_text[]',
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Text Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Provide a hex colour code here (with #) if you want to override the default', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_quick_slider_text_color),
                                'id' => 'cs_quick_slider_text_color',
                                'cust_name' => 'cs_quick_slider_text_color[]',
                                'return' => true,
                                'classes' => 'bg_color',
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Background Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Provide a hex colour code here (with #) if you want to override the default', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_quick_slider_bg_color),
                                'id' => 'cs_quick_slider_bg_color',
                                'cust_name' => 'cs_quick_slider_bg_color[]',
                                'return' => true,
                                'classes' => 'bg_color',
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => 'quick_slider',
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

    add_action('wp_ajax_jobcareer_pb_quick_slider', 'jobcareer_pb_quick_slider');
}