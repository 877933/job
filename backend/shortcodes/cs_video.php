<?php
/*
 *
 * @Shortcode Name : Video
 * @retrun
 *
 */
if(!function_exists('jobcareer_pb_video')){
function jobcareer_pb_video($die = 0) {
    global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
    $shortcode_element = '';
    $filter_element = 'filterdrag';
    $shortcode_view = '';
    $output = array();
    $counter = $_POST['counter'];
    $cs_counter = $_POST['counter'];
    $album_num = 0;
    if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
        $POSTID = '';
        $shortcode_element_id = '';
    } else {
        $POSTID = $_POST['POSTID'];
        $shortcode_element_id = $_POST['shortcode_element_id'];
        $shortcode_str = stripslashes($shortcode_element_id);
        $PREFIX = CS_SC_VIDEO;
        $parseObject = new ShortcodeParse();
        $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
    }
    $defaults = array('cs_video_section_title' => '', 'video_url' => '', 'video_height' => '250', 'cs_video_custom_animation' => '');
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
        $album_num = count($atts_content);
    }
    $video_element_size = '25';
    foreach ($defaults as $key => $values) {
        if (isset($atts[$key])) {
            $$key = $atts[$key];
        } else {
            $$key = $values;
        }
    }
    $name = 'jobcareer_pb_video';
    $coloumn_class = 'column_' . $video_element_size;
    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
        $shortcode_element = 'shortcode_element_class';
        $shortcode_view = 'cs-pbwp-shortcode';
        $filter_element = 'ajax-drag';
        $coloumn_class = '';
    }
    ?>

    <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="video" data="<?php echo jobcareer_element_size_data_array_index($video_element_size) ?>" >
        <?php jobcareer_element_setting($name, $cs_counter, $video_element_size, '', 'play-circle'); ?>
        <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_VIDEO); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_VIDEO); ?>]" style="display: none;">
            <div class="cs-heading-area">
                <h5><?php esc_html_e('VIDEO OPTIONS', 'jobcareer'); ?></h5>
                <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
            <div class="cs-pbwp-content">
                <div class="cs-wrapp-clone cs-shortcode-wrapp">
                    <?php
                    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                        jobcareer_shortcode_element_size();
                    }
                    ?>
                    <?php
                    $cs_opt_array = array(
                        'name' => esc_html__('Element Title', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => 'Enter title here',
                        'echo' => true,
                        'field_params' => array(
                            'std' => esc_html($cs_video_section_title),
                            'id' => 'cs_video_section_title',
                            'cust_name' => 'cs_video_section_title[]',
                            'return' => true,
                        ),
                    );

                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                    $cs_opt_array = array(
                        'name' => esc_html__('Video Url', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => 'Enter video url here',
                        'echo' => true,
                        'field_params' => array(
                            'std' => esc_url($video_url),
                            'id' => 'video_url[]',
                            'cust_name' => 'video_url[]',
                            'return' => true,
                        ),
                    );

                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                    $cs_opt_array = array(
                        'name' => esc_html__('Height', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => 'set video frame height here',
                        'echo' => true,
                        'field_params' => array(
                            'std' => esc_html($video_height),
                            'id' => 'video_height',
                            'cust_name' => 'video_height[]',
                            'return' => true,
                        ),
                    );

                    $jobcareer_html_fields->cs_text_field($cs_opt_array);
                    
                    if (function_exists('jobcareer_shortcode_custom_classes_test')) {
                        //jobcareer_shortcode_custom_dynamic_classes($cs_video_custom_class, $cs_video_custom_animation, '', 'video');
                    }
                    ?>
                </div>
                <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                    <ul class="form-elements insert-bg">
                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                    </ul>
                    <div id="results-shortocde"></div>
                <?php } else { ?>
                    <?php
                    $cs_opt_array = array(
                        'std' => 'video',
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
}
add_action('wp_ajax_jobcareer_pb_video', 'jobcareer_pb_video');