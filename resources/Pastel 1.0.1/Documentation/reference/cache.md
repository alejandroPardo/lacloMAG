Update System
=============

Pastel is a true HTML5 offline application, which makes use of a cache manifest. That's exciting for three reasons:

1. Pastel works without an internet connection
2. Much improved page loads
3. Update notifications

It's supported by most desktop browsers (Chrome, Firefox, Safari, Opera etc.) and mobile browsers on both iOS and Android.
Beside caching every script, stylesheet and document, I've included a small update system, which is quite important. It can be hard to reset or delete offline caches. You should probably disable the manifest file while developing - but if you change something and want to update the app on the client site, simply load up the _cache.manifest_-file in the root:

	CACHE MANIFEST
	# Version 0.9.1
	(..)

Change the version number or something else. Doesn't matter, the cache.manifest should just be different from the last. 

That's really it. Pastel will listen for cache updates and even prompt the user with the built-in notifications. First to tell the user that a new cache is being downloaded and then prompt the user when the download is done, giving the option to reload the app. It's really easy.

Some servers doesn't serve the correct MIME type for the manifest files - so if you can't get the cache.manifest to work add an _.htaccess_ file to the root of the Pastel app with this content:

	AddType text/cache-manifest .manifest manifest
	<FilesMatch "\.(manifest)$">
	FileETag None
	<IfModule mod_headers.c>
	Header unset ETag
	Header set Cache-Control "max-age=0, no-cache, no-store, must-revalidate"
	Header set Pragma "no-cache"
	Header set Expires "Wed, 11 Jan 1984 05:00:00 GMT"
	</IfModule>
	</FilesMatch>

Some people have had problems with the way Firefox handles the cache manifest file. If you experience issues and need to support the browser, either turn of the manifest or configure your server.

