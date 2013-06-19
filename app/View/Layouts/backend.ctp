<?php

$cakeDescription = __d('LACLOmag', 'LACLO Magazine');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('app');

		echo $this->Html->script('library');
		echo $this->Html->script('initialize');
		echo $this->Html->script('app');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="content">
			<div id="header">
				<ul class="con">
					<li class="dashboard">
						<a href="dashboard" rel='external' alt='Inicio'>I</a>
					</li>
					<li class="count indicator">
						<span data-count="0">Notificaciones</span>
						<ul>
							<li>
								<a href="../img/demo/ajax.html" data-modal>
									<h4>Implementar Notificaciones!!</h4>
									<p>Deberia abrir un modal con los eventos nuevos que haya</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="messages">
						<span>Mensajes</span>
						<ul>
							<li class="unread">
								<a href="../img/demo/ajax.html" data-modal>
									<img class="avatar" src="../img/avatar.jpg" alt="avatar" />
									<h4>Implementar Mensajes si vamos a hacerlos</h4>
									<p>No se que carajo sera</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="avatar">
						<img src="../img/avatar.jpg" alt="avatar" />
						<ul>
							<li>
								<a href="#">
									<h4><?php echo $fullName;?></h4>
									<p>Editar tu perfil</p>
								</a>
							</li>
							<li>
								<a href='logout' rel='external'>
									<h4>Desconectarse</h4>
									<p>Salir de la aplicación</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="search">
						<input type="text" placeholder="Buscar" />
						<ul>
							<li>
								<a href="#">
									<h4>Jens Alba</h4>
									<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
								</a>
							</li>
							<li>
								<a href="#">
									<h4>Jens Alba</h4>
									<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
								</a>
							</li>
							<li>
								<a href="#">
									<h4>Jens Alba</h4>
									<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div id="stream">
				<div class="con">
					<div class="tile" id="hello">
						<h2><span>Hola,</span> <br/><?php echo $firstName; ?> <br/><br/><span><?php echo $role; ?></span></h2>
					</div>

					<a class="tile" href="dashboard" rel='external'>
						<span class="vector">0</span>
						<span class="title"><strong>Dashboard</strong>/Inicio</span>
						<span class="desc"><strong>Volver</strong> al inicio</span>
					</a>
					<a class="tile" href="article" rel='external'>
						<span class="vector">C</span>
						<span class="title"><strong>Ver</strong> Artículos</span>
						<span class="desc"><strong>Artículos</strong> recibidos</span>
					</a>
					<a class="tile" href="pending" rel='external'>
						<span class="vector count" data-count="7">=</span>
						<span class="title"><strong>Artículos</strong> pendientes</span>
						<span class="desc"><strong>Revisiones</strong>/Asignaciones</span>
					</a>
					<a class="tile" href="current" rel='external'>
						<span class="vector">N</span>
						<span class="title"><strong>Ejemplar</strong> actual</span>
						<span class="desc"><strong>Revisar</strong>/actualizar</span>
					</a>
					<a class="tile" href="article" rel='external'>
						<span class="vector">L</span>
						<span class="title"><strong>Archivo</strong></span>
						<span class="desc"><strong>Antiguos</strong>/Otros</span>
					</a>
				</div>
			</div>

			<?php echo $this->fetch('content'); ?>
			<div id="footer">
				<div class="con">
					<h4>Pastel <span class="feather animated fadeIn">Feather</span> <span class="theme">Click to <strong>change theme</strong></span></h4>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
