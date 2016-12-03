<?php
/*
 *
 * @Shortcode Name : Video
 * @retrun
 *
 */

if (!function_exists('jobcareer_video_shortcode')) {

    function jobcareer_video_shortcode($atts, $content = "") {
        $video = '';
        $width='';
        $defaults = array(
            'column_size' => '',
            'cs_video_section_title' => '',
            'video_url' => '',
            'video_height' => '300',
            'cs_video_custom_animation' => 'slide',
            'cs_video_custom_animation_duration' => ''
        );


        extract(shortcode_atts($defaults, $atts));
		if(isset($column_size) && $column_size!=''){
                  $column_class = jobcareer_custom_column_class($column_size);
                   $video .= '<div class="'.$column_class.'">';
		}
        $height = isset($video_height) ? $video_height : '300';
        $cs_video_custom_animation = isset($cs_video_custom_animation) ? $cs_video_custom_animation : '';
        $cs_video_custom_animation_duration = isset($cs_video_custom_animation_duration) ? $cs_video_custom_animation_duration : '';
         

        $video_url = isset($video_url) ? $video_url : '';
        $url = parse_url($video_url);
        
        $cs_iframe = '<' . 'i' . 'fr' . 'ame ';

        if (trim($cs_video_custom_animation) != '') {
            $cs_video_custom_animation = 'wow' . ' ' . $cs_video_custom_animation;
        } else {

            $cs_video_custom_animation = '';
        }

        

        $column_class = jobcareer_custom_column_class($column_size);
        $section_title = '';
        
        if (isset($url['host']) && $url['host'] <> '') {
            $url['host'] = $url['host'];
        } else {
            $url['host'] = '';
        }
        if ($url['host'] == $_SERVER["SERVER_NAME"]) {
            if ($cs_video_section_title != '') {
                $video .= '<div class="cs-element-title"><h2>' . $cs_video_section_title . '</h2></div>';
            }
            
            $video .= '<figure  class="cs-video ' . $column_class . '">';
            $video .= '' . do_shortcode('[video height="' . $height . '" src="' . esc_url($video_url) . '"][/video]') . '';
            $video .= '</figure>';
        } else {

            if ($url['host'] == 'vimeo.com') {
                $content_exp = explode("/", $video_url);
                $content_vimo = array_pop($content_exp);
                if ($cs_video_section_title != '') {
                    $video .= '<div class="cs-element-title"><h2>' . $cs_video_section_title . '</h2></div>';
                }
                $video .= '<figure  class="cs-video ' . $column_class . '">';
                $video .= $cs_iframe . ' height="' . $height . '" src="'.cs_server_protocol().'player.vimeo.com/video/' . $content_vimo . '" allowfullscreen></iframe>';
                $video .= '</figure>';
            } else {
                
                if ($cs_video_section_title != '') {
                    $video .= '<div class="cs-element-title"><h2>' . $cs_video_section_title . '</h2></div>';
                }
                $video .= wp_oembed_get($video_url, array( 'width' => $width, 'height' => $height ));
            }
        }

		if(isset($column_size) && $column_size!=''){
                   $video .= '</div>';
		}
        return $video;
    }

    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_VIDEO, 'jobcareer_video_shortcode');
}