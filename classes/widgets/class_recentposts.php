<?php
/**
 * @Recent posts widget Class
 *
 *
 */
if (!class_exists('jobcareer_recentposts')) {

    class jobcareer_recentposts extends WP_Widget {

        /**
         * @init Recent posts Module
         *
         *
         */
        public function __construct() {
            parent::__construct(
                    'jobcareer_recentposts', // Base ID
                    esc_html__('CS : Recent Posts', 'jobcareer'), // Name
                    array('classname' => 'employer-info', 'description' => esc_html__('Recent Posts from category.', 'jobcareer'),) // Args
            );
        }

        /**
         * @Recent posts html form
         *
         *
         */
        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $select_category = isset($instance['select_category']) ? esc_attr($instance['select_category']) : '';
            $select_view = isset($instance['select_view']) ? esc_attr($instance['select_view']) : '';
            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';


            $cs_opt_array = array(
                'name' => esc_html__('Title', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
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
                    ),
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_select_field($cs_opt_array));

            $a_options = array();
            $a_options = jobcareer_jobcareer_show_all_cats('', '', jobcareer_special_char($this->get_field_id('select_category')), "category", true);
            $cs_opt_array = array(
                'name' => esc_html__('Choose Category', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => $select_category,
                    'cust_name' => jobcareer_special_char($this->get_field_name('select_category')),
                    'cust_id' => jobcareer_special_char($this->get_field_id('select_category')),
                    'id' => '',
                    'classes' => 'chosen-select cs-recentpost-width',
                    'options' => $a_options,
                    'return' => true,
                ),
            );

            echo jobcareer_special_char($jobcareer_html_fields->cs_select_field($cs_opt_array));

            $cs_opt_array = array(
                'name' => esc_html__('Number of Posts To Display', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_attr($showcount),
                    'id' => jobcareer_special_char($this->get_field_id('showcount')),
                    'classes' => '',
                    'cust_id' => jobcareer_special_char($this->get_field_name('showcount')),
                    'cust_name' => jobcareer_special_char($this->get_field_name('showcount')),
                    'return' => true,
                    'required' => false
                ),
            );
            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
        }

        /**
         * @Recent posts update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['select_category'] = $new_instance['select_category'];
            $instance['select_view'] = $new_instance['select_view'];
            $instance['showcount'] = $new_instance['showcount'];
            return $instance;
        }

        /**
         * @Display Recent posts widget
         *
         *
         */
        function widget($args, $instance) {
            global $jobcareer_node, $wpdb, $post;
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);
            $select_view = empty($instance['select_view']) ? ' ' : apply_filters('widget_title', $instance['select_view']);
            $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);

            if (isset($select_view) and $select_view == "simple") {

                if ($instance['showcount'] == "") {
                    $instance['showcount'] = '-1';
                }
                echo ' <div class="widget widget-recentpost">';
                if (!empty($title) && $title <> ' ') {
                    echo jobcareer_special_char($before_title);
                    echo jobcareer_special_char($title);
                    echo jobcareer_special_char($after_title);
                }
                ?>
                <ul>
                    <?php
                    if (isset($select_category) and $select_category <> ' ' and $select_category <> '') {
                        $args = array('posts_per_page' => $showcount, 'post_type' => 'post', 'category_name' => $select_category);
                    } else {
                        $args = array('posts_per_page' => $showcount, 'post_type' => 'post');
                    }
                    $title_limit = 6;
                    $custom_query = new WP_Query($args);
                    if ($custom_query->have_posts() <> "") {
                        while ($custom_query->have_posts()) : $custom_query->the_post();
                            $cs_post_id = get_the_ID();
                            $post_xml = get_post_meta($post->ID, "post", true);
                            $jobcareer_xmlObject = new stdClass();
                            $cs_noimage = '';
                            if ($post_xml <> "") {
                                $jobcareer_xmlObject = new SimpleXMLElement($post_xml);
                            }
                            $cs_noimage = '';
                            $width = 236;
                            $height = 168;
                            $image_id = get_post_thumbnail_id($post->ID);
                            $image_url = jobcareer_get_post_img_src($post->ID, $width, $height);
                            if ($image_url == '') {
                                $cs_noimage = ' class="cs-noimage"';
                            }
                            ?>
                            <li><i class="icon-news"></i>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_query();
                    } else {
                        if (function_exists('jobcareer_no_result_found')) {
                            jobcareer_no_result_found(false);
                        }
                    }
                    ?>
                </ul> 
                <?php
                echo '</div>';
            } else {
                if ($instance['showcount'] == "") {
                    $instance['showcount'] = '-1';
                }
                echo ' <div class="widget widget-recent-blog">';
                if (!empty($title) && $title <> ' ') {
                    echo jobcareer_special_char($before_title);
                    echo jobcareer_special_char($title);
                    echo jobcareer_special_char($after_title);
                }
                ?>
                <ul>
                    <?php
                    if (isset($select_category) and $select_category <> ' ' and $select_category <> '') {
                        $args = array('posts_per_page' => "$showcount", 'post_type' => 'post', 'category_name' => "$select_category");
                    } else {
                        $args = array('posts_per_page' => "$showcount", 'post_type' => 'post');
                    }
                    $title_limit = 3;
                    $custom_query = new WP_Query($args);
                    if ($custom_query->have_posts() <> "") {
                        while ($custom_query->have_posts()) : $custom_query->the_post();
                            $cs_post_id = get_the_ID();
                            $post_xml = get_post_meta($post->ID, "post", true);
                            $jobcareer_xmlObject = new stdClass();
                            $cs_noimage = '';
                            if ($post_xml <> "") {
                                $jobcareer_xmlObject = new SimpleXMLElement($post_xml);
                            }//43                  
                            $cs_noimage = '';
                            $width = 150;
                            $height = 150;
                            $image_id = get_post_thumbnail_id($post->ID);
                            $image_link = jobcareer_get_post_img_src($post->ID, $width, $height);
                            if ($image_link == '') {
                                $cs_noimage = ' class="cs-noimage"';
                            }
                            ?>
                            <li>
                                <?php if ($image_link <> '') { ?>
                                    <div class="cs-media">
                                        <figure><img alt="image" src="<?php echo esc_url($image_link); ?>"></figure>
                                    </div> 
                                <?php } ?>
                                <div class="cs-text">
                                    <div class="post-option">
                                        <span><?php echo date('F j, Y', strtotime(get_the_date())); ?></span>
                                    </div>
                                    <div class="cs-post-title">
                                        <h6><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10); ?></a></h6>
                                    </div>
                                </div>
                            </li>

                            <?php
                        endwhile;
                        wp_reset_query();
                    } else {
                        if (function_exists('jobcareer_no_result_found')) {
                            jobcareer_no_result_found(false);
                        }
                    }
                    $cs_archive = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

                    if (isset($cs_archive) and $cs_archive <> '') {
                        $cs_archive;
                    } else {
                        $cs_archive = home_url();
                    }
                    ?>
                </ul>
                <?php
                echo '</div>';
            }
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_recentposts");'));
