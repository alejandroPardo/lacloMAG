<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col sixty">
			<div class="content">
				<div class="heading">
					<h4><span>Datos del </span>Usuario</h4>
					<span>Aquí podra cambiar sus datos personales</span>
				</div>
				<div class="wrapper padding">
					<div class="profileData">
						<form action="/laclomag/backend/changeUserData" method="post">
							<p>Nombres y Apellidos</p>
							<p class="combine">
								<input name="first_name" id="first_name" type="text" placeholder="Nombres" value=<?php echo $firstNameProfile;?> />
								<input name="last_name" id="last_name" type="text" placeholder="Last name" value=<?php echo $lastNameProfile;?> />
							</p>
							<p>Correo Electrónico</p>
							<p>
								<input id="email" name="email" type="text" placeholder="Correo Electrónico" value=<?php echo $emailProfile;?> />
							</p>
							<input type="submit" value="Modificar Datos" class="col full sugar" />
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
						<form action="/laclomag/backend/changeUserPassword" method="post">
							<p>Antigua Contraseña</p>
							<p>
								<input name="pass1"  id="pass1" type="password" placeholder="Contraseña" />
							</p>
							<p>Contraseña Nueva</p>
							<p>
								<input name="pass2" id="pass2" type="password" placeholder="Confirme Contraseña" />
							</p>
							<p>Confirme Nueva Contraseña</p>
							<p>
								<input name="pass3" id="pass3" type="password" placeholder="Confirme Contraseña" />
							</p>
							<input type="submit" value="Cambiar Contraseña" class="full sugar" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>