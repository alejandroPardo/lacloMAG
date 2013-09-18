<?php

$cakeDescription = __d('LACLOmag', 'LACLO Magazine');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->meta('viewport', null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0'),false);
		echo $this->Html->css('magazine');
		echo $this->Html->css('redactor');


		echo $this->Html->script('modernizr.custom');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('sql_dump'); ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<?php
		
		echo $this->Html->script('mousewheel');
		echo $this->Html->script('jscrollpane');
		echo $this->Html->script('custom');
		echo $this->Html->script('bookblock');		
		echo $this->Html->script('page');

		echo $this->fetch('script');
	?>
	<script>
			$(function() {

				Page.init();

			});
	</script>
</body>
</html>