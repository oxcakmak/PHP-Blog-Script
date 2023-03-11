$(document).ready(function() {

	"use strict";
	
	$.scrollIt({
		topOffset: -75,
		scrollTime: 1500,
		easing: 'easeInOutExpo'
	});

	$('.count').counterUp();

	$("#contactForm").validator().on("submit", function (event) {

		"use strict";

		if (event.isDefaultPrevented()) {
			// handle the invalid form...
			formError();
			submitMSG(false, "Please Follow Error Messages and Complete as Required");
		} else {
			// everything looks good!
			event.preventDefault();
			submitForm();
		}
	});

	function submitForm(){
		
		"use strict";

		// Initiate Variables With Form Content
		var name = $("#name").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var message = $("#message").val();

		$.ajax({
			type: "POST",
			url: "php/form-process.php",
			data: "name=" + name + "&email=" + email + "&phone=" + phone + "&message=" + message,
			success : function(text){
				if (text == "success"){
					formSuccess();
				} else {
					formError();
					submitMSG(false,text);
				}
			}
		});
	}

	function formSuccess(){
		
		"use strict";

		$("#contactForm")[0].reset();
		submitMSG(true, "Thank you for your submission :)")
	}

	function formError(){
		
		"use strict";

		$("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			$('#contactForm').removeClass();
		});
	}

	function submitMSG(valid, msg){
		
		"use strict";

		if(valid){
			var msgClasses = "success form-message";
		} else {
			var msgClasses = "error form-message";
		}
		$("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
	}

	initbackTop();
	// Back to Top init
	function initbackTop() {
		
		"use strict";

		var jQuerybackToTop = jQuery("#back-top");
		jQuery(window).on('scroll', function() {
			if (jQuery(window).scrollTop() > 100) {
				jQuerybackToTop.addClass('show');
			} else {
				jQuerybackToTop.removeClass('show');
			}
		});
		jQuerybackToTop.on('click', function(e) {
			jQuery("html, body").stop().animate({scrollTop: 0}, 1500, 'easeInOutExpo');
		});
	}

	initAddClass();
	// Add Class  init
	function initAddClass() {
		"use strict";

		jQuery('.drop-link').on( "click", function(e){
			e.preventDefault();
			jQuery('.drop-link').parent().toggleClass("active");
		});

		jQuery('.menu-opener').on( "click", function(e){
			e.preventDefault();
			jQuery('body').toggleClass("nav-active");
		});

		jQuery('.search-close, .search-opener').on( "click", function(e){
			e.preventDefault();
			jQuery('body').toggleClass("search-active");
		});
	}

	initSlickSlider();
	// Slick Slider init
	function initSlickSlider() {

		"use strict";

		jQuery('.main-slider').slick({
			dots: true,
			speed: 600,
			arrows: true,
			infinite: true,
			adaptiveHeight: true
		});

		jQuery('.t-slider').slick({
			dots: true,
			speed: 600,
			arrows: false,
			infinite: true,
			adaptiveHeight: true
		});

		jQuery('.line-box .line').slick({
			speed: 600,
			dots: false,
			arrows: false,
			autoplay: true,
			infinite: true,
			slidesToShow: 5,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 991,
						settings: {
							slidesToShow: 4
						}
					},
				{
				breakpoint: 767,
					settings: {
						slidesToShow: 3
					}
				},
				{
				breakpoint: 480,
					settings: {
						slidesToShow: 2
					}
				}
			]
		});

		jQuery('.port-slider').slick({
			speed: 600,
			dots: false,
			arrows: true,
			infinite: true,
			adaptiveHeight: true
		});

		jQuery('.image-slider').slick({
			speed: 600,
			dots: true,
			arrows: false,
			infinite: true,
			adaptiveHeight: true,
			customPaging : function(slider, i) {
				var thumb = $(slider.$slides[i]).data('thumb');
				return '<span><img src="'+thumb+'"></span>';
			}
		});
	}

	initStickyHeader();
	// sticky header init
	function initStickyHeader() {
		"use strict";

		var win = jQuery(window),
			stickyClass = 'sticky';

		jQuery('#header').each(function() {
			var header = jQuery('#header');
			var headerOffset = header.offset().top || 200;
			var flag = true;
		
			function scrollHandler() {
				if (win.scrollTop() > headerOffset) {
					if (flag){
						flag = false;
						header.addClass(stickyClass);
					}
				} else {
					if (!flag) {
						flag = true;
						header.removeClass(stickyClass);
					}
				}
			}

			scrollHandler();
			win.on('scroll resize orientationchange', scrollHandler);
		});
	}

	initLightbox();
	// modal popup init
	function initLightbox() {
		"use strict";

		jQuery('a.lightbox, a[rel*="lightbox"]').fancybox({
			padding: 0
		});
	}

	initAnimatedProgressbars();
	// progressbars init
	function initAnimatedProgressbars() {
		"use strict";

		var globalResizeTimer = null;
		jQuery(window).on( "scroll", function(){
			if(globalResizeTimer != null){ 
				window.clearTimeout(globalResizeTimer); 
			}
			globalResizeTimer = window.setTimeout(function() {

				var scrollPos = jQuery(window).scrollTop();
				var windowHeight = jQuery(window).height();
			  
				var activeSection = jQuery('.wedo-section').offset().top - 50;
				if(scrollPos > activeSection){
					var item = jQuery('.bar-outer .bar');
					var percent = item.attr('data-width');
					var animationSpeed = 2500;
					var flag = false;

					if(!flag) {
						item.animate({
							width: percent + "%"
						}, animationSpeed);

						flag = true;
					}
				}
			}, 200);
		});
	}

	initGoogleMap();
	// GoogleMap init
	function initGoogleMap() {
		"use strict";
		
		jQuery('.map').googleMapAPI({
			marker: 'images/map-tip.png',
			mapInfoContent: '.map-info',
			streetViewControl: false,
			mapTypeControl: false,
			scrollwheel: false,
			panControl: false,
			zoomControl: false
		});
	}

	initTabs();
	// content tabs init
	function initTabs() {
		"use strict";

		jQuery('ul.tabset').tabset({
			tabLinks: 'a',
			defaultTab: false
		});
	}
	
	initCountDown();
	// count down init
	function initCountDown() {
		"use strict";
                
        //Countdown script
        
        var countDownDate = new Date("June 30, 2017 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            $('#daysplace').text(days);
            $('#hoursplace').text(hours);
            $('#minsplace').text(minutes);
            $('#secplace').text(seconds);

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
	}

	initTextRotator();
	// TextRotator2 init
	function initTextRotator() {
		"use strict";

		jQuery("#rotating").typed({
			strings: ["Design", "develop", "Code", "Create"],
			loop: true,
			typeSpeed: 200
		});
	}

	initTextRotator2();
	// TextRotator2 init
	function initTextRotator2() {
		"use strict";

		jQuery('#rotating2').textillate({
			selector: '.rotating-hold',

			// enable looping
			loop: true,

			// sets the minimum display time for each text before it is replaced
			minDisplayTime: 2000,

			// sets the initial delay before starting the animation
			// (note that depending on the in effect you may need to manually apply
			// visibility: hidden to the element before running this plugin)
			initialDelay: 0,

			// set whether or not to automatically start animating
			autoStart: true,

			// custom set of 'in' effects. This effects whether or not the
			// character is shown/hidden before or after an animation
			inEffects: [],

			// custom set of 'out' effects
			outEffects: [ 'hinge' ],

			// in animation settings
			in: {
				// set the effect name
				effect: 'fadeInLeftBig',

				// set the delay factor applied to each consecutive character
				delayScale: 1.5,

				// set the delay between each character
				delay: 50,

				// set to true to animate all the characters at the same time
				sync: false,

				// randomize the character sequence
				// (note that shuffle doesn't make sense with sync = true)
				shuffle: false,

				// reverse the character sequence
				// (note that reverse doesn't make sense with sync = true)
				reverse: false
			},
			out: {
				effect: 'hinge',
				delayScale: 1.5,
				delay: 50,
				sync: false,
				shuffle: false,
				reverse: false,
			},
			type: 'char'
		});
	}

	initVegasSlider();
	// Vegas Slider init
	function initVegasSlider() {
		"use strict";
		
	  jQuery("#bgvid").vegas({
	      slides: [
	        {   src: 'images/img22.jpg',
	            video: {
	                src: [
	                    'video/polina.webm',
	                    'video/polina.mov',
	                    'video/polina.mp4'
	                ],
	                loop: true,
	                timer: false,
	                mute: true
	            }
	        }
	    ]
	  });
	}

}); 
$( window ).on( "load" , function() {

	"use strict";

	$( "#loader" ).delay( 600 ).fadeOut( 300 );

	initIsoTop();
	// IsoTop init
	function initIsoTop() {
		"use strict";

		// Isotope init
		var isotopeHolder = jQuery('#isotop-holder'),
			win = jQuery(window);

		jQuery('.isotop-filter a').on( "click", function(e){
			e.preventDefault();
			
			jQuery('.isotop-filter li').removeClass('active');
			jQuery('.isotop-filter a').parent('li').addClass('active');
			var selector = jQuery('.isotop-filter a').attr('data-filter');
			isotopeHolder.isotope({ filter: selector });
		});
		jQuery('#isotop-holder').isotope({
			itemSelector: '.item',
			layoutMode: 'masonry',
			transitionDuration: '0.6s',
			masonry: {
				columnWidth: '.item'
			}
		});
	}
}); 