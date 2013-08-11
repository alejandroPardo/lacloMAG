iPhone app
==========

Even though Pastel has a responsive and fluid layout, that works fine on mobile devices, such as the iPhone - it is rather heavy. 
Because of that I decided to include a web application that meets the following criteria:

+ **Blazingly fast**: Not just quite fast. Really fast. And it is: Ready in 1-2 seconds after tap from home screen, even available offline!
+ **Beautiful UI**: Should look and behave exactly like a native application. I included some beautiful and subtle textures and cool gestures. Apple introduced momentum scrolling in web apps with iOS 5. The web app simply feels native.
+ **Feature focused**: Pastel itself is large, I decided to port a few features from the desktop dashboard to iPhone, such as charts, maps, chat bubbles and to-do list (with 3D animations).

Setup
-----

It's really easy. Use the included demo or make your own:

	<!DOCTYPE html>
	<html lang="en" manifest="cache.manifest">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<title>Dashboard</title>
		<link rel="stylesheet" href="../static/stylesheets/iphone.css">
		<link rel="apple-touch-icon-precomposed" href="../static/images/icon@2x.png" />
		<link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="../static/images/retina_splash.png" />
		<script src="../static/scripts/library.js"></script>
		<script src="../static/scripts/iphone.js"></script>
	</head>
	<body>
		<section id="app">
			<div id="toolbar">
				<h2>Dashboard</h2>
				<a id="update" class="button disabled">Update</a>
				<a class="button right" href="#about">About</a>
			</div>
			<div id="scroll">
				<section id="home" class="current">
					Section One
				</section>
				<section id="two" class="current">
					Section Two
				</section>
			</div>
			<div id="bottom">
				<a href="#home" class="active">Dashboard</a>
				<a href="#maps" data-scroll="translucent">Maps</a>
				<a href="#chat">Chat</a>
				<a href="#todo">To-do</a>
			</div>
			<div id="modals">
				<section id="about">Another <strong>view</strong></section>
			</div>
		</section>
	</body>
	</html>
	
Everything explained:

+ Meta tags to set user zooming (important when fixed elements are present), black status bar and own wrapper on the homescreen. 
+ One stylesheet (_iphone.css_) is imported together with the app icon and a splash image.
+ Two javascript files - the library and the Pastel dashboard doing it's magic. 

Everything placed in the _#modals_-div will not be visible, but can simply be called with a normal link:

	<a href="#about">Tap here</a>

The cache manifest is included, which makes the application ready in a very short amount of time. Read the chapter **Update System** to learn more about the cache manifest.

Support
-------

I've decided to only support iOS 5 for the moment. If I used some extra javascript to have support for proper scrolling on Android and older iOS devices - the performance would never be as good as Apple's native offerings. It does work on pretty much anything though, just don't expect the same performance as on iOS 5 (I've even tried it on Internet Explorer on Windows Phone 7.5 - works ok!). Still, the main dashboard  works fine on almost everything - and Pastel will automatically resize content to mobile browsers.