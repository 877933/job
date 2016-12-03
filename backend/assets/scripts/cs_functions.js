
/**
 *
 * Document ready functions 
 */
var $ = jQuery;

jQuery(document).ready(function ($) {

    // "use strict";	
    /*
     * Media Upload 
     */
    /*Popover rtl Function*/
    $('body.rtl .cs-help').attr("data-placement", "left");

    var contheight;
    jQuery(document).on("click", ".jobcareer_uploadMedia", function () {
        var $ = jQuery;
        var id = $(this).attr("name");
        var custom_uploader = wp.media({
            title: 'Select File',
            button: {
                text: 'Add File'
            },
            multiple: false
        })
                .on('select', function () {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    jQuery('#' + id).val(attachment.url);
                    jQuery('#' + id + '_img').attr('src', attachment.url);
                    jQuery('#' + id + '_box').show();
                }).open();

    });
    /*
     * End Media Upload
     */

    //alert("before popover");
    //$('[data-toggle="popover"]').popover();
    //alert("after popover");

    //jQuery(document).ready(function(){
    if (jQuery('.skillbar').length != '') {
        //alert("here cs function file");
        jQuery('.skillbar').each(function () {
            $(this).waypoint(function (direction) {
                jQuery(this).find('.skillbar-bar').animate({
                    width: jQuery(this).attr('data-percent')
                }, 2000);
            }, {
                offset: "100%",
                triggerOnce: true
            });
        });
    }
    //});



    /*
     * Upload File URL
     */

    jQuery(document).on('click', 'uploadfileurl', function () {
        var $ = jQuery;
        var id = $(this).attr("name");
        var custom_uploader = wp.media({
            title: 'Select File',
            button: {
                text: 'Add File'
            },
            multiple: false
        })
                .on('select', function () {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    jQuery('#' + id).val(attachment.url);
                }).open();

    });
    /*
     * End Upload File URL
     */



    /*
     * CS meta fileds Tabs
     */
    var myUrl = window.location.href; //get URL
    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
    var myUrlTabName = myUrlTab.substring(0, 4); // For the above example, myUrlTabName = #tab
    jQuery("#tabbed-content > div").addClass('hidden-tab'); // Initially hide all content #####EDITED#####
    jQuery("#cs-options-tab li:first a").attr("id", "current"); // Activate first tab
    jQuery("#tabbed-content > div:first").hide().removeClass('hidden-tab').fadeIn(); // Show first tab content   #####EDITED#####
    jQuery("#cs-options-tab > li:first").addClass('active');

    jQuery("#cs-options-tab a").on("click", function (e) {
        e.preventDefault();
        if (jQuery(this).attr("id") == "current") { //detection for current tab
            return
        } else {
            resetTabs();
            console.log(this);
            jQuery("#cs-options-tab > li").removeClass('active')
            jQuery(this).attr("id", "current"); // Activate this
            jQuery(this).parents('li').addClass('active');
            jQuery(jQuery(this).attr('name')).hide().removeClass('hidden-tab').fadeIn(); // Show content for current tab
        }
    });

    for (i = 1; i <= jQuery("#cs-options-tab li").length; i++) {
        if (myUrlTab == myUrlTabName + i) {
            resetTabs();
            jQuery("a[name='" + myUrlTab + "']").attr("id", "current"); // Activate url tab
            jQuery(myUrlTab).hide().removeClass('hidden-tab').fadeIn(); // Show url tab content        
        }
    }

    /*
     * End CS meta fileds Tabs
     */


    /*
     * Page builder element size json format data
     */

    var Data = [
        {"Class": "column_100", "title": "100", "element": ["job_package","gallery", "cv_package", "jobs_search", "slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "column", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "multi_counters", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "job_specialisms", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about", "multiple_team", "newsletter"]},
        {"Class": "column_75", "title": "75", "element": ["job_package","cv_package", "jobs_search", "slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "column", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "heading", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "multi_counters", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "job_specialisms", "candidate", "tweets", "button", "call_to_action", "progressbars", "about", "multiple_team", "newsletter"]},
        {"Class": "column_67", "title": "67", "element": [, "slider", "column", "contact", "column", "message_box", "slider", "dropcap", "tabs", "advance_search", "prayer", "services", "heading", "testimonials", "promobox", "offerslider", "audio", "icons", "tooltip", "highlight", "mesage", "counter", "members", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "multi_counters", "flex_editor", "about", "list"]},
        {"Class": "column_50", "title": "50", "element": ["job_package","cv_package", "jobs_search", "slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "column", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "heading", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "multi_counters", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "job_specialisms", "candidate", "tweets", "button", "call_to_action", "progressbars", "about", "multiple_team", "newsletter"]},
        {"Class": "column_33", "title": "33", "element": [, "slider", "column", "contact", "column", "message_box", "slider", "dropcap", "tabs", "advance_search", "prayer", "services", "heading", "promobox", "offerslider", "audio", "icons", "tooltip", "highlight", "mesage", "counter", "members", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "multi_counters", "flex_editor", "about", "list"]},
        {"Class": "column_25", "title": "25", "element": ["jobs_search", "slider", "column", "accordions", "team", "quotes", "contact", "column", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "heading", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "multi_counters", "flex_editor", "multi_price_table", "tweets", "button", "call_to_action", "progressbars", "about", "multiple_team", "newsletter"]},
    ];

    var DataElement = [{
            "ClassName": "col_width_full",
            "element": ["gallery", "slider", "blog", "events", "contact", "parallax", "jobs_search"]
        }];


    var _commonshortcode = (function (id) {
        
        var mainConitem = jQuery("#" + id)
        var totalItemCon = mainConitem.find(".cs-wrapp-clone").size();
        mainConitem.find(".fieldCounter").val(totalItemCon);
        mainConitem.sortable({
            cancel: '.cs-clone-append .form-elements,.cs-disable-true',
            placeholder: "ui-state-highlight"
        });

    });

    /*
     * End Page builder element size json format data
     */
    /*
     *  Delete Element from page builder
     */


    var counter_ingredient = 0;
    var html_popup = "<div id='confirmOverlay' style='display:block'> \
											<div id='confirmBox'><div id='confirmText'>Are you sure to do this?</div> \
											<div id='confirmButtons'><div class='button confirm-yes'>Delete</div>\
											<div class='button confirm-no'>Cancel</div><br class='clear'></div></div></div>"
    // deleting the accordion start

    jQuery(document).on("click", "a.deleteit_node", function () {
        var mainConitem = jQuery(this).parents(".cs-wrapp-tab-box");
        jQuery(this).parent().append(html_popup);
        jQuery(this).parents(".cs-wrapp-clone").addClass("warning");
        jQuery(document).on('click', '.confirm-yes', function (event) {
            var totalItemCon = mainConitem.find(".cs-wrapp-clone").size();
            var totalItems = jQuery(".cs-wrapp-tab-box .fieldCounter").val();
            mainConitem.find(".fieldCounter").val(totalItems - 1);
            jQuery(this).parents(".cs-wrapp-clone").fadeOut(400, function () {
                //alert("i am here now to remove");
                jQuery(this).remove();
                return false;
            });

            jQuery("#confirmOverlay").remove();
        });

        jQuery(document).on('click', '.confirm-no', function (event) {
            jQuery(".cs-wrapp-clone").removeClass("warning");
            jQuery("#confirmOverlay").remove();
        });
        return false;
    });

    //page Section items delete start
    jQuery(document).on("click", ".btndeleteitsection", function () {
        jQuery(this).parents(".parentdeletesection").addClass("warning");
        jQuery(this).parent().append(html_popup);

        jQuery(document).on('click', '.confirm-yes', function (event) {
            jQuery(this).parents(".parentdeletesection").fadeOut(400, function () {
                jQuery(this).remove();
            });
            jQuery("#confirmOverlay").remove();
            count_widget--;
            if (count_widget == 0)
                jQuery("#add_page_builder_item").removeClass("hasclass");
        });
        jQuery(document).on('click', '.confirm-no', function (event) {
            jQuery(this).parents(".parentdeletesection").removeClass("warning");
            jQuery("#confirmOverlay").remove();
        });
        return false;
    });




    //page Builder items delete start
    jQuery(document).on("click", ".btndeleteit", function () {
        jQuery(this).parents(".parentdelete").addClass("warning");
        jQuery(this).parent().append(html_popup);

        jQuery(document).on('click', '.confirm-yes', function (event) {
            jQuery(this).parents(".parentdelete").fadeOut(400, function () {
                jQuery(this).remove();
            });

            jQuery(this).parents(".parentdelete").each(function () {
                var lengthitem = jQuery(this).parents(".dragarea").find(".parentdelete").size() - 1;
                jQuery(this).parents(".dragarea").find("input.textfld").val(lengthitem);
            });

            jQuery("#confirmOverlay").remove();
            count_widget--;
            if (count_widget == 0)
                jQuery("#add_page_builder_item").removeClass("hasclass");

        });
        jQuery(document).on('click', '.confirm-no', function (event) {
            jQuery(this).parents(".parentdelete").removeClass("warning");
            jQuery("#confirmOverlay").remove();
        });

        return false;
    });

    /**
     *
     *
     * End Delete Element from page builder
     */


    /**
     *
     *
     * select background Function
     */
    //jQuery('.bg_color').wpColorPicker();
    /*
     * End select background Function
     */


    /*
     * Location Tab
     */
    jQuery(document).on('click', 'a[href="#tab-location-settings-cs-events"]', function (event) {
        var map = jQuery("#cs-map-location-id")[0];
        setTimeout(function () {
            google.maps.event.trigger(map, 'resize');
        }, 400)
    });
    /*
     * End Location Tabs
     */


    /*
     * Wrapper style functions
     */
    jQuery(document).on('click', '#wrapper_boxed_layoutoptions1', function (event) {

        var theme_option_layout = jQuery('#wrapper_boxed_layoutoptions1 input[name=layout_option]:checked').val();
        if (theme_option_layout == 'wrapper_boxed') {
            jQuery("#layout-background-theme-options").show();
        } else {
            jQuery("#layout-background-theme-options").hide();
        }
    });


    jQuery(document).on('click', '#wrapper_boxed_layoutoptions2', function (event) {
        var theme_option_layout = jQuery('#wrapper_boxed_layoutoptions2 input[name=layout_option]:checked').val();
        if (theme_option_layout == 'wrapper_boxed') {
            jQuery("#layout-background-theme-options").show();
        } else {
            jQuery("#layout-background-theme-options").hide();

        }

    });

    /*
     * End Wrapper style functions
     */


    /*
     * Textarea header indent Function
     */
    $('textarea.header_code_indent').keydown(function (e) {
        if (e.keyCode == 9) {
            var start = $(this).get(0).selectionStart;
            $(this).val($(this).val().substring(0, start) + "    " + $(this).val().substring($(this).get(0).selectionEnd));
            $(this).get(0).selectionStart = $(this).get(0).selectionEnd = start + 4;
            return false;
        }
    });
    /*
     * End Textarea header indent Function
     */

    /*
     * Location tabs function bind tabshow class 
     */
    jQuery('#tab-location-settings-cs-events').bind('tabsshow', function (event, ui) {
        if (ui.panel.id == "map-tab") {
            resizeMap();
        }
    });
    /*
     *End Location tabs function bind tabshow class 
     */


    /*
     * hide div function
     */
    jQuery(".hidediv").hide();
    jQuery(document).on('click', '.showdiv', function (event) {
        jQuery(this).parents("article").stop().find(".hidediv").toggle(300);
    });
    /*
     * End hide div function  
     */


    /*
     * Gallery sorting function
     */

    jQuery(function ($) {
        // Product gallery file uploads
        var gallery_frame;

        jQuery('.add_gallery').on('click', 'input', function (event) {
            var $el = $(this);

            get_id = $el.parent('.add_gallery').data('id');
            rand_id = $el.parent('.add_gallery').data('rand_id');
            cs_theme_url = $("#cs_theme_url").val();
            $gallery_images = $('#gallery_container_' + rand_id + ' ul.gallery_images');
            attachment_ids = $('#' + get_id).val();
            //alert('#gallery_container_'+rand_id+' ul.gallery_images');
            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (gallery_frame) {
                gallery_frame.open();
                return;
            }

            // Create the media frame.
            gallery_frame = wp.media.frames.room_gallery = wp.media({
                // Set the title of the modal.
                title: $el.data('choose'),
                button: {
                    text: $el.data('update'),
                },
                states: [
                    new wp.media.controller.Library({
                        title: $el.data('choose'),
                        filterable: 'all',
                        multiple: true,
                    })
                ]
            });

            // When an image is selected, run a callback.
            gallery_frame.on('select', function () {

                var selection = gallery_frame.state().get('selection');

                selection.map(function (attachment) {

                    attachment = attachment.toJSON();

                    if (attachment.type == 'image') {
                        var gallery_url = attachment.url;
                    } else if (attachment.type == 'audio') {
                        var gallery_url = cs_theme_url + '/backend/assets/images/audio.png';
                    } else if (attachment.type == 'video') {
                        var gallery_url = cs_theme_url + '/backend/assets/images/video.png';
                    } else {
                        var gallery_url = cs_theme_url + '/backend/assets/images/attachment.png';
                    }

                    if (attachment.id) {
                        attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
                        $('#gallery_container_' + rand_id + ' ul.gallery_images').append('\
							<li class="image" data-attachment_id="' + attachment.id + '">\
								<img src="' + gallery_url + '" />\
								<div class="actions">\
									<span><a href="javascript:;" class="delete" title="' + $el.data('delete') + '"><i class="icon-times"></i></a></span>\
								</div>\
							</li>');
                    }

                });

                var gallery = []; // more efficient than new Array()
                jQuery('#gallery_sortable_' + rand_id + ' li').each(function () {
                    var data_value = jQuery.trim(jQuery(this).data('attachment_id'));
                    gallery.push(jQuery(this).data('attachment_id'));
                });

                jQuery("#" + get_id).val(gallery.toString());
            });

            // Finally, open the modal.
            gallery_frame.open();
        });

    });

    /*
     * End Gallery sorting function
     */







});
/*
 * Document ready functions end
 */


/*
 * Reset Tabs Functions
 */
function resetTabs() {
    "use strict";
    jQuery("#tabbed-content > div").addClass('hidden-tab'); //Hide all content
    jQuery("#cs-options-tab a").attr("id", ""); //Reset id's      
}
/*
 * End Reset Tabs Functions
 */


/*
 * Delete Media Functions
 */
function del_media(id) {
    "use strict";
    var $ = jQuery;
    //jQuery('input[name="'+id+'"]').show();
    jQuery('#' + id + '_box').hide();
    jQuery('#' + id).val('');
    jQuery('#' + id).next().show();
}
/*
 * End Delete Media Functions
 */

/*
 * toggle With Value Functions
 */
function toggle_with_value(id) {
    "use strict";
    if (id == 0) {
        jQuery("#wrapper_repeat_event").hide();
    } else {
        jQuery("#wrapper_repeat_event").show();
    }
}
/*
 * End toggle With Value Functions
 */

/*
 *  Get map locations
 */
function gll_search_map() {
    "use strict";
    var vals;
    vals = jQuery('#cs_location_address').val();
    vals = vals + ", " + jQuery('#cs_loc_city').val();
    vals = vals + ", " + jQuery('#cs_loc_region').val();
    vals = vals + ", " + jQuery('#cs_loc_country').val();
    jQuery('.gllpSearchField').val(vals);
}
/*
 * End Get map locations
 */


/*
 *  Remove Image function
 */
function remove_image(id) {
    "use strict";
    var $ = jQuery;
    $('#' + id).val('');
    $('#' + id + '_img_div').hide();

}
/*
 * End Remove Image function
 */

/*
 *  Message Slide show functions
 */
function slideout() {
    "use strict";
    setTimeout(function () {
        jQuery(".form-msg").slideUp("slow", function () {
        });
    }, 5000);
}
/*
 *End Message Slide show functions
 */


/*
 *  Remove div Function
 */
function cs_div_remove(id) {
    "use strict";
    jQuery("#" + id).remove();
}

/*
 *End Remove div Function
 */


/*
 *  toggle Function
 */
function cs_toggle(id) {
    "use strict";
    jQuery("#" + id).slideToggle("slow");
}

/*
 *  End toggle Function
 */




/*
 *  Post Slider function
 */

function cs_toggle_height(value, id) {
    "use strict";
    var $ = jQuery;
    if (value == "Post Slider") {
        jQuery("#post_slider" + id).show();
        jQuery("#choose_slider" + id).hide();
        jQuery("#layer_slider" + id).hide();
        jQuery("#show_post" + id).show();
    } else if (value == "Flex Slider") {
        jQuery("#choose_slider" + id).show();
        jQuery("#layer_slider" + id).hide();
        jQuery("#post_slider" + id).hide();
        jQuery("#show_post" + id).hide();
    } else if (value == "Custom Slider") {
        jQuery("#layer_slider" + id).show();
        jQuery("#choose_slider" + id).hide();
        jQuery("#post_slider" + id).hide();
        jQuery("#show_post" + id).hide();
    } else {
        jQuery("#" + id).removeClass("no-display");
        jQuery("#post_slider" + id).show();
        jQuery("#choose_slider" + id).hide();
        jQuery("#layer_slider" + id).hide();
        jQuery("#show_post" + id).hide();
    }
}
/*
 *  End Post Slider function
 */


/*
 *  toggle list function
 */

function cs_toggle_list(value, id) {
    "use strict";
    var $ = jQuery;

    if (value == "custom_icon") {
        jQuery("#" + id).addClass("no-display");
        jQuery("#cs_list_icon").show();
    } else {
        jQuery("#" + id).removeClass("no-display");
        jQuery("#cs_list_icon").hide();
    }
}
/*
 *  End toggle list function
 */

/*
 *  Counter image function
 */

function cs_counter_image(value, id) {
    "use strict";
    var $ = jQuery;
    if (value == "icon") {
        jQuery(".selected_image_type" + id).hide();
        jQuery(".selected_icon_type" + id).show();
    } else {
        jQuery(".selected_image_type" + id).show();
        jQuery(".selected_icon_type" + id).hide();
    }

}

/*
 * End Counter image function
 */
function cs_display_url_field(id) {
    "use strict";
    if (id == 'yes') {
        jQuery("#advance_url_field").show();
    } else {
        jQuery("#advance_url_field").hide();
        jQuery("#cs_job_advance_search_url").val('');

    }
    return true;
}

/*
 *  Counter view type function
 */
function cs_counter_view_type(value, id) {
    "use strict";
    var $ = jQuery;

    if (value == "icon-border") {
        jQuery("#selected_view_icon_type" + id).hide();
        jQuery("#selected_view_border_type" + id).show();
        jQuery("#selected_view_icon_image_type" + id).hide();
        jQuery("#selected_view_icon_icon_type" + id).show();
    } else {
        jQuery("#selected_view_icon_type" + id).show();
        jQuery("#selected_view_border_type" + id).hide();
        jQuery("#selected_view_icon_image_type" + id).show();
    }

}
/*
 *  End Counter view type function
 */

/*
 *  Service toggle Image Function
 */
function cs_service_toggle_image(value, id, object) {
    "use strict";
    var $ = jQuery;
    var selectedValue = $('#cs_service_type-' + id).val();
    if (value == "image") {
        jQuery("#modern-size-" + id).hide();
        jQuery("#selected_image_type" + id).show();
        jQuery("#selected_icon_type" + id).hide();

    } else if (value == "icon") {
        if (selectedValue == 'modern') {
            jQuery("#modern-size-" + id).show();
        } else {
            jQuery("#modern-size-" + id).hide();
        }

        jQuery("#selected_image_type" + id).hide();
        jQuery("#selected_icon_type" + id).show();
    }

}
/*
 *  End Service toggle Image Function
 */

/*
 *  Service toggle view Function
 */

function cs_service_toggle_view(value, id, object) {
    "use strict";
    var $ = jQuery;
    if (value == "modern") {
        jQuery("#cs-service-bg-color-" + id).show();
        jQuery("#modern-size-" + id).show();
        jQuery("#service-position-classic-" + id).hide();
        jQuery("#service-position-modern-" + id).show();
        jQuery("#cs-modern-bg-color-" + id + " #bg-service").html('Button bg Color');

    } else if (value == "classic") {
        jQuery("#modern-size-" + id).hide();
        jQuery("#cs-service-bg-color-" + id).hide();
        jQuery("#service-position-modern-" + id).hide();
        jQuery("#service-position-classic-" + id).show();
        jQuery("#cs-modern-bg-color-" + id + " #bg-service").html('Text Color');
    }

}

/*
 * End Service toggle view Function
 */
function hide_show_fields(value) {
    var value;
    if (value == 'default') {
        jQuery('#call_to_action_id').show();
        jQuery('#call_to_action_img_id').hide();
    } else {
        jQuery('#call_to_action_id').hide();
        jQuery('#call_to_action_img_id').show();
    }

}

/*
 *  icon toggle view Function
 */

function cs_icon_toggle_view(value, id, object) {
    "use strict";
    var $ = jQuery;
    if (value == "bg_style") {
        jQuery("#selected_icon_view_" + id + " #label-icon").html('Icon Background Color');

    } else if (value == "border_style") {
        jQuery("#selected_icon_view_" + id + " #label-icon").html('Border Color');
    }

}
/*
 *  icon toggle view Function
 */

/*
 *  Price table value function
 */
function cs_pricetable_style_vlaue(value, id) {
    "use strict";
    var $ = jQuery;
    if (value == "classic") {
        jQuery("#pricetbale-title" + id).hide();
    } else {
        jQuery("#pricetbale-title" + id).show();
    }
}
/*
 *  End Price table value function
 */

/*
 *  Side bar show function
 */
function show_sidebar(id, random_id) {
    "use strict";
    var $ = jQuery;
    jQuery(document).on('click', 'input[class="radio_cs_sidebar"]', function (event) {
        jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
        jQuery(this).siblings("label").children("#check-list").addClass("check-list");
    });
    var randomeID = "#" + random_id;
    if ((id == 'left') || (id == 'right')) {
        $(randomeID + "_sidebar_right," + randomeID + "_sidebar_left").hide();
        $(randomeID + "_sidebar_" + id).show();
    } else if ((id == 'both') || (id == 'none')) {
        $(randomeID + "_sidebar_right," + randomeID + "_sidebar_left").hide();
    }
}
/*
 *  End Side bar show function
 */







/*
 *  show page side bar function 
 */
function show_sidebar_page(id) {
    "use strict";
    var $ = jQuery;
    jQuery(document).on('click', 'input[name="cs_page_layout"]', function () {
        jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
        jQuery(this).siblings("label").children("#check-list").addClass("check-list");
    });
    if ((id == 'left') || (id == 'right')) {
        $("#wrapper_sidebar_left,#wrapper_sidebar_right").hide();
        $("#wrapper_sidebar_" + id).show();
    } else if (id == 'both') {
        $("#wrapper_sidebar_right,#wrapper_sidebar_left").show();
    } else if (id == 'none') {
        $("#wrapper_sidebar_right,#wrapper_sidebar_left").hide();
    }
}
/*
 * End show page side bar function 
 */


/*
 * gallery toggle function 
 */
function cs_toggle_gal(id, counter) {
    "use strict";
    if (id == 0) {
        jQuery("#link_url" + counter).hide();
        jQuery("#video_code" + counter).hide();
    } else if (id == 1) {
        jQuery("#link_url" + counter).hide();
        jQuery("#video_code" + counter).show();
    } else if (id == 2) {
        jQuery("#link_url" + counter).show();
        jQuery("#video_code" + counter).hide();
    }
}
/*
 * End gallery toggle function 
 */


/*
 * delete item function 
 */
var counter = 0;
function delete_this(id) {
    "use strict";
    jQuery('#' + id).remove();
    jQuery('#' + id + '_del').remove();
    count_widget--;
    if (count_widget < 1)
        jQuery("#add_page_builder_item").addClass("hasclass");
}
/*
 * End delete item function 
 */


/*
 * Delete social icon function
 */

function social_icon_del(id) {
    "use strict";
    jQuery("#del_" + id).remove();
    jQuery("#" + id).remove();
}

/*
 * End Delete social icon function
 */



/*
 * Slider Element Toggle Function
 */
function cs_slider_element_toggle(id) {
    "use strict";
    if (id == 'default_header') {
        jQuery("#wrapper_default_header").hide();
        jQuery("#wrapper_breadcrumb_header").hide();
        jQuery("#wrapper_custom_slider").hide();
        jQuery("#wrapper_map").hide();
        jQuery("#wrapper_no-header").hide();
    } else if (id == 'custom_slider') {
        jQuery("#wrapper_custom_slider").show();
        jQuery("#wrapper_default_header").hide();
        jQuery("#wrapper_breadcrumb_header").hide();
        jQuery("#wrapper_map").hide();
        jQuery("#wrapper_no-header").hide();
    } else if (id == 'no-header') {
        jQuery("#wrapper_no-header").show();
        jQuery("#wrapper_default_header").hide();
        jQuery("#wrapper_breadcrumb_header").hide();
        jQuery("#wrapper_custom_slider").hide();
        jQuery("#wrapper_map").hide();
    } else if (id == 'breadcrumb_header') {
        jQuery("#wrapper_breadcrumb_header").show();
        jQuery("#wrapper_default_header").show();
        jQuery("#wrapper_custom_slider").hide();
        jQuery("#wrapper_map").hide();
        jQuery("#wrapper_no-header").hide();
    } else if (id == 'map') {
        jQuery("#wrapper_map").show();
        jQuery("#wrapper_default_header").hide();
        jQuery("#wrapper_breadcrumb_header").hide();
        jQuery("#wrapper_custom_slider").hide();
        jQuery("#wrapper_no-header").hide();
    } else {
        jQuery("#wrapper_default_header").hide();
        jQuery("#wrapper_breadcrumb_header").hide();
        jQuery("#wrapper_custom_slider").hide();
        jQuery("#wrapper_map").hide();
        jQuery("#wrapper_no-header").hide();
    }

}
/*
 * End Slider Element Toggle 
 */

/*
 *  hide show toggle function
 */
function cs_hide_show_toggle(id, div, type) {
    "use strict";
    if (type == 'theme_options') {
        if (id == 'default') {
            jQuery("#cs_sh_paddingtop_range").hide();
            jQuery("#cs_sh_paddingbottom_range").hide();
        } else if (id == 'custom') {
            jQuery("#cs_sh_paddingtop_range").show();
            jQuery("#cs_sh_paddingbottom_range").show();
        }

    } else {
        if (id == 'default') {
            jQuery("#" + div).hide();
        } else if (id == 'custom') {
            jQuery("#" + div).show();
        }
    }
}
/*
 * End  hide show toggle function
 */


/*
 *  Section background setting function
 */
function cs_section_background_settings_toggle(id, rand_no) {
    "use strict";
    if (id == "no-image") {
        jQuery(".section-custom-background-image-" + rand_no).hide();
        jQuery(".section-slider-" + rand_no).hide();
        jQuery(".section-custom-slider-" + rand_no).hide();
        jQuery(".section-background-video-" + rand_no).hide();
    } else if (id == "section-custom-background-image") {
        jQuery(".section-slider-" + rand_no).hide();
        jQuery(".section-custom-slider-" + rand_no).hide();
        jQuery(".section-background-video-" + rand_no).hide();
        jQuery(".section-custom-background-image-" + rand_no).show();
    } else if (id == "section-slider") {
        jQuery(".section-custom-background-image-" + rand_no).hide();
        jQuery(".section-slider-" + rand_no).show();
        jQuery(".section-custom-slider-" + rand_no).hide();
        jQuery(".section-background-video-" + rand_no).hide();

    } else if (id == "section-custom-slider") {
        jQuery(".section-custom-background-image-" + rand_no).hide();
        jQuery(".section-slider-" + rand_no).hide();
        jQuery(".section-custom-slider-" + rand_no).show();
        jQuery(".section-background-video-" + rand_no).hide();

    } else if (id == "section_background_video") {
        jQuery(".section-custom-background-image-" + rand_no).hide();
        jQuery(".section-slider-" + rand_no).hide();
        jQuery(".section-custom-slider-" + rand_no).hide();
        jQuery(".section-background-video-" + rand_no).show();

    } else {
        jQuery(".section-custom-background-image-" + rand_no).hide();
        jQuery(".section-slider-" + rand_no).hide();
        jQuery(".section-custom-slider-" + rand_no).hide();
        jQuery(".section-background-video-" + rand_no).hide();
    }
}
/*
 *  End Section background setting function
 */


/*
 *  thumbnail view function
 */
function cs_thumbnail_view(id) {
    "use strict";
    if (id == "none") {
        jQuery("#wrapper_thumb_slider").hide();
        jQuery("#wrapper_post_thumb_image").hide();

    } else if (id == "single") {
        jQuery("#wrapper_thumb_slider").hide();
        jQuery("#wrapper_post_thumb_image").show();
        jQuery("#wrapper_thumb_audio").hide();
    } else if (id == "slider") {
        jQuery("#wrapper_post_thumb_image").hide();
        jQuery("#wrapper_thumb_slider").show();
        jQuery("#wrapper_thumb_audio").hide();
    } else if (id == "audio") {
        jQuery("#wrapper_post_thumb_image").hide();
        jQuery("#wrapper_thumb_slider").hide();
        jQuery("#wrapper_thumb_audio").show();
    }


}
/*
 *  End thumbnail view function
 */


/*
 *  thumbnail view function
 */
function cs_post_view(id) {
    "use strict";
    if (id == "single") {
        jQuery("#wrapper_post_detail, #wrapper_post_detail_slider, #wrapper_audio_view, #wrapper_video_view").hide();
        jQuery("#wrapper_post_detail").show();
    } else if (id == "audio") {
        jQuery("#wrapper_post_detail, #wrapper_post_detail_slider, #wrapper_audio_view, #wrapper_video_view").hide();
        jQuery("#wrapper_audio_view").show();
    } else if (id == "video") {
        jQuery("#wrapper_post_detail, #wrapper_post_detail_slider, #wrapper_audio_view, #wrapper_video_view").hide();
        jQuery("#wrapper_video_view").show();
    } else if (id == "slider") {
        jQuery("#wrapper_post_detail, #wrapper_post_detail_slider, #wrapper_audio_view, #wrapper_video_view").hide();
        jQuery("#wrapper_post_detail_slider").show();
    } else {
        jQuery("#wrapper_post_detail, #wrapper_post_detail_slider, #wrapper_audio_view, #wrapper_video_view").hide();
    }
}
/*
 *  End thumbnail view function
 */


function cs_sub_header_show_slider(cs_value) {
    "use strict";
    if (cs_value == 'slider') {
        $('#cs_no_header_fields').hide();
        $('#cs_rev_slider_fields').show();
        $('#jobcareer_breadcrumbs_fields').hide();
    } else if (cs_value == 'no_header') {
        $('#cs_no_header_fields').show();
        $('#cs_rev_slider_fields').hide();
        $('#jobcareer_breadcrumbs_fields').hide();
    } else {
        $('#cs_no_header_fields').hide();
        $('#cs_rev_slider_fields').hide();
        $('#jobcareer_breadcrumbs_fields').show();

    }
}


/*
 *  add field function
 */
function cs_add_field(id, type) {
    "use strict";
    var wrapper = jQuery("#" + id + " .input_fields_wrap"); //Fields wrapper
    var items = jQuery("#" + id + " .input_fields_wrap > div").length + 1;
    var uniqueNum = type + '_' + Math.floor(Math.random() * 99999);
    var remove = 'javascript:cs_remove_field("' + uniqueNum + '","' + id + '")';
    jQuery("#" + id + "  .counter_num").val(items);
    jQuery(wrapper).append('<div class="cs-wrapp-clone cs-shortcode-wrapp  cs-pbwp-content" id="' + uniqueNum + '"><ul class="form-elements bcevent_title"><li class="to-label"><label>Pricing Feature ' + items + '</label></li><li class="to-field"><div class="input-sec"><input class="txtfield" type="text" value="" name="pricing_feature[]"></div><div id="price_remove"><a class="remove_field" onclick=' + remove + '><i class="icon-minus-circle" style="color:#000; font-size:18px"></i></div></a></li></ul></div>');
}
/*
 *  End add field function
 */


/*
 *  Remove field function 
 */
function cs_remove_field(id, wrapper) {
    "use strict";
    var totalItems = jQuery("#" + wrapper + "  .counter_num").val() - 1;
    jQuery("#" + wrapper + "  .counter_num").val(totalItems);
    jQuery("#" + wrapper + " #" + id + "").remove();
}
/*
 * End Remove field function 
 */

/*
 *  Create clone functions
 */
function _createclone(object, id, section, post) {
    "use strict";
    var _this = object.closest(".column");
    _this.clone().insertAfter(_this);
    //jQuery('.bg_color').wpColorPicker();
    callme();
    
    jQuery(".draginner").sortable({
       
        connectWith: '.draginner',
        handle: '.column-in',
        cancel: '.draginner .poped-up,#confirmOverlay',
        revert: false,
        start: function (event, ui) {
            jQuery(ui.item).css({"width": "25%"})
        },
        receive: function (event, ui) {
            callme();
            getsorting(ui)
        },
        placeholder: "ui-state-highlight",
        forcePlaceholderSize: true
    });
    return false;
}
/*
 * End Create clone functions
 */


/*
 *   Send ajax request for widget element 
 */
function ajax_shortcode_widget_element(object, admin_url, POSTID, name) {
    "use strict";
    var action = '';
    var $elem;
    var wraper = object.closest(".column-in").next();
    var _structure = "<div id='cs-pbwp-outerlay'><div id='cs-widgets-list'></div></div>",
            $elem = jQuery('#cs-widgets-list');

    jQuery(wraper).wrap(_structure).delay(100).fadeIn(150);
    var shortcodevalue = object.closest(".column-in").next().find(".cs-textarea-val").val();
    if (shortcodevalue) {

        var elementnamevalue = object.closest(".column-in").next().find(".cs-dcpt-element").val();
        SuccessLoader();
        //_createpop(wraper, "filterdrag");
        counter++;
        var dcpt_element_data = '';
        if (elementnamevalue) {
            var dcpt_element_data = '&element_name=' + elementnamevalue;
        }
        var newCustomerForm = "action=jobcareer_pb_" + name + '&counter=' + '17' + '&shortcode_element_id=' + encodeURIComponent(shortcodevalue) + '&POSTID=' + POSTID + dcpt_element_data;
    
        var edit_url = action + counter;
        //_createpop();
        jQuery.ajax({
            type: "POST",
            url: admin_url,
            data: newCustomerForm,
            success: function (data) {
                var rsponse = data;
                var response_html = jQuery(rsponse).find(".cs-pbwp-content").html();
                object.closest(".column-in").next().find(".pagebuilder-data-load").html(response_html);
                object.closest(".column-in").next().find(".cs-wiget-element-type").val('form');
                jQuery('.loader').remove();
                jQuery('.bg_color').wpColorPicker();
                jQuery('div.cs-drag-slider').each(function () {
                    var _this = jQuery(this);
                    _this.slider({
                        range: 'min',
                        step: _this.data('slider-step'),
                        min: _this.data('slider-min'),
                        max: _this.data('slider-max'),
                        value: _this.data('slider-value'),
                        slide: function (event, ui) {
                            jQuery(this).parents('li.to-field').find('.cs-range-input').val(ui.value)
                        }
                    });
                });
                jQuery(".draginner").sortable({
                    
                    connectWith: '.draginner',
                    handle: '.column-in',
                    cancel: '.draginner .poped-up,#confirmOverlay',
                    revert: false,
                    receive: function (event, ui) {
                        callme();
                        getsorting(ui)
                    },
                    placeholder: "ui-state-highlight",
                    forcePlaceholderSize: true

                });
            }
        });
    }
}
/*
 *  End Send ajax request for widget element  function
 *
 *   Overley remove function
 */
function _removerlay(object) {
    "use strict";
    var $elem;
    jQuery("#cs-widgets-list .loader").remove();
    var _elem1 = "<div id='cs-pbwp-outerlay'></div>",
            _elem2 = "<div id='cs-widgets-list'></div>";
    $elem = object.closest('div[class*="cs-wrapp-class-"]');
    $elem.unwrap(_elem2);
    $elem.unwrap(_elem1);
    $elem.hide()
}

/*
 * End Overley remove function
 */


/*
 *  Create popshort function
 */
function _createpopshort(object) {
    "use strict";
    var $elem;
    var _structure = "<div id='cs-pbwp-outerlay'><div id='cs-widgets-list'></div></div>",
            $elem = jQuery('#cs-widgets-list');
    var a = object.closest(".column-in").next();
    jQuery(a).wrap(_structure).delay(100).fadeIn(150);
}
/*
 * End Create popshort function
 */

/*
 *  Header options functions
 */
function cs_header_option(val) {
    "use strict";
    if (val == 'none') {
        jQuery('#wrapper_rev_slider,#wrapper_headerbg_image').hide();
    } else if (val == 'cs_rev_slider') {
        jQuery('#wrapper_rev_slider').fadeIn();
        jQuery('#wrapper_headerbg_image').hide();
    } else if (val == 'jobcareer_bg_image_color') {
        jQuery('#wrapper_headerbg_image').fadeIn();
        jQuery('#wrapper_rev_slider').hide();
    }
}
/*
 * End Header options functions
 */

/*
 *  Bannner widget options function
 */
function cs_banner_widget_toggle(view, id) {
    "use strict";
    if (view == 'random') {
        jQuery("#cs_banner_style_field_" + id).show();
        jQuery("#cs_banner_code_field_" + id).hide();
        jQuery("#cs_banner_number_field_" + id).show();
    } else if (view == 'single') {
        jQuery("#cs_banner_style_field_" + id).hide();
        jQuery("#cs_banner_code_field_" + id).show();
        jQuery("#cs_banner_number_field_" + id).hide();
    }
}

/*
 * Bannner widget options function
 */
function cs_service_view_change(value) {
    //alert('hello');

}
jQuery('.function-class').change(function ($) {
    var value = jQuery(this).val();
    //alert('hello');
    var parentNode = jQuery(this).parent().parent().parent();
    if (value == 'image') {
        //alert(parentNode);
        parentNode.find(".cs-sh-service-image-area").show();
        parentNode.find(".cs-sh-service-icon-area").hide();
        /*
         jQuery(".cs-sh-service-image-area").show();
         jQuery(".cs-sh-service-icon-area").hide();
         */
    } else {
        parentNode.find(".cs-sh-service-image-area").show();
        parentNode.find(".cs-sh-service-image-area").hide();
        /*
         jQuery(".cs-sh-service-image-area").hide();
         jQuery(".cs-sh-service-icon-area").show();
         */
    }

}
);
/*
 function cs_service_view_change(value) {
 
 
 }
 */

/*
 *  Gallery Sorting list Functions
 */
function cs_gallery_sorting_list(id, random_id) {
    "use strict";
    var gallery = []; // more efficient than new Array()
    jQuery('#gallery_sortable_' + random_id + ' li').each(function () {
        var data_value = jQuery.trim(jQuery(this).data('attachment_id'));
        gallery.push(jQuery(this).data('attachment_id'));
    });

    jQuery("#" + id).val(gallery.toString());
}

/*
 *  End Gallery Sorting list Functions
 */


/*
 *  add quiliy list functions
 */

var counter_qual = 0;
function add_qual_list(admin_url, theme_url) {
    "use strict";
    counter_qual++;
    var dataString = 'cs_qual_name=' + jQuery("#cs_qual_name").val() +
            '&cs_qual_desc=' + jQuery("#cs_qual_desc").val() +
            '&action=add_qual_to_list';
    jQuery(".feature-loader").html("<i class='icon-spinner8 icon-spin'></i>");
    jQuery.ajax({
        type: "POST",
        url: admin_url,
        data: dataString,
        success: function (response) {
            jQuery("#total_quals").append(response);
            jQuery(".feature-loader").html("");
            removeoverlay('add_qual_title', 'append');
            jQuery("#cs_qual_name").val("Title");
            jQuery("#cs_qual_desc").val("");
        }
    });
    return false;
}
/*
 * End add quiliy list function
 */


/*
 *  add schedule list function
 */
var counter_schedule = 0;
function add_schedule_list(admin_url, theme_url) {
    "use strict";
    counter_schedule++;
    var dataString = 'cs_schedule_name=' + jQuery("#cs_schedule_name").val() +
            '&cs_schedule_time=' + jQuery("#cs_schedule_time").val() +
            '&cs_schedule_desc=' + jQuery("#cs_schedule_desc").val() +
            '&action=add_schedule_to_list';
    jQuery(".feature-loader").html("<i class='icon-spinner8 icon-spin'></i>");
    jQuery.ajax({
        type: "POST",
        url: admin_url,
        data: dataString,
        success: function (response) {
            jQuery("#total_schedules").append(response);
            jQuery(".feature-loader").html("");
            removeoverlay('add_schedule_title', 'append');
            jQuery("#cs_schedule_name").val("Title");
            jQuery("#cs_schedule_time").val("");
            jQuery("#cs_schedule_desc").val("");
        }
    });
    return false;
}
/*
 *  End add schedule list function
 */




/*
 *End popup over trigger
 */



/*
 *  add camp schedule list function
 */
var counter_camp_sched = 0;
function add_camp_sched_list(admin_url, theme_url) {
    "use strict";
    counter_camp_sched++;
    var dataString = 'cs_camp_sched_name=' + jQuery("#cs_camp_sched_name").val() +
            '&cs_camp_sched_time=' + jQuery("#cs_camp_sched_time").val() +
            '&cs_camp_sched_loc=' + jQuery("#cs_camp_sched_loc").val() +
            '&cs_camp_sched_desc=' + jQuery("#cs_camp_sched_desc").val() +
            '&action=add_camp_sched_to_list';
    jQuery(".feature-loader").html("<i class='icon-spinner8 icon-spin'></i>");
    jQuery.ajax({
        type: "POST",
        url: admin_url,
        data: dataString,
        success: function (response) {
            jQuery("#total_camp_scheds").append(response);
            jQuery(".feature-loader").html("");
            removeoverlay('add_camp_sched_title', 'append');
            jQuery("#cs_camp_sched_name").val("Title");
            jQuery("#cs_camp_sched_time").val("");
            jQuery("#cs_camp_sched_loc").val("");
            jQuery("#cs_camp_sched_desc").val("");
        }
    });
    return false;
}

/*
 *  End add camp schedule list function
 */


/*
 * chosen selection box
 */

function chosen_selectionbox() {
    if (jQuery('.chosen-select, .chosen-select-deselect, .chosen-select-no-single, .chosen-select-no-results, .chosen-select-width').length != '') {
        var config = {
            '.chosen-select': {width: "100%"},
            '.chosen-select-deselect': {allow_single_deselect: true},
            '.chosen-select-no-single': {disable_search_threshold: 10, width: "100%"},
            '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
            '.chosen-select-width': {width: "95%"}
        }
        for (var selector in config) {
            jQuery(selector).chosen(config[selector]);
        }
    }
}

/*
 * End chosen selection box
 */
