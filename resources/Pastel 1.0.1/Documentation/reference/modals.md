Modals
======

I wrote a very lightweight modal script for use with Pastel - it's simple and beautiful.

To create a modal, use this snippet:

	$.fn.modal({
		url: "ajax.html"
	})

It will have the default theme, width, height and animation. 
Or you can simply pass an object like this:

	$("#modalcontent").modal();


Everything is easily changeable with the following parameters:

+ **theme**:	_"light"_ 	(string) 	- change the theme of the modal. Can be either: light, dark, blue or you own custom CSS class.
+ **width**:	_undefined_ (integer) 	- set a width. Don't add px or %.
+ **height**:	_undefined_ (integer) 	- set a width. Don't add px or %.
+ **layout**:	_undefined_	(string)	- if set to "elastic", the modal will be elastic. If not set every width and height will be in pixels.
+ **url**:		_undefined_	(string)	- load url into modal. Same domain only.
+ **content**	_false_		(string)	- if a object was not passed or an url not set, you can set your HTML content.
+ **padding**	_undefined_	(string)	- set padding of modal. This time remember px or %.
+ **animation**	_undefined_	(string)	- set CSS3 animation. See the Animations page for a full overview of available animations.

Complete example
----------------

	$.fn.modal({
		theme: 		"dark",
		width: 		80,
		height: 	40,
		layout: 	"elastic",
		url:		undefined,
		content:	"<strong>HTML</strong> content",
		padding:	"100px",
		animation:	"fadeInDown"
	})