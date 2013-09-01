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
		echo $this->Html->css('frontend');

		echo $this->Html->script('library');
		echo $this->Html->script('easing');
		echo $this->Html->script('fancybox');
		echo $this->Html->script('sticky');
		echo $this->Html->script('modernizr');
		echo $this->Html->script('mousewheel');		
		echo $this->Html->script('frontend');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php echo $this->fetch('content'); ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
