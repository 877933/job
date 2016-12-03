<?php
/*
 *
 * @Shortcode Name : Multi Price Table
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_multi_price_table')) {

    function jobcareer_pb_multi_price_table($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $multi_price_table_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_MULTIPRICETABLE . '|' . CS_SC_MULTIPRICETABLEITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('column_size' => '1/1', 'multi_price_table_text_color' => '', 'cs_multi_price_table_text_align' => '', 'jobcareer_multi_price_table_section_title' => '', 'pricetable_style' => '', 'cs_multi_price_col' => '3', 'cs_multi_price_table_class' => '');
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
            $multi_price_table_num = count($atts_content);
        }
        $multi_price_table_element_size = '67';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_multi_price_table';
        $coloumn_class = 'column_' . $multi_price_table_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $cs_counter = $cs_counter . rand(11, 555);
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="multi_price_table" data="<?php echo jobcareer_element_size_data_array_index($multi_price_table_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $multi_price_table_element_size, '', 'comments-o', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('PRICE TABLE OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_MULTIPRICETABLE); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_MULTIPRICETABLEITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_MULTIPRICETABLEITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr(CS_SC_MULTIPRICETABLE); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Enter Element Title Here', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($jobcareer_multi_price_table_section_title),
                                        'id' => 'jobcareer_multi_price_table_section_title',
                                        'cust_name' => 'jobcareer_multi_price_table_section_title[]',
                                        'classes' => '',
                                        'return' => true,
                                    ),
                                );
                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

//                                $cs_opt_array = array(
//                                    'name' => esc_html__('Styles', 'jobcareer'),
//                                    'desc' => '',
//                                    'hint_text' => esc_html__('Choose multi price table style here', 'jobcareer'),
//                                    'echo' => true,
//                                    'field_params' => array(
//                                        'std' => $pricetable_style,
//                                        'id' => '',
//                                        'cust_name' => 'pricetable_style[]',
//                                        'classes' => 'dropdown chosen-select',
//                                        'options' => array(
//                                            'simple' => esc_html__('Simple', 'jobcareer'),
//                                            'classic' => esc_html__('Classic', 'jobcareer'),
//                                        ),
//                                        'return' => true,
//                                    ),
//                                );
//
//                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Column', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Select Number of Columns", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_multi_price_col,
                                        'id' => '',
                                        'cust_name' => 'cs_multi_price_col[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            '1' => esc_html__('1 Column', 'jobcareer'),
                                            '2' => esc_html__('2 Columns', 'jobcareer'),
                                            '3' => esc_html__('3 Columns', 'jobcareer'),
                                            '4' => esc_html__('4 Columns', 'jobcareer'),
                                            '6' => esc_html__('6 Columns', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>

                            </div>
                            <?php
                            if (isset($multi_price_table_num) && $multi_price_table_num <> '' && isset($atts_content) && is_array($atts_content)) {

                                foreach ($atts_content as $multi_price_table) {

                                    $rand_string = $cs_counter . '' . jobcareer_generate_random_string(3);
                                    $multi_price_table_text = $multi_price_table['content'];
                                    $defaults = array(
                                        'column_size' => '1/1',
                                        'multi_pricetable_price' => '',
                                        'multi_price_table_text' => '',
                                        'multi_price_table_title_color' => '',
                                        'multi_price_table_currency' => '$',
                                        'multi_price_table_time_duration' => '',
                                        'multi_price_table_button_text' => 'Sign Up',
                                        'multi_price_table_custom_id' => '',
                                        'pricing_detail' => '',
                                        'pricetable_featured' => '',
                                        'multi_price_table_button_color' => '',
                                        'multi_price_table_button_color_bg' => '',
                                        'multi_price_table_button_column_color' => '',
                                        'multi_price_table_column_bgcolor' => '',
                                        'button_link' => ''
                                    );

                                    foreach ($defaults as $key => $values) {
                                        if (isset($multi_price_table['atts'][$key])) {
                                            $$key = $multi_price_table['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="cs_infobox_<?php echo jobcareer_special_char($rand_string); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Price Table', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__(' Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter Element Title Here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($multi_price_table_text),
                                                'id' => 'multi_price_table_text',
                                                'cust_name' => 'multi_price_table_text[]',
                                                'classes' => '',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Set price-table title color from here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($multi_price_table_title_color),
                                                'id' => 'multi_price_table_title_color',
                                                'cust_name' => 'multi_price_table_title_color[]',
                                                'classes' => 'bg_color',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__(' Price', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add price without symbol', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($multi_pricetable_price),
                                                'id' => 'multi_pricetable_price',
                                                'cust_name' => 'multi_pricetable_price[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__(' Currency Symbols', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add your currency symbol here like $', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($multi_price_table_currency),
                                                'id' => 'multi_price_table_currency',
                                                'cust_name' => 'multi_price_table_currency[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Time Duration', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add time duration for package or time range like this package for a month or year So wirte here for Mothly and year for Yearly Package', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($multi_price_table_time_duration),
                                                'id' => 'multi_price_table_time_duration',
                                                'cust_name' => 'multi_price_table_time_duration[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Button Link', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add price table button Link here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_url($button_link),
                                                'id' => 'button_link',
                                                'cust_name' => 'button_link[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Button Text', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add button text here Example : Buy Now, Purchase Now, View Packages etc', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($multi_price_table_button_text),
                                                'id' => 'multi_price_table_button_text',
                                                'cust_name' => 'multi_price_table_button_text[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Button Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Set button color with color picker', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($multi_price_table_button_color),
                                                'id' => 'multi_price_table_button_color',
                                                'cust_name' => 'multi_price_table_button_color[]',
                                                'classes' => 'bg_color',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Button Background Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Set button background color with color picker', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($multi_price_table_button_column_color),
                                                'id' => 'multi_price_table_button_column_color',
                                                'cust_name' => 'multi_price_table_button_column_color[]',
                                                'classes' => 'bg_color',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Featured on/off', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Price table featured option enable/disable with this dropdown", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $pricetable_featured,
                                                'id' => '',
                                                'cust_name' => 'pricetable_featured[]',
                                                'classes' => 'dropdown chosen-select',
                                                'options' => array(
                                                    'Yes' => esc_html__('Yes', 'jobcareer'),
                                                    'No' => esc_html__('No', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Description', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Features can be add easily in input with this shortcode 
					    					[feature_item]Text here[/feature_item][feature_item]Text here[/feature_item]", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_textarea($multi_price_table['content']),
                                                'cust_id' => '',
                                                'classes' => '',
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                                'cust_name' => 'pricing_features[]',
                                                'cs_editor' => true,
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('column Background Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Set column Background color', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($multi_price_table_column_bgcolor),
                                                'id' => 'multi_price_table_column_bgcolor',
                                                'cust_name' => 'multi_price_table_column_bgcolor[]',
                                                'classes' => 'bg_color',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
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
                                'std' => jobcareer_special_char($multi_price_table_num),
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'multi_price_table_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>
                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('multi_price_table', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Price table', 'jobcareer'); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
                                <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                    <ul class="form-elements insert-bg noborder">
                                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                    </ul>
                                    <div id="results-shortocde"></div>
                                <?php } else { ?>
                                    <?php
                                    $cs_opt_array = array(
                                        'std' => 'multi_price_table',
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

    add_action('wp_ajax_jobcareer_pb_multi_price_table', 'jobcareer_pb_multi_price_table');
}