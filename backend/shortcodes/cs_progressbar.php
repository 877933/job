<?php
/*
 *
 * @Shortcode Name : Progressbar
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_progressbars')) {

    function jobcareer_pb_progressbars($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $PREFIX = CS_SC_PROGRESSBAR . '|' . CS_SC_PROGRESSBARITEM;
        $parseObject = new ShortcodeParse();
        $progressbars_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('column_size' => '1/1', 'progressbars_element_title' => '', 'cs_progressbars_style' => 'skills-sec',);

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
            $progressbars_num = count($atts_content);
        }

        $progressbars_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_progressbars';
        $coloumn_class = 'column_' . $progressbars_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="progressbars" data="<?php echo jobcareer_element_size_data_array_index($progressbars_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $progressbars_element_size, '', 'list-alt'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter); ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Progress bars Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter); ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-clone-append cs-pbwp-content" >
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_PROGRESSBAR); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_PROGRESSBARITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_PROGRESSBARITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr(CS_SC_PROGRESSBAR); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                ?>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => '',
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_html($progressbars_element_title),
                                        'id' => 'progressbars_element_title',
                                        'cust_name' => 'progressbars_element_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                ?>

                            </div>
                            <?php
                            if (isset($progressbars_num) && $progressbars_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                foreach ($atts_content as $progressbars) {
                                    $rand_id = $cs_counter . '' . jobcareer_generate_random_string(3);
                                    $defaults = array('progressbars_title' => '', 'progressbars_color' => '#4d8b0c', 'progressbars_percentage' => '50');
                                    foreach ($defaults as $key => $values) {
                                        if (isset($progressbars['atts'][$key])) {
                                            $$key = $progressbars['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    echo '<div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content" id="cs_infobox_' . $rand_id . '">';
                                    ?>
                                    <header>
                                        <h4><i class='icon-arrows'></i><?php esc_html_e('Progress Bar', 'jobcareer'); ?></h4>
                                        <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a></header>

                                    <?php
                                    $cs_opt_array = array(
                                        'name' => esc_html__('Progress Bars Title', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($progressbars_title),
                                            'id' => 'progressbars_title',
                                            'cust_name' => 'progressbars_title[]',
                                            'return' => true,
                                        ),
                                    );

                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                    $cs_opt_array = array(
                                        'name' => esc_html__('Skill (in percentage)', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($progressbars_percentage),
                                            'id' => 'progressbars_percentage',
                                            'cust_name' => 'progressbars_percentage[]',
                                            'return' => true,
                                        ),
                                    );

                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                    $cs_opt_array = array(
                                        'name' => esc_html__('Progress Bars Color', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($progressbars_color),
                                            'id' => 'progressbars_color',
                                            'cust_name' => 'progressbars_color[]',
                                            'return' => true,
                                            'classes' => 'bg_color',
                                        ),
                                    );

                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                    ?>

                                </div>
                                <script>
                                    /*
                                     * popup over 
                                     */
                                    chosen_selectionbox();                                
                                    popup_over();
                                    /*
                                     *End popup over 
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
                            'std' => esc_attr($progressbars_num),
                            'id' => '',
                            'before' => '',
                            'after' => '',
                            'classes' => 'fieldCounter',
                            'extra_atr' => '',
                            'cust_id' => '',
                            'cust_name' => 'progressbars_num[]',
                            'return' => true,
                            'required' => false
                        );
                        echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                        ?>
                    </div>
                    <div class="wrapptabbox cs-zero-padding">
                        <div class="opt-conts">
                            <ul class="form-elements noborder">
                                <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('progressbars', 'shortcode-item-<?php echo esc_js($cs_counter); ?>', '<?php echo esc_js(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Progress bar', 'jobcareer'); ?></a> </li>
                                <div id="loading" class="shortcodeload"></div>
                            </ul>
                            <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                <ul class="form-elements insert-bg">
                                    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo esc_js($cs_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                </ul>
                                <div id="results-shortocde"></div>
                            <?php } else { ?>

                                <?php
                                $cs_opt_array = array(
                                    'std' => 'progressbars',
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

    add_action('wp_ajax_jobcareer_pb_progressbars', 'jobcareer_pb_progressbars');
}
