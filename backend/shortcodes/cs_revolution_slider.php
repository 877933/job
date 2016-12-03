<?php
//=====================================================================
// Slider Shortcode Builder start
//=====================================================================
if (!function_exists('jobcareer_pb_slider')) {

    function jobcareer_pb_slider($die = 0) {
        global $jobcareer_node, $post, $cs_html_fields, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $cs_counter = $_POST['counter'];
        $image_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_SLIDER;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        global $jobcareer_node, $cs_counter_node;
        $defaults = array(
            'column_size' => '1/1',
            'cs_slider_header_title' => '',
            'cs_slider' => '',
            'cs_slider_id' => ''
        );
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

        if (is_array($atts_content)) {
            $slider_num = count($atts_content);
        }

        $slider_element_size = '25';

        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_slider';
        $coloumn_class = 'column_' . $slider_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="slider" data="<?php echo jobcareer_element_size_data_array_index($slider_element_size) ?>">
        <?php jobcareer_element_setting($name, $cs_counter, $slider_element_size, '', 'picture-o'); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_SLIDER); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('SLIDER OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <?php
        $cs_opt_array = array(
            'name' => esc_html__('Slider Element Title', 'jobcareer'),
            'desc' => '',
            'hint_text' => esc_html__('Enter Slider Element title here', 'jobcareer'),
            'echo' => true,
            'field_params' => array(
                'std' => jobcareer_special_char(htmlspecialchars($cs_slider_header_title)),
                'id' => '',
                'classes' => 'txtfield',
                'cust_name' => 'cs_slider_header_title[]',
                'return' => true,
            ),
        );

        $cs_html_fields->cs_text_field($cs_opt_array);

        if (class_exists('RevSlider') && class_exists('jobcareer_revSlider')) {
            $slider = new jobcareer_revSlider();
            $arrSliders = $slider->getAllSliderAliases();
            $slider_options = array();
            foreach ($arrSliders as $key => $entry) {
                $slider_options[jobcareer_special_char($entry['alias'])] = jobcareer_special_char($entry['title']);
            }
        }

        $cs_opt_array = array(
            'name' => esc_html__('Choose Slider', 'jobcareer'),
            'desc' => '',
            'hint_text' => esc_html__("Choose revolution slider from here. If you have not any slider create new with activating revolution slider plugin.", 'jobcareer'),
            'echo' => true,
            'field_params' => array(
                'std' => $cs_slider_id,
                'cust_id' => 'cs_slider_id' . intval($cs_counter),
                'cust_name' => 'cs_slider_id[]',
                'classes' => 'dropdown chosen-select select-medium',
                'options' => $slider_options,
                'return' => true,
            ),
        );

        $jobcareer_html_fields->cs_select_field($cs_opt_array);
        ?>
                    </div>
                    <script>
                        'use strict';
                        var cs_slider_type = jQuery("#cs_slider_type<?php echo esc_js($cs_counter); ?>").val();
                        cs_toggle_height(cs_slider_type, '<?php echo esc_js($cs_counter) ?>');
                    </script>
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
        <?php } else { ?>

            <?php
            $cs_opt_array = array(
                'std' => 'slider',
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

    add_action('wp_ajax_jobcareer_pb_slider', 'jobcareer_pb_slider');
}