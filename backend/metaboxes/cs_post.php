<?php
/**
 * @ Start function for Add Meta Box For Post  
 * @return
 *
 */
add_action('add_meta_boxes', 'jobcareer_meta_post_add');
if (!function_exists('jobcareer_meta_post_add')) {
function jobcareer_meta_post_add() {
    add_meta_box('jobcareer_meta_post', esc_html__('Post Options', 'jobcareer'), 'jobcareer_meta_post', 'post', 'normal', 'high');
}

}

/**
 * @ Start function for Meta Box For Post  
 * @return
 *
 */
if (!function_exists('jobcareer_meta_post')) {
function jobcareer_meta_post($post) {
    global $jobcareer_options;
    $jobcareer_options = get_option('cs_theme_options');
    $cs_builtin_seo_fields = isset($jobcareer_options['cs_builtin_seo_fields']) ? $jobcareer_options['cs_builtin_seo_fields'] : '';
    ?>
    <div class="page-wrap page-opts left cs-page-opts-meta">
        <div class="option-sec cs-dragmain">
            <div class="opt-conts">
                <div class="elementhidden">
                    <nav class="admin-navigtion">
                        <ul id="cs-options-tab">
                            <li><a name="#tab-general-settings" href="javascript:;"><i class="icon-toggle-right"></i><?php echo esc_html__('General Settings', 'jobcareer'); ?></a></li>
                            <li><a name="#tab-subheader-options" href="javascript:;"><i class="icon-list-alt"></i><?php echo esc_html__('Sub Header Options', 'jobcareer'); ?>  </a></li>
                            <li><a name="#tab-post-options" href="javascript:;"><i class="icon-list-alt"></i><?php echo esc_html__('Post Settings', 'jobcareer'); ?>  </a></li>
                        </ul>
                    </nav>
                    <div id="tabbed-content">
                        <div id="tab-general-settings">
                            <?php jobcareer_general_settings_element(); ?>
                            <?php jobcareer_sidebar_layout_options(); ?>
                        </div>
                        <div id="tab-subheader-options">
                            <?php jobcareer_subheader_element(); ?>
                        </div>
                        <div id="tab-post-options">
                            <?php
                            if (function_exists('jobcareer_post_options')) {
                                jobcareer_post_options();
                            }
                            ?>
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

/**
 * @ Start function for Slider options 
 * @return html
 *
 */
if (!function_exists('jobcareer_post_options')) {

    function jobcareer_post_options() {
        global $post, $jobcareer_metaboxes;
        // Show hide post thumnail
        $thumb_view = get_post_meta($post->ID, 'cs_thumb_view', true);
        $post_thumb_image = $post_thumb_slider = 'hide';
        if (isset($thumb_view) && $thumb_view == 'single') {
            $post_thumb_image = 'show';
        } else if (isset($thumb_view) && $thumb_view == 'slider') {
            $post_thumb_slider = 'show';
        }
        // Show hide post detail views
        $detail_view = get_post_meta($post->ID, 'cs_detail_view', true);
        $detail_image = $detail_slider = $detail_audio = $detail_video = 'hide';

        if (isset($detail_view) && $detail_view == 'single') {
            $detail_image = 'show';
        } else if (isset($detail_view) && $detail_view == 'slider') {
            $detail_slider = 'show';
        } else if (isset($detail_view) && $detail_view == 'audio') {
            $detail_audio = 'show';
        } else if (isset($detail_view) && $detail_view == 'video') {
            $detail_video = 'show';
        }

        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Thumbnail View demo', 'jobcareer'),
                    'id' => 'thumb_view',
                    'classes' => 'chosen-select-no-single',
                    'std' => 'single',
                    'onclick' => 'cs_thumbnail_view',
                    'status' => '',
                    'description' => '',
                    'help_text' => esc_html__('Choose thumbnail view type for this post. None for no image. Single image for display featured image on listings and slider for display slides on thumbnail view.','jobcareer'),
                    'options' => array('none' => esc_html__('None', 'jobcareer'), 'single' => esc_html__('Single Image', 'jobcareer'), 'slider' => esc_html__('Slider', 'jobcareer')),
                )
        );
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'post_thumb_image',
                    'status' => $post_thumb_image,
                )
        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'post_thumb_image',
                )
        );
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'thumb_slider',
                    'status' => $post_thumb_slider,
                )
        );
        $jobcareer_metaboxes->cs_gallery_render(
                array('name' => esc_html__('Add Gallery Images', 'jobcareer'),
                    'id' => 'post_list_gallery',
                    'classes' => '',
                    'std' => 'gallery_meta_form',
                )
        );
        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'thumb_slider',
                )
        );
        $jobcareer_metaboxes->cs_form_select_render(
                array('name' => esc_html__('Inside Post Thumbnail View', 'jobcareer'),
                    'id' => 'detail_view',
                    'classes' => 'chosen-select-no-single',
                    'std' => 'single',
                    'onclick' => 'cs_post_view',
                    'status' => '',
                    'description' => '',
                    'help_text' => esc_html__('Choose inside thumbnail view type for this post. None for no image. Single image for display featured image on detail. Slider for display slides on detail. Audio for make this audio post and video for display video inside post.','jobcareer'),
                    'options' => array('none' => esc_html__('None', 'jobcareer'), 'single' => esc_html__('Single Image', 'jobcareer'), 'slider' => esc_html__('Slider', 'jobcareer'), 'audio' => esc_html__('Audio', 'jobcareer'), 'video' => esc_html__('Video', 'jobcareer')),
                )
        );
        # Image View
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'post_detail',
                    'status' => $detail_image,
                )
        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'post_detail',
                )
        );
        #Slider View
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'post_detail_slider',
                    'status' => $detail_slider,
                )
        );
        $jobcareer_metaboxes->cs_gallery_render(
                array('name' => esc_html__('Add Gallery Images', 'jobcareer'),
                    'id' => 'post_detail_gallery',
                    'classes' => '',
                    'std' => 'gallery_slider_meta_form',
                )
        );
        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'post_detail_slider',
                )
        );
        #Audio View
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'audio_view',
                    'status' => $detail_audio,
                )
        );
        $jobcareer_metaboxes->cs_media_url(
                array('name' => esc_html__('Audio Url', 'jobcareer'),
                    'id' => 'post_detail_audio',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('Enter audio url for this post or upload new with this browse button.','jobcareer'),
                )
        );
        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'audio_view',
                )
        );
        #Video View
        $jobcareer_metaboxes->cs_wrapper_start_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'video_view',
                    'status' => $detail_video,
                )
        );
        $jobcareer_metaboxes->cs_media_url(
                array('name' => esc_html__('Thumbnail Video Url', 'jobcareer'),
                    'id' => 'post_detail_video',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('Enter Specific Video Url (Youtube, Vimeo and Dailymotion) OR you can select it from your media library','jobcareer'),
                )
        );

        $jobcareer_metaboxes->cs_wrapper_end_render(
                array('name' => esc_html__('Wrapper', 'jobcareer'),
                    'id' => 'video_view',
                )
        );
    }

}

/**
 * @page/post General Settings Function
 * @return
 *
 */
if (!function_exists('jobcareer_general_settings_element')) {

    function jobcareer_general_settings_element() {
        global $jobcareer_xmlObject, $post, $jobcareer_metaboxes;

        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Social Sharing', 'jobcareer'),
                    'id' => 'post_social_sharing',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('ON/OFF social sharing for this post.','jobcareer')
                )
        );
        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Tags', 'jobcareer'),
                    'id' => 'post_tags_show',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('ON/OFF tags from frontend for this post.','jobcareer')
                )
        );

        $jobcareer_metaboxes->cs_form_checkbox_render(
                array('name' => esc_html__('Related Post', 'jobcareer'),
                    'id' => 'cs_related_post',
                    'classes' => '',
                    'std' => '',
                    'description' => '',
                    'hint' => '',
                    'help_text' => esc_html__('Enable/Disable related post on detail page.','jobcareer')
                )
        );
    }

}