<?php

/**
 * @Slider options
 * @return html
 *
 */
// Page subheader function start here
if (!function_exists('jobcareer_subheader_element')) {

    function jobcareer_subheader_element() {
        global $jobcareer_xmlObject, $post, $jobcareer_metaboxes;
        $page_subheader_no_image = '';
        $cs_default_map = '[cs_map column_size="1/1" map_height="250" map_lat="51.5072" map_lon="0.1275" map_zoom="11" map_type="ROADMAP" map_info="Info Window Text here." map_info_width="250" map_info_height="100" map_marker_icon1xis="Browse" map_show_marker="true" map_controls="false" map_draggable="true" map_scrollwheel="true" map_border="yes" cs_map_style="style-1"]';

        $cs_banner_style = get_post_meta($post->ID, 'cs_header_banner_style', true);

        $cs_default_header = $jobcareer_breadcrumb_header = $cs_custom_slider = $cs_map = $cs_no_header = 'hide';
        if (isset($cs_banner_style) && $cs_banner_style == 'default_header') {
            $cs_default_header = 'hide';
        } else if (isset($cs_banner_style) && $cs_banner_style == 'breadcrumb_header') {
            $jobcareer_breadcrumb_header = 'show';
            $cs_default_header = 'show';
        } else if (isset($cs_banner_style) && $cs_banner_style == 'custom_slider') {
            $cs_custom_slider = 'show';
        } else if (isset($cs_banner_style) && $cs_banner_style == 'map') {
            $cs_map = 'show';
        } else if (isset($cs_banner_style) && $cs_banner_style == 'no-header') {
            $cs_no_header = 'show';
        } else {
            $cs_default_header = 'show';
        }

        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Choose Sub-header', 'jobcareer'),
                    'id' => 'header_banner_style',
                    'classes' => 'chosen-select-no-single',
                    'std' => 'default_header',
                    'onclick' => 'cs_slider_element_toggle',
                    'status' => '',
                    'description' => '',
                    'options' => array('default_header' => esc_html__('Default Subheader', 'jobcareer'), 'breadcrumb_header' => esc_html__('Custom Subheader', 'jobcareer'), 'custom_slider' => esc_html__('Revolution Slider', 'jobcareer'), 'map' => esc_html__('Map', 'jobcareer'), 'no-header' => esc_html__('No Subheader', 'jobcareer')),
                    'help_text' => esc_html__("Choose subheader layout for this specific post. Default subheader get settings from theme options that you saved for subheader. Custom have custom fields with full control same like theme options you can manage for only this post. Revolution Slider enables slider in subheader. Map for show map in subheader and no subheader for disable subheader for this post.", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'breadcrumb_header',
                    'status' => $jobcareer_breadcrumb_header,
                )
        );

        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Text Align', 'jobcareer'),
                    'id' => 'page_title_align',
                    'classes' => '',
                    'std' => 'left',
                    'onclick' => '',
                    'status' => '',
                    'classes' => 'chosen-select-no-single',
                    'description' => '',
                    'options' => array('left' => esc_html__('left', 'jobcareer'), 'right' => esc_html__('Right', 'jobcareer'), 'center' => esc_html__('Center', 'jobcareer')),
                    'help_text' => esc_html__("Text align to left, right and center here.", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Title', 'jobcareer'),
                    'id' => 'page_title',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("Subheader get title from your post title it can be hide with this switch", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_textarea_render(
                array('name' => esc_html__('Sub Heading', 'jobcareer'),
                    'id' => 'page_subheading_title',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("Enter subheading text is here. it will be displayed after title", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Breadcrumbs', 'jobcareer'),
                    'id' => 'page_breadcrumbs',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => '',
                )
        );

        $jobcareer_metaboxes->cs_form_range_render(
                array('name' => esc_html__('Padding Top', 'jobcareer'),
                    'id' => 'subheader_padding_top',
                    'classes' => '',
                    'min' => '0',
                    'max' => '100',
                    'step' => '1',
                    'std' => '0',
                    'description' => '',
                    'help_text' => esc_html__("Set top  padding here. It affects before title", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_range_render(
                array('name' => esc_html__('Padding Bottom', 'jobcareer'),
                    'id' => 'subheader_padding_bottom',
                    'classes' => '',
                    'min' => '0',
                    'max' => '100',
                    'step' => '1',
                    'std' => '0',
                    'description' => '',
                    'help_text' => esc_html__("Set bottom padding here. It affects after title.", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_color_render(
                array('name' => esc_html__('Background Color', 'jobcareer'),
                    'id' => 'page_subheader_color',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("Provide a hex color code here (with #) if you want to override the default or leave it empty for using background image.", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_color_render(
                array('name' => esc_html__('Text Color', 'jobcareer'),
                    'id' => 'page_subheader_text_color',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("Provide a hex color code here (with #) for title.", 'jobcareer'),
                )
        );

//        $jobcareer_metaboxes->cs_form_color_render(
//                array('name' => esc_html__('Overlay Color', 'jobcareer'),
//                    'id' => 'subheader_overlay_color',
//                    'classes' => '',
//                    'std' => '',
//                    'description' => '',
//                    'hint' => '',
//                    'help_text' => esc_html__("Provide a hex color code here (with #) for border.", 'jobcareer'),
//                )
//        );
//
//        $jobcareer_metaboxes->cs_form_select_render(
//                array('name' => esc_html__('Overlay Opacity', 'jobcareer'),
//                    'id' => 'subheader_overlay_opacity',
//                    'classes' => '',
//                    'std' => '',
//                    'description' => '',
//                    'classes' => 'chosen-select-no-single',
//                    'hint' => '',
//                    'help_text' => esc_html__('Set the Opacity of Overlay.', 'jobcareer'),
//                    'options' => array(
//                        '0.1' => '0.1',
//                        '0.2' => '0.2',
//                        '0.3' => '0.3',
//                        '0.4' => '0.4',
//                        '0.5' => '0.5',
//                        '0.6' => '0.6',
//                        '0.7' => '0.7',
//                        '0.8' => '0.8',
//                        '0.9' => '0.9',
//                        '1.0' => '1.0',
//                    ),
//                )
//        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'breadcrumb_header',
                )
        );

        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'default_header',
                    'status' => $cs_default_header,
                )
        );

        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Show Image', 'jobcareer'),
                    'id' => 'page_subheader_no_image',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('On this switch for showing backgournd image.', 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_fileupload_render(
                array('name' => esc_html__('Background Image', 'jobcareer'),
                    'id' => 'header_banner_image',
                    'classes' => '',
                    'help_text' => esc_html__("Choose subheader background image from media gallery or leave it empty for display default image set by theme options.", 'jobcareer'),
                    'std' => '',
                    'description' => '',
                    'hint' => ''
                )
        );

        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Parallax Background Image', 'jobcareer'),
                    'id' => 'page_subheader_parallax',
                    'help_text' => esc_html__("Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling can be enable with this switch.", 'jobcareer'),
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => ''
                )
        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'default_header',
                )
        );

        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'custom_slider',
                    'status' => $cs_custom_slider,
                )
        );

        $cs_slider_array = array('' => 'Select Slider');

        if (class_exists('RevSlider') && class_exists('jobcareer_revSlider')) {
            $slider = new jobcareer_revSlider();
            $arrSliders = $slider->getAllSliderAliases();
            foreach ($arrSliders as $key => $entry) {
                $cs_slider_array[$entry['alias']] = $entry['title'];
            }
        }

        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Select Slider', 'jobcareer'),
                    'id' => 'custom_slider_id',
                    'classes' => '',
                    'std' => 'left',
                    'onclick' => '',
                    'classes' => 'chosen-select-no-single',
                    'status' => '',
                    'description' => '',
                    'options' => $cs_slider_array,
                    'help_text' => '',
                )
        );
        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'custom_slider',
                )
        );
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'map',
                    'status' => $cs_map,
                )
        );
        $jobcareer_metaboxes->cs_form_textarea_render(
                array('name' => esc_html__('Custom Map Short Code', 'jobcareer'),
                    'id' => 'custom_map',
                    'classes' => '',
                    'std' => $cs_default_map,
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('Add/Edit the shortcode of map.', 'jobcareer'),
                )
        );
        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'map',
                )
        );
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'no-header',
                    'status' => $cs_no_header,
                )
        );

        $jobcareer_metaboxes->cs_form_color_render(
                array('name' => esc_html__('Header Border Color', 'jobcareer'),
                    'id' => 'page_main_header_border_color',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'help_text' => esc_html__("Provide a hex color code here (with #) for header border color.", 'jobcareer'),
                    'hint' => ''
                )
        );
        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'no-header',
                )
        );
    }

}

/**
 * @SEO Settings for page and post start 
 * @return
 *
 */
if (!function_exists('jobcareer_seo_settitngs_element')) {

    function jobcareer_seo_settitngs_element() {
        global $jobcareer_metaboxes;
        $jobcareer_metaboxes->cs_form_text_render(
                array('name' => esc_html__('Seo Title', 'jobcareer'),
                    'id' => 'seo_title',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("Google typically displays the first 50-60 characters of a title tag, or as many characters as will fit into a 512-pixel display. If you keep your titles under 55 characters, you can expect at least 95% of your titles to display properly.", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_textarea_render(
                array('name' => esc_html__('Seo Description', 'jobcareer'),
                    'id' => 'seo_description',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("Meta descriptions can be any length, but search engines generally truncate snippets longer than 160 characters. It is best to keep meta descriptions between 150 and 160 characters.", 'jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_form_text_render(
                array('name' => esc_html__('Seo Keywords', 'jobcareer'),
                    'id' => 'seo_keywords',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__("There is no official length requirement but generally you ll see people mention anywhere from 100 to 255 characters. Just be sure to put in the words that match your page content and dont worry about anything else. Meta Keywords doesnt make any improvements in SEO, use Meta Description instead.", 'jobcareer'),
                )
        );
    }

}


/**
 * @Sidebar Layout setting start
 * @return
 *
 */
if (!function_exists('jobcareer_sidebar_layout_options')) {

    function jobcareer_sidebar_layout_options() {
        global $post, $jobcareer_xmlObject, $jobcareer_options, $page_option, $jobcareer_metaboxes;

        $cs_theme_sidebar = get_option('cs_theme_options');
        $cs_sidebars_array = array('' => 'Select Sidebar');
        if (isset($cs_theme_sidebar['sidebar']) and count($cs_theme_sidebar['sidebar']) > 0) {
            foreach ($cs_theme_sidebar['sidebar'] as $key => $sidebar) {
                $cs_sidebars_array[$sidebar] = $sidebar;
            }
        }

        $cs_page_layout = get_post_meta($post->ID, 'cs_page_layout', true);

        if (isset($cs_page_layout) && $cs_page_layout != '') {
            $selected = '';
        } else {
            if (isset($post->post_type) && $post->post_type == "post") {
                $selected = isset($jobcareer_options['cs_single_layout_sidebar']) ? $jobcareer_options['cs_single_layout_sidebar'] : '';
            } else {
                $selected = isset($jobcareer_options['cs_default_layout_sidebar']) ? $jobcareer_options['cs_default_layout_sidebar'] : '';
            }
        }

        $cs_page_sidebar_right = get_post_meta($post->ID, 'cs_page_sidebar_right', true);
        $cs_page_sidebar_left = get_post_meta($post->ID, 'cs_page_sidebar_left', true);

        $cs_left = $cs_right = 'hide';
        if (isset($cs_page_layout) && $cs_page_layout == 'left') {
            $cs_left = 'show';
        } else if (isset($cs_page_layout) && $cs_page_layout == 'right') {
            $cs_right = 'show';
        }

        $jobcareer_metaboxes->cs_form_layout_render(
                array('name' => esc_html__('Choose Sidebar', 'jobcareer'),
                    'id' => 'page_layout',
                    'std' => 'none',
                    'classes' => '',
                    'description' => '',
                    'onclick' => '',
                    'status' => '',
                    'meta' => '',
                    'help_text' => esc_html__('Choose sidebar layout for this post.', 'jobcareer'),
                )
        );


        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'sidebar_left',
                    'status' => $cs_left,
                )
        );

        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Select Left Sidebar', 'jobcareer'),
                    'id' => 'page_sidebar_left',
                    'classes' => 'chosen-select-no-single',
                    'std' => $cs_page_sidebar_left,
                    'description' => esc_html__('Add New Sidebar', 'jobcareer'), '<a href="' . esc_url(admin_url()) . 'themes.php?page=jobcareer_theme_options_constructor#tab-sidebar-show" target="_blank">' . esc_html__('Click Here', 'jobcareer') . '</a>',
                    'onclick' => '',
                    'status' => '', // Hide OR Show
                    'options' => $cs_sidebars_array,
                )
        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'sidebar_left',
                )
        );

        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'sidebar_right',
                    'status' => $cs_right,
                )
        );

        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Select Right Sidebar', 'jobcareer'),
                    'id' => 'page_sidebar_right',
                    'classes' => 'chosen-select-no-single',
                    'std' => $cs_page_sidebar_right,
                    'description' => esc_html__('Add New Sidebar', 'jobcareer'), '<a href="' . esc_url(admin_url()) . 'themes.php?page=jobcareer_theme_options_constructor#tab-sidebar-show" target="_blank">' . esc_html__('Click Here', 'jobcareer') . '</a>',
                    'onclick' => '',
                    'status' => '',
                    'options' => $cs_sidebars_array,
                )
        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'sidebar_right',
                )
        );

        $jobcareer_metaboxes->cs_form_hidden_render(
                array('id' => 'orderby',
                    'classes' => '',
                    'std' => 'meta_layout',
                    'type' => 'array', // Type : array for arrays and for single leave it empty,
                    'return' => 'echo' // return type : echo OR return
                )
        );
    }

}

/**
 * Upcoming page Settings start 
 * @return
 *
 */
if (!function_exists('jobcareer_upcoming_element')) {

    function jobcareer_upcoming_element() {
        global $jobcareer_xmlObject, $post, $jobcareer_metaboxes, $jobcareer_options, $jobcareer_html_fields;

        $cs_job_upcoming_con = '';
        if (isset($jobcareer_options) && $jobcareer_options != '') {
            if (isset($jobcareer_options['cs_job_upcoming_con'])) {
                $cs_job_upcoming_con = $jobcareer_options['cs_job_upcoming_con'];
            }
            $cs_post_id = isset($post->ID) ? $post->ID : '';
            if (isset($cs_post_id) and $cs_post_id <> '') {
                $cs_postObject = get_post_meta($post->ID, 'cs_full_data', true);
            } else {
                $cs_post_id = '';
            }
            if (isset($cs_postObject['cs_upcoming_page_description']) && $cs_postObject['cs_upcoming_page_description'] <> '') {
                $cs_upcoming_page = $cs_postObject['cs_upcoming_page_description'];
            }
        }
        $cs_opt_array = array(
            'name' => esc_html__('Coming Soon page', 'jobcareer'),
            'id' => '',
            'desc' => '',
            'echo' => true,
            'hint_text' => esc_html__('On this switch for showing Coming Soon page', 'jobcareer'),
            'field_params' => array(
                'std' => '',
                'id' => 'page_upcoming',
                'prefix_enable' => true,
                'cust_name' => 'cs_page_upcoming',
                'return' => true,
            ),
        );

        $jobcareer_html_fields->cs_checkbox_field($cs_opt_array);


        echo '<ul class="form-elements"><li class="to-label">' . esc_html__("Upcoming Page Content", 'jobcareer') . jobcareer_tooltip_text(esc_html__("This Content will print on frontend when employer post a new job as confirmation content on payment page.", 'jobcareer')) . '
		
		</li><li class="to-field has_input">';

        $cs_job_upcoming_content = '';
        if (isset($cs_upcoming_page)) {
            $cs_job_upcoming_content = (isset($cs_upcoming_page)) ? ($cs_upcoming_page) : '';
        } else {
            $cs_job_upcoming_content = (isset($cs_job_upcoming_con)) ? ($cs_job_upcoming_con) : '';
        }

        wp_editor($cs_job_upcoming_content, 'cs_upcoming_page_description', array(
            'textarea_name' => 'cs_upcoming_page_description',
            'editor_class' => 'text-input',
            'media_buttons' => false,
            'textarea_rows' => 6,
            'quicktags' => false,
            'tinymce' => array(
                'menubar' => false
            )
                )
        );

        echo '</li></ul>';

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'no-header',
                )
        );
    }

}