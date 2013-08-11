Getting started
===============

The live demo example is quite large and might be terrifying to some. To keep it as simple as possible, the docs will not recreate the entire demo in **one page**, but simply recreate every single feature separately in a clear manner. 

Most examples will require the app.js-file from the _Complete/static/scripts/_-folder.

In the folder _Examples_, most functions of Pastel are split into more manageable javascript-files, so you can customize your Dashboard to your preferences.

The structure of the file you've downloaded:

1. *Complete*: essentially the live demo with everything enabled. The app.js is large and not very handy to edit. That's why the following folder was included:
2. *Examples*: This folder contains a lot of examples. For instance if you don't need Markdown or charts support, why waste precious bandwidth? Good starting point if you want a simple overview of a single feature and want to customize the Dashboard to only your needs. **The folder _minimal_ inside _Examples_, contains the most barebone version of Pastel.**
3. *Documentation*: All the documentation in a lightweight HTML interface. 
4. *Misc*: Includes a layered PSD + screenshots of most of the interface.

Initialization
--------------
1. Open the folder _minimal_ inside _Examples_.
2. Create a new HTML-file - name it as you like. Or use index.html as a starting point.
2. If you want to follow the docs and have all features at hand, replace **base.js** with **app.js** from the _Complete/static/scripts/_-folder.
3. Include the necessary scripts and stylesheets:

		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<title>Dashboard</title>
			<link rel="stylesheet" href="static/stylesheets/app.css">
			<script src="static/scripts/library.js"></script>
			<script src="static/scripts/app.js"></script>
			<script src="static/scripts/initialize.js"></script>
		</head>

That's really everything you'll need (beside the body markup). Keep in mind that the app.js-file is **large** (>300 KB.) The base.js-file might suit your needs better, if you don't need every single feature. 

If you enable the **HTML5's cache manifest** from the demo, you can make the Dashboard initialize almost immediately and even make the entire _application_ available offline. Read the section **Update System** for more information.

Navigation menu
--------------
Now we can make the navigation appear. Include this code in your HTML-file and remember to add a **body**-tag:

	<div id="header">
		<ul class="con">
			<li class="dashboard">
				<a href="#home">Dashboard</a>
			</li>
			<li class="count indicator">
				<span data-count="8">Notifications</span>
			</li>
			<li class="messages">
				<span>Messages</span>
			</li>
			<li class="avatar">
				<img src="/path/to/avatar" alt="avatar" />
			</li>
			<li class="search">
				<input type="text" placeholder="Search" />
			</li>
		</ul>
	</div>
	
That snippet includes Home, Notification (with count and unread indicator), Messages, user avatar and a search input field. You don't have to add classes to every _li_-element. Only the first element _.dashboard_, _.avatar_ and _.search_ are needed if you want the default layout - of course they can be replaced by anything. What if you want to create drop down menus? Easy! Just add an extra unordered list to the menu item like this:

	<div id="header">
		<ul class="con">
			<li>
				<a href="#home">Menu 1</a>
				<ul>
					<li>
						<a href="#section">
							<h4>Menu item 1</h4>
							<p>Description</p>
						</a>
					</li>
					<li>
						<a href="#section2">
							<h4>Menu item 2</h4>
							<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>


Stream Bar
--------------
The Stream Bar is the shortcut interface. You can design it your own way entirely (or don't include it at all) - it's not required to get the Dashboard working. It's a nice indicator on where exactly you are and the big shortcuts tiles can be quite useful for common tasks. If you want to implement the demo interface, just include this markup:

	<div id="stream">
		<div class="con">
			<div class="tile" id="hello">
				<h2><span>Hi,</span> Jacques</h2>
				<p>You last visited <strong>two hours</strong> ago</p>
				<ul class="nav">
					<li>
						<a href="#home">*</a>
					</li>
					<li>
						<a href="#icons">8</a>
					</li>
					<li>
						<a href="#settings">!</a>
					</li>
					<li>
						<a href="#more">v</a>
					</li>
				</ul>
			</div>
			<a class="tile" href="#link-to-something">
				<span class="vector">C</span>
				<span class="title"><strong>New</strong> article</span>
				<span class="desc"><strong>Text</strong> editor</span>
			</a>
			<a class="tile" href="#link-to-something">
				<span class="vector">&amp;</span>
				<span class="title"><strong>UI</strong> elements</span>
				<span class="desc"><strong>Simply</strong> everything</span>
			</a>
			<a class="tile" href="#link-to-something">
				<span class="vector count" data-count="4">#</span>
				<span class="title"><strong>New</strong> comments</span>
				<span class="desc"><strong>Up from</strong> 68%</span>
			</a>
			<a class="tile" href="#link-to-something">
				<span class="vector">J</span>
				<span class="title"><strong>Non-IE</strong> users</span>
				<span class="desc"><strong>Up from</strong> 68%</span>
			</a>
			<a class="tile" href="#link-to-something">
				<span class="vector">N</span>
				<span class="title"><strong>Location</strong> sandbox</span>
				<span class="desc"><strong>Google Maps</strong> API</span>
			</a>
		</div>
	</div>
 
Even though it might look confusing, fear not - it's actually quite simple! The **only** element that makes the tiles (links) working are, not surprisingly, the _a_-elements. The rest is pure style. The first tile is not wrapped in an _a_-elemet, simply because it's not a link. It's there to great the user (_Hi, Jacques_ & _You last visited two hours ago_) and be the container of some links.

The icons are being created on-the-fly by the hosted icon font (read more in the **Icons** section.)

Dashboard View
--------------
Now we need to create the actual Dashboard view. Luckily it's dead simple. Just add this below the navigation and stream bar:

	<div id="dashboard">
		<div class="scroll con">
			<div class="section" title="Our First Section" id="first_section">
			</div>
		</div>
	</div>

I'll explain the navigation mechanisms in the next section. If you want to add a footer, the following markup will suffice:

	<div id="footer">
		<div class="con">
			<h4>Pastel</h4>
		</div>
	</div>


	
You have just created the Dashboard interface. I think you're getting started!

Complete markup
--------------
Here's the complete markup we created in the first chapter:

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Dashboard</title>
		<link rel="stylesheet" href="static/stylesheets/app.css">
		<script src="static/scripts/library.js"></script>
		<script src="static/scripts/app.js"></script>
		<script src="static/scripts/initialize.js"></script>
	</head>
	<body>
		<div id="header">
			<ul class="con">
				<li class="dashboard">
					<a href="#home">Dashboard</a>
				</li>
				<li class="count indicator">
					<span data-count="8">Notifications</span>
				</li>
				<li class="messages">
					<span>Messages</span>
				</li>
				<li class="avatar">
					<img src="/path/to/avatar" alt="avatar" />
				</li>
				<li class="search">
					<input type="text" placeholder="Search" />
				</li>
			</ul>
		</div>	
		
		<div id="stream">
			<div class="con">
				<div class="tile" id="hello">
					<h2><span>Hi,</span> Jacques</h2>
					<p>You last visited <strong>two hours</strong> ago</p>
					<ul class="nav">
						<li>
							<a href="#home">*</a>
						</li>
						<li>
							<a href="#icons">8</a>
						</li>
						<li>
							<a href="#settings">!</a>
						</li>
						<li>
							<a href="#more">v</a>
						</li>
					</ul>
				</div>
				<a class="tile" href="#link-to-something">
					<span class="vector">C</span>
					<span class="title"><strong>New</strong> article</span>
					<span class="desc"><strong>Text</strong> editor</span>
				</a>
				<a class="tile" href="#link-to-something">
					<span class="vector">&amp;</span>
					<span class="title"><strong>UI</strong> elements</span>
					<span class="desc"><strong>Simply</strong> everything</span>
				</a>
				<a class="tile" href="#link-to-something">
					<span class="vector count" data-count="4">#</span>
					<span class="title"><strong>New</strong> comments</span>
					<span class="desc"><strong>Up from</strong> 68%</span>
				</a>
				<a class="tile" href="#link-to-something">
					<span class="vector">J</span>
					<span class="title"><strong>Non-IE</strong> users</span>
					<span class="desc"><strong>Up from</strong> 68%</span>
				</a>
				<a class="tile" href="#link-to-something">
					<span class="vector">N</span>
					<span class="title"><strong>Location</strong> sandbox</span>
					<span class="desc"><strong>Google Maps</strong> API</span>
				</a>
			</div>
		</div>
		
		<div id="dashboard">
			<div class="scroll con">
				<div class="section" title="Our First Section" id="first_section">
				</div>
			</div>
		</div>
		
		<div id="footer">
			<div class="con">
				<h4>Pastel</h4>
			</div>
		</div>
	</body>
	</html>