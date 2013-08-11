PASTEL 1.0.1
============

_This is a minor bug release_

Changelog
---------

1. FEATURE: Support for external links. Check the section _Navigation_ in the docs for more on how to easy implement them.
2. FEATURE: All-new file input plugin
	+ Much more lightweight than the previous
	+ Doesn't break when used with the validation plugin
3. BUGFIX: Documentation fixes
	+ You can now open the documentation **locally** on browsers that blocks ajax loading of local files (Chrome, Firefox etc.) Note: Only the seperate docs in the _Documentation_-folder will work locally. The docs in the Dashboard itself still requires uploading to a server (either on your own machine or on the internet). 
	+ Some minor documentation errors have been fixed. Added small paragraph on how to use external links in the section _Navigation_.
	
How to update
-------------

The following files have been updated:

scripts/app.js
scripts/initialize.js

stylesheets/app.css	

Can be found in the path: _Complete/static/

Just replace them with the old files. Have you made changes to any of the files, remember to save them and add your own modifications again afterwards.