Navigation
==========

Pastel includes a fast navigation system, which is very easy to use.
In **Getting Started** you created your very first section. A section can in theory be placed anywhere on the page. The sections are mostly how one would navigate between different pages in the Dashboard. You have the Dashboard view:

	<div id="dashboard">
		<div class="scroll con">
			<!--Dashboard view-->
		</div>
	</div>
	

Here's how to place three new sections in the that view:


	<div id="dashboard">
		<div class="scroll con">
		
			<div class="section current" title="Section 1" id="section1">This is Section 1</div>
			<div class="section" title="Section 2" id="section3">This is Section 2</div>
			<div class="section" title="Section 3" id="section4">This is Section 3</div>
			
		</div>
	</div>

Notice how the first section has the class _current_. That's important to set, so the system knows where to navigate, if the URL bar doesn't contain a hash url. If a user opens the Dashboard with the hash **#section2**, that will be shown instead - no matter which section that has the _current_ class.

Now how would one navigate from a section to another? Well that's the best part, you simply link to a section like this:

	<a href="#section2">Click to go to Section 2</a>

Couldn't be much simpler. The javascript will take of the rest - if it's a invalid link a beautiful error page will be shown (see **Error pages** for more information.)

If you apply the attribute _data-reveal_ it will instead show something that's hidden. Consider this example with small popup box with the id _#popop_

	<a href="#popup" data-reveal>Click to show #popup</a>

When a user clicks the link, _#popup_ will simply show and not navigate away from whatever section that's active.

Modals
------
If you want to create a simple modal window just use the _data-modal_ attribute like this:

	<a href="#somecontent" data-modal>Click to show modal</a>

A modal will appear instantly with the content of the linked element. 

If you want to load an external page in a modal, well just link to it. Keep in mind you have to be on the same domain:

	<a href="files/ajax.html" data-modal>Click to show modal with external content</a>

For more advanced options please read the **Modals**-section.

Tabs
----
If you want to have a sub-navigation system in a section (just like the documentation page) - Pastel can automatically create tabs:

	<div class="section padding" title="Section 2 (Tabs demo)" id="section2">
		<ul class="tabs">
			<li class="current">
				<a href="#tab_one">Name of tab 1</a>
			</li>
			<li>
				<a href="#tab_two">Name of tab 2</a>
			</li>
		</ul>
		<div class="tabs">
			<div id="tab_one" class="tab">Content of tab 1</div>
			<div id="tab_two" class="tab">Content of tab 2</div>
		</div>
	</div>

Notice the added _padding_ class to the section - that will remove a section's default 40px padding. Not needed of course. Otherwise everything is simply straight forward. Create a unordered list (_ul_) with all the tabs you need and remember to apply the class _.current_ to the default tab. Then wrap all your tabs (with the class _.tab_) in a div with the class _.tabs_. It doesn't matter if you place the tabs in the same order as the list itself.

External links
--------------
_New in Pastel 1.0.1_

I can't believe I forgot that in the initial release, but now it's very easy to link to something _outside_ the application (a PHP page for instance.) Just add _rel="external"_ to your link:

	<a href="http://example.com" rel="external">Click</a>
