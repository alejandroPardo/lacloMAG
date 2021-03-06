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
		echo $this->Html->meta('viewport', null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0'),false);
		echo $this->Html->css('app');
		echo $this->Html->css('redactor');

		echo $this->Html->script('library');
		echo $this->Html->script('initialize');
		echo $this->Html->script('app');
		echo $this->Html->script('redactor');
		echo $this->Html->script('jscolor');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div style="width:216mm; height: 279"> </div>
	<?php 
		if($this->Session->check('Message.flash')){ 
			echo "<script>";
				echo "$(document).ready(function(){";
				    echo "$.notification({ title: 'Notificación al Usuario.', content: ' ".$this->Session->flash()."', icon: '!', border: false });";
				echo "});";
			echo "</script>";
		}
	?>

	<div id="container">
		<div id="content">
			<div id="header">
				<ul class="con">
					<li class="dashboard">
						<?php 
							echo $this->Html->link(
								'&nbsp;',
							array(
								'controller' => 'backend', 
								'action' => 'index'),
							array( 
								'rel' => 'external', 
								'escape'=> false)
							);
						?>

					</li>
					<?php if($role=='Editor'){?>
						<?php if($newCount>0){echo "<li class='count indicator'>"; } else {echo "<li class='count'>"; }?>
						<span data-count=<?php echo $newCount;?>>Nuevos Usuarios</span>
							<ul>
								<li>
									<?php 
										echo $this->Html->link(
											'<h4>Agregar Nuevo Usuario</h4>
											<p>LACLOmagazine</p>',
										array(
											'controller' => 'backend', 
											'action' => 'addUser', '0'),
										array( 
											'rel' => 'external', 
											'escape'=> false)
										);
									?>
								</li>
								<?php foreach( $newUsers as $newUser ): ?>
									<li>
								    	<a href="addUser/<?php echo ($newUser['User']['id']);?>" rel="external">
											<h4>Agregar Nuevo: <?php echo ($newUser['User']['last_name']);?></h4>
											<p><?php echo ($newUser['User']['first_name']);?> // <?php echo ($newUser['User']['email']);?></p>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
						<li>
							<span>Noticias</span>
							<ul>
								<li>
									<?php 
										echo $this->Html->link(
											'<h4>Redactar Nueva Noticia</h4>
											<p>Publicar en LACLOmagazine</p>',
										array(
											'controller' => 'backend', 
											'action' => 'createNews'),
										array( 
											'rel' => 'external', 
											'escape'=> false)
										);
									?>
								</li>
								<li>
									<?php 
										echo $this->Html->link(
											'<h4>Ver Noticias</h4>
											<p>Administrar noticias</p>',
										array(
											'controller' => 'backend', 
											'action' => 'viewNews'),
										array( 
											'rel' => 'external', 
											'escape'=> false)
										);
									?>
								</li>
							</ul>
						</li>
					<?php } ?>
					<li >
						<?php 
							echo $this->Html->link(
								'<span>Ir al FrontEnd</span>',
							array(
								'controller' => 'home', 
								'action' => 'index'),
							array( 
								'rel' => 'external', 
								'target' => '_blank',
								'escape'=> false)
							);
						?>
					</li>
					<li class="avatar">
						<?php echo $this->Html->image('avatar.jpg', array('alt' => 'avatar'));?>
						<ul>
							<li>
								<?php 
									echo $this->Html->link(
										'<h4>'.$fullName.'</h4>
										<p>Editar tu perfil</p>',
									array(
										'controller' => 'backend', 
										'action' => 'profile'),
									array( 
										'rel' => 'external', 
										'escape'=> false)
									);
								?>
							</li>
							<li>
								<?php 
									echo $this->Html->link(
										'<h4>Desconectarse</h4>
										<p>Salir de la aplicación</p>',
									array(
										'controller' => 'backend', 
										'action' => 'logout'),
									array( 
										'rel' => 'external', 
										'escape'=> false)
									);
								?>
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
			<input type="hidden" id="role" value=<?php echo $role;?>>
			<div id="dashboard">
				<div class="scroll con">
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
			<div id="footer">
			<div class="container">
			    <div class="col_2 alpha">
			    	I
			    </div>
			    <div class="col_2">
			    	<br/>
			    	<br/>
			   		<?php echo $this->Html->image('laclo-logo.png');?>
			   		<h4><span class="theme">
			    		<div class="footersegmentleft">
			    		<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><?php echo $this->Html->image('cc.png');?></a><br/>
						Excepto al indicarse lo contrario, el contenido de este sitio tiene licencia internacional <strong>Creative Commons Attribution 4.0.</strong><br>
						</div>
					</span></h4>
			    </div>
			    <div class="col_4">
			    	<div class="latam">
			    		<?php echo $this->Html->image('latam.png');?>
			    	</div>
			    </div>
			    <div class="col_2">
			    	<br/>
			   		<?php echo $this->Html->image('ucv-logo.png');?>
			   		<h4><span class="theme">
			   			<div class="footersegmentright">
							<strong>Desarrolladores:</strong> <a href="mailto:alejandro.pardo.r@gmail.com">Alejandro Pardo</a> // <a href="mailto:jcamejo3@gmail.com">Juan Carlos Camejo</a>
							<br><strong>Tutores:</strong> <a href="mailto:yoslyhernandez@gmail.com">Yosly Hernández</a> // <a href="mailto:asilva.sprock@gmail.com">Antonio Silva</a>
						</div>
					</span></h4>
			    </div>
			</div>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>
