<?php 
	echo $this->Html->link(
		'<span class="vector">0</span>
		<span class="title"><strong>Dashboard</strong>/Inicio</span>
		<span class="desc"><strong>Volver</strong> al inicio</span>',
	array(
		'controller' => 'backend', 
		'action' => 'index'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	if ($papersPreviews != '0') { 
		$paperMessage = 'class= "vector count" data-count="'.$papersPreviews.'"';
	} else { 
		$paperMessage = 'class="vector"';
	}

	echo $this->Html->link(
		'<span '.$paperMessage.'>C</span>
		<span class="title"><strong>Crear</strong> artículo</span>
		<span class="desc"><strong>Nuevos</strong>/artículos</span>',
	array(
		'controller' => 'backend', 
		'action' => 'createArticle'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector">I</span>
		<span class="title"><strong>Subir</strong> artículo</span>
		<span class="desc"><strong>Archivo PDF</strong> solo texto</span>',
	array(
		'controller' => 'backend', 
		'action' => 'uploadArticle'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector count" data-count= '.$pendingArticles.' >=</span>
		<span class="title"><strong>Artículos</strong> pendientes</span>
		<span class="desc"><strong>Revisiones</strong>/Asignaciones</span>',
	array(
		'controller' => 'backend', 
		'action' => 'pendingAuthor'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector">N</span>
		<span class="title"><strong>Ver</strong> Artículos</span>
		<span class="desc"><strong>Artículos</strong> del usuario</span>',
	array(
		'controller' => 'backend', 
		'action' => 'articleAuthor'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>