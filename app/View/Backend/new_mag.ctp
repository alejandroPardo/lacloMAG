<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Crear Próxima</span> Revista</h4>
					<span>Escriba el nombre de la revista, este no necesariamente será el título de portada de la misma.</span>
				</div>
				<?php echo $this->Form->create('Magazine', array(array('controller' => 'backend', 'action' => 'newMag'), 'enctype' => 'multipart/form-data')); ?>
					<p style="margin-left:5%;" >Nombre de la Revista</p>
					<p>
						<input name="name" type="text" placeholder="Nombre de la Revista" style="width:80%;margin-left:10%;"/>
					</p>
					<input type="submit" value="Crear Revista" name="send" class="lime twenty" style="margin-left:5%;" id="btnForm" /> 
					<br><br>
				</form>
			</div>
		</div>
	</div>
</div>