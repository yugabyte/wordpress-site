<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.bundle.min.js?ver=1" type="text/javascript"></script>
<script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js?ver=1.167" type="text/javascript"></script>

<!-- animate on scroll -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
	AOS.init({
		duration: 600,
		mirror: true
	});

	function polarToCartesian(centerX, centerY, radius, angleInDegrees) {
	var angleInRadians = (angleInDegrees-90) * Math.PI / 180.0;

	return {
		x: centerX + (radius * Math.cos(angleInRadians)),
		y: centerY + (radius * Math.sin(angleInRadians))
	};
	}

	function describeArc(x, y, radius, startAngle, endAngle){

		var start = polarToCartesian(x, y, radius, endAngle);
		var end = polarToCartesian(x, y, radius, startAngle);

		var arcSweep = endAngle - startAngle <= 180 ? "0" : "1";

		var d = [
			"M", start.x, start.y, 
			"A", radius, radius, 0, arcSweep, 0, end.x, end.y
		].join(" ");

		return d;       
	}

	var drawArcs = function() {
	graphic = { 
		groups: [
		[
			{ x: 120, y: 120, radius: 15, start: 0, end: 72, width: 30, color: "#E64A19" },
			{ x: 120, y: 120, radius: 60, start: 0, end: 66, width: 20, color: "#E64A19" },
			{ x: 120, y: 120, radius: 100, start: 0, end: 66, width: 20, color: "#E64A19"},
		],
		[
			{ x: 120, y: 120, radius: 15, start: 72, end: 144, width: 30, color: "#303F9F" },
			{ x: 120, y: 120, radius: 60, start: 72, end: 136, width: 20, color: "#303F9F" },
			{ x: 120, y: 120, radius: 100, start: 72, end: 136, width: 20, color: "#303F9F"},
		],
		[
			{ x: 120, y: 120, radius: 15, start: 144, end: 216, width: 30, color: "#7C4DFF" },
			{ x: 120, y: 120, radius: 60, start: 144, end: 210, width: 20, color: "#7C4DFF" },
			{ x: 120, y: 120, radius: 100, start: 144, end: 210, width: 20, color: "#7C4DFF"},
		],
		[
			{ x: 120, y: 120, radius: 15, start: 216, end: 288, width: 30, color: "#CDDC39" },
			{ x: 120, y: 120, radius: 60, start: 216, end: 282, width: 20, color: "#CDDC39" },
			{ x: 120, y: 120, radius: 100, start: 216, end: 282, width: 20, color: "#CDDC39"},
		],
		[
			{ x: 120, y: 120, radius: 15, start: 288, end: 354, width: 30, color: "#00796B" },
			{ x: 120, y: 120, radius: 60, start: 288, end: 354, width: 20, color: "#00796B" },
			{ x: 120, y: 120, radius: 100, start: 288, end: 354, width: 20, color: "#00796B"},
		],
		]
	};
	
	var svg = document.getElementById('graphic');

	var count = 0;
	graphic.groups.forEach(function(arcs, i){
		arcs.forEach(function(arc, ii){
		var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
		path.id = 'arc-' + count++;
		path.setAttribute('class', 'arc');
		path.setAttribute('data-group', i);
		path.setAttribute('data-level', ii);
		
		var rotateStart = arc.start + 6; // + gap

		path.setAttribute('data-start', rotateStart);
		path.style.fill = 'none';
		path.style.stroke = arc.color;
		path.style.strokeWidth = arc.width;
	
		var d = describeArc(arc.x, arc.y, arc.radius, arc.start, arc.end);
		path.setAttribute('d', d);
		
		if (svg) {
			svg.appendChild(path);
		}
		})
	});
}

function getImageLightness(imageSrc,callback) {
    var img = document.createElement("img");
    img.src = imageSrc;
    img.style.display = "none";
    document.body.appendChild(img);

    var colorSum = 0;

    img.onload = function() {
        // create canvas
        var canvas = document.createElement("canvas");
        canvas.width = this.width;
        canvas.height = this.height;

        var ctx = canvas.getContext("2d");
        ctx.drawImage(this,0,0);

        var imageData = ctx.getImageData(0,0,canvas.width,canvas.height);
        var data = imageData.data;
        var r,g,b,avg;

        for(var x = 0, len = data.length; x < len; x+=4) {
            r = data[x];
            g = data[x+1];
            b = data[x+2];

            avg = Math.floor((r+g+b)/3);
            colorSum += avg;
        }

        var brightness = Math.floor(colorSum / (this.width*this.height));
        callback(brightness);
    }
}

window.onload = function () {
	drawArcs();

	$('.action-dropdown.open, .action-dropdown.close').on('click', function () {
		$(this).parent().siblings('ul.sub-nav-menu').toggleClass('active');
		$(this).toggleClass('open');
		$(this).toggleClass('close');
	});

	var $navSlidingBar = $("#menu-main-menu hr");
	$("#menu-main-menu .nav-link").hover(function () {
		var paddingSize = $(this).css('padding-left').substring(0, $(this).css('padding-left').length - 2);
		var offsetLeft = $(this).offset().left - $(this).parent().parent().offset().left + parseInt(paddingSize);
		$navSlidingBar.css('left', offsetLeft);
	});

	$(".feature-list-options li").hover(function onFeatureHover() {
		var arcId = $(this).attr("data-arc-id");
		for (var i = 0; i < $(".arc").length; i++) {
			if (i != arcId) {
				var targetArc = $("#arc-" + i);
				var color = targetArc.css("stroke").replace(/rgb\((\d+, \d+, \d+)\)/, 'rgba($1, 0.2)');
				targetArc.css("stroke", color);
			}
		}
	}, function onFeatureHoverOut() {
		for (var i = 0; i < $(".arc").length; i++) {
			var targetArc = $("#arc-" + i);
			var color = targetArc.css("stroke").replace(/rgba\((\d+, \d+, \d+), \d\.\d\)/, 'rgb($1)');
			targetArc.css("stroke", color);
		}
	});

	$('.email-contact input[type="submit"]').on('click', function () {
		var $formParent = $(this).parent();
		var type = [];
		if ($formParent.hasClass('trial')) {
			type.push('Trial');
		}
		if ($formParent.hasClass('demo')) {
			type.push('Demo');
		}
		var contactEmail = encodeURI($(this).prev()[0].value);
		document.location.href = `/contact-sales?contact-email=${contactEmail}&type=${type.join(',')}`;
	});

	/* Contact Us */
	var urlParams = new URLSearchParams(window.location.search);
	if (urlParams.has('contact-email') && (window.location.pathname === '/contact-us/' || window.location.pathname === '/contact-sales/')) {
		var typeArr = urlParams.get('type').split(',');
		for (var i = 0; i < typeArr.length; i++) {
			var targetCheckbox = $(`.wpcf7-list-item input[type="checkbox"][value="${typeArr[i]}"]`);
			if (targetCheckbox.length) {
				targetCheckbox.prop('checked', true);
			}
		}
		var $emailForm = $('input.wpcf7-form-control[name="companyEmail"]');
		if ($emailForm.length) {
			$emailForm.val(urlParams.get('contact-email'));
		}
	}
    
	/* Success Stories */
	$('.company-gallery .card .expand-btn').on('click', function () {
		$(this).parent().parent().find('.company-details').removeClass('hidden');
		$(this).parent().parent().find('.testimonial-quote').addClass('hidden');
		$(this).parent().addClass('hidden');
	});

	$('.company-gallery .card .shrink-btn').on('click', function () {
		$(this).parent().parent().parent().find('.testimonial-quote').removeClass('hidden');
		$(this).parent().parent().parent().find('.action-bar').removeClass('hidden');
		$(this).parent().parent().addClass('hidden');
	});

	/* Community Page Accordion */
	var acc = document.querySelectorAll(".it-blocks .contribute-wrapper .summary")
	for (var i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		/* Toggle between adding and removing the "active" class,
		to highlight the button that controls the panel */
		this.classList.toggle("active");

		/* Toggle between hiding and showing the active panel */
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
		}
	});
	}

	/* Case Study Page */
    var $modal = $("#video-modal");
    var modalSrc = $('#video-modal iframe').attr('src');
    
    $(".hero .hero-image-wrapper").on('click', function(e) {
      $modal.css('display', "block");
      $('#video-modal iframe').attr('src', modalSrc);
  	});


    $('#video-modal .close').on('click', function() {
        $modal.css('display', "none");
        $('#video-modal iframe').attr('src', '');
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == $modal[0]) {
            $modal.css('display', "none");
            $('#video-modal iframe').attr('src', '');
        }
    }

	// Mute video and hide controls
	if ($(".demo-video iframe")[0]) {
		$(".demo-video iframe")[0].src += "&muted=1&controls=0";
	}

	// Click handler
	$(".demo-video, .demo-video .play-btn").on('click', function(ev) {
		var videoPlayer = $(".demo-video iframe")[0];
		videoPlayer.src = videoPlayer.src.substring(0, videoPlayer.src.length - 11);
		videoPlayer.src += "&autoplay=1";
		$(".demo-video .play-btn").hide();
		ev.preventDefault();
	});
}
</script>
