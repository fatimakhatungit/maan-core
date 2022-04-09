(function ($) {
"use strict";

    var MaanGlobal = function ($scope, $) {

        // Js Start
            $('[data-background]').each(function() {
                $(this).css('background-image', 'url('+ $(this).attr('data-background') + ')');
            });
        if($('.wow').length){
            new WOW({
                offset: 100,
                mobile: true
            }).init()
        }
        jQuery(window).on('scroll', function() {
            if (jQuery(window).scrollTop() > 250) {
                jQuery('.maan-sticky-header').addClass('sticky-on')
            } else {
                jQuery('.maan-sticky-header').removeClass('sticky-on')
            }
        });
        $(".maan-icon-lightbox a").magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: '//player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                },
                srcAction: 'iframe_src',
            }
        });
        // Js End

    };

    var CDNavMenu = function ($scope, $) {

        $scope.find('.maan-nav-builder').each(function () {
            var settings = $(this).data('maan');

        // Js Start
            $('.str-open_mobile_menu').on("click", function() {
                $('.str-mobile_menu_wrap').toggleClass("mobile_menu_on");
            });
            $('.str-open_mobile_menu').on('click', function () {
                $('body').toggleClass('mobile_menu_overlay_on');
            });
            if($('.str-mobile_menu li.dropdown ul').length){
                $('.str-mobile_menu li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
                $('.str-mobile_menu li.dropdown .dropdown-btn').on('click', function() {
                    $(this).prev('ul').slideToggle(500);
                });
            }
        // Js End
        });

    };

    var MaanTesti = function ($scope, $) {

        $scope.find('.feed-area').each(function () {
            var settings = $(this).data('maan');
            // Js Start
            $('.feed-sldr').owlCarousel({
                loop: true,
                margin:30,
                nav: false,
                navText: [
                    "<i class='icofont-long-arrow-left'></i>",
                    "<i class='icofont-long-arrow-right'></i>"
                ],
                dots: true,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: settings['item']
                    },
                    1000: {
                        items: settings['item']
                    }
                }
            });
            // Js End
        });

    };
    var MaanCounter = function ($scope, $) {

        $scope.find('.counter-area').each(function () {
            var settings = $(this).data('maan');
            // Js Start
            $('.timer').countTo();
            $('.fun-fact').appear(function() {
                $('.timer').countTo();
            }, {
                accY: -100
            });
            // Js End
        });

    };

    var MaanDownload = function ($scope, $) {

        $scope.find('.portfolio-area').each(function () {
            var settings = $(this).data('maan');
            // Js Start
            $('#portfolio-grid').imagesLoaded(function() {
                /* Filter active */
                var grid = $('#portfolio-grid').isotope({
                    itemSelector: '.pf-item',
                    percentPosition: true,
                    masonry: {
                        columnWidth: '.pf-item',
                    }
                });

                /* Filter menu */
                $('.mix-item-menu').on('click', 'button', function() {
                    var filterValue = $(this).attr('data-filter');
                    grid.isotope({
                        filter: filterValue
                    });
                });

                /* filter menu active class  */
                $('.mix-item-menu button').on('click', function(event) {
                    $(this).siblings('.active').removeClass('active');
                    $(this).addClass('active');
                    event.preventDefault();
                });
            });
                // Js End
        });

    };



    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            $(".preloader").fadeOut();
            console.log('Elementor editor mod loaded');
            elementorFrontend.hooks.addAction('frontend/element_ready/global', MaanGlobal);
            elementorFrontend.hooks.addAction('frontend/element_ready/nav-builder.default', CDNavMenu);
            elementorFrontend.hooks.addAction('frontend/element_ready/maan-testimonial.default', MaanTesti);
            elementorFrontend.hooks.addAction('frontend/element_ready/maan-counter.default', MaanCounter);
            elementorFrontend.hooks.addAction('frontend/element_ready/download-filter.default', MaanDownload);
        }
        else {
            console.log('Elementor frontend mod loaded');
            elementorFrontend.hooks.addAction('frontend/element_ready/global', MaanGlobal);
            elementorFrontend.hooks.addAction('frontend/element_ready/maan-testimonial.default', MaanTesti);
            elementorFrontend.hooks.addAction('frontend/element_ready/maan-counter.default', MaanCounter);
            elementorFrontend.hooks.addAction('frontend/element_ready/download-filter.default', MaanDownload);
        }
    });
console.log('addon js loaded');
})(jQuery);