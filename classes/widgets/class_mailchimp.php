<?php
/**
 * @MailChimp widget Class
 *
 *
 */
if (!class_exists('jobcareer_mailchimp')) {

    class jobcareer_mailchimp extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init MailChimp Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'jobcareer_mailchimp', // Base ID
                    esc_html__('CS: Mail Chimp', 'jobcareer'), // Name
                    array('classname' => 'widget-newsletter', 'description' => esc_html__('Mail Chimp Newsletter Widget', 'jobcareer'),) // Args
            );
        }

        /**
         * @MailChimp html form
         *
         *
         */
        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $description = isset($instance['description']) ? esc_attr($instance['description']) : '';
            $select_view = isset($instance['select_view']) ? esc_attr($instance['select_view']) : '';

            $cs_opt_array = array(
                'name' => esc_html__('Title', 'jobcareer'),
                'desc' => '',
                'hint_text' => esc_html__("Enter your element title here.", 'jobcareer'),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($title),
                    'cust_id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('title')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);

            $cs_opt_array = array(
                'name' => esc_html__('Select view', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => $select_view,
                    'id' => jobcareer_special_char($this->get_field_id('select_view')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('select_view')),
                    'classes' => 'dropdown chosen-select-no-single',
                    'options' => array(
                        'simple' => esc_html__('Simple', 'jobcareer'),
                        'modren' => esc_html__('Modern', 'jobcareer'),
                        'career' => esc_html__('career', 'jobcareer'),
                    ),
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_select_field($cs_opt_array));

            $cs_opt_array = array(
                'name' => esc_html__('Description', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($description),
                    'cust_id' => '',
                    'classes' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('description')),
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_textarea_field($cs_opt_array));
          
        }

        /**
         * @MailChimp update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['description'] = $new_instance['description'];
            $instance['select_view'] = $new_instance['select_view'];
            return $instance;
        }

        /**
         * @Display MailChimp widget
         *
         *
         */
        function widget($args, $instance) {
            global $jobcareer_node, $wpdb, $post, $jobcareer_options, $counter, $jobcareer_form_fields;

            $counter++;
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            $description = empty($instance['description']) ? ' ' : apply_filters('widget_title', $instance['description']);
            $select_view = empty($instance['select_view']) ? ' ' : apply_filters('widget_title', $instance['select_view']);
            if (isset($select_view) and $select_view == "modren") {
                $cs_clss_view = 'newsletter-widget-2';
            } elseif (isset($select_view) and $select_view == "career") {
                $cs_clss_view = 'newsletter-widget-3';
            } else {
                $cs_clss_view = 'col-md-2';
            }
            if (class_exists('MailChimp')) {
                echo jobcareer_special_char($before_widget);
                    echo jobcareer_special_char($before_title) . htmlspecialchars_decode($title) . $after_title;
                    ?>
                    <div class="fieldset">
                        <p><?php echo esc_html($description); ?></p>
                        <form action="javascript:jobcareer_mailchimp_submit('<?php echo get_template_directory_uri() ?>','<?php echo esc_js($counter); ?>','<?php echo admin_url('admin-ajax.php'); ?>')" id="mcform_<?php echo intval($counter); ?>" class="cs-mailchimp" method="post">
                            <div class="clear"></div>

                            <?php
                            $cs_opt_array = array(
                                'std' => isset($jobcareer_options['jobcareer_mailchimp_list']) ? $jobcareer_options['jobcareer_mailchimp_list'] : '',
                                'id' => 'list_id',
                                'cust_type' => 'hidden',
                            );

                            $jobcareer_form_fields->cs_form_text_render($cs_opt_array);

                            $cs_opt_array = array(
                                'std' => esc_html__('Enter your email address', 'jobcareer'),
                                'cust_id' => 'mc_email',
                                'cust_name' => 'mc_email',
                                'extra_atr' => ' onblur="if (this.value == \'\') {this.value = \'' . esc_html__('Enter your email address', 'jobcareer') . '\';}" onfocus="if (this.value == \'' . esc_html__('Enter your email address', 'jobcareer') . '\') {this.value = \'\';}"',
                                'classes' => 'txt-bar',
                            );

                            $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
                            $cs_opt_array = array(
                                'std' => esc_html__('Submit', 'jobcareer'),
                                'cust_id' => 'btn_newsletter_' . $counter,
                                'cust_name' => 'submit',
                                'cust_type' => 'submit',
                                'classes' => 'submit-btn cs-bgcolor',
                            );

                            $jobcareer_form_fields->cs_form_text_render($cs_opt_array);
                            ?>

                        </form>
                        <div id="newsletter_mess_<?php echo intval($counter); ?>" style="display:none" class="cs-error-msg"></div>
                    </div>

                <?php
				echo jobcareer_special_char($after_widget);
            }
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_mailchimp");'));
