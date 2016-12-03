<?php
/*
 *
 * @Shortcode Name : Divider
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_divider')) {

    function jobcareer_pb_divider($die = 0) {
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
            $PREFIX = CS_SC_DIVIDER;
            $parseObject = new ShortcodeParse();
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'column_size' => '1/1',
            'divider_style' => 'divider1',
            'divider_height' => '1',
            'divider_margin_top' => '',
            'divider_margin_bottom' => '',
            'line' => 'Wide', 'color' => '#000',
            'cs_divider_class' => ''
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $atts_content = $output['0']['content'];
        } else {
            $atts_content = '';
        }
        $divider_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_divider';
        $coloumn_class = 'column_' . $divider_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="divider" data="<?php echo jobcareer_element_size_data_array_index($divider_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $divider_element_size, '', 'ellipsis-h', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_DIVIDER); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('DIVIDER OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                                  <?php
                                    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                    }
                                    ?>

                        <div class="form-elements">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php esc_html_e('Margin Top', 'jobcareer'); ?></label>
                                <?php
                                if (function_exists('jobcareer_tooltip_text')) {
                                    echo jobcareer_tooltip_text(esc_html__('Set margin top for the divider in px.', 'jobcareer'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                
                                <?php
                                $cs_opt_array = array(
                                    'std' => esc_attr($divider_margin_top),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'divider_margin_top[]',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                ?>
                                <p></p>
                            </div>
                        </div>
                        <div class="form-elements">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php esc_html_e('Margin Bottom', 'jobcareer'); ?></label>
                                <?php
                                if (function_exists('jobcareer_tooltip_text')) {
                                    echo jobcareer_tooltip_text(esc_html__('Set margin bottom for the divider in px.', 'jobcareer'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php
                                $cs_opt_array = array(
                                    'std' => esc_attr($divider_margin_bottom),
                                    'id' => '',
                                    'classes' => 'cs-range-input input-small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'divider_margin_bottom[]',
                                    'return' => true,
                                    'required' => false,
                                    'rang' => true,
                                    'min' => 0,
                                    'max' => 50,
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                ?>
                                <p></p>
                            </div>
                        </div>

                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => 'divider',
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

    add_action('wp_ajax_jobcareer_pb_divider', 'jobcareer_pb_divider');
}