<?php
/*
 *
 * @Shortcode Name : Table
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_table')) {

    function jobcareer_pb_table($die = 0) {
        global $jobcareer_node, $cs_count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $PREFIX = CS_SC_TABLES;
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
        $defaults = array('column_size' => '1/2', 'cs_table_section_title' => '', 'cs_table_content' => '', 'cs_table_class' => '');
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        $atts_content = '[table]
                            [thead]
                              [tr]
                                [th]Column 1[/th]
                                [th]Column 2[/th]
                                [th]Column 3[/th]
                                [th]Column 4[/th]
                              [/tr]
                            [/thead]
                            [tbody]
                              [tr]
                                [td]Item 1[/td]
                                [td]Item 2[/td]
                                [td]Item 3[/td]
                                [td]Item 4[/td]
                              [/tr]
                              [tr]
                                [td]Item 11[/td]
                                [td]Item 22[/td]
                                [td]Item 33[/td]
                                [td]Item 44[/td]
                              [/tr]
                            [/tbody]
						[/table]
                     ';

        if ($defaultAttributes) {
            $atts_content = $atts_content;
        } else {
            if (isset($output['0']['content'])) {
                $atts_content = $output['0']['content'];
            } else {
                $atts_content = "";
            }
        }
        $table_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_table';
        $cs_count_node++;
        $coloumn_class = 'column_' . $table_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="pricetable" data="<?php echo jobcareer_element_size_data_array_index($table_element_size) ?>" >
        <?php jobcareer_element_setting($name, $cs_counter, $table_element_size, '', 'th'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>"  data-shortcode-template="[<?php echo esc_attr(CS_SC_TABLES); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_TABLES); ?>]"  style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Table Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter) ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            jobcareer_shortcode_element_size();
        } ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter element title here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($cs_table_section_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'cs_table_section_title[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Table Content', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Fill your table content in shortcode here. (th) for table heading and (td) for table container", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($atts_content),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_table_content[]',
                                'return' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );
                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                        ?>
                        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements insert-bg noborder cs-insert-noborder">
                                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                            </ul>
                            <div id="results-shortocde"></div>
                        <?php } else { ?>
                            <?php
                            $cs_opt_array = array(
                                'std' => 'table',
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
        </div>
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_table', 'jobcareer_pb_table');
}
