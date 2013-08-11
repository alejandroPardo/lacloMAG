Error & info pages
==================

Sure you can easily notify a user with Pastel's notification plugin, but what if you don't want the notification to be unobtrusive? 

Well you'll like the <strong>$.info</strong>-plugin I wrote. It's based on the fantastic three.js library. As it's quite heavy it will only be loaded on-demand. Three.js renders a very cool 3D scene with some coloured particles. If three.js is deleted the error (or info) page will still be shown - it won't be as moving though.

This is enough to show a generic error page:


	$.info();
 

Options
-------

+ **icon**:		_"!"_ 					(string) 	- change the icon.
+ **type**:		_"Error"_ 				(string) 	- type of message. Eg. error or information.
+ **title**:	_"404"_ 				(string) 	- title of your error or information.
+ **desc**:		_"An error occourred"_	(string)	- set description of error or information.
+ **theme**:	_undefined_				(string)	- if set to "black" it'll be.. well black! Or use your own CSS class.


Complete example
-------

	$.info({
		icon: 	"N",
		type:	"Info",
		title:	"New message",
		desc:	"You've got a new message. Yep important enough to take all your screen estate!",
		theme:	"black"
	});