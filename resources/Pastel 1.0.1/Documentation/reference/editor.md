Editor
======

All this documentation was written in Markdown. As described by John Gruber:

>	Markdown is a text-to-HTML conversion tool for web writers. Markdown allows you to write using an easy-to-read, easy-to-write plain text 	format, then convert it to structurally valid XHTML (or HTML).

It's a fantastic _language_ that's easy to use and understand, while still maintaing great readability. Something not true of most (if not all) WYSIWYG-editors out there. 

I created a wrapper plugin trying to bring the best from two worlds: 2-column editor with live preview:

1. **Column 1**: Edit raw source directly in a textarea with shortcuts for common tasks, such as bold and emphasized text, lists, blockquotes etc.
2. **Column 2**: Shows a live preview of the text with syntax highlighting.	 

It's based on three different plugins:

1. [JQuery-Wysiwym](http://pushingkarma.com/projects/jquery-wysiwym/) - supports Markdown, BBCode and Mediawiki. It can be used as a standalone plugin - check out the site for documentation if you don't want to use my editor plugin.
2. [Showdown](http://softwaremaniacs.org/playground/showdown-highlight/) - parses the Markdown syntax. 
3. [Prettify](http://code.google.com/p/google-code-prettify/) - syntax highlighting.

My small **$.editor**-plugin combines all the three plugins. It's very easy to use:

	$.editor("license.md", "#editor-textarea", "#editor-preview", undefined);

The first parameter specifies the url. In the second and third parameter you define where the textarea and live preview should be placed. You can pass a fourth parameter: _text_. If you have the content in a variable for instance and don't want to load an external site:

	var content = "**Hello**"
	$.editor(undefined, "#editor-textarea", "#editor-preview", content);

Just remember to set the url parameter to _undefined_.