<?php
/**
 * @Spacer html form for page builder
 */
if (!function_exists('jobcareer_sitemap_shortcode')) {

    function jobcareer_sitemap_shortcode($atts, $content = "") {
        global $cs_border, $cs_plugin_options;
        $cs_search_result_page = isset($cs_plugin_options['cs_search_result_page']) ? $cs_plugin_options['cs_search_result_page'] : '';

        $defaults = array('cs_sitemap_section_title' => '','column_size' => '',);
        extract(shortcode_atts($defaults, $atts));

        $cs_sitemap_section_title = $cs_sitemap_section_title ? $cs_sitemap_section_title : '';
        $column_size=  isset($column_size)?$column_size:'';
        ob_start();
        $column_class = jobcareer_custom_column_class($column_size);
                if(isset($column_class) &&$column_class !="")
        {
       echo "<div class='$column_class'>";
        }
        ?>
        <div class="row">
            <div class="sitemap-links">	
                <?php if (isset($cs_sitemap_section_title) && $cs_sitemap_section_title != '') { ?>
                    <div class="cs-element-title col-md-12">
                        <h2><?php echo esc_html($cs_sitemap_section_title); ?></h2>
                    </div> 
                <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h3><?php esc_html_e('Pages', 'jobcareer'); ?></h3>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'page',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query($args);
                            $post_count = $query->post_count;
                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Tags', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $tags = get_tags(array('order' => 'ASC', 'post_type' => 'post', 'order' => 'DESC'));
                            foreach ((array) $tags as $tag) {
                                ?>
                                <li> <?php echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" rel="tag">' . $tag->name . ' (' . $tag->count . ') </a>'; ?></li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Posts', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'post',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query($args);
                            $post_count = $query->post_count;
                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 3, '...'); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            ?>
                        </ul>
                    </div>	
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Categories', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'show_option_all' => '',
                                'order' => 'ASC',
                                'post_type' => 'post',
                                'order' => 'ASC',
                                'style' => 'list',
                                'title_li' => '',
                                'taxonomy' => 'category'
                            );

                            wp_list_categories($args);
                            ?>

                        </ul>
                    </div>	
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('jobcareer', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'jobs',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query($args);
                            $post_count = $query->post_count;
                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 3, '...'); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            ?>
                        </ul>
                    </div>	
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Specialisms', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $cs_terms = get_terms('specialisms');
                            if (isset($cs_terms) && is_array($cs_terms)) {
                                foreach ($cs_terms as $cs_term) {
                                    $cs_spec_link = '';
                                    if ($cs_search_result_page != '') {
                                        $cs_spec_link = ' href="' . esc_url_raw(get_page_link($cs_search_result_page) . '?&amp;specialisms=' . $cs_term->slug) . '"';
                                    }

                                    echo '<li><a' . $cs_spec_link . '>' . $cs_term->name . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div> 
        </div> 
        <?php
           if(isset($column_class) &&$column_class !="")
        {
       echo  '</div>';
        }
        $cs_sitemap = ob_get_clean();
        return do_shortcode($cs_sitemap);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_SITEMAP, 'jobcareer_sitemap_shortcode');
    }
}