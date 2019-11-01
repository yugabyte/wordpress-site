//Anchor Smooth Scroll
$(function() {
  setTimeout(function() {
    if (location.hash) {
      /* we need to scroll to the top of the window first, because the browser will always jump to the anchor first before JavaScript is ready, thanks Stack Overflow: http://stackoverflow.com/a/3659116 */
      window.scrollTo(0, 0);
      target = location.hash.split('#');
      smoothScrollTo($('#'+target[1]));
    }
  }, 1);
  
  // taken from: https://css-tricks.com/snippets/jquery/smooth-scrolling/
  $('a[href*=\\#]:not([href=\\#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      smoothScrollTo($(this.hash));
      return false;
    }
  });
  
  function smoothScrollTo(target) {
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top
      }, 1000);
    }
  }
});

function toggleNavClass() {
	var element = document.getElementById("myNav");
	if (element.classList) { 
		element.classList.toggle("darkerNav");
	} else {
		// For IE9
		var classes = element.className.split(" ");
		var i = classes.indexOf("darkerNav");
		if (i >= 0) 
			classes.splice(i, 1);
		else 
			classes.push("darkerNav");
		element.className = classes.join(" ");
	}
}

function setCookie(uname, uvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24*60*60*1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = uname + "=" + uvalue + ";" + expires + ";path=/";
}

function setMailListener() {
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		setCookie("ybcf", "userAuth699", 60);
    $('.dl-form').css("display", "none");
    $('.dl-btn').css("display", "flex");
	}, false );
}

function getCookie(uname) {
	var name = uname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var cookieArray = decodedCookie.split(';');
	for (var i = 0; i < cookieArray.length; i++) {
		var cookie = cookieArray[i];
		while (cookie.charAt(0) == ' ') {
			cookie = cookie.substring(1);
		}
		if (cookie.indexOf(name) == 0) {
			return cookie.substring(name.length, cookie.length);
		}
	}
	return "";
}

function checkAuth() {
	if (getCookie("ybcf")) {
		$('.dl-form').css("display", "none");
		$('.dl-btn').css("display", "flex");
	} else {
		$('.dl-btn').css("display", "none");
		$('.dl-form').css("display", "block");
		setMailListener();
	}
}

function createTableSubHead() {
	$("tr.break").hide();
	$("tr.break").next().addClass("sub-head");
	$(".sub-head").children().css("background-color", "#e8e8e8");
}

function addVideoListener() {
  document.getElementById("hvp").addEventListener("click", function( event ) {
    $('.placeholder').css("display", "none");
    $('.video').css("display", "block");
  });
}

function addFocusOutListener() {
  var modal = document.getElementById("pvp-2");
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}
function addPresentationListener() {
  document.getElementById("pvp-1").addEventListener("click", function( event ) {
    $('.video').css("display", "flex");
    addFocusOutListener();
  });
}

function swapResponsiveBackgrounds() {
  var $windowWidth = $(window).width();

  if($windowWidth < 800) {
      $(".hero-banner a").on("click touchend", function(e) {
        var el = $(this);
        var link = el.attr("href");
        window.location = link;
      }); 
  }

  $('[data-responsivebg]').each(function() {
    var self = this;
    
    var $responsiveBg = $(self).attr('data-responsivebg');
    var $fullBg = $(self).attr('data-fullbg');

    if($windowWidth < 800 && $responsiveBg != '' && $responsiveBg != null) {
        $('body').addClass('small-devices');
        $(self).css('background-image', 'url(' + $responsiveBg + ')');
    } else {
        $('body').removeClass('small-devices');
        $(self).css('background-image', 'url(' + $fullBg + ')');
      }
    });

}

function initParticles() {
	/* ---- particles.js config ---- */
	particlesJS('particles-js', {
      particles: {
        number: {
          value: 10,
          density: {
            enable: true,
            value_area: 800,
          },
        },
        color: {
          value: '#ffffff',
        },
        shape: {
          type: 'image',
          image: {
            src: 'https://docs.yugabyte.com/images/dot.png',
            width: 100,
            height: 100,
          },
        },
        opacity: {
          value: 0.5,
          random: false,
          anim: {
            enable: false,
            speed: 1,
            opacity_min: 0.1,
            sync: false,
          },
        },
        size: {
          value: 11,
          random: true,
          anim: {
            enable: false,
            speed: 8,
            size_min: 4,
            sync: false,
          },
        },
        line_linked: {
          enable: true,
          distance: 450,
          color: '#323A69',
          opacity: 0.2,
          width: 1,
        },
        move: {
          enable: true,
          speed: 2,
          direction: 'none',
          random: false,
          straight: false,
          out_mode: 'out',
          bounce: false,
          attract: {
            enable: false,
            rotateX: 600,
            rotateY: 1200,
          },
        },
      },
      interactivity: {
        detect_on: 'canvas',
        events: {
          onhover: {
            enable: true,
            mode: 'grab',
          },
          onclick: {
            enable: false,
            mode: 'push',
          },
          resize: true,
        },
        modes: {
          grab: {
            distance: 300,
            line_linked: {
              opacity: 0.4,
            },
          },
          bubble: {
            distance: 400,
            size: 40,
            duration: 2,
            opacity: 8,
            speed: 3,
          },
          repulse: {
            distance: 200,
            duration: 0.4,
          },
          push: {
            particles_nb: 4,
          },
          remove: {
            particles_nb: 2,
          },
        },
      },
      retina_detect: true,
    });
};

$(document).ready(function() {
	if ($('body').hasClass('download-template')) {
		if($('body').hasClass('gated')) {
        checkAuth();
    } else {
        $('.dl-form').css("display", "none");
        $('.dl-btn').css("display", "flex");
    }
    if ($('body').hasClass('presentations')) {
      addPresentationListener();
    }
	}
  
  if ($('body').hasClass('has-video')) {
    addVideoListener();
  }

  createTableSubHead();

  if ($('body').hasClass('animated-hero')) {
  	initParticles();
  }

  swapResponsiveBackgrounds();
  $(window).on('resize', function() {
    swapResponsiveBackgrounds();
  })

  if ($('body').hasClass('resource-category')) {
    document.getElementsByClassName("main")[0].scrollIntoView({behavior:'smooth', block: 'start'});
  }

});