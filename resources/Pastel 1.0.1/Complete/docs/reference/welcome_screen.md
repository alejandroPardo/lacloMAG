Welcome screen
==============

While Pastel's _cartons_ are a great way to organize content in a quick manner, I felt that a good dashboard needed a proper Welcome screen with a overview of events/stats and big headings - while retaining a simple look.

If you want to recreate the Welcome Screen from the demo page - here's a barebone example and a complete one just beneath:

	<div class="row widgets">
	
		<div class="col thirty pin">
			<div class="content">
				<div class="heading">
					<h4><span>Thin</span> header</h4>
					<span>Description</span>
				</div>
				<div class="wrapper">
					<!--Content-->
				</div>
			</div>
		</div>
		
		<div class="col thirty">
			<div class="content">
				<div class="heading">
					<h4><span>Thin</span> header</h4>
					<span>Description</span>
				</div>
				<div class="wrapper">
					<!--Content-->
				</div>
			</div>
		</div>
		
		<div class="col fourty last">
			<div class="content">
				<div class="heading">
					<h4><span>Thin</span> header</h4>
					<span>Description</span>
				</div>
				<div class="wrapper">
					<!--Content-->
				</div>
			</div>
		</div>
	
	</div>

You can use the classes _.thirty_, _.quarter_, _.seventyfive_, _.half_, _.twenty_, _.fourty_, _.sixty_ and _.full_. Of course you can create more if you need to. Remember to add the class _.last_ to the last column, otherwise the layout will break. If you add the class _.pin_ a nice eye-graphic will appear. The two divs wrapped in the _.content_-div: *.heading* and *.wrapper* stores headers and the content. 

For instance I created a CSS3 orbit chart (mostly for fun), a chart and a todo list. You can see the markup of that just below. Be creative, but try not to make too many columns as that can quickly clutter the initial experience.


Complete code
-------------

	<div class="row widgets">
		<div class="col thirty pin">
			<div class="content">
				<div class="heading">
					<h4><span>Right</span> now?</h4>
					<span>Realtime analytics (demo only)</span>
				</div>
				<div class="wrapper">
					<ul class="orbit-chart animated flipInX">
						<li class="one"><span><a href="#"></a></span></li>
						<li class="two"><span><a href="#"></a></span></li>
						<li class="three"><span><a href="#"></a></span></li>
						<li class="four"><span><a href="#"></a></span></li>
					</ul>
				</div>
			</div>
		</div>
		<div id="graph" class="col thirty">
			<div class="content">
				<div class="heading">
					<h4><span>Past</span> week</h4>
					<span>Realtime analytics (demo only)</span>
				</div>
				<div class="wrapper padding">
					<div id="chart1"></div>
				</div>
			</div>
		</div>
		<div id="tasks" class="col fourty last">
			<div class="content">
				<div class="heading">
					<h4><span>To-do</span> list</h4>
					<span>There's a third dimension</span>
				</div>
				<div class="wrapper" style="left: 1px; right: 1px; top: 141px; bottom: 0px;">
					<ul>
						<li class="layer">
							<ul>
								<li class="todo unchecked" style="background-color: #dee9e9; color: #7d8586;">Clean up site structure</li>
								<li>The Alternative Dimension</li>
							</ul>
						</li>
						<li class="layer">
							<ul>
								<li class="todo checked" style="background-color: #d7e3e3">Create something useful and pretty</li>
								<li>Layer 2</li>
							</ul>
						</li>
						<li class="layer">
							<ul>
								<li class="todo unchecked" style="background-color: #bfcccc">Laugh of a Norwegian</li>
								<li>Layer 2</li>
							</ul>
						</li>
						<li class="layer">
							<ul>
								<li class="todo unchecked" style="background-color: #a7b3b3">Make Pastel fantastic</li>
								<li>Layer 2</li>
							</ul>
						</li>
						<li class="layer">
							<ul>
								<li class="todo checked" style="background-color: #8e9898">Integrate all the charts</li>
								<li>Layer 2</li>
							</ul>
						</li>									
					</ul>
				</div>
			</div>
		</div>
	</div>