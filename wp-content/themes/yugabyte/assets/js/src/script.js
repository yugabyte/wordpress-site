jQuery(document).ready(function($) {
    
    //MOBILE NAV TOGGLE
	$('#mobile_nav_toggle').on('click', function(e) {
		e.preventDefault();
		$('#mobile_nav_tray').slideToggle();
		$(this).toggleClass('open');
		$('body').toggleClass('mobile_nav_open');
	});
	
	$('#primary-navigation-mobile .toggle').on('click', function(e) {
        e.preventDefault();
        var t = $(this);
                        
        t.siblings('.sub-menu').slideDown();
        //slide up all other sub-menus on the same level
        if( t.hasClass('active') ) {
            t.siblings('.sub-menu').slideUp();
            t.removeClass('active');
        } else {
            $('#primary-navigation-mobile .toggle').not(t).siblings('.sub-menu').slideUp();
            //active classes
            t.addClass('active');
            $('#primary-navigation-mobile .toggle').not(t).removeClass('active');
        }
    });
	
	$('.info_tip').on('click', function(e){
	    e.preventDefault();
	    $(this).toggleClass('showtip');
	});
	
	//ALM FILTERS
	
	//init the All items to active
	$('.alm-filter').each(function() {
	    var t = $(this);
	    t.find('.alm-filter--checkbox:first .alm-filter--link').addClass('init');
	});
	
	$('#filters_clear').on('click', function(e) {
        e.preventDefault();
        var t = $(this);
        window.almFiltersClear();
    });
	
	$('.alm-filter--title h3').on('click', function(e) {
	    e.preventDefault();
	    
	    var t = $(this),
	        f = t.closest('.alm-filter');
	    
	    t.toggleClass('open');
	    f.toggleClass('open');
	    
	    f.find('ul .alm-filter--checkbox:not(:first)').fadeToggle();
	});
	
	//turn off ALL if any others are clicked
	$('.alm-filter--link').on('click', function(e) {
	    e.preventDefault();
	    
	    var t = $(this),
	        i = t.parent().index();
	    
	    if( i != 0 ) {
	        $('.alm-filter--checkbox:first .alm-filter--link').removeClass('init');
	    }
	});
	
	//VIDEO BLOCK PLAY BTN
	$('.play_btn.vid_block').on('click', function(e) {
	    e.preventDefault();
	    var t = $(this),
	        v_cont = t.prev();
	    
	    v_cont.toggleClass('off');
	    t.toggleClass('off');
	    v_cont.find('iframe')[0].src += "&autoplay=1";
	});
	
	//DEEP-LINK HERO CTAs SMOOTH SCROLL TO TARGET
	//OR IF URL HAS HASH AND MATCHING TARGET (THIS IS SET IN WINDOW.LOAD)
	$('#hero .deeplink').on('click', function(e) {
        e.preventDefault();
        var t = $(this),
            tar = t.attr('href'),
            header_h = $('#masthead').height(),
            tar_scroll = $(tar).offset().top - header_h;
        
        if( $(tar).length > 0 ) {
            $('html, body').animate({
                scrollTop : tar_scroll
            }, 1000);
        }
    });
	
    //KILL NAV LINKS WITH 'NOLINK' CLASS
    $('.nav-menu .nolink > a').on('click', function(e) {
        e.preventDefault();
    });
    
    //GENERAL ACCORDION FUNCTIONALITY
    if( $('.accordion_wrap').length > 0 ) {
        $('.accordion_wrap').each(function() {
            var t = $(this),
                acc = t.find('.accordion'),
                h = acc.find('.acc_heading');
            
            h.on('click', function(e) {
                e.preventDefault();
                var t = $(this),
                    c = t.siblings('.acc_content');
        
                t.toggleClass('active');
                c.slideToggle(300, function() {
            
                });
            });
        });
    }
    
    //KILL DISABLED BUTTONS
    /*$('.btn.disabled').on('click', function(e) {
        e.preventDefault();
    });*/
    
    //IF HASH, SCROLL TO SUBSECTION
    /*if( window.location.hash ) {
        var hash = window.location.hash,
            sT = $(hash).offset().top;
        
        if ( window.location.hash ) scroll(0,0);
        // void some browsers issue
        setTimeout( function() { scroll(0,0); }, 1);
        
        $('html, body').animate({
            scrollTop: sT
        }, 1000);
    }*/
    
    /******************************************************/
    /***** SLIDERS ****************************************/
    /******************************************************/
    //IMAGE GALLERY
    $('.img_gallery_slider').each(function(i) {
	    var t = $(this);
        
        var img_slider_config = {
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true
        }
        var ImageSlider = t.slick(img_slider_config);
    });
    
    //TESTIMONIAL W/ LOGO SLIDER
    $('.test_slider').each(function(i) {
	    var t = $(this);
        
        var test_slider_config = {
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: false,
            adaptiveHeight: true
        }
        var TestSlider = t.slick(test_slider_config);
    });
    
    //ALL GRAVITY FORMS SELECTS - TARGET INITIAL OPTION TO LIGHTEN AS PLACEHOLDER
    $(document).on('change', '.ginput_container_select select', function() {
        var the_li = $(this).closest('li.gfield'),
            the_label = the_li.find('.gfield_label');
        if( $(this).children('option:first-child').is(':selected') ) {
            //the_label.css('visibility','visible');
            the_label.removeClass('float_label');
        } else {
            //the_label.css('visibility','hidden');
            the_label.addClass('float_label');
        }
    });
    //FOR COMPLEX FIELDS
    $(document).on('change', '.ginput_complex select', function() {
        var the_span = $(this).closest('span'),
            the_label = the_span.find('label');
        if( $(this).children('option:first-child').is(':selected') ) {
            //the_label.css('visibility','visible');
            the_label.removeClass('float_label');
        } else {
            //the_label.css('visibility','hidden');
            the_label.addClass('float_label');
        }
    });
    
    $(document).on('gform_confirmation_loaded', function (e) {
        floatThoseLabels();
    });
    
    $(document).on('gform_post_render', function() {
        floatThoseLabels();
    });    
    
    $(window).load(function() {
        
        if($(window).width() > 767) {
            pushOffHeader();
            //calcEqualHeightBlocks();
            rowMaxHeight( $('.row_h') );
        }
        
        if($(window).width() < 768) {
            
        }
        
        if($(window).width() > 1024) {
            calcEqualHeightBlocks();
        }
        
        if( window.location.hash ) {
            var hash = window.location.hash,
                header_h = $('#masthead').height(),
                sT = $(hash).offset().top;
                
            if ( window.location.hash ) scroll(0,0);
            // void some browsers issue
            setTimeout( function() { scroll(0,0); }, 1);
        
            setTimeout( function() {
                $('html, body').animate({
                    scrollTop: sT
                }, 1000);
            }, 1000);
        }
        
        //FORM FLOAT LABELS SETUP
        floatThoseLabels();
        
        rowMaxHeight( $('.icon_cont_blocks.two_up > li') );
        
        //ZOOM IMAGES
        if( $('.zoomable').length > 0 ) {
            $('.zoomable').each(function() {
                $(this).zoom({ on:'click' });                
            });
        }
    });
    
    var resizeTimer;

    $(window).resize(function() {
    
        if($(window).width() > 767) {
            pushOffHeader();
        } else {
            //REMOVE ANY TOP MARGIN ON #MAIN, REMOVE SCROLLING CLASS
            //$('#main').css('marginTop',0);
            //$('.site-header').removeClass('scrolling');
        }
        
        setTimeout(function(){
            if($(window).width() > 767) {
                calcEqualHeightBlocks();
                rowMaxHeight( $('.row_h') );
            } else {
                //RESET EQ H BLOCKS TO AUTO HEIGHT
                $('.eq_h .eq_l').css('height','auto');
                $('.eq_h .eq_r').css('height','auto');
            }
            
            if($(window).width() < 768) {
                
            }
            
            //PACK UP HAMBURGER AND MOBILE NAV TRAY
            if($(window).width() > 1024) {
                //$('#mobile_nav_tray').slideUp();
                //$('#mobile_nav_toggle').removeClass('open');
                //$('body').removeClass('mobile_nav_open');
            }
            
        },100);
    });
    
    var scrollTimer = null;
    
	$(window).scroll(function(event) {
	    
	    //didScroll = true;
	    
	    setInterval(function() {
            /*if (didScroll && $(window).width() < 768) {
                hasScrolled();
                didScroll = false;
            }*/
            
            //console.log('SCROLL CHECK');
        }, 250);
	    
	    if($(window).width() > 767) {
	        pushOffHeader();
	    }
        
        if (scrollTimer) {
            clearTimeout(scrollTimer);
        }
        scrollTimer = setTimeout(handleLatentScrollCalcs, 100);
        
        function handleLatentScrollCalcs() {
            scrollTimer = null;
            //nothing to do here yet...
        }
    });
    
    function pushOffHeader() {
        var hInner = $('#masthead').height(),
            sTop = $(document).scrollTop(),
            vH = $(window).height(),
            mT = '80px';
        
        //console.log('SCROLLING - HEADER HEIGHT: ' + hInner);
        
        if( sTop > 0 ) {
            $('.site-header').addClass('scrolling');
            $('#mobile_nav_tray').addClass('scrolling');
            $('#main').css({
                'marginTop' : hInner
            });
            
        } else {
            $('.site-header').removeClass('scrolling');
            $('#mobile_nav_tray').removeClass('scrolling');
            $('#main').css({
                'marginTop' : mT
            });
        }
    }
    
    function setEqualHeights(elemL,elemR) {
        var l = elemL,
            r = elemR;
        if($(window).width() > 767) {
            l.css('height','auto');
            r.css('height','auto');
            if( l.height() <= r.height() ) {
                l.height(r.height());
            } else {
                r.height(l.height());
            }
        }
    }
    
    function calcEqualHeightBlocks() {
        if( $('.eq_h').length > 0 ) {
            $('.eq_h').each(function() {
                var l = $(this).find('.eq_l'),
                    r = $(this).find('.eq_r');
                
                //set min-height on the image half
                /*$('.bg_img').each(function() {
                    var el = $(this),
                        el_h = el.closest('.eq_l').next().height();
                    
                    el.css({
                        'min-height' : el_h
                    });
                });*/
                
                setEqualHeights( l, r );
            });
        }
    }
    
    function rowMaxHeight(el) {
        if( $(window).width() > 767 && el.length > 0 ) {
            /*el.each(function() {
                $(this).find('.inner_content').css('height','auto');
                var h = Math.max.apply(null, $(this).find('.inner_content').map(function () {
                            return $(this).height();
                        }).get());
                $(this).find('.inner_content').each(function() {
                    var h_new = h;
                    $(this).height(h_new);
                });
            });*/
            
            var tallest = 0;
            el.each(function() {
                var i = $(this).find('.inner_content');
                if( i.height() > tallest ) {
                    tallest = i.height(); 
                }
      
            });
            el.find('.inner_content').height(tallest);
        }
    }
    
    function floatThoseLabels() {
        
        $('.ginput_container input, .ginput_container textarea').each(function() {
            var the_li = $(this).closest('li.gfield'),
                the_label = the_li.find('.gfield_label'),
                v = $(this).val();
            
            if( v != '' && !the_li.hasClass('no_float') ) {
                the_label.addClass('float_label');
            }
        });
        
        $('.ginput_complex input, .ginput_complex textarea').each(function() {
            var the_span = $(this).closest('span'),
                the_label = the_span.find('label'),
                v = $(this).val();
            
            if( v != '' && !the_span.hasClass('no_float') ) {
                the_label.addClass('float_label');
            }
        })
        
        $('.ginput_container input, .ginput_container textarea').on('focus', function() {
            var the_li = $(this).closest('li.gfield'),
                the_label = the_li.find('.gfield_label');
            
            the_label.addClass('float_label');
        });
        
        $('.ginput_container input, .ginput_container textarea').on('blur', function() {
            var the_li = $(this).closest('li.gfield'),
                the_label = the_li.find('.gfield_label'),
                v = $(this).val();
            
            if( v == '' && !the_li.hasClass('no_float') ) {
                the_label.removeClass('float_label');
            }
        });
 
        $('.ginput_container_select select').each(function() {
            
            var the_li = $(this).closest('li.gfield'),
                the_label = the_li.find('.gfield_label');
            if( $(this).children('option:first-child').is(':selected') ) {
                //the_label.css('visibility','visible');
                the_label.removeClass('float_label');
            } else {
                //the_label.css('visibility','hidden');
                the_label.addClass('float_label');
            }
        });
        
        //COMPLEX FIELDS
        $('.ginput_complex input, .ginput_complex textarea').on('focus', function() {
            var the_span = $(this).closest('span'),
                the_label = the_span.find('label');
            
            the_label.addClass('float_label');
        });
        
        $('.ginput_complex input, .ginput_complex textarea').on('blur', function() {
            var the_span = $(this).closest('span'),
                the_label = the_span.find('label'),
                v = $(this).val();
            
            if( v == '' && !the_span.hasClass('no_float') ) {
                the_label.removeClass('float_label');
            }
        });
 
        $('.ginput_complex select').each(function() {
            
            var the_span = $(this).closest('span'),
                the_label = the_span.find('label');
            if( $(this).children('option:first-child').is(':selected') ) {
                //the_label.css('visibility','visible');
                the_label.removeClass('float_label');
            } else {
                //the_label.css('visibility','hidden');
                the_label.addClass('float_label');
            }
        });
    }
    
});
