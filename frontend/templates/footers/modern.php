<?php
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
$cs_footer_back_to_top = isset($jobcareer_options['cs_footer_back_to_top']) ? $jobcareer_options['cs_footer_back_to_top'] : '';
$footer_background_color = isset($jobcareer_options['cs_copyright_bg_color']) ? $jobcareer_options['cs_copyright_bg_color'] : '';
$cs_sub_footer_menu = isset($jobcareer_options['cs_sub_footer_menu']) ? $jobcareer_options['cs_sub_footer_menu'] : '';
$cs_sub_footer_social_icons = isset($jobcareer_options['cs_sub_footer_social_icons']) ? $jobcareer_options['cs_sub_footer_social_icons'] : '';
$cs_copy_right = isset($jobcareer_options['cs_copy_right']) ? $jobcareer_options['cs_copy_right'] : '';

$cs_footer_widget = isset($jobcareer_options['cs_footer_widget']) ? $jobcareer_options['cs_footer_widget'] : '';
$cssidebar = false;
$footer_sidebar_list = '';
$cs_footer_sidebar_width = '';
if (isset($jobcareer_options) and isset($jobcareer_options['footer_sidebar'])) {
    if (is_array($jobcareer_options['footer_sidebar']) and count($jobcareer_options['footer_sidebar']) > 0) {
        $cs_footer_sidebar = array('footer_sidebar' => $jobcareer_options['footer_sidebar']);
    } else {
        $cs_footer_sidebar = array('footer_sidebar' => array());
    }
} else {
    $cs_footer_sidebar = array();
}

$i = 0;
if (isset($cs_footer_sidebar['footer_sidebar']) && is_array($cs_footer_sidebar['footer_sidebar'])) {
    foreach ($cs_footer_sidebar['footer_sidebar'] as $footer_sidebar_var => $footer_sidebar_val) {

        $footer_sidebar_list[$footer_sidebar_var] = $footer_sidebar_val;
        $cs_footer_sidebar_width = substr($jobcareer_options['footer_width'][$i], 0, 2);
        $footer_sidebar_id = strtolower(str_replace(' ', '-', $footer_sidebar_val));
        if (is_active_sidebar($footer_sidebar_id)) {
            $cssidebar = true;
        }
        $i++;
    }
}

if (isset($cs_footer_widget) and $cs_footer_widget == 'on') {
    if ($cssidebar == true) {
        ?>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <?php
                    $i = 0;
                    foreach ($cs_footer_sidebar['footer_sidebar'] as $footer_sidebar_var => $footer_sidebar_val) {

                        $footer_sidebar_list[$footer_sidebar_var] = $footer_sidebar_val;
                        $cs_footer_sidebar_width = substr($jobcareer_options['footer_width'][$i], 0, 2);
                        $footer_sidebar_id = strtolower(str_replace(' ', '-', $footer_sidebar_val));
                        if (is_active_sidebar($footer_sidebar_id)) {
                            if ($cs_footer_sidebar_width == 2) {
                                $cs_cols_class = ' col-md-' . $cs_footer_sidebar_width . ' col-sm-6 col-xs-12';
                            } else {
                                $cs_cols_class = ' col-md-' . $cs_footer_sidebar_width . ' col-sm-' . $cs_footer_sidebar_width . ' col-xs-12';
                            }
                            echo ' <div class="col-lg-' . $cs_footer_sidebar_width . $cs_cols_class . '">';
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($footer_sidebar_id)) : endif;
                            echo ' </div>';
                        }
                        $i++;
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<div style="background-color:<?php echo esc_html($footer_background_color); ?>;" class="cs-copyright">
    <div class="cs-copyright-area">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                if (isset($cs_sub_footer_social_icons) && $cs_sub_footer_social_icons == 'on') {
                    echo "<ul class='footer-modern-social-links'>";
                    if (function_exists('jobcareer_social_network_footer')) {
                        jobcareer_social_network_footer();
                    }
                    echo "</ul>";
                }
                
                if (function_exists('jobcareer_footer_logo')) {
                    jobcareer_footer_logo();
                }
                ?>
                <div class="footer-links">
                    <?php
                    if ($cs_sub_footer_menu == 'on') {
                        ?>
                        <div class="footer-nav">
                            <?php
                            if (function_exists('jobcareer_navigation')) {
                                jobcareer_navigation('footer-menu', '', '', '');
                            }
                            ?>
                        </div>
                        <?php
                    }
                    if (isset($cs_footer_back_to_top) && $cs_footer_back_to_top == 'on') {
                        ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="back-to-top">
                                <a href="#"><i class="icon-arrow-up7"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                    $cs_allowed_tags = array(
                        'a' => array('href' => array(), 'class' => array()),
                        'b' => array(),
                        'i' => array('class' => array()),
                    );
                    if (isset($cs_copy_right) and $cs_copy_right <> '') {
                        echo wp_kses(htmlspecialchars_decode($cs_copy_right), $cs_allowed_tags);
                    } else {
                        echo ' <p class="copyrights">
                                    ' . gmdate("Y") . '' . esc_html__('Jobs Wordpress Theme All rights reserved. Design by', 'jobcareer') . '	<a href="#" target="_blank">' . get_option("blogname") . '</a>
                                    </p>';
                    }
                    ?>                                    
                </div>

            </div>

        </div>
    </div>
</div>