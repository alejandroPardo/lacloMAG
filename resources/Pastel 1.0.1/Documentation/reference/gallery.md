Gallery
=======

The gallery plugin is based on Codrop's excellent montage plugin that arrange photos in elegant rows. I've made an easy to use wrapper. 

It's really simple:

	$.fn.gallery("montage.html");

The _montage.html_-file includes a lot of images like this:

	<img src="path/to/image1.png" />
	<img src="path/to/image2.png" />
	<img src="path/to/image3.png" />
	<img src="path/to/image4.png" />
	<img src="path/to/image5.png" />

Or you can get the content of an existing element:

	$("#image-con").gallery();
	
A list of every parameter that can be passed on to the function:

+ **liquid**	_true_		(boolean)	- if true the montage will fill the containers width on resize
+ **margin**:	_1_ 		(integer) 	- space between photos (in pixels).
+ **minw**:		_70_ 		(integer) 	- minimum width of a photo.
+ **minh**:		_20_ 		(integer) 	- minimum height of a photo.
+ **maxh**:		_250_		(integer)	- max height of a photo.
+ **alternateHeight**		_false_		(boolean)	- if set to true it will have priority over the parameter fixedHeight.
+ **alternateHeightRange**	_false_		(array)		- height will be a random value between 'min' and 'max'
+ **fixedHeight**			_null_ 		(integer)	- If the following value is set, this will have priority over defaults.minsize. All images will have this height.
+ **minsize**				_false_ 	(integer)	- Setting this value will make minw, minh irrelevant. Chosen height will be the one of the smallest image when this is set to true.
+ **fillLastRow**			_false_		(boolean)	- if true, there will be no gap in the end of the container. The last image will fill any white space left.

Complete example
----------------

	$.fn.gallery("montage.html", {
		liquid: 				true,
		margin: 				5,
		minw: 					20,
		minh: 					20,
		maxh: 					20,
		border:					false,
		alternateHeight:		false,
		alternateHeightRange:	{
		    						min : 100,
		    						max : 300
		    					},
		fixedHeight:			300,
		fillLastRow:			true
	})
