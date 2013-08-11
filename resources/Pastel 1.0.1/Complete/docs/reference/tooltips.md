Tooltips
========

It's very easy to create a tooltip. Just apply the class _.tooltip_ to the element where you want the tooltip to appear and write the content of the tooltip in the title-attribute. Take this link (works on every element) for instance:

	<a href="#some-link" class="tooltip" title="This is a tooltip">A link with a tooltip</a>

It will probably suffice for most. The plugin will determine the most appropriate location itself.

If you need more control or just want to initialize everything from the javascript, you can do it like this:

	$(".tooltip").tooltip();

Options
-------
+ **activation**:		_"hover"_	(string) 	- determine how the tooltip should be activated. Can be set to either: hover, focus or click.
+ **maxWidth**:			_"240px"_	(string)	- the max width of the tooltip can be set. 		
+ **title**:			_false_		(string)	- if set a title will appear over the content.
+ **edgeOffset**:		_3_			(integer)	- set the edge offset of the tooltip.
+ **defaultPosition**:	_"bottom"_	(string) 	- change the default position. Options: bottom, top, left and right.
+ **delay**:			_0_ 		(integer) 	- Delay in milliseconds before the tooltip will show.
+ **fadeIn**:			_100_		(integer)	- fadeIn duration in milliseconds.
+ **fadeOut**:			_100_		(integer)	- fadeOut duration in milliseconds.
+ **attribute**:		_"title"_	(string)	- change the attribute of where the tooltip content can found.
+ **theme**:			_false_		(string)	- if set the parameter will be added as a class to the tooltip, allowing for easy CSS-styling.
+ **content**:			_false_		(string)	- provide the content directly without an attribute.
+ **enter**:			_undefined_	(function)	- if function is set, it will be called, when the tooltips appear.
+ **exit**:				_undefined_	(function)	- if function is set, it will be called, when the tooltips disappear. 

Complete example
----------------

	$(".tooltip").tooltip({
		activation:			"hover",
		maxWidth:			"340px",
		title:				"This is a title",
		edgeOffset:			20,
		defaultPosition: 	"right",
		delay:				100,
		fadeIn:				500,
		fadeOut:			500,
		attribute:			"data-tooltip",
		theme:				"blue",
		content:			"Sample <strong>content</strong>",
		enter:				function() {
								alert("Enter")
							},
		exit:				function() {
								alert("Exit")
							}
	});
