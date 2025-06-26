// Template Name   :  CarrGo - Ridesharing Taxi Template
// File            :  JS Base
// Version         :  1.0.2
// Author          :  Radiuzz (https://themeforest.net/user/radiuzz)
// Developer:      :  Studio Radiuzz
// Email           :  studioradiuzz@gmail.com

$(document).ready(function () {

    // Dropdown - Start
    // --------------------------------------------------
    $('.dropdown').hover(function () {
        $(this).find('> .dropdown-menu').addClass('show');
    }, function () {
        $(this).find('> .dropdown-menu').removeClass('show');
    });
    // Dropdown - End
    // --------------------------------------------------

    // sticky header - start
    // --------------------------------------------------
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 120) {
            $('header').addClass("sticky")
        } else {
            $('header').removeClass("sticky")
        }
    });
    // sticky header - end
    // --------------------------------------------------

    $(".a-nav-toggle").on("click", function () {
        if ($("html").hasClass("body-menu-opened")) {
            $("html").removeClass("body-menu-opened").addClass("body-menu-close");
            $("body").removeClass("active");
        } else {
            $("html").addClass("body-menu-opened").removeClass("body-menu-close");
            $("body").addClass("active");
        }
    });

    $(".close-menu").on("click", function () {
        $(".responsive-menu").removeClass("active");
        $("html").removeClass("body-menu-opened");
        $("body").removeClass("active");
        return false;
    });

    $(".mobile-menu ul").parent().addClass("menu-item-has-children");
    $(".mobile-menu li.menu-item-has-children > a").on("click", function () {
        $(this).parent().toggleClass("active").siblings().removeClass("active");
        $(this).next("ul").slideToggle();
        $(this).parent().siblings().find("ul").slideUp();
        return false;
    });

    // RESPONSIVE MOBILE MENU

    $(".nav-toggle-btn").on("click", function () {
        $(".responsive-menu").toggleClass("active");
    });

    const heroCarousel = $('#hero-area-slider');

    heroCarousel.owlCarousel({
        items: 1,
        loop: true,
        dots: true,
    });

    $('#testimonial-carousel-1').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        nav: true,
        navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>'],
        responsive: {
            768: {
                navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>']
            },
            575: {
                navText: ['<i class="fal fa-angle-left"></i><span></span>', '<span></span><i class="fal fa-angle-right"></i>']
            },
            0: {
                navText: false
            }
        }
    });

    // $('#testimonial-test').owlCarousel({
    //     items: 2,
    //     loop: true,
    //     dots: false,
    //     nav: true,
    //     margin: 10,
    //     navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>'],
    //     responsive: {
    //         768: {
    //             navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>']
    //         },
    //         575: {
    //             navText: ['<i class="fal fa-angle-left"></i><span></span>', '<span></span><i class="fal fa-angle-right"></i>']
    //         },
    //         0: {
    //             navText: false
    //         }
    //     }
    // });
    const owl = $('#testimonial-test');

    owl.owlCarousel({
        items: 2,
        loop: true,
        dots: false,
        nav: true,
        margin: 10,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [980, 2],
        itemsMobile: [600, 1],
        navigation: true,
        navText: false,
        navText: ['<i class="fal fa-angle-left"></i>', '<i class="fal fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
                nav: false
            },

            700: {
                items: 2,
                nav: false
            },

            1024: {
                items: 2
            },

            1366: {
                items: 2,
            }
        }
        // responsive: {
        //     768: {
        //         navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>']
        //     },
        //     575: {
        //         navText: ['<i class="fal fa-angle-left"></i><span></span>', '<span></span><i class="fal fa-angle-right"></i>']
        //     },
        //     0: {
        //         navText: false
        //     }
        // }
    });


    // $(".next").click(function () {
    //     owl.trigger("owl.next");
    // });
    // $(".prev").click(function () {
    //     owl.trigger("owl.prev");
    // });

    $('#testimonial-carousel-2').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        nav: true,
        navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>'],
        responsive: {
            768: {
                navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>']
            },
            575: {
                navText: ['<i class="fal fa-angle-left"></i><span></span>', '<span></span><i class="fal fa-angle-right"></i>']
            },
            0: {
                navText: false
            }
        }
    });

    $('#driver-carousel').owlCarousel({
        items: 4,
        loop: true,
        nav: true,
        margin: 15,
        navText: ['<i class="fal fa-angle-left"></i><span>Previous</span>', '<span>Next</span><i class="fal fa-angle-right"></i>'],
        responsive: {
            1200: {
                items: 4
            },
            992: {
                items: 3,
                navText: false
            },
            768: {
                items: 2,
                navText: false
            },
            0: {
                navText: false,
                items: 1
            }
        }
    });

    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    $('.counter-number').counterUp({
        delay: 10,
        time: 1000
    });

    $(window).trigger("resize");
    init_map();





});

const gmMapDiv = $("#map-canvas");
const onridemap = $("#onridemap");
const ridemap = $("#ride-map");
const contactmap = $("#contact-map");

function init_map() {
    (function ($) {

        if (gmMapDiv.length) {

            const gmCenterAddress = gmMapDiv.attr("data-address");
            let gmMarkerAddress = gmMapDiv.attr("data-address");


            gmMapDiv.gmap3({
                action: "init",
                marker: {
                    address: gmMarkerAddress,
                    latLng: [22.952635, 91.282526],
                    options: {
                        icon: "../assets/images/map-marker.webp"
                    }
                },
                map: {
                    options: {
                        zoom: 14,
                        zoomControl: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.SMALL
                        },
                        mapTypeControl: false,
                        scaleControl: false,
                        scrollwheel: false,
                        streetViewControl: false,
                        draggable: true,
                        styles: [{
                                "featureType": "administrative",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "administrative.province",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": 65
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": "50"
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "simplified"
                                }]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "30"
                                }]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "40"
                                }]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                        "hue": "#ffff00"
                                    },
                                    {
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -97
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels",
                                "stylers": [{
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -100
                                    }
                                ]
                            }
                        ]
                    }
                }
            });
        }


        if (onridemap.length) {

            // const gmCenterAddress = onridemap.attr("data-address");
            let gmMarkerAddress = onridemap.attr("data-address");


            onridemap.gmap3({
                action: "init",
                marker: {
                    address: gmMarkerAddress,
                    latLng: [22.952635, 91.282526],
                    options: {
                        icon: "../assets/images/map-marker.webp"
                    }
                },
                map: {
                    options: {
                        zoom: 14,
                        zoomControl: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.SMALL
                        },
                        mapTypeControl: false,
                        scaleControl: false,
                        scrollwheel: false,
                        streetViewControl: false,
                        draggable: true,
                        styles: [{
                                "featureType": "administrative",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "administrative.province",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": 65
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": "50"
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "simplified"
                                }]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "30"
                                }]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "40"
                                }]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                        "hue": "#ffff00"
                                    },
                                    {
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -97
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels",
                                "stylers": [{
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -100
                                    }
                                ]
                            }
                        ]
                    }
                }
            });
        }

        if (ridemap.length) {

            // const gmCenterAddress = onridemap.attr("data-address");
            let gmMarkerAddress = ridemap.attr("data-address");


            ridemap.gmap3({
                action: "init",
                marker: {
                    address: gmMarkerAddress,
                    latLng: [22.952635, 91.282526],
                    options: {
                        icon: "../assets/images/map-marker.webp"
                    }
                },
                map: {
                    options: {
                        zoom: 14,
                        zoomControl: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.SMALL
                        },
                        mapTypeControl: false,
                        scaleControl: false,
                        scrollwheel: false,
                        streetViewControl: false,
                        draggable: true,
                        styles: [{
                                "featureType": "administrative",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "administrative.province",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": 65
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": "50"
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "simplified"
                                }]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "30"
                                }]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "40"
                                }]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                        "hue": "#ffff00"
                                    },
                                    {
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -97
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels",
                                "stylers": [{
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -100
                                    }
                                ]
                            }
                        ]
                    }
                }
            });
        }

        if (contactmap.length) {

            // const gmCenterAddress = onridemap.attr("data-address");
            let gmMarkerAddress = contactmap.attr("data-address");


            contactmap.gmap3({
                action: "init",
                marker: {
                    address: gmMarkerAddress,
                    latLng: [22.952635, 91.282526],
                    options: {
                        icon: "../assets/images/map-marker-2.webp"
                    }
                },
                map: {
                    options: {
                        zoom: 14,
                        zoomControl: true,
                        zoomControlOptions: {
                            style: google.maps.ZoomControlStyle.SMALL
                        },
                        mapTypeControl: false,
                        scaleControl: false,
                        scrollwheel: false,
                        streetViewControl: false,
                        draggable: true,
                        styles: [{
                                "featureType": "administrative",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "administrative.province",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": 65
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "lightness": "50"
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "road",
                                "elementType": "all",
                                "stylers": [{
                                    "saturation": "-100"
                                }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "simplified"
                                }]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "30"
                                }]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "all",
                                "stylers": [{
                                    "lightness": "40"
                                }]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": -100
                                    },
                                    {
                                        "visibility": "simplified"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                        "hue": "#ffff00"
                                    },
                                    {
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -97
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels",
                                "stylers": [{
                                        "lightness": -25
                                    },
                                    {
                                        "saturation": -100
                                    }
                                ]
                            }
                        ]
                    }
                }
            });
        }




    })(jQuery);
}