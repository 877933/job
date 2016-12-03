<?php
/**
 * The template for displaying Search Result
 */
get_header();
$var_arrays = array('cs_portfolio_excerpt', 'cs_blog_cat', 'wp_query');
$search_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($search_global_vars);
$default_excerpt_length = isset($jobcareer_options['cs_excerpt_length']) ? $jobcareer_options['cs_excerpt_length'] : '255';
$cs_blog_excerpt_theme_option = isset($jobcareer_options['cs_excerpt_length']) ? $jobcareer_options['cs_excerpt_length'] : '255';
$cs_layout = isset($jobcareer_options['cs_default_page_layout']) ? $jobcareer_options['cs_default_page_layout'] : '';
if (isset($cs_layout) && ($cs_layout == "sidebar_left" || $cs_layout == "sidebar_right")) {
    $cs_page_layout = "col-lg-9 col-md-9 col-sm-12 col-xs-12";
} else {
    $cs_page_layout = "";
}
$cs_sidebar = isset($jobcareer_options['cs_default_layout_sidebar']) ? $jobcareer_options['cs_default_layout_sidebar'] : '';
$cs_tags_name = 'post_tag';
$cs_categories_name = 'category';
$width = '85';
$height = '85';
$title_limit = 100000;
if (!isset($GET['page_id']))
    $GET['page_id_all'] = 1;
?>
<div class="main-section">
    <section class="page-section">
        <div class="container">
            <div class="row">
                <?php if ($cs_layout == 'sidebar_left') { ?>
                    <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <?php
                        if (is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar)) : endif;
                        }
                        ?>
                    </aside>
                <?php } ?>
                <div class="<?php echo esc_attr($cs_page_layout); ?>">
                    <div class="page-no-search">
                        <div class="cs-search-results">
                            <div class="relevant-search">
                                <div class="cs-search-results">
                                    <?php
									
                                    if (have_posts()) :
                                        echo '<ul> ';
                                        while (have_posts()) : the_post();
                                            $postid = get_the_ID();
                                            $cs_post_type = get_post_type($postid);
                                            if (isset($cs_post_type) and $cs_post_type == 'portfolios') {
                                                $cs_port_list_gallery = get_post_meta($post->ID, 'cs_port_list_gallery', true);
                                                if ($cs_port_list_gallery <> '') {
                                                    $cs_port_list_gallery = explode(',', $cs_port_list_gallery);
                                                    if (is_array($cs_port_list_gallery) && sizeof($cs_port_list_gallery) > 0) {
                                                        $img_url = jobcareer_attachment_image_src($cs_port_list_gallery[0], $width, $height);
                                                        $thumbnail = jobcareer_attachment_image_src($cs_port_list_gallery[0], $width, $height);
                                                    }
                                                }
                                            } else {
                                                $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
                                            }
                                            $cs_port_list_gallery = get_post_meta($post->ID, 'cs_port_list_gallery', true);
                                            if (isset($cs_post_type) and $cs_post_type == 'portfolios') {
                                                $cs_port_list_gallery = explode(',', $cs_port_list_gallery);

                                                if (is_array($cs_port_list_gallery) && sizeof($cs_port_list_gallery) > 0) {
                                                    $thumbnail = jobcareer_attachment_image_src($cs_port_list_gallery[0], $width, $height);
                                                }
                                            } else {
                                                $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
                                            }
                                            if (is_sticky()) {
                                                echo '<span>' . esc_html__('Featured:', 'jobcareer') . '</span>';
                                            }
                                            ?>
                                            <li>
                                                <div class="cs-relevant-list">
                                                    <div class="cs-text">
                                                        <span class="cs-categories">
                                                            <?php jobcareer_get_categories($cs_blog_cat); ?>
                                                        </span>
                                                        <span class="cs-date"> <?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></span>
                                                        <div class="cs-post-title">
                                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
                                                        </div>
                                                        <p> <?php echo jobcareer_get_excerpt($cs_blog_excerpt_theme_option, 'true', ''); ?></p>

                                                    </div>
                                                </div>
                                                <a class="cs-relevant-link" href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a>
                                            </li>
                                            <?php
                                        endwhile;
                                        echo ' </ul> ';
                                    else:
                                        jobcareer_no_result_found();
                                    endif;
                                    ?>

                                </div>							
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php
                    $qrystr = '';
                    if ($wp_query->found_posts > get_option('posts_per_page')) {
                        if (isset($_GET['s']))
                            $qrystr = "&amp;s=" . $_GET['s'];
                        if (isset($_GET['page_id']))
                            $qrystr .= "&amp;page_id=" . $_GET['page_id'];
                        echo jobcareer_pagination($wp_query->found_posts, get_option('posts_per_page'), $qrystr, esc_html__('Show Pagination','jobcareer'), 'page_id_all');
                    }
                    ?>
                </div>
                <?php if ($cs_layout == 'sidebar_right') { ?>
                    <aside class="page-sidebar col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <?php
                        if (is_active_sidebar(jobcareer_get_sidebar_id($cs_sidebar))) {
                            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar)) : endif;
                        }
                        ?>
                    </aside>
                    <?php
                }
                ?>          		  		
            </div>
        </div>	
    </section>
</div>
<?php
get_footer();
