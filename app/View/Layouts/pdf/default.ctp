<html>
<head>
	<link rel="stylesheet" type="text/css" href=<?php echo 'file:'.DS.DS.WWW_ROOT.'css'.DS.'app.css';?> />
	<link rel="stylesheet" type="text/css" href=<?php echo 'file:'.DS.DS.WWW_ROOT.'css'.DS.'redactor.css';?> />
	<script type="text/javascript" href=<?php echo 'file:'.DS.DS.WWW_ROOT.'js'.DS.'library.js';?>></script>
	<script type="text/javascript" href=<?php echo 'file:'.DS.DS.WWW_ROOT.'js'.DS.'redactor.js';?>></script>
</head>
<body>
	<div class="redactor_box redactor_editor" style='overflow:hidden;'>
		<?php echo $this->fetch('content');?>
	</div>
</body>
</html>