<?php
/**
 * @Add Page Meta Boxe
 * @return
 *
 */
add_action('add_meta_boxes', 'jobcareer_page_options_add');

// Start function for page option admin side

if (!function_exists('jobcareer_page_options_add')) {

    function jobcareer_page_options_add() {
        add_meta_box('id_page_options', esc_html__('Page Options', 'jobcareer'), 'jobcareer_page_options', 'page', 'normal', 'high');
    }

}

// CS page options function start

if (!function_exists('jobcareer_page_options')) {

    function jobcareer_page_options($post) {
        global $post, $jobcareer_options, $cs_plugin_options, $jobcareer_metaboxes;
        $cs_builtin_seo_fields = isset($jobcareer_options['cs_builtin_seo_fields']) ? $jobcareer_options['cs_builtin_seo_fields'] : '';
        $cs_header_position = isset($jobcareer_options['cs_header_position']) ? $jobcareer_options['cs_header_position'] : '';
        ?>

        <div class="elementhidden">
            <nav class="admin-navigtion">
                <ul id="cs-options-tab">
                    <li><a name="#tab-general-settings" href="javascript:;"><i class="icon-gear"></i><?php esc_html_e('General Settings', 'jobcareer'); ?> </a></li>
                    <li><a name="#tab-slideshow" href="javascript:;"><i class="icon-forward2"></i> <?php esc_html_e('Subheader', 'jobcareer'); ?></a></li>
                    <?php if (isset($cs_plugin_options) && $cs_plugin_options <> '') { ?>
                        <li><a name="#tab-upcoming-page-settings" href="javascript:;"><i class="icon-globe4"></i><?php esc_html_e('Coming Soon', 'jobcareer'); ?> </a></li>
                    <?php } ?>
                </ul> 
            </nav>
            <div id="tabbed-content">
                <div id="tab-general-settings">
                    <?php
                    jobcareer_sidebar_layout_options();
                    $jobcareer_metaboxes->cs_form_select_render(
                            array('name' => esc_html__('Select Header Style', 'jobcareer'),
                                'id' => 'page_header_style',
                                'classes' => '',
                                'std' => 'left',
                                'onclick' => '',
                                'status' => '',
                                'classes' => 'chosen-select',
                                'description' => '',
                                'options' => array('default' => esc_html__('Default', 'jobcareer'), 'transparent' => esc_html__('Transparent', 'jobcareer')),
                                'help_text' => esc_html__("Select Header style, whether to show it transparent or as default.", 'jobcareer'),
                            )
                    );
                    ?>
                </div>
                <div id="tab-slideshow">
                    <?php jobcareer_subheader_element(); ?>
                </div>

                <div id="tab-upcoming-page-settings">
                    <?php jobcareer_upcoming_element(); ?>
                </div>
            </div>
        </div>
        <?php
    }

}
 
