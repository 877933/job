/*
 * Document ready functions 
 */
var $ = jQuery;
jQuery(document).ready(function ($) {
    "use strict";
    /*
     * Remove post type meta id div function
     */
    $('#cs_dynamic_custom_post_type_meta_id .handlediv').remove();
    $('#cs_dynamic_custom_post_type_meta_id h3.hndle').remove();

    /*
     * End Remove post type meta id div function
     */


    /*
     * popover function for hint text
     */

    //$('[data-toggle="popover"]').popover();
    jQuery('[data-toggle="popover"]').popover({trigger: "hover", placement: "top"});

    /*
     * End popover function for hint text
     */


});
/*
 * Document ready functions end
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
 * Page builder element size json format data
 */
var Data = [
    {"Class": "column_100", "title": "100", "element": ["gallery","cv_package","jobs_search", "slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "job_specialisms", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about", "multiple_team", "newsletter"]},
    {"Class": "column_75", "title": "75", "element": ["cv_package","jobs_search","slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "job_specialisms", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about", "multiple_team", "newsletter"]},
    {"Class": "column_67", "title": "67", "element": ["cv_package","jobs_search", "slider", "blog", "column", "accordions", "team", "quotes", "contact", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about","multiple_team", "newsletter"]},
    {"Class": "column_50", "title": "50", "element": ["cv_package","jobs_search","slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "job_specialisms", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about", "multiple_team", "newsletter"]},
    {"Class": "column_33", "title": "33", "element": ["cv_package","jobs_search","slider", "blog", "column", "accordions", "team", "quotes", "contact", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about", "multiple_team", "newsletter"]},
    {"Class": "column_25", "title": "25", "element": ["cv_package","jobs_search", "slider", "blog", "column", "accordions", "team", "client", "quotes", "contact", "divider", "message_box", 'image', "image_frame", "map", "video", "slider", "dropcap", "pricetable", "tabs", "accordion", "advance_search", "prayer", "teams", "services", "table", "flex_column", "clients", "spacer", "heading", "testimonials", "infobox", "promobox", "offerslider", "audio", "icons", "contactform", "tooltip", "highlight", "list", "mesage", "faq", "counter", "members", "icon_box", "mailchimp", "facilities", "events", "team_post", "portfolio", "quick_slider", "flex_editor", "multi_price_table", "candidate", "employer", "jobs", "candidate", "tweets", "button", "call_to_action", "progressbars", "sitemap", "about", "multiple_team", "newsletter"]},
];

/*
 * End Page builder element size json format data
 */



/*
 * Parent delete function
 */
function callme() {
    "use strict";
    jQuery(".dragarea").each(function (index) {
        var lengthitem = jQuery(this).find(".parentdelete").size()
        jQuery(this).find("input.textfld").val(lengthitem);
    });
}
/*
 * End Parent delete function
 */


/*
 * sort div function
 */
function callmeontime() {
    "use strict";
    jQuery(".dradginner").sortable({
        connectWith: '.draginner',
        revert: true,
        handle: '.column-in',
        cancel: '.draginner .poped-up,#confirmOverlay',
        placeholder: "ui-state-highlight",
        receive: function (event, ui) {
            callme();
        }
    });
}

/*
 * End sort div function
 */


/*
 * Element decreament size function
 */
var DataElement = [{"ClassName": "col_width_full", "element": ["gallery", "slider", "blog", "spacer", "event", "contact", "parallax", "services","jobs_search"]}];
function decrement(id) {     //alert("decremnet");
    //"use strict";
    var $ = jQuery;
    //alert(id);
    var parent, ColumnIndex, CurrentWidget, CurrentColumn, module;
    parent = $(id).parent('.column-in');
    parent = $(parent).parent('.column');
    CurrentColumn = parseInt($(parent).attr('data'));
    CurrentWidget = $(parent).attr('widget');
    ColumnIndex = parseInt($(parent).attr('data'));
    module = $(parent).attr('item').toString();
    for (i = ColumnIndex + 1; i < Data.length; i++) {
      
        for (c = 0; c <= Data[i].element.length; c++) {
            if (Data[i].element[c] == module) {
                $(parent).removeClass(Data[ColumnIndex].Class)
                $(parent).addClass(Data[i].Class)
                $(parent).find('.ClassTitle').text(Data[i].title);
                $(parent).find('.item').val(Data[i].title);
                $(parent).find('.columnClass').val(Data[i].Class)
                $(parent).attr('data', i);
                return false;
            }
        }
    }
}

function increment(id) {
    //alert("increamnet");
    //"use strict";
    var $ = jQuery;
    var parent, ColumnIndex, CurrentWidget, CurrentColumn, module;
    parent = $(id).parent('.column-in');
    parent = $(parent).parent('.column');
    CurrentColumn = parseInt($(parent).attr('data'));
    CurrentWidget = $(parent).attr('widget');
    ColumnIndex = parseInt($(parent).attr('data'));
    module = $(parent).attr('item').toString();
    if (ColumnIndex > 0) {
        for (i = ColumnIndex - 1; i < Data.length; i--) {
           
            for (c = 0; c <= Data[i].element.length; c++) {
                if (Data[i].element[c] == module) {
                    $(parent).removeClass(Data[ColumnIndex].Class)
                    $(parent).addClass(Data[i].Class)
                    $(parent).find('.ClassTitle').text(Data[i].title);
                    $(parent).find('.item').val(Data[i].title);
                    $(parent).attr('data', i);
                    return false;
                }
            }
        }
    }
}

/*
 *  End Element increament size function
 */



/*
 *  Shortcode insert editor function
 */
function Shortcode_tab_insert_editor(element_name, id) {
    "use strict";
    var $id = jQuery("#" + id),
            _this = jQuery(this),
            attributes = '',
            content = '',
            contentToEditor = '',
            template = $id.data('shortcode-template'),
            childTemplate = $id.data('shortcode-child-template'),
            tables = $id.find(".cs-wrapp-clone.cs-shortcode-wrapp");
    for (var i = 0; i < tables.length; i++) {
        var elems = jQuery(tables[i]).find('input, select, textarea').not('.cs-search-icon,.wp-picker-clear');
        attributes = jQuery.map(elems, function (el, index) {
            var $el = jQuery(el);
            console.log(el);
            if ($el.data('content-text') === 'cs-shortcode-textarea') {
                content = $el.val();
                return '';
            } else if ($el.data('check-box') === 'check-field') {
                if ($el.is(':checked')) {
                    return $el.attr('name') + '="true"';
                } else {
                    return '';
                }
            } else {
                if ($el.attr('name') != undefined) {
                    var _name = $el.attr('name').replace('[]', '');
                    _name = _name.replace('[1]', '');
                    if ($el.val() != '' && _name != 'fontawesome_icon' && _name != 'users') {
                        return _name + '="' + $el.val() + '"';
                    }
                }
            }
        });
        attributes = attributes.join(' ').trim();
        if (childTemplate) {
            var a = jQuery(tables[i]).data('template');
            if (a) {
                contentToEditor += a.replace('{{attributes}}', attributes);

            } else {
                contentToEditor += childTemplate.replace('{{attributes}}', attributes).replace('{{attributes}}', attributes).replace('{{content}}', content);
            }
        } else {
            contentToEditor += template.replace('{{attributes}}', attributes).replace('{{attributes}}', attributes).replace('{{content}}', content);
        }
    }
    ;
    if (childTemplate) {
        contentToEditor = template.replace('{{child_shortcode}}', contentToEditor);
    }
    window.send_to_editor(contentToEditor);
    jQuery('body').removeClass('cs-overflow')
    jQuery("#cs-pbwp-outerlay").remove();
    return false;
}
/*
 *  End Shortcode insert editor function
 */



/*
 *  Shortcode selection function
 */
var cs_shortocde_selection = (function (val, admin_url, id) {
    "use strict";
    SuccessLoader();

    jQuery("#" + id).parents('#cs-widgets-list').removeClass('wide-width');
    if (val != "") {
        var shortcode_counter = 1
        var action = "jobcareer_pb_" + val;
        var newCustomerForm = "action=" + action + '&counter=' + shortcode_counter + '&shortcode_element=shortcode';
        jQuery.ajax({
            type: "POST",
            url: admin_url,
            data: newCustomerForm,
            success: function (data) {
                _fontnamesearch();
                removeoverlay(id, 'widgetitem');
                _createpop(data, "csmedia");
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
            }
        });
    }

})

/*
 *  End Shortcode selection function
 */
/*
 *  Shortcode element ajax call function
 */
function jobcareer_shortcode_element_ajax_call(val, id, admin_url,sh_code) {
    "use strict";
    if (val != "") {
        var shortcode_counter = 1
        var action = val;
        var newCustomerForm = "shortcode_element=" + val  + '&sh_code=' + sh_code +'&action=jobcareer_shortcode_element_ajax_call';
        jQuery.ajax({
            type: "POST",
            url: admin_url,
            data: newCustomerForm,
            success: function (data) {
                jQuery('.shortcodeload').html("");
                jQuery("#" + id).append(data);
                jQuery('.bg_color').wpColorPicker();
                //_commonshortcode(id);
                var a = jQuery("#" + id + " .cs-wrapp-clone.cs-shortcode-wrapp").not('.cs-disable-true').length;
                jQuery("#" + id).next('.hidden-object').find('.fieldCounter').val(a);
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

            }
        });
    }
}

/*
 *  End Shortcode element ajax call function
 */


/*
 *  Fontawesome popup function
 */
function cs_fontawsome_popup(admin_url, id) {
    "use strict";
    var shortcode_counter = 1
    var newCustomerForm = 'action=cs_fontawsome_popup_load';
    jQuery.ajax({
        type: "POST",
        url: admin_url,
        data: newCustomerForm,
        success: function (data) {
            var _data = jQuery("#" + id).find(".sipInitialized").val();
            jQuery("#" + id).append("<div id='cs-pbwp-outerlay'><div id='cs-widgets-list'>" + data + "</div></div>");
            if (_data) {
                jQuery("#cs-widgets-list").find("li[data-icon-title^=" + _data + "]").addClass('active')
            }
            _fontnamesearch();
        }
    });
}
/*
 *  End Fontawesome popup function
 *
 *  Remove overley function
 */
function removeoverlay(id, text) {
    "use strict";
    jQuery("#cs-widgets-list .loader").remove();
    var _elem1 = "<div id='cs-pbwp-outerlay'></div>",
            _elem2 = "<div id='cs-widgets-list'></div>";
    var $elem = jQuery("#" + id);
    jQuery("#cs-widgets-list").unwrap(_elem1);
    if (text == "append" || text == "filterdrag") {
        $elem.hide().unwrap(_elem2);
    }
    if (text == "widgetitem") {
        $elem.hide().unwrap(_elem2);
        jQuery("body").append("<div id='cs-pbwp-outerlay'><div id='cs-widgets-list'></div></div>");
        return false;

    }
    if (text == "ajax-drag") {
        jQuery("#cs-widgets-list").remove();
    }
    jQuery("body").removeClass("cs-overflow");
}
/*
 *  End Remove overley function
 */


/*
 *   Create popup function
 */
function _createpop(data, type) {
    "use strict";
    var _structure = "<div id='cs-pbwp-outerlay'><div id='cs-widgets-list'></div></div>",
            $elem = jQuery('#cs-widgets-list');
    jQuery('body').addClass("cs-overflow");
    if (type == "csmedia") {
        $elem.append(data);
    }
    if (type == "filter") {
        jQuery('#' + data).wrap(_structure).delay(100).fadeIn(150);
        jQuery('#' + data).parent().addClass("wide-width");
    }
    if (type == "filterdrag") {
        jQuery('#' + data).wrap(_structure).delay(100).fadeIn(150);
    }

}
/*
 *  End Create popup function
 */


/*
 *  page composer filter function
 */
function cs_page_composer_filterable(id) {
    "use strict";
    var $container = jQuery("#page_element_container" + id),
            elclass = "cs-filter-item";
    $container.find('.element-item').addClass("cs-filter-item");
    jQuery(document).on('click', "#filters" + id + " li", function (event) {
        var $selector = jQuery(this).attr('data-filter'),
                $elem = $container.find("." + $selector + "");
        jQuery("#filters" + id + " li").removeClass("active");
        jQuery(this).addClass("active");
        $container.find('.element-item').removeClass(elclass);
        if ($selector == "all") {
            $container.find('.element-item').addClass(elclass);
        } else {
            jQuery($elem).addClass(elclass);
        }
        event.preventDefault();
    });
    // Search By input
    jQuery("#quicksearch" + id).keyup(function () {
        var _val = jQuery(this).val(),
                $this = jQuery(this);
        $container.find('.element-item').addClass("cs-filter-item");
        jQuery("#filters" + id + " li").removeClass("active");
        var filter = jQuery(this).val(),
                count = 0;
        jQuery("#page_element_container" + id + " .element-item span").each(function () {
            if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
                jQuery(this).parents(".element-item").removeClass(elclass);
            } else {
                jQuery(this).parents(".element-item").addClass(elclass);
                count++;
            }
        });
    })
}
/*
 *  End page composer filter function
 */

/*
 *  Fontname search function
 */
function _fontnamesearch() {
    "use strict";
    jQuery(".cs-search-icon").bind('keyup', function () {
        var _val = jQuery(this).val(),
                count = 0;
        var $elem = jQuery(this).parents(".cs-custom-fonts").find('.webfonts-wrapper li')
        $elem.each(function () {
            if (jQuery(this).data('icon-title').search(new RegExp(_val, "i")) < 0) {
                jQuery(this).hide();
            } else {
                jQuery(this).show(100);
                count++;
            }
        });
    });
}
/*
 *  End Fontname search function
 */


/*
 *  Succes loader function
 */
function SuccessLoader() {
    "use strict";
    jQuery("#cs-widgets-list div:first").hide();
    var loader = "<div class='loader'><i class='icon-spinner icon-spin'></i></div>"
    jQuery("#cs-widgets-list").append(loader)

}/*
 *  End Succes loader function
 */