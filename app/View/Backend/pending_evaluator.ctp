<div class="section current">
	<div class="row widgets">
		<div id="pie" class="col full">
			<div class="content">
				<div class="heading">
					<h4><span>Ver</span> artículos</h4>
					<span>Aquí puede visualizar todos sus artículos creados.</span>
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
				<input type="submit" value="Enviar" name="send" class="lime twenty" style="margin-left:5%;" id="btnForm" onclick="return formBtn()" /> 
					<input type="submit" value="Guardar Previo" name="send" class="lime twenty" id="btnForm"  onClick="return formBtn();"/>
					<br><br>
			</div>
		</div>
	</div>
</div>
