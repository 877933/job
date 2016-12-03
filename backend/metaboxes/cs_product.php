<?php
/**
 * @ Start function for Add Meta Box For Product  
 * @return
 *
 */
add_action('add_meta_boxes', 'jobcareer_meta_product_add');
if (!function_exists('jobcareer_meta_product_add')) {

    function jobcareer_meta_product_add() {
        global $jobcareer_var_frame_static_text;
        
        add_meta_box('jobcareer_meta_product', __('Product Options', 'jobcareer'), 'jobcareer_meta_product', 'product', 'normal', 'high');
    }

}

/**
 * @ Start function for Meta Box For Product  
 * @return
 *
 */
if (!function_exists('jobcareer_meta_product')) {

    function jobcareer_meta_product($post) {
        global $jobcareer_var_frame_static_text;
       
        ?>
        <div class="page-wrap page-opts left" style="overflow:hidden; position:relative;">
            <div class="option-sec" style="margin-bottom:0;">
                <div class="opt-conts">
                    <div class="elementhidden">
                        <nav class="admin-navigtion">
                            <ul id="cs-options-tab">
                                <li><a name="#tab-general-settings" href="javascript:;"><i class="icon-gear"></i><?php echo __('General Settings ', 'jobcareer'); ?> </a></li>
                                <li><a name="#tab-slideshow" href="javascript:;"><i class="icon-forward2"></i> <?php echo __('Subheader', 'jobcareer'); ?></a></li>
                            </ul> 
                        </nav>
                        <div id="tabbed-content">
                            <div id="tab-general-settings">
                                <?php
                                jobcareer_sidebar_layout_options();
                                ?>
                            </div>
                            <div id="tab-slideshow">
                                <?php jobcareer_subheader_element(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <?php
    }
}