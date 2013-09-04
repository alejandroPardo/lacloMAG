$(function() {
	var sw = document.body.clientWidth, breakpoint = 700, mobile = true;
	var checkMobile = function() {
		mobile = (sw > breakpoint) ? false : true;
	};

	checkMobile();
	$(window).resize(function(){
		sw = document.body.clientWidth;	
		checkMobile();
		if (mobile) {
			$(".sectioninfo").addClass("relative");
		} else {
			mount();
		}
	});
	
	$(window).on("scroll", function(){
		var windowScroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		
		if (windowScroll > (windowHeight - 400)) {
			$("#nav").slideDown(300);
		} else {
			$("#nav").slideUp(100);
		}
		
		if (mobile) {
			$(".sectioninfo").addClass("relative");
		} else {
			mount();
		}
	});
	
	function mount() {
        var e, n, i;
		$(".sectioninfo").each(function(){			
			n = $(this).parent().parent().prevAll("div.contentsection").offset().top + $(this).parent().parent().prevAll("div.contentsection").outerHeight() -69, 
			e = $(this), 
			i = $(window).scrollTop(), 
			i >= n ? e.hasClass("relative") && e.removeClass("relative") : e.addClass("relative");
		});
    }

	$('#nav a, .arrow a').click(function(){
	    $('html, body').stop().animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 1000, "easeInOutCirc");
	    return false;
	});
	
	var intID;
	intID = setInterval ( RepeatCall, 400 );

	function RepeatCall() {
		$(".flashing").fadeIn(500).fadeOut(700);
	}
	
	$("a[class=example_group]").fancybox({
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'overlayColor'      : '#000'
	});
	
	
	var directionsDisplay;

	var marker;
	var map;
	

	function initialize() {
	}

	function toggleBounce() {
		if (marker.getAnimation() != null) {
			marker.setAnimation(null);
	   	} else {
	    	marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}
}); 
