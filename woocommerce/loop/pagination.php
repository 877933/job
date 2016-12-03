<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$woo_pagination = paginate_links( array(
	'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
	'format'       => '',
	'add_args'     => '',
	'current'      => max( 1, get_query_var( 'paged' ) ),
	'total'        => $wp_query->max_num_pages,
	'prev_text'    => '<i class="icon-angle-left"></i> '.esc_html__('Previous', 'jobcareer'),
	'next_text'    => esc_html__('Next', 'jobcareer').' <i class="icon-angle-right"></i>',
	'type'         => 'array',
	'end_size'     => 3,
	'mid_size'     => 3
) );

$jobcareer_traveladviser_pages = '';
if (is_array($woo_pagination) && sizeof($woo_pagination) > 0) {
    $jobcareer_traveladviser_pages .= '<ul class="pagination">';
    foreach ($woo_pagination as $jobcareer_traveladviser_link) {
        if (strpos($jobcareer_traveladviser_link, 'current') !== false) {
            $jobcareer_traveladviser_pages .= '<li><a class="active">' . preg_replace("/[^0-9]/", "", $jobcareer_traveladviser_link) . '</a></li>';
        } else {
            $jobcareer_traveladviser_pages .= '<li>' . $jobcareer_traveladviser_link . '</li>';
        }
    }
    $jobcareer_traveladviser_pages .= '</ul>';
}
echo force_balance_tags($jobcareer_traveladviser_pages);

