<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Agregar Nuevo </span>Usuario</h4>
					<span>Aquí podra agregar un nuevo usuario Autor o Evaluador</span>
				</div>
					<form action="/laclomag/backend/addNewUser" method="post">
						<?php if(!empty($user)){?>
							<div class="container">
								<div class="col_3 carton alpha color sail" style="margin-top:10px;margin-left:25px;">
	                                <h2>Nombre del Usuario:</h2>
	                                <div class="content">
	                                    <?php echo $user['User']['first_name'];?>
	                                </div>
	                            </div>
	                            <div class="col_3 carton alpha color rushhour" style="margin-top:10px;">
	                                <h2>Correo Electrónico:</h2>
	                                <div class="content">
	                                    <?php echo $user['User']['email'];?>
	                                </div>
	                            </div>
	                            <div class="col_3 carton alpha color adrift" style="margin-top:10px;">
	                                <h2>Rol Deseado:</h2>
	                                <div class="content">
	                                    <?php echo $user['User']['last_name'];?>
	                                </div>
	                            </div>
	                        </div>
	                        <?php if($user['User']['last_name']=="Evaluador" || $user['User']['last_name']=="evaluador"){
	                        	echo '<input id="role" name="role" type="hidden" value="evaluator"/>';
	                        } else {
	                        	echo '<input id="role" name="role" type="hidden" value="author"/>';
	                        }?>
	                        <input id="id" name="id" type="hidden" value="<?php echo $user['User']['id'];?>"/>
						<?php } ?>
						<br/>
						<div class="container" style="margin-left:10px; margin-right:10px;">
							<p>Nombres y Apellidos</p>
							<p class="combine">
								<input name="first_name" id="first_name" type="text" placeholder="Nombres" required/>
								<input name="last_name" id="last_name" type="text" placeholder="Last name" required/>
							</p>
							<p>Correo Electrónico</p>
							<p>
								<input id="email" name="email" type="text" placeholder="Correo Electrónico" required/>
							</p>
							<p>Username</p>
							<p>
								<input id="username" name="username" type="text" placeholder="Nombre de Usuario" required/>
							</p>
							<?php if(empty($user)){?>
								<p>Rol en el Sistema</p>
								<p>
									<select name='role'>
										<option value="author" selected="selected">Autor</option>
										<option value="evaluator">Evaluador</option>
									</select>
								</p>
							<?php } ?>
							<?php if(!empty($user)){?>
								<input type="submit" name="submit" value="Aceptar Usuario" class="col full sugar twenty" style="margin-left:5%;"/>
								<input type="submit" name="submit" value="Rechazar Usuario" class="col full sugar twenty"/>
							<?php } else { ?>
								<input type="submit" name="submit" value="Agregar Usuario" class="col full sugar twenty" style="margin-left:5%;"/>
							<?php } ?>
						</div>
					</form>
			</div>
		</div>
	</div>	
</div>