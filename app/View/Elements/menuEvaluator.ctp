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
		<span class="desc"><strong>Artículos</strong> asignados</span>',
	array(
		'controller' => 'backend', 
		'action' => 'articleEvaluator'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector">L</span>
		<span class="title"><strong>Aceptar</strong> revisiones</span>
		<span class="desc"><strong>Aceptar</strong>/rechazar</span>',
	array(
		'controller' => 'backend', 
		'action' => 'approvedEvaluator'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector count" data-count="7">=</span>
	<span class="title"><strong>Artículos</strong> pendientes</span>
	<span class="desc"><strong>Revisiones</strong>/Aprovaciones</span>',
	array(
		'controller' => 'backend', 
		'action' => 'pendingEvaluator'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
<?php 
	echo $this->Html->link(
		'<span class="vector">N</span>
		<span class="title"><strong>Artículos</strong> corregidos</span>
		<span class="desc"><strong>Comentarios</strong>/aprovaciones</span>',
	array(
		'controller' => 'backend', 
		'action' => 'currentEvaluator'),
	array( 
		'class' =>'tile',
		'rel' => 'external', 
		'escape'=> false)
	);
?>
