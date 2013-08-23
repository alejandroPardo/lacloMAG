<?php echo $this->Form->create('Paper', array('action' => 'saveEvaluation')); ?>
	<div class="section current">
		<div class="row widgets">
			<div id="pie" class="col full">
				<div class="content">
					<div class="heading">
						<h4><span>Revisión</span> de Artículos</h4>
						<span>Aquí puede colocar observaciones o correcciones sobre el artículo a corregir.</span>
					</div>
					<div class="section current padding" title="Text" id="text">
						<div class="carton container border">
							<div id="editor-textarea" class="column">
							</div>
							<div id="editor-preview" class="column right">
								<div class="redactor_box redactor_editor">
									<?php echo $paper; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<br><br>
					<div class="profileData">
						<p>Estado de revisión de Artículo</p>
						<p>
							<select name="selection">
							    <option selected="selected">Todavía en Corrección</option>
							    <option>Aprobado</option>
							    <option>Rechazado</option>
							    <option>El Editor necesita hacer cambios menores</option>
							    <option>El Autor necesita hacer cambios</option>
							</select>
						</p>
						<p>Enviar o Guardar Evaluación</p>
						<p>
							<input type="hidden" name="evaluatorid" value="<?php echo $evaluatorid;?>">
							<input type="submit" value="Enviar" name="send" class="lime twenty" style="margin-left:5%;" id="btnForm"/> 
							<input type="submit" value="Guardar Previo" name="send" class="lime twenty" id="btnForm"/>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(document).ready(function(){
		$.editor("<?php echo $comment;?>", "#editor-textarea");
	});
</script>