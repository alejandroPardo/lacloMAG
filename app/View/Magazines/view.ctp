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
	<?php $index=0;
		foreach ($papers as $paper) {
			echo '<div class="title" style="margin-top:20px; margin-bottom:20px;"><h2>'.$magazinePapers[$index]["Paper"]["name"].'</h2></div>';
			echo '<div class="redactor_box redactor_editor" style="margin: 10px 10px 10px 10px;">'./*substr($paper, 0, 2800)*/$paper.'</div>';
			$index++;
		}
	?>
</body>
</html>