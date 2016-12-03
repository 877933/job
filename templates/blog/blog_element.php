<?php
/**
 * @ Blog html form for page builder admin side
 *
 *
 */
if (!function_exists('jobcareer_pb_blog')) {

    function jobcareer_pb_blog($die = 0) {
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
            $PREFIX = 'cs_blog';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('cs_blog_section_title' => '', 'cs_blog_view' => '', 'cs_blog_cat' => '', 'cs_blog_orderby' => 'DESC', 'orderby' => 'ID', 'cs_blog_description' => 'yes', 'cs_blog_filterable' => '', 'cs_blog_excerpt' => '255', 'cs_blog_num_post' => '10', 'blog_pagination' => '' , 'cs_blog_boxsize' => '');
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        $blog_element_size = '50';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_blog';
        $coloumn_class = 'column_' . $blog_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="blog" data="<?php echo jobcareer_element_size_data_array_index($blog_element_size) ?>">
            <?php jobcareer_element_setting($name, $cs_counter, $blog_element_size); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[cs_blog {{attributes}}]"  style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('BLOG OPTIONS', 'jobcareer') ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter); ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
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
                            'hint_text' => esc_html__("Enter your blog element title here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_blog_section_title),
                                'cust_id' => '',
                                'cust_name' => 'cs_blog_section_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        $a_options = array();
                        $a_options = jobcareer_jobcareer_show_all_cats('', '', $cs_blog_cat, "category", true);
                        $cs_opt_array = array(
                            'name' => esc_html__('Choose Category', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select category to show posts. If you dont select category it will display all posts.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $cs_blog_cat,
                                'id' => '',
                                'cust_name' => 'cs_blog_cat[]',
                                'classes' => 'dropdown chosen-select',
                                'options' => $a_options,
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        $cs_opt_array = array(
                            'name' => esc_html__('Blog Views', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Select blog view from this drop down", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $cs_blog_view,
                                'id' => '',
                                'cust_name' => 'cs_blog_view[]',
                                'classes' => 'dropdown chosen-select',
                                'extra_atr' => 'onchange="cs_blog_column(this.value);"',
                                'options' => array(
                                    'classic' => esc_html__('Classic', 'jobcareer'),
                                    'grid' => esc_html__('Grid', 'jobcareer'),
                                    'large' => esc_html__('Large', 'jobcareer'),
                                    'medium' => esc_html__('Medium', 'jobcareer'),
                                    'modern' => esc_html__('Modern', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                      
                           $column_show = '';
                        if ($cs_blog_view == 'modern' || $cs_blog_view == 'grid') {
                                   $column_show = 'style="display: block;"';
                               
                            }else {
                               $column_show = 'style="display: none;"';
                            }
                        
                        $cs_opt_array = array(
                            'name' => __('Columns Size', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'field_params' => array(
                                'std' => $cs_blog_boxsize,
                                'id' => 'blog_boxsize',
                                'cust_name' => 'cs_blog_boxsize[]',
                                'classes' => 'dropdown chosen-select-no-single',
                                'options' => array(
                                    '12' => __('1 Columns', 'jobcareer'),
                                    '6' => __('2 Columns', 'jobcareer'),
                                    '4' => __('3 Columns', 'jobcareer'),
                                    '3' => __('4 Columns', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );
                        echo '<div class="blog_column_size" '.$column_show.'>';

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        echo '</div>';
                            $cs_opt_array = array(
                                'name' => esc_html__('Post Order by Date', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Sorting posts in ascending order and descending order with this dropdown.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_blog_orderby,
                                    'id' => '',
                                    'cust_name' => 'cs_blog_orderby[]',
                                    'classes' => 'dropdown chosen-select-no-single',
                                    'options' => array(
                                        'ASC' => esc_html__('ASC', 'jobcareer'),
                                        'DESC' => esc_html__('DESC', 'jobcareer'),
                                    ),
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_select_field($cs_opt_array);
                            $cs_opt_array = array(
                                'name' => esc_html__('Enable Post Description', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Show/Hide post description with this dropdown.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_blog_description,
                                    'id' => '',
                                    'cust_name' => 'cs_blog_description[]',
                                    'classes' => 'dropdown chosen-select-no-single',
                                    'options' => array(
                                        'yes' => esc_html__('Yes', 'jobcareer'),
                                        'no' => esc_html__('No', 'jobcareer'),
                                    ),
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_select_field($cs_opt_array);

                            $cs_opt_array = array(
                                'name' => esc_html__('Length of Excerpt in Words', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Add number of excerpt words here for display on blog listing.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($cs_blog_excerpt),
                                    'cust_id' => '',
                                    'classes' => 'txtfield',
                                    'cust_name' => 'cs_blog_excerpt[]',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                         
                        $cs_opt_array = array(
                            'name' => esc_html__('No. of Post Per Page', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Add number of post for show posts on page.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_blog_num_post),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'cs_blog_num_post[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Pagination', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Pagination is the process of dividing a document into discrete pages. Manage your pagiantion via this dropdown.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $blog_pagination,
                                'id' => '',
                                'cust_name' => 'blog_pagination[]',
                                'classes' => 'dropdown chosen-select-no-single',
                                'options' => array(
                                    'yes' => esc_html__('Show Pagination', 'jobcareer'),
                                    'no' => esc_html__('Single Page', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_select_field($cs_opt_array);
                        ?>
                        <script type="text/javascript">
                                function cs_blog_column(selected_val) {

                                    if (selected_val == 'modern' || selected_val == 'grid') {
                                        $('.blog_column_size').show();
                                    }
                                    else {
                                        $('.blog_column_size').hide();
                                    }

                                }
                            </script>

                        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements insert-bg">
                                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                            </ul>
                            <div id="results-shortocde"></div>
                        <?php } else { ?>
                            <?php
                            $cs_opt_array = array(
                                'std' => 'blog',
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
                                    'classes' => 'cs-blog-button',
                                    'cust_name' => '',
                                    'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                            ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            /*
             * modern selection box function
             */
            jQuery(document).ready(function ($) {
                chosen_selectionbox();
                popup_over();
            });
            /*
             * modern selection box function
             */
        </script>
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_blog', 'jobcareer_pb_blog');
}