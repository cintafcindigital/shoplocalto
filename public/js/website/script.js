(function($) {

	"use strict";


    /*------------------------------------------
        = FUNCTIONS
    -------------------------------------------*/
    // Toggle mobile navigation
    function toggleMobileNavigation() {
        var navbar = $("#navbar");
        var navLinks = $("#navbar > ul > li > a:not(.dropdown-toggle)");
        var openBtn = $(".navbar-header .open-btn");
        var closeBtn = $("#navbar .close-navbar");

        openBtn.on("click", function() {
            if (!navbar.hasClass("slideInn")) {
                navbar.addClass("slideInn");
            }
            return false;
        })

        closeBtn.on("click", function() {
            if (navbar.hasClass("slideInn")) {
                navbar.removeClass("slideInn");
            }
            return false;            
        })

        navLinks.on("click", function() {
            if (navbar.hasClass("slideInn")) {
                navbar.removeClass("slideInn");
            }
            return false;            
        })
    }

    toggleMobileNavigation();


    // Parallax background
    function bgParallax() {
        if ($(".parallax").length) {
            $(".parallax").each(function() {
                var height = $(this).position().top;
                var resize     = height - $(window).scrollTop();
                var doParallax = -(resize/5);
                var positionValue   = doParallax + "px";
                var img = $(this).data("bg-image");

                $(this).css({
                    backgroundImage: "url(" + img + ")",
                    backgroundPosition: "50%" + positionValue,
                    backgroundSize: "cover"
                });
            });
        }
    }

    bgParallax();


    // Hero slider background setting
    function sliderBgSetting() {
        if ($(".hero-slider .slide").length) {
            $(".hero-slider .slide").each(function() {
                var $this = $(this);
                var img = $this.children(img);
                var imgSrc = img.attr("src");

                $this.css({
                    backgroundImage: "url("+ imgSrc +")",
                    backgroundSize: "cover",
                    backgroundPosition: "center center"
                })
            });
        }
    }

    // modal append to body
    if ($(".modal").length) {
        $('.modal').appendTo("body");
    }


    /*------------------------------------------
        = HIDE PRELOADER
    -------------------------------------------*/
    function preloader() {
        if($('.preloader').length) {
            $('.preloader').delay(100).fadeOut(500, function() {

                //active wow
                wow.init();

                //Active heor slider
                if ($(".hero-slider").length) {
                    $(".hero-slider").owlCarousel({
                        items: 1,
                        autoplay: true,
                        loop: true,
                        animateOut: 'fadeOut'
                    });

                    $('.hero .owl-controls').appendTo(".hero-slider-wrapper").addClass("hero-controls");
                }
            });
        }
    } 


    /*------------------------------------------
        = ACTIVE CURRENT MENU WHILE SCROLLING
    -------------------------------------------*/
    // function for active menuitem
    var sections = $("section"),
        nav = $("#navbar"),
        nav_height = nav.outerHeight();

    function activeMenuItem() {
        var cur_pos = $(window).scrollTop() + 2;
        sections.each(function() {
            var top = $(this).offset().top - nav_height,
                bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find("ul > li > a").parent().removeClass("active");
                nav.find("a[href='#" + $(this).attr('id') + "']").parent().addClass("active");
            } else if (cur_pos === 2) {
                nav.find("ul > li > a").parent().removeClass("active");
            }
        });
    }

    // smooth-scrolling
    $(function() {
        $("#navbar > ul > li > a:not(.dropdown-toggle)").on("click", function() {
            if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $("[name=" + this.hash.slice(1) +"]");
                if (target.length) {
                    $("html, body").animate({
                    scrollTop: target.offset().top - 40
                }, 1000, "easeInOutExpo");
                    return false;
                }
            }

            return false;
        });
    });  


    /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/
    $(window).on("scroll", function() {
        var header = $("#header");
        var headerHeight = $("#header").innerHeight();
        var scroll = $(window).scrollTop();
        var top = 1;

        if (scroll > top) {
            header.addClass("sticky");
            $("body").css({
                'padding-top': headerHeight + 'px'
            })
        } else {
            header.removeClass("sticky");
            $("body").css({
                'padding-top': 0
            })
        }
    });


    /*------------------------------------------
        = WOW ANIMATION SETTING
    -------------------------------------------*/
    var wow = new WOW({
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
    });


    


    /*------------------------------------------
        = story slider
    -------------------------------------------*/
    if ($(".proposal-slider").length) {
        $(".proposal-slider").owlCarousel({
            items: 2,
            loop: true,
            margin: 15,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
        });
    }

    if ($(".date-slider").length) {
        $(".date-slider").owlCarousel({
            items: 2,
            loop: true,
            margin: 15,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
        });
    }


    /*------------------------------------------
        = POPUP VIDEO
    -------------------------------------------*/
    if ($(".video").length) {
        $(".video").on("click", function(){
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                'title'         : this.title,
                helpers     : {  
                    title : { type : 'inside' },
                    media : {}
                }
            });
            return false
        });    
    }


    /*------------------------------------------
        = ACCOMODATION AND FOOD SLIDER
    -------------------------------------------*/
    if ($(".accomodation-slider").length) {
        $(".accomodation-slider").owlCarousel({
            items: 2,
            loop: true,
            margin: 10,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
        });
    }

    if ($(".food-slider").length) {
        $(".food-slider").owlCarousel({
            items: 2,
            loop: true,
            margin: 10,
            dots: false,
            nav: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
        });
    }


    /*------------------------------------------
        = GALLERY
    -------------------------------------------*/
    // Picture popup
    if ($(".gallery .fancybox").length) {
        $(".gallery .fancybox").fancybox({
            openEffect  : "elastic",
            closeEffect : "elastic",
            wrapCSS     : "project-fancybox-title-style",

            helpers : {
                title: {
                    type: 'inside'
                }
            },

            beforeShow : function(){
                $(".fancybox-wrap").addClass("gallery-fancybox");
            }
        });
    }

    // video popup
    if ($(".gallery .video").length) {
        $(".gallery .video").on("click", function(){
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                'title'         : this.title,
                helpers     : {  
                    title : { type : 'inside' },
                    media : {}
                },

                beforeShow : function(){
                    $(".fancybox-wrap").addClass("gallery-fancybox");
                }
            });
            return false
        });    
    }    

    // Gallery filtering
    function galleryFiltering() {
        if ($(".gallery-content").length) {
            var $container = $('.grid-wrapper');
            $container.isotope({
                filter:'*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false,
                }
            });

            $(".gallery-filters li a").on("click", function(e) {
                $('.gallery-filters li a.current').removeClass('current');
                $(this).addClass('current');
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter:selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });
                return false;
            });
        }
    }

    galleryFiltering();


    /*------------------------------------------
        = EVENTS TAB FUNCTIONALITY
    -------------------------------------------*/
    if ($(".event-panel").length) {
        var allLinks = $(".event-panel .panel-title > a");

        allLinks.on("click", function() {
            var $this = $(this);
            $this.closest(".panel-heading").toggleClass("current");
            $this.closest(".panel").siblings().find(".panel-heading").removeClass("current");
            console.log();
        });
    }


    /*------------------------------------------
        = GOOGLE MAP
    -------------------------------------------*/  
    function map() {

        var locations = [
            ['<h4>Main Ceremony</h4> Hotel Radison ', 23.818876, 90.408078,1],
            ['<h4>Reciption Party</h4> InterContinental Dhaka', 23.744214, 90.396446,2],
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(23.815183, 90.402966),
            zoom: 11,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP

        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {  
                marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon:'images/map-marker.png'
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    };


    /*------------------------------------------
        = RSVP FORM SUBMISSION
    -------------------------------------------*/  
    if ($("#rsvp-form").length) {
        $("#rsvp-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: "required",
                
                guest: {
                    required: true
                },
                
                events: {
                    required: true
                }

            },

            messages: {
                name: "Please enter your name",
                email: "Please enter your email",
                guest: "Select your number of guest",
                events: "Select your event list"
            },

            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "mail.php",
                    data: $(form).serialize(),
                    success: function () {
                        $( "#loader").hide();
                        $( "#success").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#success").slideUp( "slow" );
                        }, 3000);
                        form.reset();
                    },
                    error: function() {
                        $( "#loader").hide();
                        $( "#error").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#error").slideUp( "slow" );
                        }, 3000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    }


    /*==========================================================================
        WHEN DOCUMENT LOADING 
    ==========================================================================*/
        $(window).on('load', function() {

            preloader();

            bgParallax();

            sliderBgSetting();
            
            galleryFiltering();

            if ($(".map").length) {
                map();
            } 

        });


    /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function() {
        
        galleryFiltering();

    });



    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function() {
        
        activeMenuItem();

        bgParallax();

    });


})(window.jQuery);