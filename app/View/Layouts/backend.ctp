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
						<span>Messages</span>
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
						<h2><span>Bienvenido,</span> <br/><?php echo $firstName; ?></h2>
						
						<ul class="nav">
							<li>
								<a href="#home">*</a>
							</li>
							<li>
								<a href="#icons">8</a>
							</li>
							<li>
								<a href="#ui">&amp;</a>
							</li>
							<li>
								<a href="#more" data-reveal>v</a>
							</li>
						</ul>
					</div>

					<a class="tile" id="article">
						<span class="vector">C</span>
						<span class="title"><strong>New</strong> article</span>
						<span class="desc"><strong>Text</strong> editor</span>
					</a>
					<a class="tile" href="#ui" id="elements">
						<span class="vector">&amp;</span>
						<span class="title"><strong>UI</strong> elements</span>
						<span class="desc"><strong>Simply</strong> everything</span>
					</a>
					<a class="tile" id="comment">
						<span class="vector count" data-count="7">2</span>
						<span class="title"><strong>Photo</strong> montage</span>
						<span class="desc"><strong>Beautiful </strong> gallery</span>
					</a>
					<a class="tile" href="#iphone" id="mobile">
						<span class="vector">J</span>
						<span class="title"><strong>iPhone</strong> app</span>
						<span class="desc"><strong>Fast</strong> and fluid</span>
					</a>
					<a class="tile" href="#location" id="recent">
						<span class="vector">N</span>
						<span class="title"><strong>Location</strong> sandbox</span>
						<span class="desc"><strong>Google Maps</strong> API</span>
					</a>
					
					
					<ul id="more" class="icons">
						<li>
							<ul>
								<li class="iphone"><a href="#iphone">iPhone app</a></li>
								<li class="chart"><a id="charts_init" href="#charts">Charts</a></li>
								<li class="down"><a href="#sample">Sample page</a></li>
							</ul>
						</li>
						<li>
							<ul>
								<li class="warning"><a href="#errors">Error pages</a></li>
								<li class="taging"><a href="#docs">Docs</a></li>
								<li class="blank-star"><a href="#alerts">Notifications</a></li>
							</ul>
						</li>
						
					</ul>
					
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
