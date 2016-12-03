<!DOCTYPE html>
<html <?php language_attributes(); ?>><head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <?php
        /**
         * The template for displaying header
         */
        $var_arrays = array('jobcareer_sett_options', 'jobcareer_node', 'jobcareer_xmlObject', 'jobcareer_page_option', 'post');
        $header_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
        extract($header_global_vars);
        $jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
        $cs_site_layout = '';

        if (isset($jobcareer_options['cs_layout'])) {
            $cs_site_layout = $jobcareer_options['cs_layout'];
        } else {
            $cs_site_layout == '';
        }
        $cs_post_id = isset($post->ID) ? $post->ID : '';
        if (isset($cs_post_id) and $cs_post_id <> '') {
            $cs_postObject = get_post_meta($post->ID, 'cs_full_data', true);
        } else {
            $cs_post_id = '';
        }
        ?>
        <link rel="profile" href="<?php echo cs_server_protocol(); ?>gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php
        if (isset($jobcareer_options['cs_custom_js']) and $jobcareer_options['cs_custom_js'] <> '') {
            echo '<script type="text/javascript">
					"use strict";
					 ' . htmlspecialchars_decode($jobcareer_options['cs_custom_js']) . '
				  </script> ';
        }
        if (function_exists('jobcareer_header_settings')) {
            jobcareer_header_settings();
        }

        // Google Fonts Enqueue
        if (function_exists('jobcareer_load_fonts')) {
            jobcareer_load_fonts();
        }
        jobcareer_header_meta();
        wp_head();
        ?>
    </head>
    <body <?php
    body_class();
    if ($cs_site_layout != 'full_width') {
        echo jobcareer_bg_image();
    }
    ?>><?php
            if (function_exists('jobcareer_under_construction')) {
                jobcareer_under_construction();
            }
            ?>
        <div id="cs_alerts" class="cs_alerts" ></div>
        <!-- Wrapper -->
        <div class="wrapper wrapper_<?php jobcareer_wrapper_class(); ?>">
            <?php
            if (function_exists('jobcareer_get_headers')) {
                jobcareer_get_headers();
			}
            if (get_post_type(get_the_ID()) != 'candidate' || get_post_type(get_the_ID()) != 'jobcareer' || get_post_type(get_the_ID()) != 'employer') {
                if (function_exists('jobcareer_below_header_style')) {
                    jobcareer_below_header_style();
                }
            }