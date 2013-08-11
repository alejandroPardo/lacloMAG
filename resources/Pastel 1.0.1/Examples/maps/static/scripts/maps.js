//Modal plugin
(function($){
$.fn.modal = function(options) {
	var defaults = {  
		theme: "light",  
		width: undefined,
		height: undefined,
		layout: undefined,
		url: undefined,
		content: undefined,
		padding: undefined,
		animation: "flipInX"
	};  
	if( $("#overlays .modal").length>0 ) {
		$("#overlays .modal").remove();
	}
	var options = $.extend(defaults, options); 
	
	$("#overlays").addClass("dark").append('<div class="modal"><div class="wrapper"></div></div>');
	var modal = $("#overlays .modal");
	var wrapper = $("#overlays .modal .wrapper");
	
	if(defaults.url==undefined) {
		wrapper.html( this.html() );
	} else {
		wrapper.load(defaults.url);
	}
	
	if(defaults.content!=undefined) {
		wrapper.html(defaults.content);
	}
	
	if(defaults.theme!="light") {
		modal.addClass(defaults.theme);
	}
	
	if(defaults.animation!=false) {
		modal.addClass("animated " + defaults.animation);
	}
	
	if(defaults.layout=="elastic") {
		var si = "%";
		if(defaults.width==undefined) {
			modal.css("width", "90%").css("margin-left", "-45%");
		}
		if(defaults.height==undefined) {
			modal.css("height", "70%").css("margin-top", "-35%");
		}
		
	} else {
		var si = "px";
	}
	
	if(defaults.width!=undefined) {
		var width = defaults.width + si;
		var marginLeft = -(defaults.width / 2) + si;
		modal.css("width", width).css("margin-left", marginLeft);
	}
	if(defaults.height!=undefined) {
		var height = defaults.height + si;
		var marginTop = -(defaults.height / 2) + si;
		modal.css("height", height).css("margin-top", marginTop);
	}
	
	if(defaults.padding!=undefined) {
		wrapper.css("margin", defaults.padding)
	}
	
	
	modal.live("tap", function() {
		return false;
	});
	
	$("#overlays.dark .modal .hide").live("tap", function() {
		remove(modal);
	});
	
	$(document).keyup(function(e) {
		if(e.which == 27) {
			remove(modal);
		}
	});
	
	function remove(modal) {
		modal.remove();
		$("#overlays").removeClass();
		$(document).unbind("keyup");	
	}
	
	
	
}
})(jQuery);

// Maps plugin
(function($){
	$.fn.maps = function(options) {
	var defaults = {  
		coordinates: "55.680839,12.585955",
		place: undefined,  
		texture: false,
		type: "satellite",
		zoom: 16,
		marker: true,
		geo: false,
		caption: undefined,
		modal: {padding: 0, width: 1100 },
		html: false
	};  
	var obj = this;
	var options = $.extend(defaults, options); 
	var coords = defaults.coordinates;
	var zoom = defaults.zoom;
	var type = defaults.type;
	if(defaults.place!=undefined) {
		coords = $.trim(defaults.place).split(' ').join('+');
	}
	if(defaults.geo==true) {
		if (navigator.geolocation) {  
			navigator.geolocation.getCurrentPosition(
				function(position) {  
					coords = position.coords.latitude + "," + position.coords.longitude;
					return create();  
		  		}, 
		  		function(error) {
		  			var content;
					switch(error.code) {
						case error.TIMEOUT:
							content = "Timeout.";
							break;
						case error.POSITION_UNAVAILABLE:
							content = "Position unavailable"
						case error.PERMISSION_DENIED:
							content = "Permission denied.";
							break;
						case error.UNKNOWN_ERROR:
							content = "Unknown error";
							break;
					}		  			
		  			$.notification( 
		  				{
		  					title: "Your location could not be determined",
		  					content: content,
		  					error: true
		  				}
		  			);
		  		},
		  		{
					enableHighAccuracy: true,
					timeout: 10000
		  		}
		  		
		  	);
		} else {
			$.notification( 
				{
					title: "Your location could not be determined",
					content: "Your browser doesn't support geolocation.",
					error: true
				}
			);
		}
	} else {
		return create();
	}
	function create() {
		var url = "http://maps.googleapis.com/maps/api/staticmap?center=" + coords + "&zoom=" + zoom + "&maptype=" + type + "&size=640x640&sensor=false&scale=2&language=en";
		var con = $("<div>");
		var map = $("<div>");
		map.addClass("map").css("background-image", "url("+url+")");
		if(defaults.marker==true) {
			var marker = $("<div>");
			var glow = $("<div>");
			marker.addClass("marker animated rotateInDownRight");
			glow.addClass("glow").appendTo(marker);	
			marker.appendTo(map);
		}
		if(defaults.texture==true) {
			map.addClass("texture");
		}
		if(defaults.caption!=undefined) {
			var outer = $("<div>");
			var caption = $("<div>");
			outer.addClass("outer");
			caption.addClass("caption animated bounceInDown").html(defaults.caption).appendTo(outer);	
			outer.appendTo(map);
		}
		if($(obj).length>0) {
			map.addClass("non-modal");
		}
		map.appendTo(con);
		if($(obj).length>0) {
			$(obj).html( con.html() );
		} else if (defaults.html==true) {
			return con.html();
		} else {
			con.modal(defaults.modal);
		}
	}
};
})(jQuery);