<?php
/**
 * Page Builder Functions 
 */
/**
 * @Generate Random String
 *
 *
 */
if (!function_exists('jobcareer_generate_random_string')) {

    function jobcareer_generate_random_string($length = 3) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}

// Generate Random String end 
// Custom shortcode encode functions start here
if (!function_exists('jobcareer_custom_shortcode_encode')) {

    function jobcareer_custom_shortcode_encode($sh_content = '') {
        $sh_content = str_replace(array('[', ']'), array('cs_open', 'cs_close'), $sh_content);
        return $sh_content;
    }

}
// End custom code encode shortcode function
//Custom shortcode decode functions start here
if (!function_exists('jobcareer_custom_shortcode_decode')) {

    function jobcareer_custom_shortcode_decode($sh_content = '') {
        $sh_content = str_replace(array('cs_open', 'cs_close'), array('[', ']'), $sh_content);
        return $sh_content;
    }

}

// End custom shortcode decode functions 

/**
 * @Page builder Element (shortcode(s))
 *
 *
 */
if (!function_exists('jobcareer_element_setting')) {

    function jobcareer_element_setting($name, $cs_counter, $element_size, $element_description = '', $page_element_icon = 'icon-star', $type = '') {

        global $jobcareer_form_fields;
        $element_title = str_replace("jobcareer_pb_", "", $name);
        $elm_name = str_replace("jobcareer_pb_", "", $name);
        $element_list = jobcareer_element_list();
        ?>

        <div class="column-in">
            <?php
            $cs_opt_array = array(
                'std' => esc_attr($element_size),
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => 'item',
                'extra_atr' => '',
                'cust_id' => '',
                'cust_name' => esc_attr($element_title) . '_element_size[]',
                'return' => true,
                'required' => false
            );
            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
            ?>
            <!--<a href="javascript:;" onclick="javascript:_createclone(jQuery(this),'<?php //echo esc_attr($cs_counter)                            ?>', '', '')" class="options"><i class="icon-star"></i></a>-->
            <a href="javascript:;" onclick="javascript:_createpopshort(jQuery(this))" class="options"><i class="icon-gear"></i></a>
            <a href="#" class="delete-it btndeleteit"><i class="icon-trash-o"></i></a> &nbsp;
            <a class="decrement" onclick="javascript:decrement(this)"><i class="icon-minus4"></i></a> &nbsp; 
            <a class="increment" onclick="javascript:increment(this)"><i class="icon-plus3"></i></a> 
            <span> 
                <i class="cs-icon <?php echo str_replace("jobcareer_pb_", "", $name); ?>-icon"></i> 
                <strong><?php echo jobcareer_validate_data($element_list['element_list'][$elm_name]); ?></strong><br/>
                <?php echo esc_attr($element_description); ?> 

            </span>
        </div>

        <?php
    }

}


// Page builder Element setting end here
/**
 * @Slugify The Text
 *
 */
if (!function_exists('jobcareer_slugify_text')) {

    function jobcareer_slugify_text($str) {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        return $clean;
    }

}

// Slugify the text end here
// @Page builder Element (shortcode(s))

if (!function_exists('jobcareer_page_composer_elements')) {

    function jobcareer_page_composer_elements($element = '', $icon = 'accordion-icon', $description = '') {
        echo '<i class="fa ' . $icon . '"></i><span data-title="' . $element . '"> ' . $element . '</span>';
    }

}

// End page builder element shortcode
// @Page builder Sorting List start here

if (!function_exists('jobcareer_elements_categories')) {

    function jobcareer_elements_categories() {
        return array('typography' => esc_html__('Typography', 'jobcareer'), 'commonelements' => esc_html__('Common Elements', 'jobcareer'), 'mediaelement' => esc_html__('Media Element', 'jobcareer'), 'contentblocks' => esc_html__('Content Blocks', 'jobcareer'), 'loops' => esc_html__('Loops', 'jobcareer'));
    }

}

// @Page builder Sorting List End here
// @Start Page builder Ajax Element (shortcode(s))


if (!function_exists('jobcareer_ajax_element_setting')) {

    function jobcareer_ajax_element_setting($name, $cs_counter, $element_size, $shortcode_element_id, $POSTID, $element_description = '', $page_element_icon = '', $type = '') {
        global $jobcareer_node, $post, $jobcareer_form_fields;

        $element_title = str_replace("jobcareer_pb_", "", $name);
        ?>
        <div class="column-in">
            <?php
            $cs_opt_array = array(
                'std' => esc_attr($element_size),
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => 'item',
                'extra_atr' => '',
                'cust_id' => '',
                'cust_name' => esc_attr($element_title) . '_element_size[]',
                'return' => true,
                'required' => false
            );
            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
            ?>
            <a href="javascript:;" onclick="javascript:ajax_shortcode_widget_element(jQuery(this), '<?php echo esc_js(admin_url('admin-ajax.php')); ?>', '<?php echo esc_js($POSTID); ?>', '<?php echo esc_js($name); ?>')" class="options"><i class="icon-gear"></i></a><a href="#" class="delete-it btndeleteit"><i class="icon-trash-o"></i></a> &nbsp; <a class="decrement" onclick="javascript:decrement(this)"><i class="icon-minus4"></i></a>
            &nbsp; <a class="increment" onclick="javascript:increment(this)"><i class="icon-plus3"></i></a> 
            <span> <i class="cs-icon <?php echo str_replace("jobcareer_pb_", "", $name); ?>-icon"></i> 
                <strong>
                    <?php
                    if ($jobcareer_node->getName() == 'page_element') {
                        $element_name = $jobcareer_node->element_name;
                        $element_name = str_replace("cs-", "", $element_name);
                    } else {
                        $element_name = $jobcareer_node->getName();
                    }

                    $elm_name = str_replace('_', ' ', $element_name);
                    $element_list = jobcareer_element_list();
                    if (isset($elm_name) && $elm_name == 'quick quote') {
                        echo ucfirst($elm_name);
                    } else {
                        if (isset($elm_name) && $elm_name == 'multi price table') {
                            echo ucfirst($elm_name);
                        } else {

                            echo jobcareer_validate_data($element_list['element_list'][$elm_name]);
                        }
                    }
                    ?>
                </strong><br/>
                <?php echo esc_attr($element_description); ?></span>
        </div>
        <?php
    }

}

// End page builder ajax element
// Start elment list functions
if (!function_exists('jobcareer_element_list')) {

    function jobcareer_element_list() {
        $element_list = array();
        $element_list['element_list'] = array(
            'gallery' => esc_html__('gallery', 'jobcareer'),
            'slider' => esc_html__('Slider', 'jobcareer'),
            'blog' => esc_html__('Blog', 'jobcareer'),
            'register' => esc_html__('Register', 'jobcareer'),
            'cv_package' => esc_html__('CV Package', 'jobcareer'),
            'cv package' => esc_html__('CV Package', 'jobcareer'),
            'job_package' => esc_html__('Job Package', 'jobcareer'),
            'job package' => esc_html__('Job Package', 'jobcareer'),
            'jobs_search' => esc_html__('Jobs Search', 'jobcareer'),
            'jobs search' => esc_html__('Jobs Search', 'jobcareer'),
            'flex_editor' => esc_html__('Flex Editor', 'jobcareer'),
            'job_post' => esc_html__('Job Post', 'jobcareer'),
            'job post' => esc_html__('Job Post', 'jobcareer'),
            'flex editor' => esc_html__('Flex Editor', 'jobcareer'),
            'column' => esc_html__('Column', 'jobcareer'),
            'flex_column' => esc_html__('Column', 'jobcareer'),
            'flex column' => esc_html__('Column', 'jobcareer'),
            'accordions' => esc_html__('Accordions', 'jobcareer'),
            'contact' => esc_html__('Contact', 'jobcareer'),
            'divider' => esc_html__('Divider', 'jobcareer'),
            'message_box' => esc_html__('Message Box', 'jobcareer'),
            'image' => esc_html__('Image', 'jobcareer'),
            'image_frame' => esc_html__('Image Frame', 'jobcareer'),
            'map' => esc_html__('Map', 'jobcareer'),
            'video' => esc_html__('Video', 'jobcareer'),
            'slider' => esc_html__('Quote', 'jobcareer'),
            'quotes' => esc_html__('Quotes', 'jobcareer'),
            'dropcap' => esc_html__('Drop cap', 'jobcareer'),
            'pricetable' => esc_html__('Price Table', 'jobcareer'),
            'tabs' => esc_html__('Tabs', 'jobcareer'),
            'sitemap' => esc_html__('Sitemap', 'jobcareer'),
            'accordion' => esc_html__('Accordion', 'jobcareer'),
            'prayer' => esc_html__('Prayer', 'jobcareer'),
            'prayer' => esc_html__('Prayer', 'jobcareer'),
            'table' => esc_html__('Table', 'jobcareer'),
            'call_to_action' => esc_html__('Call to Action', 'jobcareer'),
            'about' => esc_html__('About', 'jobcareer'),
            'about' => esc_html__('about', 'jobcareer'),
            'call to action' => esc_html__('Call to Action', 'jobcareer'),
            'clients' => esc_html__('Clients', 'jobcareer'),
            'gallery' => esc_html__('Gallery', 'jobcareer'),
            'heading' => esc_html__('Heading', 'jobcareer'),
            'testimonials' => esc_html__('Testimonials', 'jobcareer'),
            'infobox' => esc_html__('Info box', 'jobcareer'),
            'spacer' => esc_html__('Spacer', 'jobcareer'),
            'promobox' => esc_html__('Promo Box', 'jobcareer'),
            'offerslider' => esc_html__('Offer Slider', 'jobcareer'),
            'audio' => esc_html__('Audio', 'jobcareer'),
            'icons' => esc_html__('Icons', 'jobcareer'),
            'contactform' => esc_html__('Contact Form', 'jobcareer'),
            'tooltip' => esc_html__('Tooltip', 'jobcareer'),
            'icon box' => esc_html__('Icon Box', 'jobcareer'),
            'icon_box' => esc_html__('Icon Box', 'jobcareer'),
            'multiple team' => esc_html__('Teams', 'jobcareer'),
            'multiple_team' => esc_html__('Teams', 'jobcareer'),
            'highlight' => esc_html__('Highlight', 'jobcareer'),
            'list' => esc_html__('List', 'jobcareer'),
            'mesage' => esc_html__('Message', 'jobcareer'),
            'faq' => esc_html__('Faq', 'jobcareer'),
            'progressbars' => esc_html__('Progress bars', 'jobcareer'),
            'counter' => esc_html__('Counter', 'jobcareer'),
            'members' => esc_html__('Members', 'jobcareer'),
            'icon_box' => esc_html__('Icon Box', 'jobcareer'),
            'newsletter' => esc_html__('Newsletter', 'jobcareer'),
            'facilities' => esc_html__('Facilities', 'jobcareer'),
            'tweets' => esc_html__('Tweets', 'jobcareer'),
            'button' => esc_html__('Button', 'jobcareer'),
            'team_post' => esc_html__('Team', 'jobcareer'),
            'team post' => esc_html__('Team', 'jobcareer'),
            'multi_counters' => esc_html__('Counter', 'jobcareer'),
            'multi counters' => esc_html__('Counter', 'jobcareer'),
            'portfolio' => esc_html__('Portfolio', 'jobcareer'),
            'multi_price_table' => esc_html__('Price Table', 'jobcareer'),
            'candidate' => esc_html__('Candidate', 'jobcareer'),
            'employer' => esc_html__('Employer', 'jobcareer'),
            'jobs' => esc_html__('Jobs', 'jobcareer'),
            'job_specialisms' => esc_html__('Job Specialisms', 'jobcareer'),
            'job specialisms' => esc_html__('Job Specialisms', 'jobcareer'),
        );
        return $element_list;
    }

}

// End element list function

/**
 * @Page builder Section Settings
 *
 *
 */
if (!function_exists('jobcareer_column_pb')) {

    function jobcareer_column_pb($die = 0, $shortcode = '') {
        global $post, $jobcareer_node, $jobcareer_xmlObject, $cs_count_node, $column_container, $coloum_width, $jobcareer_html_fields, $jobcareer_form_fields;
        $total_widget = 0;
        $i = 1;
        $cs_page_section_title = $cs_page_section_height = $cs_page_section_width = '';
        $cs_section_background_option = '';
        $cs_section_bg_image = '';
        $cs_section_bg_image_position = '';
        $cs_section_bg_image_repeat = '';
        $cs_section_parallax = '';
        $cs_section_slick_slider = '';
        $cs_section_custom_slider = '';
        $cs_section_video_url = '';
        $cs_section_video_mute = '';
        $cs_section_video_autoplay = '';
        $cs_section_border_bottom = '0';
        $cs_section_border_top = '0';
        $cs_section_border_color = '#e0e0e0';
        $cs_section_padding_top = '60';
        $cs_section_padding_bottom = '30';
        $cs_section_margin_top = '0';
        $cs_section_margin_bottom = '0';
        $cs_section_css_id = '';
        $cs_section_view = 'container';
        $cs_layout = '';
        $cs_sidebar_left = '';
        $cs_sidebar_right = '';
        $cs_section_bg_color = '';
        if (isset($column_container)) {
            $jobcareer_column_atts = $column_container->attributes();
            $column_class = $jobcareer_column_atts->class;
            $cs_section_background_option = $jobcareer_column_atts->cs_section_background_option;
            $cs_section_bg_image = $jobcareer_column_atts->cs_section_bg_image;
            $cs_section_bg_image_position = $jobcareer_column_atts->cs_section_bg_image_position;
            $cs_section_bg_image_repeat = $jobcareer_column_atts->cs_section_bg_image_repeat;
            $cs_section_slick_slider = $jobcareer_column_atts->cs_section_slick_slider;
            $cs_section_custom_slider = $jobcareer_column_atts->cs_section_custom_slider;
            $cs_section_video_url = $jobcareer_column_atts->cs_section_video_url;
            $cs_section_video_mute = $jobcareer_column_atts->cs_section_video_mute;
            $cs_section_video_autoplay = $jobcareer_column_atts->cs_section_video_autoplay;
            $cs_section_bg_color = $jobcareer_column_atts->cs_section_bg_color;
            $cs_section_parallax = $jobcareer_column_atts->cs_section_parallax;
            $cs_section_padding_top = $jobcareer_column_atts->cs_section_padding_top;
            $cs_section_padding_bottom = $jobcareer_column_atts->cs_section_padding_bottom;
            $cs_section_border_bottom = $jobcareer_column_atts->cs_section_border_bottom;
            $cs_section_border_top = $jobcareer_column_atts->cs_section_border_top;
            $cs_section_border_color = $jobcareer_column_atts->cs_section_border_color;
            $cs_section_margin_top = $jobcareer_column_atts->cs_section_margin_top;
            $cs_section_margin_bottom = $jobcareer_column_atts->cs_section_margin_bottom;
            $cs_section_css_id = $jobcareer_column_atts->cs_section_css_id;
            $cs_section_view = $jobcareer_column_atts->cs_section_view;
            $cs_layout = $jobcareer_column_atts->cs_layout;
            $cs_sidebar_left = $jobcareer_column_atts->cs_sidebar_left;
            $cs_sidebar_right = $jobcareer_column_atts->cs_sidebar_right;
        }
        $style = '';
        if (isset($_POST['action'])) {
            $name = $_POST['action'];
            $cs_counter = $_POST['counter'];
            $total_column = $_POST['total_column'];
            $column_class = $_POST['column_class'];
            $postID = $_POST['postID'];
            $randomno = rand(34, 3242432);
            $rand = rand(1, 999);
            $style = '';
        } else {
            $postID = $post->ID;
            $name = '';
            $cs_counter = '';
            $total_column = 0;
            $rand = rand(1, 999);
            $randomno = rand(34, 3242432);
            $name = $_REQUEST['action'];
            $style = 'style="display:none;"';
        }
        $cs_page_elements_name = jobcareer_shortcode_names();
        $cs_page_categories_name = jobcareer_elements_categories();
		
		$cs_insert_btn = true;
		$screen = get_current_screen();
		if(is_admin() && isset($screen->parent_file) && $screen->parent_file == 'users.php') {
			$cs_insert_btn = false;
		}
        ?>
        <div class="cs-page-composer composer-<?php echo absint($rand) ?>" id="composer-<?php echo absint($rand) ?>" style="display:none">
            <div class="page-elements">
                <div class="cs-heading-area">

                    <h5> <i class="icon-plus-circle"></i><?php esc_html_e('Add Element', 'jobcareer'); ?>  </h5>
                    <span class='cs-btnclose' onclick='javascript:removeoverlay("composer-<?php echo absint($rand) ?>", "append")'><i class="icon-times"></i></span> 
                </div>
                <script>
                    jQuery(document).ready(function ($) {
                        'use strict';
                        cs_page_composer_filterable('<?php echo absint($rand) ?>');
                    });
                </script>
                <div class="cs-filter-content">
                    <p>

                        <?php
                        $cs_opt_array = array(
                            'std' => '',
                            'cust_id' => 'quicksearch' . absint($rand),
                            'classes' => '',
                            'cust_name' => '',
                            'extra_atr' => ' placeholder=' . esc_html__('Search', 'jobcareer'),
                            'return' => true,
                        );
                        echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                        ?>

                    </p>
                    <div class="cs-filtermenu-wrap">
                        <h6><?php esc_html_e('Filter by', 'jobcareer'); ?></h6>
                        <ul class="cs-filter-menu" id="filters<?php echo absint($rand) ?>">
                            <li data-filter="all" class="active"><?php esc_html_e('Show all', 'jobcareer'); ?></li>
                            <?php foreach ($cs_page_categories_name as $key => $value) { ?>
                                <li data-filter="<?php echo esc_attr($key); ?>"><?php echo esc_attr($value); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="cs-filter-inner" id="page_element_container<?php echo absint($rand) ?>">
                        <?php unset($cs_page_elements_name['button']);?> <!-- unset the buuton shortcode from page builder -->
                        <?php foreach ($cs_page_elements_name as $key => $value) { ?>
                            <div class="element-item <?php echo esc_attr($value['categories']); ?>"> 
                                <a href='javascript:ajaxSubmitwidget("jobcareer_pb_<?php echo esc_js($value['name']); ?>","<?php echo esc_js($rand) ?>")'>
                                    <?php jobcareer_page_composer_elements($value['title'], $value['icon']); ?>
                                </a> 
                            </div>
                        <?php } ?>                    
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($shortcode) && $shortcode <> '' && $cs_insert_btn) {
            ?>
            <a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand) ?>', 'filter')"><i class="icon-plus-circle"></i><?php esc_html_e('CS: Insert shortcode', 'jobcareer'); ?> </a>
            <?php
        } else {
            ?>
            <div id="<?php echo esc_attr($randomno); ?>_del" class="column columnmain parentdeletesection column_100" >
                <div class="column-in"> <a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand) ?>', 'filter')"><i class="icon-plus-circle"></i> <?php esc_html_e('Add Element', 'jobcareer'); ?></a>
                    <p> <a href="javascript:_createpop('<?php echo esc_js($column_class . $randomno); ?>','filterdrag')" class="options">
                            <i class="icon-gear"></i></a> &nbsp; <a href="#" class="delete-it btndeleteitsection"><i class="icon-trash-o"></i></a> &nbsp; 
                    </p>
                </div>
                <div class="column column_container page_section <?php echo sanitize_html_class($column_class); ?>" >
                    <?php
                    $parts = explode('_', $column_class);
                    if ($total_column > 0) {
                        for ($i = 1; $i <= $total_column; $i++) {
                            ?>
                            <div class="dragarea" data-item-width="col_width_<?php echo esc_attr($parts[$i]); ?>">

                                <?php
                                $cs_opt_array = array(
                                    'std' => '0',
                                    'cust_id' => '',
                                    'classes' => 'textfld',
                                    'cust_name' => 'total_widget[]',
                                    'extra_atr' => '',
                                    'return' => true,
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                                ?>


                                <div class="draginner" id="counter_<?php echo absint($rand) ?>"></div>
                            </div>
                            <?php
                        }
                    }
                    $i = 1;

                    if (isset($column_container)) {
                        global $wpdb;
                        $total_column = count($column_container->children());
                        $section = 0;
                        $section_widget_element_num = 0;
                        foreach ($column_container->children() as $column) {
                            $section++;
                            $total_widget = count($column->children());
                            ?>
                            <div class="dragarea" data-item-width="col_width_<?php echo esc_attr($parts[$i]) ?>">
                                <div class="toparea">
                                    <?php
                                    $cs_opt_array = array(
                                        'std' => esc_attr($total_widget),
                                        'cust_id' => '',
                                        'classes' => 'textfld page-element-total-widget',
                                        'cust_name' => 'total_widget[]',
                                        'extra_atr' => '',
                                        'return' => true,
                                    );
                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                                    ?>
                                </div>
                                <div class="draginner" id="counter_<?php echo absint($rand) ?>">
                                    <?php
                                    $shortcode_element = '';
                                    $filter_element = 'filterdrag';
                                    $shortcode_view = '';
                                    $global_array = array();
                                    $section_widget__element = 0;
                                    foreach ($column->children() as $jobcareer_node) {

                                        $section_widget__element++;
                                        $shortcode_element_idd = $rand . '_' . $section_widget__element;
                                        $global_array[] = $jobcareer_node;
                                        $cs_count_node++;
                                        $cs_counter = $postID . $cs_count_node;
                                        $a = $name = "jobcareer_pb_" . $jobcareer_node->getName();
                                        $coloumn_class = 'column_' . $jobcareer_node->page_element_size;
                                        $abbbbc = (string) $jobcareer_node->cs_shortcode;
                                        $type = '';
                                        if ($jobcareer_node->getName() == 'page_element') {
                                            $type = 'page_element';
                                        }
                                        ?>
                                        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete  <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="<?php echo esc_attr($jobcareer_node->getName()); ?>" data="<?php echo jobcareer_element_size_data_array_index($jobcareer_node->page_element_size) ?>" >
                                            <?php jobcareer_ajax_element_setting($jobcareer_node->getName(), $cs_counter, $jobcareer_node->page_element_size, $shortcode_element_idd, $postID, $element_description = '', $jobcareer_node->getName() . '-icon', $type); ?>
                                            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" style="display: none;">
                                                <div class="cs-heading-area">
                                                    <?php
                                                    $shortcode_name = '';
                                                    if ($jobcareer_node->getName() == 'quick_slider') {
                                                        $shortcode_name = esc_html__("Quick Quote", 'jobcareer');
                                                    } else {
                                                        $shortcode_name = str_replace("_", " ", $jobcareer_node->getName());
                                                    }
                                                    ?>
                                                    <h5><?php echo esc_attr($shortcode_name); ?> <?php echo esc_html__("Options", 'jobcareer'); ?></h5>
                                                    <a href="javascript:;" onclick="javascript:_removerlay(jQuery(this))" class="cs-btnclose"><i class="icon-times"></i></a>
                                                </div>
                                                <?php
                                                $cs_opt_array = array(
                                                    'std' => 'shortcode',
                                                    'cust_id' => 'shortcode_' . $name . $cs_counter,
                                                    'classes' => 'cs-wiget-element-type',
                                                    'cust_name' => 'cs_widget_element_num[]',
                                                    'extra_atr' => '',
                                                    'return' => true,
                                                );
                                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                                                ?>
                                                <div class="pagebuilder-data-load demo dmeo">
                                                    <?php
                                                    $cs_opt_array = array(
                                                        'std' => $jobcareer_node->getName(),
                                                        'cust_id' => '',
                                                        'classes' => '',
                                                        'cust_name' => 'cs_orderby[]',
                                                        'extra_atr' => '',
                                                        'return' => true,
                                                    );
                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));

                                                    $cs_opt_array = array(
                                                        'std' => htmlspecialchars_decode($jobcareer_node->cs_shortcode),
                                                        'cust_id' => '',
                                                        'classes' => 'cs-textarea-val',
                                                        'cust_name' => 'shortcode[' . $jobcareer_node->getName() . '][]',
                                                        'extra_atr' => 'style="display:none;"',
                                                        'return' => true,
                                                    );
                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_textarea_render($cs_opt_array));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function ($) {
                            if (jQuery('.chosen-select, .chosen-select-deselect, .chosen-select-no-single, .chosen-select-no-results, .chosen-select-width').length != '') {
                                var config = {
                                    '.chosen-select': {width: "100%"},
                                    '.chosen-select-deselect': {allow_single_deselect: true},
                                    '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
                                    '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
                                    '.chosen-select-width': {width: "95%"}
                                }
                                for (var selector in config) {
                                    jQuery(selector).chosen(config[selector]);
                                }
                            }
                        });
                    </script>
                </div>
                <div id="<?php echo esc_attr($column_class . $randomno); ?>" style="display:none">
                    <div class="cs-heading-area">
                        <h5><?php esc_html_e('Edit Page Section', 'jobcareer'); ?></h5>
                        <a href="javascript:removeoverlay('<?php echo esc_js($column_class . $randomno); ?>','filterdrag')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                    <div class="cs-pbwp-content">
                        <div class="cs-wrapp-clone cs-shortcode-wrapp">
                            <?php
                            $cs_opt_array = array(
                                'name' => esc_html__('Background View', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Choose Background View.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_background_option,
                                    'id' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_background_option[]',
                                    'classes' => 'chosen-select-no-single select-small',
                                    'options' => array(
                                        'no-image' => esc_html__('None', 'jobcareer'),
                                        'section-custom-background-image' => esc_html__('Background Image', 'jobcareer'),
                                        'section-custom-slider' => esc_html__('Custom Slider', 'jobcareer'),
                                        'section_background_video' => esc_html__('Video', 'jobcareer'),
                                    ),
                                    'return' => true,
                                    'extra_atr' => 'onchange="javascript:cs_section_background_settings_toggle(this.value, ' . absint($randomno) . ')"',
                                ),
                            );
                            $jobcareer_html_fields->cs_select_field($cs_opt_array);
                            ?>    
                            <div class="meta-body noborder section-custom-background-image-<?php echo esc_attr($randomno); ?>" style=" <?php
                            if ($cs_section_background_option == "section-custom-background-image") {
                                echo "display:block";
                            } else
                                echo "display:none";
                            ?>">
                                     <?php
                                     $cs_opt_array = array(
                                         'std' => $cs_section_bg_image,
                                         'id' => 'section_bg_image',
                                         'name' => esc_html__('Background Image', 'jobcareer'),
                                         'desc' => '',
                                         'force_std' => true,
                                         'echo' => true,
                                         'array' => true,
                                         'field_params' => array(
                                             'std' => $cs_section_bg_image,
                                             'cust_id' => '',
                                             'id' => 'section_bg_image',
                                             'force_std' => true,
                                             'return' => true,
                                             'array' => true,
                                             'array_txt' => false,
                                         ),
                                     );
                                     $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

                                     $cs_opt_array = array(
                                         'name' => esc_html__('Background Image Position', 'jobcareer'),
                                         'desc' => '',
                                         'hint_text' => esc_html__("Choose Background Image Position", 'jobcareer'),
                                         'echo' => true,
                                         'field_params' => array(
                                             'std' => $cs_section_bg_image_position,
                                             'id' => '',
                                             'cust_id' => '',
                                             'cust_name' => 'cs_section_bg_image_position[]',
                                             'classes' => 'select_dropdown chosen-select-no-single select-small',
                                             'options' => array(
                                                 'no-repeat center top' => esc_html__('no-repeat center top', 'jobcareer'),
                                                 'repeat center top' => esc_html__('repeat center top', 'jobcareer'),
                                                 'no-repeat center' => esc_html__('no-repeat center', 'jobcareer'),
                                                 'no-repeat center / cover' => esc_html__('no-repeat center / cover', 'jobcareer'),
                                                 'repeat center' => esc_html__('repeat center', 'jobcareer'),
                                                 'no-repeat left top' => esc_html__('no-repeat left top', 'jobcareer'),
                                                 'repeat left top' => esc_html__('repeat left top', 'jobcareer'),
                                                 'no-repeat fixed center' => esc_html__('no-repeat fixed center', 'jobcareer'),
                                                 'no-repeat fixed center / cover' => esc_html__('no-repeat fixed center / cover', 'jobcareer'),
                                             ),
                                             'return' => true,
                                             'extra_atr' => '',
                                         ),
                                     );
                                     $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                     $cs_opt_array = array(
                                         'name' => esc_html__('Background Image Repetition', 'jobcareer'),
                                         'desc' => '',
                                         'hint_text' => esc_html__("Choose Background Image Repetition", 'jobcareer'),
                                         'echo' => true,
                                         'field_params' => array(
                                             'std' => $cs_section_bg_image_repeat,
                                             'id' => '',
                                             'cust_id' => '',
                                             'cust_name' => 'cs_section_bg_image_repeat[]',
                                             'classes' => 'select_dropdown chosen-select-no-single select-small',
                                             'options' => array(
                                                 'repeat' => esc_html__('Repeat', 'jobcareer'),
                                                 'no-repeat' => esc_html__('No Repeat', 'jobcareer'),
                                             ),
                                             'return' => true,
                                             'extra_atr' => '',
                                         ),
                                     );
                                     //$jobcareer_html_fields->cs_select_field($cs_opt_array);
                                     ?>    
                            </div>
                            <div class="meta-body noborder section-slider-<?php echo esc_attr($randomno); ?>" style=" <?php
                            if ($cs_section_background_option == "section-slider") {
                                echo "display:block";
                            } else
                                echo "display:none";
                            ?>">
                            </div>
                            <div class="meta-body noborder section-custom-slider-<?php echo esc_attr($randomno); ?>" style=" <?php
                            if ($cs_section_background_option == "section-custom-slider") {
                                echo "display:block";
                            } else
                                echo "display:none";
                            ?>" >

                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Custom Slider', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Enter Custom Slider.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr($cs_section_custom_slider),
                                        'cust_id' => '',
                                        'classes' => 'txtfield',
                                        'cust_name' => 'cs_section_custom_slider[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                ?>

                            </div>
                            <div class="meta-body noborder section-background-video-<?php echo esc_attr($randomno); ?>" style=" <?php
                            if ($cs_section_background_option == "section_background_video") {
                                echo "display:block";
                            } else
                                echo "display:none";
                            ?>">
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php esc_html_e('Video Url', 'jobcareer'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <div class="input-sec">
                                            <?php
                                            $cs_opt_array = array(
                                                'std' => esc_url($cs_section_video_url),
                                                'cust_id' => '',
                                                'id' => 'section_video_url_' . esc_attr($randomno),
                                                'classes' => 'jobcareer_uploadMedia left',
                                                'cust_name' => 'cs_section_video_url',
                                                'extra_atr' => '',
                                                'return' => true,
                                            );
                                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                            ?>

                                            <label class="cs-browse">
                                                <?php
                                                $cs_opt_array = array(
                                                    'std' => esc_html__('Browse', 'jobcareer'),
                                                    'cust_id' => '',
                                                    'cust_type' => 'button',
                                                    'classes' => 'jobcareer_uploadMedia left',
                                                    'cust_name' => 'cs_section_video_url_' . esc_attr($randomno),
                                                    'extra_atr' => '',
                                                    'return' => true,
                                                );
                                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                                ?>
                                            </label>
                                        </div>
                                        <div class="left-info">
                                            <p><?php esc_html_e('Please enter Vimeo/Youtube Video Url', 'jobcareer'); ?></p>
                                        </div>
                                    </li>
                                </ul>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Enable Mute', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Choose Mute selection", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_section_video_mute,
                                        'id' => '',
                                        'cust_id' => '',
                                        'cust_name' => 'cs_section_video_mute[]',
                                        'classes' => 'select_dropdown chosen-select-no-single select-small',
                                        'options' => array(
                                            'yes' => esc_html__('Yes', 'jobcareer'),
                                            'no' => esc_html__('No', 'jobcareer'),
                                        ),
                                        'return' => true,
                                        'extra_atr' => '',
                                    ),
                                );
                                $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                $cs_opt_array = array(
                                    'name' => esc_html__('Video Auto Play', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Choose Video Auto Play selection", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_section_video_autoplay,
                                        'id' => '',
                                        'cust_id' => '',
                                        'cust_name' => 'cs_section_video_autoplay[]',
                                        'classes' => 'select_dropdown chosen-select-no-single select-small',
                                        'options' => array(
                                            'yes' => esc_html__('Yes', 'jobcareer'),
                                            'no' => esc_html__('No', 'jobcareer'),
                                        ),
                                        'return' => true,
                                        'extra_atr' => '',
                                    ),
                                );
                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>      

                            </div>
                            <?php
                            $cs_opt_array = array(
                                'name' => esc_html__('Enable Parallax', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_parallax,
                                    'id' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_parallax[]',
                                    'classes' => 'select_dropdown chosen-select-no-single select-small',
                                    'options' => array(
                                        'yes' => esc_html__('Yes', 'jobcareer'),
                                        'no' => esc_html__('No', 'jobcareer'),
                                    ),
                                    'return' => true,
                                    'extra_atr' => '',
                                ),
                            );
                            $jobcareer_html_fields->cs_select_field($cs_opt_array);

                            $cs_opt_array = array(
                                'name' => esc_html__('Select View', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => '',
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_view,
                                    'id' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_view[]',
                                    'classes' => 'select_dropdown chosen-select-no-single select-small',
                                    'options' => array(
                                        'container' => esc_html__('Box', 'jobcareer'),
                                        'wide' => esc_html__('Wide', 'jobcareer'),
                                    ),
                                    'return' => true,
                                    'extra_atr' => '',
                                ),
                            );
                            $jobcareer_html_fields->cs_select_field($cs_opt_array);
                            $cs_opt_array = array(
                                'name' => esc_html__('Background Color', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Choose background color.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($cs_section_bg_color),
                                    'cust_id' => '',
                                    'classes' => 'bg_color',
                                    'cust_name' => 'cs_section_bg_color[]',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                            //range
                            $cs_opt_array = array(
                                'name' => esc_html__('Padding Top', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Set the Padding top (In px)", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_padding_top,
                                    'id' => '',
                                    'classes' => 'small',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_padding_top[]',
                                    'return' => true,
                                    'required' => false,
                                    'after' => '<span class="cs_form_px">(px)</span>',
                                ),
                                'return' => true,
                                'extra_atr' => '',
                            );
                            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
                            $cs_opt_array = array(
                                'name' => esc_html__('Padding Bottom', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Set the Padding Bottom (In px)", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_padding_bottom,
                                    'id' => '',
                                    'classes' => '',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_padding_bottom[]',
                                    'return' => true,
                                    'required' => false,
                                    'after' => '<span class="cs_form_px">(px)</span>',
                                ),
                                'return' => true,
                                'extra_atr' => '',
                            );
                            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
                            $cs_opt_array = array(
                                'name' => esc_html__('Margin Top', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Set the Margin Top (In px)", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_margin_top,
                                    'id' => '',
                                    'classes' => '',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_margin_top[]',
                                    'return' => true,
                                    'required' => false,
                                    'after' => '<span class="cs_form_px">(px)</span>',
                                ),
                                'return' => true,
                                'extra_atr' => '',
                            );
                            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
                            $cs_opt_array = array(
                                'name' => esc_html__('Margin Bottom', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Set the Margin Bottom (In px)", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => $cs_section_margin_bottom,
                                    'id' => '',
                                    'classes' => '',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_margin_bottom[]',
                                    'return' => true,
                                    'required' => false,
                                    'after' => '<span class="cs_form_px">(px)</span>',
                                ),
                                'return' => true,
                                'extra_atr' => '',
                            );
                            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
                            $cs_opt_array = array(
                                'name' => esc_html__('Border Top', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Set the Border top (In px)", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => absint($cs_section_border_top),
                                    'id' => '',
                                    'classes' => '',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_border_top[]',
                                    'return' => true,
                                    'required' => false,
                                    'after' => '<span class="cs_form_px">(px)</span>',
                                ),
                                'return' => true,
                                'extra_atr' => '',
                            );
                            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
                            $cs_opt_array = array(
                                'name' => esc_html__('Border Bottom', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Set the Border Bottom (In px)", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => absint($cs_section_border_bottom),
                                    'id' => '',
                                    'classes' => '',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'cs_section_border_bottom[]',
                                    'return' => true,
                                    'required' => false,
                                    'after' => '<span class="cs_form_px">(px)</span>',
                                ),
                                'return' => true,
                                'extra_atr' => '',
                            );
                            echo jobcareer_special_char($jobcareer_html_fields->cs_text_field($cs_opt_array));
                            $cs_opt_array = array(
                                'name' => esc_html__('Border Color', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Choose Border color.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($cs_section_border_color),
                                    'cust_id' => '',
                                    'classes' => 'bg_color',
                                    'cust_name' => 'cs_section_border_color[]',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                            $choose_id = '';
                            $cs_opt_array = array(
                                'name' => esc_html__('Custom Id', 'jobcareer'),
                                'desc' => '',
                                'hint_text' => esc_html__("Enter Custom Id.", 'jobcareer'),
                                'echo' => true,
                                'field_params' => array(
                                    'std' => esc_attr($cs_section_css_id),
                                    'cust_id' => '',
                                    'classes' => 'txtfield',
                                    'cust_name' => 'cs_section_css_id[]',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                            ?>

                            <div class="form-elements elementhiddenn">
                                <ul class="noborder">
                                    <li class="to-label">
                                        <label><?php esc_html_e('Select Layout', 'jobcareer'); ?></label>
                                    </li>
                                    <li class="to-field">
                                        <div class="meta-input">
                                            <div class="meta-input pattern">
                                                <div class='radio-image-wrapper'>

                                                    <?php
                                                    $checked = '';
                                                    if ($cs_layout == "none") {
                                                        $checked = "checked";
                                                    }
                                                    $cs_opt_array = array(
                                                        'extra_atr' => 'onclick="show_sidebar(\'none\',\'' . esc_js($randomno) . '\')" ' . $checked . '',
                                                        'cust_name' => 'cs_layout[' . esc_attr($rand) . '][]',
                                                        'cust_id' => 'radio_1' . esc_attr($randomno),
                                                        'classes' => 'radio_cs_sidebar',
                                                        'std' => 'none',
                                                        'return' => true,
                                                    );
                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_radio_render($cs_opt_array));
                                                    ?>
                                                    <label for="radio_1<?php echo esc_attr($randomno) ?>"> 
                                                        <span class="ss"> <img src="<?php echo trailingslashit(get_template_directory_uri()) . 'backend/assets/images/no_sidebar.png'; ?>"  alt="" />  </span>
                                                        <span  <?php
                                                        if ($cs_layout == "none") {
                                                            echo "class='check-list'";
                                                        }
                                                        ?> id="check-list"></span> 
                                                    </label>
                                                </div>
                                                <div class='radio-image-wrapper'>

                                                    <?php
                                                    $checked = '';
                                                    if ($cs_layout == "right") {
                                                        $checked = "checked";
                                                    }
                                                    $cs_opt_array = array(
                                                        'extra_atr' => 'onclick="show_sidebar(\'right\',\'' . esc_js($randomno) . '\')" ' . $checked . '',
                                                        'cust_name' => 'cs_layout[' . esc_attr($rand) . '][]',
                                                        'cust_id' => 'radio_2' . esc_attr($randomno),
                                                        'classes' => 'radio_cs_sidebar',
                                                        'std' => 'right',
                                                        'return' => true,
                                                    );
                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_radio_render($cs_opt_array));
                                                    ?>

                                                    <label for="radio_2<?php echo esc_attr($randomno) ?>"> 
                                                        <span class="ss"><img src="<?php echo trailingslashit(get_template_directory_uri()) . 'backend/assets/images/sidebar_right.png'; ?>" alt="" /></span> 
                                                        <span <?php
                                                        if ($cs_layout == "right") {
                                                            echo "class='check-list'";
                                                        }
                                                        ?> id="check-list"></span> 
                                                    </label>
                                                </div>
                                                <div class='radio-image-wrapper'>

                                                    <?php
                                                    $checked = '';
                                                    if ($cs_layout == "left") {
                                                        $checked = "checked";
                                                    }
                                                    $cs_opt_array = array(
                                                        'extra_atr' => 'onclick="show_sidebar(\'left\',\'' . esc_js($randomno) . '\')" ' . $checked . '',
                                                        'cust_name' => 'cs_layout[' . esc_attr($rand) . '][]',
                                                        'cust_id' => 'radio_3' . esc_attr($randomno),
                                                        'classes' => 'radio_cs_sidebar',
                                                        'std' => 'left',
                                                        'return' => true,
                                                    );

                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_radio_render($cs_opt_array));
                                                    ?>
                                                    <label for="radio_3<?php echo esc_attr($randomno); ?>">
                                                        <span class="ss">
                                                            <img src="<?php echo trailingslashit(get_template_directory_uri()) . 'backend/assets/images/sidebar_left.png'; ?>" alt="" /></span> <span <?php
                                                        if ($cs_layout == "left") {
                                                            echo "class='check-list'";
                                                        }
                                                        ?> id="check-list">
                                                        </span> 
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <?php
                                $display = 'none';
                                if ($cs_layout == "left") {
                                    $display = "block";
                                }

                                global $wpdb, $jobcareer_options;
                                $cs_theme_option = $jobcareer_options;
                                $cs_theme_option = get_option('cs_theme_options');
                                $a_option = array();
                                if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {
                                    foreach ($cs_theme_option['sidebar'] as $sidebar) {
                                        $a_option[$sidebar] = esc_attr($sidebar);
                                    }
                                }
                                $cs_opt_array = array(
                                    'name' => esc_html__('Select Left Sidebar', 'jobcareer'),
                                    'desc' => '',
                                    'classes' => 'meta-body',
                                    'styles' => 'display:' . $display,
                                    'extra_atr' => '',
                                    'id' => esc_attr($randomno) . '_sidebar_left',
                                    'hint_text' => '',
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_sidebar_left,
                                        'id' => '',
                                        'cust_name' => 'cs_sidebar_left[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => $a_option,
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>
                                <p style="display:<?php echo esc_attr($display); ?>">
                                    <?php esc_html_e('Add New Sidebar', 'jobcareer'); ?> <a href="<?php echo admin_url(); ?>themes.php?page=cs_theme_options#tab-manage-sidebars-show" target="_blank"><?php esc_html_e('Click Here', 'jobcareer'); ?></a></p> 

                                <?php
                                $display = 'none';
                                if ($cs_layout == "left") {
                                    $display = "block";
                                }
                                $a_option = array();
                                if (isset($cs_theme_option['sidebar']) and count($cs_theme_option['sidebar']) > 0) {
                                    foreach ($cs_theme_option['sidebar'] as $sidebar) {
                                        $a_option[$sidebar] = esc_attr($sidebar);
                                    }
                                }

                                $cs_opt_array = array(
                                    'name' => esc_html__('Select Right Sidebar', 'jobcareer'),
                                    'desc' => '',
                                    'classes' => 'meta-body',
                                    'styles' => 'display:' . $display,
                                    'extra_atr' => '',
                                    'id' => esc_attr($randomno) . '_sidebar_right',
                                    'hint_text' => '',
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_sidebar_right,
                                        'id' => '',
                                        'cust_name' => 'cs_sidebar_right[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => $a_option,
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>

                                <p style="display:<?php echo esc_attr($display); ?>"><?php esc_html_e('Add New Sidebar', 'jobcareer'); ?>  <a href="<?php echo admin_url('themes.php?page=cs_theme_options#tab-manage-sidebars-show'); ?>" target="_blank"><?php esc_html_e('Click Here', 'jobcareer'); ?></a></p>   


                            </div>
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
                                    'classes' => 'cs-admin-btn',
                                    'cust_name' => '',
                                    'extra_atr' => 'onclick="javascript:removeoverlay(\'' . esc_js($column_class . $randomno) . '\', \'filterdrag\')"',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                            ?>   
                        </div>
                    </div>
                </div>

                <?php
                $cs_opt_array = array(
                    'std' => esc_attr($rand),
                    'id' => '',
                    'before' => '',
                    'after' => '',
                    'classes' => '',
                    'extra_atr' => '',
                    'cust_id' => '',
                    'cust_name' => 'column_rand_id[]',
                    'return' => true,
                    'required' => false
                );
                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));

                $cs_opt_array = array(
                    'std' => esc_attr($column_class),
                    'id' => '',
                    'before' => '',
                    'after' => '',
                    'classes' => '',
                    'extra_atr' => '',
                    'cust_id' => '',
                    'cust_name' => 'column_class[]',
                    'return' => true,
                    'required' => false
                );
                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));

                $cs_opt_array = array(
                    'std' => esc_attr($total_column),
                    'id' => '',
                    'before' => '',
                    'after' => '',
                    'classes' => '',
                    'extra_atr' => '',
                    'cust_id' => '',
                    'cust_name' => 'total_column[]',
                    'return' => true,
                    'required' => false
                );
                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                ?>                   


            </div>

            <script>


                /*
                 * modern selection box function
                 */
                jQuery(document).ready(function ($) {
                    chosen_selectionbox();
                });
                /*
                 * modern selection box function
                 
                 */

            </script>


            <?php
        }

        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_column_pb', 'jobcareer_column_pb');
}

// Page builder section setting end 

/**
 * @Media Pagination for slider/gallery in admin side
 *
 *
 */
if (!function_exists('jobcareer_media_pagination')) {

    function jobcareer_media_pagination($id = '', $func = 'clone') {
        foreach ($_REQUEST as $keys => $values) {
            $$keys = $values;
        }
        $records_per_page = 18;
        if (empty($page_id)) {
            $page_id = 1;
        }
        $offset = $records_per_page * ($page_id - 1);
        ?>
        <ul class="gal-list">
            <?php
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
            $query_images = new WP_Query($query_images_args);
            if (empty($total_pages)) {
                $total_pages = count($query_images->posts);
            }
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
            $query_images = new WP_Query($query_images_args);
            $images = array();
            foreach ($query_images->posts as $image) {
                $image_path = wp_get_attachment_image_src($image->ID, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h")));
                ?>
                <li class="cs-listclass"><img src="<?php echo esc_url($image_path[0]); ?>" onclick="javascript:<?php echo esc_attr($func); ?>('<?php echo esc_js($image->ID) ?>', 'gal-sortable-<?php echo esc_js($id); ?>')" alt="<?php echo jobcareer_get_post_img_title($post->ID); ?>" /></li>
            <?php } ?>
        </ul>
        <br />
        <div class="pagination-cus">
            <ul>
                <?php
                if ($page_id > 1) {
                    echo "<li><a href='javascript:show_next(" . ($page_id - 1) . ",$total_pages)'>Prev</a></li>";
                }
                for ($i = 1; $i <= ceil($total_pages / $records_per_page); $i++) {
                    if ($i <> $page_id) {
                        echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";
                    } else {
                        echo "<li class='active'><a>" . $i . "</a></li>";
                    }
                }
                if ($page_id < $total_pages / $records_per_page) {
                    echo "<li><a href='javascript:show_next(" . ($page_id + 1) . ",$total_pages)'>Next</a></li>";
                }
                ?>
            </ul>
        </div>
        <?php
        if (isset($_POST['action']))
            die();
    }

    add_action('wp_ajax_jobcareer_media_pagination', 'jobcareer_media_pagination');
}


// Media Pagination for gallery/slider end here

/**
 * @Media Slider Pagination
 *
 *
 */
if (!function_exists('jobcareer_slider_media_pagination')) {

    function jobcareer_slider_media_pagination($id = '', $func = 'clone') {

        foreach ($_REQUEST as $keys => $values) {
            $$keys = $values;
        }
        $records_per_page = 18;
        if (empty($page_id)) {
            $page_id = 1;
        }
        $offset = $records_per_page * ($page_id - 1);
        ?>
        <ul class="gal-list">
            <?php
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
            $query_images = new WP_Query($query_images_args);
            if (empty($total_pages)) {
                $total_pages = count($query_images->posts);
            }
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
            $query_images = new WP_Query($query_images_args);
            $images = array();
            foreach ($query_images->posts as $image) {
                $image_path = wp_get_attachment_image_src($image->ID, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h")));
                ?>
                <li class="cs-listclass"><img src="<?php echo esc_url($image_path[0]); ?>" onclick="javascript:slider('<?php echo esc_js($image->ID) ?>', 'gal-sortable-<?php echo esc_js($id); ?>')" alt="<?php echo jobcareer_get_post_img_title($post->ID); ?>" /></li>
            <?php } ?>
        </ul>
        <br />
        <div class="pagination-cus">
            <ul>
                <?php
                if ($page_id > 1) {
                    echo "<li><a href='javascript:slider_show_next(" . ($page_id - 1) . ",$total_pages)'>" . esc_html__('Prev', 'jobcareer') . "</a></li>";
                }
                for ($i = 1; $i <= ceil($total_pages / $records_per_page); $i++) {
                    if ($i <> $page_id) {
                        echo "<li><a href='javascript:slider_show_next($i,$total_pages)'>" . $i . "</a></li> ";
                    } else {
                        echo "<li class='active'><a>" . $i . "</a></li>";
                    }
                }
                if ($page_id < $total_pages / $records_per_page)
                    echo "<li><a href='javascript:slider_show_next(" . ($page_id + 1) . ",$total_pages)'>" . esc_html__('Next', 'jobcareer') . "</a></li>";
                ?>
            </ul>
        </div>
        <?php
        if (isset($_POST['action'])) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_slider_media_pagination', 'jobcareer_slider_media_pagination');
}


// Media slider pagination end here

/**
 * @Make a copy of media image for slider start
 *
 *
 */
if (!function_exists('jobcareer_slider_clone')) {

    function jobcareer_slider_clone() {
        global $jobcareer_node, $cs_counter, $jobcareer_html_fields, $jobcareer_form_fields;
        if (isset($_POST['action'])) {
            $jobcareer_node = array();
            $jobcareer_node['cs_slider_title'] = '';
            $jobcareer_node['cs_slider_description'] = '';
            $jobcareer_node['cs_slider_link'] = '';
            $jobcareer_node['cs_slider_link_target'] = '';
            $jobcareer_node['slider_use_image_as'] = '';
            $jobcareer_node['slider_video_code'] = '';
        }
        if (isset($_POST['counter'])) {
            $cs_counter = $_POST['counter'];
        }
        if (isset($_POST['path'])) {
            $jobcareer_node['cs_slider_path'] = $_POST['path'];
        }
        ?>
        <li class="ui-state-default" id="<?php echo esc_attr($cs_counter) ?>">
            <div class="thumb-secs">
                <?php $image_path = wp_get_attachment_image_src($jobcareer_node['cs_slider_path'], array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>
                <img src="<?php echo esc_url($image_path[0]) ?>" alt="<?php echo jobcareer_get_post_img_title($post->ID); ?>">
                <div class="gal-edit-opts"> 
                    <a href="javascript:slidedit(<?php echo esc_attr($cs_counter) ?>)" class="edit"></a> <a href="javascript:del_this('wrapper_post_detail_slider',<?php echo esc_js($cs_counter) ?>)" class="delete"></a> </div>

            </div>
            <div class="poped-up" id="edit_<?php echo esc_attr($cs_counter) ?>">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Edit Options', 'jobcareer'); ?></h5>
                    <a href="javascript:slideclose(<?php echo esc_js($cs_counter) ?>)" class="closeit">&nbsp;</a>
                    <div class="clear"></div>
                </div>
                <div class="cs-pbwp-content">
                    <?php
                    $cs_opt_array = array(
                        'name' => esc_html__('Image Title', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => esc_html__("Add Image Title", 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => htmlspecialchars($jobcareer_node['cs_slider_title']),
                            'cust_id' => '',
                            'classes' => 'txtfield',
                            'cust_name' => 'cs_slider_title[]',
                            'return' => true,
                        ),
                    );
                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                    $cs_opt_array = array(
                        'name' => esc_html__('Image Description', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => esc_html__("Add Image Description", 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => htmlspecialchars($jobcareer_node['cs_slider_description']),
                            'cust_id' => '',
                            'classes' => 'txtarea',
                            'cust_name' => 'cs_slider_description[]',
                            'return' => true,
                        ),
                    );
                    $jobcareer_html_fields->cs_textarea_field($cs_opt_array);

                    $cs_opt_array = array(
                        'name' => esc_html__('Link', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => esc_html__("Add Image Link", 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => htmlspecialchars($jobcareer_node['cs_slider_link']),
                            'cust_id' => '',
                            'classes' => 'txtfield',
                            'cust_name' => 'cs_slider_link[]',
                            'return' => true,
                        ),
                    );
                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                    $cs_opt_array = array(
                        'name' => esc_html__('Link Target', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => esc_html__('Please select image target', 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => $jobcareer_node['link_target'],
                            'id' => '',
                            'cust_id' => 'button_target',
                            'cust_name' => 'cs_slider_link_target[]',
                            'classes' => 'select_dropdown chosen-select-no-single button_target select-medium',
                            'options' => array(
                                '_blank' => esc_html__('Blank', 'jobcareer'),
                                '_self' => esc_html__('Self', 'jobcareer'),
                            ),
                            'return' => true,
                        ),
                    );

                    $jobcareer_html_fields->cs_select_field($cs_opt_array);
                    ?>

                    <ul class="form-elements">
                        <li class="to-label"></li>
                        <li class="to-field">
                            <?php
                            $cs_opt_array = array(
                                'std' => esc_attr($jobcareer_node['cs_slider_path']),
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => '',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'cs_slider_path[]',
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
                                    'std' => 'Submit',
                                    'cust_id' => '',
                                    'cust_type' => 'button',
                                    'classes' => 'close-submit',
                                    'cust_name' => '',
                                    'extra_atr' => 'onclick="javascript:slideclose(\'' . esc_js($cs_counter) . '\')"',
                                    'return' => true,
                                ),
                            );

                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                            ?>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </li>

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
        if (isset($_POST['action'])) {
            die();
        }
    }

    add_action('wp_ajax_slider_clone', 'jobcareer_slider_clone');
}


// Make a copy of media images for slider end
/**
 * @Make a copy of media image for gallery start
 *
 *
 */
if (!function_exists('jobcareer_gallery_clone')) {

    function jobcareer_gallery_clone($clone_field_name = '') {
        global $jobcareer_node, $cs_counter, $jobcareer_html_fields, $jobcareer_form_fields;
        if (isset($_POST['action'])) {
            $jobcareer_node = array();
            $jobcareer_node['title'] = "";
            $jobcareer_node['use_image_as'] = "";
            $jobcareer_node['video_code'] = "";
            $jobcareer_node['link_url'] = "";
            $jobcareer_node['use_image_as_db'] = "";
            $jobcareer_node['link_url_db'] = "";
        }
        if (isset($_POST['counter'])) {
            $cs_counter = $_POST['counter'];
        }
        if (isset($_POST['path'])) {
            $jobcareer_node['path'] = $_POST['path'];
        }
        ?>
        <li class="ui-state-default" id="<?php echo esc_attr($cs_counter); ?>">
            <div class="thumb-secs">
                <?php $image_path = wp_get_attachment_image_src($jobcareer_node['path'], array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>
                <img src="<?php echo esc_url($image_path[0]); ?>" alt="<?php echo jobcareer_get_post_img_title($post->ID); ?>">
                <div class="gal-edit-opts"> 
                    <a href="javascript:galedit(<?php echo esc_js($cs_counter) ?>)" class="edit"></a> <a href="javascript:del_this('wrapper_thumb_slider',<?php echo esc_js($cs_counter); ?>)" class="delete"></a>
                </div>
            </div>
            <div class="poped-up" id="edit_<?php echo esc_attr($cs_counter); ?>">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Edit Options', 'jobcareer'); ?></h5>
                    <a href="javascript:galclose(<?php echo esc_attr($cs_counter); ?>)" class="closeit">&nbsp;</a>
                </div>
                <div class="cs-pbwp-content">
                    <?php
                    $cs_opt_array = array(
                        'name' => esc_html__('Image Title', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => esc_html__("Add Image Title", 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => htmlspecialchars($jobcareer_node['title']),
                            'cust_id' => '',
                            'classes' => 'txtfield',
                            'cust_name' => esc_attr($clone_field_name) . 'title[]',
                            'return' => true,
                        ),
                    );
                    $jobcareer_html_fields->cs_text_field($cs_opt_array);
                    $cs_opt_array = array(
                        'name' => esc_html__('Use Image As', 'jobcareer'),
                        'desc' => '',
                        'hint_text' => esc_html__('Please select Image link where it will go', 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => $jobcareer_node['link_target'],
                            'id' => '',
                            'cust_id' => 'button_target',
                            'cust_name' => esc_attr($clone_field_name) . 'use_image_as[]',
                            'classes' => 'select_dropdown chosen-select-no-single ',
                            'extra_atr' => 'onchange="cs_toggle_gal(this.value,  \'' . esc_js($cs_counter) . '\')"',
                            'options' => array(
                                '0' => esc_html__('LightBox to current thumbnail', 'jobcareer'),
                                '1' => esc_html__('LightBox to Video', 'jobcareer'),
                                '2' => esc_html__('Link', 'jobcareer'),
                            ),
                            'return' => true,
                        ),
                    );

                    $jobcareer_html_fields->cs_select_field($cs_opt_array);

                    $display = '';
                    if ($jobcareer_node['use_image_as'] == "0" or $jobcareer_node['use_image_as'] == "" or $jobcareer_node['use_image_as'] == "2") {
                        $display = 'display:none';
                    }

                    $cs_opt_array = array(
                        'name' => esc_html__('Image Title', 'jobcareer'),
                        'desc' => '',
                        'id' => 'video_code' . esc_attr($cs_counter),
                        'styles' => esc_attr($display),
                        'hint_text' => esc_html__("Enter Specific Video Url Youtube or Vimeo", 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => htmlspecialchars($jobcareer_node['video_code']),
                            'cust_id' => '',
                            'classes' => 'txtfield',
                            'cust_name' => esc_attr($clone_field_name) . 'video_code[]',
                            'return' => true,
                        ),
                    );
                    $jobcareer_html_fields->cs_text_field($cs_opt_array);


                    $display = '';
                    if ($jobcareer_node['use_image_as'] == "0" or $jobcareer_node['use_image_as'] == "" or $jobcareer_node['use_image_as'] == "2") {
                        $display = 'display:none';
                    }

                    $cs_opt_array = array(
                        'name' => esc_html__('Url', 'jobcareer'),
                        'desc' => '',
                        'id' => esc_attr($clone_field_name) . 'link_url' . esc_attr($cs_counter),
                        'styles' => esc_attr($display),
                        'hint_text' => esc_html__("Enter specific url", 'jobcareer'),
                        'echo' => true,
                        'field_params' => array(
                            'std' => htmlspecialchars($jobcareer_node['link_url']),
                            'cust_id' => '',
                            'classes' => 'txtfield',
                            'cust_name' => esc_attr($clone_field_name) . 'link_url[]',
                            'return' => true,
                        ),
                    );
                    $jobcareer_html_fields->cs_text_field($cs_opt_array);
                    $cs_opt_array = array(
                        'std' => esc_attr($jobcareer_node['path']),
                        'id' => '',
                        'before' => '',
                        'after' => '',
                        'classes' => '',
                        'extra_atr' => '',
                        'cust_id' => '',
                        'cust_name' => esc_attr($clone_field_name) . 'path[]',
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
                            'std' => esc_html__('Submit', 'jobcareer'),
                            'cust_id' => '',
                            'cust_type' => 'button',
                            'classes' => 'close-submit',
                            'cust_name' => '',
                            'extra_atr' => 'onclick="javascript:galclose(\'' . esc_js($cs_counter) . '\')"',
                            'return' => true,
                        ),
                    );

                    $jobcareer_html_fields->cs_text_field($cs_opt_array);
                    ?>
                    <div class="clear"></div>
                </div>
            </div>
        </li>
        <?php
        if (isset($_POST['action'])) {
            die();
        }
    }

    add_action('wp_ajax_gallery_clone', 'jobcareer_gallery_clone');
}

// Make a copy of media image for gallery end

/**
 * @Section element Size(s)
 *
 *
 */
if (!function_exists('jobcareer_element_size_data_array_index')) {

    function jobcareer_element_size_data_array_index($size) {
        if ($size == "" or $size == 100) {
            return 0;
        } else if ($size == 75) {
            return 1;
        } else if ($size == 67) {
            return 2;
        } else if ($size == 50) {
            return 3;
        } else if ($size == 33) {
            return 4;
        } else if ($size == 25) {
            return 5;
        }
    }

}


// Section element size end 
/**
 * @Section element Size(s)
 *
 *
 */
if (!function_exists('jobcareer_element_size_data_array_index')) {

    function jobcareer_element_size_data_array_index($size) {
        if ($size == "" or $size == 100) {
            return 0;
        } else if ($size == 75) {
            return 1;
        } else if ($size == 67) {
            return 2;
        } else if ($size == 50) {
            return 3;
        } else if ($size == 33) {
            return 4;
        } else if ($size == 25) {
            return 5;
        }
    }

}


// Section element size end

/**
 * @Get  all Categories of posts or Custom posts
 *
 *
 */
if (!function_exists('jobcareer_jobcareer_show_all_cats')) {

    function jobcareer_jobcareer_show_all_cats($parent, $separator, $selected = "", $taxonomy, $optional = '') {

        if ($parent == "") {
            global $wpdb;
            $parent = 0;
        } else
            $separator .= " &ndash; ";
        $args = array(
            'parent' => $parent,
            'hide_empty' => 0,
            'taxonomy' => $taxonomy
        );
        $categories = get_categories($args);

        if ($optional) {
            $a_options = array();
            $a_options[''] = esc_html__("All Categories", 'jobcareer');
            foreach ($categories as $category) {
                $a_options[$category->slug] = $category->cat_name;
            }

            return $a_options;
        } else {
            foreach ($categories as $category) {
                ?>
                <option <?php
                if ($selected == $category->slug) {
                    echo "selected";
                }
                ?> value="<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($separator . $category->cat_name); ?></option>
                    <?php
                    jobcareer_jobcareer_show_all_cats($category->term_id, $separator, $selected, $taxonomy);
                }
            }
        }

    }


//  End Get all categories of post or custom posts
    /**
     * @Add Social Icons
     *
     *
     */
    if (!function_exists('jobcareer_add_social_icon')) {

        function jobcareer_add_social_icon() {
            global $jobcareer_html_fields, $jobcareer_form_fields;
            $js_alert_conf = esc_html__('Are you sure! You want to delete this', 'jobcareer');
            $counter_icon = rand(124234, 546455);
            $template_path = trailingslashit(get_template_directory_uri()) . 'backend/assets/scripts/media_upload.js';

            if ($_POST['social_net_awesome']) {

                $icon_awesome = $_POST['social_net_awesome'];
            }
            $output = '';
            $socail_network = get_option('jobcareer_social_network');

            echo '<tr id="del_' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '">
    
            <td>';
            if (isset($icon_awesome) and $icon_awesome <> '') {
                ;
                echo '<i style="color:' . $_POST['social_font_awesome_color'] . '!important;" class="fa ' . $_POST['social_net_awesome'] . ' icon-2x"></i>';
            } else {
                ;
                echo '<img width="50" src="' . esc_url($_POST['social_net_icon_path']) . '">';
            }echo '</td> 
            
            <td>' . $_POST['social_net_tooltip'] . '</td> 
    
            <td><a href="#">' . $_POST['social_net_url'] . '</a></td> 
			
			 <td><img src="' . esc_url($_POST['social_net_icon_path']) . '" height="50" width="50"></td> 
    
            <td class="centr"> 
                <a class="remove-btn" onclick="javascript:return confirm(' . $js_alert_conf . ')" href="javascript:social_icon_del(\'' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '\')"><i class="icon-times"></i></a>
                 <a href="javascript:cs_toggle(\'' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '\')"><i class="icon-edit"></i></a>
            </td></tr>
    
        </tr>';

            echo '<tr id="' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '" style="display:none">
                <td colspan="3">
				<div class="form-elements">
                <div><a onclick="cs_toggle(\'' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '\')"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/close-red.png" /></a></div>';

            $output .= $jobcareer_html_fields->cs_opening_field(array(
                'name' => esc_html__("Title", 'jobcareer'),
                'hint_text' => esc_html__("Please enter text for icon tooltip", 'jobcareer'),
                    )
            );

            $output .= $jobcareer_form_fields->cs_form_text_render(array(
                'std' => $_POST['social_net_tooltip'],
                'cust_id' => 'social_net_tooltip',
                'cust_name' => 'social_net_tooltip[]',
                'classes' => 'small',
                'return' => true,
            ));

            $output .= $jobcareer_html_fields->cs_closing_field(array(
                'desc' => '',
                    )
            );

            $output .= $jobcareer_html_fields->cs_opening_field(array(
                'name' => esc_html__("Title", 'jobcareer'),
                'hint_text' => esc_html__("Please enter full Url", 'jobcareer'),
                    )
            );

            $output .= $jobcareer_form_fields->cs_form_text_render(array(
                'std' => $_POST['social_net_url'],
                'cust_id' => 'social_net_url',
                'cust_name' => 'social_net_url[]',
                'classes' => 'small',
                'return' => true,
            ));

            $output .= $jobcareer_html_fields->cs_closing_field(array(
                'desc' => '',
                    )
            );

            $cs_opt_array = array(
                'std' => $_POST['social_net_icon_path'],
                'id' => 'social_net_icon_path',
                'name' => esc_html__('Icon Path', 'jobcareer'),
                'desc' => '',
                'hint_text' => esc_html__("Please enter text for icon tooltip", 'jobcareer'),
                'array' => true,
                'prefix' => '',
                'field_params' => array(
                    'std' => $_POST['social_net_icon_path'],
                    'id' => 'social_net_icon_path',
                    'return' => true,
                    'array' => true,
                    'array_txt' => false,
                    'prefix' => '',
                ),
            );

            $output .= $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);

            $output .= $jobcareer_html_fields->cs_opening_field(array(
                'name' => esc_html__("Font awesome Icon", 'jobcareer'),
                'hint_text' => '',
                    )
            );

            $output .= jobcareer_fontawsome_theme_options($_POST['social_net_awesome'], "networks" . $counter_icon, 'social_net_awesome');

            $output .= $jobcareer_html_fields->cs_closing_field(array(
                'desc' => '',
                    )
            );

            $output .= $jobcareer_html_fields->cs_opening_field(array(
                'name' => esc_html__("Font awesome Color", 'jobcareer'),
                'hint_text' => '',
                    )
            );

            $output .= $jobcareer_form_fields->cs_form_text_render(array(
                'std' => $_POST['social_font_awesome_color'],
                'cust_id' => 'social_font_awesome_color',
                'cust_name' => 'social_font_awesome_color[]',
                'classes' => 'bg_color',
                'return' => true,
            ));

            $output .= $jobcareer_html_fields->cs_closing_field(array(
                'desc' => '',
                    )
            );

            echo jobcareer_special_char($output);

            echo '  
                  </div>
				  </td>
              </tr>';
            die;
        }

        add_action('wp_ajax_jobcareer_add_social_icon', 'jobcareer_add_social_icon');
    }

// End add social icon
// Fontawsome icon box
    if (!function_exists('jobcareer_fontawsome_icons_box')) {

        function jobcareer_fontawsome_icons_box($icon_value = '', $id = '', $name = '') {
            ob_start();
            global $jobcareer_html_fields, $jobcareer_form_fields;
            ?>
        <script>
            jQuery(document).ready(function ($) {
                'use strict';

                var e9_element = $('#e9_element_<?php echo jobcareer_special_char($id); ?>').fontIconPicker({
                    theme: 'fip-bootstrap'
                });
                // Add the event on the button
                $('#e9_buttons_<?php echo jobcareer_special_char($id); ?> button').on('click', function (e) {
                    e.preventDefault();
                    // Show processing message
                    $(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
                    $.ajax({
                        url: '<?php echo get_template_directory_uri(); ?>/backend/assets/icon/js/selection.json',
                        type: 'GET',
                        dataType: 'json'
                    })
                            .done(function (response) {
                                // Get the class prefix
                                var classPrefix = response.preferences.fontPref.prefix,
                                        icomoon_json_icons = [],
                                        icomoon_json_search = [];
                                $.each(response.icons, function (i, v) {
                                    icomoon_json_icons.push(classPrefix + v.properties.name);
                                    if (v.icon && v.icon.tags && v.icon.tags.length) {
                                        icomoon_json_search.push(v.properties.name + ' ' + v.icon.tags.join(' '));
                                    } else {
                                        icomoon_json_search.push(v.properties.name);
                                    }
                                });
                                // Set new fonts on fontIconPicker
                                e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
                                // Show success message and disable
                                $('#e9_buttons_<?php echo jobcareer_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-success').text('Successfully loaded icons').prop('disabled', true);
                            })
                            .fail(function () {
                                // Show error message and enable
                                $('#e9_buttons_<?php echo jobcareer_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-danger').text('Error: Try Again?').prop('disabled', false);
                            });
                    e.stopPropagation();
                });
            });

            jQuery("#e9_buttons_<?php echo jobcareer_special_char($id); ?> button").click();
        </script>
        <?php
        $cs_opt_array = array(
            'std' => jobcareer_special_char($icon_value),
            'cust_id' => 'e9_element_' . jobcareer_special_char($id),
            'classes' => '',
            'cust_name' => jobcareer_special_char($name) . '[]',
            'extra_atr' => '',
            'return' => true,
        );
        echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
        ?>
        <span id="e9_buttons_<?php echo jobcareer_special_char($id); ?>" style="display:none">
            <button autocomplete="off" type="button" class="btn btn-primary"><?php esc_html_e('Load from IcoMoon selection.json', 'jobcareer'); ?></button>
        </span>
        <?php
        $fontawesome = ob_get_clean();
        echo jobcareer_special_char($fontawesome);
    }

}

// End fontawsome icon box
// Fontawsome icon box for Theme Options
if (!function_exists('jobcareer_fontawsome_theme_options')) {

    function jobcareer_fontawsome_theme_options($icon_value = '', $id = '', $name = '') {
        global $jobcareer_form_fields;
        ob_start();
        ?>
        <script>
            jQuery(document).ready(function ($) {
                'use strict';
                var e9_element = $('#e9_element_<?php echo jobcareer_special_char($id); ?>').fontIconPicker({
                    theme: 'fip-bootstrap'
                });
                // Add the event on the button
                $('#e9_buttons_<?php echo jobcareer_special_char($id); ?> button').on('click', function (e) {
                    e.preventDefault();
                    // Show processing message
                    $(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
                    $.ajax({
                        url: '<?php echo get_template_directory_uri(); ?>/backend/assets/icon/js/selection.json',
                        type: 'GET',
                        dataType: 'json'
                    })
                            .done(function (response) {
                                // Get the class prefix
                                var classPrefix = response.preferences.fontPref.prefix,
                                        icomoon_json_icons = [],
                                        icomoon_json_search = [];
                                $.each(response.icons, function (i, v) {
                                    icomoon_json_icons.push(classPrefix + v.properties.name);
                                    if (v.icon && v.icon.tags && v.icon.tags.length) {
                                        icomoon_json_search.push(v.properties.name + ' ' + v.icon.tags.join(' '));
                                    } else {
                                        icomoon_json_search.push(v.properties.name);
                                    }
                                });
                                // Set new fonts on fontIconPicker
                                e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
                                // Show success message and disable
                                $('#e9_buttons_<?php echo jobcareer_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-success').text('<?php esc_html_e('Successfully loaded icons', 'jobcareer') ?>').prop('disabled', true);
                            })
                            .fail(function () {
                                // Show error message and enable
                                $('#e9_buttons_<?php echo jobcareer_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-danger').text('<?php esc_html_e('Error: Try Again?', 'jobcareer') ?>').prop('disabled', false);
                            });
                    e.stopPropagation();
                });

                jQuery("#e9_buttons_<?php echo jobcareer_special_char($id); ?> button").click();
            });
        </script>

        <?php
        $cs_opt_array = array(
            'std' => jobcareer_special_char($icon_value),
            'cust_id' => 'e9_element_' . jobcareer_special_char($id),
            'classes' => '',
            'cust_name' => jobcareer_special_char($name) . '[]',
            'extra_atr' => '',
            'return' => true,
        );
        echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
        ?>
        <span id="e9_buttons_<?php echo jobcareer_special_char($id); ?>" style="display:none">
            <button autocomplete="off" type="button" class="btn btn-primary"><?php esc_html_e('Load from IcoMoon selection.json', 'jobcareer'); ?></button>
        </span>
        <?php
        $fontawesome = ob_get_clean();
        return $fontawesome;
    }

}

// Fontawsome icon box for theme option
/**
 * @Get  all Categories of posts or Custom posts
 *
 *
 */
if (!function_exists('jobcareer_show_all_cats')) {

    function jobcareer_show_all_cats($parent, $separator, $selected = "", $taxonomy) {
        if ($parent == "") {
            global $wpdb;
            $parent = 0;
        } else
            $separator .= " &ndash; ";
        $args = array(
            'parent' => $parent,
            'hide_empty' => 0,
            'taxonomy' => $taxonomy
        );
        $categories = get_categories($args);
        foreach ($categories as $category) {
            ?>
            <option <?php
            if ($selected == $category->slug) {
                echo "selected";
            }
            ?> value="<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($separator . $category->cat_name); ?></option>
            <?php
            jobcareer_show_all_cats($category->term_id, $separator, $selected, $taxonomy);
        }
    }

}


// Get all Categories of posts or custom posts
/**
 * @Add Banner Fields
 *
 */
if (!function_exists('jobcareer_add_banner_fields')) {

    function jobcareer_add_banner_fields() {
        global $jobcareer_html_fields, $jobcareer_form_fields;

        $cs_rand_id = rand(45764, 565468990);
        $output = '';
        $cs_top_banner_selected = $_POST['banner_field_style'] == 'top_banner' ? 'selected' : '';
        $cs_bottom_banner_selected = $_POST['banner_field_style'] == 'bottom_banner' ? 'selected' : '';
        $cs_sidebar_banner_selected = $_POST['banner_field_style'] == 'sidebar_banner' ? 'selected' : '';
        $cs_vertical_banner_selected = $_POST['banner_field_style'] == 'vertical_banner' ? 'selected' : '';
        // Banner Type Check
        $cs_image_banner_selected = $_POST['banner_field_type'] == 'image' ? 'selected' : '';
        $cs_code_banner_selected = $_POST['banner_field_type'] == 'code' ? 'selected' : '';
        // Banner Type Display Block Check
        $cs_baner_image_display = $_POST['banner_field_type'] == 'image' ? 'block' : 'none';
        $cs_baner_code_display = $_POST['banner_field_type'] == 'code' ? 'block' : 'none';
        // Target Check
        $cs_self_target_selected = $_POST['banner_field_url_target'] == '_self' ? 'selected' : '';
        $cs_blank_target_selected = $_POST['banner_field_url_target'] == '_blank' ? 'selected' : '';
        $js_alert_conf = esc_html__('Are you sure! You want to delete this', 'jobcareer');
        if ($_POST['banner_field_style'] == 'top_banner') {
            $cs_banner_group = esc_html__('Top', 'jobcareer');
        } else if ($_POST['banner_field_style'] == 'bottom_banner') {
            $cs_banner_group = esc_html__('Bottom', 'jobcareer');
        } else if ($_POST['banner_field_style'] == 'sidebar_banner') {
            $cs_banner_group = esc_html__('Sidebar', 'jobcareer');
        } else {
            $cs_banner_group = esc_html__('Vertical', 'jobcareer');
        }

        echo '<tr id="del_' . jobcareer_slugify_text($_POST['banner_field']) . '">
                <td>' . $_POST['banner_field'] . '</td>
                <td>' . $cs_banner_group . '</td>';
        if ($_POST['banner_field_type'] == 'image') {
            echo '<td><img src="' . esc_url($_POST['banner_field_image']) . '" alt="" width="100" /></td>';
        } else {
            echo '<td>' . esc_html__('Custom Code', 'jobcareer') . '</td>';
        }
        echo '<td>&nbsp;</td>';
        echo '<td>[cs_ads id="' . $cs_rand_id . '"]</td>';
        echo '<td class="centr">
                    <a class="remove-btn" onclick="javascript:return confirm(' . $js_alert_conf . ')" href="javascript:social_icon_del(\'' . jobcareer_slugify_text($_POST['banner_field']) . '\')"><i class="icon-cross3"></i></a>
                    <a href="javascript:cs_toggle(\'' . jobcareer_slugify_text($_POST['banner_field']) . '\')"><i class="icon-pencil6"></i></a>
                </td>
              </tr>';
        echo '<tr id="' . jobcareer_slugify_text($_POST['banner_field']) . '" style="display:none;">
                <td colspan="3">
                  <div class="form-elements">
                    <div><a onclick="cs_toggle(\'' . jobcareer_slugify_text($_POST['banner_field']) . '\')"><img src="' . esc_url(get_template_directory_uri()) . '/backend/assets/images/close-red.png" /></a></div>';

        $output .= $jobcareer_html_fields->cs_opening_field(array(
            'name' => esc_html__("Title", 'jobcareer'),
            'hint_text' => esc_html__("Please enter the Title", 'jobcareer'),
                )
        );

        $output .= $jobcareer_form_fields->cs_form_text_render(array(
            'std' => $_POST['banner_field'],
            'cust_id' => 'banner_field_title',
            'cust_name' => 'banner_field_title[]',
            'classes' => 'small',
            'return' => true,
        ));

        $output .= $jobcareer_html_fields->cs_closing_field(array(
            'desc' => '',
                )
        );

        $output .= $jobcareer_html_fields->cs_opening_field(array(
            'name' => esc_html__("Banner Style", 'jobcareer'),
            'hint_text' => esc_html__("Please select the Banner", 'jobcareer'),
                )
        );

        $output .= $jobcareer_form_fields->cs_form_select_render(array(
            'std' => $cs_top_banner_selected,
            'cust_id' => 'banner-style' . $cs_rand_id,
            'cust_name' => 'banner_field_style[]',
            'options' => array('top_banner' => esc_html__('Top Banner', 'jobcareer'), 'bottom_banner' => esc_html__('Bottom Banner', 'jobcareer'), 'sidebar_banner' => esc_html__('Sidebar Banner', 'jobcareer'), 'vertical_banner' => esc_html__('Vertical Banner', 'jobcareer'),),
            'return' => true,
        ));

        $output .= $jobcareer_html_fields->cs_closing_field(array(
            'desc' => '',
                )
        );

        $output .= $jobcareer_html_fields->cs_opening_field(array(
            'name' => esc_html__("Banner Type", 'jobcareer'),
            'hint_text' => esc_html__("Please select the Banner Type", 'jobcareer'),
                )
        );

        $output .= $jobcareer_form_fields->cs_form_select_render(array(
            'std' => $cs_image_banner_selected,
            'cust_id' => 'banner-style' . $cs_rand_id,
            'cust_name' => 'banner_field_type[]',
            'extra_atr' => ' onchange="cs_banner_type_toggle(this.value, \'' . $cs_rand_id . '\')"',
            'options' => array('image' => esc_html__('Image', 'jobcareer'), 'code' => esc_html__('Code', 'jobcareer')),
            'return' => true,
        ));

        $output .= $jobcareer_html_fields->cs_closing_field(array(
            'desc' => '',
                )
        );

        $output .= '
                    <div class="form-elements" id="cs_banner_image_field_' . $cs_rand_id . '" style="display:' . $cs_baner_image_display . ';">
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					    <label>Image</label>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="cs_banner_image_value_' . $cs_rand_id . '" style="display:' . $cs_baner_image_display . ';">
						<ul class="form-elements" id="' . $cs_rand_id . '_upload">
						  <li class="to-field">';
        $output .= $jobcareer_form_fields->cs_form_text_render(array(
            'std' => $_POST['banner_field_image'],
            'cust_id' => 'banner_field_image' . $cs_rand_id,
            'cust_name' => 'banner_field_image[]',
            'cust_type' => 'hidden',
            'classes' => 'small',
            'return' => true,
        ));

        $output .= '
							<label class="browse-icon">';

        $output .= $jobcareer_form_fields->cs_form_text_render(array(
            'std' => esc_html__('Browse', 'jobcareer'),
            'cust_id' => 'banner-filde' . $cs_rand_id,
            'cust_name' => 'banner_field_image' . $cs_rand_id,
            'cust_type' => 'button',
            'classes' => 'jobcareer_uploadMedia left',
            'return' => true,
        ));

        $output .= '
							</label>
						  </li>
						</ul>
						<div class="page-wrap" style="overflow:hidden;display:block;" id="banner_field_image' . $cs_rand_id . '_box" >
						  <div class="gal-active cs-galactive">
							<div class="dragareamain cs-drag-padding">
							  <ul id="gal-sortable">
								<li class="ui-state-default">
								  <div class="thumb-secs"> <img src="' . esc_url($_POST['banner_field_image']) . '" id="banner_field_image' . $cs_rand_id . '_img" width="100" />
									<div class="gal-edit-opts"> <a href=javascript:del_media("banner_field_image' . $cs_rand_id . '") class="delete"></a> </div>
								  </div>
								</li>
							  </ul>
							</div>
						  </div>
						</div>
					  </div>
                    </div>';

        $output .= $jobcareer_html_fields->cs_opening_field(array(
            'name' => esc_html__("URL", 'jobcareer'),
            'hint_text' => esc_html__("Please enter Banner Url", 'jobcareer'),
                )
        );
        $cs_opt_array = array(
            'std' => $_POST['banner_field_url'],
            'cust_id' => '',
            'classes' => 'small',
            'cust_name' => 'banner_field_url[]',
            'extra_atr' => '',
            'return' => true,
        );
        $output .= $jobcareer_form_fields->cs_form_text_render($cs_opt_array);

        $output .= $jobcareer_form_fields->cs_form_text_render(array(
            'std' => $_POST['banner_field_url'],
            'cust_id' => 'banner-filde' . $cs_rand_id,
            'cust_name' => 'banner_field_url[]',
            'classes' => 'small',
            'return' => true,
        ));

        $output .= $jobcareer_html_fields->cs_closing_field(array(
            'desc' => '',
                )
        );

        $output .= $jobcareer_html_fields->cs_opening_field(array(
            'name' => esc_html__("Target", 'jobcareer'),
            'hint_text' => esc_html__("Please select Banner Link Target", 'jobcareer'),
                )
        );

        $output .= $jobcareer_form_fields->cs_form_select_render(array(
            'std' => $cs_self_target_selected,
            'cust_id' => 'banner-style' . $cs_rand_id,
            'cust_name' => 'banner_field_url_target[]',
            'options' => array('_self' => esc_html__('Self', 'jobcareer'), '_blank' => esc_html__('Blank', 'jobcareer')),
            'return' => true,
        ));

        $output .= $jobcareer_html_fields->cs_closing_field(array(
            'desc' => '',
                )
        );

        $output .= '
                    <div class="form-elements" id="cs_banner_code_field_' . $cs_rand_id . '" style="display:' . $cs_baner_code_display . ';">
					  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label>' . esc_html__('Ad sense Code', 'jobcareer') . '</label>
                      </div>
                      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" id="cs_banner_code_value_' . $cs_rand_id . '" style="display:' . $cs_baner_code_display . ';">';

        $output .= $jobcareer_form_fields->cs_form_textarea_render(array(
            'std' => $_POST['banner_field_code'],
            'cust_id' => 'banner-filde' . $cs_rand_id,
            'cust_name' => 'banner_adsense_code[]',
            'classes' => '',
            'return' => true,
        ));

        $output .= '
                      </div>
					</div>';
        $cs_opt_array = array(
            'std' => $cs_rand_id,
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => '',
            'extra_atr' => '',
            'cust_id' => '',
            'cust_name' => 'banner_field_code_no[]',
            'return' => true,
            'required' => false
        );
        $output .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
        $output .= ' </div>
                </td>
              </tr>';

        echo jobcareer_special_char($output);
        die;
    }

    add_action('wp_ajax_jobcareer_add_banner_fields', 'jobcareer_add_banner_fields');
}

// Add banner Fields end
// start validate data 
if (!function_exists('jobcareer_validate_data')) {

    function jobcareer_validate_data($input = '') {
        $output = $input;
        return $output;
    }
}// End validate data