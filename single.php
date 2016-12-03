<?php
/**
 * The template for displaying single post
 */
$var_arrays = array('post', 'cs_blog_cat');
$single_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($single_global_vars);
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
if (isset($jobcareer_options['cs_excerpt_length']) && $jobcareer_options['cs_excerpt_length'] <> '') {
    $default_excerpt_length = $jobcareer_options['cs_excerpt_length'];
} else {
    $default_excerpt_length = '20';
}
$cs_uniq = rand(11111111, 99999999);
$cs_postObject = get_post_meta($post->ID, 'cs_full_data', true);
$cs_gallery_ids = get_post_meta($post->ID, 'cs_post_list_gallery', true);
$cs_gallery_slider_ids = get_post_meta($post->ID, 'cs_post_detail_gallery', true);
$cs_gallery = explode(',', $cs_gallery_ids);
$cs_gallery_slider = explode(',', $cs_gallery_slider_ids);
get_header();
$cs_postid = get_the_id();
$cs_layout = '';
$leftSidebarFlag = false;
$rightSidebarFlag = false;
$cs_layout = get_post_meta($post->ID, 'cs_page_layout', true);
$cs_sidebar_left = get_post_meta($post->ID, 'cs_page_sidebar_left', true);
$cs_sidebar_right = get_post_meta($post->ID, 'cs_page_sidebar_right', true);
$post_tags_show = get_post_meta($post->ID, 'cs_post_tags_show', true);
$cs_post_social_sharing = get_post_meta($post->ID, 'cs_post_social_sharing', true);
$post_pagination_show = get_post_meta($post->ID, 'cs_post_pagination_show', true);
$inside_post_view = get_post_meta($post->ID, 'cs_detail_view', true);
$post_audio = get_post_meta($post->ID, 'cs_post_detail_audio', true);
$post_video = get_post_meta($post->ID, 'cs_post_detail_video', true);
$cs_single_view = get_post_meta($post->ID, 'cs_single_view', true);
$cs_related_post = get_post_meta($cs_postid, 'cs_cs_related_post', true);
$cs_related_blog_post = get_post_meta($cs_postid, 'cs_related_blog_post', true);

$cs_default_sidebar = false;
if ($cs_layout == '') {
    $cs_default_sidebar = true;
}

if ($cs_layout == "left") {
    $cs_layout = "page-content";
    $leftSidebarFlag = true;
    $custom_height = 300;
} else if ($cs_layout == "right") {
    $cs_layout = "page-content";
    $rightSidebarFlag = true;
    $custom_height = 300;
} else {
    $cs_layout = "page-content-fullwidth";
    $custom_height = 408;
}
if (!isset($cs_layout)) {
    $cs_layout = isset($jobcareer_options['cs_single_post_layout']) ? $jobcareer_options['cs_single_post_layout'] : '';
    if (isset($cs_layout) && $cs_layout == "sidebar_left") {
        $cs_layout = "page-content";
        $cs_sidebar_left = $jobcareer_options['cs_single_layout_sidebar'];
        $leftSidebarFlag = true;
        $custom_height = 300;
    } else if (isset($cs_layout) && $cs_layout == "sidebar_right") {
        $cs_layout = "page-content";
        $cs_sidebar_right = $jobcareer_options['cs_single_layout_sidebar'];
        $rightSidebarFlag = true;
        $custom_height = 300;
    }
}
$width = 870;
$height = 446;
$image_url = jobcareer_get_post_img_src($post->ID, $width, $height);
$cs_section_bg = $image_url <> '' ? esc_url($image_url) : '';
$cs_iframe = '<' . 'iframe ';
$current_post_id = $post->ID;
// col classes for post content area
$main_content_col_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';

if ($rightSidebarFlag == true || $leftSidebarFlag == true) {
    $main_content_col_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
} else if ($cs_default_sidebar == true && is_active_sidebar('sidebar-1')) {
    $main_content_col_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
}
?> 
<div class="main-section">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <div class="container"> 
                <div class="row">
                    <?php if ($leftSidebarFlag == true) { ?>
                        <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <?php
                            if (is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar_left))) {
                                if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : endif;
                            }
                            ?>
                        </aside>
                        <?php
                    }
                    ?>
                    <div class="blog-detail <?php echo $main_content_col_class; ?>">
                        <div class="cs-blog-detail">
                            <?php
                            if (isset($inside_post_view) and $inside_post_view <> '') {
                                if ($inside_post_view == "slider") {
                                    echo '<div class="cs-main-post"><figure>';
                                    jobcareer_post_slick_detail($width, $height, get_the_id(), 'post');
                                    echo '</figure></div>';
                                } else if ($inside_post_view == "single" && $image_url <> '') {
                                    echo '<div class="cs-main-post"><figure>';
                                    echo '<img src="' . esc_url($image_url) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '" >';
                                    echo '</figure></div>';
                                } else if ($inside_post_view == "video" and $post_video <> '' and $inside_post_view <> '') {
                                    $url = parse_url($post_video);
                                    if ($url['host'] == $_SERVER["SERVER_NAME"]) {
                                        echo '<div class="cs-main-post"><figure>';
                                        echo do_shortcode('[video width="' . $width . '" height="' . $height . '" src="' . esc_url($post_video) . '"][/video]');
                                        echo '</figure></div>';
                                    } else {
                                        if ($url['host'] == 'vimeo.com') {
                                            $content_exp = explode("/", $post_video);
                                            $content_vimo = array_pop($content_exp);
                                            echo '<div class="cs-main-post"><figure>' . $cs_iframe . ' width="' . $width . '" height="' . $height . '" src="' . cs_server_protocol() . 'player.vimeo.com/video/' . $content_vimo . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></figure></div>';
                                        } elseif ($url['host'] == 'soundcloud.com') {
                                            $video = wp_oembed_get($post_video, array('height' => $custom_height));
                                            $search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="0"');
                                            echo '<div class="cs-main-post"><figure>';
                                            echo str_replace($search, '', $video);
                                            echo '</figure></div>';
                                        } else {
                                            echo '<div class="cs-main-post"><figure>';
                                            $content = str_replace(array('watch?v=', '' . cs_server_protocol() . 'www.dailymotion.com/'), array('embed/', '//www.dailymotion.com/embed/'), $post_video);
                                            echo jobcareer_special_char($cs_frame) . ' width="' . $width . '" height="' . $height . '" src="' . esc_url($content) . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                                            echo '</figure></div>';
                                        }
                                    }
                                } elseif ($inside_post_view == "audio" and $inside_post_view <> '') {
                                    echo '<div class="cs-main-post"><figure>';
                                    echo do_shortcode('[audio mp3="' . $post_audio . '"][/audio]');
                                    echo '</figure></div>';
                                } elseif ($inside_post_view <> '' and $inside_post_view == 'slider') {
                                    jobcareer_post_slick_slider($width, $height, get_the_id(), 'post-list');
                                }
                            }
                            ?>
                            <div class="cs-post-title">
                                <div class="cs-author">
                                    <figure>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 32); ?></a>
                                    </figure>

                                    <div class="cs-text">
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                    </div>
                                </div>
                                <div class="post-option">
                                    <span class="post-category"><i class="icon-list-ul"></i><?php the_category(', '); ?></span>
                                    <span class="post-date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><i class="cs-color icon-calendar6"></i><?php echo date('M j, Y', strtotime(get_the_date())); ?></a></span>
                                    <span class="post-comment"><a href="<?php the_permalink(); ?>#comments"><i class="cs-color icon-chat6"></i><?php echo comments_number('0 ', esc_html__('1 Comment', 'jobcareer'), esc_html__('% Comments', 'jobcareer')); ?></a></span>
                                </div>
                            </div>
                            <div class="cs-post-option-panel">
                                <div class="rich-editor-text">
                                    <?php
                                    the_content();
                                    wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'jobcareer') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                                    ?>
                                </div>
                            </div>
                           <div class="cs-tags">
                                <?php
                                if ($post_tags_show) {
                                    $cs_tags_list = get_the_term_list(get_the_id(), 'post_tag', '<li>', ',</li><li>', '</li>');
                                    if ($cs_tags_list) {
                                        ?>
                                        <div class="tags">
                                            <span><?php esc_html_e('Tags', 'jobcareer'); ?></span>
                                            <ul>
                                                <?php
                                                $cs_tags = str_replace(',', '', $cs_tags_list);
                                                printf('%1$s', $cs_tags);
                                                ?>
                                            </ul>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>  
                            <?php if(isset($cs_post_social_sharing) && $cs_post_social_sharing <> '') { ?>    
                                <div class="cs-share-detail">
                                    <div class="cs-social-share">
                                        <ul class="cs-social-media">
                                            <?php
                                            echo jobcareer_blog_single_share(0);
                                            ?>      
                                        </ul>
                                        <span class="cs-share"><a href="#"> <?php esc_html_e('Share This', 'jobcareer'); ?></a></span>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            <?php

                            if (isset($cs_related_post) && $cs_related_post == 'on') {
                                $categories = get_the_category();
                                $cat_arr = array();
                                foreach ($categories as $category) {
                                    $cat_arr[] = $category->term_id;
                                }
                                if (!empty($cat_arr)) {
                                    $cs_blog_excerpt = $default_excerpt_length;
                                    $width = '236';
                                    $height = '168';
                                    $exclude_ids = $exclude_ids = array($current_post_id);
                                    $args_value = array('post__not_in' => $exclude_ids, 'category__in' => $cat_arr, 'post_type' => 'post', 'posts_per_page' => -1, 'orderby' => 'post_date', 'order' => 'DESC');
                                    ?>
                                    <div class="blog-list">
                                        <h2><?php esc_html_e("Related Blogs", 'jobcareer'); ?></h2>
                                        <?php
                                        $query = new WP_Query($args_value);
                                        $post_count = $query->post_count;
                                        if ($query->have_posts()) {
                                            $postCounter = 0;
                                            ?>
                                            <script type='text/javascript'>
                                                jQuery(document).ready(function () {
                                                    'use strict';
                                                    jQuery('.blog-slide').slick({
                                                        slidesToShow: 3,
                                                        slidesToScroll: 1,
                                                        autoplay: true,
                                                        autoplaySpeed: 2000,
                                                        prevArrow: jQuery('.blog-slider-prev'),
                                                        nextArrow: jQuery('.blog-slider-next'),
                                                        responsive: [
                                                            {
                                                                breakpoint: 600,
                                                                settings: {
                                                                    slidesToShow: 1,
                                                                    slidesToScroll: 1
                                                                }
                                                            },
                                                            {
                                                                breakpoint: 480,
                                                                settings: {
                                                                    slidesToShow: 1,
                                                                    slidesToScroll: 1,
                                                                    dots: false
                                                                }
                                                            }
                                                        ]
                                                    });



                                                });
                                            </script>
                                            <div class="blog-slider-prev"><a href="javascript:void();" title="<?php echo esc_html__('Previous', 'jobcareer'); ?>"><i class="icon-arrow-left9"></i></a></div>
                                            <div class="blog-slider-next"><a  href="javascript:void();" title="<?php echo esc_html__('Next', 'jobcareer'); ?>"><i class="icon-arrow-right9"></i></a></div>
                                            <ul class="blog-list blog-slide blogs">
                                                <?php
                                                while ($query->have_posts()) : $query->the_post();
                                                    $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
                                                    $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
                                                    $cs_gallery = get_post_meta($post->ID, 'cs_post_list_gallery', true);
                                                    $cs_gallery = explode(',', $cs_gallery);
                                                    $cs_thumb_view = get_post_meta($post->ID, 'cs_thumb_view', true);
                                                    $cs_post_view = isset($cs_thumb_view) ? $cs_thumb_view : '';
                                                    $current_user = wp_get_current_user();
                                                    $custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
                                                    $tags = get_tags();
                                                    ?>
                                                    <li class="col-md-3">
                                                        <?php if (isset($thumbnail) and $thumbnail <> '' || $cs_post_view != "slider") { ?>
                                                            <figure class="effect-julia">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <img src="<?php echo esc_url($thumbnail); ?>" alt="" /></a></figure>
                                                            <?php
                                                        } elseif (isset($cs_post_view) and $cs_post_view == "slider") {
                                                            jobcareer_post_slick_slider($width, $height, get_the_id(), '');
                                                        }
                                                        ?>
                                                        <div class="cs-text"> 
                                                            <span><?php echo date('M j, Y', strtotime(get_the_date())); ?></span>
                                                            <h5><a href="<?php the_permalink(); ?>">
                                                                    <?php echo wp_trim_words(get_the_title(), 4); ?></a>
                                                            </h5>
                                                            <p> <?php echo jobcareer_get_excerpt($cs_blog_excerpt, 'true', ''); ?></p>
                                                            <div class="post-option">
                                                                <span class="post-comment"><a href="<?php the_permalink(); ?>#comments"><i class="icon-comment"></i><?php
                                                                        $num_comments = get_comments_number($post->ID); // get_comments_number returns only a numeric value
                                                                        echo absint($num_comments);
                                                                        ?></a></span>
                                                                <a href="<?php the_permalink(); ?>" class="readmore cs-color"><?php esc_html_e('Read More', 'jobcareer'); ?></a> 
                                                            </div>

                                                        </div>
                                                    </li>

                                                    <?php
                                                endwhile;
                                                ?>
                                            </ul><?php
                                        } else {
                                            $cs_notification->error(esc_html__('No blog post found.', 'jobcareer'));
                                        }
                                        /* Restore original Post Data */
                                        wp_reset_postdata();
                                        ?>      
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div id="comment" class="comment-form">
                                <?php
                                if ('open' == $post->comment_status) {
                                    comments_template('', true);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($rightSidebarFlag == true) {
                        ?>
                        <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <?php
                            if (is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar_right))) {

                                if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : endif;
                            }
                            ?>
                        </aside>
                        <?php
                    } else if ($cs_default_sidebar == true && is_active_sidebar('sidebar-1')) {
                        echo '<div class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">';
                        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1')) : endif;
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <?php
        endwhile;
    endif;
    ?>
</div>
<?php
get_footer();
