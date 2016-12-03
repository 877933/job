<?php
//=====================================================================
// Adding mce custom button for short codes start
//=====================================================================
if ( ! class_exists( 'jobcareer_shortcodes_editor_selector' ) ) {

	class jobcareer_shortcodes_editor_selector {

		var $buttonName = 'shortcode';

		// start function for Add Selector

		function addSelector() {
			add_filter( 'mce_external_plugins', array( $this, 'registerTmcePlugin' ) );
			add_filter( 'mce_buttons', array( $this, 'registerButton' ) );
		}

		// start function for registerButton

		function registerButton( $buttons ) {
			array_push( $buttons, "separator", $this->buttonName );
			return $buttons;
		}

		// start function for registerTmcePlugin

		function registerTmcePlugin( $plugin_array ) {
			return $plugin_array;
		}

	}

}
//=====================================================================
// Allow special char functions start
//=====================================================================

if ( ! function_exists( 'jobcareer_special_char' ) ) {

	function jobcareer_special_char( $input = '' ) {
		$output = $input;
		return $output;
	}

}

if ( ! isset( $shortcodesES ) ) {
	$shortcodesES = new jobcareer_shortcodes_editor_selector();
	add_action( 'admin_head', array( $shortcodesES, 'addSelector' ) );
}
//=====================================================================
//Bootstrap Coloumn Class
//=====================================================================
if ( ! function_exists( 'jobcareer_custom_column_class' ) ) {

	function jobcareer_custom_column_class( $column_size ) {
		$coloumn_class = '';
		if ( isset( $column_size ) && $column_size <> '' ) {
			list($top, $bottom) = explode( '/', $column_size );
			$width = $top / $bottom * 100;
			$width = ( int ) $width;
			$coloumn_class = '';
			if ( round( $width ) == '16' || round( $width ) < 16 ) {
				$coloumn_class = 'col-lg-2 col-md-2 col-sm-6 col-xs-12';
			} elseif ( round( $width ) == '25' || (round( $width ) < 25 && round( $width ) > 16) ) {
				$coloumn_class = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
			} elseif ( round( $width ) == '33' || (round( $width ) < 33 && round( $width ) > 25) ) {
				$coloumn_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
			} elseif ( round( $width ) == '50' || (round( $width ) < 50 && round( $width ) > 33) ) {
				$coloumn_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			} elseif ( round( $width ) == '67' || (round( $width ) < 67 && round( $width ) > 50) ) {
				$coloumn_class = 'col-lg-8 col-md-12 col-sm-12 col-xs-12';
			} elseif ( round( $width ) == '75' || (round( $width ) < 75 && round( $width ) > 67) ) {
				$coloumn_class = 'col-md-9 col-lg-9 col-sm-12 col-xs-12';
			} elseif ( round( $width ) == '100' ) {
				$coloumn_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
			} else {
				$coloumn_class = '';
			}
		}
		return esc_html( $coloumn_class );
	}

}
//=====================================================================
// Ads Banner Shortcode
//=====================================================================
// here i made changes
if ( ! function_exists( 'jobcareer_banner_ads_shortcode' ) ) {

	function jobcareer_banner_ads_shortcode( $atts ) {

		global $jobcareer_options;
		$defaults = array( 'id' => '0' );
		extract( shortcode_atts( $defaults, $atts ) );
		$html = '';
		if ( isset( $jobcareer_options['banner_field_code_no'] ) && is_array( $jobcareer_options['banner_field_code_no'] ) ) {
			$i = 0;
			foreach ( $jobcareer_options['banner_field_code_no'] as $banner ) :
				if ( $jobcareer_options['banner_field_code_no'][$i] == $id ) {
					break;
				}
				$i ++;
			endforeach;
			$cs_banner_title = isset( $jobcareer_options['banner_field_title'][$i] ) ? $jobcareer_options['banner_field_title'][$i] : '';
			$cs_banner_style = isset( $jobcareer_options['banner_field_style'][$i] ) ? $jobcareer_options['banner_field_style'][$i] : '';
			$cs_banner_type = isset( $jobcareer_options['banner_field_type'][$i] ) ? $jobcareer_options['banner_field_type'][$i] : '';
			$cs_banner_image = isset( $jobcareer_options['banner_field_image'][$i] ) ? $jobcareer_options['banner_field_image'][$i] : '';
			$cs_banner_url = isset( $jobcareer_options['banner_field_url'][$i] ) ? $jobcareer_options['banner_field_url'][$i] : '';
			$cs_banner_url_target = isset( $jobcareer_options['banner_field_url_target'][$i] ) ? $jobcareer_options['banner_field_url_target'][$i] : '';
			$cs_banner_adsense_code = isset( $jobcareer_options['banner_adsense_code'][$i] ) ? $jobcareer_options['banner_adsense_code'][$i] : '';
			$cs_banner_code_no = isset( $jobcareer_options['banner_field_code_no'][$i] ) ? $jobcareer_options['banner_field_code_no'][$i] : '';
			$html .= '<div class="cs_banner_section">';


			if ( $cs_banner_type == 'image' ) {
				if ( ! isset( $_COOKIE["cs_banner_clicks_" . $cs_banner_code_no] ) ) {
					$html .= '<a onclick="jobcareer_banner_count_plus(\'' . admin_url( 'admin-ajax.php' ) . '\', \'' . $cs_banner_code_no . '\')" id="cs_banner_clicks' . $cs_banner_code_no . '" href="' . esc_url( $cs_banner_url ) . '" target="' . $cs_banner_url_target . '"><img src="' . esc_url( $cs_banner_image ) . '" alt="' . $cs_banner_title . '" /></a>';
				} else {
					$html .= '<a href="' . esc_url( $cs_banner_url ) . '" target="' . $cs_banner_url_target . '"><img src="' . esc_url( $cs_banner_image ) . '" alt="' . $cs_banner_title . '" /></a>';
				}
			} else {
				$html .= htmlspecialchars_decode( stripslashes( $cs_banner_adsense_code ) );
			}
			$html .= '</div>';
		}

		return $html;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_ads', 'jobcareer_banner_ads_shortcode' );
}


//=====================================================================
// Listing pages shortcode
//=====================================================================
if ( ! function_exists( 'jobcareer_tags_render' ) ) {

	function jobcareer_tags_render( $atts, $content = "" ) {
		global $post, $jobcareer_xmlObject;
		$defaults = array( 'icon' => '', 'label' => '', 'seperator' => '' );
		ob_start();
		if ( isset( $jobcareer_xmlObject->cs_post_tags_show ) && $jobcareer_xmlObject->cs_post_tags_show == 'on' ) {
			if ( isset( $seperator ) && $seperator <> '' ) {
				$seperator = $seperator;
			}
			$args = array(
				'name' => ( string ) get_post_type( $post->ID ),
				'post_type' => 'dcpt',
				'post_status' => 'publish',
				'showposts' => 1,
			);
			$get_posts = get_posts( $args );
			if ( $get_posts ) {
				$dcpt_id = ( int ) $get_posts[0]->ID;
				$cs_tags_name = get_post_meta( $dcpt_id, 'cs_tags_name', true );
				$before_cat = '';
				if ( $icon ) {
					$before_cat .= $icon;
				}
				if ( $label ) {
					$before_cat .= ' ' . $label;
				}
				$tags_listtt = get_the_term_list( $post->ID, strtolower( $cs_tags_name ), $before_cat, $seperator, '' );
				if ( $tags_listtt ) {
					printf( '%1$s', $tags_listtt );
				}
			}
		}
		$tags_data = ob_get_clean();
		return $tags_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_tag', 'jobcareer_tags_render' );
}
//=====================================================================
// get shortcode content
//=====================================================================
if ( ! function_exists( 'jobcareer_content_render' ) ) {

	function jobcareer_content_render( $atts, $content = "" ) {
		global $post;
		ob_start();
		the_content();
		wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages', 'jobcareer' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		$content_data = ob_get_clean();
		return $content_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_content', 'jobcareer_content_render' );
}
//=====================================================================
// Start get post attachement function
//=====================================================================
if ( ! function_exists( 'jobcareer_post_attachment_render' ) ) {

	function jobcareer_post_attachment_render( $atts, $content = "" ) {
		global $post, $jobcareer_xmlObject;
		ob_start();
		$post_attachment = '';
		$args = array(
			'post_type' => 'attachment',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $post->ID
		);
		$attachments = get_posts( $args );
		if ( $attachments ) {
			?>
			<div class="cs-media-attachment mediaelements-post">
				<?php
				foreach ( $attachments as $attachment ) {
					$attachment_title = apply_filters( 'the_title', $attachment->post_title );
					$type = get_post_mime_type( $attachment->ID );
					if ( $type == 'image/jpeg' ) {
						?>
						<a <?php
						if ( $attachment_title <> '' ) {
							echo 'data-title="' . $attachment_title . '"';
						}
						?> href="<?php echo esc_url( $attachment->guid ); ?>" data-rel="<?php echo "prettyPhoto[gallery1]" ?>" class="me-imgbox">
							<?php echo wp_get_attachment_image( $attachment->ID, array( 240, 180 ), true ) ?></a>
						<?php
					} elseif ( $type == 'audio/mpeg' ) {
						?>
						<!-- Button to trigger modal --> 
						<a href="#audioattachment<?php echo intval( $attachment->ID ); ?>" role="button" data-toggle="modal" class="iconbox"><i class="icon-microphone"></i></a> 
						<!-- Modal -->
						<div class="modal fade" id="audioattachment<?php echo intval( $attachment->ID ); ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<audio class="cs-sectionaudio" src="<?php echo esc_url( $attachment->guid ); ?>" type="audio/mp3" controls></audio>
									</div>
								</div>
								<!-- /.modal-content --> 
							</div>
						</div>
						<?php
					} elseif ( $type == 'video/mp4' ) {
						?>
						<a href="#videoattachment<?php echo intval( $attachment->ID ); ?>" role="button" data-toggle="modal" class="iconbox"><i class="icon-video-camera"></i></a>
						<div class="modal fade" id="videoattachment<?php echo intval( $attachment->ID ); ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									</div>
									<div class="modal-body">
										<video width="100%" height="360" poster="">
											<source src="<?php echo esc_url( $attachment->guid ); ?>" type="video/mp4" title="mp4">
										</video>
									</div>
								</div>
								<!-- /.modal-content --> 
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<?php
		}
		$post_attachment_data = ob_get_clean();
		return $post_attachment_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_post_attachment', 'jobcareer_post_attachment_render' );
}
//=====================================================================
// Start Author's related posts function
//=====================================================================
if ( ! function_exists( 'jobcareer_get_related_athor_posts' ) ) {

	function jobcareer_get_related_athor_posts( $num_of_post ) {
		global $authordata, $post;
		$post_type = get_post_type( $post->ID );
		$authors_posts = get_posts( array( 'author' => $authordata->ID, 'post_type' => $post_type, 'post__not_in' => array( $post->ID ), 'posts_per_page' => $num_of_post ) );
		$output = '<ul>';
		foreach ( $authors_posts as $authors_post ) {
			$output .= '<li><a href="' . esc_url( get_permalink( $authors_post->ID ) ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
		}
		$output .= '</ul>';
		return $output;
	}

}
//=====================================================================
// Start Author's posts render function
//=====================================================================
if ( ! function_exists( 'jobcareer_post_author_render' ) ) {

	function jobcareer_post_author_render( $atts, $content = "" ) {
		global $post, $jobcareer_xmlObject, $authordata;
		$defaults = array( 'thumbnail' => 'on', 'thumbnail_size' => '70', 'biographical' => 'off', 'social' => 'off', 'num_of_post' => '4' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( isset( $jobcareer_xmlObject->cs_post_author_info_show ) && $jobcareer_xmlObject->cs_post_author_info_show == 'on' ) {
			?>
			<div class="cs-content-wrap">
				<header class="cs-heading-title">
					<h2 class=" cs-element-title"><?php esc_html_e( 'About', 'jobcareer' ); ?> <?php esc_html_e( 'Author', 'jobcareer' ); ?></h2>
				</header>
				<div class="about-author">
					<?php if ( isset( $thumbnail ) && $thumbnail == 'on' ) { ?>
						<figure><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="float-left"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'PixFill_author_bio_avatar_size', $thumbnail_size ) ); ?></a></figure>
					<?php } ?>
					<div class="text">
						<h4><a class="colrhover" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></h4>
						<span></span>
						<?php if ( isset( $thumbnail ) && $thumbnail == 'on' ) { ?>
							<p><?php the_author_meta( 'description' ); ?></p>
						<?php } ?>
						<?php if ( isset( $social ) && $social == 'on' ) { ?>
							<ul class="socialmedia group">
								<?php if ( get_the_author_meta( 'facebook' ) <> '' ) { ?>
									<li><a href="<?php echo cs_server_protocol(); ?>facebook.com/<?php the_author_meta( 'facebook' ); ?>"><i class="icon-facebook2"></i></a></li>
								<?php } ?>
								<?php if ( get_the_author_meta( 'twitter' ) <> '' ) { ?>
									<li><a href="<?php echo cs_server_protocol(); ?>twitter.com/<?php the_author_meta( 'twitter' ); ?>"><i class="icon-twitter6"></i></a></li>
								<?php } ?>
								<li class="share"><a href="#"><?php esc_html_e( 'View All Posts', 'jobcareer' ); ?></a></li>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>    
			<!-- About Author End -->
			<?php
		}
		$coments_data = ob_get_clean();
		return $coments_data;
	}

	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'cs_author_description', 'jobcareer_post_author_render' );
	}
	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'cs_author_detail', 'jobcareer_post_author_render' );
	}
}
//=====================================================================
//start Links Render functions 
//=====================================================================
if ( ! function_exists( 'jobcareer_edit_link_render' ) ) {

	function jobcareer_edit_link_render( $atts, $content = "" ) {
		global $post;
		ob_start();
		edit_post_link( esc_html__( 'Edit', 'jobcareer' ), '<li>', '</li>' );
		$edit_post_data = ob_get_clean();
		return $edit_post_data;
	}

	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'cs_edit', 'jobcareer_edit_link_render' );
	}
}
//=====================================================================
// next prev posts links function
//=====================================================================
if ( ! function_exists( 'jobcareer_next_previous_post_render' ) ) {

	function jobcareer_next_previous_post_render( $atts, $content = "" ) {
		global $post, $jobcareer_xmlObject;
		$defaults = array( 'post_type' => 'post' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( isset( $jobcareer_xmlObject->post_pagination_show ) && $jobcareer_xmlObject->post_pagination_show == 'on' ) {
			jobcareer_next_prev_links();
		}
		$cs_next_previous_data = ob_get_clean();
		return $cs_next_previous_data;
	}

	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'cs_next_previous', 'jobcareer_next_previous_post_render' );
	}
}
//=====================================================================
// post share button init functions
//=====================================================================
if ( ! function_exists( 'jobcareer_share_render' ) ) {

	function jobcareer_share_render( $atts, $content = "" ) {
		global $post, $jobcareer_xmlObject;
		$defaults = array( 'title' => esc_html__( 'Share', 'jobcareer' ), 'icon' => 'icon-share-square-o', 'class' => 'btnshare' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( $jobcareer_xmlObject->cs_post_social_sharing == "on" ) {
			jobcareer_addthis_script_init_method();
			echo '<a class="addthis_button_compact ' . $class . '" href="#"><i class="fa ' . $icon . '"></i>' . $title . '</a>';
		}

		$share_data = ob_get_clean();
		return $share_data;
	}

	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'cs_share', 'jobcareer_share_render' );
	}
}

//=====================================================================
// Share Post comments function
//=====================================================================
if ( ! function_exists( 'jobcareer_comments_render' ) ) {

	function jobcareer_comments_render( $atts, $content = "" ) {
		global $post;
		ob_start();
		comments_template( '', true );
		$coments_data = ob_get_clean();
		return $coments_data;
	}

	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'jobcareer_comments', 'jobcareer_comments_render' );
	}
}
//=====================================================================
// Start get Post author function 
//=====================================================================
if ( ! function_exists( 'jobcareer_author_render' ) ) {

	function jobcareer_author_render( $atts, $content = "" ) {
		global $post;
		ob_start();
		printf( '%1$s', '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" >' . get_the_author() . '</a>' );
		$author_data = ob_get_clean();
		return $author_data;
	}

	if ( function_exists( 'cs_short_code' ) ) {
		cs_short_code( 'cs_author', 'jobcareer_author_render' );
	}
}
//=====================================================================
// Get Post posted date function 
//=====================================================================
if ( ! function_exists( 'jobcareer_postdate_render' ) ) {

	function jobcareer_postdate_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'date_format' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		if ( isset( $date_format ) || $date_format <> '' ) {
			$date_format = $date_format;
		} else {
			$date_format = get_option( 'date_format' );
		}
		ob_start();
		?>
		<time datetime="<?php echo date_i18n( 'Y-m-d', strtotime( get_the_date() ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( get_the_date() ) ); ?></time>
		<?php
		$postdate_data = ob_get_clean();
		return $postdate_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_postdate', 'jobcareer_postdate_render' );
}
//=====================================================================
// Start Post Excerpt function
//=====================================================================
if ( ! function_exists( 'jobcareer_excerpt_render' ) ) {

	function jobcareer_excerpt_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'read_more' => 'true', 'read_more_text' => esc_html__( 'Read More', 'jobcareer' ) );
		ob_start();
		$jobcareer_node->cs_dcpt_excerpt = ( int ) $jobcareer_node->cs_dcpt_excerpt;
		if ( isset( $jobcareer_node->cs_dcpt_excerpt ) && $jobcareer_node->cs_dcpt_excerpt > 0 ) {
			?>
			<p><?php echo jobcareer_get_excerpt( $jobcareer_node->cs_dcpt_excerpt, $read_more, $read_more_text ); ?></p>
			<?php
		}
		$postexcerpt_data = ob_get_clean();
		return $postexcerpt_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_excerpt', 'jobcareer_excerpt_render' );
}
//=====================================================================
// Get Post Title function 
//=====================================================================
if ( ! function_exists( 'jobcareer_title_render' ) ) {

	function jobcareer_title_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'link' => 'yes', 'chars' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( $link == 'yes' ) {
			echo '<a href="' . esc_url( get_permalink() ) . '">';
		}
		if ( ! empty( $chars ) && strlen( get_the_title() ) > $chars ) {
			echo substr( get_the_title(), 0, $chars );
			echo '...';
		} else {
			the_title();
		}
		if ( $link == 'yes' ) {
			echo '</a>';
		}
		$posttitle_data = ob_get_clean();
		return $posttitle_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_title', 'jobcareer_title_render' );
}


//=====================================================================
// Featured post title
//=====================================================================
if ( ! function_exists( 'jobcareer_featured_render' ) ) {

	function jobcareer_featured_render( $atts, $content = "" ) {
		$defaults = array( 'title' => esc_html__( 'Featured', 'jobcareer' ) );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		if ( is_sticky() ) {
			echo '<span class="cs-featured">' . $title . '</span>';
		}
		$postfeatured_data = ob_get_clean();
		return $postfeatured_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'jobcareer_featured', 'jobcareer_featured_render' );
}
//=====================================================================
// Rating
//=====================================================================
if ( ! function_exists( 'jobcareer_rating_render' ) ) {

	function jobcareer_rating_render( $atts, $content = "" ) {
		$defaults = array( 'rating_percentage' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$rating_percent = 0;
		$rating_percent = $rating_percentage * 20;
		echo '<div class="cs-rating"><span style="width:' . $rating_percentage . '%" class="rating-box"></span></div>';
		$postfeatured_data = ob_get_clean();
		return $postfeatured_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_rating', 'jobcareer_rating_render' );
}
//=====================================================================
// attachments
//=====================================================================
if ( ! function_exists( 'jobcareer_mediaattachments_render' ) ) {

	function jobcareer_mediaattachments_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$media_attachment = '';
		if ( $icon ) {
			$media_attachment .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( count( $jobcareer_xmlObject->gallery ) > 0 ) {
			$media_attachment .= count( $jobcareer_xmlObject->gallery );
		}
		return $media_attachment;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_mediaattachments', 'jobcareer_mediaattachments_render' );
}
//=====================================================================
// Model
//=====================================================================
if ( ! function_exists( 'jobcareer_model_render' ) ) {

	function jobcareer_model_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'title' => '', 'model' => '', 'icon' => 'icon-check' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_model = '';
		if ( $icon ) {
			$cs_model .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_model .= $title;
		}
		if ( isset( $jobcareer_xmlObject->dynamic_post_sale_model ) && $jobcareer_xmlObject->dynamic_post_sale_model <> '' ) {
			$cs_model .= $jobcareer_xmlObject->dynamic_post_sale_model;
		}
		return $cs_model;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_model', 'jobcareer_model_render' );
}
//=====================================================================
// post sale milage
//=====================================================================
if ( ! function_exists( 'jobcareer_milage_render' ) ) {

	function jobcareer_milage_render() {
		global $post, $jobcareer_node;
		$defaults = array( 'title' => '', 'milage' => '', 'icon' => 'icon-check' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_milage = '';
		if ( $icon ) {
			$cs_milage .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_milage .= $title;
		}
		if ( isset( $jobcareer_xmlObject->dynamic_post_sale_milage ) && $jobcareer_xmlObject->dynamic_post_sale_milage <> '' ) {
			$cs_milage .= $jobcareer_xmlObject->dynamic_post_sale_milage;
		}
		return $cs_milage;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_milage', 'jobcareer_milage_render' );
}
//=====================================================================
// post price
//=====================================================================
if ( ! function_exists( 'jobcareer_price_render' ) ) {

	function jobcareer_price_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'title' => '', 'old_price' => '', 'new_price' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_price = '<span>';
		if ( $title ) {
			$cs_price .= $title;
		}
		if ( $icon ) {
			$cs_price .= '<i class="icon-' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_price .= $title;
		}
		if ( isset( $jobcareer_xmlObject->dynamic_post_sale_oldprice ) && $jobcareer_xmlObject->dynamic_post_sale_oldprice <> '' ) {
			$cs_price .= '<span>' . $jobcareer_xmlObject->dynamic_post_sale_oldprice . '</span>';
		}
		if ( isset( $jobcareer_xmlObject->dynamic_post_sale_newprice ) && $jobcareer_xmlObject->dynamic_post_sale_newprice <> '' ) {
			$cs_price .= '<big>' . $jobcareer_xmlObject->dynamic_post_sale_newprice . '</big>';
		}
		$cs_price .= '</span>';
		return '<div class="cs-carprice">' . $cs_price . '</div>';
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_price', 'jobcareer_price_render' );
}
//=====================================================================
// custom email
//=====================================================================
if ( ! function_exists( 'jobcareer_custom_email_render' ) ) {

	function jobcareer_custom_email_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_custom_email = '';
		if ( $title ) {
			$cs_custom_email .= $title;
		}
		if ( $icon ) {
			$cs_custom_email .= '<i class="icon-' . $icon . '"></i>';
		}
		if ( isset( $name ) ) {
			$cs_custom_email .= $jobcareer_xmlObject->$name;
		}
		return $cs_custom_email;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_email', 'jobcareer_custom_email_render' );
}
//=====================================================================
// custom text
//=====================================================================
if ( ! function_exists( 'jobcareer_custom_text_render' ) ) {

	function jobcareer_custom_text_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_custom_text = '';
		if ( $icon ) {
			$cs_custom_text .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_custom_text .= $title;
		}
		if ( isset( $name ) ) {
			$cs_custom_text .= $jobcareer_xmlObject->$name;
		}
		return $cs_custom_text;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_text', 'jobcareer_custom_text_render' );
}
//=====================================================================
// custom textarea 
//=====================================================================
if ( ! function_exists( 'jobcareer_custom_textarea_render' ) ) {

	function jobcareer_custom_textarea_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_custom_text = '';
		if ( $icon ) {
			$cs_custom_text .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( isset( $title ) && $title <> '' ) {
			$cs_custom_text .= $title;
		}
		if ( isset( $name ) ) {
			$cs_custom_text .= $jobcareer_xmlObject->$name;
		}
		return $cs_custom_text;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_textarea', 'jobcareer_custom_text_render' );
}
//=====================================================================
// custom radio
//=====================================================================
if ( ! function_exists( 'jobcareer_custom_radio_render' ) ) {

	function jobcareer_custom_radio_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_custom_radio = '';
		if ( $icon ) {
			$cs_custom_radio .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_custom_radio .= $title;
		}
		if ( isset( $name ) ) {
			$cs_custom_radio .= $jobcareer_xmlObject->$name;
		}
		return $cs_custom_radio;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_radio', 'jobcareer_custom_radio_render' );
}
//=====================================================================
// post date
//=====================================================================
if ( ! function_exists( 'jobcareer_date_render' ) ) {

	function jobcareer_date_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_custom_date = '';
		if ( $icon ) {
			$cs_custom_date .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_custom_date .= $title;
		}
		if ( isset( $name ) ) {
			$cs_custom_date .= $jobcareer_xmlObject->$name;
		}
		return $cs_custom_date;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_date', 'jobcareer_date_render' );
}
//=====================================================================
// multi select option
//=====================================================================
if ( ! function_exists( 'jobcareer_multiselect_render' ) ) {

	function jobcareer_multiselect_render( $atts, $content = "" ) {
		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_multiselect = '';
		if ( $icon ) {
			$cs_multiselect .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_multiselect .= $title;
		}
		if ( isset( $name ) ) {
			$name = trim( $name );
			$cs_multiselect .= $jobcareer_xmlObject->$name;
		}
		return $cs_multiselect;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_multiselect', 'jobcareer_multiselect_render' );
}
//=====================================================================
// post url
//=====================================================================
if ( ! function_exists( 'jobcareer_url_render' ) ) {

	function jobcareer_url_render( $atts, $content = "" ) {

		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );

		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$jobcareer_url_render = '';
		if ( $icon ) {
			$jobcareer_url_render .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$jobcareer_url_render .= $title;
		}

		if ( isset( $name ) ) {
			$name = trim( $name );
			$jobcareer_url_render .= $jobcareer_xmlObject->$name;
		}
		return $jobcareer_url_render;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_url', 'jobcareer_url_render' );
}
//=====================================================================
// count media attachments
//=====================================================================
if ( ! function_exists( 'jobcareer_mediaattachment_count_render' ) ) {

	function jobcareer_mediaattachment_count_render( $atts, $content = "" ) {

		global $post, $jobcareer_node;
		$defaults = array( 'title' => '', 'icon' => 'icon-camera' );
		extract( shortcode_atts( $defaults, $atts ) );

		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_mediaattachment_count .= '<i class="fa ' . $icon . '"></i> <span class="viewcount cs-bg-color">' . count( $jobcareer_xmlObject->gallery ) . '</span>';
		return $cs_mediaattachment_count;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_mediaattachment_count', 'jobcareer_mediaattachment_count_render' );
}

//=====================================================================
// Map location Render link
//=====================================================================
if ( ! function_exists( 'jobcareer_map_location_link_render' ) ) {

	function jobcareer_map_location_link_render( $atts, $content = "" ) {

		global $post;
		$defaults = array( 'icon' => 'icon-map-marker', 'link' => '#map' );
		extract( shortcode_atts( $defaults, $atts ) );

		$cs_map_location .= '<a href="' . esc_url( get_permalink() ) . $link . '"><i class="fa ' . $icon . '"></i></a>';
		return $cs_map_location;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_map_location', 'jobcareer_map_location_link_render' );
}
//=====================================================================
// get location address
//=====================================================================
if ( ! function_exists( 'jobcareer_location_address_render' ) ) {

	function jobcareer_location_address_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'icon' => 'icon-map-marker', 'link' => '#map' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_location_address = '';
		if ( isset( $jobcareer_xmlObject->dynamic_post_location_address_icon ) ) {
			$cs_location_address .= '<i class="fa ' . $jobcareer_xmlObject->dynamic_post_location_address_icon . '"></i>';
		}
		if ( isset( $jobcareer_xmlObject->dynamic_post_location_address ) ) {
			$cs_location_address .= $jobcareer_xmlObject->dynamic_post_location_address;
		}
		return $cs_location_address;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_location_address', 'jobcareer_location_address_render' );
}
//=====================================================================
// post hidden
//=====================================================================
if ( ! function_exists( 'jobcareer_hidden_render' ) ) {

	function jobcareer_hidden_render( $atts, $content = "" ) {

		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_hidden = '';
		if ( $icon ) {
			$cs_hidden .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_hidden .= $title;
		}

		if ( isset( $name ) ) {
			$name = trim( $name );
			$cs_hidden .= $jobcareer_xmlObject->$name;
		}
		return $cs_hidden;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_hidden', 'jobcareer_hidden_render' );
}
//=====================================================================
// post dropdown option
//=====================================================================
if ( ! function_exists( 'jobcareer_post_dropdown_render' ) ) {

	function jobcareer_post_dropdown_render( $atts, $content = "" ) {

		global $post, $jobcareer_node;
		$defaults = array( 'name' => '', 'title' => '', 'icon' => '' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_post_dropdown = '';
		if ( $icon ) {
			$cs_post_dropdown .= '<i class="fa ' . $icon . '"></i>';
		}
		if ( $title ) {
			$cs_post_dropdown .= $title;
		}
		if ( isset( $name ) ) {
			$name = trim( $name );
			$cs_post_dropdown .= $jobcareer_xmlObject->$name;
		}
		return $cs_post_dropdown;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_dropdown', 'jobcareer_post_dropdown_render' );
}
//=====================================================================
// buy tickers
//=====================================================================
if ( ! function_exists( 'jobcareer_buytickets_render' ) ) {

	function jobcareer_buytickets_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'icon' => 'icon-map-marker', 'title' => '', 'link' => '#map' );
		extract( shortcode_atts( $defaults, $atts ) );
		$post_xml = get_post_meta( $post->ID, "dynamic_cusotm_post", true );
		global $jobcareer_xmlObject;
		if ( $post_xml <> "" ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $post_xml );
		}
		$cs_location_address = '';
		if ( isset( $jobcareer_xmlObject->dynamic_post_location_address_icon ) ) {
			$cs_location_address .= '<i class="fa ' . $jobcareer_xmlObject->dynamic_post_location_address_icon . '"></i>';
		}
		if ( isset( $jobcareer_xmlObject->dynamic_post_location_address ) ) {
			$cs_location_address .= $jobcareer_xmlObject->dynamic_post_location_address;
		}
		return $cs_location_address;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_buytickets', 'jobcareer_buytickets_render' );
}
//=====================================================================
// user wishlist
//=====================================================================
if ( ! function_exists( 'jobcareer_wishlist_render' ) ) {

	function jobcareer_wishlist_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'icon' => 'icon-plus', 'title' => esc_html__( 'Save', 'jobcareer' ) );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$post_data = ob_get_clean();
		return $post_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_wishlist', 'jobcareer_wishlist_render' );
}
//=====================================================================
// wishlist listing
//=====================================================================
if ( ! function_exists( 'jobcareer_wishlist_listing_render' ) ) {

	function jobcareer_wishlist_listing_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'icon' => 'icon-plus', 'title' => esc_html__( 'Save', 'jobcareer' ) );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$post_data = ob_get_clean();
		return $post_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_wishlisting', 'jobcareer_wishlist_listing_render' );
}
//=====================================================================
// like counter
//=====================================================================
if ( ! function_exists( 'jobcareer_likecounter_render' ) ) {

	function jobcareer_likecounter_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'icon' => 'icon-plus', 'title' => esc_html__( 'Save', 'jobcareer' ) );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$post_data = ob_get_clean();
		return $post_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_likecounter', 'jobcareer_likecounter_render' );
}
//=====================================================================
// User Rating 
//=====================================================================
if ( ! function_exists( 'jobcareer_user_rating_render' ) ) {

	function jobcareer_user_rating_render( $atts, $content = "" ) {
		global $post;
		$defaults = array( 'icon' => 'icon-plus', 'title' => esc_html__( 'Save', 'jobcareer' ) );
		extract( shortcode_atts( $defaults, $atts ) );
		ob_start();
		$post_data = ob_get_clean();
		return $post_data;
	}

	if ( function_exists( 'cs_short_code' ) )
		cs_short_code( 'cs_user_rating', 'jobcareer_user_rating_render' );
}

//=====================================================================
// Shortcode Array Start
//=====================================================================
if ( ! function_exists( 'jobcareer_shortcode_names' ) ) {

	function jobcareer_shortcode_names() {
		global $post;
		$dcpt_elements_array = array();
		$shortcode_array = array(
			'accordion' => array(
				'title' => esc_html__( 'Accordion', 'jobcareer' ),
				'name' => 'accordion',
				'icon' => 'icon-list-ul',
				'categories' => 'commonelements',
			),
			'blog' => array(
				'title' => esc_html__( 'Blog', 'jobcareer' ),
				'name' => 'blog',
				'icon' => 'icon-newspaper',
				'categories' => 'loops',
			),
			'button' => array(
				'title' => esc_html__( 'Button', 'jobcareer' ),
				'name' => 'button',
				'icon' => 'icon-hand-o-up',
				'categories' => 'commonelements',
			),
			'call_to_action' => array(
				'title' => esc_html__( 'Call to Action', 'jobcareer' ),
				'name' => 'call_to_action',
				'icon' => 'icon-info-circle',
				'categories' => 'commonelements',
			),
			'clients' => array(
				'title' => esc_html__( 'Clients', 'jobcareer' ),
				'name' => 'clients',
				'icon' => 'icon-user3',
				'categories' => 'loops',
			),
			'gallery' => array(
				'title' => esc_html__( 'Gallery', 'jobcareer' ),
				'name' => 'gallery',
				'icon' => 'icon-gallery',
				'categories' => 'loops',
			),
			'contactform' => array(
				'title' => esc_html__( 'Contact Form', 'jobcareer' ),
				'name' => 'contactform',
				'icon' => 'icon-building-o',
				'categories' => 'contentblocks',
			),
			'flex_editor' => array(
				'title' => esc_html__( 'Editor', 'jobcareer' ),
				'name' => 'flex_editor',
				'icon' => 'icon-clock-o',
				'categories' => 'commonelements',
			),
			'divider' => array(
				'title' => esc_html__( 'Divider', 'jobcareer' ),
				'name' => 'divider',
				'icon' => 'icon-ellipsis-h',
				'categories' => 'typography misc',
			),
			'flex_column' => array(
				'title' => esc_html__( 'Column', 'jobcareer' ),
				'name' => 'flex_column',
				'icon' => 'icon-columns',
				'categories' => 'typography misc',
			),
			'heading' => array(
				'title' => esc_html__( 'Heading', 'jobcareer' ),
				'name' => 'heading',
				'icon' => 'icon-h-square',
				'categories' => 'typography misc',
			),
			'newsletter' => array(
				'title' => esc_html__( 'Newsletter', 'jobcareer' ),
				'name' => 'newsletter',
				'icon' => 'icon-news',
				'categories' => 'typography misc',
			),
			'infobox' => array(
				'title' => esc_html__( 'Info box', 'jobcareer' ),
				'name' => 'infobox',
				'icon' => 'icon-info-circle',
				'categories' => ' contentblocks',
			),
			'image' => array(
				'title' => esc_html__( 'Image Frame', 'jobcareer' ),
				'name' => 'image',
				'icon' => 'icon-photo2',
				'categories' => 'mediaelement',
			),
			'list' => array(
				'title' => esc_html__( 'List', 'jobcareer' ),
				'name' => 'list',
				'icon' => 'icon-list-ol',
				'categories' => 'typography misc    ',
			),
			'map' => array(
				'title' => esc_html__( 'Map', 'jobcareer' ),
				'name' => 'map',
				'icon' => 'icon-list-ol',
				'categories' => 'contentblocks',
			),
			'icon_box' => array(
				'title' => esc_html__( 'Icon Boxes', 'jobcareer' ),
				'name' => 'icon_box',
				'icon' => 'icon-database2',
				'categories' => 'loops misc',
			),
			'multiple_team' => array(
				'title' => esc_html__( 'Team', 'jobcareer' ),
				'name' => 'multiple_team',
				'icon' => 'icon-user',
				'categories' => 'loops misc',
			),
			'progressbars' => array(
				'title' => esc_html__( 'Progress Bars', 'jobcareer' ),
				'name' => 'progressbars',
				'icon' => 'icon-list-alt',
				'categories' => ' commonelements',
			),
			'quotes' => array(
				'title' => esc_html__( 'Quote', 'jobcareer' ),
				'name' => 'quotes',
				'icon' => 'icon-image2',
				'categories' => 'loops',
			),
			'tabs' => array(
				'title' => esc_html__( 'Tabs', 'jobcareer' ),
				'name' => 'tabs',
				'icon' => 'icon-list-alt',
				'categories' => 'commonelements',
			),
			'testimonials' => array(
				'title' => esc_html__( 'Testimonials', 'jobcareer' ),
				'name' => 'testimonials',
				'icon' => 'icon-comments-o',
				'categories' => 'typography misc',
			),
			'multi_price_table' => array(
				'title' => esc_html__( 'Price Table', 'jobcareer' ),
				'name' => 'multi_price_table',
				'icon' => 'icon-comments-o',
				'categories' => 'typography misc',
			),
			'multi_counters' => array(
				'title' => esc_html__( 'Counters', 'jobcareer' ),
				'name' => 'multi_counters',
				'icon' => 'icon-comments-o',
				'categories' => 'typography misc',
			),
			'table' => array(
				'title' => esc_html__( 'Table', 'jobcareer' ),
				'name' => 'table',
				'icon' => 'icon-th',
				'categories' => 'commonelements',
			),
			'video' => array(
				'title' => esc_html__( 'Video', 'jobcareer' ),
				'name' => 'video',
				'icon' => 'icon-th',
				'categories' => 'commonelements',
			),
			/*
			  'about' => array(
			  'title' => esc_html__('About US', 'jobcareer'),
			  'name' => 'about',
			  'icon' => 'icon-th',
			  'categories' => 'commonelements',
			  ),
			 * */
			'tweets' => array(
				'title' => esc_html__( 'Tweets', 'jobcareer' ),
				'name' => 'tweets',
				'icon' => 'icon-twitter2',
				'categories' => 'loops',
			),
			'spacer' => array(
				'title' => esc_html__( 'Spacer', 'jobcareer' ),
				'name' => 'spacer',
				'icon' => 'icon-arrows-v',
				'categories' => 'commonelements',
			),
			'sitemap' => array(
				'title' => esc_html__( 'Site Map', 'jobcareer' ),
				'name' => 'sitemap',
				'icon' => 'icon-arrows-v',
				'categories' => 'commonelements',
			),
			'faq' => array(
				'title' => esc_html__( 'FAQ', 'jobcareer' ),
				'name' => 'faq',
				'icon' => 'icon-question-circle',
				'categories' => 'typography',
			),
		);

		if ( class_exists( 'wp_jobhunt' ) ) {

			$shortcode_array['cv_package'] = array(
				'title' => esc_html__( 'JC: CV Package', 'jobcareer' ),
				'name' => 'cv_package',
				'icon' => 'icon-table',
				'categories' => 'loops misc',
			);

			$shortcode_array['job_package'] = array(
				'title' => esc_html__( 'JC: Job Package', 'jobcareer' ),
				'name' => 'job_package',
				'icon' => 'icon-table',
				'categories' => 'loops misc',
			);

			$shortcode_array['job_specialisms'] = array(
				'title' => esc_html__( 'JC: Job Specialisms', 'jobcareer' ),
				'name' => 'job_specialisms',
				'icon' => 'icon-table',
				'categories' => 'loops misc',
			);

			$shortcode_array['jobs_search'] = array(
				'title' => esc_html__( 'JC: Job Search', 'jobcareer' ),
				'name' => 'jobs_search',
				'icon' => 'icon-table',
				'categories' => 'loops misc',
			);

			$shortcode_array['candidate'] = array(
				'title' => esc_html__( 'JC: Candidate', 'jobcareer' ),
				'name' => 'candidate',
				'icon' => 'icon-home',
				'categories' => 'loops misc',
			);

			$shortcode_array['employer'] = array(
				'title' => esc_html__( 'JC: Employer', 'jobcareer' ),
				'name' => 'employer',
				'icon' => 'icon-home',
				'categories' => 'loops misc',
			);
			$shortcode_array['jobs'] = array(
				'title' => esc_html__( 'JC: Jobs', 'jobcareer' ),
				'name' => 'jobs',
				'icon' => 'icon-home',
				'categories' => 'loops misc',
			);
			$shortcode_array['job_post'] = array(
				'title' => esc_html__( 'JC: Job Post', 'jobcareer' ),
				'name' => 'job_post',
				'icon' => 'icon-home',
				'categories' => 'loops misc',
			);
			$shortcode_array['register'] = array(
				'title' => esc_html__( 'JC: Register', 'jobcareer' ),
				'name' => 'register',
				'icon' => 'icon-home',
				'categories' => 'loops misc',
			);
		}

		if ( class_exists( 'cs_framework' ) ) {
			$plugin_shortcodes = array(
					// do something
			);
			$shortcode_array = array_merge( $shortcode_array, $plugin_shortcodes );
		}



		ksort( $shortcode_array );
		return $shortcode_array;
	}

}

//=====================================================================
// Shortcode Buttons
//=====================================================================
// Only register media button when get_current_screen() is available and
// current page's post type is not 'jh-templates'
add_action( 'current_screen', 'this_screen_callback' );

function this_screen_callback() {
	$current_screen = get_current_screen();

	if ( 'jh-templates' != $current_screen->post_type ) {
		//remove_action( 'media_buttons', 'jobcareer_shortcode_popup',5 );
		add_action( 'media_buttons', 'jobcareer_shortcode_popup', 11 );
	}
}

// 
if ( ! function_exists( 'jobcareer_shortcode_popup' ) ) {

	function jobcareer_shortcode_popup( $die = 0, $shortcode = 'shortcode' ) {
		global $jobcareer_form_fields;
		$i = 1;
		$style = '';
		if ( isset( $_POST['action'] ) ) {
			$name = $_POST['action'];
			$cs_counter = $_POST['counter'];
			$randomno = jobcareer_generate_random_string( '5' );
			$rand = rand( 1, 999 );
			$style = '';
		} else {
			$name = '';
			$cs_counter = '';
			$rand = rand( 1, 999 );
			$randomno = jobcareer_generate_random_string( '5' );
			if ( isset( $_REQUEST['action'] ) )
				$name = $_REQUEST['action'];
			$style = 'style="display:none;"';
		}
		$cs_page_elements_name = array();
		$cs_page_elements_name = jobcareer_shortcode_names();
		$cs_page_categories_name = jobcareer_elements_categories();

		$cs_insert_btn = true;
		$screen = get_current_screen();
		if ( is_admin() && isset( $screen->parent_file ) && $screen->parent_file == 'users.php' ) {
			$cs_insert_btn = false;
		}
		?> 
		<div class="cs-page-composer  <?php echo sanitize_html_class( $shortcode ); ?> composer-<?php echo intval( $rand ) ?>" id="composer-<?php echo intval( $rand ) ?>" style="display:none">
			<div class="page-elements">
				<div class="cs-heading-area">
					<h5>
						<i class="icon-plus-circle"></i> <?php esc_html_e( 'Add Element', 'jobcareer' ); ?>
					</h5>
					<span class='cs-btnclose' onclick='javascript:removeoverlay("composer-<?php echo esc_js( $rand ) ?>", "append")'>
						<i class="icon-times"></i>
					</span>
				</div>
				<script>
			    jQuery(document).ready(function ($) {
				cs_page_composer_filterable('<?php echo esc_js( $rand ) ?>');
			    });
				</script>
				<div class="cs-filter-content shortcode">
					<p>
						<?php
						$cs_opt_array = array(
							'std' => '',
							'cust_id' => 'quicksearch' . $rand,
							'extra_atr' => ' placeholder="' . esc_html__( 'Search', 'jobcareer' ) . '"',
							'cust_name' => '',
							'required' => false,
						);
						$jobcareer_form_fields->cs_form_text_render( $cs_opt_array );
						?>
					</p>
					<div class="cs-filtermenu-wrap">
						<h6><?php esc_html_e( 'Filter by', 'jobcareer' ); ?></h6>
						<ul class="cs-filter-menu" id="filters<?php echo intval( $rand ) ?>">
							<li data-filter="all" class="active"><?php esc_html_e( 'Show all', 'jobcareer' ); ?></li>
							<?php
							foreach ( $cs_page_categories_name as $key => $value ) {
								echo '<li data-filter="' . $key . '">' . $value . '</li>';
							}
							?>
						</ul>
					</div>
					<div class="cs-filter-inner" id="page_element_container<?php echo intval( $rand ) ?>">
						<?php
						foreach ( $cs_page_elements_name as $key => $value ) {
							echo '<div class="element-item ' . $value['categories'] . ' pb_' . esc_js( $key ) . '">';
							$icon = isset( $value['icon'] ) ? $value['icon'] : 'accordion-icon';
							?>
							<a href='javascript:cs_shortocde_selection("<?php echo esc_js( $key ); ?>","<?php echo admin_url( 'admin-ajax.php' ); ?>","composer-<?php echo intval( $rand ) ?>")'><?php jobcareer_page_composer_elements( $value['title'], $icon ) ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="cs-page-composer-shortcode"></div>
		</div>
		<?php
		if ( isset( $shortcode ) && $shortcode <> '' && $cs_insert_btn ) {
			?>
			<a class="button" href="javascript:_createpop('composer-<?php echo esc_js( $rand ) ?>', 'filter')">
				<i class="icon-plus-circle"></i> <?php esc_html_e( 'CS: Insert shortcode', 'jobcareer' ); ?></a>
			<?php
		}
	}

}
//=====================================================================
// Column Size Dropdown Function Start
//=====================================================================
if ( ! function_exists( 'jobcareer_shortcode_element_size' ) ) {

	function jobcareer_shortcode_element_size( $column_size = '' ) {
		global $jobcareer_html_fields;
		$cs_opt_array = array(
			'name' => esc_html__( 'Size', 'jobcareer' ),
			'desc' => '',
			'hint_text' => esc_html__( 'Select column width. This width will be calculated depend page width', 'jobcareer' ),
			'echo' => true,
			'field_params' => array(
				'std' => $column_size,
				'cust_id' => 'column_size',
				'cust_type' => 'button',
				'classes' => 'column_size chosen-select',
				'cust_name' => 'column_size[]',
				'extra_atr' => '',
				'options' => array(
					'1/1' => esc_html__( '1 Column', 'jobcareer' ),
					'1/2' => esc_html__( '2 Columns', 'jobcareer' ),
					'1/3' => esc_html__( '3 Columns', 'jobcareer' ),
					'1/4' => esc_html__( '4 Columns', 'jobcareer' ),
					'1/6' => esc_html__( '6 Columns', 'jobcareer' ),
				),
				'return' => true,
			),
		);

		$jobcareer_html_fields->cs_select_field( $cs_opt_array );
		?>


		<?php
	}

}
/*
 * Column Size Dropdown Function end
 */
if ( ! function_exists( 'jobcareer_animation_style' ) ) {

	function jobcareer_animation_style() {
		return $animation_style = array(
			'Entrances' => array( 'slideDown' => 'slideDown', 'slideUp' => 'slideUp', 'slideLeft' => 'slideLeft', 'slideRight' => 'slideRight', 'slideExpandUp' => 'slideExpandUp', 'expandUp' => 'expandUp', 'expandOpen' => 'expandOpen', 'bigEntrance' => 'bigEntrance', 'hatch' => 'hatch' ),
			'Misc' => array( 'floating' => 'floating', 'tossing' => 'tossing', 'pullUp' => 'pullUp', 'pullDown' => 'pullDown', 'stretchLeft' => 'stretchLeft', 'stretchRight' => 'stretchRight' ),
			'Attention Candidates' => array( 'bounce' => 'bounce', 'flash' => 'flash', 'pulse' => 'pulse', 'rubberBand' => 'rubberBand', 'shake' => 'shake', 'swing' => 'swing', 'tada' => 'tada', 'wobble' => 'wobble' ),
			'Bouncing Entrances' => array( 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp' ),
			'Fading Entrances' => array( 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig' ),
			'Flippers' => array( 'flip' => 'flip', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY' ),
			'Lightspeed' => array( 'lightSpeedIn' => 'lightSpeedIn' ),
			'Rotating Entrances' => array( 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight' ),
			'Specials' => array( 'hinge' => 'hinge', 'rollIn' => 'rollIn' ),
			'Zoom Entrances' => array( 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp' ),
		);
	}

}

//=====================================================================
// Custom Class and Animations Function Start
//=====================================================================
if ( ! function_exists( 'jobcareer_shortcode_custom_classes' ) ) {

	function jobcareer_shortcode_custom_classes( $cs_custom_class = '', $cs_custom_animation = '', $cs_custom_animation_duration = '1' ) {
		global $jobcareer_html_fields;
		$cs_opt_array = array(
			'name' => esc_html__( 'Custom Id', 'jobcareer' ),
			'desc' => '',
			'hint_text' => esc_html__( 'Use this option if you want to use specified Class for this element', 'jobcareer' ),
			'echo' => true,
			'field_params' => array(
				'std' => sanitize_text_field( $cs_custom_class ),
				'cust_id' => '',
				'cust_type' => 'cs_custom_class[]',
				'classes' => 'txtfield',
				'cust_name' => 'column_size[]',
				'extra_atr' => '',
				'return' => true,
			),
		);
		$jobcareer_html_fields->cs_text_field( $cs_opt_array );

		$custom_animation_array = array( 'fade' => esc_html__( 'Fade', 'jobcareer' ), 'slide' => esc_html__( 'Slide', 'jobcareer' ), 'left-slide' => esc_html__( 'left Slide', 'jobcareer' ) );
		$animation_array_option = '';
		$animation_array = jobcareer_animation_style();
		foreach ( $animation_array as $animation_key => $animation_value ) {
			foreach ( $animation_value as $key => $value ) {
				$animation_array_option[$key] = $value;
			}
		}

		$cs_opt_array = array(
			'name' => esc_html__( 'Animation Class', 'jobcareer' ),
			'desc' => '',
			'hint_text' => esc_html__( "Select Entrance animation type from the dropdown", 'jobcareer' ),
			'echo' => true,
			'field_params' => array(
				'std' => $cs_custom_animation,
				'id' => '',
				'cust_name' => 'cs_custom_animation[]',
				'classes' => 'dropdown chosen-select',
				'options' => $animation_array_option,
				'return' => true,
			),
		);

		$jobcareer_html_fields->cs_select_field( $cs_opt_array );
	}

}
// Custom Class and Animations Function end
//=====================================================================
// Dynamic Custom Class and Animations Function Start
//=====================================================================
if ( ! function_exists( 'jobcareer_shortcode_custom_dynamic_classes' ) ) {

	function jobcareer_shortcode_custom_dynamic_classes( $cs_custom_class = '', $cs_custom_animation = '', $cs_custom_animation_duration = '1', $prefix ) {

		global $jobcareer_html_fields;

		$cs_opt_array = array(
			'name' => esc_html__( 'Custom Id', 'jobcareer' ),
			'desc' => '',
			'hint_text' => esc_html__( 'Use this option if you want to use specified id for this element', 'jobcareer' ),
			'echo' => true,
			'field_params' => array(
				'std' => $cs_custom_class,
				'cust_id' => $prefix . '_class',
				'cust_name' => $prefix . '_class[]',
				'return' => true,
				'classes' => 'txtfield',
			),
		);

		$jobcareer_html_fields->cs_text_field( $cs_opt_array );

		$custom_animation_array = array( 'fade' => esc_html__( 'Fade', 'jobcareer' ), 'slide' => esc_html__( 'Slide', 'jobcareer' ), 'left-slide' => esc_html__( 'left Slide', 'jobcareer' ) );

		$cs_anim_options = '<option value="">' . esc_html__( 'Select Animation', 'jobcareer' ) . '</option>';

		$animation_array = jobcareer_animation_style();
		foreach ( $animation_array as $animation_key => $animation_value ) {
			$cs_anim_options .= '<optgroup label="' . $animation_key . '">';
			foreach ( $animation_value as $key => $value ) {
				$active_class = '';
				if ( $cs_custom_animation == $key ) {
					$active_class = 'selected="selected"';
				}
				$cs_anim_options .= '<option value="' . $key . '" ' . $active_class . '>' . $value . '</option>';
			}
		}

		$cs_opt_array = array(
			'name' => esc_html__( 'Animation Class', 'jobcareer' ),
			'desc' => '',
			'hint_text' => esc_html__( 'Select Entrance animation type from the dropdown', 'jobcareer' ),
			'echo' => true,
			'field_params' => array(
				'std' => $cs_custom_animation,
				'cust_id' => $prefix . '_animation',
				'cust_name' => $prefix . '_animation[]',
				'return' => true,
				'options_markup' => true,
				'options' => $cs_anim_options,
				'classes' => 'dropdown',
			),
		);

		$jobcareer_html_fields->cs_select_field( $cs_opt_array );
	}

}
// Dynamic Custom Class and Animations Function end
//=====================================================================
// Shortcode Add box Ajax Function
//=====================================================================
if ( ! function_exists( 'jobcareer_shortcode_element_ajax_call' ) ) {

	function jobcareer_shortcode_element_ajax_call() {
		global $cs_html_fields, $jobcareer_html_fields, $jobcareer_form_fields;
		$sh_code = isset( $_POST['sh_code'] ) ? $_POST['sh_code'] : '';
		?>
		<?php
		if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] ) {
			if ( $_POST['shortcode_element'] == 'accordions' ) {
				$rand_id = rand( 324235, 993249 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Accordion', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Active', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "You can set the accordion section that is open by default on frontend by select dropdown", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => '',
							'cust_name' => 'accordion_active[]',
							'classes' => 'dropdown chosen-select',
							'options' => array(
								'yes' => esc_html__( 'Yes', 'jobcareer' ),
								'no' => esc_html__( 'No', 'jobcareer' ),
							),
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Accordion Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add accordion title here.', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'accordion_title',
							'cust_name' => 'accordion_title[]',
							'classes' => '',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>

					<div class="form-elements"  id="<?php echo intval( $rand_id ); ?>">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label> <?php esc_html_e( "Font awsome Icon:", 'jobcareer' ); ?></label>
							<?php
							if ( function_exists( 'jobcareer_tooltip_text' ) ) {
								echo jobcareer_tooltip_text( esc_html__( 'Select the Icons you would like to show with your accordion title.', 'jobcareer' ) );
							}
							?>

						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<?php jobcareer_fontawsome_icons_box( '', $rand_id, 'cs_accordian_icon' ); ?>
							<p></p>
						</div>
					</div>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Accordion Content', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add accordion content here.', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'accordion_text',
							'cust_name' => 'accordion_text[]',
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'classes' => 'txtfield',
							'cs_editor' => true,
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<script>

				    /*
				     * modern selection box function
				     */
				    jQuery(document).ready(function ($) {
					chosen_selectionbox();
					popup_over();
				    });
				    /*
				     * modern selection box function
				     */


				</script> 
				<?php
			} else if ( $_POST['shortcode_element'] == 'faq' ) {
				$rand_id = rand( 32433245, 99234239 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'FAQ', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Style', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "You can set the FAQ section that is open by default on frontend by select dropdown..", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => '',
							'cust_id' => '',
							'cust_name' => 'faq_active[]',
							'classes' => 'chosen-select-no-single select-medium',
							'options' => array(
								'yes' => esc_html__( 'Yes', 'jobcareer' ),
								'no' => esc_html__( 'No', 'jobcareer' ),
							),
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );
					?>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Add FAQ title here.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => 'txtfield',
							'cust_name' => 'faq_title[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Content', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter content here.', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => 'txtfield',
							'cust_name' => 'faq_text[]',
							'return' => true,
							'cs_editor' => true,
							'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<script>
				    /*
				     * modern selection box function
				     */
				    jQuery(document).ready(function ($) {
					chosen_selectionbox();
					popup_over();
				    });
				    /*
				     * modern selection box function
				     */

				</script>
				<?php
			} else if ( $_POST['shortcode_element'] == 'register' ) {
				$rand_id = rand( 5, 999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Register', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Register Title:', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'register_title',
							'cust_name' => 'register_title[]',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'User Role:', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'register_role',
							'cust_name' => 'register_role[]',
							'return' => true,
							'options' => array(
								'subscriber' => esc_html__( 'Subscriber', 'jobcareer' ),
								'staff' => esc_html__( 'Staff', 'jobcareer' ),
								'member' => esc_html__( 'Member', 'jobcareer' ),
								'instructor' => esc_html__( 'Instructor', 'jobcareer' ),
								'customer' => esc_html__( 'Customer', 'jobcareer' ),
								'contributor' => esc_html__( 'Contributor', 'jobcareer' ),
								'author' => esc_html__( 'Author', 'jobcareer' ),
								'editor' => esc_html__( 'Editor', 'jobcareer' ),
								'administrator' => esc_html__( 'Administrator', 'jobcareer' ),
							),
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Register Text:', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'register_text',
							'cust_name' => 'register_text[]',
							'return' => true,
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<?php
			} else if ( $_POST['shortcode_element'] == 'tabs' ) {
				$rand_id = rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Tab', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Active', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "You can set the tab section that is open by default on frontend by select dropdown", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => '',
							'cust_name' => 'tab_active[]',
							'classes' => 'chosen-select-no-single',
							'options' => array(
								'no' => esc_html__( 'No', 'jobcareer' ),
								'yes' => esc_html__( 'Yes', 'jobcareer' ),
							),
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Tab Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter tab title here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'tab_title',
							'cust_name' => 'tab_title[]',
							'classes' => '',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>

					<div class="form-elements" id="<?php echo intval( $rand_id ); ?>">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label><?php esc_html_e( 'Tab Fonta wesome Icon', 'jobcareer' ); ?></label>
							<?php
							if ( function_exists( 'jobcareer_tooltip_text' ) ) {
								echo jobcareer_tooltip_text( esc_html__( 'Choose icon for this tab. It appear with title.', 'jobcareer' ) );
							}
							?>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<?php jobcareer_fontawsome_icons_box( '', $rand_id, 'cs_tab_icon' ); ?>
							<p></p>
						</div>
					</div>


					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Tab Text', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Insert tab detail text here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'tab_text',
							'cust_name' => 'tab_text[]',
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'classes' => 'txtfield',
							'cs_editor' => true,
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<script>


				    /*
				     * modern selection box function
				     */
				    jQuery(document).ready(function ($) {
					chosen_selectionbox();
					popup_over();
				    });
				    /*
				     * modern selection box function
				     */

				</script>
				<?php
			} else if ( $_POST['shortcode_element'] == 'testimonials' ) {
				global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
				$rand_id = rand( 324335, 9234299 );
				$rand_id_ = rand( 324321, 9234299 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Testimonial', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Text', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter testimonial text here.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
							'cust_name' => 'testimonial_text[]',
							'cs_editor' => true,
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Author', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter testimonial author name here", 'jobcareer' ),
						'echo' => true,
						'classes' => 'txtfield',
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'cust_name' => 'testimonial_author[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Company', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter company name of author here", 'jobcareer' ),
						'echo' => true,
						'classes' => 'txtfield',
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'cust_name' => 'testimonial_company[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'std' => '',
						'id' => 'testimonial_img_user',
						'name' => esc_html__( 'Image', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'array' => true,
						'prefix' => '',
						'field_params' => array(
							'std' => '',
							'id' => 'testimonial_img_user',
							'return' => true,
							'array' => true,
							'array_txt' => false,
							'prefix' => '',
						),
					);
					if ( $sh_code == 1 ) {
						$cs_opt_array['cus_rand_id'] = ( string ) jobcareer_generate_random_string( 6 );
					}

					$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );
					?>

				</div>
				<script>popup_over();</script>
				<?php
			} else if ( $_POST['shortcode_element'] == 'multi_price_table' ) {
				$rand_id = rand( 324335, 9234299 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Price Table', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( ' Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter  Title Here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_text',
							'cust_name' => 'multi_price_table_text[]',
							'classes' => '',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Title Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Set price-table title color from here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_title_color',
							'cust_name' => 'multi_price_table_title_color[]',
							'classes' => 'bg_color',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( ' Price', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add price without symbol', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_pricetable_price',
							'cust_name' => 'multi_pricetable_price[]',
							'classes' => 'txtfield',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( ' Currency Symbols', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add your currency symbol here like $', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_currency',
							'cust_name' => 'multi_price_table_currency[]',
							'classes' => 'txtfield',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Time Duration', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add time duration for package or time range like this package for a month or year So write here for Monthly and yearly for Yearly Package', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_time_duration',
							'cust_name' => 'multi_price_table_time_duration[]',
							'classes' => 'txtfield',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Button Link', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add price table button Link here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'button_link',
							'cust_name' => 'button_link[]',
							'classes' => 'txtfield',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Button Text', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Add button text here Example : Buy Now, Purchase Now, View Packages etc', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_button_text',
							'cust_name' => 'multi_price_table_button_text[]',
							'classes' => 'txtfield',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Button Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Set button color with color picker', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_button_color',
							'cust_name' => 'multi_price_table_button_color[]',
							'classes' => 'bg_color',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Button Background Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Set button background color with color picker', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_button_column_color',
							'cust_name' => 'multi_price_table_button_column_color[]',
							'classes' => 'bg_color',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Featured on/off', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Price table featured option enable/disable with this dropdown", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => '',
							'cust_name' => 'pricetable_featured[]',
							'classes' => 'dropdown chosen-select',
							'options' => array(
								'Yes' => esc_html__( 'Yes', 'jobcareer' ),
								'No' => esc_html__( 'No', 'jobcareer' ),
							),
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Description', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Features can be add easily in input with this shortcode 
						[feature_item]Text here[/feature_item][feature_item]Text here[/feature_item]", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => '',
							'cs_editor' => true,
							'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
							'cust_name' => 'pricing_features[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Column Background Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Set price-table title color from here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'multi_price_table_column_bgcolor',
							'cust_name' => 'multi_price_table_column_bgcolor[]',
							'classes' => 'bg_color',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>
				</div> 
				</div>
				<script>

				    /*
				     * modern selection box function
				     */
				    jQuery(document).ready(function ($) {
					chosen_selectionbox();
					popup_over();
				    });
				    /*
				     * modern selection box function
				     */
				</script>



				<?php
			} else if ( $_POST['shortcode_element'] == 'multi_counters' ) {
				$counter_count = rand( 0215, 9234299 );
				$rand_string = rand( 324335, 9234299 );
				$counter_style = 'icon';
				$counter_icon_type = 'icon';
				?>

				<div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="cs_infobox_<?php echo intval( $rand_string ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Counter', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>

					<div class="selected_icon_type<?php echo esc_attr( $counter_count ) ?>" id="selected_view_icon_icon_type<?php echo esc_attr( $counter_count ) ?>" <?php
					if ( $counter_style == "icon-border" || $counter_icon_type == "icon" ) {
						echo 'style="display:block"';
					} else {
						echo 'style="display:block"';
					}
					?>>
						<div class="form-elements" id="<?php echo intval( $rand_string ); ?>">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label><?php esc_html_e( 'Font awsome Icon:', 'jobcareer' ); ?></label>
								<?php
								if ( function_exists( 'jobcareer_tooltip_text' ) ) {
									echo jobcareer_tooltip_text( esc_html__( 'Choose icon for counter.', 'jobcareer' ) );
								}
								?>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php jobcareer_fontawsome_icons_box( '', $rand_string, 'counter_icon' ); ?>
								<p></p>
							</div>
						</div>

					</div>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter title of counter icon.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => 'txtfield',
							'cust_name' => 'counter_title[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Number', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Set counting numbers for count", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'counter_numbers[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Content', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'cust_name' => 'counter_text_content[]',
							'cs_editor' => true,
							'cust_id' => '',
							'classes' => '',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<script>

				    /*
				     * modern selection box function
				     */
				    jQuery(document).ready(function ($) {
					chosen_selectionbox();
					popup_over();
				    });
				    /*
				     * modern selection box function
				     */

				</script> 
				<?php
			} else if ( $_POST['shortcode_element'] == 'counter' ) {
				$counter_count = rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $counter_count ); ?>">
					<header><h4><i class='icon-arrows'></i><?php esc_html_e( 'Counter', 'jobcareer' ); ?></h4> <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a></header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Counter Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_title',
							'cust_name' => 'counter_title[]',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Type', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_style',
							'cust_name' => 'counter_style[]',
							'return' => true,
							'options' => array(
								'one' => esc_html__( 'Counter Style One', 'jobcareer' ),
								'two' => esc_html__( 'Counter Style Two', 'jobcareer' ),
								'three' => esc_html__( 'Counter Style Three', 'jobcareer' ),
								'four' => esc_html__( 'Counter Style Four', 'jobcareer' ),
							),
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Choose Icon', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_icon_type',
							'cust_name' => 'counter_icon_type[]',
							'return' => true,
							'options' => array(
								'icon' => esc_html__( 'Icon', 'jobcareer' ),
								'image' => esc_html__( 'Image', 'jobcareer' ),
							),
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );

					$cs_output = $jobcareer_html_fields->cs_opening_field( array(
						'id' => $counter_count,
						'name' => esc_html__( 'Font awsome Icon:', 'jobcareer' ),
						'hint_text' => '',
							) );
					echo force_balance_tags( $cs_output );
					jobcareer_fontawsome_icons_box( '', $counter_count, 'counter_icon' );
					$cs_output = $jobcareer_html_fields->cs_closing_field( array(
						'desc' => '',
							) );
					echo force_balance_tags( $cs_output );

					$cs_opt_array = array(
						'std' => '',
						'id' => 'counter_logo',
						'name' => esc_html__( 'Image', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'array' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'counter_logo',
							'return' => true,
							'array' => true,
							'array_txt' => false,
						),
					);

					$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Background Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_bg_color',
							'cust_name' => 'counter_bg_color[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Numbers', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_numbers',
							'cust_name' => 'counter_numbers[]',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Count Text Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_text_color',
							'cust_name' => 'counter_text_color[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Link Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_icon_linktitle',
							'cust_name' => 'counter_icon_linktitle[]',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Link', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_icon_linkurl',
							'cust_name' => 'counter_icon_linkurl[]',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Button Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_link_bgcolor',
							'cust_name' => 'counter_link_bgcolor[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Text', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_text',
							'cust_name' => 'counter_text[]',
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Button Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'counter_link_bgcolor',
							'cust_name' => 'counter_link_bgcolor[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Custom Id', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'coutner_class',
							'cust_name' => 'coutner_class[]',
							'return' => true,
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>

				</div>
				<?php
			} else if ( $_POST['shortcode_element'] == 'list' ) {
				$rand_id = rand( 42130, 9999999 );
			
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'List Item', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<script>
	
				</script>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'List Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter list title', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => jobcareer_special_char( $cs_list_item ),
							'id' => 'cs_list_item',
							'cust_name' => 'cs_list_item[]',
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'classes' => '',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					$display = $cs_list_type == 'icon' ? 'block' : 'none';
					echo '<div class="list_icon_div" style=" display:' . $display . ' ">';
					?>
					<div class="icon_fields">
						<div class="form-elements" id="cs_infobox_<?php echo esc_attr( $name . $cs_counter ); ?>">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label> <?php esc_html_e( "Icon:", 'jobcareer' ); ?></label>
								<?php
								if ( function_exists( 'jobcareer_tooltip_text' ) ) {
									echo jobcareer_tooltip_text( 'Choose icon for list.' );
								}
								?>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php jobcareer_fontawsome_icons_box( $cs_list_icon, $rand_id, 'cs_list_icon' ); ?>
							</div>
						</div>

						<?php
						$cs_opt_array = array(
							'name' => esc_html__( 'Icon Color', 'jobcareer' ),
							'desc' => '',
							'hint_text' => esc_html__( 'Select Icon Color', 'jobcareer' ),
							'echo' => true,
							'field_params' => array(
								'std' => jobcareer_special_char( $cs_list_item_icon_color ),
								'id' => 'cs_list_item_icon_color',
								'cust_name' => 'cs_list_item_icon_color[]',
								'classes' => 'bg_color',
								'return' => true,
							),
						);
						$jobcareer_html_fields->cs_text_field( $cs_opt_array );

						$cs_opt_array = array(
							'name' => esc_html__( 'Icon Background Color', 'jobcareer' ),
							'desc' => '',
							'hint_text' => esc_html__( 'Select Icon Background Color', 'jobcareer' ),
							'echo' => true,
							'field_params' => array(
								'std' => jobcareer_special_char( $cs_list_item_icon_bg_color ),
								'id' => 'cs_list_item_icon_bg_color',
								'cust_name' => 'cs_list_item_icon_bg_color[]',
								'classes' => 'bg_color',
								'return' => true,
							),
						);
						$jobcareer_html_fields->cs_text_field( $cs_opt_array );
						echo '</div>';
						?>
					</div>
				</div>
				<script>
					jQuery("select#cs_list_type").change();
				    function cs_list_style_view(cs_list_style_data) {
					if (cs_list_style_data == 'icon') {
					    jQuery('.list_icon_div').show();
					} else {
					    jQuery('.list_icon_div').hide();
					}
				    }
				</script> 

				<?php
			} else if ( $_POST['shortcode_element'] == 'infobox_items' ) {
				global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
				$rand_id = rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header><h4><i class='icon-arrows'></i><?php esc_html_e( 'Info box Item(s)', 'jobcareer' ); ?></h4> 
						<a href='#' class='deleteit_node'>
							<i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?>
						</a>
					</header>



					<div class="form-elements" id="<?php echo intval( $rand_id ); ?>">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<label><?php esc_html_e( 'Info Box Font awesome Icon', 'jobcareer' ); ?></label>
							<?php
							if ( function_exists( 'jobcareer_tooltip_text' ) ) {
								echo jobcareer_tooltip_text( esc_html__( 'Select the Icons you would like to show in infobox section.', 'jobcareer' ) );
							}
							?>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<?php jobcareer_fontawsome_icons_box( '', $rand_id, 'cs_infobox_list_icon' ); ?>
							<p></p>
						</div>
					</div>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Infobox Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter the infobox title here', 'jobcareer' ),
						'echo' => true,
						'classes' => '',
						'field_params' => array(
							'std' => '',
							'id' => '',
							'cust_name' => 'cs_infobox_list_title[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );


					$cs_opt_array = array(
						'name' => esc_html__( 'Infobox Content', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter the content here', 'jobcareer' ),
						'echo' => true,
						'classes' => '',
						'field_params' => array(
							'std' => '',
							'id' => '',
							"extra_atr" => 'data-content-text="cs-shortcode-textarea"',
							'cust_name' => 'cs_infobox_list_description[]',
							'cs_editor' => true,
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<script>
				    /*
				     * popup over 
				     */
				    popup_over();
				    /*
				     *End popup over 
				     */
				</script> 
				<?php
			} else if ( $_POST['shortcode_element'] == 'audio' ) {
				$rand_id = 'clinets_' . rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Album Item(s)', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Track Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'classes' => '',
						'field_params' => array(
							'std' => '',
							'id' => 'album_track_title',
							'cust_name' => 'cs_album_track_title[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Track MP3 Url', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'classes' => '',
						'field_params' => array(
							'std' => '',
							'id' => 'album_track_mp3_url',
							'cust_name' => 'cs_album_track_mp3_url[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>

				</div>
				<?php
			} else if ( $_POST['shortcode_element'] == 'clients' ) {
				$clients_count = 'clinets_' . rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo jobcareer_special_char( $clients_count ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Client', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Website Url', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter your client URL.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_website_url[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>
					<?php
					$cs_opt_array = array(
						'std' => '',
						'id' => 'client_logo',
						'name' => esc_html__( 'Choose Logo', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Attach client logo here from media gallery.', 'jobcareer' ),
						'echo' => true,
						'array' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'id' => 'client_logo',
							'return' => true,
							'array' => true,
							'array_txt' => false,
						),
					);
					if ( $sh_code == 1 ) {
						$cs_opt_array['cus_rand_id'] = ( string ) jobcareer_generate_random_string( 6 );
					}
					$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );
					?>
				</div>
				<script>
				    /*
				     * popup over 
				     */
				    popup_over();
				    /*
				     *End popup over 
				     */
				</script> 

				<?php
			} else if ( $_POST['shortcode_element'] == 'gallery' ) {
				$gallery_count = 'gallery_' . rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo jobcareer_special_char( $gallery_count ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Gallery', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>

					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Website Url', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter your gallery URL.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_website_url[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Gallery Size', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Select gallery size", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => '',
							'cust_id' => 'cs_gallery_size',
							'cust_name' => 'cs_gallery_size[]',
							'classes' => 'chosen-select-no-single',
							'options' => array(
								'' => esc_html__( 'Please Select', 'jobcareer' ),
								'img-small' => esc_html__( 'Small', 'jobcareer' ),
								'img-larage' => esc_html__( 'Large', 'jobcareer' ),
							),
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_select_field( $cs_opt_array );
					?>
					<?php
					$cs_opt_array = array(
						'std' => '',
						'id' => 'gallery_logo',
						'name' => esc_html__( 'Choose Image', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Attach gallery image here from media .', 'jobcareer' ),
						'echo' => true,
						'array' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'id' => 'gallery_logo',
							'return' => true,
							'array' => true,
							'array_txt' => false,
						),
					);
					if ( $sh_code == 1 ) {
						$cs_opt_array['cus_rand_id'] = ( string ) jobcareer_generate_random_string( 6 );
					}
					$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );
					?>
				</div>
				<script>
				    /*
				     * popup over 
				     */
				    popup_over();
				    /*
				     *End popup over 
				     */
				</script> 

				<?php
			} else if ( $_POST['shortcode_element'] == 'icon_box' ) {
				$icon_box_count = 'icon_box_' . rand( 455345, 23454390 );
				if ( isset( $cs_icon_box_text ) && $cs_icon_box_text != '' ) {
					$cs_icon_box_text = $cs_icon_box_text;
				} else {
					$cs_icon_box_text = '';
				}
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo jobcareer_special_char( $icon_box_count ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Icon Box', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Icon Box Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Add icon_box title here..", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => 'cs_icon_box_title',
							'classes' => '',
							'cust_name' => 'cs_icon_box_title[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					?>

					<?php
					/*
					  $cs_opt_array = array(
					  'name' => esc_html__('Icon Box Title Color', 'jobcareer'),
					  'desc' => '',
					  'hint_text' => esc_html__("Set title color from here.", 'jobcareer'),
					  'echo' => true,
					  'field_params' => array(
					  'std' => '',
					  'cust_id' => 'cs_title_color',
					  'classes' => 'bg_color',
					  'cust_name' => 'cs_title_color[]',
					  'return' => true,
					  ),
					  );

					  $jobcareer_html_fields->cs_text_field($cs_opt_array);
					 */



					$cs_opt_array = array(
						'name' => esc_html__( 'Icon Type', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Select icon type image or font icon.', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'cs_icon_box_icon_type',
							'cust_name' => 'cs_icon_box_icon_type[]',
							'classes' => 'chosen-select-no-single select-medium function-class',
							'options' => array(
								'icon' => esc_html__( 'Icon', 'jobcareer' ),
								'image' => esc_html__( 'Image', 'jobcareer' ),
							),
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_select_field( $cs_opt_array );
					?>
					<div class="cs-sh-icon_box-image-area" style="display:<?php echo esc_html( $cs_icon_box_icon_type == 'image' ? 'block' : 'none'  ) ?>;">
						<?php
						$cs_opt_array = array(
							'std' => '',
							'id' => 'icon_box_image',
							'name' => esc_html__( 'Icon Box Image', 'jobcareer' ),
							'desc' => '',
							'hint_text' => esc_html__( 'Attach image from media gallery.', 'jobcareer' ),
							'echo' => true,
							'array' => true,
							'field_params' => array(
								'std' => '',
								'cust_id' => '',
								'id' => 'icon_box_image',
								'return' => true,
								'array' => true,
								'array_txt' => true,
							),
						);
						if ( $sh_code == 1 ) {
							$cs_opt_array['cus_rand_id'] = ( string ) jobcareer_generate_random_string( 6 );
						}
						$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );

						$rand_id = rand( 1111111, 9999999 );
						?>
					</div>
					<div class="cs-sh-icon_box-icon-area" style="display:<?php echo esc_html( $cs_icon_box_icon_type != 'image' ? 'block' : 'none'  ) ?>;">
						<div class="form-elements" id="cs_infobox_<?php echo esc_attr( $rand_id ); ?>">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<label><?php esc_html_e( 'Icon Box Icon', 'jobcareer' ); ?></label>
								<?php
								if ( function_exists( 'jobcareer_tooltip_text' ) ) {
									echo jobcareer_tooltip_text( esc_html__( 'Select the Icons you would like to show with your accordion title.', 'jobcareer' ) );
								}
								?>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<?php jobcareer_fontawsome_icons_box( '', $rand_id, 'cs_icon_box_icon' ); ?>
							</div>
						</div>
						<?php
						$cs_opt_array = array(
							'name' => esc_html__( 'Icon Color', 'jobcareer' ),
							'desc' => '',
							'hint_text' => esc_html__( 'Set the position of icon_box image here', 'jobcareer' ),
							'echo' => true,
							'field_params' => array(
								'std' => '',
								'id' => 'cs_icon_box_icon_color',
								'cust_name' => 'cs_icon_box_icon_color[]',
								'classes' => 'bg_color',
								'return' => true,
							),
						);

						//$jobcareer_html_fields->cs_text_field($cs_opt_array);
						?>
					</div>    
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Title Link', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Enter icon_box title link here', 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'cs_icon_box_link',
							'cust_name' => 'cs_icon_box_link[]',
							'classes' => 'txtfield',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );


					$rand_id = rand( 0, 85498749847 );


					$cs_opt_array = array(
						'name' => esc_html__( 'Icon Box Content', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter little description about icon_box.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'cust_id' => '',
							'classes' => 'txtfield',
							'cust_name' => 'cs_icon_box_text[]',
							'return' => true,
							'cs_editor' => true,
							'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					/*
					  $cs_opt_array = array(
					  'name' => esc_html__('Icon Box Content Color', 'jobcareer'),
					  'desc' => '',
					  'hint_text' => esc_html__('Provide a hex colour code here (with #) for text color. if you want to override the default.', 'jobcareer'),
					  'echo' => true,
					  'field_params' => array(
					  'std' => '',
					  'id' => 'cs_icon_box_content_color',
					  'cust_name' => 'cs_icon_box_content_color[]',
					  'classes' => 'bg_color',
					  'return' => true,
					  ),
					  );


					  $jobcareer_html_fields->cs_text_field($cs_opt_array);
					 */
					?>
				</div>
				<script>
				    jQuery('.function-class').change(function ($) {
					var value = jQuery(this).val();
					//alert('hello');
					var parentNode = jQuery(this).parent().parent().parent();
					if (value == 'image') {
					    //alert(parentNode);
					    parentNode.find(".cs-sh-icon_box-image-area").show();
					    parentNode.find(".cs-sh-icon_box-icon-area").hide();
					    /*
					 jQuery(".cs-sh-icon_box-image-area").show();
					 jQuery(".cs-sh-icon_box-icon-area").hide();
					 */
					} else {
					    parentNode.find(".cs-sh-icon_box-image-area").hide();
					    parentNode.find(".cs-sh-icon_box-icon-area").show();
					    /*
					 jQuery(".cs-sh-icon_box-image-area").hide();
					 jQuery(".cs-sh-icon_box-icon-area").show();
					 */
					}


				    }
				    );
				    /*
				     * modern selection box function
				     */
				    chosen_selectionbox();
				    /*
				     * modern selection box function
				     */

				    /*
				     * popup over 
				     */
				    popup_over();
				    /*
				     *End popup over 
				     */
				</script>
				<?php
			} else if ( $_POST['shortcode_element'] == 'multiple_team' ) {

				$multiple_team_count = 'multiple_team_' . rand( 455345, 23454390 );

				if ( isset( $cs_multiple_service_text ) && $cs_multiple_service_text != '' ) {
					$cs_multiple_service_text = $cs_multiple_service_text;
				} else {
					$cs_multiple_service_text = '';
				}
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo jobcareer_special_char( $multiple_team_count ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Team', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Name', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter team member name here.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => esc_attr( $cs_multi_team_name ),
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_multi_team_name[]',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );
					$cs_opt_array = array(
						'name' => esc_html__( 'Designation', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Enter team member designation here.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => esc_attr( $cs_multi_team_designation ),
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_multi_team_designation[]',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'std' => $cs_multi_team_image,
						'id' => 'multi_team_image',
						'name' => esc_html__( 'Team Profile Image', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( 'Attach image from media gallery.', 'jobcareer' ),
						'echo' => true,
						'array' => true,
						'field_params' => array(
							'std' => $cs_multi_team_image,
							'cust_id' => '',
							'id' => 'multi_team_image',
							'return' => true,
							'array' => true,
							'array_txt' => false,
						),
					);
					if ( $sh_code == 1 ) {
						$cs_opt_array['cus_rand_id'] = ( string ) jobcareer_generate_random_string( 6 );
					}
					$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );


					$cs_opt_array = array(
						'name' => esc_html__( 'Facebook', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Insert facebook profile URL of member.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => esc_attr( $cs_multi_team_fb_url ),
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_multi_team_fb_url[]',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Twitter URL', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Insert twitter profile URL of member.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => esc_attr( $cs_multi_team_twitter_url ),
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_multi_team_twitter_url[]',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Linkedin', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Insert linkedin profile URL of member.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => esc_attr( $cs_multi_team_linkedin_url ),
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_multi_team_linkedin_url[]',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Email', 'jobcareer' ),
						'desc' => '',
						'hint_text' => esc_html__( "Add member email for any one can contact.", 'jobcareer' ),
						'echo' => true,
						'field_params' => array(
							'std' => sanitize_email( $cs_multi_team_email ),
							'cust_id' => '',
							'classes' => '',
							'cust_name' => 'cs_multi_team_email[]',
							'return' => true,
						),
					);
					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					/*
					  $cs_opt_array = array(
					  'name' => esc_html__('Service Content Color', 'jobcareer'),
					  'desc' => '',
					  'hint_text' => esc_html__('Provide a hex colour code here (with #) for text color. if you want to override the default.', 'jobcareer'),
					  'echo' => true,
					  'field_params' => array(
					  'std' => '',
					  'id' => 'cs_service_content_color',
					  'cust_name' => 'cs_service_content_color[]',
					  'classes' => 'bg_color',
					  'return' => true,
					  ),
					  );


					  $jobcareer_html_fields->cs_text_field($cs_opt_array);
					 */
					?>
				</div>
				<script>

				    /*
				     * modern selection box function
				     */
				    chosen_selectionbox();
				    /*
				     * modern selection box function
				     */

				    /*
				     * popup over 
				     */
				    popup_over();
				    /*
				     *End popup over 
				     */
				</script>
				<?php
			} else if ( $_POST['shortcode_element'] == 'facilities' ) {
				$facilities_count = 'facilities_' . rand( 455345, 23454390 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo jobcareer_special_char( $facilities_count ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Facilities', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'classes' => '',
						'field_params' => array(
							'std' => '',
							'id' => 'title',
							'cust_name' => 'title[]',
							'return' => true,
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Title color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'title_color',
							'cust_name' => 'title_color[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Text Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'text_color',
							'cust_name' => 'text_color[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$jobcareer_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'std' => '',
						'id' => 'image',
						'name' => esc_html__( 'Image', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'array' => true,
						'prefix' => '',
						'field_params' => array(
							'std' => '',
							'id' => 'image',
							'return' => true,
							'array' => true,
							'array_txt' => false,
							'prefix' => '',
						),
					);

					$jobcareer_html_fields->cs_upload_file_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Text', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'facilities_text',
							'cust_name' => 'facilities_text[]',
							'return' => true,
							'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
							'classes' => '',
						),
					);

					$jobcareer_html_fields->cs_textarea_field( $cs_opt_array );
					?>

				</div>
				<?php
			} else if ( $_POST['shortcode_element'] == 'progressbars' ) {
				$rand_id = rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="cs_infobox_<?php echo intval( $rand_id ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Progress bars', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Progress Bars Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'progressbars_title',
							'cust_name' => 'progressbars_title[]',
							'return' => true,
						),
					);

					$cs_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Skill (in percentage)', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'progressbars_percentage',
							'cust_name' => 'progressbars_percentage[]',
							'return' => true,
						),
					);

					$cs_html_fields->cs_text_field( $cs_opt_array );


					$cs_opt_array = array(
						'name' => esc_html__( 'Progress Bars Color', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => '',
							'id' => 'progressbars_color',
							'cust_name' => 'progressbars_color[]',
							'return' => true,
							'classes' => 'bg_color',
						),
					);

					$cs_html_fields->cs_text_field( $cs_opt_array );
					?>

				</div>
				<script>
				    /*
				     * popup over 
				     */
				    jQuery(document).ready(function ($) {
					chosen_selectionbox();
					popup_over();
				    });
				    /*
				     *End popup over 
				     */
				</script>
				<?php
			} else if ( $_POST['shortcode_element'] == 'offerslider' ) {
				$offer_count = 'offer_' . rand( 40, 9999999 );
				?>
				<div class='cs-wrapp-clone cs-shortcode-wrapp' id="cs_infobox_<?php echo intval( $offer_count ); ?>">
					<header>
						<h4><i class='icon-arrows'></i><?php esc_html_e( 'Offer Slider Item', 'jobcareer' ); ?></h4>
						<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
					</header>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Image', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => esc_html( $cs_slider_image ),
							'id' => 'cs_slider_image',
							'cust_name' => 'cs_slider_image[]',
							'return' => true,
						),
					);

					$cs_html_fields->cs_form_fileupload_render( $cs_opt_array );
					?>

					<div class="page-wrap" style="overflow:hidden; display:<?php echo 'none'; ?>" id="cs_slider_image<?php echo intval( $offer_count ) ?>_box"  >
						<div class="gal-active">
							<div class="dragareamain cs-dragmain" >
								<ul id="gal-sortable">
									<li class="ui-state-default" id="">
										<div class="thumb-secs">
											<img src=""  id="cs_slider_image<?php echo intval( $offer_count ) ?>_img" width="100" height="150" alt=""  />
											<div class="gal-edit-opts">
												<a href="javascript:del_media('cs_slider_image<?php echo esc_js( $offer_count ) ?>')" class="delete"></a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php
					$cs_opt_array = array(
						'name' => esc_html__( 'Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => esc_html( $cs_slider_title ),
							'id' => 'cs_slider_title',
							'cust_name' => 'cs_slider_title[]',
							'return' => true,
						),
					);

					$cs_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Contents', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => esc_html( $cs_slider_contents ),
							'id' => 'cs_slider_contents',
							'cust_name' => 'cs_slider_contents[]',
							'return' => true,
						),
					);

					$cs_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Link', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => esc_url( $cs_readmore_link ),
							'id' => 'cs_readmore_link',
							'cust_name' => 'cs_readmore_link[]',
							'return' => true,
						),
					);

					$cs_html_fields->cs_text_field( $cs_opt_array );

					$cs_opt_array = array(
						'name' => esc_html__( 'Link Title', 'jobcareer' ),
						'desc' => '',
						'hint_text' => '',
						'echo' => true,
						'field_params' => array(
							'std' => esc_html( $cs_offerslider_link_title ),
							'id' => 'cs_offerslider_link_title',
							'cust_name' => 'cs_offerslider_link_title[]',
							'return' => true,
						),
					);
					$cs_html_fields->cs_text_field( $cs_opt_array );
					?>

				</div>
				<?php
			}
		}
		exit;
	}

	add_action( 'wp_ajax_jobcareer_shortcode_element_ajax_call', 'jobcareer_shortcode_element_ajax_call' );
}

/*
 *
 * @Shortcode Name : Post Attachment
 * @retrun
 *
 */
if ( ! function_exists( 'jobcareer_post_attachments' ) ) {

	function jobcareer_post_attachments( $gallery_meta_form ) {
		global $post, $jobcareer_form_fields, $jobcareer_html_fields;
		$galleryConter = rand( 40, 9999999 );
		?>        
		<div class="to-social-network">
			<div class="gal-active cs-galactive">
				<div class="clear"></div>
				<div class="dragareamain">
					<div class="placehoder"><?php esc_html_e( 'Gallery is Empty. Please Select Media', 'jobcareer' ); ?> <img src="<?php echo trailingslashit( get_template_directory_uri() ) . 'backend/assets/images/bg-arrowdown.png'; ?>" alt="" />
					</div>
					<ul id="gal-sortable" class="gal-sortable-<?php echo esc_attr( $gallery_meta_form ); ?>">
						<?php
						global $jobcareer_node, $cs_counter, $post;
						$cs_post_type = $post->post_type;
						if ( $gallery_meta_form == 'gallery_slider_meta_form' ) {
							$type = 'gallery_slider';
						} else {
							$type = 'gallery';
						}

						$cs_counter_gal = 0;
						$slider_data = get_post_meta( $post->ID, 'cs_' . $type, true );

						if ( isset( $slider_data ) && count( $slider_data ) > 0 && ! empty( $slider_data ) ) {
							foreach ( $slider_data as $jobcareer_node ) {
								$cs_counter_gal ++;
								$cs_counter = $post->ID . $cs_counter_gal;
								if ( $type == 'gallery_slider' ) {
									jobcareer_slider_clone();
								} else {
									jobcareer_gallery_clone();
								}
							}
						}
						?>
					</ul>
				</div>
			</div>
			<div class="to-social-list">
				<div class="soc-head">
					<h5><?php esc_html_e( 'Select Media', 'jobcareer' ); ?></h5>
					<div class="right">
						<?php
						if ( $gallery_meta_form == 'gallery_slider_meta_form' ) {
							$cs_opt_array = array(
								'std' => esc_html__( 'Reload', 'jobcareer' ),
								'id' => '',
								'classes' => 'button reload',
								'extra_atr' => ' onclick="refresh_media_slider(' . esc_attr( $galleryConter ) . ')"',
								'cust_id' => '',
								'cust_name' => '',
								'return' => true,
								'required' => false,
								'cust_type' => 'button',
							);
							echo jobcareer_special_char( $jobcareer_form_fields->cs_form_text_render( $cs_opt_array ) );
							?>
							<?php
						} else {
							$cs_opt_array = array(
								'std' => esc_html__( 'Reload', 'jobcareer' ),
								'id' => '',
								'classes' => 'button reload',
								'extra_atr' => ' onclick="refresh_media(' . esc_attr( $galleryConter ) . ')"',
								'cust_id' => '',
								'cust_name' => '',
								'return' => true,
								'required' => false,
								'cust_type' => 'button',
							);
							echo jobcareer_special_char( $jobcareer_form_fields->cs_form_text_render( $cs_opt_array ) );
							?>
							<?php
						}

						$cs_opt_array = array(
							'std' => esc_html__( 'Upload Media', 'jobcareer' ),
							'id' => '',
							'classes' => 'uploadfile button',
							'cust_id' => 'cs_log',
							'cust_name' => 'cs_logo',
							'return' => true,
							'required' => false,
							'cust_type' => 'button',
						);
						echo jobcareer_special_char( $jobcareer_form_fields->cs_form_text_render( $cs_opt_array ) );
						?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<script type="text/javascript">
			    function show_next(page_id, total_pages) {
				"use strict";
				var dataString = 'action=jobcareer_media_pagination&page_id=' + page_id + '&total_pages=' + total_pages;
				jQuery("#pagination").html("<img src='<?php echo trailingslashit( get_template_directory_uri() ) . 'backend/assets/images/ajax_loading.gif'; ?>' />");
				jQuery.ajax({
				    type: 'POST',
				    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				    data: dataString,
				    success: function (response) {
					jQuery("#pagination").html(response);
				    }
				});
			    }
			    function slider_show_next(page_id, total_pages) {
				"use strict";
				var dataString = 'action=jobcareer_slider_media_pagination&page_id=' + page_id + '&total_pages=' + total_pages;
				jQuery(".pagination_slider").html("<img src='<?php echo get_template_directory_uri() ?>/backend/assets/images/ajax_loading.gif' />");
				jQuery.ajax({
				    type: 'POST',
				    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				    data: dataString,
				    success: function (response) {
					jQuery(".pagination_slider").html(response);
				    }
				});
			    }
			    function refresh_media(id) {
				"use strict";
				var dataString = 'action=jobcareer_media_pagination&id=' + id + '&func=slider';
				jQuery(".pagination_clone").html("<img src='<?php echo get_template_directory_uri() ?>/backend/assets/images/ajax_loading.gif' />");
				jQuery.ajax({
				    type: 'POST',
				    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				    data: dataString,
				    success: function (response) {
					jQuery(".pagination_clone").html(response);
				    }
				});
			    }

			    function refresh_media_slider(id) {
				"use strict";
				var dataString = 'action=jobcareer_slider_media_pagination&id=' + id + '&func=slider';
				jQuery(".pagination_slider").html("<img src='<?php echo get_template_directory_uri() ?>/backend/assets/images/ajax_loading.gif' />");
				jQuery.ajax({
				    type: 'POST',
				    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				    data: dataString,
				    success: function (response) {
					jQuery(".pagination_slider").html(response);
				    }
				});
			    }
				</script>
				<script>
			    jQuery(document).ready(function ($) {
				"use strict";
				$(".gal-sortable-<?php echo esc_js( $galleryConter ); ?>").sortable({
				    cancel: 'li div.poped-up',
				});
			    });
			    var counter = 0;
			    var count_items = <?php echo esc_js( $cs_counter_gal ) ?>;
			    if (count_items > 0) {
				jQuery(".dragareamain").addClass("noborder");
			    }

			    function clone(path, id) {
				"use strict";
				counter = counter + 1;
				var cls = 'gal-sortable-gallery_meta_form';
				var dataString = 'path=' + path + '&counter=' + counter + '&action=gallery_clone';
				jQuery("." + cls).append("<li id='loading'><img src='<?php echo get_template_directory_uri() ?>/backend/assets/images/ajax_loading.gif' /></li>");
				jQuery.ajax({
				    type: 'POST',
				    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				    data: dataString,
				    success: function (response) {
					jQuery("#loading").remove();
					jQuery("." + cls).append(response);
					count_items = jQuery("." + cls + ' ' + "li").length;
					if (count_items > 0) {
					    jQuery(".dragareamain").addClass("noborder");
					}
				    }
				});
			    }

			    function slider(path, id) {
				"use strict";
				counter = counter + 1;
				var cls = 'gal-sortable-gallery_slider_meta_form';
				var dataString = 'path=' + path + '&counter=' + counter + '&action=slider_clone';
				jQuery("." + cls).append("<li id='loading'><img src='<?php echo get_template_directory_uri() ?>/backend/assets/images/ajax_loading.gif' /></li>");
				jQuery.ajax({
				    type: 'POST',
				    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				    data: dataString,
				    success: function (response) {
					jQuery("#loading").remove();
					jQuery("." + cls).append(response);
					count_items = jQuery("." + cls + ' ' + "li").length;
					if (count_items > 0) {
					    jQuery(".dragareamain").addClass("noborder");
					}
				    }
				});
			    }

			    function del_this(div, id) {
				"use strict";
				jQuery("#" + div + ' ' + "#" + id).remove();
				count_items = jQuery("#gal-sortable li").length;
				if (count_items == 0) {
				    jQuery(".dragareamain").removeClass("noborder");
				}
			    }
				</script>
				<?php if ( $gallery_meta_form == 'gallery_slider_meta_form' ) { ?>
					<div id="pagination" class="pagination_slider"><?php jobcareer_slider_media_pagination( $gallery_meta_form, 'slider' ); ?></div>
				<?php } else { ?>
					<div id="pagination" class="pagination_clone"><?php jobcareer_media_pagination( $gallery_meta_form, 'clone' ); ?></div>
					<?php
				}
				$cs_opt_array = array(
					'std' => '1',
					'id' => '',
					'cust_id' => '',
					'cust_name' => esc_attr( $gallery_meta_form ),
					'return' => true,
					'required' => false
				);
				echo jobcareer_special_char( $jobcareer_form_fields->cs_form_hidden_render( $cs_opt_array ) );
				?>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}

}

/*
 *
 * @Shortcode Name : Flex Slider
 * @retrun
 *
 */

if ( ! function_exists( 'jobcareer_post_slick_slider' ) ) {

	function jobcareer_post_slick_slider( $width, $height, $postid, $view ) {
		global $post, $jobcareer_node, $jobcareer_options, $cs_counter_node;
		$cs_post_counter = rand( 40, 9999999 );
		$cs_counter_node ++;

		if ( $view == 'post-list' ) {
			$viewMeta = 'cs_post_list_gallery';
		} else {
			$viewMeta = $view;
		}

		$cs_meta_slider_options = get_post_meta( "$postid", $viewMeta, true );

		$totaImages = '';
		?>
		<script type='text/javascript'>
		    jQuery(document).ready(function () {
			"use strict";
			$('.blog-slides').slick({
			    slidesToShow: 1,
			    dots: true,
			    adaptiveHeight: true,
			    slidesToScroll: 1,
			    autoplay: false,
			    autoplaySpeed: 2000,
			    arrows: false,
			});
		    });
		</script>
		<div class="cs-media blog-slides">
			<?php
			$cs_counter = 1;

			if ( $view == 'post' ) {
				$sliderData = get_post_meta( $post->ID, 'cs_post_detail_gallery', true );
				$sliderData = explode( ',', $sliderData );
				$totaImages = count( $sliderData );
			} else if ( $view == 'post-list' ) {
				$sliderData = get_post_meta( $post->ID, 'cs_post_list_gallery', true );
				$sliderData = explode( ',', $sliderData );
				$totaImages = count( $sliderData );
			} else {
				$sliderData = get_post_meta( $post->ID, 'cs_post_list_gallery', true );
				$sliderData = explode( ',', $sliderData );
				$totaImages = count( $sliderData );
			}
			asort( $sliderData );
			foreach ( $sliderData as $as_node ) {
				$image_url = jobcareer_attachment_image_src( ( int ) $as_node, $width, $height );
				echo ' <figure>
                                        <img src="' . esc_url( $image_url ) . '" alt="">';
				if ( isset( $as_node['title'] ) && $as_node['title'] != '' ) {
					?>         
				<?php } ?>
			</figure>

			<?php
			$cs_counter ++;
		}
		?>
		</div>
		<?php
		jobcareer_enqueue_slick_script();
	}

}

//=====================================================================
//  Post Slick Detail function
//=====================================================================

if ( ! function_exists( 'jobcareer_post_slick_detail' ) ) {

	function jobcareer_post_slick_detail( $width, $height, $postid, $view ) {
		global $post, $jobcareer_node, $jobcareer_options, $cs_counter_node;
		$cs_post_counter = rand( 40, 9999999 );
		$cs_counter_node ++;

		if ( $view == 'post-list' ) {
			$viewMeta = 'cs_post_list_gallery';
		} else {
			$viewMeta = $view;
		}
		$cs_meta_slider_options = get_post_meta( "$postid", $viewMeta, true );
		$totaImages = '';
		?>
		<div class="blog-detail-slider">
			<?php
			$cs_counter = 1;
			if ( $view == 'post' ) {
				$sliderData = get_post_meta( $post->ID, 'cs_post_detail_gallery', true );
				$sliderData = explode( ',', $sliderData );
				$totaImages = count( $sliderData );
			} else if ( $view == 'post-list' ) {
				$sliderData = get_post_meta( $post->ID, 'cs_post_list_gallery', true );
				$sliderData = explode( ',', $sliderData );
				$totaImages = count( $sliderData );
			} else {
				$sliderData = get_post_meta( $post->ID, 'cs_post_list_gallery', true );
				$sliderData = explode( ',', $sliderData );
				$totaImages = count( $sliderData );
			}
			asort( $sliderData );
			foreach ( $sliderData as $as_node ) {
				$image_url = jobcareer_attachment_image_src( ( int ) $as_node, $width, $height );
				echo ' <figure>
							<img src="' . esc_url( $image_url ) . '" alt="">';
				if ( isset( $as_node['title'] ) && $as_node['title'] != '' ) {
					?>         
				<?php } ?>
			</figure>
			<?php
			$cs_counter ++;
		}
		?>
		</div>
		<?php jobcareer_enqueue_slick_script(); ?>
		<script type='text/javascript'>
		    jQuery(document).ready(function () {
			"use strict";
			$('.blog-detail-slider').slick({
			    slidesToShow: 1,
			    dots: true,
			    adaptiveHeight: true,
			    slidesToScroll: 1,
			    autoplay: false,
			    autoplaySpeed: 2000,
			    arrows: false,
			});
		    });
		</script>

		<?php
	}

}

//=====================================================================
//  Post Slick list function
//=====================================================================

if ( ! function_exists( 'jobcareer_post_slick_list' ) ) {

	function jobcareer_post_slick_list( $width, $height, $postid, $view ) {
		global $post, $jobcareer_node, $jobcareer_options, $cs_counter_node;
		$cs_post_counter = rand( 40, 9999999 );
		$cs_counter_node ++;

		if ( $view == 'post-list' ) {
			$viewMeta = 'cs_post_list_gallery';
		} else {
			$viewMeta = $view;
		}
		$cs_meta_slider_options = get_post_meta( "$postid", $viewMeta, true );
		$totaImages = '';

		$cs_counter = 0;

		if ( $view == 'post' ) {
			$sliderData = get_post_meta( $post->ID, 'cs_post_detail_gallery', true );
			$sliderData = explode( ',', $sliderData );
			$totaImages = count( $sliderData );
		} else if ( $view == 'post-list' ) {
			$sliderData = get_post_meta( $post->ID, 'cs_post_list_gallery', true );
			$sliderData = explode( ',', $sliderData );
			$totaImages = count( $sliderData );
		} else {
			$sliderData = get_post_meta( $post->ID, 'cs_post_list_gallery', true );
			$sliderData = explode( ',', $sliderData );
			$totaImages = count( $sliderData );
		}

		foreach ( $sliderData as $as_node ) {
			$image_url = jobcareer_attachment_image_src( ( int ) $as_node, $width, $height );
			echo ' <figure>
						<img src="' . esc_url( $image_url ) . '" alt=""></figure>';
			if ( isset( $as_node['title'] ) && $as_node['title'] != '' ) {
				
			}
			?>
			<?php
			$cs_counter ++;
		}
		jobcareer_enqueue_slick_script();
		?>
		<script type='text/javascript'>
		    jQuery(document).ready(function () {
			"use strict";
			$('.slider-medium').slick({
			    slidesToShow: 0,
			    dots: false,
			    adaptiveHeight: false,
			    slidesToScroll: 0,
			    autoplay: false,
			    autoplaySpeed: 2000,
			    arrows: false,
			});
		    });
		</script>
		<?php
	}

}    