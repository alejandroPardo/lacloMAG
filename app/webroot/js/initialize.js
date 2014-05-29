$.initialize = function() {
	// --------------- Overlay initialization ----------------
	$("body").append('<div id="overlays"></div>');
	$("#overlays").on("click", function() {
		$(this).removeClass("dark");
		$("#overlays .modal").remove();
	});
	
	
	// -------------------------------------------------------
		
	// Update
	if ($.browser.msie  && parseInt($.browser.version, 10) === 8) {
		// IE8 doesn't like HTML!
	} else {
		window.addEventListener("load", function (a) {
		    window.applicationCache.addEventListener("updateready", function (a) {
		        if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
		            window.applicationCache.swapCache();
		            
		            $.notification( 
		            	{
		            		title: 'An update has been installed!',
		            		content: 'Click here to reload.',
		            		icon: "u",
		            		click: function() {
		            			window.location.reload();
		            		}
		            	}
		            );
		            
		        }
		    }, false);
	    
		    window.applicationCache.addEventListener("downloading", function (a) {
		        if (window.applicationCache.status == window.applicationCache.DOWNLOADING) {
		    		$.notification( 
		    			{
		    				title: 'Latest version is being cached',
		    				content: 'Only takes a few seconds.',
		    				icon: "H"
		    			}
		    		);
		    	}
		    }, false);
	
		}, false);
	}
	
	// --------------- Navigation ----------------------------
	$('a').bind("click tap", function(e) {
		if($(this).attr("rel") != "external") {
			if(!$(this).data("href")) {
				return false;
			}
			var element = $( $(this).data("href") );
			if(!$(this).parents("ul.tabs").length>0) {
				if ($(this).data("href").charAt( 0 ) == '#' ) {
					if( $(this).hasAttr('data-reveal') ) {
						if( element.is(":hidden") ) {
							element.fadeIn(200);
						} else {
							element.fadeOut(200);
						}	
					} else if ( $(this).hasAttr('data-modal') ) {
						if(element.size()>0) {
							element.modal();
						} else {
							$.info({desc: "The hash <strong>"+$(this).data("href")+"</strong> is not valid"});
						}
					}
				} else {
					if ( $(this).hasAttr('data-modal') ) {
						$.fn.modal(
							{
								url: $(this).data("href")
							}
						);
					}
				}
			} else {
				var tab = $("div.tabs > " + $(this).data("href"));
				if(tab.length>0) {
					$(this).parents("ul.tabs, .section").children("div.tabs").children(".tab.current").removeClass("current");
					$(this).parents("ul.tabs, .section").children("div.tabs").children($(this).data("href")).addClass("current");
					$(this).parents("ul.tabs").children("li.current").removeClass("current");
					$(this).parents("li").addClass("current");
				} else {
					$.info({desc: "The hash <strong>"+$(this).data("href")+"</strong> is not valid"});
				}
			}
			e.preventDefault();
		} else {
			if( $(this).attr('target') === '_blank' ) { 
				window.open($(this).attr("data-href"));
			} else { 
				window.location.href = $(this).attr("data-href");
			}
		}
	});
	// -------------------------------------------------------
	
	
	// --------------- Add class to body ---------------
	$("body").addClass("dashboard");
	// -------------------------------------------------------


	// --------------- Span image replace --------------------
	$("#header ul li > ul > li > img.avatar").each(function() {
		$(this).replaceWith( $('<span />').addClass("avatar").css("background-image", "url("+$(this).attr("src")+")") );
	});
	$("#header ul li.avatar, .comment .avatar").each(function() {
		var src = $(this).children("img").attr("src");
		$(this).children("img").remove();
		$(this).css("background-image", "url("+src+")");
	});
	// -------------------------------------------------------
	
	
	// --------------- Checkbox toggle replace ---------------
	$("input:checkbox").each(function () {
		$(this).checkbox();
	});
	
	$(".checkbox input").change(function () {
		$(this).parents("span").toggleClass("checked");
	});
	// -------------------------------------------------------
	
	
	// --------------- File input replace --------------------
	$('input[type="file"]').file();
	// -------------------------------------------------------
	
	
	// --------------- Tabs in carton ------------------------
	$(".carton, .carton .column").each(function() {
		if($(this).children(".content").length>1) {
			var len = $(this).children(".content").length;
			$(this).addClass("multiple");
			$(this).children(".content:first").addClass("current");
			
			var round = $('<ul class="round" />');
			
			for (var i = 0; i < len; i++) {
				$('<li />').appendTo(round);
			}
			
			round.children("li:first").addClass("current");
			
			$('ul.round li', this).live("tap", function() {
				var index = $(this).index();
				var carton = $(this).parent("ul").parent();
				
				carton.children("ul").children("li.current").removeClass("current");
				$(this).addClass("current");
				
				carton.children(".content.current").removeClass("current");
				carton.children(".content").eq(index).addClass("current");
			})
			
			$(this).append(round);
		}
	});
	// -------------------------------------------------------
	
	
	// --------------- Select replace ------------------------
	$("select").chosen();
	// -------------------------------------------------------
	
	
	// --------------- Menu elements -------------------------
	$("#header > ul > li").bind("click tap", function() {
		var menu = $(this).children("ul");
		$("#header").removeClass("inactive");
		
		if(menu.length>0) {
			$("#header > ul > li").removeClass("active");
			$(this).addClass("active");
			$("#header > ul > li > ul").not(menu).hide();
			$("#header").addClass("inactive");
			if(menu.is(":hidden")) {
				menu.show();
			} else {
				menu.hide();
				$(this).removeClass("active");
				$("#header").removeClass("inactive");
			} 	
			
		} else {
			$("#header > ul > li > ul").hide();
			$("#header").removeClass("inactive");
			$("#header > ul > li").removeClass("active");
		}
		return false;
	});
	$("body").bind("tap", function() {
		$("#header > ul > li > ul").hide();
		$("#header").removeClass("inactive");
		$("#header > ul > li").removeClass("active");
	});
	// -------------------------------------------------------
	
	
	// --------------- Removal of title attribute ------------
	$('[title]').attr('title', function(i, title) {
	    $(this).data('title', title).removeAttr('title');
	});
	
	$('a[href]').attr('href', function(i, title) {
		$(this).data('href', title).removeAttr('href').attr('data-href', title);
	});
	// -------------------------------------------------------
	
	
	// --------------- Tooltip initialization ----------------
	$(".tooltip").tooltip();
	// -------------------------------------------------------

	// --------------- Tabs initialization -------------------
	$("ul.tabs").each(function() {
		var hash = $(this).children("li.current").children("a").data("href");
		var tab = $(this).siblings("div.tabs").children(hash);
		if(tab.length>0) {
			tab.addClass("current");
		} else {
			tab = $(this).siblings("div.tabs").children("div.tab:first-child");
			href = "#" + tab.attr("id");
			$(this).children("li.current").removeClass("current");
			$('li a[data-href="'+href+'"]', this).parent("li").addClass("current");
			tab.addClass("current");
		}
	});
	// -------------------------------------------------------
	
	
	// --------------- Pull to refresh -----------------------
	/*if ($.browser.webkit && navigator.platform=='MacIntel') {
		var distance;
		var pulled = false;
		$('body').append('<div class="pull"><span class="icon">w</span><div>Pull <span>to refresh</span></div></div>');
		$(window).scroll(function () {
			if($(window).scrollTop() < 0) {
				distance = -$(window).scrollTop()*1.6;
				$("#stream").addClass("hide");
				if(distance < 2) {
					distance = 0;
					$("#stream").removeClass("hide");
					if(pulled){
						$(window).delay(2000);
						//location.reload();
					}
				}
				if(distance > 62) {
					$('.pull div').html('Release <span>to refresh</span>');
					$('.pull .icon').addClass('release');
					pulled = true;
				} else {
					$('.pull div').html('Pull <span> to refresh</span>');
					$('.pull .icon').removeClass('release');
				}
				
				if(distance > 300) {
					distance = 300;
				}
				
				$("#dashboard").css("-webkit-transform", "translateY("+distance+"px"+")");
			} else if ($(window).scrollTop() > 0) {
				$("#stream").removeClass("hide");
			} else {
				$("dashboard").css("-webkit-transform", "translateY(0)");
			}
		});
	}*/
	// -------------------------------------------------------
};

/********************************************
//
//
// FUNCIONES DE ADMIN BACKEND
//
/********************************************/


$.admin = function(lastUrl) {

	if(lastUrl == 'dashboard'){ // DASHBOARD DE AUTHOR
		/////// PIE CHART DEL HISTORIAL EN EL DASHBOARD
		var data = [];
		var series = Math.floor(Math.random()*7)+1;
		for( var i = 0; i<series; i++) {
			data[i] = { label: "Series"+(i+1), data: Math.floor(Math.random()*100)+1 }
		}
		
		$.plot($("#pie_chart"), data,
		{
		       series: {
		           pie: { 
		               show: true
		           }
		       }
		});
		/////// END PIECHART 

		//TO-DO DEL DASHBOARD CON LOS EFECTOS Y EL ALTERNATE DIMENSION
		$("li.layer > ul").bind("tap", function() {
			if( !$(this).hasClass("turn") ) {
				$("li.layer > ul.turn").addClass("back").delay(800).queue(function(){ 
					$(this).removeClass("turn");
					$(this).removeClass("back");
					$(this).clearQueue();
				});
				$(this).addClass("turn");
			} else {
				$(this).addClass("back").delay(800).queue(function(){ 
					$(this).removeClass("turn");
					$(this).removeClass("back");
					$(this).clearQueue();
				});
			}
		});
		$("li.todo").each(function() {
			$(this).prepend('<span class="box" />');
		});
		$("li.todo span").bind("tap", function() {
			if( !$(this).parent("li.todo").hasClass("unchecked") ) {
				$(this).parent("li.todo").removeClass("checked").addClass("unchecked");
			} else {
				$(this).parent("li.todo").removeClass("unchecked").addClass("checked");
			}
			return false;	
		});
		// TO-DO END

		
	}
};

/********************************************
//
//
// FUNCIONES GENERALES BACKEND
//
/********************************************/

$.general = function(lastUrl) {
	if (lastUrl == 'notifications') {
		$("table")
			.table()
			.pagination({extended: true});
	}
	$('#redactor_content').redactor({
		imageUpload: '../uploadImage'
	});
	$(".paginationTable")
		.table()
		.pagination({extended: true});
	//$(".noTableConf").table().pagination();
	// MODAL MESSAGES
	$("#modals message").bind("tap", function() {
		var attr = $(this).attr("data-function");
		var options;

		options =  { animation: "flipInX", theme: "dark", url: "newMessage" };
		
		$().modal(options);
	});
};

/********************************************
//
//
// FUNCIONES DE EDITOR BACKEND
//
/********************************************/


$.editor = function(lastUrl) {
	$('#redactor_content').redactor({
			imageUpload: '../uploadImage'
	});
};

function formBtnNews(){
	if($("#paper").attr("value")=='') {
		$.notification(
			{
				title: "Datos Incompletos",
				content: "Debe introducir un nombre y un resumen para la noticia.",
				icon: "!"
			}
		);
		event.preventDefault();
		return false;
	}
	return true;
}
/********************************************
//
//
// FUNCIONES DE AUTHOR BACKEND
//
/********************************************/


$.author = function(lastUrl) {
	if(lastUrl == 'author'){ // DASHBOARD DE AUTHOR
		
	} else if (lastUrl == 'createArticle') {
		
	} else if (lastUrl == 'pendingAuthor') {
		$("table")
			.table()
			.pagination({extended: true});
	} else if (lastUrl == 'articleAuthor') {
		$("table")
			.table()
			.pagination({extended: true});
	} else if (lastUrl == 'uploadArticle') {
		$("table")
			.table()
			.pagination({extended: true});
	}
};

function formBtn(){
	if($("#paper").attr("value")=='') {
		$.notification(
			{
				title: "Datos Incompletos",
				content: "Debe introducir un nombre para el paper.",
				icon: "!"
			}
		);
		event.preventDefault();
		return false;
	} 
	return true;
}

/********************************************
//
//
// FUNCIONES DE EVALUATOR BACKEND
//
/********************************************/


$.evaluator = function(lastUrl) {

	if(lastUrl == 'evaluator'){ // DASHBOARD DE AUTHOR
		
	} else if(lastUrl == 'articleEvaluator'){ // DASHBOARD DE AUTHOR
		$("table")
			.table()
			.pagination({extended: true});
	} else if(lastUrl == 'currentEvaluator'){ // DASHBOARD DE AUTHOR
		$("table")
			.table()
			.pagination({extended: true});
	} else if(lastUrl == 'pendingEvaluator'){ // DASHBOARD DE AUTHOR
		$("table")
			.table()
			.pagination({extended: true});
	} else if(lastUrl == 'approvedEvaluator'){ // DASHBOARD DE AUTHOR
		$("table")
			.table()
			.pagination({extended: true});
	} else {
		var url = window.location.pathname.split("/");
    	var lastUrl2 = url[url.length - 2];
    	if(lastUrl2 == 'evaluatePaper'){
    	}
		
	}

};


$(document).ready(function() {
	$.initialize();
	var url = window.location.pathname.split("/");
    var lastUrl = url[url.length - 1];
    var role = document.getElementById('role').value;

	$.general(lastUrl);

    if(role == 'Administrador'){
    	$.admin(lastUrl);
    } else if(role == 'Autor'){
    	$.author(lastUrl);
    } else if(role == 'Editor'){
    	$.editor(lastUrl);
    } else if(role == 'Evaluador'){
    	$.evaluator(lastUrl);
    }
});