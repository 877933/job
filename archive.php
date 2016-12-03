<?php
/**
 * The template for Home page 
 */
get_header();
$var_arrays = array('cs_blog_cat', 'cs_blog_description', 'cs_blog_excerpt', 'wp_query', 'cs_counter_node', 'jobcareer_node');
$archive_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($archive_global_vars);
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
if (isset($jobcareer_options['cs_excerpt_length']) && $jobcareer_options['cs_excerpt_length'] <> '') {
    $default_excerpt_length = $jobcareer_options['cs_excerpt_length'];
} else {
    $default_excerpt_length = '20';
}
$cs_layout = isset($jobcareer_options['cs_default_page_layout']) ? $jobcareer_options['cs_default_page_layout'] : '';
if (isset($cs_layout) && ($cs_layout == "sidebar_left" || $cs_layout == "sidebar_right")) {
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
                            <?php
                            if (empty($_GET['page_id_all'])) {
                                $_GET['page_id_all'] = 1;
                            }
                            if (!isset($_GET["s"])) {
                                $_GET["s"] = '';
                            }
                            $description = 'yes';
                            $taxonomy = 'category';
                            $taxonomy_tag = 'post_tag';
                            $args_cat = array();
                            if (is_author()) {
                                global $author;
                                $userdata = get_userdata($author);
                            }
                            if (category_description() || is_tag() || (is_author() && isset($userdata->description) && !empty($userdata->description))) {
                                echo '<div class="widget evorgnizer">';
                                if (is_author()) {
                                    ?>
                                    <figure>
                                        <a>
                                            <?php
                                            $cs_profile_img = '';
                                            echo get_avatar($userdata->user_email, apply_filters('Cs_author_bio_avatar_size', 70));
                                            ?>
                                        </a>
                                    </figure>
                                    <div class="left-sp">
                                        <h5><a><?php echo esc_attr($userdata->display_name); ?></a></h5>
                                        <p><?php echo balanceTags($userdata->description, true); ?></p>
                                    </div>
                                    <?php
                                } elseif (is_category()) {
                                    $category_description = category_description();
                                    if (!empty($category_description)) {
                                        ?>
                                        <div class="left-sp">
                                            <p><?php echo category_description(); ?></p>
                                        </div>
                                    <?php } ?>
                                    <?php
                                } elseif (is_tag()) {
                                    $tag_description = tag_description();
                                    if (!empty($tag_description)) {
                                        ?>
                                        <div class="left-sp">
                                            <p><?php echo apply_filters('tag_archive_meta', $tag_description); ?></p>
                                        </div>
                                        <?php
                                    }
                                }
                                echo '</div>';
                            }
                            if (empty($_GET['page_id_all'])) {
                                $_GET['page_id_all'] = 1;
                            }
                            if (!isset($_GET["s"])) {
                                $_GET["s"] = '';
                            }
                            $description = 'yes';
                            $taxonomy = 'category';
                            $taxonomy_tag = 'post_tag';
                            $args_cat = array();
                            if (is_author()) {
                                $args_cat = array('author' => $wp_query->query_vars['author']);
                                $post_type = array('post');
                            } elseif (is_date()) {
                                if (is_month() || is_year() || is_day() || is_time()) {
                                    $args_cat = array('m' => $wp_query->query_vars['m'], 'year' => $wp_query->query_vars['year'], 'day' => $wp_query->query_vars['day'], 'hour' => $wp_query->query_vars['hour'], 'minute' => $wp_query->query_vars['minute'], 'second' => $wp_query->query_vars['second']);
                                }
                                $post_type = array('post', 'jobcareer');
                            } else if ((isset($wp_query->query_vars['taxonomy']) && !empty($wp_query->query_vars['taxonomy']))) {
                                $taxonomy = $wp_query->query_vars['taxonomy'];
                                $taxonomy_category = '';
                                if (isset($wp_query->query_vars[$taxonomy])) {
                                    $taxonomy_category = $wp_query->query_vars[$taxonomy];
                                }
                                if (isset($wp_query->query_vars['taxonomy']) && $wp_query->query_vars['taxonomy'] == 'Specialisms') {
                                    $args_cat = array($taxonomy => "$taxonomy_category");

                                    $post_type = 'jobcareer';
                                } else {
                                    $taxonomy = 'category';
                                    $args_cat = array();
                                    $post_type = 'post';
                                }
                            } else if (is_category()) {
                                $taxonomy = 'category';
                                $args_cat = array();
                                $category_blog = '';
                                if (isset($wp_query->query_vars['cat'])) {
                                    $category_blog = $wp_query->query_vars['cat'];
                                }
                                $post_type = 'post';
                                $args_cat = array('cat' => "$category_blog");
                            } else if (is_tag()) {
                                $taxonomy = 'category';
                                $args_cat = array();
                                $tag_blog = '';
                                if (isset($wp_query->query_vars['tag'])) {
                                    $tag_blog = $wp_query->query_vars['tag'];
                                }
                                $post_type = 'post';
                                $args_cat = array('tag' => "$tag_blog");
                            } else {
                                $taxonomy = 'category';
                                $args_cat = array();
                                $post_type = 'post';
                            }
                            $args = array(
                                'post_type' => $post_type,
                                'paged' => $_GET['page_id_all'],
                                'post_status' => 'publish',
                                'order' => 'ASC',
                            );
                            $args = array_merge($args_cat, $args);
                            $custom_query = new WP_Query($args);

                            if (have_posts()) :
                                if (empty($_GET['page_id_all'])) {
                                    $_GET['page_id_all'] = 1;
                                }
                                if (!isset($_GET["s"])) {
                                    $_GET["s"] = '';
                                }
                                while ($custom_query->have_posts()) : $custom_query->the_post();
                                    $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
//                                    if ($thumbnail == '') {
//                                        $thumbnail = trailingslashit(get_template_directory_uri()) . 'assets/images/img-not-found16x9.jpg';
//                                    }
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


                                    <div class="cs-blog blog-medium">
                                        <?php if (isset($cs_thumb_view) and $cs_thumb_view == 'slider') { ?> 
                                            <div class="cs-media">
                                                <?php jobcareer_post_slick_list($width, $height, get_the_id(), ''); ?>
                                            </div>
                                        <?php } else if (isset($thumbnail) && $thumbnail != '') { ?>
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
                                                <span class="post-comment"><a href="<?php the_permalink(); ?>#comments"><i class="icon-comments-o"></i><?php
                                                        $num_comments = get_comments_number($post->ID); // get_comments_number returns only a numeric value
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
                            if (isset($_GET['specialisms'])) {
                                $qrystr .= "&specialisms=" . $_GET['specialisms'];
                            }
                            if ($wp_query->found_posts > get_option('posts_per_page')) {
                                if (function_exists('jobcareer_pagination')) {
                                    echo jobcareer_pagination(wp_count_posts()->publish, get_option('posts_per_page'), $qrystr, 'Show Pagination', 'page_id_all');
                                }
                            }
                            ?><!----end block--->
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
                        ?>
                    </div>
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
    </section>
</div>
<?php get_footer();