<?php
add_action( 'after_setup_theme', 'jobcareer_setup' );
require_once trailingslashit( get_template_directory() ) . 'classes/cs_global_functions.php';
/*
 * Start  CS Theme Setup function  
 */

if ( ! function_exists( 'jobcareer_setup' ) ) {

    function jobcareer_setup() {
        global $wpdb;
        /*
         * Add theme-supported features. 
         *
         * This theme styles the visual editor with editor-style.css to match the theme style.
         */
        add_editor_style();
        /*
         * Make theme available for translation Translations can be filed in the /languages/ directory
         */
        load_theme_textdomain( 'jobcareer', trailingslashit( get_template_directory() ) . 'languages' );
        if ( ! isset( $content_width ) ) {
            $content_width = 1170;
        }
        $args = array(
            'default-color' => '',
            'flex-width' => true,
            'flex-height' => true,
            'default-image' => '',
        );
        add_theme_support( 'custom-background', $args );
        add_theme_support( 'custom-header', $args );
        /*
         * This theme uses post thumbnails
         */
        add_theme_support( 'post-thumbnails' );
        /*
         * Add default posts and comments RSS feed links to head
         */
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( "title-tag" );

        /*
         * Add custom actions. 
         */
        global $pagenow;

        if ( ! get_option( 'jobcareer_font_list' ) || ! get_option( 'jobcareer_font_attribute' ) ) {
            jobcareer_get_google_init_arrays();
        }
        if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

            if ( ! get_option( 'cs_theme_options' ) ) {
                add_action( 'init', 'jobcareer_activation_data' );
            }

            if ( ! get_option( 'cs_theme_options' ) ) {
                wp_redirect( admin_url( 'themes.php?page=install-required-plugins' ) );
            }
        }

        add_action( 'admin_enqueue_scripts', 'jobcareer_admin_scripts' );
        /*
         * wp_enqueue_scripts
         */
        add_action( 'wp_enqueue_scripts', 'jobcareer_front_scripts', 1 );
        add_action( 'wp_enqueue_scripts', 'jobcareer_responsive_front_scripts', 4 );

        /*
         * Add custom filters. 
         */
        add_filter( 'widget_text', 'do_shortcode' );
        add_filter( 'the_password_form', 'jobcareer_password_form' );
        add_filter( 'wp_page_menu', 'jobcareer_add_menuid' );
        add_filter( 'wp_page_menu', 'jobcareer_remove_div' );
        add_filter( 'nav_menu_css_class', 'jobcareer_parent_css', 10, 2 );
        define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
    }

}

$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();

$jobcareer_options = get_option( 'cs_theme_options' );

/*
 * Start Default Gallery function 
 */
add_action( 'admin_footer-post.php', 'jobcareer_gallery_setting_div' );
if ( ! function_exists( 'jobcareer_gallery_setting_div' ) ) {

    function jobcareer_gallery_setting_div() {
        echo '<style type="text/css">
                .media-sidebar .gallery-settings{
                        display:none;
                }
             </style>';
    }

}

function jobcareer_form_field_comment( $field ) {

    return '';
}

// add the filter
add_filter( 'comment_form_field_comment', 'jobcareer_form_field_comment', 10, 1 );

add_action( 'comment_form_logged_in_after', 'jobcareer_comment_tut_fields' );
add_action( 'comment_form_after_fields', 'jobcareer_comment_tut_fields' );

function jobcareer_comment_tut_fields() {
    global $jobcareer_form_fields;
    $cs_msg_class = '';
    if ( is_user_logged_in() ) {
        $cs_msg_class = ' cs-message';
    }
    $jobcareer_comment_opt_array = array(
        'std' => '',
        'id' => '',
        'classes' => 'commenttextarea',
        'extra_atr' => ' rows="55" cols="15"',
        'cust_id' => 'comment_mes',
        'cust_name' => 'comment',
        'return' => true,
        'required' => false
    );
    $html = '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12' . $cs_msg_class . '"><div class="row"><div class="input-holder">' . $jobcareer_form_fields->cs_form_textarea_render( $jobcareer_comment_opt_array ) . '</div></div></div>';
    echo jobcareer_special_char( $html );
}

add_filter( 'body_class', 'jobcareer_body_classes' );

function jobcareer_body_classes( $classes ) {
    global $jobcareer_options;
    $cs_res_cls = (isset( $jobcareer_options['cs_responsive'] ) && $jobcareer_options['cs_responsive'] == "on") ? 'cbp-spmenu-push' : 'non-responsive';
    $classes[] = $cs_res_cls;
    return $classes;
}

add_filter( 'the_permalink', 'cs_decode_permalinks' );

function cs_decode_permalinks( $url ) {
    return urldecode( $url );
}

/*
 * Start Custom Gallery function 
 */
if ( ! function_exists( 'jobcareer_custom_gallery' ) ) {
    add_filter( 'post_gallery', 'jobcareer_custom_gallery', 10, 2 );
    if ( ! function_exists( 'jobcareer_custom_gallery' ) ) {

        function jobcareer_custom_gallery( $output, $attr ) {
            global $post;

            if ( isset( $attr['orderby'] ) ) {
                $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
                if ( ! $attr['orderby'] ) {
                    unset( $attr['orderby'] );
                }
            }

            extract( shortcode_atts( array(
                'order' => 'ASC',
                'orderby' => 'menu_order ID',
                'id' => $post->ID,
                'itemtag' => 'dl',
                'icontag' => 'dt',
                'captiontag' => 'dd',
                'include' => '',
                'exclude' => ''
                            ), $attr ) );

            $id = intval( $id );
            if ( 'RAND' == $order ) {
                $orderby = 'none';
            }

            if ( ! empty( $include ) ) {
                $include = preg_replace( '/[^0-9,]+/', '', $include );
                $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
                $attachments = array();
                foreach ( $_attachments as $key => $val ) {
                    $attachments[$val->ID] = $_attachments[$key];
                }
            }
            if ( empty( $attachments ) ) {
                return '';
            }
            $img_full = wp_get_attachment_image_src( $id, 'full' );
            $img = wp_get_attachment_image_src( $id, 'jobcareer_media_3' );
            $filename = basename( get_attached_file( $id ) );
            $i = 0;
            ob_start();
            foreach ( $attachments as $id => $attachment ) {
                $i = $i + 1;
                $img_full = wp_get_attachment_image_src( $id, 'full' );
                $img = wp_get_attachment_image_src( $id, 'jobcareer_media_3' );
                $filename = basename( get_attached_file( $id ) );
                $withoutExt = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $filename );
                ?> 
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 thumb">

                    <div class="cs-media">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo get_the_title( $id ) ?>" 
                           data-caption="<?php echo get_the_title( $id ) ?>" 
                           data-image="<?php echo esc_url( $img_full[0] ); ?>" data-target="#image-gallery">
                            <img class="img-responsive" src="<?php echo esc_url( $img["0"] ); ?>" alt="<?php echo get_the_title( $id ) ?>">
                        </a>
                    </div>

                </div>  
                <?php
            }
            $cs_gallery = ob_get_clean();
            $output = '<section class="cs-fancy">';
            $output .= '<div class="cs-gallry">';
            $output .= '<div class="row">';
            $output .= $cs_gallery;
            $output .= '</div>';
            $output .=
                    '<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> ' . esc_html__( 'Close', 'jobcareer' ) . '</span></button>
                                </div>
                                <div class="modal-body">
                                    <img id="image-gallery-image" class="img-responsive" src="#" alt="">
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary" id="show-previous-image">
                                            <i class="icon-arrow-left7"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-8 text-justify" id="image-gallery-caption">
                                        ' . esc_html__( 'This text will be overwritten by jQuery ', 'jobcareer' ) . '
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" id="show-next-image" class="btn btn-default">
                                            <i class="icon-arrow-right7"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
			</div>';
            $output .= '</div>';
            $output .= '</section>';

            return $output;
        }

    }
}

/*
 * tgm class for (internal and WordPress repository) plugin activation start
 */

require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-activation-plugins/tgm_plugin_activation.php';
if ( ! function_exists( 'jobcareer_required_plugins' ) ) {
    add_action( 'tgmpa_register', 'jobcareer_required_plugins' );
    if ( ! function_exists( 'jobcareer_required_plugins' ) ) {

        function jobcareer_required_plugins() {

            /*
             * Array of plugin arrays. Required keys are name and slug.
             * If the source is NOT from the .org repo, then source is also required.
             */

            $plugins = array(
                /*
                 * This is an example of how to include a plugin from the WordPress Plugin Repository.
                 */
                array(
                    'name' => esc_html__( 'WP jobhunt', 'jobcareer' ),
                    'slug' => 'wp-jobhunt',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/wp-jobhunt.zip',
                    'required' => true,
                    'version' => '1.5',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'JobHunt Application Deadline', 'jobcareer' ),
                    'slug' => 'jobhunt-application-deadline',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/jobhunt-application-deadline.zip',
                    'required' => true,
                    'version' => '1.3',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'JobHunt Indeed Jobs', 'jobcareer' ),
                    'slug' => 'jobhunt-indeed-jobs',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/jobhunt-indeed-jobs.zip',
                    'required' => true,
                    'version' => '1.3',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'JobHunt Notifications', 'jobcareer' ),
                    'slug' => 'jobhunt-notifications',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/jobhunt-notifications.zip',
                    'required' => true,
                    'version' => '1.3',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'JobHunt Email Templates', 'jobcareer' ),
                    'slug' => 'jobhunt-email-templates',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/jobhunt-email-templates.zip',
                    'required' => true,
                    'version' => '1.2',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'Revolution Slider', 'jobcareer' ),
                    'slug' => 'revslider',
                    'source' => '' . cs_server_protocol() . 'chimpgroup.com/wp-demo/download-plugin/revslider.zip',
                    'required' => true,
                    'version' => '',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'Jobhunt Apply With Facebook', 'jobcareer' ),
                    'slug' => 'jobhunt-apply-with-facebook',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/jobhunt-apply-with-facebook.zip',
                    'required' => true,
                    'version' => '1.1',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'CS Framework', 'jobcareer' ),
                    'slug' => 'cs-framework',
                    'source' => trailingslashit( get_template_directory_uri() ) . 'backend/theme-components/cs-activation-plugins/cs-framework.zip',
                    'required' => true,
                    'version' => '1.3',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => esc_html__( 'Loco translate', 'jobcareer' ),
                    'slug' => 'loco-translate',
                    'required' => true,
                    'version' => '',
                    'force_activation' => false,
                    'force_deactivation' => false,
                    'external_url' => '',
                ),
                array(
                    'name' => 'Woocommerce',
                    'slug' => 'woocommerce',
                    'required' => false,
                ),
                array(
                    'name' => esc_html__( 'Contact Form 7', 'jobcareer' ),
                    'slug' => 'contact-form-7',
                    'required' => false,
                ),
                array(
                    'name' => esc_html__( 'Envato Wordpress Toolkit', 'jobcareer' ),
                    'slug' => 'envato-wordpress-toolkit',
                    'source' => '' . cs_server_protocol() . 'github.com/envato/envato-wordpress-toolkit/archive/master.zip',
                    'external_url' => '',
                    'required' => false,
                )
            );

            /*
             * Change this to your theme text domain, used for internationalising strings
             */
            $theme_text_domain = 'jobcareer';
            /**
             * Array of configuration settings. Amend each line as needed.
             * If you want the default strings to be available under your own theme domain,
             * leave the strings uncommented.
             * Some of the strings are added into a sprintf, so see the comments at the
             * end of each line for what each argument will be.
             */
            $config = array(
                'domain' => 'jobcareer', /* Text domain - likely want to be the same as your theme. */
                'default_path' => '', /* Default absolute path to pre-packaged plugins */
                'parent_slug' => 'themes.php', /* Default parent menu slug */
                //'parent_menu_slug' => 'themes.php', /* Default parent menu slug */
                //'parent_url_slug' => 'themes.php', /* Default parent URL slug */
                'menu' => 'install-required-plugins', /* Menu slug */
                'has_notices' => true, /* Show admin notices or not */
                'is_automatic' => true, /* Automatically activate plugins after installation or not */
                'message' => '', /* Message to output right before the plugins table */
                'strings' => array(
                    'page_title' => esc_html__( 'Install Required Plugins', 'jobcareer' ),
                    'menu_title' => esc_html__( 'Install Plugins', 'jobcareer' ),
                    'installing' => esc_html__( 'Installing Plugin: %s', 'jobcareer' ), /* %1$s = plugin name */
                    'oops' => esc_html__( 'Something went wrong with the plugin API.', 'jobcareer' ),
                    'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'jobcareer' ), /* %1$s = plugin name(s) */
                    'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'jobcareer' ),
                    'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'jobcareer' ),
                    'return' => esc_html__( 'Return to Required Plugins Installer', 'jobcareer' ),
                    'plugin_activated' => esc_html__( 'Plugin activated successfully.', 'jobcareer' ),
                    'complete' => esc_html__( 'All plugins installed and activated successfully. %s', 'jobcareer' ), /* %1$s = dashboard link */
                    'nag_type' => 'updated' /* Determines admin notice type - can only be 'updated' or 'error' */
                )
            );
            tgmpa( $plugins, $config );
        }

    }
}

/*
 * tgm class for (internal and WordPress repository) plugin activation end
 * Thumb size On Blogs Detail
 */
add_image_size( 'jobcareer_media_1', 870, 489, true );


/*
 * Thumb size On Related Blogs On Detail, blogs on listing, Candidate Detail Portfolio
 */

add_image_size( 'jobcareer_media_2', 270, 203, true );

/*
 * Thumb size On Blogs On slider, blogs on listing, Candidate Detail Portfolio
 */

add_image_size( 'jobcareer_media_3', 236, 168, true );

add_image_size( 'jobcareer_media_4', 200, 200, true );

/*
 * Thumb size On BEmployer Listing, Employer Listing View 2,Candidate Detail ,User Resume, company profile
 */
add_image_size( 'jobcareer_media_5', 180, 135, true );

/*
 * Thumb size On Candidate ,Candidate , Listing 2, Employer Detail,Related Jobs
 */

add_image_size( 'jobcareer_media_6', 150, 113, true );

add_image_size( 'jobcareer_media_7', 120, 90, true );

/*
 * Thumb size On Related Blogs On Detail, blogs on listing, Candidate Detail Portfolio
 */

add_image_size( 'jobcareer_media_8', 350, 210, true );

// for blog large view
add_image_size( 'jobcareer_media_9', 825, 464, true );
/*
 * Start Default Navigation function 
 */
if ( ! function_exists( 'jobcareer_default_nav' ) ) {

    function jobcareer_default_nav( $format ) {
        posts_nav_link();
    }

}
// Start Default Navigation function

/*
 * Start Next post link function 
 */

if ( ! function_exists( 'jobcareer_posts_link_next_class' ) ) {

    function jobcareer_posts_link_next_class( $format ) {
        $format = str_replace( 'href=', 'class="pix-nextpost" href=', $format );
        return $format;
    }

    add_filter( 'next_post_link', 'jobcareer_posts_link_next_class' );
}

// End Next Post link function 

/**
 * Start Function how to get using servers and servers protocols
 */
if ( ! function_exists( 'cs_server_protocol' ) ) {

    function cs_server_protocol() {
        if ( is_ssl() ) {
            return 'https://';
        }
        return 'http://';
    }

}
/*
 * Start prev post link class function 
 */

if ( ! function_exists( 'jobcareer_posts_link_prev_class' ) ) {

    function jobcareer_posts_link_prev_class( $format ) {
        $format = str_replace( 'href=', 'class="pix-prevpost" href=', $format );
        return $format;
    }

    add_filter( 'previous_post_link', 'jobcareer_posts_link_prev_class' );
}


// End prev post link class function 
/*
 * stripslashes / htmlspecialchars for theme option save start
 */

if ( ! function_exists( 'jobcareer_stripslashes_chars' ) ) {

    function jobcareer_stripslashes_chars( $value ) {
        $value = is_array( $value ) ? array_map( 'jobcareer_stripslashes_chars', $value ) : stripslashes( htmlspecialchars( $value ) );
        return $value;
    }

}

// End stripslashes / htmlspecialchars for theme option save start
/*
 * Start Hex formating Color function 
 */
if ( ! function_exists( 'jobcareer_hex2rgb' ) ) {

    function jobcareer_hex2rgb( $hex ) {
        $hex = str_replace( "#", "", $hex );
        if ( strlen( $hex ) == 3 ) {
            $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
        } else {
            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }
        $rgb = array( $r, $g, $b );
        return $rgb;
    }

}
/*
 * End Hex formating Color function 
 */

/*
 * installing tables on theme activating start
 */

$var_arrays = array( 'pagenow' );
$function_global_vars = CS_JOBCAREER_GLOBALS()->globalizing( $var_arrays );
extract( $function_global_vars );

/*
 * Start function for admin files enqueue 
 */

if ( ! function_exists( 'jobcareer_admin_scripts' ) ) {

    function jobcareer_admin_scripts() {
        if ( is_admin() ) {
            jobcareer_timepicker_script();
            $template_path = trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/media_upload.js';
            wp_enqueue_media();
            wp_enqueue_script( 'jobcareer_my_upload_js', $template_path, array( 'jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker' ) );
            wp_enqueue_script( 'jobcareer_admin_theme_option_fucntion_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/theme_option_fucntion.js', '', '', true );
            wp_enqueue_script( 'jobcareer_custom_wp_admin_script_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/cs_functions.js' );
            wp_enqueue_script( 'jobcareer_custom_page_builder_wp_admin_script_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/cs_page_builder_functions.js' );
            wp_enqueue_script( 'jobcareer_bootstrap_min_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/bootstrap.min.js' );
            wp_enqueue_script( 'jobcareer_chosen_jquery_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/chosen.jquery.js' );
            wp_enqueue_script( 'cs_fonticonpicker_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/icon/js/jquery.fonticonpicker.min.js' );
            wp_enqueue_script( 'jobcareer_editor_script', trailingslashit( get_template_directory_uri() ) . 'backend/assets/editor/scripts/jquery-te-1.4.0.min.js' );


            /*
             * load icon moon
             */
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( 'cs_fonticonpicker_css', trailingslashit( get_template_directory_uri() ) . 'backend/assets/icon/css/jquery.fonticonpicker.min.css' );
            wp_enqueue_style( 'cs_fonticonpicker_bootstrap_css', trailingslashit( get_template_directory_uri() ) . 'backend/assets/icon/theme/bootstrap-theme/jquery.fonticonpicker.bootstrap.css' );
            wp_enqueue_style( 'cs_iconmoon_css', trailingslashit( get_template_directory_uri() ) . 'backend/assets/icon/css/iconmoon.css' );
            wp_enqueue_style( 'jobcareer_jquery_ui_datepicker_cs', trailingslashit( get_template_directory_uri() ) . 'backend/assets/css/jquery_ui_datepicker.css' );
            wp_enqueue_style( 'jobcareer_jobcareer_jquery_ui_datepicker_theme_cs', trailingslashit( get_template_directory_uri() ) . 'backend/assets/css/jquery_ui_datepicker_theme.css' );
            wp_enqueue_style( 'jobcareer_admin_styles_css', trailingslashit( get_template_directory_uri() ) . 'backend/assets/css/admin_style.css' );
            wp_enqueue_style( 'jobcareer_editor_style', trailingslashit( get_template_directory_uri() ) . 'backend/assets/editor/css/jquery-te-1.4.0.css' );
        }
    }

}

// End function for admin files enqueue 
//Include Classes files 
require_once trailingslashit( get_template_directory() ) . 'classes/class_parse.php';
require_once trailingslashit( get_template_directory() ) . 'classes/class_meta_fields.php';
require_once trailingslashit( get_template_directory() ) . 'classes/cs_form_fields.php';
require_once trailingslashit( get_template_directory() ) . 'classes/cs_html_fields.php';
require_once trailingslashit( get_template_directory() ) . 'backend/helpers/notification-helper.php';

/**
 * 
 * Include Backend shortcodes pages function 
 */
if ( ! function_exists( 'jobcareer_shortcode_files' ) ) {

    function jobcareer_shortcode_files() {

        $shortcode_directory = get_template_directory() . "/backend/shortcodes/";
        $aAdmin = array();
        $aFront = array();
        $aResult = array();
        $file_counter = 0;
        if ( is_dir( $shortcode_directory ) ) {
            if ( $dh = opendir( $shortcode_directory ) ) {
                while ( ($file = readdir( $dh )) !== false ) {
                    $aAdmin[] = $file;
                    $file_counter ++;
                }

                $aResult['admin'] = $aAdmin;
                closedir( $dh );
            }
        }
        if ( is_array( $aResult ) && count( $aResult ) > 0 ) {
            return $aResult;
        }
    }

}



// End Include backend Files
// Start shortcode include Files function

if ( ! function_exists( 'jobcareer_include_shortcode_files' ) ) {

    function jobcareer_include_shortcode_files() {
        $aFiles = jobcareer_shortcode_files();

        $admin = '/';
        $shortcode_directory = get_template_directory() . "/backend/shortcodes";
        foreach ( $aFiles as $file ) {
            for ( $i = 0; $i < sizeof( $file ); $i ++ ) {
                if ( $file[$i] != '' && $file[$i] != "." && $file[$i] != "..." && $file[$i] != ".." ) {
                    require_once $shortcode_directory . $admin . $file[$i];
                }
            }
        }
    }

}

// End shortcode include Files function
// Call include shortcode function 

if ( function_exists( 'jobcareer_include_shortcode_files' ) ) {
    jobcareer_include_shortcode_files();
}

/**
 * 
 * Include Backend shortcodes pages
 */
if ( ! function_exists( 'jobcareer_shortcode_front_files' ) ) {

    function jobcareer_shortcode_front_files() {

        $shortcode_directory = get_template_directory() . "/frontend/shortcodes/";
        $aAdmin = array();
        $aFront = array();
        $aResult = array();
        $file_counter = 0;
        if ( is_dir( $shortcode_directory ) ) {
            if ( $dh = opendir( $shortcode_directory ) ) {
                while ( ($file = readdir( $dh )) !== false ) {
                    //$aAdmin[] = $file;
                    $aFront[] = $file;
                    $file_counter ++;
                }

                $aResult['frontend'] = $aFront;
                closedir( $dh );
            }
        }
        if ( is_array( $aResult ) && count( $aResult ) > 0 ) {
            return $aResult;
        }
    }

}

// End Frontend files
// Start inlcude Frontend Files

if ( ! function_exists( 'jobcareer_include_shortcode_front_files' ) ) {

    function jobcareer_include_shortcode_front_files() {
        $aFiles = jobcareer_shortcode_front_files();

        $fornt = '/';
        $shortcode_directory = get_template_directory() . "/frontend/shortcodes/";
        foreach ( $aFiles as $file ) {
            for ( $i = 0; $i < sizeof( $file ); $i ++ ) {
                if ( $file[$i] != '' && $file[$i] != "." && $file[$i] != "..." && $file[$i] != ".." ) {
                    require_once $shortcode_directory . $fornt . $file[$i];
                }
            }
        }
    }

}
// Call frontend  files function 

if ( function_exists( 'jobcareer_include_shortcode_front_files' ) ) {
    jobcareer_include_shortcode_front_files();
}

// End Frontend Files
# Files
require_once trailingslashit( get_template_directory() ) . 'backend/theme-config.php';
require_once trailingslashit( get_template_directory() ) . 'backend/cs-auto-update.php';
require_once trailingslashit( CS_BASE ) . 'backend/importer-hooks.php';

require_once trailingslashit( get_template_directory() ) . 'backend/page-builder/cs_main.php';
//require_once trailingslashit(get_template_directory()) . 'backend/page-builder/class-wp-nav-menu-widget-chimp.php';
require_once trailingslashit( get_template_directory() ) . 'backend/metaboxes/cs_page_functions.php';
require_once trailingslashit( get_template_directory() ) . 'backend/metaboxes/cs_post.php';
require_once trailingslashit( get_template_directory() ) . 'backend/metaboxes/cs_page.php';
require_once trailingslashit( get_template_directory() ) . 'backend/metaboxes/cs_product.php';
#Blogs
require_once trailingslashit( get_template_directory() ) . 'templates/blog/blog_element.php';
require_once trailingslashit( get_template_directory() ) . 'templates/blog/blog_functions.php';
#Admin
require_once trailingslashit( get_template_directory() ) . 'backend/page-builder/cs_functions.php';

// Include theme componenets files 
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-widgets/cs_main.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-header/cs_functions.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-google-fonts/cs_fonts.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-google-fonts/cs_extra_fonts.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-google-fonts/cs_functions.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-google-fonts/cs_array.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-options/cs_options.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-options/cs_options_fields.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-options/cs_options_functions.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-options/cs_options_array.php';

// include files for Mega Menu
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-mega-menu/custom_walker.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-mega-menu/edit_custom_walker.php';
require_once trailingslashit( get_template_directory() ) . 'backend/theme-components/cs-mega-menu/menu_functions.php';

if ( class_exists( 'woocommerce' ) ) {
    require_once trailingslashit( get_template_directory() ) . 'backend/cs-woocommerce/cs-config.php';
}

jobcareer_include_file( ABSPATH . '/wp-admin/includes/file.php' );

// call add theme option function 
if ( ! function_exists( 'jobcareer_opt_menu' ) ) {
    add_action( 'admin_menu', 'jobcareer_opt_menu' );

    function jobcareer_opt_menu() {
        add_theme_page( 'CS Theme Option', esc_html__( 'CS Theme Option', 'jobcareer' ), 'read', 'jobcareer_theme_options_constructor', 'jobcareer_theme_options_constructor' );
    }

}

/*
 * start Enqueue frontend style and scripts function  
 */

if ( ! function_exists( 'jobcareer_front_scripts' ) ) {

    function jobcareer_front_scripts() {
        global $jobcareer_options;
        if ( ! is_admin() ) {
            /*
             * Css Files
             */
            wp_enqueue_style( 'jobcareer_iconmoon_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/iconmoon.css' );
            wp_enqueue_style( 'cs_bootstrap_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/bootstrap.css' );
            wp_enqueue_style( 'jobcareer_style_css', get_stylesheet_directory_uri() . '/style.css' );
            wp_enqueue_style( 'jobcareer_top-menu', trailingslashit( get_template_directory_uri() ) . 'assets/css/top-menu.css' );
            wp_enqueue_style( 'cs_slicknav_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/slicknav.css' );
            wp_enqueue_style( 'jobcareer_widgets_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/widget.css' );
            wp_enqueue_style( 'jobcareer_prettyPhoto', trailingslashit( get_template_directory_uri() ) . 'assets/css/prettyPhoto.css' );
            if ( class_exists( 'WooCommerce' ) ) {
                wp_enqueue_style( 'cs-woocommerce', trailingslashit( get_template_directory_uri() ) . 'assets/css/cs-woocommerce.css' );
            }

            // color style 
            $custom_style_ver = (isset( $jobcareer_options['jobcareer_theme_option_save_flag'] )) ? $jobcareer_options['jobcareer_theme_option_save_flag'] : '';
            wp_enqueue_style( 'jobcareer_custom_style_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/custom-style.css', '', $custom_style_ver );

            /*
             * Js Files
             * 
             */

            if ( isset( $jobcareer_options['cs_maintenance_page_switch'] ) and $jobcareer_options['cs_maintenance_page_switch'] == 'on' ) {
                wp_enqueue_script( 'jobcareer_addthis_widget_js', '' . cs_server_protocol() . 's7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', '', '', true );
            }
            wp_enqueue_script( 'cs_bootstrap_min_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/bootstrap.min.js', array( 'jquery' ), '', true );
            wp_enqueue_script( 'jobcareer_modernizr_min_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/modernizr.min.js', '', '', true );
            wp_enqueue_script( 'jobcareer_browser_detect_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/browser-detect.js', '', '', true );
            wp_enqueue_script( 'cs_slick_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/slick.js', '', '', true );
            wp_enqueue_script( 'jobcareer_jquery_sticky_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.sticky.js', '', '', true );
            wp_enqueue_script( 'jobcareer_map_styles', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/cs_map_styles.js', '', '', true );
            wp_enqueue_script( 'jobcareer_functions_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/functions.js', '', '', true );
            wp_enqueue_script( 'jobcareer_menu_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/menu.js', '', '', true );
            wp_enqueue_script( 'jobcareer_prettyPhoto_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.prettyPhoto.js', '', '', true );
            wp_enqueue_script( 'jobcareer_lightbox_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/lightbox.js', '', '', true );

            if ( is_singular() && get_option( 'thread_comments' ) && get_comments_number() ) {
                wp_enqueue_script( 'comment-reply' );
            }

            /*
             * Include scroll js enqueue files functions 
             */
            if ( ! function_exists( 'jobcareer_scrolltofix' ) ) {

                function jobcareer_scrolltofix() {
                    wp_enqueue_script( 'jobcareer_sticky_header_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/sticky_header.js', '', '', true );
                }

            }

            /*
             * Include scroll js enqueue files functions 
             */
            if ( ! function_exists( 'jobcareer_jquery_easing_js' ) ) {

                function jobcareer_jquery_easing_js() {
                    wp_enqueue_script( 'jobcareer_jquery_easing_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.easing.1.3.js', '', '', true );
                }

            }

            // Start Include  Counter Script enqueue files functions 
            if ( ! function_exists( 'jobcareer_counter_script' ) ) {

                function jobcareer_counter_script() {
                    wp_enqueue_script( 'jobcareer_counter_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/counter.js', '', '', true );
                }

            }

            /*
             *  Include slick Script enqueue files functions 
             */
            if ( ! function_exists( 'jobcareer_enqueue_slick_script' ) ) {

                function jobcareer_enqueue_slick_script() {
                    wp_enqueue_script( 'cs_slick_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/slick.js', '', '', true );
                }

            }

            /*
             * Start Include Count Script enqueue files functions 
             */
            if ( ! function_exists( 'jobcareer_enqueue_count_nos' ) ) {

                function jobcareer_enqueue_count_nos() {
                    wp_enqueue_script( 'jobcareer_countTo_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.countTo.js', '', '', true );
                    wp_enqueue_script( 'jobcareer_inview_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.inview.min.js', '', '', true );
                }

            }

            /*
             * Start Include Ticker enqueue files functions 
             */
            if ( ! function_exists( 'jobcareer_news_ticker_script' ) ) {

                function jobcareer_news_ticker_script() {
                    wp_enqueue_script( 'jobcareer_news_ticker_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/ticker.js', '', '', true );
                }

            }
            /*
             *  End Include Ticker enqueue files functions 
             */

            if ( ! function_exists( 'jobcareer_google_map_script' ) ) {

                function jobcareer_google_map_script() {
                    global $jobcareer_options;
                    $google_api_key = '?libraries=places';
                    if ( isset( $jobcareer_options['cs_googleapi_key'] ) && $jobcareer_options['cs_googleapi_key'] != '' ) {
                        $google_api_key = '?key=' . $jobcareer_options['cs_googleapi_key'] . '&libraries=places';
                    }
                    wp_enqueue_script( 'cs_google_autocomplete_script', 'https://maps.googleapis.com/maps/api/js' . $google_api_key );
                }

            }

            // Start Include Slide Menu enqueue files functions
            if ( ! function_exists( 'jobcareer_sliiide_menu' ) ) {

                function jobcareer_sliiide_menu() {
                    wp_enqueue_script( 'jobcareer_sliiide_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/sliiide.js', '', '', true );
                    wp_enqueue_script( 'jobcareer_nav-icon_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/nav-icon.js', '', '', true );
                    wp_enqueue_script( 'jobcareer_jquery.slicknav_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.slicknav.js', '', '', true );
                }

            }

            /*
             * Start Add this soocial sharing enqueue Script
             */
            if ( ! function_exists( 'jobcareer_addthis_script_init_method' ) ) {

                function jobcareer_addthis_script_init_method() {
                    wp_enqueue_script( 'jobcareer_addthis_widget_js', '' . cs_server_protocol() . 's7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64' );
                }

            }

            if ( ! function_exists( 'jobcareer_dynamic_scripts' ) ) {

                function jobcareer_dynamic_scripts( $cs_js_key, $cs_arr_key, $cs_js_code ) {
                    // Register the script
                    wp_register_script( 'jobcareer_dynamic_scripts', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/cs_inline_scripts_functions.js', '', '', true );
                    // Localize the script
                    $cs_code_array = array(
                        $cs_arr_key => $cs_js_code
                    );
                    wp_localize_script( 'jobcareer_dynamic_scripts', $cs_js_key, $cs_code_array );
                    wp_enqueue_script( 'jobcareer_dynamic_scripts' );

                    wp_enqueue_style( 'jobcareer_dynamic_scripts' );
                }

            }

            if ( ! function_exists( 'jobcareer_gallery_masonry' ) ) {

                function jobcareer_gallery_masonry() {
                    wp_enqueue_script( 'jobcareer_init_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/init.js', '', '', true );
                    wp_enqueue_script( 'jobcareer_freetile_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/jquery.freetile.js', '', '', true );
                    wp_enqueue_script( 'jobcareer_masonry_pkgd_min_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/masonry.pkgd.min.js', '', '', true );
                }

            }
        }
        jobcareer_inline_styles_method();
    }

}
/*
 * start Enqueue responsive frontend style and scripts function  
 */
if ( ! function_exists( 'jobcareer_responsive_front_scripts' ) ) {

    function jobcareer_responsive_front_scripts() {
        global $jobcareer_options;
        if ( ! is_admin() ) {
            /*
             * Css Files
             */
            if ( is_rtl() ) {
                wp_enqueue_style( 'jobcareer_rtl_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/rtl.css' );
            }

            if ( isset( $jobcareer_options['cs_responsive'] ) && $jobcareer_options['cs_responsive'] == "on" ) {
                echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">';
                wp_enqueue_style( 'jobcareer_responsive_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/responsive.css' );
            } else {
                wp_enqueue_style( 'jobcareer_none_responsive_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/none-responsive.css' );
                wp_enqueue_style( 'jobcareer_sliders_js', trailingslashit( get_template_directory_uri() ) . 'assets/scripts/sliders-code.js' );
            }
        }
    }

}

/*
 * Start Favicon and header code in head tag 
 */
if ( ! function_exists( 'jobcareer_header_settings' ) ) {

    function jobcareer_header_settings() {
        global $jobcareer_options;
        if ( ! function_exists( 'has_site_icon' ) || ! wp_site_icon() ) {
            $cs_favicon = isset( $jobcareer_options['cs_custom_favicon'] ) ? $jobcareer_options['cs_custom_favicon'] : '#';
            if ( isset( $cs_favicon ) && $cs_favicon != '' ) {
                ?>
                <link rel="shortcut icon" href="<?php echo esc_url( $cs_favicon ) ?>">
                <?php
            }
        }
    }

}

// End Favicone and header code in head tag

/*
 * Start footer settings function 
 */
if ( ! function_exists( 'jobcareer_footer_settings' ) ) {

    function jobcareer_footer_settings() {
        global $jobcareer_options;

        if ( isset( $jobcareer_options['analytics'] ) ) {
            echo htmlspecialchars_decode( $jobcareer_options['cs_custom_js'] );
        }
    }

}

// End Footer setting function 
/*
 * Start password protect post/page function
 */
if ( ! function_exists( 'jobcareer_password_form' ) ) {

    function jobcareer_password_form() {
        global $post, $cs_theme_option, $jobcareer_form_fields;

        $cs_password_opt_array = array(
            'std' => '',
            'id' => '',
            'classes' => '',
            'extra_atr' => ' size="20"',
            'cust_id' => 'password_field',
            'cust_name' => 'post_password',
            'return' => true,
            'required' => false,
            'cust_type' => 'password',
        );

        $cs_submit_opt_array = array(
            'std' => esc_html__( "Submit", 'jobcareer' ),
            'id' => '',
            'classes' => 'bgcolr',
            'extra_atr' => '',
            'cust_id' => '',
            'cust_name' => 'Submit',
            'return' => true,
            'required' => false,
            'cust_type' => 'submit',
        );


        $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
        $o = '<div class="password_protected">
                <div class="protected-icon"><a href="#"><i class="icon-unlock-alt icon-4x"></i></a></div>
                <h3>' . esc_html__( "This post is password protected. To view it please enter your password below:", 'jobcareer' ) . '</h3>';
        $o .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><label>'
                . $jobcareer_form_fields->cs_form_text_render( $cs_password_opt_array )
                . '</label>'
                . $jobcareer_form_fields->cs_form_text_render( $cs_submit_opt_array )
                . '</form>
            </div>';
        return $o;
    }

}

// End Password Protected function 
/*
 * Start tool tip text asaign function
 */
if ( ! function_exists( 'jobcareer_tooltip_text' ) ) {

    function jobcareer_tooltip_text( $popover_text = '', $return_html = true ) {
        $popover_link = '';
        if ( isset( $popover_text ) && $popover_text != '' ) {
            $popover_link = '<a class="cs-help" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="' . $popover_text . '"><i class="icon-help"></i></a>';
        }
        if ( $return_html == true ) {
            return jobcareer_special_char( $popover_link );
        } else {
            echo jobcareer_special_char( $popover_link );
        }
    }

}
/*
 *  End tool tip text asaign function
 */
/*
 * Start add menu id function
 */
if ( ! function_exists( 'jobcareer_add_menuid' ) ) {

    function jobcareer_add_menuid( $ulid ) {
        return preg_replace( '/<ul>/', '<ul id="menus">', $ulid, 1 );
    }

}
// End add menu id function

/*
 * Start remove additional div from menu function 
 */
if ( ! function_exists( 'jobcareer_remove_div' ) ) {

    function jobcareer_remove_div( $menu ) {
        return preg_replace( array( '#^<div[^>]*>#', '#</div>$#' ), '', $menu );
    }

}
// End Remove Additional div from Menu function 
/*
 * Start add parent class function 
 */
if ( ! function_exists( 'jobcareer_parent_css' ) ) {

    function jobcareer_parent_css( $classes, $item ) {
        global $cs_menu_children;
        if ( $cs_menu_children ) {
            $classes[] = 'parent';
        }
        return $classes;
    }

}
// End parent class function 

/*
 * Filter shortcode in text areas function 
 */
if ( ! function_exists( 'jobcareer_textarea_filter' ) ) {

    function jobcareer_textarea_filter( $content = '' ) {
        return do_shortcode( $content );
    }

}
// End shortcode in text area function 

/*
 * Start Add Featured/sticky text/icon for sticky posts.
 */
if ( ! function_exists( 'jobcareer_featured' ) ) {

    function jobcareer_featured() {
        if ( is_sticky() ) {
            ?>
            <span class="featured-post"><?php esc_html_e( 'Featured', 'jobcareer' ); ?></span>
            <?php
        }
    }

}
// End Add Featured/sticky text/icon for sticky posts.

/*
 * Start function for If no content, include the "No posts found" function
 */
if ( ! function_exists( 'jobcareer_no_result_found' ) ) {

    function jobcareer_no_result_found() {
        $is_search = '';
        global $jobcareer_options;
        ?>
        <div class="search-results">
            <div class="cs-element-title">
                <h2><strong><?php printf( esc_html__( 'Showing result for %s', 'jobcareer' ), get_search_query() ); ?></strong></h2>						
            </div>									
            <div class="suggestions">
                <h4 class="cs-color"><?php esc_html_e( 'Suggestions:', 'jobcareer' ); ?></h4>
                <ul>
                    <li><?php esc_html_e( 'Make sure all words are spelled correctly', 'jobcareer' ); ?></li>
                    <li><?php esc_html_e( 'Wildcard searches (using the asterisk *) are not supported', 'jobcareer' ); ?></li>
                    <li><?php esc_html_e( 'Try more general keywords, especially if you are attempting a name', 'jobcareer' ); ?></li>
                </ul>
            </div>									
            <div class="cs-search-area">
                <?php
                if ( is_search() ) :
                    get_search_form();
                endif;
                ?>
            </div>
        </div>
        <?php
    }

}

// End if no content include the no posts found function

/*
 * Start function for Highlight Search Results
 */
if ( ! function_exists( 'jobcareer_highlight_results' ) ) {

    function jobcareer_highlight_results( $text ) {
        if ( is_search() ) {
            $sr = get_query_var( 's' );
            $keys = explode( " ", $sr );
            $text = preg_replace( '/(' . implode( '|', $keys ) . ')/iu', '' . $sr . '', $text );
        }
        return $text;
    }

    add_filter( 'get_the_excerpt', 'jobcareer_highlight_results' );
}

// End highlight Search Results

/*
 * Start Custom function for previous posts
 */
if ( ! function_exists( 'jobcareer_next_prev_links' ) ) {

    function jobcareer_next_prev_links( $post_type = 'events' ) {
        global $post, $wpdb, $jobcareer_options, $jobcareer_xmlObject;
        $previd = $nextid = '';
        $post_type = get_post_type( $post->ID );
        $count_posts = wp_count_posts( "$post_type" )->publish;
        $cs_postlist_args = array(
            'posts_per_page' => -1,
            'order' => 'ASC',
            'post_type' => "$post_type",
        );
        $cs_postlist = get_posts( $cs_postlist_args );
        $ids = array();
        foreach ( $cs_postlist as $cs_thepost ) {
            $ids[] = $cs_thepost->ID;
        }
        $thisindex = array_search( $post->ID, $ids );
        if ( isset( $ids[$thisindex - 1] ) ) {
            $previd = $ids[$thisindex - 1];
        }
        if ( isset( $ids[$thisindex + 1] ) ) {
            $nextid = $ids[$thisindex + 1];
        }
        echo '<div class="cs-post-pagination">';
        if ( isset( $nextid ) && ! empty( $nextid ) && $nextid >= 0 ) {
            ?>
            <article class="cs-prev">
                <a href="<?php echo get_permalink( $nextid ); ?>"><i class="icon-arrow-right"></i> </a>
                <div class="cs-text">
                    <a class="cs-post-prev" href="<?php echo get_permalink( $nextid ) ?>"><?php esc_html_e( 'Read the next artical', 'jobcareer' ) ?></a>
                    <h3><a href="<?php echo get_permalink( $nextid ) ?>"><?php echo get_the_title( $nextid ) ?></a></h3>
                    <ul>
                        <li><time datetime="2008-02-14"><?php echo get_the_date(); ?></time> <?php esc_html_e( 'by', 'jobcareer' ) ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
                    </ul>
                </div>
            </article>
            <?php
        }
        if ( isset( $previd ) && ! empty( $previd ) ) {
            ?>
            <div class="cs-spreater">
                <div class="cs-divider1"></div>
            </div>
            <article class="cs-next">
                <a href="<?php echo get_permalink( $previd ); ?>"><i class="icon-arrow-left"></i> </a>
                <div class="cs-text">
                    <a class="cs-post-next" href="<?php echo get_permalink( $previd ) ?>"><?php esc_html_e( 'Read the previous artical', 'jobcareer' ) ?></a>
                    <h3><a href="<?php echo get_permalink( $previd ) ?>"><?php echo get_the_title( $previd ) ?></a></h3>
                    <ul>
                        <li><time datetime="2008-02-14"><?php echo get_the_date(); ?></time> <?php esc_html_e( 'by', 'jobcareer' ) ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
                    </ul>
                </div>
            </article>
            <?php
        }
        echo '</div>';
        /* wp_reset_query(); */
    }

}

// End custom function for previous posts
/*
 * Start Custom function for next posts
 */
if ( ! function_exists( 'jobcareer_portfolios_next_prev' ) ) {

    function jobcareer_portfolios_next_prev( $post_type = 'portfolios' ) {
        global $post, $wpdb, $jobcareer_options;
        $previd = $nextid = '';
        $post_type = get_post_type( $post->ID );
        $count_posts = wp_count_posts( "$post_type" )->publish;
        $cs_postlist_args = array(
            'posts_per_page' => -1,
            'order' => 'ASC',
            'post_type' => "$post_type",
        );

        $cs_postlist = get_posts( $cs_postlist_args );
        $ids = array();
        foreach ( $cs_postlist as $cs_thepost ) {
            $ids[] = $cs_thepost->ID;
        }
        $thisindex = array_search( $post->ID, $ids );
        if ( isset( $ids[$thisindex - 1] ) ) {
            $previd = $ids[$thisindex - 1];
        }
        if ( isset( $ids[$thisindex + 1] ) ) {
            $nextid = $ids[$thisindex + 1];
        }

        echo '<div class="cs-project-pagination"><ul>';
        if ( isset( $previd ) && ! empty( $previd ) && $previd >= 0 ) {
            ?>
            <li class="prev"><a href="<?php echo esc_url( get_permalink( $previd ) ); ?>"><?php esc_html_e( 'Previous Project', 'jobcareer' ) ?></a></li>
            <?php
        }
        if ( $previd > 0 || $nextid > 0 ) {

            $cs_prev_link = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url();
            echo '<li class="back"><a href="' . esc_url( cs_prev_link ) . '"><i class="icon-list8"></i> ' . esc_html__( 'Go Back', 'jobcareer' ) . '</a></li>';
        }
        if ( isset( $nextid ) && ! empty( $nextid ) ) {
            ?>
            <li class="next"><a href="<?php echo esc_url( get_permalink( $nextid ) ); ?>"><?php esc_html_e( 'Next Project', 'jobcareer' ) ?></a></li>
            <?php
        }
        echo '</ul></div>';
    }

}

// end Custom function for next posts

if ( ! function_exists( 'jobcareer_filter_head' ) ) {

    function jobcareer_filter_head() {
        remove_action( 'wp_head', '_admin_bar_bump_cb' );
    }

}
/*
 * Start function for enqueue timepicker scripts
 */
if ( ! function_exists( 'jobcareer_timepicker_script' ) ) {

    function jobcareer_timepicker_script() {
        wp_enqueue_script( 'jobcareer_jobcareer_datetimepicker_js', trailingslashit( get_template_directory_uri() ) . 'backend/assets/scripts/jquery_datetimepicker.js', '', '', true );
        wp_enqueue_style( 'jobcareer_jobcareer_datetimepicker_css', trailingslashit( get_template_directory_uri() ) . 'backend/assets/css/jquery_datetimepicker.css' );
    }

}


// End function for enqueue timepicker scripts 

/*
 * Start function for enqueue admin scripts
 */

add_action( 'admin_enqueue_scripts', 'jobcareer_cus_admin_scripts' );
if ( ! function_exists( 'jobcareer_cus_admin_scripts' ) ) {

    function jobcareer_cus_admin_scripts() {
        if ( isset( $_GET['page'] ) && $_GET['page'] == 'my_plugin_page' ) {
            wp_enqueue_media();
            wp_register_script( 'jobcareer_my_admin', WP_PLUGIN_URL . '/my-plugin/my-admin.js', array( 'jquery' ) );
            wp_enqueue_script( 'jobcareer_my_admin' );
        }
    }

}
// End function for enqueue admin script
/*
 * Start function for register theme menu
 */
if ( ! function_exists( 'jobcareer_register_menus' ) ) {

    function jobcareer_register_menus() {
        register_nav_menus(
                array(
                    'main-menu' => esc_html__( 'Main Menu', 'jobcareer' ),
                    'footer-menu' => esc_html__( 'Footer Menu', 'jobcareer' )
                )
        );
    }

}
add_action( 'init', 'jobcareer_register_menus' );

// End function for register theme menu


/*
 * Start Set Post Excerpt Default Length
 *
 */
if ( ! function_exists( 'jobcareer_excerpt_length' ) ) {

    function jobcareer_excerpt_length( $length ) {
        return 200;
    }

    add_filter( 'excerpt_length', 'jobcareer_excerpt_length' );
}
// End Set Post Excerpt Default Length
/*
 * Start function for Custom excerpt function
 */
if ( ! function_exists( 'jobcareer_get_excerpt' ) ) {

    function jobcareer_get_excerpt( $wordlength = '', $readmore = 'true', $readmore_text = 'Read More' ) {
        global $post, $jobcareer_options;
        if ( $wordlength == '' ) {
            $wordlength = $jobcareer_options['cs_excerpt_length'] ? $jobcareer_options['cs_excerpt_length'] : '30';
        }
        $excerpt = trim( preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '', get_the_content() ) );
        if ( $readmore == 'true' ) {
            $more = '..';
        } else {
            $more = '...';
        }
        $excerpt_new = wp_trim_words( $excerpt, $wordlength, $more );

        return $excerpt_new;
    }

}

// End function for Custom excerpt function
/*
 * Start function for Excerpt Read More
 */
if ( ! function_exists( 'jobcareer_excerpt_more' ) ) {

    function jobcareer_excerpt_more( $more = '...' ) {
        return '....';
    }

    add_filter( 'excerpt_more', 'jobcareer_excerpt_more' );
}

// End function for excerpt read more
/*
 * Start function for remove menu
 */
if ( ! function_exists( 'jobcareer_remove_menu_ids' ) ) {

    function jobcareer_remove_menu_ids() {
        add_filter( 'nav_menu_item_id', '__return_null' );
    }

    add_action( 'init', 'jobcareer_remove_menu_ids' );
}

//End function for remove menu

/*
 * Start function for return selected values
 */
if ( ! function_exists( 'jobcareer_selected' ) ) {

    function jobcareer_selected( $current, $orignal ) {
        if ( $current == $orignal ) {
            echo ' selected="selected"';
        }
    }

}

// End function for return selected values
// Start element size function

if ( ! function_exists( 'jobcareer_pb_element_sizes' ) ) {

    function jobcareer_pb_element_sizes( $size = '100' ) {

        if ( isset( $size ) && $size == '' ) {
            $element_size = 'element-size-100';
        } else {
            $element_size_col = $size;
        }

        if ( isset( $element_size_col ) and $element_size_col == '100' || $element_size_col > 75 ) {

            $element_size = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        } else if ( isset( $element_size_col ) and $element_size_col == '75' || $element_size_col > 67 ) {

            $element_size = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
        } else if ( isset( $element_size_col ) and $element_size_col == '67' || $element_size_col > 50 ) {

            $element_size = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
        } else if ( isset( $element_size_col ) and $element_size_col == '50' || $element_size_col > 33 ) {

            $element_size = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
        } else if ( isset( $element_size_col ) and $element_size_col == '33' || $element_size_col > 25 ) {

            $element_size = 'col-lg-4 col-md-4 col-sm-12 col-xs-12';
        } else if ( isset( $element_size_col ) and $element_size_col == '25' || $element_size_col < 25 ) {

            $element_size = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
        }

        return $element_size;
    }

}
// End Element size function

/*
 * Start Enable More Buttons
 */
if ( ! function_exists( 'jobcareer_enable_more_btns' ) ) {

    function jobcareer_enable_more_btns( $buttons ) {

        $buttons[] = 'fontselect';
        $buttons[] = 'fontsizeselect';
        $buttons[] = 'styleselect';
        $buttons[] = 'backcolor';
        $buttons[] = 'newdocument';
        $buttons[] = 'cut';
        $buttons[] = 'copy';
        $buttons[] = 'charmap';
        $buttons[] = 'hr';
        $buttons[] = 'visualaid';
        return $buttons;
    }

    add_filter( "mce_buttons_3", "jobcareer_enable_more_btns" );
}

// End enable more button
// Start register heart Beat
add_action( 'init', 'jobcareer_deregister_heartbeat', 1 );
if ( ! function_exists( 'jobcareer_deregister_heartbeat' ) ) {

    function jobcareer_deregister_heartbeat() {
        global $pagenow;
        if ( 'post.php' != $pagenow && 'post-new.php' != $pagenow )
            wp_deregister_script( 'heartbeat' );
    }

}
// End register heart beat
/*
 * Start function for ajax base Like Counter
 */
if ( ! function_exists( 'jobcareer_like_counter' ) ) {

    function jobcareer_like_counter( $cs_likes_title = '' ) {
        $jobcareer_like_counter = '';
        $jobcareer_like_counter = get_post_meta( get_the_id(), "jobcareer_like_counter", true );
        if ( ! isset( $jobcareer_like_counter ) or empty( $jobcareer_like_counter ) )
            $jobcareer_like_counter = 0;
        if ( isset( $_COOKIE["jobcareer_like_counter" . get_the_id()] ) ) {
            ?>
            <a> <i class="icon-heart liked-post"></i><span><?php echo jobcareer_special_char( $jobcareer_like_counter . ' ' . $cs_likes_title ); ?></span></a> 
        <?php } else { ?>
            <a class="likethis<?php echo get_the_id() ?> cs-btnheart cs-btnpopover" id="like_this<?php echo get_the_id() ?>"  href="javascript:jobcareer_like_counter('<?php echo get_template_directory_uri() ?>',<?php echo get_the_id() ?>,'<?php echo jobcareer_special_char( $cs_likes_title ); ?>','<?php echo admin_url( 'admin-ajax.php' ); ?>')" data-container="body" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Like This', 'jobcareer' ); ?>"><i class="icon-heart-o"></i><span><?php echo jobcareer_special_char( $jobcareer_like_counter . ' ' . $cs_likes_title ); ?></span></a>

            <a class="likes likethis" id="you_liked<?php echo get_the_id() ?>" style="display:none;"><i class="icon-heart  liked-post"></i><span class="count-numbers like_counter<?php echo get_the_id() ?>"><?php echo jobcareer_special_char( $jobcareer_like_counter . ' ' . $cs_likes_title ); ?></span> </a>

            <div id="loading_div<?php echo get_the_id() ?>" style="display:none;"><i class="icon-spinner icon-spin"></i></div>
            <?php
        }
    }

    /*
     * Like Counter*
     */
    add_action( 'wp_ajax_nopriv_jobcareer_likes_count', 'jobcareer_likes_count' );
    add_action( 'wp_ajax_jobcareer_likes_count', 'jobcareer_likes_count' );
}

/*
 * End function for ajax base Like Counter
 */


// Start likes count function
if ( ! function_exists( 'jobcareer_likes_count' ) ) {

    function jobcareer_likes_count() {
        $jobcareer_like_counter = get_post_meta( $_POST['post_id'], "jobcareer_like_counter", true );
        if ( ! isset( $_COOKIE["jobcareer_like_counter" . $_POST['post_id']] ) ) {
            setcookie( "jobcareer_like_counter" . $_POST['post_id'], 'true', time() + (10 * 365 * 24 * 60 * 60), '/' );
            update_post_meta( $_POST['post_id'], 'jobcareer_like_counter', $jobcareer_like_counter + 1 );
        }
        $jobcareer_like_counter = get_post_meta( $_POST['post_id'], "jobcareer_like_counter", true );
        if ( ! isset( $jobcareer_like_counter ) or empty( $jobcareer_like_counter ) )
            $jobcareer_like_counter = 0;
        echo jobcareer_special_char( $jobcareer_like_counter );
        die();
    }

}

// End likes count function 

/*
 * Start Mailchimp function 
 */
add_action( 'wp_ajax_nopriv_jobcareer_mailchimp', 'jobcareer_mailchimp' );
add_action( 'wp_ajax_jobcareer_mailchimp', 'jobcareer_mailchimp' );

if ( ! function_exists( 'jobcareer_mailchimp' ) ) {

    function jobcareer_mailchimp() {
        global $jobcareer_options, $counter;
        if ( class_exists( 'MailChimp' ) ) {
            $mailchimp_key = '';
            if ( isset( $jobcareer_options['jobcareer_mailchimp_key'] ) ) {
                $mailchimp_key = $jobcareer_options['jobcareer_mailchimp_key'];
            }
            if ( isset( $_POST ) and ! empty( $_POST['cs_list_id'] ) and $mailchimp_key != '' ) {
                if ( $mailchimp_key <> '' ) {
                    $MailChimp = new MailChimp( $mailchimp_key );
                }
                $email = $_POST['mc_email'];
                $list_id = $_POST['cs_list_id'];
                $result = $MailChimp->call( 'lists/subscribe', array(
                    'id' => $list_id,
                    'email' => array( 'email' => $email ),
                    'merge_vars' => array(),
                    'double_optin' => false,
                    'update_existing' => false,
                    'replace_interests' => false,
                    'send_welcome' => true,
                        ) );
                if ( $result <> '' ) {
                    if ( isset( $result['status'] ) and $result['status'] == 'error' ) {
                        echo jobcareer_special_char( $result['error'] );
                    } else {
                        echo esc_html__( 'Subscribed Successfully', 'jobcareer' );
                    }
                }
            } else {
                echo esc_html__( 'please set API key', 'jobcareer' );
            }
        }
        die();
    }

}

// End Mailchimp function 

/*
 * Start Mailchimp widget functions
 */
if ( ! function_exists( 'jobcareer_mailchimp_list' ) ) {

    function jobcareer_mailchimp_list( $apikey ) {
        global $jobcareer_options;
        if ( class_exists( 'MailChimp' ) ) {
            $MailChimp = new MailChimp( $apikey );
            $mailchimp_list = $MailChimp->call( 'lists/list' );
            return $mailchimp_list;
        }
    }

}
// End Mailchimp list end

/**
 * Start under construction function for coming soon page
 */
if ( ! function_exists( 'jobcareer_under_construction' ) ) {

    function jobcareer_under_construction() {
        global $jobcareer_options, $post, $cs_uc_options, $jobcareer_options, $counter;
        $counter ++;
        $cs_uc_options = get_option( 'cs_theme_options' );

        $cs_social_text = isset( $jobcareer_options['cs_social_text'] ) ? $jobcareer_options['cs_social_text'] : '';
        $cs_newsletter_text = isset( $jobcareer_options['cs_newsletter_text'] ) ? $jobcareer_options['cs_newsletter_text'] : '';
        $cs_maintenance_newsletter_switch = isset( $jobcareer_options['cs_maintenance_newsletter_switch'] ) ? $jobcareer_options['cs_maintenance_newsletter_switch'] : '';
        $cs_maintenance_social_switch = isset( $jobcareer_options['cs_maintenance_social_switch'] ) ? $jobcareer_options['cs_maintenance_social_switch'] : '';
        $cs_maintenance_bg_img = isset( $jobcareer_options['cs_maintenance_bg_img'] ) ? $jobcareer_options['cs_maintenance_bg_img'] : '';



        if ( isset( $post ) ) {
            $post_name = $post->post_name;
        } else {
            $post_name = '';
        }
        $cs_maintenance_logo_switch = "";
        $cs_maintenance_custom_logo = isset( $jobcareer_options['cs_maintenance_custom_logo'] ) ? $jobcareer_options['cs_maintenance_custom_logo'] : '';
        $cs_maintenance_logo_switch = isset( $jobcareer_options['cs_maintenance_logo_switch'] ) ? $jobcareer_options['cs_maintenance_logo_switch'] : '';
        $cs_newsletter_text = isset( $jobcareer_options['cs_newsletter_text'] ) ? $jobcareer_options['cs_newsletter_text'] : '';
        $cs_social_text = isset( $jobcareer_options['cs_social_text'] ) ? $jobcareer_options['cs_social_text'] : '';

        $cs_maintenance_page_switch = isset( $cs_uc_options['cs_maintenance_page_switch'] ) ? $cs_uc_options['cs_maintenance_page_switch'] : 'off';
        if ( ($cs_maintenance_page_switch == "on" && ! (is_user_logged_in())) or $post_name == "pf-under-construction" ) {
            $launch_date = '15/01/2017';
            if ( isset( $cs_uc_options['cs_launch_date'] ) && $cs_uc_options['cs_launch_date'] != '' ) {
                $launch_date = trim( $cs_uc_options['cs_launch_date'] );
            }
            ?>
            <script>


                function jobcareer_mailchimp_submit(theme_url, counter, admin_url) {
                    'use strict';
                    $ = jQuery;
                    $('#btn_newsletter_' + counter).hide();
                    $('#process_' + counter).html('<div id="process_newsletter_' + counter + '"><i class="icon-refresh icon-spin"></i></div>');
                    $.ajax({
                        type: 'POST',
                        url: admin_url,
                        data: $('#mcform_' + counter).serialize() + '&action=jobcareer_mailchimp',
                        success: function (response) {
                            $('#mcform_' + counter).get(0).reset();
                            $('#newsletter_mess_' + counter).fadeIn(600);
                            $('#newsletter_mess_' + counter).html(response);
                            $('#btn_newsletter_' + counter).fadeIn(600);
                            $('#process_' + counter).html('');
                        }
                    });
                }

            </script>
            <style>
                .cover-pic
                { 
                    background: rgba(0, 0, 0, 0) url(<?php echo esc_url( $cs_maintenance_bg_img ); ?>) no-repeat scroll 0 0 / 100% auto !important;

                }

            </style>
            <div id="main">
                <section class="cs-construction">
                    <div class="holder">
                        <div class="col-md-5">
                            <div class="cover-pic">


                            </div>
                        </div>
                        <div class="col-md-7">

                            <div class="cs-content">
                                <?php if ( isset( $cs_maintenance_logo_switch ) and $cs_maintenance_logo_switch == 'on' ) { ?>                                                             
                                    <?php if ( $cs_maintenance_custom_logo <> '' ) { ?> 
                                        <div class="under-logo">
                                            <figure><a href="<?php echo esc_url( get_site_url() ); ?>"> <img alt="image" src="<?php echo esc_url( $cs_maintenance_custom_logo ); ?>"  class="img-responsive"></a></figure>
                                        </div>
                                    <?php } ?>
                                    <?php
                                }

                                echo '  <div class="cs-text">';
                                if ( $cs_uc_options['cs_maintenance_text'] ) {
                                    echo stripslashes( htmlspecialchars_decode( $cs_uc_options['cs_maintenance_text'] ) );
                                } else {
                                    ?>
                                    <h3><?php esc_html_e( 'Sorry! We are down for maintenance', 'jobcareer' ); ?></h3>
                                    <p><?php esc_html_e( 'the best experience with this one.', 'jobcareer' ); ?>   </p>
                                <?php } echo '</div>';
                                ?> 

                                <div class="date"></div>
                                <?php
                                $aLaunchDate = explode( "/", $launch_date );
                                $splitedDay = $aLaunchDate[0];
                                $splitedMonth = $aLaunchDate[1];
                                $splitedYear = $aLaunchDate[2];
                                $newLaunchDate = $splitedYear . '/' . $splitedMonth . '/' . $splitedDay;
                                ?>
                                <script type="text/javascript">
                                    jQuery(document).ready(function () {


                                        var endDate = '<?php echo esc_attr( $newLaunchDate ); ?>'; // you can set date and time both or any one of those.
                                        var element = '.date'; // set class or id name.

                                        if (element.length != '') {

                                            var timeInterval = setInterval(function () {

                                                // converting milliseconds into seperate units

                                                var seconds = 1000;
                                                var minutes = seconds * 60;
                                                var hours = minutes * 60;
                                                var days = hours * 24;
                                                var months = days * 30;
                                                var years = days * 365;

                                                // getting end and start times

                                                var startTime = new Date();
                                                var endTime = new Date(endDate);

                                                // checking endtime should be greater than current time 

                                                if (startTime >= endTime) {

                                                    jQuery(element).html('Time has Reached! Wait for A While.');
                                                    clearInterval(timeInterval);

                                                } else {

                                                    // getting difference in time 

                                                    var timeDiff = endTime.getTime() - startTime.getTime();

                                                    // converting difference in time into seperate units

                                                    var secondsLeft = Math.floor(timeDiff / seconds);
                                                    var minutesLeft = Math.floor(timeDiff / minutes);
                                                    var hoursLeft = Math.floor(timeDiff / hours);
                                                    var daysLeft = Math.floor(timeDiff / days);
                                                    var monthsLeft = Math.floor(timeDiff / months);
                                                    var yearsLeft = Math.floor(timeDiff / years);

                                                    // time should not exceed its unit limit

                                                    var secondsRem = secondsLeft % 60;
                                                    var minutesRem = minutesLeft % 60;
                                                    var hoursRem = hoursLeft % 24;
                                                    var daysRem = daysLeft % 31;
                                                    var monthsRem = monthsLeft % 12;
                                                    var yearsRem = yearsLeft % 365;

                                                    // html structure for putting data

                                                    var secondsHtml = '<span class="seconds"> <span class="digit">' + secondsRem + '</span> <span class="unit">Seconds</span></span>';
                                                    var minutesHtml = '<span class="minutes"> <span class="digit">' + minutesRem + '</span> <span class="unit">Minutes</span></span>';
                                                    var hoursHtml = '<span class="hours"> <span class="digit">' + hoursRem + '</span> <span class="unit">Hours</span></span>';
                                                    var daysHtml = '<span class="days"> <span class="digit">' + daysRem + '</span> <span class="unit">Days</span></span>';
                                                    var monthsHtml = '<span class="months"> <span class="digit">' + monthsRem + '</span> <span class="unit">Months</span></span>';
                                                    var yearsHtml = '<span class="years"> <span class="digit">' + yearsRem + '</span> <span class="unit">Years</span></span>';

                                                    // if any unit reaches to '0' it won't show

                                                    if (secondsLeft > 0) {

                                                        secondsLeft = secondsLeft % 60;
                                                        jQuery(element).html(secondsHtml);

                                                        if (minutesLeft > 0) {

                                                            minutesLeft = minutesLeft % 60;
                                                            jQuery(element).html(minutesHtml + '' + secondsHtml);

                                                            if (hoursLeft > 0) {

                                                                hoursLeft = hoursLeft % 24;
                                                                jQuery(element).html(hoursHtml + '' + minutesHtml + '' + secondsHtml);

                                                                if (daysLeft > 0) {

                                                                    daysLeft = daysLeft % 31;
                                                                    jQuery(element).html(daysHtml + '' + hoursHtml + '' + minutesHtml + '' + secondsHtml);

                                                                    if (monthsLeft > 0) {

                                                                        monthsLeft = monthsLeft % 12;
                                                                        jQuery(element).html(monthsHtml + '' + daysHtml + '' + hoursHtml + '' + minutesHtml + '' + secondsHtml);

                                                                        if (yearsLeft > 0) {

                                                                            yearsLeft = yearsLeft % 365;
                                                                            jQuery(element).html(yearsHtml + '' + monthsHtml + '' + daysHtml + '' + hoursHtml + '' + minutesHtml + '' + secondsHtml);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }, 1000);
                                        }
                                    });
                                </script>

                                <?php if ( isset( $cs_maintenance_newsletter_switch ) and $cs_maintenance_newsletter_switch == 'on' ) { ?>
                                    <div class="widget newsletter-widget">
                                        <div class="widget-title">
                                            <h3><?php esc_html_e( "WEEKLY NEWSLETTER", "jobcareer" ); ?></h3>
                                        </div>
                                        <div class="fieldset">   
                                            <?php
                                            if ( function_exists( 'cs_custom_mailchimp' ) ) {
                                                cs_custom_mailchimp();
                                            }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if ( isset( $cs_maintenance_social_switch ) and $cs_maintenance_social_switch == 'on' ) { ?>
                                    <?php
                                    if ( isset( $cs_uc_options['cs_social_text'] ) && $cs_uc_options['cs_social_text'] != '' ) {
                                        echo'<h1>' . $cs_social_text . '</h1>';
                                    }
                                    ?>

                                    <div class="share-post">
                                        <ul class="share-medea">
                                            <?php
                                            echo jobcareer_blog_single_share( 0 );
                                            ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php
            die();
        }
    }

}

// End under construction function for coming soon page


/*
 * Start Social Share Blog function 
 */
if ( ! function_exists( 'jobcareer_social_share_blog' ) ) {

    function jobcareer_social_share_blog( $default_icon = 'false', $title = 'true', $post_social_sharing_text = '' ) {
        global $jobcareer_options;
        $html = '';
        $twitter = $jobcareer_options['cs_twitter_share'];
        $facebook = $jobcareer_options['cs_facebook_share'];
        $google_plus = $jobcareer_options['cs_google_plus_share'];
        $tumblr = $jobcareer_options['cs_tumblr_share'];
        $dribbble = $jobcareer_options['cs_dribbble_share'];
        $instagram = $jobcareer_options['cs_instagram_share'];
        $share = $jobcareer_options['cs_share_share'];
        $stumbleupon = $jobcareer_options['cs_stumbleupon_share'];
        $youtube = $jobcareer_options['cs_youtube_share'];
        /*  jobcareer_addthis_script_init_method(); */
        $html = '';
        $path = get_template_directory_uri() . "/backend/assets/images/";
        if ( $twitter == 'on' or $facebook == 'on' or $google_plus == 'on' or $pinterest == 'on' or $tumblr == 'on' or $dribbble == 'on' or $instagram == 'on' or $share == 'on' or $stumbleupon == 'on' or $youtube == 'on' ) {
            $html = '<ul>';
            $html .= '<li class="cs-sharepost">';
            $html .='<a class="cs-sharepost-btn cs-bgcolor"><i class="icon-share-alt"></i>' . $post_social_sharing_text . '</a>';
            $html .='<div class="social-media"><ul>';
            if ( $default_icon <> '1' ) {

                if ( isset( $facebook ) && $facebook == 'on' ) {
                    $html .='<li><a class="addthis_button_facebook" onclick="incrementValue()" data-original-title="Facebook"><i class="icon-facebook2"></i></a></li>';
                }
                if ( isset( $twitter ) && $twitter == 'on' ) {
                    $html .='<li><a class="addthis_button_twitter" onclick="incrementValue()" data-original-title="twitter"><i class="icon-twitter6"></i></a></li>';
                }
                if ( isset( $google_plus ) && $google_plus == 'on' ) {
                    $html .='<li><a class="addthis_button_google" onclick="incrementValue()" data-original-title="google-plus"><i class="icon-google-plus"></i></a></li>';
                }
                if ( isset( $tumblr ) && $tumblr == 'on' ) {
                    $html .='<li><a class="addthis_button_tumblr" onclick="incrementValue()" data-original-title="Tumblr"><i class="icon-tumblr2"></i></a></li>';
                }
                if ( isset( $dribbble ) && $dribbble == 'on' ) {
                    $html .='<li><a class="addthis_button_dribbble" onclick="incrementValue()" data-original-title="Dribbble"><i class="icon-dribbble2"></i></a></li>';
                }
                if ( isset( $instagram ) && $instagram == 'on' ) {
                    $html .='<li><a class="addthis_button_instagram" onclick="incrementValue()" data-original-title="Instagram"><i class="icon-instagram"></i></a></li>';
                }
                if ( isset( $stumbleupon ) && $stumbleupon == 'on' ) {
                    $html .='<li><a class="addthis_button_stumbleupon" onclick="incrementValue()" data-original-title="stumbleupon"><i class="icon-stumbleupon5"></i></a></li>';
                }
                if ( isset( $youtube ) && $youtube == 'on' ) {
                    $html .='<li><a class="addthis_button_youtube" onclick="incrementValue()" data-original-title="Youtube"><i class="icon-youtube"></i></a></li>';
                }
                $html .='<li><a class="cs-more addthis_button_compact" onclick="incrementValue()">&nbsp;<i class="icon-stumbleupon"></i></a></li>';
            }
            $html .='</ul></div>';
            $html .='</ul>';
        }
        echo balanceTags( $html, true );
    }

}

// End social share blog function 
/*
 * Start Single Share Blog function
 */
if ( ! function_exists( 'jobcareer_blog_single_share' ) ) {

    function jobcareer_blog_single_share( $post_social_sharing_text = '' ) {
        global $jobcareer_options;
        $html = '';
        $twitter = '';
        $facebook = '';
        $google_plus = '';
        $tumblr = '';
        $dribbble = '';
        $instagram = '';
        $share = '';
        $stumbleupon = '';
        $youtube = '';

        if ( isset( $jobcareer_options['cs_twitter_share'] ) ) {
            $twitter = $jobcareer_options['cs_twitter_share'];
        }

        if ( isset( $jobcareer_options['cs_facebook_share'] ) ) {
            $facebook = $jobcareer_options['cs_facebook_share'];
        }
        if ( isset( $jobcareer_options['cs_google_plus_share'] ) ) {
            $google_plus = $jobcareer_options['cs_google_plus_share'];
        }
        if ( isset( $jobcareer_options['cs_tumblr_share'] ) ) {
            $tumblr = $jobcareer_options['cs_tumblr_share'];
        }
        if ( isset( $jobcareer_options['cs_dribbble_share'] ) ) {
            $dribbble = $jobcareer_options['cs_dribbble_share'];
        }
        if ( isset( $jobcareer_options['cs_instagram_share'] ) ) {
            $instagram = $jobcareer_options['cs_instagram_share'];
        }
        if ( isset( $jobcareer_options['cs_share_share'] ) ) {
            $share = $jobcareer_options['cs_share_share'];
        }
        if ( isset( $jobcareer_options['cs_stumbleupon_share'] ) ) {
            $stumbleupon = $jobcareer_options['cs_stumbleupon_share'];
        }
        if ( isset( $jobcareer_options['cs_youtube_share'] ) ) {
            $youtube = $jobcareer_options['cs_youtube_share'];
        }


        jobcareer_addthis_script_init_method();
        $html = '';
        $path = get_template_directory_uri() . "/backend/assets/images/";
        if ( $twitter == 'on' or $facebook == 'on' or $google_plus == 'on' or $tumblr == 'on' or $dribbble == 'on' or $instagram == 'on' or $share == 'on' or $stumbleupon == 'on' or $youtube == 'on' ) {
            $html = '';
            if ( isset( $facebook ) && $facebook == 'on' ) {
                $html .='<li><a class="addthis_button_facebook a2a_counter" onclick="incrementValue()" data-original-title="Facebook"><i class="icon-facebook7"></i></a></li>';
            }
            if ( isset( $twitter ) && $twitter == 'on' ) {
                $html .='<li><a  onclick="incrementValue()" class="addthis_button_twitter" data-original-title="twitter"><i class="icon-twitter6"></i></a></li>';
            }
            if ( isset( $google_plus ) && $google_plus == 'on' ) {
                $html .='<li><a onclick="incrementValue()" class="addthis_button_google" data-original-title="google-plus"><i class="icon-googleplus7"></i></a></li>';
            }
            if ( isset( $tumblr ) && $tumblr == 'on' ) {
                $html .='<li><a onclick="incrementValue()" class="addthis_button_tumblr" onclick="incrementValue()" data-original-title="Tumblr"><i class="icon-tumblr5"></i></a></li>';
            }
            if ( isset( $dribbble ) && $dribbble == 'on' ) {
                $html .='<li><a onclick="incrementValue()" class="addthis_button_dribbble" data-original-title="Dribbble"><i class="icon-dribbble8"></i></a></li>';
            }
            if ( isset( $instagram ) && $instagram == 'on' ) {
                $html .='<li><a onclick="incrementValue()" class="addthis_button_instagram" data-original-title="Instagram"><i class="icon-instagram4"></i></a></li>';
            }
            if ( isset( $stumbleupon ) && $stumbleupon == 'on' ) {
                $html .='<li><a onclick="incrementValue()" class="addthis_button_stumbleupon" data-original-title="stumbleupon"><i class="icon-stumbleupon4"></i></a></li>';
            }
            if ( isset( $youtube ) && $youtube == 'on' ) {
                $html .='<li><a onclick="incrementValue()" class="addthis_button_youtube" data-original-title="Youtube"><i class="icon-youtube"></i></a></li>';
            }
            if ( isset( $share ) && $share == 'on' ) {
                $html .= '<li><a onclick="incrementValue()" class="cs-more addthis_button_compact at300m"></a></li>';
            }
            $html .= '</ul>';
        }
        echo balanceTags( $html, true );
    }

}

// End single share share

/*
 * Start function for social network theme options 
 */
if ( ! function_exists( 'jobcareer_social_network' ) ) {

    function jobcareer_social_network( $icon_type = '', $tooltip = '' ) {
        global $jobcareer_options;
        $tooltip_data = '';
        if ( $icon_type == 'large' ) {
            $icon = 'icon-2x';
        } else {

            $icon = '';
        }
        if ( isset( $tooltip ) && $tooltip <> '' ) {
            $tooltip_data = 'data-placement-tooltip="tooltip"';
        }
        if ( isset( $jobcareer_options['social_net_url'] ) and count( $jobcareer_options['social_net_url'] ) > 0 ) {
            $i = 0;
            foreach ( $jobcareer_options['social_net_url'] as $val ) {

                if ( $val != '' ) {
                    ?> 
                    <li>
                        <a style="color:<?php echo jobcareer_special_char( $jobcareer_options['social_font_awesome_color'][$i] ); ?>;" href="<?php echo esc_url( $val ); ?>" title="<?php echo jobcareer_special_char( $jobcareer_options['social_net_tooltip'][$i] ); ?>" data-toggle="tooltip" data-placement="bottom" target="_blank">
                            <?php if ( $jobcareer_options['social_net_awesome'][$i] <> '' && isset( $jobcareer_options['social_net_awesome'][$i] ) ) { ?>
                                <i class=" <?php echo esc_attr( $jobcareer_options['social_net_awesome'][$i] ); ?> <?php echo esc_attr( $icon ); ?>"></i>
                                <?php
                                if ( $tooltip == 'yes' ) {
                                    echo esc_attr( $jobcareer_options['social_net_tooltip'][$i] );
                                }
                                ?>
                            <?php } else { ?>
                                <img src="<?php echo esc_url( $jobcareer_options['social_net_icon_path'][$i] ); ?>" alt="<?php echo esc_attr( $jobcareer_options['social_net_tooltip'][$i] ); ?>" />
                            <?php } ?>
                        </a>
                    </li>
                    <?php
                }
                $i ++;
            }
        }
    }

}

// End function for social network theme options 
/*
 * Start function for Social network Footer
 */

if ( ! function_exists( 'jobcareer_social_network_footer' ) ) {

    function jobcareer_social_network_footer( $icon_type = '', $tooltip = '' ) {
        global $jobcareer_options;
        $tooltip_data = '';
        if ( $icon_type == 'large' ) {
            $icon = 'icon-2x';
        } else {

            $icon = '';
        }
        if ( isset( $tooltip ) && $tooltip <> '' ) {
            $tooltip_data = 'data-placement-tooltip="tooltip"';
        }
        if ( isset( $jobcareer_options['social_net_url'] ) and count( $jobcareer_options['social_net_url'] ) > 0 ) {
            $i = 0;
            foreach ( $jobcareer_options['social_net_url'] as $val ) {

                if ( $val != '' ) {
                    ?> 
                    <li>
                        <a title="" href="<?php echo esc_url( $val ); ?>" data-original-title="<?php echo jobcareer_special_char( $jobcareer_options['social_net_tooltip'][$i] ); ?>" data-placement="top" <?php echo balanceTags( $tooltip_data, false ); ?>  class=""  target="_blank">
                            <?php if ( $jobcareer_options['social_net_awesome'][$i] <> '' && isset( $jobcareer_options['social_net_awesome'][$i] ) ) { ?>
                                <i style="color:<?php echo jobcareer_special_char( $jobcareer_options['social_font_awesome_color'][$i] ); ?>;"  class="fa <?php echo esc_attr( $jobcareer_options['social_net_awesome'][$i] ); ?> <?php echo esc_attr( $icon ); ?>"></i>
                                <?php
                                if ( $tooltip == 'yes' ) {
                                    echo esc_attr( $jobcareer_options['social_net_tooltip'][$i] );
                                }
                                ?>
                            <?php } else { ?>
                                <img src="<?php echo esc_url( $jobcareer_options['social_net_icon_path'][$i] ); ?>" alt="<?php echo esc_attr( $jobcareer_options['social_net_tooltip'][$i] ); ?>" />
                            <?php } ?>
                        </a>
                    </li>
                    <?php
                }
                $i ++;
            }
        }
    }

}

// End function for Footer Social network 

/*
 * Start function for social network links
 */
if ( ! function_exists( 'jobcareer_social_network_widget' ) ) {

    function jobcareer_social_network_widget( $icon_type = '', $tooltip = '' ) {
        global $cs_theme_option;

        $tooltip_data = '';
        if ( $icon_type == 'large' ) {
            $icon = 'icon-2x';
        } else {

            $icon = '';
        }
        if ( isset( $tooltip ) && $tooltip <> '' ) {
            $tooltip_data = 'data-placement-tooltip="tooltip"';
        }
        if ( isset( $cs_theme_option['social_net_url'] ) and count( $cs_theme_option['social_net_url'] ) > 0 ) {
            $i = 0;
            foreach ( $cs_theme_option['social_net_url'] as $val ) {
                ?>
                <?php if ( $val != '' ) { ?>
                    <a class="cs-colrhvr" title="" href="<?php echo esc_url( $val ); ?>" data-original-title="<?php echo esc_attr( $cs_theme_option['social_net_tooltip'][$i] ); ?>" data-placement="top" <?php echo balanceTags( $tooltip_data, false ); ?> target="_blank">
                        <?php if ( $cs_theme_option['social_net_awesome'][$i] <> '' && isset( $cs_theme_option['social_net_awesome'][$i] ) ) { ?> 

                            <i class="fa <?php echo esc_attr( $cs_theme_option['social_net_awesome'][$i] ); ?>"></i>
                        <?php } else { ?><img src="<?php echo esc_url( $cs_theme_option['social_net_icon_path'][$i] ); ?>" alt="<?php echo esc_attr( $cs_theme_option['social_net_tooltip'][$i] ); ?>" /><?php } ?>
                    </a>
                    <?php
                }

                $i ++;
            }
        }
    }

}

// end function for social network links

/**
 * Facebook cache clear.
 */
if ( ! function_exists( 'cs_facebook_cache_clear' ) ) {

    function cs_facebook_cache_clear() {
        global $post;

        if ( is_singular( 'jobs' ) ) {
            ?>
            <script>
                var $ = jQuery;
                $.post(
                        "https://graph.facebook.com",
                        {
                            id: "<?php echo get_permalink() ?>",
                            scrape: true
                        },
                        function (response) {
                            console.log(response);
                        }
                );
                var fbxhr = new XMLHttpRequest();
                fbxhr.open("POST", "https://graph.facebook.com", true);
                fbxhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                fbxhr.send("id=<?php echo get_permalink() ?>&scrape=true");
            </script>
            <?php
        }
    }

}
/**
 * Start function for Add TinyMCE to multiple Textareas (usually in backend).
 */
if ( ! function_exists( 'jobcareer_wp_editor' ) ) {

    function jobcareer_wp_editor( $id = '' ) {
        ?>
        <script type="text/javascript">
            "use strict";
            var fullId = "<?php echo jobcareer_special_char( $id ); ?>";
            /* tinymce.execCommand('mceAddEditor', false, fullId);
             use wordpress settings*/
            tinymce.init({
                selector: fullId,
                theme: "modern",
                skin: "lightgray",
                language: "en",
                selector:"#" + fullId,
                        resize: "vertical",
                menubar: false,
                wpautop: true,
                indent: false,
                quicktags: "em,strong,link",
                toolbar1: "bold,italic,strikethrough,bullist,numlist,blockslider,hr,alignleft,aligncenter,alignright,link,unlink",
                /* toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",*/
                tabfocus_elements: ":prev,:next",
                body_class: "id post-type-post post-status-publish post-format-standard",
            });
            /*  quicktags({id : fullId});*/
            settings = {
                id: fullId,
                /*  buttons: 'strong,em,link' */
            }
            quicktags(settings);
            /* init tinymce*/
        </script><?php
    }

}
add_action( 'wp_ajax_cs_select_editor', 'jobcareer_wp_editor' );

// End TinyMce To multiple textareas
/*
 * Submit Form
 */
add_action( 'wp_ajax_nopriv_jobcareer_contact_form_submit', 'jobcareer_contact_form_submit' );
add_action( 'wp_ajax_jobcareer_contact_form_submit', 'jobcareer_contact_form_submit' );

/*
 * Start function for Get attachment id from url
 */
if ( ! function_exists( 'jobcareer_get_attachment_id_from_url' ) ) {

    function jobcareer_get_attachment_id_from_url( $attachment_url = '' ) {
        global $wpdb;
        $attachment_id = false;
        /*  If there is no url, return. */
        if ( '' == $attachment_url )
            return;
        /* Get the upload directory paths */
        $upload_dir_paths = wp_upload_dir();
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
            /*  If this is the URL of an auto-generated thumbnail, get the URL of the original image */
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
            /* Remove the upload path base directory from the attachment URL */
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
        }
        return $attachment_id;
    }

}



/*
 * start function for Custom Files types allowed
 */
add_filter( 'upload_mimes', 'jobcareer_upload_mimes' );
if ( ! function_exists( 'jobcareer_upload_mimes' ) ) {

    function jobcareer_upload_mimes( $existing_mimes = array() ) {
        /* add the file extension to the array */
        $existing_mimes['woff'] = 'mime/type';
        $existing_mimes['ttf'] = 'mime/type';
        $existing_mimes['svg'] = 'mime/type';
        $existing_mimes['eot'] = 'mime/type';
        return $existing_mimes;
    }

}

// End function for Custom Files types allowed

/*
 * Start function for Contact form submit ajax
 */
if ( ! function_exists( 'jobcareer_contact_form_submit' ) ) {

    function jobcareer_contact_form_submit() {
        define( 'WP_USE_THEMES', false );
        $subject = '';
        $cs_contact_error_msg = '';
        $subject_name = 'Subject';
        foreach ( $_REQUEST as $keys => $values ) {
            $$keys = $values;
        }

        if ( isset( $phone ) && $phone <> '' ) {
            $subject_name = 'Phone';
            $subject = $phone;
        }
        $bloginfo = get_bloginfo();
        $subjecteemail = "(" . $bloginfo . ") Contact Form Received";
        $message = '
            <table width="100%" border="1">
              <tr>
                <td width="100"><strong>' . esc_html__( 'Name:', 'jobcareer' ) . '</strong></td>
                <td>' . $contact_name . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'Email:', 'jobcareer' ) . '</strong></td>
                <td>' . $contact_email . '</td>
              </tr>
              <tr>
                <td><strong>' . $subject_name . ':</strong></td>
                <td>' . $subject . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'Message:', 'jobcareer' ) . '</strong></td>
                <td>' . $contact_msg . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'IP Address:', 'jobcareer' ) . '</strong></td>
                <td>' . $_SERVER["REMOTE_ADDR"] . '</td>
              </tr>
            </table>';

        $headers = "From: " . $contact_name . "\r\n";
        $headers .= "Reply-To: " . $contact_email . "\r\n";
        $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $attachments = '';
        if ( mail( $cs_contact_email, sanitize_email( $contact_email ), $message, $headers, '' ) ) {
            $json = array();
            $json['type'] = "success";
            $json['message'] = '<p>' . jobcareer_textarea_filter( $cs_contact_succ_msg ) . '</p>';
        } else {
            $json['type'] = "error";
            $json['message'] = '<p>' . jobcareer_textarea_filter( $cs_contact_error_msg ) . '</p>';
        };
        echo json_encode( $json );

        die();
    }

}
add_action( 'wp_ajax_nopriv_jobcareer_slider_form_submit', 'jobcareer_slider_form_submit' );
add_action( 'wp_ajax_jobcareer_slider_form_submit', 'jobcareer_slider_form_submit' );

// End function for Contact form submit ajax

/*
 * Start function Quote Form Submit 
 */
if ( ! function_exists( 'jobcareer_slider_form_submit' ) ) {

    function jobcareer_slider_form_submit() {
        define( 'WP_USE_THEMES', false );

        $cs_slider_error_msg = '';
        foreach ( $_REQUEST as $keys => $values ) {
            $$keys = $values;
        }

        $bloginfo = get_bloginfo();
        $subjecteEmail = "(" . $bloginfo . ") Quote Form Received";
        $message = '
            <table width="100%" border="1">
              <tr>
                <td width="100"><strong>' . esc_html__( 'Name:', 'jobcareer' ) . '</strong></td>
                <td>' . $slider_name . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'Email:', 'jobcareer' ) . '</strong></td>
                <td>' . $slider_mail . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'Mobile Number:', 'jobcareer' ) . '</strong></td>
                <td>' . $slider_number . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'Message:', 'jobcareer' ) . '</strong></td>
                <td>' . $slider_message . '</td>
              </tr>
              <tr>
                <td><strong>' . esc_html__( 'IP Address:', 'jobcareer' ) . '</strong></td>
                <td>' . $_SERVER["REMOTE_ADDR"] . '</td>
              </tr>
            </table>';
        $headers = '';
        if ( (isset( $slider_name ) && $slider_name !== '') && (isset( $slider_mail ) && $slider_mail !== '') ) {
            $headers = 'From: ' . $slider_name . ' <' . $slider_mail . '>' . "\r\n";
            // $headers .= "Reply-To: " . $slider_mail . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
        }
        $attachments = '';
        //  $headers = 'From: '.$slider_name.' <'.$slider_mail.'>' . "\r\n";//exit;
        if ( wp_mail( sanitize_email( $cs_slider_email ), ($subjecteEmail ), $message, $headers, $attachments ) ) {
            $json = array();
            $json['type'] = "success";
            $json['message'] = '<p>' . jobcareer_textarea_filter( $cs_slider_succ_msg ) . '</p>';
        } else {
            $json['type'] = "error";
            $json['message'] = '<p>' . jobcareer_textarea_filter( $cs_slider_error_msg ) . '</p>';
        };

        echo json_encode( $json );
        die();
    }

}


// End function Quote Form Submit 

/* Start function for RevSlider Extend Class 
 */
if ( class_exists( 'RevSlider' ) ) {

    class jobcareer_revSlider extends RevSlider {
        /*
         * Get sliders alias, Title, ID
         */

        public function getAllSliderAliases() {
            $where = "";
            $response = $this->db->fetch( GlobalsRevSlider::$table_sliders, $where, "id" );
            $arrAliases = array();
            $slider_array = array();
            foreach ( $response as $arrSlider ) {
                $arrAliases['id'] = $arrSlider["id"];
                $arrAliases['title'] = $arrSlider["title"];
                $arrAliases['alias'] = $arrSlider["alias"];
                $slider_array[] = $arrAliases;
            }
            return($slider_array);
        }

    }

}

// End function for RevSlider Extend Class 
/*
 * Start function for Custom Widget Title
 */

if ( ! function_exists( 'jobcareer_custom_widget_title' ) ) {

    function jobcareer_custom_widget_title( $title ) {
        $title = $title;
        return $title;
    }

    add_filter( 'widget_title', 'jobcareer_custom_widget_title' );
}
// End function for Custom widget title

/*
 * Start function for count Banner Clicks
 */
if ( ! function_exists( 'jobcareer_banner_count_plus' ) ) {

    function jobcareer_banner_count_plus() {
        $code_id = $_POST['code_id'];
        $cs_banner_click_count = get_option( "cs_banner_clicks_" . $code_id );
        $cs_banner_click_count = $cs_banner_click_count <> '' ? $cs_banner_click_count : 0;
        if ( ! isset( $_COOKIE["cs_banner_clicks_" . $code_id] ) ) {
            setcookie( "cs_banner_clicks_" . $code_id, 'true', time() + 86400, '/' );
            update_option( "cs_banner_clicks_" . $code_id, $cs_banner_click_count + 1 );
        }
        die( 0 );
    }

    add_action( 'wp_ajax_jobcareer_banner_count_plus', 'jobcareer_banner_count_plus' );
    add_action( 'wp_ajax_nopriv_jobcareer_banner_count_plus', 'jobcareer_banner_count_plus' );
}

if ( ! function_exists( 'jobcareer_change_query_vars' ) ) {

    function jobcareer_change_query_vars( $query ) {
        if ( ! is_admin() ) {
            if ( is_search() || is_home() || is_archive() ) {
                if ( empty( $_GET['page_id_all'] ) ) {
                    $_GET['page_id_all'] = 1;
                }
                $query->query_vars['paged'] = $_GET['page_id_all'];
                return $query;
            }
        }
    }

    add_filter( 'pre_get_posts', 'jobcareer_change_query_vars' );
}

// End function count banner clicks
/*
 * start function for custom pagination
 */
if ( ! function_exists( 'jobcareer_pagination' ) ) {

    function jobcareer_pagination( $total_records, $per_page, $qrystr = '', $show_pagination = 'Show Pagination', $page_var = 'page_id_all' ) {
        if ( $show_pagination <> 'Show Pagination' ) {
            return;
        } else if ( $total_records < $per_page ) {
            return;
        } else {

            $html = '';
            $dot_pre = '';

            $dot_more = '';

            $total_page = 0;
            if ( $per_page <> 0 )
                $total_page = ceil( $total_records / $per_page );
            $page_id_all = 0;
            if ( isset( $_GET[$page_var] ) && $_GET[$page_var] != '' ) {
                $page_id_all = $_GET[$page_var];
            }

            $loop_start = $page_id_all - 2;

            $loop_end = $page_id_all + 2;

            if ( $page_id_all < 3 ) {

                $loop_start = 1;

                if ( $total_page < 5 )
                    $loop_end = $total_page;
                else
                    $loop_end = 5;
            }

            else if ( $page_id_all >= $total_page - 1 ) {

                if ( $total_page < 5 )
                    $loop_start = 1;
                else
                    $loop_start = $total_page - 4;

                $loop_end = $total_page;
            }

            $html .= "<nav><ul class='pagination'>";
            if ( $page_id_all > 1 ) {
                $html .= "<li class='pgprev'><a href='?page_id_all=" . ($page_id_all - 1) . "$qrystr'  class='icon'>
				" . esc_html__( 'Previous', 'jobcareer' ) . " </a></li>";
            } else {
                $html .= "<li class='pgprev cs-inactive'><a class='icon'>" . esc_html__( 'Previous', 'jobcareer' ) . "</a></li>";
            }

            if ( $page_id_all > 3 and $total_page > 5 )
                $html .= "<li><a href='?page_id_all=1$qrystr'>1</a></li>";

            if ( $page_id_all > 4 and $total_page > 6 )
                $html .= "<li> <a>. . .</a> </li>";

            if ( $total_page > 1 ) {

                for ( $i = $loop_start; $i <= $loop_end; $i ++ ) {

                    if ( $i <> $page_id_all )
                        $html .= "<li><a href='?page_id_all=$i$qrystr'>" . $i . "</a></li>";
                    else
                        $html .= "<li><a class='active'>" . $i . "</a></li>";
                }
            }

            if ( $loop_end <> $total_page and $loop_end <> $total_page - 1 ) {
                $html .= "<li> <a>. . .</a> </li>";
            }

            if ( $loop_end <> $total_page ) {
                $html .= "<li><a href='?page_id_all={$total_page}{$qrystr}'>$total_page</a></li>";
            }
            if ( $per_page > 0 and $page_id_all < ($total_records / $per_page) ) {

                $html .= "<li class='pgnext'><a class='icon' href='?page_id_all=" . ($page_id_all + 1) . "$qrystr' >" . esc_html__( 'Next', 'jobcareer' ) . "</a></li>";
            } else {
                $html .= "<li class='pgnext cs-inactive'><a class='icon'>" . esc_html__( 'Next', 'jobcareer' ) . " </a></li>";
            }
            $html .= "</ul></nav>";
            return $html;
        }
    }

}

// End function for custom pagination


/*
 * Start function for Single files paths
 */
if ( ! function_exists( 'jobcareer_get_post_type_template' ) ) {

    function jobcareer_get_post_type_template( $single_template ) {

        global $post;

        $single_path = get_template_directory();

        return $single_template;
    }

    add_filter( 'single_template', 'jobcareer_get_post_type_template' );
}
// End function for Single files paths
/*
 * Start function for Post image attachment function
 */
if ( ! function_exists( 'jobcareer_attachment_image_src' ) ) {

    function jobcareer_attachment_image_src( $attachment_id, $width, $height ) {
        $image_url = wp_get_attachment_image_src( $attachment_id, array( $width, $height ), true );
        if ( $image_url[1] == $width and $image_url[2] == $height )
            ;
        else
            $image_url = wp_get_attachment_image_src( $attachment_id, "full", true );
        $parts = explode( '/uploads/', $image_url[0] );
        if ( count( $parts ) > 1 )
            return $image_url[0];
    }

}
// End post image attachment function
/*
 * Post image attachment source function Post image attachment source function
 */
if ( ! function_exists( 'jobcareer_get_post_img_src' ) ) {

    function jobcareer_get_post_img_src( $post_id, $width, $height ) {
        global $post;
        if ( has_post_thumbnail() ) {
            $image_id = get_post_thumbnail_id( $post_id );
            $image_url = wp_get_attachment_image_src( $image_id, array( $width, $height ), true );
            if ( $image_url[1] == $width and $image_url[2] == $height ) {
                return $image_url[0];
            } else {
                $image_url = wp_get_attachment_image_src( $image_id, "full", true );
                return $image_url[0];
            }
        }
    }

}

// End post images attachment 

/*
 * Start Post image attachment source function
 */
if ( ! function_exists( 'jobcareer_get_post_img_title' ) ) {

    function jobcareer_get_post_img_title( $post_id ) {
        global $post;
        if ( has_post_thumbnail() ) {
            $image_id = get_post_thumbnail_id( $post_id );
            $image_title = get_the_title( $image_id );
            if ( isset( $image_title ) and $image_title <> '' ) {
                return $image_title;
            } else {
                return '';
            }
        }
    }

}
// End Post image attachment source function
/*
 * Start function for Get Post image attachment
 */
if ( ! function_exists( 'jobcareer_get_post_img' ) ) {

    function jobcareer_get_post_img( $post_id, $width, $height ) {
        $image_id = get_post_thumbnail_id( $post_id );
        $image_url = wp_get_attachment_image_src( $image_id, array( $width, $height ), true );
        if ( $image_url[1] == $width and $image_url[2] == $height ) {
            return get_the_post_thumbnail( $post_id, array( $width, $height ) );
        } else {
            return get_the_post_thumbnail( $post_id, "full" );
        }
    }

}

// End function for Get Post image attachment

/*
 * Start function for background image/color
 */


if ( ! function_exists( 'jobcareer_bg_image' ) ) {

    function jobcareer_bg_image() {

        global $jobcareer_options;
        $result_return = '';
        $cs_custom_image = '';
        $cs_coustom_bg_color = '';

        if ( is_array( $jobcareer_options ) ) {
            $cs_custom_bg_image = isset( $jobcareer_options['cs_custom_bgimage'] ) ? $jobcareer_options['cs_custom_bgimage'] : '';
            $jobcareer_bg_image = isset( $jobcareer_options['jobcareer_bg_image'] ) ? $jobcareer_options['jobcareer_bg_image'] : '';
            $jobcareer_bg_image_val = isset( $jobcareer_options['jobcareer_bg_image'] ) ? $jobcareer_options['jobcareer_bg_image'] : '';
            $get_first_two_chr = substr( $jobcareer_bg_image_val, 0, 2 );
            $cs_bg_color = isset( $jobcareer_options['cs_bg_color'] ) ? $jobcareer_options['cs_bg_color'] : '';

            if ( isset( $cs_custom_bg_image ) && $cs_custom_bg_image <> "" ) { // custom image
                $cs_custom_bg_image = 'style="background:transparent url(' . $cs_custom_bg_image . ')  ' . $jobcareer_options['cs_bgimage_position'] . ' !important;';
                return $result_return = $cs_custom_bg_image;
            } else {

                if ( isset( $get_first_two_chr ) && $get_first_two_chr == 'bg' && $jobcareer_bg_image <> 'bg0' && $jobcareer_bg_image <> "" ) { // bg image
                    $jobcareer_bg_image = get_template_directory_uri() . "/backend/assets/images/background/" . $jobcareer_options['jobcareer_bg_image'] . ".png";
                    return $result_return = 'style="background:transparent url(' . $jobcareer_bg_image . ')  ' . $jobcareer_options['cs_bgimage_position'] . ' !important;';
                } else {
                    $get_first_two_chr = substr( $jobcareer_bg_image_val, 0, 7 );
                    if ( isset( $get_first_two_chr ) && $get_first_two_chr == 'pattern' && $jobcareer_bg_image <> 'pattern0' && $jobcareer_bg_image <> "" ) { // pattern
                        $jobcareer_bg_image = get_template_directory_uri() . "/backend/assets/images/background/" . $jobcareer_options['jobcareer_bg_image'] . ".png";
                        return $result_return = 'style="background:transparent url(' . $jobcareer_bg_image . ') !important; ' . $jobcareer_options['cs_bgimage_position'] . ' !important;';
                    } else {
                        if ( isset( $cs_bg_color ) && $cs_bg_color <> "" ) {
                            return $result_return = 'style="background:' . $cs_bg_color . ' !important"';
                        }
                    }
                }
            }
        }
    }

}

// End function for background image/color
/*
 * Start functon for Main wrapper class function
 */
if ( ! function_exists( 'jobcareer_wrapper_class' ) ) {

    function jobcareer_wrapper_class() {
        global $jobcareer_options;

        if ( isset( $_POST['cs_layout'] ) ) {

            $_SESSION['lmssess_layout_option'] = $_POST['cs_layout'];
            echo jobcareer_special_char( $_SESSION['lmssess_layout_option'] );
        } elseif ( isset( $_SESSION['lmssess_layout_option'] ) and ! empty( $_SESSION['lmssess_layout_option'] ) ) {
            echo jobcareer_special_char( $_SESSION['lmssess_layout_option'] );
        } else {
            if ( isset( $jobcareer_options['cs_layout'] ) ) {
                echo jobcareer_special_char( $jobcareer_options['cs_layout'] );
            }
            $_SESSION['lmssess_layout_option'] = '';
        }
    }

}

// End function for Main wrapper class function 
/*
 * start function for custom sidebar
 */

$cs_theme_sidebar = $jobcareer_options = get_option( 'cs_theme_options' );

$cs_footer_style = isset( $jobcareer_options['cs_footer_style'] ) ? $jobcareer_options['cs_footer_style'] : '';
if ( isset( $cs_theme_sidebar['sidebar'] ) and ! empty( $cs_theme_sidebar['sidebar'] ) ) {
    foreach ( $cs_theme_sidebar['sidebar'] as $sidebar ) {
        $sidebar_id = strtolower( str_replace( ' ', '_', $sidebar ) );

        $cs_widget_start = '<div class="widget %2$s">';
        $cs_widget_end = '</div>';
        if ( isset( $jobcareer_options['cs_footer_widget_sidebar'] ) && $jobcareer_options['cs_footer_widget_sidebar'] == $sidebar ) {

            $cs_widget_start = '<aside class="widget col-lg-4 col-md-4 col-sm-6 col-xs-12 %2$s">';
            $cs_widget_end = '</aside>';
        }
        register_sidebar( array(
            'name' => $sidebar,
            'id' => $sidebar_id,
            'description' => esc_html__( 'This widget will be displayed on right/left side of the page.', 'jobcareer' ),
            'before_widget' => $cs_widget_start,
            'after_widget' => $cs_widget_end,
            'before_title' => '<div class="widget-title"><h5>',
            'after_title' => '</h5></div>'
        ) );
    }
}


// End function for custom sidebar 




/*
 * start function for custom sidebar
 */
$cs_theme_footer_sidebar = $jobcareer_options = get_option( 'cs_theme_options' );

$cs_footer_style = isset( $jobcareer_options['cs_footer_style'] ) ? $jobcareer_options['cs_footer_style'] : '';
$sidebar_name = '';
if ( isset( $cs_theme_footer_sidebar['footer_sidebar'] ) and ! empty( $cs_theme_footer_sidebar['footer_sidebar'] ) ) {
    $i = 0;
    foreach ( $cs_theme_footer_sidebar['footer_sidebar'] as $footer_sidebar ) {

        $footer_sidebar_id = strtolower( str_replace( ' ', '-', $footer_sidebar ) );

        $sidebar_name = $cs_theme_footer_sidebar['footer_width'];
        $customwidth = str_replace( '(', ' - ', $sidebar_name[$i] );
        $cs_widget_start = '<div class="widget %2$s">';
        $cs_widget_end = '</div>';

        if ( isset( $jobcareer_options['cs_footer_widget_footer_sidebar'] ) && $jobcareer_options['cs_footer_widget_footer_sidebar'] == $footer_sidebar ) {

            $cs_widget_start = '<aside class="widget col-lg-4 col-md-4 col-sm-6 col-xs-12 %2$s">';
            $cs_widget_end = '</aside>';
        }
        register_sidebar( array(
            'name' => esc_html__( 'Footer ', 'jobcareer' ) . $footer_sidebar . '  ' . '(' . $customwidth . ' ',
            'id' => $footer_sidebar_id,
            'description' => esc_html__( 'This widget will be displayed on right/left side of the page.', 'jobcareer' ),
            'before_widget' => $cs_widget_start,
            'after_widget' => $cs_widget_end,
            'before_title' => '<div class="widget-title"><h5>',
            'after_title' => '</h5></div>'
        ) );
        $i ++;
    }
}


// End function for custom sidebar 




/*
 * start function for theme option custom sidebar end primary widget
 */
register_sidebar( array(
    'name' => esc_html__( 'Primary Sidebar', 'jobcareer' ),
    'id' => 'sidebar-1',
    'description' => esc_html__( 'Main sidebar that appears on the right.', 'jobcareer' ),
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h5>',
    'after_title' => '</h5></div>'
) );


// Start function for get sidebar id
if ( ! function_exists( 'jobcareer_get_sidebar_id' ) ) :

    function jobcareer_get_sidebar_id( $sidebar ) {
        $sidebar_id = strtolower( str_replace( ' ', '_', $sidebar ) );
        return $sidebar_id;
    }

endif;
// End function for get sidebar id
// Start custom comment function for single detail page

if ( ! function_exists( 'jobcareer_comment' ) ) :

    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own jobcareer_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     */
    function jobcareer_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        $args['reply_text'] = esc_html__( 'Reply to Comment', 'jobcareer' );
        $args['before'] = '';
        switch ( $comment->comment_type ) :
            case '' :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <div class="thumblist" id="comment-<?php comment_ID(); ?>">
                        <ul>
                            <li>
                                <div class="thumblist">
                                    <figure><?php echo get_avatar( $comment, 80 ); ?></figure>
                                    <div class="cs-text">
                                        <div class="cs-author-info">
                                            <h5><?php comment_author(); ?></h5>
                                            <span><i class="icon-clock-o"></i> <?php comment_date( 'M d, Y  H:i a' ); ?></span>
                                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'reply_text' => __( 'Reply', 'jobcareer' ) ) ) ); ?>
                                        </div>

                                        <?php if ( $comment->comment_approved == '0' ) : ?>
                                            <p>
                                            <div class="comment-awaiting-moderation colr"><?php esc_html_e( 'Your comment is awaiting moderation.', 'jobcareer' ); ?></div></p><?php endif; ?>
                                        <?php comment_text(); ?>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <?php
                    break;
                case 'pingback' :
                case 'trackback' :
                    ?>
                <li class="post pingback">
                    <p><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'jobcareer' ), ' ' ); ?></p>
                    <?php
                    break;
            endswitch;
        }

    endif;

// End custom comment function for single detail page

    /*
     * Start function for breadcrumbs 
     */
    if ( ! function_exists( 'jobcareer_breadcrumbs' ) ) {

        function jobcareer_breadcrumbs() {
            global $wp_query, $jobcareer_options, $post;

            /* === OPTIONS === */
            $text['home'] = '<i class="icon-home"></i> ' . esc_html__( 'Home', 'jobcareer' ); /*  text for the 'Home' link */
            $text['category'] = '%s'; /*  text for a category page */
            $text['search'] = '%s'; /*   text for a search results page */
            $text['tag'] = '%s'; /*  text for a tag page */
            $text['author'] = '%s'; /*  text for an author page */
            $text['404'] = 'Error 404'; /*  text for the 404 page */

            $showCurrent = 1; /*  1 - show current post/page title in breadcrumbs, 0 - don't show */
            $showOnHome = 1; /*  1 - show breadcrumbs on the homepage, 0 - don't show */
            $delimiter = ''; /*  delimiter between crumbs */
            $before = '<li class="active">'; /* tag before the current crumb */
            $after = '</li>'; /*  tag after the current crumb */
            /* === END OF OPTIONS === */
            $current_page = esc_html__( 'Current Page', 'jobcareer' );
            $homeLink = home_url() . '/';
            $linkBefore = '<li>';
            $linkAfter = '</li>';
            $linkAttr = '';
            $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
            $linkhome = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

            if ( is_home() || is_front_page() ) {

                if ( $showOnHome == "1" )
                    echo '<ul class="breadcrumb-nav">' . $before . '<a href="' . esc_url( $homeLink ) . '">' . $text['home'] . '</a>' . $after . '</ul>';
            } else {
                echo '<ul class="breadcrumb-nav">' . sprintf( $linkhome, $homeLink, $text['home'] ) . $delimiter;
                if ( is_category() ) {
                    $thisCat = get_category( get_query_var( 'cat' ), false );
                    if ( $thisCat->parent != 0 ) {
                        $cats = get_category_parents( $thisCat->parent, TRUE, $delimiter );
                        $cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
                        $cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
                        echo esc_attr( $cats );
                    }
                    echo jobcareer_special_char( $before ) . sprintf( $text['category'], single_cat_title( '', false ) ) . jobcareer_special_char( $after );
                } elseif ( is_search() ) {

                    echo jobcareer_special_char( $before ) . sprintf( $text['search'], get_search_query() ) . $after;
                } elseif ( is_day() ) {

                    echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
                    echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
                    echo jobcareer_special_char( $before ) . get_the_time( 'd' ) . $after;
                } elseif ( is_month() ) {

                    echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
                    echo jobcareer_special_char( $before ) . get_the_time( 'F' ) . $after;
                } elseif ( is_year() ) {

                    echo jobcareer_special_char( $before ) . get_the_time( 'Y' ) . $after;
                } elseif ( is_single() && ! is_attachment() ) {

                    if ( function_exists( "is_shop" ) && get_post_type() == 'product' ) {

                        $cs_shop_page_id = woocommerce_get_page_id( 'shop' );
                        $current_page = get_the_title( get_the_id() );
                        $cs_shop_page = "<li class='cs-color'><a href='" . esc_url( get_permalink( $cs_shop_page_id ) ) . "'>" . get_the_title( $cs_shop_page_id ) . "</a></li>";
                        echo jobcareer_special_char( $cs_shop_page );
                        if ( $showCurrent == 1 )
                            echo jobcareer_special_char( $before ) . $current_page . $after;
                    }
                    else if ( get_post_type() != 'post' ) {
                        $post_type = get_post_type_object( get_post_type() );
                        $slug = $post_type->rewrite;
                        printf( $link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name );
                        if ( $showCurrent == 1 )
                            echo jobcareer_special_char( $delimiter ) . $before . $current_page . $after;
                    } else {

                        $cat = get_the_category();
                        $cat = $cat[0];
                        $cats = get_category_parents( $cat, TRUE, $delimiter );
                        if ( $showCurrent == 0 )
                            $cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
                        $cats = str_replace( '<a', $linkBefore . '<a' . $linkAttr, $cats );
                        $cats = str_replace( '</a>', '</a>' . $linkAfter, $cats );
                        echo jobcareer_special_char( $cats );

                        if ( $showCurrent == 1 )
                            echo jobcareer_special_char( $before ) . $current_page . $after;
                    }
                } elseif ( ! is_single() && ! is_page() && get_post_type() <> '' && get_post_type() != 'post' && ! is_404() ) {

                    $post_type = get_post_type_object( get_post_type() );
                    echo jobcareer_special_char( $before ) . $post_type->labels->singular_name . $after;
                } elseif ( isset( $wp_query->query_vars['taxonomy'] ) && ! empty( $wp_query->query_vars['taxonomy'] ) ) {

                    $taxonomy = $taxonomy_category = '';
                    $taxonomy = $wp_query->query_vars['taxonomy'];
                    echo jobcareer_special_char( $before ) . $wp_query->query_vars[$taxonomy] . $after;
                } elseif ( is_page() && ! $post->post_parent ) {

                    if ( $showCurrent == 1 )
                        echo jobcareer_special_char( $before ) . get_the_title() . $after;
                } elseif ( is_page() && $post->post_parent ) {

                    $parent_id = $post->post_parent;
                    $breadcrumbs = array();
                    while ( $parent_id ) {
                        $page = get_page( $parent_id );
                        $breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
                        echo jobcareer_special_char( $breadcrumbs[$i] );
                        if ( $i != count( $breadcrumbs ) - 1 ) {
                            echo jobcareer_special_char( $delimiter );
                        }
                    }
                    if ( $showCurrent == 1 ) {
                        echo jobcareer_special_char( $delimiter . $before . get_the_title() . $after );
                    }
                } elseif ( is_tag() ) {

                    echo jobcareer_special_char( $before ) . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                } elseif ( is_author() ) {

                    global $author;
                    $userdata = get_userdata( $author );
                    echo jobcareer_special_char( $before ) . sprintf( $text['author'], $userdata->display_name ) . $after;
                } elseif ( is_404() ) {
                    echo jobcareer_special_char( $before ) . $text['404'] . $after;
                }
                echo '</ul>';
            }
        }

    }

    // End Breadcrums functions here

    /**
     * @Start function for Footer Logo 
     *
     *
     */
    if ( ! function_exists( 'jobcareer_footer_logo' ) ) {

        function jobcareer_footer_logo() {
            global $jobcareer_options;
            $logo = isset( $jobcareer_options['jobcareer_footer_logo'] ) ? $jobcareer_options['jobcareer_footer_logo'] : '';
            $cs_tripadvisor_logo_link = $jobcareer_options['cs_tripadvisor_logo_link'];

            if ( $logo == '' && ! get_option( 'cs_theme_options' ) ) {
                $logo = trailingslashit( get_template_directory_uri() ) . 'assets/images/footer-logo.png';
            }

            if ( $logo <> '' ) {
                echo '<span class="footer-logo"> <a href="' . esc_url( $cs_tripadvisor_logo_link ) . '" target="_blank"><img src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '"/></a></span>';
            }
        }

    }
    // Footer logo end here
    /**
     * @Start function for Categories Postcount Filter 
     */
    if ( ! function_exists( 'jobcareer_cat_postcount_filter' ) ) {

        function jobcareer_cat_postcount_filter( $variable ) {
            $variable = str_replace( '(', '<span class="post_count">(', $variable );
            $variable = str_replace( ')', ')</span>', $variable );
            return $variable;
        }

        add_filter( 'wp_list_categories', 'jobcareer_cat_postcount_filter' );
    }
    // End function for Categories postcount Filter

    /**
     * @Start function for Archives Postcount Filter
     *
     *
     */
    if ( ! function_exists( 'jobcareer_archives_postcount_filter' ) ) {

        function jobcareer_archives_postcount_filter( $variable ) {
            $variable = str_replace( '(', '<span class="post_count">(', $variable );
            $variable = str_replace( ')', ')</span>', $variable );
            return $variable;
        }

        add_filter( 'get_archives_link', 'jobcareer_pages_postcount_filter' );
    }

    //End function Archives post count filter

    /**
     * @Start function for Pages Postcount Filter
     *
     *
     */
    if ( ! function_exists( 'jobcareer_pages_postcount_filter' ) ) {

        function jobcareer_pages_postcount_filter( $variable ) {
            $variable = str_replace( '(', '<span class="post_count">(', $variable );
            $variable = str_replace( ')', ')</span>', $variable );
            return $variable;
        }

    }

    // End function for Pages Postcount Filter 


    /*
     * Start function for Include File
     *
     *
     */
    function jobcareer_include_file( $file_path = '' ) {
        if ( $file_path != '' ) {
            require_once $file_path;
        }
    }

// End function for Include File

    /*
     * Start wp formating issue in chrome browser
     */

    if ( ! function_exists( 'jobcareer_chromefix_inline_css' ) ) {

        function jobcareer_chromefix_inline_css() {
            wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' );
        }

        add_action( 'admin_enqueue_scripts', 'jobcareer_chromefix_inline_css' );
    }

// End wp formating issue in chrome browser
// End File path functions 
// Start stylesheet content function 
    if ( ! function_exists( 'jobcareer_write_stylesheet_content' ) ) {

        function jobcareer_write_stylesheet_content() {
            global $wp_filesystem;
            require_once trailingslashit( get_template_directory() ) . 'backend/theme_styles.php';
            $cs_export_options = jobcareer_custom_style_theme_options();
            // remove comment from complete file
            $fileStr = $cs_export_options;
            $regex = array(
                "`^([\t\s]+)`ism" => '',
                "`^\/\*(.+?)\*\/`ism" => "",
                "`([\n\A;]+)\/\*(.+?)\*\/`ism" => "$1",
                "`([\n\A;\s]+)//(.+?)[\n\r]`ism" => "$1\n",
                "`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n"
            );
            $newStr = preg_replace( array_keys( $regex ), $regex, $fileStr );
            //$newStr = jobcareer_style_minify($newStr);
            $cs_option_fields = $newStr;

            $backup_url = wp_nonce_url( 'themes.php?page=jobcareer_theme_options_constructor' );
            if ( false === ($creds = request_filesystem_credentials( $backup_url, '', false, false, array() ) ) ) {
                return true;
            }
            if ( ! WP_Filesystem( $creds ) ) {
                request_filesystem_credentials( $backup_url, '', true, false, array() );
                return true;
            }
            $cs_upload_dir = trailingslashit( get_template_directory() ) . 'assets/css/';
            $cs_filename = trailingslashit( $cs_upload_dir ) . 'custom-style.css';
            if ( ! $wp_filesystem->put_contents( $cs_filename, $cs_option_fields, FS_CHMOD_FILE ) ) {
                
            }
        }

    }

// End stylesheet content function 
// Start style minify function 
    if ( ! function_exists( 'jobcareer_style_minify' ) ) {

        function jobcareer_style_minify( $css ) {
            // Normalize whitespace
            $css = preg_replace( '/\s+/', ' ', $css );

            // Remove spaces before and after comment
            $css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
            // Remove comment blocks, everything between /* and */, unless
            // preserved with /*! ... */ or /** ... */
            $css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
            // Remove ; before }
            $css = preg_replace( '/;(?=\s*})/', '', $css );
            // Remove space after , : ; { } */ >
            $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
            // Remove space before , ; { } ( ) >
            $css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
            // Strips leading 0 on decimal values (converts 0.5px into .5px)
            $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
            // Strips units if value is 0 (converts 0px to 0)
            $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
            // Converts all zeros value into short-hand
            $css = preg_replace( '/0 0 0 0/', '0', $css );
            // Shortern 6-character hex color codes to 3-character where possible
            $css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );
            return trim( $css );
        }

    }

// End style minify function 

    if ( ! get_option( 'cs_theme_options' ) ) {
        $jobcareer_activation_data = jobcareer_theme_default_options();
        $jobcareer_options = $jobcareer_activation_data;
        $jobcareer_options['cs_default_layout_sidebar'] = 'sidebar-1';
        $jobcareer_options['cs_single_layout_sidebar'] = 'sidebar-1';
        $jobcareer_options['cs_footer_widget'] = 'off';
    }
    if ( ! function_exists( 'jobcareer_inline_styles_method' ) ) {

        function jobcareer_inline_styles_method() {
            global $jobcareer_options;

            if ( isset( $jobcareer_options['cs_custom_css'] ) and $jobcareer_options['cs_custom_css'] <> '' ) {
                $custom_css = $jobcareer_options['cs_custom_css'];
                $custom_css = str_replace( array( '&gt;' ), '>', $custom_css );
                wp_enqueue_style( 'jobcareer-custom-style-inline', get_template_directory_uri() . '/assets/css/custom-inline-style.css', '', '' );
                wp_add_inline_style( 'jobcareer-custom-style-inline', $custom_css );
            }
        }

    }
    /*
      array column function for old php versions
     */
    if ( ! function_exists( 'array_column' ) ) {

        /**
         * Returns the values from a single column of the input array, identified by
         * the $columnKey.
         *
         * Optionally, you may provide an $indexKey to index the values in the returned
         * array by the values from the $indexKey column in the input array.
         *
         * @param array $input A multi-dimensional array (record set) from which to pull
         *                     a column of values.
         * @param mixed $columnKey The column of values to return. This value may be the
         *                         integer key of the column you wish to retrieve, or it
         *                         may be the string key name for an associative array.
         * @param mixed $indexKey (Optional.) The column to use as the index/keys for
         *                        the returned array. This value may be the integer key
         *                        of the column, or it may be the string key name.
         * @return array
         */
        function array_column( $input = null, $columnKey = null, $indexKey = null ) {
            // Using func_get_args() in order to check for proper number of
            // parameters and trigger errors exactly as the built-in array_column()
            // does in PHP 5.5.
            $argc = func_num_args();
            $params = func_get_args();
            if ( $argc < 2 ) {
                trigger_error( "array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING );
                return null;
            }
            if ( ! is_array( $params[0] ) ) {
                trigger_error(
                        'array_column() expects parameter 1 to be array, ' . gettype( $params[0] ) . ' given', E_USER_WARNING
                );
                return null;
            }
            if ( ! is_int( $params[1] ) && ! is_float( $params[1] ) && ! is_string( $params[1] ) && $params[1] !== null && ! (is_object( $params[1] ) && method_exists( $params[1], '__toString' ))
            ) {
                trigger_error( 'array_column(): The column key should be either a string or an integer', E_USER_WARNING );
                return false;
            }
            if ( isset( $params[2] ) && ! is_int( $params[2] ) && ! is_float( $params[2] ) && ! is_string( $params[2] ) && ! (is_object( $params[2] ) && method_exists( $params[2], '__toString' ))
            ) {
                trigger_error( 'array_column(): The index key should be either a string or an integer', E_USER_WARNING );
                return false;
            }
            $paramsInput = $params[0];
            $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
            $paramsIndexKey = null;
            if ( isset( $params[2] ) ) {
                if ( is_float( $params[2] ) || is_int( $params[2] ) ) {
                    $paramsIndexKey = (int) $params[2];
                } else {
                    $paramsIndexKey = (string) $params[2];
                }
            }
            $resultArray = array();
            foreach ( $paramsInput as $row ) {
                $key = $value = null;
                $keySet = $valueSet = false;
                if ( $paramsIndexKey !== null && array_key_exists( $paramsIndexKey, $row ) ) {
                    $keySet = true;
                    $key = (string) $row[$paramsIndexKey];
                }
                if ( $paramsColumnKey === null ) {
                    $valueSet = true;
                    $value = $row;
                } elseif ( is_array( $row ) && array_key_exists( $paramsColumnKey, $row ) ) {
                    $valueSet = true;
                    $value = $row[$paramsColumnKey];
                }
                if ( $valueSet ) {
                    if ( $keySet ) {
                        $resultArray[$key] = $value;
                    } else {
                        $resultArray[] = $value;
                    }
                }
            }
            return $resultArray;
        }

    }
