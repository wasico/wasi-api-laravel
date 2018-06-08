/*
* Author: Wisely Themes
* Author URI: http://www.wiselythemes.com
* Theme Name: Cozy
* Version: 1.0.0
*/

/*jslint browser:true, devel: true */
/*global jQuery, google, Freewall, InfoBox, MarkerClusterer, CountUp, Recaptcha, mobileMenuTitle, twitter_username, agency_initialZoom, agency_selectedZoom, agency_mapInitialLatitude, agency_mapInitialLongitude, agency_viewMore, properties_cluster_marker, properties_cluster_textcolor, properties_initialZoom, properties_selectedZoom, properties_mapInitialLatitude, properties_mapInitialLongitude, properties_viewMore, use_default_map_style*/

var Cozy;

(function ($) { "use strict";

    $(document).ready(function () {

        Cozy = {

            initialized: false,
            mobMenuFlag: false,
            mobileMenuTitle: mobileMenuTitle,
            twitter_username: twitter_username,
            agency_initialZoom: agency_initialZoom,
            agency_selectedZoom: agency_selectedZoom,
            agency_mapInitialLatitude: agency_mapInitialLatitude,
            agency_mapInitialLongitude: agency_mapInitialLongitude,
            agency_viewMore: agency_viewMore,
            properties_cluster_marker: properties_cluster_marker,
            properties_cluster_textcolor: properties_cluster_textcolor,
            properties_initialZoom: properties_initialZoom,
            properties_selectedZoom: properties_selectedZoom,
            properties_mapInitialLatitude: properties_mapInitialLatitude,
            properties_mapInitialLongitude: properties_mapInitialLongitude,
            properties_viewMore: properties_viewMore,
            use_default_map_style: use_default_map_style,
            sendingMail: false,

            init: function () {

                var $tis = this;

                if ($tis.initialized) {
                    return;
                }

                $tis.initialized = true;
                $tis.build();
                $tis.events();
            },

            build: function () {

                var $tis = this;

                /**
                 * Dinamically create the menu for mobile devices
                 */
                $tis.createMobileMenu();

                /**
                 * Get latest tweets
                 */
                $tis.getLatestTweets();

                /**
                 * Create Owl Sliders
                 */
                $tis.createOwlSliders();

                /**
                 * Create Revolution Slider
                 */
                $tis.createRevSlider();

                /**
                 * Create custom select boxes
                 */
                $tis.createSelectBoxes();

                /**
                 * Create custom check boxes
                 */
                // $tis.createCheckBoxes();

                /**
                 * Build properties grid
                 */
                $tis.propertiesGrid();

                /**
                 * Create PrettyPhoto links
                 */
                if ($("a[data-gal^='prettyPhoto']").length) {
                    $("a[data-gal^='prettyPhoto']").prettyPhoto({theme: 'cozy', hook: 'data-gal', social_tools: false});
                }

                /**
                 * Create Tooltip objects
                 */
                $('[data-toggle="tooltip"]').tooltip();

                /**
                 * Initiate Parallax
                 */
                $tis.parallaxItems();

                /**
                 * Activate placeholder in older browsers
                 */
                $('input, textarea').placeholder();
            },

            events: function () {

                var $tis = this;

                /**
                 * Functions called on window resize
                 */
                $tis.windowResize();

                /**
                 * Make the navbar stick to the top on scroll
                 */
                $tis.stickyNav();

                /**
                 * If #content has class colored, make the sidebar with a minimun height equal to #main height
                 */
                $tis.resizeSidebar();

                /**
                 * Buttons click event
                 */
                $tis.buttonsClick();

                /**
                 * Initialize countUp plugin
                 */
                $tis.initCountUp();

                /**
                 * Contact form submit
                 */
                //$tis.contactForm();

                /**
                 * View Mode Switcher
                 */
                $tis.viewModeSwitcher();

                /**
                 * Animate elements on scrolling
                 */
                $tis.animateElems();
            },

            createMobileMenu: function (w) {

                var $tis = this,
                    $wrapper = $('#wrapper'),
                    $navMobile,
                    etype = $.browser.mobile ? 'touchstart' : 'click';

                if (w !== null) {
                    w = $(window).innerWidth();
                }

                if (w <= 975 && !$tis.mobMenuFlag) {

                    $('body').prepend('<nav class="nav-mobile"><i class="fa fa-times"></i><h2><i class="fa fa-bars"></i>' + $tis.mobileMenuTitle + '</h2><ul></ul></nav>');

                    $('.nav-mobile > ul').html($('.nav').html());

                    $('.nav-mobile b').remove();

                    $('.nav-mobile ul.dropdown-menu').removeClass().addClass("dropdown-mobile");

                    //$('.nav-mobile').css({'min-height': ($('#wrapper').height() + 270) + 'px' });

                    $navMobile = $(".nav-mobile");

                    $("#nav-mobile-btn").bind(etype, function (e) {
                        e.stopPropagation();
                        e.preventDefault();

                        setTimeout(function () {
                            $wrapper.addClass('open');
                            $navMobile.addClass('open');
                            $navMobile.getNiceScroll().show();
                        }, 25);

                        $.waypoints('disable');

                        $(document).bind(etype, function (e) {
                            if (!$(e.target).hasClass('nav-mobile') && !$(e.target).parents('.nav-mobile').length) {
                                $wrapper.removeClass('open');
                                $navMobile.removeClass('open');
                                $(document).unbind(etype);
                                $.waypoints('enable');
                            }
                        });

                        $('>i', $navMobile).bind(etype, function () {
                            $navMobile.getNiceScroll().hide();
                            $wrapper.removeClass('open');
                            $navMobile.removeClass('open');
                            $(document).unbind(etype);
                            $.waypoints('enable');
                        });
                    });

                    $navMobile.niceScroll({
                        autohidemode: true,
                        cursorcolor: "#c2c2c2",
                        cursoropacitymax: "0.7",
                        cursorwidth: 10,
                        cursorborder: "0px solid #000",
                        horizrailenabled: false,
                        zindex: "1"
                    });

                    $navMobile.getNiceScroll().hide();

                    $tis.mobMenuFlag = true;
                }
            },

            getLatestTweets: function () {

                var $tis = this,
                    twitterBox = document.createElement('div'),
                    len = $(".twitter .item").length,
                    index = 0;

                if (len === 0) {
                    return false;
                }

                twitterBox.setAttribute('id', 'twitter-box');

                $('body').append(twitterBox);

                $("#twitter-box").css({display: 'none'});

                try {
                    $("#twitter-box").tweet({
                        username: $tis.twitter_username,
                        modpath: 'twitter/',
                        count: len,
                        loading_text: 'Loading tweets...',
                        template: '<header><h3>{name}</h3><a href="http://twitter.com/{screen_name}" target="_blank">@{screen_name}</a>&nbsp;.&nbsp;<a href="http://twitter.com/{screen_name}/statuses/{tweet_id}/" target="_blank" class="time">{tweet_relative_time}</a></header><div class="text">{text}</div>'
                    });
                } catch (err) {
                    console.log("Your twitter account is misconfigured.");
                }

                $("#twitter-box li").each(function () {
                    if (index < len) {
                        $(".twitter .item").eq(index).html($(this).html());
                        index += 1;
                    } else {
                        return false;
                    }
                });

                $("#twitter-box").remove();
            },

            createOwlSliders: function () {

                if ($("#new-properties-slider").length) {
                    $("#new-properties-slider").owlCarousel({
                        itemsCustom : [
                            [0, 1],
                            [590, 2],
                            [751, 2],
                            [975, 3],
                            [1183, 4],
                            [1440, 4],
                            [1728, 4]
                        ]
                    });
                }

                if ($("#property-gallery").length) {
                    $("#property-gallery").owlCarousel({
                        navigation: true,
                        navigationText: false,
                        pagination: false,
                        itemsCustom : [
                            [0, 1],
                            [392, 2],
                            [596, 3],
                            [751, 2],
                            [975, 3],
                            [1183, 3],
                            [1440, 3],
                            [1728, 3]
                        ]
                    });
                }

                if ($("#testimonials-slider").length) {
                    $("#testimonials-slider").owlCarousel({
                        singleItem : true,
                        autoHeight : true,
                        mouseDrag: false,
                        transitionStyle : "fade"
                    });
                }

                if ($("#featured-properties-slider").length) {
                    $(".fullwidthsingle .item").each(function () {
                        var $item = $(this);
                        $('.image', $item).css({'background-image': 'url(' + $('.image img', $item).attr('src') + ')'});
                        $('.image img', $item).remove();
                    });

                    $("#featured-properties-slider").owlCarousel({
                        singleItem : true,
                        autoHeight : true,
                        mouseDrag: false,
                        transitionStyle : "fade"
                    });
                }

                if ($("#latest-properties-slider").length) {
                    $(".fullwidthsingle2 .item").each(function () {
                        var $item = $(this);
                        $('.image', $item).css({'background-image': 'url(' + $('.image img', $item).attr('src') + ')'});
                        $('.image img', $item).remove();
                    });

                    $("#latest-properties-slider").owlCarousel({
                        navigation: true,
                        navigationText: false,
                        pagination: false,
                        singleItem : true,
                        autoHeight : true
                    });
                }

                if ($("#latest-news-slider").length) {
                    $(".latest-news-slider .item").each(function () {
                        var $item = $(this);
                        $('.image', $item).css({'background-image': 'url(' + $('.image img', $item).attr('src') + ')'});
                        $('.image img', $item).remove();
                    });

                    $("#latest-news-slider").owlCarousel({
                        singleItem : true,
                        autoHeight : true,
                        mouseDrag: false,
                        transitionStyle : "fade"
                    });
                }

                if ($("#twitter-slider").length) {
                    $("#twitter-slider").owlCarousel({
                        singleItem : true,
                        autoHeight : true,
                        mouseDrag: false,
                        transitionStyle : "fade"
                    });
                }

                if ($("#property-detail-large").length && $("#property-detail-thumbs").length) {
                    var sync1 = $("#property-detail-large"),
                        sync2 = $("#property-detail-thumbs"),

                        center  = function (number) {
                            var sync2visible = sync2.data("owlCarousel").owl.visibleItems,
                                num = number,
                                found = false,
                                i;

                            for (i = 0; i < sync2visible.length - 1; i += 1) {
                                if (num === sync2visible[i]) {
                                    found = true;
                                }
                            }

                            if (found === false) {
                                if (num > sync2visible[sync2visible.length - 1]) {
                                    sync2.trigger("owl.goTo", num - sync2visible.length + 2);
                                } else {
                                    if (num - 1 === -1) {
                                        num = 0;
                                    }
                                    sync2.trigger("owl.goTo", num);
                                }
                            } else if (num === sync2visible[sync2visible.length - 1]) {
                                sync2.trigger("owl.goTo", sync2visible[1]);
                            } else if (num === sync2visible[0]) {
                                sync2.trigger("owl.goTo", num - 1);
                            }
                        },

                        syncPosition = function () {
                            /*jshint validthis: true */

                            var current = this.currentItem;

                            $("#property-detail-thumbs")
                                .find(".owl-item")
                                .removeClass("synced")
                                .eq(current)
                                .addClass("synced");

                            if (sync2.data("owlCarousel") !== undefined) {
                                center(current);
                            }
                        };

                    $(".item", sync2).each(function () {
                        var $item = $(this);
                        $item.css({'background-image': 'url(' + $('img', $item).attr('src') + ')'});
                        $('img', $item).remove();
                    });

                    sync1.owlCarousel({
                        singleItem : true,
                        slideSpeed : 1000,
                        navigation: false,
                        pagination: false,
                        autoHeight : true,
                        afterAction : syncPosition,
                        responsiveRefreshRate : 200
                    });

                    sync2.owlCarousel({
                        itemsCustom : [
                            [0, 2],
                            [300, 3],
                            [629, 4],
                            [751, 3],
                            [975, 4],
                            [1183, 5]
                        ],
                        pagination: true,
                        responsiveRefreshRate : 100,
                        afterInit : function (el) {
                            el.find(".owl-item").eq(0).addClass("synced");
                        }
                    });

                    $("#property-detail-thumbs").on("click", ".owl-item", function (e) {
                        e.preventDefault();
                        var number = $(this).data("owlItem");
                        sync1.trigger("owl.goTo", number);
                    });
                }
            },

            createRevSlider: function () {

                if ($('.revslider').length) {
                    $('.revslider').revolution({
                        delay: 9000,
                        startwidth: 1170,
                        startheight: 500,
                        hideThumbs: 10,
                        navigationType: "none",
                        fullWidth: "on"
                    });
                }
            },

            createSelectBoxes: function () {

                if ($('select').length) {
                    $("select").chosen({
                        allow_single_deselect: true,
                        disable_search_threshold: 12
                    });
                }
            },

            /*createCheckBoxes: function () {

                if ($('input[type="checkbox"]').length) {
                    $('input[type="checkbox"]').checkbox({
                        checkedClass: 'fa fa-check-square-o',
                        uncheckedClass: 'fa fa-square-o'
                    });
                }
            },*/

            propertiesGrid: function () {

                if ($('#freewall').length) {
                    $("#freewall .item").each(function () {
                        var $item = $(this);
                        $item.width(Math.floor(200 +  200 * Math.random()));
                        $item.css({'background-image': 'url(' + $('>img', $item).attr('src') + ')'});
                        $('>img', $item).remove();
                    });

                    var wall = new Freewall("#freewall");
                    wall.reset({
                        selector: '.item',
                        animate: false,
                        cellW: 20,
                        cellH: 240,
                        gutterX: 1,
                        gutterY: 1,
                        onResize: function () {
                            wall.fitWidth();
                        }
                    });
                    wall.fitWidth();
                }
            },

            parallaxItems: function () {

                if (!$.browser.mobile) {
                    $.stellar();
                } else {
                    $('.parallax, #home-search-section').css({'background-position': '50% 50%', 'background-size': 'cover', 'background-attachment': 'scroll'});
                }
            },

            /*
            agencyMap: function (markers, agency_map_canvas, agency_id) {

                if (agency_map_canvas === undefined || markers.length === 0) {
                    return false;
                }

                var $tis = this,
                    styles = [],
                    styledMap,
                    myLatlng,
                    mapOptions,
                    map,
                    mapMarkers = [],
                    createMarker,
                    appendAgency = false,
                    i;

                if ($tis.agency_mapInitialLatitude === null) {
                    $tis.agency_mapInitialLatitude = markers[0].latitude;
                }

                if ($tis.agency_mapInitialLongitude === null) {
                    $tis.agency_mapInitialLongitude = markers[0].longitude;
                }

                if (agency_id !== undefined || agency_id === null) {
                    myLatlng = new google.maps.LatLng(markers[agency_id].latitude, markers[agency_id].longitude);
                    $tis.agency_initialZoom = $tis.agency_selectedZoom;
                } else {
                    myLatlng = new google.maps.LatLng($tis.agency_mapInitialLatitude, $tis.agency_mapInitialLongitude);
                }

                if (!this.use_default_map_style) {
                    styles = [
                        {
                            featureType: "all",
                            elementType: "all",
                            stylers: [
                                { saturation: -100 }
                            ]
                        }
                    ];
                }

                styledMap = new google.maps.StyledMapType(styles, {name: "Cozy"});

                mapOptions = {
                    center:  myLatlng,
                    zoom: $tis.agency_initialZoom,
                    scrollwheel: false,
                    panControl: false,
                    mapTypeControl: false,
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.RIGHT_CENTER
                    }
                };

                map = new google.maps.Map(document.getElementById(agency_map_canvas), mapOptions);

                map.mapTypes.set('map_style', styledMap);
                map.setMapTypeId('map_style');

                createMarker = function (obj) {

                    var lat = obj.latitude,
                        lng = obj.longitude,
                        myOptions,

                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lat, lng),
                            map: map,
                            icon: obj.map_marker_icon
                        }),

                        content = '<div class="infoWindowAgency">' + '<h3>' + obj.title + '</h3>' + '<a href="' + obj.link + '"><img src="' + obj.image + '" alt="' + obj.title + '"></a>' + '<div class="description">' + obj.description + '</div>';

                    if (obj.link !== "" && obj.link !== undefined) {
                        content += '<div class="center"><a class="btn btn-fullcolor" href="' + obj.link + '">' + $tis.agency_viewMore + '</a></div></div>';
                    } else {
                        content += '</div>';
                    }

                    myOptions = {
                        content: content,
                        zIndex: null,
                        alignBottom: true,
                        pixelOffset: new google.maps.Size(-85, -62),
                        closeBoxMargin: "10px 10px 10px 10px",
                        closeBoxURL: "images/close_infobox.png",
                        infoBoxClearance: new google.maps.Size(5, 5),
                        isHidden: false,
                        pane: "floatPane",
                        enableEventPropagation: false
                    };

                    mapMarkers.push(marker);

                    mapMarkers[mapMarkers.length - 1].infobox = new InfoBox(myOptions);

                    google.maps.event.addListener(marker, 'click', function () {
                        $.each(mapMarkers, function () {
                            this.infobox.close();
                        });

                        this.infobox.open(map, this);
                    });
                };

                if ($('#' + agency_map_canvas).parent().parent().find("#agency").length > 0) {
                    appendAgency = true;
                }

                for (i = 0; i < markers.length; i += 1) {
                    if (markers[i] !== undefined) {
                        createMarker(markers[i]);

                        if (appendAgency) {
                            $('#agency').append($("<option></option>").attr("value", i).text(markers[i].title));
                        }
                    }
                }

                if (appendAgency) {
                    $("#agency").trigger("liszt:updated");

                    $("#agency").chosen().change(function () {
                        var id = $("#agency").val();
                        if (id === "") {
                            map.setZoom($tis.agency_initialZoom);
                            return false;
                        }

                        map.setCenter(new google.maps.LatLng(markers[id].latitude, markers[id].longitude));
                        map.setZoom($tis.agency_selectedZoom);
                    });
                }
            },*/

            propertiesMap: function (markers, properties_map_canvas, property_id) {

                var $tis = this,
                    properties = {},
                    styles = [],
                    styledMap,
                    latlng,
                    options,
                    markerClickFunction,
                    i,
                    latlng2,
                    mkr,
                    fn,
                    mcOptions;

                properties.pics = null;
                properties.map = null;
                properties.markerClusterer = null;
                properties.markers = [];
                properties.infoWindow = null;

                if (!this.use_default_map_style) {
                    styles = [
                        {
                            featureType: "all",
                            elementType: "all",
                            stylers: [
                                { saturation: -100 }
                            ]
                        }
                    ];
                }

                styledMap = new google.maps.StyledMapType(styles, {name: "Cozy"});

                if (property_id !== undefined || property_id === null) {
                    latlng = new google.maps.LatLng(markers[property_id].latitude, markers[property_id].longitude);
                    $tis.properties_initialZoom = $tis.properties_selectedZoom;
                } else {
                    latlng = new google.maps.LatLng($tis.properties_mapInitialLatitude, $tis.properties_mapInitialLongitude);
                }

                options = {
                    zoom: $tis.properties_initialZoom,
                    center: latlng,
                    scrollwheel: false
                };

                properties.map = new google.maps.Map(document.getElementById(properties_map_canvas), options);
                properties.map.mapTypes.set('map_style', styledMap);
                properties.map.setMapTypeId('map_style');

                properties.pics = markers;

                properties.infoWindow = new google.maps.InfoWindow({
                    pixelOffset: new google.maps.Size(0, -45)
                });

                markerClickFunction = function (obj, latlngClik) {
                    return function (e) {
                        e.cancelBubble = true;
                        e.returnValue = false;
                        if (e.stopPropagation) {
                            e.stopPropagation();
                            e.preventDefault();
                        }

                        var infoHtml = '<div class="infoWindow">' + '<h3>' + obj.title + '</h3>' + '<a href="' + obj.link + '"><img src="' + obj.image + '" alt="' + obj.title + '"></a>' + '<div class="description">' + obj.description + '</div>';

                        if (obj.link !== "" && obj.link !== undefined) {
                            infoHtml += '<div class="right"><a class="btn btn-fullcolor" href="' + obj.link + '">' + $tis.properties_viewMore + '</a></div></div>';
                        } else {
                            infoHtml += '</div>';
                        }

                        properties.infoWindow.setContent(infoHtml);
                        properties.infoWindow.setPosition(latlngClik);
                        properties.infoWindow.open(properties.map);
                    };
                };

                for (i = 0; i < properties.pics.length; i += 1) {

                    latlng2 = new google.maps.LatLng(properties.pics[i].latitude, properties.pics[i].longitude);

                    mkr = new google.maps.Marker({
                        position: latlng2,
                        map: properties.map,
                        icon: properties.pics[i].map_marker_icon
                    });

                    fn = markerClickFunction(properties.pics[i], latlng2);
                    google.maps.event.addListener(mkr, 'click', fn);
                    properties.markers.push(mkr);
                }

                mcOptions = {
                    styles: [
                        {
                            height: 52,
                            url: $tis.properties_cluster_marker,
                            width: 35,
                            textColor: $tis.properties_cluster_textcolor,
                            anchorText: [-10, 0],
                            textSize: 20,
                            fontWeight: "normal",
                            fontFamily: "Open Sans, Arial, sans-serif"
                        },
                        {
                            height: 52,
                            url: $tis.properties_cluster_marker,
                            width: 35,
                            textColor: $tis.properties_cluster_textcolor,
                            anchorText: [-10, 0],
                            textSize: 20,
                            fontWeight: "normal",
                            fontFamily: "Open Sans, Arial, sans-serif"
                        },
                        {
                            height: 52,
                            url: $tis.properties_cluster_marker,
                            width: 35,
                            textColor: $tis.properties_cluster_textcolor,
                            anchorText: [-10, 0],
                            textSize: 16,
                            fontWeight: "normal",
                            fontFamily: "Open Sans, Arial, sans-serif"
                        }
                    ],
                    maxZoom: 15
                };

                properties.markerClusterer = new MarkerClusterer(properties.map, properties.markers, mcOptions);
            },

            /*contactsMap: function (markers, map_canvas, map_zoom) {

                var $tis = this,
                    styles = [],
                    styledMap,
                    lng,
                    myLatlng,
                    mapOptions,
                    map,
                    mapMarkers = [],
                    createMarker,
                    i;

                if (map_canvas === undefined || markers.length === 0) {
                    return false;
                }

                if (map_zoom === undefined || map_zoom === null) {
                    map_zoom = 14;
                }

                if (!this.use_default_map_style) {
                    styles = [
                        {
                            featureType: "all",
                            elementType: "all",
                            stylers: [
                                { saturation: -100 }
                            ]
                        }
                    ];
                }

                styledMap = new google.maps.StyledMapType(styles, {name: "Cozy"});

                if ($(window).innerWidth() <= 751) {
                    lng = markers[0].longitude;
                } else {
                    lng = markers[0].longitude + 0.03;
                }

                myLatlng = new google.maps.LatLng(markers[0].latitude, lng);

                mapOptions = {
                    center:  myLatlng,
                    zoom: map_zoom,
                    scrollwheel: false,
                    panControl: false,
                    mapTypeControl: false,
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_TOP
                    }
                };

                map = new google.maps.Map(document.getElementById(map_canvas), mapOptions);

                map.mapTypes.set('map_style', styledMap);
                map.setMapTypeId('map_style');

                createMarker = function (obj) {

                    var myOptions,

                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(obj.latitude, obj.longitude),
                            map: map,
                            icon: obj.map_marker_icon
                        }),

                        content = '<div class="infoWindowContacts">' + '<h3>' + obj.title + '</h3>' + '<img src="' + obj.image + '" alt="' + obj.title + '">' + '<div class="description">' + obj.description + '</div>';

                    if (obj.link !== "" && obj.link !== undefined) {
                        content += '<div class="center"><a class="btn btn-fullcolor" href="' + obj.link + '">' + $tis.agency_viewMore + '</a></div></div>';
                    } else {
                        content += '</div>';
                    }

                    myOptions = {
                        content: content,
                        zIndex: null,
                        alignBottom: true,
                        pixelOffset: new google.maps.Size(-85, -62),
                        closeBoxMargin: "10px 10px 10px 10px",
                        closeBoxURL: "images/close_infobox.png",
                        infoBoxClearance: new google.maps.Size(5, 5),
                        isHidden: false,
                        pane: "floatPane",
                        enableEventPropagation: false
                    };

                    mapMarkers.push(marker);

                    mapMarkers[mapMarkers.length - 1].infobox = new InfoBox(myOptions);

                    google.maps.event.addListener(marker, 'click', function () {
                        $.each(mapMarkers, function () {
                            this.infobox.close();
                        });

                        this.infobox.open(map, this);
                    });
                };

                for (i = 0; i < markers.length; i += 1) {
                    if (markers[i] !== undefined) {
                        createMarker(markers[i]);
                    }
                }
            },*/

            windowResize: function () {

                var $tis = this;

                $(window).resize(function () {
                    var w = $(window).innerWidth();

                    $tis.resizeSidebar(w);
                    $tis.createMobileMenu(w);
                });
            },

            stickyNav: function () {

                var $navSection = $('#nav-section');

                $navSection.waypoint('sticky');

                $('body').waypoint(function (dir) {
                    if (dir === "down") {
                        $navSection.addClass('shrink');
                    } else {
                        $navSection.removeClass('shrink');
                    }
                }, { offset: -320 });
            },

            resizeSidebar: function (w) {

                if (w !== null) {
                    w = $(window).innerWidth();
                }

                if ($(".colored .sidebar").length || $(".gray .sidebar").length) {
                    if (w >= 751) {
                        $(".sidebar").each(function () {
                            var h = $(this).closest(".content").find(".main").height();
                            $(this).css({minHeight: (h + 135) + 'px'});
                        });
                    } else {
                        $(".sidebar").each(function () {
                            $(this).css({"min-height": "0px"});
                        });
                    }
                }
            },

            buttonsClick: function () {

                $("#home-search-buttons > .btn").bind('click', function () {
                    $("#home-search-buttons > .btn").removeClass("active");
                    $(this).addClass("active");
                });

                $("#opensearch").bind('click', function () {
                    $("#home-advanced-search .container").css({"overflow": "hidden"});

                    $("#home-advanced-search").toggleClass("open");

                    if ($("#home-advanced-search").hasClass("open")) {
                        setTimeout(function () {
                            $("#home-advanced-search .container").css({"overflow": "visible"});
                        }, 400);
                    }
                });

                var animating = false,
                    objHeight = 0,
                    objWidth = 0;

                $("#filter-close").bind('click', function () {
                    var $this = $(this);

                    if (animating) {
                        return false;
                    }

                    animating = true;

                    if ($this.hasClass("fa-minus")) {
                        $this.removeClass("fa-minus").addClass("fa-plus");
                        objHeight = $("#map-property-filter .row > div").height();
                        $("#map-property-filter .row > div")
                            .css({"overflow": "hidden"})
                            .animate({"height": "35px", "margin-top": "-83px"}, 300, function () {
                                $("form", this).css({"visibility": "hidden"});
                                $(this).animate({"width": "42px"}, 300);
                                animating = false;
                            });

                    } else {
                        $this.removeClass("fa-plus").addClass("fa-minus");
                        $("#map-property-filter .row > div")
                            .animate({"width": "100%"}, 300, function () {
                                $("form", this).css({"visibility": "visible"});
                                $(this).animate({"height": objHeight + "px", "margin-top": "-200px"}, 300, function () {
                                    $(this).css({"overflow": "visible", "height": "auto"});
                                    animating = false;
                                });
                            });
                    }
                });

                $("#contacts-overlay-close").bind('click', function () {
                    var $this = $(this);

                    if (animating) {
                        return false;
                    }

                    animating = true;

                    if ($this.hasClass("fa-minus")) {
                        $this.removeClass("fa-minus").addClass("fa-plus");
                        objHeight = $("#contacts-overlay").height();
                        objWidth = $("#contacts-overlay").width();
                        $("#contacts-overlay")
                            .css({"overflow": "hidden"})
                            .animate({"height": "35px", "margin-top": "-83px"}, 300, function () {
                                $("ul", this).css({"visibility": "hidden"});
                                $(this).animate({"width": "42px", "min-width": "42px"}, 300);
                                animating = false;
                            });

                    } else {
                        $this.removeClass("fa-plus").addClass("fa-minus");
                        $("#contacts-overlay")
                            .animate({"min-width": objWidth + "px", "width": "auto"}, 300, function () {
                                $("ul", this).css({"visibility": "visible"});
                                $(this).animate({"height": objHeight + "px", "margin-top": "-200px"}, 300, function () {
                                    $(this).css({"overflow": "visible", "height": "auto"});
                                    animating = false;
                                });
                            });
                    }
                });


                //"Slide to" buttons click event
                $('[data-slide-to]').click(function (e) {
                    e.preventDefault();

                    var d = $("#" + $(this).data('slide-to')).offset().top;

                    $("html, body").animate({ scrollTop: d - 40 }, 1000, 'easeInOutExpo');

                    return false;
                });


                //"Load more" grid items click event
                $('[data-load-amount]').click(function (e) {
                    e.preventDefault();

                    var $btn = $(this),
                        amount = $btn.data("load-amount"),
                        $id = $("#" + $btn.data("grid-id")),
                        count = 0;

                    $("div.disabled", $id).each(function () {
                        if (count < amount) {
                            $(this).css({ opacity: 0, "margin-top": "-20px" }).removeClass("disabled").animate({ opacity: 1, "margin-top": "0px" }, 500);
                        }
                        count += 1;
                    });

                    if (!$("div.disabled", $id).length) {
                        $btn.hide();
                    }

                    return false;
                });
            },

            initCountUp: function () {

                var options = {
                        useEasing : true,
                        useGrouping : true,
                        separator : ',',
                        decimal : '.'
                    },
                    timers = [],
                    checkViewPort;

                $(".timer").each(function (i) {
                    var tis = $(this);
                    tis.attr("id", "timer" + i);
                    timers["timer" + i] = new CountUp("timer" + i, 0, parseInt(tis.data("to"), 10), 0, 4.5, options);
                });

                checkViewPort = function () {
                    var s = $(window).scrollTop(),
                        h = $(window).height();

                    $('.timer').each(function () {
                        var $this = $(this);

                        if (s + h >= $this.offset().top) {
                            timers[$this.attr("id")].start();
                        }
                    });
                };

                $(window).scroll(function () {
                    checkViewPort();
                });

                checkViewPort();
            },
            /*
            contactForm: function () {

                var $tis = this;

                $(".submit_form").click(function (e) {
                    e.preventDefault();

                    var $submit_btn = $(this),
                        $form = $submit_btn.closest("form"),
                        $fields = $("input, textarea", $form),
                        len = 0,
                        re = /\S+@\S+\.\S+/,
                        html = "contact",
                        error = false,
                        showError,
                        showSuccess,
                        stopSpin,
                        capChallenge,
                        capResponse;

                    $fields.each(function () {
                        var $field = $(this);

                        if ($field.attr('type') === "hidden") {
                            if ($field.hasClass('subject')) {
                                html += "&subject=" + $field.val();
                            } else if ($field.hasClass('fromName') || $field.hasClass('fromname')) {
                                html += "&fromname=" + $field.val();
                            } else if ($field.hasClass('fromEmail') || $field.hasClass('fromemail')) {
                                html += "&fromemail=" + $field.val();
                            } else if ($field.hasClass('emailTo') || $field.hasClass('emailto')) {
                                html += "&emailto=" + $field.val();
                            }
                        } else {
                            if ($field.hasClass('required') && $field.val() === "") {
                                $field.addClass('invalid');
                                error = true;
                            } else if ($field.attr('type') === "email" && $field.val() !== "" && re.test($field.val()) === false) {
                                $field.addClass('invalid');
                                error = true;
                            } else if ($field.attr('id') !== "recaptcha_response_field") {
                                $field.removeClass('invalid');
                                if ($field.hasClass('subject')) {
                                    html += "&subject=" + $field.val();
                                    html += "&subject_label=" + $field.attr("name");
                                } else if ($field.hasClass('fromName') || $field.hasClass('fromname')) {
                                    html += "&fromname=" + $field.val();
                                    html += "&fromname_label=" + $field.attr("name");
                                } else if ($field.hasClass('fromEmail') || $field.hasClass('fromemail')) {
                                    html += "&fromemail=" + $field.val();
                                    html += "&fromemail_label=" + $field.attr("name");
                                } else {
                                    html += "&field" + len + "_label=" + $field.attr("name");
                                    html += "&field" + len + "_value=" + $field.val();
                                    len += 1;
                                }
                            }
                        }
                    });

                    html += "&len=" + len;

                    showError = function () {
                        var iClass = $('i', $submit_btn).attr("class");

                        $('i', $submit_btn).removeClass(iClass).addClass('fa fa-times').delay(1500).queue(function (next) {
                            $(this).removeClass('fa fa-times').addClass(iClass);
                            next();
                        });
                        $submit_btn.addClass('btn-danger').delay(1500).queue(function (next) {
                            $(this).removeClass('btn-danger');
                            next();
                        });
                    };

                    showSuccess = function () {
                        var iClass = $('i', $submit_btn).attr("class");

                        $('i', $submit_btn).removeClass(iClass).addClass('fa fa-check').delay(1500).queue(function (next) {
                            $(this).removeClass('fa fa-check').addClass(iClass);
                            next();
                        });
                        $submit_btn.addClass('btn-success').delay(1500).queue(function (next) {
                            $(this).removeClass('btn-success');
                            next();
                        });
                    };

                    stopSpin = function () {
                        $('i', $submit_btn).removeClass('fa-cog fa-spin').addClass('fa-envelope');
                        $submit_btn.removeClass('disabled');
                    };

                    if (!error && !$tis.sendingMail) {
                        $tis.sendingMail = true;
                        $('i', $submit_btn).removeClass('fa-envelope').addClass('fa-cog fa-spin');
                        $submit_btn.addClass('disabled');

                        if ($("#recaptcha_response_field").length) {
                            capChallenge = Recaptcha.get_challenge();
                            capResponse = Recaptcha.get_response();

                            $.ajax({
                                type: 'POST',
                                url: 'recaptcha/verify.php',
                                data: 'captcha=' + capResponse + '&challenge=' + capChallenge,
                                success: function (json) {
                                    var result = JSON.parse(json);

                                    $(".recaptcha_only_if_incorrect").hide();

                                    if (result.status === 0) {
                                        $(".recaptcha_only_if_incorrect").show();

                                        stopSpin();
                                        showError();

                                        $tis.sendingMail = false;

                                    } else if (result.status === 1) {
                                        $.ajax({
                                            type: 'POST',
                                            url: 'contact.php',
                                            data: html,
                                            success: function (msg) {
                                                stopSpin();

                                                if (msg === 'ok') {
                                                    showSuccess();
                                                    $form[0].reset();
                                                } else {
                                                    showError();
                                                }

                                                $tis.sendingMail = false;
                                            },
                                            error: function () {
                                                stopSpin();
                                                showError();
                                                $tis.sendingMail = false;
                                            }
                                        });
                                    }

                                    Recaptcha.reload();
                                },

                                error: function () {
                                    stopSpin();
                                }
                            });

                        } else {
                            $.ajax({
                                type: 'POST',
                                url: 'contact.php',
                                data: html,
                                success: function (msg) {
                                    stopSpin();

                                    if (msg === 'ok') {
                                        showSuccess();
                                        $form[0].reset();
                                    } else {
                                        showError();
                                    }

                                    $tis.sendingMail = false;
                                },
                                error: function () {
                                    stopSpin();

                                    showError();
                                    $tis.sendingMail = false;
                                }
                            });
                        }

                    } else {
                        showError();
                    }

                    return false;
                });
            },*/

            viewModeSwitcher: function () {

                $(".view-mode ul > li").bind('click', function () {
                    var $btn = $(this),
                        target = $btn.data("target"),
                        view = $btn.data("view");

                    $(">li", $(this).parent()).each(function () {
                        $(this).removeClass("active");
                    });

                    $btn.addClass("active");

                    $("#" + target).children().animate({ opacity: 0 }, 300, function () {
                        $("#" + target).removeClass().addClass(view);
                        $("#" + target).children().animate({ opacity: 1 }, 300);
                    });
                });
            },

            animateElems : function () {

                var animate = function () {
                    $('[data-animation-delay]').each(function () {
                        var $this = $(this),
                            s = $(window).scrollTop(),
                            h = $(window).height(),
                            d = parseInt($this.attr('data-animation-delay'), 10),
                            dir = $this.data('animation-direction');

                        if (dir === undefined) {
                            return false;
                        }

                        $this.addClass('animate-' + dir);

                        if (s + h >= $this.offset().top) {
                            if (isNaN(d) || d === 0) {
                                $this.removeClass('animate-' + dir).addClass('animation-' + dir);
                            } else {
                                setTimeout(function () {
                                    $this.removeClass('animate-me').addClass('animation-' + dir);
                                }, d);
                            }
                        }
                    });
                };

                if ($(window).innerWidth() >= 751) {
                    $(window).scroll(function () {
                        animate();
                    });

                    animate();
                }
            }

        };

        Cozy.init();
    });
}(jQuery));
