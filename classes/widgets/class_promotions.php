<?php

/**
 * @ Contact info widget Class
 *
 *
 */
class jobcareer_promotions extends WP_Widget {
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */

    /**
     * @init Contact Info Module
     *
     *
     */
    public function __construct() {

        parent::__construct(
                'jobcareer_promotions', // Base ID
                esc_html__('CS : Promotions', 'jobcareer'), // Name
                array('classname' => 'widget_text', 'description' => esc_html__('Promotions', 'jobcareer'),) // Args
        );
    }

    /**
     * @Contact Info html form
     *
     *
     */
    function form($instance) {
        global $jobcareer_form_fields, $cs_html_fields, $jobcareer_html_fields;
        $instance = wp_parse_args((array) $instance);
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $image_url = isset($instance['image_url']) ? esc_attr($instance['image_url']) : '';
        $address = isset($instance['address']) ? esc_attr($instance['address']) : '';
        $phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
        $mobile = isset($instance['mobile']) ? esc_attr($instance['mobile']) : '';
        $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
        $link = isset($instance['link']) ? esc_attr($instance['link']) : '';
        $randomID = rand(40, 9999999);

        $cs_opt_array = array(
            'name' => esc_html__('Title', 'jobcareer'),
            'desc' => '',
            'hint_text' => esc_html__("Enter your element title here.", 'jobcareer'),
            'echo' => true,
            'field_params' => array(
                'std' => esc_attr($title),
                'id' => jobcareer_special_char($this->get_field_id('title')),
                'classes' => '',
                'cust_id' => jobcareer_special_char($this->get_field_name('title')),
                'cust_name' => jobcareer_special_char($this->get_field_name('title')),
                'return' => true,
                'required' => false
            ),
        );
        echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
        $cs_opt_array = array(
            'std' => $image_url,
            'id' => 'form-widget_cs_widget_logo' . absint($randomID),
            'name' => esc_html__('Image', 'jobcareer'),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'prefix' => '',
            'field_params' => array(
                'std' => $image_url,
                'id' => 'form-widget_cs_widget_logo' . absint($randomID),
                'cust_name' => $this->get_field_name('image_url'),
                'return' => true,
                'prefix' => '',
            ),
        );
        $cs_html_fields->cs_upload_file_field($cs_opt_array);
        $cs_opt_array = array(
            'name' => esc_html__('Description', 'jobcareer'),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => esc_attr($address),
                'id' => jobcareer_special_char($this->get_field_id('address')),
                'classes' => '',
                'cust_id' => jobcareer_special_char($this->get_field_name('address')),
                'cust_name' => jobcareer_special_char($this->get_field_name('address')),
                'return' => true,
                'required' => false
            ),
        );
        echo jobcareer_special_char($jobcareer_html_fields->cs_textarea_field($cs_opt_array));
        $cs_opt_array = array(
            'name' => esc_html__('Button Title', 'jobcareer'),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => esc_attr($phone),
                'id' => jobcareer_special_char($this->get_field_id('phone')),
                'classes' => '',
                'cust_id' => jobcareer_special_char($this->get_field_name('phone')),
                'cust_name' => jobcareer_special_char($this->get_field_name('phone')),
                'return' => true,
                'required' => false
            ),
        );
        echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
        $cs_opt_array = array(
            'name' => esc_html__('Button URL', 'jobcareer'),
            'desc' => '',
            'hint_text' => '',
            'echo' => true,
            'field_params' => array(
                'std' => esc_attr($mobile),
                'id' => jobcareer_special_char($this->get_field_id('mobile')),
                'classes' => '',
                'cust_id' => jobcareer_special_char($this->get_field_name('mobile')),
                'cust_name' => jobcareer_special_char($this->get_field_name('mobile')),
                'return' => true,
                'required' => false
            ),
        );
        echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
    }

    /**
     * @Update Info html form
     *
     *
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['image_url'] = $new_instance['image_url'];
        $instance['address'] = $new_instance['address'];
        $instance['phone'] = $new_instance['phone'];
        $instance['mobile'] = $new_instance['mobile'];
        return $instance;
    }

    /**
     * @Widget Info html form
     *
     *
     */
    function widget($args, $instance) {
        global $jobcareer_node;
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $title = htmlspecialchars_decode(stripslashes($title));
        $image_url = empty($instance['image_url']) ? '' : apply_filters('widget_title', $instance['image_url']);
        $address = empty($instance['address']) ? '' : apply_filters('widget_title', $instance['address']);
        $phone = empty($instance['phone']) ? '' : apply_filters('widget_title', $instance['phone']);
        $mobile = empty($instance['mobile']) ? '' : apply_filters('widget_title', $instance['mobile']);

        echo jobcareer_special_char($before_widget);
        echo '<div class="cs-jobcareer_promotions">';
        echo ' <div class="cs-media"> ';
        if (isset($image_url) && $image_url != '') {
            echo '<figure ><img src="' . esc_url($image_url) . '" alt="' . get_bloginfo('name') . '" /></figure>';
        }
        echo ' </div>';
        echo ' <div class="cs-text left">';
        if (isset($title) and $title <> '') {
            echo '<h2>' . esc_attr($title) . '</h2>';
        }
        if (isset($address) and $address <> '') {
            echo '<p>' . esc_attr($address) . '</p>';
        }
        if (isset($phone) and $phone <> '') {
            echo '<a href="' . esc_url($mobile) . '" class="cs-button cs-bgcolor">' . esc_attr($phone) . '</a>';
        }
        echo '</div>';
        echo '</div>';

        echo jobcareer_special_char($after_widget);
    }

}

add_action('widgets_init', create_function('', 'return register_widget("jobcareer_promotions");'));
