<?php
/*
 * Start function for multi team backend view
 */
if (!function_exists('jobcareer_pb_multiple_team')) {

    function jobcareer_pb_multiple_team($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $multiple_team_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_MULTPLETEAM . '|' . CS_SC_MULTPLETEAMITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_multiple_team_section_title' => '',
            'cs_multi_team_content_col' => '',
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
            $multiple_team_num = count($atts_content);
        }
        $multiple_team_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $name = 'jobcareer_pb_multiple_team';
        $coloumn_class = 'column_' . $multiple_team_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $randD_id = rand(34213234, 453324453);
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="multiple_team" data="<?php echo jobcareer_element_size_data_array_index($multiple_team_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $multiple_team_element_size, '', 'weixin'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter); ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Team Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content" >
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_MULTPLETEAM); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_MULTPLETEAMITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_MULTPLETEAMITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_MULTPLETEAM); ?> {{attributes}}]">
                                <?php
                                $sh_code = '';
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                    $sh_code = 1;
                                }

                                $cs_opt_array = array(
                                    'name' => esc_html__('Element Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Add element title here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_multiple_team_section_title),
                                        'cust_id' => '',
                                        'classes' => '',
                                        'cust_name' => 'cs_multiple_team_section_title[]',
                                        'return' => true,
                                    ),
                                );
                                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Column', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Select Number of Columns", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_multi_team_content_col,
                                        'id' => '',
                                        'cust_name' => 'cs_multi_team_content_col[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            '2' => esc_html__('2 Columns', 'jobcareer'),
                                            '3' => esc_html__('3 Columns', 'jobcareer'),
                                            '4' => esc_html__('4 Columns', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);


                                //do_action('admin_print_footer_scripts');
                                //$('.editor').append( EDITOR );
                                ?>
                            </div>
                            <?php if ($cs_multiple_team_view == 'cs-box') {
                                ?>
                                <script type="text/javascript">
                                    jQuery('.alignment-style').hide();
                                </script>
                                <?php
                            }
                            ?>
                            <script type="text/javascript">
                                function cs_service_style_change(selected_val) {

                                    if (selected_val == 'cs-box') {
                                        $('.alignment-style').hide();
                                    }
                                    else {
                                        $('.alignment-style').show();
                                    }

                                }



                            </script>

                            <?php
                            if (isset($multiple_team_num) && $multiple_team_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                $itemCounter = 0;
                                foreach ($atts_content as $multiple_team_items) {
                                    $itemCounter++;
                                    $rand_id = rand(3453499, 94646890);
                                    $cs_multiple_service_text = $multiple_team_items['content'];
                                    $defaults = array(
                                        'cs_multi_team_name' => '',
                                        'cs_multi_team_designation' => '',
                                        'cs_multi_team_image' => '',
                                        'cs_multi_team_fb_url' => '',
                                        'cs_multi_team_twitter_url' => '',
                                        'cs_multi_team_linkedin_url' => '',
                                        'cs_multi_team_email' => '',
                                    );

                                    foreach ($defaults as $key => $values) {
                                        if (isset($multiple_team_items['atts'][$key])) {
                                            $$key = $multiple_team_items['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo jobcareer_special_char($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Team', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>
                <?php
                $cs_opt_array = array(
                    'name' => esc_html__('Name', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Enter team member name here.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr($cs_multi_team_name),
                        'cust_id' => '',
                        'classes' => '',
                        'cust_name' => 'cs_multi_team_name[]',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                $cs_opt_array = array(
                    'name' => esc_html__('Designation', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Enter team member designation here.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr($cs_multi_team_designation),
                        'cust_id' => '',
                        'classes' => '',
                        'cust_name' => 'cs_multi_team_designation[]',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                
                $cs_opt_array = array(
                    'std' => $cs_multi_team_image,
                    'id' => 'multi_team_image',
                    'name' => esc_html__('Team Profile Image', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__('Attach image from media gallery.', 'jobcareer'),
                    'echo' => true,
                    'array' => true,
                    'field_params' => array(
                        'std' => $cs_multi_team_image,
                        'cust_id' => '',
                        'id' => 'multi_team_image',
                        'return' => true,
                        'array' => true,
                        'array_txt' => false,
                    ),
                );
               
                $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);


                $cs_opt_array = array(
                    'name' => esc_html__('Facebook', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Insert facebook profile URL of member.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr($cs_multi_team_fb_url),
                        'cust_id' => '',
                        'classes' => '',
                        'cust_name' => 'cs_multi_team_fb_url[]',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                $cs_opt_array = array(
                    'name' => esc_html__('Twitter URL', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Insert twitter profile URL of member.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr($cs_multi_team_twitter_url),
                        'cust_id' => '',
                        'classes' => '',
                        'cust_name' => 'cs_multi_team_twitter_url[]',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                $cs_opt_array = array(
                    'name' => esc_html__('Linkedin', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Insert linkedin profile URL of member.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr($cs_multi_team_linkedin_url),
                        'cust_id' => '',
                        'classes' => '',
                        'cust_name' => 'cs_multi_team_linkedin_url[]',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                $cs_opt_array = array(
                    'name' => esc_html__('Email', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Add member email for any one can contact.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => sanitize_email($cs_multi_team_email),
                        'cust_id' => '',
                        'classes' => '',
                        'cust_name' => 'cs_multi_team_email[]',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);


                $rand_id = rand(0, 85498749847);
                ?>
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
                                    </div>										
                <?php
            }
        }
        ?>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $cs_opt_array = array(
                                'std' => (int) $multiple_team_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'multiple_team_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>
                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">
                                    <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('multiple_team', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>','<?php echo esc_html($sh_code); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Team', 'jobcareer'); ?></a> </li>
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
                                    'std' => 'multiple_team',
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

    add_action('wp_ajax_jobcareer_pb_multiple_team', 'jobcareer_pb_multiple_team');
}
