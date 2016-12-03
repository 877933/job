<?php

if (!function_exists('jobcareer_tweets_shortcode')) {

    function jobcareer_tweets_shortcode($atts, $content = "") {
        global $cs_tweets_view, $tweet_color;
        $defaults = array('column_size' => '', 'cs_tweets_section_title' => '', 'cs_tweets_user_name' => 'default', 'cs_tweets_view' => '', 'cs_tweets_color' => '', 'cs_no_of_tweets' => '');
        extract(shortcode_atts($defaults, $atts));
        $cs_tweets_color = isset($cs_tweets_color) ? $cs_tweets_color : '';
        $column_size = isset($column_size) ? $column_size : '';
        if ($column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
        }
        //  echo '==='.$column_class.'===';

        $rand_id = rand(1115, 999999);
        $html = '';
        $section_title = '';
        jobcareer_enqueue_slick_script();
        if ($column_size != '') {
            $html .= '<div class="' . $column_class . '">';
        }
        if ($cs_tweets_view == 'fancy') {
            $html .= '
            <div class="cs-news-ticker cs-news-ticker-' . $rand_id . '">
                <h2 class="cs-color" >@' . $cs_tweets_user_name . '</h2>
                <ul>';
            $html .= cs_get_tweets($cs_tweets_user_name, $cs_no_of_tweets, $cs_tweets_color);
            $html .= '
                </ul>
            </div>
            <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery(".cs-news-ticker-' . $rand_id . ' ul").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    arrows:false,
                    autoplaySpeed: 2000,
                });
            });
            </script>';
        } else {
            $html .= '<div class="vticker">';
            $html .= '<ul>';
            $html .= cs_get_tweets($cs_tweets_user_name, $cs_no_of_tweets, $cs_tweets_color);
            $html .= '</ul>';
            $html .= '</div>';
        }
        if ($column_size != '') {
            $html .= '</div>';
        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_TWEETS, 'jobcareer_tweets_shortcode');
    }
}

/*
 *
 * @ Start function for Get Tweets through APi
 * @retrun
 *
 */
if (!function_exists('cs_get_tweets')) {

    function cs_get_tweets($username, $numoftweets, $cs_tweets_color = '') {
        global $jobcareer_options, $cs_tweets_view, $tweet_color;

        $username = html_entity_decode($username);
        $numoftweets = $numoftweets;
        if ($numoftweets == '') {
            $numoftweets = 2;
        }
        if (class_exists('wp_jobhunt')) {
            if (strlen($username) > 1) {

                $text = '';
                $return = '';
                $cacheTime = 10000;
                $transName = 'latest-tweets';
                jobcareer_include_file(cs_framework::plugin_dir() . 'include/cs-twitter/twitteroauth.php');
                $consumerkey = isset($jobcareer_options['cs_consumer_key']) ? $jobcareer_options['cs_consumer_key'] : '';
                $consumersecret = isset($jobcareer_options['cs_consumer_secret']) ? $jobcareer_options['cs_consumer_secret'] : '';
                $accesstoken = isset($jobcareer_options['cs_access_token']) ? $jobcareer_options['cs_access_token'] : '';
                $accesstokensecret = isset($jobcareer_options['cs_access_token_secret']) ? $jobcareer_options['cs_access_token_secret'] : '';
                $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
                $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $username . "&count=" . $numoftweets);


                if (!is_wp_error($tweets) and is_array($tweets)) {
                    set_transient($transName, $tweets, 60 * $cacheTime);
                } else {
                    $tweets = get_transient('latest-tweets');
                }
                if (!is_wp_error($tweets) and is_array($tweets)) {
                    $twitter_text_color = '';
                    if (!empty($cs_tweets_color)) {
                        $twitter_text_color = 'style="color: ' . $cs_tweets_color . ' !important;" ';
                    }
                    $rand_id = rand(11115, 300000);
                    $exclude = 0;
                    foreach ($tweets as $tweet) {
                        $exclude++;
                        $text = $tweet->{'text'};
                        foreach ($tweet->{'user'} as $type => $userentity) {
                            if ($type == 'profile_image_url') {
                                $profile_image_url = $userentity;
                            } else if ($type == 'screen_name') {
                                $screen_name = '<a href="https://twitter.com/' . $userentity . '" target="_blank" class="colrhover" title="' . $userentity . '">@' . $userentity . '</a>';
                            }
                        }
                        foreach ($tweet->{'entities'} as $type => $entity) {
                            if ($type == 'hashtags') {
                                foreach ($entity as $j => $hashtag) {
                                    $update_with = '<a href="https://twitter.com/search?q=%23' . $hashtag->{'text'} . '&amp;src=hash" target="_blank" title="' . $hashtag->{'text'} . '">#' . $hashtag->{'text'} . '</a>';
                                    $text = str_replace('#' . $hashtag->{'text'}, $update_with, $text);
                                }
                            }
                        }
                        $large_ts = time();
                        $n = $large_ts - strtotime($tweet->{'created_at'});
                        if ($n < (60)) {
                            $posted = sprintf(esc_html__('%d seconds ago', 'jobcareer'), $n);
                        } elseif ($n < (60 * 60)) {
                            $minutes = round($n / 60);
                            $posted = sprintf(_n('About a Minute Ago', '%d Minutes Ago', $minutes, 'jobcareer'), $minutes);
                        } elseif ($n < (60 * 60 * 16)) {
                            $hours = round($n / (60 * 60));
                            $posted = sprintf(_n('About an Hour Ago', '%d Hours Ago', $hours, 'jobcareer'), $hours);
                        } elseif ($n < (60 * 60 * 24)) {
                            $hours = round($n / (60 * 60));
                            $posted = sprintf(_n('About an Hour Ago', '%d Hours Ago', $hours, 'jobcareer'), $hours);
                        } elseif ($n < (60 * 60 * 24 * 6.5)) {
                            $days = round($n / (60 * 60 * 24));
                            $posted = sprintf(_n('About a Day Ago', '%d Days Ago', $days, 'jobcareer'), $days);
                        } elseif ($n < (60 * 60 * 24 * 7 * 3.5)) {
                            $weeks = round($n / (60 * 60 * 24 * 7));
                            $posted = sprintf(_n('About a Week Ago', '%d Weeks Ago', $weeks, 'jobcareer'), $weeks);
                        } elseif ($n < (60 * 60 * 24 * 7 * 4 * 11.5)) {
                            $months = round($n / (60 * 60 * 24 * 7 * 4));
                            $posted = sprintf(_n('About a Month Ago', '%d Months Ago', $months, 'jobcareer'), $months);
                        } elseif ($n >= (60 * 60 * 24 * 7 * 4 * 12)) {
                            $years = round($n / (60 * 60 * 24 * 7 * 52));
                            $posted = sprintf(_n('About a year Ago', '%d years Ago', $years, 'jobcareer'), $years);
                        }

                        if ($cs_tweets_view == 'fancy') {
                            $return .= '
                            <li>
                            <span class="cs-color" ' . $twitter_text_color . '>' . $text . '</span>
                            ' . $posted . '
                            </li>';
                        } else {
                            $return .= "<li >";
                            $return .= "<p " . $twitter_text_color . ">$text</p>";
                            $return .= "<span><i class='icon-twitter2'></i>(" . $posted . ")</span>";
                            $return .= "</li>";
                        }
                    }
                    return $return;
                } else {
                    if (isset($tweets->errors[0]) && $tweets->errors[0] <> "") {
                        return '<div class="cs-twitter item" data-hash="dummy-one"><h4>' . $tweets->errors[0]->message . esc_html__('Please enter valid Twitter API Keys', 'jobcareer') . '</h4></div>';
                    } else {
                        return '<div class="cs-twitter item" data-hash="dummy-two"><h4>' . esc_html__('No Tweets Found', 'jobcareer') . '</h4></div>';
                    }
                }
            } else {
                return '<div class="cs-twitter item" data-hash="dummy-three"><h4>' . esc_html__('No Tweets Found', 'jobcareer') . '</h4></div>';
            }
        }
    }

}