<?php
/**
 * The template for Home page 
 */
get_header();

$var_arrays = array('jobcareer_node', 'cs_blog_cat', 'cs_blog_description', 'cs_blog_excerpt', 'cs_counter_node');
$index_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($index_global_vars);
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();

if (isset($jobcareer_options['cs_excerpt_length']) && $jobcareer_options['cs_excerpt_length'] <> '') {
    $default_excerpt_length = $jobcareer_options['cs_excerpt_length'];
} else {
    $default_excerpt_length = '120';
}
$cs_layout = isset($jobcareer_options['cs_default_page_layout']) ? $jobcareer_options['cs_default_page_layout'] : '';

$cs_default_sidebar = false;
if ($cs_layout == '') {
    $cs_default_sidebar = true;
}
if (isset($cs_layout) && ($cs_layout == "sidebar_left" || $cs_layout == "sidebar_right")) {
    $cs_col_class = "col-md-9";
    $cs_page_layout = "page-content";
} else if ($cs_default_sidebar == true) {
    $cs_col_class = "col-md-9";
    $cs_page_layout = "page-content";
} else {
    $cs_col_class = "col-md-12";
    $cs_page_layout = "page-content-fullwidth";
}
$cs_sidebar = $jobcareer_options['cs_default_layout_sidebar'];
$cs_tags_name = 'post_tag';
$cs_categories_name = 'category';
$width = '270';
$height = '203';
?>
<div class="main-section">
    <section class="page-section cs-zero-padding">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">     
                <!--Left Sidebar Starts-->
                <?php if ($cs_layout == 'sidebar_left') { ?>
                    <div class="page-sidebar col-md-3">
                        <?php
                        if (is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar)) : endif;
                        }
                        ?>
                    </div>
                <?php } ?>
                <!--Left Sidebar End-->
                <!-- Page Detail Start -->
                <div class="<?php echo sanitize_html_class($cs_col_class); ?>">
                    <div class="cs-content-holder">
                        <div class="<?php echo sanitize_html_class($cs_page_layout); ?>">
                            <div class="cs-blog medium">
                                <?php
                                if (have_posts()) :
                                    if (empty($_GET['page_id_all'])) {
                                        $_GET['page_id_all'] = 1;
                                    }
                                    if (!isset($_GET["s"])) {
                                        $_GET["s"] = '';
                                    }
                                    while (have_posts()) : the_post();
                                        $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
//                                            if($thumbnail == '') {
//                                                $thumbnail = trailingslashit(get_template_directory_uri()) . 'assets/images/img-not-found16x9.jpg';
//                                            }
                                        $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
                                        $cs_gallery = get_post_meta($post->ID, 'cs_post_list_gallery', true);
                                        $cs_gallery = explode(',', $cs_gallery);
                                        $cs_thumb_view = get_post_meta($post->ID, 'cs_thumb_view', true);
                                        $cs_post_view = isset($cs_thumb_view) ? $cs_thumb_view : '';
                                        $current_user = wp_get_current_user();
                                        $custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
                                        $cs_post_like_counter = get_post_meta(get_the_id(), "cs_post_like_counter", true);
                                        $cs_blog_excerpt_theme_option = isset($jobcareer_options['cs_excerpt_length']) ? $jobcareer_options['cs_excerpt_length'] : '255';
                                        $tags = get_tags();
                                        ?>         
                                        <div id="post-<?php the_ID(); ?>" <?php post_class("cs-blog blog-medium"); ?>>
                                            <?php if ($thumbnail <> '' and $cs_thumb_view == 'slider') {
                                                ?>
                                                <div class="cs-media">
                                                    <div class="cs-media slider-medium">
                                                        <?php jobcareer_post_slick_slider($width, $height, get_the_id(), 'post-list'); ?>
                                                    </div>
                                                </div>

                                                <?php
                                            } else if ($thumbnail != '') {
                                                ?>
                                                <div class="cs-media">
                                                    <figure>
                                                        <a href="<?php the_permalink(); ?>"><img alt="" src="<?php echo esc_url($thumbnail); ?>"></a>
                                                    </figure>
                                                </div>
                                            <?php } ?>
                                            <div class="blog-text">
                                                <div class="cs-author">
                                                    <figure>
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 32); ?></a>
                                                    </figure>
                                                    <div class="cs-text">
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                                    </div>
                                                </div>
                                                <div class="post-option">
                                                    <span class="post-date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><i class="icon-calendar5"></i><?php echo date('M j, Y', strtotime(get_the_date())); ?></a></span>
                                                    <?php
                                                    $num_comments = get_comments_number($post->ID); // get_comments_number returns only a numeric value
                                                    ?><span class="post-comment"><a href="<?php the_permalink(); ?>#comments"><i class="icon-comments-o"></i><?php
                                                            echo absint($num_comments) . " ";
                                                            if ($num_comments > 1) {
                                                                echo esc_html__('comments', 'jobcareer');
                                                            } else {
                                                                echo esc_html__('comment', 'jobcareer');
                                                            }
                                                            ?></a></span>
                                                </div>
                                                <div class="cs-post-title">
                                                    <h3><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words($post->post_title, 4); ?></a></h3>
                                                </div>
                                                <p> <?php echo jobcareer_get_excerpt($default_excerpt_length, 'true', ''); ?></p>
                                                <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More', 'jobcareer'); ?></a>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_query();
                                else:
                                    if (function_exists('jobcareer_no_result_found')) {
                                        jobcareer_no_result_found();
                                    }
                                endif;
                                $qrystr = '';
                                if (isset($_GET['page_id'])) {
                                    $qrystr .= "&page_id=" . $_GET['page_id'];
                                }
                                if ($wp_query->found_posts > get_option('posts_per_page')) {
                                    if (function_exists('jobcareer_pagination')) {
                                        echo jobcareer_pagination(wp_count_posts()->publish, get_option('posts_per_page'), $qrystr);
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div> 
                </div>
                <?php if (isset($cs_layout) && $cs_layout == 'sidebar_right' && is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar))) { ?>
                    <div class="page-sidebar col-md-3"><?php
                        if (is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar)) :
                                ?><?php
                            endif;
                        }
                        ?></div>
                    <?php
                } else {
                    if (is_active_sidebar('sidebar-1')) {
                        echo '<div class="page-sidebar col-md-3">';
                        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1')) : endif;
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>
</div>
<?php get_footer();