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
		echo $this->Html->css('app');

		echo $this->Html->script('library');
		echo $this->Html->script('initialize');
		echo $this->Html->script('app');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<?php echo $this->fetch('content'); ?>
</html>
