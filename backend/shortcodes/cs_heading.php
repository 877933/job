<?php
/* *
 * @Shortcode Name : Heading
 * @retrun
 * */
if (!function_exists('jobcareer_pb_heading')) {

    function jobcareer_pb_heading($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
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
            $PREFIX = CS_SC_HEADING;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'heading_title' => '',
            'color_title' => '',
            'color_title_color' => '',
            'heading_color' => '#000',
            'class' => 'cs-heading-shortcode',
            'heading_style' => '1',
            'heading_style_type' => '1',
            'heading_size' => '',
            'font_weight' => '',
            'letter_space' => '',
            'line_height' => '',
            'heading_font_style' => '',
            'heading_align' => 'center',
            'heading_divider' => '',
            'heading_color' => '',
            'sub_heading_title' => '',
            'heading_content_color' => ''
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $heading_content = $output['0']['content'];
        } else {
            $heading_content = '';
        }
        $heading_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_heading';
        $coloumn_class = 'column_' . $heading_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="heading" data="<?php echo jobcareer_element_size_data_array_index($heading_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $heading_element_size, '', 'h-square', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>"  data-shortcode-template="[<?php echo esc_attr(CS_SC_HEADING); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_HEADING); ?>]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('HEADING OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')"
                       class="cs-btnclose"><i class="icon-times"></i>
                    </a>
                </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                        }

                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter your element title here", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($heading_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'heading_title[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Content', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter content here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($heading_content),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'heading_content[]',
                                'return' => true,
								'cs_editor' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );

                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Heading Style', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select headings and style with this dropdown. H1 to H6 Headings and one Fancy view. All headings font sizes,color and family can be change from theme options.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $heading_style,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'heading_style[]',
                                'classes' => 'chosen-select select-medium',
                                'options' => array(
                                    '1' => esc_html__('h1', 'jobcareer'),
                                    '2' => esc_html__('h2', 'jobcareer'),
                                    '3' => esc_html__('h3', 'jobcareer'),
                                    '4' => esc_html__('h4', 'jobcareer'),
                                    '5' => esc_html__('h5', 'jobcareer'),
                                    '6' => esc_html__('h6', 'jobcareer'),
                                    'fancy' => esc_html__('Fancy', 'jobcareer'),
                                    'section_title' => esc_html__('Element Title', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>

                        <div class="form-elements">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php esc_html_e('Font Size', 'jobcareer'); ?></label>
                                <?php
                                if (function_exists('jobcareer_tooltip_text')) {
                                    echo jobcareer_tooltip_text(esc_html__('Add font size for heading here.', 'jobcareer'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php
                                $cs_opt_array = array(
                                    'std' => esc_attr($heading_size),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'heading_size[]',
                                    'extra_atr' => ' placeholder="Font Size"',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php esc_html_e('Letter Spacing', 'jobcareer'); ?></label>
                                <?php
                                if (function_exists('jobcareer_tooltip_text')) {
                                    echo jobcareer_tooltip_text(esc_html__('Add letter spacing for heading here.', 'jobcareer'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                
                                <?php
                                $cs_opt_array = array(
                                    'std' => esc_attr($letter_space),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'letter_space[]',
                                    'extra_atr' => ' placeholder="'.esc_html__('Letter Spacing' , 'jobcareer').'"',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php esc_html_e('Line Height', 'jobcareer'); ?></label>
                                <?php
                                if (function_exists('jobcareer_tooltip_text')) {
                                    echo jobcareer_tooltip_text(esc_html__('Add line height for heading here.', 'jobcareer'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php
                                $cs_opt_array = array(
                                    'std' => esc_attr($line_height),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'line_height[]',
                                    'extra_atr' => ' placeholder="'.esc_html__('Line Height' , 'jobcareer').'"',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                ?>
                            </div>
                        </div>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Text Align', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Align the content position with this dropdown.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $heading_align,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'heading_align[]',
                                'classes' => 'chosen-select select-medium',
                                'options' => array(
                                    'left' => esc_html__('Left', 'jobcareer'),
                                    'right' => esc_html__('Right', 'jobcareer'),
                                    'Center' => esc_html__('Center', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Heading Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Choose heading color with this color picker.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($heading_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'heading_color[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Divider On/Off', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set divider on/off for heading with this dropdown.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $heading_divider,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'heading_divider[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'on' => esc_html__('On', 'jobcareer'),
                                    'off' => esc_html__('Off', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Font Style', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select the font style here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $heading_font_style,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'heading_font_style[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'normal' => esc_html__('Normal', 'jobcareer'),
                                    'italic' => esc_html__('Italic', 'jobcareer'),
                                    'oblique' => esc_html__('Oblique', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>

                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                        <?php
                    } else {
                        $cs_opt_array = array(
                            'std' => 'heading',
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

    add_action('wp_ajax_jobcareer_pb_heading', 'jobcareer_pb_heading');
}