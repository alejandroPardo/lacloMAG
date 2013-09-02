// @PLUGIN Captures touch events on mobile devices to reduce delay.
jQuery.event.special.tap = {
    setup: function (a, b) {
        var c = this,
            d = jQuery(c);
        d.bind("tap", jQuery.event.special.tap.click)
    },
    click: function (a) {
        a.type = "click";
        jQuery.event.handle.apply(this, arguments)
    }
};
// @PLUGIN Notifications
(function ($) {
    $.notification = function (settings) {
       	var con, notification, hide, image, right, left, inner;
        
        settings = $.extend({
        	title: undefined,
        	content: undefined,
            timeout: 10000,
            img: undefined,
            border: true,
            fill: false,
            showTime: true,
            click: undefined,
            icon: undefined,
            color: undefined,
            error: false
        }, settings);
        
        con = $("#notifications");
        if (!con.length) {
            con = $("<div>", { id: "notifications" }).appendTo($("#overlays"))
        };
        
		notification = $("<div>");
        notification.addClass("notification animated fadeInLeftMiddle fast");
        
        if(settings.error == true) {
        	notification.addClass("error");
        }
        
        if( $("#notifications .notification").length > 0 ) {
        	notification.addClass("more");
        } else {
        	con.addClass("animated flipInX").delay(1000).queue(function(){ 
        	    con.removeClass("animated flipInX");
        			con.clearQueue();
        	});
        }
        
        hide = $("<div>", {
			click: function () {
				if($(this).parent().is(':last-child')) {
				    $(this).parent().remove();
				    $('#notifications .notification:last-child').removeClass("more");
				} else {
					$(this).parent().remove();
				}
			}
		});
		
		hide.addClass("hide");

		left = $("<div class='left'>");
		right = $("<div class='right'>");
		
		if(settings.title != undefined) {
			var htmlTitle = "<h2>" + settings.title + "</h2>";
		} else {
			var htmlTitle = "";
		}
		
		if(settings.content != undefined) {
			var htmlContent = settings.content;
		} else {
			var htmlContent = "";
		}
		
		inner = $("<div>", { html: htmlTitle + htmlContent });
		inner.addClass("inner");
		
		inner.appendTo(right);
		
		if (settings.img != undefined) {
			image = $("<div>", {
				style: "background-image: url('"+settings.img+"')"
			});
		
			image.addClass("img");
			image.appendTo(left);
			
			if(settings.border==false) {
				image.addClass("border")
			}
			
			if(settings.fill==true) {
				image.addClass("fill");
			}
			
		} else {
			if (settings.icon != undefined) {
				var iconType = settings.icon;
			} else {
				if(settings.error!=true) {
					var iconType = '"';
				} else {
					var iconType = '!';
				}
			}	
			icon = $('<div class="icon">').html(iconType);
			
			if (settings.color != undefined) {
				icon.css("color", settings.color);
			}
			
			icon.appendTo(left);
		}

		function timeSince(time){
        	var time_formats = [
        	  [2, "One second", "1 second from now"], // 60*2
        	  [60, "seconds", 1], // 60
        	  [120, "One minute", "1 minute from now"], // 60*2
        	  [3600, "minutes", 60], // 60*60, 60
        	  [7200, "One hour", "1 hour from now"], // 60*60*2
        	  [86400, "hours", 3600], // 60*60*24, 60*60
        	  [172800, "One day", "tomorrow"], // 60*60*24*2
        	  [604800, "days", 86400], // 60*60*24*7, 60*60*24
        	  [1209600, "One week", "next week"], // 60*60*24*7*4*2
        	  [2419200, "weeks", 604800], // 60*60*24*7*4, 60*60*24*7
        	  [4838400, "One month", "next month"], // 60*60*24*7*4*2
        	  [29030400, "months", 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
        	  [58060800, "One year", "next year"], // 60*60*24*7*4*12*2
        	  [2903040000, "years", 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
        	  [5806080000, "One century", "next century"], // 60*60*24*7*4*12*100*2
        	  [58060800000, "centuries", 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        	];
        	
        	var seconds = (new Date - time) / 1000;
        	var token = "ago", list_choice = 1;
        	if (seconds < 0) {
        		seconds = Math.abs(seconds);
        		token = "from now";
        		list_choice = 1;
        	}
        	var i = 0, format;
        	
        	while (format = time_formats[i++]) if (seconds < format[0]) {
        		if (typeof format[2] == "string")
        			return format[list_choice];
        	    else
        			return Math.floor(seconds / format[2]) + " " + format[1];
        	}
        	return time;
        };
        
        if(settings.showTime != false) {
        	var timestamp = Number(new Date());
        	
        	timeHTML = $("<div>", { html: "<strong>" + timeSince(timestamp) + "</strong> ago" });
        	timeHTML.addClass("time").attr("title", timestamp);
        	timeHTML.appendTo(right);
        	
        	setInterval(
	        	function() {
	        		$(".time").each(function () {
	        			var timing = $(this).attr("title");
	        			$(this).html("<strong>" + timeSince(timing) + "</strong> ago");
	        		});
	        	}, 4000)
        	
        }

        left.appendTo(notification);
        right.appendTo(notification);
        
        hide.appendTo(notification);

        notification.hover(
        	function () {
            	hide.show();
        	}, 
        	function () {
        		hide.hide();
        	}
        );
        
        notification.prependTo(con);
		notification.show();

        if (settings.timeout) {
            setTimeout(function () {
            	var prev = notification.prev();
            	if(prev.hasClass("more")) {
            		if(prev.is(":first-child") || notification.is(":last-child")) {
            			prev.removeClass("more");
            		}
            	}
	        	notification.remove();
            }, settings.timeout)
        }

        return this
    }
})(jQuery);

$.initializeLogin = function() {
	// Update
	if ($.browser.msie  && parseInt($.browser.version, 10) === 8) {
		// IE8 doesn't like HTML!
	} 
	// Adding overlay to the body
	$("body").addClass("welcome").append('<div id="overlays"></div>');

	// --------------- Overlay initialization ----------------
	$("#overlays.dark").live("tap", function() {
		$(this).removeClass("dark");
		$("#overlays .modal").remove();
	});
	// -------------------------------------------------------
	
	// Welcome notification
	$.notification( 
		{
			title: "Bienvenido a LACLO magazine.",
			content: "¡Ingrese sus datos para continuar!",
			img: "../img/logo-notification.png",
			border: false,
			timeout: false,
			showTime: false
		}
	);

	$("#password").addClass("animated flipInY").show();
	$("#password .input.username input").focus();
	
	$("#password #boton").bind("click tap", function() {
		forgot();
	});
	
	$("#password .input.password input").keyup(function(event) {
		if (event.which == 13) {
			forgot();
		}
	});

	// MODAL FORGOT PASSWORD
	$("#modals button").bind("click tap", function() {
		var attr = $(this).attr("data-function");
		var options;

		options =  { animation: "flipInX", theme: "dark", url: "passForgot" };
		
		$().modal(options);
	});

	$("#btnForgot").live("click tap", function() {
		if($("#forgot .forEmail input").attr("value")=='') {
			$.notification( 
				{
					title: "Datos Incompletos",
					content: "Para recuperar su contraseña debe ingresar su Correo Electrónico",
					icon: "!"
				}
			);
		} else {
			/**
			 * AJAX call to login the user
			 */
			var email = document.getElementById("email");

			var data = {
                'data[User][email]': email.value
            }

            $.ajax({
				type: "POST",
				url: "forgetPwd/",
				data:  data,
				dataType: "json",
				success: function(response) {
					// Response was a success
					if (response.success) {
						$.notification({
							title: "Correo Electrónico enviado",
							content: "Se enviaron a su correo electrónico los pasos para recuperar su contraseña",
							icon: "!"
						});
					// Response contains errors
					} else {
						$.notification({
							title: "Error al recuperar contraseña",
							content: "No se pudo enviar su contraseña. ¿Escribió correctamente su correo electrónico?",
							icon: "!",
							error: true
						});
					}
				}
			});
			$("#overlays").removeClass("dark");
			$("#overlays .modal").remove();
		}
		
	});

	$("#btnForgotCancel").live("tap click", function() {
		$("#overlays").removeClass("dark");
		$("#overlays .modal").remove();
	});
	
	function forgot() {
		if($("#password .input.password input").attr("value")=='' || $("#password .input.username input").attr("value")=='') {
			$.notification( 
				{
					title: "Datos Incompletos",
					content: "Debe completar ambos campos para continuar",
					icon: "!"
				}
			);
			$("#password").removeClass().addClass("animated wobble").delay(1000).queue(function(){ 
			});
			$("#password .input.password input").attr("value", "").focus();
		} else {
			/**
			 * AJAX call to login the user
			 */
				var username = document.getElementById("username");
				var password = document.getElementById("pass");

				var data = {
                    'data[User][username]': username.value,
                    'data[User][password]': password.value
                }

                $.ajax({
					type: "POST",
					url: "verify/",
					data:  data,
					dataType: "json",
					success: function(response) {
						// Response was a success
						if (response.success) {
							document.location.href = "redirection/";
						// Response contains errors
						} else {
							$("#password").removeClass().addClass("animated wobble").delay(1000).queue(function(){ 
							});
							$.notification({
								title: "Datos Incorrectos",
								content: "Revise sus datos para continuar",
								icon: "!",
								error: true
							});
						}
					}
				});
				return false;
			}
	}
};

$.initializeReset = function() {
	// Update
	if ($.browser.msie  && parseInt($.browser.version, 10) === 8) {
		// IE8 doesn't like HTML!
	} 
	// Adding overlay to the body
	$("body").addClass("welcome").append('<div id="overlays"></div>');

	$.notification( 
		{
			title: "Recuperar contraseña.",
			content: "¡Ingrese la Nueva Contraseña!",
			img: "../../img/logo-notification.png",
			border: false,
			timeout: false,
			showTime: false
		}
	);

	$("#forgot").addClass("animated flipInY").show();
	$("#forgot .forEmail.first input").focus();
	
	
	$("#forgot .forEmail.second input").keyup(function(event) {
		if (event.which == 13) {
			forgotpwd();
		}
	});

	$("#btnRecover").bind("click tap", function() {
		forgotpwd();
	});

	function forgotpwd() {
		if($("#forgot .forEmail.first input").attr("value")=='' || $("#forgot .forEmail.second input").attr("value")=='') {
			$.notification( 
				{
					title: "Datos Incompletos",
					content: "Debe completar ambos campos para continuar",
					icon: "!"
				}
			);
			$("#forgot").removeClass().addClass("animated wobble").delay(1000).queue(function(){});
		} else {
			if($("#forgot .forEmail.first input").attr("value") != $("#forgot .forEmail.second input").attr("value")) {
				$.notification( 
					{
						title: "Datos Incorrectos",
						content: "Las Contraseñas ingresadas son diferentes",
						icon: "!"
					}
				);
				$("#forgot").removeClass().addClass("animated wobble").delay(1000).queue(function(){});
			} else {
				/**
				 * AJAX call to change the user password
				 */
				var password = document.getElementById("pass1");
				var token = document.getElementById("token");

				var data = {
                    'data[User][password]': password.value,
					'data[User][tokenhash]': token.value
                }
                
                $.ajax({
					type: "POST",
					url: "../changePwd/",
					data:  data,
					dataType: "json",
					success: function(response) {
						// Response was a success
						if (response.success) {
							document.location.href = "../login/success";
						// Response contains errors
						} else {
							$("#password").removeClass().addClass("animated wobble").delay(1000).queue(function(){ 
							});
							$.notification({
								title: "Ocurrio un error",
								content: "Actualice la página e intente nuevamente",
								icon: "!",
								error: true
							});
						}
					}
				});
				return false;
			}
		}
	}	
};



$(document).ready(function() {
	var url = window.location.pathname.split("/");
    var lastUrl = url[url.length - 2];
    var lastUrl1 = url[url.length - 1];
    if(lastUrl == 'reset'){$.initializeReset();} else {$.initializeLogin();}
});