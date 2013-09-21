<?php echo $cover;?>
<?php $index=0;
	foreach ($papers as $paper) {
		echo '<div class="title"><h2>'.$magazinePapers[$index]["Paper"]["name"].'</h2></div>';
		echo '<div class="redactor_box redactor_editor" style="margin-right:50px; margin-left:50px;">'.$paper.'</div>';
		echo '<em style="margin-left:50px;"> Creado Por: '.$magazinePapers[$index]["Paper"]["PaperAuthor"]['0']['Author']['User']['first_name'].' '.$magazinePapers[$index]["Paper"]["PaperAuthor"]['0']['Author']['User']['last_name'].'</em>';
		$index++;
	}
?>