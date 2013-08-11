Interactive tables
==================

Pastel uses the Tablesorter plugin written by Christian Bach. I did however modify the pagination plugin quite heavily.
It's initialized automatically in the demo like this:

	$("table")
	.table()
	.pagination()

In most cases that's enough! Now you can dynamically sort through large data tables with pagination enabled.

If you want to sort a row in a certain way where the default initialization just doesn't suffice. Visit the [plugin's site](http://tablesorter.com/docs/index.html#Examples). 

As noted before I modified the pagination plugin a lot, it is vastly different from the original, as you don't need to provide a container for the pagination and dots are used to identify different pages. A quick note: If the default dots pagination is too simple, you can enable a more complete set of controls with the parameter _extended_ like this:

	$("table")
	.table()	
	.pagination({extended: true})

Really simple, right?