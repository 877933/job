<?php
/*
 * Start function for Icon Box backend view
 */
if (!function_exists('jobcareer_pb_icon_box')) {

    function jobcareer_pb_icon_box($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $icon_box_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_ICONBOX . '|' . CS_SC_ICONBOXITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_icon_box_section_title' => '',
            'cs_icon_box_sub_title' => '',
            'cs_main_title_color' => '',
            'cs_icon_box_view' => '',
            'cs_icon_box_content_align' => '',
            'cs_icon_box_image_align' => '',
            'cs_icon_box_content_col' => '',
            'cs_icon_box_styles' => '',
            'cs_title_color' => '',
            'cs_icon_box_content_color' => '',
            'cs_icon_box_icon_color' => '',
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
            $icon_box_num = count($atts_content);
        }
        $icon_box_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $name = 'jobcareer_pb_icon_box';
        $coloumn_class = 'column_' . $icon_box_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $randD_id = rand(34213234, 453324453);
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="icon_box" data="<?php echo jobcareer_element_size_data_array_index($icon_box_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $icon_box_element_size, '', 'weixin'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter); ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Icon Box Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_ICONBOX); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_ICONBOXITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_ICONBOXITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_ICONBOX); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }

                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Add element title here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_icon_box_section_title),
                                        'cust_id' => '',
                                        'classes' => '',
                                        'cust_name' => 'cs_icon_box_section_title[]',
                                        'return' => true,
                                    ),
                                );
                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Content ', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Add content here.", 'jobcareer'),
                                    'echo' => true,
                                    'teeny' => true,
                                    'media_buttons' => false,
                                    'textarea_rows' => 6,
                                    'quicktags' => false,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_icon_box_sub_title),
                                        'cust_id' => '',
                                        'classes' => 'cs_icon_box_sub_title',
                                        'cust_name' => 'cs_icon_box_sub_title[]',
                                        'return' => true,
                                        'cs_editor' => true,
                                    //'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                    ),
                                );
                                $jobcareer_html_fields->cs_textarea_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title Color ', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Set title and element color from here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr($cs_main_title_color),
                                        'cust_id' => 'cs_main_title_color',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'cs_main_title_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Styles', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Choose style for multiple icon_box.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_icon_box_view,
                                        'id' => '',
                                        'cust_id' => 'cs_size',
                                        'cust_name' => 'cs_icon_box_view[]',
                                        'classes' => 'cs_size chosen-select select-medium',
                                        'extra_atr' => ' onchange=cs_icon_box_style_change(this.value)',
                                        'options' => array(
                                            'cs-box' => esc_html__('Box', 'jobcareer'),
                                            'simple' => esc_html__('Simple', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);


                                $cs_opt_array = array(
                                    'name' => esc_html__('Alignment', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Set the position of icon box image here", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_icon_box_content_align,
                                        'id' => '',
                                        'cust_name' => 'cs_icon_box_content_align[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            'left' => esc_html__('Left', 'jobcareer'),
                                            'right' => esc_html__('Right', 'jobcareer'),
                                            'center' => esc_html__('Center', 'jobcareer'),
                                            'top-left' => esc_html__('Top Left', 'jobcareer'),
                                            'top-right' => esc_html__('Top Right', 'jobcareer')
                                        ),
                                        'return' => true,
                                    ),
                                );
                                $cs_div_style = "display:none";
                                if (isset($cs_icon_box_view) && $cs_icon_box_view != "") {
                                    $cs_div_style = "display:block";
                                }
                                echo '<div class="alignment-style" style=" ' . $cs_div_style . ' ">';
                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                echo '</div>';

                                $cs_opt_array = array(
                                    'name' => esc_html__('Column', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Select Number of Columns", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_icon_box_content_col,
                                        'id' => '',
                                        'cust_name' => 'cs_icon_box_content_col[]',
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

                                $cs_opt_array = array(
                                    'name' => esc_html__('Icon Box Title Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Set title color from here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr($cs_title_color),
                                        'cust_id' => 'cs_title_color',
                                        'classes' => 'bg_color',
                                        'cust_name' => 'cs_title_color[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Icon Box Content Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Provide a hex colour code here (with #) for text color. if you want to override the default.', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_html($cs_icon_box_content_color),
                                        'id' => 'cs_icon_box_content_color',
                                        'cust_name' => 'cs_icon_box_content_color[]',
                                        'classes' => 'bg_color',
                                        'return' => true,
                                    ),
                                );

                                //$jobcareer_html_fields->cs_text_field($cs_opt_array);
                                $cs_opt_array = array(
                                    'name' => esc_html__('Icon Box icon Color', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__('Provide a hex colour code here (with #) for icon color. if you want to override the default.', 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_html($cs_icon_box_icon_color),
                                        'id' => 'cs_icon_box_icon_color',
                                        'cust_name' => 'cs_icon_box_icon_color[]',
                                        'classes' => 'bg_color',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                //do_action('admin_print_footer_scripts');
                                ?>
                            </div>
                            <?php if ($cs_icon_box_view == 'cs-box') {
                                ?>
                                <script type="text/javascript">
                                    jQuery('.alignment-style').hide();
                                </script>
                                <?php
                            }
                            ?>
                            <script type="text/javascript">
                                function cs_icon_box_style_change(selected_val) {

                                    if (selected_val == 'cs-box') {
                                        $('.alignment-style').hide();
                                    } else {
                                        $('.alignment-style').show();
                                    }

                                }
                            </script>
                            <?php
                            if (isset($icon_box_num) && $icon_box_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                $itemCounter = 0;
                                foreach ($atts_content as $icon_box_items) {
                                    $itemCounter++;
                                    $rand_id = rand(3453499, 94646890);
                                    $cs_icon_box_text = $icon_box_items['content'];
                                    $defaults = array('cs_title_color' => '', 'cs_text_color' => '', 'cs_bg_color' => '', 'cs_website_url' => '', 'cs_icon_box_title' => '', 'cs_icon_box_logo' => '', 'cs_icon_box_btn' => '', 'cs_icon_box_btn_link' => '', 'cs_icon_box_btn_bg_color' => '', 'cs_icon_box_btn_txt_color' => '',
                                        'cs_icon_box_image_icon' => '',
                                        'cs_icon_box_image_circle' => '',
                                        'cs_sercices_icon' => '',
                                        'cs_icon_box_icon_size' => '',
                                        'cs_icon_box_icon_color' => '',
                                        'cs_icon_box_icon_circle' => '',
                                        'cs_button_link' => '',
                                        'cs_button_text' => '',
                                        'cs_button_text_color' => '',
                                        'cs_button_color' => '',
                                        'cs_icon_box_content_color' => '',
                                        //'cs_icon_box_background_color' => '',
                                        'cs_icon_box_image_size' => '',
                                        'cs_icon_box_icon_type' => '',
                                        'cs_icon_box_image_array' => '',
                                        'cs_icon_box_icon' => '',
                                        'cs_icon_box_link' => '',
                                    );

                                    foreach ($defaults as $key => $values) {
                                        if (isset($icon_box_items['atts'][$key])) {
                                            $$key = $icon_box_items['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo jobcareer_special_char($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Icon Box', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Add icon_box title here..", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($cs_icon_box_title),
                                                'cust_id' => 'cs_icon_box_title',
                                                'classes' => '',
                                                'cust_name' => 'cs_icon_box_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title Link', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter icon box title link here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $cs_icon_box_link,
                                                'id' => 'cs_icon_box_link',
                                                'cust_name' => 'cs_icon_box_link[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                        $rand_id = rand(0, 85498749847);

                                        //$jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Image/icon', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Select icon type image or font icon.', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($cs_icon_box_icon_type),
                                                'id' => 'cs_icon_box_icon_type',
                                                'cust_name' => 'cs_icon_box_icon_type[]',
                                                //'extra_atr' => ' onchange=cs_icon_box_view_change(this.value)',
                                                'classes' => 'chosen-select-no-single select-medium function-class',
                                                'options' => array(
                                                    'icon' => esc_html__('Icon', 'jobcareer'),
                                                    'image' => esc_html__('Image', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                        ?>
                                        <div class="cs-sh-icon_box-image-area" style="display:<?php echo esc_html($cs_icon_box_icon_type == 'image' ? 'block' : 'none') ?>;">
                                            <?php
                                            $cs_opt_array = array(
                                                'std' => $cs_icon_box_image_array,
                                                'id' => 'icon_box_image',
                                                'name' => esc_html__('Image', 'jobcareer'),
                                                'desc' => '',
                                                'hint_text' => esc_html__('Attach image from media gallery.', 'jobcareer'),
                                                'echo' => true,
                                                'array' => true,
                                                'field_params' => array(
                                                    'std' => $cs_icon_box_image_array,
//                                                'cust_id' => '',
                                                    'id' => 'icon_box_image',
                                                    'return' => true,
                                                    'array' => true,
                                                    'array_txt' => true
                                                ),
                                            );
                                            $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

                                            $rand_id = rand(1111111, 9999999);
                                            ?>
                                        </div>

                                        <div class="cs-sh-icon_box-icon-area" style="display:<?php echo esc_html($cs_icon_box_icon_type != 'image' ? 'block' : 'none') ?>;">
                                            <div class="form-elements" id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label><?php esc_html_e('Icon Box Icon', 'jobcareer'); ?></label>
                                                    <?php
                                                    if (function_exists('jobcareer_tooltip_text')) {
                                                        echo jobcareer_tooltip_text(esc_html__('Select the Icons you would like to show with your accordion title.', 'jobcareer'));
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <?php jobcareer_fontawsome_icons_box($cs_icon_box_icon, $rand_id, 'cs_icon_box_icon'); ?>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <?php
                                            // $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                            $cs_opt_array = array(
                                                'name' => esc_html__('Icon Color', 'jobcareer'),
                                                'desc' => '',
                                                'hint_text' => esc_html__('Set the position of icon_box image here', 'jobcareer'),
                                                'echo' => true,
                                                'field_params' => array(
                                                    'std' => esc_html($cs_icon_box_icon_color),
                                                    'id' => 'cs_icon_box_icon_color',
                                                    'cust_name' => 'cs_icon_box_icon_color[]',
                                                    'classes' => 'bg_color',
                                                    'return' => true,
                                                ),
                                            );

                                            //$jobcareer_html_fields->cs_text_field($cs_opt_array);
                                            ?>
                                        </div>    
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title Link', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Enter icon_box title link here', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($cs_icon_box_link),
                                                'id' => 'cs_icon_box_link',
                                                'cust_name' => 'cs_icon_box_link[]',
                                                'classes' => 'txtfield',
                                                'return' => true,
                                            ),
                                        );

                                        //$jobcareer_html_fields->cs_text_field($cs_opt_array);


                                        $cs_opt_array = array(
                                            'name' => esc_html__('Icon Box Content', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter little description about icon_box.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($cs_icon_box_text),
                                                'cust_id' => '',
                                                'classes' => 'txtfield',
                                                'cust_name' => 'cs_icon_box_text[]',
                                                'return' => true,
                                                'cs_editor' => true,
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                                        ?>
                                        <script>
                                            jQuery('.function-class').change(function ($) {
                                                var value = jQuery(this).val();

                                                var parentNode = jQuery(this).parent().parent().parent();
                                                if (value == 'image') {
                                                    //alert(parentNode);
                                                    parentNode.find(".cs-sh-icon_box-image-area").show();
                                                    parentNode.find(".cs-sh-icon_box-icon-area").hide();
                                                    /*
                                                     jQuery(".cs-sh-icon_box-image-area").show();
                                                     jQuery(".cs-sh-icon_box-icon-area").hide();
                                                     */
                                                } else {
                                                    parentNode.find(".cs-sh-icon_box-image-area").hide();
                                                    parentNode.find(".cs-sh-icon_box-icon-area").show();
                                                    /*
                                                     jQuery(".cs-sh-icon_box-image-area").hide();
                                                     jQuery(".cs-sh-icon_box-icon-area").show();
                                                     */
                                                }

                                            }
                                            );
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
                                    </div>										
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $cs_opt_array = array(
                                'std' => (int) $icon_box_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'icon_box_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>
                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field"> <a href="#" class="add_icon_boxss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('icon_box', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Icon Box', 'jobcareer'); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
                            </div>
                            <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                <ul class="form-elements insert-bg">
                                    <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo jobcareer_special_char(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                </ul>
                                <div id="results-shortocde"></div>
                            <?php } else { ?>
                                <?php
                                $cs_opt_array = array(
                                    'std' => 'icon_box',
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
        <script>

            /*
                     
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

    add_action('wp_ajax_jobcareer_pb_icon_box', 'jobcareer_pb_icon_box');
}