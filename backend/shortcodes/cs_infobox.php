<?php
/*
 *
 * @Shortcode Name : Infobox
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_infobox')) {

    function jobcareer_pb_infobox($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $info_list_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_INFOBOX . '|' . CS_SC_INFOBOXITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'column_size' => '1/1',
            'cs_infobox_section_title' => '',
            'cs_infobox_title' => '',
            'cs_infobox_list_color' => '',
            'cs_infobox_list_text_color' => '',
            'cs_infobox_list_content_color' => '',
            'cs_infobox_bg_color' => '',
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
        if (is_array($atts_content))
            $info_list_num = count($atts_content);

        $infobox_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_infobox';
        $coloumn_class = 'column_' . $infobox_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>

        <div id="<?php echo jobcareer_special_char($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="infobox" data="<?php echo jobcareer_element_size_data_array_index($infobox_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $infobox_element_size, '', 'info-circle'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('INFOBOX OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-clone-append cs-pbwp-content" >
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_INFOBOX); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_INFOBOXITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_INFOBOXITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_INFOBOX); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Enter infobox title here', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_infobox_title),
                                        'id' => '',
                                        'cust_name' => 'cs_infobox_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Icon Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Set the Color for Icon', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_infobox_list_color),
                                        'id' => '',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'cs_infobox_list_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                $cs_opt_array = array(
                                    'name' => esc_html__('Title Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Set the Color for Title', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_infobox_list_text_color),
                                        'id' => '',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'cs_infobox_list_text_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Content color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Set the Color for Content', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_infobox_list_content_color),
                                        'id' => '',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'cs_infobox_list_content_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                ?>


                            </div>
                            <?php
                            if (isset($info_list_num) && $info_list_num <> '' && isset($atts_content) && is_array($atts_content)) {

                                foreach ($atts_content as $infobox_item) {

                                    $rand_id = $cs_counter . '' . jobcareer_generate_random_string(3);
                                    $cs_infobox_list_description = $infobox_item['content'];
                                    $defaults = array(
                                        'cs_infobox_list_title' => '',
                                        'cs_infobox_list_icon' => '',
                                        );
                                    foreach ($defaults as $key => $values) {
                                        if (isset($infobox_item['atts'][$key])) {
                                            $$key = $infobox_item['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo jobcareer_special_char($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Info box Item(s)', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a></header>




                                        <div class="form-elements" id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label><?php esc_html_e('Info Box Font awesome Icon', 'jobcareer'); ?></label>
                                                <?php
                                                if (function_exists('jobcareer_tooltip_text')) {
                                                    echo jobcareer_tooltip_text(esc_html__('Select the Icons you would like to show in infobox section.', 'jobcareer'));
                                                }
                                                ?>


                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <?php jobcareer_fontawsome_icons_box($cs_infobox_list_icon, $rand_id, 'cs_infobox_list_icon'); ?>
                                                <p></p>
                                            </div>
                                        </div>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Infobox Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter the infobox title here', 'jobcareer'),
                                            'echo' => true,
                                            'classes' => '',
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($cs_infobox_list_title),
                                                'id' => '',
                                                'cust_name' => 'cs_infobox_list_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                        $cs_opt_array = array(
                                            'name' => esc_html__('Infobox Content', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter the content here', 'jobcareer'),
                                            'echo' => true,
                                            'classes' => '',
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($cs_infobox_list_description),
                                                'id' => '',
                                                "extra_atr" => 'data-content-text="cs-shortcode-textarea"',
                                                'cust_name' => 'cs_infobox_list_description[]',
                                                'cs_editor' => true,
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                                        ?>

                                    </div>
                <?php
            }
        }
        $info_list_num + 1;
        ?>
                        </div>
                        <div class="hidden-object">
        <?php
        $cs_opt_array = array(
            'std' => $info_list_num,
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => 'fieldCounter',
            'extra_atr' => '',
            'cust_id' => '',
            'cust_name' => 'info_list_num[]',
            'return' => true,
            'required' => false
        );
        echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
        ?>

                        </div>
                        <div class="wrapptabbox cs-infobox-padding">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('infobox_items', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Item', 'jobcareer'); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                    <ul class="form-elements insert-bg">
                                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                    </ul>
                                    <div id="results-shortocde"></div>
        <?php } else { ?>
                                    <?php
                                    $cs_opt_array = array(
                                        'std' => 'infobox',
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
                            </div>
                        </div>
                    </div>
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

    add_action('wp_ajax_jobcareer_pb_infobox', 'jobcareer_pb_infobox');
}
