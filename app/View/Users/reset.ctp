<?php
if($this->Session->flash('bad')){
?>
	<div style="position: fixed; left: 50%; top: 50%; height: 400px; margin-top: -200px; width: 500px; margin-left: -250px;">
		<h1 style="color: white; text-align:center;">La ficha de recuperación de clave es invalida o ya fue utilizada</h1>
		<div id="forgot">
			<a href='../login'><button>Iniciar Sesión</button></a>
		</div>
	</div>
<?php
} else {
?>
<div style="position: fixed; left: 50%; top: 50%; height: 400px; margin-top: -200px; width: 500px; margin-left: -250px;">
	<h1 style="color: white;">Cambio de Contraseña</h1>
	<br>
	<div id="forgot">
		<h4 style="color: white;">Nueva Contraseña</h4>
		<div class="forEmail first"><input id="pass1" type="password" placeholder="Ingrese nueva contraseña" /></div>
		<br>
		<h4 style="color: white; font-weight:bold;">Escriba nuevamente la Contraseña</h4>
		<div class="forEmail second"style="font-weight:bold;"><input id="pass2" type="password" placeholder="Ingrese nuevamente la contraseña" /></div>
		<br>
		<input id="token" type="hidden" value=<?php echo $token;?> />
		<button id="btnRecover" class="btnRecover">Recuperar Contraseña</button>
	</div>
</div>
<?php
	}
?>