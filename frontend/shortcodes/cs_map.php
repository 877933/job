<?php

/*
 *
 * @Shortcode Name : Start function for Map shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_map_shortcode')) {

    function jobcareer_map_shortcode($atts, $content = "") {
        global $header_map, $jobcareer_form_fields, $jobcareer_options, $jobcareer_html_fields;
		
        $defaults = array(
            'column_size' => '1/1',
            'cs_map_section_title' => '',
            'map_title' => '',
            'map_height' => '',
            'map_lat' => '51.507351',
            'map_lon' => '-0.127758',
            'map_zoom' => '',
            'map_type' => '',
            'map_info' => '',
            'map_info_width' => '200',
            'map_info_height' => '200',
            'map_marker_icon' => '',
            'map_show_marker' => 'true',
            'map_controls' => '',
            'map_draggable' => '',
            'map_scrollwheel' => '',
            'map_conactus_content' => '',
            'map_border' => '',
            'map_border_color' => '',
            'cs_map_style' => '',
            'cs_map_directions' => 'off'
        );
        extract(shortcode_atts($defaults, $atts));
        $column_size = isset($column_size) ? $column_size : '';
        if (isset($map_height) && $map_height == '') {
            $map_height = '500';
        }

        if ($header_map) {
            $column_class = '';
            $header_map = false;
        } else {
            if($column_size != ''){
            $column_class = jobcareer_custom_column_class($column_size);
            }
        }
         $col_div_start = '';
        $col_div_end = '';
        if ($column_class != '') {
            $col_div_start = '<div class="' . $column_class . '">';
            $col_div_end = '</div>';
        }
        $cs_map_style = isset($jobcareer_options['def_map_style']) ? $jobcareer_options['def_map_style'] : '';

        $section_title = '';

        if ($cs_map_section_title && trim($cs_map_section_title) != '') {
            $section_title = '<div class="cs-element-title"><h2>' . $cs_map_section_title . '</h2></div>';
        }
        $map_dynmaic_no = rand(6548, 9999999);
        if ($map_show_marker == "true") {
            $map_show_marker = " var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '',
                        icon: '" . $map_marker_icon . "',
                        shadow: ''
                    });
            ";
        } else {
            $map_show_marker = "var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '',
                        icon: '',
                        shadow: ''
                    });";
        }
        $border = '';
        if (isset($map_border) && $map_border == 'yes' && $map_border_color != '') {
            $border = 'border:1px solid ' . $map_border_color . '; ';
        }

        jobcareer_google_map_script();

		
        $map_type = isset($jobcareer_options['def_map_style']) ? $jobcareer_options['def_map_style'] : '';
        $map_dynmaic_no = jobcareer_generate_random_string('10');
        $html = '';
        $html .= $col_div_start.'<div style="animation-duration:">';
        $html .= $section_title;
        $html .= '<div class="clear"></div>';
        $html .= '<div class="cs-map-section" style="' . $border . ';">';
        $html .= '<div class="cs-map">';
        $html .= '<div class="cs-map-content">';

        $html .= '<div class="mapcode iframe mapsection gmapwrapp" id="map_canvas' . $map_dynmaic_no . '" style="height:' . $map_height . 'px;"> </div>';

        if ($cs_map_directions == 'off') {
            $html .= '<div id="cs-directions-panel"></div>';
        }

        $html .= '</div>';
        $html .= '</div>';
        $html .= "<script type='text/javascript'>
                    jQuery(window).load(function(){
						'use strict';
                        setTimeout(function(){
                        jQuery('.cs-map-" . $map_dynmaic_no . "').animate({
                            'height':'" . $map_height . "'
                        },400)
                        },400)
                    })
		    var panorama;
                    function initialize() {
                    var myLatlng = new google.maps.LatLng(" . $map_lat . ", " . $map_lon . ");
                    var mapOptions = {
                        zoom: " . $map_zoom . ",
                        scrollwheel: " . $map_scrollwheel . ",
                        draggable: " . $map_draggable . ",
                        streetViewControl: false,
                        center: myLatlng,
                        disableDefaultUI: " . $map_controls . ",
                        };";

        if ($cs_map_directions == 'on') {
            $html .= "var directionsDisplay;
                      var directionsService = new google.maps.DirectionsService();
                      directionsDisplay = new google.maps.DirectionsRenderer();";
        }

        $html .= "var map = new google.maps.Map(document.getElementById('map_canvas" . $map_dynmaic_no . "'), mapOptions);";

        if ($cs_map_directions == 'on') {
            $html .= "directionsDisplay.setMap(map);
                        directionsDisplay.setPanel(document.getElementById('cs-directions-panel'));

                        function cs_calc_route() {
                                var myLatlng = new google.maps.LatLng(" . $map_lat . ", " . $map_lon . ");
                                var start = myLatlng;
                                var end = document.getElementById('cs_end_direction').value;
                                var mode = document.getElementById('cs_chng_dir_mode').value;
                                var request = {
                                        origin:start,
                                        destination:end,
                                        travelMode: google.maps.TravelMode[mode]
                                };
                                directionsService.route(request, function(response, status) {
                                        if (status == google.maps.DirectionsStatus.OK) {
                                                directionsDisplay.setDirections(response);
                                        }
                                });
                        }

                        document.getElementById('cs_search_direction').addEventListener('click', function() {
                                cs_calc_route();
                        });";
        }

        $html .= "
                        var style = '".$cs_map_style."';
                        if (style != '') {
                            var styles = cs_map_select_style(style);
                            if (styles != '') {
                                var styledMap = new google.maps.StyledMapType(styles,
                                        {name: 'Styled Map'});
                                map.mapTypes.set('map_style', styledMap);
                                map.setMapTypeId('map_style');
                            }
                        }
                        var infowindow = new google.maps.InfoWindow({
                            content: '" . $map_info . "',
                            maxWidth: " . $map_info_width . ",
                            maxHeight: " . $map_info_height . ",
                            
                        });
                        " . $map_show_marker . "
                        //google.maps.event.addListener(marker, 'click', function() {
                            if (infowindow.content != ''){
                              infowindow.open(map, marker);
                               map.panBy(1,-60);
                               google.maps.event.addListener(marker, 'click', function(event) {
                                infowindow.open(map, marker);
                               });
                            }
                        //});
                            panorama = map.getStreetView();
                            panorama.setPosition(myLatlng);
                            panorama.setPov(({
                              heading: 265,
                              pitch: 0
                            }));

                    }
					
                        function cs_toggle_street_view(btn) {
                          var toggle = panorama.getVisible();
                          if (toggle == false) {
                                if(btn == 'streetview'){
                                  panorama.setVisible(true);
                                }
                          } else {
                                if(btn == 'mapview'){
                                  panorama.setVisible(false);
                                }
                          }
                        }

                google.maps.event.addDomListener(window, 'load', initialize);
                </script>";

        $html .= '</div>';
        $html .= '</div>'.$col_div_end;
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MAP, 'jobcareer_map_shortcode');
    }
}