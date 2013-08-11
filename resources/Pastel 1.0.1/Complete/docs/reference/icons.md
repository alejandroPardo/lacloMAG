Icons
=====

Pastel uses the beautiful glyph set *iconSweets 2*, which is actually a commercial icon package. 
That's why the icons are not included (they can still be used though!) 

**See the Icon demo page for an interactive and complete character map.**

I've made an deal with the kind people of Yummygum (creator) so you can use them free of charge, under the following conditions:

1. Only for use with this project. 
2. Only when using the hosted font file. It is **not** allowed to download the font from my server.

Read the use license in the _LICENSE_-section. 

If you want to host it yourself, you can buy the very same bundle for [only **$8**](http://www.iconsweets2.com/). It includes sliced PNG-files, Photoshop shapes, **@font-face font** and a desktop font. It's a complete bargain. Strongly recommended. 

This service is provided as is - I can not guarantee the stability of the hosting.

How to use the icons
--------------------

While it's not a good practice semantically, you can simply write an icon's character inline like this:

	<span>}</span>

and in your stylesheet:

	span {
		font-family: Icons;
	}


Google (or any other search engine) will never crawl a closed Dashboard), but if you want to do it semantically, it's almost as easy:

	<span></span>

and in your stylesheet:

	span:before {
		content: "}"
		font-family: Icons;
	}

Icon set #2
---

I've included another glyph set, Entypo (licensed under CC BY-SA) which you can host yourself. The included glyphs are smaller than the iconSweets 2 glyphs though, which means you probably need to adjust the font-size a bit. 