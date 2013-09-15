<html>
<head>
	<?php
		echo $this->Html->css('app');
		echo $this->Html->css('redactor');

		echo $this->Html->script('library');

		echo $this->Html->script('redactor');		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="redactor_box redactor_editor">
		<?php echo $htm;?>
	</div>
</body>
</html>