jQuery(document).ready(function($) {
    
    //MOBILE NAV TOGGLE
	$('#mobile_nav_toggle').on('click', function(e) {
		e.preventDefault();
		$('#mobile_nav_tray').slideToggle();
		$(this).toggleClass('open');
		$('body').toggleClass('mobile_nav_open');
	});
	
	$('.info_tip').on('click', function(e){
	    e.preventDefault();
	});
	
	
    
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
    
    $(window).load(function() {
        
        if($(window).width() > 767) {
            pushOffHeader();
            calcEqualHeightBlocks();
        }
        
        if($(window).width() < 768) {
            
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
                $('.bg_img').each(function() {
                    var el = $(this),
                        el_h = el.closest('.eq_l').next().height();
                    
                    el.css({
                        'min-height' : el_h
                    });
                });
                
                setEqualHeights( l, r );
            });
        }
    }
    
});
