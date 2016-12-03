<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */
get_header();
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
$var_arrays = array('jobcareer_form_fields');
$footer_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($footer_global_vars);
$cs_sub_footer_social_icons = isset($jobcareer_options['cs_sub_footer_social_icons']) ? $jobcareer_options['cs_sub_footer_social_icons'] : '';
?>
<div class="wrapper">
    <header id="main-header" class="header_1"></header>
    <div class="clear"></div>
    <div class="main-section">
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="page-not-found">
                        <div class="cs-404-text">
                            <h2><img src="<?php echo trailingslashit(get_template_directory_uri()) . 'assets/images/404-bg-img.png' ?>" alt="image" class="cs-bgcolor"></h2>
                            <span><?php esc_html_e('We Are Sorry, Page Not Found', 'jobcareer'); ?></span>
                        </div>
                        <div class="cs-spreater">
                            <div class="cs-divider-style"></div>
                        </div>
                        <div class="cs-content404">
                            <div class="desc">
                                <p><?php _e('Unfortunately the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exist. <br> Check the Url you entered for any mistakes and try again.', 'jobcareer'); ?></p> 
                            </div>
                            <div class="cs-search-area">
                                <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                    <?php
                                    $cs_opt_array = array(
                                        'std' => '',
                                        'id' => '',
                                        'classes' => 'form-control txt-bar',
                                        'extra_atr' => 'onfocus="if (this.value == \'' . esc_html__('Enter any keyword', 'jobcareer') . '\') {
                                            this.value = \'\';
                                        }" 
                                       onblur="if (this.value == \'\') {
                                                   this.value = \'' . esc_html__('Enter any keyword', 'jobcareer') . '\';
                                               }" 
                                       placeholder="' . esc_html__('Enter any keyword', 'jobcareer') . '"',
                                        'cust_id' => 's',
                                        'cust_name' => 's',
                                        'return' => true,
                                        'required' => false
                                    );
                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                    ?>
                                    <label>
                                        <?php
                                        $cs_opt_array = array(
                                            'std' => esc_html__('Search', 'jobcareer'),
                                            'id' => '',
                                            'before' => '',
                                            'after' => '',
                                            'classes' => 'btnsubmit cs-bg-color search-bar',
                                            'extra_atr' => '',
                                            'cust_id' => '',
                                            'cust_name' => '',
                                            'return' => true,
                                            'required' => false
                                        );
                                        echo jobcareer_special_char($jobcareer_form_fields->cs_form_submit_render($cs_opt_array));
                                        ?>
                                    </label>
                                    <?php
                                    $cs_opt_array = array(
                                        'std' => 'en',
                                        'id' => '',
                                        'extra_atr' => '',
                                        'cust_id' => 'lang',
                                        'cust_name' => 'lang',
                                        'return' => true,
                                        'required' => false
                                    );
                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                                    ?>
                                </form>
                            </div> 
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="back-home"><?php esc_html_e('Back To Homepage', 'jobcareer') ?></a>                 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
get_footer();
