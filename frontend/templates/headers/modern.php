<?php
$cs_modern_vars = array('post', 'cs_plugin_options');
$cs_modern_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_modern_vars);
extract($cs_modern_vars);
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();

$cs_sitcky_header_switchs = '';
if (isset($cs_plugin_options) && $cs_plugin_options != '') {
    if (isset($cs_plugin_options['cs_user_dashboard_switchs'])) {
        $cs_sitcky_header_switchs = $cs_plugin_options['cs_user_dashboard_switchs'];
    }
}

$cs_allowed_tags = array(
    'a' => array('href' => array()),
    'b' => array(),
    'i' => array('class' => array()),
);

$cs_header_style = isset($jobcareer_options['cs_header_style']) ? $jobcareer_options['cs_header_style'] : '';
$cs_posts_header_style = isset($jobcareer_options['cs_posts_header_style']) ? $jobcareer_options['cs_posts_header_style'] : '';
$cs_header_style_type = isset($jobcareer_options['cs_header_style_type']) ? $jobcareer_options['cs_header_style_type'] : 'boxed'; //default headet type is boxed
$cs_sitcky_header_switch = isset($jobcareer_options['cs_sitcky_header_switch']) ? $jobcareer_options['cs_sitcky_header_switch'] : '';
$cs_top_strip_switch = isset($jobcareer_options['cs_top_strip_switch']) ? $jobcareer_options['cs_top_strip_switch'] : '';
$cs_hder_serch_view = isset($jobcareer_options['cs_header_search_view']) ? $jobcareer_options['cs_header_search_view'] : '';
$cs_social_setting_switch = isset($jobcareer_options['cs_social_setting_switch']) ? $jobcareer_options['cs_social_setting_switch'] : '';
$cs_multi_setting_switch = isset($jobcareer_options['cs_multi_setting_switch']) ? $jobcareer_options['cs_multi_setting_switch'] : '';
$cs_infobox_1 = isset($jobcareer_options['cs_infobox_1']) ? $jobcareer_options['cs_infobox_1'] : '';
$cs_infobox_2 = isset($jobcareer_options['cs_infobox_2']) ? $jobcareer_options['cs_infobox_2'] : '';
$cs_top_newsticker = isset($jobcareer_options['cs_top_newsticker']) ? $jobcareer_options['cs_top_newsticker'] : '';
$cs_nav_sidebar_icon = isset($jobcareer_options['cs_nav_sidebar_icon']) ? $jobcareer_options['cs_nav_sidebar_icon'] : '';
$cs_nav_sidebar_pos = isset($jobcareer_options['cs_nav_sidebar_pos']) ? $jobcareer_options['cs_nav_sidebar_pos'] : '';
$cs_top_nav_sidebar = isset($jobcareer_options['cs_top_nav_sidebar']) ? $jobcareer_options['cs_top_nav_sidebar'] : '';
// get header class from header options
// for default header style
$containner_class = 'container';

$cs_header_style_class = 'cs-default-header';
if ($cs_header_style == 'transparent-header') {
    $cs_header_style_class = 'cs-transparent-header';
}

if (is_singular()) {
    if ($cs_posts_header_style == 'transparent-header') {
        $cs_header_style_class = 'cs-transparent-header';
    } else {
        $cs_header_style_class = 'cs-default-header';
    }
}

if (is_page()) {
    $page_header_t_style = get_post_meta($post->ID, 'cs_page_header_style', true);
    if ($page_header_t_style == 'transparent') {
        $cs_header_style_class = 'cs-transparent-header';
    } else {
        $cs_header_style_class = 'cs-default-header';
    }
}

if ($cs_header_style_type == 'wide') {
    $containner_class = '';
}
if (isset($jobcareer_options['cs_sitcky_header_switch']) and $jobcareer_options['cs_sitcky_header_switch'] == "on") {
    $has_sticky = 'has_sticky';
    jobcareer_scrolltofix();
    ?>
    <script>
        jQuery(document).ready(function () {
            "use strict";
            jQuery('.main-head').scrollToFixed();
        });
    </script>
    <?php
} else {

    $has_sticky = '';
}

if ($cs_hder_serch_view == 'full_page') {
    ?>

    <div id="search">
        <div class="container">
            <button type="button" id="header_default_search_close" class="close cs-bgcolor">&times;</button>
            <form method="get" action="<?php echo esc_url(home_url('/')) ?>">
                <input type="search" name="s" value="" placeholder="<?php esc_html_e('Search here', 'jobcareer'); ?>" />
                <button type="submit" class="btn btn-primary cs-bgcolor"><i class="icon-search7"></i></button>
            </form>
        </div>
    </div>
    <?php
}
?>
<!-- Header 1 Start -->
<header class="<?php echo sanitize_html_class($cs_header_style_class); ?>" id="header">
    <?php
    if ($cs_top_strip_switch != '') {
        ?>
        <div class="top-bar">
            <div class="<?php echo force_balance_tags($containner_class); ?>">
                <div class="row">
                    <?php
                    if ($cs_top_newsticker != '') {
                        jobcareer_news_ticker_script();

                        $cs_top_newsticker = explode(',', $cs_top_newsticker);
                        ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function () {
                                jQuery('.ticker').ticker();
                            });
                        </script>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="tagline">
                                <div class="ticker">
                                    <ul>
                                        <?php
                                        if (is_array($cs_top_newsticker) && sizeof($cs_top_newsticker) > 0) {
                                            foreach ($cs_top_newsticker as $new_tickr) {
                                                ?>
                                                <li><span><?php echo wp_kses(htmlspecialchars_decode($new_tickr), $cs_allowed_tags) ?></span></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                        <div class="contact-detail">
                            <ul>
                                <?php if ($cs_infobox_1 != '') { ?>
                                    <li>
                                        <?php echo wp_kses(htmlspecialchars_decode($cs_infobox_1), $cs_allowed_tags); ?>
                                    </li>
                                <?php } if ($cs_infobox_2 != '') { ?>
                                    <li>
                                        <?php echo wp_kses(htmlspecialchars_decode($cs_infobox_2), $cs_allowed_tags); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="social-media">
                            <ul>
                                <?php
                                if ($cs_social_setting_switch == 'on') {
                                    if (function_exists('jobcareer_social_network')) {
                                        jobcareer_social_network();
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <?php if (function_exists('icl_object_id') and $cs_multi_setting_switch != 'off') { ?> 
                            <div class="cs-lang"> 
                                <?php echo do_action('icl_language_selector'); ?> 
                            </div>								
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="main-head">
        <div class="navbar navbar-default navbar-static-top <?php echo force_balance_tags($containner_class); ?>">

            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <?php
                    if (isset($jobcareer_options['cs_sitcky_header_switch']) and $jobcareer_options['cs_sitcky_header_switch'] == "on") {
                        jobcareer_sticky_logo();
                    } else {
                        jobcareer_logo();
                    }

                    if ($cs_nav_sidebar_icon == 'after_logo') {
                        ?>
                        <div id="nav-icon2">
                            <i class="icon-list8"></i>
                        </div>
                        <?php
                    }
                    if ($cs_nav_sidebar_icon != 'off') {
                        ?>

                        <div class="buttons-container flex-center-wrapper flex-row">
                            <div>
                                <button id="left-toggle" class="slider-toggle<?php if ($cs_nav_sidebar_pos == 'left-menu') echo ' selected'; ?>" data-link="left-menu"><?php esc_html_e('left Menu', 'jobcareer'); ?></button>
                            </div>
                            <div>
                                <button id="top-toggle" class="slider-toggle<?php if ($cs_nav_sidebar_pos == 'top-menu') echo ' selected'; ?>" data-link="top-menu"><?php esc_html_e('Top Menu', 'jobcareer'); ?></button>
                            </div>
                            <div>
                                <button id="right-toggle" class="slider-toggle<?php if ($cs_nav_sidebar_pos == 'right-menu') echo ' selected'; ?>" data-link="right-menu"><?php esc_html_e('Right Menu', 'jobcareer'); ?></button>
                            </div>
                            <div>
                                <button id="bottom-toggle" class="slider-toggle<?php if ($cs_nav_sidebar_pos == 'bottom-menu') echo ' selected'; ?>" data-link="bottom-menu"><?php esc_html_e('Bottom Menu', 'jobcareer'); ?></button>
                            </div>
                        </div>
                        <?php
                        if ($cs_nav_sidebar_pos == 'left-menu') {
                            $cs_sidebar_place = 'left';
                        } else if ($cs_nav_sidebar_pos == 'top-menu') {
                            $cs_sidebar_place = 'top';
                        } else if ($cs_nav_sidebar_pos == 'right-menu') {
                            $cs_sidebar_place = 'right';
                        } else {
                            $cs_sidebar_place = 'bottom';
                        }
                        ?>
                        <div class="sliding-menu flex-center-wrapper flex-column <?php echo sanitize_html_class($cs_nav_sidebar_pos) ?>">
                            <span class="sliiider-exit exit <?php echo sanitize_html_class($cs_sidebar_place) ?>-exit">&#215;</span>
                            <?php
                            if (is_active_sidebar(jobcareer_get_sidebar_id($cs_top_nav_sidebar))) {
                                if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_top_nav_sidebar)) : endif;
                            }
                            ?>
                        </div>
                    <?php } ?>

                </div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 text-right">
                    <?php
                    if ($cs_nav_sidebar_icon != 'off') {
                        jobcareer_sliiide_menu();
                        ?>
                        <script type="text/javascript">

                            jQuery(document).ready(function () {
                                jQuery('.navigation>ul').slicknav();
                                var $ = jQuery;
                                var $navIcon = $('#nav-icon2')
                                var menu = $('.<?php echo sanitize_html_class($cs_nav_sidebar_pos) ?>').sliiide({place: '<?php echo sanitize_html_class($cs_sidebar_place) ?>', exit_selector: '.<?php echo sanitize_html_class($cs_sidebar_place) ?>-exit', toggle: '#nav-icon2'});
                                var notes = $('.note');
                                $('.slider-toggle').on('click', function () {
                                    var $button = $(this);
                                    if ($button.hasClass('selected')) {
                                        return;
                                    }
                                    $navIcon.removeClass('flip animated');
                                    notes.fadeOut(700);
                                    var place = $button.attr('data-link').split('-')[0];
                                    var menuPlace = $button.attr('data-link');
                                    var note;
                                    menu.reset();
                                    $button.addClass('selected');
                                    $('.slider-toggle').not($button).removeClass('selected');
                                    menu = $('.' + menuPlace).sliiide({place: place, exit_selector: '.' + place + '-exit', toggle: '#nav-icon2'});
                                    $navIcon.addClass('flip');
                                    $('.note[data-link="' + menuPlace + '"]').fadeIn(700).css('display', '').removeClass('display-off');
                                });
                            });

                        </script>
                        <?php
                    }
                    ?>
                    <div class="nav-right-area">
                        <nav class="navigation">
                            <?php jobcareer_header_main_navigation(); ?>
                        </nav>
                        <?php
                        if ($cs_nav_sidebar_icon == 'after_menu') {
                            ?>
                            <div id="nav-icon2">
                                <i class="icon-list8"></i>
                            </div>
                            <?php
                        }
                        if ($cs_hder_serch_view == 'full_page') {
                            ?>
                            <div class="search-bar search-popup">
                                <a href="#search">
                                    <i class="icon-search7"></i>
                                </a>
                            </div>
                            <?php
                        }
                        if ($cs_hder_serch_view == 'toggle') {
                            ?>
                            <div class="search-bar search-toggle">
                                <a href="#" class="cs-searchbtn">
                                    <i class="icon-search7"></i>
                                </a>
                                <form method="get" action="<?php echo esc_url(home_url('/')) ?>">
                                    <label>
                                        <input name="s" value=""  type="text" placeholder="<?php echo esc_html__('Enter any keyword', 'jobcareer'); ?>">
                                    </label>
                                    <label class="icon-submit">
                                        <input class="cs-bgcolor" type="submit">
                                    </label>
                                </form>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
<?php
$cs_emp_dashboard = '';
$cs_emp_dashboard = '';
$cs_js_dashboard = '';

if (isset($cs_plugin_options['cs_emp_dashboard'])) {
    $cs_emp_dashboard = $cs_plugin_options['cs_emp_dashboard'];
}

if (isset($cs_plugin_options['cs_emp_dashboard'])) {
    $cs_emp_dashboard = $cs_plugin_options['cs_emp_dashboard'];
}

if (isset($cs_plugin_options['cs_js_dashboard'])) {
    $cs_js_dashboard = $cs_plugin_options['cs_js_dashboard'];
}

$postid = get_the_ID();

$post_type = get_post_type(get_the_ID());

if (function_exists('jobcareer_subheader_style')) {
    if (is_author()) {
        $cs_j_author = get_queried_object();
        $cs_j_role = $cs_j_author->roles[0];
        if ($cs_j_role == 'cs_candidate' || $cs_j_role == 'cs_employer') {
            
        } else {
            jobcareer_subheader_style();
        }
    } else {
        jobcareer_subheader_style();
    }
}

$page_header_style = '';
$page_header_border_colr = '';
if (is_page() || is_single()) {

    $jobcareer_page_bulider = get_post_meta($post->ID, "cs_full_data", true);

    if (isset($jobcareer_page_bulider) and $jobcareer_page_bulider <> '') {
        $page_header_style = isset($jobcareer_page_bulider['cs_header_banner_style']) ? $jobcareer_page_bulider['cs_header_banner_style'] : '';
        $page_header_border_colr = isset($jobcareer_page_bulider['cs_page_main_header_border_color']) ? $jobcareer_page_bulider['cs_page_main_header_border_color'] : '';
    }
}

if ($page_header_style == 'no-header' && $page_header_border_colr != '') {
    echo '
    <style type="text/css">
    #header {
        border-bottom: 1px solid ' . jobcareer_special_char($page_header_border_colr) . ' !important;
    }
    </style>';
}
