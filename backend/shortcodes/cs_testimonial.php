<?php
/*
 *
 * @Shortcode Name : Testimonial
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_testimonials')) {

    function jobcareer_pb_testimonials($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $testimonials_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_TESTIMONIALS . '|' . CS_SC_TESTIMONIALSITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('column_size' => '1/1', 'testimonial_text_color' => '', 'cs_testimonial_text_align' => '', 'cs_testimonial_section_title' => '',
            'cs_testimonial_class' => '', 'testimonial_style' => '', 'testimonial_text_color' => '', 'testimonial_author_color' => '', 'testimonial_comp_color' => '', 'testimonial_border' => '');
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
            $testimonials_num = count($atts_content);
        }
        $testimonials_element_size = '100';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_testimonials';
        $coloumn_class = 'column_' . $testimonials_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="testimonials" data="<?php echo jobcareer_element_size_data_array_index($testimonials_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $testimonials_element_size, '', 'comments-o', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('TESTIMONIALS OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_TESTIMONIALS); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_TESTIMONIALSITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_TESTIMONIALSITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr(CS_SC_TESTIMONIALS); ?> {{attributes}}]">
                                <?php
                                $sh_code = '';
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                    $sh_code = 1;
                                }
                                $testimonial_style = isset($testimonial_style) ? $testimonial_style : '';
                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Enter your element title here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr($cs_testimonial_section_title),
                                        'cust_id' => '',
                                        'cust_name' => 'cs_testimonial_section_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

//                                $cs_opt_array = array(
//                                    'name' => esc_html__('Text Color', 'jobcareer'),
//                                    'desc' => '',
//                                    'hint_text' => '',
//                                    'echo' => true,
//                                    'classes' => 'txtfield',
//                                    'field_params' => array(
//                                        'std' => esc_attr($testimonial_text_color),
//                                        'cust_id' => '',
//                                        'classes' => 'bg_color',
//                                        'cust_name' => 'testimonial_text_color[]',
//                                        'return' => true,
//                                    ),
//                                );
//
//                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Author Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => '',
                                    'echo' => true,
                                    'classes' => 'txtfield',
                                    'field_params' => array(
                                        'std' => esc_attr($testimonial_author_color),
                                        'cust_id' => '',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'testimonial_author_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Company Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => '',
                                    'echo' => true,
                                    'classes' => 'txtfield',
                                    'field_params' => array(
                                        'std' => esc_attr($testimonial_comp_color),
                                        'cust_id' => '',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'testimonial_comp_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                ?>
                                <script>
                                     function promotion_view(value) {

                                    if (value == 'classic') {
                                        jQuery('#testimonial_border').show();
                                    } else {
                                        jQuery('#testimonial_border').hide();
                                    }
                                }
                                    </script>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Choose View', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Choose testimonial style from here", 'jobcareer'),
                                    'echo' => true,
                                    'classes' => 'dropdown chosen-select-no-single select-medium views',
                                    'field_params' => array(
                                        'std' => $testimonial_style,
                                        'id' => '',
                                        'cust_name' => 'testimonial_style[]',
                                        'classes' => 'dropdown chosen-select',
                                        'extra_atr' => 'onchange="promotion_view(value)"',
                                        'options' => array(
                                            'advance-slider' => esc_html__('Advance Slider', 'jobcareer'),
                                            'classic' => esc_html__('Classic', 'jobcareer'),
                                            
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                
                                  $testimonial_classic = 'none';

                            if ($testimonial_style == "classic") {
                                $testimonial_classic = 'block';
                            } else{
                                $testimonial_classic = 'none';
                            }
?>
                                    <div id="testimonial_border" style="display:<?php echo esc_html($testimonial_classic) ?>">
                                    <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Border', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Set Border as yes or no.", 'jobcareer'),
                                    'echo' => true,
                                    'classes' => 'dropdown chosen-select-no-single select-medium',
                                    'field_params' => array(
                                        'std' => $testimonial_border,
                                        'id' => 'testimonial_border',
                                        'cust_name' => 'testimonial_border[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            'yes' => esc_html__('Yes', 'jobcareer'),
                                            'no' => esc_html__('No', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>
                                    </div>

                            </div>
                            <?php
                            if (isset($testimonials_num) && $testimonials_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                foreach ($atts_content as $testimonials) {
                                    $rand_string = $cs_counter . '' . jobcareer_generate_random_string(3);
                                    $testimonial_text = $testimonials['content'];
                                    $defaults = array('testimonial_author' => '', 'testimonial_img_user' => '', 'testimonial_company' => '');
                                    foreach ($defaults as $key => $values) {
                                        if (isset($testimonials['atts'][$key])) {
                                            $$key = $testimonials['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'
                                         id="cs_infobox_<?php echo jobcareer_special_char($rand_string); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Testimonial', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Text', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter testimonial text here.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr($testimonial_text),
                                                'cust_id' => '',
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                                'cust_name' => 'testimonial_text[]',
												'cs_editor' => true,
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);


                                        $cs_opt_array = array(
                                            'name' => esc_html__('Author', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter testimonial author name here", 'jobcareer'),
                                            'echo' => true,
                                            'classes' => 'txtfield',
                                            'field_params' => array(
                                                'std' => esc_attr($testimonial_author),
                                                'cust_id' => '',
                                                'cust_name' => 'testimonial_author[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Company', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter company name of author here", 'jobcareer'),
                                            'echo' => true,
                                            'classes' => 'txtfield',
                                            'field_params' => array(
                                                'std' => esc_attr($testimonial_company),
                                                'cust_id' => '',
                                                'cust_name' => 'testimonial_company[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'std' => $testimonial_img_user,
                                            'id' => 'testimonial_img_user',
                                            'name' => esc_html__('Image', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => '',
                                            'echo' => true,
                                            'array' => true,
                                            'prefix' => '',
                                            'field_params' => array(
                                                'std' => $testimonial_img_user,
                                                'id' => 'testimonial_img_user',
                                                'return' => true,
                                                'array' => true,
                                                'array_txt' => false,
                                                'prefix' => '',
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);
                                        ?>

                                    </div>
                                    <script>
                                        popup_over();
                                    </script>                   
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $cs_opt_array = array(
                                'std' => jobcareer_special_char($testimonials_num),
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'testimonials_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>

                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('testimonials', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>','<?php echo esc_html($sh_code); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add testimonials', 'jobcareer'); ?></a> </li>
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
                                        'std' => 'testimonials',
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
            </div>
        </div>
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_testimonials', 'jobcareer_pb_testimonials');
}