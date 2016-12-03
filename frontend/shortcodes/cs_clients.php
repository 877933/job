<?php

/*
 *
 * @Shortcode Name : Clients
 * @retrun
 *
 */

if (!function_exists('jobcareer_clients_shortcode')) {

    function jobcareer_clients_shortcode($atts, $content = "") {
        global $post, $cs_clients_view, $cs_client_style;
        $defaults = array(
            'column_size' => '',
            'cs_clients_view' => esc_html__('Grid View', 'jobcareer'),
            'cs_client_style' => '',
            'cs_client_grey_scale' => '',
            'cs_client_section_title' => '',
            'cs_clients_perslide' => '',
            'cs_clients_arrow_switch' => 'yes'
        );
        extract(shortcode_atts($defaults, $atts));

        $cs_clients_perslide = isset($cs_clients_perslide) ? $cs_clients_perslide : '';
        $column_size = isset($column_size) ? $column_size : '';
        // if this is not set by admin then set it 6
        if ($cs_clients_perslide == '') {
            $cs_clients_perslide = 6;
        }
        $cs_clients_arrow_switch = isset($cs_clients_arrow_switch) ? $cs_clients_arrow_switch : '';
        $cs_clients_arrow_switch_str = 'false';
        // if this is not set by admin then set it 6
        if ($cs_clients_arrow_switch == 'yes') {
            $cs_clients_arrow_switch_str = 'true';
        }
        $column_class = '';
        if($column_size != ''){
        $column_class = jobcareer_custom_column_class($column_size);
        }
 
        $randomid = rand(40, 9999999);
        $title = "";
        if (isset($cs_client_section_title) && $cs_client_section_title <> "") {
            $title = $cs_client_section_title;
        }

        if (isset($cs_client_style) && $cs_client_style <> '') {
            $cs_client_style = $cs_client_style;
        } else {
            $cs_client_style = '';
        }
        $classes = '';
        if ($cs_client_grey_scale == 'yes') {
            $classes .= 'cs-grey-scale';
        }

        $html = '';
        if ($column_class != '') {
        $html .= '<div class="' . $column_class . '">';
        }
        jobcareer_enqueue_slick_script();
        if ($title <> "") {
            $html .= '<h2>' . esc_attr($title) . '</h2>';
        }
        if ($cs_client_style == 'simple' || $cs_client_style == 'modern' || $cs_client_style == 'fancy') {
            $html .= '<div class="cs-clinets ' . $classes . '">';
            $html .= '<div class="row">';
            if ($cs_client_style == 'fancy') {
                $html .= '<div class="cs-inner-clients">';
            }
            $html .= do_shortcode($content);
            if ($cs_client_style == 'fancy') {
                $html .= '</div>';
            }
            $html .= '</div>';
            $html .= '</div>';
         //   return $html;
        } else {
            $html .= '<div class="cs-clinets ' . $classes . '">';
            $html .= '<div class="row">';
            $html .= '<ul class="clients" id="client-slider' . $randomid . '">';
            $html .= do_shortcode($content);
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<script>
            jQuery(document).ready(function () {
                jQuery("#client-slider' . $randomid . '").slick({
                    infinite: true,
                    slidesToShow: ' . $cs_clients_perslide . ',
                    slidesToScroll: 1,
                    autoplay: true,
                    arrows: ' . $cs_clients_arrow_switch_str . ',
                    autoplaySpeed: 2000,
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    }, {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }]
                });
            });
            </script>';
            
        }
         if ($column_class != '') {
             $html .= '</div>';
             }
            return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_CLIENTS, 'jobcareer_clients_shortcode');
    }
}

/*
 * @Clinets Item
 * @retrun
 */
if (!function_exists('cs_clients_item_shortcode')) {

    function cs_clients_item_shortcode($atts, $content = "") {
        global $post, $cs_clients_view, $cs_client_style;
        $defaults = array('cs_bg_color' => '', 'cs_website_url' => '', 'cs_client_title' => '', 'cs_client_logo' => '');
        extract(shortcode_atts($defaults, $atts));
        $randomid = rand(1000, 9999);

        $html = '';
        $cs_client_logo = isset($cs_client_logo) ? $cs_client_logo : '';
        $cs_website_url = isset($cs_website_url) ? $cs_website_url : '';
        $tooltip = '';
        if (isset($cs_client_title) && $cs_client_title != '') {
            $tooltip = 'title="' . $cs_client_title . '"';
        }

        $cs_url = $cs_website_url ? $cs_website_url : 'javascript:;';
        if ($cs_client_style == 'simple' || $cs_client_style == 'modern' || $cs_client_style == 'fancy') {
            $classes = '';
            if ($cs_client_style == 'modern') {
                $classes = 'has-border';
            }
            if ($cs_client_style == 'fancy') {
                $classes = 'fancy-border';
            }
            if ($classes == 'has-border') {
                $html .= '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">';
                $html .= '<div class="' . $classes . '"><a href="' . esc_url($cs_website_url) . '"><img src="' . esc_url($cs_client_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"/></a></div>';
                $html .= '</div>';
            } else {
                $html .= '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ' . $classes . '"><a href="' . esc_url($cs_website_url) . '"><img src="' . esc_url($cs_client_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"/></a></div>';
            }
        } else {
            $html .= '<li class="col-lg-2 col-md-2 col-sm-4 col-xs-12"><a href="' . esc_url($cs_website_url) . '"><img src="' . esc_url($cs_client_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"/></a></li>';
        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_CLIENTSITEM, 'cs_clients_item_shortcode');
    }
}