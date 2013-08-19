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
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
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
					<?php if($pendingMessages>0){echo "<li class='count indicator'>"; } else {echo "<li class='count'>"; }?>
					<span data-count=<?php echo $pendingMessages;?>>Mensajes</span>
						<ul>
							<li>
								<a href="#" rel="external">
									<h4>Enviar Nuevo Mensaje</h4>
									<p>Miembros de LACLOmagazine</p>
								</a>
							</li>
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
