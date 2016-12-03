<?php
/**
 * The template for displaying Search Form
 */
$var_arrays = array('jobcareer_form_fields');
$search_form_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($search_form_global_vars);
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
?>
<form method="get" action="<?php echo esc_url(home_url()); ?>" >
    <?php
    $cs_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'form-control',
        'extra_atr' => ' placeholder ="'.esc_html__('Enter your search', 'jobcareer'). '"',
        'cust_id' => 'srch_email',
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
            'classes' => 'btnsubmit cs-bg-color',
            'extra_atr' => '',
            'cust_id' => '',
            'cust_name' => '',
            'return' => true,
            'required' => false
        );
        echo jobcareer_special_char($jobcareer_form_fields->cs_form_submit_render($cs_opt_array));
        ?>
    </label>
</form>