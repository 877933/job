<?php

/**
 * @ Contact info widget Class
 *
 *
 */
if(!class_exists('jobcareer_opening_hours')){ 
    
class jobcareer_opening_hours extends WP_Widget {
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
                'jobcareer_opening_hours', // Base ID
                esc_html__('CS : Opening Hours', 'jobcareer'), // Name
                array('classname' => 'widget_timing', 'description' => esc_html__('Footer Opening Hours Information', 'jobcareer'),) // Args
        );
    }

    /**
     * @Contact Info html form
     *
     *
     */
    function form($instance) {
        global $jobcareer_form_fields, $jobcareer_html_fields;
        $instance = wp_parse_args((array) $instance);
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $monday = isset($instance['monday']) ? esc_attr($instance['monday']) : '';
        $monday_time = isset($instance['monday_time']) ? esc_attr($instance['monday_time']) : '';
        $tuesday = isset($instance['tuesday']) ? esc_attr($instance['tuesday']) : '';
        $tuesday_time = isset($instance['tuesday_time']) ? esc_attr($instance['tuesday_time']) : '';
        $wednesday = isset($instance['wednesday']) ? esc_attr($instance['wednesday']) : '';
        $wednesday_time = isset($instance['wednesday_time']) ? esc_attr($instance['wednesday_time']) : '';
        $thursday = isset($instance['thursday']) ? esc_attr($instance['thursday']) : '';
        $thursday_time = isset($instance['thursday_time']) ? esc_attr($instance['thursday_time']) : '';
        $friday = isset($instance['friday']) ? esc_attr($instance['friday']) : '';
        $friday_time = isset($instance['friday_time']) ? esc_attr($instance['friday_time']) : '';
        $saturday = isset($instance['saturday']) ? esc_attr($instance['saturday']) : '';
        $saturday_time = isset($instance['saturday_time']) ? esc_attr($instance['saturday_time']) : '';
        $sunday = isset($instance['sunday']) ? esc_attr($instance['sunday']) : '';
        $sunday_time = isset($instance['sunday_time']) ? esc_attr($instance['sunday_time']) : '';
        $randomID = rand(40, 9999999);
        ?>    
        <div class="cs-widget-openinghours">
            <?php
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
                'name' => esc_html__('Monday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($monday),
                    'id' => jobcareer_special_char($this->get_field_id('monday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('monday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('monday')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));


            $cs_opt_array = array(
                'name' => esc_html__('Monday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($monday_time),
                    'id' => jobcareer_special_char($this->get_field_id('monday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('monday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('monday_time')),
                    'return' => true,
                    'required' => false
                ),
            );

          echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
           $cs_opt_array = array(
                'name' => esc_html__('Tuesday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($tuesday),
                    'id' => jobcareer_special_char($this->get_field_id('tuesday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('tuesday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('tuesday')),
                    'return' => true,
                    'required' => false
                ),
            );

          echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
          $cs_opt_array = array(
                'name' => esc_html__('Tuesday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($tuesday_time),
                    'id' => jobcareer_special_char($this->get_field_id('tuesday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('tuesday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('tuesday_time')),
                    'return' => true,
                    'required' => false
                ),
            );

          echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
           $cs_opt_array = array(
                'name' => esc_html__('Wednesday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($wednesday),
                    'id' => jobcareer_special_char($this->get_field_id('wednesday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('wednesday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('wednesday')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
 
            $cs_opt_array = array(
                'name' => esc_html__('Wednesday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($wednesday_time),
                    'id' => jobcareer_special_char($this->get_field_id('wednesday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('wednesday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('wednesday_time')),
                    'return' => true,
                    'required' => false
                ),
            );


       echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));

        $cs_opt_array = array(
                'name' => esc_html__('Thursday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($thursday),
                    'id' => jobcareer_special_char($this->get_field_id('thursday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('thursday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('thursday')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
            $cs_opt_array = array(
                'name' => esc_html__('Thursday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($thursday_time),
                    'id' => jobcareer_special_char($this->get_field_id('thursday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('thursday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('thursday_time')),
                    'return' => true,
                    'required' => false
                ),
            );
 
            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
 
            $cs_opt_array = array(
                'name' => esc_html__('Friday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($friday),
                    'id' => jobcareer_special_char($this->get_field_id('friday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('friday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('friday')),
                    'return' => true,
                    'required' => false
                ),
            );

         echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
         $cs_opt_array = array(
                'name' => esc_html__('Friday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($friday_time),
                    'id' => jobcareer_special_char($this->get_field_id('friday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('friday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('friday_time')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));

            $cs_opt_array = array(
                'name' => esc_html__('Saturday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($saturday),
                    'id' => jobcareer_special_char($this->get_field_id('saturday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('saturday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('saturday')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));


            $cs_opt_array = array(
                'name' => esc_html__('Saturday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($saturday_time),
                    'id' => jobcareer_special_char($this->get_field_id('saturday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('saturday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('saturday_time')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));

            $cs_opt_array = array(
                'name' => esc_html__('Sunday', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($sunday),
                    'id' => jobcareer_special_char($this->get_field_id('sunday')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('sunday')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('sunday')),
                    'return' => true,
                    'required' => false
                ),
            );


            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
 
            $cs_opt_array = array(
                'name' => esc_html__('Sunday time', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($sunday_time),
                    'id' => jobcareer_special_char($this->get_field_id('sunday_time')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('sunday_time')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('sunday_time')),
                    'return' => true,
                    'required' => false
                ),
            );

        echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
            ?>


        </div>


        <?php
    }

    /**
     * @Update Info html form
     *
     *
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['monday'] = $new_instance['monday'];
        $instance['monday_time'] = $new_instance['monday_time'];
        $instance['tuesday'] = $new_instance['tuesday'];
        $instance['tuesday_time'] = $new_instance['tuesday_time'];
        $instance['wednesday'] = $new_instance['wednesday'];
        $instance['wednesday_time'] = $new_instance['wednesday_time'];
        $instance['thursday'] = $new_instance['thursday'];
        $instance['thursday_time'] = $new_instance['thursday_time'];
        $instance['friday'] = $new_instance['friday'];
        $instance['friday_time'] = $new_instance['friday_time'];
        $instance['saturday'] = $new_instance['saturday'];
        $instance['saturday_time'] = $new_instance['saturday_time'];
        $instance['sunday'] = $new_instance['sunday'];
        $instance['sunday_time'] = $new_instance['sunday_time'];

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
        $monday = empty($instance['monday']) ? '' : apply_filters('widget_title', $instance['monday']);
        $monday_time = empty($instance['monday_time']) ? '' : apply_filters('widget_title', $instance['monday_time']);
        $tuesday = empty($instance['tuesday']) ? '' : apply_filters('widget_title', $instance['tuesday']);
        $tuesday_time = empty($instance['tuesday_time']) ? '' : apply_filters('widget_title', $instance['tuesday_time']);
        $wednesday = empty($instance['wednesday']) ? '' : apply_filters('widget_title', $instance['wednesday']);
        $wednesday_time = empty($instance['wednesday_time']) ? '' : apply_filters('widget_title', $instance['wednesday_time']);
        $thursday = empty($instance['thursday']) ? '' : apply_filters('widget_title', $instance['thursday']);
        $thursday_time = empty($instance['thursday_time']) ? '' : apply_filters('widget_title', $instance['thursday_time']);
        $friday = empty($instance['friday']) ? '' : apply_filters('widget_title', $instance['friday']);
        $friday_time = empty($instance['friday_time']) ? '' : apply_filters('widget_title', $instance['friday_time']);
        $saturday = empty($instance['saturday']) ? '' : apply_filters('widget_title', $instance['saturday']);
        $saturday_time = empty($instance['saturday_time']) ? '' : apply_filters('widget_title', $instance['saturday_time']);
        $sunday = empty($instance['sunday']) ? '' : apply_filters('widget_title', $instance['sunday']);
        $sunday_time = empty($instance['sunday_time']) ? '' : apply_filters('widget_title', $instance['sunday_time']);
        echo jobcareer_special_char($before_widget);
        ?> 
        <div class="widget-title">
            <?php if (!empty($title) && $title <> ' ') { ?>
                <h4><?php echo jobcareer_special_char($title); ?></h4> 
            <?php } ?>
        </div>
        <div class="timing-details">
            <ul>
                <?php if (!empty($monday) && $monday <> ' ' and ! empty($monday_time) && $monday_time <> '') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($monday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($monday_time); ?></time>
                    </li>
                <?php } ?>
                <?php if (!empty($tuesday) && $tuesday <> ' ' and ! empty($tuesday_time) && $tuesday_time <> '') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($tuesday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($tuesday_time); ?></time>
                    </li>
                <?php } ?>
                <?php if (!empty($wednesday) && $wednesday <> ' ' and ! empty($wednesday_time) && $wednesday_time <> '') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($wednesday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($wednesday_time); ?></time>
                    </li>
                <?php } ?>
                <?php if (!empty($thursday) && $thursday <> ' ' and ! empty($thursday_time) && $thursday_time <> ' ') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($thursday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($thursday_time); ?></time>
                    </li>
                <?php } ?>
                <?php if (!empty($friday) && $friday <> ' ' and ! empty($friday_time) && $friday_time <> ' ') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($friday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($friday_time); ?></time>
                    </li>
                <?php } ?>
                <?php if (!empty($saturday) && $saturday <> ' ' and ! empty($saturday_time) && $saturday_time <> '') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($saturday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($saturday_time); ?></time>
                    </li>
                <?php } ?>
                <?php if (!empty($sunday) && $sunday <> ' ' and ! empty($sunday_time) && $sunday_time <> ' ') { ?>
                    <li>
                        <span class="days"><?php echo jobcareer_special_char($sunday); ?></span>
                        <time datetime="2008-02-14"><?php echo jobcareer_special_char($sunday_time); ?></time>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php
        echo jobcareer_special_char($after_widget);
    }

}


}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_opening_hours");'));
