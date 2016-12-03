<?php
/*
 *
 * @Shortcode Name : Button
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_accordion')) {

    function jobcareer_pb_accordion($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;

        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $PREFIX = CS_SC_ACCORDION . '|' . CS_SC_ACCORDIONITEM;
        $parseObject = new ShortcodeParse();
        $accordion_num = 0;
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
            'column_size' => '1/2',
            'class' => 'cs-accrodian',
            'accordian_style' => '',
            'accordion_animation' => '',
            'cs_accordian_section_title' => ''
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
            $accordion_num = count($atts_content);
        }
        $accordion_element_size = '50';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_accordion';
        $coloumn_class = 'column_' . $accordion_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="accordion" data="<?php echo jobcareer_element_size_data_array_index($accordion_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $accordion_element_size, '', 'list-ul'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_ACCORDION); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('ACCORDION OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>" data-shortcode-template="{{child_shortcode}}[/<?php echo esc_attr(CS_SC_ACCORDION); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_ACCORDIONITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_ACCORDIONITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr(CS_SC_ACCORDION); ?> {{attributes}}]">
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Add your accordion element title here', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_accordian_section_title),
                                        'id' => 'cs_accordian_section_title',
                                        'cust_name' => 'cs_accordian_section_title[]',
                                        'classes' => '',
                                        'return' => true,
                                    ),
                                );
                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                ?>

                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                ?>
                            </div>
                            <?php
                            if (isset($accordion_num) && $accordion_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                foreach ($atts_content as $accordion) {

                                    $rand_id = rand(333, 9999999);
                                    $accordion_text = $accordion['content'];
                                    $defaults = array('accordion_title' => '', 'accordion_active' => 'yes', 'cs_accordian_icon' => '');
                                    foreach ($defaults as $key => $values) {
                                        if (isset($accordion['atts'][$key]))
                                            $$key = $accordion['atts'][$key];
                                        else
                                            $$key = $values;
                                    }
                                    if ($accordion_active == "yes") {
                                        $accordian_active = "selected";
                                    } else {
                                        $accordian_active = "";
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="cs_infobox_<?php echo jobcareer_special_char($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Accordion', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a></header>
                                        <?php
                                        $accordion_active = isset($accordion_active) ? $accordion_active : '';
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Active', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("You can set the accordion element that is open by default on frontend by select dropdown.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $accordion_active,
                                                'id' => '',
                                                'cust_name' => 'accordion_active[]',
                                                'classes' => 'dropdown chosen-select',
                                                'options' => array(
                                                    'yes' => esc_html__('Yes', 'jobcareer'),
                                                    'no' => esc_html__('No', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Accordion Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add accordion title here.', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($accordion_title),
                                                'id' => 'accordion_title',
                                                'cust_name' => 'accordion_title[]',
                                                'classes' => '',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>
                                        <div class="form-elements" id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label> <?php esc_html_e("Icon:", 'jobcareer'); ?></label>
                                                <?php
                                                if (function_exists('jobcareer_tooltip_text')) {
                                                    echo jobcareer_tooltip_text(esc_html__('Select the Icon you would like to show with your accordion title.', 'jobcareer'));
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <?php jobcareer_fontawsome_icons_box($cs_accordian_icon, $rand_id, 'cs_accordian_icon'); ?>
                                                <p></p>
                                            </div>
                                        </div>
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Accordion Content', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add accordion content here.', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($accordion_text),
                                                'id' => 'accordion_text',
                                                'cust_name' => 'accordion_text[]',
                                                'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                                'classes' => 'txtfield',
                                                'cs_editor' => true,
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                                        ?>

                                    </div>
                                    <script>
                                        /*
                                         * modern selection box function
                                         */
                                        jQuery(document).ready(function ($) {
                                            chosen_selectionbox();
                                            popup_over();
                                        });
                                        /*
                                         * modern selection box function
                                         */
                                    </script>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $cs_opt_array = array(
                                'std' => $accordion_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'accordion_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>
                        </div>
                        <div class="wrapptabbox">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field"> <a href="javascript:void(0);" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('accordions', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add accordion', 'jobcareer'); ?></a> </li>
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
                                        'std' => 'accordion',
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
                </div>
            </div>
        </div>
        <script>

            /*
             * modern selection box function
             */
            jQuery(document).ready(function ($) {
                chosen_selectionbox();
                popup_over();
            });
            /*
             * modern selection box function
             */


        </script>

        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_accordion', 'jobcareer_pb_accordion');
}