Maps & Location
===============

While there's a lot of great Google Maps plugins out there, many of them are quite heavy. I wrote a small plugin, that uses the Google Maps Image API and return high resolution maps. As default the location will be showed in a modal, but you can get the HTML output if that's what you prefer.

Let's take a look on an example:

	$.fn.maps(
		{
			place: "magasin du nord, kongens nytorv, copenhagen",
			caption: "Magasin du Nord, <span>Copenhagen</span>"
		}
	);


The place parameter is quite flexible, just as the Google Maps service itself. In this case we search for a _famous_ department store at King's New Square (_Kongens Nytorv_) in the Danish capital.
We enable a caption, which automatically will be placed in the center of the map.

We can easily replace the place parameter with the user's current location, taking advantage of the HTML5 geolocation API - which works in most modern browsers (including IE9):


	$.fn.maps(
		{
			geo: true,
			caption: "Your current location"
		}
	);

If you want to apply the same map to an element instead of a modal:

	$("#somesection").maps(
		{
			geo: true,
			caption: "Your current location"
		}
	);

Just remember to set a height on the target element.

Options
-------

+ **coordinates**	_"55.680839,12.585955"_ (string)	- coordinates, if a place isn't defined.
+ **place**:		_undefined_ 			(string) 	- search for a place.
+ **texture**:		_false_					(boolean)	- whether a texture should be applied to the map or not.
+ **type**:			_"satellite"_ 			(string) 	- type of map: "satellite", "roadmap", "hybrid" and "terrain".
+ **zoom**:			_16_ 					(integer) 	- zoom level.
+ **marker**:		_true_					(boolean)	- insert marker.
+ **geo**:			_false_					(boolean)	- get current location.
+ **caption**:		_caption_				(string)	- caption the the marker.
+ **modal**			_{padding: 0, width: 1100, close: "light"}_ (array)	- change the modal's default settings.
+ **html**			_false_ 				(boolean)	- if set to true, the function will return the HTML.