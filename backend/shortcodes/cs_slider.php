<?php
/**
 * @Offer Slider html form for page builder start
 */
if (!function_exists('jobcareer_pb_offerslider')) {

    function jobcareer_pb_offerslider($die = 0) {
        global $jobcareer_node, $cs_html_fields, $post;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);

            $PREFIX = CS_SC_OFFERSLIDER . '|' . CS_SC_OFFERITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'column_size' => '1/1',
            'cs_offerslider_section_title' => '',
            'cs_offerslider_animation' => ''
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
            $offerslider_num = count($atts_content);
        }

        $offerslider_element_size = '50';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_offerslider';
        $coloumn_class = 'column_' . $offerslider_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="offerslider" data="<?php echo jobcareer_element_size_data_array_index($offerslider_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $offerslider_element_size, '', 'trophy', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter); ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('SLIDER OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter); ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_OFFERSLIDER); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_OFFERITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_OFFERITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_OFFERSLIDER); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Size', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__("Select column width. This width will be calculated depend page width", 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => $column_size,
                                            'id' => '',
                                            'cust_name' => 'column_size[]',
                                            'classes' => 'dropdown chosen-select',
                                            'options' => array(
                                                '1/1' => esc_html__('Full width', 'jobcareer'),
                                                '1/2' => esc_html__('One half', 'jobcareer'),
                                                '2/3' => esc_html__('Two third', 'jobcareer'),
                                                '3/4' => esc_html__('Three fourth', 'jobcareer'),
                                            ),
                                            'return' => true,
                                        ),
                                    );

                                    $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                }


                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Enter Slider Element title here', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_html($cs_offerslider_section_title),
                                        'id' => 'cs_offerslider_section_title',
                                        'cust_name' => 'cs_offerslider_section_title[]',
                                        'return' => true,
                                    ),
                                );

                                $cs_html_fields->cs_text_field($cs_opt_array);

                                //if (function_exists('jobcareer_shortcode_custom_dynamic_classes')) {
                                   // jobcareer_shortcode_custom_dynamic_classes($cs_offerslider_class, $cs_offerslider_animation, '', CS_SC_OFFERSLIDER);
                               // }
                                ?>
                            </div>
                            <?php
                            if (isset($offerslider_num) && $offerslider_num <> '' && isset($atts_content) && is_array($atts_content)) {

                                foreach ($atts_content as $offerslider) {

                                    $rand_string = $cs_counter . '' . jobcareer_generate_random_string(3);
                                    $offerslider_text = $offerslider['content'];
                                    $defaults = array('cs_slider_image' => '', 'cs_slider_title' => '', 'cs_slider_contents' => '', 'cs_readmore_link' => '', 'cs_offerslider_link_title' => '');

                                    foreach ($defaults as $key => $values) {
                                        if (isset($offerslider['atts'][$key]))
                                            $$key = $offerslider['atts'][$key];
                                        else
                                            $$key = $values;
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php
                                    echo esc_attr($rand_string);
                                    ;
                                    ?>">
                                        <header><h4><i class='icon-arrows'></i><?php esc_html_e('Testimonial', 'jobcareer'); ?></h4> <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a></header>
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Image', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter Slider Element title here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($cs_slider_image),
                                                'id' => 'cs_slider_image',
                                                'cust_name' => 'cs_slider_image[]',
                                                'return' => true,
                                            ),
                                        );

                                        $cs_html_fields->cs_form_fileupload_render($cs_opt_array);

                                        $cs_opt_array = array(
                                            'std' => $cs_slider_image,
                                            'id' => 'cs_slider_image',
                                            'name' => esc_html__('Image', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => '',
                                            'echo' => true,
                                            'array' => true,
                                            'prefix' => '',
                                            'field_params' => array(
                                                'std' => $cs_slider_image,
                                                'id' => 'cs_slider_image',
                                                'return' => true,
                                                'array' => true,
                                                'array_txt' => false,
                                                'prefix' => '',
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter Slider Element title here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($cs_slider_title),
                                                'id' => 'cs_slider_title',
                                                'cust_name' => 'cs_slider_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $cs_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Contents', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter Slider Element title here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($cs_slider_contents),
                                                'id' => 'cs_slider_contents',
                                                'cust_name' => 'cs_slider_contents[]',
                                                'return' => true,
                                            ),
                                        );

                                        $cs_html_fields->cs_text_field($cs_opt_array);

                                        $cs_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Read More Link', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Add number of post for show posts on page', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_url($cs_readmore_link),
                                                'id' => 'cs_readmore_link',
                                                'cust_name' => 'cs_readmore_link[]',
                                                'return' => true,
                                            ),
                                        );

                                        $cs_html_fields->cs_text_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Link Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => '',
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_url($cs_offerslider_link_title),
                                                'id' => 'cs_offerslider_link_title',
                                                'cust_name' => 'cs_offerslider_link_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $cs_html_fields->cs_text_field($cs_opt_array);
                                        ?>

                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $cs_opt_array = array(
                                'std' => (int) $offerslider_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'offerslider_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>

                            <div class="wrapptabbox cs-zero-padding">
                                <div class="opt-conts">
                                    <ul class="form-elements noborder">
                                        <li class="to-field">
                                            <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('offerslider', 'shortcode-item-<?php echo esc_attr($cs_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Offer', 'jobcareer'); ?></a>
                                            <div id="loading" class="shortcodeload"></div>
                                        </li>
                                    </ul>
                                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                        <ul class="form-elements insert-bg">
                                            <li class="to-field">
                                                <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo esc_js($cs_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a>
                                            </li>
                                        </ul>
                                        <div id="results-shortocde"></div>
                                    <?php } else { ?>

                                        <?php
                                        $cs_opt_array = array(
                                            'std' => 'offerslider',
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

        add_action('wp_ajax_jobcareer_pb_offerslider', 'jobcareer_pb_offerslider');
    }