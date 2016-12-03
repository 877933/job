<?php
$cs_main_vars = array('post', 'jobcareer_node', 'cs_count_node', 'jobcareer_xmlObject');
$cs_main_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_main_vars);
extract($cs_main_vars);

$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();

// Start cs page builder meta box function
if (!function_exists('jobcareer_page_bulider_add')) {
    add_action('add_meta_boxes', 'jobcareer_page_bulider_add');

    function jobcareer_page_bulider_add() {
        add_meta_box('id_page_builder', esc_html__('CS Page Builder', 'jobcareer'), 'jobcareer_page_bulider', 'page', 'normal', 'high');
    }

}

// Page builder section Form fields start

if (!function_exists('jobcareer_page_bulider')) {

    function jobcareer_page_bulider($post) {
        global $post, $jobcareer_xmlObject, $jobcareer_node, $cs_count_node, $post, $column_container, $coloum_width, $jobcareer_form_fields;
        wp_reset_query();
        $postID = $post->ID;
        $count_widget = 0;
        $page_title = '';
        $page_content = '';
        $page_sub_title = '';
        $builder_active = 0;
        $jobcareer_page_bulider = get_post_meta($post->ID, "cs_page_builder", true);
        if ($jobcareer_page_bulider <> "") {
            $jobcareer_xmlObject = new stdClass();
            $jobcareer_xmlObject = new SimpleXMLElement($jobcareer_page_bulider);
            $builder_active = $jobcareer_xmlObject->builder_active;
        }

        $cs_opt_array = array(
            'std' => jobcareer_special_char($builder_active),
            'id' => '',
            'before' => '',
            'after' => '',
            'classes' => '',
            'extra_atr' => '',
            'cust_id' => '',
            'cust_name' => 'builder_active',
            'return' => true,
            'required' => false
        );
        echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
        ?>
        <div class="clear"></div>
        <div id="add_page_builder_item">
            <div id="cs_shortcode_area"></div>  
            <?php
            if ($jobcareer_page_bulider <> "") {
                if (isset($jobcareer_xmlObject->page_title)) {
                    $page_title = $jobcareer_xmlObject->page_title;
                }
                if (isset($jobcareer_xmlObject->page_content)) {
                    $page_content = $jobcareer_xmlObject->page_content;
                }
                if (isset($jobcareer_xmlObject->page_sub_title)) {
                    $page_sub_title = $jobcareer_xmlObject->page_sub_title;
                }
                foreach ($jobcareer_xmlObject->column_container as $column_container) {
                    jobcareer_column_pb(1);
                }
            }
            ?>
        </div>
        <div class="clear"></div>
        <div class="add-widget"> <span class="addwidget"> <a href="javascript:ajaxSubmit('jobcareer_column_pb','1','column_full')"><i class="icon-plus-circle"></i> <?php esc_html_e('Add Page Sections', 'jobcareer'); ?></a> </span> 
            <div id="loading" class="builderload"></div>
            <div class="clear"></div>
            <?php
            $cs_opt_array = array(
                'std' => '1',
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => '',
                'extra_atr' => '',
                'cust_id' => '',
                'cust_name' => 'page_builder_form',
                'return' => true,
                'required' => false
            );
            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
            ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>  
        <script type="text/javascript">
            var count_widget = <?php echo jobcareer_special_char($count_widget); ?>;
            jQuery(function () {
                jQuery(".draginner").sortable({
                    connectWith: '.draginner',
                    handle: '.column-in',
                    start: function (event, ui) {
                        jQuery(ui.item).css({"width": "25%"});
                    },
                    cancel: '.draginner .poped-up,#confirmOverlay',
                    revert: false,
                    receive: function (event, ui) {
                        callme();
                    },
                    placeholder: "ui-state-highlight",
                    forcePlaceholderSize: true
                });
                jQuery("#add_page_builder_item").sortable({
                    handle: '.column-in',
                    connectWith: ".columnmain",
                    cancel: '.column_container,.draginner,#confirmOverlay',
                    revert: false,
                    placeholder: "ui-state-highlight",
                    forcePlaceholderSize: true
                });

            });
            function ajaxSubmit(action, total_column, column_class) {
                counter++;
                count_widget++;
                jQuery('.builderload').html("<img src='<?php echo get_template_directory_uri(); ?>/backend/assets/images/ajax_loading.gif' />");
                var newCustomerForm = "action=" + action + '&counter=' + counter + '&total_column=' + total_column + '&column_class=' + column_class + '&postID=<?php echo esc_js($postID); ?>';
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php') ?>",
                    data: newCustomerForm,
                    success: function (data) {
                        jQuery('.builderload').html("");
                        jQuery("#add_page_builder_item").append(data);
                        jQuery('div.cs-drag-slider').each(function () {
                            var _this = jQuery(this);
                            _this.slider({
                                range: 'min',
                                step: _this.data('slider-step'),
                                min: _this.data('slider-min'),
                                max: _this.data('slider-max'),
                                value: _this.data('slider-value'),
                                slide: function (event, ui) {
                                    jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
                                }
                            });
                        });
                        jQuery('.bg_color').wpColorPicker();
                        jQuery(".draginner").sortable({
                            connectWith: '.draginner',
                            handle: '.column-in',
                            cancel: '.draginner .poped-up,#confirmOverlay',
                            revert: false,
                            start: function (event, ui) {
                                jQuery(ui.item).css({"width": "25%"})
                            },
                            receive: function (event, ui) {
                                callme();
                            },
                            placeholder: "ui-state-highlight",
                            forcePlaceholderSize: true
                        });

                        chosen_selectionbox();
                        popup_over();
                        //alert('12345');
                    }
                });

            }
            function ajaxSubmitwidget(action, id) {

                SuccessLoader();
                counter++;
                var newCustomerForm = "action=" + action + '&counter=' + counter;
                var edit_url = action + counter;

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php') ?>",
                    data: newCustomerForm,
                    success: function (data) {

                        jQuery("#counter_" + id).append(data);
                        jQuery("#" + action + counter).append('<input type="hidden" name="cs_widget_element_num[]" value="form" />');
                        jQuery('.bg_color').wpColorPicker();
                        jQuery(".draginner").sortable({
                            connectWith: '.draginner',
                            handle: '.column-in',
                            cancel: '.draginner .poped-up,#confirmOverlay',
                            revert: false,
                            receive: function (event, ui) {
                                callme();
                            },
                            placeholder: "ui-state-highlight",
                            forcePlaceholderSize: true
                        });
                        removeoverlay("composer-" + id, "append");
                        jQuery('div.cs-drag-slider').each(function () {
                            var _this = jQuery(this);
                            _this.slider({
                                range: 'min',
                                step: _this.data('slider-step'),
                                min: _this.data('slider-min'),
                                max: _this.data('slider-max'),
                                value: _this.data('slider-value'),
                                slide: function (event, ui) {
                                    jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
                                }
                            });
                        });
                        callme();
                        chosen_selectionbox();
                        popup_over();

                        //alert('dddddddd');

                    }
                });
            }
            function ajaxSubmitwidget_element(action, id, name) {
                SuccessLoader();
                counter++;
                var newCustomerForm = "action=" + action + '&element_name=' + name + '&counter=' + counter;
                var edit_url = action + counter;

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php') ?>",
                    data: newCustomerForm,
                    success: function (data) {
                        jQuery("#counter_" + id).append(data);

                        jQuery("#counter_" + id + " #results-shortocde-id-form").append('<input type="hidden" name="cs_widget_element_num[]" value="form" />');
                        jQuery('.bg_color').wpColorPicker();
                        jQuery(".draginner").sortable({
                            connectWith: '.draginner',
                            handle: '.column-in',
                            cancel: '.draginner .poped-up,#confirmOverlay',
                            revert: false,
                            receive: function (event, ui) {
                                callme();
                            },
                            placeholder: "ui-state-highlight",
                            forcePlaceholderSize: true
                        });
                        removeoverlay("composer-" + id, "append");
                        jQuery('div.cs-drag-slider').each(function () {
                            var _this = jQuery(this);
                            _this.slider({
                                range: 'min',
                                step: _this.data('slider-step'),
                                min: _this.data('slider-min'),
                                max: _this.data('slider-max'),
                                value: _this.data('slider-value'),
                                slide: function (event, ui) {
                                    jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
                                }
                            });
                        });
                        callme();
                        chosen_selectionbox();
                        popup_over();
                        //alert('calme function');
                    }
                });
            }
            function ajaxSubmittt(action) {
                counter++;
                count_widget++;
                var newCustomerForm = "action=" + action + '&counter=' + counter;
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo admin_url() ?>/admin-ajax.php",
                    data: newCustomerForm,
                    success: function (data) {
                        jQuery("#add_page_builder_item").append(data);
                        if (count_widget > 0) {
                            jQuery("#add_page_builder_item").addClass('hasclass');
                        }

                        //alert('ddddddd');

                    }
                });

            }
        </script>
        <?php
    }

}

// Post and save page builder values  

if (isset($_POST['page_builder_form']) and $_POST['page_builder_form'] == 1) {
    if (!function_exists('save_page_builder')) {
        add_action('save_post', 'save_page_builder');

        function save_page_builder($post_id) {

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;

            if (isset($_POST['builder_active'])) {
                $sxe = new SimpleXMLElement("<pagebuilder></pagebuilder>");
                if (empty($_POST["builder_active"])) {
                    $_POST["builder_active"] = "";
                }
                if (empty($_POST["page_content"])) {
                    $_POST["page_content"] = "";
                }
                $sxe->addChild('builder_active', $_POST['builder_active']);
                $sxe->addChild('page_content', $_POST['page_content']);

                $cs_counter = 0;
                $page_element_id = 0;
                $cs_counter_gal = 0;
                $cs_counter_port = 0;
                $counter_team = 0;
                $cs_counter_slider = 0;
                $cs_counter_blog_slider = 0;
                $cs_counter_blog = 0;
                $cs_counter_sermon = 0;
                $cs_counter_latest_sermon = 0;
                $cs_counter_directory = 0;
                $cs_counter_news = 0;
                $cs_counter_contact = 0;
                $cs_counter_contactus = 0;
                $cs_counter_testimonial = 0;
                $cs_counter_column = 0;
                $cs_counter_mb = 0;
                $cs_counter_image = 0;
                $cs_counter_map = 0;
                $cs_counter_services_node = 0;
                $cs_counter_services = 0;
                $cs_counter_tabs_node = 0;
                $cs_counter_accordion_node = 0;
                $cs_counter_highlight = 0;
                $cs_counter_register = 0;
                $cs_counter_testimonials_node = 0;
                $cs_shortcode_counter_testimonial = 0;
                $cs_global_counter_testimonials = 0;
                $cs_counter_testimonials = 0;
                $cs_counter_list = 0;
                $cs_counter_lists_node = 0;
                $cs_counter_team = 0;
                $cs_counter_team_node = 0;
                $counter_slider = 0;

                $counter_slider = 0;
                $counter_services = 0;
                $counter_services_node = 0;
                $cs_global_counter_services = 0;
                $cs_shortcode_counter_services = 0;
                $counter_tabs = 0;
                $counter_tabs_node = 0;
                $cs_shortcode_counter_tabs = 0;
                $cs_global_counter_tabs = 0;
                $counter_accordion = 0;
                $counter_accordion_node = 0;
                $cs_global_counter_accordion = 0;
                $cs_shortcode_counter_accordion = 0;
                $counter_faq = 0;
                $counter_faq_node = 0;
                $cs_global_counter_faq = 0;
                $cs_shortcode_counter_faq = 0;
                $cs_counter_toggle = 0;
                $cs_global_counter_toggle = 0;
                $cs_shortcode_counter_toggle = 0;
                $cs_counter_parallax = 0;
                $widget_no = 0;
                $column_container_no = 0;
                $cs_counter_dcpt = 0;
                $cs_counter_pricetables = 0;
                $cs_counter_pricetables_node = 0;
                $cs_global_counter_pricetables = 0;
                $cs_shortcode_counter_pricetables = 0;
                $cs_counter_client = 0;
                $cs_counter_image = 0;
                $cs_counter_dropcap = 0;
                $cs_counter_divider = 0;
                $cs_counter_tooltip = 0;
                $cs_counter_piecharts = 0;
                $cs_global_counter_piecharts = 0;
                $cs_shortcode_counter_piecharts = 0;
                $cs_counter_progressbars = 0;
                $cs_counter_progressbars_node = 0;
                $cs_global_counter_progressbars = 0;
                $cs_shortcode_counter_progressbars = 0;
                $cs_counter_table = 0;
                $cs_global_counter_table = 0;
                $cs_shortcode_counter_table = 0;
                $cs_counter_message = 0;

                $cs_counter_button = 0;
                $cs_counter_call_to_action = 0;
                $cs_global_counter_call_to_action = 0;
                $cs_shortcode_counter_call_to_action = 0;
                $cs_counter_fancyheading = 0;
                $cs_counter_promobox = 0;
                $cs_counter_iconbox = 0;
                $cs_counter_audio = 0;
                $cs_counter_audio_node = 0;
                $cs_counter_infobox = 0;
                $cs_counter_infobox_node = 0;
                $counter_coutner = 0;
                $cs_global_counter_counter = 0;
                $cs_shortcode_counter_counter = 0;
                $counter_counter_item_node = 0;
                $cs_counter_icons = 0;
                $cs_counter_map = 0;
                $cs_parallax_slider = 0;
                $cs_parallax_video_url = 0;
                $cs_parallax_video_mute = 0;
                $cs_counter_offerslider = 0;

                $cs_counter_clients = 0;
                $cs_counter_clients_node = 0;

                $cs_counter_gallery = 0;
                $cs_counter_gallery_node = 0;

                $cs_counter_contentslider = 0;
                $cs_counter_page_element = 0;
                $cs_counter_members = 0;
                $cs_counter_spacer = 0;
                $cs_counter_teams = 0;
                $cs_counter_tweets = 0;
                $cs_counter_richeditor = 0;
                $cs_counter_apple = 0;
                $cs_global_counter_message = 0;
                $cs_shortcode_counter_message = 0;
                $cs_global_counter_button = 0;
                $cs_shortcode_counter_button = 0;
                $cs_global_counter_column = 0;
                $cs_shortcode_counter_column = 0;
                $cs_global_counter_contactus = 0;
                $cs_shortcode_counter_contactus = 0;
                $cs_global_counter_tooltip = 0;
                $cs_shortcode_counter_tooltip = 0;
                $cs_global_counter_tweets = 0;
                $cs_shortcode_counter_tweets = 0;
                $cs_global_counter_divider = 0;
                $cs_shortcode_counter_divider = 0;
                $cs_global_counter_slider = 0;
                $cs_shortcode_counter_slider = 0;
                $cs_global_counter_highlight = 0;
                $cs_shortcode_counter_highlight = 0;
                $cs_global_counter_register = 0;
                $cs_shortcode_counter_register = 0;
                $cs_global_counter_dropcap = 0;
                $cs_shortcode_counter_dropcap = 0;
                $cs_global_counter_list = 0;
                $cs_shortcode_counter_list = 0;
                $cs_global_counter_richeditor = 0;
                $cs_shortcode_counter_richeditor = 0;
                $cs_global_counter_blog_slider = 0;
                $cs_shortcode_counter_blog_slider = 0;
                $cs_global_counter_blog = 0;
                $cs_global_counter_sermon = 0;
                $cs_global_counter_latest_sermon = 0;
                $cs_shortcode_counter_blog = 0;
                $cs_shortcode_counter_sermon = 0;
                $cs_shortcode_counter_latest_sermon = 0;
                $cs_global_counter_teams = 0;
                $cs_shortcode_counter_teams = 0;
                $cs_global_counter_clients = 0;
                $cs_shortcode_counter_clients = 0;


                $cs_global_counter_page_element = 0;
                $cs_shortcode_counter_page_element = 0;
                $cs_global_counter_image = 0;
                $cs_shortcode_counter_image = 0;
                $cs_global_counter_promobox = 0;
                $cs_shortcode_counter_promobox = 0;
                $cs_global_counter_gallery = 0;
                $cs_shortcode_counter_gallery = 0;
                $cs_global_counter_register = 0;
                $cs_counter_register = 0;
                $cs_shortcode_counter_register = 0;
                $cs_global_counter_audio = 0;
                $cs_shortcode_counter_audio = 0;
                $cs_counter_offerslider_node = 0;
                $cs_global_counter_offerslider = 0;
                $cs_shortcode_counter_offerslider = 0;
                $cs_global_counter_spacer = 0;
                $cs_shortcode_counter_spacer = 0;
                $cs_global_counter_map = 0;
                $cs_shortcode_counter_map = 0;
                $cs_global_counter_icons = 0;
                $cs_shortcode_counter_icons = 0;
                $cs_global_counter_contentslider = 0;
                $cs_shortcode_counter_contentslider = 0;
                $cs_global_counter_members = 0;
                $cs_shortcode_counter_members = 0;
                $cs_global_counter_page_element = 0;
                $cs_shortcode_counter_page_element = 0;
                $cs_global_counter_infobox = 0;
                $cs_shortcode_counter_infobox = 0;
                $cs_shortcode_counter_slider = 0;
                $cs_global_counter_slider = 0;
                $counter_badges = 0;
                $cs_global_counter_badges = 0;
                $cs_shortcode_counter_badges = 0;
                $cs_counter_events = 0;
                $cs_global_counter_events = 0;
                $cs_shortcode_counter_events = 0;
                $cs_counter_candidate = 0;
                $cs_global_counter_candidate = 0;
                $cs_shortcode_counter_candidate = 0;
                $cs_counter_employer = 0;
                $cs_global_counter_employer = 0;
                $cs_shortcode_counter_employer = 0;
                $cs_counter_job = 0;
                $cs_global_counter_job = 0;
                $cs_shortcode_counter_job = 0;
                $cs_global_counter_directory = 0;
                $cs_shortcode_counter_directory = 0;
                $cs_counter_directory = 0;
                $cs_global_counter_directory_search = 0;
                $cs_shortcode_counter_directory_search = 0;
                $cs_counter_directory_search = 0;
                $cs_global_counter_directory_map = 0;
                $cs_shortcode_counter_directory_map = 0;
                $cs_counter_directory_map = 0;
                $cs_global_counter_latest_directory = 0;
                $cs_shortcode_counter_latest_directory = 0;
                $cs_counter_latest_directory = 0;
                $cs_global_counter_directory_pkg = 0;
                $cs_shortcode_counter_directory_pkg = 0;
                $cs_counter_directory_pkg = 0;
                $directory_categories = 0;
                $cs_global_counter_directory_categories = 0;
                $cs_shortcode_counter_directory_categories = 0;
                $cs_counter_directory_categories = 0;
                $cs_global_counter_project = 0;
                $cs_shortcode_counter_project = 0;
                $cs_counter_project = 0;

                $cs_counter_multi_counter = 0;
                $cs_global_counter_team_post = 0;
                $cs_shortcode_counter_team_post = 0;
                $cs_counter_team_post = 0;
                $cs_shortcode_counter_multi_counter = 0;
                $cs_global_counter_portfolio = 0;
                $cs_shortcode_counter_portfolio = 0;
                $cs_counter_portfolio = 0;


                $cs_global_counter_sitemap = 0;
                $cs_shortcode_counter_sitemap = 0;
                $cs_counter_sitemap = 0;

                $cs_shortcode_counter_icon_box = 0;
                $cs_global_counter_icon_box = 0;
                $cs_counter_icon_box = 0;
                $cs_counter_icon_box_node = 0;

                $cs_shortcode_counter_multiple_team = 0;
                $cs_global_counter_multiple_team = 0;
                $cs_counter_multiple_team = 0;
                $cs_counter_multiple_team_node = 0;

                $cs_shortcode_counter_facilities = 0;
                $cs_global_counter_facilities = 0;
                $cs_counter_facilities = 0;
                $cs_counter_facilities_node = 0;
                $cs_global_counter_multi_counter = 0;
                $cs_counter_quick_slider = 0;
                $cs_shortcode_counter_quick_slider = 0;
                $cs_global_counter_quick_slider = 0;
                $cs_counter_multi_counters = 0;
                $cs_counter_multi_counters_node = 0;
                $cs_shortcode_counter_multi_counters = 0;
                $cs_global_counter_multi_counters = 0;
                $cs_counter_multi_counters = 0;
                $cs_counter_multi_price_table = 0;
                $cs_counter_multi_price_table_node = 0;
                $cs_counter_multi_price_feature_node = 0;
                $cs_shortcode_counter_multi_price_table = 0;
                $cs_global_counter_multi_price_table = 0;
                $cs_counter_multi_price_table = 0;
                $cs_counter_cv_package = 0;
                $cs_shortcode_counter_cv_package = 0;
                $cs_global_counter_cv_package = 0;
                $cs_counter_job_package = 0;
                $cs_shortcode_counter_job_package = 0;
                $cs_global_counter_job_package = 0;
                $cs_counter_job_specialisms = 0;
                $cs_shortcode_counter_job_specialisms = 0;
                $cs_global_counter_job_specialisms = 0;
                $cs_counter_editor = 0;
                $cs_shortcode_counter_editor = 0;
                $cs_global_counter_editor = 0;
                $cs_counter_jobs_search = 0;
                $cs_shortcode_counter_jobs_search = 0;
                $cs_global_counter_jobs_search = 0;
                
                $cs_global_counter_job_post = 0;
                $cs_shortcode_counter_job_post = 0;
                $cs_counter_job_post = 0;
                
                $cs_counter_heading = 0;
                $cs_global_counter_heading = 0;
                $cs_shortcode_counter_heading = 0;
                $cs_global_counter_quote = 0;
                $cs_shortcode_counter_quote = 0;
                $counter_quote = 0;
                $cs_counter_newsletter = 0;
                $cs_global_counter_newsletter = 0;
                $cs_shortcode_counter_newsletter = 0;


                $cs_global_counter_quotes = 0;
                $cs_shortcode_counter_quotes = 0;
                $cs_counter_quotes = 0;

                $cs_global_counter_video = 0;
                $cs_shortcode_counter_video = 0;
                $counter_video = 0;

                $cs_global_counter_about = 0;
                $cs_shortcode_counter_about = 0;
                $counter_about = 0;

                if (isset($_POST['total_column'])) {
                    foreach ($_POST['total_column'] as $count_column) {
                        // Sections Element Attributes start
                        $column_container = $sxe->addChild('column_container');
                        if (empty($_POST['column_class'][$column_container_no])) {
                            $_POST['column_class'][$column_container_no] = "";
                        }
                        $column_container->addAttribute('class', $_POST['column_class'][$column_container_no]);
                        $column_rand_id = $_POST['column_rand_id'][$column_container_no];

                        //cs_section_background_option
                        if (empty($_POST['cs_section_background_option'][$column_container_no])) {
                            $_POST['cs_section_background_option'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_bg_image'][$column_container_no])) {
                            $_POST['cs_section_bg_image'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_bg_image_position'][$column_container_no])) {
                            $_POST['cs_section_bg_image_position'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_bg_image_repeat'][$column_container_no])) {
                            $_POST['cs_section_bg_image_repeat'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_slick_slider'][$column_container_no])) {
                            $_POST['cs_section_slick_slider'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_video_url'][$column_container_no])) {
                            $_POST['cs_section_video_url'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_video_mute'][$column_container_no])) {
                            $_POST['cs_section_video_mute'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_video_autoplay'][$column_container_no])) {
                            $_POST['cs_section_video_autoplay'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_bg_color'][$column_container_no])) {
                            $_POST['cs_section_bg_color'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_padding_top'][$column_container_no])) {
                            $_POST['cs_section_padding_top'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_padding_bottom'][$column_container_no])) {
                            $_POST['cs_section_padding_bottom'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_parallax'][$column_container_no])) {
                            $_POST['cs_section_parallax'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_css_id'][$column_container_no])) {
                            $_POST['cs_section_css_id'][$column_container_no] = "";
                        }
                        if (empty($_POST['cs_section_view'][$column_rand_id]['0'])) {
                            $_POST['cs_section_view'][$column_rand_id] = "";
                        }
                        if (empty($_POST['cs_layout'][$column_rand_id]['0'])) {
                            $_POST['cs_layout'][$column_rand_id]['0'] = "";
                        }

                        $column_container->addAttribute('cs_section_background_option', $_POST['cs_section_background_option'][$column_container_no]);
                        $column_container->addAttribute('cs_section_bg_image', $_POST['cs_section_bg_image'][$column_container_no]);
                        $column_container->addAttribute('cs_section_bg_image_position', $_POST['cs_section_bg_image_position'][$column_container_no]);
                        $column_container->addAttribute('cs_section_bg_image_repeat', $_POST['cs_section_bg_image_repeat'][$column_container_no]);
                        $column_container->addAttribute('cs_section_slick_slider', $_POST['cs_section_slick_slider'][$column_container_no]);
                        $column_container->addAttribute('cs_section_custom_slider', $_POST['cs_section_custom_slider'][$column_container_no]);
                        $column_container->addAttribute('cs_section_video_url', $_POST['cs_section_video_url'][$column_container_no]);
                        $column_container->addAttribute('cs_section_video_mute', $_POST['cs_section_video_mute'][$column_container_no]);
                        $column_container->addAttribute('cs_section_video_autoplay', $_POST['cs_section_video_autoplay'][$column_container_no]);
                        $column_container->addAttribute('cs_section_bg_color', $_POST['cs_section_bg_color'][$column_container_no]);
                        $column_container->addAttribute('cs_section_padding_top', $_POST['cs_section_padding_top'][$column_container_no]);
                        $column_container->addAttribute('cs_section_padding_bottom', $_POST['cs_section_padding_bottom'][$column_container_no]);
                        $column_container->addAttribute('cs_section_border_bottom', $_POST['cs_section_border_bottom'][$column_container_no]);
                        $column_container->addAttribute('cs_section_border_top', $_POST['cs_section_border_top'][$column_container_no]);
                        $column_container->addAttribute('cs_section_border_color', $_POST['cs_section_border_color'][$column_container_no]);
                        $column_container->addAttribute('cs_section_margin_top', $_POST['cs_section_margin_top'][$column_container_no]);
                        $column_container->addAttribute('cs_section_margin_bottom', $_POST['cs_section_margin_bottom'][$column_container_no]);
                        $column_container->addAttribute('cs_section_parallax', $_POST['cs_section_parallax'][$column_container_no]);
                        $column_container->addAttribute('cs_section_css_id', $_POST['cs_section_css_id'][$column_container_no]);
                        $column_container->addAttribute('cs_section_view', $_POST['cs_section_view'][$column_container_no]);
                        $column_container->addAttribute('cs_layout', $_POST['cs_layout'][$column_rand_id]['0']);
                        $column_container->addAttribute('cs_sidebar_left', $_POST['cs_sidebar_left'][$column_container_no]);
                        $column_container->addAttribute('cs_sidebar_right', $_POST['cs_sidebar_right'][$column_container_no]);
                        // Sections Element Attributes end
                        for ($i = 0; $i < $count_column; $i++) {
                            $column = $column_container->addChild('column');
                            $a = $_POST['total_widget'][$widget_no];
                            for ($j = 1; $j <= $a; $j++) {
                                $page_element_id++;
                                if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "flex_column") {
                                    $shortcode = '';
                                    $flex_column = $column->addChild('flex_column');
                                    $flex_column->addChild('page_element_size', htmlspecialchars($_POST['flex_column_element_size'][$cs_global_counter_column]));
                                    $flex_column->addChild('flex_column_element_size', htmlspecialchars($_POST['flex_column_element_size'][$cs_global_counter_column]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {

                                        $shortcode_str = stripslashes(htmlspecialchars(( $_POST['shortcode']['flex_column'][$cs_shortcode_counter_column]), ENT_QUOTES));
                                        $cs_shortcode_counter_column++;
                                        $flex_column->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode .= '[' . CS_SC_COLUMN . ' ';
                                        if (isset($_POST['flex_column_section_title'][$cs_counter_column]) && $_POST['flex_column_section_title'][$cs_counter_column] != '') {
                                            $shortcode .= 'flex_column_section_title="' . stripslashes(htmlspecialchars(($_POST['flex_column_section_title'][$cs_counter_column]), ENT_QUOTES)) . '" ';
                                        }

                                        if (isset($_POST['content_title_color'][$cs_counter_column]) && $_POST['content_title_color'][$cs_counter_column] != '') {
                                            $shortcode .= 'content_title_color="' . stripslashes(htmlspecialchars(($_POST['content_title_color'][$cs_counter_column]), ENT_QUOTES)) . '" ';
                                        }

                                        if (isset($_POST['column_bg_color'][$cs_counter_column]) && $_POST['column_bg_color'][$cs_counter_column] != '') {
                                            $shortcode .= 'column_bg_color="' . stripslashes(htmlspecialchars(($_POST['column_bg_color'][$cs_counter_column]), ENT_QUOTES)) . '" ';
                                        }

                                        if (isset($_POST['cs_column_margin_left'][$cs_counter_column]) && $_POST['cs_column_margin_left'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_margin_left="' . htmlspecialchars($_POST['cs_column_margin_left'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_column_margin_right'][$cs_counter_column]) && $_POST['cs_column_margin_right'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_margin_right="' . htmlspecialchars($_POST['cs_column_margin_right'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_column_top_padding'][$cs_counter_column]) && $_POST['cs_column_top_padding'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_top_padding="' . htmlspecialchars($_POST['cs_column_top_padding'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_column_bottom_padding'][$cs_counter_column]) && $_POST['cs_column_bottom_padding'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_bottom_padding="' . htmlspecialchars($_POST['cs_column_bottom_padding'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_column_left_padding'][$cs_counter_column]) && $_POST['cs_column_left_padding'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_left_padding="' . htmlspecialchars($_POST['cs_column_left_padding'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_column_right_padding'][$cs_counter_column]) && $_POST['cs_column_right_padding'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_right_padding="' . htmlspecialchars($_POST['cs_column_right_padding'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }


                                        if (isset($_POST['cs_column_image_url'][$cs_counter_column]) && $_POST['cs_column_image_url'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_image_url="' . htmlspecialchars($_POST['cs_column_image_url'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_column_class'][$cs_counter_column]) && $_POST['cs_column_class'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_class="' . htmlspecialchars($_POST['cs_column_class'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_column_animation'][$cs_counter_column]) && $_POST['cs_column_animation'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_column_animation="' . htmlspecialchars($_POST['cs_column_animation'][$cs_counter_column]) . '" ';
                                        }
                                        $shortcode .=']';
                                        if (isset($_POST['flex_column_text'][$cs_counter_column]) && $_POST['flex_column_text'][$cs_counter_column] != '') {
                                            $shortcode .= esc_textarea(jobcareer_custom_shortcode_encode($_POST['flex_column_text'][$cs_counter_column])) . ' ';
                                        }

                                        $shortcode .= '[/' . CS_SC_COLUMN . ']';
                                        //var_dump($shortcode); die;
                                        $flex_column->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_column++;
                                    }
                                    $cs_global_counter_column++;
                                } else if ($_POST['cs_orderby'][$cs_counter] == "flex_editor") {

                                    $shortcode = '';
                                    $flex_editor = $column->addChild('flex_editor');
                                    $flex_editor->addChild('page_element_size', htmlspecialchars($_POST['flex_editor_element_size'][$cs_global_counter_editor]));
                                    $flex_editor->addChild('flex_editor_element_size', htmlspecialchars($_POST['flex_editor_element_size'][$cs_global_counter_editor]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {

                                        $shortcode_str = stripslashes(htmlspecialchars(( $_POST['shortcode']['flex_editor'][$cs_shortcode_counter_editor]), ENT_QUOTES));
                                        $cs_shortcode_counter_editor++;
                                        $flex_editor->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode .= '[' . CS_SC_EDITOR . ' ';

                                        if (isset($_POST['cs_flex_editor_class'][$cs_counter_editor]) && $_POST['cs_flex_editor_class'][$cs_counter_editor] != '') {
                                            $shortcode .= 'cs_flex_editor_class="' . htmlspecialchars($_POST['cs_flex_editor_class'][$cs_counter_editor], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_editor_content_title'][$cs_counter_editor]) && $_POST['cs_editor_content_title'][$cs_counter_editor] != '') {
                                            $shortcode .= 'cs_editor_content_title="' . stripslashes(htmlspecialchars(($_POST['cs_editor_content_title'][$cs_counter_editor]), ENT_QUOTES)) . '" ';
                                        }

                                        $shortcode .= ']';
                                        if (isset($_POST['flex_editor_text'][$cs_counter_editor]) && $_POST['flex_editor_text'][$cs_counter_editor] != '') {
                                            $shortcode .= htmlspecialchars(jobcareer_custom_shortcode_encode($_POST['flex_editor_text'][$cs_counter_editor], ENT_QUOTES)) . ' ';
                                        }

                                        $shortcode .= '[/' . CS_SC_EDITOR . ']';
                                        //var_dump($shortcode); die;
                                        $flex_editor->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_editor++;
                                    }

                                    //echo '<pre>';
                                    //print_r($_POST);
                                    //echo '</pre>';exit;
                                    $cs_global_counter_editor++;
                                }
                                // Save Form page element 
                                else if ($_POST['cs_orderby'][$cs_counter] == "contactform") {
                                    $shortcode = '';
                                    $contact_us = $column->addChild('contactform');
                                    $contact_us->addChild('page_element_size', htmlspecialchars($_POST['contactform_element_size'][$cs_global_counter_contactus]));
                                    $contact_us->addChild('contactform_element_size', htmlspecialchars($_POST['contactform_element_size'][$cs_global_counter_contactus]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['contactform'][$cs_shortcode_counter_contactus]);
                                        $cs_shortcode_counter_contactus++;
                                        $contact_us->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_CONTACTUS . ' ';
                                        if (isset($_POST['cs_contactform_section_title'][$cs_counter_contactus]) && $_POST['cs_contactform_section_title'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_contactform_section_title="' . htmlspecialchars($_POST['cs_contactform_section_title'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_contactform_label'][$cs_counter_contactus]) && $_POST['cs_contactform_label'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_contactform_label="' . htmlspecialchars($_POST['cs_contactform_label'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_contactform_view'][$cs_counter_contactus]) && $_POST['cs_contactform_view'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_contactform_view="' . htmlspecialchars($_POST['cs_contactform_view'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_contactform_send'][$cs_counter_contactus]) && $_POST['cs_contactform_send'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_contactform_send="' . htmlspecialchars($_POST['cs_contactform_send'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_success'][$cs_counter_contactus]) && $_POST['cs_success'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_success="' . htmlspecialchars($_POST['cs_success'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_error'][$cs_counter_contactus]) && $_POST['cs_error'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_error="' . htmlspecialchars($_POST['cs_error'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_form_id'][$cs_counter_contactus]) && $_POST['cs_form_id'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_form_id="' . htmlspecialchars($_POST['cs_form_id'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_contact_class'][$cs_counter_contactus]) && $_POST['cs_contact_class'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_contact_class="' . htmlspecialchars($_POST['cs_contact_class'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_contact_animation'][$cs_counter_contactus]) && $_POST['cs_contact_animation'][$cs_counter_contactus] != '') {
                                            $shortcode .= 'cs_contact_animation="' . htmlspecialchars($_POST['cs_contact_animation'][$cs_counter_contactus], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode .= ']';

                                        $contact_us->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_contactus++;
                                    }
                                    $cs_global_counter_contactus++;
                                } else if ($_POST['cs_orderby'][$cs_counter] == "quick_slider") {
                                    $shortcode = '';
                                    $contact_us = $column->addChild('quick_slider');
                                    $contact_us->addChild('page_element_size', htmlspecialchars($_POST['quick_slider_element_size'][$cs_global_counter_quick_slider]));
                                    $contact_us->addChild('quick_slider_element_size', htmlspecialchars($_POST['quick_slider_element_size'][$cs_global_counter_quick_slider]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['quick_slider'][$cs_shortcode_counter_quick_slider]);
                                        $cs_shortcode_counter_quick_slider++;
                                        $contact_us->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_QUICK_QUOTE . ' ';
                                        if (isset($_POST['cs_quick_slider_section_title'][$cs_counter_quick_slider]) && $_POST['cs_quick_slider_section_title'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_quick_slider_section_title="' . htmlspecialchars($_POST['cs_quick_slider_section_title'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_quick_slider_view'][$cs_counter_quick_slider]) && $_POST['cs_quick_slider_view'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_quick_slider_view="' . htmlspecialchars($_POST['cs_quick_slider_view'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_quick_slider_send'][$cs_counter_quick_slider]) && $_POST['cs_quick_slider_send'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_quick_slider_send="' . htmlspecialchars($_POST['cs_quick_slider_send'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_success'][$cs_counter_quick_slider]) && $_POST['cs_success'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_success="' . htmlspecialchars($_POST['cs_success'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_error'][$cs_counter_quick_slider]) && $_POST['cs_error'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_error="' . htmlspecialchars($_POST['cs_error'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_quick_slider_text_color'][$cs_counter_quick_slider]) && $_POST['cs_quick_slider_text_color'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_quick_slider_text_color="' . htmlspecialchars($_POST['cs_quick_slider_text_color'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_quick_slider_bg_color'][$cs_counter_quick_slider]) && $_POST['cs_quick_slider_bg_color'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= 'cs_quick_slider_bg_color="' . htmlspecialchars($_POST['cs_quick_slider_bg_color'][$cs_counter_quick_slider], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode .= ']';
                                        if (isset($_POST['cs_quick_slider_text'][$cs_counter_quick_slider]) && $_POST['cs_quick_slider_text'][$cs_counter_quick_slider] != '') {
                                            $shortcode .= esc_textarea($_POST['cs_quick_slider_text'][$cs_counter_quick_slider]) . ' ';
                                        }

                                        $shortcode .= '[/' . CS_SC_QUICK_QUOTE . ']';
                                        $contact_us->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_quick_slider++;
                                    }
                                    $cs_global_counter_quick_slider++;
                                }

                                /* Call to action */ else if ($_POST['cs_orderby'][$cs_counter] == "call_to_action") {
                                    $shortcode = '';
                                    $call_to_action = $column->addChild('call_to_action');
                                    $call_to_action->addChild('page_element_size', htmlspecialchars($_POST['call_to_action_element_size'][$cs_global_counter_call_to_action]));
                                    $call_to_action->addChild('call_to_action_element_size', htmlspecialchars($_POST['call_to_action_element_size'][$cs_global_counter_call_to_action]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = htmlspecialchars(stripslashes($_POST['shortcode']['call_to_action'][$cs_shortcode_counter_call_to_action]));
                                        $cs_shortcode_counter_call_to_action++;
                                        $call_to_action->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {

                                        $shortcode .= '[' . CS_SC_CALLTOACTION . ' ';

                                        if (isset($_POST['cs_call_to_action_section_title'][$cs_counter_call_to_action]) && $_POST['cs_call_to_action_section_title'][$cs_counter_call_to_action] != '') {
                                            $shortcode .= ' cs_call_to_action_section_title="' . htmlspecialchars($_POST['cs_call_to_action_section_title'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_content_type'][$cs_counter_call_to_action]) && trim($_POST['cs_content_type'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_content_type="' . htmlspecialchars($_POST['cs_content_type'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_call_action_title'][$cs_counter_call_to_action]) && trim($_POST['cs_call_action_title'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_call_action_title="' . htmlspecialchars($_POST['cs_call_action_title'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_contents_color'][$cs_counter_call_to_action]) && trim($_POST['cs_contents_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_contents_color="' . htmlspecialchars($_POST['cs_contents_color'][$cs_counter_call_to_action]) . '" ';
                                        }

                                        if (isset($_POST['cs_title_color'][$cs_counter_call_to_action]) && trim($_POST['cs_title_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_title_color="' . htmlspecialchars($_POST['cs_title_color'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_contents_color'][$cs_counter_call_to_action]) && trim($_POST['cs_contents_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_contents_color="' . htmlspecialchars($_POST['cs_contents_color'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_call_action_icon'][$cs_counter_call_to_action]) && trim($_POST['cs_call_action_icon'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_call_action_icon="' . htmlspecialchars($_POST['cs_call_action_icon'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_icon_color'][$cs_counter_call_to_action]) && trim($_POST['cs_icon_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_icon_color="' . htmlspecialchars($_POST['cs_icon_color'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_call_to_action_icon_background_color'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_icon_background_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_call_to_action_icon_background_color="' . htmlspecialchars($_POST['cs_call_to_action_icon_background_color'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_call_to_action_icon_text_color'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_icon_text_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_call_to_action_icon_text_color="' . htmlspecialchars($_POST['cs_call_to_action_icon_text_color'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_show_button'][$cs_counter_call_to_action]) && trim($_POST['cs_show_button'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_show_button="' . htmlspecialchars($_POST['cs_show_button'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_call_to_action_button_text'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_button_text'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_call_to_action_button_text="' . htmlspecialchars($_POST['cs_call_to_action_button_text'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_call_to_action'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_call_to_action="' . htmlspecialchars($_POST['cs_call_to_action'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_call_to_action_button_link'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_button_link'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .='cs_call_to_action_button_link="' . htmlspecialchars($_POST['cs_call_to_action_button_link'][$cs_counter_call_to_action]) . '" ';
                                        }

                                        /* if (isset($_POST['cs_call_to_action_bg_img'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_bg_img'][$cs_counter_call_to_action]) <> '') {
                                          $shortcode .= 'cs_call_to_action_bg_img="' . htmlspecialchars($_POST['cs_call_to_action_bg_img'][$cs_counter_call_to_action]) . '" ';
                                          } */


                                        if (isset($_POST['cs_call_to_action_img'][$cs_counter_call_to_action]) && trim($_POST['cs_call_to_action_img'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_call_to_action_img="' . htmlspecialchars($_POST['cs_call_to_action_img'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        if (isset($_POST['cs_contents_bg_color'][$cs_counter_call_to_action]) && trim($_POST['cs_contents_bg_color'][$cs_counter_call_to_action]) <> '') {
                                            $shortcode .= 'cs_contents_bg_color="' . htmlspecialchars($_POST['cs_contents_bg_color'][$cs_counter_call_to_action]) . '" ';
                                        }

                                        if (isset($_POST['cs_call_to_action_class'][$cs_counter_call_to_action]) && $_POST['cs_call_to_action_class'][$cs_counter_call_to_action] != '') {
                                            $shortcode .= 'cs_call_to_action_class="' . htmlspecialchars($_POST['cs_call_to_action_class'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_call_action_text_align'][$cs_counter_call_to_action]) && $_POST['cs_call_action_text_align'][$cs_counter_call_to_action] != '') {
                                            $shortcode .= 'cs_call_action_text_align="' . htmlspecialchars($_POST['cs_call_action_text_align'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_call_action_view'][$cs_counter_call_to_action]) && $_POST['cs_call_action_view'][$cs_counter_call_to_action] != '') {
                                            $shortcode .= 'cs_call_action_view="' . htmlspecialchars($_POST['cs_call_action_view'][$cs_counter_call_to_action], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_call_to_action_animation'][$cs_counter_call_to_action]) && $_POST['cs_call_to_action_animation'][$cs_counter_call_to_action] != '') {
                                            $shortcode .='cs_call_to_action_animation="' . htmlspecialchars($_POST['cs_call_to_action_animation'][$cs_counter_call_to_action]) . '" ';
                                        }
                                        $shortcode .=']';
                                        if (isset($_POST['cs_call_action_contents'][$cs_counter_call_to_action]) && $_POST['cs_call_action_contents'][$cs_counter_call_to_action] != '') {
                                            $shortcode .= htmlspecialchars($_POST['cs_call_action_contents'][$cs_counter_call_to_action], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_CALLTOACTION . ']';

                                        $call_to_action->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_call_to_action++;
                                    }
                                    $cs_global_counter_call_to_action++;
                                }
                                // Save heading page element 
                                else if ($_POST['cs_orderby'][$cs_counter] == "heading") {
                                    $shortcode = '';
                                    $heading = $column->addChild('heading');
                                    $heading->addChild('page_element_size', htmlspecialchars($_POST['heading_element_size'][$cs_global_counter_heading]));
                                    $heading->addChild('heading_element_size', htmlspecialchars($_POST['heading_element_size'][$cs_global_counter_heading]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['heading'][$cs_shortcode_counter_heading]);
                                        $cs_shortcode_counter_heading++;
                                        $heading->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_HEADING . ' ';
                                        if (isset($_POST['heading_title'][$cs_counter_heading]) && $_POST['heading_title'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_title="' . htmlspecialchars($_POST['heading_title'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['sub_heading_title'][$cs_counter_heading]) && $_POST['sub_heading_title'][$cs_counter_heading] != '') {
                                            $shortcode .= 'sub_heading_title="' . htmlspecialchars($_POST['sub_heading_title'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['heading_style'][$cs_counter_heading]) && $_POST['heading_style'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_style="' . htmlspecialchars($_POST['heading_style'][$cs_counter_heading]) . '" ';
                                        }
                                        if (isset($_POST['heading_size'][$cs_counter_heading]) && $_POST['heading_size'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_size="' . htmlspecialchars($_POST['heading_size'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['letter_space'][$cs_counter_heading]) && $_POST['letter_space'][$cs_counter_heading] != '') {
                                            $shortcode .= 'letter_space="' . htmlspecialchars($_POST['letter_space'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['line_height'][$cs_counter_heading]) && $_POST['line_height'][$cs_counter_heading] != '') {
                                            $shortcode .= 'line_height="' . htmlspecialchars($_POST['line_height'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['heading_align'][$cs_counter_heading]) && $_POST['heading_align'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_align="' . htmlspecialchars($_POST['heading_align'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['heading_font_style'][$cs_counter_heading]) && $_POST['heading_font_style'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_font_style="' . htmlspecialchars($_POST['heading_font_style'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['heading_divider'][$cs_counter_heading]) && $_POST['heading_divider'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_divider="' . htmlspecialchars($_POST['heading_divider'][$cs_counter_heading]) . '" ';
                                        }
                                        if (isset($_POST['heading_color'][$cs_counter_heading]) && $_POST['heading_color'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_color="' . htmlspecialchars($_POST['heading_color'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['color_title'][$cs_counter_heading]) && $_POST['color_title'][$cs_counter_heading] != '') {
                                            $shortcode .= 'color_title="' . htmlspecialchars($_POST['color_title'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['color_title_color'][$cs_counter_heading]) && $_POST['color_title_color'][$cs_counter_heading] != '') {
                                            $shortcode .= 'color_title_color="' . htmlspecialchars($_POST['color_title_color'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['heading_content_color'][$cs_counter_heading]) && $_POST['heading_content_color'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_content_color="' . htmlspecialchars($_POST['heading_content_color'][$cs_counter_heading], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['heading_animation'][$cs_counter_heading]) && $_POST['heading_animation'][$cs_counter_heading] != '') {
                                            $shortcode .= 'heading_animation="' . htmlspecialchars($_POST['heading_animation'][$cs_counter_heading]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        if (isset($_POST['heading_content'][$cs_counter_heading]) && $_POST['heading_content'][$cs_counter_heading] != '') {
                                            $shortcode .= htmlspecialchars($_POST['heading_content'][$cs_counter_heading], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_HEADING . ']';
                                        $heading->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_heading++;
                                    }
                                    $cs_global_counter_heading++;
                                } else if ($_POST['cs_orderby'][$cs_counter] == "newsletter") {
                                    $shortcode = '';
                                    $newsletter = $column->addChild('newsletter');
                                    $newsletter->addChild('page_element_size', htmlspecialchars($_POST['newsletter_element_size'][$cs_global_counter_newsletter]));
                                    $newsletter->addChild('newsletter_element_size', htmlspecialchars($_POST['newsletter_element_size'][$cs_global_counter_newsletter]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['newsletter'][$cs_shortcode_counter_newsletter]);
                                        $cs_shortcode_counter_newsletter++;
                                        $newsletter->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_NEWSLETTER . ' ';
                                        if (isset($_POST['newsletter_title'][$cs_counter_newsletter]) && $_POST['newsletter_title'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_title="' . htmlspecialchars($_POST['newsletter_title'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['sub_newsletter_title'][$cs_counter_newsletter]) && $_POST['sub_newsletter_title'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'sub_newsletter_title="' . htmlspecialchars($_POST['sub_newsletter_title'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['newsletter_style'][$cs_counter_newsletter]) && $_POST['newsletter_style'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_style="' . htmlspecialchars($_POST['newsletter_style'][$cs_counter_newsletter]) . '" ';
                                        }
                                        if (isset($_POST['newsletter_size'][$cs_counter_newsletter]) && $_POST['newsletter_size'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_size="' . htmlspecialchars($_POST['newsletter_size'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['newsletter_align'][$cs_counter_newsletter]) && $_POST['newsletter_align'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_align="' . htmlspecialchars($_POST['newsletter_align'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['newsletter_font_style'][$cs_counter_newsletter]) && $_POST['newsletter_font_style'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_font_style="' . htmlspecialchars($_POST['newsletter_font_style'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['newsletter_divider'][$cs_counter_newsletter]) && $_POST['newsletter_divider'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_divider="' . htmlspecialchars($_POST['newsletter_divider'][$cs_counter_newsletter]) . '" ';
                                        }
                                        if (isset($_POST['newsletter_color'][$cs_counter_newsletter]) && $_POST['newsletter_color'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_color="' . htmlspecialchars($_POST['newsletter_color'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['color_title'][$cs_counter_newsletter]) && $_POST['color_title'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'color_title="' . htmlspecialchars($_POST['color_title'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['newsletter_content_color'][$cs_counter_newsletter]) && $_POST['newsletter_content_color'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_content_color="' . htmlspecialchars($_POST['newsletter_content_color'][$cs_counter_newsletter], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['newsletter_animation'][$cs_counter_newsletter]) && $_POST['newsletter_animation'][$cs_counter_newsletter] != '') {
                                            $shortcode .= 'newsletter_animation="' . htmlspecialchars($_POST['newsletter_animation'][$cs_counter_newsletter]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        if (isset($_POST['newsletter_content'][$cs_counter_newsletter]) && $_POST['newsletter_content'][$cs_counter_newsletter] != '') {
                                            $shortcode .= htmlspecialchars($_POST['newsletter_content'][$cs_counter_newsletter], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_NEWSLETTER . ']';
                                        $newsletter->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_newsletter++;
                                    }
                                    $cs_global_counter_newsletter++;
                                }
                                // Save divider page element 
                                else if ($_POST['cs_orderby'][$cs_counter] == "quotes") {

                                    $shortcode = '';
                                    $quotes = $column->addChild('quotes');
                                    $quotes->addChild('page_element_size', htmlspecialchars($_POST['quotes_element_size'][$cs_global_counter_quotes]));
                                    $quotes->addChild('quotes_element_size', htmlspecialchars($_POST['quotes_element_size'][$cs_global_counter_quotes]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['quotes'][$cs_shortcode_counter_quotes]);
                                        $cs_shortcode_counter_quotes++;
                                        $quotes->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[cs_quotes ';
                                        if (isset($_POST['quote_style'][$cs_counter_quotes]) && $_POST['quote_style'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'quote_style="' . htmlspecialchars($_POST['quote_style'][$cs_counter_quotes], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_quote_section_title'][$cs_counter_quotes]) && $_POST['cs_quote_section_title'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'cs_quote_section_title="' . htmlspecialchars($_POST['cs_quote_section_title'][$cs_counter_quotes], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['quotes_style'][$cs_counter_quotes]) && $_POST['quotes_style'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'quotes_style="' . htmlspecialchars($_POST['quotes_style'][$cs_counter_quotes]) . '" ';
                                        }
                                        if (isset($_POST['quote_cite'][$cs_counter_quotes]) && $_POST['quote_cite'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'quote_cite="' . htmlspecialchars($_POST['quote_cite'][$cs_counter_quotes], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['quote_cite_url'][$cs_counter_quotes]) && $_POST['quote_cite_url'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'quote_cite_url="' . htmlspecialchars($_POST['quote_cite_url'][$cs_counter_quotes], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['quote_text_color'][$cs_counter_quotes]) && $_POST['quote_text_color'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'quote_text_color="' . htmlspecialchars($_POST['quote_text_color'][$cs_counter_quotes], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['quote_align'][$cs_counter_quotes]) && $_POST['quote_align'][$cs_counter_quotes] != '') {
                                            $shortcode .= 'quote_align="' . htmlspecialchars($_POST['quote_align'][$cs_counter_quotes]) . '" ';
                                        }


                                        $shortcode .= ']';
                                        if (isset($_POST['cs_quote_content'][$cs_counter_quotes]) && $_POST['cs_quote_content'][$cs_counter_quotes] != '') {
                                            $shortcode .= htmlspecialchars($_POST['cs_quote_content'][$cs_counter_quotes]);
                                        }
                                        $shortcode .= '[/cs_quotes]';

                                        //echo $shortcode; exit;
                                        $quotes->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_quotes++;
                                    }
                                    $cs_global_counter_quotes++;
                                } else if ($_POST['cs_orderby'][$cs_counter] == "divider") {
                                    $shortcode = '';
                                    $divider = $column->addChild('divider');
                                    $divider->addChild('page_element_size', htmlspecialchars($_POST['divider_element_size'][$cs_global_counter_divider]));
                                    $divider->addChild('divider_element_size', htmlspecialchars($_POST['divider_element_size'][$cs_global_counter_divider]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['divider'][$cs_shortcode_counter_divider]);
                                        $cs_shortcode_counter_divider++;
                                        $divider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_DIVIDER . ' ';
                                        if (isset($_POST['divider_style'][$cs_counter_divider]) && $_POST['divider_style'][$cs_counter_divider] != '') {
                                            $shortcode .= 'divider_style="' . htmlspecialchars($_POST['divider_style'][$cs_counter_divider]) . '" ';
                                        }
                                        if (isset($_POST['divider_backtotop'][$cs_counter_divider]) && $_POST['divider_backtotop'][$cs_counter_divider] != '') {
                                            $shortcode .= 'divider_backtotop="' . htmlspecialchars($_POST['divider_backtotop'][$cs_counter_divider]) . '" ';
                                        }
                                        if (isset($_POST['divider_margin_top'][$cs_counter_divider]) && $_POST['divider_margin_top'][$cs_counter_divider] != '') {
                                            $shortcode .= 'divider_margin_top="' . htmlspecialchars($_POST['divider_margin_top'][$cs_counter_divider]) . '" ';
                                        }
                                        if (isset($_POST['divider_margin_bottom'][$cs_counter_divider]) && $_POST['divider_margin_bottom'][$cs_counter_divider] != '') {
                                            $shortcode .= 'divider_margin_bottom="' . htmlspecialchars($_POST['divider_margin_bottom'][$cs_counter_divider]) . '" ';
                                        }
                                        if (isset($_POST['divider_height'][$cs_counter_divider]) && $_POST['divider_height'][$cs_counter_divider] != '') {
                                            $shortcode .= 'divider_height="' . htmlspecialchars($_POST['divider_height'][$cs_counter_divider]) . '" ';
                                        }
                                        if (isset($_POST['cs_divider_class'][$cs_counter_divider]) && $_POST['cs_divider_class'][$cs_counter_divider] != '') {
                                            $shortcode .= 'cs_divider_class="' . htmlspecialchars($_POST['cs_divider_class'][$cs_counter_divider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_divider_animation'][$cs_counter_divider]) && $_POST['cs_divider_animation'][$cs_counter_divider] != '') {
                                            $shortcode .= 'cs_divider_animation="' . htmlspecialchars($_POST['cs_divider_animation'][$cs_counter_divider]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $divider->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_divider++;
                                    }
                                    $cs_global_counter_divider++;
                                }// Save divider page element 
                                else if ($_POST['cs_orderby'][$cs_counter] == "spacer") {
                                    $shortcode = '';
                                    $spacer = $column->addChild('spacer');
                                    $spacer->addChild('page_element_size', htmlspecialchars($_POST['spacer_element_size'][$cs_global_counter_spacer]));
                                    $spacer->addChild('spacer_element_size', htmlspecialchars($_POST['spacer_element_size'][$cs_global_counter_spacer]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['spacer'][$cs_shortcode_counter_spacer]);
                                        $cs_shortcode_counter_spacer++;
                                        $spacer->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {

                                        $shortcode .= '[' . CS_SC_SPACER . ' ';
                                        if (isset($_POST['cs_spacer_height'][$cs_counter_spacer]) && $_POST['cs_spacer_height'][$cs_counter_spacer] != '') {
                                            $shortcode .= 'cs_spacer_height="' . htmlspecialchars($_POST['cs_spacer_height'][$cs_counter_spacer]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $spacer->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_spacer++;
                                    }
                                    $cs_global_counter_spacer++;
                                } else if ($_POST['cs_orderby'][$cs_counter] == "sitemap") {
                                    $shortcode = '';
                                    $sitemap = $column->addChild('sitemap');
                                    $sitemap->addChild('page_element_size', '100');
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['sitemap'][$cs_shortcode_counter_spacer]);
                                        $cs_shortcode_counter_sitemap++;
                                        $sitemap->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[' . CS_SC_SITEMAP . ' ';
                                        if (isset($_POST['cs_sitemap_section_title'][$cs_counter_sitemap]) && $_POST['cs_sitemap_section_title'][$cs_counter_sitemap] != '') {
                                            $shortcode .= 'cs_sitemap_section_title="' . htmlspecialchars($_POST['cs_sitemap_section_title'][$cs_counter_sitemap]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $sitemap->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_sitemap++;
                                    }
                                    $cs_global_counter_sitemap++;
                                }


                                // Save testimonials page element 
                                else if ($_POST['cs_orderby'][$cs_counter] == "testimonials") {
                                    $shortcode = $shortcode_item = '';
                                    $testimonials = $column->addChild('testimonials');
                                    $testimonials->addChild('page_element_size', htmlspecialchars($_POST['testimonials_element_size'][$cs_global_counter_testimonials]));
                                    $testimonials->addChild('testimonials_element_size', htmlspecialchars($_POST['testimonials_element_size'][$cs_global_counter_testimonials]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['testimonials'][$cs_shortcode_counter_testimonial]);
                                        $cs_shortcode_counter_testimonial++;
                                        $testimonials->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['testimonials_num'][$cs_counter_testimonials]) && $_POST['testimonials_num'][$cs_counter_testimonials] > 0) {
                                            for ($i = 1; $i <= $_POST['testimonials_num'][$cs_counter_testimonials]; $i++) {
                                                $shortcode_item .= '[testimonial_item ';

                                                if (isset($_POST['testimonial_company'][$cs_counter_testimonials_node]) && $_POST['testimonial_company'][$cs_counter_testimonials_node] != '') {
                                                    $shortcode_item .= 'testimonial_company="' . htmlspecialchars($_POST['testimonial_company'][$cs_counter_testimonials_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['testimonial_img_user'][$cs_counter_testimonials_node]) && $_POST['testimonial_img_user'][$cs_counter_testimonials_node] != '') {
                                                    $shortcode_item .= 'testimonial_img_user="' . htmlspecialchars($_POST['testimonial_img_user'][$cs_counter_testimonials_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['testimonial_author'][$cs_counter_testimonials_node]) && $_POST['testimonial_author'][$cs_counter_testimonials_node] != '') {
                                                    $shortcode_item .= 'testimonial_author="' . htmlspecialchars($_POST['testimonial_author'][$cs_counter_testimonials_node], ENT_QUOTES) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['testimonial_text'][$cs_counter_testimonials_node]) && $_POST['testimonial_text'][$cs_counter_testimonials_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['testimonial_text'][$cs_counter_testimonials_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/testimonial_item]';
                                                $cs_counter_testimonials_node++;
                                            }
                                        }
                                        $section_title = '';
                                        if (isset($_POST['cs_testimonial_section_title'][$cs_counter_testimonials]) && $_POST['cs_testimonial_section_title'][$cs_counter_testimonials] != '') {
                                            $section_title .= 'cs_testimonial_section_title="' . htmlspecialchars($_POST['cs_testimonial_section_title'][$cs_counter_testimonials], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['testimonial_style'][$cs_counter_testimonials]) && $_POST['testimonial_style'][$cs_counter_testimonials] != '') {
                                            $section_title .= 'testimonial_style="' . htmlspecialchars($_POST['testimonial_style'][$cs_counter_testimonials], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['testimonial_text_color'][$cs_counter_testimonials]) && $_POST['testimonial_text_color'][$cs_counter_testimonials] != '') {
                                            $section_title .= 'testimonial_text_color="' . htmlspecialchars($_POST['testimonial_text_color'][$cs_counter_testimonials], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['testimonial_author_color'][$cs_counter_testimonials]) && $_POST['testimonial_author_color'][$cs_counter_testimonials] != '') {
                                            $section_title .= 'testimonial_author_color="' . htmlspecialchars($_POST['testimonial_author_color'][$cs_counter_testimonials], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['testimonial_comp_color'][$cs_counter_testimonials]) && $_POST['testimonial_comp_color'][$cs_counter_testimonials] != '') {
                                            $section_title .= 'testimonial_comp_color="' . htmlspecialchars($_POST['testimonial_comp_color'][$cs_counter_testimonials], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['testimonial_border'][$cs_counter_testimonials]) && $_POST['testimonial_border'][$cs_counter_testimonials] != '') {
                                            $section_title .= 'testimonial_border="' . htmlspecialchars($_POST['testimonial_border'][$cs_counter_testimonials], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode = '[cs_testimonials ' . $section_title . ' ]' . $shortcode_item . '[/cs_testimonials]';
                                        $testimonials->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_testimonials++;
                                    }
                                    $cs_global_counter_testimonials++;
                                }                           // Save Multi Price table
                                else if ($_POST['cs_orderby'][$cs_counter] == "multi_price_table") {
                                    $shortcode = $price_item = $shortcode_item = '';
                                    $multi_price_table = $column->addChild('multi_price_table');
                                    $multi_price_table->addChild('page_element_size', htmlspecialchars($_POST['multi_price_table_element_size'][$cs_global_counter_multi_price_table]));
                                    $multi_price_table->addChild('multi_price_table_element_size', htmlspecialchars($_POST['multi_price_table_element_size'][$cs_global_counter_multi_price_table]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['multi_price_table'][$cs_shortcode_counter_multi_price_table]);
                                        $cs_shortcode_counter_multi_price_table++;
                                        $multi_price_table->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['multi_price_table_num'][$cs_counter_multi_price_table]) && $_POST['multi_price_table_num'][$cs_counter_multi_price_table] > 0) {

                                            for ($i = 1; $i <= $_POST['multi_price_table_num'][$cs_counter_multi_price_table]; $i++) {


                                                $shortcode_item .= '[multi_price_table_item ';

                                                if (isset($_POST['multi_price_table_text'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_text'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_text="' . htmlspecialchars($_POST['multi_price_table_text'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_title_color'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_title_color'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_title_color="' . htmlspecialchars($_POST['multi_price_table_title_color'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_company'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_company'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_company="' . htmlspecialchars($_POST['multi_price_table_company'][$cs_counter_multi_price_table], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_img'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_img'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_img="' . htmlspecialchars($_POST['multi_price_table_img'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_currency'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_currency'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_currency="' . htmlspecialchars($_POST['multi_price_table_currency'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_time_duration'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_time_duration'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_time_duration="' . htmlspecialchars($_POST['multi_price_table_time_duration'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_button_text'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_button_text'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_button_text="' . htmlspecialchars($_POST['multi_price_table_button_text'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }


                                                if (isset($_POST['multi_price_table_custom_id'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_custom_id'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_custom_id="' . htmlspecialchars($_POST['multi_price_table_custom_id'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_button_color'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_button_color'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_button_color="' . htmlspecialchars($_POST['multi_price_table_button_color'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_button_color_bg'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_button_color_bg'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_button_color_bg="' . htmlspecialchars($_POST['multi_price_table_button_color_bg'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_button_column_color'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_button_column_color'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_button_column_color="' . htmlspecialchars($_POST['multi_price_table_button_column_color'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_price_table_column_bgcolor'][$cs_counter_multi_price_table_node]) && $_POST['multi_price_table_column_bgcolor'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_price_table_column_bgcolor="' . htmlspecialchars($_POST['multi_price_table_column_bgcolor'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['pricetable_featured'][$cs_counter_multi_price_table_node]) && $_POST['pricetable_featured'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'pricetable_featured="' . htmlspecialchars($_POST['pricetable_featured'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['multi_pricetable_price'][$cs_counter_multi_price_table_node]) && $_POST['multi_pricetable_price'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'multi_pricetable_price="' . htmlspecialchars($_POST['multi_pricetable_price'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['pricing_detail'][$cs_counter_multi_price_table_node]) && $_POST['pricing_detail'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'pricing_detail="' . htmlspecialchars($_POST['pricing_detail'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['button_link'][$cs_counter_multi_price_table_node]) && $_POST['button_link'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= 'button_link="' . htmlspecialchars($_POST['button_link'][$cs_counter_multi_price_table_node], ENT_QUOTES) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['pricing_features'][$cs_counter_multi_price_table_node]) && $_POST['pricing_features'][$cs_counter_multi_price_table_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['pricing_features'][$cs_counter_multi_price_table_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/multi_price_table_item]';
                                                $cs_counter_multi_price_table_node++;
                                            }
                                        }

                                        $section_title = '';
                                        if (isset($_POST['jobcareer_multi_price_table_section_title'][$cs_counter_multi_price_table]) && $_POST['jobcareer_multi_price_table_section_title'][$cs_counter_multi_price_table] != '') {
                                            $section_title = 'jobcareer_multi_price_table_section_title="' . htmlspecialchars($_POST['jobcareer_multi_price_table_section_title'][$cs_counter_multi_price_table], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode = '[cs_multi_price_table cs_multi_price_col="' . htmlspecialchars($_POST['cs_multi_price_col'][$cs_counter_multi_price_table], ENT_QUOTES) . '" 
                                                 ' . $section_title . ' ]' . $shortcode_item . '[/cs_multi_price_table]';
                                        $multi_price_table->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_multi_price_table++;
                                    }
                                    $cs_global_counter_multi_price_table++;
                                }
                                // Save Multi Counter
                                else if ($_POST['cs_orderby'][$cs_counter] == "multi_counters") {
                                    $shortcode = $shortcode_item = '';
                                    $multi_counters = $column->addChild('multi_counters');
                                    $multi_counters->addChild('page_element_size', htmlspecialchars($_POST['multi_counters_element_size'][$cs_global_counter_multi_counters]));
                                    $multi_counters->addChild('multi_counters_element_size', htmlspecialchars($_POST['multi_counters_element_size'][$cs_global_counter_multi_counters]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['multi_counters'][$cs_shortcode_counter_multi_counters]);
                                        $cs_shortcode_counter_multi_counters++;
                                        $multi_counters->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['multi_counters_num'][$cs_counter_multi_counters]) && $_POST['multi_counters_num'][$cs_counter_multi_counters] > 0) {

                                            for ($i = 1; $i <= $_POST['multi_counters_num'][$cs_counter_multi_counters]; $i++) {

                                                $shortcode_item .= '[multi_counters_item ';

                                                if (isset($_POST['counter_style'][$cs_counter_multi_counters_node]) && $_POST['counter_style'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_style="' . htmlspecialchars($_POST['counter_style'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['counter_title'][$cs_counter_multi_counters_node]) && $_POST['counter_title'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_title="' . htmlspecialchars($_POST['counter_title'][$cs_counter_multi_counters_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['counter_icon_type'][$cs_counter_multi_counters_node]) && $_POST['counter_icon_type'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_icon_type="' . htmlspecialchars($_POST['counter_icon_type'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['counter_icon'][$cs_counter_multi_counters_node]) && $_POST['counter_icon'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_icon="' . htmlspecialchars($_POST['counter_icon'][$cs_counter_multi_counters_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['counter_icon_align'][$cs_counter_multi_counters_node]) && $_POST['counter_icon_align'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_icon_align="' . htmlspecialchars($_POST['counter_icon_align'][$cs_counter_multi_counters_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['counter_icon_size'][$cs_counter_multi_counters_node]) && $_POST['counter_icon_size'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_icon_size="' . htmlspecialchars($_POST['counter_icon_size'][$cs_counter_multi_counters_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['counter_icon_color'][$cs_counter_multi_counters_node]) && $_POST['counter_icon_color'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_icon_color="' . htmlspecialchars($_POST['counter_icon_color'][$cs_counter_multi_counters_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['counter_numbers'][$cs_counter_multi_counters_node]) && $_POST['counter_numbers'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_numbers="' . htmlspecialchars($_POST['counter_numbers'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['counter_number_color'][$cs_counter_multi_counters_node]) && $_POST['counter_number_color'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_number_color="' . htmlspecialchars($_POST['counter_number_color'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['counter_text_content'][$cs_counter_multi_counters_node]) && $_POST['counter_text_content'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_text_content="' . htmlspecialchars($_POST['counter_text_content'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['counter_border_color'][$cs_counter_multi_counters_node]) && $_POST['counter_border_color'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_border_color="' . htmlspecialchars($_POST['counter_border_color'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['counter_border'][$cs_counter_multi_counters_node]) && $_POST['counter_border'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'counter_border="' . htmlspecialchars($_POST['counter_border'][$cs_counter_multi_counters_node]) . '" ';
                                                }
                                                if (isset($_POST['multi_counters_img'][$cs_counter_multi_counters_node]) && $_POST['multi_counters_img'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= 'multi_counters_img="' . htmlspecialchars($_POST['multi_counters_img'][$cs_counter_multi_counters_node], ENT_QUOTES) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['counter_text_content'][$cs_counter_multi_counters_node]) && $_POST['counter_text_content'][$cs_counter_multi_counters_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['counter_text_content'][$cs_counter_multi_counters_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/multi_counters_item]';
                                                $cs_counter_multi_counters_node++;
                                            }
                                        }
                                        $section_title = '';

                                        $shortcode = '[cs_multi_counters ';


                                        if (isset($_POST['cs_multi_counters_section_title'][$cs_counter_multi_counters]) && $_POST['cs_multi_counters_section_title'][$cs_counter_multi_counters] != '') {
                                            $shortcode .= 'cs_multi_counters_section_title="' . htmlspecialchars($_POST['cs_multi_counters_section_title'][$cs_counter_multi_counters]) . '" ';
                                        }
                                        if (isset($_POST['cs_multi_counters_view'][$cs_counter_multi_counters]) && $_POST['cs_multi_counters_view'][$cs_counter_multi_counters] != '') {
                                            $shortcode .= 'cs_multi_counters_view="' . htmlspecialchars($_POST['cs_multi_counters_view'][$cs_counter_multi_counters]) . '" ';
                                        }
                                        if (isset($_POST['cs_multi_counters_title_color'][$cs_counter_multi_counters]) && $_POST['cs_multi_counters_title_color'][$cs_counter_multi_counters] != '') {
                                            $shortcode .= 'cs_multi_counters_title_color="' . htmlspecialchars($_POST['cs_multi_counters_title_color'][$cs_counter_multi_counters]) . '" ';
                                        }
                                        if (isset($_POST['cs_multi_counters_number_color'][$cs_counter_multi_counters]) && $_POST['cs_multi_counters_number_color'][$cs_counter_multi_counters] != '') {
                                            $shortcode .= 'cs_multi_counters_number_color="' . htmlspecialchars($_POST['cs_multi_counters_number_color'][$cs_counter_multi_counters]) . '" ';
                                        }
                                        if (isset($_POST['cs_multi_counters_icon_color'][$cs_counter_multi_counters]) && $_POST['cs_multi_counters_icon_color'][$cs_counter_multi_counters] != '') {
                                            $shortcode .= 'cs_multi_counters_icon_color="' . htmlspecialchars($_POST['cs_multi_counters_icon_color'][$cs_counter_multi_counters]) . '" ';
                                        }

                                        $shortcode.= $section_title . ' ]' . $shortcode_item . '[/cs_multi_counters]';
									
                                        $multi_counters->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_multi_counters++;
                                    }
                                    $cs_global_counter_multi_counters++;
                                } else if ($_POST['cs_orderby'][$cs_counter] == "slider") {
                                    $shortcode = '';
                                    $slider = $column->addChild('slider');
                                    $slider->addChild('page_element_size', htmlspecialchars($_POST['slider_element_size'][$cs_global_counter_slider]));
                                    $slider->addChild('slider_element_size', htmlspecialchars($_POST['slider_element_size'][$cs_global_counter_slider]));

                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['slider'][$cs_shortcode_counter_slider]);
                                        $cs_shortcode_counter_slider++;
                                        $slider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_QUOTE . ' ';
                                        if (isset($_POST['slider_cite'][$counter_slider]) && $_POST['slider_cite'][$counter_slider] != '') {
                                            $shortcode .= 'slider_cite="' . htmlspecialchars($_POST['slider_cite'][$counter_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['slider_cite_url'][$counter_slider]) && $_POST['slider_cite_url'][$counter_slider] != '') {
                                            $shortcode .= 'slider_cite_url="' . htmlspecialchars($_POST['slider_cite_url'][$counter_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['slider_text_color'][$counter_slider]) && $_POST['slider_text_color'][$counter_slider] != '') {
                                            $shortcode .= 'slider_text_color="' . htmlspecialchars($_POST['slider_text_color'][$counter_slider]) . '" ';
                                        }
                                        if (isset($_POST['slider_align'][$counter_slider]) && $_POST['slider_align'][$counter_slider] != '') {
                                            $shortcode .= 'slider_align="' . htmlspecialchars($_POST['slider_align'][$counter_slider]) . '" ';
                                        }
                                        if (isset($_POST['cs_slider_section_title'][$counter_slider]) && $_POST['cs_slider_section_title'][$counter_slider] != '') {
                                            $shortcode .= 'cs_slider_section_title="' . htmlspecialchars($_POST['cs_slider_section_title'][$counter_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_slider_class'][$counter_slider]) && $_POST['cs_slider_class'][$counter_slider] != '') {
                                            $shortcode .= 'cs_slider_class="' . htmlspecialchars($_POST['cs_slider_class'][$counter_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_slider_animation'][$counter_slider]) && $_POST['cs_slider_animation'][$counter_slider] != '') {
                                            $shortcode .= 'cs_slider_animation="' . htmlspecialchars($_POST['cs_slider_animation'][$counter_slider]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        if (isset($_POST['slider_content'][$counter_slider])) {
                                            $shortcode .= htmlspecialchars($_POST['slider_content'][$counter_slider], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_QUOTE . ']';
                                        $slider->addChild('cs_shortcode', $shortcode);
                                        $counter_slider++;
                                    }
                                    $cs_global_counter_slider++;
                                }
                                // Save List page element 
                                else if ($_POST['cs_orderby'][$cs_counter] == "list") {
                                    $shortcode = $shortcode_item = '';
                                    $lists = $column->addChild('list');
                                    $lists->addChild('page_element_size', htmlspecialchars($_POST['list_element_size'][$cs_global_counter_list]));
                                    $lists->addChild('list_element_size', htmlspecialchars($_POST['list_element_size'][$cs_global_counter_list]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['list'][$cs_shortcode_counter_list]);
                                        $cs_shortcode_counter_list++;
                                        $lists->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['list_num'][$cs_counter_list]) && $_POST['list_num'][$cs_counter_list] > 0) {
                                            for ($i = 1; $i <= $_POST['list_num'][$cs_counter_list]; $i++) {

                                                $shortcode_item .= '[' . CS_SC_LISTITEM . ' ';
                                                if (isset($_POST['cs_list_icon'][$cs_counter_lists_node])) {
                                                    $shortcode_item .='cs_list_icon="' . htmlspecialchars($_POST['cs_list_icon'][$cs_counter_lists_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_list_item_icon_color'][$cs_counter_lists_node])) {
                                                    $shortcode_item .='cs_list_item_icon_color="' . htmlspecialchars($_POST['cs_list_item_icon_color'][$cs_counter_lists_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_list_item_icon_bg_color'][$cs_counter_lists_node])) {
                                                    $shortcode_item .='cs_list_item_icon_bg_color="' . htmlspecialchars($_POST['cs_list_item_icon_bg_color'][$cs_counter_lists_node], ENT_QUOTES) . '" ';
                                                }
                                                $shortcode_item .= ']';
                                                if (isset($_POST['cs_list_item'][$cs_counter_lists_node])) {
                                                    $shortcode_item .= htmlspecialchars($_POST['cs_list_item'][$cs_counter_lists_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/' . CS_SC_LISTITEM . ']';
                                                $cs_counter_lists_node++;
                                            }
                                        }
                                        $shortcode = '[' . CS_SC_LIST . ' ';

                                        $shortcode .= 'column_size="1/1" ';
                                        if (isset($_POST['cs_list_type'][$cs_counter_list]) && $_POST['cs_list_type'][$cs_counter_list] != '') {
                                            $shortcode .= 'cs_list_type="' . htmlspecialchars($_POST['cs_list_type'][$cs_counter_list]) . '" ';
                                        }
                                        if (isset($_POST['cs_border'][$cs_counter_list]) && $_POST['cs_border'][$cs_counter_list] != '') {
                                            $shortcode .= 'cs_border="' . htmlspecialchars($_POST['cs_border'][$cs_counter_list]) . '" ';
                                        }
                                        if (isset($_POST['cs_list_section_title'][$cs_counter_list]) && $_POST['cs_list_section_title'][$cs_counter_list] != '') {
                                            $shortcode .= 'cs_list_section_title="' . htmlspecialchars($_POST['cs_list_section_title'][$cs_counter_list], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_list_animation'][$cs_counter_list]) && $_POST['cs_list_animation'][$cs_counter_list] != '') {
                                            $shortcode .= 'cs_list_animation="' . htmlspecialchars($_POST['cs_list_animation'][$cs_counter_list]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_LIST . ']';
                                        $lists->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_list++;
                                    }
                                    $cs_global_counter_list++;
                                }
                                // Accrodian
                                else if ($_POST['cs_orderby'][$cs_counter] == "faq") {
                                    $shortcode = $shortcode_item = '';
                                    $faqs = $column->addChild('faq');
                                    $faqs->addChild('page_element_size', htmlspecialchars($_POST['faq_element_size'][$cs_global_counter_faq]));
                                    $faqs->addChild('faq_element_size', htmlspecialchars($_POST['faq_element_size'][$cs_global_counter_faq]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['faq'][$cs_shortcode_counter_faq]);
                                        $cs_shortcode_counter_faq++;
                                        $faqs->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['faq_num'][$counter_faq]) && $_POST['faq_num'][$counter_faq] > 0) {
                                            for ($i = 1; $i <= $_POST['faq_num'][$counter_faq]; $i++) {
                                                $shortcode_item .= '[' . CS_SC_FAQITEM . ' ';
                                                if (isset($_POST['faq_title'][$counter_faq_node]) && $_POST['faq_title'][$counter_faq_node] != '') {
                                                    $shortcode_item .= 'faq_title="' . htmlspecialchars($_POST['faq_title'][$counter_faq_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['faq_active'][$counter_faq_node]) && $_POST['faq_active'][$counter_faq_node] != '') {
                                                    $shortcode_item .= 'faq_active="' . htmlspecialchars($_POST['faq_active'][$counter_faq_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_faq_icon'][$counter_faq_node]) && $_POST['cs_faq_icon'][$counter_faq_node] != '') {
                                                    $shortcode_item .= 'cs_faq_icon="' . htmlspecialchars($_POST['cs_faq_icon'][$counter_faq_node], ENT_QUOTES) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['faq_text'][$counter_faq_node]) && $_POST['faq_text'][$counter_faq_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['faq_text'][$counter_faq_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/' . CS_SC_FAQITEM . ']';
                                                $counter_faq_node++;
                                            }
                                        }

                                        $section_title = '';
                                        if (isset($_POST['cs_faq_section_title'][$counter_faq]) && $_POST['cs_faq_section_title'][$counter_faq] != '') {
                                            $section_title = 'cs_faq_section_title="' . htmlspecialchars($_POST['cs_faq_section_title'][$counter_faq], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode = '[' . CS_SC_FAQ . ' ' . $section_title;
                                        if (isset($_POST['cs_faq_view'][$counter_faq]) && $_POST['cs_faq_view'][$counter_faq] != '') {
                                            $shortcode .= 'cs_faq_view="' . htmlspecialchars($_POST['cs_faq_view'][$counter_faq], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['faq_animation'][$counter_faq]) && $_POST['faq_animation'][$counter_faq] != '') {
                                            $shortcode .= ' faq_animation="' . htmlspecialchars($_POST['faq_animation'][$counter_faq]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_FAQ . ']';

                                        $faqs->addChild('cs_shortcode', $shortcode);
                                        $counter_faq++;
                                    }
                                    $cs_global_counter_faq++;
                                }
                                // Tabs
                                else if ($_POST['cs_orderby'][$cs_counter] == "tabs") {
                                    $shortcode = $shortcode_item = '';
                                    $tabs = $column->addChild('tabs');
                                    $tabs->addChild('page_element_size', htmlspecialchars($_POST['tabs_element_size'][$cs_global_counter_tabs]));
                                    $tabs->addChild('tabs_element_size', htmlspecialchars($_POST['tabs_element_size'][$cs_global_counter_tabs]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['tabs'][$cs_shortcode_counter_tabs]);
                                        $cs_shortcode_counter_tabs++;
                                        $tabs->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['tabs_num'][$counter_tabs]) && $_POST['tabs_num'][$counter_tabs] > 0) {
                                            for ($i = 1; $i <= $_POST['tabs_num'][$counter_tabs]; $i++) {
                                                $shortcode_item .= '[' . CS_SC_TABSITEM . ' ';
                                                if (isset($_POST['tab_title'][$counter_tabs_node]) && $_POST['tab_title'][$counter_tabs_node] != '') {
                                                    $shortcode_item .= 'tab_title="' . htmlspecialchars($_POST['tab_title'][$counter_tabs_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['tab_active'][$counter_tabs_node]) && $_POST['tab_active'][$counter_tabs_node] != '') {
                                                    $shortcode_item .= 'tab_active="' . htmlspecialchars($_POST['tab_active'][$counter_tabs_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_tab_icon'][$counter_tabs_node]) && $_POST['cs_tab_icon'][$counter_tabs_node] != '') {
                                                    $shortcode_item .= 'cs_tab_icon="' . htmlspecialchars($_POST['cs_tab_icon'][$counter_tabs_node], ENT_QUOTES) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['tab_text'][$counter_tabs_node]) && $_POST['tab_text'][$counter_tabs_node] != '') {
                                                    $shortcode_item .=htmlspecialchars($_POST['tab_text'][$counter_tabs_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/' . CS_SC_TABSITEM . ']';
                                                $counter_tabs_node++;
                                            }
                                        }
                                        $section_title = '';
                                        if (isset($_POST['cs_tabs_section_title'][$counter_tabs]) && $_POST['cs_tabs_section_title'][$counter_tabs] != '') {
                                            $section_title = 'cs_tabs_section_title="' . htmlspecialchars($_POST['cs_tabs_section_title'][$counter_tabs], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode = '[' . CS_SC_TABS . ' ' . $section_title . '  cs_tab_style="' . htmlspecialchars($_POST['cs_tab_style'][$counter_tabs]) . '" cs_tabs_class="' . htmlspecialchars($_POST['cs_tabs_class'][$counter_tabs], ENT_QUOTES) . '"   cs_tabs_animation="' . htmlspecialchars($_POST['cs_tabs_animation'][$counter_tabs]) . '"]' . $shortcode_item . '[/' . CS_SC_TABS . ']';
                                        $tabs->addChild('cs_shortcode', $shortcode);
                                        $counter_tabs++;
                                    }
                                    $cs_global_counter_tabs++;
                                }
                                // Counters
                                else if ($_POST['cs_orderby'][$cs_counter] == "counter") {
                                    $shortcode_item = '';
                                    $counter = $column->addChild('counter');
                                    $counter->addChild('counter_element_size', htmlspecialchars($_POST['counter_element_size'][$cs_global_counter_counter]));
                                    $counter->addChild('page_element_size', htmlspecialchars($_POST['counter_element_size'][$cs_global_counter_counter]));

                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['counter'][$cs_shortcode_counter_counter]);
                                        $cs_shortcode_counter_counter++;
                                        $counter->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode_item .= '[' . CS_SC_COUNTERS . ' ';
                                        if (isset($_POST['counter_style'][$counter_coutner]) && $_POST['counter_style'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_style="' . htmlspecialchars($_POST['counter_style'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_title'][$counter_coutner]) && $_POST['counter_title'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_title="' . htmlspecialchars($_POST['counter_title'][$counter_coutner], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['counter_icon_type'][$counter_coutner]) && $_POST['counter_icon_type'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_icon_type="' . htmlspecialchars($_POST['counter_icon_type'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_icon'][$counter_coutner]) && $_POST['counter_icon'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_icon="' . htmlspecialchars($_POST['counter_icon'][$counter_coutner], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['counter_icon_align'][$counter_coutner]) && $_POST['counter_icon_align'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_icon_align="' . htmlspecialchars($_POST['counter_icon_align'][$counter_coutner], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['counter_icon_size'][$counter_coutner]) && $_POST['counter_icon_size'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_icon_size="' . htmlspecialchars($_POST['counter_icon_size'][$counter_coutner], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_counter_logo'][$counter_coutner]) && $_POST['cs_counter_logo'][$counter_coutner] != '') {
                                            $shortcode_item .= 'cs_counter_logo="' . htmlspecialchars($_POST['cs_counter_logo'][$counter_coutner], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['counter_icon_color'][$counter_coutner]) && $_POST['counter_icon_color'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_icon_color="' . htmlspecialchars($_POST['counter_icon_color'][$counter_coutner], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['counter_numbers'][$counter_coutner]) && $_POST['counter_numbers'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_numbers="' . htmlspecialchars($_POST['counter_numbers'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_number_color'][$counter_coutner]) && $_POST['counter_number_color'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_number_color="' . htmlspecialchars($_POST['counter_number_color'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_text_color'][$counter_coutner]) && $_POST['counter_text_color'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_text_color="' . htmlspecialchars($_POST['counter_text_color'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_border_color'][$counter_coutner]) && $_POST['counter_border_color'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_border_color="' . htmlspecialchars($_POST['counter_border_color'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_border'][$counter_coutner]) && $_POST['counter_border'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_border="' . htmlspecialchars($_POST['counter_border'][$counter_coutner]) . '" ';
                                        }
                                        if (isset($_POST['counter_animation'][$counter_coutner]) && $_POST['counter_animation'][$counter_coutner] != '') {
                                            $shortcode_item .= 'counter_animation="' . htmlspecialchars($_POST['counter_animation'][$counter_coutner]) . '" ';
                                        }
                                        $shortcode_item .= ']';
                                        $shortcode_item .= '[/' . CS_SC_COUNTERS . ']';
                                        $counter->addChild('cs_shortcode', $shortcode_item);
                                        $counter_coutner++;
                                    }
                                    $cs_global_counter_counter++;
                                }
                                // Pricetable
                                else if ($_POST['cs_orderby'][$cs_counter] == "pricetable") {
                                    $shortcode = $price_item = $shortcode_item = '';
                                    $pricetable_item = $column->addChild('pricetable');
                                    $pricetable_item->addChild('page_element_size', htmlspecialchars($_POST['pricetable_element_size'][$cs_global_counter_pricetables]));
                                    $pricetable_item->addChild('pricetable_element_size', htmlspecialchars($_POST['pricetable_element_size'][$cs_global_counter_pricetables]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['pricetable'][$cs_shortcode_counter_pricetables]);
                                        $cs_shortcode_counter_pricetables++;
                                        $pricetable_item->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['price_num'][$cs_counter_pricetables]) && $_POST['price_num'][$cs_counter_pricetables] > 0) {
                                            for ($i = 1; $i <= $_POST['price_num'][$cs_counter_pricetables]; $i++) {
                                                $price_item .= '[' . CS_SC_PRICETABLEITEM . ' ';
                                                if (isset($_POST['pricing_feature'][$cs_counter_pricetables_node]) && trim($_POST['pricing_feature'][$cs_counter_pricetables_node]) != '') {
                                                    $price_item .= 'pricing_feature="' . htmlspecialchars($_POST['pricing_feature'][$cs_counter_pricetables_node], ENT_QUOTES) . '" ';
                                                }
                                                $price_item .= ']';
                                                $price_item .= '[/' . CS_SC_PRICETABLEITEM . ']';
                                                $cs_counter_pricetables_node++;
                                            }
                                        }
                                        $section_title = '';
                                        if (isset($_POST['cs_pricetable_section_title'][$cs_counter_pricetables]) && $_POST['cs_pricetable_section_title'][$cs_counter_pricetables] != '') {
                                            $section_title = 'cs_pricetable_section_title="' . htmlspecialchars($_POST['cs_pricetable_section_title'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_style'][$cs_counter_pricetables]) && $_POST['pricetable_style'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_style="' . htmlspecialchars($_POST['pricetable_style'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_title'][$cs_counter_pricetables]) && $_POST['pricetable_title'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_title="' . htmlspecialchars($_POST['pricetable_title'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_title_bgcolor'][$cs_counter_pricetables]) && $_POST['pricetable_title_bgcolor'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_title_bgcolor="' . htmlspecialchars($_POST['pricetable_title_bgcolor'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_price'][$cs_counter_pricetables]) && $_POST['pricetable_price'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_price="' . htmlspecialchars($_POST['pricetable_price'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['currency_symbols'][$cs_counter_pricetables]) && $_POST['currency_symbols'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'currency_symbols="' . htmlspecialchars($_POST['currency_symbols'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_period'][$cs_counter_pricetables]) && $_POST['pricetable_period'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_period="' . htmlspecialchars($_POST['pricetable_period'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_bgcolor'][$cs_counter_pricetables]) && $_POST['pricetable_bgcolor'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_bgcolor="' . htmlspecialchars($_POST['pricetable_bgcolor'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['btn_text'][$cs_counter_pricetables]) && $_POST['btn_text'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'btn_text="' . htmlspecialchars($_POST['btn_text'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['btn_link'][$cs_counter_pricetables]) && $_POST['btn_link'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'btn_link="' . htmlspecialchars($_POST['btn_link'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['btn_bg_color'][$cs_counter_pricetables]) && $_POST['btn_bg_color'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'btn_bg_color="' . htmlspecialchars($_POST['btn_bg_color'][$cs_counter_pricetables]) . '" ';
                                        }
                                        if (isset($_POST['pricetable_featured'][$cs_counter_pricetables]) && $_POST['pricetable_featured'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_featured="' . htmlspecialchars($_POST['pricetable_featured'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_class'][$cs_counter_pricetables]) && $_POST['pricetable_class'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_class="' . htmlspecialchars($_POST['pricetable_class'][$cs_counter_pricetables], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pricetable_animation'][$cs_counter_pricetables]) && $_POST['pricetable_animation'][$cs_counter_pricetables] != '') {
                                            $shortcode_item .= 'pricetable_animation="' . htmlspecialchars($_POST['pricetable_animation'][$cs_counter_pricetables]) . '" ';
                                        }
                                        $shortcode = '[' . CS_SC_PRICETABLE . ' ' . $section_title . ' ' . $shortcode_item . ']';
                                        $shortcode .= $price_item . '[/' . CS_SC_PRICETABLE . ']';
                                        $pricetable_item->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_pricetables++;
                                    }
                                    $cs_global_counter_pricetables++;
                                }

                                // Progressbar
                                else if ($_POST['cs_orderby'][$cs_counter] == "progressbars") {
                                    $shortcode = $shortcode_item = '';
                                    $progressbars = $column->addChild('progressbars');
                                    $progressbars->addChild('progressbars_element_size', $_POST['progressbars_element_size'][$cs_global_counter_progressbars]);
                                    $progressbars->addChild('page_element_size', $_POST['progressbars_element_size'][$cs_global_counter_progressbars]);

                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['progressbars'][$cs_shortcode_counter_progressbars]);
                                        $cs_shortcode_counter_progressbars++;
                                        $progressbars->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['progressbars_num'][$cs_counter_progressbars]) && $_POST['progressbars_num'][$cs_counter_progressbars] > 0) {
                                            for ($i = 1; $i <= $_POST['progressbars_num'][$cs_counter_progressbars]; $i++) {
                                                $shortcode_item .= '[progressbar_item ';
                                                if (isset($_POST['progressbars_title'][$cs_counter_progressbars_node]) && $_POST['progressbars_title'][$cs_counter_progressbars_node] != '') {
                                                    $shortcode_item .= 'progressbars_title="' . htmlspecialchars($_POST['progressbars_title'][$cs_counter_progressbars_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['progressbars_percentage'][$cs_counter_progressbars_node]) && $_POST['progressbars_percentage'][$cs_counter_progressbars_node] != '') {
                                                    $shortcode_item .= 'progressbars_percentage="' . htmlspecialchars($_POST['progressbars_percentage'][$cs_counter_progressbars_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['progressbars_color'][$cs_counter_progressbars_node]) && $_POST['progressbars_color'][$cs_counter_progressbars_node] != '') {
                                                    $shortcode_item .= 'progressbars_color="' . htmlspecialchars($_POST['progressbars_color'][$cs_counter_progressbars_node], ENT_QUOTES) . '" ';
                                                }
                                                $shortcode_item .=']';

                                                $cs_counter_progressbars_node++;
                                            }
                                        }

                                        $shortcode .= '[cs_progressbars ';

                                        if (isset($_POST['cs_progressbars_style'][$cs_counter_progressbars]) && trim($_POST['cs_progressbars_style'][$cs_counter_progressbars]) <> '') {
                                            $shortcode .= 'cs_progressbars_style="' . htmlspecialchars($_POST['cs_progressbars_style'][$cs_counter_progressbars]) . '" ';
                                        }
                                        if (isset($_POST['progressbars_class'][$cs_counter_progressbars]) && $_POST['progressbars_class'][$cs_counter_progressbars] != '') {
                                            $shortcode .= 'progressbars_class="' . htmlspecialchars($_POST['progressbars_class'][$cs_counter_progressbars], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['progressbars_element_title'][$cs_counter_progressbars]) && $_POST['progressbars_element_title'][$cs_counter_progressbars] != '') {
                                            $shortcode .= 'progressbars_element_title="' . htmlspecialchars($_POST['progressbars_element_title'][$cs_counter_progressbars], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['progressbars_animation'][$cs_counter_progressbars]) && $_POST['progressbars_animation'][$cs_counter_progressbars] != '') {
                                            $shortcode .= 'progressbars_animation="' . htmlspecialchars($_POST['progressbars_animation'][$cs_counter_progressbars]) . '" ';
                                        }

                                        $shortcode .= ']' . $shortcode_item . '[/cs_progressbars]';
                                        $progressbars->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_progressbars++;
                                    }
                                    $cs_global_counter_progressbars++;
                                }
                                // Table
                                else if ($_POST['cs_orderby'][$cs_counter] == "table") {
                                    $shortcode = '';
                                    $table = $column->addChild('table');
                                    $table->addChild('table_element_size', $_POST['table_element_size'][$cs_global_counter_table]);
                                    $table->addChild('page_element_size', $_POST['table_element_size'][$cs_global_counter_table]);
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['table'][$cs_shortcode_counter_table]);
                                        $cs_shortcode_counter_table++;
                                        $table->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[' . CS_SC_TABLES . ' ';
                                        if (isset($_POST['cs_table_section_title'][$cs_counter_table]) && $_POST['cs_table_section_title'][$cs_counter_table] != '') {
                                            $shortcode .= ' cs_table_section_title="' . htmlspecialchars($_POST['cs_table_section_title'][$cs_counter_table], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_table_class'][$cs_counter_table]) && $_POST['cs_table_class'][$cs_counter_table] != '') {
                                            $shortcode .= 'cs_table_class="' . htmlspecialchars($_POST['cs_table_class'][$cs_counter_table], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_table_animation'][$cs_counter_table]) && $_POST['cs_table_animation'][$cs_counter_table] != '') {
                                            $shortcode .= 'cs_table_animation="' . htmlspecialchars($_POST['cs_table_animation'][$cs_counter_table]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        if (isset($_POST['cs_table_content'][$cs_counter_table]) && $_POST['cs_table_content'][$cs_counter_table] != '') {
                                            $shortcode .= htmlspecialchars($_POST['cs_table_content'][$cs_counter_table], ENT_QUOTES);
                                        }
                                        $shortcode .='[/' . CS_SC_TABLES . ']';
                                        $table->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_table++;
                                    }
                                    $cs_global_counter_table++;
                                }

                                // CV Package
                                else if ($_POST['cs_orderby'][$cs_counter] == "cv_package") {
                                    $shortcode = '';
                                    $cv_package = $column->addChild('cv_package');
                                    $cv_package->addChild('cv_package_element_size', $_POST['cv_package_element_size'][$cs_global_counter_cv_package]);
                                    $cv_package->addChild('page_element_size', $_POST['cv_package_element_size'][$cs_global_counter_cv_package]);
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['cv_package'][$cs_shortcode_counter_cv_package]);
                                        $cs_shortcode_counter_cv_package++;
                                        $cv_package->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[cs_cv_package ';
                                        if (isset($_POST['cv_package_title'][$cs_counter_cv_package]) && $_POST['cv_package_title'][$cs_counter_cv_package] != '') {
                                            $shortcode .= ' cv_package_title="' . htmlspecialchars($_POST['cv_package_title'][$cs_counter_cv_package], ENT_QUOTES) . '" ';
                                        }
                                             if (isset($_POST['cv_columns'][$cs_counter_cv_package]) && $_POST['cv_columns'][$cs_counter_cv_package] != '') {
                                            $shortcode .= ' cv_columns="' . htmlspecialchars($_POST['cv_columns'][$cs_counter_cv_package], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_cv_pkg_id'][$cs_counter_cv_package]) && $_POST['cs_cv_pkg_id'][$cs_counter_cv_package] != '') {
                                            $cs_cv_pkg_id = $_POST['cs_cv_pkg_id'][$cs_counter_cv_package];
                                            if (isset($_POST['cv_pkges'][$cs_cv_pkg_id]) && $_POST['cv_pkges'][$cs_cv_pkg_id] != '') {

                                                if (is_array($_POST['cv_pkges'][$cs_cv_pkg_id])) {

                                                    $shortcode .= ' cv_pkges="' . implode(',', $_POST['cv_pkges'][$cs_cv_pkg_id]) . '" ';
                                                }
                                            }
                                        }

                                        $shortcode .= ']';
                                        $shortcode .='[/cs_cv_package]';

                                        $cv_package->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_cv_package++;
                                    }
                                    $cs_global_counter_cv_package++;
                                }

                                // Job Package
                                else if ($_POST['cs_orderby'][$cs_counter] == "job_package") {
                                    $shortcode = '';
                                    $job_package = $column->addChild('job_package');
                                    $job_package->addChild('job_package_element_size', $_POST['job_package_element_size'][$cs_global_counter_job_package]);
                                    $job_package->addChild('page_element_size', $_POST['job_package_element_size'][$cs_global_counter_job_package]);
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['job_package'][$cs_shortcode_counter_job_package]);
                                        $cs_shortcode_counter_job_package++;
                                        $job_package->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[cs_job_package ';
                                        if (isset($_POST['job_package_title'][$cs_counter_job_package]) && $_POST['job_package_title'][$cs_counter_job_package] != '') {
                                            $shortcode .= ' job_package_title="' . htmlspecialchars($_POST['job_package_title'][$cs_counter_job_package], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_packages_columns'][$cs_counter_job_package]) && $_POST['job_packages_columns'][$cs_counter_job_package] != '') {
                                            $shortcode .= ' job_packages_columns="' . htmlspecialchars($_POST['job_packages_columns'][$cs_counter_job_package], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_package_style'][$cs_counter_job_package]) && $_POST['job_package_style'][$cs_counter_job_package] != '') {
                                            $shortcode .= ' job_package_style="' . htmlspecialchars($_POST['job_package_style'][$cs_counter_job_package]) . '" ';
                                        }

                                        if (isset($_POST['cs_pkg_id'][$cs_counter_job_package]) && $_POST['cs_pkg_id'][$cs_counter_job_package] != '') {
                                            $cs_pkg_id = $_POST['cs_pkg_id'][$cs_counter_job_package];
                                            if (isset($_POST['job_pkges'][$cs_pkg_id]) && $_POST['job_pkges'][$cs_pkg_id] != '') {

                                                if (is_array($_POST['job_pkges'][$cs_pkg_id])) {

                                                    $shortcode .= ' job_pkges="' . implode(',', $_POST['job_pkges'][$cs_pkg_id]) . '" ';
                                                }
                                            }
                                        }

                                        $shortcode .= ']';
                                        $shortcode .='[/cs_job_package]';

                                        $job_package->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_job_package++;
                                    }
                                    $cs_global_counter_job_package++;
                                }

                                // Job Specialisms
                                else if ($_POST['cs_orderby'][$cs_counter] == "job_specialisms") {
                                    $shortcode = '';
                                    $job_specialisms = $column->addChild('job_specialisms');
                                    $job_specialisms->addChild('job_specialisms_element_size', $_POST['job_specialisms_element_size'][$cs_global_counter_job_specialisms]);
                                    $job_specialisms->addChild('page_element_size', $_POST['job_specialisms_element_size'][$cs_global_counter_job_specialisms]);
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['job_specialisms'][$cs_shortcode_counter_job_specialisms]);
                                        $cs_shortcode_counter_job_specialisms++;
                                        $job_specialisms->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[cs_job_specialisms ';
                                        if (isset($_POST['job_specialisms_title'][$cs_counter_job_specialisms]) && $_POST['job_specialisms_title'][$cs_counter_job_specialisms] != '') {
                                            $shortcode .= ' job_specialisms_title="' . htmlspecialchars($_POST['job_specialisms_title'][$cs_counter_job_specialisms], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_specialisms_title_align'][$cs_counter_job_specialisms]) && $_POST['job_specialisms_title_align'][$cs_counter_job_specialisms] != '') {
                                            $shortcode .= ' job_specialisms_title_align="' . htmlspecialchars($_POST['job_specialisms_title_align'][$cs_counter_job_specialisms], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_specialisms_img'][$cs_counter_job_specialisms]) && $_POST['job_specialisms_img'][$cs_counter_job_specialisms] != '') {
                                            $shortcode .= ' job_specialisms_img="' . htmlspecialchars($_POST['job_specialisms_img'][$cs_counter_job_specialisms]) . '" ';
                                        }

                                        if (isset($_POST['cs_spec_id'][$cs_counter_job_specialisms]) && $_POST['cs_spec_id'][$cs_counter_job_specialisms] != '') {
                                            $cs_spec_id = $_POST['cs_spec_id'][$cs_counter_job_specialisms];
                                            if (isset($_POST['spec_cats'][$cs_spec_id]) && $_POST['spec_cats'][$cs_spec_id] != '') {

                                                if (is_array($_POST['spec_cats'][$cs_spec_id])) {

                                                    $shortcode .= ' spec_cats="' . implode(',', $_POST['spec_cats'][$cs_spec_id]) . '" ';
                                                }
                                            }
                                        }if (isset($_POST['specialisms_view'][$cs_counter_job_specialisms]) && $_POST['specialisms_view'][$cs_counter_job_specialisms] != '') {
                                            $shortcode .= ' specialisms_view="' . htmlspecialchars($_POST['specialisms_view'][$cs_counter_job_specialisms], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['specialisms_columns'][$cs_counter_job_specialisms]) && $_POST['specialisms_columns'][$cs_counter_job_specialisms] != '') {
                                            $shortcode .= ' specialisms_columns="' . htmlspecialchars($_POST['specialisms_columns'][$cs_counter_job_specialisms], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_specialisms_subtitle_switch'][$cs_counter_job_specialisms]) && $_POST['job_specialisms_subtitle_switch'][$cs_counter_job_specialisms] != '') {
                                            $shortcode .= ' job_specialisms_subtitle_switch="' . htmlspecialchars($_POST['job_specialisms_subtitle_switch'][$cs_counter_job_specialisms], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $shortcode .= '[/cs_job_specialisms]';
                                        $job_specialisms->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_job_specialisms++;
                                    }
                                    $cs_global_counter_job_specialisms++;
                                }
                                
                                // Job Post
                                else if ($_POST['cs_orderby'][$cs_counter] == "job_post") {
                                    $shortcode = '';
                                    $job_post = $column->addChild('job_post');
                                    $job_post->addChild('job_post_element_size', $_POST['job_post_element_size'][$cs_global_counter_job_post]);
                                    $job_post->addChild('page_element_size', $_POST['job_post_element_size'][$cs_global_counter_job_post]);
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['job_post'][$cs_shortcode_counter_job_post]);
                                        $cs_shortcode_counter_job_post++;
                                        $job_post->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[cs_job_post ';
                                        if (isset($_POST['job_post_title'][$cs_counter_job_post]) && $_POST['job_post_title'][$cs_counter_job_post] != '') {
                                            $shortcode .= ' job_post_title="' . htmlspecialchars($_POST['job_post_title'][$cs_counter_job_post], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $shortcode .='[/cs_job_post]';

                                        $job_post->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_job_post++;
                                    }
                                    $cs_global_counter_job_post++;
                                }

                                // Job Search
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "jobs_search") {
                                    $shortcode = '';
                                    $jobs_search = $column->addChild('jobs_search');
                                    $jobs_search->addChild('jobs_search_element_size', $_POST['jobs_search_element_size'][$cs_global_counter_jobs_search]);
                                    $jobs_search->addChild('page_element_size', $_POST['jobs_search_element_size'][$cs_global_counter_jobs_search]);
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['jobs_search'][$cs_shortcode_counter_jobs_search]);
                                        $cs_shortcode_counter_jobs_search++;
                                        $jobs_search->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode .= '[cs_jobs_search ';
                                        if (isset($_POST['jobs_search_title'][$cs_counter_jobs_search]) && $_POST['jobs_search_title'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'jobs_search_title="' . htmlspecialchars($_POST['jobs_search_title'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_search_style'][$cs_counter_jobs_search]) && $_POST['job_search_style'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_style="' . htmlspecialchars($_POST['job_search_style'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['job_search_layout'][$cs_counter_jobs_search]) && $_POST['job_search_layout'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_layout="' . htmlspecialchars($_POST['job_search_layout'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_search_layout_bg'][$cs_counter_jobs_search]) && $_POST['job_search_layout_bg'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_layout_bg="' . htmlspecialchars($_POST['job_search_layout_bg'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['job_search_layout_heading_color'][$cs_counter_jobs_search]) && $_POST['job_search_layout_heading_color'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_layout_heading_color="' . htmlspecialchars($_POST['job_search_layout_heading_color'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['job_search_title_field_switch'][$cs_counter_jobs_search]) && $_POST['job_search_title_field_switch'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_title_field_switch="' . htmlspecialchars($_POST['job_search_title_field_switch'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_search_specialisam_field_switch'][$cs_counter_jobs_search]) && $_POST['job_search_specialisam_field_switch'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_specialisam_field_switch="' . htmlspecialchars($_POST['job_search_specialisam_field_switch'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_search_location_field_switch'][$cs_counter_jobs_search]) && $_POST['job_search_location_field_switch'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_location_field_switch="' . htmlspecialchars($_POST['job_search_location_field_switch'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['job_lable_switch'][$cs_counter_jobs_search]) && $_POST['job_lable_switch'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_lable_switch="' . htmlspecialchars($_POST['job_lable_switch'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_search_hint_switch'][$cs_counter_jobs_search]) && $_POST['job_search_hint_switch'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_search_hint_switch="' . htmlspecialchars($_POST['job_search_hint_switch'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_advance_search_switch'][$cs_counter_jobs_search]) && $_POST['job_advance_search_switch'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_advance_search_switch="' . htmlspecialchars($_POST['job_advance_search_switch'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['job_advance_search_url'][$cs_counter_jobs_search]) && $_POST['job_advance_search_url'][$cs_counter_jobs_search] != '') {
                                            $shortcode .= 'job_advance_search_url="' . htmlspecialchars($_POST['job_advance_search_url'][$cs_counter_jobs_search], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode .= ']';
                                        $shortcode .= '[/cs_jobs_search]';

                                        $jobs_search->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_jobs_search++;
                                    }
                                    $cs_global_counter_jobs_search++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "button") {
                                    $shortcode = '';
                                    $button = $column->addChild('button');
                                    $button->addChild('page_element_size', htmlspecialchars($_POST['button_element_size'][$cs_global_counter_button]));
                                    $button->addChild('button_element_size', htmlspecialchars($_POST['button_element_size'][$cs_global_counter_button]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = isset($_POST['shortcode']['button'][$cs_shortcode_counter_button]) && $_POST['shortcode']['button'][$cs_shortcode_counter_button] != '' ? stripslashes($_POST['shortcode']['button'][$cs_shortcode_counter_button]) : '';
                                        $button->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                        $cs_shortcode_counter_button++;
                                    } else {
                                        $shortcode .= '[' . CS_SC_BUTTON . ' ';
                                        if (isset($_POST['button_size'][$cs_counter_button]) && trim($_POST['button_size'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_size="' . htmlspecialchars($_POST['button_size'][$cs_counter_button]) . '" ';
                                        }
                                        if (isset($_POST['button_title'][$cs_counter_button]) && trim($_POST['button_title'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_title="' . htmlspecialchars($_POST['button_title'][$cs_counter_button], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['button_link'][$cs_counter_button]) && trim($_POST['button_link'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_link="' . htmlspecialchars($_POST['button_link'][$cs_counter_button], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['button_bg_color'][$cs_counter_button]) && trim($_POST['button_bg_color'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_bg_color="' . htmlspecialchars($_POST['button_bg_color'][$cs_counter_button], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['button_color'][$cs_counter_button]) && trim($_POST['button_color'][$cs_counter_button]) <> '') {
                                            $shortcode .='button_color="' . htmlspecialchars($_POST['button_color'][$cs_counter_button], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['border_button_color'][$cs_counter_button]) && trim($_POST['border_button_color'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'border_button_color="' . htmlspecialchars($_POST['border_button_color'][$cs_counter_button]) . '" ';
                                        }
                                        if (isset($_POST['button_icon'][$cs_counter_button]) && trim($_POST['button_icon'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_icon="' . htmlspecialchars($_POST['button_icon'][$cs_counter_button], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['button_icon_position'][$cs_counter_button]) && trim($_POST['button_icon_position'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_icon_position="' . htmlspecialchars($_POST['button_icon_position'][$cs_counter_button]) . '" ';
                                        }
                                        if (isset($_POST['button_type'][$cs_counter_button]) && trim($_POST['button_type'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_type="' . htmlspecialchars($_POST['button_type'][$cs_counter_button]) . '" ';
                                        }
                                        if (isset($_POST['button_target'][$cs_counter_button]) && trim($_POST['button_target'][$cs_counter_button]) <> '') {
                                            $shortcode .= 'button_target="' . htmlspecialchars($_POST['button_target'][$cs_counter_button]) . '" ';
                                        }
                                        if (isset($_POST['button_border'][$cs_counter_button]) && trim($_POST['button_border'][$cs_counter_button]) <> '') {
                                            $shortcode .='button_border="' . htmlspecialchars($_POST['button_border'][$cs_counter_button]) . '" ';
                                        }
                                        if (isset($_POST['cs_button_animation'][$cs_counter_button]) && $_POST['cs_button_animation'][$cs_counter_button] != '') {
                                            $shortcode .='cs_button_animation="' . htmlspecialchars($_POST['cs_button_animation'][$cs_counter_button]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $button->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_button++;
                                    }
                                    $cs_global_counter_button++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "register") {
                                    $shortcode = '';

                                    $register = $column->addChild('register');
                                    $register->addChild('page_element_size', htmlspecialchars($_POST['register_element_size'][$cs_global_counter_register]));
                                    $register->addChild('register_element_size', htmlspecialchars($_POST['register_element_size'][$cs_global_counter_register]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = isset($_POST['shortcode']['register'][$cs_shortcode_counter_register]) && $_POST['shortcode']['register'][$cs_shortcode_counter_register] != '' ? $_POST['shortcode']['register'][$cs_shortcode_counter_register] : '';
                                        $register->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                        $cs_shortcode_counter_register++;
                                    } else {
                                        $shortcode .= '[cs_register ';
                                        if (isset($_POST['candidate_register_element_title'][$cs_counter_register]) && trim($_POST['candidate_register_element_title'][$cs_counter_register]) <> '') {
                                            $shortcode .= 'candidate_register_element_title="' . htmlspecialchars($_POST['candidate_register_element_title'][$cs_counter_register]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $register->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_register++;
                                    }
                                    $cs_global_counter_register++;
                                }
                                // Common Elements end
                                // Media Elements Shortcode
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "slider") {
                                    $shortcode = '';
                                    $slider = $column->addChild('slider');
                                    $slider->addChild('page_element_size', $_POST['slider_element_size'][$cs_global_counter_slider]);
                                    $slider->addChild('slider_element_size', $_POST['slider_element_size'][$cs_global_counter_slider]);

                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['slider'][$cs_shortcode_counter_slider]);
                                        $cs_shortcode_counter_slider++;
                                        $slider->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_SLIDER . ' ';
                                        if (isset($_POST['cs_slider_header_title'][$cs_counter_slider]) && trim($_POST['cs_slider_header_title'][$cs_counter_slider]) <> '') {
                                            $shortcode .= 'cs_slider_header_title="' . htmlspecialchars($_POST['cs_slider_header_title'][$cs_counter_slider], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_slider'][$cs_counter_slider]) && trim($_POST['cs_slider'][$cs_counter_slider]) <> '') {
                                            $shortcode .= 'cs_slider="' . htmlspecialchars($_POST['cs_slider'][$cs_counter_slider]) . '" ';
                                        }
                                        if (isset($_POST['cs_slider_id'][$cs_counter_slider]) && trim($_POST['cs_slider_id'][$cs_counter_slider]) <> '') {
                                            $shortcode .= 'cs_slider_id="' . htmlspecialchars($_POST['cs_slider_id'][$cs_counter_slider]) . '" ';
                                        }

                                        $shortcode .= ']';
                                        $slider->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_slider++;
                                    }
                                    $cs_global_counter_slider++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "promobox") {
                                    $shortcode = '';
                                    $promobox = $column->addChild('promobox');
                                    $promobox->addChild('page_element_size', htmlspecialchars($_POST['promobox_element_size'][$cs_global_counter_promobox]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['promobox'][$cs_shortcode_counter_promobox]);
                                        $cs_shortcode_counter_promobox++;
                                        $promobox->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode .= '[' . CS_SC_PROMOBOX . ' ';

                                        if (isset($_POST['cs_promobox_section_title'][$cs_counter_promobox]) && trim($_POST['cs_promobox_section_title'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_promobox_section_title="' . htmlspecialchars($_POST['cs_promobox_section_title'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promo_image_url'][$cs_counter_promobox]) && trim($_POST['cs_promo_image_url'][$cs_counter_promobox]) <> '') {
                                            $shortcode .='cs_promo_image_url="' . htmlspecialchars($_POST['cs_promo_image_url'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_title'][$cs_counter_promobox]) && trim($_POST['cs_promobox_title'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_promobox_title="' . htmlspecialchars($_POST['cs_promobox_title'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_contents'][$cs_counter_promobox]) && trim($_POST['cs_promobox_contents'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_promobox_contents="' . htmlspecialchars($_POST['cs_promobox_contents'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_link'][$cs_counter_promobox]) && trim($_POST['cs_link'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_link="' . htmlspecialchars($_POST['cs_link'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_title_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_title_color'][$cs_counter_promobox]) <> '') {
                                            $shortcode .='cs_promobox_title_color="' . htmlspecialchars($_POST['cs_promobox_title_color'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_background_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_background_color'][$cs_counter_promobox]) <> '') {
                                            $shortcode .='cs_promobox_background_color="' . htmlspecialchars($_POST['cs_promobox_background_color'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_content_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_content_color'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_promobox_content_color="' . htmlspecialchars($_POST['cs_promobox_content_color'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_btn_bg_color'][$cs_counter_promobox]) && trim($_POST['cs_promobox_btn_bg_color'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_promobox_btn_bg_color="' . htmlspecialchars($_POST['cs_promobox_btn_bg_color'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_link_title'][$cs_counter_promobox]) && trim($_POST['cs_link_title'][$cs_counter_promobox]) <> '') {
                                            $shortcode .= 'cs_link_title="' . htmlspecialchars($_POST['cs_link_title'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['bg_repeat'][$cs_counter_promobox]) && trim($_POST['bg_repeat'][$cs_counter_promobox]) <> '') {
                                            $shortcode .='bg_repeat="' . htmlspecialchars($_POST['bg_repeat'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['text_align'][$cs_counter_promobox]) && trim($_POST['text_align'][$cs_counter_promobox]) <> '') {
                                            $shortcode .='text_align="' . htmlspecialchars($_POST['text_align'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_class'][$cs_counter_promobox]) && $_POST['cs_promobox_class'][$cs_counter_promobox] != '') {
                                            $shortcode .= 'cs_promobox_class="' . htmlspecialchars($_POST['cs_promobox_class'][$cs_counter_promobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_promobox_animation'][$cs_counter_promobox]) && $_POST['cs_promobox_animation'][$cs_counter_promobox] != '') {
                                            $shortcode .='cs_promobox_animation="' . htmlspecialchars($_POST['cs_promobox_animation'][$cs_counter_promobox]) . '" ';
                                        }
                                        $shortcode .=']';
                                        if (isset($_POST['cs_promobox_contents'][$cs_counter_promobox]) && $_POST['cs_promobox_contents'][$cs_counter_promobox] != '') {
                                            $shortcode .= htmlspecialchars($_POST['cs_promobox_contents'][$cs_counter_promobox], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_PROMOBOX . ']';

                                        $promobox->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_promobox++;
                                    }
                                    $cs_global_counter_promobox++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "teams") {
                                    $shortcode = '';
                                    $team = $column->addChild('teams');
                                    $team->addChild('page_element_size', htmlspecialchars($_POST['teams_element_size'][$cs_global_counter_teams]));
                                    $team->addChild('teams_element_size', htmlspecialchars($_POST['teams_element_size'][$cs_global_counter_teams]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['teams'][$cs_shortcode_counter_teams]);
                                        $cs_shortcode_counter_teams++;
                                        $team->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode = '[' . CS_SC_TEAM . ' ';
                                        if (isset($_POST['cs_team_section_title'][$cs_counter_teams]) && $_POST['cs_team_section_title'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_section_title="' . htmlspecialchars($_POST['cs_team_section_title'][$cs_counter_teams], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_name'][$cs_counter_teams]) && $_POST['cs_team_name'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_name="' . htmlspecialchars($_POST['cs_team_name'][$cs_counter_teams], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_designation'][$cs_counter_teams]) && $_POST['cs_team_designation'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_designation="' . htmlspecialchars($_POST['cs_team_designation'][$cs_counter_teams]) . '" ';
                                        }
                                        if (isset($_POST['cs_team_description'][$cs_counter_teams]) && $_POST['cs_team_description'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_description="' . htmlspecialchars($_POST['cs_team_description'][$cs_counter_teams], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_profile_image'][$cs_counter_teams]) && $_POST['cs_team_profile_image'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_profile_image="' . htmlspecialchars($_POST['cs_team_profile_image'][$cs_counter_teams]) . '" ';
                                        }

                                        if (isset($_POST['cs_team_fb_url'][$cs_counter_teams]) && $_POST['cs_team_fb_url'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_fb_url="' . htmlspecialchars($_POST['cs_team_fb_url'][$cs_counter_teams]) . '" ';
                                        }
                                        if (isset($_POST['cs_team_twitter_url'][$cs_counter_teams]) && $_POST['cs_team_twitter_url'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_twitter_url="' . htmlspecialchars($_POST['cs_team_twitter_url'][$cs_counter_teams]) . '" ';
                                        }

                                        if (isset($_POST['cs_team_linkedin_url'][$cs_counter_teams]) && $_POST['cs_team_linkedin_url'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_linkedin_url="' . htmlspecialchars($_POST['cs_team_linkedin_url'][$cs_counter_teams]) . '" ';
                                        }
                                        if (isset($_POST['cs_team_email'][$cs_counter_teams]) && $_POST['cs_team_email'][$cs_counter_teams] != '') {
                                            $shortcode .= 'cs_team_email="' . htmlspecialchars($_POST['cs_team_email'][$cs_counter_teams]) . '" ';
                                        }

                                        $shortcode .= ']';
                                        if (isset($_POST['cs_team_description'][$cs_counter_teams]) && $_POST['cs_team_description'][$cs_counter_teams] != '') {
                                            $shortcode .= htmlspecialchars($_POST['cs_team_description'][$cs_counter_teams], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_TEAM . ']';
                                        $team->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_teams++;
                                    }
                                    $cs_global_counter_teams++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "portfolio") {
                                    $shortcode = '';
                                    $team = $column->addChild('portfolio');
                                    $team->addChild('page_element_size', htmlspecialchars($_POST['portfolio_element_size'][$cs_global_counter_portfolio]));
                                    $team->addChild('portfolio_element_size', htmlspecialchars($_POST['portfolio_element_size'][$cs_global_counter_portfolio]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['portfolio'][$cs_shortcode_counter_portfolio]);
                                        $cs_shortcode_counter_portfolio++;
                                        $team->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode = '[cs_portfolio ';
                                        if (isset($_POST['cs_portfolio_section_title'][$cs_counter_portfolio]) && $_POST['cs_portfolio_section_title'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_section_title="' . htmlspecialchars($_POST['cs_portfolio_section_title'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_portfolio_orderby'][$cs_counter_portfolio]) && $_POST['cs_portfolio_orderby'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_orderby="' . htmlspecialchars($_POST['cs_portfolio_orderby'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_portfolio_cat'][$cs_counter_portfolio]) && $_POST['cs_portfolio_cat'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_cat="' . htmlspecialchars($_POST['cs_portfolio_cat'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_portfolio_view'][$cs_counter_portfolio]) && $_POST['cs_portfolio_view'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_view="' . htmlspecialchars($_POST['cs_portfolio_view'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_port_filter'][$cs_counter_portfolio]) && $_POST['cs_port_filter'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_port_filter="' . htmlspecialchars($_POST['cs_port_filter'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_portfolio_description'][$cs_counter_portfolio]) && $_POST['cs_portfolio_description'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_description="' . htmlspecialchars($_POST['cs_portfolio_description'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_portfolio_excerpt'][$cs_counter_portfolio]) && $_POST['cs_portfolio_excerpt'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_excerpt="' . htmlspecialchars($_POST['cs_portfolio_excerpt'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_portfolio_num_post'][$cs_counter_portfolio]) && $_POST['cs_portfolio_num_post'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'cs_portfolio_num_post="' . htmlspecialchars($_POST['cs_portfolio_num_post'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['portfolio_pagination'][$cs_counter_portfolio]) && $_POST['portfolio_pagination'][$cs_counter_portfolio] != '') {
                                            $shortcode .= 'portfolio_pagination="' . htmlspecialchars($_POST['portfolio_pagination'][$cs_counter_portfolio], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode .= ']';

                                        $shortcode .= '[/cs_portfolio]';
                                        $team->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_portfolio++;
                                    }
                                    $cs_global_counter_portfolio++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "accordion") {
                                    $shortcode = $shortcode_item = '';
                                    $accordions = $column->addChild('accordion');
                                    $accordions->addChild('page_element_size', htmlspecialchars($_POST['accordion_element_size'][$cs_global_counter_accordion]));
                                    $accordions->addChild('accordion_element_size', htmlspecialchars($_POST['accordion_element_size'][$cs_global_counter_accordion]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['accordion'][$cs_shortcode_counter_accordion]);
                                        $cs_shortcode_counter_accordion++;
                                        $accordions->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['accordion_num'][$counter_accordion]) && $_POST['accordion_num'][$counter_accordion] > 0) {
                                            for ($i = 1; $i <= $_POST['accordion_num'][$counter_accordion]; $i++) {
                                                $shortcode_item .= '[accordian_item ';
                                                if (isset($_POST['accordion_title'][$counter_accordion_node]) && $_POST['accordion_title'][$counter_accordion_node] != '') {
                                                    $shortcode_item .= 'accordion_title="' . htmlspecialchars($_POST['accordion_title'][$counter_accordion_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['accordion_active'][$counter_accordion_node]) && $_POST['accordion_active'][$counter_accordion_node] != '') {
                                                    $shortcode_item .= 'accordion_active="' . htmlspecialchars($_POST['accordion_active'][$counter_accordion_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_accordian_icon'][$counter_accordion_node]) && $_POST['cs_accordian_icon'][$counter_accordion_node] != '') {
                                                    $shortcode_item .= 'cs_accordian_icon="' . htmlspecialchars($_POST['cs_accordian_icon'][$counter_accordion_node], ENT_QUOTES) . '" ';
                                                }
                                                $shortcode_item .= ']';
                                                if (isset($_POST['accordion_text'][$counter_accordion_node]) && $_POST['accordion_text'][$counter_accordion_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['accordion_text'][$counter_accordion_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/accordian_item]';

                                                $counter_accordion_node++;
                                            }
                                        }

                                        $section_title = '';
                                        if (isset($_POST['cs_accordian_section_title'][$counter_accordion]) && $_POST['cs_accordian_section_title'][$counter_accordion] != '') {
                                            $section_title = 'cs_accordian_section_title="' . htmlspecialchars($_POST['cs_accordian_section_title'][$counter_accordion], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode = '[cs_accordian accordian_style="' . htmlspecialchars($_POST['accordian_style'][$counter_accordion]) . '" ' . $section_title;

                                        if (isset($_POST['accordion_animation'][$counter_accordion]) && $_POST['accordion_animation'][$counter_accordion] != '') {
                                            $shortcode .= ' accordion_animation="' . htmlspecialchars($_POST['accordion_animation'][$counter_accordion]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/cs_accordian]';

                                        $accordions->addChild('cs_shortcode', $shortcode);
                                        $counter_accordion++;
                                    }
                                    $cs_global_counter_accordion++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "members") {
                                    $shortcode = '';
                                    $members = $column->addChild('members');
                                    $members->addChild('page_element_size', htmlspecialchars($_POST['members_element_size'][$cs_global_counter_members]));
                                    $members->addChild('members_element_size', htmlspecialchars($_POST['members_element_size'][$cs_global_counter_members]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['members'][$cs_shortcode_counter_members]);
                                        $cs_shortcode_counter_members++;
                                        $output = array();
                                        $PREFIX = 'cs_members';
                                        $parseObject = new ShortcodeParse();
                                        $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
                                        $defaults = array('var_pb_members_title' => '', 'var_contact_fields' => '', 'var_pb_members_description' => '', 'var_pb_members_roles' => '', 'var_pb_members_filterable' => '', 'var_pb_members_azfilterable' => '', 'var_pb_members_pagination' => '', 'var_pb_members_all_tab' => '', 'var_pb_members_per_page' => get_option("posts_per_page"), 'var_pb_member_view' => '', 'cs_members_class' => '', 'cs_members_animation' => '');
                                        if (isset($output['0']['atts'])) {
                                            $atts = $output['0']['atts'];
                                        } else {
                                            $atts = array();
                                        }
                                        foreach ($defaults as $key => $values) {
                                            if (isset($atts[$key]))
                                                $$key = $atts[$key];
                                            else
                                                $$key = $values;
                                        }
                                        $members->addChild('var_pb_members_title', htmlspecialchars($var_pb_members_title, ENT_QUOTES));
                                        $members->addChild('var_pb_member_view', htmlspecialchars($var_pb_member_view));
                                        $members->addChild('var_pb_members_roles', htmlspecialchars($var_pb_members_roles));
                                        $members->addChild('var_pb_members_filterable', htmlspecialchars($var_pb_members_filterable));
                                        $members->addChild('var_pb_members_azfilterable', htmlspecialchars($var_pb_members_azfilterable));
                                        $members->addChild('var_pb_members_azfilterable', htmlspecialchars($var_pb_members_azfilterable));
                                        $members->addChild('var_pb_members_all_tab', htmlspecialchars($var_pb_members_all_tab));
                                        $members->addChild('var_contact_fields', htmlspecialchars($var_contact_fields));
                                        $members->addChild('var_pb_members_description', htmlspecialchars($var_pb_members_description));
                                        $members->addChild('var_pb_members_pagination', htmlspecialchars($var_pb_members_pagination));
                                        $members->addChild('var_pb_members_per_page', intval($var_pb_members_per_page));
                                        $members->addChild('cs_members_class', htmlspecialchars($cs_members_class, ENT_QUOTES));
                                        $members->addChild('cs_members_animation', htmlspecialchars($cs_members_animation));
                                        $members->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['cs_members_counter'][$cs_counter_members])) {
                                            $cs_members_counter = htmlspecialchars($_POST['cs_members_counter'][$cs_counter_members]);
                                        }
                                        $members->addChild('var_pb_members_title', htmlspecialchars($_POST['var_pb_members_title'][$cs_counter_members], ENT_QUOTES));
                                        $members->addChild('var_pb_member_view', htmlspecialchars($_POST['var_pb_member_view'][$cs_counter_members]));

                                        if (empty($_POST['var_pb_members_roles'][$cs_members_counter])) {
                                            $var_pb_members_roles = "";
                                        } else {
                                            $var_pb_members_roles = implode(",", $_POST['var_pb_members_roles'][$cs_members_counter]);
                                        }
                                        $members->addChild('var_pb_members_roles', htmlspecialchars($var_pb_members_roles));
                                        $members->addChild('var_pb_members_filterable', htmlspecialchars($_POST['var_pb_members_filterable'][$cs_counter_members]));
                                        $members->addChild('var_pb_members_azfilterable', htmlspecialchars($_POST['var_pb_members_azfilterable'][$cs_counter_members]));
                                        $members->addChild('var_pb_members_all_tab', htmlspecialchars($_POST['var_pb_members_all_tab'][$cs_counter_members]));
                                        $members->addChild('var_pb_members_description', htmlspecialchars($_POST['var_pb_members_description'][$cs_counter_members]));
                                        $members->addChild('var_pb_members_pagination', htmlspecialchars($_POST['var_pb_members_pagination'][$cs_counter_members]));
                                        $members->addChild('var_pb_members_per_page', intval($_POST['var_pb_members_per_page'][$cs_counter_members]));
                                        $members->addChild('cs_members_class', htmlspecialchars($_POST['cs_members_class'][$cs_counter_members], ENT_QUOTES));
                                        $members->addChild('cs_members_animation', htmlspecialchars($_POST['cs_members_animation'][$cs_counter_members]));
                                        $shortcode .= '[cs_members ';
                                        if (isset($_POST['var_pb_members_title'][$cs_counter_members]) && trim($_POST['var_pb_members_title'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_title="' . htmlspecialchars($_POST['var_pb_members_title'][$cs_counter_members], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['var_pb_member_view'][$cs_counter_members]) && trim($_POST['var_pb_member_view'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_member_view="' . htmlspecialchars($_POST['var_pb_member_view'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($var_pb_members_roles) && trim($var_pb_members_roles) <> '') {
                                            $shortcode .= 'var_pb_members_roles="' . htmlspecialchars($var_pb_members_roles) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_filterable'][$cs_counter_members]) && trim($_POST['var_pb_members_filterable'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_filterable="' . htmlspecialchars($_POST['var_pb_members_filterable'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_azfilterable'][$cs_counter_members]) && trim($_POST['var_pb_members_filterable'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_azfilterable="' . htmlspecialchars($_POST['var_pb_members_azfilterable'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_all_tab'][$cs_counter_members]) && trim($_POST['var_pb_members_all_tab'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_all_tab="' . htmlspecialchars($_POST['var_pb_members_all_tab'][$cs_counter_members]) . '" ';
                                        }

                                        if (isset($_POST['var_contact_fields'][$cs_counter_members]) && trim($_POST['var_contact_fields'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_contact_fields="' . htmlspecialchars($_POST['var_contact_fields'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_register_text'][$cs_counter_members]) && trim($_POST['var_pb_members_register_text'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_register_text="' . htmlspecialchars($_POST['var_pb_members_register_text'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_register_url'][$cs_counter_members]) && trim($_POST['var_pb_members_register_url'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_register_url="' . htmlspecialchars($_POST['var_pb_members_register_url'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_register_color'][$cs_counter_members]) && trim($_POST['var_pb_members_register_color'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_register_color="' . htmlspecialchars($_POST['var_pb_members_register_color'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_description'][$cs_counter_members]) && trim($_POST['var_pb_members_description'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_description="' . htmlspecialchars($_POST['var_pb_members_description'][$cs_counter_members]) . '" ';
                                        }

                                        if (isset($_POST['var_pb_members_pagination'][$cs_counter_members]) && trim($_POST['var_pb_members_pagination'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_pagination="' . htmlspecialchars($_POST['var_pb_members_pagination'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['var_pb_members_per_page'][$cs_counter_members]) && trim($_POST['var_pb_members_per_page'][$cs_counter_members]) <> '') {
                                            $shortcode .= 'var_pb_members_per_page="' . htmlspecialchars($_POST['var_pb_members_per_page'][$cs_counter_members]) . '" ';
                                        }
                                        if (isset($_POST['cs_members_class'][$cs_counter_members]) && $_POST['cs_members_class'][$cs_counter_members] != '') {
                                            $shortcode .= 'cs_members_class="' . htmlspecialchars($_POST['cs_members_class'][$cs_counter_members], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_members_animation'][$cs_counter_members]) && $_POST['cs_members_animation'][$cs_counter_members] != '') {
                                            $shortcode .= 'cs_members_animation="' . htmlspecialchars($_POST['cs_members_animation'][$cs_counter_members]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $members->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_members++;
                                    }
                                    $cs_global_counter_members++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "audio") {
                                    $shortcode = $shortcode_item = '';
                                    $section_title = '';
                                    $audio = $column->addChild('audio');
                                    $audio->addChild('page_element_size', htmlspecialchars($_POST['audio_element_size'][$cs_global_counter_audio]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['audio'][$cs_shortcode_counter_audio]);
                                        $cs_shortcode_counter_audio++;
                                        $audio->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['album_num'][$cs_counter_audio]) && $_POST['album_num'][$cs_counter_audio] > 0) {
                                            for ($i = 1; $i <= $_POST['album_num'][$cs_counter_audio]; $i++) {

                                                $shortcode_item .= '[album_item ';
                                                if (isset($_POST['cs_album_track_title'][$cs_counter_audio_node]) && $_POST['cs_album_track_title'][$cs_counter_audio_node] != '') {
                                                    $shortcode_item .='cs_album_track_title="' . htmlspecialchars($_POST['cs_album_track_title'][$cs_counter_audio_node]) . '" ';
                                                }if (isset($_POST['cs_album_speaker'][$cs_counter_audio_node]) && $_POST['cs_album_speaker'][$cs_counter_audio_node] != '') {
                                                    $shortcode_item .='cs_album_speaker="' . htmlspecialchars($_POST['cs_album_speaker'][$cs_counter_audio_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_album_track_mp3_url'][$cs_counter_audio_node]) && $_POST['cs_album_track_mp3_url'][$cs_counter_audio_node] != '') {
                                                    $shortcode_item .='cs_album_track_mp3_url="' . htmlspecialchars($_POST['cs_album_track_mp3_url'][$cs_counter_audio_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_album_track_buy_mp3'][$cs_counter_audio_node]) && $_POST['cs_album_track_buy_mp3'][$cs_counter_audio_node] != '') {
                                                    $shortcode_item .= 'cs_album_track_buy_mp3="' . htmlspecialchars($_POST['cs_album_track_buy_mp3'][$cs_counter_audio_node]) . '" ';
                                                }
                                                $shortcode_item .= ']';
                                                $cs_counter_audio_node++;
                                            }
                                        }
                                        if (isset($_POST['cs_audio_section_title'][$cs_counter_audio]) && $_POST['cs_audio_section_title'][$cs_counter_audio] != '') {
                                            $section_title = 'cs_audio_section_title="' . htmlspecialchars($_POST['cs_audio_section_title'][$cs_counter_audio], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode = '[cs_album 
                                                      ' . $section_title . ' 
                                                     cs_audio_section_title="' . htmlspecialchars($_POST['cs_audio_section_title'][$cs_counter_audio], ENT_QUOTES) . '"   cs_audio_class="' . htmlspecialchars($_POST['cs_audio_class'][$cs_counter_audio], ENT_QUOTES) . '"   cs_audio_animation="' . htmlspecialchars($_POST['cs_audio_animation'][$cs_counter_audio]) . '"  ]' . $shortcode_item . '[/cs_album]';
                                        $audio->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_audio++;
                                    }
                                    $cs_global_counter_audio++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "map") {
                                    $shortcode = '';
                                    $map = $column->addChild('map');
                                    $map->addChild('page_element_size', htmlspecialchars($_POST['map_element_size'][$cs_global_counter_map]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['map'][$cs_shortcode_counter_map]);
                                        $cs_shortcode_counter_map++;
                                        $map->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_MAP . ' ';
                                        if (isset($_POST['cs_map_section_title'][$cs_counter_map]) && $_POST['cs_map_section_title'][$cs_counter_map] != '') {
                                            $shortcode .='cs_map_section_title="' . htmlspecialchars($_POST['cs_map_section_title'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_height'][$cs_counter_map]) && $_POST['map_height'][$cs_counter_map] != '') {
                                            $shortcode .='map_height="' . htmlspecialchars($_POST['map_height'][$cs_counter_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['map_lat'][$cs_counter_map]) && $_POST['map_lat'][$cs_counter_map] != '') {
                                            $shortcode .= 'map_lat="' . htmlspecialchars($_POST['map_lat'][$cs_counter_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['map_lon'][$cs_counter_map]) && $_POST['map_lon'][$cs_counter_map] != '') {
                                            $shortcode .= 'map_lon="' . htmlspecialchars($_POST['map_lon'][$cs_counter_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['map_zoom'][$cs_counter_map]) && $_POST['map_zoom'][$cs_counter_map] != '') {
                                            $shortcode .='map_zoom="' . htmlspecialchars($_POST['map_zoom'][$cs_counter_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['map_type'][$cs_counter_map]) && $_POST['map_type'][$cs_counter_map] != '') {
                                            $shortcode .='map_type="' . htmlspecialchars($_POST['map_type'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_info'][$cs_counter_map]) && $_POST['map_info'][$cs_counter_map] != '') {
                                            $shortcode .='map_info="' . htmlspecialchars($_POST['map_info'][$cs_counter_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['map_info_width'][$cs_counter_map]) && $_POST['map_info_width'][$cs_counter_map] != '') {
                                            $shortcode .='map_info_width="' . htmlspecialchars($_POST['map_info_width'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_info_height'][$cs_counter_map]) && $_POST['map_info_height'][$cs_counter_map] != '') {
                                            $shortcode .='map_info_height="' . htmlspecialchars($_POST['map_info_height'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_marker_icon'][$cs_counter_map]) && $_POST['map_marker_icon'][$cs_counter_map] != '') {
                                            $shortcode .='map_marker_icon="' . htmlspecialchars($_POST['map_marker_icon'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_show_marker'][$cs_counter_map]) && $_POST['map_show_marker'][$cs_counter_map] != '') {
                                            $shortcode .='map_show_marker="' . htmlspecialchars($_POST['map_show_marker'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_controls'][$cs_counter_map]) && $_POST['map_controls'][$cs_counter_map] != '') {
                                            $shortcode .='map_controls="' . htmlspecialchars($_POST['map_controls'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_draggable'][$cs_counter_map]) && $_POST['map_draggable'][$cs_counter_map] != '') {
                                            $shortcode .='map_draggable="' . htmlspecialchars($_POST['map_draggable'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_scrollwheel'][$cs_counter_map]) && $_POST['map_scrollwheel'][$cs_counter_map] != '') {
                                            $shortcode .='map_scrollwheel="' . htmlspecialchars($_POST['map_scrollwheel'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_view'][$cs_counter_map]) && $_POST['map_view'][$cs_counter_map] != '') {
                                            $shortcode .='map_view="' . htmlspecialchars($_POST['map_view'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_border'][$cs_counter_map]) && $_POST['map_border'][$cs_counter_map] != '') {
                                            $shortcode .='map_border="' . htmlspecialchars($_POST['map_border'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_border_color'][$cs_counter_map]) && $_POST['map_border_color'][$cs_counter_map] != '') {
                                            $shortcode .='map_border_color="' . htmlspecialchars($_POST['map_border_color'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['cs_map_style'][$cs_counter_map]) && $_POST['cs_map_style'][$cs_counter_map] != '') {
                                            $shortcode .='cs_map_style="' . htmlspecialchars($_POST['cs_map_style'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['map_conactus_content'][$cs_counter_map]) && $_POST['map_conactus_content'][$cs_counter_map] != '') {
                                            $shortcode .='map_conactus_content="' . htmlspecialchars($_POST['map_conactus_content'][$cs_counter_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['map_border'][$cs_counter_map]) && $_POST['map_border'][$cs_counter_map] != '') {
                                            $shortcode .='map_border="' . htmlspecialchars($_POST['map_border'][$cs_counter_map]) . '" ';
                                        }
                                        if (isset($_POST['cs_map_animation'][$cs_counter_map]) && $_POST['cs_map_animation'][$cs_counter_map] != '') {
                                            $shortcode .='cs_map_animation="' . htmlspecialchars($_POST['cs_map_animation'][$cs_counter_map]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $map->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_map++;
                                    }
                                    $cs_global_counter_map++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "infobox") {
                                    $shortcode = $shortcode_item = '';
                                    $infobox = $column->addChild('infobox');
                                    $infobox->addChild('page_element_size', htmlspecialchars($_POST['infobox_element_size'][$cs_counter_infobox]));
                                    $infobox->addChild('infobox_element_size', htmlspecialchars($_POST['infobox_element_size'][$cs_counter_infobox]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['infobox'][$cs_shortcode_counter_infobox]);
                                        $cs_shortcode_counter_infobox++;
                                        $infobox->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        if (isset($_POST['info_list_num'][$cs_counter_infobox]) && $_POST['info_list_num'][$cs_counter_infobox] > 0) {
                                            for ($i = 1; $i <= $_POST['info_list_num'][$cs_counter_infobox]; $i++) {
                                                $shortcode_item .= '[' . CS_SC_INFOBOXITEM . ' ';
//                                                if (isset($_POST['cs_infobox_list_icon'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_icon'][$cs_counter_infobox_node] != '') {
//                                                    $shortcode_item .='cs_infobox_list_icon="' . htmlspecialchars($_POST['cs_infobox_list_icon'][$cs_counter_infobox_node]) . '" ';
//                                                }

                                                if (isset($_POST['cs_infobox_list_icon'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_icon'][$cs_counter_infobox_node] != '') {
                                                    $shortcode_item .= 'cs_infobox_list_icon="' . htmlspecialchars($_POST['cs_infobox_list_icon'][$cs_counter_infobox_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_infobox_list_title'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_title'][$cs_counter_infobox_node] != '') {
                                                    $shortcode_item .= 'cs_infobox_list_title="' . htmlspecialchars($_POST['cs_infobox_list_title'][$cs_counter_infobox_node], ENT_QUOTES) . '" ';
                                                }
                                                $shortcode_item .= ']';
                                                if (isset($_POST['cs_infobox_list_description'][$cs_counter_infobox_node]) && $_POST['cs_infobox_list_description'][$cs_counter_infobox_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['cs_infobox_list_description'][$cs_counter_infobox_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .='[/' . CS_SC_INFOBOXITEM . ']';
                                                $cs_counter_infobox_node++;
                                            }
                                        }
                                        $shortcode .= '[' . CS_SC_INFOBOX . ' ';
                                        if (isset($_POST['cs_infobox_section_title'][$cs_counter_infobox]) && trim($_POST['cs_infobox_section_title'][$cs_counter_infobox]) <> '') {
                                            $shortcode .= 'cs_infobox_section_title="' . htmlspecialchars($_POST['cs_infobox_section_title'][$cs_counter_infobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_infobox_list_color'][$cs_counter_infobox]) && $_POST['cs_infobox_list_color'][$cs_counter_infobox] != '') {
                                            $shortcode .='cs_infobox_list_color="' . htmlspecialchars($_POST['cs_infobox_list_color'][$cs_counter_infobox]) . '" ';
                                        }
                                        if (isset($_POST['cs_infobox_list_text_color'][$cs_counter_infobox]) && $_POST['cs_infobox_list_text_color'][$cs_counter_infobox] != '') {
                                            $shortcode .= 'cs_infobox_list_text_color="' . htmlspecialchars($_POST['cs_infobox_list_text_color'][$cs_counter_infobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_infobox_list_content_color'][$cs_counter_infobox]) && $_POST['cs_infobox_list_content_color'][$cs_counter_infobox] != '') {
                                            $shortcode .= 'cs_infobox_list_content_color="' . htmlspecialchars($_POST['cs_infobox_list_content_color'][$cs_counter_infobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_infobox_title'][$cs_counter_infobox]) && trim($_POST['cs_infobox_title'][$cs_counter_infobox]) <> '') {
                                            $shortcode .= 'cs_infobox_title="' . htmlspecialchars($_POST['cs_infobox_title'][$cs_counter_infobox], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_infobox_bg_color'][$cs_counter_infobox]) && trim($_POST['cs_infobox_bg_color'][$cs_counter_infobox]) <> '') {
                                            $shortcode .= 'cs_infobox_bg_color="' . htmlspecialchars($_POST['cs_infobox_bg_color'][$cs_counter_infobox]) . '" ';
                                        }
                                        if (isset($_POST['cs_infobox_animation'][$cs_counter_infobox]) && trim($_POST['cs_infobox_animation'][$cs_counter_infobox]) <> '') {
                                            $shortcode .= 'cs_infobox_animation="' . htmlspecialchars($_POST['cs_infobox_animation'][$cs_counter_infobox]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_INFOBOX . ']';
                                        $infobox->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_infobox++;
                                    }
                                    $cs_global_counter_infobox++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "image") {
                                    $shortcode = '';

                                    $image = $column->addChild('image');
                                    $image->addChild('page_element_size', htmlspecialchars($_POST['image_element_size'][$cs_global_counter_image]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['image'][$cs_shortcode_counter_image]);
                                        $cs_shortcode_counter_image++;
                                        $image->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {

                                        $shortcode .= '[' . CS_SC_IMAGE . ' ';
                                        if (isset($_POST['cs_image_section_title'][$cs_counter_image]) && $_POST['cs_image_section_title'][$cs_counter_image] != '') {
                                            $shortcode .='cs_image_section_title="' . htmlspecialchars($_POST['cs_image_section_title'][$cs_counter_image], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_image_url'][$cs_counter_image]) && $_POST['cs_image_url'][$cs_counter_image] != '') {
                                            $shortcode .='cs_image_url="' . htmlspecialchars($_POST['cs_image_url'][$cs_counter_image], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_image_title'][$cs_counter_image]) && $_POST['cs_image_title'][$cs_counter_image] != '') {
                                            $shortcode .='cs_image_title="' . htmlspecialchars($_POST['cs_image_title'][$cs_counter_image], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['cs_custom_class'][$cs_counter_image]) && $_POST['cs_custom_class'][$cs_counter_image] != '') {
                                            $shortcode .= 'cs_custom_class="' . htmlspecialchars($_POST['cs_custom_class'][$cs_counter_image], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['cs_custom_animation'][$cs_counter_image]) && $_POST['cs_custom_animation'][$cs_counter_image] != '') {
                                            $shortcode .='cs_custom_animation="' . htmlspecialchars($_POST['cs_custom_animation'][$cs_counter_image]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        if (isset($_POST['cs_image_caption'][$cs_counter_image]) && $_POST['cs_image_caption'][$cs_counter_image] != '') {
                                            $shortcode .=htmlspecialchars($_POST['cs_image_caption'][$cs_counter_image], ENT_QUOTES);
                                        }
                                        $shortcode .= '[/' . CS_SC_IMAGE . ']';

                                        $image->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_image++;
                                    }
                                    $cs_global_counter_image++;
                                }
                                // Loops Short Code Start
                                // Blog
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "blog") {
                                    $shortcode = '';
                                    $blog = $column->addChild('blog');
                                    $blog->addChild('page_element_size', htmlspecialchars($_POST['blog_element_size'][$cs_global_counter_blog]));
                                    $blog->addChild('blog_element_size', htmlspecialchars($_POST['blog_element_size'][$cs_global_counter_blog]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['blog'][$cs_shortcode_counter_blog]);
                                        $cs_shortcode_counter_blog++;
                                        $blog->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode = '[cs_blog ';
                                        if (isset($_POST['cs_blog_section_title'][$cs_counter_blog]) && $_POST['cs_blog_section_title'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_section_title="' . htmlspecialchars($_POST['cs_blog_section_title'][$cs_counter_blog], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_blog_description'][$cs_counter_blog]) && $_POST['cs_blog_description'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_description="' . htmlspecialchars($_POST['cs_blog_description'][$cs_counter_blog], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['cs_blog_cat'][$cs_counter_blog]) && $_POST['cs_blog_cat'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_cat="' . htmlspecialchars($_POST['cs_blog_cat'][$cs_counter_blog]) . '" ';
                                        }if (isset($_POST['cs_blog_view'][$cs_counter_blog]) && $_POST['cs_blog_view'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_view="' . htmlspecialchars($_POST['cs_blog_view'][$cs_counter_blog]) . '" ';
                                        }
                                        if (isset($_POST['cs_blog_boxsize'][$cs_counter_blog]) && $_POST['cs_blog_boxsize'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_boxsize="' . htmlspecialchars($_POST['cs_blog_boxsize'][$cs_counter_blog]) . '" ';
                                        }
                                        if (isset($_POST['cs_blog_excerpt'][$cs_counter_blog]) && $_POST['cs_blog_excerpt'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_excerpt="' . htmlspecialchars($_POST['cs_blog_excerpt'][$cs_counter_blog], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['cs_blog_num_post'][$cs_counter_blog]) && $_POST['cs_blog_num_post'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_num_post="' . htmlspecialchars($_POST['cs_blog_num_post'][$cs_counter_blog]) . '" ';
                                        }if (isset($_POST['cs_blog_orderby'][$cs_counter_blog]) && $_POST['cs_blog_orderby'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_orderby="' . htmlspecialchars($_POST['cs_blog_orderby'][$cs_counter_blog]) . '" ';
                                        }if (isset($_POST['blog_pagination'][$cs_counter_blog]) && $_POST['blog_pagination'][$cs_counter_blog] != '') {
                                            $shortcode .='blog_pagination="' . htmlspecialchars($_POST['blog_pagination'][$cs_counter_blog]) . '" ';
                                        }
                                        if (isset($_POST['cs_blog_animation'][$cs_counter_blog]) && $_POST['cs_blog_animation'][$cs_counter_blog] != '') {
                                            $shortcode .='cs_blog_animation="' . htmlspecialchars($_POST['cs_blog_animation'][$cs_counter_blog]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $blog->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_blog++;
                                    }
                                    $cs_global_counter_blog++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "team_post") {
                                    $shortcode = '';
                                    $team = $column->addChild('team_post');
                                    $team->addChild('page_element_size', htmlspecialchars($_POST['team_post_element_size'][$cs_global_counter_team_post]));
                                    $team->addChild('team_post_element_size', htmlspecialchars($_POST['team_post_element_size'][$cs_global_counter_team_post]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['team_post'][$cs_shortcode_counter_team_post]);
                                        $cs_shortcode_counter_team_post++;
                                        $team->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode = '[cs_team_post ';
                                        if (isset($_POST['cs_team_post_section_title'][$cs_counter_team_post]) && $_POST['cs_team_post_section_title'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'cs_team_post_section_title="' . htmlspecialchars($_POST['cs_team_post_section_title'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_post_sub_title'][$cs_counter_team_post]) && $_POST['cs_team_post_sub_title'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'cs_team_post_sub_title="' . htmlspecialchars($_POST['cs_team_post_sub_title'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_post_orderby'][$cs_counter_team_post]) && $_POST['cs_team_post_orderby'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'cs_team_post_orderby="' . htmlspecialchars($_POST['cs_team_post_orderby'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_post_description'][$cs_counter_team_post]) && $_POST['cs_team_post_description'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'cs_team_post_description="' . htmlspecialchars($_POST['cs_team_post_description'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_post_excerpt'][$cs_counter_team_post]) && $_POST['cs_team_post_excerpt'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'cs_team_post_excerpt="' . htmlspecialchars($_POST['cs_team_post_excerpt'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_team_post_num_post'][$cs_counter_team_post]) && $_POST['cs_team_post_num_post'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'cs_team_post_num_post="' . htmlspecialchars($_POST['cs_team_post_num_post'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['team_post_pagination'][$cs_counter_team_post]) && $_POST['team_post_pagination'][$cs_counter_team_post] != '') {
                                            $shortcode .= 'team_post_pagination="' . htmlspecialchars($_POST['team_post_pagination'][$cs_counter_team_post], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode .= ']';

                                        $shortcode .= '[/cs_team_post]';
                                        $team->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_team_post++;
                                    }
                                    $cs_global_counter_team_post++;
                                }

                                // Directory Map
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "directory_map") {
                                    $shortcode = '';
                                    $directory_map = $column->addChild('directory_map');
                                    $directory_map->addChild('page_element_size', htmlspecialchars($_POST['directory_map_element_size'][$cs_global_counter_directory_map]));
                                    $directory_map->addChild('directory_map_element_size', htmlspecialchars($_POST['directory_map_element_size'][$cs_global_counter_directory_map]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['directory_map'][$cs_shortcode_counter_directory_map]);
                                        $cs_shortcode_counter_directory_map++;
                                        $directory_map->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode = '[cs_directory_map ';
                                        if (isset($_POST['directory_map_title'][$cs_counter_directory_map]) && $_POST['directory_map_title'][$cs_counter_directory_map] != '') {
                                            $shortcode .='directory_map_title="' . htmlspecialchars($_POST['directory_map_title'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_map_style'][$cs_counter_directory_map]) && $_POST['cs_directory_map_style'][$cs_counter_directory_map] != '') {
                                            $shortcode .='cs_directory_map_style="' . htmlspecialchars($_POST['cs_directory_map_style'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_map_views'][$cs_counter_directory_map]) && $_POST['cs_directory_map_views'][$cs_counter_directory_map] != '') {
                                            $shortcode .='cs_directory_map_views="' . htmlspecialchars($_POST['cs_directory_map_views'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_map_filter'][$cs_counter_directory_map]) && $_POST['cs_directory_map_filter'][$cs_counter_directory_map] != '') {
                                            $shortcode .='cs_directory_map_filter="' . htmlspecialchars($_POST['cs_directory_map_filter'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_map'][$cs_counter_directory_map]) && $_POST['cs_directory_map'][$cs_counter_directory_map] != '') {
                                            $shortcode .='cs_directory_map="' . htmlspecialchars($_POST['cs_directory_map'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['directory_map_results_per_page'][$cs_counter_directory_map]) && $_POST['directory_map_results_per_page'][$cs_counter_directory_map] != '') {
                                            $shortcode .='directory_map_results_per_page="' . htmlspecialchars($_POST['directory_map_results_per_page'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_map_class'][$cs_counter_directory_map]) && $_POST['cs_directory_map_class'][$cs_counter_directory_map] != '') {
                                            $shortcode .='cs_directory_map_class="' . htmlspecialchars($_POST['cs_directory_map_class'][$cs_counter_directory_map], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['cs_directory_map_animation'][$cs_counter_directory_map]) && $_POST['cs_directory_map_animation'][$cs_counter_directory_map] != '') {
                                            $shortcode .='cs_directory_map_animation="' . htmlspecialchars($_POST['cs_directory_map_animation'][$cs_counter_directory_map]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $directory_map->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_directory_map++;
                                    }
                                    $cs_global_counter_directory_map++;
                                }
                                // Save directory categories page element 
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "directory_categories") {
                                    $shortcode = '';
                                    $directory_categories = $column->addChild('directory_categories');
                                    $directory_categories->addChild('page_element_size', htmlspecialchars($_POST['directory_categories_element_size'][$cs_global_counter_directory_categories]));
                                    $directory_categories->addChild('directory_categories_element_size', htmlspecialchars($_POST['directory_categories_element_size'][$cs_global_counter_directory_categories]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['directory_categories'][$cs_shortcode_counter_directory_categories]);
                                        $cs_shortcode_counter_directory_categories++;
                                        $directory_categories->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode = '[cs_directory_categories ';
                                        if (isset($_POST['cs_directory_categories_title'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_title'][$cs_counter_directory_categories] != '') {
                                            $shortcode .= 'cs_directory_categories_title="' . htmlspecialchars($_POST['cs_directory_categories_title'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_view'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_view'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_directory_categories_view="' . htmlspecialchars($_POST['cs_directory_categories_view'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_page'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_page'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_directory_categories_page="' . htmlspecialchars($_POST['cs_directory_categories_page'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_bg_color'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_bg_color'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_directory_categories_bg_color="' . htmlspecialchars($_POST['cs_directory_categories_bg_color'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_txt_color'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_txt_color'][$cs_counter_directory_categories] != '') {
                                            $shortcode .= 'cs_directory_categories_txt_color="' . htmlspecialchars($_POST['cs_directory_categories_txt_color'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_counter'][$cs_counter_directory_categories])) {
                                            $cs_directory_categories_counter = htmlspecialchars($_POST['cs_directory_categories_counter'][$cs_counter_directory_categories]);
                                        }
                                        if (empty($_POST['cs_directory_categories_cats'][$cs_directory_categories_counter])) {
                                            $cs_directory_categories_cats = "";
                                        } else {
                                            $cs_directory_categories_cats = implode(",", $_POST['cs_directory_categories_cats'][$cs_directory_categories_counter]);
                                        }
                                        if (isset($cs_directory_categories_cats) && trim($cs_directory_categories_cats) <> '') {
                                            $shortcode .='cs_directory_categories_cats="' . htmlspecialchars($cs_directory_categories_cats) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_order'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_order'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_directory_categories_order="' . htmlspecialchars($_POST['cs_directory_categories_order'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_directory_categories_number'][$cs_counter_directory_categories]) && $_POST['cs_directory_categories_number'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_directory_categories_number="' . htmlspecialchars($_POST['cs_directory_categories_number'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        if (isset($_POST['cs_custom_class'][$cs_counter_directory_categories]) && $_POST['cs_custom_class'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_custom_class="' . htmlspecialchars($_POST['cs_custom_class'][$cs_counter_directory_categories], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_custom_animation'][$cs_counter_directory_categories]) && $_POST['cs_custom_animation'][$cs_counter_directory_categories] != '') {
                                            $shortcode .='cs_custom_animation="' . htmlspecialchars($_POST['cs_custom_animation'][$cs_counter_directory_categories]) . '" ';
                                        }
                                        $shortcode .='[/cs_directory_categories]';
                                        $directory_categories->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_directory_categories++;
                                    }
                                    $cs_global_counter_directory_categories++;
                                }

                                // video
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "video") {
                                    $shortcode = '';
                                    $video = $column->addChild('video');
                                    $video->addChild('page_element_size', htmlspecialchars($_POST['video_element_size'][$cs_global_counter_video]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['video'][$cs_shortcode_counter_video]);
                                        $cs_shortcode_counter_video++;
                                        $video->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode .= '[' . CS_SC_VIDEO . ' ';
                                        if (isset($_POST['cs_video_section_title'][$counter_video]) && $_POST['cs_video_section_title'][$counter_video] != '') {
                                            $shortcode .='cs_video_section_title="' . htmlspecialchars($_POST['cs_video_section_title'][$counter_video], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['video_url'][$counter_video]) && $_POST['video_url'][$counter_video] != '') {
                                            $shortcode .='video_url="' . htmlspecialchars($_POST['video_url'][$counter_video], ENT_QUOTES) . '" ';
                                        }if (isset($_POST['video_width'][$counter_video]) && $_POST['video_width'][$counter_video] != '') {
                                            $shortcode .='video_width="' . htmlspecialchars($_POST['video_width'][$counter_video]) . '" ';
                                        }if (isset($_POST['video_height'][$counter_video]) && $_POST['video_height'][$counter_video] != '') {
                                            $shortcode .='video_height="' . htmlspecialchars($_POST['video_height'][$counter_video]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $video->addChild('cs_shortcode', $shortcode);
                                        $counter_video++;
                                    }
                                    $cs_global_counter_video++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "about") {

                                    $shortcode = '';
                                    $about = $column->addChild('about');
                                    $about->addChild('page_element_size', htmlspecialchars($_POST['about_element_size'][$cs_global_counter_about]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['about'][$cs_shortcode_counter_about]);
                                        $cs_shortcode_counter_about++;
                                        $about->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode .= '[' . CS_SC_ABOUT . ' ';
                                        if (isset($_POST['cs_about_section_title'][$counter_about]) && $_POST['cs_about_section_title'][$counter_about] != '') {
                                            $shortcode .='cs_about_section_title="' . htmlspecialchars($_POST['cs_about_section_title'][$counter_about], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['about_url'][$counter_about]) && $_POST['about_url'][$counter_about] != '') {
                                            $shortcode .='about_url="' . htmlspecialchars($_POST['about_url'][$counter_about], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['button_text'][$counter_about]) && $_POST['button_text'][$counter_about] != '') {
                                            $shortcode .='button_text="' . htmlspecialchars($_POST['button_text'][$counter_about]) . '" ';
                                        }

                                        if (isset($_POST['cs_image_about_url'][$cs_counter_column]) && $_POST['cs_image_about_url'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_image_about_url="' . htmlspecialchars($_POST['cs_image_about_url'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_text_color'][$cs_counter_column]) && $_POST['cs_text_color'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_text_color="' . htmlspecialchars($_POST['cs_text_color'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_bg_color'][$cs_counter_column]) && $_POST['cs_bg_color'][$cs_counter_column] != '') {
                                            $shortcode .= 'cs_bg_color="' . htmlspecialchars($_POST['cs_bg_color'][$cs_counter_column], ENT_QUOTES) . '" ';
                                        }


                                        if (isset($_POST['content_texarea'][$counter_about]) && $_POST['content_texarea'][$counter_about] != '') {
                                            $shortcode .='content_texarea="' . htmlspecialchars($_POST['content_texarea'][$counter_about], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $about->addChild('cs_shortcode', $shortcode);
                                        $counter_about++;
                                    }
                                    $cs_global_counter_about++;
                                }
                                // Clients
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "clients") {
                                    $shortcode = $shortcode_item = '';
                                    $clients = $column->addChild('clients');
                                    $clients->addChild('page_element_size', htmlspecialchars($_POST['clients_element_size'][$cs_global_counter_clients]));
                                    $clients->addChild('clients_element_size', htmlspecialchars($_POST['clients_element_size'][$cs_shortcode_counter_clients]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['clients'][$cs_shortcode_counter_clients]);
                                        $cs_shortcode_counter_clients++;
                                        $clients->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        if (isset($_POST['clients_num'][$cs_counter_clients]) && $_POST['clients_num'][$cs_counter_clients] > 0) {
                                            for ($i = 1; $i <= $_POST['clients_num'][$cs_counter_clients]; $i++) {
                                                $clients_item = $clients->addChild('clients_item');
                                                $shortcode_item .= '[' . CS_SC_CLIENTSITEM . ' ';
                                                if (isset($_POST['cs_bg_color'][$cs_counter_clients_node]) && $_POST['cs_bg_color'][$cs_counter_clients_node] != '') {
                                                    $shortcode_item .='cs_bg_color="' . htmlspecialchars($_POST['cs_bg_color'][$cs_counter_clients_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_website_url'][$cs_counter_clients_node]) && $_POST['cs_website_url'][$cs_counter_clients_node] != '') {
                                                    $shortcode_item .='cs_website_url="' . htmlspecialchars($_POST['cs_website_url'][$cs_counter_clients_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_client_title'][$cs_counter_clients_node]) && $_POST['cs_client_title'][$cs_counter_clients_node] != '') {
                                                    $shortcode_item .='cs_client_title="' . htmlspecialchars($_POST['cs_client_title'][$cs_counter_clients_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_client_logo'][$cs_counter_clients_node]) && $_POST['cs_client_logo'][$cs_counter_clients_node] != '') {
                                                    $shortcode_item .='cs_client_logo="' . htmlspecialchars($_POST['cs_client_logo'][$cs_counter_clients_node]) . '" ';
                                                }
                                                $shortcode_item .= ']';
                                                $cs_counter_clients_node++;
                                            }
                                        }
                                        $section_title = '';


                                        if (isset($_POST['cs_client_section_title'][$cs_counter_clients]) && $_POST['cs_client_section_title'][$cs_counter_clients] != '') {
                                            $section_title = 'cs_client_section_title="' . htmlspecialchars($_POST['cs_client_section_title'][$cs_counter_clients], ENT_QUOTES) . '" ';
                                        }

                                        $shortcode = '[' . CS_SC_CLIENTS . ' ';
                                        if (isset($_POST['cs_clients_view'][$cs_counter_clients]) && $_POST['cs_clients_view'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_clients_view="' . htmlspecialchars($_POST['cs_clients_view'][$cs_counter_clients]) . '" ';
                                        }
                                        if (isset($_POST['cs_client_section_title'][$cs_counter_clients]) && $_POST['cs_client_section_title'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_client_section_title="' . htmlspecialchars($_POST['cs_client_section_title'][$cs_counter_clients]) . '" ';
                                        }
                                        if (isset($_POST['cs_client_border'][$cs_counter_clients]) && $_POST['cs_client_border'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_client_border="' . htmlspecialchars($_POST['cs_client_border'][$cs_counter_clients]) . '" ';
                                        }

                                        if (isset($_POST['cs_client_style'][$cs_counter_clients]) && $_POST['cs_client_style'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_client_style="' . htmlspecialchars($_POST['cs_client_style'][$cs_counter_clients]) . '" ';
                                        }
                                        if (isset($_POST['cs_client_grey_scale'][$cs_counter_clients]) && $_POST['cs_client_grey_scale'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_client_grey_scale="' . htmlspecialchars($_POST['cs_client_grey_scale'][$cs_counter_clients]) . '" ';
                                        }
                                        if (isset($_POST['cs_clients_perslide'][$cs_counter_clients]) && $_POST['cs_clients_perslide'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_clients_perslide="' . htmlspecialchars($_POST['cs_clients_perslide'][$cs_counter_clients]) . '" ';
                                        }
                                        if (isset($_POST['cs_clients_arrow_switch'][$cs_counter_clients]) && $_POST['cs_clients_arrow_switch'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_clients_arrow_switch="' . htmlspecialchars($_POST['cs_clients_arrow_switch'][$cs_counter_clients]) . '" ';
                                        }
                                        if (isset($_POST['cs_client_animation'][$cs_counter_clients]) && $_POST['cs_client_animation'][$cs_counter_clients] != '') {
                                            $shortcode .='cs_client_animation="' . htmlspecialchars($_POST['cs_client_animation'][$cs_counter_clients]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_CLIENTS . ']';
                                        $clients->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_clients++;
                                    }
                                    $cs_global_counter_clients++;
                                }
                                // gallery
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "gallery") {
                                    $shortcode = $shortcode_item = '';
                                    $gallery = $column->addChild('gallery');
                                    $gallery->addChild('page_element_size', htmlspecialchars($_POST['gallery_element_size'][$cs_global_counter_gallery]));
                                    $gallery->addChild('gallery_element_size', htmlspecialchars($_POST['gallery_element_size'][$cs_shortcode_counter_gallery]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['gallery'][$cs_shortcode_counter_gallery]);
                                        $cs_shortcode_counter_gallery++;
                                        $gallery->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        if (isset($_POST['gallery_num'][$cs_counter_gallery]) && $_POST['gallery_num'][$cs_counter_gallery] > 0) {
                                            for ($i = 1; $i <= $_POST['gallery_num'][$cs_counter_gallery]; $i++) {
                                                $gallery_item = $gallery->addChild('gallery_item');
                                                $shortcode_item .= '[' . CS_SC_GALLERYITEM . ' ';
                                                if (isset($_POST['cs_bg_color'][$cs_counter_gallery_node]) && $_POST['cs_bg_color'][$cs_counter_gallery_node] != '') {
                                                    $shortcode_item .='cs_bg_color="' . htmlspecialchars($_POST['cs_bg_color'][$cs_counter_gallery_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_website_url'][$cs_counter_gallery_node]) && $_POST['cs_website_url'][$cs_counter_gallery_node] != '') {
                                                    $shortcode_item .='cs_website_url="' . htmlspecialchars($_POST['cs_website_url'][$cs_counter_gallery_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_gallery_title'][$cs_counter_gallery_node]) && $_POST['cs_gallery_title'][$cs_counter_gallery_node] != '') {
                                                    $shortcode_item .='cs_gallery_title="' . htmlspecialchars($_POST['cs_gallery_title'][$cs_counter_gallery_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['cs_gallery_size'][$cs_counter_gallery_node]) && $_POST['cs_gallery_size'][$cs_counter_gallery_node] != '') {
                                                    $shortcode_item .='cs_gallery_size="' . htmlspecialchars($_POST['cs_gallery_size'][$cs_counter_gallery_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['cs_gallery_logo'][$cs_counter_gallery_node]) && $_POST['cs_gallery_logo'][$cs_counter_gallery_node] != '') {
                                                    $shortcode_item .='cs_gallery_logo="' . htmlspecialchars($_POST['cs_gallery_logo'][$cs_counter_gallery_node]) . '" ';
                                                }
                                                $shortcode_item .= ']';
                                                $cs_counter_gallery_node++;
                                            }
                                        }
                                        $section_title = '';


                                        if (isset($_POST['cs_gallery_section_title'][$cs_counter_gallery]) && $_POST['cs_gallery_section_title'][$cs_counter_gallery] != '') {
                                            $section_title = 'cs_gallery_section_title="' . htmlspecialchars($_POST['cs_gallery_section_title'][$cs_counter_gallery], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode = '[' . CS_SC_GALLERY . ' ';
                                        if (isset($_POST['cs_gallery_view'][$cs_counter_gallery]) && $_POST['cs_gallery_view'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_view="' . htmlspecialchars($_POST['cs_gallery_view'][$cs_counter_gallery]) . '" ';
                                        }
                                        if (isset($_POST['cs_gallery_section_title'][$cs_counter_gallery]) && $_POST['cs_gallery_section_title'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_section_title="' . htmlspecialchars($_POST['cs_gallery_section_title'][$cs_counter_gallery]) . '" ';
                                        }
                                        if (isset($_POST['cs_gallery_border'][$cs_counter_gallery]) && $_POST['cs_gallery_border'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_border="' . htmlspecialchars($_POST['cs_gallery_border'][$cs_counter_gallery]) . '" ';
                                        }

                                        if (isset($_POST['cs_gallery_style'][$cs_counter_gallery]) && $_POST['cs_gallery_style'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_style="' . htmlspecialchars($_POST['cs_gallery_style'][$cs_counter_gallery]) . '" ';
                                        }
                                        if (isset($_POST['cs_gallery_grey_scale'][$cs_counter_gallery]) && $_POST['cs_gallery_grey_scale'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_grey_scale="' . htmlspecialchars($_POST['cs_gallery_grey_scale'][$cs_counter_gallery]) . '" ';
                                        }
                                        if (isset($_POST['cs_gallery_margin_left'][$cs_counter_gallery]) && $_POST['cs_gallery_margin_left'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_margin_left="' . htmlspecialchars($_POST['cs_gallery_margin_left'][$cs_counter_gallery], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_gallery_margin_right'][$cs_counter_gallery]) && $_POST['cs_gallery_margin_right'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_margin_right="' . htmlspecialchars($_POST['cs_gallery_margin_right'][$cs_counter_gallery], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_gallery_animation'][$cs_counter_gallery]) && $_POST['cs_gallery_animation'][$cs_counter_gallery] != '') {
                                            $shortcode .='cs_gallery_animation="' . htmlspecialchars($_POST['cs_gallery_animation'][$cs_counter_gallery]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_GALLERY . ']';
                                        $gallery->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_gallery++;
                                    }
                                    $cs_global_counter_gallery++;
                                }

                                // Multiple services
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "icon_box") {

                                    $shortcode = $shortcode_item = '';
                                    $icon_box = $column->addChild('icon_box');
                                    $icon_box->addChild('page_element_size', htmlspecialchars($_POST['icon_box_element_size'][$cs_global_counter_icon_box]));
                                    $icon_box->addChild('icon_box_element_size', htmlspecialchars($_POST['icon_box_element_size'][$cs_shortcode_counter_icon_box]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['icon_box'][$cs_shortcode_counter_icon_box]);
                                        $cs_shortcode_counter_icon_box++;
                                        $icon_box->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        if (isset($_POST['icon_box_num'][$cs_counter_icon_box]) && $_POST['icon_box_num'][$cs_counter_icon_box] > 0) {
                                            for ($i = 1; $i <= $_POST['icon_box_num'][$cs_counter_icon_box]; $i++) {
                                                $icon_box_item = $icon_box->addChild('icon_box_item');
                                                $shortcode_item .= '[' . CS_SC_ICONBOXITEM . ' ';

                                                if (isset($_POST['cs_text_color'][$cs_counter_icon_box_node]) && $_POST['cs_text_color'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_text_color="' . htmlspecialchars($_POST['cs_text_color'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_bg_color'][$cs_counter_icon_box_node]) && $_POST['cs_bg_color'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_bg_color="' . htmlspecialchars($_POST['cs_bg_color'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_website_url'][$cs_counter_icon_box_node]) && $_POST['cs_website_url'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_website_url="' . htmlspecialchars($_POST['cs_website_url'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                /*                                                 * **** */

                                                if (isset($_POST['cs_icon_box_image_icon'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_image_icon'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_image_icon="' . htmlspecialchars($_POST['cs_icon_box_image_icon'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_icon_box_image_circle'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_image_circle'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_image_circle="' . htmlspecialchars($_POST['cs_icon_box_image_circle'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_icon_box_icon'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_icon'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_icon="' . htmlspecialchars($_POST['cs_icon_box_icon'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_icon_box_icon_size'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_icon_size'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_icon_size="' . htmlspecialchars($_POST['cs_icon_box_icon_size'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_icon_box_icon_color'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_icon_color'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_icon_color="' . htmlspecialchars($_POST['cs_icon_box_icon_color'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_icon_box_background_color'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_background_color'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_background_color="' . htmlspecialchars($_POST['cs_icon_box_background_color'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_icon_box_image_size'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_image_size'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_image_size="' . htmlspecialchars($_POST['cs_icon_box_image_size'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_icon_box_link'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_link'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .= 'cs_icon_box_link="' . htmlspecialchars($_POST['cs_icon_box_link'][$cs_counter_icon_box_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_icon_box_image_array'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_image_array'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .= 'cs_icon_box_image_array="' . htmlspecialchars($_POST['cs_icon_box_image_array'][$cs_counter_icon_box_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_icon_box_icon_type'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_icon_type'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .= 'cs_icon_box_icon_type="' . htmlspecialchars($_POST['cs_icon_box_icon_type'][$cs_counter_icon_box_node], ENT_QUOTES) . '" ';
                                                }

                                                if (isset($_POST['cs_icon_box_icon_circle'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_icon_circle'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_icon_circle="' . htmlspecialchars($_POST['cs_icon_box_icon_circle'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_button_link'][$cs_counter_icon_box_node]) && $_POST['cs_button_link'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_button_link="' . htmlspecialchars($_POST['cs_button_link'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_button_text'][$cs_counter_icon_box_node]) && $_POST['cs_button_text'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_button_text="' . htmlspecialchars($_POST['cs_button_text'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_button_text_color'][$cs_counter_icon_box_node]) && $_POST['cs_button_text_color'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_button_text_color="' . htmlspecialchars($_POST['cs_button_text_color'][$cs_counter_icon_box_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_website_url'][$cs_counter_icon_box_node]) && $_POST['cs_button_color'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_button_color="' . htmlspecialchars($_POST['cs_button_color'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                /*                                                 * * -- :(  ): -- ** */
                                                if (isset($_POST['cs_icon_box_title'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_title'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_title="' . htmlspecialchars($_POST['cs_icon_box_title'][$cs_counter_icon_box_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['cs_icon_box_logo'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_logo'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .='cs_icon_box_logo="' . htmlspecialchars($_POST['cs_icon_box_logo'][$cs_counter_icon_box_node]) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['cs_icon_box_text'][$cs_counter_icon_box_node]) && $_POST['cs_icon_box_text'][$cs_counter_icon_box_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['cs_icon_box_text'][$cs_counter_icon_box_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/' . CS_SC_ICONBOXITEM . ']';
                                                $cs_counter_icon_box_node++;
                                            }
                                        }
                                        $section_title = '';

                                        $shortcode = '[' . CS_SC_ICONBOX . ' ';
                                        $shortcode .= 'column_size="1/1" ';
                                        if (isset($_POST['cs_icon_box_view'][$cs_counter_icon_box]) && $_POST['cs_icon_box_view'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_view="' . htmlspecialchars($_POST['cs_icon_box_view'][$cs_counter_icon_box]) . '"  ';
                                        }

                                        if (isset($_POST['cs_icon_box_section_title'][$cs_counter_icon_box]) && $_POST['cs_icon_box_section_title'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_section_title="' . htmlspecialchars($_POST['cs_icon_box_section_title'][$cs_counter_icon_box]) . '" ';
                                        }
                                        if (isset($_POST['cs_title_color'][$cs_counter_icon_box]) && $_POST['cs_title_color'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_title_color="' . htmlspecialchars($_POST['cs_title_color'][$cs_counter_icon_box]) . '" ';
                                        }
                                        if (isset($_POST['cs_icon_box_icon_color'][$cs_counter_icon_box]) && $_POST['cs_icon_box_icon_color'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_icon_color="' . htmlspecialchars($_POST['cs_icon_box_icon_color'][$cs_counter_icon_box]) . '" ';
                                        }

                                        if (isset($_POST['cs_icon_box_content_color'][$cs_counter_icon_box]) && $_POST['cs_icon_box_content_color'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_content_color="' . htmlspecialchars($_POST['cs_icon_box_content_color'][$cs_counter_icon_box]) . '" ';
                                        }

                                        if (isset($_POST['cs_icon_box_sub_title'][$cs_counter_icon_box]) && $_POST['cs_icon_box_sub_title'][$cs_counter_icon_box] != '') {

                                            $shortcode .= 'cs_icon_box_sub_title="' . htmlspecialchars(str_replace('"', '\'', jobcareer_custom_shortcode_encode($_POST['cs_icon_box_sub_title'][$cs_counter_icon_box]))) . '" ';
                                        }
                                        
                                        /*
                                          if (isset($_POST['flex_column_text'][$cs_counter_column]) && $_POST['flex_column_text'][$cs_counter_column] != '') {
                                          $shortcode .= esc_textarea(jobcareer_custom_shortcode_encode($_POST['flex_column_text'][$cs_counter_column])) . ' ';
                                          }
                                         */

                                        if (isset($_POST['cs_icon_box_content_align'][$cs_counter_icon_box]) && $_POST['cs_icon_box_content_align'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_content_align="' . htmlspecialchars($_POST['cs_icon_box_content_align'][$cs_counter_icon_box]) . '" ';
                                        }
                                        if (isset($_POST['cs_main_title_color'][$cs_counter_icon_box]) && $_POST['cs_main_title_color'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_main_title_color="' . htmlspecialchars($_POST['cs_main_title_color'][$cs_counter_icon_box]) . '" ';
                                        }
                                        if (isset($_POST['cs_icon_box_image_align'][$cs_counter_icon_box]) && $_POST['cs_icon_box_image_align'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_image_align="' . htmlspecialchars($_POST['cs_icon_box_image_align'][$cs_counter_icon_box]) . '" ';
                                        }
                                        if (isset($_POST['cs_icon_box_content_col'][$cs_counter_icon_box]) && $_POST['cs_icon_box_content_col'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_content_col="' . htmlspecialchars($_POST['cs_icon_box_content_col'][$cs_counter_icon_box]) . '" ';
                                        }
                                        if (isset($_POST['cs_icon_box_styles'][$cs_counter_icon_box]) && $_POST['cs_icon_box_styles'][$cs_counter_icon_box] != '') {
                                            $shortcode .='cs_icon_box_styles="' . htmlspecialchars($_POST['cs_icon_box_styles'][$cs_counter_icon_box]) . '" ';
                                        }

                                        if (isset($_POST['icon_box_element_size'][$cs_counter_icon_box]) && $_POST['icon_box_element_size'][$cs_counter_icon_box] != '') {
                                            $shortcode .='icon_box_element_size="' . htmlspecialchars($_POST['icon_box_element_size'][$cs_counter_icon_box]) . '" ';
                                        }

                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_ICONBOX . ']';
                                        $icon_box->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_icon_box++;
                                    }
                                    $cs_global_counter_icon_box++;
                                } elseif (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "multiple_team") {

                                    $shortcode = $shortcode_item = '';
                                    $multiple_team = $column->addChild('multiple_team');
                                    $multiple_team->addChild('page_element_size', htmlspecialchars($_POST['multiple_team_element_size'][$cs_global_counter_multiple_team]));
                                    $multiple_team->addChild('multiple_team_element_size', htmlspecialchars($_POST['multiple_team_element_size'][$cs_shortcode_counter_multiple_team]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['multiple_team'][$cs_shortcode_counter_multiple_team]);
                                        $cs_shortcode_counter_multiple_team++;
                                        $multiple_team->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        if (isset($_POST['multiple_team_num'][$cs_counter_multiple_team]) && $_POST['multiple_team_num'][$cs_counter_multiple_team] > 0) {
                                            for ($i = 1; $i <= $_POST['multiple_team_num'][$cs_counter_multiple_team]; $i++) {
                                                $multiple_team_item = $multiple_team->addChild('multiple_team_item');
                                                $shortcode_item .= '[' . CS_SC_MULTPLETEAMITEM . ' ';

                                                if (isset($_POST['cs_multi_team_name'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_name'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .='cs_multi_team_name="' . htmlspecialchars($_POST['cs_multi_team_name'][$cs_counter_multiple_team_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_multi_team_designation'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_designation'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .='cs_multi_team_designation="' . htmlspecialchars($_POST['cs_multi_team_designation'][$cs_counter_multiple_team_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_multi_team_fb_url'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_fb_url'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .='cs_multi_team_fb_url="' . htmlspecialchars($_POST['cs_multi_team_fb_url'][$cs_counter_multiple_team_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_multi_team_twitter_url'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_twitter_url'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .='cs_multi_team_twitter_url="' . htmlspecialchars($_POST['cs_multi_team_twitter_url'][$cs_counter_multiple_team_node]) . '" ';
                                                }
                                                if (isset($_POST['cs_multi_team_linkedin_url'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_linkedin_url'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .='cs_multi_team_linkedin_url="' . htmlspecialchars($_POST['cs_multi_team_linkedin_url'][$cs_counter_multiple_team_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_multi_team_email'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_email'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .='cs_multi_team_email="' . htmlspecialchars($_POST['cs_multi_team_email'][$cs_counter_multiple_team_node]) . '" ';
                                                }

                                                if (isset($_POST['cs_multi_team_image'][$cs_counter_multiple_team_node]) && $_POST['cs_multi_team_image'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .= 'cs_multi_team_image="' . htmlspecialchars($_POST['cs_multi_team_image'][$cs_counter_multiple_team_node], ENT_QUOTES) . '" ';
                                                }


                                                $shortcode_item .= ']';
                                                if (isset($_POST['cs_multiple_service_text'][$cs_counter_multiple_team_node]) && $_POST['cs_multiple_service_text'][$cs_counter_multiple_team_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['cs_multiple_service_text'][$cs_counter_multiple_team_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/' . CS_SC_MULTPLETEAMITEM . ']';
                                                $cs_counter_multiple_team_node++;
                                            }
                                        }
                                        $section_title = '';

                                        $shortcode = '[' . CS_SC_MULTPLETEAM . ' ';
                                        $shortcode .= 'column_size="" ';

                                        if (isset($_POST['cs_multiple_team_section_title'][$cs_counter_multiple_team]) && $_POST['cs_multiple_team_section_title'][$cs_counter_multiple_team] != '') {
                                            $shortcode .='cs_multiple_team_section_title="' . htmlspecialchars($_POST['cs_multiple_team_section_title'][$cs_counter_multiple_team]) . '" ';
                                        }
                                        if (isset($_POST['cs_multi_team_content_col'][$cs_counter_multiple_team]) && $_POST['cs_multi_team_content_col'][$cs_counter_multiple_team] != '') {
                                            $shortcode .='cs_multi_team_content_col="' . htmlspecialchars($_POST['cs_multi_team_content_col'][$cs_counter_multiple_team]) . '" ';
                                        }

                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_MULTPLETEAM . ']';
                                        $multiple_team->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_multiple_team++;
                                    }
                                    $cs_global_counter_multiple_team++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "facilities") {
                                    $shortcode = $shortcode_item = '';
                                    $facilities = $column->addChild('facilities');
                                    $facilities->addChild('page_element_size', htmlspecialchars($_POST['facilities_element_size'][$cs_global_counter_facilities]));
                                    $facilities->addChild('facilities_element_size', htmlspecialchars($_POST['facilities_element_size'][$cs_shortcode_counter_facilities]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['facilities'][$cs_shortcode_counter_facilities]);
                                        $cs_shortcode_counter_facilities++;
                                        $facilities->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        if (isset($_POST['facilities_num'][$cs_counter_facilities]) && $_POST['facilities_num'][$cs_counter_facilities] > 0) {
                                            for ($i = 1; $i <= $_POST['facilities_num'][$cs_counter_facilities]; $i++) {
                                                $facilities_item = $facilities->addChild('facilities_item');
                                                $shortcode_item .= '[' . CS_SC_FACILITIESITEM . ' ';
                                                if (isset($_POST['title'][$cs_counter_facilities_node]) && $_POST['title'][$cs_counter_facilities_node] != '') {
                                                    $shortcode_item .='title="' . htmlspecialchars($_POST['title'][$cs_counter_facilities_node], ENT_QUOTES) . '" ';
                                                }
                                                if (isset($_POST['title_color'][$cs_counter_facilities_node]) && $_POST['title_color'][$cs_counter_facilities_node] != '') {
                                                    $shortcode_item .='title_color="' . htmlspecialchars($_POST['title_color'][$cs_counter_facilities_node]) . '" ';
                                                }
                                                if (isset($_POST['text_color'][$cs_counter_facilities_node]) && $_POST['text_color'][$cs_counter_facilities_node] != '') {
                                                    $shortcode_item .='text_color="' . htmlspecialchars($_POST['text_color'][$cs_counter_facilities_node]) . '" ';
                                                }
                                                if (isset($_POST['image'][$cs_counter_facilities_node]) && $_POST['image'][$cs_counter_facilities_node] != '') {
                                                    $shortcode_item .='image="' . htmlspecialchars($_POST['image'][$cs_counter_facilities_node]) . '" ';
                                                }
                                                if (isset($_POST['facilities_text'][$cs_counter_facilities_node]) && $_POST['facilities_text'][$cs_counter_facilities_node] != '') {
                                                    $shortcode_item .='facilities_text="' . htmlspecialchars($_POST['facilities_text'][$cs_counter_facilities_node]) . '" ';
                                                }

                                                $shortcode_item .= ']';
                                                if (isset($_POST['cs_multiple_service_text'][$cs_counter_facilities_node]) && $_POST['cs_multiple_service_text'][$cs_counter_facilities_node] != '') {
                                                    $shortcode_item .= htmlspecialchars($_POST['cs_multiple_service_text'][$cs_counter_facilities_node], ENT_QUOTES);
                                                }
                                                $shortcode_item .= '[/' . CS_SC_FACILITIESITEM . ']';
                                                $cs_counter_facilities_node++;
                                            }
                                        }
                                        $section_title = '';
                                        $shortcode = '[' . CS_SC_FACILITIES . ' ';
                                        $shortcode .= 'column_size="1/1" ';

                                        if (isset($_POST['cs_section_title'][$cs_counter_facilities]) && $_POST['cs_section_title'][$cs_counter_facilities] != '') {
                                            $shortcode .='cs_section_title="' . htmlspecialchars($_POST['cs_section_title'][$cs_counter_facilities]) . '" ';
                                        }

                                        if (isset($_POST['facilities_element_size'][$cs_counter_facilities]) && $_POST['facilities_element_size'][$cs_counter_facilities] != '') {
                                            $shortcode .='facilities_element_size="' . htmlspecialchars($_POST['facilities_element_size'][$cs_counter_facilities]) . '" ';
                                        }
                                        $shortcode .= ']' . $shortcode_item . '[/' . CS_SC_FACILITIES . ']';
                                        $facilities->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_facilities++;
                                    }
                                    $cs_global_counter_facilities++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "events") {
                                    $shortcode = '';
                                    $event = $column->addChild('events');
                                    $event->addChild('page_element_size', htmlspecialchars($_POST['events_element_size'][$cs_global_counter_events]));
                                    $event->addChild('events_element_size', htmlspecialchars($_POST['events_element_size'][$cs_global_counter_events]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['events'][$cs_shortcode_counter_events]);
                                        $cs_shortcode_counter_events++;
                                        $event->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode = '[cs_events ';
                                        if (isset($_POST['section_title'][$cs_counter_events]) && $_POST['section_title'][$cs_counter_events] != '') {
                                            $shortcode .= 'section_title="' . htmlspecialchars($_POST['section_title'][$cs_counter_events], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['category'][$cs_counter_events]) && $_POST['category'][$cs_counter_events] != '') {
                                            $shortcode .= 'category="' . htmlspecialchars($_POST['category'][$cs_counter_events]) . '" ';
                                        }
                                        if (isset($_POST['view'][$cs_counter_events]) && $_POST['view'][$cs_counter_events] != '') {
                                            $shortcode .= 'view="' . htmlspecialchars($_POST['view'][$cs_counter_events]) . '" ';
                                        }
                                        if (isset($_POST['event_excerpt'][$cs_counter_events]) && $_POST['event_excerpt'][$cs_counter_events] != '') {
                                            $shortcode .= 'event_excerpt="' . htmlspecialchars($_POST['event_excerpt'][$cs_counter_events], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['pagination'][$cs_counter_events]) && $_POST['pagination'][$cs_counter_events] != '') {
                                            $shortcode .= 'pagination="' . htmlspecialchars($_POST['pagination'][$cs_counter_events]) . '" ';
                                        }
                                        if (isset($_POST['event_type'][$cs_counter_events]) && $_POST['event_type'][$cs_counter_events] != '') {
                                            $shortcode .= 'event_type="' . htmlspecialchars($_POST['event_type'][$cs_counter_events]) . '" ';
                                        }
                                        if (isset($_POST['post_order'][$cs_counter_events]) && $_POST['post_order'][$cs_counter_events] != '') {
                                            $shortcode .= 'post_order="' . htmlspecialchars($_POST['post_order'][$cs_counter_events]) . '" ';
                                        }
                                        if (isset($_POST['events_time'][$cs_counter_events]) && $_POST['events_time'][$cs_counter_events] != '') {
                                            $shortcode .= 'events_time="' . htmlspecialchars($_POST['events_time'][$cs_counter_events]) . '" ';
                                        }
                                        if (isset($_POST['classes'][$cs_counter_events]) && $_POST['classes'][$cs_counter_events] != '') {
                                            $shortcode .= 'classes="' . htmlspecialchars($_POST['classes'][$cs_counter_events], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['filterable'][$cs_counter_events]) && $_POST['filterable'][$cs_counter_events] != '') {
                                            $shortcode .= 'filterable="' . htmlspecialchars($_POST['filterable'][$cs_counter_events], ENT_QUOTES) . '" ';
                                        }
                                        $shortcode .= ']';

                                        $event->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_events++;
                                    }
                                    $cs_global_counter_events++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "candidate") {
                                    $shortcode = '';
                                    $candidate = $column->addChild('candidate');
                                    $candidate->addChild('page_element_size', htmlspecialchars($_POST['candidate_element_size'][$cs_global_counter_candidate]));
                                    $candidate->addChild('candidate_element_size', htmlspecialchars($_POST['candidate_element_size'][$cs_global_counter_candidate]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['candidate'][$cs_shortcode_counter_candidate]);
                                        $cs_shortcode_counter_candidate++;
                                        $candidate->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode = '[cs_candidate  ';
                                        if (isset($_POST['cs_candidate_title'][$cs_counter_candidate]) && $_POST['cs_candidate_title'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_title="' . htmlspecialchars($_POST['cs_candidate_title'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_map'][$cs_counter_candidate]) && $_POST['cs_candidate_map'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_map="' . htmlspecialchars($_POST['cs_candidate_map'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_map_lat'][$cs_counter_candidate]) && $_POST['cs_candidate_map_lat'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_map_lat="' . htmlspecialchars($_POST['cs_candidate_map_lat'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_map_long'][$cs_counter_candidate]) && $_POST['cs_candidate_map_long'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_map_long="' . htmlspecialchars($_POST['cs_candidate_map_long'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_map_zoom'][$cs_counter_candidate]) && $_POST['cs_candidate_map_zoom'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_map_zoom="' . htmlspecialchars($_POST['cs_candidate_map_zoom'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_map_height'][$cs_counter_candidate]) && $_POST['cs_candidate_map_height'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_map_height="' . htmlspecialchars($_POST['cs_candidate_map_height'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_map_style'][$cs_counter_candidate]) && $_POST['cs_candidate_map_style'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_map_style="' . htmlspecialchars($_POST['cs_candidate_map_style'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_searchbox'][$cs_counter_candidate]) && $_POST['cs_candidate_searchbox'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_searchbox="' . htmlspecialchars($_POST['cs_candidate_searchbox'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_view'][$cs_counter_candidate]) && $_POST['cs_candidate_view'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_view="' . htmlspecialchars($_POST['cs_candidate_view'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_cols'][$cs_counter_candidate]) && $_POST['cs_candidate_cols'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_cols="' . htmlspecialchars($_POST['cs_candidate_cols'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_candidate_searchbox_top'][$cs_counter_candidate]) && $_POST['cs_candidate_searchbox_top'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_searchbox_top="' . htmlspecialchars($_POST['cs_candidate_searchbox_top'][$cs_counter_candidate], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_pagination'][$cs_counter_candidate]) && $_POST['cs_candidate_pagination'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_pagination="' . htmlspecialchars($_POST['cs_candidate_pagination'][$cs_counter_candidate]) . '" ';
                                        }
                                        if (isset($_POST['cs_candidate_show_pagination'][$cs_counter_candidate]) && $_POST['cs_candidate_show_pagination'][$cs_counter_candidate] != '') {
                                            $shortcode .= 'cs_candidate_show_pagination="' . htmlspecialchars($_POST['cs_candidate_show_pagination'][$cs_counter_candidate]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $candidate->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_candidate++;
                                    }
                                    $cs_global_counter_candidate++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "employer") {

                                    $shortcode = '';
                                    $employer = $column->addChild('employer');
                                    $employer->addChild('page_element_size', htmlspecialchars($_POST['employer_element_size'][$cs_global_counter_employer]));
                                    $employer->addChild('employer_element_size', htmlspecialchars($_POST['employer_element_size'][$cs_global_counter_employer]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['employer'][$cs_shortcode_counter_employer]);
                                        $cs_shortcode_counter_employer++;
                                        $employer->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode = '[cs_employer ';
                                        if (isset($_POST['cs_employer_title'][$cs_counter_employer]) && $_POST['cs_employer_title'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_title="' . htmlspecialchars($_POST['cs_employer_title'][$cs_counter_employer], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_employer_sub_title'][$cs_counter_employer]) && $_POST['cs_employer_sub_title'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_sub_title="' . htmlspecialchars($_POST['cs_employer_sub_title'][$cs_counter_employer], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_employer_searchbox'][$cs_counter_employer]) && $_POST['cs_employer_searchbox'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_searchbox="' . htmlspecialchars($_POST['cs_employer_searchbox'][$cs_counter_employer], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_employer_searchbox_top'][$cs_counter_employer]) && $_POST['cs_employer_searchbox_top'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_searchbox_top="' . htmlspecialchars($_POST['cs_employer_searchbox_top'][$cs_counter_employer], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_employer_view'][$cs_counter_employer]) && $_POST['cs_employer_view'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_view="' . htmlspecialchars($_POST['cs_employer_view'][$cs_counter_employer]) . '" ';
                                        }
                                        if (isset($_POST['cs_employer_boxsize'][$cs_counter_employer]) && $_POST['cs_employer_boxsize'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_boxsize="' . htmlspecialchars($_POST['cs_employer_boxsize'][$cs_counter_employer]) . '" ';
                                        }
                                        if (isset($_POST['cs_employer_show_pagination'][$cs_counter_employer]) && $_POST['cs_employer_show_pagination'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_show_pagination="' . htmlspecialchars($_POST['cs_employer_show_pagination'][$cs_counter_employer]) . '" ';
                                        }if (isset($_POST['cs_employer_pagination'][$cs_counter_employer]) && $_POST['cs_employer_pagination'][$cs_counter_employer] != '') {
                                            $shortcode .= 'cs_employer_pagination="' . htmlspecialchars($_POST['cs_employer_pagination'][$cs_counter_employer]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $employer->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_employer++;
                                    }
                                    $cs_global_counter_employer++;
                                } else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == 'jobs') {
                                    $shortcode = '';
                                    $job = $column->addChild('jobs');
                                    $job->addChild('page_element_size', htmlspecialchars($_POST['jobs_element_size'][$cs_global_counter_job]));
                                    $job->addChild('jobs_element_size', htmlspecialchars($_POST['jobs_element_size'][$cs_global_counter_job]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['jobs'][$cs_shortcode_counter_job]);
                                        $cs_shortcode_counter_job++;
                                        $job->addChild('cs_shortcode', htmlspecialchars($shortcode_str));
                                    } else {
                                        $shortcode = '[cs_jobs ';
                                        if (isset($_POST['cs_job_title'][$cs_counter_job]) && $_POST['cs_job_title'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_title="' . htmlspecialchars($_POST['cs_job_title'][$cs_counter_job], ENT_QUOTES) . '" ';
                                        }

                                        if (isset($_POST['cs_job_sub_title'][$cs_counter_job]) && $_POST['cs_job_sub_title'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_sub_title="' . htmlspecialchars($_POST['cs_job_sub_title'][$cs_counter_job], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_job_searchbox'][$cs_counter_job]) && $_POST['cs_job_searchbox'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_searchbox="' . htmlspecialchars($_POST['cs_job_searchbox'][$cs_counter_job], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_job_filterable'][$cs_counter_job]) && $_POST['cs_job_filterable'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_filterable="' . htmlspecialchars($_POST['cs_job_filterable'][$cs_counter_job], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_job_top_search'][$cs_counter_job]) && $_POST['cs_job_top_search'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_top_search="' . htmlspecialchars($_POST['cs_job_top_search'][$cs_counter_job], ENT_QUOTES) . '" ';
                                        }
                                        if (isset($_POST['cs_job_view'][$cs_counter_job]) && $_POST['cs_job_view'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_view="' . htmlspecialchars($_POST['cs_job_view'][$cs_counter_job]) . '" ';
                                        }if (isset($_POST['cs_job_result_type'][$cs_counter_job]) && $_POST['cs_job_result_type'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_result_type="' . htmlspecialchars($_POST['cs_job_result_type'][$cs_counter_job]) . '" ';
                                        }
                                        // saving job type admin field using filter in "import indeed jobs" add on
                                        $shortcode = apply_filters( 'jobhunt_save_jobs_shortcode_admin_fields', $shortcode, $_POST, $cs_counter_job);
										
                                        if (isset($_POST['cs_job_show_pagination'][$cs_counter_job]) && $_POST['cs_job_show_pagination'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_show_pagination="' . htmlspecialchars($_POST['cs_job_show_pagination'][$cs_counter_job]) . '" ';
                                        }
										if (isset($_POST['cs_job_pagination'][$cs_counter_job]) && $_POST['cs_job_pagination'][$cs_counter_job] != '') {
                                            $shortcode .= 'cs_job_pagination="' . htmlspecialchars($_POST['cs_job_pagination'][$cs_counter_job]) . '" ';
                                        }
										
                                        $shortcode .= ']';
                                        
                                        $job->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_job++;
                                    }
                                    $cs_global_counter_job++;
                                }
                                // Save Twitter page element 
                                else if (isset($_POST['cs_orderby'][$cs_counter]) && $_POST['cs_orderby'][$cs_counter] == "tweets") {
                                    $shortcode = '';
                                    $tweet = $column->addChild('tweets');
                                    $tweet->addChild('page_element_size', htmlspecialchars($_POST['tweets_element_size'][$cs_global_counter_tweets]));
                                    $tweet->addChild('tweets_element_size', htmlspecialchars($_POST['tweets_element_size'][$cs_global_counter_tweets]));
                                    if (isset($_POST['cs_widget_element_num'][$cs_counter]) && $_POST['cs_widget_element_num'][$cs_counter] == 'shortcode') {
                                        $shortcode_str = stripslashes($_POST['shortcode']['tweets'][$cs_shortcode_counter_tweets]);
                                        $cs_shortcode_counter_tweets++;
                                        $tweet->addChild('cs_shortcode', htmlspecialchars($shortcode_str, ENT_QUOTES));
                                    } else {
                                        $shortcode = '[' . CS_SC_TWEETS . ' ';

                                        if (isset($_POST['cs_tweets_user_name'][$cs_counter_tweets]) && $_POST['cs_tweets_user_name'][$cs_counter_tweets] != '') {
                                            $shortcode .='cs_tweets_user_name="' . htmlspecialchars($_POST['cs_tweets_user_name'][$cs_counter_tweets]) . '" ';
                                        }
                                        if (isset($_POST['cs_tweets_view'][$cs_counter_tweets]) && $_POST['cs_tweets_view'][$cs_counter_tweets] != '') {
                                            $shortcode .='cs_tweets_view="' . htmlspecialchars($_POST['cs_tweets_view'][$cs_counter_tweets]) . '" ';
                                        }
                                        if (isset($_POST['cs_tweets_color'][$cs_counter_tweets]) && $_POST['cs_tweets_color'][$cs_counter_tweets] != '') {
                                            $shortcode .='cs_tweets_color="' . htmlspecialchars($_POST['cs_tweets_color'][$cs_counter_tweets]) . '" ';
                                        }
                                        if (isset($_POST['cs_no_of_tweets'][$cs_counter_tweets]) && $_POST['cs_no_of_tweets'][$cs_counter_tweets] != '') {
                                            $shortcode .='cs_no_of_tweets="' . htmlspecialchars($_POST['cs_no_of_tweets'][$cs_counter_tweets]) . '" ';
                                        }
                                        if (isset($_POST['cs_tweets_animation'][$cs_counter_tweets]) && $_POST['cs_tweets_animation'][$cs_counter_tweets] != '') {
                                            $shortcode .='cs_tweets_animation="' . htmlspecialchars($_POST['cs_tweets_animation'][$cs_counter_tweets]) . '" ';
                                        }
                                        $shortcode .= ']';
                                        $tweet->addChild('cs_shortcode', $shortcode);
                                        $cs_counter_tweets++;
                                    }
                                    $cs_global_counter_tweets++;
                                }
                                //===Loops Short Code End
                                $cs_counter++;
                            }
                            $widget_no++;
                        }
                        $column_container_no++;
                    }
                }
                update_post_meta($post_id, 'cs_page_builder', $sxe->asXML());
            }
        }

    }
}// End save page builder values
