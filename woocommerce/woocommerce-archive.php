<?php
/**
 * Shop Archive
 */
global $post, $jobcareer_var_options;

$jobcareer_layout = isset($jobcareer_var_options['jobcareer_var_woo_archive_layout']) ? $jobcareer_var_options['jobcareer_var_woo_archive_layout'] : '';
if ($jobcareer_layout == "sidebar_left" || $jobcareer_layout == "sidebar_right") {
    $jobcareer_col_class = "page-content col-lg-9 col-md-9 col-sm-12 col-xs-12";
} else {
    $jobcareer_col_class = "page-content-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12";
}
$jobcareer_sidebar = isset($jobcareer_var_options['jobcareer_var_woo_archive_sidebar']) ? $jobcareer_var_options['jobcareer_var_woo_archive_sidebar'] : '';

?>   

<div class="main-section">
    <div class="page-section">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <?php if ($jobcareer_layout == 'sidebar_left') { ?>
                    <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <?php
                        if (is_active_sidebar(jobcareer_get_sidebar_id($jobcareer_sidebar))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($jobcareer_sidebar)) : endif;
                        }
                        ?>
                    </div>
                <?php } ?>
                
                <div class="<?php echo esc_html($jobcareer_col_class); ?>">
                    <?php
                    if (function_exists('woocommerce_content')) {
                        woocommerce_content();
                    }
                    ?>
                </div>
                <?php if ($jobcareer_layout == 'sidebar_right') { ?>
                    <div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12"><?php
                    if (is_active_sidebar(jobcareer_get_sidebar_id($jobcareer_sidebar))) {
                        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($jobcareer_sidebar)) : endif;
                    }
                    ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>