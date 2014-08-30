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
		<?php 
		echo '<div class="title"><h2>'.$title.'</h2></div>';
		echo '<div class="redactor_box redactor_editor" style="margin-right:50px; margin-left:50px;">'.$paper.'</div>';
		echo '<em style="margin-left:50px; color:black;"> Creado Por: '.$author.'</em>';
		?>
	</div>
</body>
</html>