<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col sixty" style="height:500px;">
			<div class="content">
				<div class="heading">
					<h4><span>Portada de </span>Revista</h4>
					<span>Creación de portada para la revista</span>
				</div>
				<div class="wrapper padding">
					<div class="profileData">
						<?php echo $this->Form->create(null, array('url' => array('controller' => 'backend', 'action' => 'previewCover'), 'enctype' => 'multipart/form-data'));?>
							<p>Título de Portada</p>
							<p>
								<input id="title" name="title" type="text" placeholder="Título" />
							</p>
							<p>Descripción de Portada (140 Caracteres)</p>
							<p>
								<input id="desc" name="desc" type="text"  maxlength="140" placeholder="Descripción" />
							</p>
							<p>Edicion: (</p>
							<p>
								<input id="desc" name="desc" type="text" placeholder="Descripción" />
							</p>
					</div>
				</div>
			</div>
		</div>
		<div id="pie" class="col fourty last" style="height:500px;">
			<div class="content">
				<div class="heading">
					<h4><span>Revista</span> <?php echo $magazine['Magazine']['title'];?></h4>
				</div>
				<div class="wrapper padding">
					<div class="profileData">
							
							<p>Color de Fondo</p>
							<p>
								<input name="color" class="color" type="text">
							</p>
							<p>Color de Letra</p>
							<p>
								<input name="fontcolor" class="color" type="text" value="000000">
							</p>
							<input name="magazine" type="hidden" value="<?php echo $magazine['Magazine']['id'];?>" />
							<input type="submit" value="Visualizar" class="full sugar" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>