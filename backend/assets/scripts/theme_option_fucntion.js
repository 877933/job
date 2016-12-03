/*
* Document ready functions 
*/
	var $ = jQuery;
	jQuery(document).ready(function() {
		"use strict";
		
		/*
		* Choose Backgorund color function 
		*/
			jQuery('.bg_color').wpColorPicker();
		/*
		* End Choose Backgorund color function  
		*/
		
		
		/*
		* Remove Backup Functions
		*/
		jQuery('.backup_generates_area').on('click', '#cs-backup-delte', function () {
		
			var var_confirm = confirm("This action will delete your selected Backup File. Are you want to continue?");
			if (var_confirm == true) {
				jQuery(".outerwrapp-layer,.loading_div").fadeIn(100);
			
				var admin_url = jQuery('.backup_generates_area').data('ajaxurl');
				var file_name = jQuery(this).data('file');
			
				var dataString = 'file_name=' + file_name + '&action=jobcareer_backup_file_delete';
				jQuery.ajax({
					type: "POST",
					url: admin_url,
					data: dataString,
					success: function (response) {
			
						jQuery(".loading_div").hide();
						jQuery(".form-msg .innermsg").html(response);
						jQuery(".form-msg").show();
						jQuery(".outerwrapp-layer").delay(2000).fadeOut(100);
						window.location.reload(true);
						slideout();
					}
				});
				//return false;
			}
		});	
		/*
		* End Remove Backup Functions
		*/	
		
		
		
		/*
		* Restore Backup Functions
		*/
		jQuery('.backup_generates_area').on('click', '#cs-backup-restore, #cs-backup-url-restore', function () {

			jQuery(".outerwrapp-layer,.loading_div").fadeIn(100);
			
			var admin_url = jQuery('.backup_generates_area').data('ajaxurl');
			var file_name = jQuery(this).data('file');
			var dataString = 'file_name=' + file_name + '&action=jobcareer_backup_file_restore';
			if (typeof (file_name) === 'undefined') {
				var file_name = jQuery('#bkup_import_url').val();
				var dataString = 'file_name=' + file_name + '&file_path=yes&action=jobcareer_backup_file_restore';
			}
			
			jQuery.ajax({
				type: "POST",
				url: admin_url,
				data: dataString,
				success: function (response) {
				
				jQuery(".loading_div").hide();
				jQuery(".form-msg .innermsg").html(response);
				jQuery(".form-msg").show();
				jQuery(".outerwrapp-layer").delay(2000).fadeOut(100);
				
				window.location.reload(true);
				slideout();
				}
			});
			//return false;
		});
        /*
		* End Restore Backup Functions
		*/
	});		
	
	/*
	* popup over trigger
	*/
		function popup_over(){
			jQuery('[data-toggle="popover"]').popover({trigger: "hover", placement: "right"});
		}
	/*
	* End popup over trigger
	*/	
		
	/*
	* theme option save function 
	*/
	function jobcareer_theme_option_save(admin_url, theme_url) {
		"use strict";
		jQuery(".outerwrapp-layer,.loading_div").fadeIn(100);
		function newValues() {
			var serializedValues = jQuery("#frm input,#frm select,#frm textarea[name!=cs_export_theme_options]").serialize();
			return serializedValues;
		}
		var serializedReturn = newValues();
		jQuery.ajax({
			type: "POST",
			url: admin_url,
			data: serializedReturn,
			success: function (response) {
	
				jQuery(".loading_div").hide();
				jQuery(".form-msg .innermsg").html(response);
				jQuery(".form-msg").show();
				jQuery(".outerwrapp-layer").delay(100).fadeOut(100)
				window.location.reload(true);
				slideout();
			}
		});
		//return false;
	}
	/*
	* End theme option save function 
	*/
	
	
	/*
	* reset all theme options function 
	*/
	function cs_rest_all_options(admin_url) {
		"use strict";
	
		var var_confirm = confirm("You current theme options will be replaced with the default theme activation options.");
		if (var_confirm == true) {
			var dataString = 'action=jobcareer_theme_option_rest_all';
			jQuery.ajax({
				type: "POST",
				url: admin_url,
				data: dataString,
				success: function (response) {
	
					jQuery(".form-msg").show();
					jQuery(".form-msg").html(response);
					jQuery(".loading_div").hide();
	
					window.location.reload(true);
					slideout();
				}
			});
		}
		//return false;
	}
	/*
	* End  reset all theme options function 
	*/
	
	
	
	/*
	* set filename function 
	*/
	function cs_set_filename(file_value, file_path) {
		"use strict";
		jQuery(".backup_action_btns").find('input[type="button"]').attr('data-file', file_value);
		jQuery(".backup_action_btns").find('> a').attr('href', file_path + file_value);
		jQuery(".backup_action_btns").find('> a').attr('download', file_value);
	}
	/*
	* End set filename function 
	*/
	
	
	
	/*
	* backup generate function
	*/
	function cs_backup_generate(admin_url) {
		"use strict";
		jQuery(".outerwrapp-layer,.loading_div").fadeIn(100);
	
		var dataString = 'action=jobcareer_options_backup_generate';
		jQuery.ajax({
			type: "POST",
			url: admin_url,
			data: dataString,
			success: function (response) {
	
				jQuery(".loading_div").hide();
				jQuery(".form-msg .innermsg").html(response);
				jQuery(".form-msg").show();
				jQuery(".outerwrapp-layer").delay(100).fadeOut(100);
				window.location.reload(true);
				slideout();
			}
		});
		//return false;
	}
	/*
	* End backup generate function
	*/
	
	
	/*
	* Remove image function
	*/
		function cs_remove_image(id) {
			"use strict";
			var $ = jQuery;
			$('#' + id).val('');
			$('#' + id + '_img_div').hide();
			//$('#'+id+'_div').attr('src', '');
		}
	/*
	* End Remove image function 
	*/
	
	
	/*
	* social icon delete function
	*/
		function social_icon_del(id) {
			"use strict";
			jQuery("#del_" + id).remove();
			jQuery("#" + id).remove();
		}
	/*
	* End social icon delete function
	*/
	
	
	/*
	* get google font attribute function
	*/	
		function cs_google_font_att(admin_url, att_id, id) {
		   "use strict";
			var $ = jQuery;
			if (att_id != "") {
				jQuery('#' + id).parent().next().remove(0);
				jQuery('#' + id).parent().parent().append('<i style="font-size:20px;color:#ff6363;" class="icon-spinner icon-spin"></i>');
				jQuery('#' + id).parent().parent().css('text-align', 'center');
				jQuery('#' + id).parent().hide(0);
				var dataString = 'index=' + att_id + '&id=' + id +
						'&action=jobcareer_get_google_font_attributes';
				jQuery.ajax({
					type: "POST",
					url: admin_url,
					data: dataString,
					success: function (response) {
						jQuery('#' + id).parent().show(0);
						jQuery('#' + id).parent().html(response);
						jQuery('#' + id).parent().next().remove(0);
		
					}
				});
				//return false;
			}
		}
		/*
	* End get google font attribute function 
	*/
	
	
	/*
	* add social icons function 
	*/
		var counter_social_network = 0;
		function jobcareer_add_social_icon(admin_url) {
			"use strict";
			counter_social_network++;
			var social_net_icon_path = jQuery("#social_net_icon_path_input").val();
			var social_net_awesome = jQuery(".selected-icon i").attr("class");
			var social_net_url = jQuery("#social_net_url_input").val();
			var social_net_tooltip = jQuery("#social_net_tooltip_input").val();
			var social_font_awesome_color = jQuery("#social_font_awesome_color").val();
			if (social_net_url != "" && (social_net_icon_path != "" || social_net_awesome != "")) {
				var dataString = 'social_net_icon_path=' + social_net_icon_path +
						'&social_net_awesome=' + social_net_awesome +
						'&social_net_url=' + social_net_url +
						'&social_net_tooltip=' + social_net_tooltip +
						'&counter_social_network=' + counter_social_network +
						'&social_font_awesome_color=' + social_font_awesome_color +
						'&action=jobcareer_add_social_icon';
		
				jQuery.ajax({
					type: "POST",
					url: admin_url,
					data: dataString,
					success: function (response) {
						jQuery("#social_network_area").append(response);
						jQuery(".social-area").show(200);
						jQuery("#social_net_icon_path_input,#social_net_awesome_input,#social_net_url_input,#social_net_tooltip_input").val("");
						jQuery("#social_font_awesome_color").val("#fff");
					}
				});
				//return false;
			}
		}
		
	/*
	* End add social icons function  
	*/
		
		
		/*
		* Choose background function
		*/
		
		function select_bg(layout, value, theme_url, admin_url) {
			
			"use strict";
			var $ = jQuery;
			jQuery('input[name="' + layout + '"]').live('click', function () {
				jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
				jQuery(this).siblings("label").children("#check-list").addClass("check-list");
				jQuery(this).addClass('selected').siblings().removeClass('selected');
			});
			if (value == 'boxed' && layout == 'cs_layout') {
				jQuery('.horizontal_tabs,.main_tab').show();
			} else if (value == 'full_width' && layout == 'cs_layout') {
				jQuery('.horizontal_tabs,.main_tab').hide();
				jQuery('#cs_bg_color').hide();
				
			}  
			  
		   jQuery('#cs_custom_bgimage_main').hide();
		  
			if (value == 'no_sidebar' && layout == 'cs_single_post_layout') {
					jQuery('#cs_single_layout_sidebar_header').hide();
			}
			if (layout == 'cs_single_post_layout' && value == 'sidebar_left') {
					jQuery('#cs_single_layout_sidebar_header').show();
			}
			if (layout == 'cs_single_post_layout' && value == 'sidebar_right') {
					jQuery('#cs_single_layout_sidebar_header').show();
			}
			
			if (value == 'no_sidebar' && layout == 'cs_default_page_layout') {
					jQuery('#cs_default_layout_sidebar_header').hide();
			}
			if (layout == 'cs_default_page_layout' && value == 'sidebar_left') {
					jQuery('#cs_default_layout_sidebar_header').show();
			} 
			if (layout == 'cs_default_page_layout' && value == 'sidebar_right') {
					jQuery('#cs_default_layout_sidebar_header').show();
			}
		}
		/*
		* End Choose background function
		*/
	
	/*
	* End set filename function 
	*/
		var counter_sidebar = 0;
		function add_sidebar() {
			"use strict";
			counter_sidebar++;
			var sidebar_input = jQuery("#sidebar_input").val();
			if (sidebar_input != "") {
				jQuery("#sidebar_area").append('<tr id="' + counter_sidebar + '"> \
									<td><input type="hidden" name="sidebar[]" value="' + sidebar_input + '" />' + sidebar_input + '</td> \
									<td class="centr"> <a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove(' + counter_sidebar + ')"><i class="icon-times"></i></a> </td> \
								</tr>');
				jQuery("#sidebar_input").val("");
				jQuery(".sidebar-area").slideDown();
			}
		}
		
		
		
    var counter_footer_sidebar = 0;
				
		function add_footer_sidebar() {
			"use strict";
			counter_footer_sidebar++;
			var footer_sidebar_input = jQuery("#footer_sidebar_input").val();
			var footer_sidebar_width = jQuery("#footer_sidebar_width").val();
		 
			if (footer_sidebar_input != "" || footer_sidebar_width != "") {
				jQuery("#footer_sidebar_area").append('<tr id="' + counter_footer_sidebar + '"> \
									<td><input type="hidden" name="footer_sidebar[]" value="' + footer_sidebar_input + '" />' + footer_sidebar_input + '</td> \
									<td><input type="hidden" name="footer_width[]" value="' + footer_sidebar_width + '" />' + footer_sidebar_width + '</td> \
									<td class="centr"> <a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:cs_div_remove(' + counter_footer_sidebar + ')"><i class="icon-times"></i></a> </td> \
								</tr>');
				jQuery("#footer_sidebar_input").val("");
				jQuery("#footer_sidebar_width").val("");
				jQuery(".footer_sidebar-area").slideDown();
			}
		}
		
		
	/*
	* End set filename function 
	*/
	
	/*
	* set header backgorund function 
	*/
		function cs_set_headerbg(value) {
			"use strict";
			if (value == 'absolute') {
		
				jQuery('#cs_headerbg_options_header,#cs_headerbg_image_upload,#cs_headerbg_color_color,#jobcareer_headerbg_slider_1,#cs_headerbg_image_box').show();
				if (jQuery('#cs_headerbg_options').val() == 'cs_rev_slider') {
					jQuery('#jobcareer_headerbg_slider_1').show();
					jQuery('#cs_headerbg_image_upload,#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box').hide();
				} else if (jQuery('#cs_headerbg_options').val() == 'jobcareer_bg_image_color') {
					jQuery('#jobcareer_headerbg_slider_1').hide();
					jQuery('#cs_headerbg_image_upload,#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box').show();
				} else {
					jQuery('#jobcareer_headerbg_slider_1').hide();
					jQuery('#cs_headerbg_image_upload,#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box,#jobcareer_headerbg_slider_1').hide();
				}
		
			} else if (value == 'relative') {
		
				jQuery('#cs_headerbg_options_header,#cs_headerbg_image_upload,#cs_headerbg_color_color,#jobcareer_headerbg_slider_1,#tab-header-options #cs_headerbg_image_box').hide();
		
			} else if (value == 'cs_rev_slider') {
		
				jQuery('#jobcareer_headerbg_slider_1').show();
		
				jQuery('#cs_headerbg_image_upload,#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box').hide();
		
			} else if (value == 'jobcareer_bg_image_color') {
		
				jQuery('#jobcareer_headerbg_slider_1').hide();
		
				jQuery('#cs_headerbg_image_upload,#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box').show();
		
			} else if (value == 'none') {
		
				jQuery('#jobcareer_headerbg_slider_1').hide();
		
				jQuery('#cs_headerbg_image_upload,#cs_headerbg_color_color,#tab-header-options #cs_headerbg_image_box,#jobcareer_headerbg_slider_1').hide();
		
			}
		
		}
		
		
	/*
	* End set header backgorund function 
	*/
	
	
	/*
	* banner type toggle function 
	*/
		function cs_banner_type_toggle(type, id) {
			"use strict";
			if (type == 'image') {
				jQuery("#cs_banner_image_field_" + id).show();
				jQuery("#cs_banner_image_value_" + id).show();
				jQuery("#cs_banner_code_field_" + id).hide();
				jQuery("#cs_banner_code_value_" + id).hide();
			}
			else if (type == 'code') {
				jQuery("#cs_banner_image_field_" + id).hide();
				jQuery("#cs_banner_image_value_" + id).hide();
				jQuery("#cs_banner_code_field_" + id).show();
				jQuery("#cs_banner_code_value_" + id).show();
			}
		}
	/*
	* End banner type toggle function  
	*/
	
	
	
	/*
	* add banner field function 
	*/
		var counter_banner_field = 0;
		function jobcareer_add_banner_fields(admin_url, theme_url, id) {
			"use strict";
			counter_banner_field++;
			var banner_field = jQuery("#banner_title_input").val();
			var banner_field_style = jQuery("#banner_style_input").val();
			var banner_field_type = jQuery("#banner_type_input").val();
			var banner_field_image = jQuery("#banner_field_image" + id).val();
			var banner_field_url = jQuery("#banner_field_url_input").val();
			var banner_field_url_target = jQuery("#banner_field_url_target_input").val();
			var banner_field_code = jQuery("#banner_adsense_code_input").val();
			var check_field_value = banner_field_image;
			if (banner_field_type == 'code') {
				check_field_value = banner_field_code;
			}
			if (banner_field != "" && check_field_value != "") {
				jQuery("#banner-loader").html("<img src='" + theme_url + "/backend/assets/images/ajax_loading.gif' alt=''/>");
				var dataString = 'banner_field=' + banner_field +
						'&banner_field_style=' + banner_field_style +
						'&banner_field_type=' + banner_field_type +
						'&banner_field_image=' + banner_field_image +
						'&banner_field_url=' + banner_field_url +
						'&banner_field_url_target=' + banner_field_url_target +
						'&banner_field_code=' + banner_field_code +
						'&action=jobcareer_add_banner_fields';
				jQuery.ajax({
					type: "POST",
					url: admin_url,
					data: dataString,
					success: function (response) {
						jQuery("#banner-loader").html("");
						jQuery("#cs_banner_fields").append(response);
						jQuery(".banner-fields-area").show(200);
						jQuery("#banner_title_input,#banner_field_image" + id + ",#banner_field_url_input,#banner_adsense_code_input").val("");
						jQuery("#banner_field_image" + id + "_box").hide();
						jQuery("#banner_field_image" + id + "_img").removeAttr("src");
					}
				});
				//return false;
			}
			else {
				alert("Oops! please enter fields first.");
			}
		}
	/*
	* End add banner field function 
	*/
