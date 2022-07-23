var theme = function ($) {
    
    'use strict';

    function resizePage(){
        var ismobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (ismobile != false) {
            $(".navbar-collapse").css({ maxHeight: $(window).height() - $(".navbar-header").height() + "px" });    
        }
    };

    /* Fix shrink header when scroll page */

    function refresh() {
        var header = $('header .header_menu');
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            header.addClass('shrink');
        } else {
            header.removeClass('shrink');
            $('.header .nav li').removeClass('current');
        }
    };
    function shrinkheader() {
        $(window).load(function () { refresh(); });
        $(window).scroll(function () { refresh(); });
        $(window).on('touchstart',function(){ refresh(); });
        $(window).on('scrollstart',function(){ refresh(); });
        $(window).on('scrollstop',function(){ refresh(); });
        $(window).on('touchmove',function(){ refresh(); });

    }
    /* /Fix shrink header when scroll page */

    /* Fix full-height for slider */
    function heightslider(){
        var height_desk = $('.main_slider').data('height_desk');
        var height_ipad = $('.main_slider').data('height_ipad');
        var height_mobile = $('.main_slider').data('height_mobile');

        var widthw = $(window).width();

        if(widthw < 768){
            $('.main_slider .item').css('height', height_mobile);    
        }else if (widthw >= 768 && widthw < 991){
            $('.main_slider .item').css('height', height_ipad);
        }else{
            $('.main_slider .item').css('height', height_desk);
        }

        
        var ismobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (ismobile != false) {
            $(".navbar-collapse").css({ maxHeight: $(window).height() - $(".navbar-header").height() + "px" });    
        }

    }
    /* /Fix full-height for slider */

    /* Close menu when click an item in mobile */
    function menumobile(){
        $(document).on('click','.navbar-collapse.in',function(e) {
            if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
                $(this).collapse('hide');
            }
        });
    }
    /* Scroll top */
    function scrolltop() {
        
        $('.totop').click(function () {
            $('html, body').animate({scrollTop: '0px'}, 300);
            return false;
        });
        $('.sidebar .mc4wp-form input[type="submit"]').val(">>");
    }

    /* Empty link */
    function BehaviorEmptyLinks() {
        $('a[href="#"]').click(function (event) {
            event.preventDefault();
        });
    }

    /* PrettyPhoto */
    function PrettyPhoto() {
         $("a[data-rel^='prettyPhoto']").prettyPhoto();
    }

    
    /* fix layout */
    function fixlayout(){

        var widthW = $(window).width();
        var widthContent = $('.container').outerWidth();
        var paddingLeft = (widthW - widthContent)/2;

        /* quickinfo */
        $('.quickinfo.text-left').css("padding-left", paddingLeft);
        $('.quickinfo.text-right').css("padding-right", paddingLeft);
        var zindex = $('.zindex').height();
        $('.zindex').css("margin-top", '-'+zindex+'px');

        /* about */
        var spe_about_h = $('.spe_about').outerHeight();
        $('.fixpadding_left').css("padding-left", paddingLeft);
        $('.spe_about_bg').css('height', spe_about_h);

        /* faq*/
        $('.fixpadding_right').css("padding-right", paddingLeft);
        var faq_content = $('.faq_content').outerHeight();
        $('.event_bgslide .bgslide_item .bg').css('height', faq_content);

        /* Register text */
        var register_text_h = $('.register_text').outerHeight();
        $('.register_text_bg').css('height', register_text_h);


    }


    function bootstrap_select(){
        $('.selectpicker').selectpicker({
        });
        
    }



   



    /* Show hide speaker */
    $('.list_speaker a').off('click').on('click', function(){
        $(this).addClass('active');
    });



    /* INIT FUNCTIONS */
    /* --------------------------------------------------------------------------------------- */
    return {
        onResize: function () {
            resizePage();
            fixlayout();
            heightslider();

        },
        init: function () {
            BehaviorEmptyLinks();
            heightslider();
            shrinkheader();
            menumobile();
            scrolltop();
            PrettyPhoto();
            fixlayout();
            bootstrap_select();

        },
        /* Main Slider */
        mainslider: function () {
            $('.main_slider').each(function(){

                var auto_slider = $(this).data('auto_slider');
                var duration = $(this).data('duration');
                var navigation = $(this).data('navigation');
                var loop = $(this).data('loop');

                $(this).owlCarousel({
                    autoplay: auto_slider,
                    autoplayHoverPause: true,
                    loop: loop,
                    margin: 0,
                    dots: false,
                    autoplayTimeout: duration,
                    nav: navigation,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ],
                    responsiveRefreshRate: 100,
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 1},
                        768:  {items: 1},
                        991:  {items: 1},
                        1024: {items: 1}
                    }
                });
            });

        },
        /* Button shortcode */
        sc_button: function () {
            $('.sc_button a, button.submit-button').each(function(){
                var bg = $(this).data('bg');
                var bg_hover = $(this).data('bg_hover');
                var text_color = $(this).data('text_color');
                var text_color_hover = $(this).data('text_color_hover');
                var border_color = $(this).data('border_color');
                var border_color_hover = $(this).data('border_color_hover');
                $(this).mouseover(function(){

                    $(this).css({
                        "background-color": bg_hover,
                        "-webkit-transition": "all .3s ease-in-out 0s",
                        "-moz-transition": "all .3s ease-in-out 0s",
                        "-ms-transition": "all .3s ease-in-out 0s",
                        "-o-transition": "all .3s ease-in-out 0s",
                        "transition":  "all .3s ease-in-out 0s"
                    });
                    $(this).css({
                        'border-color': border_color_hover,
                        "-webkit-transition": "all .3s ease-in-out 0s",
                        "-moz-transition": "all .3s ease-in-out 0s",
                        "-ms-transition": "all .3s ease-in-out 0s",
                        "-o-transition": "all .3s ease-in-out 0s",
                        "transition":  "all .3s ease-in-out 0s"
                    });
                    $(this).css({
                        'color': text_color_hover,
                        "-webkit-transition": "all .3s ease-in-out 0s",
                        "-moz-transition": "all .3s ease-in-out 0s",
                        "-ms-transition": "all .3s ease-in-out 0s",
                        "-o-transition": "all .3s ease-in-out 0s",
                        "transition":  "all .3s ease-in-out 0s"
                    });
                    
                    
                });
                $(this).mouseout(function(){
                    
                    $(this).css({
                        "background-color": bg,
                        "-webkit-transition": "all .3s ease-in-out 0s",
                        "-moz-transition": "all .3s ease-in-out 0s",
                        "-ms-transition": "all .3s ease-in-out 0s",
                        "-o-transition": "all .3s ease-in-out 0s",
                        "transition":  "all .3s ease-in-out 0s"
                    });
                    $(this).css({
                        'border-color': border_color,
                        "-webkit-transition": "all .3s ease-in-out 0s",
                        "-moz-transition": "all .3s ease-in-out 0s",
                        "-ms-transition": "all .3s ease-in-out 0s",
                        "-o-transition": "all .3s ease-in-out 0s",
                        "transition":  "all .3s ease-in-out 0s"
                    });
                    $(this).css({
                        'color': text_color,
                        "-webkit-transition": "all .3s ease-in-out 0s",
                        "-moz-transition": "all .3s ease-in-out 0s",
                        "-ms-transition": "all .3s ease-in-out 0s",
                        "-o-transition": "all .3s ease-in-out 0s",
                        "transition":  "all .3s ease-in-out 0s"
                    });

                    
                });
            });
        },
        
        countdown: function() {
            $('.event_countdown').each(function(){
                var years = $(this).data('years');
                var months = $(this).data('months');
                var weeks = $(this).data('weeks');
                var days = $(this).data('days');
                var hours = $(this).data('hours');
                var minutes = $(this).data('minutes');
                var seconds = $(this).data('seconds');

                var year = $(this).data('year');
                var month = $(this).data('month');
                var week = $(this).data('week');
                var day = $(this).data('day');
                var hour = $(this).data('hour');
                var minute = $(this).data('minute');
                var second = $(this).data('second');

                var end_date_y = $(this).data('end_date_y');
                var end_date_m = $(this).data('end_date_m');
                var end_date_d = $(this).data('end_date_d');

                var timezone = $(this).data('timezone');
                var display_format = $(this).data('display_format');


                var austDay = new Date();
                austDay = new Date(end_date_y, end_date_m, end_date_d);
                $(this).countdown({
                    labels: [years,months,weeks,days,hours,minutes,seconds], 
                    labels1: [year,month,week,day,hour,minute,second], 
                    until: austDay, 
                    timezone: timezone, 
                    format: display_format
                });
            });
        },
        
        /* Onepgae menu */
        onepagemenu: function(){
            $('.header .nav').onePageNav({
                currentClass: 'current',
                changeHash: false,
                scrollSpeed: 750,
                scrollThreshold: 0.1,
                filter: '.scroll',
                easing: 'swing',
                end:function(){
                    refresh();
                }

                
            });
            $('body').onePageNav({
                filter: '.scroll'
            });
             
        },
        /* frequently_questions_slider */
        frequently_questions_slider:function(){
                $('.frequently_questions').each(function(){
                var auto_slider = $(this).data('auto');
                var duration = $(this).data('duration');
                var loop = $(this).data('loop');
                var dot = $(this).data('dot');
                var item_count = $(this).data('count');
                $(this).owlCarousel({
                    autoplay: auto_slider,
                    autoplayHoverPause: true,
                    loop: loop,
                    margin: 30,
                    nav:false,
                    dots: dot,
                    autoplayTimeout: duration,
                    responsiveRefreshRate: 100,
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 2},
                        768:  {items: 2},
                        991:  {items: 2},
                        1024: {items: item_count}
                    }
                });
            });
        },
        /* Speakers */
        speakers: function () {
            $('.event_speakers').each(function(){

                var count = $(this).data('count');
                var autoplay = $(this).data('autoplay');
                var duration = $(this).data('duration');
                var dots = $(this).data('dots');
                var loop = $(this).data('loop');


                $(this).owlCarousel({
                    autoplay: autoplay,
                    autoplayTimeout: duration,
                    loop: loop,
                    dots: dots,
                    margin: 30,
                    nav: false,
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 1},
                        768:  {items: 2},
                        991:  {items: 2},
                        1024: {items: count}
                    },
                    navText: [
                        "<i class='fa fa-caret-left'></i>",
                        "<i class='fa fa-caret-right'></i>"
                    ]
                });
            });
            
        },
        
        /* Sponsor */
        sponsor: function () {
            $('.event_sponsor').each(function(){

                var count = $(this).data('count');
                var autoplay = $(this).data('autoplay');
                var duration = $(this).data('duration');
                var dots = $(this).data('dots');
                var loop = $(this).data('loop');


                $(this).owlCarousel({
                    autoplay: autoplay,
                    autoplayTimeout: duration,
                    loop: loop,
                    dots: dots,
                    margin: 30,
                    nav: false,
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 1},
                        768:  {items: 2},
                        991:  {items: 2},
                        1024: {items: count}
                    },
                    navText: [
                        "<i class='fa fa-caret-left'></i>",
                        "<i class='fa fa-caret-right'></i>"
                    ]
                });
            });
            
        },
        /* event_bgslide */
        bgslide: function () {
            $('.event_bgslide').each(function(){

                var auto_slider = $(this).data('auto_slider');
                var duration = $(this).data('duration');
                var navigation = $(this).data('navigation');
                var loop = $(this).data('loop');

                $(this).owlCarousel({
                    autoplay: auto_slider,
                    autoplayHoverPause: true,
                    loop: loop,
                    margin: 0,
                    dots: false,
                    autoplayTimeout: duration,
                    nav: navigation,
                    navText: [
                        "<i class='fa fa-angle-left'></i>",
                        "<i class='fa fa-angle-right'></i>"
                    ],
                    responsiveRefreshRate: 100,
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 1},
                        768:  {items: 1},
                        991:  {items: 1},
                        1024: {items: 1}
                    }
                });false

            });
            
        },

        /* Testimonials */
        testimonials: function () {
            $('.testimonials-alt').each(function(){

                var autoplay = $(this).data('autoplay');
                var duration = $(this).data('duration');
                var dots = $(this).data('dots');
                var loop = $(this).data('loop');

                $(this).owlCarousel({
                    items: 3,
                    autoplay: autoplay,
                    autoplayTimeout: duration,
                    loop: loop,
                    dots: dots,
                    margin: 30,
                    nav: false,
                    navText: [
                        "<i class='fa fa-caret-left'></i>",
                        "<i class='fa fa-caret-right'></i>"
                    ],
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 1},
                        768:  {items: 2},
                        991:  {items: 2},
                        1024: {items: 3}
                    }
                });
            });
            
        },
        /* blog */
        blogs: function () {
            $('.event_blog').each(function(){

                var autoplay = $(this).data('autoplay');
                var duration = $(this).data('duration');
                var dots = $(this).data('dots');
                var loop = $(this).data('loop');
                var count = $(this).data('count');

                $(this).owlCarousel({
                    autoplay: autoplay,
                    autoplayTimeout: duration,
                    loop: loop,
                    dots: dots,
                    nav: false,
                    margin: 30,
                    responsive: {
                        0:    {items: 1},
                        479:  {items: 1},
                        768:  {items: 2},
                        991:  {items: 2},
                        1024: {items: count}
                    },
                    navText: [
                        "<i class='fa fa-caret-left'></i>",
                        "<i class='fa fa-caret-right'></i>"
                    ]
                });
            });
            
        },
        /* Google map */
        googlemap: function () {

            $('.event-google-map').each(function(){

                var idmap = $(this).data('idmap');
                var zoom =  $(this).data('zoom');
                var icon = $(this).data('icon');
                var title = $(this).data('title').split("|");
                var location = $(this).data('location').split("|");

                var location_obj = [];
                var title_obj = [];
                
                for(var i=0; i< location.length; i++){
                    location_obj[i] = location[i].replace(" ","");
                }

                for(var k=0; k< title.length; k++){
                    title_obj[k] = "<span class='title_marker'>"+title[k]+'</div>';
                }
                


                function initialize() {
                    var map;
                    var bounds = new google.maps.LatLngBounds();
                    var mapOptions = {
                        mapTypeId: 'roadmap',
                        scrollwheel: false 
                    };
                                    
                    /* Display a map on the page */
                    map = new google.maps.Map(document.getElementById(idmap), mapOptions);
                    map.setTilt(45);
                   
                    /* Display multiple markers on a map */
                    var infoWindow = new google.maps.InfoWindow(), marker, i;
                    
                    /* Loop through our array of markers & place each one on the map */
                    for(var d=0; d< location_obj.length; d++){
                        var localtion_lg = location_obj[d].split(",");
                        var position = new google.maps.LatLng(localtion_lg[0], localtion_lg[1]);
                        bounds.extend(position);
                        marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            icon: icon
                        });
                        
                        /* Allow each marker to have an info window */
                        google.maps.event.addListener(marker, 'click', (function(marker, d) {
                            return function() {
                                infoWindow.setContent(title_obj[d]);
                                infoWindow.open(map, marker);
                            }
                        })(marker, d));

                        /* Automatically center the map fitting all markers on the screen */
                        map.fitBounds(bounds);
                    }

                    /* Override our map zoom level once our fitBounds function runs (Make sure it only runs once) */
                    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
                        this.setZoom(zoom);
                        google.maps.event.removeListener(boundsListener);
                    });
                    
                }

                google.maps.event.addDomListener(window, "load", initialize);

               
            });
        }
        



    };

}(jQuery);




