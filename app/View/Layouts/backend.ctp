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
					<li class="count">
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
					<?php if($pendingMessages>0){echo "<li class='count indicator'>"; } else {echo "<li class='count'>"; }?>
					<span data-count=<?php echo $pendingMessages;?>>Mensajes</span>
						<ul>
							<?php foreach( $messages as $message ): ?>
								<?php 
									if($message['MappedMessage']['is_read']==0){
										echo "<li class='unread'>";
									} else {
										echo "<li>";
									}
								?>
							    	<a href="ajax" data-modal>
										<h4>De: 
											<?php 
												echo ($message['User']['username']);
											?>
										</h4>
										<p><?php echo ($message['Message']['content']);?></p>
									</a>
								</li>
							<?php endforeach; ?>
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
					<?php 
						if ($role == 'Administrador'){
							echo $this->element('menuAdmin'); 
						} else if ($role == 'Autor'){
							echo $this->element('menuAuthor'); 
						} else if ($role == 'Editor'){
							echo $this->element('menuEditor'); 
						} else if ($role == 'Evaluador'){
							echo $this->element('menuEvaluator'); 
						}
					?>
				</div>
			</div>

			<?php echo $this->fetch('content'); ?>
			<div id="footer">
			<div class="container">
			    <div class="col_2 alpha">
			    	I
			    </div>
			    <div class="col_2">
			    	<br/>
			    	<br/>
			   		<?php echo $this->Html->image('laclo-logo.png');?>
			    </div>
			    <div class="col_4">
			    	<div class="latam">
			    		<?php echo $this->Html->image('latam.png');?>
			    	</div>
			    	<h4><span class="theme">Copyright © 2013 Universidad Central de Venezuela. Todos los derechos reservados.</span></h4>
			    </div>
			    <div class="col_2">
			    	<br/>
			   		<?php echo $this->Html->image('ucv-logo.png');?>

			    </div>
			</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
