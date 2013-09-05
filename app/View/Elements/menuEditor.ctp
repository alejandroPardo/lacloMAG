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
	echo $this->Html->link(
		'<span class="vector">C</span>
		<span class="title"><strong>Ver</strong> Artículos</span>
		<span class="desc"><strong>Artículos</strong> recibidos</span>',
	array(
		'controller' => 'backend', 
		'action' => 'viewArticlesEditor'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	if ($papersPreviews != 0) { 
		$paperMessage = 'class= "vector count" data-count="'.$papersPreviews.'"';
	} else { 
		$paperMessage = 'class="vector"';
	}
	echo $this->Html->link(
		'<span '.$paperMessage.'>=</span>
		<span class="title"><strong>Artículos</strong> pendientes</span>
		<span class="desc"><strong>Revisiones</strong>/Asignaciones</span>',
	array(
		'controller' => 'backend', 
		'action' => 'viewPendingArticlesEditor'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector">N</span>
		<span class="title"><strong>Proximo</strong> Ejemplar</span>
		<span class="desc"><strong>Revisar</strong>/actualizar</span>',
	array(
		'controller' => 'backend', 
		'action' => 'viewCurrentMagEditor'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector">L</span>
	<span class="title"><strong>Archivo</strong></span>
	<span class="desc"><strong>Antiguos</strong>/Otros</span>',
	array(
		'controller' => 'backend', 
		'action' => 'viewArticlesArchiveEditor'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>