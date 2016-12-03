<?php

/**
 * @Ads Banners Widget Class
 */
if (!class_exists('jobcareer_ads_banner')) {

    class jobcareer_ads_banner extends WP_Widget {
        /**
         * Outputs the content of the widget
         * @param array $args
         * @param array $instance
         */

       // Cs Ads Banner construct start
        public function __construct() {

            parent::__construct(
                    'jobcareer_ads_banner', // Base ID
                    esc_html__('CS : Ads Banners', 'jobcareer'), // Name
                    array('classname' => 'jobcareer_ads_banner', 'description' => esc_html__('Set Banners option in widget', 'jobcareer'),) // Args
            );
        }

        /**
         * @Ads Banners html form
         */
    
        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $cs_rand_id = rand(23789, 934578930);
            $instance = wp_parse_args((array) $instance, array('title' => '', 'banner_code' => ''));
            $title = $instance['title'];
            $banner_style = isset($instance['banner_style']) ? esc_attr($instance['banner_style']) : '';
            $banner_code = $instance['banner_code'];
            $banner_view = isset($instance['banner_view']) ? esc_attr($instance['banner_view']) : '';
            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';
            $cs_opt_array = array(
                'name' => esc_html__('Title', 'jobcareer'),
                'desc' => '',
                'hint_text' => esc_html__("Enter your title here.", 'jobcareer'),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($title),
                    'cust_id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('title')),
                    'return' => true,
                ),
            );
            jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
            $cs_opt_array = array(
                'name' => esc_html__('Banner View', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'extra' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => jobcareer_special_char($banner_view),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('banner_view')),
                    'options' => array(
                        'single' => esc_html__('Single Banner', 'jobcareer'),
                        'random' => esc_html__('Random Banners', 'jobcareer'),
                    ),
                    'extra_atr' => 'onchange="cs_banner_widget_toggle(this.value, \'' . jobcareer_special_char($cs_rand_id) . '\')"',
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_select_field($cs_opt_array);

            if ($banner_view == "random") {
                $banner_types = 'block';
            } else {
                $banner_types = 'none';
            }
            $display = "none";
            if ($banner_view == 'single') {
                $display = 'block';
            }
            $cs_opt_array = array(
                'name' => esc_html__('Banner Code', 'jobcareer'),
                'desc' => '',
                'id' => 'cs_banner_code_field_' . jobcareer_special_char($cs_rand_id),
                'hint_text' => '',
                'styles' => 'display:' . esc_html($display) . '',
                'echo' => true,
                'field_params' => array(
                    'std' => htmlspecialchars($banner_code),
                    'cust_id' => jobcareer_special_char($this->get_field_id('banner_code')),
                    'extra_atr' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('banner_code')),
                    'return' => true,
                ),
            );
            jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));

            $cs_opt_array = array(
                'name' => esc_html__('Banner Style', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'id' => 'cs_banner_code_field_' . jobcareer_special_char($cs_rand_id),
                'extra' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => jobcareer_special_char($banner_style),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('banner_style')),
                    'options' => array(
                        'top_banner' => esc_html__('Top Banner', 'jobcareer'),
                        'bottom_banner' => esc_html__('Bottom Banner', 'jobcareer'),
                        'sidebar_banner' => esc_html__('Sidebar Banner', 'jobcareer'),
                        'vertical_banner' => esc_html__('Vertical Banner', 'jobcareer'),
                    ),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_select_field($cs_opt_array);
            $cs_opt_array = array(
                'name' => esc_html__('Number of Banners', 'jobcareer'),
                'desc' => '',
                'id' => 'cs_banner_number_field_' . jobcareer_special_char($cs_rand_id),
                'styles' => 'display:' . esc_html($banner_types) . '',
                'hint_text' => esc_html__("Set maximum number of Banners upto 10", 'jobcareer'),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($showcount),
                    'cust_id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('showcount')),
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
        }
       /**
         * 
         * @Ads Banners update data
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['banner_style'] = esc_sql($new_instance['banner_style']);
            $instance['banner_code'] = $new_instance['banner_code'];
            $instance['banner_view'] = esc_sql($new_instance['banner_view']);
            $instance['showcount'] = esc_sql($new_instance['showcount']);
            return $instance;
        }

        /**
         * 
         * @Ads Banners list widget
         */
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            global $wpdb, $post, $jobcareer_options;
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $banner_style = empty($instance['banner_style']) ? ' ' : apply_filters('widget_title', $instance['banner_style']);
            $banner_code = empty($instance['banner_code']) ? ' ' : $instance['banner_code'];
            $banner_view = empty($instance['banner_view']) ? ' ' : apply_filters('widget_title', $instance['banner_view']);
            $showcount = $instance['showcount'];
            // WIDGET display CODE Start
            echo balanceTags($before_widget, false);
            if (!empty($title) && $title <> ' ') {
                echo jobcareer_special_char($before_title) . $title . $after_title;
            }
            $showcount = ( $showcount <> '' || !is_integer($showcount) ) ? $showcount : 2;
            if ($banner_view == 'single') {
                echo do_shortcode($banner_code);
            } else {
                $cs_total_banners = ( is_integer($showcount) && $showcount > 10) ? 10 : $showcount;
                if (isset($jobcareer_options['banner_field_title'])) {
                    $i = 0;
                    $d = 0;
                    $cs_banner_array = array();
                    foreach ($jobcareer_options['banner_field_title'] as $banner) :
                        if ($jobcareer_options['banner_field_style'][$i] == $banner_style) {
                            $cs_banner_array[] = $i;
                            $d++;
                        }
                        if ($cs_total_banners == $d) {
                            break;
                        }
                        $i++;
                    endforeach;
                    if (sizeof($cs_banner_array) > 0) {
                        $cs_act_size = sizeof($cs_banner_array) - 1;
                        $cs_rand_banner = rand(0, $cs_act_size);

                        $cs_rand_banner = $cs_banner_array[$cs_rand_banner];
                        echo do_shortcode('[cs_ads id="' . $jobcareer_options['banner_field_code_no'][$cs_rand_banner] . '"]');
                    }
                }
            }
            echo balanceTags($after_widget, false);
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_ads_banner");'));
