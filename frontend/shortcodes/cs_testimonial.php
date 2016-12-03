<?php
/*
 *
 * @Shortcode Name :   Start function for Testimonial shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_testimonials_shortcode')) {

    function jobcareer_testimonials_shortcode($atts, $content = null) {
        global $testimonial_style, $cs_testimonial_class, $column_class, $testimonial_text_color, $testimonial_author_color, $testimonial_comp_color, $section_title, $post, $jobcareer_options;
        $randomid = rand(10000, 99999);
        $defaults = array('column_size' => '', 'testimonial_style' => '', 'testimonial_text_color' => '', 'testimonial_author_color' => '', 'testimonial_comp_color' => '', 'testimonial_border' => '', 'testimonial_text_color' => '', 'cs_testimonial_text_align' => '', 'cs_testimonial_section_title' => '', 'cs_testimonial_class' => '');
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $section_title = '';
        $cs_testimonial_section_title = isset($cs_testimonial_section_title) ? $cs_testimonial_section_title : '';
        if (isset($cs_testimonial_section_title) and $cs_testimonial_section_title <> '') {
            $html .= '<div class="cs-element-title">';
            $html .= '<h2>' . $cs_testimonial_section_title . '</h2>';
            $html .= '</div>';
        }
        jobcareer_enqueue_slick_script();
        jobcareer_jquery_easing_js();

        //  Start script for Testimonial slider view
        ?>
        <script type='text/javascript'>
            jQuery(document).ready(function () {
                "use strict";
                jQuery('.slider<?php echo absint($randomid) ?>').slick({
                    infinite: true,
                    speed: 500,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    fade: true,
                    cssEase: 'linear',
                });
            });
        </script>
        <?php
        $cs_border_class = '';
        if ($testimonial_border == 'yes') {
            $cs_border_class = ' has-border';
        }

        if (isset($testimonial_style) and $testimonial_style == 'classic') {

            $html .= '<section class="testimonial-inner">';
            $html .= '<ul class="testimonial-home slider' . $randomid . $cs_border_class . '">';
            $html .= '' . do_shortcode($content) . '';
            $html .= '</ul>';
            $html .= '</section>';
        }  elseif (isset($testimonial_style) and $testimonial_style == 'advance-slider') {
            $html .= '<div class="testimonial-advance">'
                    . '<ul class="testimonials-slider-thumb">'
                    . do_shortcode($content)
					. '</ul>'
					  . '</div>';
        }
//        else {
//            $html .= '<ul class="testimonial-home slider' . $randomid . $cs_border_class . '">';
//            $html .= do_shortcode($content);
//            $html .= '</ul>';
//        }
        if ($column_class == '') {
            return $html;
        } else {
            return '<div class="' . $column_class . '"> ' . $html . '</div>';
        }
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TESTIMONIALS, 'jobcareer_testimonials_shortcode');
    }
}
/*
 *
 * @Shortcode Name :  Start function for Testimonial Item shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_testimonial_item')) {

    function jobcareer_testimonial_item($atts, $content = null) {
        global $testimonial_style, $cs_testimonial_class, $column_class, $testimonial_text_color, $testimonial_text_color, $testimonial_author_color, $testimonial_comp_color, $post;
        $defaults = array('testimonial_author' => '', 'testimonial_img_user' => '', 'cs_testimonial_text_align' => '', 'testimonial_company' => '');
        extract(shortcode_atts($defaults, $atts));
        $figure = '';
        $html = '';
        $testimonial_img_user = isset($testimonial_img_user) ? $testimonial_img_user : '';
		$testimonial_user_image='';
		if($testimonial_img_user!=''){
				$testimonial_user_image='<img alt="#" src="' . esc_url($testimonial_img_user) . '">';
		}
	
        $testimonial_company = isset($testimonial_company) ? $testimonial_company : '';
        $cs_test_text_color = '';
        $cs_test_author_color = '';
        $cs_test_comp_color = '';
        if ($testimonial_text_color != '') {
            $cs_test_text_color = ' style="color:' . $testimonial_text_color . ' !important;"';
        }
        if ($testimonial_author_color != '') {
            $cs_test_author_color = ' style="color:' . $testimonial_author_color . ' !important;"';
        }
        if ($testimonial_comp_color != '') {
            $cs_test_comp_color = ' style="color:' . $testimonial_comp_color . ' !important;"';
        }
        if (isset($testimonial_style) and $testimonial_style == 'simple') {

            $html = '';
            $html .= '<li>';
            $html .= '<div class="question-mark">';
            $html .= '<figure><img src="' . esc_url($testimonial_img_user) . '" alt="" class="img-circle" /><figcaption><i class="icon-slider4 cs-bgcolor"></i></figcaption></figure>';
            $html .= '<p' . $cs_test_text_color . '>' . do_shortcode($content) . '</p>';
            $html .= '<h4' . $cs_test_author_color . '>' . $testimonial_author . '</h4>';
            $html .= '<span' . $cs_test_comp_color . '>' . $testimonial_company . '</span> </div>';
            $html .= '</li>';
        }  elseif (isset($testimonial_style) and $testimonial_style == 'advance-slider') {
            $html = '
            <li>
                <a href="#" class="pos1">
                 '.$testimonial_user_image.'
                </a>
                <div class="question-mark"> 
                    <span' . $cs_test_text_color . '>' . do_shortcode($content) . '</span>
                    <div class="cs-text">
                        <div class="cs-author-info">
                            <h5' . $cs_test_author_color . '>' . $testimonial_author . '</h5>
                            <small' . $cs_test_comp_color . '>' . $testimonial_company . '</small> 
                        </div>
                    </div>
                </div>
            </li>';
        } else {

            $html = '';
            $html .= '<li>';
            $html .= '<div class="question-mark">';
            $html .= '<figure><img src="' . esc_url($testimonial_img_user) . '" alt="" class="img-circle" /><figcaption><i class="icon-slider4 cs-bgcolor"></i></figcaption></figure>';
            $html .= '<p' . $cs_test_text_color . '>' . do_shortcode($content) . '</p>';
            $html .= '<h4' . $cs_test_author_color . '>' . $testimonial_author . '</h4>';
            $html .= '<span' . $cs_test_comp_color . '>' . $testimonial_company . '</span> </div>';
            $html .= '</li>';
        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TESTIMONIALSITEM, 'jobcareer_testimonial_item');
    }
}
?>