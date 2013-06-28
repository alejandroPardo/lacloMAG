<!--Log in screen-->
<div id="welcome">
	
	<div id="overlayLogo">
  		<?php echo $this->Html->image('bg.jpg', array('alt' => 'Overlay'));?>
  		<?php echo $this->Html->image('logoLogin.png', array('alt' => 'Logo'));?>
	</div>
  	
	
	<div id="password">
		<div class="input username"><input id="username" type="text" placeholder="Email o Username" /></div>
		<div class="input password"><input id="pass" type="password" placeholder="Contraseña" /></div>
		<button id="boton">Entrar</button>
		<div id="forgot">
			<div id="modals" class="tab">
				<br>
				<button><strong>¿Olvidó su Clave?</strong></button>
			</div>
		</div>
	</div>

	

	

</div>
