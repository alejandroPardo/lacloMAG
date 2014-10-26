<?php echo '!!!COVER!!!'.$idCover;?>
<?php echo '!!!COVER!!!'.$cover.'!!!COVER!!!';?>
<?php $index=0;
	foreach ($papers as $paper) {
		echo '<div class="title"><h2>'.$magazinePapers[$index]["Paper"]["name"].'</h2></div>';
		echo '<div class="redactor_box redactor_editor" style="margin-right:50px; margin-left:50px;">'.$paper.'</div>';
		echo '<em style="margin-left:50px;"> Creado Por: '.$magazinePapers[$index]["Paper"]["PaperAuthor"]['0']['Author']['User']['first_name'].' '.$magazinePapers[$index]["Paper"]["PaperAuthor"]['0']['Author']['User']['last_name'].'</em>';
		$index++;
		echo '<div class="page-break"></div>';
	}
	echo "<div class='cover' style='background: #59B7FF !important;'><br/>
					<h3 style='color:#FFFFFF !important;'>No. 1 | Enero - Junio 2014</h3><br/>
					<img src='/laclomag/img/bannercover.jpg'><h1 style='color:#FFFFFF 
					!important;'>Ejemplar Inicial</h1><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<h2 style='color:#FFFFFF !important;'>Este es el primer ejemplar de LACLOmagazine</h2></div>";
?>