<?php
//======================================================================
// Adding Offer Slider start front end view
//======================================================================
if (!function_exists('jobcareer_offerslider_shortcode')) {

    function jobcareer_offerslider_shortcode($atts, $content = "") {
        $defaults = array(
            'column_size' => '1/1',
            'cs_offerslider_section_title' => '',
            'cs_offerslider_animation' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);

        if (trim($cs_offerslider_animation) != '') {
            $cs_offerslider_animation = 'wow' . ' ' . $cs_offerslider_animation;
        } else {
            $cs_offerslider_animation = '';
        }

        $html = '';
        $section_title = '';
        if ($cs_offerslider_section_title && trim($cs_offerslider_section_title) != '') {
            $section_title = '<div class="cs-element-title"><h2 class="' . $cs_offerslider_animation . '">' . $cs_offerslider_section_title . '</h2></div>';
        }
        $randomid = jobcareer_generate_random_string('10');
        ?>
        <script>
            jQuery(document).ready(function ($) {
                "use strict";
                jQuery('#postslider<?php echo esc_js($randomid); ?>').owlCarousel({
                    loop: true,
                    nav: false,
                    autoplay: true,
                    margin: 15,
                    navText: [
                        "",
                        ""
                    ],
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        1000: {
                            items: 1
                        }
                    }
                });
            });
        </script>
        <?php
        $html .= '<div ' . $CustomId . ' class="col-md-12">';
        $html .= $section_title;
        $html .= '<div class="row">';
        $html .= '<div id="postslider' . $randomid . '" class="owl-carousel has_bgicon cs-offers-slider">';
        $html .= do_shortcode($content);
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_OFFERSLIDER, 'jobcareer_offerslider_shortcode');
    }
}

//======================================================================
// Offer Slider item function front end view
//======================================================================
if (!function_exists('cs_offerslider_item')) {

    function cs_offerslider_item($atts, $content = null) {
        $defaults = array('cs_slider_image' => '', 'cs_slider_title' => '', 'cs_slider_contents' => '', 'cs_readmore_link' => '', 'cs_offerslider_link_title' => '');
        extract(shortcode_atts($defaults, $atts));
        $html = '';

        $html .='<div class="item">';

        if ($cs_slider_image) {
            $html .='<div class="col-md-7">';
            $html .='<figure>';
            if ($cs_readmore_link) {
                $html .='<a href="' . esc_url($cs_readmore_link) . '">';
            }
            $html .='<img  src="' . esc_url($cs_slider_image) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '">';
            if ($cs_readmore_link) {
                $html .='</a>';
            }
            $html .='</figure>';
            $html .='</div>';
        }

        $html .='<div class="col-md-5">';
        $html .='<div class="cs-contact-info no_border">';
        if ($cs_slider_title) {
            $html .='<h1>' . $cs_slider_title . '</h1>';
        }
        if ($content) {
            $html .='<p>' . do_shortcode($content) . '</p>';
        }
        if ($cs_readmore_link) {
            $link_title = $cs_offerslider_link_title ? $cs_offerslider_link_title : esc_html__('Get Directions','jobcareer');
            $html .='<a href="' . esc_url($cs_readmore_link) . '"><button class="custom-btn cs-bg-color">' . $link_title . '</button</a>';
        }
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';

        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_OFFERITEM, 'cs_offerslider_item');
    }
}