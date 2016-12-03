<?php
/*
 *
 * @Shortcode Name : FAQ
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_faq')) {

    function jobcareer_pb_faq($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;

        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $PREFIX = CS_SC_FAQ . '|' . CS_SC_FAQITEM;
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
            'column_size' => '1/1',
            'class' => 'cs-faq',
            'cs_faq_section_title' => '',
            'cs_faq_view' => 'simple'
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
        $faq_num = '';
        if (is_array($atts_content))
            $faq_num = count($atts_content);

        $faq_element_size = '50';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_faq';
        $coloumn_class = 'column_' . $faq_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="faq" data="<?php echo jobcareer_element_size_data_array_index($faq_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $faq_element_size, '', 'question-circle'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_FAQ); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('FAQ OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter); ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}}[/<?php echo esc_attr(CS_SC_FAQ); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_FAQITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_FAQITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr(CS_SC_FAQ); ?> {{attributes}}]">
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Add FAQ element title here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_faq_section_title),
                                        'cust_id' => '',
                                        'classes' => '',
                                        'cust_name' => 'cs_faq_section_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                ?>
                            </div>
                            <?php
                            if (isset($faq_num) && $faq_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                foreach ($atts_content as $faq) {
                                    $rand_id = rand(13543544, 91112430);
                                    $faq_text = $faq['content'];
                                    $defaults = array('faq_title' => 'Title', 'faq_active' => 'yes', 'cs_faq_icon' => '');
                                    foreach ($defaults as $key => $values) {
                                        if (isset($faq['atts'][$key])) {
                                            $$key = $faq['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('FAQ', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Style', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("You can set the FAQ element that is open by default on frontend by select dropdown.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $faq_active,
                                                'id' => '',
                                                'cust_id' => '',
                                                'cust_name' => 'faq_active[]',
                                                'classes' => 'chosen-select-no-single select-medium',
                                                'options' => array(
                                                    'yes' => esc_html__('Yes', 'jobcareer'),
                                                    'no' => esc_html__('No', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Add FAQ question text here.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($faq_title),
                                                'cust_id' => '',
                                                'classes' => 'txtfield',
                                                'cust_name' => 'faq_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Content', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter FAQ content here.', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_textarea($faq_text),
                                                'cust_id' => '',
                                                'classes' => 'txtfield',
                                                'cust_name' => 'faq_text[]',
                                                'return' => true,
                                                'cs_editor' => true,
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
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
                                'std' => (int) $faq_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'faq_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>
                        </div>
                        <div class="wrapptabbox">
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-field"> <a href="javascript:viod(0);" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('faq', 'shortcode-item-<?php echo esc_js($cs_counter); ?>', '<?php echo esc_js(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Faq', 'jobcareer'); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
                                <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                    <ul class="form-elements insert-bg noborder">
                                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo esc_js($cs_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                    </ul>
                                    <div id="results-shortocde"></div>
                                <?php } else { ?>

                                    <?php
                                    $cs_opt_array = array(
                                        'std' => 'faq',
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
                                }
                                ?>
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

    add_action('wp_ajax_jobcareer_pb_faq', 'jobcareer_pb_faq');
}
