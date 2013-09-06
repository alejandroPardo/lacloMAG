<a id="Media"></a>
<div class="contentsection yellow clearfix s2">
	<div class="content">
		<h2><?php echo $headline;?> </h2>
		<p><?php echo $summary;?> <img class="flashing" src="img/stripe.gif" alt=""></p>
		
		<div id="projects" class="clearfix">
			<?php echo $content;?> 
		</div>
		<?php if($video != ''){
			echo '<div class="videoplayer">
			<iframe src="http://player.vimeo.com/video/37410423" width="1000" height="570"></iframe>
		</div>	';
		}?>
		
	</div>
</div>