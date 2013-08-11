Notifications
=============

Pastel includes a jQuery plugin based on my own Owl plugin (on sale on Codecanyon.)
It has a completely different look, better suited for administrator and dashboard interfaces.

The notifications are small, beautiful, unobtrusive and very flexible. They are a very important part of the interface as they communicate directly with the user, whether it's pure information or a fatal error. The notifications can be created anywhere in your Javascript. 

Examples
--------------
A simple notification without much fanfare:

	$.notification ( 
		{
			title: 		'Your First Notification',
			content: 	'Pretty cool, huh?'
		}
	)	
	
Easy to grasp, no? A default notification where no icon or image is specified will simply show a notification icon. That's very easy to change though:

	$.notification ( 
		{
			title: 		'Your Second Notification',
			content: 	'Pretty cool, huh?',
			img: 		'/path/to/image.png'
		}
	)
	

Or use the included icon font instead of a image:

	$.notification ( 
		{
			title: 		'Your Third Notification',
			content: 	'Pretty cool, huh?',
			icon: 		'N',
			color: 		'lightblue'
		}
	)

In this case a light blue maps icon will be shown. See the Icons page for a overview of the complete character map. The color can be specified in either HEX, rgb(a) or as in the example, color name.

If you want to create a callback function, when the user clicks a notification that's simply done by providing the _click_-option:

	$.notification ( 
		{
			title: 		'Your Fourth Notification',
			content: 	'Pretty cool, huh?',
			click: 		function() {
							alert('Created on callback!')
						}
		}
	)

Options
-------
Below is a overview of every single parameter that can be passed on to the notification plugin and what it does.

+ **title**:	_undefined_ (string) 	- provide the title of the notification.
+ **content**:	_undefined_ (string) 	- provide the content of the notification.
+ **timeout**:	_0_ 		(integer) 	- if you want the notification to destroy itself after a certain milliseconds.
+ **img**:		_undefined_	(string)	- provide path (relative or absolute) to the image.
+ **border**:	_true_		(boolean)	- if set to false, the border and shadow around the image will not be shown. Practical if you want to show a icon.
+ **fill**		_false_		(boolean)	- if set to true, the image will fill the entire left section of a notification. Nice effect with photos.
+ **showTime**	_false_		(boolean)	- if set to true, the notification will get a visible timestamp and update every fourth second.	
+ **click**		_undefined_	(function)	- if function is set, it will be called, when a user clicks the notification.
+ **icon**		_undefined_ (string)	- if set (and _img_ is not set) a vector icon will be shown. Use the character map.
+ **color**		_undefined_ (string)	- if set and an icon is present, the icon will be rendered in the specified color. Any CSS color will suffice, whether it's HEX, rgba(a), hsl(a) or CSS color names.
+ **error**		_undefined_	(boolean)	- if set to true, the notification will be red.

Complete example
----------------
Here's a complete example. Keep in mind that the specified icon never will be shown, as an image is present.

	$.notification ( 
		{
			title: 		'Your Fifth Notification',
			content: 	'Pretty cool, huh?',
			timeout: 	5000,
			img: 		'path/to/image.png',
			border: 	true,
			fill:		true,
			showTime:	true,
			click: 		function() {
							alert('Created on callback!')
						},
			icon:		'N',
			color:		'#333',
			error:		true
		}
	)