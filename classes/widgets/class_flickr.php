<?php

/**
 * @Flickr widget Class
 *
 *
 */
if (!class_exists('jobcareer_flickr')) {

    class jobcareer_flickr extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init Flickr Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'jobcareer_flickr', // Base ID
                    esc_html__('CS : Flickr Gallery', 'jobcareer'), // Name
                    array('classname' => 'widget-gallery', 'description' => esc_html__('Type a user name to show photos in widget', 'jobcareer'),) // Args
            );
        }

        /**
         * @Flickr html form
         *
         *
         */
        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $username = isset($instance['username']) ? esc_attr($instance['username']) : '';
            $no_of_photos = isset($instance['no_of_photos']) ? esc_attr($instance['no_of_photos']) : '';

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

            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));

            $cs_opt_array = array(
                'name' => esc_html__('Flickr username', 'jobcareer'),
                'desc' => '',
                'hint_text' => esc_html__("Enter your Flicker Username here.", 'jobcareer'),
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($username),
                    'cust_id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('username')),
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));

          $cs_opt_array = array(
                'name' => esc_html__('Number of Photos', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($no_of_photos),
                    'cust_id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('no_of_photos')),
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
        }

        /**
         * @Flickr update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['username'] = $new_instance['username'];
            $instance['no_of_photos'] = $new_instance['no_of_photos'];
            return $instance;
        }

        /**
         * @Display Flickr widget
         *
         *
         */
        function widget($args, $instance) {
            global $jobcareer_options;
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $username = empty($instance['username']) ? ' ' : apply_filters('widget_title', $instance['username']);
            $no_of_photos = empty($instance['no_of_photos']) ? ' ' : apply_filters('widget_title', $instance['no_of_photos']);
            if ($instance['no_of_photos'] == "") {
                $instance['no_of_photos'] = '3';
            }

            echo jobcareer_special_char($before_widget);
            if (!empty($title) && $title <> ' ') {
                echo jobcareer_special_char($before_title) . $title . $after_title;
            }

            $get_flickr_array = array();
            $apiKey = $jobcareer_options['flickr_key'];
            $apiSecret = $jobcareer_options['flickr_secret'];
            if ($apiKey <> '') {
                // Getting transient
                $cachetime = 86400;
                $transient = 'flickr_gallery_data';
                $check_transient = get_transient($transient);
                // Get Flickr Gallery saved data
                $saved_data = get_option('flickr_gallery_data');
                $db_apiKey = '';
                $db_user_name = '';
                $db_total_photos = '';
                if ($saved_data <> '') {
                    $db_apiKey = isset($saved_data['api_key']) ? $saved_data['api_key'] : '';
                    $db_user_name = isset($saved_data['user_name']) ? $saved_data['user_name'] : '';
                    $db_total_photos = isset($saved_data['total_photos']) ? $saved_data['total_photos'] : '';
                }
                if ($check_transient === false || ($apiKey <> $db_apiKey || $username <> $db_user_name || $no_of_photos <> $db_total_photos)) {
                    $user_id = "https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=" . $apiKey . "&username=" . $username . "&format=json&nojsoncallback=1";
                    $user_info = wp_remote_get($user_id);
                    $user_info = isset($user_info['body']) ? $user_info['body'] : '';
                    $user_info = json_decode($user_info, true);
                    if ($user_info['stat'] == 'ok') {
                        $user_get_id = $user_info['user']['id'];
                        $get_flickr_array['api_key'] = $apiKey;
                        $get_flickr_array['user_name'] = $username;
                        $get_flickr_array['user_id'] = $user_get_id;
                        $url = "https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=" . $apiKey . "&user_id=" . $user_get_id . "&per_page=" . $no_of_photos . "&format=json&nojsoncallback=1";
                        $content = wp_remote_get($url);
                        $content = isset($content['body']) ? $content['body'] : '';
                        $content = json_decode($content, true);
                        if ($content['stat'] == 'ok') {
                            $counter = 0;
                            echo '<ul class="gallery-list">';
                            foreach ((array) $content['photos']['photo'] as $photo) {
                                $image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_s.jpg";
                                $img_headers = get_headers($image_file);
                                if (strpos($img_headers[0], '200') !== false) {
                                    $image_file = $image_file;
                                } else {
                                    $image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_q.jpg";
                                    $img_headers = get_headers($image_file);
                                    if (strpos($img_headers[0], '200') !== false) {
                                        $image_file = $image_file;
                                    } else {
                                        $image_file = trailingslashit(get_template_directory_uri()) . 'assets/images/no_image_thumb.jpg';
                                    }
                                }
                                echo '<li>';
                                echo "<a target='_blank' href='https://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
                                echo "<img alt='image' src='" . $image_file . "'>";
                                echo "</a>";
                                echo '</li>';
                                $counter++;
                                $get_flickr_array['photo_src'][] = $image_file;
                                $get_flickr_array['photo_title'][] = $photo['title'];
                                $get_flickr_array['photo_owner'][] = $photo['owner'];
                                $get_flickr_array['photo_id'][] = $photo['id'];
                            }
                            echo '</ul>';
                            $get_flickr_array['total_photos'] = $counter;
                            // Setting Transient
                            set_transient($transient, true, $cachetime);
                            update_option('flickr_gallery_data', $get_flickr_array);
                            if ($counter == 0)
                                esc_html_e('No result found.', 'jobcareer');
                        }
                        else {
                            echo esc_html__('Error:', 'jobcareer') . $content['code'] . ' - ' . $content['message'];
                        }
                    } else {
                        echo esc_html__('Error:', 'jobcareer') . $user_info['code'] . ' - ' . $user_info['message'];
                    }
                } else {
                    if (get_option('flickr_gallery_data') <> '') {
                        $flick_data = get_option('flickr_gallery_data');
                        echo '<ul class="gallery-list">';
                        if (isset($flick_data['photo_src'])):
                            $i = 0;
                            foreach ($flick_data['photo_src'] as $ph) {
                                echo '<li>';
                                echo "<a target='_blank' href='https://www.flickr.com/photos/" . $flick_data['photo_owner'][$i] . "/" . $flick_data['photo_id'][$i] . "/'>";
                                echo "<img alt='image' src='" . $flick_data['photo_src'][$i] . "'>";
                                echo "</a>";
                                echo '</li>';
                                $i++;
                            }
                        endif;
                        echo '</ul>';
                    } else {
                        esc_html_e('No result found.', 'jobcareer');
                    }
                }
            } else {
                esc_html_e('Please Enter Flickr API key from Theme Options.', 'jobcareer');
            }
            echo jobcareer_special_char($after_widget);
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_flickr");'));