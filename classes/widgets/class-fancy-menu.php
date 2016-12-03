<?php
if (!class_exists('jobcareer_fancy_menu')) {
    class jobcareer_fancy_menu extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init Fancy Menu Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'jobcareer_fancy_menu', // Base ID
                    esc_html__('CS : Fancy Menu', 'jobcareer'), // Name
                    array('classname' => 'cs-fancy-menu', 'description' =>  esc_html__('Fancy Menu', 'jobcareer'),) // Args
            );
        }

        /**
         * @Fancy Menu html form
         *
         *
         */
        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $jobcareer_widget_title = $instance['title'];
            $jobcareer_menu_name = isset($instance['jobcareer_menu_name']) ? esc_attr($instance['jobcareer_menu_name']) : '';
            $menus = get_terms('nav_menu', array('hide_empty' => false));
            // If no menus exists, jobcareerect the user to go and create some.
            if (!$menus) {
                echo '<p>' . sprintf( __('No Menu exists. ', 'jobcareer') . '<a href="%s">Create some</a>', admin_url('nav-menus.php')) . '</p>';
                return;
            }
            foreach ($menus as $menu) {
                $all_options[$menu->term_id]=$menu->name;
            }
            
            $jobcareer_opt_array = array(
                'name' => esc_html__('Title', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($jobcareer_widget_title),
                    'id' => cs_allow_special_char($this->get_field_id('title')),
                    'classes' => '',
                    'cust_id' => cs_allow_special_char($this->get_field_name('title')),
                    'cust_name' => cs_allow_special_char($this->get_field_name('title')),
                    'return' => true,
                    'required' => false
                ),
            );
            $jobcareer_html_fields->cs_text_field($jobcareer_opt_array);
            $jobcareer_opt_array = array(
                'name' => esc_html__('Select Menu', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                        'std' => esc_html($jobcareer_menu_name),
                        'cust_name' => cs_allow_special_char($this->get_field_name('jobcareer_menu_name')),
                        'cust_id' => cs_allow_special_char($this->get_field_name('jobcareer_menu_name')),
                        'id' => '',
                        'classes' => 'cs-recentpost-width',
                        'options' => $all_options,
                        'return' => true,
                ),
            );
            $jobcareer_html_fields->cs_select_field($jobcareer_opt_array);
        }

        /**
         * @Fancy menu update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['jobcareer_menu_name'] = $new_instance['jobcareer_menu_name'];
            return $instance;
        }
        // Fancy menu Widget View
        function widget($args, $instance) {
            global $jobcareer_node, $wpdb, $post;
            extract($args, EXTR_SKIP);
            $jobcareer_widget_title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            $jobcareer_widget_title = htmlspecialchars_decode(stripslashes($jobcareer_widget_title));
            $jobcareer_menu_name = empty($instance['jobcareer_menu_name']) ? ' ' : apply_filters('widget_title', $instance['jobcareer_menu_name']);
//            echo cs_allow_special_char($before_widget);
            //$jobcareer_menu_class = $jobcareer_sticky_menu == true ? 'shortcode-nav cs-stickynav' : 'shortcode-nav';
            $jobcareer_menu_arg = array(
                'theme_location' => '',
                'menu' => $jobcareer_menu_name,
                'container' => '',
                'container_class' => '',
                'container_id' => '',
                'menu_class' => 'menu',
                'menu_id' => '',
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'items_wrap' => '<ul>%3$s</ul>',
                'depth' => 0,
                'walker' => ''
            );
            echo '<div class="widget nav-widget cs-fancy-menu">';
            
            
            if (!empty($jobcareer_widget_title) && $jobcareer_widget_title <> '') {
                    echo '<div class="widget-title">
                            <h6>'. cs_allow_special_char($jobcareer_widget_title) .'</h6>
                        </div>';
                
            }
            wp_nav_menu($jobcareer_menu_arg);
            echo '</div>';

//            echo cs_allow_special_char($after_widget);
        }
    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_fancy_menu");'));
