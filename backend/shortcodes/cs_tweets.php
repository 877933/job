<?php
/*
 *
 * @Shortcode Name : Tweets
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_tweets')) {

    function jobcareer_pb_tweets($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
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
            $PREFIX = CS_SC_TWEETS;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('cs_tweets_section_title' => '', 'cs_tweets_user_name' => 'default', 'cs_tweets_view' => '', 'cs_no_of_tweets' => '', 'cs_tweets_color' => '');
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        $tweets_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_tweets';
        $coloumn_class = 'column_' . $tweets_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="tweets" data="<?php echo jobcareer_element_size_data_array_index($tweets_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $tweets_element_size, '', 'twitter'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_TWEETS); ?> {{attributes}}]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('TWITTER OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter) ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                        }
                        $cs_opt_array = array(
                            'name' => esc_html__('Twitter Username', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => 'Enter your twitter user name here',
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_tweets_user_name),
                                'id' => 'cs_tweets_user_name',
                                'cust_name' => 'cs_tweets_user_name[]',
                                'classes' => '',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        
                        $cs_opt_array = array(
                            'name' => esc_html__('Choose Style', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => 'Choose style from this dropdown ',
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_tweets_view),
                                'id' => 'cs_tweets_view',
                                'cust_name' => 'cs_tweets_view[]',
                                'classes' => 'chosen-select',
                                'options' => array('modren' => __('Modern', 'jobcareer'), 'fancy' => __('Fancy', 'jobcareer')),
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Text Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => 'set text color here',
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_tweets_color),
                                'id' => 'cs_tweets_color',
                                'cust_name' => 'cs_tweets_color[]',
                                'classes' => 'bg_color',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('No of Tweets', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => 'Enter number of tweets',
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_no_of_tweets),
                                'id' => 'cs_no_of_tweets',
                                'cust_name' => 'cs_no_of_tweets[]',
                                'classes' => '',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                    </div>
                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field">
                                <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a>
                            </li>
                        </ul>
                        <div id="results-shortocde"></div>
                        <?php
                    } else {

                        $cs_opt_array = array(
                            'std' => 'tweets',
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
    add_action('wp_ajax_jobcareer_pb_tweets', 'jobcareer_pb_tweets');
}