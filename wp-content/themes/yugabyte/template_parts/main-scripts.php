<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.bundle.min.js?ver=1" type="text/javascript"></script>
<script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js?ver=1.169" type="text/javascript"></script>

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

window.onresize = formatLogoWall;

// Adding logo slider
function formatLogoWall() {
	var $logoWall = $('.logo-wall');
	if (window.innerWidth > 1000) {
		if ($logoWall.length && !$logoWall.hasClass('slick-slider')) {
			if ($logoWall.parents('.home').length) {
				$logoWall.slick({
					slidesToShow: 8,
					slidesToScroll: 2,
					autoplay: true,
					autoplaySpeed: 5000,
				});
			} else {
				$logoWall.slick({
					slidesToShow: 5,
					slidesToScroll: 2
				});
			}
		}		
	} else {
		if ($logoWall.hasClass('slick-slider')) {
			$logoWall.slick('unslick');
		}
	}
}

window.onload = function () {
	drawArcs();

	if (window.innerWidth > 1000) {
		formatLogoWall();
	}

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
	}, function () {
		// Force bootstrap to close the dropdown menu when hover out
		var $childDropdown = $(this).siblings('.dropdown-menu.show');
		if ($childDropdown.length) {
			$childDropdown.removeClass('show');
		}
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

	/* Charity Page */
	$('.vote-charity .email-vote').on('click', function() {
		var submissionForm = $(this).siblings('.email-submission-form')
		submissionForm.removeClass('hidden');
		var charityUrl = submissionForm.attr('data-url');
		submissionForm.find('input[type="hidden"][name="choice"]').val(charityUrl);
		$(this).addClass('hidden');
	});

	/* Download Report Template */
	var SERVICE_URL = 'https://yugabyte-form-submission.herokuapp.com';
	var SERVICE_AUTH_TOKEN = '84c2c09d-2f20-48a5-b5e9-0068a95e97de';
	document.addEventListener( 'wpcf7submit', function( event ) {
		if (event.detail.apiResponse.status == 'mail_sent') {
			var formBox = $('#research-page .form-container');
			if (formBox.length) {
				formBox.addClass('is-flipped');
				var formData = {}
				event.detail.inputs.forEach(val => formData[val.name] = val.value);
				var params = new URLSearchParams(formData);
				var url = '';
				if (window.location.pathname.match(/virtual-tech-talk/)) {
					url = `${SERVICE_URL}/virtual-tech-talk/registration`;
				} else if (window.location.pathname.match(/dzone-database-report-2020/)) {
					url = `${SERVICE_URL}/dzone-report/download`;
				} else if (window.location.pathname.match(/451-report-distributed-sql/)) {
					url = `${SERVICE_URL}/report/download`;
				} else if (window.location.pathname.match(/oreilly-sql-cookbook/)) {
					url = `${SERVICE_URL}/oreilly-book/download`;
				} else if (window.location.pathname.match(/dzone-refcard-distributedsql-2020/)) {
					url = `${SERVICE_URL}/dzone-refcard/download`;
				} else if (window.location.pathname.match(/multi-cloud-data-strategy/)) {
					url = `${SERVICE_URL}/multi-cloud-white-paper-jan-2021/download`;
				} else if (window.location.pathname.match(/dzone-data-persistence-report-2021/)) {
					url = `${SERVICE_URL}/dzone-data-persistence-2021/download`;
				}
				if (url) {
					fetch(url, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded',
							'X-AUTH-TOKEN': SERVICE_AUTH_TOKEN
						},
						body: params.toString()
					});
				}
			}
		}
	}, false );

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

	$(".comparison .graph-sequence img").on('click', function(e) {
		if (window.innerWidth > 576) {
			$modal.css('display', "block");
			$("#video-modal .modal-content .image-container").html(e.currentTarget.outerHTML);
		}
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
		$(".demo-video iframe")[0].src += "&controls=0";
	}

	// Click handler
	$(".demo-video, .demo-video .play-btn").on('click', function(ev) {
		var videoPlayer = $(".demo-video iframe")[0];
		videoPlayer.src = videoPlayer.src.substring(0, videoPlayer.src.length - 11);
		videoPlayer.src += "&autoplay=1";
		videoPlayer.style.opacity = 1;
		$(".demo-video .play-btn").hide();
		ev.preventDefault();
	});

	// Events page
	$("select#event-type-filter").on('change', function (ev) {
		var term = ev.target.value;
		if (term === 'None') {
			$(".events-page .event-list li.item-container").removeClass('hidden');
		} else {
			$(".events-page .event-list li.item-container").addClass('hidden');
			$(`.events-page .event-list li.item-container[data-event-type='${term}']`).removeClass('hidden');
		}
	});

	// primitive search over content library items available on current page
	$('.content-library-search__input').on('keyup', function(event) {
		var query = event.target.value.trim().toLowerCase();
		if (query) {
			$('.content-library-tile')
				.hide()
				.filter(function() {
					return $('.content-library-tile__text', this).text().toLowerCase().includes(query);
				})
				.show();
		} else {
			$('.content-library-tile').show();
		}
	});

	// dropdown-like filters for content library mobile view
	$('.content-library-filters__title--mobile').on('click', function() {
		$('.content-library-filters__container').toggle();
		$('.content-library-filters__chevron').toggleClass('content-library-filters__chevron--rotated');
	});

	$('.content-library-list__scroll-top').on('click', function() {
		window.scrollTo(0, 0);
	});

	// scroll top button for content library page at mobile view
	if (window.location.href.includes('/content-library/?type=')) {
		window.document.querySelector('.content-library-search').scrollIntoView();
	}

	// kubecon swag page - learn more toggler
	$('.kubecon-page').click(function(event) {
		$('.kubecon-options__learn-more')
			.not(event.target)
			.find('> .kubecon-options__learn-more__tooltip')
			.hide();
		$(event.target)
			.find('> .kubecon-options__learn-more__tooltip')
			.toggle();
	});

	if (window.location.pathname.includes('dss-asia-swag')) {
		function updateSwagNumbers() {
			const url = `${SERVICE_URL}/swag-donations`;
			const params = {
				mode: 'cors',
				headers: {
					'X-AUTH-TOKEN': SERVICE_AUTH_TOKEN
				}
			};
			
			fetch(url, params)
				.then((resp) => resp.json())
				.then((data) => {
					const total = Object.values(data).reduce((a, b) => Number(a) + Number(b), 0);

					for (const [key, value] of Object.entries(data)) {
						const progressbarElem = $(`.kubecon-options__progressbar[data-name="${key}"]`);
						const progressbarValueElem = $('.kubecon-options__progressbar__value', progressbarElem);
						const offset = Number(progressbarValueElem.attr('data-initial'));
						const spaceAvailable = progressbarElem.height() - offset;
						const newHeight = offset + (spaceAvailable * Number(value) / total);

						progressbarValueElem.css('height', newHeight);
					}
				});
		}
		updateSwagNumbers();

		$('.kubecon-options__select').click(function(event) {
			// exit if already selected option has been clicked
			if ($('.kubecon-options__select__btn-selected--visible', this).length) return;

			// reset all selections
			$('.kubecon-options__select__btn-default').show();
			$('.kubecon-options__select__btn-selected').removeClass('kubecon-options__select__btn-selected--visible');

			// select current
			$('.kubecon-options__select__btn-default', this).hide();
			$('.kubecon-options__select__btn-selected', this).addClass('kubecon-options__select__btn-selected--visible');

			// update hidden form field
			$('#kubecon-charity-selection').val(this.attributes['data-name'].value);
		});
	
		document.addEventListener('wpcf7mailsent', function(event) {
			$('.kubecon-form__form-wrapper').hide();
			$('.kubecon-form__after-submit').show();
			$('.kubecon-options__select').addClass('kubecon-options__select--disabled');

			const urlencoded = new URLSearchParams();
			const fields = ['firstName', 'lastName', 'company', 'email', 'charity'];
			event.detail.inputs.forEach(input => {
				if (fields.includes(input.name)) {
					urlencoded.append(input.name, input.value);
				}
			});

			const url = `${SERVICE_URL}/swag-donations`;
			const params = {
				method: 'POST',
				mode: 'cors',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
					'X-AUTH-TOKEN': SERVICE_AUTH_TOKEN
				},
				body: urlencoded.toString()
			};

			fetch(url, params).then((resp) => {	
				updateSwagNumbers();
			});
		}, false);	
	}
	
	// duplicate all form submissions
	document.addEventListener('wpcf7mailsent', function(event) {
		const formDataLines = [];
		event.detail.inputs.forEach(input => {
			if (input.name !== 'g-recaptcha-response') {
				formDataLines.push(`${input.name}: ${input.value}`);
			}
		});

		const urlencoded = new URLSearchParams();
		urlencoded.append('location', window.location.href);
		urlencoded.append('userAgent', window.navigator.userAgent);
		urlencoded.append('contactFormId', event.detail.contactFormId);
		urlencoded.append('formData', formDataLines.join('\n'));

		const url = `${SERVICE_URL}/submit-form`;
		const params = {
			method: 'POST',
			mode: 'cors',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				'X-AUTH-TOKEN': SERVICE_AUTH_TOKEN
			},
			body: urlencoded.toString()
		};

		fetch(url, params);
	}, false);
}
</script>
