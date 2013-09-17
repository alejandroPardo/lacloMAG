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
	<?php echo $cover;?>
	<?php foreach ($papers as $paper) {
		echo strlen($paper);
		echo '<div class="redactor_box redactor_editor" style="margin: 10 10 10 10;">'./*substr($paper, 0, 2800)*/$paper.'</div>';
	}?>
</body>
</html>