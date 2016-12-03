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
?>
<div class="cs-blog classic"><?php
    if ($query->have_posts()) {
        $postCounter = 0;
        wp_reset_query();
        ?>
        <ul>
            <?php
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
                ?>
                <li>
                    <div class="cs-text">
                        <p>
                            <i class="icon-file-text-o"></i> <a class="cs-color" href="<?php the_permalink(); ?>"><?php echo wp_trim_words($post->post_title, 4); ?></a>
                            <a class="cs-color" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><span><?php echo get_the_date(); ?><i class="icon-uniEAB5"></i></span></a>
                        </p>
                        <?php
                        if ($cs_blog_description == 'yes') {
                            ?>
                            <p><?php echo jobcareer_get_excerpt($cs_blog_excerpt, 'true', ''); ?></p>
                            <a href="<?php the_permalink(); ?>" class="cs-color read-more"><?php esc_html_e('Read More', 'jobcareer'); ?></a>
                            <?php
                        }
                        ?>
                    </div>
                </li>
                <?php
            endwhile;
            ?>
        </ul>
        <?php
    } else {
        $cs_notification->error(esc_html__('No blog post found.', 'jobcareer'));
    }
    ?>
</div>