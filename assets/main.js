(function($) {
    "use strict";
    // Document ready function 
    $(function() {
        headerNsliderResize();
        var priceSlider = document.getElementById('price-range-filter');
        if (priceSlider) {
            noUiSlider.create(priceSlider, {
                start: [20, 80],
                connect: true,
                range: {
                    'min': 0,
                    'max': 100
                },
                format: wNumb({
                    decimals: 0
                }),
            });
            var marginMin = document.getElementById('price-range-min'),
                marginMax = document.getElementById('price-range-max');
            priceSlider.noUiSlider.on('update', function(values, handle) {
                if (handle) {
                    marginMax.innerHTML = "$" + values[handle];
                } else {
                    marginMin.innerHTML = "$" + values[handle];
                }
            });
        }
        /*-------------------------------------
        Popup
        -------------------------------------*/
        var yPopup = $(".popup-youtube");
        if (yPopup.length) {
            yPopup.magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }
        if ($('.elv-zoom-single').length) {
            $('.elv-zoom-single').magnificPopup({ type: 'image' });
        }
        if ($('.zoom-gallery').length) {
            $('.zoom-gallery').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a.elv-zoom', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            });
        }
        /*-------------------------------------
        Booking dates and time
        -------------------------------------*/
        if ($('.rt-date').length) {
            $('.rt-date').datetimepicker({
                format: 'Y-m-d',
                timepicker: false
            });
        }
        if ($('.rt-time').length) {
            $('.rt-time').datetimepicker({
                format: 'H:i',
                datepicker: false
            });
        }
        /*-------------------------------------
         Jquery Serch Box
         -------------------------------------*/
        $(document).on('click', '#top-search-form a.search-button', function(e) {
            e.preventDefault();
            var targrt = $(this).prev('input.search-input');
            targrt.animate({
                width: ["toggle", "swing"],
                height: ["toggle", "swing"],
                opacity: "toggle"
            }, 500, "linear");
            return false;
        });
        /*-------------------------------------
        On click loadmore functionality 
        -------------------------------------*/
        $('.loadmore').on('click', 'a', function(e) {
            e.preventDefault();
            var _this = $(this),
                _parent = _this.parents('.menu-list-wrapper'),
                _target = _parent.find('.menu-list'),
                _set = _target.find('.menu-item.hidden').slice(0, 4); // Herre 2 is the limit
            if (_set.length) {
                _set.animate({ opacity: 0 });
                _set.promise().done(function() {
                    _set.removeClass('hidden');
                    _set.show().animate({ opacity: 1 }, 1000);
                });
            } else {
                _this.text('No more item to display');
            }
            return false;
        });
        /*-------------------------------------
        On click loadmore functionality 
        -------------------------------------*/
        $('.loadmore').on('click', 'a', function(e) {
            e.preventDefault();
            var _this = $(this),
                _parent = _this.parents('.menu-list-wrapper'),
                _target = _parent.find('.menu-list'),
                _set = _target.find('.menu-item.hidden').slice(0, 4); // Herre 2 is the limit
            if (_set.length) {
                _set.animate({ opacity: 0 });
                _set.promise().done(function() {
                    _set.removeClass('hidden');
                    _set.show().animate({ opacity: 1 }, 1000);
                });
            } else {
                _this.text('No more item to display');
            }
            return false;
        });
    });
    /*-------------------------------------
     jQuery MeanMenu activation code
     --------------------------------------*/
    $('nav#dropdown').meanmenu({ siteLogo: "<a href='index.html' class='logo-mobile'><img src='img/logo.png' alt='logo'></a>" });
    /*-------------------------------------
     Wow js Active
    -------------------------------------*/
    new WOW().init();
    /*-------------------------------------
    jquery zoom activation code
    -------------------------------------*/
    var ecomZoom = $('.ex1');
    if (ecomZoom.length) {
        $('.ex1').zoom();
    }
    /*-------------------------------------
    Jquery Scollup
    -------------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-double-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });
    /*-------------------------------------
    Sidebar Menu activation code
    -------------------------------------*/
    $('#offcanvas-menu-area').on('click', 'span#side-menu-trigger a', function(e) {
        e.preventDefault();
        var $this = $(this),
            wrapper = $(this).parents('body').find('>#wrapper'),
            wrapMask = $('<div />').addClass('offcanvas-mask');
        if ($this.hasClass('open')) {
            document.getElementById('offcanvas-main-menu').style.width = '0';
            $this.removeClass('open').find('i.fa').removeClass('flaticon-unchecked').addClass('flaticon-menu');
            wrapper.removeClass('open').find('.offcanvas-mask').remove();
        } else {
            wrapper.addClass('open').append(wrapMask);
            $this.addClass('open').find('i.fa').removeClass('flaticon-menu').addClass('flaticon-unchecked');
            document.getElementById('offcanvas-main-menu').style.width = '280px';
        }
        return false;
    });
    $('#offcanvas-menu-area').on('click', 'span#offcanvas-nav-close a', function(e) {
        closeSideMenu();
    });
    $(document).on('click', '#wrapper.open .offcanvas-mask', function() {
        closeSideMenu();
    });
    $(document).on('keyup', function(event) {
        if (event.which == 27) {
            event.preventDefault();
            closeSideMenu();
        }
    });

    function closeSideMenu() {
        var wrapper = $('body > #wrapper');
        if (wrapper.hasClass('open')) {
            wrapper.removeClass('open').find('.offcanvas-mask').remove();
            document.getElementById('offcanvas-main-menu').style.width = '0';
            $('#offcanvas-menu-area span#side-menu-trigger a').removeClass('open').find('i.fa').removeClass('flaticon-unchecked').addClass('flaticon-menu');
        }
    }
    $('.menu-trigger').on('click', function() {
        var targetHolder = $('#main-nav-wrap'),
            target = $('#main-nav', targetHolder),
            targetMenu = target.find(' > ul').not('.temp-main-nav'),
            $tempMenu = target.find('ul.temp-main-nav'),
            self = $(this);
        if ($tempMenu.length) {
            self.find('i').removeClass('flaticon-unchecked').addClass('flaticon-menu');
            $tempMenu.animate({ right: '-100%' }, 500, function() {
                $(this).animate({ opacity: 0 }, 200, function() {
                    $(this).remove()
                });
            });
        } else {
            self.find('i').removeClass('flaticon-menu').addClass('flaticon-unchecked');
            var tempMenu = targetMenu.clone();
            tempMenu.css({
                visibility: 'visible',
                position: 'absolute',
                right: '-100%',
                top: 0,
                opacity: 0,
                width: targetMenu.outerWidth()
            }).addClass('temp-main-nav');
            target.append(tempMenu);
            tempMenu.animate({ opacity: 1 }, 200, function() {
                $(this).animate({ right: 0 }, 500);
            });
        }
    });
    /*-------------------------------------
    Circle Bars - Knob
    -------------------------------------*/
    if (typeof($.fn.knob) != 'undefined') {
        $('.knob.knob-nopercent').each(function() {
            var $this = $(this),
                knobVal = $this.attr('data-rel');
            $this.knob({
                'draw': function() {}
            });
            $this.appear(function() {
                $({
                    value: 0
                }).animate({
                    value: knobVal
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.val(Math.ceil(this.value)).trigger('change');
                    }
                });
            }, { accX: 0, accY: -150 });
        });
    }
    /*-------------------------------------
    Select2 activation code
    -------------------------------------*/
    if ($('.select2-wrapper select.select2, #checkout-form select.select2, #appointment-form select.select2').length) {
        $('.select2-wrapper select.select2, #checkout-form select.select2, #appointment-form select.select2').select2({
            theme: 'classic',
            dropdownAutoWidth: true,
            width: '100%'
        });
    }
    /*-------------------------------------
    Window load function
    -------------------------------------*/
    $(window).on('load', function() {
        var galleryIsoContainer = $('#no-equal-gallery');
        if (galleryIsoContainer.length) {
            var blogGallerIso = galleryIsoContainer.imagesLoaded(function() {
                blogGallerIso.isotope({
                    itemSelector: '.no-equal-item',
                    masonry: {
                        columnWidth: '.no-equal-item'
                    }
                });
            });
        }
        /*-------------------------------------
        Page Preloader
        -------------------------------------*/
        $('#preloader').fadeOut('slow', function() {
            $(this).remove();
        });
        /*-------------------------------------
        jQuery for Isotope initialization
        -------------------------------------*/
        var $container = $('#isotope-container');
        if ($container.length > 0) {
            var $isotope = $container.find('.featuredContainer').isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            $container.find('.isotope-classes-tab').on('click', 'a', function() {
                var $this = $(this);
                $this.parent('.isotope-classes-tab').find('a').removeClass('current');
                $this.addClass('current');
                var selector = $this.attr('data-filter');
                $isotope.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        }
        var testimonialCarousel = $('#rt-testimonial-slider-wrap');
        if (testimonialCarousel.length) {
            testimonialCarousel.find('.testimonial-sliders').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                autoplay: true,
                asNavFor: '.testimonial-carousel',
                prevArrow: '<span class="elv-prev elv-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></span>',
                nextArrow: '<span class="elv-next elv-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>'
            });
            testimonialCarousel.find('.testimonial-carousel').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.testimonial-sliders',
                dots: false,
                arrows: true,
                prevArrow: true,
                nextArrow: true,
                centerMode: true,
                centerPadding: '0px',
                focusOnSelect: true,
                responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }]
            });
        }
    });
    /*-------------------------------------
    About Counter
    -------------------------------------*/
    var counterContainer = $('.counter');
    if (counterContainer.length) {
        counterContainer.counterUp({
            delay: 50,
            time: 5000
        });
    }
    /*-------------------------------------
    Auto height for product listing
    -------------------------------------*/
    $(window).on('load resize', function() {
        equalHeight();
    });

    function equalHeight() {
        var imgH = 0,
            boxH = 0,
            wWidth = $(window).width(),
            allH;
        $('.equal-height-wrap .item-img,.equal-height-wrap .item-content').height('auto');
        if (wWidth > 767) {
            $('.equal-height-wrap').each(function() {
                var self = $(this);
                var TempImgH = self.find('.item-img').height();
                imgH = TempImgH > imgH ? TempImgH : imgH;
                var TempBoxH = self.find('.item-content').outerHeight();
                boxH = TempBoxH > boxH ? TempBoxH : boxH;
            });
            allH = imgH;
            allH = boxH > imgH ? boxH : imgH;
            $('.equal-height-wrap .item-img,.equal-height-wrap .item-content').height(allH + "px");
        }
    }
    /*-------------------------------------
    Accordion
    -------------------------------------*/
    var accordion = $('#accordion');
    accordion.children('.panel').children('.panel-collapse').each(function() {
        if ($(this).hasClass('in')) {
            $(this).parent('.panel').children('.panel-heading').addClass('active');
        }
    });
    accordion.on('show.bs.collapse', function(e) {
        $(e.target).prev('.panel-heading').addClass('active');
    }).on('hide.bs.collapse', function(e) {
        $(e.target).prev('.panel-heading').removeClass('active');
    });
    /*-------------------------------------
    Contact Form initiating
    -------------------------------------*/
    var contactForm = $('#contact-form');
    if (contactForm.length) {
        contactForm.validator().on('submit', function(e) {
            var $this = $(this),
                $target = contactForm.find('.form-response');
            if (e.isDefaultPrevented()) {
                $target.html("<div class='alert alert-success'><p>Please select all required field.</p></div>");
            } else {
                $.ajax({
                    url: "vendor/php/form-process.php",
                    type: "POST",
                    data: contactForm.serialize(),
                    beforeSend: function() {
                        $target.html("<div class='alert alert-info'><p>Loading ...</p></div>");
                    },
                    success: function(text) {
                        if (text == "success") {
                            $this[0].reset();
                            $target.html("<div class='alert alert-success'><p>Message has been sent successfully.</p></div>");
                        } else {
                            $target.html("<div class='alert alert-success'><p>" + text + "</p></div>");
                        }
                    }
                });
                return false;
            }
        });
    }
    /*-------------------------------------
    Reservation Form initiating
    -------------------------------------*/
    var reservationForm = $('#reservation-form');
    if (reservationForm.length) {
        reservationForm.validator().on('submit', function(e) {
            var $this = $(this),
                $target = reservationForm.find('.form-response');
            if (e.isDefaultPrevented()) {
                $target.html("<div class='alert alert-success'><p>Please select all required field.</p></div>");
            } else {
                $.ajax({
                    url: "vendor/php/form-process.php",
                    type: "POST",
                    data: reservationForm.serialize(),
                    beforeSend: function() {
                        $target.html("<div class='alert alert-info'><p>Loading ...</p></div>");
                    },
                    success: function(text) {
                        if (text == "success") {
                            $this[0].reset();
                            $target.html("<div class='alert alert-success'><p>Message has been sent successfully.</p></div>");
                        } else {
                            $target.html("<div class='alert alert-success'><p>" + text + "</p></div>");
                        }
                    }
                });
                return false;
            }
        });
    }
    /*-------------------------------------
    Input Quantity Up & Down activation code
    -------------------------------------*/
    $('#quantity-holder').on('click', '.quantity-plus', function() {
        var $holder = $(this).parents('.quantity-holder');
        var $target = $holder.find('input.quantity-input');
        var $quantity = parseInt($target.val(), 10);
        if ($.isNumeric($quantity) && $quantity > 0) {
            $quantity = $quantity + 1;
            $target.val($quantity);
        } else {
            $target.val($quantity);
        }
    }).on('click', '.quantity-minus', function() {
        var $holder = $(this).parents('.quantity-holder');
        var $target = $holder.find('input.quantity-input');
        var $quantity = parseInt($target.val(), 10);
        if ($.isNumeric($quantity) && $quantity >= 2) {
            $quantity = $quantity - 1;
            $target.val($quantity);
        } else {
            $target.val(1);
        }
    });
    /*-------------------------------------
    Google Map
    -------------------------------------*/
    if ($('#googleMap').length) {
        var initialize = function() {
                var mapOptions = {
                    zoom: 15,
                    scrollwheel: false,
                    center: new google.maps.LatLng(-37.81618, 144.95692),
                    styles: [{
                        stylers: [{
                            saturation: -100
                        }]
                    }]
                };
                var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
                var marker = new google.maps.Marker({
                    position: map.getCenter(),
                    animation: google.maps.Animation.BOUNCE,
                    icon: 'img/map-marker.png',
                    map: map
                });
            }
            // Add the map initialize function to the window load function
        google.maps.event.addDomListener(window, "load", initialize);
    }
    /*-------------------------------------
    Carousel slider initiation
    -------------------------------------*/
    $('.rc-carousel').each(function() {
        var carousel = $(this),
            loop = carousel.data('loop'),
            items = carousel.data('items'),
            margin = carousel.data('margin'),
            stagePadding = carousel.data('stage-padding'),
            autoplay = carousel.data('autoplay'),
            autoplayTimeout = carousel.data('autoplay-timeout'),
            smartSpeed = carousel.data('smart-speed'),
            dots = carousel.data('dots'),
            nav = carousel.data('nav'),
            navSpeed = carousel.data('nav-speed'),
            rXsmall = carousel.data('r-x-small'),
            rXsmallNav = carousel.data('r-x-small-nav'),
            rXsmallDots = carousel.data('r-x-small-dots'),
            rXmedium = carousel.data('r-x-medium'),
            rXmediumNav = carousel.data('r-x-medium-nav'),
            rXmediumDots = carousel.data('r-x-medium-dots'),
            rSmall = carousel.data('r-small'),
            rSmallNav = carousel.data('r-small-nav'),
            rSmallDots = carousel.data('r-small-dots'),
            rMedium = carousel.data('r-medium'),
            rMediumNav = carousel.data('r-medium-nav'),
            rMediumDots = carousel.data('r-medium-dots'),
            center = carousel.data('center');
        carousel.owlCarousel({
            loop: (loop ? true : false),
            items: (items ? items : 4),
            lazyLoad: true,
            margin: (margin ? margin : 0),
            autoplay: (autoplay ? true : false),
            autoplayTimeout: (autoplayTimeout ? autoplayTimeout : 1000),
            smartSpeed: (smartSpeed ? smartSpeed : 250),
            dots: (dots ? true : false),
            nav: (nav ? true : false),
            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            navSpeed: (navSpeed ? true : false),
            center: (center ? true : false),
            responsiveClass: true,
            responsive: {
                0: {
                    items: (rXsmall ? rXsmall : 1),
                    nav: (rXsmallNav ? true : false),
                    dots: (rXsmallDots ? true : false)
                },
                480: {
                    items: (rXmedium ? rXmedium : 2),
                    nav: (rXmediumNav ? true : false),
                    dots: (rXmediumDots ? true : false)
                },
                768: {
                    items: (rSmall ? rSmall : 3),
                    nav: (rSmallNav ? true : false),
                    dots: (rSmallDots ? true : false)
                },
                992: {
                    items: (rMedium ? rMedium : 5),
                    nav: (rMediumNav ? true : false),
                    dots: (rMediumDots ? true : false)
                }
            }
        });
    });
    /*-------------------------------------
    Window onLoad and onResize event trigger
    -------------------------------------*/
    $(window).on('load resize', function() {
        var wHeight = $(window).height(),
            mLogoH = $('a.logo-mobile-menu').outerHeight();
        wHeight = wHeight - 50;
        $('.mean-nav > ul').css('height', wHeight + 'px');
        headerNsliderResize();
    });
    /*-------------------------------------
    Jquery Stiky Menu at window Load
    -------------------------------------*/
    $(window).on('scroll', function() {
        var s = $('#sticker'),
            w = $('body'),
            h = s.outerHeight(),
            windowpos = $(window).scrollTop(),
            windowWidth = $(window).width(),
            h1 = s.parent('#header-one'),
            h2 = s.parent('#header-two'),
            h3 = s.parent('#header-three'),
            h3H = h3.find('.header-top-bar').outerHeight(),
            topBar = s.prev('.header-top-bar'),
            tempMenu;
        if (windowWidth > 991) {
            w.css('padding-top', '');
            var topBarH, mBottom = 0;
            if (h1.length) {
                topBarH = h = 1;
                mBottom = 0;
            } else if (h2.length) {
                mBottom = h2.find('.main-menu-area').outerHeight();
                topBarH = w.find("#top-slider").outerHeight();
                topBarH = mBottom + topBarH;
            } else if (h3.length) {
                topBarH = topBar.outerHeight();
                if (windowpos <= topBarH) {
                    if (h3.hasClass('header-fixed')) {
                        h3.css('top', '-' + windowpos + 'px');
                    }
                }
            }
            if (windowpos >= topBarH) {
                if (h3.length || h1.length) {
                    s.addClass('stick');
                }
                if (h3.length) {
                    if (h3.hasClass('header-fixed')) {
                        h3.css('top', '-' + topBarH + 'px');
                    } else {
                        w.css('padding-top', h + 'px');
                    }
                } else if (h2.length) {
                    h2.addClass('hide-menu');
                    tempMenu = h2.find('.main-menu-area').clone();
                    tempMenu.addClass('temp-main-menu stick').attr("id", '');
                    tempMenu.css({ opacity: 0 });
                    if (h2.find('.temp-main-menu.stick').length == 0) {
                        h2.append(tempMenu);
                        h2.find('.temp-main-menu.stick').animate({ opacity: 1 }, 100);
                    }
                    if (h2.find('.temp-main-menu.stick').length > 1) {
                        h2.find('.temp-main-menu.stick').last().remove();
                    }
                }
            } else {
                s.removeClass('stick');
                if (h3.length) {
                    w.css('padding-top', 0);
                } else if (h2.length) {
                    h2.removeClass('hide-menu');
                    h2.find('.stick.temp-main-menu').remove();
                }
            }
        }
    });

    function headerNsliderResize() {
        var Hh3 = $('#header-three'),
            wWidth = $(window).width(),
            Hh3slider = Hh3.parents('#wrapper').find("#fixed-type-slider"),
            mHeight = Hh3.outerHeight();
        if (wWidth < 992) {
            mHeight = $('body > .mean-bar').outerHeight();
            // $("#downFromTop").css("margin-top", mHeight + 'px');
        }
        Hh3slider.css("margin-top", mHeight + 'px');
    }
})(jQuery);