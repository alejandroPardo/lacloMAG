<?php

$cakeDescription = __d('LACLOmag', 'LACLO Magazine - Backend');
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
		echo $this->Html->script('login');
		echo $this->Html->script('app');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->Js->writeBuffer(); // Write cached scripts ?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
