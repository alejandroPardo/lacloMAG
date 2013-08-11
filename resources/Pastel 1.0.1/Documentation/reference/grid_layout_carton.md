Layout, Grid & Cartons
======================
Even though the demo has a fixed width you can simply add the _.fluid_-class to the body-element - or change the global wrapper _.con_ in the stylesheet.

Grid
----

I've included a variation of the popular 960gs grid system. It's based on 12 columns, rock solid, fluid and will resize to whatever width the container has. Remember to check out the demo in the UI-section. First a basic example with three columns:

	<div class="container">
		<div class="col_4 alpha">
			Column with the width of 4 columns
		</div>
		<div class="col_2">
			Column with the width of 2 columns
		</div>
		<div class="col_6 omega">
			Column with the width of 6 columns
		</div>
	</div>

The _.container_ div is very important as it clears the floating elements. If you prefer the old fashion clear method with a separate element - go ahead! For the columns just use the _.col_-class with a suffix of how many columns it should fill. Remember to add the _.alpha_ and _.omega_ classes to the **first** and **last** column in every container. Alternatively you can use the CSS selectors __::first-child_ and _::last-child::. I didn't want to risk to break the layout in old browsers. The layout will be broken if you exceed more than 12 columns in total.

You can nest the columns as you please, for instance:

	<div class="container">
		<div class="col_4 alpha">
			<div class="col_3 alpha">1</div>
			<div class="col_3">2</div>
			<div class="col_3">3</div>
			<div class="col_3 omega">4</div>
		</div>
		<div class="col_2">
			<div class="col_6 alpha">1</div>
			<div class="col_6 omega">2</div>
		</div>
		<div class="col_6 omega">
			<div class="col_2 alpha">1</div>
			<div class="col_2">2</div>
			<div class="col_2">3</div>
			<div class="col_2">4</div>
			<div class="col_2">5</div>
			<div class="col_2 omega">6</div>
		</div>
	</div>

Everything in these columns will align up nicely - works as most grid systems. I have, however, added some very simple (but neat!) functionality:

Cartons
-------

Cartons give some basic style to your columns. You guessed it, that's not the cool part! Consider this simple markup:

	<div class="container">
		<div class="col_4 carton alpha">
			<div class="content">Content 1</div>
			<div class="content">Content 2</div>
			<div class="content">Content 3</div>
		</div>
		<div class="col_2 carton">
			<div class="content">Content 1</div>
			<div class="content">Content 2</div>
			<div class="content">Content 3</div>
		</div>
		<div class="col_6 carton omega">
			<div class="content">Content 1</div>
		</div>
	</div>

First notice how I've added the class _.carton_ to every column to give them some basic styling. Last, notice the columns' children. The class _.content_ is largely uninteresting as it only adds a 20px padding. But together with some javascript, magic appears! If there's more than one _.content_-div in a column, Pastel will automatically create some neat pagination so you can navigate between the _.content_-divs with some iOS-like dots. If there's only one _.content_-div (as in the last column) - it will be leaved untouched. You can even nest them infinitely, check out the crazy _Inception_-example in the UI-section.


If you want to add a heading to a carton just add a _H2_-heading like this:

	<div class="container">
		<div class="col_4 carton alpha">
			<h2>Heading</h2>
		</div>
	</div>

Check out the Cartons demo page for all the examples.