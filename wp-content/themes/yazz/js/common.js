jQuery(document).ready(function() {

    /*Video Youtube Viemo*/
    if (jQuery('[data-video-widget]').length) {
        jQuery('[data-video-widget]').each(function() {
            var videoUrl = jQuery(this).attr('data-video');
            var type = jQuery(this).attr('data-type');
            var avoidBgVideo = jQuery(this).attr('data-avoid-bg') !== undefined;
            var widget = jQuery(this);
            var target = jQuery(this).attr('data-video-widget');

            if (!avoidBgVideo) {
                switch (type) {
                    case 'youtube':
                        widget.css({
                            'background-image': 'url(http://img.youtube.com/vi/' + videoUrl + '/0.jpg)'
                        });
                        break;
                    case 'vimeo':
                        jQuery.ajax({
                            type: 'GET',
                            url: 'http://vimeo.com/api/v2/video/' + videoUrl + '.json',
                            jsonp: 'callback',
                            dataType: 'jsonp',
                            success: function(data) {
                                var thumbnail_src = data[0].thumbnail_large;
                                widget.css({
                                    'background-image': 'url(' + thumbnail_src + ')'
                                })
                            }
                        });
                        break;
                    default:
                        /* nothing to do to avoid loading of video */
                        break;
                }
            }
        });
    }

    jQuery('[data-video-widget] .c-play-video').click(function() {

        // var widget = jQuery(this).closest('[data-video-widget]');
        // if(widget.length == 0) {
        // return;
        // }

        // var target = widget.attr('data-video-widget');
        // var type = widget.attr('data-type');
        // var videoUrl = widget.attr('data-video');

        // target = jQuery(target);
        // target.addClass('show');
        // target.find('.video-wrapper').empty();

        // switch (type) {
        // case 'youtube':
        //     target.find('.video-wrapper').html('<iframe src="https://www.youtube.com/embed/' + videoUrl + '?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>');
        //     break;
        // case 'vimeo':
        //     target.find('.video-wrapper').html('<iframe src="https://player.vimeo.com/video/' + videoUrl + '?autoplay=1&byline=0&portrait=0"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        //     break;
        // default:
        //     target.find('.video-wrapper').append('<video src="'+videoUrl+'" width="100%" class="video-local" autoplay="autoplay"></video>');
        //     playFileVideo(jQuery(this).parent());
        //     break;
        // }
    });

    /* Play/pause for file video type  */
    // jQuery('.wrap-video').on('click', 'video', function(e) {
    //   e.preventDefault();
    //   var type = jQuery(this).closest('.wrap-video').attr('type');
    //   if(type == 'file') {
    //     togglePlayback(this);
    //   }
    // });

    jQuery('.popup-play').magnificPopup({
        type: 'iframe',
        iframe: {
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: function(url) {
                        var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                        if (!m || !m[1]) return null;
                        return m[1];
                    },
                    src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: function(url) {
                        var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                        if (!m || !m[5]) return null;
                        return m[5];
                    },
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                }
            }
        }
    });

    function playFileVideo(parent) {
        parent.find('video').get(0).play();
    }

    // Remove any playing of videos when a video modal is closed
    jQuery('.video-modal').click(function(e) {
        if (jQuery(e.target).closest('.modal-content').length == 0) {
            jQuery(e.target).closest('.video-modal').find('.video-wrapper').empty();
        }
    });
    jQuery(".c-play-video").click(function() {
        // jQuery(this).css("display","none");
    });

    /************ slider video ****************/
    jQuery('.content-test-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
        customPaging: function(slider, i) {
            return '<a href="javascript:;"><span></span></a>';
        },
        arrows: false,
        centerMode: true,
        centerPadding: '0',
        autoplay: true,
        infinite: true,
        autoplaySpeed: 1500,
        initialSlide: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: false,
                    // centerPadding: '100%',
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: false,
                    // centerPadding: '30%',
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    // centerPadding: '30%',
                }
            }
        ]
    });
    jQuery('.video-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        // autoplay: true,
        // autoplaySpeed: 2000,
        prevArrow: "<a href='#' class='arrow-slide sli-prev'><i class='icon-chevron-left'></i></a>",
        nextArrow: "<a href='#' class='arrow-slide sli-next'><i class='icon-chevron-right'></i></a>",
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: false,
                    centerPadding: '30%',
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerMode: false,
                    centerPadding: '10%',
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: false,
                    centerPadding: '10%',
                }
            }
        ]
    });
    jQuery('.slide-gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        autoplay: false,
        autoplaySpeed: 4000,
        prevArrow: "<a href='#' class='arrow-slide sli-prev'><i class='icon-chevron-left'></i></a>",
        nextArrow: "<a href='#' class='arrow-slide sli-next'><i class='icon-chevron-right'></i></a>"
    });

    /* magnific popup */
    jQuery('.sfm-va-middle .sfm-menu .sfm-menu-item-164 a,.open-contact a').magnificPopup({
        type: 'inline',
        midClick: true,
    });

    jQuery('a.contratame').magnificPopup({
        type: 'inline',
        midClick: true,
    });

    jQuery('.gallery').magnificPopup({
        delegate: 'a.g-img',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
    });

    jQuery('.item-btn.open-book a').magnificPopup({
        type: 'inline',
        midClick: true,
    });


    // Popup Hero 
    jQuery('.play-top a').magnificPopup({
        type: 'iframe',
    });

    var $href = jQuery(".content-book a").attr("href");
    jQuery(".play-top a").attr("href", $href)
        // End Popup Hero

    // ScrollReveal Animate scroll
    // window.sr = ScrollReveal({ reset: true });
    // sr.reveal('.animate-title-text', { 
    //     easing: 'ease-out',
    //     origin: 'right',
    //     duration: 1200,
    //     rotate: { x: 0, y: 50, z: 0 },
    // });

    // AOS Animate Scroll
    AOS.init();


    // menu Stiky
    jQuery(window).scroll(function() {
        var scroll = jQuery(window).scrollTop();
        if (scroll >= 180) {
            jQuery(".site-header").addClass("stiky", 1000, "easeOutBounce");
            jQuery(".sfm-navicon-button").addClass("stiky", 1000, "easeOutBounce");

        } else {
            jQuery(".site-header").removeClass("stiky", 1000, "easeOutBounce");
            jQuery(".sfm-navicon-button").removeClass("stiky", 1000, "easeOutBounce");
        }
    });

    //
    jQuery('.mob-slide').slick({
        // centerMode: true,
        // centerPadding: '60px',
        slidesToShow: 3,
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        infinite: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 768,
                settings: {
                    centerMode: false,
                    // centerPadding: '0',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerMode: false,
                    // centerPadding: '0',
                    slidesToShow: 1
                }
            }
        ]
    });

    // Text Visible
    jQuery(window).scroll(function() {
        jQuery('.title-animate').each(function() {
            if (isScrolledIntoView(jQuery(this))) {
                jQuery(this).children('div').addClass('visible');
            }
        });
    });

    function isScrolledIntoView(elem) {
        var $elem = jQuery(elem);
        var $window = jQuery(window);

        var docViewTop = $window.scrollTop();
        var docViewBottom = docViewTop + $window.height();

        var elemTop = $elem.offset().top;
        var elemBottom = elemTop + $elem.height() + 50;

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }

    // Top Menu
    jQuery('.post-type-archive-cursos .nav-header .menu-item:nth-child(2)').addClass('current-menu-item current_page_item');

    jQuery('.mfp-close').click(function() {
        // jQuery('body').removeClass('poppu-show');
        setTimeout(function() {
            jQuery('.open-contact').removeClass('sfHover');
        }, 900);

    });

    jQuery('.sfm-va-middle .sfm-menu .sfm-menu-item-164 a').click(function() {
        jQuery(".sfm-sidebar-close").trigger("click");
        // jQuery('body').removeClass('poppu-show');
    });

    jQuery('.open-contact a,.sfm-va-middle .sfm-menu .sfm-menu-item-164 a').click(function() {
        // jQuery('body').addClass('poppu-show');
    });


    /* popup not move body file js*/
    jQuery(document).on('click', '.open-contact a,.sfm-va-middle .sfm-menu .sfm-menu-item-164 a', function(e) {
        e.preventDefault();
        // jQuery('body').addClass('size-popup');
        jQuery('html').attr('data-pos', jQuery(window).scrollTop()); // get actual scrollpos
        jQuery('html').addClass('locked'); // add class to body
        // jQuery('.body').scrollTop(jQuery('html').attr('data-pos')); // let wrapper scroll to scrollpos
    });

    jQuery(document).on('click', '.mfp-close', function(e) {
        e.preventDefault();
        // jQuery("body").removeClass('size-popup');
        jQuery('html').removeClass('locked');
        jQuery(window).scrollTop(jQuery('html').attr('data-pos'));
    });

    jQuery('.btn-red-menu').click(function() {
        jQuery('.nav-header .menu-item').removeClass('current-menu-item');
        jQuery('.nav-header .menu-item').removeClass('current_page_item');
    });

    jQuery('.open-contact').click(function() {
        jQuery('.nav-header .menu-item').removeClass('current-menu-item');
        jQuery('.nav-header .menu-item').removeClass('current_page_item');
        jQuery(this).addClass('current-menu-item');
        jQuery(this).addClass('current_page_item');
    });

    jQuery(document).on('click', '#_form_1_submit', function(e) {
        setTimeout(function() {
            var cont = jQuery("._form-content ._error._above").length;
            console.log(cont);
            if (cont > 0) {
                jQuery("._form-content ._error-inner").text('Este campo es requerido');
            }
        }, 10);
    });
    jQuery(document).on('click', '#_form_3_submit', function(e) {
        setTimeout(function() {
            var cont = jQuery("._form-content ._error._below").length;
            console.log(cont);
            if (cont > 0) {
                jQuery("._form-content ._error-inner").text('Este campo es requerido');
            }
        }, 10);
    });

});