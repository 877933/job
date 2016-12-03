<?php
/**
 * The template for displaying Footer
 */
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
$cs_footer_back_to_top = isset($jobcareer_options['cs_footer_back_to_top']) ? $jobcareer_options['cs_footer_back_to_top'] : '';
$cs_sub_footer_social_icons = isset($jobcareer_options['cs_sub_footer_social_icons']) ? $jobcareer_options['cs_sub_footer_social_icons'] : '';
$cs_footer_back_to_top_color = isset($jobcareer_options['$cs_footer_back_to_top_color']) ? $jobcareer_options['$cs_footer_back_to_top_color'] : '';
?>
<div class="clear"></div>
<!-- Footer -->
<?php
$cs_footer_switch = isset($jobcareer_options['cs_footer_switch']) ? $jobcareer_options['cs_footer_switch'] : '';
$cs_footer_style = isset($jobcareer_options['cs_footer_style']) ? $jobcareer_options['cs_footer_style'] : '';

$footer_background_color = isset($jobcareer_options['cs_copyright_bg_color']) ? $jobcareer_options['cs_copyright_bg_color'] : '';
$cs_sub_footer_menu = isset($jobcareer_options['cs_sub_footer_menu']) ? $jobcareer_options['cs_sub_footer_menu'] : '';
$cs_copy_right = isset($jobcareer_options['cs_copy_right']) ? $jobcareer_options['cs_copy_right'] : '';
$cs_copyright_color = isset($jobcareer_options['$cs_copyright_color']) ? $jobcareer_options['$cs_copyright_color'] : '';

$cs_ftr_class = $cs_footer_style;

$cs_ftr_class = 'footer-v1 ' . $cs_footer_style;
if ($cs_footer_style == 'modern-footer') {
    $cs_ftr_class = $cs_footer_style;
}

if ((isset($cs_footer_switch) && $cs_footer_switch == 'on')) {
    
    ?> 	
    <footer id="footer">
        <div class="cs-footer <?php echo force_balance_tags($cs_ftr_class); ?>">
            <?php
            if ($cs_footer_style == 'modern-footer') {
                echo get_template_part('frontend/templates/footers/modern');
            } elseif ($cs_footer_style == 'fancy-footer') {
                echo '<div class="container">';
                echo get_template_part('frontend/templates/footers/fancy');
                echo '</div>';
            }else {
                echo get_template_part('frontend/templates/footers/classic');
            }
            ?>
        </div>
    </footer>
    <?php
}
cs_facebook_cache_clear();
?>
<!-- Wrapper End -->   
</div>
<?php wp_footer() ?>
</body>
</html>