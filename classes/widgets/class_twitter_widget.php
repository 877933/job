<?php

/**
 * @Twitter Tweets widget Class
 *
 *
 */
if (!class_exists('jobcareer_twitter_widget')) {

    class jobcareer_twitter_widget extends WP_Widget {

        /**
         * Twitter Module construct
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'jobcareer_twitter_widget', // Base ID
                    esc_html__('CS: Twitter Widget', 'jobcareer'), // Name
                    array('classname' => 'twitter-widget', 'description' => esc_html__('Twitter Widget.', 'jobcareer'),) // Args
            );
        }

        // Start function for backend twitter widget view

        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $username = isset($instance['username']) ? esc_attr($instance['username']) : '';
            $numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';

            $cs_opt_array = array(
                'name' => esc_html__('Title', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_html($title),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('title')),
                    'cust_id' => jobcareer_special_char($this->get_field_name('title')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);
            $cs_opt_array = array(
                'name' => esc_html__('User Name', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_html($username),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('username')),
                    'cust_id' => jobcareer_special_char($this->get_field_name('username')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);
            $cs_opt_array = array(
                'name' => esc_html__('Num of Tweets', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_html($numoftweets),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('numoftweets')),
                    'cust_id' => jobcareer_special_char($this->get_field_name('numoftweets')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);
        }

        // Start function for update twitter data

        function update($new_instance, $old_instance) {

            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['username'] = $new_instance['username'];
            $instance['numoftweets'] = $new_instance['numoftweets'];
            return $instance;
        }

        function widget($args, $instance) {
            global $jobcareer_options, $cs_twitter_arg;

            $cs_twitter_arg['consumerkey'] = isset($jobcareer_options['cs_consumer_key']) ? $jobcareer_options['cs_consumer_key']: '';
            $cs_twitter_arg['consumersecret'] = isset($jobcareer_options['cs_consumer_secret']) ? $jobcareer_options['cs_consumer_secret']: '';
            $cs_twitter_arg['accesstoken'] = isset($jobcareer_options['cs_access_token']) ? $jobcareer_options['cs_access_token']: '';
            $cs_twitter_arg['accesstokensecret'] = isset($jobcareer_options['cs_access_token_secret']) ? $jobcareer_options['cs_access_token_secret']: '';
            $cs_cache_limit_time = isset($jobcareer_options['cs_cache_limit_time']) ? $jobcareer_options['cs_cache_limit_time']: '';
            $cs_tweet_num_from_twitter = isset($jobcareer_options['cs_tweet_num_post']) ? $jobcareer_options['cs_tweet_num_post'] : '';
            $cs_twitter_datetime_formate = isset($jobcareer_options['cs_twitter_datetime_formate']) ? $jobcareer_options['cs_twitter_datetime_formate'] : '';
            
            if ($cs_cache_limit_time == '') {
                $cs_cache_limit_time = 60;
            }
            if ($cs_twitter_datetime_formate == '') {
                $cs_twitter_datetime_formate = 'time_since';
            }
            if ($cs_tweet_num_from_twitter == '') {
                $cs_tweet_num_from_twitter = 5;
            }

            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $username = $instance['username'];
            $numoftweets = $instance['numoftweets'];
            if ($numoftweets == '') {
                $numoftweets = 2;
            }
            echo jobcareer_special_char($before_widget);
            // WIDGET display CODE Start
            if (!empty($title) && $title <> ' ') {
                echo jobcareer_special_char($before_title . $title . $after_title);
            }
            if (class_exists('wp_jobhunt')) {
                if (strlen($username) > 1) {

                    jobcareer_include_file(cs_framework::plugin_dir() . 'include/cs-twitter/display-tweets.php');     
                    display_tweets($username,$cs_twitter_datetime_formate , $cs_tweet_num_from_twitter, $numoftweets, $cs_cache_limit_time);
                }
            } 
	    echo jobcareer_special_char($after_widget);
        }
    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_twitter_widget");'));
