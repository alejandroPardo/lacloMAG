<?php echo $cover;?>
<?php foreach ($papers as $paper) {
	echo strlen($paper);
	echo '<div class="redactor_box redactor_editor" style="margin: 10 10 10 10;">'./*substr($paper, 0, 2800)*/$paper.'</div>';
}?>