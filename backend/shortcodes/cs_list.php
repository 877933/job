<?php
/*
 *
 * @File : List
 * @retrun
 *
 */
if ( ! function_exists( 'jobcareer_pb_list' ) ) {

	function jobcareer_pb_list( $die = 0 ) {
		global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields,$cs_list_type;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$cs_counter = $_POST['counter'];
		$list_num = 0;
		if ( isset( $_POST['action'] ) && ! isset( $_POST['shortcode_element_id'] ) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes( $shortcode_element_id );
			$PREFIX = CS_SC_LIST . '|' . CS_SC_LISTITEM;
			$parseObject = new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str, true, $PREFIX );
		}
		$defaults = array(
			'column_size' => '',
			'cs_list_section_title' => '',
			'cs_list_type' => '',
			'cs_list_icon' => '',
			'cs_border' => '',
			'cs_list_item' => '',
		);
		$randD_id = rand( 12332, 976875 );
		if ( isset( $output['0']['atts'] ) ) {
			$atts = $output['0']['atts'];
		} else {
			$atts = array();
		}
		if ( isset( $output['0']['content'] ) ) {
			$atts_content = $output['0']['content'];
		} else {
			$atts_content = array();
		}
		if ( is_array( $atts_content ) ) {
			$list_num = count( $atts_content );
		}
		$list_element_size = '25';
		foreach ( $defaults as $key => $values ) {
			if ( isset( $atts[$key] ) ) {
				$$key = $atts[$key];
			} else {
				$$key = $values;
			}
		}
		$name = 'jobcareer_pb_list';
		$coloumn_class = 'column_' . $list_element_size;
		if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
		?>
		<div id="<?php echo esc_attr( $name . $cs_counter ) ?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class ); ?> <?php echo esc_attr( $shortcode_view ); ?>" item="list" data="<?php echo jobcareer_element_size_data_array_index( $list_element_size ) ?>" >
			<?php jobcareer_element_setting( $name, $cs_counter, $list_element_size, '', 'list-ol', $type = '' ); ?>
			<div class="cs-wrapp-class-<?php echo intval( $cs_counter ) ?> <?php echo esc_attr( $shortcode_element ); ?>" id="<?php echo esc_attr( $name . $cs_counter ) ?>" style="display: none;">
				<div class="cs-heading-area">
					<h5><?php esc_html_e( 'LIST OPTIONS', 'jobcareer' ); ?></h5>
					<a href="javascript:removeoverlay('<?php echo esc_js( $name . $cs_counter ) ?>','<?php echo esc_js( $filter_element ); ?>')"
					   class="cs-btnclose"><i class="icon-times"></i>
					</a>
				</div>

				<div class="cs-clone-append cs-pbwp-content">
					<div class="cs-wrapp-tab-box">
						<div id="shortcode-item-<?php echo intval( $cs_counter ); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr( CS_SC_LIST ); ?>]" data-shortcode-child-template="[<?php echo esc_attr( CS_SC_LISTITEM ); ?> {{attributes}}] {{content}} [/<?php echo esc_attr( CS_SC_LISTITEM ); ?>]">
							<div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr( CS_SC_LIST ); ?> {{attributes}}]">

								<?php
								if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
									jobcareer_shortcode_element_size();
								}
								?>
								<?php
								$cs_opt_array = array(
									'name' => esc_html__( 'Element Title', 'jobcareer' ),
									'desc' => '',
									'hint_text' => esc_html__( 'Enter element title', 'jobcareer' ),
									'echo' => true,
									'field_params' => array(
										'std' => esc_html( $cs_list_section_title ),
										'id' => 'cs_list_section_title',
										'cust_name' => 'cs_list_section_title[]',
										'classes' => '',
										'return' => true,
									),
								);
								$jobcareer_html_fields->cs_text_field( $cs_opt_array );


								$cs_opt_array = array(
									'name' => esc_html__( 'List Style', 'jobcareer' ),
									'desc' => '',
									'hint_text' => esc_html__( "Choose list style from here", 'jobcareer' ),
									'echo' => true,
									'field_params' => array(
										'std' => $cs_list_type,
										'id' => '',
										'cust_id' => 'cs_list_type',
										'extra_atr' => 'onchange="cs_list_style_view(this.value)"',
										'cust_name' => 'cs_list_type[]',
										'classes' => 'dropdown chosen-select-no-single select-medium',
										'options' => array(
											'default' => esc_html__( 'Default', 'jobcareer' ),
											'numeric-icon' => esc_html__( 'Numeric', 'jobcareer' ),
											'built' => esc_html__( 'Bullet', 'jobcareer' ),
											'icon' => esc_html__( 'Icon', 'jobcareer' ),
											'alphabetic' => esc_html__( 'Alphabetic', 'jobcareer' ),
										),
										'return' => true,
									),
								);

								$jobcareer_html_fields->cs_select_field( $cs_opt_array );
								
								//session_start();
                                //$_SESSION['superhero'] = $cs_list_type;
								?>
							</div>
							<script>
						function cs_list_style_view(cs_list_style_data) {
							if (cs_list_style_data == 'icon') {
								jQuery('.list_icon_div').show();
						    } else {
								jQuery('.list_icon_div').hide();
							}
						}
							</script>
							<?php
							if ( isset( $list_num ) && $list_num <> '' && isset( $atts_content ) && is_array( $atts_content ) ) {
								foreach ( $atts_content as $list_items ) {

									$rand_id = rand( 111333, 9999999 );
									$cs_list_item = $list_items['content'];
									$defaults = array( 'cs_list_icon' => '', 'cs_list_item_icon_color' => '', 'cs_list_item_icon_bg_color' => '', 'cs_cusotm_class' => '', 'cs_custom_animation' => '' );
									foreach ( $defaults as $key => $values ) {
										if ( isset( $list_items['atts'][$key] ) ) {
											$$key = $list_items['atts'][$key];
										} else {
											$$key = $values;
										}
									}
									?>
									<div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo esc_attr( $rand_id ); ?>">
										<header>
											<h4><i class='icon-arrows'></i><?php esc_html_e( 'List Item', 'jobcareer' ); ?></h4>
											<a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e( 'Remove', 'jobcareer' ); ?></a>
										</header>
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

										$display = '';
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
									<?php
								}
							}
							?>
						</div>
						<div class="hidden-object">
							<?php
							$cs_opt_array = array(
								'std' => intval( $list_num ),
								'id' => '',
								'before' => '',
								'after' => '',
								'classes' => 'fieldCounter',
								'extra_atr' => '',
								'cust_id' => '',
								'cust_name' => 'list_num[]',
								'return' => true,
								'required' => false
							);
							echo jobcareer_special_char( $jobcareer_form_fields->cs_form_hidden_render( $cs_opt_array ) );
							?>

						</div>
						<div class="wrapptabbox no-padding-lr">
							<div class="opt-conts">
								<ul class="form-elements">
									<li class="to-field">
										<a href="javascript:viod(0);" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('list', 'shortcode-item-<?php echo esc_js( $cs_counter ); ?>', '<?php echo admin_url( 'admin-ajax.php' ); ?>')">
											<i class="icon-plus-circle"></i><?php esc_html_e( 'Add List Item', 'jobcareer' ) ?> 
										</a>
									</li>
									<div id="loading" class="shortcodeload"></div>
								</ul>
							</div>
							<?php
							if ( isset( $_POST['shortcode_element'] ) && $_POST['shortcode_element'] == 'shortcode' ) {
								?>
								<ul class="form-elements insert-bg noborder">
									<li class="to-field"> 
										<a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace( 'jobcareer_pb_', '', $name ); ?> ', 'shortcode-item-<?php echo esc_js( $cs_counter ); ?>', '<?php echo esc_js( $filter_element ); ?>')" ><?php esc_html_e( 'Insert', 'jobcareer' ); ?></a>
									</li>
								</ul>
								<div id="results-shortocde"></div>
								<?php
							} else {
								$cs_opt_array = array(
									'std' => 'list',
									'id' => '',
									'before' => '',
									'after' => '',
									'classes' => '',
									'extra_atr' => '',
									'cust_id' => '',
									'cust_name' => 'cs_orderby[]',
									'return' => true,
									'required' => false
								);
								echo jobcareer_special_char( $jobcareer_form_fields->cs_form_hidden_render( $cs_opt_array ) );

								$cs_opt_array = array(
									'name' => '',
									'desc' => '',
									'hint_text' => '',
									'echo' => true,
									'field_params' => array(
										'std' => esc_html__( 'Save', 'jobcareer' ),
										'cust_id' => '',
										'cust_type' => 'button',
										'classes' => 'cs-admin-btn',
										'cust_name' => '',
										'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
										'return' => true,
									),
								);

								$jobcareer_html_fields->cs_text_field( $cs_opt_array );
							}
							?>
							<script>
					/* modern selection box function */
					jQuery(document).ready(function ($) {
					    chosen_selectionbox();
					    popup_over();
					});
					/* modern selection box function */


							</script>
						</div>
					</div>

				</div>
			</div>
		</div>

		<?php
		if ( $die <> 1 ) {
			die();
		}
	}

	add_action( 'wp_ajax_jobcareer_pb_list', 'jobcareer_pb_list' );
}

// Multiple lists start
if ( ! function_exists( 'cs_get_pagebuilder_element' ) ) {

	function cs_get_pagebuilder_element( $shortcode_element_id, $POSTID ) {
		$jobcareer_page_bulider = get_post_meta( $POSTID, "cs_page_builder", true );
		if ( isset( $jobcareer_page_bulider ) && $jobcareer_page_bulider <> '' ) {
			$jobcareer_xmlObject = new SimpleXMLElement( $jobcareer_page_bulider );
		}
		$shortcode_element_array = explode( '_', $shortcode_element_id );
		$section_no = $shortcode_element_array['0'];
		$columnn_no = $shortcode_element_array['1'];
		$section = 0;
		$colummmn = 0;
		foreach ( $jobcareer_xmlObject->column_container as $column_container ) {
			$section ++;
			if ( $section == $section_no ) {
				foreach ( $column_container->children() as $column ) {
					foreach ( $column->children() as $jobcareer_node ) {
						$colummmn ++;
						if ( $colummmn == $columnn_no ) {
							break;
						}
					}
				}
			}
			break;
		}
		return $jobcareer_node;
	}

}