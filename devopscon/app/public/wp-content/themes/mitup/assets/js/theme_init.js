(function($) {
    
    'use strict';

    $(document).ready(function () {

        "use strict";
        

        theme.googlemap();
        theme.init();
        theme.sc_button();

        setTimeout(function() {
            theme.mainslider();
        }, 500);

        theme.countdown();
        
        theme.frequently_questions_slider();
        theme.speakers();
        theme.sponsor();
        theme.bgslide();
        theme.testimonials();
        theme.blogs();
        
        theme.onepagemenu();

        // initAnimation();
         
        

    });

    /* Animation */
    // function initAnimation(){

    //     var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        
        
    //     if (isMobile == false) {
            
    //         $('.animated').css('opacity',0);
    //         $('.animated').waypoint(function (down) {

    //             var el = $(this);
    //             var animation = el.data('animation');
    //             var animationDelay = el.data('animation_delay');

    //             if (animationDelay && animation ) {
    //                 setTimeout(function () {
    //                     el.addClass(animation);
    //                     el.css('opacity',1);
    //                 }, animationDelay);
    //             }
                


    //         }, {
    //             offset: '100%'
    //         });


    //     }

    //     if(isMobile == true){

    //         $('.wpb_animate_when_almost_visible').each(function(){
    //             $(this).removeClass('wpb_animate_when_almost_visible');
    //         });

    //     }

            
    // }




    $(window).load(function() {
        $('#loading').fadeOut();
        if (location.hash != '') {
            var hash = '#' + window.location.hash.substr(1);
            if (hash.length) {

                $('html,body').delay(0).animate({
                    scrollTop: $(hash).offset().top - 60 + 'px'
                }, {
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
            }
        }
    });


    $(document).ready(function () {
        "use strict";
        theme.onResize();
    });
    $(window).load(function () {
        theme.onResize();
       
    });
    $(window).resize(function () {
        theme.onResize();
    });
        

})(jQuery);




