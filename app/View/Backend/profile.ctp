<div class="row widgets">
	<div id="pie" class="col sixty">
		<div class="content">
			<div class="heading">
				<h4><span>Datos del </span>Usuario</h4>
				<span>Aquí podra cambiar sus datos personales</span>
			</div>
			<div class="wrapper padding">
				<div class="profileData">
					<form action="prueba" method="post">
					<p>Nombres y Apellidos</p>
					<p class="combine">
						<input id="firstname" type="text" placeholder="Nombres" value=<?php echo $firstNameProfile;?> />
						<input id ="lastname" type="text" placeholder="Last name" value=<?php echo $lastNameProfile;?> />
					</p>
					<p>Correo Electrónico</p>
					<p>
						<input id="email" type="text" placeholder="Correo Electrónico" value=<?php echo $emailProfile;?> />
					</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div id="pie" class="col fourty last">
		<div class="content">
			<div class="heading">
				<h4><span>Cambiar</span> contraseña</h4>
				<span>Ingrese y confirme su nueva contraseña para cambiarla</span>
			</div>
			<div class="wrapper padding">
				<div class="profileData">
					<form action="prueba" method="post">
						<p>Nueva Contraseña</p>
						<p>
							<input id="pass1" type="password" placeholder="Contraseña" />
						</p>
						<p>Confirme Nueva Contraseña</p>
						<p>
							<input id="pass2" type="password" placeholder="Confirme Contraseña" />
						</p>
						<input type="submit" value="Enviar" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>	