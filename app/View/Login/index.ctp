<!--Log in screen-->
<div id="welcome">
	
	<div id="overlayLogo">
  		<?php echo $this->Html->image('bg.jpg', array('alt' => 'Overlay'));?>
  		<?php echo $this->Html->image('logoLogin.png', array('alt' => 'Logo'));?>
	</div>
  	
	
	<div id="password">
		<div class="input username"><input type="text" placeholder="Usuario" /></div>
		<div class="input password"><input type="password" placeholder="Contraseña" /></div>
		<button>Log in</button>
	</div>
</div>