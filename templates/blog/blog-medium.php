<?php
/**
 * @ Start front end Blog list view 
 *
 *
 */
$cs_blog_vars = array('post', 'cs_blog_cat', 'cs_blog_description', 'cs_blog_excerpt', 'cs_notification', 'wp_query','column_class');
$cs_blog_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_blog_vars);
extract($cs_blog_vars);

extract($wp_query->query_vars);

$width = '270';
$height = '203';

$query = new WP_Query($args);
$post_count = $query->post_count;
if ($query->have_posts()) {
    $postCounter = 0;
    wp_reset_query();

 
 
    while ($query->have_posts()) : $query->the_post();
        $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
        $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
        $cs_gallery = get_post_meta($post->ID, 'cs_post_list_gallery', true);
        $cs_gallery = explode(',', $cs_gallery);
        $cs_thumb_view = get_post_meta($post->ID, 'cs_detail_view', true);
        $cs_post_view = isset($cs_thumb_view) ? $cs_thumb_view : '';
        $current_user = wp_get_current_user();
        $custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
        $tags = get_tags();
        if(isset($cs_col_class) && $cs_col_class!="")
        {
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
        }
        ?> 
        <div class="cs-blog blog-medium">
            <?php if ($thumbnail <> '') { ?>
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
                    <span class="post-date"><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><i class="icon-calendar5"></i><?php echo get_the_date(); ?></a></span>
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
                <?php if ($cs_blog_description == 'yes') { ?><p> <?php echo jobcareer_get_excerpt($cs_blog_excerpt, 'true', ''); ?></p>
                    <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e('Read More', 'jobcareer'); ?></a>
                <?php }
                ?> 
            </div>
        </div>
        <?php
    endwhile;
    ?>
<?php
} else {
    $cs_notification->error(esc_html__('No blog post found.', 'jobcareer'));
}
