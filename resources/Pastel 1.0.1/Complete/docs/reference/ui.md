UI elements
===========

Color palettes
--------------
Pastel includes a few CSS color classes, which can be used on things such as cartons, input fields, chat boxes etc. Included colors: (and their classes)

<span class="color submarine">submarine</span>
<span class="color dust">dust</span>
<span class="color rust">rust</span>
<span class="color prettybaby">prettybaby</span>
<span class="color paris">paris</span>
<span class="color orangeblur">orangeblur</span>
<span class="color redconfetti">redconfetti</span>
<span class="color sugar">sugar</span>
<span class="color rushhour">rushhour</span>
<span class="color sunlit">sunlit</span>
<span class="color sea">sea</span>
<span class="color green">green</span>
<span class="color sail">sail</span>
<span class="color adrift">adrift</span>
<span class="color red">red</span>
<span class="color purple">purple</span>
<span class="color blue">blue</span>
<span class="color turkish">turkish</span>
<span class="color lime">lime</span>
<span class="color lightgrey">lightgrey</span>
<span class="color grey">grey</span>
<span class="color darkgrey">darkgrey</span>
<span class="color noir">noir</span>
<span class="color overcast">overcast</span>
<span class="color liquid">liquid</span>
<span class="color peach">peach</span>


Layered lists
-------------

Supported on every _modern_ browser. On WebKit browsers such as Chrome + Safari and newest Firefox version, a very nice 3D animation will be revealed.

If you use the default Pastel scripts, just add this to your markup:

	<ul>
		<li class="layer">
			<ul>
				<li class="todo unchecked">Clean up site structure</li>
				<li>The Alternative Dimension</li>
			</ul>
		</li>
		<li class="layer">
			<ul>
				<li class="todo checked">Create something useful and pretty</li>
				<li>Layer 2</li>
			</ul>
		</li>
		<li class="layer">
			<ul>
				<li class="todo unchecked">Laugh of a Norwegian</li>
				<li>Layer 2</li>
			</ul>
		</li>
		<li class="layer">
			<ul>
				<li class="todo unchecked">Make Pastel fantastic</li>
				<li>Layer 2</li>
			</ul>
		</li>
		<li class="layer">
			<ul>
				<li class="todo checked">Integrate all the charts</li>
				<li>Layer 2</li>
			</ul>
		</li>									
	</ul>
 
First a ul->li->ul --> li (layer 1) & li (layer 2.)

Add the class todo (and either checked or unchecked) if you want it to function like a to-do list. The JS will toggle and animate automatically.

Checkboxes
----------

Checkboxes will be replaced by an iOS-like toggle. The Pastel javascript will automatically replace every checkbox when the document initialize. If you want to change that behavior or need to call it after the document is ready you can simple do it like this:

	$("#checkbox").checkbox();

Make sure this is included in your javascript so the toggle will work:

	$(".checkbox input").change(function () {
		$(this).parents("span").toggleClass("checked");
	});

_Note: Remember it's included, so unless you have deleted it, no need to worry._

The HTML markup for a checkbox:

	<input type="checkbox" />

Yeah that's pretty straightforward? If you want to use a certain color or style, just apply the classes you want to use:

	<input type="checkbox" class="darkgrey rounded" checked />

The _.rounded_-class provides a rounded checkbox.


Progress Bars
------------
The included progress bars are very lightweight (only CSS!) - but can of course be manipulated by javascript. 

A progress bar:

	<span class="progress-bar stripes">
	    <span class="green"></span>
	</span>
Notice the class _.stribes_, which adds animated stribes.

Here's one with a different color and width:

	<span class="progress-bar stripes">
	    <span class="sail" style="width: 60%"></span>
	</span>

And last, a rounded progress bar. Notice the class _.round_.

	<span class="progress-bar stripes round">
	    <span class="adrift"></span>
	</span>



Input fields
------------
Input fields are styled automatically. Just include an input field in your HTML:

	<input type="text" placeholder="Username" />

Every input field will fill 100% of its parent's width. If you wish to put two input fields onto one line and make the space between them seamless, apply this markup:

	<p class="combine">
		<input type="text" placeholder="First name" />
		<input type="text" placeholder="Last name" />
	</p>


Searchable selection
--------------------
Pastel includes the plugin _Chosen_ written by Harvest. It transforms any select box into a searchable and custom (CSS-styled) select box. Initialize it like this:

HTML:

	<select>
		<option>Paris</option>
		<option>Copenhagen</option>
		<option selected="selected">Berlin</option>
		<option>Amsterdam</option>
	</select>

Javascript:

	$("select").chosen();


Chat boxes
----------

To create the iPhone-like chat bubbles from the demo simply apply this markup:

	<div class="com-con grey">
		<div class="comment">
		      <p>Hey. Copenhagen any good?</p>
		      <div class="avatar">
		      	<img src="http://mediacdn.disqus.com/uploads/users/404/5006/avatar92.jpg?1282753103" alt="avatar" />
		      </div>
		 </div>
		 <div class="byline"><strong>Jacques</strong> 4 days ago</div>
	</div>
	<div class="com-con right sunlit">
		<div class="comment">
		     <p>You did not just create this comment with the magic of ajax?</p>
		     <div class="avatar">
		     	<img src="https://twimg0-a.akamaihd.net/profile_images/1413825800/249936_10150196488184570_702004569_6768906_3999746_n.jpg" alt="avatar" />
		     </div>
		</div>
		<div class="byline"><strong>You</strong> An hour ago</div>
	</div>
	
Want to place a comment on the right? Apply the _.right_-class. The javascript will automatically replace img-tags and style it with CSS.


Tags
----
Tags is a plugin by XOXCO, which can turn any input field into a tags container. Every tag separated by comma or enter will turn into a small beautiful tags. The best part? Incredibly easy to use:

Input field on HTML page:

	<input id="tags" type="text" value="ipad,apple,stock" />

Javscript:

	$("#tags").tags();

Boom! That's it! 

But there's more! You can even add an autocomplete url like this:

	$("#tags").tags(
		{
		  autocomplete_url:'http://myserver.com/api/autocomplete'
		}
	);

If you want to import predefined tags directly from javascript:

	$('#tags').importTags('rim,google,microsoft');

Add or remove a single tag:

	$('#tags').addTag('foo');
	$('#tags').removeTag('bar');

Reset tag list:

	$('#tags').importTags('');

Check if tag already exists: 

	if ($('#tags').tagExist('google')) { 
		// code goes here
	}

Example with every parameter enabled:

	$("#tags").tags(
		{
		   'autocomplete_url': url_to_autocomplete_api,
		   'autocomplete': { option: value, option: value},
		   'height':'100px',
		   'width':'300px',
		   'interactive':true,
		   'defaultText':'add a tag',
		   'onAddTag':callback_function,
		   'onRemoveTag':callback_function,
		   'onChange' : callback_function,
		   'removeWithBackspace' : true,
		   'minChars' : 0,
		   'maxChars' : 0 //if not provided there is no limit,
		   'placeholderColor' : '#666666'
		}
	);

Validator
---------
Pastel includes a lightweight validator plugin with the cute name Happy.js, written by Henrik Joreteg. Example from demo:

HTML:

	<form id="demo" class="content">
		<p class="combine">
			<input id="firstname" type="text" placeholder="First name" />
			<input type="text" placeholder="Last name" />
		</p>
		<p>
			<input id="username" type="text" placeholder="Username" />
		</p>
		<p>
			<input id="key" type="password" placeholder="Password" />
		</p>
		<input type="submit" value="Submit" />
	</form>

Javascript:

	$('form#demo').isHappy({
		fields: {
			'#firstname': {
			  required: true,
			  message: 'Might we at least inquire your first name?'
			},
			'#username': {
			  required: true,
			  message: 'A username is required'
			},
			'#key': {
			  required: true,
			  message: 'A password is required'
			}
		}
	});

It will only submit if every field validate. The [happy.js documentation](http://happyjs.com/):

File input
----------
File inputs are hard, if not impossible, to style. The file plugin by Scott Jehl makes it easy. Example:

HTML:

	<input type="file" name="file" data-text="Choose an <strong>avatar</strong>" />

Javascript:

	$('input[type="file"]').file();

Datepicker
----------
The datepicker plugin is written by Gautam Lad. It can turn any input field into a complete data picker. Very simple to use.

### Features

- forward and back navigation
- current date highlight
- restricting selection of dates outside of a range
- restricting selection of dates beyond N-days from start date
- restricting forward / backwards month navigation
- individual styles per date picker (in case you have multiples on one page)


### Installation / Usage

Include an input box in your HTML document:

    <input type="text" id="date" />


Initialize the plugin with no parameters:

	$("#date").date();

or with every parameter available:

    $("#date").date(
    {
        allowOld: false,
        startDate: new Date("September 5, 2011"),
        endDate: new Date("October 26, 2011"),
        onChange: function(target, newDate)
        {
            alert("You selected: " + newDate);
        }
    });
