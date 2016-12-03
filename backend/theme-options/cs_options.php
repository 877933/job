<?php
/**
 * @Theme option function
 * @return
 *
 */
if (!function_exists('jobcareer_theme_options_constructor')) {

    function jobcareer_theme_options_constructor() {
        jobcareer_theme_option();
        jobcareer_options_page();
    }

}
// Start function for Theme option backend setting 
if (!function_exists('jobcareer_options_page')) {

    function jobcareer_options_page() {
        global $jobcareer_options, $jobcareer_sett_options, $jobcareer_form_fields;
        $jobcareer_options = get_option('cs_theme_options');
        ?>
        <div class="theme-wrap fullwidth">
            <div class="inner">
                <div class="outerwrapp-layer">
                    <div class="loading_div"> <i class="icon-circle-o-notch icon-spin"></i> <br>
                        <?php esc_html_e('Saving changes...', 'jobcareer'); ?>
                    </div>
                    <div class="form-msg"> <i class="icon-check-circle-o"></i>
                        <div class="innermsg"></div>
                    </div>
                </div>
                <div class="row">
                    <form id="frm" method="post">
                        <?php
                        $jobcareer_theme_options_fields = new jobcareer_theme_options_fields();
                        $return = $jobcareer_theme_options_fields->cs_fields($jobcareer_sett_options);
                        ?>
                        <div class="col1">
                            <nav class="admin-navigtion">
                                <div class="logo"> <a href="#" class="logo1"><img src="<?php echo get_template_directory_uri() ?>/backend/assets/images/logo-themeoption.png" /></a> <a href="#" class="nav-button"><i class="icon-align-justify"></i></a> </div>
                                <ul>
                                    <?php echo force_balance_tags($return[1], true); ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="col2">
                            <?php echo force_balance_tags($return[0], true); /* Settings */ ?>
                        </div>
                        <div class="clear"></div>
                        <div class="footer">
                            <?php
                            $cs_opt_array = array(
                                'std' => esc_html__('Save All Settings', 'jobcareer'),
                                'id' => '',
                                'classes' => 'bottom_btn_save',
                                'extra_atr' => 'onclick="javascript:jobcareer_theme_option_save(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\');"',
                                'cust_id' => 'submit_btn',
                                'cust_name' => 'submit_btn',
                                'return' => true,
                                'required' => false,
                                'cust_type' => 'button',
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                            $cs_opt_array = array(
                                'std' => 'jobcareer_theme_option_save',
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'cust_id' => 'action',
                                'cust_name' => 'action',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            $cs_opt_array = array(
                                'std' => esc_html__('Reset All Options', 'jobcareer'),
                                'id' => '',
                                'classes' => 'bottom_btn_reset',
                                'extra_atr' => 'onclick="javascript:cs_rest_all_options(\'' . esc_js(admin_url('admin-ajax.php')) . '\', \'' . esc_js(get_template_directory_uri()) . '\');"',
                                'cust_id' => 'reset',
                                'cust_name' => 'reset',
                                'return' => true,
                                'required' => false,
                                'cust_type' => 'button',
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!--wrap--> 
        <script type="text/javascript">
            // Sub Menus Show/hide
            jQuery(document).ready(function ($) {
                'use strict';
                jQuery(".sub-menu").parent("li").addClass("parentIcon");
                $(document).on('click', 'a.nav-button', function () {
                    $(".admin-navigtion").toggleClass("navigation-small");
                });

                $(document).on('click', 'a.nav-button', function () {
                    $(".inner").toggleClass("shortnav");
                });

                $(document).on('click', '.admin-navigtion > ul > li > a', function () {
                    var a = $(this).next('ul')
                    $(".admin-navigtion > ul > li > a").not($(this)).removeClass("changeicon")
                    $(".admin-navigtion > ul > li ul").not(a).slideUp();
                    $(this).next('.sub-menu').slideToggle();
                    $(this).toggleClass('changeicon');
                });
                $('[data-toggle="popover"]').popover('destroy');
            });

            function show_hide(id) {

                "use strict";
                if (id == '#pattern_tab') {
                    jQuery('#cs_custom_bgimage_main').hide();
                }

                if (id == '#custom_image_tab') {
                    jQuery('#cs_custom_bgimage_main').show();
                } else {
                    if (id == '#background_tab_color') {
                        jQuery('#cs_bg_color').show();
                        jQuery('#cs_bgimage_position_select').hide();

                    } else {
                        jQuery('#cs_bg_color').hide();
                        jQuery('#cs_bgimage_position_select').show();
                    }
                }




                var link = id.replace('#', '');
                jQuery('.horizontal_tab').fadeOut(0);
                jQuery('#' + link).fadeIn(400);
            }

            function toggleDiv(id) {
                "use strict";
                jQuery('.col2').children().hide();
                jQuery(id).show();
                location.hash = id + "-show";
                var link = id.replace('#', '');
                jQuery('.categoryitems li').removeClass('active');
                jQuery(".menuheader.expandable").removeClass('openheader');
                jQuery(".categoryitems").hide();
                jQuery("." + link).addClass('active');
                jQuery("." + link).parent("ul").show().prev().addClass("openheader");
            }
            jQuery(document).ready(function () {
                "use strict";
                jQuery(".categoryitems").hide();
                jQuery(".categoryitems:first").show();
                jQuery(".menuheader:first").addClass("openheader");
                jQuery(".menuheader").live('click', function (event) {
                    if (jQuery(this).hasClass('openheader')) {
                        jQuery(".menuheader").removeClass("openheader");
                        jQuery(this).next().slideUp(200);
                        return false;
                    }
                    jQuery(".menuheader").removeClass("openheader");
                    jQuery(this).addClass("openheader");
                    jQuery(".categoryitems").slideUp(200);
                    jQuery(this).next().slideDown(200);
                    return false;
                });

                var hash = window.location.hash.substring(1);
                var id = hash.split("-show")[0];
                if (id) {
                    jQuery('.col2').children().hide();
                    jQuery("#" + id).show();
                    jQuery('.categoryitems li').removeClass('active');
                    jQuery(".menuheader.expandable").removeClass('openheader');
                    jQuery(".categoryitems").hide();
                    jQuery("." + id).addClass('active');
                    jQuery("." + id).parent("ul").slideDown(300).prev().addClass("openheader");
                }
            });
            jQuery(function ($) {
                "use strict";
                $("#cs_launch_date").datepicker({
                    defaultDate: "+1w",
                    dateFormat: "dd/mm/yy",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onSelect: function (selectedDate) {
                        $("#cs_launch_date").datepicker();
                    }
                });
            });
        </script>
        <?php
    }

}

/**
 * @Background Count function
 * @return
 *
 */
if (!function_exists('jobcareer_bgcount')) {

    function jobcareer_bgcount($name, $count) {
        for ($i = 0; $i <= $count; $i++) {
            $pattern['option' . $i] = $name . $i;
        }
        return $pattern;
    }

}

/**
 * @Theme Options Initilize
 * @return
 *
 */
if (!function_exists('jobcareer_theme_option')) {

    function jobcareer_theme_option() {
        global $jobcareer_sett_options, $cs_header_colors, $jobcareer_options;
        $jobcareer_options = get_option('cs_theme_options');
        $on_off_option = array("show" => "on", "hide" => "off");
        $navigation_style = array("left" => "left", "center" => "center", "right" => "right");
        $google_fonts = array('google_font_family_name' => array('', '', ''), 'google_font_family_url' => array('', '', ''));
        $social_network = array('social_net_icon_path' => array('', '', '', '', ''), 'social_net_awesome' => array('icon-facebook9', 'icon-dribbble7', 'icon-twitter2', 'icon-behance2'), 'social_net_url' => array('' . cs_server_protocol() . 'www.facebook.com/', '' . cs_server_protocol() . 'dribbble.com/', '' . cs_server_protocol() . 'www.twitter.com/', '' . cs_server_protocol() . 'www.behance.net/'), 'social_net_tooltip' => array(esc_html__('Facebook', 'jobcareer'), esc_html__('Dribble', 'jobcareer'), esc_html__('Twitter', 'jobcareer'), esc_html__('Behance', 'jobcareer')), 'social_font_awesome_color' => array('#cccccc', '#cccccc', '#cccccc', '#cccccc'));

        $banner_fields = array('banner_field_title' => array(esc_html__('Banner 1', 'jobcareer')), 'banner_field_style' => array('top_banner'), 'banner_field_type' => array('code'), 'banner_field_image' => array(''), 'banner_field_url' => array('#'), 'banner_field_url_target' => array('_self'), 'banner_adsense_code' => array(''), 'banner_field_code_no' => array('0'));
        $sidebar = array(
            'sidebar' => array(
                '' => esc_html__('Please Select', 'jobcareer'),
                'blogs_sidebar' => esc_html__('Blogs Sidebar', 'jobcareer'),
                'faq_sidebar' => esc_html__('Faq Sidebar', 'jobcareer'),
                'price_and_packages' => esc_html__('Price and Packages', 'jobcareer'),
                'cotnact_us' => esc_html__('Contact us', 'jobcareer'),
                'other_pages' => esc_html__('Other pages', 'jobcareer'),
                'home_sidebar' => esc_html__('Home sidebar', 'jobcareer'),
                'job_listing' => esc_html__('Job Listing', 'jobcareer'),
                'employer_listing' => esc_html__('Employer Listing', 'jobcareer'),
                'candidates' => esc_html__('Candidates', 'jobcareer'),
            )
        );

        $footer_sidebar = array(
            'footer_sidebar' => array(
                '' => esc_html__('Please Select', 'jobcareer'),
                'blogs_sidebar' => esc_html__('Blogs Sidebar', 'jobcareer'),
                'faq_sidebar' => esc_html__('Faq Sidebar', 'jobcareer'),
            )
        );


        $menus_locations = array_flip(get_nav_menu_locations());
        $breadcrumb_option = array("option1" => "option1", "option2" => "option2", "option3" => "option3");
        $deafult_sub_header = array('breadcrumbs_sub_header' => esc_html__('Breadcrumbs Sub Header', 'jobcareer'), 'slider' => esc_html__('Revolution Slider', 'jobcareer'), 'no_header' => esc_html__('No sub Header', 'jobcareer'));
        $padding_sub_header = array(esc_html__('Default', 'jobcareer') => 'default', esc_html__('Custom', 'jobcareer') => 'custom');

        #Menus List
        $menu_option = $cs_theme_menus = get_registered_nav_menus();
        foreach ($menu_option as $key => $menu) {
            $menu_location = $key;
            $menu_locations = get_nav_menu_locations();
            $menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
            $menu_name[] = (isset($menu_object->name) ? $menu_object->name : '');
        }

        #Mailchimp List
        $mail_chimp_list[] = '';
        if (isset($jobcareer_options['jobcareer_mailchimp_key'])) {
            $mailchimp_option = $jobcareer_options['jobcareer_mailchimp_key'];
            if ($mailchimp_option <> '' && function_exists('jobcareer_mailchimp_list')) {
                $mc_list = jobcareer_mailchimp_list($mailchimp_option);
                if (is_array($mc_list) && isset($mc_list['data'])) {
                    foreach ($mc_list['data'] as $list) {
                        $mail_chimp_list[$list['id']] = $list['name'];
                    }
                }
            }
        }

        #Map Search Pages
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-ad-search.php',
            'hierarchical' => 0
        ));

        $map_options = array();
        $map_options[] = 'Default';
        foreach ($pages as $page) {
            $map_options[$page->ID] = $page->post_title;
        }

        #google fonts array
        $g_fonts = jobcareer_googlefont_list();
        $g_fonts_atts = jobcareer_get_google_font_attribute();

        global $jobcareer_options;
        if (isset($jobcareer_options) and isset($jobcareer_options['sidebar'])) {
            if (is_array($jobcareer_options['sidebar']) and count($jobcareer_options['sidebar']) > 0) {
                $cs_sidebar = array('sidebar' => $jobcareer_options['sidebar']);
            } else {
                $cs_sidebar = array('sidebar' => array());
            }
        } else {
            $cs_sidebar = $sidebar;
        }
        $sidebar_list[''] = esc_html__('Please Select', 'jobcareer');
        foreach ($cs_sidebar['sidebar'] as $sidebar_var => $sidebar_val) {
            $sidebar_list[$sidebar_var] = $sidebar_val;
        }
        $cs_sidebar['sidebar'] = $sidebar_list;
        if (isset($jobcareer_options) and isset($jobcareer_options['footer_sidebar'])) {
            if (is_array($jobcareer_options['footer_sidebar']) and count($jobcareer_options['footer_sidebar']) > 0) {
                $cs_footer_sidebar = array('footer_sidebar' => $jobcareer_options['footer_sidebar']);
            } else {
                $cs_footer_sidebar = array('footer_sidebar' => array());
            }
        } else {
            $cs_footer_sidebar = $footer_sidebar;
        }
        $footer_sidebar_list[''] = esc_html__('Please Select', 'jobcareer');
        foreach ($cs_footer_sidebar['footer_sidebar'] as $footer_sidebar_var => $footer_sidebar_val) {
            $footer_sidebar_list[$footer_sidebar_var] = $footer_sidebar_val;
        }
        $cs_footer_sidebar['footer_sidebar'] = $footer_sidebar_list;

        #Set the Options Array
        $jobcareer_sett_options = array();
        $cs_header_colors = jobcareer_header_setting();

        #general setting options
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("General", 'jobcareer'),
            "fontawesome" => 'icon-cog3',
            "type" => "heading",
            "options" => array(
                'tab-global-setting' => esc_html__("global", 'jobcareer'),
                'tab-header-options' => esc_html__("Header", 'jobcareer'),
                'tab-sub-header-options' => esc_html__("Sub Header", 'jobcareer'),
                'tab-footer-options' => esc_html__("Footer", 'jobcareer'),
                'tab-social-setting' => esc_html__("social icons", 'jobcareer'),
                'tab-social-network' => esc_html__("social sharing", 'jobcareer'),
                'banner-fields' => esc_html__('Ads Unit Settings', 'jobcareer'),
                'tab-custom-code' => esc_html__("custom code", 'jobcareer'),
            )
        );
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("color", 'jobcareer'),
            "fontawesome" => 'icon-magic',
            "hint_text" => "",
            "type" => "heading",
            "options" => array(
                'tab-general-color' => esc_html__("general", 'jobcareer'),
                'tab-header-color' => esc_html__("Header", 'jobcareer'),
                'tab-topstrip-color' => esc_html__("Top Strip", 'jobcareer'),
                'tab-footer-color' => esc_html__("Footer", 'jobcareer'),
                'tab-heading-color' => esc_html__("headings", 'jobcareer'),
            )
        );
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("typography / fonts", 'jobcareer'),
            "fontawesome" => 'icon-font',
            "desc" => "",
            "hint_text" => "",
            "type" => "heading",
            "options" => array(
                'tab-custom-font' => esc_html__('Custom Font', 'jobcareer'),
                'tab-font-family' => esc_html__('Google Fonts', 'jobcareer'),
            )
        );
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("sidebar", 'jobcareer'),
            "fontawesome" => 'icon-columns',
            "id" => "tab-sidebar",
            "std" => "",
            "type" => "main-heading",
            "options" => ''
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Footer sidebar", 'jobcareer'),
            "fontawesome" => 'icon-columns',
            "id" => "tab-footer-sidebar",
            "std" => "",
            "type" => "main-heading",
            "options" => ''
        );
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("global", 'jobcareer'),
            "id" => "tab-global-setting",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Layout", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set boxed and full width layout for theme", 'jobcareer'),
            "id" => "cs_layout",
            "std" => "full_width",
            "options" => array(
                "boxed" => esc_html__("Boxed", 'jobcareer'),
                "full_width" => esc_html__("Full width", 'jobcareer')
            ),
            "type" => "layout",
        );

        $jobcareer_sett_options[] = array(
            "name" => "",
            "id" => "cs_horizontal_tab",
            "class" => "horizontal_tab",
            "type" => "horizontal_tab",
            "std" => "",
            "options" => array(esc_html__('Background color', 'jobcareer') => 'background_tab_color', esc_html__('Background', 'jobcareer') => 'background_tab', esc_html__('Pattern', 'jobcareer') => 'pattern_tab', esc_html__('Custom Image', 'jobcareer') => 'custom_image_tab')
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for theme background color.", 'jobcareer'),
            "id" => "cs_bg_color",
            "std" => "#f3f3f3",
            "tab" => "background_tab_color",
            "display" => "none",
            "type" => "layout_body_color"
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Background image", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Choose from Predefined Background images.", 'jobcareer'),
            "id" => "jobcareer_bg_image",
            "class" => "cs_background_",
            "path" => "background",
            "tab" => "background_tab",
            "std" => "bg7",
            "type" => "layout_body",
            "display" => "block",
            "options" => jobcareer_bgcount('bg', '10')
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Background pattern", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Choose from Predefined Pattern images.", 'jobcareer'),
            "id" => "jobcareer_bg_image",
            "class" => "cs_background_",
            "path" => "patterns",
            "tab" => "pattern_tab",
            "std" => "bg7",
            "type" => "layout_body",
            "display" => "none",
            "options" => jobcareer_bgcount('pattern', '27')
        );
        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Custom image", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("This option can be used only with Boxed Layout.", 'jobcareer'),
            "mian_id" => "cs_custom_bgimage_main",
            "id" => "cs_custom_bgimage",
            "std" => "",
            "tab" => "custom_image_tab",
            "display" => "none",
            "type" => "upload logo"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Background image position", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Choose image position for body background", 'jobcareer'),
            "id" => "cs_bgimage_position",
            "std" => "Center Repeat",
            "type" => "select",
            'classes' => 'chosen-select-no-single',
            "options" => array(
                "no-repeat center top" => "no-repeat center top",
                "repeat center top" => "repeat center top",
                "no-repeat center" => "no-repeat center",
                "repeat Center" => "repeat Center",
                "no-repeat left top" => "no-repeat left top",
                "repeat left top" => "repeat left top",
                "no-repeat fixed center" => "no-repeat fixed center",
                "no-repeat fixed center / cover" => "no-repeat fixed center / cover"
            )
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Custom favicon", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("An favicon associated with a particular website, typically displayed in the address bar of a browser accessing the site or next to the site name in a user's list of bookmarks. Attach favicon here from media gallery.", 'jobcareer'),
            "id" => "cs_custom_favicon",
            "std" => get_template_directory_uri() . "/assets/images/favicon.png",
            "type" => "upload logo"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Responsive", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("One switch for Responsive On/Off. Responsive Web Design is about using CSS and HTML to resize, hide, shrink, enlarge, or move the content to make it look good on any screen.", 'jobcareer'),
            "id" => "cs_responsive",
            "std" => "on",
            "type" => "checkbox",
            "main_id" => 'cs_responsive_main',
            "options" => $on_off_option
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Default Container Width", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("If you want to set default width for bootstrap container. (without px)", 'jobcareer'),
            "id" => "cs_container_default_width",
            "std" => "",
            "type" => "text"
        );



        $jobcareer_sett_options[] = array("name" => __("Map Style", 'jobcareer'),
            "desc" => "",
            "hint_text" => __("Select Map style for all Maps.", "jobcareer"),
            "id" => "def_map_style",
            "std" => "",
            "type" => "select_values",
            'classes' => 'chosen-select-no-single',
            "options" => array(
                'map-box' => __('Map Box', 'jobcareer'),
                'blue-water' => __('Blue Water', 'jobcareer'),
                'icy-blue' => __('Icy Blue', 'jobcareer'),
                'bluish' => __('Bluish', 'jobcareer'),
                'light-blue-water' => __('Light Blue Water', 'jobcareer'),
                'clad-me' => __('Clad Me', 'jobcareer'),
                'chilled' => __('Chilled', 'jobcareer'),
                'two-tone' => __('Two Tone', 'jobcareer'),
                'light-and-dark' => __('Light and Dark', 'jobcareer'),
                'ilustracao' => __('Ilustracao', 'jobcareer'),
                'flat-pale' => __('Flat Pale', 'jobcareer'),
                'title' => __('Title', 'jobcareer'),
                'moret' => __('Moret', 'jobcareer'),
            ),
        );

//        if (class_exists('wp_jobhunt')) {
//            $jobcareer_sett_options[] = array("name" => esc_html__("Language Settings", 'jobcareer'),
//                "id" => "tab-general-options",
//                "std" => esc_html__("Language Settings", 'jobcareer'),
//                "type" => "section",
//                "options" => ""
//            );
//
//            if (class_exists('cs_framework')) {
//                $dir = cs_framework::plugin_dir() . '/languages/';
//                $cs_plugin_language[''] = esc_html__("Select Language File", 'jobcareer');
//                if (is_dir($dir)) {
//                    if ($dh = opendir($dir)) {
//                        while (($file = readdir($dh)) !== false) {
//                            $ext = pathinfo($file, PATHINFO_EXTENSION);
//                            if ($ext == 'mo') {
//                                $cs_plugin_language[$file] = $file;
//                            }
//                        }
//                        closedir($dh);
//                    }
//                }
//            }
//        }
        // Header options start
        $jobcareer_sett_options[] = array("name" => esc_html__("header", 'jobcareer'),
            "id" => "tab-header-options",
            "type" => "sub-heading"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Header Padding", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Header top/bottom Padding.", 'jobcareer'),
            "id" => "cs_main_header_padding",
            "min" => '0',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Logo", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select your custom logo in png, jpeg and gif format from media.", 'jobcareer'),
            "id" => "cs_custom_logo",
            "std" => get_template_directory_uri() . "/assets/images/logo.png",
            "type" => "upload logo"
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Header for Default Pages", 'jobcareer'),
            "desc" => "",
            "hint_text" => "Select default header style here for all pages.",
            "id" => "cs_header_style",
            "std" => "default-header",
            'classes' => 'chosen-select-no-single',
            "type" => "select_values",
            "options" => array('default-header' => esc_html__("Default Header", 'jobcareer'), 'transparent-header' => esc_html__("Transparent Header", 'jobcareer')),
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Header for Detail Posts", 'jobcareer'),
            "desc" => "",
            "hint_text" => "Select default header style here for all Detail Posts.",
            "id" => "cs_posts_header_style",
            "std" => "default-header",
            'classes' => 'chosen-select-no-single',
            "type" => "select_values",
            "options" => array('default-header' => esc_html__("Default Header", 'jobcareer'), 'transparent-header' => esc_html__("Transparent Header", 'jobcareer')),
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Header Type", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select default header style here for all pages.", "jobcareer"),
            "id" => "cs_header_style_type",
            "std" => "boxed",
            'classes' => 'chosen-select-no-single',
            "type" => "select_values",
            "options" => array('boxed' => esc_html__("Boxed", 'jobcareer'), 'wide' => esc_html__("Wide", 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("logo width", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set exact logo width in pixels.", 'jobcareer'),
            "id" => "cs_logo_width",
            "min" => '0',
            "max" => '210',
            "std" => "189",
            "type" => "range"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Logo Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set exact logo height pixels.", 'jobcareer'),
            "id" => "cs_logo_height",
            "min" => '0',
            "max" => '100',
            "std" => "40",
            "type" => "range"
        );


        $jobcareer_sett_options[] = array("name" => esc_html__("Logo margin top", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set the logo margin from top.", 'jobcareer'),
            "id" => "cs_logo_margint",
            "min" => '0',
            "max" => '200',
            "std" => "18",
            "type" => "range"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Logo margin bottom", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set the logo margin from bottom.", 'jobcareer'),
            "id" => "cs_logo_marginb",
            "min" => '-60',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Logo margin right", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set the logo margin from right.", 'jobcareer'),
            "id" => "cs_logo_marginr",
            "min" => '0',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Logo margin left", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set the logo margin from left.", 'jobcareer'),
            "id" => "cs_logo_marginl",
            "min" => '-20',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        /* header element settings */

        $jobcareer_sett_options[] = array("name" => esc_html__("Header Elements", 'jobcareer'),
            "id" => "tab-header-options",
            "std" => esc_html__("Header Elements", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );


        if (function_exists('is_woocommerce')) {
            $jobcareer_sett_options[] = array(
                "name" => esc_html__("Cart Count", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Enable/Disable Woocommerce Cart Count", 'jobcareer'),
                "id" => "cs_woocommerce_switch",
                "main_id" => 'cs_woocommerce_switch_main',
                "std" => "off",
                "type" => "checkbox",
                "options" => $on_off_option
            );
        }

        $jobcareer_sett_options[] = array("name" => esc_html__("Sticky Header On/Off", 'jobcareer'),
            "desc" => "",
            "id" => "cs_sitcky_header_switch",
            "hint_text" => esc_html__("The sticky header makes your header visible at all times. It's a great feature that allows people to browse faster and consume more of your content.", 'jobcareer'),
            "std" => "off",
            "main_id" => 'cs_sitcky_header_switch_main',
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Sticky Logo", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set sticky header logo from media gallery.", 'jobcareer'),
            "id" => "jobcareer_sticky_logo",
            "std" => get_template_directory_uri() . "/assets/images/logo.png",
            "type" => "upload logo"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Search View", 'jobcareer'),
            "desc" => "",
            "id" => "cs_header_search_view",
            "hint_text" => esc_html__("Set Header Search View", 'jobcareer'),
            "std" => "toggle",
            "type" => "select",
            "options" => array('toggle' => esc_html__("Toggle", 'jobcareer'), 'full_page' => esc_html__("Full Page", 'jobcareer'), 'off' => esc_html__("Off", 'jobcareer'),)
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Nav Sidebar", 'jobcareer'),
            "id" => "tab-navsidebar-options",
            "std" => esc_html__("Nav Sidebar", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Sidebar Icon", 'jobcareer'),
            "desc" => "",
            "id" => "cs_nav_sidebar_icon",
            "hint_text" => '',
            "std" => "after_logo",
            'classes' => 'chosen-select-no-single',
            "type" => "select",
            "options" => array("after_logo" => esc_html__("After Logo", 'jobcareer'), "after_menu" => esc_html__("After Menu", 'jobcareer'), "off" => esc_html__("Off", 'jobcareer'))
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Sidebar Position", 'jobcareer'),
            "desc" => "",
            "id" => "cs_nav_sidebar_pos",
            "hint_text" => '',
            "std" => "left",
            "type" => "select",
            'classes' => 'chosen-select-no-single',
            "options" => array("left-menu" => esc_html__("Left Menu", 'jobcareer'), "top-menu" => esc_html__("Top Menu", 'jobcareer'), "right-menu" => esc_html__("Right Menu", 'jobcareer'), "bottom-menu" => esc_html__("bottom Menu", 'jobcareer'))
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Select Sidebar", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_top_nav_sidebar",
            "std" => "",
            "type" => "select_sidebar",
            'classes' => 'chosen-select',
            "options" => $cs_sidebar
        );


        $jobcareer_sett_options[] = array("name" => esc_html__("Header", 'jobcareer'),
            "id" => "tab-header-options",
            "std" => esc_html__("Header Top Strip", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Top Strip", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_top_strip_switch",
            "std" => "on",
            "type" => "checkbox",
            "main_id" => 'cs_top_strip_switch_main',
            "options" => $on_off_option
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Infobox 1", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_infobox_1",
            "std" => "",
            "type" => "text",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Infobox 2", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_infobox_2",
            "std" => "",
            "type" => "text",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("News Ticker", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_top_newsticker",
            "std" => "",
            "type" => "textarea",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Social Icon", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("N/A", 'jobcareer'),
            "id" => "cs_social_setting_switch",
            "main_id" => 'cs_social_setting_switch_main',
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        if (function_exists('icl_object_id')) {
            $jobcareer_sett_options[] = array("name" => esc_html__("Multi Linguale", 'jobcareer'),
                "desc" => "",
                "hint_text" => '',
                "id" => "cs_multi_setting_switch",
                "std" => "on",
                "type" => "checkbox",
                "main_id" => 'cs_multi_setting_switch_main',
                "options" => $on_off_option
            );
        }

        /* sub header element settings */
        $jobcareer_sett_options[] = array("name" => esc_html__("sub header", 'jobcareer'),
            "id" => "tab-sub-header-options",
            "type" => "sub-heading"
        );



        $jobcareer_sett_options[] = array("name" => esc_html__("Default", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Subheader settings made here will be implemented on all default subheader pages.", 'jobcareer'),
            "id" => "cs_default_header",
            "std" => "breadcrumbs_sub_header",
            "type" => "default header",
            'classes' => 'chosen-select-no-single',
            "options" => $deafult_sub_header
        );

        $jobcareer_sett_options[] = array(
            "type" => "division",
            "enable_id" => "cs_default_header",
            "enable_val" => "no_header",
            "extra_atts" => 'id="cs_no_header_fields"',
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Header Border Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => "No subheader will be implemented on all default subheader pages.",
            "id" => "cs_header_border_color",
            "std" => "",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array(
            "type" => "division_close",
        );

        $jobcareer_sett_options[] = array(
            "type" => "division",
            "enable_id" => "cs_default_header",
            "enable_val" => "slider",
            "extra_atts" => 'id="cs_rev_slider_fields"',
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Revolution Slider", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("For apply revolution  slider on all default subheader pages.", 'jobcareer'),
            "id" => "cs_custom_slider",
            "std" => "",
            "type" => "slider code",
            "options" => '',
            'classes' => '',
        );
        $jobcareer_sett_options[] = array(
            "type" => "division_close",
        );

        $jobcareer_sett_options[] = array(
            "type" => "division",
            "enable_id" => "cs_default_header",
            "enable_val" => "breadcrumbs_sub_header",
            "extra_atts" => 'id="jobcareer_breadcrumbs_fields"',
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Padding Top", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Custom padding for subheader content top area.", 'jobcareer'),
            "id" => "cs_sh_paddingtop",
            "min" => '0',
            "max" => '200',
            "std" => "33",
            "type" => "range"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Padding Bottom", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Custom padding for subheader content bottom area.", 'jobcareer'),
            "id" => "cs_sh_paddingbottom",
            "min" => '0',
            "max" => '200',
            "std" => "30",
            "type" => "range"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Content Text Align", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Align subheader text to left, right and center.", 'jobcareer'),
            "id" => "cs_title_align",
            "std" => "left",
            'classes' => '',
            "type" => "select",
            "options" => $navigation_style
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Page Title", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Turn Page title On/Off from here.", 'jobcareer'),
            "id" => "cs_title_switch",
            "main_id" => 'cs_title_switch_main',
            "std" => "on",
            "type" => "checkbox"
        );


        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Breadcrumbs", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Breadcrumbs enable/disable from subheader.", "jobcareer"),
            "id" => "jobcareer_breadcrumbs_switch",
            "main_id" => 'jobcareer_breadcrumbs_switch_main',
            "std" => "on",
            "type" => "checkbox"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for subheader background.", "jobcareer"),
            "id" => "cs_sub_header_bg_color",
            "std" => "#f8f9f9",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for subheader text.", "jobcareer"),
            "id" => "cs_sub_header_text_color",
            "std" => "#ffffff",
            "type" => "color"
        );
//        $jobcareer_sett_options[] = array("name" => esc_html__("Overlay Color", 'jobcareer'),
//            "desc" => "",
//            "hint_text" => esc_html__("Provide a hex color code here (with #) for Overlay text.", "jobcareer"),
//            "id" => "cs_sub_header_overlay_color",
//            "std" => "",
//            "type" => "color"
//        );
//        $jobcareer_sett_options[] = array(
//            "name" => esc_html__("Overlay Opacity", 'jobcareer'),
//            "desc" => "",
//            "hint_text" => esc_html__("Set the Opacity of Overlay.", "jobcareer"),
//            "id" => "cs_overlay_opacity",
//            'classes' => 'chosen-select-no-single',
//            "main_id" => 'cs_overlay_opacity_main',
//            "std" => "0.5",
//            "type" => "select_values",
//            "options" => array(
//                '0.1' => '0.1',
//                '0.2' => '0.2',
//                '0.3' => '0.3',
//                '0.4' => '0.4',
//                '0.5' => '0.5',
//                '0.6' => '0.6',
//                '0.7' => '0.7',
//                '0.8' => '0.8',
//                '0.9' => '0.9',
//                '1.0' => '1.0',
//            ),
//        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Sub Header Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Sub Header Height", 'jobcareer'),
            "id" => "cs_sub_header_default_h",
            "std" => '',
            "type" => "text"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Background", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select your background image from media.", 'jobcareer'),
            "id" => "cs_background_img",
            "std" => get_template_directory_uri() . "/assets/images/subheader-bg.jpg",
            "type" => "upload logo"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Parallax", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling can be enable with this switch.", "jobcareer"),
            "id" => "cs_parallax_bg_switch",
            "main_id" => 'cs_parallax_bg_switch_main',
            "std" => "off",
            "type" => "checkbox"
        );
        if (class_exists('wp_jobhunt')) {
            $jobcareer_sett_options[] = array("name" => esc_html__('Candidate Sub Header', 'jobcareer'),
                "id" => "tab-candidate-sub-header-page",
                "std" => esc_html__("Candidate Sub Header", 'jobcareer'),
                "type" => "section",
                "options" => "",
            );
//            $jobcareer_sett_options[] = array(
//                "name" => esc_html__("Candidate Header Cover Switch", 'jobcareer'),
//                "desc" => "",
//                "hint_text" => esc_html__("Default Single Candidate Header Cover enable/disable from subheader.", "jobcareer"),
//                "id" => "cs_candidate_default_cover_switch",
//                "main_id" => 'cs_candidate_default_cover_switch',
//                "std" => "on",
//                "type" => "checkbox"
//            );
            $jobcareer_sett_options[] = array("name" => esc_html__("Single Candidate Header Cover", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Set Default Single Candidate Header Cover", 'jobcareer'),
                "id" => "cs_candidate_default_cover",
                "std" => '',
                "type" => "upload logo"
            );
            $jobcareer_sett_options[] = array(
                "name" => esc_html__("Candidate Header Cover Style", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Select Candidate Header Cover Style for sub header.", "jobcareer"),
                "id" => "cs_candidate_default_cover_style",
                "std" => "boxed",
                'classes' => 'chosen-select-no-single',
                "type" => "select_values",
                "options" => array('dark' => esc_html__("Dark", 'jobcareer'), 'light' => esc_html__("Light", 'jobcareer')),
            );


//            $jobcareer_sett_options[] = array(
//                "name" => esc_html__("Candidate Dashboard Header Cover Switch", 'jobcareer'),
//                "desc" => "",
//                "hint_text" => esc_html__("Default Candidate Dashboard Header Cover enable/disable from subheader.", "jobcareer"),
//                "id" => "cs_candidate_dash_default_cover_switch",
//                "main_id" => 'cs_candidate_dash_default_cover_switch',
//                "std" => "on",
//                "type" => "checkbox"
//            );
            $jobcareer_sett_options[] = array("name" => esc_html__("Candidate Dashboard Header Cover", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Set Default Candidate Dashboard Header Cover", 'jobcareer'),
                "id" => "cs_candidate_dash_default_cover",
                "std" => '',
                "type" => "upload logo"
            );
            $jobcareer_sett_options[] = array(
                "name" => esc_html__("Default Candidate Header Cover Style", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Select Default Candidate Header Cover Style for sub header.", "jobcareer"),
                "id" => "cs_candidate_dash_default_cover_style",
                "std" => "boxed",
                'classes' => 'chosen-select-no-single',
                "type" => "select_values",
                "options" => array('dark' => esc_html__("Dark", 'jobcareer'), 'light' => esc_html__("Light", 'jobcareer')),
            );

            $jobcareer_sett_options[] = array("name" => esc_html__('Employer Sub Header', 'jobcareer'),
                "id" => "tab-employer-sub-header-page",
                "std" => esc_html__("Employer Sub Header", 'jobcareer'),
                "type" => "section",
                "options" => "",
            );


//            $jobcareer_sett_options[] = array(
//                "name" => esc_html__("Single Employer Header Cover Switch", 'jobcareer'),
//                "desc" => "",
//                "hint_text" => esc_html__("Default Single Employer Header enable/disable from subheader.", "jobcareer"),
//                "id" => "cs_employer_default_cover_switch",
//                "main_id" => 'cs_employer_default_cover_switch',
//                "std" => "on",
//                "type" => "checkbox"
//            );
            $jobcareer_sett_options[] = array("name" => esc_html__("Single Employer Header Cover", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Set Default Single Employer Header Cover", 'jobcareer'),
                "id" => "cs_employer_default_cover",
                "std" => '',
                "type" => "upload logo"
            );
            $jobcareer_sett_options[] = array(
                "name" => esc_html__("Single Employer Header Cover Style", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Select Single Employer Header Cover Style for sub header.", "jobcareer"),
                "id" => "cs_employer_default_cover_style",
                "std" => "boxed",
                'classes' => 'chosen-select-no-single',
                "type" => "select_values",
                "options" => array('dark' => esc_html__("Dark", 'jobcareer'), 'light' => esc_html__("Light", 'jobcareer')),
            );


//            $jobcareer_sett_options[] = array(
//                "name" => esc_html__("Employer Dashboard Header Cover Swicth", 'jobcareer'),
//                "desc" => "",
//                "hint_text" => esc_html__("Employer Dashboard Header Cover enable/disable from subheader.", "jobcareer"),
//                "id" => "cs_employer_dash_default_cover_switch",
//                "main_id" => 'cs_employer_dash_default_cover_switch',
//                "std" => "on",
//                "type" => "checkbox"
//            );
            $jobcareer_sett_options[] = array("name" => esc_html__("Employer Dashboard Header Cover", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Set Default Employer Dashboard Header Cover", 'jobcareer'),
                "id" => "cs_employer_dash_default_cover",
                "std" => '',
                "type" => "upload logo"
            );
            $jobcareer_sett_options[] = array(
                "name" => esc_html__("Select Default Employer Header Cover Style", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Select Default Employer  Header Cover Style for sub header.", "jobcareer"),
                "id" => "cs_employer_dash_default_cover_Style",
                "std" => "boxed",
                'classes' => 'chosen-select-no-single',
                "type" => "select_values",
                "options" => array('dark' => esc_html__("Dark", 'jobcareer'), 'light' => esc_html__("Light", 'jobcareer')),
            );

            $jobcareer_sett_options[] = array("name" => esc_html__('Job Sub Header', 'jobcareer'),
                "id" => "tab-job-sub-header-page",
                "std" => esc_html__("Job Sub Header", 'jobcareer'),
                "type" => "section",
                "options" => "",
            );
//            $jobcareer_sett_options[] = array(
//                "name" => esc_html__("Job Header Cover Switch", 'jobcareer'),
//                "desc" => "",
//                "hint_text" => esc_html__("Single Job Header Cover enable/disable from subheader.", "jobcareer"),
//                "id" => "cs_job_default_cover_switch",
//                "main_id" => 'cs_job_default_cover_switch',
//                "std" => "on",
//                "type" => "checkbox"
//            );
            $jobcareer_sett_options[] = array("name" => esc_html__("Single Job Header Cover", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Set Default Single Job Header Cover", 'jobcareer'),
                "id" => "cs_job_default_cover",
                "std" => '',
                "type" => "upload logo"
            );
            $jobcareer_sett_options[] = array(
                "name" => esc_html__("Select Default Single Job Header Cover Style", 'jobcareer'),
                "desc" => "",
                "hint_text" => esc_html__("Select Default Single Job  Header Cover Style for sub header.", "jobcareer"),
                "id" => "cs_job_default_cover_style",
                "std" => "boxed",
                'classes' => 'chosen-select-no-single',
                "type" => "select_values",
                "options" => array('dark' => esc_html__("Dark", 'jobcareer'), 'light' => esc_html__("Light", 'jobcareer')),
            );
        }


        $jobcareer_sett_options[] = array(
            "type" => "division_close",
        );

        // start footer options    

        $jobcareer_sett_options[] = array("name" => esc_html__("footer options", 'jobcareer'),
            "id" => "tab-footer-options",
            "type" => "sub-heading"
        );




        $jobcareer_sett_options[] = array("name" => esc_html__("Footer section", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Switch for enable/diable footer area.", 'jobcareer'),
            "id" => "cs_footer_switch",
            "main_id" => 'cs_footer_switch_main',
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $jobcareer_sett_options[] = array(
            "name" => esc_html__("Select Footer", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__('Select default footer style here for all pages.', 'jobcareer'),
            "id" => "cs_footer_style",
            "std" => "default-footer",
            'classes' => 'chosen-select-no-single',
            "type" => "select_values",
            "options" => array('default-footer' => esc_html__("Default Footer", 'jobcareer'), 'fancy-footer' => esc_html__("Fancy Footer", 'jobcareer'), 'modern-footer' => esc_html__("Modern Footer", 'jobcareer')),
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Widgets", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Switch for enable/diable footer widgets.", 'jobcareer'),
            "id" => "cs_footer_widget",
            "main_id" => 'cs_footer_widget_main',
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option
        );


        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Social Icons", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Enable/disable footer social icon from here.", 'jobcareer'),
            "id" => "cs_sub_footer_social_icons",
            "main_id" => 'cs_sub_footer_social_icons',
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option,
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Menu", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Enable/disable footer menu from here.", 'jobcareer'),
            "id" => "cs_sub_footer_menu",
            "main_id" => 'cs_sub_footer_menu_main',
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option,
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Back to top", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Enable/Disable back to top button.", 'jobcareer'),
            "id" => "cs_footer_back_to_top",
            "main_id" => 'cs_footer_back_to_top_main',
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option,
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Logo", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Choose footer logo from media gallery.", 'jobcareer'),
            "id" => "jobcareer_footer_logo",
            "std" => get_template_directory_uri() . "/assets/images/foot-logo.png",
            "type" => "upload logo");

        $jobcareer_sett_options[] = array("name" => esc_html__("Footer logo Link", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Enter footer logo link here", 'jobcareer'),
            "id" => "cs_tripadvisor_logo_link",
            "std" => "",
            "type" => "text");

        $jobcareer_sett_options[] = array("name" => esc_html__("Copyright Text", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Enter copyright text here.", 'jobcareer'),
            "id" => "cs_copy_right",
            "std" => "&copy; " . esc_html__('2014 Jobhunt Name All rights reserved. Design by', 'jobcareer') . " <a class='cscolor' href='#'>" . esc_html__('Chimp Studio', 'jobcareer') . "</a>",
            "type" => "textarea"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Widgets", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select footer widget space with this dropdown", 'jobcareer'),
            "id" => "cs_footer_widget_sidebar",
            "std" => "",
            'classes' => 'chosen-select-no-single',
            "type" => "select_sidebar",
            "options" => $cs_sidebar,
        );
        // End footer tab setting
        /* general colors */
        $jobcareer_sett_options[] = array("name" => esc_html__("general colors", 'jobcareer'),
            "id" => "tab-general-color",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Theme Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for theme.", 'jobcareer'),
            "id" => "cs_theme_color",
            "std" => "#3e5d89",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Body Text Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for theme body text color.", 'jobcareer'),
            "id" => "cs_text_color",
            "std" => "#333333",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Sidebar Widget title color", 'jobcareer'),
            "desc" => "",
            "id" => "cs_widget_color",
            "std" => "#b59759",
            "type" => "color",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for sidebar widget color.", 'jobcareer'),
        );

        // start top strip tab options
        $jobcareer_sett_options[] = array("name" => esc_html__("header colors", 'jobcareer'),
            "id" => "tab-header-color",
            "type" => "sub-heading"
        );

        // start header color tab options
        $jobcareer_sett_options[] = array("name" => esc_html__("Header Colors", 'jobcareer'),
            "id" => "tab-header-color",
            "std" => esc_html__("Header Colors", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for header background color.", 'jobcareer'),
            "id" => "cs_header_bgcolor",
            "std" => "#ffffff",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Navigation Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for navigation background color.", 'jobcareer'),
            "id" => "cs_nav_bgcolor",
            "std" => "#ffffff",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Menu Link color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for menu link color.", 'jobcareer'),
            "id" => "cs_menu_color",
            "std" => "#f2f2f2",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Menu Heading color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for menu link color.", 'jobcareer'),
            "id" => "cs_menu_heading_color",
            "std" => "#f2f2f2",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Menu Hover Link color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for menu hover link color.", 'jobcareer'),
            "id" => "cs_menu_active_color",
            "std" => "#1e73be",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Submenu Background", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for submenu background color.", 'jobcareer'),
            "id" => "cs_submenu_bgcolor",
            "std" => "#ffffff",
            "type" => "color",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Submenu Link Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for submenu link color.", 'jobcareer'),
            "id" => "cs_submenu_color",
            "std" => "#4c545a",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Submenu Hover Link Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for sidebar widget color.", 'jobcareer'),
            "id" => "cs_submenu_hover_color",
            "std" => "#1e73be",
            "type" => "color"
        );

        // start top strip tab options
        $jobcareer_sett_options[] = array("name" => esc_html__("Top Strip colors", 'jobcareer'),
            "id" => "tab-topstrip-color",
            "type" => "sub-heading"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_topstr_bg_color",
            "std" => "",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Text Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_topstr_text_color",
            "std" => "",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Link Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_topstr_link_color",
            "std" => "",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Link Hover Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_topstr_linkhover_color",
            "std" => "",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Icons Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_topstr_icon_color",
            "std" => "",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Icons Hover Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_topstr_iconhover_color",
            "std" => "",
            "type" => "color"
        );

        /* footer colors */
        $jobcareer_sett_options[] = array("name" => esc_html__("footer colors", 'jobcareer'),
            "id" => "tab-footer-color",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for footer background color.", 'jobcareer'),
            "id" => "cs_footerbg_color",
            "std" => "#2d3037",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Top Border Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for footer top border color.", 'jobcareer'),
            "id" => "cs_footer_top_border_color",
            "std" => "#2d3037",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Text Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for footer text color.", 'jobcareer'),
            "id" => "cs_footer_text_color",
            "std" => "#ffffff",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Link Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for footer link color.", 'jobcareer'),
            "id" => "cs_link_color",
            "std" => "#777777",
            "type" => "color"
        );


        $jobcareer_sett_options[] = array("name" => esc_html__("Copyright Text", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for footer copyright text color.", 'jobcareer'),
            "id" => "cs_copyright_text_color",
            "std" => "#cccccc",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Copyright Background Color", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for footer copyright section background color.", 'jobcareer'),
            "id" => "cs_copyright_bg_color",
            "std" => "#2d3037",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Widgets Title", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_ft_widget_title_color",
            "std" => "#333333",
            "type" => "color"
        );



        /* heading colors */
        $jobcareer_sett_options[] = array("name" => esc_html__("heading colors", 'jobcareer'),
            "id" => "tab-heading-color",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("heading h1", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for heading 1 color.", 'jobcareer'),
            "id" => "cs_heading_h1_color",
            "std" => "#2d2d2d",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("heading h2", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for heading 2 color.", 'jobcareer'),
            "id" => "cs_heading_h2_color",
            "std" => "#2d2d2d",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("heading h3", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for heading 3 color.", 'jobcareer'),
            "id" => "cs_heading_h3_color",
            "std" => "#2d2d2d",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("heading h4", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for heading 4 color.", 'jobcareer'),
            "id" => "cs_heading_h4_color",
            "std" => "#2d2d2d",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("heading h5", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for heading 5 color.", 'jobcareer'),
            "id" => "cs_heading_h5_color",
            "std" => "#2d2d2d",
            "type" => "color"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("heading h6", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Provide a hex color code here (with #) for heading 6 color.", 'jobcareer'),
            "id" => "cs_heading_h6_color",
            "std" => "#2d2d2d",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Element Title", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_title_color",
            "std" => "#333333",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Post Title", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_post_title_color",
            "std" => "#333333",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Page Title", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_page_title_color",
            "std" => "#333333",
            "type" => "color"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Widgets Title", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_title_color",
            "std" => "#333333",
            "type" => "color"
        );



        /* start custom font family */
        $jobcareer_sett_options[] = array("name" => esc_html__("Custom Font", 'jobcareer'),
            "id" => "tab-custom-font",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Custom Font .woff", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Upload Your Custom Font file in .woff format", 'jobcareer'),
            "id" => "cs_custom_font_woff",
            "std" => "",
            "type" => "upload font"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Custom Font .ttf", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Upload Your  Custom Font file in .ttf format", 'jobcareer'),
            "id" => "cs_custom_font_ttf",
            "std" => "",
            "type" => "upload font"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Custom Font .svg", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Upload Your  Custom Font file in .svg format", 'jobcareer'),
            "id" => "cs_custom_font_svg",
            "std" => "",
            "type" => "upload font"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Custom Font .eot", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Upload Your Custom Font file in  .eot format", 'jobcareer'),
            "id" => "cs_custom_font_eot",
            "std" => "",
            "type" => "upload font"
        );


        $jobcareer_sett_options[] = array("name" => esc_html__("Google Fonts", 'jobcareer'),
            "id" => "tab-font-family",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Content Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set fonts for Body text", 'jobcareer'),
            "id" => "cs_content_font",
            "std" => "Raleway",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_content_font_att",
            "std" => "500",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_content_size",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_content_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_content_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_content_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Main Menu Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set font for main Menu. It will be applied to sub menu as well", 'jobcareer'),
            "id" => "cs_mainmenu_font",
            "std" => "Raleway",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_mainmenu_font_att",
            "std" => "700",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mainmenu_size",
            "min" => '6',
            "max" => '50',
            "std" => "14",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mainmenu_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mainmenu_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mainmenu_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 1 Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select font for Headings. It will apply on all posts and pages headings", 'jobcareer'),
            "id" => "cs_heading1_font",
            "std" => "Montserrat",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_heading1_font_att",
            "std" => "700",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_1_size",
            "min" => '6',
            "max" => '50',
            "std" => "36",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_1_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_1_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_1_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 2 Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select font for Headings. It will apply on all posts and pages headings", 'jobcareer'),
            "id" => "cs_heading2_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_heading2_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_2_size",
            "min" => '6',
            "max" => '50',
            "std" => "30",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_2_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_2_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_2_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 3 Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select font for Headings. It will apply on all posts and pages headings", 'jobcareer'),
            "id" => "cs_heading3_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_heading3_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 3 Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_3_size",
            "min" => '6',
            "max" => '50',
            "std" => "26",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_3_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_3_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => 'none', 'capitalize' => 'capitalize', 'uppercase' => 'uppercase', 'lowercase' => 'lowercase', 'initial' => 'initial', 'inherit' => 'inherit',),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_3_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 4 Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select font for Headings. It will apply on all posts and pages headings", 'jobcareer'),
            "id" => "cs_heading4_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_heading4_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_4_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_4_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_4_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_4_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 5 Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select font for Headings. It will apply on all posts and pages headings", 'jobcareer'),
            "id" => "cs_heading5_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_heading5_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_5_size",
            "min" => '6',
            "max" => '50',
            "std" => "18",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_5_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_5_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_5_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Heading 6 Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select font for Headings. It will apply on all posts and pages headings", 'jobcareer'),
            "id" => "cs_heading6_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_heading6_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_6_size",
            "min" => '6',
            "max" => '50',
            "std" => "16",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_6_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_6_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_6_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Element Title Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set font for Element Title Headings", 'jobcareer'),
            "id" => "cs_section_title_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_section_title_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_title_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_title_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_title_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_title_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Page Title Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set font for Page Title Headings", 'jobcareer'),
            "id" => "cs_page_title_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_page_title_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_page_title_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_page_title_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_page_title_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_page_title_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Post Title Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set font for Post Title Headings", 'jobcareer'),
            "id" => "cs_post_title_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_post_title_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_post_title_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_post_title_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_post_title_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_post_title_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Sidebar Widget Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set font for Widget Headings", 'jobcareer'),
            "id" => "cs_widget_heading_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_widget_heading_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_heading_size",
            "min" => '6',
            "max" => '50',
            "std" => "18",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_heading_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_heading_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_heading_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Widget Font", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set font for Footer Widget Headings", 'jobcareer'),
            "id" => "cs_ft_widget_heading_font",
            "std" => "",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Font Attribute", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Font Attribute", 'jobcareer'),
            "id" => "cs_ft_widget_heading_font_att",
            "std" => "",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Size", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_ft_widget_heading_size",
            "min" => '6',
            "max" => '50',
            "std" => "18",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Line Height", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_ft_widget_heading_lh",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Text Transform", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_ft_widget_heading_textr",
            "std" => "none",
            "type" => "select_ftext",
            "options" => array('none' => esc_html__('none', 'jobcareer'), 'capitalize' => esc_html__('capitalize', 'jobcareer'), 'uppercase' => esc_html__('uppercase', 'jobcareer'), 'lowercase' => esc_html__('lowercase', 'jobcareer'), 'initial' => esc_html__('initial', 'jobcareer'), 'inherit' => esc_html__('inherit', 'jobcareer')),
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Letter Spacing", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_ft_widget_heading_spc",
            "min" => '6',
            "max" => '50',
            "std" => "13",
            "type" => "range_font",
        );


        /* social icons setting */
        $jobcareer_sett_options[] = array("name" => esc_html__("social icons", 'jobcareer'),
            "id" => "tab-social-setting",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Social Network", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "jobcareer_social_network",
            "std" => "",
            "type" => "networks",
            "options" => $social_network
        );
        /* social Network setting */
        $jobcareer_sett_options[] = array("name" => esc_html__("social Sharing", 'jobcareer'),
            "id" => "tab-social-network",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Facebook", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_facebook_share",
            "std" => "on",
            "main_id" => 'cs_facebook_share_main',
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Twitter", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_twitter_share",
            "main_id" => 'cs_twitter_share_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Google Plus", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_google_plus_share",
            "main_id" => 'cs_google_plus_share_main',
            "std" => "off",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Tumblr", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_tumblr_share",
            "main_id" => 'cs_tumblr_share_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Dribble", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_dribbble_share",
            "main_id" => 'cs_dribbble_share_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Instagram", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_instagram_share",
            "main_id" => 'cs_instagram_share_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("StumbleUpon", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_stumbleupon_share",
            "main_id" => 'cs_stumbleupon_share_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("youtube", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_youtube_share",
            "main_id" => 'cs_youtube_share_main',
            "std" => "on",
            "type" => "checkbox");



        $jobcareer_sett_options[] = array("name" => esc_html__("share more", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_share_share",
            "main_id" => 'cs_share_share_main',
            "std" => "on",
            "type" => "checkbox");
        /* custom code setting */


        $jobcareer_sett_options[] = array("name" => esc_html__("custom code", 'jobcareer'),
            "id" => "tab-custom-code",
            "with_col" => true,
            "type" => "sub-heading"
        );



        $jobcareer_sett_options[] = array("name" => esc_html__("Custom Css", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Custom css linked with theme css user can add own custom styling without editing any css file.", 'jobcareer'),
            "id" => "cs_custom_css",
            "std" => "",
            "type" => "textarea"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Custom JavaScript", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("User can add own custom JS without editing any js file.", 'jobcareer'),
            "id" => "cs_custom_js",
            "std" => "",
            "type" => "textarea"
        );

        $jobcareer_sett_options[] = array(
            "col_heading" => esc_html__("About Custom Code!", 'jobcareer'),
            "type" => "col-right-text",
            "help_text" => esc_html__("", 'jobcareer'),
        );

        // req
        $jobcareer_sett_options[] = array("name" => esc_html__("Ads Unit", 'jobcareer'),
            "id" => "banner-fields",
            "with_col" => true,
            "type" => "sub-heading"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Ads Unit Settings", 'jobcareer'),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_banner_fields",
            "std" => "",
            "type" => "banner_fields",
            "options" => $banner_fields
        );

        $jobcareer_sett_options[] = array("col_heading" => esc_html__("About Add Unit!", 'jobcareer'),
            "type" => "col-right-text",
            "help_text" => ""
        );
        // req

        /* sidebar tab */
        $jobcareer_sett_options[] = array("name" => esc_html__("sidebar", 'jobcareer'),
            "id" => "tab-sidebar",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Sidebar", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select a sidebar from the list already given. (Nine pre-made sidebars are given)", 'jobcareer'),
            "id" => "cs_sidebar",
            'classes' => 'chosen-select',
            "std" => $sidebar,
            "type" => "sidebar",
            "options" => $sidebar
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("post layout", 'jobcareer'),
            "id" => "cs_non_metapost_layout",
            "std" => esc_html__("Default Single Post Layout", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Single Post Layout", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Its default settings for single post layout.", 'jobcareer'),
            "id" => "cs_single_post_layout",
            "std" => "sidebar_right",
            'classes' => 'chosen-select-no-single',
            "type" => "layout",
            "options" => array(
                "no_sidebar" => esc_html__("full width", 'jobcareer'),
                "sidebar_left" => esc_html__("sidebar left", 'jobcareer'),
                "sidebar_right" => esc_html__("sidebar right", 'jobcareer'),
            )
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Single Layout Sidebar", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select your Single post selector.", 'jobcareer'),
            "id" => "cs_single_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar",
            'classes' => 'chosen-select',
            "options" => $cs_sidebar
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("default pages", 'jobcareer'),
            "id" => "default_pages",
            "std" => esc_html__("Default Page Layout", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Default Pages Layout", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Its default settings for single page layout.", 'jobcareer'),
            "id" => "cs_default_page_layout",
            "std" => "sidebar_right",
            "type" => "layout",
            "options" => array(
                "sidebar_left" => esc_html__("sidebar left", 'jobcareer'),
                "sidebar_right" => esc_html__("sidebar right", 'jobcareer'),
                "no_sidebar" => esc_html__("full width", 'jobcareer'),
            )
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Sidebar", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select pre-made sidebars for default pages on sidebar layout. Full width layout cannot have sidebars", 'jobcareer'),
            "id" => "cs_default_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar1",
            'classes' => 'chosen-select',
            "options" => $cs_sidebar
        );


        $jobcareer_sett_options[] = array("name" => esc_html__('Default Page Content', 'jobcareer'),
            "id" => "tab-default-page-content",
            "std" => esc_html__("Default Page Content", 'jobcareer'),
            "type" => "section",
            "options" => "",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Default Excerpt Length (in words)", 'jobcareer'),
            "desc" => "",
            "hint_text" => '',
            "id" => "cs_excerpt_length",
            "std" => "30",
            "type" => "text",
        );


        /* Footer sidebar tab */
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer sidebar", 'jobcareer'),
            "id" => "tab-footer-sidebar",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Footer Sidebar", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select a sidebar from the list already given. (Nine pre-made sidebars are given)", 'jobcareer'),
            "id" => "cs_footer_sidebar",
            'classes' => 'chosen-select',
            "std" => $footer_sidebar,
            "type" => "footer_sidebar",
            "options" => $footer_sidebar
        );

        /*  Maintenance Mode */
        $jobcareer_sett_options[] = array("name" => esc_html__("Maintenance Mode", 'jobcareer'),
            "fontawesome" => 'icon-tasks',
            "id" => "tab-maintenace-mode",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Maintenance Mode", 'jobcareer'),
            "id" => "tab-maintenace-mode",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Maintenace Page", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Users will see Maintenance page & logged in Admin will see normal site.", 'jobcareer'),
            "id" => "cs_maintenance_page_switch",
            "main_id" => 'cs_maintenance_page_switch_main',
            "std" => "off",
            "type" => "checkbox");

        $jobcareer_sett_options[] = array("name" => esc_html__("Show Logo", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Show/Hide logo on Maintenance. Logo can be uploaded from General > Header in CS Theme options.", 'jobcareer'),
            "id" => "cs_maintenance_logo_switch",
            "main_id" => 'cs_maintenance_logo_switch_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Show Newsletter", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Show/Hide NewsLetter from maintenance page.", 'jobcareer'),
            "id" => "cs_maintenance_newsletter_switch",
            "main_id" => 'cs_maintenance_newsletter_switch_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Newsletter Text", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Add newsletter text here.", 'jobcareer'),
            "id" => "cs_newsletter_text",
            "std" => esc_html__("Weekly Newsletter", 'jobcareer'),
            "type" => "text"
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Social Icons", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("On/Off social network from maintenance page.", 'jobcareer'),
            "id" => "cs_maintenance_social_switch",
            "main_id" => 'cs_maintenance_social_switch_main',
            "std" => "on",
            "type" => "checkbox");
        $jobcareer_sett_options[] = array("name" => esc_html__("Social Text", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Add your social text here.", 'jobcareer'),
            "id" => "cs_social_text",
            "std" => "Follow Us",
            "type" => "text"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Maintenance Image", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Add Maintenance page image in JPG, GIF and PNG format.", 'jobcareer'),
            "id" => "cs_maintenance_bg_img",
            "std" => get_template_directory_uri() . "/assets/images/undrconstruction.png",
            "type" => "upload logo"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Maintenance Page Logo", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Add your maintenance page logo in JPG, PNG and GIF format.", 'jobcareer'),
            "id" => "cs_maintenance_custom_logo",
            "std" => get_template_directory_uri() . "/assets/images/under-logo.png",
            "type" => "upload logo"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Maintenance Text", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Text for Maintenance page. Insert some basic HTML or use shortcodes here.", 'jobcareer'),
            "id" => "cs_maintenance_text",
            "std" => "<h1>" . esc_html__('Sorry, We are down for maintenance', 'jobcareer') . " </h1><p>" . esc_html__('We are currently under maintenance, if all goes as planned we will be back in', 'jobcareer') . "</p>",
            "type" => "textarea"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Launch Date", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Set Estimated date for completion of site on Maintenance page.", 'jobcareer'),
            "id" => "cs_launch_date",
            "std" => gmdate("dd/mm/yy"),
            "type" => "text"
        );


        $jobcareer_sett_options[] = array("name" => esc_html__('Coming Soon Page', 'jobcareer'),
            "id" => "tab-upcoming-page",
            "std" => esc_html__("Coming Soon Page", 'jobcareer'),
            "type" => "section",
            "options" => "",
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Content", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("This Content will print on frontend.", 'jobcareer'),
            "id" => "cs_job_upcoming_con",
            "std" => "",
            "type" => "textarea",
        );
        /* api options tab */
        $jobcareer_sett_options[] = array("name" => esc_html__("Api settings", 'jobcareer'),
            "fontawesome" => 'icon-chain',
            "id" => "tab-api-options",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        //Start Twitter Api    
        $jobcareer_sett_options[] = array("name" => esc_html__("All api settings", 'jobcareer'),
            "id" => "tab-api-options",
            "with_col" => true,
            "type" => "sub-heading"
        );

        //start mailChimp api
        $jobcareer_sett_options[] = array("name" => esc_html__("Mail Chimp", 'jobcareer'),
            "id" => "mailchimp",
            "std" => esc_html__("Mail Chimp", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Mail Chimp Key", 'jobcareer'),
            "desc" => esc_html__("Enter a valid Mail Chimp API key here to get started. Once you've done that, you can use the Mail Chimp Widget from the Widgets menu. You will need to have at least Mail Chimp list set up before the using the widget. You can get your mail chimp activation key", 'jobcareer'),
            "hint_text" => esc_html__("Get your mailchimp key by <a href='https://login.mailchimp.com/' target='_blank'>Clicking Here </a>", 'jobcareer'),
            "id" => "jobcareer_mailchimp_key",
            "std" => "90f86a57314446ddbe87c57acc930ce8-us2",
            "type" => "text"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Mail Chimp List", 'jobcareer'),
            "desc" => "",
            "hint_text" => "Mail chimp list select from dropdown.",
            "id" => "jobcareer_mailchimp_list",
            "std" => "on",
            'classes' => 'chosen-select-no-single',
            "type" => "mailchimp",
            "options" => $mail_chimp_list
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Flickr API Setting", 'jobcareer'),
            "id" => "flickr_api_setting",
            "std" => esc_html__("Flickr API Setting", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Flickr key", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("add your flickr key here.", 'jobcareer'),
            "id" => "flickr_key",
            "std" => "",
            "type" => "text");
        $jobcareer_sett_options[] = array("name" => esc_html__("Flickr secret", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("add your flickr secret key here.", 'jobcareer'),
            "id" => "flickr_secret",
            "std" => "",
            "type" => "text");
        $jobcareer_sett_options[] = array("name" => esc_html__("Twitter", 'jobcareer'),
            "id" => "Twitter",
            "std" => esc_html__("Twitter", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );

        $jobcareer_sett_options[] = array("name" => esc_html__("Consumer Key", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("insert your consumer key here.", 'jobcareer'),
            "id" => "cs_consumer_key",
            "std" => "",
            "type" => "text");
        $jobcareer_sett_options[] = array("name" => esc_html__("Cache Time Limit", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Please enter the time limit in minutes for refresh cache", 'jobcareer'),
            "id" => "cs_cache_limit_time",
            "std" => "",
            "type" => "text");

        $jobcareer_sett_options[] = array("name" => esc_html__("Number of tweet", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Please enter number of tweet that you get from twitter for cache file.", 'jobcareer'),
            "id" => "cs_tweet_num_post",
            "std" => "",
            "type" => "text");

        $jobcareer_sett_options[] = array("name" => esc_html__("Date Time Formate", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Select date time formate for every tweet.", 'jobcareer'),
            "id" => "cs_twitter_datetime_formate",
            "std" => "",
            'classes' => 'chosen-select-no-single',
            "type" => "select_values",
            "options" => array(
                'default' => esc_html__('Displays November 06 2012', 'jobcareer'),
                'eng_suff' => esc_html__('Displays 6th November', 'jobcareer'),
                'ddmm' => esc_html__('Displays 06 Nov', 'jobcareer'),
                'ddmmyy' => esc_html__('Displays 06 Nov 2012', 'jobcareer'),
                'full_date' => esc_html__('Displays Tues 06 Nov 2012', 'jobcareer'),
                'time_since' => esc_html__('Displays in hours, minutes etc', 'jobcareer'),
            )
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Consumer Secret", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("insert your consumer secret key here.", 'jobcareer'),
            "id" => "cs_consumer_secret",
            "std" => "",
            "type" => "text");
        $jobcareer_sett_options[] = array("name" => esc_html__("Access Token", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("insert access token here.", 'jobcareer'),
            "id" => "cs_access_token",
            "std" => "",
            "type" => "text");
        $jobcareer_sett_options[] = array("name" => esc_html__("Access Token Secret", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("insert access token secret here.", 'jobcareer'),
            "id" => "cs_access_token_secret",
            "std" => "",
            "type" => "text");
        //end Twitter Api
		
		$jobcareer_sett_options[] = array("name" => esc_html__("Google", 'jobcareer'),
            "id" => "Google",
            "std" => esc_html__("Google", 'jobcareer'),
            "type" => "section",
            "options" => ""
        );
		$jobcareer_sett_options[] = array("name" => esc_html__("Google API Key", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("Google API Key", 'jobcareer'),
            "id" => "cs_googleapi_key",
            "std" => "",
            "type" => "text"
		);
		
        $jobcareer_sett_options[] = array("col_heading" => esc_html__("Attention for API Settings!", 'jobcareer'),
            "type" => "col-right-text",
            "help_text" => ""
        );

		/*  Automatic Updater */
        $jobcareer_sett_options[] = array("name" => esc_html__("Auto Update", 'jobcareer'),
            "fontawesome" => 'icon-tasks',
            "id" => "tab-auto-updater",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Auto Update Theme", 'jobcareer'),
            "id" => "tab-auto-updater",
			"with_col" => true,
            "type" => "sub-heading"
        );
		$jobcareer_sett_options[] = array("name" => esc_html__("Automatic Upgrade", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("", 'jobcareer'),
            "id" => "cs_backup_options",
            "std" => "",
            "type" => "automatic_upgrade"
        );
		$jobcareer_sett_options[] = array("name" => esc_html__("Marketplace Username", 'jobcareer'),
			"desc" => "",
			"hint_text" => esc_html__("Enter your Marketplace Username.", 'jobcareer'),
			"id" => "cs_marketplace_username",
			"std" => "",
			"type" => "text");
		$jobcareer_sett_options[] = array("name" => esc_html__("Secret API Key", 'jobcareer'),
			"desc" => "",
			"hint_text" => esc_html__("Enter your Secret API key.", 'jobcareer'),
			"id" => "cs_secret_api_key",
			"std" => "",
			"type" => "text");
		$jobcareer_sett_options[] = array("name" => esc_html__("Skip Theme Backup", 'jobcareer'),
			"desc" => "",
			"hint_text" => esc_html__("Do you want to skip theme backup?", 'jobcareer'),
			"id" => "cs_skip_theme_backup",
			"std" => "on",
			"type" => "checkbox",
		);
		$jobcareer_sett_options[] = array("col_heading" => esc_html__("Attention User Account Information!", 'jobcareer'),
			"type" => "col-right-text",
			"help_text" => "To obtain your API Key, visit your \"My Settings\" page on any of the Envato 
							Marketplaces. Once a valid connection has been made any changes to the API 
							key below for this username will not effect the results for 5 minutes 
							because they're cached in the database. If you have already made an API 
							connection and just purchase a theme and it's not showing up, wait five 
							minutes and refresh the page. If the theme is still not showing up, it's 
							possible the author has not made it available for auto install yet."
		);

        #import and export theme options tab
        $jobcareer_sett_options[] = array("name" => esc_html__("import & export", 'jobcareer'),
            "fontawesome" => 'icon-database',
            "id" => "tab-import-export-options",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("import & export", 'jobcareer'),
            "id" => "tab-import-export-options",
            "type" => "sub-heading"
        );
        $jobcareer_sett_options[] = array("name" => esc_html__("Backup", 'jobcareer'),
            "desc" => "",
            "hint_text" => esc_html__("", 'jobcareer'),
            "id" => "cs_backup_options",
            "std" => "",
            "type" => "generate_backup"
        );
        if (class_exists('cs_widget_data')) {

            $jobcareer_sett_options[] = array("name" => esc_html__("Widgets Backup Options", 'jobcareer'),
                "std" => esc_html__("Widgets Backup Options", 'jobcareer'),
                "id" => "widgets-bakups-options",
                "type" => "section"
            );
            $jobcareer_sett_options[] = array("name" => esc_html__("Widgets Backup", 'jobcareer'),
                "desc" => "",
                "hint_text" => '',
                "id" => "cs_widgets_backup",
                "std" => "",
                "type" => "widgets_backup"
            );
        }

        $jobcareer_sett_options[] = array(
            "id" => "jobcareer_theme_option_save_flag",
            "std" => md5(uniqid(rand(), true)),
            "type" => "hidden");

        update_option('cs_theme_data', $jobcareer_sett_options);
        // create css file when them option call
        jobcareer_write_stylesheet_content();
    }

}

/**
 *
 *
 * Header Colors Setting
 */
if (!function_exists('jobcareer_header_setting')) {


    function jobcareer_header_setting() {
        global $cs_header_colors;
        $cs_header_colors = array();
        $cs_header_colors['header_colors'] = array(
            'header_1' => array(
                'color' => array(
                    'cs_topstrip_bgcolor' => '#00799F',
                    'cs_topstrip_text_color' => '#ffffff',
                    'cs_topstrip_link_color' => '#ffffff',
                    'cs_header_bgcolor' => '',
                    'cs_nav_bgcolor' => '#00799F',
                    'cs_menu_color' => '#ffffff',
                    'cs_menu_active_color' => '#ffffff',
                    'cs_submenu_bgcolor' => '#ffffff',
                    'cs_submenu_color' => '#333333',
                    'cs_submenu_hover_color' => '#00799F',
                ),
                'logo' => array(
                    'cs_logo_with' => '210',
                    'cs_logo_height' => '130',
                    'cs_logo_margintb' => '0',
                    'cs_logo_marginlr' => '0',
                )
            ),
        );
        return $cs_header_colors;
    }

}
