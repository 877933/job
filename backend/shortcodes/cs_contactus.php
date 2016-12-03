<?php
/*
 *
 * @Shortcode Name : Contact us
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_contactform')) {

    function jobcareer_pb_contactform($die = 0) {
        global $jobcareer_node, $post, $cs_html_fields, $jobcareer_form_fields, $jobcareer_html_fields;
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
            $PREFIX = CS_SC_CONTACTUS;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_contactform_section_title' => '',
            'cs_contactform_label' => '',
            'cs_contactus_view' => '',
            'cs_contactform_send' => '',
            'cs_success' => '',
            'cs_error' => '',
            'cs_contact_class' => ''
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        $contactus_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_contactform';
        $coloumn_class = 'column_' . $contactus_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="contactform" data="<?php echo jobcareer_element_size_data_array_index($contactus_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $contactus_element_size, '', 'building-o', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_CONTACTUS); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Contact Form Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                        }

                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Give a element title for form', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_contactform_section_title),
                                'id' => 'cs_contactform_section_title',
                                'cust_name' => 'cs_contactform_section_title[]',
                                'return' => true,
                            ),
                        );

                        $cs_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Fields Label', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("You can on/off form labels with this dropdown. Label represents a caption for an item in a user interface.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $cs_contactform_label,
                                'id' => '',
                                'cust_name' => 'cs_contactform_label[]',
                                'classes' => 'cs_contactform_label chosen-select-no-single',
                                'options' => array(
                                    'on' => esc_html__('On', 'jobcareer'),
                                    'off' => esc_html__('Off', 'jobcareer')
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Receiver Email', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Add email where do you want receive emails', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_contactform_send),
                                'id' => 'cs_contactform_send',
                                'cust_name' => 'cs_contactform_send[]',
                                'return' => true,
                            ),
                        );

                        $cs_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Success Message', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter success message here. When form submited your success message will be print', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_success),
                                'id' => 'cs_success',
                                'cust_name' => 'cs_success[]',
                                'return' => true,
                            ),
                        );

                        $cs_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Error Message', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter your error message here. If user filled something wrong in form Error message will be print', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_error),
                                'id' => 'cs_error',
                                'cust_name' => 'cs_error[]',
                                'return' => true,
                            ),
                        );

                        $cs_html_fields->cs_text_field($cs_opt_array);
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
                            'std' => 'contactform',
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

    add_action('wp_ajax_jobcareer_pb_contactform', 'jobcareer_pb_contactform');
}