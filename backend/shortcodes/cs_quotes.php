<?php
/*
 *
 * @Shortcode Name : Heading
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_quotes')) {

    function jobcareer_pb_quotes($die = 0) {
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
            $PREFIX = 'cs_quotes';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'quote_style' => 'default',
            'cs_quote_section_title' => '',
            'quote_cite' => '',
            'quote_cite_url' => '#',
            'quote_text_color' => '',
            'quote_align' => 'center',
            'cs_quote_content' => ''
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $quotes_content = $output['0']['content'];
        } else {
            $quotes_content = '';
        }
        $quotes_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'jobcareer_pb_quotes';
        $coloumn_class = 'column_' . $quotes_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="quotes" data="<?php echo jobcareer_element_size_data_array_index($quotes_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $quotes_element_size, '', 'h-square', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>"  
                 data-shortcode-template="[cs_quotes {{attributes}}]{{content}}[/cs_quotes]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Quote Options', 'jobcareer'); ?></h5>
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
                            'hint_text' => esc_html__('Enter element title here', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_quote_section_title),
                                'id' => 'cs_quote_section_title',
                                'cust_name' => 'cs_quote_section_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Author', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Give the name of the quote author', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($quote_cite),
                                'id' => 'quote_cite',
                                'cust_name' => 'quote_cite[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Author Url', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Give the URL of author profile external/internal', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_url($quote_cite_url),
                                'id' => 'quote_cite_url',
                                'cust_name' => 'quote_cite_url[]',
                                'return' => true,
                                'classes' => 'txtfield',
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                        $cs_opt_array = array(
                            'name' => esc_html__('Content', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter content here.', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                'std' => esc_html($quotes_content),
                                'id' => 'cs_quote_content',
                                'cust_name' => 'cs_quote_content[]',
                                'cs_editor' => true,
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                        ?>

                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => 'quotes',
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

    add_action('wp_ajax_jobcareer_pb_quotes', 'jobcareer_pb_quotes');
}