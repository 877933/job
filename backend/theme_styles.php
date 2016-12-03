<?php
/*
 * Theme style 
 */
if (!function_exists('jobcareer_custom_style_theme_options')) {
    $cs_custom_themeoption_str = '';

	//  Start function for theme option backend setting and classes.
    function jobcareer_custom_style_theme_options() {
        global $cs_custom_themeoption_str;
        ob_start();
        if (get_option('cs_theme_options')) {
            $jobcareer_options = get_option('cs_theme_options');
        } else {
            $jobcareer_options = jobcareer_theme_default_options();
        }
        global $post;
        $cs_theme_color = $jobcareer_options['cs_theme_color'];
        $cs_second_theme_color = isset($jobcareer_options['cs_second_theme_color']) ? $jobcareer_options['cs_second_theme_color'] : '';
        $sub_header_border_color = isset($jobcareer_options['cs_sub_header_border_color']) ? $jobcareer_options['cs_sub_header_border_color'] : '';
        $main_header_border_color = isset($jobcareer_options['cs_header_border_color']) ? $jobcareer_options['cs_header_border_color'] : '';
        $cs_header_border_color = isset($jobcareer_options['cs_header_border_color']) ? $jobcareer_options['cs_header_border_color'] : '';
        $cs_container_default_width = isset($jobcareer_options['cs_container_default_width']) ? $jobcareer_options['cs_container_default_width'] : '';
        $cs_main_header_padding = isset($jobcareer_options['cs_main_header_padding']) ? $jobcareer_options['cs_main_header_padding'] : '';
        $cs_footer_top_border_color = isset($jobcareer_options['cs_footer_top_border_color']) ? $jobcareer_options['cs_footer_top_border_color'] : '';
        ?>
        /*!
        * Theme Color File */
        <?php
        if (isset($cs_container_default_width) && $cs_container_default_width != '') {
            ?>

            .container {width:<?php echo jobcareer_special_char($cs_container_default_width); ?>px !important;}
        <?php }
        ?>
        .cs-color,
        .wp-jobhunt .cs-listing-filters .select-location .pop i,
        .cs-fancy-menu ul li:hover a i, 
        .panel-group.default .panel i,
        .rich-editor-text a, .rich-text-editor a,
        .widget ul li a:hover,
        .rich-editor-text table a,
        .rich-editor-text p a,
        .active > a,
        .active > a:hover,
        .active > a:focus,
        .account-menu li.active a i,
        .employer-listing .company-info li i,
        .account-menu li.active a i,
        .search-btn label a,
        .login-section a,
        .cs-jobs-filter .panel-group .panel .panel-body ul li a.active i,
        .cs-jobs-filter .panel-group .panel .panel-body ul li:hover a:before,
        .cs-jobs-filter .panel-group .panel .panel-body ul li a:hover,
        .widget_nav_menu ul li a:hover,
        .widget-recentpost li a:hover,
        #inner-links > ul li a:hover,
        .cs-favorite-jobs .feature-jobs li .company-date-option .control a:hover,
        .scetion-title-alert span a:hover,
        .cs-ended-jobs .feature-jobs li .company-date-option .control a:hover,
        .inner-tabs ul li.active i,
        .inner-tabs ul li:hover i,
        .team-social-info .team-send-email a:hover,
        .portfolio-filter li a:hover,
        .resp-vtabs li.resp-tab-active,
        ul.hiring-list li .cs-text h3 a:hover,
        .cs-category ul li:hover:after,
        .cs-category ul li:hover a,
        ul.feature-jobs li h3 a:hover,
        ul.breadcrumb-nav li a:hover,
        ul.page-nav li a:hover,
        .job-detail ul li a:hover,
        ul.tag-list li a:hover,
        ul.more-jobs li a:hover,
        .cs-blog .post-option span a:hover,
        .blog-medium .blog-text .read-more,
        .cs-blog .post-option span:hover i,
        .cs-blog-detail .post-option span:hover i,
        .cs-blog .cs-author .cs-text a:hover,
        ul.managment-list li .list-holder .control a:hover,
        ul.packege-payment li .option:hover:after,
        .cs-blog.medium .cs-text h2 a:hover,
        #comment ul li .thumblist .cs-text a,
        .cs-candidate-detail .profile-nav li a.active,
        .price-packege .detail span i,
        .cs-ans-quest .panel-heading a:before,
        .cs-ans-quest .panel-heading a.collapsed:before,
        .account-menu li a:hover, .account-menu li a:hover i,
        .account-menu li.active a, .account-menu li.active a i,
        .blog-medium:hover h4 a,
        .comment-form > span a,
        .resumes-list button.close,
        .cs-login-dropdown ul li:hover a,
        .sitemap-links .site-maps-links ul li a:hover, 
        .cs-relevant-list .cs-text strong a:hover,
        .select-location .my-location i,
        .cs-jobs-filter .cs-fliters .accordion-heading a.accordion-toggle:after, 
        /* widget Style */ 
        .widget-recent-blog ul li .cs-post-title a:hover,
        .recentblog_post li:hover .text h6 a,
        .cs-blog article:hover .cs-bloginfo-sec h3 a,
        .cs-portfolio-plain article:hover h5 a,
        .cs-blog .cs-tags ul li a:hover,
        .cs-post-pagination article:hover a i,
        .cs-post-options li a:hover,
        .cs-tags ul li:hover i,
        .cs-gallery.cs-loading:after,
        .widget.widget_recent_comments li a:hover,
        .widget_rss ul li:hover a,
        .option a:hover,
        .wish-list-dropdown ul.recruiter-list li a:hover,
        .cs-holder .cs-text h5 a:hover,
        .cs-jobs article .cs-text h5 a:hover,
        .jobs-listing.simple .list-options a:hover,
        footer#footer .back-to-top a,
        .cs-pricetable .cs-button:hover,
        .cs-candidate-list .cs-text .cs-post-title a:hover,
        .cs-blog .cs-categories a, .cs-blog-detail .cs-categories a,
        .page-sidebar .menu-candidates-container ul li a:hover:before,
        .cs-candidate-detail .profile-nav li a:hover,
        .cs-blog.blog-grid .read-more:before,
        .cs-blog.blog-grid .read-more,
        .cs-blog.blog-grid .post-option span.post-comment a:hover,
        .cs-post-title a:hover,
        .cs-gallry .modal-footer .btn, .cs-search-results a.cs-relevant-link, .widget-twitter ul li P a, .widget-twitter ul li .post-date i, .widget_pages ul li:hover a, .widget_meta li:hover a, .widget_archive ul li:hover a, .unauthorized h1 span, .post-comment > a, ul.breadcrumb-nav li a,
        .wp-jobhunt .pricetable-holder.advance .price-holder .cs-price span,
        .wp-jobhunt .pricetable-holder.classic.active .price-holder a,
        #footer .footer-nav li a:hover,
        .wp-jobhunt .cs-jobs-holder .jobs-listing .job-post .shortlist:hover, #footer .widget_categories ul li a:after, .wp-jobhunt .user-search ul.filter-list li a, .wp-jobhunt .cs-company-listing strong span, .wp-jobhunt .user-account .nav-tabs > li a:hover, 
		.wp-jobhunt .jobs-listing.modern .cs-text h3 a:hover,
		.wp-jobhunt .jobs-listing a:hover,
		.wp-jobhunt .jobs-detail-4 .company-info .cs-text strong a:hover,
		.wp-jobhunt .company-info .admin-contect li p a:hover,
		.wp-jobhunt .cs-company-jobs li .cs-text span a:hover,
		.wp-jobhunt .employer-contact-form form .cs-terms a:hover,
		.wp-jobhunt .company-info .btn-area a:hover,
        .woocommerce ul.products li.product a.added_to_cart
        {
        <?php if (isset($cs_theme_color) || $cs_theme_color != '') { ?>
            color:<?php echo jobcareer_special_char($cs_theme_color); ?> !important;
        <?php } ?>
        }
        /*!
        * Theme Background Color */
        .cs-bgcolor,
        .wp-jobhunt .cs-employer-slide-listing [class*="col-lg"]:hover .cs-media figcaption, .wp-jobhunt .cs-employer-slide-listing [class*="col-md"]:hover .cs-media figcaption, .wp-jobhunt .cs-employer-slide-listing [class*="col-sm"]:hover .cs-media figcaption, .wp-jobhunt .cs-employer-slide-listing [class*="col-xs"]:hover .cs-media figcaption,
        .cs-fancy-menu ul li:hover:after,
        .widget.widget_search form label input[type="submit"],
        .chosen-container-multi .chosen-choices li.search-choice,
        .chosen-container .chosen-results li.highlighted,
        .widget .cs-button:hover,
        .select-location .slider-selection,
        .cs-selector-range .slider-selection,
        .cs-selector-range .slider-handle,
        ul.post-step li.active h3 a i,
        .cs-candidate-list .cs-button,
        .widget ul.social-media li a:hover,
        .cs-map-candidate span.gmaplock,
        .blog-large .read-more:hover,
        .cs-search-results .cs-categories a,
        .custom-listing input[type="radio"]:checked + label:before, .cs-copyright .back-to-top a i,
        .stay-save .slick-dots li.slick-active button,
        .cs-agent-filters ul li a:hover span, .cs-agent-filters .specialism_list li:hover span,
        .cs-agent-filters .checkbox label:hover:before, .cs-agent-filters .specialism_list li a:hover:before, 
        .cs-agent-filters .accordion-group ul li a:hover:before, .cs-agent-filters .accordion-group ul li a.active:before, 
        .cs-listing-filters ul li a:hover span, .cs-listing-filters .specialism_list li:hover span,
        .cs-listing-filters .checkbox label:hover:before, .cs-listing-filters .checkbox a:hover:before, .cs-listing-filters .accordion-group ul li a:hover:before,
        /* widget Style*/
        .widget_categories ul li:hover,
        .widget_tag_cloud .tagcloud a:hover, 
        .pagination > li > a.active, .pagination > li > a:hover, .cs-login-dropdown li:hover .logout-btn, .user-search ul.filter-list li a:hover,
        .cs_google_suggestions:hover, .cs_location_parent:hover, .cs_location_child:hover, .search-results .cs-search-area .btnsubmit, .cs-search-area .search-bar,.jobs-listing li .wish-list .shortlist,.slicknav_btn,
        .wp-jobhunt .employer-contact-form .submit-btn input[type="submit"], .wp-jobhunt .employer-contact-form .submit-btn input[type="button"],
        .wp-jobhunt .pricetable-holder.modren.active .price-holder .cs-price span,
        .wp-jobhunt .pricetable-holder.advance .price-holder a,
        .blog-modern .blog-text .cs-post-title:after,
        .wp-jobhunt .pricetable-holder.classic.active,
        .wp-jobhunt ul.cs-pricetable.fancy .pricetable-holder.active .price-holder a,
        .wp-jobhunt .cs-employer-slide-listing ul li:hover .cs-media figcaption, .cs-employer-offer-list:after,
        .skills-percentage-bar .skill-process > span{
        <?php if (isset($cs_theme_color) || $cs_theme_color != '') { ?>
            background-color:<?php echo jobcareer_special_char($cs_theme_color); ?> !important;
        <?php } ?>
        }

        /*!
        * Theme Border Color */
        .csborder-color, 
        .rich-text-editor blockquote,
        a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active,
        .join-us a,
        .uplaod-btn,
        .cs-agent-filters .checkbox label:hover:before, .cs-agent-filters .specialism_list li a:hover:before, .cs-agent-filters .accordion-group ul li a:hover:before, .cs-agent-filters .accordion-group ul li a.active:before,
        .cs-listing-filters .checkbox label:hover:before, .cs-listing-filters .checkbox a:hover:before, .cs-listing-filters .accordion-group ul li a:hover:before,
        .cs-tabs.horizontal .nav-tabs > li.active:before, .cs-tabs.horizontal .nav-tabs > li:hover:before,
        .cs-tabs.vertical .nav-tabs > li.active:before, .cs-tabs.vertical .nav-tabs > li:hover:before,
        .csborder-hovercolor:hover,
        .job-info .btn-application:hover,
        ul.candidate-list li a:hover,
        ul.candidate-list li.active a,
        ul.post-step li.active h3 a i,
        ul.packege-payment li .option:hover,
        ul.select-card li a:hover,
        .account-menu li.active,
        .account-menu li:hover,
        .blog-large .read-more,
        .resumes-list button.close,
        .wp-jobhunt .resumes-list input.acc-submit[type="button"],
        .cs-blog-detail blockquote,
        .widget_tag_cloud .tagcloud a:hover,
        #footer .widget_nav_menu ul li a:after,
        ul.resumes-list li .cs-text .cs-posted span, ul.select-card li.active,
        .navigation ul ul li:hover > a, .navigation ul ul li > a:hover, .navigation ul ul li.active > a,
        .custom-listing input[type=radio]:checked + label:before, .pagination > li > a.active, .pagination > li > a:hover, .jobs-listing.modern .read-more::before, .continue-btn,
        .wp-jobhunt input.acc-submit.cs-section-update,
        .wp-jobhunt .pricetable-holder.modren.active,
        .wp-jobhunt .pricetable-holder.classic.active,
        .wp-jobhunt ul.cs-pricetable.fancy .pricetable-holder.active,
        .wp-jobhunt ul.cs-pricetable.fancy .pricetable-holder.active .price-holder a,
        .woocommerce ul.products li.product a.added_to_cart
        {
        <?php if (isset($cs_theme_color) || $cs_theme_color != '') { ?>
            border-color:<?php echo jobcareer_special_char($cs_theme_color); ?> !important;
        <?php } ?>
        }

        .wp-jobhunt .pricetable-holder.classic{
        <?php if (isset($cs_theme_color) || $cs_theme_color != '') { ?>
            border-top-color:<?php echo jobcareer_special_char($cs_theme_color); ?> !important;
        <?php } ?>
        }


        <?php
        if ($sub_header_border_color <> '') {
            ?>
            .breadcrumb-sec .cs-search-inner {
            border-top: 1px solid <?php echo jobcareer_special_char($sub_header_border_color); ?>;
            border-bottom: 1px solid <?php echo jobcareer_special_char($sub_header_border_color); ?>;
            }
            <?php
        }
        if (isset($jobcareer_options['cs_default_header']) and $jobcareer_options['cs_default_header'] == 'no_header') {
            if ($main_header_border_color <> '') {
                ?>
                #main-header {
                border-bottom: 1px solid <?php echo jobcareer_special_char($main_header_border_color); ?>;
                }
                #header {
                border-bottom: 1px solid <?php echo jobcareer_special_char($cs_header_border_color); ?> !important;
                }
                <?php
            }
        }

        /**
         * @Set Top Strip color Css
         *
         */
        $cs_topstr_bg_color = isset($jobcareer_options['cs_topstr_bg_color']) ? $jobcareer_options['cs_topstr_bg_color'] : '';
        $cs_topstr_text_color = (isset($jobcareer_options['cs_topstr_text_color']) and $jobcareer_options['cs_topstr_text_color'] <> '') ? $jobcareer_options['cs_topstr_text_color'] : '';
        $cs_topstr_link_color = (isset($jobcareer_options['cs_topstr_link_color']) and $jobcareer_options['cs_topstr_link_color'] <> '') ? $jobcareer_options['cs_topstr_link_color'] : '';
        $cs_topstr_linkhover_color = (isset($jobcareer_options['cs_topstr_linkhover_color']) and $jobcareer_options['cs_topstr_linkhover_color'] <> '') ? $jobcareer_options['cs_topstr_linkhover_color'] : '';
        $cs_topstr_icon_color = (isset($jobcareer_options['cs_topstr_icon_color']) and $jobcareer_options['cs_topstr_icon_color'] <> '') ? $jobcareer_options['cs_topstr_icon_color'] : '';
        $cs_topstr_iconhover_color = (isset($jobcareer_options['cs_topstr_iconhover_color']) and $jobcareer_options['cs_topstr_iconhover_color'] <> '') ? $jobcareer_options['cs_topstr_iconhover_color'] : '';

        /**
         * @Set Header color Css
         *
         *
         */
        $cs_header_bgcolor = (isset($jobcareer_options['cs_header_bgcolor']) and $jobcareer_options['cs_header_bgcolor'] <> '') ? $jobcareer_options['cs_header_bgcolor'] : '';
        $cs_nav_bgcolor = (isset($jobcareer_options['cs_nav_bgcolor']) and $jobcareer_options['cs_nav_bgcolor'] <> '') ? $jobcareer_options['cs_nav_bgcolor'] : '';
        $cs_menu_color = (isset($jobcareer_options['cs_menu_color']) and $jobcareer_options['cs_menu_color'] <> '') ? $jobcareer_options['cs_menu_color'] : '';
        $cs_menu_active_color = (isset($jobcareer_options['cs_menu_active_color']) and $jobcareer_options['cs_menu_active_color'] <> '') ? $jobcareer_options['cs_menu_active_color'] : '';
        $cs_submenu_bgcolor = (isset($jobcareer_options['cs_submenu_bgcolor']) and $jobcareer_options['cs_submenu_bgcolor'] <> '' ) ? $jobcareer_options['cs_submenu_bgcolor'] : '';
        $cs_submenu_color = (isset($jobcareer_options['cs_submenu_color']) and $jobcareer_options['cs_submenu_color'] <> '') ? $jobcareer_options['cs_submenu_color'] : '';
        $cs_menu_heading_color = (isset($jobcareer_options['cs_menu_heading_color']) and $jobcareer_options['cs_menu_heading_color'] <> '') ? $jobcareer_options['cs_menu_heading_color'] : '';
        $cs_submenu_hover_color = (isset($jobcareer_options['cs_submenu_hover_color']) and $jobcareer_options['cs_submenu_hover_color'] <> '') ? $jobcareer_options['cs_submenu_hover_color'] : '';
        $cs_topstrip_bgcolor = (isset($jobcareer_options['cs_topstrip_bgcolor']) and $jobcareer_options['cs_topstrip_bgcolor'] <> '') ? $jobcareer_options['cs_topstrip_bgcolor'] : '';
        $cs_topstrip_text_color = (isset($jobcareer_options['cs_topstrip_text_color']) and $jobcareer_options['cs_topstrip_text_color'] <> '') ? $jobcareer_options['cs_topstrip_text_color'] : '';
        $cs_topstrip_link_color = (isset($jobcareer_options['cs_topstrip_link_color']) and $jobcareer_options['cs_topstrip_link_color'] <> '') ? $jobcareer_options['cs_topstrip_link_color'] : '';
        $cs_menu_activ_bg = (isset($jobcareer_options['cs_theme_color'])) ? $jobcareer_options['cs_theme_color'] : '';
        $cs_page_title_color = (isset($jobcareer_options['cs_page_title_color'])) ? $jobcareer_options['cs_page_title_color'] : '';

        /* logo margins */
        $cs_logo_margint = (isset($jobcareer_options['cs_logo_margint']) and $jobcareer_options['cs_logo_margint'] <> '') ? $jobcareer_options['cs_logo_margint'] : '0';
        $cs_logo_marginb = (isset($jobcareer_options['cs_logo_marginb']) and $jobcareer_options['cs_logo_marginb'] <> '') ? $jobcareer_options['cs_logo_marginb'] : '0';

        $cs_logo_marginr = (isset($jobcareer_options['cs_logo_marginr']) and $jobcareer_options['cs_logo_marginr'] <> '') ? $jobcareer_options['cs_logo_marginr'] : '0';
        $cs_logo_marginl = (isset($jobcareer_options['cs_logo_marginl']) and $jobcareer_options['cs_logo_marginl'] <> '') ? $jobcareer_options['cs_logo_marginl'] : '0';

        /* font family */
        $cs_content_font = (isset($jobcareer_options['cs_content_font'])) ? $jobcareer_options['cs_content_font'] : '';
        $cs_content_font_att = (isset($jobcareer_options['cs_content_font_att'])) ? $jobcareer_options['cs_content_font_att'] : '';

        $cs_mainmenu_font = (isset($jobcareer_options['cs_mainmenu_font'])) ? $jobcareer_options['cs_mainmenu_font'] : '';
        $cs_mainmenu_font_att = (isset($jobcareer_options['cs_mainmenu_font_att'])) ? $jobcareer_options['cs_mainmenu_font_att'] : '';

        $cs_heading1_font = (isset($jobcareer_options['cs_heading1_font'])) ? $jobcareer_options['cs_heading1_font'] : '';
        $cs_heading1_font_att = (isset($jobcareer_options['cs_heading1_font_att'])) ? $jobcareer_options['cs_heading1_font_att'] : '';

        $cs_heading2_font = (isset($jobcareer_options['cs_heading2_font'])) ? $jobcareer_options['cs_heading2_font'] : '';
        $cs_heading2_font_att = (isset($jobcareer_options['cs_heading2_font_att'])) ? $jobcareer_options['cs_heading2_font_att'] : '';

        $cs_heading3_font = (isset($jobcareer_options['cs_heading3_font'])) ? $jobcareer_options['cs_heading3_font'] : '';
        $cs_heading3_font_att = (isset($jobcareer_options['cs_heading3_font_att'])) ? $jobcareer_options['cs_heading3_font_att'] : '';

        $cs_heading4_font = (isset($jobcareer_options['cs_heading4_font'])) ? $jobcareer_options['cs_heading4_font'] : '';
        $cs_heading4_font_att = (isset($jobcareer_options['cs_heading4_font_att'])) ? $jobcareer_options['cs_heading4_font_att'] : '';

        $cs_heading5_font = (isset($jobcareer_options['cs_heading5_font'])) ? $jobcareer_options['cs_heading5_font'] : '';
        $cs_heading5_font_att = (isset($jobcareer_options['cs_heading5_font_att'])) ? $jobcareer_options['cs_heading5_font_att'] : '';

        $cs_heading6_font = (isset($jobcareer_options['cs_heading6_font'])) ? $jobcareer_options['cs_heading6_font'] : '';
        $cs_heading6_font_att = (isset($jobcareer_options['cs_heading6_font_att'])) ? $jobcareer_options['cs_heading6_font_att'] : '';

        $cs_section_title_font = (isset($jobcareer_options['cs_section_title_font'])) ? $jobcareer_options['cs_section_title_font'] : '';
        $cs_section_title_font_att = (isset($jobcareer_options['cs_section_title_font_att'])) ? $jobcareer_options['cs_section_title_font_att'] : '';

        $cs_page_title_font = (isset($jobcareer_options['cs_page_title_font'])) ? $jobcareer_options['cs_page_title_font'] : '';
        $cs_page_title_font_att = (isset($jobcareer_options['cs_page_title_font_att'])) ? $jobcareer_options['cs_page_title_font_att'] : '';

        $cs_post_title_font = (isset($jobcareer_options['cs_post_title_font'])) ? $jobcareer_options['cs_post_title_font'] : '';
        $cs_post_title_font_att = (isset($jobcareer_options['cs_post_title_font_att'])) ? $jobcareer_options['cs_post_title_font_att'] : '';

        $cs_widget_heading_font = (isset($jobcareer_options['cs_widget_heading_font'])) ? $jobcareer_options['cs_widget_heading_font'] : '';
        $cs_widget_heading_font_att = (isset($jobcareer_options['cs_widget_heading_font_att'])) ? $jobcareer_options['cs_widget_heading_font_att'] : '';

        $cs_ft_widget_heading_font = (isset($jobcareer_options['cs_ft_widget_heading_font'])) ? $jobcareer_options['cs_ft_widget_heading_font'] : '';
        $cs_ft_widget_heading_font_att = (isset($jobcareer_options['cs_ft_widget_heading_font_att'])) ? $jobcareer_options['cs_ft_widget_heading_font_att'] : '';

        // setting content fonts
        $cs_content_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_content_font_att);

        $cs_content_font_atts = jobcareer_get_font_att_array($cs_content_fonts);

        // setting main menu fonts
        $cs_mainmenu_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_mainmenu_font_att);

        $cs_mainmenu_font_atts = jobcareer_get_font_att_array($cs_mainmenu_fonts);

        // setting heading fonts
        $cs_heading1_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading1_font_att);
        $cs_heading1_font_atts = jobcareer_get_font_att_array($cs_heading1_fonts);

        $cs_heading2_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading2_font_att);
        $cs_heading2_font_atts = jobcareer_get_font_att_array($cs_heading2_fonts);

        $cs_heading3_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading3_font_att);
        $cs_heading3_font_atts = jobcareer_get_font_att_array($cs_heading3_fonts);

        $cs_heading4_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading4_font_att);
        $cs_heading4_font_atts = jobcareer_get_font_att_array($cs_heading4_fonts);

        $cs_heading5_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading5_font_att);
        $cs_heading5_font_atts = jobcareer_get_font_att_array($cs_heading5_fonts);

        $cs_heading6_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_heading6_font_att);
        $cs_heading6_font_atts = jobcareer_get_font_att_array($cs_heading6_fonts);

        // element title fonts
        $cs_section_title_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_section_title_font_att);
        $cs_section_title_font_atts = jobcareer_get_font_att_array($cs_section_title_fonts);

        // page title heading fonts
        $cs_page_title_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_page_title_font_att);
        $cs_page_title_font_atts = jobcareer_get_font_att_array($cs_page_title_fonts);

        //post title heading fonts
        $cs_post_title_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_post_title_font_att);
        $cs_post_title_font_atts = jobcareer_get_font_att_array($cs_post_title_fonts);

        // setting widget heading fonts
        $cs_widget_heading_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_widget_heading_font_att);
        $cs_widget_heading_font_atts = jobcareer_get_font_att_array($cs_widget_heading_fonts);

        // setting footer widget heading fonts
        $cs_ft_widget_heading_fonts = preg_split('#(?<=\d)(?=[a-z])#i', $cs_ft_widget_heading_font_att);
        $cs_ft_widget_heading_font_atts = jobcareer_get_font_att_array($cs_ft_widget_heading_fonts);

        /* font size */
        $cs_content_size = (isset($jobcareer_options['cs_content_size'])) ? $jobcareer_options['cs_content_size'] : '';
        $cs_mainmenu_size = (isset($jobcareer_options['cs_mainmenu_size'])) ? $jobcareer_options['cs_mainmenu_size'] : '';
        $cs_heading_1_size = (isset($jobcareer_options['cs_heading_1_size'])) ? $jobcareer_options['cs_heading_1_size'] : '';
        $cs_heading_2_size = (isset($jobcareer_options['cs_heading_2_size'])) ? $jobcareer_options['cs_heading_2_size'] : '';
        $cs_heading_3_size = (isset($jobcareer_options['cs_heading_3_size'])) ? $jobcareer_options['cs_heading_3_size'] : '';
        $cs_heading_4_size = (isset($jobcareer_options['cs_heading_4_size'])) ? $jobcareer_options['cs_heading_4_size'] : '';
        $cs_heading_5_size = (isset($jobcareer_options['cs_heading_5_size'])) ? $jobcareer_options['cs_heading_5_size'] : '';
        $cs_heading_6_size = (isset($jobcareer_options['cs_heading_6_size'])) ? $jobcareer_options['cs_heading_6_size'] : '';
        $cs_section_title_size = (isset($jobcareer_options['cs_section_title_size'])) ? $jobcareer_options['cs_section_title_size'] : '';
        $cs_page_title_size = (isset($jobcareer_options['cs_page_title_size'])) ? $jobcareer_options['cs_page_title_size'] : '';
        $cs_post_title_size = (isset($jobcareer_options['cs_post_title_size'])) ? $jobcareer_options['cs_post_title_size'] : '';
        $cs_widget_heading_size = (isset($jobcareer_options['cs_widget_heading_size'])) ? $jobcareer_options['cs_widget_heading_size'] : '';
        $cs_ft_widget_heading_size = (isset($jobcareer_options['cs_ft_widget_heading_size'])) ? $jobcareer_options['cs_ft_widget_heading_size'] : '';

        // Font Line Heights
        $cs_content_lh = (isset($jobcareer_options['cs_content_lh'])) ? $jobcareer_options['cs_content_lh'] : '';
        $cs_mainmenu_lh = (isset($jobcareer_options['cs_mainmenu_lh'])) ? $jobcareer_options['cs_mainmenu_lh'] : '';
        $cs_heading_1_lh = (isset($jobcareer_options['cs_heading_1_lh'])) ? $jobcareer_options['cs_heading_1_lh'] : '';
        $cs_heading_2_lh = (isset($jobcareer_options['cs_heading_2_lh'])) ? $jobcareer_options['cs_heading_2_lh'] : '';
        $cs_heading_3_lh = (isset($jobcareer_options['cs_heading_3_lh'])) ? $jobcareer_options['cs_heading_3_lh'] : '';
        $cs_heading_4_lh = (isset($jobcareer_options['cs_heading_4_lh'])) ? $jobcareer_options['cs_heading_4_lh'] : '';
        $cs_heading_5_lh = (isset($jobcareer_options['cs_heading_5_lh'])) ? $jobcareer_options['cs_heading_5_lh'] : '';
        $cs_heading_6_lh = (isset($jobcareer_options['cs_heading_6_lh'])) ? $jobcareer_options['cs_heading_6_lh'] : '';
        $cs_section_title_lh = (isset($jobcareer_options['cs_section_title_lh'])) ? $jobcareer_options['cs_section_title_lh'] : '';
        $cs_page_title_lh = (isset($jobcareer_options['cs_page_title_lh'])) ? $jobcareer_options['cs_page_title_lh'] : '';
        $cs_post_title_lh = (isset($jobcareer_options['cs_post_title_lh'])) ? $jobcareer_options['cs_post_title_lh'] : '';
        $cs_widget_heading_lh = (isset($jobcareer_options['cs_widget_heading_lh'])) ? $jobcareer_options['cs_widget_heading_lh'] : '';
        $cs_ft_widget_heading_lh = (isset($jobcareer_options['cs_ft_widget_heading_lh'])) ? $jobcareer_options['cs_ft_widget_heading_lh'] : '';

        // Font Line Heights
        $cs_content_spc = (isset($jobcareer_options['cs_content_spc'])) ? $jobcareer_options['cs_content_spc'] : '';
        $cs_mainmenu_spc = (isset($jobcareer_options['cs_mainmenu_spc'])) ? $jobcareer_options['cs_mainmenu_spc'] : '';
        $cs_heading_1_spc = (isset($jobcareer_options['cs_heading_1_spc'])) ? $jobcareer_options['cs_heading_1_spc'] : '';
        $cs_heading_2_spc = (isset($jobcareer_options['cs_heading_2_spc'])) ? $jobcareer_options['cs_heading_2_spc'] : '';
        $cs_heading_3_spc = (isset($jobcareer_options['cs_heading_3_spc'])) ? $jobcareer_options['cs_heading_3_spc'] : '';
        $cs_heading_4_spc = (isset($jobcareer_options['cs_heading_4_spc'])) ? $jobcareer_options['cs_heading_4_spc'] : '';
        $cs_heading_5_spc = (isset($jobcareer_options['cs_heading_5_spc'])) ? $jobcareer_options['cs_heading_5_spc'] : '';
        $cs_heading_6_spc = (isset($jobcareer_options['cs_heading_6_spc'])) ? $jobcareer_options['cs_heading_6_spc'] : '';
        $cs_section_title_spc = (isset($jobcareer_options['cs_section_title_spc'])) ? $jobcareer_options['cs_section_title_spc'] : '';
        $cs_page_title_spc = (isset($jobcareer_options['cs_page_title_spc'])) ? $jobcareer_options['cs_page_title_spc'] : '';
        $cs_post_title_spc = (isset($jobcareer_options['cs_post_title_spc'])) ? $jobcareer_options['cs_post_title_spc'] : '';
        $cs_widget_heading_spc = (isset($jobcareer_options['cs_widget_heading_spc'])) ? $jobcareer_options['cs_widget_heading_spc'] : '';
        $cs_ft_widget_heading_spc = (isset($jobcareer_options['cs_ft_widget_heading_spc'])) ? $jobcareer_options['cs_ft_widget_heading_spc'] : '';

        // Font Text Transfrom
        $cs_content_textr = (isset($jobcareer_options['cs_content_textr'])) ? $jobcareer_options['cs_content_textr'] : '';
        $cs_mainmenu_textr = (isset($jobcareer_options['cs_mainmenu_textr'])) ? $jobcareer_options['cs_mainmenu_textr'] : '';
        $cs_heading_1_textr = (isset($jobcareer_options['cs_heading_1_textr'])) ? $jobcareer_options['cs_heading_1_textr'] : '';
        $cs_heading_2_textr = (isset($jobcareer_options['cs_heading_2_textr'])) ? $jobcareer_options['cs_heading_2_textr'] : '';
        $cs_heading_3_textr = (isset($jobcareer_options['cs_heading_3_textr'])) ? $jobcareer_options['cs_heading_3_textr'] : '';
        $cs_heading_4_textr = (isset($jobcareer_options['cs_heading_4_textr'])) ? $jobcareer_options['cs_heading_4_textr'] : '';
        $cs_heading_5_textr = (isset($jobcareer_options['cs_heading_5_textr'])) ? $jobcareer_options['cs_heading_5_textr'] : '';
        $cs_heading_6_textr = (isset($jobcareer_options['cs_heading_6_textr'])) ? $jobcareer_options['cs_heading_6_textr'] : '';
        $cs_section_title_textr = (isset($jobcareer_options['cs_section_title_textr'])) ? $jobcareer_options['cs_section_title_textr'] : '';
        $cs_page_title_textr = (isset($jobcareer_options['cs_page_title_textr'])) ? $jobcareer_options['cs_page_title_textr'] : '';
        $cs_post_title_textr = (isset($jobcareer_options['cs_post_title_textr'])) ? $jobcareer_options['cs_post_title_textr'] : '';
        $cs_widget_heading_textr = (isset($jobcareer_options['cs_widget_heading_textr'])) ? $jobcareer_options['cs_widget_heading_textr'] : '';
        $cs_ft_widget_heading_textr = (isset($jobcareer_options['cs_ft_widget_heading_textr'])) ? $jobcareer_options['cs_ft_widget_heading_textr'] : '';


        $cs_widget_color = isset($jobcareer_options['cs_widget_color']) ? $jobcareer_options['cs_widget_color'] : '#2d2d2d';
        $cs_ft_widget_title_color = isset($jobcareer_options['cs_ft_widget_title_color']) ? $jobcareer_options['cs_ft_widget_title_color'] : '';


        /* font Color */
        $cs_heading_h1_color = (isset($jobcareer_options['cs_heading_h1_color']) and $jobcareer_options['cs_heading_h1_color'] <> '') ? $jobcareer_options['cs_heading_h1_color'] : '';
        $cs_heading_h2_color = (isset($jobcareer_options['cs_heading_h2_color']) and $jobcareer_options['cs_heading_h2_color'] <> '') ? $jobcareer_options['cs_heading_h2_color'] : '';
        $cs_heading_h3_color = (isset($jobcareer_options['cs_heading_h3_color']) and $jobcareer_options['cs_heading_h3_color'] <> '') ? $jobcareer_options['cs_heading_h3_color'] : '';
        $cs_heading_h4_color = (isset($jobcareer_options['cs_heading_h4_color']) and $jobcareer_options['cs_heading_h4_color'] <> '') ? $jobcareer_options['cs_heading_h4_color'] : '';
        $cs_heading_h5_color = (isset($jobcareer_options['cs_heading_h5_color']) and $jobcareer_options['cs_heading_h5_color'] <> '') ? $jobcareer_options['cs_heading_h5_color'] : '';
        $cs_heading_h6_color = (isset($jobcareer_options['cs_heading_h6_color']) and $jobcareer_options['cs_heading_h6_color'] <> '') ? $jobcareer_options['cs_heading_h6_color'] : '';
        $cs_text_color = (isset($jobcareer_options['cs_text_color']) && $jobcareer_options['cs_text_color'] != '' ) ? $jobcareer_options['cs_text_color'] : '';

        $cs_widget_heading_size = (isset($jobcareer_options['cs_widget_heading_size'])) ? $jobcareer_options['cs_widget_heading_size'] : '';
        $cs_section_heading_size = (isset($jobcareer_options['cs_section_heading_size'])) ? $jobcareer_options['cs_section_heading_size'] : '';
        $cs_copyright_bg_color = (isset($jobcareer_options['cs_copyright_bg_color'])) ? $jobcareer_options['cs_copyright_bg_color'] : '';

        if (
                ( isset($jobcareer_options['cs_custom_font_woff']) && $jobcareer_options['cs_custom_font_woff'] <> '' ) &&
                ( isset($jobcareer_options['cs_custom_font_ttf']) && $jobcareer_options['cs_custom_font_ttf'] <> '' ) &&
                ( isset($jobcareer_options['cs_custom_font_svg']) && $jobcareer_options['cs_custom_font_svg'] <> '' ) &&
                ( isset($jobcareer_options['cs_custom_font_eot']) && $jobcareer_options['cs_custom_font_eot'] <> '' )
        ):

            $font_face_html = "
        @font-face {
	font-family: 'cs_custom_font';
	src: url('" . $jobcareer_options['cs_custom_font_eot'] . "');
	src:
		url('" . $jobcareer_options['cs_custom_font_eot'] . "?#iefix') format('eot'),
		url('" . $jobcareer_options['cs_custom_font_woff'] . "') format('woff'),
		url('" . $jobcareer_options['cs_custom_font_ttf'] . "') format('truetype'),
		url('" . $jobcareer_options['cs_custom_font_svg'] . "#cs_custom_font') format('svg');
	font-weight: 400;
	font-style: normal;
        }";

            $custom_font = true;
        else: $custom_font = false;
        endif;

        if ($custom_font == true) {
            echo jobcareer_special_char($font_face_html);
        }
        if ((isset($cs_content_size) && $cs_content_size != '') || (isset($cs_content_spc) && $cs_content_spc != '') || (isset($cs_content_textr) && $cs_content_textr != '') || (isset($cs_text_color) && $cs_text_color != '')) {
            ?>
            body,.main-section p, .mce-content-body p {
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_content_size) && $cs_content_size != '') {
                    echo 'font-size: ' . $cs_content_size . '!important;';
                }
                if (isset($cs_content_spc) && $cs_content_spc != '') {
                    echo esc_html($cs_content_spc != '' ? 'letter-spacing: ' . $cs_content_spc . 'px !important;' : '');
                }
                if (isset($cs_content_textr) && $cs_content_textr != '') {
                    echo esc_html($cs_content_textr != '' ? 'text-transform: ' . $cs_content_textr . ';' : '');
                }
                if (isset($cs_text_color) && $cs_text_color != '') {
                    echo esc_html($cs_text_color != '' ? 'color: ' . $cs_text_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_content_font_atts, $cs_content_size, $cs_content_lh, $cs_content_font, true);
                if (isset($cs_content_spc) && $cs_content_spc != '') {
                    echo esc_html($cs_content_spc != '' ? 'letter-spacing: ' . $cs_content_spc . 'px !important;' : '');
                }
                if (isset($cs_content_textr) && $cs_content_textr != '') {
                    echo esc_html($cs_content_textr != '' ? 'text-transform: ' . $cs_content_textr . ' !important;' : '');
                }
                if (isset($cs_text_color) && $cs_text_color != '') {
                    echo esc_html($cs_text_color != '' ? 'color: ' . $cs_text_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_logo_margint) && $cs_logo_margint != '') || (isset($cs_logo_marginr) && $cs_logo_marginr != '') || (isset($cs_logo_marginb) && $cs_logo_marginb != '') || (isset($cs_logo_marginl) && $cs_logo_marginl != '')) {
            ?>
            header .logo{
            <?php if (isset($cs_logo_margint) && $cs_logo_margint != '') { ?>
                margin-top:<?php echo jobcareer_special_char($cs_logo_margint); ?>px;
            <?php } if (isset($cs_logo_marginr) && $cs_logo_marginr != '') { ?>
                margin-right:<?php echo jobcareer_special_char($cs_logo_marginr); ?>px;
            <?php } if (isset($cs_logo_marginb) && $cs_logo_marginb != '') { ?>
                margin-bottom:<?php echo jobcareer_special_char($cs_logo_marginb); ?>px;
            <?php }if (isset($cs_logo_marginl) && $cs_logo_marginl != '') { ?>
                margin-left:<?php echo jobcareer_special_char($cs_logo_marginl); ?>px;
            <?php } ?>

            }
            <?php
        }
        if ((isset($cs_mainmenu_size) && $cs_mainmenu_size != '') || (isset($cs_mainmenu_spc) && $cs_mainmenu_spc != '') || (isset($cs_mainmenu_textr) && $cs_mainmenu_textr != '')) {
            ?>
            #header .navigation > ul > li > a, #header .navigation > ul > li{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_mainmenu_size) && $cs_mainmenu_size != '') {
                    echo 'font-size: ' . $cs_mainmenu_size . ';';
                }
                if (isset($cs_mainmenu_spc) && $cs_mainmenu_spc != '') {
                    echo esc_html($cs_mainmenu_spc != '' ? 'letter-spacing: ' . $cs_mainmenu_spc . 'px !important;' : '');
                }
                if (isset($cs_mainmenu_textr) && $cs_mainmenu_textr != '') {
                    echo esc_html($cs_mainmenu_textr != '' ? 'text-transform: ' . $cs_mainmenu_textr . ' !important;' : '');
                }
            } else {

                echo jobcareer_font_font_print($cs_mainmenu_font_atts, $cs_mainmenu_size, $cs_mainmenu_lh, $cs_mainmenu_font, true);
                if (isset($cs_mainmenu_spc) && $cs_mainmenu_spc != '') {
                    echo esc_html($cs_mainmenu_spc != '' ? 'letter-spacing: ' . $cs_mainmenu_spc . 'px !important;' : '');
                }
                if (isset($cs_mainmenu_textr) && $cs_mainmenu_textr != '') {
                    echo esc_html($cs_mainmenu_textr != '' ? 'text-transform: ' . $cs_mainmenu_textr . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_heading_1_size) && $cs_heading_1_size != '') || (isset($cs_heading_1_spc) && $cs_heading_1_spc != '') || (isset($cs_heading_1_textr) && $cs_heading_1_textr != '') || (isset($cs_heading_h1_color) && $cs_heading_h1_color != '')) {
            ?>
            h1, h1 a{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_heading_1_size) && $cs_heading_1_size != '') {
                    echo 'font-size: ' . $cs_heading_1_size . ';';
                }
                if (isset($cs_heading_1_spc) && $cs_heading_1_spc != '') {
                    echo esc_html($cs_heading_1_spc != '' ? 'letter-spacing: ' . $cs_heading_1_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_1_textr) && $cs_heading_1_textr != '') {
                    echo esc_html($cs_heading_1_textr != '' ? 'text-transform: ' . $cs_heading_1_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h1_color) && $cs_heading_h1_color != '') {
                    echo esc_html($cs_heading_h1_color != '' ? 'color: ' . $cs_heading_h1_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_heading1_font_atts, $cs_heading_1_size, $cs_heading_1_lh, $cs_heading1_font, true);
                if (isset($cs_heading_1_spc) && $cs_heading_1_spc != '') {
                    echo esc_html($cs_heading_1_spc != '' ? 'letter-spacing: ' . $cs_heading_1_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_1_textr) && $cs_heading_1_textr != '') {
                    echo esc_html($cs_heading_1_textr != '' ? 'text-transform: ' . $cs_heading_1_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h1_color) && $cs_heading_h1_color != '') {
                    echo esc_html($cs_heading_h1_color != '' ? 'color: ' . $cs_heading_h1_color . ' !important;' : '');
                }
            }
            ?>}
            <?php
        }
        if ((isset($cs_heading_2_size) && $cs_heading_2_size != '') || (isset($cs_heading_2_spc) && $cs_heading_2_spc != '') || (isset($cs_heading_2_textr) && $cs_heading_2_textr != '') || (isset($cs_heading_h2_color) && $cs_heading_h2_color != '')) {
            ?>
            h2, h2 a{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_heading_2_size) && $cs_heading_2_size != '') {
                    echo 'font-size: ' . $cs_heading_2_size . ';';
                }
                if (isset($cs_heading_2_spc) && $cs_heading_2_spc != '') {
                    echo esc_html($cs_heading_2_spc != '' ? 'letter-spacing: ' . $cs_heading_2_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_2_textr) && $cs_heading_2_textr != '') {
                    echo esc_html($cs_heading_2_textr != '' ? 'text-transform: ' . $cs_heading_2_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h2_color) && $cs_heading_h2_color != '') {
                    echo esc_html($cs_heading_h2_color != '' ? 'color: ' . $cs_heading_h2_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_heading2_font_atts, $cs_heading_2_size, $cs_heading_2_lh, $cs_heading2_font, true);
                if (isset($cs_heading_2_spc) && $cs_heading_2_spc != '') {
                    echo esc_html($cs_heading_2_spc != '' ? 'letter-spacing: ' . $cs_heading_2_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_2_textr) && $cs_heading_2_textr != '') {
                    echo esc_html($cs_heading_2_textr != '' ? 'text-transform: ' . $cs_heading_2_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h2_color) && $cs_heading_h2_color != '') {
                    echo esc_html($cs_heading_h2_color != '' ? 'color: ' . $cs_heading_h2_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_heading_3_size) && $cs_heading_3_size != '') || (isset($cs_heading_3_spc) && $cs_heading_3_spc != '') || (isset($cs_heading_3_textr) && $cs_heading_3_textr != '') || (isset($cs_heading_h3_color) && $cs_heading_h3_color != '')) {
            ?>
            h3, h3 a{ 
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_heading_3_size) && $cs_heading_3_size != '') {
                    echo 'font-size: ' . $cs_heading_3_size . ';';
                }
                if (isset($cs_heading_3_spc) && $cs_heading_3_spc != '') {
                    echo esc_html($cs_heading_3_spc != '' ? 'letter-spacing: ' . $cs_heading_3_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_3_textr) && $cs_heading_3_textr != '') {
                    echo esc_html($cs_heading_3_textr != '' ? 'text-transform: ' . $cs_heading_3_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h3_color) && $cs_heading_h3_color != '') {
                    echo esc_html($cs_heading_h3_color != '' ? 'color: ' . $cs_heading_h3_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_heading3_font_atts, $cs_heading_3_size, $cs_heading_3_lh, $cs_heading3_font, true);
                if (isset($cs_heading_3_spc) && $cs_heading_3_spc != '') {
                    echo esc_html($cs_heading_3_spc != '' ? 'letter-spacing: ' . $cs_heading_3_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_3_textr) && $cs_heading_3_textr != '') {
                    echo esc_html($cs_heading_3_textr != '' ? 'text-transform: ' . $cs_heading_3_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h3_color) && $cs_heading_h3_color != '') {
                    echo esc_html($cs_heading_h3_color != '' ? 'color: ' . $cs_heading_h3_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_heading_4_size) && $cs_heading_4_size != '') || (isset($cs_heading_4_spc) && $cs_heading_4_spc != '') || (isset($cs_heading_4_textr) && $cs_heading_4_textr != '') || (isset($cs_heading_h4_color) && $cs_heading_h4_color != '')) {
            ?>
            h4, h4 a{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_heading_4_size) && $cs_heading_4_size != '') {
                    echo 'font-size: ' . $cs_heading_4_size . ';';
                }
                if (isset($cs_heading_4_spc) && $cs_heading_4_spc != '') {
                    echo esc_html($cs_heading_4_spc != '' ? 'letter-spacing: ' . $cs_heading_4_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_4_textr) && $cs_heading_4_textr != '') {
                    echo esc_html($cs_heading_4_textr != '' ? 'text-transform: ' . $cs_heading_4_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h4_color) && $cs_heading_h4_color != '') {
                    echo esc_html($cs_heading_h4_color != '' ? 'color: ' . $cs_heading_h4_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_heading4_font_atts, $cs_heading_4_size, $cs_heading_4_lh, $cs_heading4_font, true);
                if (isset($cs_heading_4_spc) && $cs_heading_4_spc != '') {
                    echo esc_html($cs_heading_4_spc != '' ? 'letter-spacing: ' . $cs_heading_4_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_4_textr) && $cs_heading_4_textr != '') {
                    echo esc_html($cs_heading_4_textr != '' ? 'text-transform: ' . $cs_heading_4_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h4_color) && $cs_heading_h4_color != '') {
                    echo esc_html($cs_heading_h4_color != '' ? 'color: ' . $cs_heading_h4_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_heading_5_size) && $cs_heading_5_size != '') || (isset($cs_heading_5_spc) && $cs_heading_5_spc != '') || (isset($cs_heading_5_textr) && $cs_heading_5_textr != '') || (isset($cs_heading_h5_color) && $cs_heading_h5_color != '')) {
            ?>
            h5, h5 a{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_heading_5_size) && $cs_heading_5_size != '') {
                    echo 'font-size: ' . $cs_heading_5_size . ';';
                }
                if (isset($cs_heading_5_spc) && $cs_heading_5_spc != '') {
                    echo esc_html($cs_heading_5_spc != '' ? 'letter-spacing: ' . $cs_heading_5_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_5_textr) && $cs_heading_5_textr != '') {
                    echo esc_html($cs_heading_5_textr != '' ? 'text-transform: ' . $cs_heading_5_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h5_color) && $cs_heading_h5_color != '') {
                    echo esc_html($cs_heading_h5_color != '' ? 'color: ' . $cs_heading_h5_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_heading5_font_atts, $cs_heading_5_size, $cs_heading_5_lh, $cs_heading5_font, true);
                if (isset($cs_heading_5_spc) && $cs_heading_5_spc != '') {
                    echo esc_html($cs_heading_5_spc != '' ? 'letter-spacing: ' . $cs_heading_5_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_5_textr) && $cs_heading_5_textr != '') {
                    echo esc_html($cs_heading_5_textr != '' ? 'text-transform: ' . $cs_heading_5_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h5_color) && $cs_heading_h5_color != '') {
                    echo esc_html($cs_heading_h5_color != '' ? 'color: ' . $cs_heading_h5_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_heading_6_size) && $cs_heading_6_size != '') || (isset($cs_heading_6_spc) && $cs_heading_6_spc != '') || (isset($cs_heading_6_textr) && $cs_heading_6_textr != '') || (isset($cs_heading_h6_color) && $cs_heading_h6_color != '')) {
            ?>
            h6, h6 a{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_heading_6_size) && $cs_heading_6_size != '') {
                    echo 'font-size: ' . $cs_heading_6_size . ';';
                }
                if (isset($cs_heading_6_spc) && $cs_heading_6_spc != '') {
                    echo esc_html($cs_heading_6_spc != '' ? 'letter-spacing: ' . $cs_heading_6_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_6_textr) && $cs_heading_6_textr != '') {
                    echo esc_html($cs_heading_6_textr != '' ? 'text-transform: ' . $cs_heading_6_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h6_color) && $cs_heading_h6_color != '') {
                    echo esc_html($cs_heading_h6_color != '' ? 'color: ' . $cs_heading_h6_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_heading6_font_atts, $cs_heading_6_size, $cs_heading_6_lh, $cs_heading6_font, true);
                if (isset($cs_heading_6_spc) && $cs_heading_6_spc != '') {
                    echo esc_html($cs_heading_6_spc != '' ? 'letter-spacing: ' . $cs_heading_6_spc . 'px !important;' : '');
                }
                if (isset($cs_heading_6_textr) && $cs_heading_6_textr != '') {
                    echo esc_html($cs_heading_6_textr != '' ? 'text-transform: ' . $cs_heading_6_textr . ' !important;' : '');
                }
                if (isset($cs_heading_h6_color) && $cs_heading_h6_color != '') {
                    echo esc_html($cs_heading_h6_color != '' ? 'color: ' . $cs_heading_h6_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_section_title_size) && $cs_section_title_size != '') || (isset($cs_section_title_spc) && $cs_section_title_spc != '') || (isset($cs_section_title_textr) && $cs_section_title_textr != '') || (isset($cs_section_title_color) && $cs_section_title_color != '')) {
            ?>       
            .cs-element-title h2{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_section_title_size) && $cs_section_title_size != '') {
                    echo 'font-size: ' . $cs_section_title_size . ';';
                }
                if (isset($cs_section_title_spc) && $cs_section_title_spc != '') {
                    echo esc_html($cs_section_title_spc != '' ? 'letter-spacing: ' . $cs_section_title_spc . 'px !important;' : '');
                }
                if (isset($cs_section_title_textr) && $cs_section_title_textr != '') {
                    echo esc_html($cs_section_title_textr != '' ? 'text-transform: ' . $cs_section_title_textr . ' !important;' : '');
                }
                if (isset($cs_section_title_color) && $cs_section_title_color != '') {
                    echo esc_html($cs_section_title_color != '' ? 'color: ' . $cs_section_title_color . ' !important;' : '');
                }
            } else {

                echo jobcareer_font_font_print($cs_section_title_font_atts, $cs_section_title_size, $cs_section_title_lh, $cs_section_title_font, true);
                if (isset($cs_section_title_spc) && $cs_section_title_spc != '') {
                    echo esc_html($cs_section_title_spc != '' ? 'letter-spacing: ' . $cs_section_title_spc . 'px !important;' : '');
                }
                if (isset($cs_section_title_textr) && $cs_section_title_textr != '') {
                    echo esc_html($cs_section_title_textr != '' ? 'text-transform: ' . $cs_section_title_textr . ' !important;' : '');
                }
                if (isset($cs_section_title_color) && $cs_section_title_color != '') {
                    echo esc_html($cs_section_title_color != '' ? 'color: ' . $cs_section_title_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }

        if ((isset($cs_post_title_size) && $cs_post_title_size != '') || (isset($cs_post_title_spc) && $cs_post_title_spc != '') || (isset($cs_post_title_textr) && $cs_post_title_textr != '') || (isset($cs_post_title_color) && $cs_post_title_color != '')) {
            ?>
            .cs-post-title h3 a, .cs-post-title h2 a{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';

                if (isset($cs_post_title_size) && $cs_post_title_size != '') {
                    echo 'font-size: ' . $cs_post_title_size . ';';
                }
                if (isset($cs_post_title_spc) && $cs_post_title_spc != '') {
                    echo esc_html($cs_post_title_spc != '' ? 'letter-spacing: ' . $cs_post_title_spc . 'px !important;' : '');
                }
                if (isset($cs_post_title_textr) && $cs_post_title_textr != '') {
                    echo esc_html($cs_post_title_textr != '' ? 'text-transform: ' . $cs_post_title_textr . ' !important;' : '');
                }
                if (isset($cs_post_title_color) && $cs_post_title_color != '') {
                    echo esc_html($cs_post_title_color != '' ? 'color: ' . $cs_post_title_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_post_title_font_atts, $cs_post_title_size, $cs_post_title_lh, $cs_post_title_font, true);
                if (isset($cs_post_title_spc) && $cs_post_title_spc != '') {
                    echo esc_html($cs_post_title_spc != '' ? 'letter-spacing: ' . $cs_post_title_spc . 'px !important;' : '');
                }
                if (isset($cs_post_title_textr) && $cs_post_title_textr != '') {
                    echo esc_html($cs_post_title_textr != '' ? 'text-transform: ' . $cs_post_title_textr . ' !important;' : '');
                }
                if (isset($cs_post_title_color) && $cs_post_title_color != '') {
                    echo esc_html($cs_post_title_color != '' ? 'color: ' . $cs_post_title_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        if ((isset($cs_page_title_size) && $cs_page_title_size != '') || (isset($cs_page_title_spc) && $cs_page_title_spc != '') || (isset($cs_page_title_textr) && $cs_page_title_textr != '')) {
            ?>
            .cs-page-title h1{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_page_title_size) && $cs_page_title_size != '') {
                    echo 'font-size: ' . $cs_page_title_size . ';';
                }
                if (isset($cs_page_title_spc) && $cs_page_title_spc != '') {
                    echo esc_html($cs_page_title_spc != '' ? 'letter-spacing: ' . $cs_page_title_spc . 'px !important;' : '');
                }
                if (isset($cs_page_title_textr) && $cs_page_title_textr != '') {
                    echo esc_html($cs_page_title_textr != '' ? 'text-transform: ' . $cs_page_title_textr . ' !important;' : '');
                }
                if (isset($cs_page_title_color) && $cs_page_title_color != '') {
                    echo esc_html($cs_page_title_color != '' ? 'color: ' . $cs_page_title_color . ' !important;' : '');
                }
            } else {

                echo jobcareer_font_font_print($cs_page_title_font_atts, $cs_page_title_size, $cs_page_title_lh, $cs_page_title_font, true);
                if (isset($cs_page_title_spc) && $cs_page_title_spc != '') {
                    echo esc_html($cs_page_title_spc != '' ? 'letter-spacing: ' . $cs_page_title_spc . 'px !important;' : '');
                }
                if (isset($cs_page_title_textr) && $cs_page_title_textr != '') {
                    echo esc_html($cs_page_title_textr != '' ? 'text-transform: ' . $cs_page_title_textr . ' !important;' : '');
                }
                if (isset($cs_page_title_color) && $cs_page_title_color != '') {
                    echo esc_html($cs_page_title_color != '' ? 'color: ' . $cs_page_title_color . ' !important;' : '');
                }
            }
            ?>
            }


            <?php
        }


        if ((isset($cs_widget_heading_size) && $cs_widget_heading_size != '') || (isset($cs_widget_heading_spc) && $cs_widget_heading_spc != '') || (isset($cs_widget_title_color) && $cs_widget_title_color != '')) {
            ?>
            .widget .widget-title h5{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_widget_heading_size) && $cs_widget_heading_size != '') {
                    echo 'font-size: ' . $cs_widget_heading_size . ';';
                }
                if (isset($cs_widget_heading_spc) && $cs_widget_heading_spc != '') {
                    echo esc_html($cs_widget_heading_spc != '' ? 'letter-spacing: ' . $cs_widget_heading_spc . 'px !important;' : '');
                }
                if (isset($cs_widget_heading_textr) && $cs_widget_heading_textr != '') {
                    echo esc_html($cs_widget_heading_textr != '' ? 'text-transform: ' . $cs_widget_heading_textr . ' !important;' : '');
                }
                if (isset($cs_widget_title_color) && $cs_widget_title_color != '') {
                    echo esc_html($cs_widget_title_color != '' ? 'color: ' . $cs_widget_title_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_widget_heading_font_atts, $cs_widget_heading_size, $cs_widget_heading_lh, $cs_widget_heading_font, true);
                if (isset($cs_widget_heading_spc) && $cs_widget_heading_spc != '') {
                    echo esc_html($cs_widget_heading_spc != '' ? 'letter-spacing: ' . $cs_widget_heading_spc . 'px !important;' : '');
                }
                if (isset($cs_widget_heading_textr) && $cs_widget_heading_textr != '') {
                    echo esc_html($cs_widget_heading_textr != '' ? 'text-transform: ' . $cs_widget_heading_textr . ' !important;' : '');
                }
                if (isset($cs_widget_title_color) && $cs_widget_title_color != '') {
                    echo esc_html($cs_widget_title_color != '' ? 'color: ' . $cs_widget_title_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }
        ?>



        <?php if (isset($cs_ft_widget_title_color) && $cs_ft_widget_title_color <> "") { ?>
            #footer .widget-title h5{ <?php echo esc_html($cs_ft_widget_title_color != '' ? 'color: ' . $cs_ft_widget_title_color . ' !important;' : ''); ?>}

            <?php
        }
        if ((isset($cs_ft_widget_heading_size) && $cs_ft_widget_heading_size != '') || (isset($cs_ft_widget_heading_spc) && $cs_ft_widget_heading_spc != '') || (isset($cs_ft_widget_heading_textr) && $cs_ft_widget_heading_textr != '') || (isset($cs_ft_widget_title_color) && $cs_ft_widget_title_color != '')) {
            ?> 
            #footer .widget-title h5{
            <?php
            if ($custom_font == true) {
                echo 'font-family: cs_custom_font;';
                if (isset($cs_ft_widget_heading_size) && $cs_ft_widget_heading_size != '') {
                    echo 'font-size: ' . $cs_ft_widget_heading_size . ';';
                }
                if (isset($cs_ft_widget_heading_spc) && $cs_ft_widget_heading_spc != '') {
                    echo esc_html($cs_ft_widget_heading_spc != '' ? 'letter-spacing: ' . $cs_ft_widget_heading_spc . 'px !important;' : '');
                }
                if (isset($cs_ft_widget_heading_textr) && $cs_ft_widget_heading_textr != '') {
                    echo esc_html($cs_ft_widget_heading_textr != '' ? 'text-transform: ' . $cs_ft_widget_heading_textr . ' !important;' : '');
                }
                if (isset($cs_ft_widget_title_color) && $cs_ft_widget_title_color != '') {
                    echo esc_html($cs_ft_widget_title_color != '' ? 'color: ' . $cs_ft_widget_title_color . ' !important;' : '');
                }
            } else {
                echo jobcareer_font_font_print($cs_ft_widget_heading_font_atts, $cs_ft_widget_heading_size, $cs_ft_widget_heading_lh, $cs_ft_widget_heading_font, true);

                if (isset($cs_ft_widget_heading_spc) && $cs_ft_widget_heading_spc != '') {
                    echo esc_html($cs_ft_widget_heading_spc != '' ? 'letter-spacing: ' . $cs_ft_widget_heading_spc . 'px !important;' : '');
                }
                if (isset($cs_ft_widget_heading_textr) && $cs_ft_widget_heading_textr != '') {
                    echo esc_html($cs_ft_widget_heading_textr != '' ? 'text-transform: ' . $cs_ft_widget_heading_textr . ' !important;' : '');
                }
                if (isset($cs_ft_widget_title_color) && $cs_ft_widget_title_color != '') {
                    echo esc_html($cs_ft_widget_title_color != '' ? 'color: ' . $cs_ft_widget_title_color . ' !important;' : '');
                }
            }
            ?>
            }
            <?php
        }

        if (isset($cs_menu_heading_color) && $cs_menu_heading_color != '') {
            ?>
            .dropdown-menu h6 a{color:<?php echo jobcareer_special_char($cs_menu_heading_color); ?> !important;}
            <?php
        }
        if (isset($cs_topstrip_bgcolor) && $cs_topstrip_bgcolor != '') {
            ?>
            .top-bar,#lang_sel ul ul {background-color:<?php echo jobcareer_special_char($cs_topstrip_bgcolor); ?> !important;}
            <?php
        }
        if (isset($cs_topstrip_bgcolor) && $cs_topstrip_bgcolor != '') {
            ?>
            #lang_sel ul ul:before { border-bottom-color: <?php echo jobcareer_special_char($cs_topstrip_bgcolor); ?>; }
            <?php
        }
        if (isset($cs_topstrip_text_color) && $cs_topstrip_text_color != '') {
            ?>
            .top-bar p{color:<?php echo jobcareer_special_char($cs_topstrip_text_color); ?> !important;}
            <?php
        }
        if (isset($cs_topstrip_link_color) && $cs_topstrip_link_color != '') {
            ?>
            .top-bar a,.top-bar i{color:<?php echo jobcareer_special_char($cs_topstrip_link_color); ?> !important;}
            <?php
        }
        if (isset($cs_header_bgcolor) && $cs_header_bgcolor != '') {
            ?>
            .logo-section,#header,.main-head{background:<?php echo jobcareer_special_char($cs_header_bgcolor); ?> !important; 


            }
            <?php
        }

        if (isset($cs_main_header_padding) && $cs_main_header_padding != '') {
            ?>
            .main-head{
            padding:<?php echo jobcareer_special_char($cs_main_header_padding); ?>px !important;
            }
            <?php
        }
        if (isset($cs_nav_bgcolor) && $cs_nav_bgcolor != '') {
            ?>
            .main-navbar,#main-header .btn-style1,.wrapper:before {background:<?php echo jobcareer_special_char($cs_nav_bgcolor); ?> !important;}
            <?php
        }
        if (isset($cs_nav_bgcolor) && $cs_nav_bgcolor != '') {
            ?>
            .navigation, #header.dark-header {background:<?php echo jobcareer_special_char($cs_nav_bgcolor); ?> !important;}
            <?php
        }
        if (isset($cs_submenu_bgcolor) && $cs_submenu_bgcolor != '') {
            ?>
            .dropdown-menu { background-color:<?php echo jobcareer_special_char($cs_submenu_bgcolor); ?> !important;}
            <?php
        }
        if (isset($cs_submenu_color) && $cs_submenu_color != '') {
            ?>
            .navigation > ul > li > ul li > a {color:<?php echo jobcareer_special_char($cs_submenu_color); ?> !important;}
            <?php
        }
        if (isset($cs_submenu_hover_color) && $cs_submenu_hover_color != '') {
            ?>
            .navigation > ul ul li > a:hover {color:<?php echo jobcareer_special_char($cs_submenu_hover_color); ?> !important;}
            <?php
        }
        if (isset($cs_menu_active_color) && $cs_menu_active_color != '') {
            ?>
            .navigation > ul > li:hover > a, 
            .navigation > ul > li.current-menu-ancestor > a, 
            .navigation > ul > li.current-menu-parent > a, 
            .navigation > ul > li.current_page_item > a, 
            .navigation > ul > li.current-menu-parent > ul.sub-dropdown > , 
            .navigation ul li ul.sub-dropdown li.current-menu-parent.current-menu-parent > a, 
            .navigation ul li ul.sub-dropdown li.current-menu-parent ul.sub-dropdown{
            color:<?php //echo jobcareer_special_char($cs_menu_active_color);    ?> !important;
            }
            <?php
        }
        if (isset($cs_menu_active_color) && $cs_menu_active_color != '') {
            ?>
            .sub-dropdown:before {border-bottom:8px solid <?php echo jobcareer_special_char($cs_menu_active_color); ?> !important;}
            <?php
        }
        if (isset($cs_menu_active_color) && $cs_menu_active_color != '') {
            ?>
            .navigation > ul > li.parentIcon:hover > a:before { background-color:<?php echo jobcareer_special_char($cs_menu_active_color); ?> !important; }
            <?php
        }
        if (isset($cs_menu_color) && $cs_menu_color != '') {
            ?>
            .navigation > ul > li > a, #nav-icon2 i, #header.cs-transparent-header .search-bar i, #header.cs-transparent-header .join-us > a, header#header.cs-transparent-header .login > a, header#header.cs-transparent-header .wish-list a i { color:<?php echo jobcareer_special_char($cs_menu_color); ?> !important; }
            <?php
        }
        if (isset($cs_menu_color) && $cs_menu_color != '') {
            ?>
            #header.cs-transparent-header .navicon, #header.cs-transparent-header .navicon::before, #header.cs-transparent-header .navicon::after{ background:<?php echo jobcareer_special_char($cs_menu_color); ?> !important; }
            <?php
        }
        if (isset($cs_menu_color) && $cs_menu_color != '') {
            ?>
            #header.cs-transparent-header .join-us > a, header#header.cs-transparent-header .login > a { border-color:<?php echo jobcareer_special_char($cs_menu_color); ?> !important; background:none !important; }
            <?php
        }
        if (isset($cs_menu_active_color) && $cs_menu_active_color != '') {
            ?>
            .cs-user,.cs-user-login { border-color:<?php echo jobcareer_special_char($cs_menu_active_color); ?> !important; }
            <?php
        }
        if (isset($cs_widget_color) && $cs_widget_color != '') {
            ?>
            .page-sidebar .widget-title h3, .page-sidebar .widget-title h4, .page-sidebar .widget-title h5, .page-sidebar .widget-title h6{
            color:<?php echo jobcareer_special_char($cs_widget_color); ?> !important;
            }<?php
        }
        if (isset($cs_widget_color) && $cs_widget_color != '') {
            ?>
            .section-sidebar .widget-title h3, .section-sidebar .widget-title h4, .section-sidebar .widget-title h5, .section-sidebar .widget-title h6{
            color:<?php echo jobcareer_special_char($cs_widget_color); ?> !important;
            }
            <?php
        }
        if (isset($cs_footer_top_border_color) && $cs_footer_top_border_color != '') {
            ?>
            .cs-copyright-area, #footer .cs-footer.fancy-footer .footer-top, .cs-footer.modern-footer .footer-top {border-top:1px solid <?php echo jobcareer_special_char($cs_footer_top_border_color); ?> !important;}
            <?php
        }
        if (isset($cs_footer_top_border_color) && $cs_footer_top_border_color != '') {
            ?>
            .cs-footer.modern-footer .cs-copyright .back-to-top a:before,
            .cs-footer.modern-footer .cs-copyright .back-to-top a:after {background: <?php echo jobcareer_special_char($cs_footer_top_border_color); ?> !important;}
        <?php } ?>

        /**
        * @Set top strip colors
        *
        */
        <?php if (isset($cs_topstr_bg_color) && $cs_topstr_bg_color != '') { ?>
            #header .top-bar {
            background-color:<?php echo jobcareer_special_char($cs_topstr_bg_color); ?> !important;
            }
            <?php
        }
        if (isset($cs_topstr_text_color) && $cs_topstr_text_color != '') {
            ?>
            #header .top-bar {
            color:<?php echo jobcareer_special_char($cs_topstr_text_color); ?> !important;
            }
            <?php
        }
        if (isset($cs_topstr_link_color) && $cs_topstr_link_color != '') {
            ?>
            #header .top-bar a {
            color:<?php echo jobcareer_special_char($cs_topstr_link_color); ?> !important;
            }
            <?php
        }
        if (isset($cs_topstr_linkhover_color) && $cs_topstr_linkhover_color != '') {
            ?>
            #header .top-bar a:hover {
            color:<?php echo jobcareer_special_char($cs_topstr_linkhover_color); ?> !important;
            }
            <?php
        }
        if (isset($cs_topstr_iconhover_color) && $cs_topstr_iconhover_color != '') {
            ?>
            #header .top-bar .social-media a:hover i {
            color:<?php echo jobcareer_special_char($cs_topstr_iconhover_color); ?> !important;
            }
        <?php }if (isset($cs_topstr_icon_color) && $cs_topstr_icon_color != '') { ?>
            #header .top-bar .social-media a i {
            color:<?php echo jobcareer_special_char($cs_topstr_icon_color); ?> !important;
            }
            <?php
        }
        /**
         * @Set Footer colors
         *
         *
         */
        $cs_footerbg_color = (isset($jobcareer_options['cs_footerbg_color']) and $jobcareer_options['cs_footerbg_color'] <> '') ? $jobcareer_options['cs_footerbg_color'] : '';


        $cs_footerbg_image = (isset($jobcareer_options['cs_ftr_bg']) and $jobcareer_options['cs_ftr_bg'] <> '') ? $jobcareer_options['cs_ftr_bg'] : '';
        $footer_bg_color = jobcareer_hex2rgb($cs_footerbg_color);

        $cs_bg_footer_color = 'background-color:rgba(' . $footer_bg_color[0] . ', ' . $footer_bg_color[1] . ', ' . $footer_bg_color[2] . ', 0.95) !important;';

        $cs_footer_text_color = (isset($jobcareer_options['cs_footer_text_color']) and $jobcareer_options['cs_footer_text_color'] <> '') ? $jobcareer_options['cs_footer_text_color'] : '';
        $cs_link_color = (isset($jobcareer_options['cs_link_color']) and $jobcareer_options['cs_link_color'] <> '') ? $jobcareer_options['cs_link_color'] : '';
        $cs_sub_footerbg_color = (isset($jobcareer_options['cs_sub_footerbg_color']) and $jobcareer_options['cs_sub_footerbg_color'] <> '') ? $jobcareer_options['cs_sub_footerbg_color'] : '';

        $cs_copyright_text_color = (isset($jobcareer_options['cs_copyright_text_color']) and $jobcareer_options['cs_copyright_text_color'] <> '') ? $jobcareer_options['cs_copyright_text_color'] : '';

        $cs_copyright_bg_color = (isset($jobcareer_options['cs_copyright_bg_color']) and $jobcareer_options['cs_copyright_bg_color'] <> '') ? $jobcareer_options['cs_copyright_bg_color'] : '';
        if (isset($cs_footer_text_color) && $cs_footer_text_color != '') {
            ?>
            footer#footer p, footer#footer span, footer#footer .textwidget{color:<?php echo jobcareer_special_char($cs_footer_text_color); ?> !important;}
            <?php
        }
        if (isset($cs_footerbg_color) && $cs_footerbg_color != '') {
            ?>
            .footer-top {
            background-color:<?php echo jobcareer_special_char($cs_footerbg_color); ?> !important;
            }
            <?php
        }
        if (isset($cs_footerbg_image) && $cs_footerbg_image != '') {
            ?>
            footer#footer {
            background-image:url("<?php echo jobcareer_special_char($cs_footerbg_image); ?>") !important;
            }
            <?php
        }
        if (isset($cs_copyright_text_color) && $cs_copyright_text_color != '') {
            ?>
            .footer-links,.footer-links a{color:<?php echo jobcareer_special_char($cs_copyright_text_color); ?> !important;}
            <?php
        }
        if (isset($cs_copyright_bg_color) && $cs_copyright_bg_color != '') {
            ?>.footer-btm {background-color:<?php echo jobcareer_special_char($cs_copyright_bg_color); ?> !important;}
            <?php
        }
        if (isset($cs_copyright_text_color) && $cs_copyright_text_color != '') {
            ?>
            #footer  .copyrights{
            color:<?php echo jobcareer_special_char($cs_copyright_text_color); ?> !important;
            }
        <?php }if (isset($cs_link_color) && $cs_link_color != '') { ?>
            footer#footer a, .footer-nav li a  {
            color:<?php echo jobcareer_special_char($cs_link_color); ?> !important;
            }<?php
        }
        if (isset($cs_link_color) && $cs_link_color != '') {
            ?>
            .footer-nav li::before  {
            background-color:<?php echo jobcareer_special_char($cs_link_color); ?> !important;
            }<?php
        }

        if (isset($cs_copyright_text_color) && $cs_copyright_text_color != '') {
            ?>
            footer#footer .footer-links a.footer#footer .footer-link {color:<?php echo jobcareer_special_char($cs_copyright_text_color); ?> !important;}
            <?php
        }


        $cs_custom_themeoption_str = ob_get_clean();
        return $cs_custom_themeoption_str;
    }

}

