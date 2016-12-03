<?php
/**
 * @Google map html form for page builder start
 */
if (!function_exists('jobcareer_pb_map')) {

    function jobcareer_pb_map($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
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
            $PREFIX = CS_SC_MAP;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_map_section_title' => '',
            'map_title' => '',
            'map_height' => '',
            'map_lat' => '-0.127758',
            'map_lon' => '51.507351',
            'map_zoom' => '',
            'map_type' => '',
            'map_info' => '',
            'map_info_width' => '',
            'map_info_height' => '',
            'map_marker_icon' => '',
            'map_show_marker' => 'true',
            'map_controls' => '',
            'map_draggable' => '',
            'map_scrollwheel' => '',
            'map_conactus_content' => '',
            'map_border' => '',
            'cs_map_style' => '',
            'map_border_color' => '',
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
        $map_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_map';
        $coloumn_class = 'column_' . $map_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $rand_string = $cs_counter . '' . jobcareer_generate_random_string(3);
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="map" data="<?php echo jobcareer_element_size_data_array_index($map_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $map_element_size, '', 'globe'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_MAP); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Map Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        $sh_code = '';
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                            $sh_code = 1;
                        }
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Element Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter Element Title here", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($cs_map_section_title),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_map_section_title[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Height', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Map height set here", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_height),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_height[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Latitude', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Latitude is the angular distance of a place north or south of the earths
								  equator, or of the equator of a celestial object, usually expressed in degrees and minutes.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_lat),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_lat[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Longitude', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Longitude the angular distance of a place east or west of the Greenwich 
								 meridian, or west of the standard meridian of a celestial object, usually expressed in degrees and minutes.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_lon),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_lon[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Zoom', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set map zoom level example 100 or leave it empty by default will be apply.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_zoom),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_zoom[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Types', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Choose type with this dropdown", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $map_type,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'map_type[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'ROADMAP' => esc_html__('ROADMAP', 'jobcareer'),
                                    'HYBRID' => esc_html__('HYBRID', 'jobcareer'),
                                    'SATELLITE' => esc_html__('SATELLITE', 'jobcareer'),
                                    'TERRAIN' => esc_html__('TERRAIN', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        //$jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Info Text', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter info text for marker.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_info),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_info[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Info Text Width', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("set info text max width here..", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_info_width),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_info_width[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>



                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Info Text Height', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Info Text Height.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_info_height),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'map_info_height[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'std' => $map_marker_icon,
                            'id' => 'map_marker_icon',
                            'name' => esc_html__('Marker Icon', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Select the Marker Icon Path for element.', 'jobcareer'),
                            'echo' => true,
                            'array' => true,
                            'prefix' => '',
                            'field_params' => array(
                                'std' => $map_marker_icon,
                                'cust_id' => '',
                                'id' => 'map_marker_icon',
                                'return' => true,
                                'array' => true,
                                'array_txt' => false,
                                'prefix' => '',
                            ),
                        );
                        if ($sh_code == 1){
                            $cs_opt_array['cus_rand_id'] = (string)jobcareer_generate_random_string(6);
                        }
                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Show Marker', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("This switch on/off marker from the map.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $map_show_marker,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'map_show_marker[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'true' => esc_html__('On', 'jobcareer'),
                                    'false' => esc_html__('Off', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Disable Controls', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Map control disable/enable with this dropdown.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $map_controls,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'map_controls[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'true' => esc_html__('On', 'jobcareer'),
                                    'false' => esc_html__('Off', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Draggable', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Draggable On/Off in map.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $map_draggable,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'map_draggable[]',
                                'classes' => 'dropdown  chosen-select-no-single select-medium',
                                'options' => array(
                                    'true' => esc_html__('On', 'jobcareer'),
                                    'false' => esc_html__('Off', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Scroll Wheel', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set Scroll wheel zoom in zoom out enable disable from this dropdown.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $map_scrollwheel,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'map_scrollwheel[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'true' => esc_html__('On', 'jobcareer'),
                                    'false' => esc_html__('Off', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Border', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set border for map", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $map_border,
                                'id' => '',
                                'cust_id' => '',
                                'cust_name' => 'map_border[]',
                                'classes' => 'dropdown chosen-select-no-single select-medium',
                                'options' => array(
                                    'yes' => esc_html__('Yes', 'jobcareer'),
                                    'no' => esc_html__('No', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Border Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Choose map border color.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($map_border_color),
                                'cust_id' => '',
                                'classes' => 'bg_color',
                                'cust_name' => 'map_border_color[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                        ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => 'map',
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
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_map', 'jobcareer_pb_map');
}