<?php

/*
 * Start function for quotes front end view
 */
if (!function_exists('jobcareer_quotes_shortcode')) {

    function jobcareer_quotes_shortcode($atts, $content = "") {
        $divider_div = '';
        $defaults = array(
            'column_size' => '',
            'quotes_style' => 'default',
            'cs_quotes_section_title' => '',
            'quotes_cite' => '',
            'quote_cite_url' => '#',
            'quotes_text_color' => '',
            'quote_align' => '',
            'cs_quote_content' => ''
            , $atts);
        extract(shortcode_atts($defaults, $atts));
        $author_name = '';
        $html = '';
        $column_class = jobcareer_custom_column_class($column_size);
        $cs_quotes_section = isset($atts['cs_quote_section_title']) ? $atts['cs_quote_section_title'] : '';
        $quote_cities = isset($atts['quote_cite']) ? $atts['quote_cite'] : '';
        $quotes_url = isset($atts['quote_cite_url']) ? $atts['quote_cite_url'] : '';
        $quote_color = isset($atts['quote_text_color']) ? $atts['quote_text_color'] : '';
        $quotes_aligns = isset($atts['quotes_align']) ? $atts['cs_quote_class'] : '';
        $cs_quote = isset($atts['cs_quote_content']) ? $atts['cs_quote_content'] : '';
        if (isset($quotes_url) && $quotes_url <> '') {
            $author_name .= '';
            if (isset($quotes_url) && $quotes_url <> '') {
                $author_name .= '<a href="' . esc_url($quotes_url) . '">';
            }
            $author_name .= '-- ' . $quote_cities;
            if (isset($quotes_url) && $quotes_url <> '') {
                $author_name .= '</a>';
            }
            $author_name .= '';
        }
        $align = "";

        if (isset($quote_align) && $quote_align == 'left') {
            $align = 'text-left-align';
        } else
        if (isset($quote_align) && $quote_align == 'right') {
            $align = 'text-right-align';
        } else
        if (isset($quote_align) && $quote_align == 'center') {
            $align = 'text-center-align';
        }
     
        $section_title = '';
         if ($column_class != '') {
            $html .= '<div class="'.$column_class.'">';
        }
        if ($cs_quotes_section && trim($cs_quotes_section) != '') {
            $section_title = '<div class="cs-element-title"><h2 class="">' . $cs_quotes_section . '</h2></div>';
            echo jobcareer_special_char($section_title);
        }
        $html .= '<blockquote class="' . $align . '" >
		<span>' . do_shortcode($content) . '</span>
		<span class="author-name"> ' . $author_name . '</span>
		</blockquote>';
        if ($column_class != '') {
            $html .= '</div>';
        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code('cs_quotes', 'jobcareer_quotes_shortcode');
    }
}