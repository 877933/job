<?php
/**
 * The template for 
 * displaying shop page
 */
get_header();
global $post, $jobcareer_node, $jobcareer_sidebarLayout, $column_class, $jobcareer_xmlObject, $jobcareer_node_id, $column_attributes, $jobcareer_elem_id;
if ( is_shop() ) {

    $jobcareer_shop_id = woocommerce_get_page_id( 'shop' );

    $jobcareer_page_bulider = get_post_meta( $jobcareer_shop_id, "jobcareer_page_builder", true );

    $jobcareer_xmlObject = new stdClass();
    if ( isset( $jobcareer_page_bulider ) && $jobcareer_page_bulider <> '' ) {
        $jobcareer_xmlObject = new SimpleXMLElement( $jobcareer_page_bulider );
    }
    ?>
    <!-- Main Content Section -->
    <div class="main-section">
        <?php
        $jobcareer_page_sidebar_right = '';
        $jobcareer_page_sidebar_left = '';
        $jobcareer_postObject = get_post_meta( $jobcareer_shop_id, 'cs_full_data', true );
        $jobcareer_page_layout = get_post_meta( $jobcareer_shop_id, 'cs_page_layout', true );
        $jobcareer_page_sidebar_right = get_post_meta( $jobcareer_shop_id, 'cs_page_sidebar_right', true );
        $jobcareer_page_sidebar_left = get_post_meta( $jobcareer_shop_id, 'cs_page_sidebar_left', true );
        $jobcareer_page_bulider = get_post_meta( $jobcareer_shop_id, "jobcareer_page_builder", true );
        $section_container_width = '';
        $page_element_size = 'page-content-fullwidth';

        if ( ! isset( $jobcareer_page_layout ) || $jobcareer_page_layout == "none" ) {
            $page_element_size = 'page-content-fullwidth';
        } else {
            $page_element_size = 'page-content col-lg-9 col-md-9 col-sm-12 col-xs-12';
        }
        $jobcareer_xmlObject = new stdClass();

        if ( isset( $jobcareer_page_bulider ) && $jobcareer_page_bulider <> '' ) {
            $jobcareer_xmlObject = new SimpleXMLElement( $jobcareer_page_bulider );
        }
        if ( isset( $jobcareer_page_layout ) ) {
            $jobcareer_sidebarLayout = $jobcareer_page_layout;
        }
        $pageSidebar = false;
        if ( $jobcareer_sidebarLayout == 'left' || $jobcareer_sidebarLayout == 'right' ) {
            $pageSidebar = true;
        }

        if ( isset( $jobcareer_xmlObject ) && count( $jobcareer_xmlObject ) > 1 ) {
            if ( isset( $jobcareer_page_layout ) ) {
                $jobcareer_page_sidebar_right = $jobcareer_page_sidebar_right;
                $jobcareer_page_sidebar_left = $jobcareer_page_sidebar_left;
            }
            $jobcareer_counter_node = $column_no = 0;
            $fullwith_style = '';
            $section_container_style_elements = ' ';
            if ( isset( $jobcareer_page_layout ) && $jobcareer_sidebarLayout <> '' and $jobcareer_sidebarLayout <> "none" ) {

                $fullwith_style = 'style="width:100%;"';
                $section_container_style_elements = ' width: 100%;';
                echo '<div class="container">';
                echo '<div class="row">';


                if ( isset( $jobcareer_page_layout ) && $jobcareer_sidebarLayout <> '' and $jobcareer_sidebarLayout <> "none" and $jobcareer_sidebarLayout == 'left' ) :
                    if ( is_active_sidebar( jobcareer_get_sidebar_id( $jobcareer_page_sidebar_left ) ) ) {
                        ?>
                        <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $jobcareer_page_sidebar_left ) ) : endif; ?>
                        </aside>
                        <?php
                    }
                endif;
                echo '<div class="' . ($page_element_size) . '">';
            }

            if ( post_password_required() ) {
                echo '<header class="heading"><h6 class="transform">' . get_the_title( $jobcareer_shop_id ) . '</h6></header>';
                echo jobcareer_password_form();
            } else {
                $width = 840;
                $height = 328;
                $jobcareer_post_thumbnail_id = get_post_thumbnail_id( $jobcareer_shop_id );
                $image_url = jobcareer_attachment_image_src( $jobcareer_post_thumbnail_id, $width, $height );
                wp_reset_postdata();
                if ( $pageSidebar != true ) {
                    ?>
                    <div class="page-section">
                        <div class="container">
                            <div class="row">
                                <?php
                            }
                            if ( isset( $image_url ) && $image_url != '' ) {
                                ?>
                                <a href="<?php echo esc_url( $image_url ); ?>" data-rel="prettyPhoto" data-title="">
                                    <figure>
                                        <div class="page-featured-image">
                                            <img class="img-thumbnail cs-page-thumbnail" title="" alt="" data-src="" src="<?php echo esc_url( $image_url ); ?>">
                                        </div>
                                    </figure>
                                </a>
                                <?php
                            }
                            $content_post = get_post( $jobcareer_shop_id );
                            if ( is_object( $content_post ) ) {
                                $content = $content_post->post_content;

                                if ( trim( $content ) <> '' ) {
                                    echo '<div class="cs-shop-wrap"><div class="cs-rich-editor">';
                                    $content = apply_filters( 'the_content', $content );
                                    $content = str_replace( ']]>', ']]&gt;', $content );
                                    echo do_shortcode( $content );
                                    echo '</div></div>';
                                }
                            }
                            if ( $pageSidebar != true ) {
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                get_template_part( 'woocommerce/products-loop', 'page' );
            }

            if ( isset( $jobcareer_xmlObject->column_container ) ) {
                $jobcareer_elem_id = 0;
            }
            foreach ( $jobcareer_xmlObject->column_container as $column_container ) {

                $jobcareer_section_bg_image = $cs_section_title = $cs_section_subtitle = $jobcareer_section_bg_image_position = $jobcareer_section_bg_image_repeat = $jobcareer_section_bg_color = $jobcareer_section_padding_top = $jobcareer_section_padding_bottom = $jobcareer_section_custom_style = $jobcareer_section_css_id = $jobcareer_layout = $jobcareer_sidebar_left = $jobcareer_sidebar_right = $css_bg_image = '';
                $section_style_elements = '';
                $section_container_style_elements = '';
                $section_video_element = '';
                $jobcareer_section_bg_color = '';
                $jobcareer_section_view = 'container';
                if ( isset( $column_container ) ) {
                    $column_attributes = $column_container->attributes();
                    $column_class = $column_attributes->class;
                    $parallax_class = '';
                    $parallax_data_type = '';
                    $jobcareer_section_parallax = $column_attributes->jobcareer_section_parallax;
                    if ( isset( $jobcareer_section_parallax ) && (string) $jobcareer_section_parallax == 'yes' ) {
                        $parallax_class = ($jobcareer_section_parallax == 'yes') ? 'parallex-bg' : '';
                        $parallax_data_type = ' data-type="background"';
                    }
                    $cs_section_title = $column_attributes->cs_section_title;
                    $cs_section_subtitle = $column_attributes->cs_section_subtitle;
                    $jobcareer_section_margin_top = $column_attributes->jobcareer_section_margin_top;
                    $jobcareer_section_margin_bottom = $column_attributes->jobcareer_section_margin_bottom;
                    $jobcareer_section_padding_top = $column_attributes->jobcareer_section_padding_top;
                    $jobcareer_section_padding_bottom = $column_attributes->jobcareer_section_padding_bottom;
                    $jobcareer_section_view = $column_attributes->jobcareer_section_view;
                    $jobcareer_section_border_color = $column_attributes->jobcareer_section_border_color;
                    if ( isset( $jobcareer_section_border_color ) && $jobcareer_section_border_color != '' ) {
                        $section_style_elements .= '';
                    }
                    if ( isset( $jobcareer_section_margin_top ) && $jobcareer_section_margin_top != '' ) {
                        $section_style_elements .= 'margin-top: ' . $jobcareer_section_margin_top . 'px;';
                    }
                    if ( isset( $jobcareer_section_padding_top ) && $jobcareer_section_padding_top != '' ) {
                        $section_style_elements .= 'padding-top: ' . $jobcareer_section_padding_top . 'px;';
                    }
                    if ( isset( $jobcareer_section_padding_bottom ) && $jobcareer_section_padding_bottom != '' ) {
                        $section_style_elements .= 'padding-bottom: ' . $jobcareer_section_padding_bottom . 'px;';
                    }
                    if ( isset( $jobcareer_section_margin_bottom ) && $jobcareer_section_margin_bottom != '' ) {
                        $section_style_elements .= 'margin-bottom: ' . $jobcareer_section_margin_bottom . 'px;';
                    }
                    $jobcareer_section_border_top = $column_attributes->jobcareer_section_border_top;
                    $jobcareer_section_border_bottom = $column_attributes->jobcareer_section_border_bottom;
                    if ( isset( $jobcareer_section_border_top ) && $jobcareer_section_border_top != '' ) {
                        $section_style_elements .= 'border-top: ' . $jobcareer_section_border_top . 'px ' . $jobcareer_section_border_color . ' solid;';
                    }
                    if ( isset( $jobcareer_section_border_bottom ) && $jobcareer_section_border_bottom != '' ) {
                        $section_style_elements .= 'border-bottom: ' . $jobcareer_section_border_bottom . 'px ' . $jobcareer_section_border_color . ' solid;';
                    }
                    $jobcareer_section_background_option = $column_attributes->jobcareer_section_background_option;
                    $jobcareer_section_bg_image_position = $column_attributes->jobcareer_section_bg_image_position;
                    if ( isset( $column_attributes->jobcareer_section_bg_color ) )
                        $jobcareer_section_bg_color = $column_attributes->jobcareer_section_bg_color;
                    if ( isset( $jobcareer_section_background_option ) && $jobcareer_section_background_option == 'section-custom-background-image' ) {
                        $jobcareer_section_bg_image = $column_attributes->jobcareer_section_bg_image;
                        $jobcareer_section_bg_image_position = $column_attributes->jobcareer_section_bg_image_position;
                        $jobcareer_section_bg_imageg = '';
                        if ( isset( $jobcareer_section_bg_image ) && $jobcareer_section_bg_image != '' ) {
                            if ( isset( $jobcareer_section_parallax ) && (string) $jobcareer_section_parallax == 'yes' ) {
                                $jobcareer_section_bg_imageg = 'url(' . $jobcareer_section_bg_image . ') ' . $jobcareer_section_bg_image_position . ' ' . ' fixed';
                            } else {
                                $jobcareer_section_bg_imageg = 'url(' . $jobcareer_section_bg_image . ') ' . $jobcareer_section_bg_image_position . ' ';
                            }
                        }
                        $section_style_elements .= 'background: ' . $jobcareer_section_bg_imageg . ' ' . $jobcareer_section_bg_color . ';';
                    } else if ( isset( $jobcareer_section_background_option ) && $jobcareer_section_background_option == 'section_background_video' ) {
                        $jobcareer_section_video_url = $column_attributes->jobcareer_section_video_url;
                        $jobcareer_section_video_mute = $column_attributes->jobcareer_section_video_mute;
                        $jobcareer_section_video_autoplay = $column_attributes->jobcareer_section_video_autoplay;
                        $mute_flag = $mute_control = '';
                        $mute_flag = 'true';
                        if ( $jobcareer_section_video_mute == 'yes' ) {
                            $mute_flag = 'false';
                            $mute_control = 'controls muted ';
                        }
                        $jobcareer_video_autoplay = 'autoplay';
                        if ( $jobcareer_section_video_autoplay == 'yes' ) {
                            $jobcareer_video_autoplay = 'autoplay';
                        } else {
                            $jobcareer_video_autoplay = '';
                        }
                        $section_video_class = 'video-parallex';
                        $url = parse_url( $jobcareer_section_video_url );
                        if ( $url['host'] == $_SERVER["SERVER_NAME"] ) {
                            $file_type = wp_check_filetype( $jobcareer_section_video_url );
                            if ( isset( $file_type['type'] ) && $file_type['type'] <> '' ) {
                                $file_type = $file_type['type'];
                            } else {
                                $file_type = 'video/mp4';
                            }
                            $rand_player_id = rand( 6, 555 );
                            $section_video_element = '<div class="page-section-video cs-section-video">
                                        <video id="player' . $rand_player_id . '" width="100%" height="100%" ' . $jobcareer_video_autoplay . ' loop="true" preload="none" volume="false" controls="controls" class="nectar-video-bg   cs-video-element"  ' . $mute_control . ' >
                                            <source src="' . esc_url( $jobcareer_section_video_url ) . '" type="' . $file_type . '">
                                        </video>
                                    </div>';
                        } else {
                            $section_video_element = wp_oembed_get( $jobcareer_section_video_url, array( 'height' => '1083' ) );
                        }
                    } else {
                        if ( isset( $jobcareer_section_bg_color ) && $jobcareer_section_bg_color != '' ) {
                            $section_style_elements .= 'background: ' . esc_attr( $jobcareer_section_bg_color ) . ';';
                        }
                    }
                    $jobcareer_section_padding_top = $column_attributes->jobcareer_section_padding_top;
                    $jobcareer_section_padding_bottom = $column_attributes->jobcareer_section_padding_bottom;
                    if ( isset( $jobcareer_section_padding_top ) && $jobcareer_section_padding_top != '' ) {
                        $section_container_style_elements .= 'padding-top: ' . $jobcareer_section_padding_top . 'px; ';
                    }
                    if ( isset( $jobcareer_section_padding_bottom ) && $jobcareer_section_padding_bottom != '' ) {
                        $section_container_style_elements .= 'padding-bottom: ' . $jobcareer_section_padding_bottom . 'px; ';
                    }
                    $jobcareer_section_custom_style = $column_attributes->jobcareer_section_custom_style;
                    $jobcareer_section_css_id = $column_attributes->jobcareer_section_css_id;
                    if ( isset( $jobcareer_section_css_id ) && trim( $jobcareer_section_css_id ) != '' ) {
                        $jobcareer_section_css_id = 'id="' . $jobcareer_section_css_id . '"';
                    }

                    $page_element_size = 'section-fullwidth';
                    $jobcareer_layout = $column_attributes->jobcareer_layout;
                    if ( ! isset( $jobcareer_layout ) || $jobcareer_layout == '' || $jobcareer_layout == 'none' ) {
                        $jobcareer_layout = "none";
                        $page_element_size = 'section-fullwidth col-lg-12 col-md-12 col-sm-12 col-xs-12';
                    } else {
                        $page_element_size = 'section-content col-lg-9 col-md-9 col-sm-12 col-xs-12 ';
                    }
                    $jobcareer_sidebar_left = $column_attributes->jobcareer_sidebar_left;
                    $jobcareer_sidebar_right = $column_attributes->jobcareer_sidebar_right;
                }
                if ( isset( $jobcareer_section_bg_image ) && $jobcareer_section_bg_image <> '' && $jobcareer_section_background_option == 'section-custom-background-image' ) {
                    $css_bg_image = 'url(' . $jobcareer_section_bg_image . ')';
                }

                $section_style_element = '';
                if ( $section_style_elements ) {
                    $section_style_element = 'style="' . $section_style_elements . '"';
                }
                if ( $section_container_style_elements ) {
                    $section_container_style_elements = 'style="' . $section_container_style_elements . '"';
                }
                ?>
                <!-- Page Section -->
                <div <?php echo ($jobcareer_section_css_id); ?> class="page-section <?php echo sanitize_html_class( $parallax_class ); ?>" <?php echo ($parallax_data_type); ?>  <?php echo ($section_style_element); ?> >
                    <?php
                    echo ($section_video_element);
                    if ( isset( $jobcareer_section_background_option ) && $jobcareer_section_background_option == 'section-custom-slider' ) {
                        $jobcareer_section_custom_slider = $column_attributes->jobcareer_section_custom_slider;
                        if ( $jobcareer_section_custom_slider != '' ) {
                            echo do_shortcode( $jobcareer_section_custom_slider );
                        }
                    }
                    if ( $jobcareer_page_layout == '' || $jobcareer_page_layout == 'none' ) {
                        if ( $jobcareer_section_view == 'container' ) {
                            $jobcareer_section_view = 'container';
                        } else {
                            $jobcareer_section_view = 'wide';
                        }
                    } else {
                        $jobcareer_section_view = '';
                    }
                    ?>
                    <!-- Container Start -->
                    <div class="<?php echo sanitize_html_class( $jobcareer_section_view ); ?> "> 
                        <?php
                        if ( isset( $jobcareer_layout ) && ( $jobcareer_layout != '' || $jobcareer_layout != 'none' ) ) {
                            ?>
                            <div class="row">
                                <?php
                            }
                            // start page section
                            if ( $cs_section_title != '' || $cs_section_subtitle != '' ) {
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="cs-section-title" style="margin-bottom:27px;">
                                        <?php if ( $cs_section_title != '' ) { ?>
                                            <h2 style="font-size:24px !important; letter-spacing:1px !important; text-align:center; margin-bottom:20px;"><?php echo esc_html( $cs_section_title ) ?></h2>
                                        <?php } if ( $cs_section_subtitle != '' ) { ?>
                                            <span><?php echo esc_html( $cs_section_subtitle ) ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                            }// end page section
                            if ( isset( $jobcareer_layout ) && $jobcareer_layout == "left" && $jobcareer_sidebar_left <> '' ) {
                                echo '<aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">';
                                if ( is_active_sidebar( jobcareer_get_sidebar_id( $jobcareer_sidebar_left ) ) ) {
                                    if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $jobcareer_sidebar_left ) ) : endif;
                                }
                                echo '</aside>';
                            }
                            $jobcareer_node_id = 0;
                            echo '<div class="' . ($page_element_size) . ' ">';
                            echo '<div class="row">';

                            foreach ( $column_container->children() as $column ) {
                                $column_no ++;
                                $jobcareer_node_id ++;
                                foreach ( $column->children() as $jobcareer_node ) {

                                    $jobcareer_elem_id ++;
                                    $page_element_size = '100';
                                    if ( isset( $jobcareer_node->page_element_size ) )
                                        $page_element_size = $jobcareer_node->page_element_size;
                                    echo '<div class="' . cs_page_builder_element_sizes( $page_element_size ) . '">';
                                    $shortcode = trim( (string) $jobcareer_node->jobcareer_shortcode );
                                    $shortcode = html_entity_decode( $shortcode );
                                    echo do_shortcode( $shortcode );
                                    echo '</div>';
                                }
                            }
                            echo '</div></div>';
                            if ( isset( $jobcareer_layout ) && $jobcareer_layout == "right" && $jobcareer_sidebar_right <> '' ) {
                                echo '<aside class="section-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">';
                                if ( is_active_sidebar( jobcareer_get_sidebar_id( $jobcareer_sidebar_right ) ) ) {
                                    if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $jobcareer_sidebar_right ) ) : endif;
                                }
                                echo '</aside>';
                            }
                            if ( isset( $jobcareer_layout ) && ( $jobcareer_layout != '' || $jobcareer_layout != 'none' ) ) {
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                $column_no = 0;
            }
            if ( isset( $jobcareer_page_layout ) && $jobcareer_sidebarLayout <> '' && $jobcareer_sidebarLayout <> "none" ) {

                echo '</div>';
            }
            if ( isset( $jobcareer_page_layout ) && $jobcareer_sidebarLayout <> '' and $jobcareer_sidebarLayout <> "none" and $jobcareer_sidebarLayout == 'right' ) :
                if ( is_active_sidebar( jobcareer_get_sidebar_id( $jobcareer_page_sidebar_right ) ) ) {
                    ?>
                    <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $jobcareer_page_sidebar_right ) ) : endif; ?>
                    </aside>
                    <?php
                }
            endif;
            if ( isset( $jobcareer_page_layout ) && $jobcareer_sidebarLayout <> '' and $jobcareer_sidebarLayout <> "none" ) {
                echo '</div>';
                echo '</div>';
            }
        } else {
            ?>
            <div class="container">        
                <!-- Row Start -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php get_template_part( 'woocommerce/products-loop', 'page' ); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
get_footer();
